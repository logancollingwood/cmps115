<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiResponder extends Model
{
    //
    private $data;
    private $code;
    private $payload;
    private $errorMsg;

    private $statusKey = "status";
    private $payloadKey = "payload";
    private $errorKey = "error";

    // API responder sets up our data object which will contain a response

    public function __construct() {
    	//header("Access-Control-Allow-Orgin: *");
        //header("Access-Control-Allow-Methods: *");
        //header("Content-Type: application/json");
    }

    public function send() {
    	if (!isset($this->payload[$this->statusKey])) {
    		$this->payload[$this->statuskey] = 200;
    	}
    	return $this->payload;
    }

    // code = 200 for success
    // code = 404 for not found
    public function setCode ($code) {
    	$this->payload[$this->statusKey] = $code;
    }

    public function setData($data) {
    	$this->payload[$this->payloadKey] = $data;
    }

    public function setError($string) {
        $this->payload[$this->errorKey] = $string;
    }
}
