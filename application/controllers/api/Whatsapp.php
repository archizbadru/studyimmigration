<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Whatsapp extends REST_Controller {
    function __construct()
    {
        parent::__construct();
           $this->load->database();
           $this->load->library('form_validation');
			$this->load->model(array(
				'Whatsapp_model'
			));
           $this->load->library('email'); 
           $this->load->helper('url');
           $this->methods['users_get']['limit'] = 500; 
           $this->methods['users_post']['limit'] = 100; 
           $this->methods['users_delete']['limit'] = 50; 
    }
  public function get_list_POST(){
    $type=$this->input->post('type');
    $res = $this->Whatsapp_model->get_list($type);
    $re =!empty($res)?$res:array();
            $this->set_response([
              'status' => false,
              'message' => $re  
            ], REST_Controller::HTTP_OK);  
  }
  public function get_comp_list_POST(){
    $type=$this->input->post('type');
    $comp=$this->input->post('comp_id');
    $res = $this->Whatsapp_model->get_comp_list($type,$comp);
    $re =!empty($res)?$res:array();
            $this->set_response([
              'status' => true,
              'message' => $re  
            ], REST_Controller::HTTP_OK);  
  }


  public function get_report_GET($type){
    $comp = $this->session->companey_id;
    if($comp !== "0"){
      $res = $this->Whatsapp_model->get_comp_list($type,$comp);
    }else{
      $res = $this->Whatsapp_model->get_report($type);
    }
            $this->set_response([
              'status' => true,
              'message' =>  $res
            ], REST_Controller::HTTP_OK);  
  }
}