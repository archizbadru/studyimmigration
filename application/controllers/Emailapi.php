<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Emailapi extends CI_Controller {



    public function __construct()

	{

		parent::__construct();

		

		$this->load->model(array(

			'Client_Model','Apiintegration_Model','dash_model','User_model','Leads_Model'

		));

		$panel_menu = $this->db->select("modules")

    ->where('pk_i_admin_id',$this->session->user_id)

    ->get('tbl_admin')

    ->row();

        $module=explode(',',$panel_menu->modules);

	}

    

         

	public function index(){
		$data['nav1']='nav6';
        $aid = $this->session->userdata('user_id');     
        $data['title'] = 'Email Integration';
        $data['page_title'] = 'Email Integration';
        $data['api_list'] = $this->Apiintegration_Model->get_email_list();
        $api_for = 3;
        $data['products'] = $this->dash_model->get_user_product_list();
        $data['all_department'] = $this->Leads_Model->dept_select();
        $data['temp_list'] = $this->Apiintegration_Model->get_template_list($api_for);
        $data['content'] = $this->load->view('emailapi',$data,true);
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

    

    redirect('emailapi');

    }

    

    //////////////////////////////////////////////////////

    $api_for = 3;

    $data['title'] = 'Email Api Integration'  ;	

    $data['api_list'] = $this->Apiintegration_Model->get_api_list($api_for);

    $data['temp_list'] = $this->Apiintegration_Model->get_template_list($api_for);

    

    $data['content'] = $this->load->view('emailapi', $data, true);

    $this->load->view('layout/main_wrapper',$data);

    }

    

    

    

    

    public function template_details()
    {  
        
    //$data['title'] = display('Enquiry Details');
    #------------------------------# 
    //$leadid = $this->uri->segment(3);
    
    //////////////////////////////////////////////////////
    if(!empty($_POST)){
    $tmpid = $this->input->post('template_id');
    
    $template_name = $this->input->post('template_name');
    $template_content = $this->input->post('template_content');
    
    $mail_subject = $this->input->post('mail_subject');
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
    $this->db->set('mail_subject',$mail_subject);
    $this->db->set('template_content',$template_content);
    
    $this->db->where('temp_id',$tmpid);
    $this->db->update('api_templates');
    
    redirect('emailapi');
    }
    
    //////////////////////////////////////////////////////
    $api_for = 3;
    $data['title'] = 'Email Api Integration'  ; 
    $data['api_list'] = $this->Apiintegration_Model->get_api_list($api_for);
    $data['temp_list'] = $this->Apiintegration_Model->get_template_list($api_for);
    
    $data['content'] = $this->load->view('emailapi', $data, true);
    $this->load->view('layout/main_wrapper',$data);
    }



    

	

    

        public function createapi(){
            if(!empty($_POST)){
                $api_name = $this->input->post('api_name');
                $api_type = $this->input->post('api_type');
                $api_url = $this->input->post('api_url');
                $data = array(
                'api_name' => $api_name,
                'api_url' => $api_url,
                //'api_type' => $api_type,
                'comp_id'=>$this->session->userdata('companey_id'),
                'api_addby' => $this->session->userdata('user_id'),
                'api_for' => 3          
                );
                $insert_id = $this->Apiintegration_Model->addsmsapi($data);
                $this->session->set_flashdata('SUCCESSMSG','API Details Added Successfully');
                redirect('emailapi');
            }
        }


        public function create_email_conf(){
            if(!empty($_POST)){
             
                $title              = $this->input->post('title');
                $protocol           = $this->input->post('protocol');
                $smtp_host          = $this->input->post('smtp_host');
                $smtp_user          = $this->input->post('smtp_user');
                $smtp_password      = $this->input->post('smtp_password');
                $smtp_port          = $this->input->post('smtp_port');

                $data   = array(
                                'comp_id'   =>  $this->session->userdata('companey_id'),
                                'name'      =>  $title,
                                'protocol'  =>  $protocol,                                
                                'smtp_host' =>  $smtp_host,                                
                                'smtp_port' =>  $smtp_port,                                
                                'smtp_timeout' =>  7,                                
                                'smtp_user' =>  $smtp_user,                                
                                'smtp_pass' =>  $smtp_password,                                
                                'created_by' => $this->session->userdata('user_id'),                                
                            );
                if ($this->input->post('id')) {
                    $this->db->where('id',$this->input->post('id'));
                    $this->db->update('email_integration',$data);
                    $this->session->set_flashdata('SUCCESSMSG','Email Setting Updated Successfully');                       
                }else{
                    $insert_id = $this->Apiintegration_Model->add_emaiapi($data);
                    $this->session->set_flashdata('SUCCESSMSG','Email Setting Added Successfully');
                }

                redirect('emailapi');
            }   
        }

    
        public function delete_emailapi(){
            if(!empty($_POST)){
                $user_status=$this->input->post('user_status');
                foreach($user_status as $key){
                    $this->db->where('id',$key);
                    $query = $this->db->delete('email_integration');
                }
            }
        }
            

        public function createtemplate()
        {
            
            if(!empty($_POST)){
            
            $template_name = $this->input->post('template_name');
            $template_content = stripslashes($this->input->post('template_content'));
            
            $template_response = $this->input->post('template_response');
            
            $auto_mail_for = $this->input->post('auto_mail_for');
            
            $mail_subject = $this->input->post('mail-subject');
            
            $insert=array();
            
            if(!empty($_FILES['upload-attachments']['name'])){
                
                $filesCount = count($_FILES['upload-attachments']['name']);
                
                for($i=0; $i < $filesCount; $i++){
                    
                    $_FILES['file']['name']     = $_FILES['upload-attachments']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['upload-attachments']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['upload-attachments']['tmp_name'][$i];
                    $_FILES['file']['size']     = $_FILES['upload-attachments']['size'][$i];
                    
                    $uploadPath = 'assets/attachments/mail/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|png|pdf|doc|docx';
                    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    if($this->upload->do_upload('file')){
                        
                        $fileData = $this->upload->data();
                        $uploadData[$i]['files'] = $uploadPath.$fileData['file_name'];
                        $uploadData[$i]['added_by'] = $this->session->user_id; 
                    }
                    
                }
                
                if(!empty($uploadData)){
                    
                    $insert = $uploadData;
                }
                
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
            'template_name' => $template_name,
            'mail_subject'  =>$mail_subject,
            'template_content' => $template_content,
            'response_type'    => $template_response,
            'auto_mail_for'=>$auto_mail_for,
            'temp_addby' => $this->session->userdata('companey_id'),
            'comp_id' => $this->session->userdata('companey_id'),
             'temp_for' => 3
            
            );
            
            $insert_id = $this->Apiintegration_Model->addTemplate($data,$insert);
            
            $this->session->set_flashdata('SUCCESSMSG','Template Added Successfully');
            redirect('emailapi');
            
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

        

        

	   

	

}

