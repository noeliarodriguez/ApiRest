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
			$this->response(array("resp" => $prov),200);
	}

	public function index_post()
	{
		$type = $this->post('type');
		//AGREGAR
		if( $type == "add")
		{
			$prov = $this->post('proveedor');
			$provId = $this->Prov->save($prov);
			if(!is_null($provId))
				{
					$prov = $this->Prov->_setProv($prov);
					$prov["Id"] = $provId;
					$this->response(array("resp" => "Nuevo proveedor codigo: ".$provId,"prov" => $prov,"status" => "OK"));
				}
			else
				$this->response(array("resp" => "Ha ocurrido un error",400));	
			
		}
		//EDITAR
		else
			if($type == "edit")
			{
				$prov = $this->post('proveedor');
				$id = $this->post('proveedor')['Id'];
				if(!$prov || !$id)
				$this->response(NULL,400);

				$update = $this->Prov->update($id,$prov);
				if(!is_null($update))
					$this->response(array("resp" => "Proveedor actualizado","status" => "OK"));
				else
					$this->response(array("resp" => "No se ha actualizado nada",400));
			}
			//BORRAR
			else
				if($type == "delete")
				{
					$id = $this->post('Id');
					if(!$id)
					$this->response(NULL,400);

					$delete = $this->Prov->delete($id);
					if(!is_null($delete))
						$this->response(array("resp" => "Proveedor dado de Baja","status" => "OK"));
					else
						$this->response(array("resp" => "Ha ocurrido un error",400));
				}
				else
					echo "ERROR";
		
	}

	


}
?>
