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
		    $array = array('Id' => $id, 'Estado' => 'CAR');
			$query = $this->db->select("*")->from("proveedor")->where($array)->get();
			if($query->num_rows() === 1)
				$result = $query->row_array();
		}
		else
		{
			$query = $this->db->select("*")->from("proveedor")->where('Estado','CAR')->get();
			if($query->num_rows() >= 1)
				$result = $query->result_array();
		}

		return $result;
	}
	public function save($prov)
	{
		$this->db->set($this->_setProv($prov))->insert("proveedor");

		if($this->db->affected_rows() == 1)
			return $this->db->insert_id();
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
		    /*
			$this->db->where("Id",$id)->delete("proveedor");
			if($this->db->affected_rows() == 1)
				return TRUE;
			else
				return NULL;
		    */
		    $this->db->set('Estado','BAJ')->where("Id",$id)->update("proveedor");

		}
		else
		    return NULL;
	}
	public function _setProv($prov)
	{
		if(!is_null($prov))
		{
			if(!array_key_exists('Nro_Ing_Brutos', $prov))
				$prov['Nro_Ing_Brutos'] = 0;
			if(!array_key_exists('Telefono', $prov))
				$prov['Telefono'] = "";
			if(!array_key_exists('Celular', $prov))
				$prov['Celular'] = "";
			if(!array_key_exists('Fax', $prov))
				$prov['Fax'] = "";
			if(!array_key_exists('Domicilio', $prov))
				$prov['Domicilio'] = "";
			if(!array_key_exists('Observaciones', $prov))
				$prov['Observaciones'] = "";
			if(!array_key_exists('Pagina_Web', $prov))
				$prov['Pagina_Web'] = "";
			if(!array_key_exists('Codigo_Postal', $prov))
				$prov['Codigo_Postal'] = "";
			if(!array_key_exists('Localidad', $prov))
				$prov['Localidad'] = "";
			if(!array_key_exists('Barrio', $prov))
				$prov['Barrio'] = "";
			if(!array_key_exists('Id_Provincia', $prov))
				$prov['Id_Provincia'] = 1;
			if(!array_key_exists('Id_Iva', $prov))
				$prov['Id_Iva'] = 1;
			if(!array_key_exists('Id_Cat_Ing_Br', $prov))
				$prov['Id_Cat_Ing_Br'] = 1;
			if(!array_key_exists('Id_Cat_Ganancia', $prov))
				$prov['Id_Cat_Ganancia'] = 1;
			if(!array_key_exists('Id_Rubro', $prov))
				$prov['Id_Rubro'] = 0;
			if(!array_key_exists('Agente_Retencion', $prov))
				$prov['Agente_Retencion'] = 0;
            if(!array_key_exists('Estado', $prov))
                $prov['Estado'] = "CAR";
			
			return array(
			"Razon_Social" => $prov['Razon_Social'],
			"Cuit" => $prov['Cuit'],
			"Email" => $prov['Email'],
			"Nro_Ing_Brutos" => $prov['Nro_Ing_Brutos'],
			"Telefono" => $prov['Telefono'],
			"Celular" => $prov['Celular'],
			"Fax" => $prov['Fax'],
			"Domicilio" => $prov['Domicilio'],
			"Observaciones" => $prov['Observaciones'],
			"Pagina_Web" => $prov['Pagina_Web'],
			"Codigo_Postal" => $prov['Codigo_Postal'],
			"Localidad" => $prov['Localidad'],
			"Barrio" => $prov['Barrio'],
			"Id_Provincia" => $prov['Id_Provincia'],
			"Id_Pais" => 1,
			"Id_Iva" => $prov['Id_Iva'],
			"Id_Cat_Ing_Br" => $prov['Id_Cat_Ing_Br'],
			"Id_Cat_Ganancia" => $prov['Id_Cat_Ganancia'],
			"Id_Rubro" => $prov['Id_Rubro'],
			"Agente_Retencion" => $prov['Agente_Retencion'],
            "Estado" => $prov['Estado']
			);
		}
		else
			return NULL;
		
	}

	
}

