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
			$query = $this->db->select("rubro_proveedor.Id,rubro_proveedor.Descripcion,rubro_proveedor.Id_Estado,estados.Descripcion as Estado")->from("rubro_proveedor")->join("estados","rubro_proveedor.Id_Estado = estados.Id_Estado")->where("Id",$id)->get();
			if($query->num_rows() === 1)
				$result = $query->row_array();
		}
		else
		{
			$query = $this->db->select("rubro_proveedor.Id,rubro_proveedor.Descripcion,rubro_proveedor.Id_Estado,estados.Descripcion as Estado")->from("rubro_proveedor")->join("estados","rubro_proveedor.Id_Estado = estados.Id_Estado")->get();
			if($query->num_rows() >= 1)
				$result = $query->result_array();
		}

		return $result;
	}
    public function save($rubro)
    {
        $this->db->set($rubro)->insert("rubro_proveedor");

        if($this->db->affected_rows() == 1)
            return $this->db->insert_id();
        else
            return NULL;
    }
    public function update($id,$rubro)
    {
        $this->db->set($rubro)->where("Id",$id)->update("rubro_proveedor");
        if($this->db->affected_rows() == 1)
            return TRUE;
        else
            return NULL;
    }
    public function delete($id)
    {
        if(!is_null($id))
        {
            $this->db->set('Estado','BAJ')->where("Id",$id)->update("rubro_proveedor");
            if($this->db->affected_rows() == 1)
                return TRUE;
            else
                return NULL;

        }
        else
            return NULL;
    }
}
