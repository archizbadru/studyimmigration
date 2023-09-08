<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'department_model',
			'User_model',
			'location_model',
			'Modules_model',
			'doctor_model'
		));
		
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1 
		) 
		redirect('login'); 

	}
 
	public function index()
	{
		$data['title'] = display('user_list');
		#-------------------------------#
		$data['departments'] = $this->User_model->read();
		$data['content'] = $this->load->view('user',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

 	public function create()
	{
		$data['title'] = display('add_user');
		#-------------------------------#
		$this->form_validation->set_rules('company_info', display('company_info') ,'required');
		$this->form_validation->set_rules('Name', display('disolay_name'),'required');
		$this->form_validation->set_rules('email', display('email') ,'required|is_unique[tbl_admin.s_user_email]',array('is_unique'=>'Multiple Entery For email'));
		$this->form_validation->set_rules('cell', display('cell') ,'required|max_length[10]');
		$this->form_validation->set_rules('password', display('password'),'required');
		$this->form_validation->set_rules('country_id', display('country_name') ,'required');
		$this->form_validation->set_rules('region_id', display('region_name') ,'required');
		$this->form_validation->set_rules('territory_id', display('territory_name'),'required');
		$this->form_validation->set_rules('state_id', display('state_name') ,'required');
		$this->form_validation->set_rules('city_name', display('city_name') ,'required');
		$this->form_validation->set_rules('user_role', display('user_role') ,'required');
		$this->form_validation->set_rules('status', display('status') ,'required');
		#-------------------------------#
		$data['department'] = (object)$postData = [
			'pk_i_admin_id' 	  => $this->input->post('dprt_id',true),
			'user_roles' 		  => $this->input->post('user_role',true),
			's_user_email' 		  => $this->input->post('email',true),
			's_phoneno' 		  => $this->input->post('cell',true),
			's_password' => md5($this->input->post('password',true)),
			's_display_name'      => $this->input->post('Name',true),
			'country_id' 	  => $this->input->post('country_id',true),
			'region_id' 		  => $this->input->post('region_id',true),
			'territory_id' => $this->input->post('territory_id',true),
			'state_id'      => $this->input->post('state_id',true),
			'city_id' 	  => $this->input->post('city_name',true),
			'companey_id' 		  => $this->input->post('company_info',true)
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $dprt_id then insert data
			if (empty($postData['dprt_id'])) {
				if ($this->User_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('user/create');
			} else {
				if ($this->User_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('user/edit/'.$postData['dprt_id']);
			}

		} else {
		     $data['country']=$this->location_model->country();
		     $data['region_list']=$this->location_model->region_list();
		     	$data['companey_list']= $this->doctor_model->read();; 
			$data['content'] = $this->load->view('user_from',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}

	public function edit($dprt_id = null) 
	{
		$data['title'] = display('department_edit');
		#-------------------------------#
		$data['department'] = $this->department_model->read_by_id($dprt_id);
		$data['content'] = $this->load->view('department_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 

	public function delete($dprt_id = null) 
	{
		if ($this->department_model->delete($dprt_id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('department');
	}
  
}
