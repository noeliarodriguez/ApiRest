<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Pais extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Pais','Pais');
	}

	public function index_get($id = NULL)
	{
		$pais = $this->Pais->get($id);
		if(!is_null($pais))
			$this->response(array("resp" => $pais),200);
		else
			$this->response(array("resp" => "no hay datos"),404);	
	}
}

