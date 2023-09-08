<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modules_model extends CI_Model {

	private $table = 'tbll_modules';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->order_by('dprt_id','desc')
			->get()
			->result();
	} 
 
	public function read_by_id($dprt_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('dprt_id',$dprt_id)
			->get()
			->row();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('dprt_id',$data['dprt_id'])
			->update($this->table,$data); 
	} 
 
	public function delete($dprt_id = null)
	{
		$this->db->where('dprt_id',$dprt_id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function modules_list()
	{
		$result = $this->db->select("*")
			->from($this->table)
			->get()
			->result();

		if (!empty($result)) {
			
			return $result;
		} else {
			return false;
		}
	}
	
 }
