<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Proveedor extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Proveedor','Prov');
	}
	public function index_get($id = NULL)
	{
		$prov = $this->Prov->get($id);
		if(!is_null($prov))
			$this->response(array("response" => $prov),200);
		else
			$this->response(array("response" => "no hay datos"),404);	
	}

	public function index_post($id)
	{

		if(!$this->post('proveedor'))
			$this->response(NULL,400);

		$provId = $this->Prov->save($this->post('proveedor'));
		if(!is_null($provId))
			$this->response(array("response" => $provId,200));
		else
			$this->response(array("response" => "Ha ocurrido un error",400));
	}
	public function index_put($id)
	{
		if(!$this->put('proveedor') || !$id)
			$this->response(NULL,400);

		$update = $this->Prov->update($id,$this->put('proveedor'));
		if(!is_null($update))
			$this->response(array("response" => "Proveedor actualizado",200));
		else
			$this->response(array("response" => "Ha ocurrido un error",400));
	}

	public function index_delete($id)
	{
		if(!$id)
			$this->response(NULL,400);

		$delete = $this->Prov->delete($id);
		if(!is_null($delete))
			$this->response(array("response" => "Proveedor eliminado",200));
		else
			$this->response(array("response" => "Ha ocurrido un error",400));

	}
}
?>
