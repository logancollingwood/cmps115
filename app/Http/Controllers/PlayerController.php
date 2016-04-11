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
		$this->connection = new riotapi('na');
		$this->apiResponder = new ApiResponder();
	}


	/*
		Endpoint: api/player/$region/$name
		Param $region = [
			na, eu, oce, etc] 
		Param $name String

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
			$this->apiResponder->setData($player);
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
    		$player = $this->createPlayer($name, $region);
		} else {
			// force update
			if (time() - time($player->updated_at) > self::PLAYER_FULL_REFRESH_TIMER) {
				$player = $this->updatePlayerFull($player, $name);
			} else {
				$matchStats = $this->getMatchStats($name, $region);
				// get recent match data here!
				$player = [
					'playerStats' => $player,
					'matchStats' => $matchStats
				];
			}
		}

		return $player;
    }
    private function getMatchStats($name, $region) {
    	$this->connection->setRegion($region);
		$data = $this->connection->getSummonerByName($name);
		$summId = $data[$name]['id'];

		// should just query and build result from DB
    	return $this->updateMatchTypeStats($summId, $region);
    }

    private function createPlayer($name, $region) {
    	// no data, need to do lookup
		$this->connection->setRegion($region);
		$data = $this->connection->getSummonerByName($name);
		
		// create model and save
		$player = new Player;
		$player->region = $region;
		$player->summonerName = $name;
		$player->summonerId = $data[$name]['id'];

		// grab ID, and use it to query into the stats endpoint
		$summId = $data[$name]['id'];

		// Update database records for General Match Type Statistics
		$overallStatistics = $this->updateMatchTypeStats($summId, $region);
		
		$player->wins = $overallStatistics['totalWins'];
		$player->totalChampionKills = $overallStatistics['totalChampionKills'];
		$player->assists = $overallStatistics['totalAssists'];
		$player->neutralMinionKills = $overallStatistics['totalNeutralMinionsKilled'];
		$player->turretsDestroyed = $overallStatistics['totalTurretsKilled'];
		
		$player->save();
		$object = [
			'playerStats' => $player,
			'matchStats' => $overallStatistics
		];
		return $object;
    }


    private function updatePlayerFull($player, $name) {
    	// refreshing data, need to do lookup
		$this->connection->setRegion($region);
		$data = $this->connection->getSummonerByName($name);
		
		$player->summonerName = $name;
		$player->summonerId = $data[$name]['id'];

		// grab ID, and use it to query into the stats endpoint
		$summId = $data[$name]['id'];

		// Update database records for General Match Type Statistics
		$overallStatistics = $this->updateMatchTypeStats($summId, $region);
		
		$player->wins = $overallStatistics['totalWins'];
		$player->totalChampionKills = $overallStatistics['totalChampionKills'];
		$player->assists = $overallStatistics['totalAssists'];
		$player->neutralMinionKills = $overallStatistics['totalNeutralMinionsKilled'];
		$player->turretsDestroyed = $overallStatistics['totalTurretsKilled'];
		
		$player->save();
		$object = [
			'playerStats' => $player,
			'matchStats' => $overallStatistics
		];
		return $object;
    }

    public function updateMatchTypeStats($summId, $region) {
		$stats = $this->getStats($region, $summId);
		
		$totalTurretsKilled = 0;
		$totalChampionKills = 0;
		$totalAssists = 0;
		$totalNeutralMinionsKilled = 0;
		$totalWins = 0;
		$MatchTypeStats = [];

		foreach ($stats['playerStatSummaries'] as $statSummary) {
			$gameTypeKey = $statSummary['playerStatSummaryType'];

			//Map game type string to ID from GameTypeStats types object
			$gameTypeId = GameTypeStats::getType($gameTypeKey);
			
			$gameTypeStats = GameTypeStats::where('summonerId', $summId)
											->where('region', $region)
											->where('gameTypeId', $gameTypeId)
											->first();

			if (!$gameTypeStats) {
				$gameTypeStats = new GameTypeStats;
			}
			$gameTypeStats->summonerId = $summId;
			$gameTypeStats->region = $region;
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
		
			$MatchTypeStats[$gameTypeKey] = $gameTypeStats;
			$gameTypeStats->save();
		}
		return [
				'totalWins' => $totalWins,
				'totalChampionKills' => $totalChampionKills,
				'totalTurretsKilled' => $totalTurretsKilled,
				'totalNeutralMinionsKilled' => $totalNeutralMinionsKilled,
				'totalAssists' => $totalAssists,
				'matchTypeStats' => $MatchTypeStats
		];
    }

    public function getStats($region, $id, $ranked = false) {
    	if ($ranked) {
    		$r = $this->connection->getStats($id, 'ranked');
    	} else {
    		$r = $this->connection->getStats($id);
    	}
    	return $r;
    }

    public function byIdMatch($region, $id) {

    }

}
