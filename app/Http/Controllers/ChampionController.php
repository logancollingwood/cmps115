<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\riotapi;;
use App\Champions;

class ChampionController extends Controller
{
//
    private $connection;

	public function __construct() {
		$this->connection = new riotapi('na');
	}

// This is pretty disgusting, I haven't quite figured out what the best way to store DataDragon's 
// most up to date version number/ lookup url. It's possible we just make a new table with one 
// row that stores this info but for now I'm just going to do the lookup everytime we do a champ lookup.
// Also need to implement if the database is X time old, update;
    public function updateList(){
        $list = $this->connection->getChampion();
        foreach ($list['champions'] as $champion) {
            $champ = Champions::where('championId', $champion['id'])->first();
            if(!$champ){
                $champ = new Champions;
            }
                    // Relm lookjup for DD
        $relm = $this->connection->getStatic("realm");


        //getting the info we need out of relm
        $champVer = $relm['n']['champion'];
        $championLookup = $this->connection->getChampionStaticWithImage($champion['id']);
        // combine CDN, version, and champ lookup
        $champImage = $relm['cdn'] . '/' . $relm['n']['champion'] . '/img/champion/' . $championLookup['image']['full'];

        $champ->championId = $champion['id'];
        $champ->title = $championLookup['title'];
        $champ->name = $championLookup['name'];
        $champ->key = $championLookup['key'];
        $champ->image = $champImage;
        $champ->save();
        }
        return $list;
    }

    public function lookup($championId){
    	
    	$champion = Champions::where('championId', $championId)->first();

    	if(!$champion){
    		$champion = new Champions;
    	
    	// Relm lookjup for DD
    	$relm = $this->connection->getStatic("realm");


    	//getting the info we need out of relm
    	$champVer = $relm['n']['champion'];
    	$championLookup = $this->connection->getChampionStaticWithImage($championId);
    	// combine CDN, version, and champ lookup
    	$champImage = $relm['cdn'] . '/' . $relm['n']['champion'] . '/img/champion/' . $championLookup['image']['full'];

    	$champion->championId = $championId;
    	$champion->title = $championLookup['title'];
    	$champion->name = $championLookup['name'];
    	$champion->key = $championLookup['key'];
    	$champion->image = $champImage;
    	$champion->save();
    	}
    	

        //return $this->connection->getStatic("champion", $championId);
        return $champion;
    }
}
