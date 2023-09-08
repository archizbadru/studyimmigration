<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function insert($data)
	{	 


		$this->db->insert('tbl_admin',$data);
		return $this->db->insert_id();
	}

	public function insert_enq($data)
	{	 


		$this->db->insert('enquiry',$data);
		return $this->db->insert_id();
	}

}

?>
