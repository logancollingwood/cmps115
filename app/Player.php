<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GameTypeStats;

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


    public function encapsulate() {
    	
    	// doing this forces the call to $this->gameTypeStats()
    	// which adds the foreign key relationship to the player object
    	// populating the gameTypeStats field with data
    	// from the gameTypeStats mysql db table on the player object.
    	// even though this variable is unsed. This allows us 
    	$stats = $this->gameTypeStats;

    	$json = [];
    	// copy player data over into this json field
    	// this includes agregate match stats since they're
    	// part of the player model
    	$json['playerData'] = $this;

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
											->where('region', $this->region)
											->where('gameTypeId', $gameTypeId)
											->first();

			if (!$gameTypeStats) {
				$gameTypeStats = new GameTypeStats;
			}
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

    public function gameTypeStats() {

        return $this->hasMany('App\GameTypeStats', 'summonerId', 'summonerId');

    }
    
}
