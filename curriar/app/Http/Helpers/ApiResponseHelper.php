<?php

namespace App\Http\Helpers;

class ApiResponseHelper{
	private $response;
	public function __construct() {
		$this->response = array();
		$this->response['success'] = 1;
		$this->response['error_msg'] = '';
	}

	public function failed(){
		$this->response = array();
		$this->response['success'] = 0;
		$this->response['error_msg'] = '';
	}

	public function setErrorMessage($msg){
		$this->response['error_msg'] = $msg;
	}

	public function setValue($key,$value){
		$this->response[$key] = $value;
	}

	public function getResponse(){
		return $this->response;
	}
}