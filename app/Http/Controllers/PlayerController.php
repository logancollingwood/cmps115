<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\riotapi;
use App\ApiResponder;
use App\Player;


class PlayerController extends Controller
{
    //
    private $connection;
    private $apiResponder;

	public function __construct() {
		$this->connection = new riotapi('na');
		$this->apiResponder = new ApiResponder();
	}

    public function byName($region, $name) {
    	$matchThese = ['summonerName' => $name, 'region' => $region];

    	$player =  Player::where($matchThese);
    	if ($player == null) {
    		// no data, need to do lookup
			$this->connection->setRegion($region);
			$data = $this->connection->getSummonerByName($name);
		} else {

		}
		
		


		// On error, connection calls return an empty object
		// current hacky solution to avoid laravel thrown exceptions
		if (!empty($data)) {

			// grab ID, and use it to query into the stats endpoint
			$summId = $data[$name]['id'];
			$stats = $this->getStats($region, $summId);

			$this->apiResponder->setCode(200);
			$this->apiResponder->setData($stats);
		} else {
			$this->apiResponder->setCode(404);
		}

		return $this->apiResponder->send();
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

    public function setRegion($region) {

    }
}
