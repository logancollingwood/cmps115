<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\riotapi;
use App\ApiResponder;
use App\Match;
use App\PlayerMatch;

class MatchController extends Controller
{
    //
	//
    private $connection;
    private $apiResponder;
    private $regions =  ['BR', 'EUNE', 'EUW', 'JP', 'KR', 'LAN', 'LAS', 'NA', 'OCE', 'RU', 'TR'];

	public function __construct() {
		$this->connection = new riotapi('na');
		$this->apiResponder = new ApiResponder();
	}

	//Method for current game lookup. Takes REGION and summonerId
    public function currentMatch($region, $playerId){
    	return $this->connection->getCurrentGame($playerId, $region . '1');

    }

    public function byId($region, $id) {
    	$this->apiResponder->setCode(404);

    	/* Non recognized region */
    	if (!in_array(strtoupper($region), $this->regions)) {
    		$this->apiResponder->setError("Unknown Region");
    		return $this->apiResponder->send();
    	}
    	
    	$region = strtoupper($region) . "1";
    	$match = $this->updateOrCreateInitialMatch($region, $id);
    
		
		if (!empty($match)) {
			$this->apiResponder->setCode(200);
			$match->playerMatch;
			$this->apiResponder->setData($match);
		} else {
            $this->apiResponder->setError("Unable to find Player with name $name in $region");
        }
		return $this->apiResponder->send();
    }

    /* Returns a player object */
    private function updateOrCreateInitialMatch($region, $matchId) {
    	/* Do initial DB lookup */
    	$match = Match::where('platformId', $region)
							->where('matchId', $matchId)
							->first();

    	
    	if (!$match) {
			$match = new Match;
			$matchData = $this->connection->getMatch($matchId);
			
			$participantIdentities = $matchData['participantIdentities'];
			
			foreach ($participantIdentities as $participant) {
				$partId = $participant['participantId'];
				$summonerId = $participant['player']['summonerId'];
				$pm = PlayerMatch::where('summonerId', $summonerId)
    									->where('platformId', $region)
    									->where('matchId', $matchId)
    									->first();
    			if(!$pm) {
    				$playerMatch = new PlayerMatch;
		    		// identifiers
		    		$playerMatch->summonerId = $summonerId;
		    		$playerMatch->platformId = $region;
		    		$playerMatch->matchId = $matchId;
		    		$playerMatch->profileIcon = $participant['player']['profileIcon'];

		    		// subquery riot match api with matchid

		    		foreach ($matchData['participants'] as $participant) {
			    		if ($participant['participantId'] == $partId) {
			    			$stats = $participant['stats'];

			    			if ($participant['teamId'] == 100) {
			    				$playerMatch->team = 0;
			    			} else {
			    				$playerMatch->team = 1;
			    			}

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
			$match->length = $matchData['matchDuration'];
			$match->platformId = $region;
			$match->matchId = $matchId;

			$match->map = $matchData['mapId'];
					

			$match->queue = $matchData['queueType'];
			$match->season = $matchData['season'];
			$match->serverTime = $matchData['matchCreation'];
			$match->save();
		}
		
		return $match;
    }

    function parseMatchMode($str) {

    }
}
