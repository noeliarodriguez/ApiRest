<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Cat_Ing_Br extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Cat_Ing_Br','Cat_Ing_Br');
	}

	public function index_get()
	{
		$id = $this->get('id');
		$esProvincia = $this->get('esProvincia');
		$esProveedor = $this->get('esProveedor');
		$catIngBr = $this->Cat_Ing_Br->get($id,$esProvincia,$esProveedor);
		if(!is_null($catIngBr))
			$this->response(array("resp" => $catIngBr),200);
		else
			$this->response(array("resp" => "no hay datos"),404);	
	}

}

