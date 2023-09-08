<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Programs extends CI_Controller {
 
    public function __construct(){
        parent::__construct();
    }     
    public function load_programs(){        
        $this->load->model('program_model');
        $q = $this->program_model->get_data();
        $data['courses'] = $q;
        $data['i'] = $this->input->post('id');
        
        if(!empty($_SESSION["layout"]) and $_SESSION["layout"] == "grid") {                                           
            $this->load->view('student/content-grid-view',$data);
        }else{             
            $this->load->view('student/content-list-view',$data);
        }
                        
    }    
}
