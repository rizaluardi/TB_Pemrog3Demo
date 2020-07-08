<!-- Updated by Rizaluardi-PC -->
<?php
//import library dari REST_Controllr.php

require APPPATH.'/libraries/REST_Controller.php';
//extends class dari Rest_Controller
class TestApi extends REST_Controller{

	//constructor
	public function __construct(){
		parent::__construct();
	}
	public function index_get(){


		//testing response
		$response['status'] = 200;
		$response['error'] = false;
		$response['message'] = 'Pesan untuk response';
		//tampilan response
		$this->response($response);
	}
	public function user_get(){
		$response['status'] = 200;
		$response['error'] = false;
		$response['user']['username'] = 'Jotaro';
		$response['user']['email'] = 'kujojotaro@poltekpos.ac.id';
		$response['user']['detail']['full_name'] = 'Kujo Jotaro';
		$response['user']['detail']['position'] = 'Programmer';
		$response['user']['detail']['specialize'] = 'Android, IOS, WEB, Desktop';
		//tampilkan response
		$this->response($response);
			
	}
}
?>