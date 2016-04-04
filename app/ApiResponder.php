<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiResponder extends Model
{
    //
    public function __construct() {
    	header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
    }

    public function send($data, $code) {
    	
    }
}
