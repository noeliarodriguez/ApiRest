<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Rubro extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function get($id = NULL)
	{
		$result = NULL;
		if (!is_null($id))
		{
			$query = $this->db->select("*")->from("rubro_proveedor")->where("Id",$id)->get();
			if($query->num_rows() === 1)
				$result = $query->row_array();
		}
		else
		{
			$query = $this->db->select("*")->from("rubro_proveedor")->get();
			if($query->num_rows() >= 1)
				$result = $query->result_array();
		}

		return $result;
	}

}
