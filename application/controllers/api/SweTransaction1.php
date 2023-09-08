<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class SmsTransaction extends REST_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function email_whatapp_sms_get(){
        $comp_id = $this->input->post('comp_id');
        $this->db->where('comp_id',$comp_id);
        $this->db->or_where('comp_id',0);
        $sms_trs    =  $this->db->get('tbl_email_whatapp_sms_trans')->result_array();
        $this->set_response([
            'status' => false,
            'message' => $sms_trs  
           ], REST_Controller::HTTP_OK);  
    }

    public function add_post(){
        $comp_id = $this->input->post('comp_id');
        $user_id = $this->input->post('user_id');
        $sms_qty = $this->input->post('sms_qty');
        $sms_price = $this->input->post('sms_price');
        $total_amt = $this->input->post('total_amt');
        $type = $this->input->post('type');
        $expiry_date = $this->input->post('expiry_date');
        $data = array(
            'comp_id'=>$comp_id,
            'user_id'=>$user_id,
            'type'=>$type,
            'sms_qty'=>$sms_qty,
            'sms_price'=>$sms_price,
            'total_amt'=>$total_amt,
            'expiry_date'=>$expiry_date
        );
      
        if($this->db->insert('tbl_email_whatapp_sms_trans',$data)){
           $res = [
            'status' => true,
            'message' => "Successfully added!"  
           ];
        }else{
            $res = [
                  'status' => false,
                  'message' => "Failed to add!"  
                 ];
        }
        
        $this->set_response($res , REST_Controller::HTTP_OK);  
    }
    public function edit_get($comp_id,$smsId){
        
        $sms_trs    =  $this->db->where(['id'=>$smsId,'comp_id'=>$comp_id,'status'=>1])->get('tbl_email_whatapp_sms_trans')->result_array();
       
        $this->set_response([
            'status' => true,
            'message' => $sms_trs  
           ], REST_Controller::HTTP_OK);  
    }
    public function update_post($comp_id,$smsId){
        
        
        $data  = $this->input->post();
        $sms_trs    =  $this->db->where(['id'=>$smsId,'comp_id'=>$comp_id,'status'=>1])->update('tbl_email_whatapp_sms_trans',$data);
        if($sms_trs){
            $res = [
                'status' => true,
                'message' => "Successfully updated!"  
               ];
        }else{
            $res = [
                'status' => false,
                'message' => "Failed to update!"  
               ];
        }
        $this->set_response($res, REST_Controller::HTTP_OK);  
    }

   
} 