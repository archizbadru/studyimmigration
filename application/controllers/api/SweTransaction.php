<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class SweTransaction extends REST_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(array(
            'Whatsapp_model'
        ));
    }

    public function email_whatapp_sms_get(){
        
        // $this->db->where('comp_id',$comp_id);
        // $this->db->or_where('comp_id',0);
        $swe_trs    =  $this->db->get('tbl_email_whatapp_sms_trans')->result_array();
        $this->set_response([
            'status' => true,
            'message' => $swe_trs  
           ], REST_Controller::HTTP_OK);  
    }

    public function add_post(){
        $comp_id = $this->input->post('comp_id');
        $comp_admin_id = $this->input->post('comp_admin_id');
        $user_id = $this->session->user_id;
        $swe_qty = $this->input->post('qty');
        $swe_price = $this->input->post('price');
        $total_amt = ($swe_qty * $swe_price);
        $type = $this->input->post('trans_type');
        $expiry_date = $this->input->post('expiry_date');
        $res = $this->Whatsapp_model->get_balance($type,$comp_id);
        // $this->set_response($res , REST_Controller::HTTP_OK);  
        // return;
        if($res->total_quantity){
            $balance = ($res->total_quantity - $res->used_quantity);
        }else{
            $balance = $swe_qty;
        }
        
        
        
        $data = array(
            'comp_id'=>$comp_id,
            'comp_admin_id'=>$comp_admin_id,
            'user_id'=>$user_id,
            'type'=>$type,
            'qty'=>$swe_qty,
            'balance'=>$balance,
            'price'=>$swe_price,
            'total_amt'=>$total_amt,
            'expiry_date'=>$expiry_date
        );
         
        if($this->Whatsapp_model->add_balance($data)){
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

    public function edit_get($comp_id){
        
        $swe_trs    =  $this->db->where(['comp_id'=>$comp_id])->get('tbl_email_whatapp_sms_trans')->result_array();
        
        $this->set_response([
            'status' => true,
            'message' => $swe_trs  
           ], REST_Controller::HTTP_OK);  
    }

    
    public function update_post($comp_id,$smsId){
        $data  = $this->input->post();
        $swe_trs    =  $this->db->where(['id'=>$smsId,'comp_id'=>$comp_id,'status'=>1])->update('tbl_email_whatapp_sms_trans',$data);
        if($swe_trs){
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