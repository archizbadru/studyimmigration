<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {
 
	private $table = "setting";

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->get()
			->row();
	} 
	
  	public function update($data = [])
	{
		return $this->db->where('setting_id',$data['setting_id'])
			->update($this->table,$data); 
	} 
	
	
	
	//Chnage password...
	public function update_pass($oldpas,$newpass){
	    
	       $query = $this->db->query('select * from tbl_admin where s_password="'.$oldpas.'" and pk_i_admin_id="'.$this->session->user_id.'"');  
	       
           if($query->num_rows()==1){
               
               $this->db->query('update tbl_admin set s_password="'.$newpass.'" where pk_i_admin_id="'.$this->session->user_id.'" ');
               
               return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
               
           }
	    
	    
	}
	
	
	
}
