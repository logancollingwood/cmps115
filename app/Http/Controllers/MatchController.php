<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\riotapi;
use App\ApiResponder;

class MatchController extends Controller
{
    //
	//
    private $connection;
    private $apiResponder;

	public function __construct() {
		$this->connection = new riotapi('na');
		$this->apiResponder = new ApiResponder();
	}

    public function byId($matchId) {
    	// Second Param is for timeline?
    	$data = $this->connection->getMatch($matchId, true);
    	if (!empty($data)) {

			$this->apiResponder->setCode(200);
			$this->apiResponder->setData($data);
		} else {
			$this->apiResponder->setCode(404);
		}
		return $this->apiResponder->send();
    }
}
