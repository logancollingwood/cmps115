<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\riotapi;
use App\ApiResponder;

class StaticController extends Controller
{
    //
    private $connection;
    private $apiResponder;

	public function __construct() {
		$this->connection = new riotapi('na');
	}

	public function freeChamps() {
		return $this->connection->getFreeChampions();
	}

	public function championById($id) {
		return $this->connection->getChampionStaticById($id);
	}
}
