<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\riotapi;

use App\GameTypeStats;
use App\PlayerMatch;
use App\Match;
use App\Player;
use App\Rune;
use Event;
use App\Events\PlayerWasRefreshed;

class UpdateOrCreatePlayerJob extends Job implements ShouldQueue
{
    use InteractsWithQueue;
    const PLAYER_FULL_REFRESH_TIMER = 6;

    protected $player;
    private $apiConnection;
    
    private $playerName;
    private $playerRegion;
    private $summonerId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $region) {
        //
        $this->apiConnection = new riotapi($region);
        
        $player =  Player::where('summonerName', $name)
                           ->where('region', $region)
                           ->first();
        
        $this->playerName = $name;
        $this->playerRegion = $region;

        // could be null at this point
        $this->player = $player;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        
        if ($this->attempts() > 3) {
            //
            $this->release(10);
            return;
        }

        if (!$this->player) {
            // No player exists in our DB with this information, need to manually create it
            // by doing an API request
            $status = $this->createPlayer($this->playerName, $this->playerRegion);
            if ($status == false) return;

            $runes = $this->runesById($this->summonerId);
        } else {
            // We have this player's record in our database. If it hasn't been updated in
            // PLAYER_FULL_REFRESH_TIMER, we'll 
            if (time() - time($this->player->updated_at) > self::PLAYER_FULL_REFRESH_TIMER) {
                $this->updatePlayerFull();
            }
        }

        // fire socket event
        Event::fire(new PlayerWasRefreshed($this->player));
    }


    // very expensive. Need to look up player data,
    // as well as full match data
    private function createPlayer($name, $region) {
        
        // no data, need to do lookup
        $this->apiConnection->setRegion($region);
        $data = $this->apiConnection->getSummonerByName($name);
        if (!$data) return False;
        // create model and initialize with values

        $this->player = new Player;

        $this->player->summonerName = $name;
        $this->player->region = $region;
        $this->player->summonerId = $data[$name]['id'];
        $this->summonerId = $data[$name]['id'];

        // Update database records for General Match Type Statistics
        
        $overallStatistics = $this->updateMatchTypeStats();
        $this->updateMatches();
        return True;
    }
    
    // this is pretty damn expensive
    private function updateMatches() {


        $matchHistory = $this->apiConnection->getMatchHistory($this->summonerId);
        $count = 0;

        foreach ($matchHistory["matches"] as $match) {
            if ($count > 5) break;
            

            $this->matchLookupOrCreate($match);
            
            $count++;
        }

        // now we set the updated_matches_at timestamp to the current time and save
        $this->updated_matches_at = time();
        $this->player->save();
    }

    private function matchLookupOrCreate($match) {
        // if we haven't stored this match before, lets
        // grab it and throw it in our sql database
        // otherwise no need to do that.
        $matchModel = Match::where('platformId', $match['platformId'])
                            ->where('matchId', $match['matchId'])
                            ->first();
        if (!$matchModel) {
            $matchModel = new Match;
            $matchData = $this->apiConnection->getMatch($match['matchId']);
            
            $participantIdentities = $matchData['participantIdentities'];
            
            foreach ($participantIdentities as $participant) {
                $partId = $participant['participantId'];
                $summonerId = $participant['player']['summonerId'];
                $pm = PlayerMatch::where('summonerId', $summonerId)
                                        ->where('platformId', $match['platformId'])
                                        ->where('matchId', $match['matchId'])
                                        ->first();
                if(!$pm) {
                    $playerMatch = new PlayerMatch;
                    // identifiers
                    $playerMatch->summonerId = $summonerId;
                    $playerMatch->platformId = $match['platformId'];
                    $playerMatch->matchId = $match['matchId'];
                    // subquery riot match api with matchid

                    foreach ($matchData['participants'] as $participant) {
                        if ($participant['participantId'] == $partId) {
                            $stats = $participant['stats'];
                            
                            $playerMatch->won = $stats['winner'];
                            $playerMatch->kills = $stats['kills'];
                            $playerMatch->deaths = $stats['deaths'];
                            $playerMatch->assists = $stats['assists'];
                            $playerMatch->wards_placed = $stats['wardsPlaced'];
                            $playerMatch->wards_killed = $stats['wardsKilled'];
                            $playerMatch->first_blood = $stats['firstBloodKill'] || $stats['firstBloodAssist'];
                            $playerMatch->lane = $participant['timeline']['lane'];
                            $playerMatch->role = $participant['timeline']['role'];
                            $playerMatch->champion = $participant['championId'];
                        }
                    }

                    
                    $playerMatch->queue = $matchData['queueType'];
                    $playerMatch->season = $matchData['season'];
                    $playerMatch->serverTime = $matchData['matchCreation'];
                    $playerMatch->save();
                    
                }
            }
            $matchModel->platformId = $match['platformId'];
            $matchModel->matchId = $match['matchId'];
            $matchModel->queue = $matchData['queueType'];
            $matchModel->season = $matchData['season'];
            $matchModel->serverTime = $matchData['matchCreation'];
            $matchModel->save();
        }
    }
    private function updatePlayerFull() {
        
        // refreshing data, need to do lookup
        $this->apiConnection->setRegion($this->player->region);
        $data = $this->apiConnection->getSummonerByName($this->player->summonerName);

        $this->player->summonerId = $data[$this->playerName]['id'];
        $this->summonerId = $data[$this->playerName]['id'];

        // Do a rune refresh here as well
        $runes = $this->runesById($player->summonerId);

        // Update database records for General Match Type Statistics
        // and specific match type stats
        $this->updateMatchTypeStats();
        
        $this->player->save();
        
    }

    private function updateMatchTypeStats() {
        $stats = $this->getStats();
        
        $totalTurretsKilled = 0;
        $totalChampionKills = 0;
        $totalAssists = 0;
        $totalNeutralMinionsKilled = 0;
        $totalWins = 0;

        foreach ($stats['playerStatSummaries'] as $statSummary) {
            $gameTypeKey = $statSummary['playerStatSummaryType'];

            //Map game type string to ID from GameTypeStats types object
            $gameTypeId = GameTypeStats::getType($gameTypeKey);
            
            $gameTypeStats = GameTypeStats::where('summonerId', $this->summonerId)
                                            ->where('region', $this->playerRegion)
                                            ->where('gameTypeId', $gameTypeId)
                                            ->first();

            if (!$gameTypeStats) {
                $gameTypeStats = new GameTypeStats;
            }
            // it makes sense to overwrite our database here
            //  since these structures are modified often
            //  ie (number of wins in Unranked5x5)
            $gameTypeStats->summonerId = $this->summonerId;
            $gameTypeStats->region = $this->playerRegion;
            $gameTypeStats->gameTypeId = $gameTypeId;
            
            $agregatedStats = $statSummary['aggregatedStats'];
            
            $gameTypeStats->wins = $statSummary['wins'] ?: 0;
            $totalWins += $gameTypeStats->wins;

            // Sorry this is disgusting.. :[

            $gameTypeStats->totalChampionKills = 
                isset($agregatedStats['totalChampionKills']) ? $agregatedStats['totalChampionKills']
                : 0;
            $totalChampionKills += $gameTypeStats->totalChampionKills;
            
            $gameTypeStats->totalTurretsKilled = 
                isset($agregatedStats['totalTurretsKilled']) ? $agregatedStats['totalTurretsKilled']
                : 0;
            $totalTurretsKilled += $gameTypeStats->totalTurretsKilled;

            $gameTypeStats->totalNeutralMinionsKilled = 
                isset($agregatedStats['totalNeutralMinionsKilled']) ? $agregatedStats['totalNeutralMinionsKilled']
                : 0;
            $totalNeutralMinionsKilled += $gameTypeStats->totalNeutralMinionsKilled;

            $gameTypeStats->totalAssists = 
                isset($agregatedStats['totalAssists']) ? $agregatedStats['totalAssists']
                : 0;
            $totalAssists += $gameTypeStats->totalAssists;
        
            
            $gameTypeStats->save();
        }
        $this->player->wins = $totalWins;
        $this->player->totalChampionKills = $totalChampionKills;
        $this->player->assists = $totalAssists;
        $this->player->neutralMinionKills = $totalNeutralMinionsKilled;
        $this->player->turretsDestroyed = $totalTurretsKilled;
        
    }

    private function getStats($ranked = false) {
        if ($ranked) {
            $r = $this->apiConnection->getStats($this->summonerId, 'ranked');
        } else {
            $r = $this->apiConnection->getStats($this->summonerId);
        }
        return $r;
    }

    private function runesById($id){
        $data = $this->apiConnection->getSummoner($id, 'runes');

        foreach ($data[$id]['pages'] as $page) {
            foreach($page['slots'] as $rune){
                $runes = Rune::where('summonerId', $id)
                                ->where('page', $page)
                                ->where('slot', $rune['runeSlotId'])
                                ->first();
                if(!$runes){
                    $runes = new Rune;
                }
                $runes->summonerId = $id;
                $runes->page = $page['id'];
                $runes->slot = $rune['runeSlotId'];
                $runes->runeId = $rune['runeId'];
                $runes->pageName = $page['name'];
                $runes->save();
            }
       
        }
        return $data;
    }
}
