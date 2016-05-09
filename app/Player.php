<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GameTypeStats;
use App\PlayerMatch;
use App\Match;
use App\Rune;

class Player extends Model
{
	
	public function __construct() {

	}
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'player';

    private $regions =  ['BR', 'EUNE', 'EUW', 'JP', 'KR', 'LAN', 'LAS', 'NA', 'OCE', 'RU', 'TR'];
    
    private $specificMatchStats = [];

    // Returns the full model encapsulated
    // for delivery over API
    public function encapsulate() {
    	
    	// doing this forces the call to $this->gameTypeStats()
    	// which adds the foreign key relationship to the player object
    	// populating the gameTypeStats field with data
    	// from the gameTypeStats mysql db table on the player object.
    	// even though this variable is unsed. This allows us 
    	$stats = $this->GameTypeStats;
    	$recentMatches = $this->mostRecentGames(5);
    	$runes = Rune::where('summonerId', $this->summonerId)->get();
    	
    	$json = [];
    	// copy player data over into this json field
    	// this includes agregate match stats since they're
    	// part of the player model
    	$json['playerData'] = $this;
    	$json['recentMatches'] = $recentMatches;
    	$json['runes'] = $runes;
    	
    	return $json;
    }
    
    

    public function updatePlayerFull($connection) {
    	
    	// refreshing data, need to do lookup
		$connection->setRegion($this->region);
		$data = $connection->getSummonerByName($this->summonerName);



		// Update database records for General Match Type Statistics
		// and specific match type stats
		$overallStatistics = $this->updateMatchTypeStats($connection);

		// This includes total wins and other stats for ALL game types
		$player->wins = $overallStatistics['totalWins'];
		$player->totalChampionKills = $overallStatistics['totalChampionKills'];
		$player->assists = $overallStatistics['totalAssists'];
		$player->neutralMinionKills = $overallStatistics['totalNeutralMinionsKilled'];
		$player->turretsDestroyed = $overallStatistics['totalTurretsKilled'];
		
		$player->save();
		
		return $object;
    }

    public function updateMatchTypeStats($connection) {
		$stats = $this->getStats($connection);
		
		if (!$stats) return;

		$totalTurretsKilled = 0;
		$totalChampionKills = 0;
		$totalAssists = 0;
		$totalNeutralMinionsKilled = 0;
		$totalWins = 0;
		
		if (!isset($stats['playerStatSummaries'])) return;

		foreach ($stats['playerStatSummaries'] as $statSummary) {
			$gameTypeKey = $statSummary['playerStatSummaryType'];

			//Map game type string to ID from GameTypeStats types object
			$gameTypeId = GameTypeStats::getType($gameTypeKey);
			
			$gameTypeStats = GameTypeStats::where('summonerId', $this->summonerId)
											->where('region', $this->region)
											->where('gameTypeId', $gameTypeId)
											->first();

			if (!$gameTypeStats) {
				$gameTypeStats = new GameTypeStats;
			}
			// it makes sense to overwrite our database here
			//  since these structures are modified often
			//  ie (number of wins in Unranked5x5)
			$gameTypeStats->summonerId = $this->summonerId;
			$gameTypeStats->region = $this->region;
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

		return [
				'totalWins' => $totalWins,
				'totalChampionKills' => $totalChampionKills,
				'totalTurretsKilled' => $totalTurretsKilled,
				'totalNeutralMinionsKilled' => $totalNeutralMinionsKilled,
				'totalAssists' => $totalAssists
		];
    }

    public function getStats($connection, $ranked = false) {
    	if ($ranked) {
    		$r = $connection->getStats($this->summonerId, 'ranked');
    	} else {
    		$r = $connection->getStats($this->summonerId);
    	}
    	return $r;
    }

    public function GameTypeStats() {

        return $this->hasMany('App\GameTypeStats', 'summonerId', 'summonerId');

    }

    // this is pretty damn expensive
    public function updateMatches($connection) {


    	$matchHistory = $connection->getMatchHistory($this->summonerId);
    	$count = 0;

    	if (!$matchHistory) return;
    	foreach ($matchHistory["matches"] as $match) {
    		if ($count > 5) break;
    		

    		$this->matchLookupOrCreate($connection, $match);
    		
	    	$count++;
    	}

    	// now we set the updated_matches_at timestamp to the current time and save
    	$this->updated_matches_at = time();
		$this->save();
    }

    public function matchLookupOrCreate($connection, $match) {
	    // if we haven't stored this match before, lets
		// grab it and throw it in our sql database
		// otherwise no need to do that.
    	$matchModel = Match::where('platformId', $match['platformId'])
							->where('matchId', $match['matchId'])
							->first();
		if (!$matchModel) {
			$matchModel = new Match;
			$matchData = $connection->getMatch($match['matchId']);
			
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
			$matchModel->matchId = $match['matchId'];
			$matchModel->queue = $matchData['queueType'];
			$matchModel->season = $matchData['season'];
			$matchModel->serverTime = $matchData['matchCreation'];
			$matchModel->save();
		}
    }
    


    // Retrieves the last $number matches from 
    // PlayerMatch for a specific player object
    public function mostRecentGames($number) {
    	return PlayerMatch::where('summonerId', $this->summonerId)
    							->orderBy('serverTime', 'desc')
    							->take($number)
    							->get();
    }

    public function PlayerMatches() {
    	return $this->hasMany('App\PlayerMatch', 'summonerId', 'summonerId');
    }
    
}
