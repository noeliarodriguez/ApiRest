<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Producto extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get($id = NULL)
    {
        $result = NULL;
        if (!is_null($id))
        {
            $query = $this->db->select("*")->from("producto")->where("Id",$id)->get();
            if($query->num_rows() === 1)
                $result = $query->row_array();
        }
        else
        {
            $query = $this->db->select("*")->from("producto")->get();
            if($query->num_rows() >= 1)
                $result = $query->result_array();
        }

        return $result;
    }
    public function save($producto)
    {
        $this->db->set($producto)->insert("producto");

        if($this->db->affected_rows() == 1)
            return $this->db->insert_id();
        else
            return NULL;
    }
    public function update($id,$producto)
    {
        $this->db->set($producto)->where("Id",$id)->update("producto");
        if($this->db->affected_rows() == 1)
            return TRUE;
        else
            return NULL;
    }
    public function delete($id)
    {
        if(!is_null($id))
        {
            $this->db->set('Estado','BAJ')->where("Id",$id)->update("producto");
            if($this->db->affected_rows() == 1)
                return TRUE;
            else
                return NULL;
        }
        else
            return NULL;
    }
}
