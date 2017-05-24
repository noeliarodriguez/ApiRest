<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Rubro extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Rubro','Rubro');
	}

	public function index_get($id = NULL)
	{
		$rubro = $this->Rubro->get($id);
		if(!is_null($rubro))
			$this->response(array("resp" => $rubro),200);
		else
			$this->response(array("resp" => "no hay datos"),404);	
	}

}
