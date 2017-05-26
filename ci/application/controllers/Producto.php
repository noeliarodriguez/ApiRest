<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Producto extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Producto','Producto');
    }

    public function index_get($id = NULL)
    {
        $producto = $this->Producto->get($id);
        if(!is_null($producto))
            $this->response(array("resp" => $producto),200);
        else
            $this->response(array("resp" => "no hay datos"),404);
    }

    public function index_post()
    {
        $type = $this->post('type');
        $producto = $this->post('producto');
        //AGREGAR
        if( $type == "add")
        {
            $productoId = $this->Producto->save($producto);
            if(!is_null($productoId))
            {
                $producto["Id"] = $productoId;
                $this->response(array("resp" => "Nuevo Producto codigo: ".$producto['Codigo'],"producto" => $producto,"status" => "OK"));
            }
            else
                $this->response(array("resp" => "Ha ocurrido un error",400));

        }
        //EDITAR
        else
            if($type == "edit")
            {
                $id = $this->post('producto')['Id'];
                if(!$producto || !$id)
                    $this->response(NULL,400);

                $update = $this->Producto->update($id,$producto);
                if(!is_null($update))
                    $this->response(array("resp" => "Producto actualizado","status" => "OK"));
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

