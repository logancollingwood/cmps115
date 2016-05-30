<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //
    protected $table = 'match';


    public function encaspulate() {
    	$this->playerMatch();
    	return $this;
    }

    public function matchLookup($connection, $region, $matchId) {
    	$regionStr = strtoupper($region) + "1";
    	$match = matchLookupOrCreate($this->connection, $regionStr, $matchId);
    	$match->PlayerMatch();
    	return $match;
    }

    public static function matchLookupOrCreate($connection, $region, $matchId) {
	    // if we haven't stored this match before, lets
		// grab it and throw it in our sql database
		// otherwise no need to do that.
		//echo $matchId;
    	$matchModel = Match::where('platformId', $region)
							->where('matchId', $matchId)
							->first();
		if (!$matchModel) {
			$matchModel = new Match;
			$matchData = $connection->getMatch($matchId, true);
			dd($matchData);
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
			$matchModel->platformId = $region;
			$matchModel->matchId = $matchId;
			$matchModel->queue = $matchData['queueType'];
			$matchModel->season = $matchData['season'];
			$matchModel->serverTime = $matchData['matchCreation'];
			$matchModel->save();
		}
		return $matchModel;
    }

    public function PlayerMatch() {
    	return $this->hasMany('App\PlayerMatch', 'matchId', 'matchId');
    }

}
