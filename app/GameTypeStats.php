<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameTypeStats extends Model
{
    
    protected $types = [
        "CUSTOM" => 0,
        "NORMAL_5x5_BLIND" => 1, 
        "RANKED_SOLO_5x5" => 2,
        "RANKED_PREMADE_5x5" => 3, 
        "BOT_5x5" => 4,
        "NORMAL_3x3" => 5,
        "RANKED_PREMADE_3x3" => 6,
        "NORMAL_5x5_DRAFT" => 7,
        "ODIN_5x5_BLIND" => 8, 
        "ODIN_5x5_DRAFT" => 9,
        "BOT_ODIN_5x5" => 10,
        "BOT_5x5_INTRO" => 11,
        "BOT_5x5_BEGINNER" => 12,
        "BOT_5x5_INTERMEDIATE" => 13,
        "RANKED_TEAM_3x3" => 14,
        "RANKED_TEAM_5x5" => 15,
        "BOT_TT_3x3" => 16,
        "GROUP_FINDER_5x5" => 17,
        "ARAM_5x5" => 18,
        "ONEFORALL_5x5" => 19,
        "FIRSTBLOOD_1x1" => 20,
        "FIRSTBLOOD_2x2" => 21,
        "SR_6x6" => 22,
        "URF_5x5" => 23, 
        "ONEFORALL_MIRRORMODE_5x5" => 24,
        "BOT_URF_5x5" => 25,
        "NIGHTMARE_BOT_5x5_RANK1" => 26,
        "NIGHTMARE_BOT_5x5_RANK2" => 27,
        "NIGHTMARE_BOT_5x5_RANK5" => 28,
        "ASCENSION_5x5" => 29, 
        "HEXAKILL" => 30,
        "BILGEWATER_ARAM_5x5" => 31,
        "KING_PORO_5x5" => 32,
        "COUNTER_PICK" => 33,
        "BILGEWATER_5x5" => 34,
        "TEAM_BUILDER_DRAFT_UNRANKED_5x5" => 35,
        "TEAM_BUILDER_DRAFT_RANKED_5x5" => 36
    ];

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
            "OneForAll5x5" => 15,
            "KingPoro" => 16,
            "Hexakill" => 17,
            
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
            "OneForAll5x5" => 15,
            "KingPoro" => 16,
            "Hexakill" =>17
        ];
    	return array_search($id, $types);
    }

    protected $table = 'gameTypeStats';
}
