<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\riotapi;
use App\ApiResponder;
use App\Player;
use App\GameTypeStats;


class PlayerController extends Controller
{
    //
    private $connection;
    private $apiResponder;
    private $regions =  ['BR', 'EUNE', 'EUW', 'JP', 'KR', 'LAN', 'LAS', 'NA', 'OCE', 'RU', 'TR'];

    const PLAYER_FULL_REFRESH_TIMER = 6;

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

		// 
		if (!empty($player)) {
			$this->apiResponder->setCode(200);
			$this->apiResponder->setData($player->encapsulate());
		} else {
			$this->apiResponder->setCode(404);
		}

		return $this->apiResponder->send();
    }
    
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
		} else {
			// We have this player's record in our database. If it hasn't been updated in
			// PLAYER_FULL_REFRESH_TIMER, we'll 
			if (time() - time($player->updated_at) > self::PLAYER_FULL_REFRESH_TIMER) {
				$player->updatePlayerFull($player, $name);
			}
		}
		return $player;
    }

    private function createPlayer($name, $region) {
    	
    	// no data, need to do lookup
		$this->connection->setRegion($region);
		$data = $this->connection->getSummonerByName($name);
		
		// create model and initialize with values
		$player = new Player($this->connection);
		$player->region = $region;
		$player->summonerName = $name;
		$player->summonerId = $data[$name]['id'];

		// grab ID, and use it to query into the stats endpoint
		$summId = $data[$name]['id'];

		// Update database records for General Match Type Statistics
		$overallStatistics = $player->updateMatchTypeStats($this->connection);
		
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

}
