<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Datasource_model extends CI_Model {

    private $table = "tbl_datasource";

    public function insertRow($data = []) {
        return $this->db->insert($this->table, $data);
    }
    
    public function updateRow($data = []) {

        return $this->db->where('datasource_id', $data['datasource_id'])
                        ->update($this->table, $data);
    }
    
    public function readRow($datasource_id = null) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('datasource_id', $datasource_id)
                        ->get()
                        ->row();
    }

     public function datasourcelist() {
	return $this->db->select('enquiry2.*,tbl_datasource.*,count(enquiry2.enquiry_id) as count_enq')->from('tbl_datasource')
         ->join('enquiry2', "enquiry2.datasource_id = tbl_datasource.datasource_id")
         ->where('enquiry2.status!=',3)
		 ->where('tbl_datasource.comp_id',$this->session->companey_id)
		 ->group_by('tbl_datasource.datasource_id')
         ->get()->result();
	 }
	 
       public function datasourcelist_api($compno) {
    return $this->db->select('enquiry2.*,tbl_datasource.*,count(enquiry2.enquiry_id) as count_enq')->from('tbl_datasource')
         ->join('enquiry2', "enquiry2.datasource_id = tbl_datasource.datasource_id")
         ->where('enquiry2.status!=',3)
         ->where('tbl_datasource.comp_id',$compno)
         ->group_by('tbl_datasource.datasource_id')
         ->get()->result();
     }

	 public function datasourcelist2() {
        return $this->db->select("*")
                        ->from("tbl_datasource")
                        ->where('tbl_datasource.comp_id',$this->session->companey_id)
                        ->get()
                        ->result();
    }

    public function datasourcelist2_api($compno) {
        return $this->db->select("*")
                        ->from("tbl_datasource")
                        ->where('tbl_datasource.comp_id',$compno)
                        ->get()
                        ->result();
    }
    
    public function subsourcelist() {
        return $this->db->select("*")
                        ->from("tbl_subsource")
                        ->where('tbl_subsource.comp_id',$this->session->companey_id)                        
                        ->get()
                        ->result();
    }
    public function findRows($datasource_id) {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('datasource_id', $datasource_id)
                        ->get()
                        ->result();
    }
    
    public function deleteDatasource($paramId = null)
	{
		$this->db->where('datasource_id',$paramId)->delete('tbl_datasource');
		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}
	
	public function get_sub_byid($id5) {
        return $this->db->select("*")
                        ->from("tbl_subsource")
                        ->where('lead_source_id', $id5)
                        ->get()
                        ->result();
    }
}
