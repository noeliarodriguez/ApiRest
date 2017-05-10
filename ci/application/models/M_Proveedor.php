<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Proveedor extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function get($id = NULL)
	{
		$result = NULL;
		if (!is_null($id))
		{
			$query = $this->db->select("*")->from("proveedor")->where("Id",$id)->get();
			if($query->num_rows() === 1)
				$result = $query->row_array();
		}
		else
		{
			$query = $this->db->select("*")->from("proveedor")->get();
			if($query->num_rows() > 1)
				$result = $query->result_array();
		}

		return $result;
	}
	public function save($prov)
	{
		$this->db->set($this->_setProv($prov))->insert("proveedor");
		if($this->db->affected_rows() == 1)
			return $this->db->insert_id;
		else
			return NULL;
	}
	public function update($id,$prov)
	{
		$this->db->set($this->_setProv($prov))->where("Id",$id)->update("proveedor");
		if($this->db->affected_rows() == 1)
			return TRUE;
		else
			return NULL;
	}
	public function delete($id)
	{
		if(!is_null($id))
		{
			$this->db->where("Id",$id)->delete("proveedor");
			if($this->db->affected_rows() == 1)
				return TRUE;
			else
				return NULL;
		}
	}
	private function _setProv($prov)
	{
		return array(
			"Razon_Social" => $prov['Razon_Social'],
			"Cuit" => $prov['Cuit'],
			"Domicilio" => $prov['Domicilio']
			);
	}

}

