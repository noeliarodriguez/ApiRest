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

    public function index_post()
    {
        $type = $this->post('type');
        $rubro = $this->post('rubro');
        //AGREGAR
        if( $type == "add")
        {
            $rubroId = $this->Rubro->save($rubro);
            if(!is_null($rubroId))
            {
                $rubro["Id"] = $rubroId;
                $this->response(array("resp" => "Nuevo Rubro codigo: ".$rubroId,"prov" => $rubro,"status" => "OK"));
            }
            else
                $this->response(array("resp" => "Ha ocurrido un error",400));

        }
        //EDITAR
        else
            if($type == "edit")
            {
                $id = $this->post('rubro')['Id'];
                if(!$rubro || !$id)
                    $this->response(NULL,400);

                $update = $this->Rubro->update($id,$rubro);
                if(!is_null($update))
                    $this->response(array("resp" => "Rubro actualizado","status" => "OK"));
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

                    $delete = $this->Rubro->delete($id);
                    if(!is_null($delete))
                        $this->response(array("resp" => "Rubro dado de Baja","status" => "OK"));
                    else
                        $this->response(array("resp" => "Ha ocurrido un error",400));
                }
                else
                    echo "ERROR";

    }

}
