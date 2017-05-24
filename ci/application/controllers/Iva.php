<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Iva extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Iva','Iva');
	}

	public function index_get($id = NULL)
	{
		$iva = $this->Iva->get($id);
		if(!is_null($iva))
			$this->response(array("resp" => $iva),200);
		else
			$this->response(array("resp" => "no hay datos"),404);	
	}

}

