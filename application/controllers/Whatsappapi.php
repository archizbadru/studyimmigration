<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsappapi extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		
            //$this->load->helper('url');
		
		$this->load->model(array(
			'Client_Model','Apiintegration_Model','dash_model','User_model','Leads_Model'
		));
		$panel_menu = $this->db->select("modules")
    ->where('pk_i_admin_id',$this->session->user_id)
    ->get('tbl_admin')
    ->row();
        $module=explode(',',$panel_menu->modules);
		/*if (in_array(13,$module)){ 
		}else{redirect('login');}*/
	}
    
         
	public function index()
	{
	
		//$data['nav1']='nav5';
		$aid = $this->session->userdata('user_id');
			$api_for = 1;
		$data['title'] = 'Whatsapp Api Integration';
		$data['page_title'] = 'Whatsapp API';
		$data['api_list'] = $this->Apiintegration_Model->get_api_list($api_for);
		$data['temp_list'] = $this->Apiintegration_Model->get_template_list($api_for);
        $data['all_department'] = $this->Leads_Model->dept_select();
        $data['products'] = $this->dash_model->get_user_product_list();
		$data['content'] = $this->load->view('whatsappapi',$data,true);
		//$this->load->view('leads',$data);
		$this->load->view('layout/main_wrapper',$data);
	}
	
    public function api_details()
    {  
    //$data['title'] = display('Enquiry Details');
    #------------------------------# 
    //$leadid = $this->uri->segment(3);
    
    //////////////////////////////////////////////////////
    if(!empty($_POST)){
    $apiid = $this->input->post('id');
    
    $api_name = $this->input->post('api_name');
    $api_url = $this->input->post('api_url');
    
    
    $this->db->set('api_name',$api_name);
    $this->db->set('api_url',$api_url);
    
    $this->db->where('api_id',$apiid);
    $this->db->update('api_integration');
    
    redirect('whatsappapi');
    }
    
    //////////////////////////////////////////////////////
    $api_for = 1;
    $data['title'] = 'Whatsapp Api Integration'  ;	
    $data['api_list'] = $this->Apiintegration_Model->get_api_list($api_for);
    $data['temp_list'] = $this->Apiintegration_Model->get_template_list($api_for);
    
    $data['content'] = $this->load->view('whatsappapi', $data, true);
    $this->load->view('layout/main_wrapper',$data);
    }
    
    
    
    
    public function template_details(){  
        if (user_role('52') == true) {
        }
        //$data['title'] = display('Enquiry Details');
        #------------------------------# 
        //$leadid = $this->uri->segment(3);
        
        //////////////////////////////////////////////////////
        if(!empty($_POST)){
            $tmpid = $this->input->post('template_id');
            
            $template_name = $this->input->post('template_name');
            $template_content = $this->input->post('template_content');
            $process=$this->input->post('process');
            $stage=$this->input->post('stage');
            $department=$this->input->post('department');
            $process =implode(',',$process);
            $stage =implode(',',$stage);
            $department =implode(',',$department);
            // die();
            $this->db->set('stage',$stage);
            $this->db->set('process',$process);
            $this->db->set('departments',$department);
            $this->db->set('template_name',$template_name);
            $this->db->set('template_content',$template_content);
            
            $this->db->where('temp_id',$tmpid);
            $this->db->update('api_templates');
            
            redirect('whatsappapi');
        }
        
        //////////////////////////////////////////////////////
        $api_for = 1;
        $data['title'] = 'Whatsapp Api Integration'  ;  
        $data['api_list'] = $this->Apiintegration_Model->get_api_list($api_for);
        $data['temp_list'] = $this->Apiintegration_Model->get_template_list($api_for);
        
        $data['content'] = $this->load->view('whatsappapi', $data, true);
        $this->load->view('layout/main_wrapper',$data);
    }

    
        public function createapi()
        {
        if(!empty($_POST)){
        
        $api_name = $this->input->post('api_name');
        $api_type = $this->input->post('api_type');
        $api_url = $this->input->post('api_url');
        
        $data = array(
        'api_name' => $api_name,
        'api_url' => $api_url,
        //'api_type' => $api_type,
        'comp_id' => $this->session->userdata('companey_id'),
         'api_for' => 1
        
        );
        
        $insert_id = $this->Apiintegration_Model->addsmsapi($data);
        
        $this->session->set_flashdata('SUCCESSMSG','API Details Added Successfully');
        redirect('whatsappapi');
        
        }
        }
        
        
        public function createtemplate()
        {
            if (user_role('50') == true) {
            }
        if(!empty($_POST)){
        
        $template_name = $this->input->post('template_name');
        $template_content = $this->input->post('template_content');
        
        $image=$_FILES['media']['name'];
        $path = '';
        if(!empty($image)){
            $path= "uploads/media/".$image;
            move_uploaded_file($_FILES['media']['tmp_name'],$path);
        }
        $process=$this->input->post('process');
        $stage=$this->input->post('stage');
        $department=$this->input->post('department');
        $process =implode(',',$process);
        $stage =implode(',',$stage);
        $department =implode(',',$department);
        $data = array(
        'stage'=>$stage,
        'process'=>$process,
        'departments'=>$department,
        'template_name'     => $template_name,
        'template_content'  => $template_content,
        'media'             => $path,
        //'api_type' => $api_type,
        'comp_id'    => $this->session->userdata('companey_id'),
        'temp_for'         => 1
        );
        
        $insert_id = $this->Apiintegration_Model->addTemplates($data);
        
        $this->session->set_flashdata('SUCCESSMSG','Template Added Successfully');
        redirect('whatsappapi');
        
        }
        }


        public function delete_api(){
        if(!empty($_POST)){
        $user_status=$this->input->post('user_status');
        foreach($user_status as $key){
        $this->db->where('api_id',$key);
        $query = $this->db->delete('api_integration');
        }
        }
        }
        
        public function delete_template(){
        if(!empty($_POST)){
        $user_status=$this->input->post('sel_temp');
        foreach($user_status as $key){
        $this->db->where('temp_id',$key);
        $query = $this->db->delete('api_templates');
        }
        }
        }

        public function facebook(){
            $data['page_title']='Facebook'; 
        $data['content'] = $this->load->view('facebook1',$data,true);
        $this->load->view('layout/main_wrapper',$data);
        }
	   
	
}
