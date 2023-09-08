<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_model extends CI_Model {

	private $table = "schedule";
 
	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("schedule.*, user.firstname, user.lastname, department.name")
			->from($this->table)
			->join('user','user.user_id = schedule.doctor_id','left')
			->join('department','department.dprt_id = user.department_id','left')
			->order_by('schedule.schedule_id','desc')
			->get()
			->result();
	} 
  

	public function read_by_id($schedule_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('schedule_id',$schedule_id)
			->get()
			->row();
	} 
 
 
	public function update($data = [])
	{
		return $this->db->where('schedule_id',$data['schedule_id'])
			->update($this->table,$data); 
	} 
 
	public function delete($schedule_id = null)
	{
		$this->db->where('schedule_id',$schedule_id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} public function vid_list(){          return $this            ->db            ->select("*")            ->from('tbl_vid')            ->where('comp_id',$this->session->companey_id)            ->get()            ->result_array();    }	public function faq_list(){      return $this            ->db            ->select("*")            ->from('tbl_faq')            ->where('comp_id',$this->session->companey_id)            ->get()            ->result_array();    }
   public function get_schedule_list(){	    $company = $this->session->userdata('companey_id');		$usr_id = $this->session->userdata('user_id');	if($this->session->userdata('user_right')=='110'){		$query = $this->db->query("select schdl_dt,stm,ty,schl_sts,sts,id,avblty from tbl_schdl where comp_id='$company' and uni_id='$usr_id' order by id desc");		return $query->result_array();	}else{		$company = $this->session->userdata('companey_id');		$usr_id = $this->session->userdata('user_id');		$query = $this->db->query("select * from tbl_schdl where comp_id='$company' order by id desc");		return $query->result_array();	}}

}
