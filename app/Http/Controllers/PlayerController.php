<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\riotapi;
use App\ApiResponder;
use App\Player;
use App\GameTypeStats;
use App\Rune;
use App\Jobs\UpdateOrCreatePlayerJob;


class PlayerController extends Controller
{
    //
    private $connection;
    private $apiResponder;
    private $regions =  ['BR', 'EUNE', 'EUW', 'JP', 'KR', 'LAN', 'LAS', 'NA', 'OCE', 'RU', 'TR'];

    const PLAYER_FULL_REFRESH_TIMER = 6;
    const PLAYER_MATCHES_REFRESH_TIMER = 6;

	public function __construct() {
		$this->apiResponder = new ApiResponder();
		$this->connection = new riotapi('na');
	}


	/*
		Endpoint: api/player/$region/$name
		Param $region = [
			na, eu, oce, etc] 
		Param $name String

		Notes:
			api responder is a custom helper class I made in App/HTTP/ApiResponder.php


	*/
    public function byName($region, $name) {
    	$this->apiResponder->setCode(404);

    	/* Non recognized region */
    	if (!in_array(strtoupper($region), $this->regions)) {
    		$this->apiResponder->setError("Unknown Region");
    		return $this->apiResponder->send();
    	}
    	
    	$player = $this->updateOrCreateInitialPlayer($name, $region);
    
		
		if (!empty($player)) {
			$this->apiResponder->setCode(200);
			$this->apiResponder->setData($player->encapsulate());
		} else {
            $this->apiResponder->setError("Unable to find Player with name $name in $region");
        }
		return $this->apiResponder->send();
    }

    public function challenger(){
        $challengerList = $this->connection->getChallenger();
        return $challengerList;
    }

    public function byNameJob($region, $name) {
        /* Non recognized region */
        if (!in_array(strtoupper($region), $this->regions)) {
            $this->apiResponder->setError("Unknown Region");
            return $this->apiResponder->send();
        }

        $job = (new UpdateOrCreatePlayerJob($name, $region));
        $this->dispatch($job);

        $this->apiResponder->setCode(200);
        $this->apiResponder->setData(
            ["listen_on" => "Listen for broadcast on event://player::$name"]
        );
        return $this->apiResponder->send();
    }

    public function runesById($id){
        $data = $this->connection->getSummoner($id, 'runes');

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

    /*
            foreach($page['slots'] as $rune){
                $runes = Rune::where('summonerId', $id)
                                ->where('page', $page)
                                ->where('slot', $rune['slots'])
                                ->first();
                if(!$runes){
                    $runes = new Rune;
                }
                $runes->summonerId = $id;
                $runes->save();
            } 
    */
    
    /* Returns a player object */
    private function updateOrCreateInitialPlayer($name, $region) {
    	/* Do initial DB lookup */
    	$player =  Player::where('summonerName', $name)
    					   ->where('region', $region)
    					   ->first();

    	if (!$player) {
    		// No player exists in our DB with this information, need to manually create it
    		// by doing an API request
    		$player = $this->createPlayer($name, $region);
            $runes = $this->runesById($player->summonerId);
		} else {
			// We have this player's record in our database. If it hasn't been updated in
			// PLAYER_FULL_REFRESH_TIMER, we'll 
			if (time() - time($player->updated_at) > self::PLAYER_FULL_REFRESH_TIMER) {
				$player->updatePlayerFull($this->connection);
                $runes = $this->runesById($player->summonerId);

			}
		}
		return $player;
    }

    // very expensive. Need to look up player data,
    // as well as full match data
    private function createPlayer($name, $region) {
    	
    	// no data, need to do lookup
		$this->connection->setRegion($region);
		$data = $this->connection->getSummonerByName($name);
		
        if (!$data) return;

		// create model and initialize with values
		$player = new Player;
		$player->region = $region;
		$player->summonerName = $name;
		$player->summonerId = $data[$name]['id'];

		// grab ID, and use it to query into the stats endpoint
		$summId = $data[$name]['id'];

		// Update database records for General Match Type Statistics
		
		$overallStatistics = $player->updateMatchTypeStats($this->connection);
		$player->updateMatches($this->connection);

		$player->wins = $overallStatistics['totalWins'];
		$player->totalChampionKills = $overallStatistics['totalChampionKills'];
		$player->assists = $overallStatistics['totalAssists'];
		$player->neutralMinionKills = $overallStatistics['totalNeutralMinionsKilled'];
		$player->turretsDestroyed = $overallStatistics['totalTurretsKilled'];

		//Save these attributes
		$player->save();
		return $player;
    }
    

    public function byIdMatch($region, $id) {

    }

    public function matchHistory($region, $name) {
    	$this->apiResponder->setCode(404);

    	/* Non recognized region */
    	if (!in_array(strtoupper($region), $this->regions)) {
    		$this->apiResponder->setError("Unknown Region");
    		return $this->apiResponder->send();
    	}
    	
    	$player = $this->updateOrCreateInitialPlayer($name, $region); 
		if (!empty($player)) {
    		if (time() - time($player->updated_matches_at) > self::PLAYER_MATCHES_REFRESH_TIMER) {
				$player->updateMatches($this->connection);
			}
			$this->apiResponder->setCode(200);
			$this->apiResponder->setData($player->PlayerMatches);
		}		
    	
    	

		return $this->apiResponder->send();
    }

    public function showPlayer($region, $name) {
    	return view('player');
    }

    public function summonerInfo($id) {
    	$json['summary'] = $this->connection->getSummoner($id);
    	$json['masteries'] = $this->connection->getSummoner($id, 'masteries');
    	$json['runes'] = $this->connection->getSummoner($id, 'runes');
    	return $json;
    }
}
