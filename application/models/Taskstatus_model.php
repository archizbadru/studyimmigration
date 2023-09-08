<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Taskstatus_model extends CI_Model {

    private $table = "tbl_taskstatus";

    public function insertRow($data = []) {
        return $this->db->insert($this->table, $data);
    }
    
    public function updateRow($data = []) {

        return $this->db->where('taskstatus_id', $data['taskstatus_id'])
                        ->update($this->table, $data);
    }
    
    public function readRow($taskstatus_id = null) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('taskstatus_id', $taskstatus_id)
                        ->get()
                        ->row();
    }

    public function taskstatuslist($comp_id=0) {
        if($this->session->companey_id){
            $comp_id    =   $this->session->companey_id;
        }
        return $this->db->select("*")
                        ->from("tbl_taskstatus")
                        ->where('tbl_taskstatus.comp_id',$comp_id)
                        ->get()
                        ->result();
    }
    
    public function countrylist() {
        return $this->db->select("*")
                        ->from("tbl_country")
                        ->where('comp_id',$this->session->companey_id)
                        ->get()
                        ->result();
    }
    public function statelist() {
        return $this->db->select("*")
                        ->from("state")
                        ->get()
                        ->result();
    }
    public function citylist() {
        return $this->db->select("*")
                        ->from("city")
                        ->get()
                        ->result();
    }
    
    public function peronellist($enquiry_id) {
        return $this->db->select("*")
                        ->from("tbl_personal_details")
                        ->where('unique_number', $enquiry_id)
                        ->get()
                        ->result();
    }
    
    public function insertpersonel($data) {
        return $this->db->insert('tbl_personal_details', $data);
    }
    public function updatepersonel($data) {

        return $this->db->where('unique_number', $data['unique_number'])
                        ->update('tbl_personal_details', $data);
    }
    
    public function findRows($taskstatus_id) {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('taskstatus_id', $taskstatus_id)
                        ->get()
                        ->result();
    }
    
    public function deleteTaskstatus($paramId = null)
	{
		$this->db->where('taskstatus_id',$paramId)->delete('tbl_taskstatus');
		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
}
