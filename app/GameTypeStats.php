<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameTypeStats extends Model
{
    

    public static function getType($str) {
    	$types = [
    		"AramUnranked5x5" => 0,
    		"CAP5x5" => 1,
            "CoopVsAI" => 2,
            "CoopVsAI3x3" => 3,
            "CoopVsAI5x5" => 4,
            "OdinUnranked" => 5,
            "RankedSolo5x5" => 6,
            "RankedTeam5x5" => 7,
            "RankedTeam3x3" => 8,
            "Unranked" => 9,
            "Unranked3x3" => 10,
            "RankedPremade3x3" => 11,
            "RankedPremade5x5" => 12,
            "Ascension" => 13,
            "URF" => 14,
            "OneForAll5x5" => 15
    	];

    	return $types[$str];
    }

    public static function getMatchKey($id) {
    	$types = [
            "AramUnranked5x5" => 0,
            "CAP5x5" => 1,
            "CoopVsAI" => 2,
            "CoopVsAI3x3" => 3,
            "CoopVsAI5x5" => 4,
            "OdinUnranked" => 5,
            "RankedSolo5x5" => 6,
            "RankedTeam5x5" => 7,
            "RankedTeam3x3" => 8,
            "Unranked" => 9,
            "Unranked3x3" => 10,
            "RankedPremade3x3" => 11,
            "RankedPremade5x5" => 12,
            "Ascension" => 13,
            "OneForAll5x5" => 15
        ];
    	return array_search($id, $types);
    }

    protected $table = 'gameTypeStats';
}
