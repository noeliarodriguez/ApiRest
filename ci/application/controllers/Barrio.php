<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Barrio extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Barrio','Barrio');
	}

	public function index_get($id = NULL)
	{
		$barrio = $this->Barrio->get($id);
		if(!is_null($barrio))
			$this->response(array("resp" => $barrio),200);
		else
			$this->response(array("resp" => "no hay datos"),404);	
	}

}
