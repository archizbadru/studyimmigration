<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Field_map extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(array(            
            'map_model'
        ));
        if(empty($this->session->userdata('isLogIn')))
            redirect('login');
        }
    public function index() {
        $data['title']       = 'Filed Map Data';
        $data['departments'] = $this->map_model->get_users_map_feed($id);        
        $data['user_role']   = $this->db->get('tbl_user_role')->result();
        $data['content']     = $this->load->view('user_map', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function map_model_content(){        
        
        $this->form_validation->set_rules('id','Id','trim|required');            

        if ($this->form_validation->run() == TRUE) {
            $id    =   $this->input->post('id');
			$mspsid= $this->map_model->get_users_map_feed($id);
            if(empty($mspsid)){ 
                echo json_encode(array('status'=>false,'msg'=>'No activity found !')); 	
            }else{
                $map_id=$mspsid->id;			  
                $this->db->where('id',$map_id);               
                $data['feed_row']    =   $this->db->get('map_location_feed')->row_array(); 			
                $content    =   $this->load->view('map_modal_content',$data,true);
                echo json_encode(array('status'=>true,'data'=>$content));            
		    }
        } else {
            echo json_encode(array('status'=>false,'msg'=>validation_error()));
        }
    }

}
