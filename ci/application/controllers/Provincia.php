<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Provincia extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Provincia','Provi');
	}

	public function index_get($id = NULL)
	{
		$provi = $this->Provi->get($id);
		if(!is_null($provi))
			$this->response(array("resp" => $provi),200);
		else
			$this->response(array("resp" => "no hay datos"),404);	
	}

}

