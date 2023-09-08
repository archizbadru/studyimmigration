<?php
	class Crm_setting_model extends CI_Model
	{
		public function __construct()
		{
			parent ::__construct();
        	$this->table = 'admin';
			
		}
		
	
	
	public function payment_setting($data)
	{
		return $this->db->insert('sys_parameters', $data);
		
	}
	public function payment_setting_update($data,$id)
	{
		$this->db->where('id',$id);
		return $this->db->update('sys_parameters', $data);

		
	}
	public function payment_list()
	{
		$this->db->select('*');
		$this->db->from('sys_parameters');
		return $this->db->get()->row_array();
	}

	public function portal($data)
	{
		return $this->db->insert('sys_parameters', $data);
		
	}
	public function processrights($data)
	{
		return $this->db->insert('sys_parameters', $data);
		
	}

	public function enquirysetting($data)
	{
		return $this->db->insert('sys_parameters', $data);
		
	}

	public function duplicates($data)
	{
		return $this->db->insert('sys_parameters', $data);
		
	}
	public function user_list($company_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user_role');
		$this->db->where('comp_id',$company_id);
		return $this->db->get()->result_array();
	}
	
	
	
	



	
	

	
	
	
	
	


}
	
?>