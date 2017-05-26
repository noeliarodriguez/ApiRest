<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Estado extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Estado','Estado');
    }

    public function index_get($id = NULL)
    {
        $estado = $this->Estado->get($id);
        if(!is_null($estado))
            $this->response(array("resp" => $estado),200);
        else
            $this->response(array("resp" => "no hay datos"),404);
    }

}

