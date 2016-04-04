<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\riotapi;
use App\ApiResponder;

class PlayerController extends Controller
{
    //
    private $connection;
    private $apiResponder;

	public function __construct() {
		$this->connection = new riotapi('na');
	}

    public function byId($region, $name) {
		$this->connection->setRegion($region);
		$data = $this->connection->getSummonerByName($name);
		if (!empty($data)) {
			$summId = $data[$name]['id'];
			$stats = $this->getStats($region, $summId);
			$response['response'] = 200;
			$response['payload'] = $stats;
		} else {
			$response['response'] = 404;
		}
		return $response;
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
