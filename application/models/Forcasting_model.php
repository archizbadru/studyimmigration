<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forcasting_model extends CI_Model {

    private $table = 'tbl_target';

    public function create($data) {
        return $this->db->insert($this->table, $data);
    }
	
	public function create_forcast($data) {
        return $this->db->insert('tbl_forecast', $data);
    }
	
	public function update_forcast($data,$uid,$pid,$cid) {
		
               $this->db->where('fu_id', $uid);
		       $this->db->where('fp_id', $pid);
			   $this->db->where('comp_id', $cid);
               return  $this->db->update('tbl_forecast', $data);
    }
	
	public function update($data,$id,$pid) {
		
               $this->db->where('u_id', $id);
		       $this->db->where('p_id', $pid);
               return  $this->db->update($this->table, $data);
    }
	
	public function get_trgt() {
        $this->db->select("*");
        $this->db->from($this->table);
		$this->db->where('comp_id',$this->session->companey_id); 
        return $this->db->get()->result();
    }
	
	public function get_product() {
        $this->db->select("*");
        $this->db->from('tbl_product_country');
		$this->db->where('comp_id',$this->session->companey_id); 
        return $this->db->get()->result();
    }

}
