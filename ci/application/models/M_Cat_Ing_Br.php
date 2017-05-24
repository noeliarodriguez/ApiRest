<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Cat_Ing_Br extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function get($id = NULL,$esProvincia,$esProveedor)
	{
		$result = NULL;
		if (!is_null($id))
		{
			if($esProveedor)
			{
				if($esProvincia === true)
				{
					$query = $this->db->select("*")->from("cat_ing_br_prov_pcia")->where("Id",$id)->get();
					if($query->num_rows() === 1)
						$result = $query->row_array();
				}
				else
				{
					$query = $this->db->select("*")->from("cat_ing_br_prov")->where("Id",$id)->get();
					if($query->num_rows() === 1)
						$result = $query->row_array();	
				}
			}
		}
		else
		{
			if($esProveedor)
			{
				if($esProvincia)
				{
					$query = $this->db->select("*")->from("cat_ing_br_prov_pcia")->get();
					if($query->num_rows() >= 1)
						$result = $query->result_array();
				}
				else
				{
					$query = $this->db->select("*")->from("cat_ing_br_prov")->get();
					if($query->num_rows() >= 1)
						$result = $query->result_array();	
				}
			}
		}

		return $result;
	}

}

