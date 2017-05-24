<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Cat_Ganancias extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Cat_Ganancias','Cat_Ganancias');
	}

	public function index_get()
	{
		$id = $this->get('id');
		$Cat_Ganancias = $this->Cat_Ganancias->get($id);
		if(!is_null($Cat_Ganancias))
			$this->response(array("resp" => $Cat_Ganancias),200);
		else
			$this->response(array("resp" => "no hay datos"),404);	
	}

}

