<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Enquiry extends REST_Controller {
    function __construct()
    {
        parent::__construct();
           $this->load->database();
           $this->load->library('form_validation');
            
    $this->load->model(array(
      'enquiry_model','Leads_Model','location_model','Task_Model','User_model','Message_models','common_model'
    ));
    $this->load->model('api/sync_model');
    $this->lang->load("activitylogmsg","english");
    
    $this->load->library('email'); 
   // $this->lang->load('notifications_lang', 'english');   
    
           $this->load->helper('url');
           $this->methods['users_get']['limit'] = 500; 
           $this->methods['users_post']['limit'] = 100; 
           $this->methods['users_delete']['limit'] = 50; 
    }
    function phone_check($phone){
        $product_id    =   $this->input->post('process_id');
        if(!$product_id){  
            $this->form_validation->set_message('phone_check', 'The Process field can not be the empty');
            return false;
        }else{
            $query = $this->db->query("select phone from enquiry where product_id=$product_id AND phone=$phone");
            if ($query->num_rows()>0) {
                $this->form_validation->set_message('phone_check', 'The Mobile no field can not be dublicate in current process');
                return false;
            }else{
                return TRUE;
            }
        }    
    }
    public function create_post()
    {   
      
      $upd =$this->input->post('update');   
    if(!empty($this->input->post('email') && !empty($this->input->post('mobileno')))){
        $comp_id  = $this->input->post('company_id');   
          if (!$upd) {
            $this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|required');            
          }else{
            $this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|required');            
          }         
        $enquiry_date = $this->input->post('enquiry_date');
          if($enquiry_date !=''){
            $enquiry_date = date('d/m/Y');
          }else{
            $enquiry_date = date('d/m/Y');
          } 
           $city_id= $this->db->select("*")
      ->from("city")
      ->where('id',$this->input->post('city'))
      ->get();
      
    if ($this->form_validation->run() === true) {
            $name = $this->input->post('fname');
            $name_w_prefix = $name;
            $branch_code = $this->input->post('branch_name');
if(empty($branch_code)){
  $create_by = $this->input->post('user_id');
            $this->db->select('sales_branch');
                          $this->db->where('pk_i_admin_id',$create_by);
           $qr_row1    =  $this->db->get('tbl_admin')->row_array();
           $bnm = $this->db->where('id',$qr_row1['sales_branch'])->get('tbl_branch')->row();
           $branch_code = $bnm->b_name;
}
             if(!empty($branch_code)){   
               // print_r($branch_code);exit;
                $branch=strtoupper($branch_code);
                $first=substr($branch,0,4);
                $dt=date('d');
                $mt=date('m');
                $yt=date('y');
                $second=$dt.''.$mt.''.$yt;
                $third=mt_rand(10000,99999);
                $encode=$first.''.$second.''.$third;
            }else{
                $encode = $this->get_enquery_code();
            }
           // print_r($encode);die;
      $crtdby = $this->input->post('user_id');
      $user =$this->User_model->read_by_id($crtdby);
            $postData = [                
                'user_role' => $user->user_roles,
                'comp_id' => $comp_id,
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('mobileno', true),
                'name_prefix' => $this->input->post('name_prefix', true),
                'name' => $name_w_prefix,
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'reference_type' => $this->input->post('reference_type'),
                'reference_name' => $this->input->post('reference_name'),
                'enquiry' => $this->input->post('enquiry', true),
                'enquiry_source' => $this->input->post('enquiry_source'),
                'enquiry_subsource' => $this->input->post('product_id'),
                'company' => $this->input->post('org_name'),
                'address' => $this->input->post('address'),
                'checked' => 0,                
                'product_id' => $this->input->post('process_id'),
                'institute_id' => $this->input->post('institute_id'),
                'datasource_id' => $this->input->post('datasource_id'),
                'center_id' => $this->input->post('center_id'),
                'ip_address' => $this->input->ip_address(),
                'created_by' => $this->input->post('user_id'),
                'city_id' => !empty($city_id->row())?$city_id->row()->id:'',
                'state_id' => !empty($city_id->row())?$city_id->row()->state_id:'',
                'country_id'  =>!empty($city_id->row())?$city_id->row()->country_id:'',
                'region_id'  =>!empty($city_id->row())?$city_id->row()->region_id:'',
                'territory_id'  =>!empty($city_id->row())?$city_id->row()->territory_id:'',

                'branch_name' => $this->input->post('branch_name'),
                'in_take' => $this->input->post('in_take'),
                'residing_country' => $this->input->post('residing_country'),
                'nationality' => $this->input->post('nationality'),
                'preferred_country' => $this->input->post('preferred_country'),
                'age' => $this->input->post('age'),
                'marital_status' => $this->input->post('marital_status'),
                'apply_person' => $this->input->post('apply_person'),
                'country_stayed' => $this->input->post('country_stayed'),
                'police_case' => $this->input->post('police_case'),
                'ban_country' => $this->input->post('ban_country'),
                'high_qualification' => $this->input->post('high_qualification'),
                'ielts' => $this->input->post('ielts'),
                'code_prefix' => '91',
               
                //'created_date' =>$enquiry_date, 
                'status' => 1
            ];
            
           
            if(!empty($upd))
            {   
              //print_r($postData);die;                              
             
              
              $this->db->where('Enquery_id',$this->input->post('update'));
              $insert_id = $this->db->update('enquiry',$postData);
              //print_r($insert_id);die;
              $this->db->select('enquiry.Enquery_id,enquiry.enquiry_id');
              $this->db->where('Enquery_id',$this->input->post('update'));
              $e_row  = $this->db->get('enquiry')->row_array();
              $msg  = 'Enquiry successfully updated';
              $this->Leads_Model->add_comment_for_events($this->lang->line("information_updated"), $this->input->post('update'),'',$this->input->post('user_id'));
            }
            else
            {
              $postData['Enquery_id'] = $encode;
              $postData['status'] = 1;
              $this->db->select('enquiry_id,drop_status');
              $this->db->or_where('phone',$this->input->post('mobileno', true));
              $this->db->or_where('email',$this->input->post('email', true));
              $res=$this->db->get('enquiry')->row();
              $email = $this->db->where('email',$this->input->post('email'))->get('enquiry')->row();
              $mobile = $this->db->where('phone',$this->input->post('mobileno'))->get('enquiry')->row();
              if(!empty($email->enquiry_id))
              {
                  $insert_id = $res->enquiry_id;
                  $this->db->select('enquiry.Enquery_id,enquiry.enquiry_id');
                  $this->db->where('enquiry_id',$insert_id);
                  $e_row  = $this->db->get('enquiry')->row_array();
                  $msg  = 'email exist';
              }else if(!empty($mobile->enquiry_id)){
                $insert_id = $res->enquiry_id;
                $this->db->select('enquiry.Enquery_id,enquiry.enquiry_id');
                $this->db->where('enquiry_id',$insert_id);
                $e_row  = $this->db->get('enquiry')->row_array();
                $msg  = 'mobile no exist';

              }else if(empty($res->enquiry_id) && empty($res->drop_status)){

        $this->enquiry_model->create($postData);
      $insert_id = $this->db->insert_id();
    $this->db->select('enquiry.Enquery_id,enquiry.enquiry_id');
    $this->db->where('enquiry_id',$insert_id);
    $e_row  = $this->db->get('enquiry')->row_array();
    $msg  = 'Enquiry successfully created';

    }else if(!empty($res->enquiry_id) && !empty($res->drop_status)){

        $this->db->set('drop_status', '0');
        $this->db->set('drop_reason', '');
        $this->db->set('update_date', date('Y-m-d H:i:s'));
        $this->db->where('enquiry_id', $res->enquiry_id);
        $this->db->update('enquiry');

        $insert_id = $res->enquiry_id;
        $this->db->select('enquiry.Enquery_id,enquiry.enquiry_id');
    $this->db->where('enquiry_id',$insert_id);
    $e_row  = $this->db->get('enquiry')->row_array();
    $msg  = 'Your Enquiry has been  Successfully Activated!';

    }
          
          $this->Leads_Model->add_comment_for_events($this->lang->line("enquery_create"), $encode,'',$this->input->post('user_id'));


            }
        $this->load->model('rule_model');
          $this->rule_model->execute_rules($encode,array(1,2,3,6,7),$comp_id,$this->input->post('user_id'),$this->input->post('process_id'));           
      if ($insert_id) {
          foreach($this->input->post() as $ind => $val){         
            if(is_int($ind)){           
            $biarr = array( 
                    "enq_no"  => $e_row['Enquery_id'],
                          "input"   => $ind,
                          "parent"  => $e_row['enquiry_id'], 
                          "fvalue"  => $val,
                          "cmp_no"  => $comp_id,
                         );     
            
            $this->db->where('enq_no',$e_row['Enquery_id']);        
            $this->db->where('input',$ind);        
            $this->db->where('parent',$e_row['enquiry_id']);
            
            if($this->db->get('extra_enquery')->num_rows()){              
                $this->db->where('enq_no',$e_row['Enquery_id']);        
                $this->db->where('input',$ind);        
                $this->db->where('parent',$e_row['enquiry_id']);
                $this->db->set('fvalue',$val);
                $this->db->update('extra_enquery');
            }else{
                $this->db->insert('extra_enquery',$biarr);
            }
          }
        }
        $this->set_response([
                'status' => TRUE,
                'message' => $msg
            ], REST_Controller::HTTP_OK);
      
      } 
       } else {        
         $this->set_response([
                'status' => false,
                'message' =>strip_tags(validation_errors())
             ], REST_Controller::HTTP_OK);
         }
    }else{
         $error='Empty field';
         $this->set_response([
                'status' => false,
                'message' =>$error
             ], REST_Controller::HTTP_OK);
    
    }
  }
  
  public function send_message_post(){
    
    $Enquery_id = $this->input->post('enquery_code');
    $template_id = $this->input->post('template_id');
    $company_id  = $this->input->post('company_id');
    $msg_type = $this->input->post('msg_type');
    $user_id = $this->input->post('user_id');

    $this->form_validation->set_rules('enquery_code','Inquiry Code','required');
    $this->form_validation->set_rules('company_id','Company ID','required');
    $this->form_validation->set_rules('template_id','Template ID','required');
    $this->form_validation->set_rules('user_id','User ID','required');
    $this->form_validation->set_rules('msg_type','Message Type','required');
    
    if($this->form_validation->run() == true){
    
    $this->db->where('pk_i_admin_id',$user_id);
    $user_row  = $this->db->get('tbl_admin')->row_array();

    $this->db->where('temp_id',$template_id);
    $this->db->where('temp_for',$msg_type);
    $template_row = $this->db->get('api_templates')->row();
    // print_r($template_row);die;
    if(!empty($template_row))
    {

        $Templat_subject = $template_row->mail_subject;
        $message_name = $template_row->template_content;
      
          $enq = $this->enquiry_model->enquiry_by_code($Enquery_id);

          $empty =1;
          if($msg_type=='1')
          {
             $empty = empty($enq->phone);
             $type = 'Whatasapp Message';
          }
          else if($msg_type=='2')
          {
              $empty = empty($enq->phone);
              $type = 'Message';
          }
          else if($msg_type=='3')
          {
              $empty = empty($enq->email);
              $type = 'Email';
          }
          //echo $empty; exit();
          if(!$empty)
          {
            $this->db->where('comp_id',$company_id);
            $this->db->where('sys_para','usermail_in_cc');
            $this->db->where('type','COMPANY_SETTING');
            $cc_row = $this->db->get('sys_parameters')->row_array(); 
            $cc = '';
                if(!empty($cc_row))
                {
                  $this->db->where('pk_i_admin_id',$user_id);
                  $cc_user =  $this->db->get('tbl_admin')->row_array();
                  if(!empty($cc_user))
                        $cc = $cc_user['s_user_email'];
                }
                           
              $to = $enq->email;
              $name1 = $enq->name_prefix.' '.$enq->name.' '.$enq->lastname;

              $msg = str_replace('@name',$name1,str_replace('@org',$user_row['orgisation_name'],str_replace('@desg',$user_row['designation'],str_replace('@phone',$user_row['contact_phone'],str_replace('@desg',$user_row['designation'],str_replace('@user',$user_row['s_display_name'].' '.$user_row['last_name'],$message_name))))));
                     //str_replace('@web',$user_row['website'], 
              $Templat_subject = str_replace('@name',$name1,str_replace('@org',$user_row['orgisation_name'],str_replace('@desg',$user_row['designation'],str_replace('@phone',$user_row['contact_phone'],str_replace('@desg',$user_row['designation'],str_replace('@user',$user_row['s_display_name'].' '.$user_row['last_name'],$Templat_subject))))));
              $send_result=0;
              if($msg_type=='1')
              {
                $phone = '91'.$enq->phone;
               // echo $phone.'<br>'.$msg; exit();
                  $this->Message_models->sendwhatsapp($phone,$msg); 
                    if($template_row['media'])
                    {            
                      $media_url = $template_row['media'];    
                      $this->Message_models->sendwhatsapp($phone,base_url().$media_url); 
                      
                    }
                  $send_result =1;
              }
              else if($msg_type=='2')
              {
                 $phone = '91'.$enq->phone;
                  $this->Message_models->smssend($phone,$msg);
                  $send_result =1;
              }
              else if($msg_type=='3')
                $send_result = $this->Message_models->send_email($to,$msg,$Templat_subject,$company_id,$cc);

              
              if($send_result)
              {
               $msg= $type.' Sent successfully';
               $this->set_response([
                      'status' => true,
                      'message' =>$msg
                   ], REST_Controller::HTTP_OK);
               }
               else
               {
                 $msg= 'Something went wrong!';
                 $this->set_response([
                        'status' => false,
                        'message' =>$msg
                     ], REST_Controller::HTTP_OK);
               }
          }else
          {
               $msg= (($msg_type=='1' or $msg_type=='2')?'Phone Number':'Email').' does not exist for this inquiry';
               $this->set_response([
                      'status' => false,
                      'message' =>$msg
                   ], REST_Controller::HTTP_OK);
          }
         
      }
      else
      {
          $msg= 'No Template Found';
               $this->set_response([
                      'status' => false,
                      'message' =>$msg
                   ], REST_Controller::HTTP_OK);
      }
    }else{
          $error= strip_tags(validation_errors());
         $this->set_response([
                'status' => false,
                'message' =>$error
             ], REST_Controller::HTTP_OK);
    }
  }
  
  public function get_mail_template_post(){    
    $this->db->where('temp_for',3);
    $this->db->where('response_type',1);
    $this->db->where('comp_id',$this->input->post('company_id'));
    $res=$this->db->get('api_templates');
    $q=$res->result_array();
    $template = array();
    foreach($q  as $value){
      array_push($template,array('template_id'=>$value['temp_id'],'template_value' => $value['template_name'] ) );     
    }
    if(empty($template)){
      $this->set_response([
          'status' => false,
          'template' => $template,
           ], REST_Controller::HTTP_OK);
    }else{      
      $this->set_response([
          'status' => TRUE,
          'template' => $template,
           ], REST_Controller::HTTP_OK);
    }
  }

  public function addtimeline_post(){ 
    $this->form_validation->set_rules("phone", "Phone", "trim|required");
    $this->form_validation->set_rules("campaign", "Campaign", "trim|required"); 
    
    if($this->form_validation->run()){
      
      $phone = $this->input->post("phone", true);
      $camp  = $this->input->post("campaign", true);
      //$key   = $this->input->post("key", true);
      
    
      $this->db->select("enq.*");
      $this->db->where(
                      array(
                        "enq.phone" => $phone,
            "prd.product_name"  => trim($camp),
                )
             );                         
      $this->db->from("enquiry enq");            
      $this->db->join("tbl_product prd", "prd.sb_id = enq.product_id", "inner");
      $res = $this->db->get()->row();     
      
      //echo $this->db->last_query();
      //print_r($resarr);
      if(!empty($res)){
      $ins = false;               
          $this->load->model("leads_model");        
      
          
            $Enquery_id  = $res->Enquery_id;
            $stage_id = '';
            $stage_desc = '';
            $stage_remark = json_encode($this->input->post());
            $user_id = '';
        $ret = $this->leads_model->add_comment_for_events_stage_api("Voice Call",$Enquery_id,$stage_id,$stage_desc,$stage_remark,$user_id,5);                   
          
            if($ret){
          $ins = true;
        }
        //echo $this->db->last_query();
      
    
    if($ins){
      $this->set_response(["status"     => TRUE,
         "message"   => "Successfully Added"], REST_Controller::HTTP_OK);
    }else{
        $this->set_response(["status"     => False,
         "message"   => "Failed to add "], REST_Controller::HTTP_OK);
    }
  }else{
    $this->set_response(["status"     => false,
         "message"   => "Mobile No not found"], REST_Controller::HTTP_OK);
  }
  }else{
  $this->set_response(["status"     => False,
         "message"   => "Failed to add ".strip_tags(validation_errors())], REST_Controller::HTTP_OK);
  }
    
  }
  public function timeline_post(){
    
    $enquiry_id = $this->input->post('enqueryno', true); 
    $this->load->model("Leads_Model");
    
    $cmntarr = $this->Leads_Model->comment_byId($enquiry_id);
    $tmlinearr  = array();
    
    if(!empty($enquiry_id)) {
      foreach($cmntarr as $ind => $tml){
      
        if($tml->status == 1){
          
          $type = "Enquery";
          
        }else if($tml->status == 2){
          
          $type = "Client";
          
        }else if($tml->status == 3){
          
          $type = "Lead";
        }else{
          $type = $tml->status;
        }
        
        array_push($tmlinearr,array("leadno"      => $tml->lead_id,
                      "message"      => $tml->comment_msg,
                      "updated"      => date("j-M-Y h:i:s a",strtotime($tml->ddate)),
                      "addedby"      => $tml->comment_created_by . ' ' .$tml->lastname,
                      "stage"       => $tml->lead_stage_name,
                      "description"  => $tml->description,
                      "remark"       => $tml->remark,
                      "type"      => $type)
                      ); 
      }
  
      $this->set_response(["status"     => TRUE,
               "timeline"   => $tmlinearr], REST_Controller::HTTP_OK);
    }else{
      $this->set_response(["status"     => False,
               "timeline"   => $tmlinearr], REST_Controller::HTTP_OK);
      
    }        
  }
  public function addfieldans_post(){   // this is for paisa expo enquiry capturring    
    $this->db->insert('test',array('res'=>json_encode($_POST)));
    $comp_id = 29;    
        $this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|required', array('is_unique' => 'Duplicate   Entery for phone'));   
        $this->form_validation->set_rules('process_id', 'Process Id', 'trim|required');
    if($this->form_validation->run()){  
      $city_id= $this->db->select("*")
          ->from("city")
          ->where('comp_id',$comp_id)
          ->where('TRIM(city)',trim($this->input->post('city')))
          ->get();
            $product  = $this->input->post('product');
            if (!empty($product)) {
              $product_row  = $this->db->select("*")
                  ->from("tbl_product_country")
                    ->where('comp_id',$comp_id)
                    ->where('TRIM(country_name)',trim($product))
                    ->get()->row_array();
            }
        $mob  = $this->input->post('mobileno');
        $marr = explode('_', $mob);       
        //print_r($marr);
        if (!empty($marr[1])) {
          $this->db->where('phone',$marr[0]);         
          $this->db->where('enquiry_subsource',$marr[1]);         
          $enq_arr  = $this->db->get('enquiry')->row_array();
          $update = $enq_arr['Enquery_id'];
          if (empty($enq_arr)) {
            echo "You can not submit application form directly";
            die(); 
          }
        }else{
          $update = 0;
        }
        
        if($update){
          $this->db->where('Enquery_id',$update);         
          if($this->db->get('enquiry')->num_rows()){
            $encode = $update;
          }else{
            $this->set_response(["status"     => false,
                     "message"   => "Invalid Id"], REST_Controller::HTTP_OK);
            die(); 
          }
        }else{
          $encode = $this->get_enquery_code();
        }
        if (isset($_POST["gender"])) {
          if ($this->input->post('gender')=='Male') {
            $gender = 1;
          }elseif ($this->input->post('gender')=='Female') {
            $gender = 2;
          }elseif ($this->input->post('gender')=='Other') {
            $gender = 3;
          }
        }else{
          $gender  = '';
        }
        
          $insarr = [             
              'comp_id'         => $comp_id,              
              'name_prefix'     => (isset($_POST["name_prefix"])) ? $this->input->post('name_prefix', true) :"",
              'name'          => (isset($_POST["name"])) ? $this->input->post('name')  : "",
              'lastname'        => (isset($_POST["lastname"])) ? $this->input->post('lastname') : "",
              'gender'        => $gender,
              'phone'           => (isset($_POST["mobileno"])) ? $marr[0] :"",
              'email'         => (isset($_POST["email"])) ? $this->input->post('email', true) : "",
              'product_id'    => (isset($_POST["process_id"])) ? $this->input->post('process_id', true) : "",
              'city_id'       => (isset($city_id)) ? $city_id->row()->id : "",
              'state_id'      => (isset($city_id)) ? $city_id->row()->state_id : "",
              'country_id'      => (isset($city_id)) ? $city_id->row()->country_id : "",
              'region_id'     => (isset($city_id)) ? $city_id->row()->region_id : "",
              'territory_id'    => (isset($city_id)) ? $city_id->row()->territory_id : "",              
              'address'       => (isset($_POST["address"])) ? $this->input->post('address') : "",
              'pin_code'      => (isset($_POST["pin-code"])) ? $this->input->post('pin-code') : "",
              'enquiry_source'  => (isset($_POST["enquiry_source"])) ? $this->input->post('enquiry_source') : "55",
              'sub_source'    => (isset($_POST["sub_source"])) ? $this->input->post('sub_source') : "",
              'other_phone'     => (isset($_POST["other_phone"])) ? $this->input->post('other_phone', true) :"",
              'reference_type'  => (isset($_POST["reference_type"])) ? $this->input->post('reference_type') : "1",
              'reference_name'  => (isset($_POST["reference_name"])) ? $this->input->post('reference_name') : "",
              'enquiry'     => (isset($_POST["remark"])) ? $this->input->post('remark', true) : "",
              'enquiry_subsource' => !empty($product_row['id'])?$product_row['id']:'',
              'company'       => (isset($_POST["company"])) ? $this->input->post('company') : "",
              'checked'       => (isset($_POST["checked"])) ? 0 : "",             
              'datasource_id'   => (isset($_POST["datasource_id"])) ? $this->input->post('datasource_id') : "",             
              'ip_address'    => (isset($_POST["ip_address"])) ? $this->input->ip_address() : "",
              'created_by'    => (isset($_POST["user_id"])) ? $this->input->post("user_id", true) : "191",
              'lead_stage'        => (isset($_POST["lead_stage"])) ? $this->input->post("lead_stage", true) : "",
              'status'      => 1,
              'aasign_to'       => (isset($_POST["assign_to"])) ? $this->input->post("assign_to", true) : "",
              'partner_id'    => (isset($_POST["partner_id"])) ? $this->input->post("partner_id", true) : ""
            ];
  
      if ($update) {        
        $this->db->where('Enquery_id',$encode);         
        $enq_row  = $this->db->get('enquiry')->row_array(); 
        $enqno =  $enq_row['enquiry_id']; 
        $this->db->where('Enquery_id',$encode);
        $insarr['lead_stage'] = 173;
        //$this->db->update('enquiry',array('lead_stage'=>173));      
        $this->db->update('enquiry',$insarr);     
                $this->Leads_Model->add_comment_for_events_stage_api('Stage Updated', $encode,173,'','',191,0);
      }else{      
        $insarr['Enquery_id'] = $encode;
        $insarr['lead_stage'] = 172;    //first form submitted;
        $ret = $this->db->insert('enquiry', $insarr); 
        $enqno = $this->db->insert_id();    
        $comment = $this->lang->line("enquery_create");
                $this->Leads_Model->add_comment_for_events_stage_api($comment, $encode,0,'','',191,0);
                $this->Leads_Model->add_comment_for_events_stage_api('Stage Updated', $encode,172,'','',191,0);
        $process_id = $this->input->post('process_id', true);       
        if ($process_id == 95 || $process_id == 91) {
          $meta_arr = array(
              'enquiry_code'      => $encode,             
              'paisaexpo_processid'   => (isset($_POST["paisaexpo_processid"])) ? $this->input->post('paisaexpo_processid', true) : "",  
              'paisaexpo_customerid'  => (isset($_POST["paisaexpo_customerid"])) ? $this->input->post('paisaexpo_customerid', true) : "",
              'paisaexpo_requestid' => (isset($_POST["paisaexpo_requestid"])) ? $this->input->post('paisaexpo_requestid', true) : "",             
              'date_updated'      => (isset($_POST["date_updated"])) ? $this->input->post('date_updated', true) : ""              
          );
          $this->db->insert('paisa_expo_enquiry_meta',$meta_arr); 
        }     
      }
            if ($this->input->post('bankname')) {
              $res = $this->enquiry_model->get_deal($encode);            
              $bank = $this->input->post('bankname');
              $product_loan = $product_row['id'];
              if($res){             
                $array_newdeal = array(
                        'bank'    => $bank,
                        'product'   => $product_loan,
                        'updated_by'=> 191
                    );  
                $this->db->where('enq_id',$encode);
                $this->db->update('tbl_newdeal',$array_newdeal);
              }else{
                $array_newdeal = array(
                    'comp_id'   => 29,
                    'enq_id'    => $encode,
                    'bank'      => $bank,
                    'product'   => $product_loan,
                    'created_by'=> 191
                );     
                  $this->db->insert('tbl_newdeal',$array_newdeal);
              }
          }
      $labelarr = $_POST;
      if(!empty($labelarr)){      
        $newlbl = array();
        $valarr = array();
        foreach($labelarr as $ind => $val){                   
          $clnlbl           = $ind; 
          $newlbl[]         = $clnlbl;
          $valarr[$clnlbl]  = $val;
        }       
        $this->db->select('*');
        $this->db->where('company_id', $comp_id);
        $this->db->where_in('input_name', $newlbl);       
        $lblarr = $this->db->get('tbl_input')->result();      
        foreach($lblarr as $ind => $val){ 
            $input_value = (!empty($valarr[$val->input_name])) ? $valarr[$val->input_name] : "";  
            $biarr = array(
                    "enq_no" => $encode,
                    "parent" => $enqno,
                    "input"  => $val->input_id,
                    "fvalue" => $input_value ,
                    "cmp_no" => $comp_id,
                    "status" => 1
                  );
            $this->db->where('enq_no',$encode);        
                        $this->db->where('input',$val->input_id);        
                        $this->db->where('parent',$enqno);
                        if($this->db->get('extra_enquery')->num_rows()){                            
                            $this->db->where('enq_no',$encode);        
                            $this->db->where('input',$val->input_id);        
                            $this->db->where('parent',$enqno);
                            $this->db->set('fvalue',$input_value);
                          $ret =   $this->db->update('extra_enquery');
                        }else{
                          $ret  =  $this->db->insert('extra_enquery',$biarr);
                        }                 
        }
        if($ret){
            $this->set_response(["status"     => true,
             "message"   => "Successfully saved",           
          ], REST_Controller::HTTP_OK);
        }else{
          $this->set_response(["status"     => false,
          "message"   => "Failed to  saved"], REST_Controller::HTTP_OK);
        }
      }
    }else{
      $this->set_response(["status"     => false,
       "message"   => "Failed to add ".validation_errors()], REST_Controller::HTTP_OK);
    }   
  }
  public function addfields_post(){
    
  //  $this->form_validation->set_rules("key","Key", "trim|required");
    $this->form_validation->set_rules("label","Label", "trim|required|callback_checklabel");
    $this->form_validation->set_rules("type","Type", "trim|required");
    //$this->form_validation->set_rules("default","Default", "trim|required");
    
    if(!empty($_SERVER['HTTP_KEY'])){
      
      $key = $_SERVER['HTTP_KEY']; 
    }else{
      $this->set_response(["status"     => false,
           "message"   => "key not matched"], REST_Controller::HTTP_OK);
    }
    
    
    if($this->form_validation->run()) {
    
      $label  = $this->input->post("label", true);
      $type   = $this->input->post("type", true);
      $value  = $this->input->post("default", true);
      $isreq  = $this->input->post("isreq", true);
      $key    = $this->input->post("key", true);
      $insarr = array("input_place"   => "",
              "input_label"   => $label,
              "input_values"  => $value,
              "input_name"    => "",
              "input_type"    =>  $type,
              "function"      => "",
              "label_required" => (!empty($isreq)) ? $isreq : "No",
              "company_id"     => $key ,
              "process_id"    => "",
              "status"    => "1");
              
      $ret = $this->db->insert("tbl_input", $insarr);
      
      if($ret){
        
        $this->set_response(["status"     => true,
           "message"   => "Successfully added"], REST_Controller::HTTP_OK);
  
      }else{
        $this->set_response(["status"     => false,
           "message"   => "Failed to add"], REST_Controller::HTTP_OK);
        
      }
    
    }else{
      $this->set_response(["status"     => false,
           "message"   => "Failed to add ".validation_errors()], REST_Controller::HTTP_OK);
    }       
            
    
  }
  
  public function checklabel(){
    
    $lblname = $this->input->post("label", true);
    $cmpno   = $this->input->post("key", true);
    $tcol =  $this->db->select("*")
            -> where("company_id", $cmpno)  
            ->where("input_label", $lblname)  
          ->from("tbl_input")
          ->count_all_results();
    if($tcol > 0){
      $this->form_validation->set_message('checklabel','Input label already exist');
      return false;
    }else{
      return true;
    }
  }
  public function update_post()
  {  
    $enquiry_id = $this->input->post('Enquiry_id'); 
    
   /* 
    echo "<pre>";
    print_r($_POST);
    exit();
   */
    $this->form_validation->set_rules('Enquiry_id','Enquiry Id '  ,'required');
    $this->form_validation->set_rules('user_id','User Id '  ,'required');
  //  $this->form_validation->set_rules('enquiry_type','Inquiry type '  ,'required');
    $this->form_validation->set_rules('fname','First Name '  ,'required');
   // $this->form_validation->set_rules('lastname','Last Name '  ,'required');
   // $this->form_validation->set_rules('fcity','City '  ,'required');
    $data['title'] = display('information');
    #-------------------------------#
    if ($this->form_validation->run() == true) {
    if(!empty($_POST)){
    
    /*********hhhhhhhhhhhhhh*******/
          $name = $this->input->post('fname');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobileno');
            $lead_source = $this->input->post('lead_source');
            $enquiry = $this->input->post('enquiry');
            $en_comments = $this->input->post('enqCode');
            $company = $this->input->post('org_name');
            $address = $this->input->post('address');
            $name_prefix = $this->input->post('name_prefix');
            $this->db->set('country_id', $this->input->post('product'));
            $this->db->set('product_id', $this->input->post('process'));
           // $this->db->set('institute_id', $this->input->post('institute_id'));
          //  $this->db->set('datasource_id', $this->input->post('lead_source'));
            $this->db->set('phone', $mobile);
      //$this->db->set('enquiry_subsource',$this->input->post('sub_source'));
            $this->db->set('email', $email);
            $this->db->set('company', $company);
            $this->db->set('address', $address);
            $this->db->set('name_prefix', $name_prefix);
            $this->db->set('name', $name);
            $this->db->set('enquiry_source', $lead_source);
            $this->db->set('enquiry', $enquiry);
            $this->db->set('lastname', $this->input->post('lastname'));
            $this->db->where('Enquery_id', $enquiry_id);
            $this->db->update('enquiry');     
            if($this->db->affected_rows()>0){
           // echo $this->db->last_query();
        /*  $ld_updt_by = $this->input->post('user_id');
          $enquiry_row = $this->enquiry_model->enquiry_by_code($enquiry_id);
          $created_by_user_id = $enquiry_row->created_by;
          
          $user_row = $this->User_model->read_by_id($created_by_user_id);
          $phone_no = $user_row->s_phoneno;
          $creator_phone = '91'.$phone_no;      
          $user_row = $this->User_model->read_by_id($ld_updt_by);          
          
          $updated_by_name = $user_row->s_display_name.' '.$user_row->last_name;
          
          $enq_of_name = $enquiry_row->name_prefix.''.$enquiry_row->name.' '.$enquiry_row->lastname;
          $notification_msg = sprintf($this->lang->line('enquiry_update_text'),trim($enq_of_name),trim($updated_by_name));
          $this->Message_models->sendwhatsapp($creator_phone,$notification_msg);
          $this->Leads_Model->add_comment_for_events_api($notification_msg,$enquiry_id,$ld_updt_by);
          /
          /*$adt = date("d-m-Y H:i:s");
          $this->db->set('lead_id',$en_comments);
          $this->db->set('created_date',$adt);
          $this->db->set('comment_msg','Enquiry Updated');
          $this->db->set('created_by',$ld_updt_by);
          $this->db->insert('tbl_comment');*/
        //$this->Leads_Model->add_comment_for_events('Enquiry Updated',$en_comments);
        
        $this->set_response([
              'status' => TRUE,
              'message' => 'Enquiry successfully updated'
          ], REST_Controller::HTTP_OK);      
      }else{
        $error='Something went wrong!';
         $this->set_response([
                'status' => false,
                'message' =>$error
             ], REST_Controller::HTTP_OK);
      }
      
    }else{
      $error='Post data does not exit!';
         $this->set_response([
                'status' => false,
                'message' =>$error
             ], REST_Controller::HTTP_OK);
    }
  }else{
    $error= strip_tags(validation_errors());
         $this->set_response([
                'status' => false,
                'message' =>$error
             ], REST_Controller::HTTP_OK);
  }
  }
   public function customer_type_post()
                          {
            if($this->input->post('customer_type')==1){
            $data['customer_types'] = $this->enquiry_model->customers_types();
            
             if(!empty($data['customer_types'])){
                   $array_val=array();
                   foreach($data['customer_types'] as $val){
                     array_push($array_val,array('customer_id'=>$val->cus_id,'customer_type'=>$val->customer_type)); 
                   }
           
                }
        
        
            }elseif($this->input->post('customer_type')==11){
              $data['customer_types'] = $this->enquiry_model->channel_partner_type_list();
               if(!empty($data['customer_types'])){
                   $array_val=array();
                   foreach($data['customer_types'] as $val){
                     array_push($array_val,array('customer_id'=>$val->ch_id,'customer_type'=>$val->channel_partner_type)); 
                   }
           
                }
            }
       
      
       
          $this->set_response([
                'status' => TRUE,
                'Customer' => $array_val
                 ], REST_Controller::HTTP_OK);
        
        }
        
        public function source_post()
        {
         $comp_id = $this->input->post('company_id');
         $data['leadsource'] = $this->Leads_Model->get_leadsource_list_api($comp_id);
         $source=array();
         foreach($data['leadsource']  as $value){
           array_push($source,array('lsid'=>$value->lsid,'lead_name'=>$value->lead_name));
             
         }
          $this->set_response([
                'status' => TRUE,
                'source' => $source,
                 ], REST_Controller::HTTP_OK);
        
        }
        
        
         public function state_post()
                          {        
         $data['state_list'] = $this->location_model->state_list_api();
         $state=array();
         foreach($data['state_list']  as $value1){
            array_push($state,array('state_id'=>$value1->id,'state'=>$value1->state));
          }
         
          $this->set_response([
                'status' => TRUE,
                'state' => $state,
                 ], REST_Controller::HTTP_OK);
        
        }
    
    public function product_post(){ 
         $comp=$this->input->post('company_id');    
         $result = $this->enquiry_model->product_api($comp);
         $product=array();
         foreach($result  as $value1){
            array_push($product,array('product_name'=>$value1->country_name,'id'=>$value1->id));
          }
         
          
         if(!empty($product)){
          $this->set_response([
                'status' => TRUE,
                'product' => $product,
                 ], REST_Controller::HTTP_OK);
        
    } else{
  
     $this->set_response([
                'status' => false,
                'product' =>array(array('error'=>'Not found')) 
                 ], REST_Controller::HTTP_OK);
        }
    
        }
    public function process_post(){ 
             $userid=$this->input->post('user_id');   
         $data['process'] = $this->enquiry_model->product_list_api($userid);
         $process=array();
         foreach($data['process']  as $value1){
            array_push($process,array('process_name'=>$value1->product_name,'id'=>$value1->sb_id));
          }
         if(!empty($process)){
          $this->set_response([
                'status' => TRUE,
                'process' => $process,
                 ], REST_Controller::HTTP_OK);
        
    } else{
  
     $this->set_response([
                'status' => false,
                  'process' =>array(array('error'=>'Not found'))
                 ], REST_Controller::HTTP_OK);
        }
        }
        
         public function city_post()
                          {
                             $state_id= $this->input->post('state_id');
         $data['city_list'] = $this->location_model->get_city_byid($state_id);
         $city=array();
         foreach($data['city_list']  as $value1){
            array_push($city,array('id'=>$value1->id,'city'=>$value1->city));
         }
         
          $this->set_response([
                'status' => TRUE,
                'city' => $city,
                 ], REST_Controller::HTTP_OK);
        
        }
        
        
    
  
  
  
  
   public function get_enquery_code() {
        $code = $this->genret_code();
        $code2 = 'ENQ' . $code;
        $response = $this->enquiry_model->check_existance($code2);
        
        if ($response) {
            
            $this->get_enquery_code();
        } else {
            
            return $code2;
            
            //exit;
        }
        //exit;
    }
    function genret_code() {
        $pass = "";
        $chars = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        for ($i = 0; $i < 12; $i++) {
            $pass .= $chars[mt_rand(0, count($chars) - 1)];
        }
        return $pass;
    }
      
      
      
    public function view_post(){        

    define('FIRST_NAME',1);
    define('LAST_NAME',2);
    define('GENDER',3);
    define('MOBILE',4);
    define('EMAIL',5);
    define('COMPANY',6);
    define('LEAD_SOURCE',7);
    define('PRODUCT_FIELD',8);
    define('STATE_FIELD',9);
    define('CITY_FIELD',10);
    define('ADDRESS_FIELD',11);  
    $this->load->helper('common_helper');
      $enquiry_code= $this->input->post('enquiry_code');
    $data['title'] = display('information');    
    $data['drops'] = $this->Leads_Model->get_drop_list();
        $data['name_prefix'] = $this->enquiry_model->name_prefix_list();
    $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
    $result = $this->enquiry_model->enquiry_detail_for_api($enquiry_code);
      $res= array();
      if(!empty($result)){
          $res= array();
          $customer='';
          $channe = '';$male='';
          if($result->gender==1){
              $male='Male';
          }elseif($result->gender==2){
              $male='Female';
          }elseif($result->gender==3){
              $male='Other';
          }else{
          }
        $res = array();     
      $proc  = $result->product_id;
      $comp_id  = $result->enq_comp_id;
      if (is_active_field_api(COMPANY,$proc,$comp_id)) {
        $res['org_name']    = array(
                  'value' => $result->company,
                  'status' => true
                  );        
      }else{
        $res['org_name']    = array(
                    'value' => $result->company,
                    'status' => false
                  );
      }
      if (is_active_field_api(FIRST_NAME,$proc,$comp_id)) {
        $res['customer_name']   = array(
                        'value' => $result->name_prefix.' '.$result->name.' '.$result->lastname,
                        'status' => true
                      );        
      }else{
        $res['customer_name']   = array(
                        'value' => $result->name_prefix.' '.$result->name.' '.$result->lastname,
                        'status' => false
                      );        
      }
      if (is_active_field_api(EMAIL,$proc,$comp_id)) {
        $res['email']   =  array(
                    'value' => $result->email,
                    'status' => true
                  );
      }else{
        $res['email']   =  array(
                    'value' => $result->email,
                    'status' => false
                  );
      }
      if (is_active_field_api(MOBILE,$proc,$comp_id)) {
        $res['phone']   = array(
                  'value' => $result->phone,
                  'status' => true
                  );
      }else{
        $res['phone']   = array(
                  'value' => $result->phone,
                  'status' => false
                  );
      }
      
      if (is_active_field_api(LEAD_SOURCE,$proc,$comp_id)) {
        $res['source']    = array(
                    'value' => $result->enquiry_source_name,
                    'status' => true
                  );
      }else{
        $res['source']    = array(
                    'value' => $result->enquiry_source_name,
                    'status' => false
                  );
      }
      if (is_active_field_api(ADDRESS_FIELD,$proc,$comp_id)) {        
        $res['address']     = array(
                    'value' => $result->address,
                    'status' => true
                    );
      }else{
        $res['address']   = array(
                    'value' => $result->address,
                    'status' => false
                  );
      }
      if (is_active_field_api(GENDER,$proc,$comp_id)) {       
        $res['gender']     = array(
                    'value' => $male,
                    'status' => true
                    );
      }else{
        $res['gender']   = array(
                    'value' => $male,
                    'status' => false
                  );
      }
      if (is_active_field_api(STATE_FIELD,$proc,$comp_id)) {        
        $res['state']     = array(
                    'value' => $result->state,
                    'status' => true
                    );
      }else{
        $res['state']   = array(
                    'value' => $result->state,
                    'status' => false
                  );
      }
      if (is_active_field_api(CITY_FIELD,$proc,$comp_id)) {       
        $res['city']     = array(
                    'value' => $result->city,
                    'status' => true
                    );
      }else{
        $res['city']   = array(
                    'value' => $result->city,
                    'status' => false
                  );
      }
      if (is_active_field_api(PRODUCT_FIELD,$proc,$comp_id)) {        
        $res['product']     = array(
                    'value' => $result->pcountry_name,
                    'status' => true
                    );
      }else{
        $res['product']   = array(
                    'value' => $result->pcountry_name,
                    'status' => false
                  );
      }
      $res['process'] = array(
                  'value' => $result->product_name,
                  'status' => true
                );
      $res['created_by'] = array(
                  'value' => $result->created_by_name,
                  'status' => true
                );
      $res['assign_to'] = array(
                  'value' => $result->assign_to_name,
                  'status' => true
                );
      $res['remark'] = array(
                  'value' => $result->enquiry,
                  'status' => true
                );
      $res['created_on'] = array(
                  'value' => $result->created_date,
                  'status' => true
                );
      
      /*$res['created_by']        = $result->s_display_name.' '.$result->last_name;
      $res['assign_to']         = $result->assign_to_name;
      $res['created_on']        = $result->created_date;
      $res['requirement']       = $result->enquiry;*/
      
        /*array(
          'enquery_id'  =>  $result->enquiry_id,
          'enquery_code'  =>  $result->Enquery_id,
          'org_name'    =>  $result->company,
          'customer_name' =>  $result->name_prefix.' '.$result->name.' '.$result->lastname,
          'email'     =>  $result->email,
          'phone'     =>  $result->phone,
          'source'    =>  $result->enquiry_source_name,
          'created_by'  =>  $result->s_display_name.' '.$result->last_name,
          'Assign_to'   =>  $result->assign_to_name,
          'address'   =>  $result->address,
          'created_on'  =>  $result->created_date,
          'requirement' =>  $result->enquiry,
          'gender'    =>  $male,
          'state'     =>  $result->state,
          'city'      =>  $result->city,
          'process'   =>  $result->product_name,
          'product'   =>  $result->pcountry_name
        );*/
      $dynval = $this->enquiry_model->get_dyn_fld_api($result->enquiry_id); 
      if(!empty($dynval)){          
        foreach($dynval as $dind => $dval){           
          $ind = (!empty($dval['input_label'])) ? $dval['input_label'] : false;
          if(!empty($ind)) {              
            $res["fields"][] = array("label" => $dval['input_label'],
                        "value"  => (!empty($dval['fvalue'])) ?  $dval['fvalue'] :"",
                        "status" => $dval['status']
                        );
          }                   
        }         
      }else{
        $res["fields"] = array(); 
      }   
      }         
      $this->set_response([
                'status' => true,
                'enquiry' =>$res
                 ], REST_Controller::HTTP_OK);  
  } 
      
  //user list   
    public function user_list_post()
        { 
    $comp=$this->input->post('company_id');   
         $result = $this->enquiry_model->user_list_api($comp);
         $users=array();
         foreach($result  as $user2){
             array_push($users,array('id'=>$user2->pk_i_admin_id,'user_name'=>$user2->s_display_name.' '.$user2->last_name));
          }
         
          
         if(!empty($users)){
          $this->set_response([
                'status' => TRUE,
                'users' => $users,
                 ], REST_Controller::HTTP_OK);
        
    } else{
  
     $this->set_response([
                'status' => false,
                'users' =>array(array('error'=>'Not found')) 
                 ], REST_Controller::HTTP_OK);
        }
        
        }   
      
      
    public function assign_enquiry_post(){
      
      $this->form_validation->set_rules('login_id','Login ID' ,'required');
      $this->form_validation->set_rules('assign_user_id','Assign ID' ,'required');
      $this->form_validation->set_rules('enquiry_code[]','Enquery Code' ,'required');
        if($this->form_validation->run() == true){
          
          $move_enquiry = $this->input->post('enquiry_code[]');
          $enq_codes = explode("," ,$move_enquiry[0]);
          $assign_employee = $this->input->post('assign_user_id');
          
          $user =$this->User_model->read_by_id($assign_employee);
          
          $assigner_user_id  = $this->input->post('login_id');
          $assigner_user =$this->User_model->read_by_id($assigner_user_id);
          $assignee_phone = '91'.$user->s_phoneno;
          $assign_to_name = $user->s_display_name.' '.$user->last_name;
          $assign_by_name = $assigner_user->s_display_name.' '.$assigner_user->last_name;
          $assigner_phone = '91'.$assigner_user->s_phoneno;
          
          
          if(!empty($enq_codes)){
          
            foreach($enq_codes as $key){
             
              $data['enquiry'] = $this->enquiry_model->enquiry_by_code($key);
          
              $enquiry_code = $data['enquiry']->Enquery_id;
              //print_r($data['enquiry']);die;
              //if(empty($this->Leads_Model->get_leadListDetailsby_code($enquiry_code))){
          
                $this->enquiry_model->assign_enquery_api($key,$assign_employee,$enquiry_code,$assigner_user_id);
               // $customer_name = $data['enquiry']->name_prefix.''.$data['enquiry']->name.' '.$data['enquiry']->lastname.' ';
              //  $notification_msg = sprintf($this->lang->line('enquiry_assigned_to'),trim($customer_name),trim($assign_to_name),trim($assign_by_name));
               // $this->Message_models->sendwhatsapp($assignee_phone,$notification_msg);
              //  $this->Message_models->sendwhatsapp($assigner_phone,$notification_msg);
              //  $this->Leads_Model->add_comment_for_events_api($notification_msg,$enquiry_code,$assigner_user_id);
          
                //$this->Leads_Model->add_comment_for_events('Enquiry Assigned',$enquiry_code);
          
             // }
          
            }            
            $this->set_response([
              'status' => true,
              'message' => array(array('error'=>'Assigned successfully to Sales'))  
               ], REST_Controller::HTTP_OK);
          
          }else{
          
             $this->set_response([
              'status' => false,
              'message' => array(array('error'=>'No enquiry found to assign.'))  
               ], REST_Controller::HTTP_OK);
          
          }
        
        }else{
          $this->set_response([
          'status' => false,
          'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
           ], REST_Controller::HTTP_OK);
        }  
     
     }
      ////////////// Transfer Enquiry to Lead API ///////////////////////
  
      public function move_to_lead_post(){
        $this->form_validation->set_rules('expected_date','Expected Date');
        $this->form_validation->set_rules('conversion_probability','Conversion Probability','required');
        $this->form_validation->set_rules('comment','Comment','required');
        $this->form_validation->set_rules('enquiry_code[]','Enquery Code' ,'required');
        $this->form_validation->set_rules('user_id','User Id' ,'required');
        if($this->form_validation->run() == true){
            $move_enquiry=$this->input->post('enquiry_code[]');
            
            $date     = date('d-m-Y H:i:s');
                    
            $lead_score = $this->input->post('conversion_probability');
            $lead_stage = $this->input->post('lead_stage');
            $comment  = $this->input->post('comment');
//            $assign_to=$this->session->user_id;
            
            if(empty($lead_score)){
               $lead_score='';              
            }
            
             if(empty($lead_stage)){
               $lead_stage=''; 
            }
            if(empty($comment)){
               $comment=''; 
            }
            if(!empty($move_enquiry)){
              $assigner_user_id =  $this->input->post('user_id');
              $assigner_user  = $this->User_model->read_by_id($this->input->post('user_id'));          
              $convertor_phone  = '91'.$assigner_user->s_phoneno;
              
              foreach($move_enquiry as $key){
                
                $enq = $this->enquiry_model->enquiry_by_code($key);
                
               // if(empty($this->Leads_Model->get_leadListDetailsby_code($enq->Enquery_id))){
              
                  $data = array(
                          'adminid'     => $enq->created_by,
                          'ld_name'     => $enq->name,
                          'ld_email'    => $enq->email,
                          'ld_mobile'     => $enq->phone,
                          'lead_code'     => $enq->Enquery_id,
                          'city_id'     => $enq->city_id,
                          'state_id'    => $enq->state_id,
                          'country_id'    => $enq->country_id,
                          'region_id'     => $enq->region_id,
                          'territory_id'    => $enq->territory_id,
                          'ld_created'    => $date,
                          'ld_for'      => $enq->enquiry,
                          'lead_score'    => $lead_score,
                          'lead_stage'    => 1,
                          'comment'     => $comment,
                          'ld_status'     => '1'
                );
                
                $this->db->set('status',2);
                $this->db->where('Enquery_id',$key);
                $this->db->update('enquiry');
                
                $this->Leads_Model->add_comment_for_events_stage_api("Enquiry Moved",$enq->Enquery_id,'','','',$assigner_user_id);
                
                //$this->Leads_Model->('Enquiry Moved ',$enq->Enquery_id,'','','',$assigner_user_id);             
                 /*

              $created_by_user_id =   $enq->created_by;
              
              
              $phone_no =$this->User_model->read_by_id($created_by_user_id)->s_phoneno;
              
              $creator_phone = '91'.$phone_no;          
              
              $enq_of_name = $enq->name_prefix.''.$enq->name.' '.$enq->lastname;
              $notification_msg = sprintf($this->lang->line('enquiry_converted_to_lead'),trim($enq_of_name));
        
              $this->Message_models->sendwhatsapp($convertor_phone,$notification_msg);
              
              $this->Message_models->sendwhatsapp($creator_phone,$notification_msg);              
              
              $insert_id = $this->Leads_Model->LeadAdd($data);
                
             // }*/
              }
               $this->set_response([
              'status' => true,
              'message' => array(array('error'=>'Enquiry moved successfully to lead'))  
               ], REST_Controller::HTTP_OK);
          }
          else{
            $this->set_response([
              'status' => false,
              'message' => array(array('error'=>'No enquiry found to move.'))  
               ], REST_Controller::HTTP_OK);
          }
        }else{
          $this->set_response([
          'status' => false,
          'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
           ], REST_Controller::HTTP_OK);          
        }
      }
      
      //////// Drop Enquiry API /////////
    public function drop_enquiries_post(){  
     // $this->form_validation->set_rules('reason','Reason','required');
      $this->form_validation->set_rules('drop_status','Drop Status','required');
      $this->form_validation->set_rules('enquiry_code[]','Enquiry Code','required');
      $this->form_validation->set_rules('user_id',':Login ID','required');
      if( $this->form_validation->run() == true){
        $reason = $this->input->post('reason');
        $drop_status = $this->input->post('drop_status');
        $move_enquiry=$this->input->post('enquiry_code[]');
        $enq_codes = explode("," ,$move_enquiry[0]);
        $login_id=$this->input->post('user_id');
        if(!empty($enq_codes)){
          foreach($enq_codes as $key){
              $this->db->set('drop_status',$drop_status);
              $this->db->set('drop_reason',$reason);
              $this->db->set('update_date',date('Y-m-d H:i:s'));
              $this->db->where('Enquery_id',$key);
              $this->db->update('enquiry');
            $data['enquiry'] = $this->enquiry_model->enquiry_by_code($key);
            $enquiry_code = $data['enquiry']->Enquery_id;
            //print_r($enquiry_code);die;
            $this->Leads_Model->add_comment_for_events_api('Onboarding Dropped',$enquiry_code,$login_id);
          }
          $this->set_response([
              'status' => true,
              'message' => array(array('error'=>'Onboarding droped successfully'))  
               ], REST_Controller::HTTP_OK);
        }else{
          $this->set_response([
              'status' => false,
              'message' => array(array('error'=>'No Onboarding found to drop.'))  
               ], REST_Controller::HTTP_OK);
        }
      }else{
        $this->set_response([
          'status' => false,
          'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
           ], REST_Controller::HTTP_OK);          
      }
    }
    public function add_comment_post(){ 
      
      $this->form_validation->set_rules('user_id','User Id','required');
      $this->form_validation->set_rules('comment','Comment Message','required');
      $this->form_validation->set_rules('enquiry_code','Enquiry Code','required');  
      //$this->form_validation->set_rules('comment_type','Enquiry Code','required');  
      if($this->form_validation->run() == true){   
        $ld_updt_by = $this->input->post('user_id');
      
        $lead_id = $this->input->post('enquiry_code');
      
        $conversation = trim($this->input->post('comment'));        
      
        $coment_type = trim($this->input->post('comment_type'));
      
        $adt = date("d-m-Y H:i:s");        
      
        $msg = $conversation;        
        $this->db->set('lead_id',$lead_id); 
        $this->db->set('created_date',$adt); 
        $this->db->set('coment_type ',$coment_type); 
        $this->db->set('comment_msg',$conversation); 
        $this->db->set('created_by',$ld_updt_by); 
        $this->db->insert('tbl_comment');
        $this->set_response([
        'status' => true,
        'message' => array(array('error'=>'Comment added successfully'))  
        ], REST_Controller::HTTP_OK);
     }else{
        $this->set_response([
          'status' => false,
          'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
           ], REST_Controller::HTTP_OK);          
      }
    }
    public function drop_status_post(){
    $comp=$this->input->post('company_id'); 
        $drops = $this->enquiry_model->get_drop_list_api($comp);
        $this->set_response([
                    'status' => true,
                    'message' =>$drops
                     ], REST_Controller::HTTP_OK);
    }
    public function get_enquiry_fields_post(){
      //$process_id = $this->input->post('process_id');
      $companey_id = $this->input->post('company_id');      
      
    define('FIRST_NAME',1);
    define('LAST_NAME',2);
    define('GENDER',3);
    define('MOBILE',4);
    define('EMAIL',5);
    define('COMPANY',6);
    define('LEAD_SOURCE',7);
    define('PRODUCT_FIELD',8);
    define('STATE_FIELD',9);
    define('CITY_FIELD',10);
    define('ADDRESS_FIELD',11);  
    
    $comp_id  = $companey_id;
    $process_list = $this->sync_model->get_process_list($comp_id);
    $process_list = $process_list->result_array();
    $res = array();
    if (!empty($process_list)) {    
      foreach ($process_list as $key => $value) {
        $process_id = $value['sb_id'];
        $this->db->select("*");
        $this->db->from('enquiry_fileds_basic');
        $where = " FIND_IN_SET($process_id,process_id) AND comp_id = {$comp_id} AND status=1";
        $this->db->where($where);
        $field_list = $this->db->get()->result_array();
        $arr = array();
        $field_ids = array();
            if(!empty($field_list)){
                foreach($field_list as $field_list){
                    $field_ids[]  = $field_list['field_id'];
                }
           }
        if(in_array(FIRST_NAME,$field_ids)){$arr['first_name'] = true;}else{$arr['first_name'] = false;}
        if(in_array(LAST_NAME,$field_ids)){$arr['last_name'] = true;}else{$arr['last_name'] = false;}
        if(in_array(GENDER,$field_ids)){$arr['gender'] = true;}else{$arr['gender'] = false;}
        if(in_array(MOBILE,$field_ids)){$arr['mobile'] = true;}else{$arr['mobile'] = false;}
        if(in_array(EMAIL,$field_ids)){$arr['email'] = true;}else{$arr['email'] = false;}
        if(in_array(COMPANY,$field_ids)){$arr['company'] = true;}else{$arr['company'] = false;}
        if(in_array(LEAD_SOURCE,$field_ids)){$arr['lead_source'] = true;}else{$arr['lead_source'] = false;}
        if(in_array(PRODUCT_FIELD,$field_ids)){$arr['product'] = true;}else{$arr['product'] = false;}
        if(in_array(STATE_FIELD,$field_ids)){$arr['state'] = true;}else{$arr['state'] = false;}
        if(in_array(CITY_FIELD,$field_ids)){$arr['city'] = true;}else{$arr['city'] = false;}
        if(in_array(ADDRESS_FIELD,$field_ids)){$arr['address'] = true;}else{$arr['address'] = false;}
        $extra  = $this->get_enquiry_extra_fields($process_id,$companey_id);
        /*
        $arr1[] = $arr;
        $extra1[] = $extra;*/
        $res[] = array('process_id'=>$process_id,'fields'=>array('basic'=>$arr,'extra'=>$extra));
      }
    }
    $this->set_response([
                    'status' => true,
                    'data'=>$res
                     ], REST_Controller::HTTP_OK);
    }
  public function get_enquiry_fields_by_process_post()
  {
    // live app without local database single process field
      $process_id = $this->input->post('process_id');
    $companey_id = $this->input->post('company_id');
    
    //$process = implode(',',$process_id);
    $process = $process_id;
      
      
    define('FIRST_NAME',1);
    define('LAST_NAME',2);
    define('GENDER',3);
    define('MOBILE',4);
    define('EMAIL',5);
    define('COMPANY',6);
    define('LEAD_SOURCE',7);
    define('PRODUCT_FIELD',8);
    define('STATE_FIELD',9);
    define('CITY_FIELD',10);
    define('ADDRESS_FIELD',11);  
    
    $comp_id  = $companey_id;
    $this->db->select("*");
    $this->db->from('enquiry_fileds_basic');
    $where = " FIND_IN_SET('$process_id',process_id) AND comp_id = {$comp_id} AND status=1";
    $this->db->where($where);
    $field_list = $this->db->get()->result_array();
    $arr = array();
    $field_ids = array();
    if(!empty($field_list))
    {
      foreach($field_list as $field_list)
      {
                $field_ids[]  = $field_list['field_id'];
            }
        }
      
      //print_r($field_list);die;
    if(in_array(FIRST_NAME,$field_ids)){$arr['first_name'] = true;}else{$arr['first_name'] = false;}
    if(in_array(LAST_NAME,$field_ids)){$arr['last_name'] = true;}else{$arr['last_name'] = false;}
    if(in_array(GENDER,$field_ids)){$arr['gender'] = true;}else{$arr['gender'] = false;}
    if(in_array(MOBILE,$field_ids)){$arr['mobile'] = true;}else{$arr['mobile'] = false;}
    if(in_array(EMAIL,$field_ids)){$arr['email'] = true;}else{$arr['email'] = false;}
    if(in_array(COMPANY,$field_ids)){$arr['company'] = true;}else{$arr['company'] = false;}
    if(in_array(LEAD_SOURCE,$field_ids)){$arr['lead_source'] = true;}else{$arr['lead_source'] = false;}
    if(in_array(PRODUCT_FIELD,$field_ids)){$arr['product'] = true;}else{$arr['product'] = false;}
    if(in_array(STATE_FIELD,$field_ids)){$arr['state'] = true;}else{$arr['state'] = false;}
    if(in_array(CITY_FIELD,$field_ids)){$arr['city'] = true;}else{$arr['city'] = false;}
    if(in_array(ADDRESS_FIELD,$field_ids)){$arr['address'] = true;}else{$arr['address'] = false;}
    $extra  = $this->get_enquiry_extra_fields($process_id,$companey_id);
    $this->set_response([
                    'status' => true,
                    'basic' =>$arr,
                    'extra' =>$extra
                     ], REST_Controller::HTTP_OK);
    }
    public function get_enquiry_extra_fields($process_id,$companey_id){           
      $where = " FIND_IN_SET('".$process_id."',process_id) AND company_id = {$companey_id} AND status=1";
      $this->db->select("*");
      $this->db->from('tbl_input');
      $this->db->where($where);
      $this->db->order_by('input_id asc');
      return $this->db->get()->result_array();    
    } 
/* Syncing apis start */
public function sync_enquiry_data_post(){   
  $p = file_get_contents('php://input');      
  $sync = $this->input->post('sync');   
  $i = 0;
  $j = 0;
  $k = 0;
  $l = 0;
  if (!empty($p)) {   
    $p = json_decode($p,true);
    $basic  = $p['basic'];  
    $extra  = $p['extra'];
    if (!empty($basic)) {
      foreach ($basic as $key => $value) {
        $this->db->where('Enquery_id',$value['Enquery_id']);
        if($this->db->get('enquiry')->num_rows()){
          $this->db->where('Enquery_id',$value['Enquery_id']);
          $this->db->update('enquiry',$value);          
          $j++;
        }else{
          $this->db->insert('enquiry',$value);
          $i++;
        }       
      }
    }
    if (!empty($extra)) {
      foreach ($extra as $key => $value) {
        $this->db->where('enq_no',$value['enq_no']);
        $this->db->where('input',$value['input']);
        if($this->db->get('extra_enquery')->num_rows()){
          $this->db->where('enq_no',$value['enq_no']);
          $this->db->where('input',$value['input']);
          $this->db->update('extra_enquery',$value);          
          $k++;
        }else{
          $this->db->insert('extra_enquery',$value);
          $l++;
        }       
      }
    }
    if ($i || $j) {
      $this->set_response([
        'status' => true,
        'enquiry' =>'Created: '.$i.' Updated: '.$j
        ], REST_Controller::HTTP_OK);     
    }else{
      $this->set_response([
        'status' => False,
        'enquiry' =>'No enquiry synced'
        ], REST_Controller::HTTP_OK);     
    }
  }
}
  public function enquiry_data_list_post(){
      $res= array();
      $user_id= $this->input->post('user_id');
    if(!empty($user_id)){
      $user = $this->User_model->read_by_id($user_id); 
      if(!empty($user)){
        $result = $this->sync_model->all_enquiry($user_id);
        $res['basic'] = $result->result_array();
        $extra_result = $this->sync_model->all_enquiry_extra($user_id);
        $res['extra'] = $extra_result->result_array();
        
        $this->set_response([
          'status' => TRUE,
          'enquiry' =>$res
          ], REST_Controller::HTTP_OK);
      }else{    
        array_push($res,array('error'=>'user not exist'));
        $this->set_response([
        'status' => False,
        'enquiry' =>$res
        ], REST_Controller::HTTP_OK);
      }
    }else{
      $this->set_response([
            'status' => false,
            'enquiry' =>'not found'
             ], REST_Controller::HTTP_OK);
    }
  
  }
public function sync_lead_stage_post(){
  $comp_id = $this->input->post('comp_id');
    $res= array();  
  if(!empty($comp_id)){   
    $result = $this->sync_model->lead_stage($comp_id);
    $res['lead_stage'] = $result->result_array();     
    $result = $this->sync_model->lead_description($comp_id);
    $res['lead_description'] = $result->result_array();     
    $this->set_response([
      'status' => TRUE,
      'data' =>$res
      ], REST_Controller::HTTP_OK);   
  }else{
    $this->set_response([
          'status' => false,
          'data' =>'not found'
           ], REST_Controller::HTTP_OK);
  }
}
public function sync_lead_source_post(){
  $comp_id = $this->input->post('comp_id');
    $res= array();  
  if(!empty($comp_id)){   
    $result = $this->sync_model->lead_source($comp_id);
    $res['lead_source'] = $result->result_array();      
    $result = $this->sync_model->lead_sub_source($comp_id);
    $res['lead_subsource'] = $result->result_array();     
    $this->set_response([
      'status' => TRUE,
      'data' =>$res
      ], REST_Controller::HTTP_OK);   
  }else{
    $this->set_response([
          'status' => false,
          'data' =>'not found'
           ], REST_Controller::HTTP_OK);
  }
}
public function sync_product_post(){
  $comp_id = $this->input->post('comp_id');
    $res= array();  
  if(!empty($comp_id)){   
    $result = $this->sync_model->products($comp_id);
    $res['products'] = $result->result_array();         
    $this->set_response([
      'status' => TRUE,
      'data' =>$res
      ], REST_Controller::HTTP_OK);   
  }else{
    $this->set_response([
          'status' => false,
          'data' =>'not found'
           ], REST_Controller::HTTP_OK);
  }
}
public function sync_country_post(){
  $comp_id = $this->input->post('comp_id');
    $res= array();  
  if(!empty($comp_id)){   
    $result = $this->sync_model->country($comp_id);
    $res['country'] = $result->result_array();          
    $this->set_response([
      'status' => TRUE,
      'data' =>$res
      ], REST_Controller::HTTP_OK);   
  }else{
    $this->set_response([
          'status' => false,
          'data' =>'not found'
           ], REST_Controller::HTTP_OK);
  }
}
public function sync_state_post(){
  $comp_id = $this->input->post('comp_id');
    $res= array();  
  if(!empty($comp_id)){   
    $result = $this->sync_model->state($comp_id);
    $res = $result->result_array();         
    $this->set_response([
      'status' => TRUE,
      'state' =>$res
      ], REST_Controller::HTTP_OK);   
  }else{
    $this->set_response([
          'status' => false,
          'state' =>'not found'
           ], REST_Controller::HTTP_OK);
  }
}
public function sync_city_post(){
  $comp_id = $this->input->post('comp_id');
    $res= array();  
  if(!empty($comp_id)){   
    $result = $this->sync_model->city($comp_id);
    $res = $result->result_array();         
    $this->set_response([
      'status' => TRUE,
      'city' =>$res
      ], REST_Controller::HTTP_OK);   
  }else{
    $this->set_response([
          'status' => false,
          'city' =>'not found'
           ], REST_Controller::HTTP_OK);
  }
}
public function sync_task_post(){
  $comp_id = $this->input->post('comp_id');
    $res= array();  
  if(!empty($comp_id)){   
    $result = $this->sync_model->city($comp_id);
    $res = $result->result_array();         
    $this->set_response([
      'status' => TRUE,
      'city' =>$res
      ], REST_Controller::HTTP_OK);   
  }else{
    $this->set_response([
          'status' => false,
          'city' =>'not found'
           ], REST_Controller::HTTP_OK);
  }
}
public function sync_comment_post(){
  $comp_id = $this->input->post('comp_id');
    $res= array();  
  if(!empty($comp_id)){   
    $this->db->where('comp_id',$comp_id);
    $result = $this->db->get('tbl_comment');    
    $res = $result->result_array();         
    $this->set_response([
      'status' => TRUE,
      'data' =>$res
      ], REST_Controller::HTTP_OK);   
  }else{
    $this->set_response([
          'status' => false,
          'data' =>'not found'
           ], REST_Controller::HTTP_OK);
  }
}
public function sync_tbl_input_post(){
  $comp_id = $this->input->post('comp_id');
    $res= array();  
  if(!empty($comp_id)){   
    $this->db->where('company_id',$comp_id);
    $result = $this->db->get('tbl_input');    
    $res = $result->result_array();         
    $this->set_response([
      'status' => TRUE,
      'data' =>$res
      ], REST_Controller::HTTP_OK);   
  }else{
    $this->set_response([
          'status' => false,
          'data' =>'not found'
           ], REST_Controller::HTTP_OK);
  }
}
/* Syncing apis end */
public function get_enq_list_post(){
  $dfields = $this->sync_model->getformfield();                   
  $dacolarr = array();
  $compid = $this->input->post('comp_id');
   $fieldval =  $this->sync_model->getfieldvalue($enqnos,$compid);  
  if(!empty($compid)){
      $arr_basic = $arr_dyn = array();
    $res = $this->sync_model->get_enquiry_list($compid);
      foreach ($res as $key => $value) {
          $arr_basic = array('nameprefix'=>$value->name_prefix,'firstname'=>$value->name,'lastname'=>$value->lastname,'phone'=>$value->phone,'address'=>$value->address,'process'=>$value->product_name,'lead_stage'=>$value->lead_stage_name,'lead_description'=>$value->lead_discription,'reference_name'=>$value->reference_name,'created_date'=>$value->created_date,'created_by'=>$value->created_by_name,'assign_to'=>$value->assign_to_name,'datasource_name'=>$value->datasource_name,'country_name'=>$value->country_name,'bank_name'=>$value->bank_name);
              $enqid = $value->enquiry_id;      
        if(!empty($dacolarr) and !empty($dfields)){
          foreach($dfields as $ind => $flds){         
            if(in_array($flds->input_id, $dacolarr )){            
              $arr_dyn = $fieldval[$enqid][$flds->input_id]->fvalue;  
            }         
          }       
        }
        
      }
      $this->set_response([
        'status' => TRUE,
        'basic' =>$arr_basic,
        'dyn'   =>$arr_dyn,
        ], REST_Controller::HTTP_OK); 
    }
  }

  /*space international contact form data into crm*/
  public function space_international_contact_form_post(){    
    $curl = curl_init();
    
    $fname = $this->input->post('name');
    $mobile = $this->input->post('mobile_no_1589146856501');
    $email = $this->input->post('email');
    $city = $this->input->post('city_1589147378529');
    $visa_type = $this->input->post('visa_type_1589147351535');
    $country = $this->input->post('country_you_wish_to_apply_for_1589147152924');
    $message = $this->input->post('message');

    $city = $city.' '.$country;

    if ($visa_type == 'study-visa') {
      $process_id = 146;
    }else if ($visa_type == 'tourist-visa') {
      $process_id = 147;
    }else if ($visa_type == 'spouse-visa') {
      $process_id = 148;
    }else if ($visa_type == 'schooling-visa') {
      $process_id = 149;
    }

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://thecrm360.com/new_crm/api/enquiry/create",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => array('fname' => $fname,'email' => $email,'mobileno' => $mobile,'company_id' => '67','enquiry' => $message,'process_id' => $process_id,'user_id' => '295','address'=>$city),
      CURLOPT_HTTPHEADER => array(
        "Cookie: ci_session=3ba7d4lq4alv2pgpq3sc8t2ojrh41s04"
      ),
    ));
    $response = curl_exec($curl);   
    curl_close($curl);
  }

  /*CAREERex contact form data */
  public function career_ex_contact_form_post(){
    
    $course   = $this->input->post('course'); 
    $this->load->model('product_model');        
    $product_row  = $this->product_model->get_product_id_by_name(trim($course));
    $product_id = '';
    if (!empty($product_row['id'])) {
      $product_id = $product_row['id'];
    }
    $full_name  = $this->input->post('full_name');  
    $join_date  = $this->input->post('join_date');  
    $email    = $this->input->post('email');  
    $mobile   = $this->input->post('mobile'); 
    $address  = $this->input->post('address');  

    $name = explode(' ', $full_name);
    $fname  = !empty($name[0])?$name[0]:'';
    $last_name  = !empty($name[1])?$name[1]:'';
    $this->form_validation->set_rules('email','Email','required');
    $this->form_validation->set_rules('mobile','Mobile','required');
    
    if ($this->form_validation->run() == true) {  
      $curl = curl_init();
      curl_setopt_array($curl, array(
          CURLOPT_URL => "https://thecrm360.com/new_crm/api/enquiry/create",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array('fname' => $fname,'lastname' => $last_name,'email' => $email,'mobileno' => $mobile,'company_id' => '81','process_id' => 175,'product_id' => $product_id,'enquiry_source'=>244,'enquiry'=>'','user_id' => '511','address'=>$address,'4023'=>$join_date),
          CURLOPT_HTTPHEADER => array(
            "Cookie: ci_session=3ba7d4lq4alv2pgpq3sc8t2ojrh41s04"
          ),
      ));
      $response = curl_exec($curl);   
      curl_close($curl);  
      $msg = 'Successfully Saved';
      $status = true;
    }else{
      $str = strip_tags(validation_errors());
      $msg = str_replace("\n","",$str);
      $status = false;
    }
    $this->set_response([
        'status' => $status,
        'message' =>$msg
        ], REST_Controller::HTTP_OK); 
  }
  public function add_experience_post(){ 
      
    
    $this->form_validation->set_rules('enquiry_id','Enquiry ID','required');  
    //$this->form_validation->set_rules('comment_type','Enquiry Code','required'); 
    $upd =$this->input->post('update');
    $enq_id1 =  $this->input->post('enquiry_id');
    if($this->form_validation->run() == true){ 

      $total_experience = $this->input->post('total_experience');
      $relevant_experience = $this->input->post('relevant_experience');
      $tax_payer = $this->input->post('tax_payer');
      $whole_eperience = $this->input->post('whole_eperience');
      $return_filed = $this->input->post('return_filed');
      $professional_tax = $this->input->post('professional_tax');
      $insurance_benefit = $this->input->post('insurance_benefit');
      $any_contribution = $this->input->post('any_contribution');
      $payment_mode = $this->input->post('payment_mode');
      $ex_remark = $this->input->post('ex_remark');
$user_id = $this->input->post('user_id');
$comp_id = $this->input->post('company_id');

//print_r($upd);die;


if(!empty($upd))
{		
  foreach($family_name as $key=>$value){  

    $data = array(
      'comp_id'   => $comp_id,
      'enquiry_id'   => $enq_id,
      'e_member_name'   => $person_name,
      'total_experience'   => $total_experience[$key],
      'relevant_experience'   => $relevant_experience[$key],
      'tax_payer' => $tax_payer[$key],
      'whole_eperience'   => $whole_eperience[$key],
      'return_filed'   => $return_filed[$key],
      'professional_tax'   => $professional_tax[$key],
      'insurance_benefit'   => $insurance_benefit[$key],
      'any_contribution'   => $any_contribution[$key],
      'payment_mode'   => $payment_mode[$key],
      'ex_remark'   => $ex_remark[$key],
      'created_by' => $user_id
    );
  //print_r($postData);die;														
  $this->db->where('id',$this->input->post('update'));
  $insert_id = $this->db->update('tbl_experience_details',$data);
  }
  $msg	=	'Experience successfully updated';
//print_r($data);die;
}else{
  foreach($family_name as $key=>$value){ 

    $data = array(
      'comp_id'   => $comp_id,
      'enquiry_id'   => $enq_id,
      'e_member_name'   => $person_name,
      'total_experience'   => $total_experience[$key],
      'relevant_experience'   => $relevant_experience[$key],
      'tax_payer' => $tax_payer[$key],
      'whole_eperience'   => $whole_eperience[$key],
      'return_filed'   => $return_filed[$key],
      'professional_tax'   => $professional_tax[$key],
      'insurance_benefit'   => $insurance_benefit[$key],
      'any_contribution'   => $any_contribution[$key],
      'payment_mode'   => $payment_mode[$key],
      'ex_remark'   => $ex_remark[$key],
      'created_by' => $user_id
    );
  
  $insert_id = $this->Leads_Model->exp_all_add($data);
}
$msg	=	'Experience added successfully';
}
 
//print_r($data);die;	
      $this->set_response([
      'status' => true,
      'message' =>  $msg  
      ], REST_Controller::HTTP_OK);
   }else{
      $this->set_response([
        'status' => false,
        'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
         ], REST_Controller::HTTP_OK);          
    }
  }
  public function experience_list_post(){
    $user_id = $this->input->post('user_id');
    $enq_id = $this->input->post('enquiry_id');
    $enquiry_id = $this->Leads_Model->get_leadListDetailsby_id($enq_id);
    $this->db->where('enquiry_id',$enquiry_id->Enquery_id);
    $res = $this->db->get('tbl_experience_details')->result_array();
    if(!empty($res)){
      $this->set_response([
        'status' => TRUE,
        'enquiry' =>$res
         ], REST_Controller::HTTP_OK);
    }else{
      $this->set_response([
        'status' => false,
        'enquiry' =>$res
         ], REST_Controller::HTTP_OK);
    }
  }
  function delete_experience_post()
  {
     
      $family_id = $this->input->post('experience_id');
        $this->db->where(array('id'=>$family_id))->delete('tbl_experience_details');
        
          $res =$this->db->affected_rows(); 
          if($res)
          {
            //$this->Leads_Model->add_comment_for_events($tabname." Deleted ", $enquiry_code);
            $this->set_response([
            'status'      => TRUE,           
            'msg'  => 'success',
            ], REST_Controller::HTTP_OK);   
          }
          else
          {
            $this->set_response([
            'status'  => false,           
            'msg'     => "Unable to delete",
            ], REST_Controller::HTTP_OK); 
          }
      
  }
  
  public function add_job_details_post(){ 
      
    
    $this->form_validation->set_rules('enquiry_id','Enquiry ID','required');  
    //$this->form_validation->set_rules('comment_type','Enquiry Code','required'); 
    $upd =$this->input->post('update');
    $enq_id1 =  $this->input->post('enquiry_id');
    if($this->form_validation->run() == true){ 

 $from = $this->input->post('from');
            $to = $this->input->post('to');
            $still_work = $this->input->post('still_work');
            $designation = $this->input->post('designation');
            $company = $this->input->post('company');
            $duration = $this->input->post('duration');
            $jy_duration = $this->input->post('yduration');
            $jm_duration = $this->input->post('mduration');
            $relevant = $this->input->post('relevant');
            $j_remark = $this->input->post('j_remark');
$user_id = $this->input->post('user_id');
$comp_id = $this->input->post('company_id');

//print_r($upd);die;


if(!empty($upd))
           
{		
  foreach($family_name as $key=>$value){  

    $data = array(
      'comp_id'   => $comp_id,
      'enquiry_id'   => $enq_id,
      'j_member_name'   => $person_name,
      'j_from'   => $value,
      'j_to' => $to[$key],
      'still_work' => $still_work[$key],
      'j_designation'   => $designation[$key],
      'j_company'   => $company[$key],
      'j_duration'   => $duration[$key],
      'jy_duration'   => $jy_duration[$key],
      'jm_duration'   => $jm_duration[$key],
      'j_relevant'   => $relevant[$key],
      'j_remark'   => $j_remark[$key],
                    'created_by' => $user_id
    );
  //print_r($postData);die;														
  $this->db->where('id',$this->input->post('update'));
  $insert_id = $this->db->update('tbl_job_details',$data);
  }
  $msg	=	'Job Details successfully updated';
//print_r($data);die;
}else{
  foreach($family_name as $key=>$value){  

    $data = array(
      'comp_id'   => $comp_id,
      'enquiry_id'   => $enq_id,
      'j_member_name'   => $person_name,
      'j_from'   => $value,
      'j_to' => $to[$key],
      'still_work' => $still_work[$key],
      'j_designation'   => $designation[$key],
      'j_company'   => $company[$key],
      'j_duration'   => $duration[$key],
      'jy_duration'   => $jy_duration[$key],
      'jm_duration'   => $jm_duration[$key],
      'j_relevant'   => $relevant[$key],
      'j_remark'   => $j_remark[$key],
                    'created_by' => $user_id
    );
  //print_r($postData);die;														
  $insert_id = $this->Leads_Model->job_all_add($data);
  }
  $msg	=	'Job Details added successfully';
}
 
//}
//print_r($data);die;	
      $this->set_response([
      'status' => true,
      'message' =>  $msg  
      ], REST_Controller::HTTP_OK);
   }else{
      $this->set_response([
        'status' => false,
        'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
         ], REST_Controller::HTTP_OK);          
    }
  } 
  public function job_detail_list_post(){
    $user_id = $this->input->post('user_id');
    $enq_id = $this->input->post('enquiry_id');
    $enquiry_id = $this->Leads_Model->get_leadListDetailsby_id($enq_id);
    $this->db->where('enquiry_id',$enquiry_id->Enquery_id);
    $res = $this->db->get('tbl_job_details')->result_array();
    if(!empty($res)){
      $this->set_response([
        'status' => TRUE,
        'enquiry' =>$res
         ], REST_Controller::HTTP_OK);
    }else{
      $this->set_response([
        'status' => false,
        'enquiry' =>$res
         ], REST_Controller::HTTP_OK);
    }
  }
  function delete_job_detail_post()
  {
     
      $family_id = $this->input->post('job_id');
        $this->db->where(array('id'=>$family_id))->delete('tbl_job_details');
        
          $res =$this->db->affected_rows(); 
          if($res)
          {
            //$this->Leads_Model->add_comment_for_events($tabname." Deleted ", $enquiry_code);
            $this->set_response([
            'status'      => TRUE,           
            'msg'  => 'success',
            ], REST_Controller::HTTP_OK);   
          }
          else
          {
            $this->set_response([
            'status'  => false,           
            'msg'     => "Unable to delete",
            ], REST_Controller::HTTP_OK); 
          }
      
  }

  public function add_family_member_post(){ 
      
    
    $this->form_validation->set_rules('enquiry_id','Enquiry ID','required');  
    //$this->form_validation->set_rules('comment_type','Enquiry Code','required'); 
    $upd =$this->input->post('update');
    $enq_id1 =  $this->input->post('enquiry_id');
    if($this->form_validation->run() == true){   
      $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
      $this->db->from('enquiry');
      $this->db->where('enquiry_id',$enq_id1);
      $q= $this->db->get()->row();
$enq_id=$q->Enquery_id;
$aasign_to_id=$q->aasign_to;
$all_assign=$q->all_assign;

// $this->db->select('pk_i_admin_id');
//       $this->db->from('tbl_admin');
//       $this->db->where('s_user_email',$q->email);
//       $this->db->where('s_phoneno',$q->phone);
//       $stuid= $this->db->get()->row();
// $id_for_bell_noti=$stuid->pk_i_admin_id;

$family_name = $this->input->post('family_name');
$family_relation = $this->input->post('family_relation');
$family_mobile = $this->input->post('family_mobile');
$family_email = $this->input->post('family_email');
$family_age = $this->input->post('family_age');
$family_remark = $this->input->post('f_remark');
$user_id = $this->input->post('user_id');
$comp_id = $this->input->post('company_id');

//print_r($upd);die;


if(!empty($upd))
           
{		
  foreach($family_name as $key=>$value){  

    $data = array(
      'comp_id'   => $comp_id,
      'enquiry_id'   => $enq_id,
                'f_member_name'   => $value,
                'f_relation'   => $family_relation[$key],
                'f_mobile' => $family_mobile[$key],
                'f_email'   => $family_email[$key],
                'f_age'   => $family_age[$key],
                'f_remark'   => $family_remark[$key],
      'created_by' => $user_id
    );
  //print_r($postData);die;														
  $this->db->where('id',$this->input->post('update'));
  $insert_id = $this->db->update('tbl_family',$data);
  }
  $msg	=	'Family Member successfully updated';
//print_r($data);die;
}else{
  foreach($family_name as $key=>$value){  

    $data = array(
      'comp_id'   => $comp_id,
      'enquiry_id'   => $enq_id,
      'f_member_name'   => $value,
      'f_relation'   => $family_relation[$key],
      'f_mobile' => $family_mobile[$key],
      'f_email'   => $family_email[$key],
      'f_age'   => $family_age[$key],
      'f_remark'   => $family_remark[$key],
      'created_by' => $user_id
    );
    $comment_id = $this->Leads_Model->add_comment_for_events('Family details has been created', $enq_id);
  //print_r($postData);die;														
  $insert_id = $this->Leads_Model->family_all_add($data);
  }
  $msg	=	'Family Member added successfully';
}
 
//}
//print_r($data);die;	
      $this->set_response([
      'status' => true,
      'message' =>  $msg  
      ], REST_Controller::HTTP_OK);
   }else{
      $this->set_response([
        'status' => false,
        'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
         ], REST_Controller::HTTP_OK);          
    }
  }
  public function family_member_list_post(){
    $user_id = $this->input->post('user_id');
    $enq_id = $this->input->post('enquiry_id');
    $enquiry_id = $this->Leads_Model->get_leadListDetailsby_id($enq_id);
    $this->db->where('enquiry_id',$enquiry_id->Enquery_id);
    $res = $this->db->get('tbl_family')->result_array();
    if(!empty($res)){
      $this->set_response([
        'status' => TRUE,
        'enquiry' =>$res
         ], REST_Controller::HTTP_OK);
    }else{
      $this->set_response([
        'status' => false,
        'enquiry' =>$res
         ], REST_Controller::HTTP_OK);
    }
  }
  function delete_family_member_post()
  {
     
      $family_id = $this->input->post('member_id');
        $this->db->where(array('id'=>$family_id))->delete('tbl_family');
        
          $res =$this->db->affected_rows(); 
          if($res)
          {
            //$this->Leads_Model->add_comment_for_events($tabname." Deleted ", $enquiry_code);
            $this->set_response([
            'status'      => TRUE,           
            'msg'  => 'success',
            ], REST_Controller::HTTP_OK);   
          }
          else
          {
            $this->set_response([
            'status'  => false,           
            'msg'     => "Unable to delete",
            ], REST_Controller::HTTP_OK); 
          }
      
  }
  public function getEnquiryTabs_post()
  {      
  	$this->load->model('Enquiry_model');
    $company_id   = $this->input->post('company_id');
    $enquiry_id      = $this->input->post('enquiry_id');
    $this->form_validation->set_rules('company_id','company_id','trim|required',array('required'=>'You have note provided %s'));
    $this->form_validation->set_rules('enquiry_id','enquiry_id','trim|required',array('required'=>'You have note provided %s'));
    if($this->form_validation->run() == true)
    {
      $data  = $this->Enquiry_model->enquiry_all_tab_api($company_id,$enquiry_id);
     // echo $this->db->last_query();die;
      if(!empty($data))
      {
        $this->set_response([
        'status'      => TRUE,           
        'data'  => $data,
        ], REST_Controller::HTTP_OK);   
      }
      else
      {
        $this->set_response([
        'status'  => false,           
        'msg'     => "No Data Updated"
        ], REST_Controller::HTTP_OK); 
      }
    }
    else
    {
      $msg = strip_tags(validation_errors());
      $this->set_response([
        'status'  => false,
        'msg'     => $msg,//"Please provide a company id"
      ],REST_Controller::HTTP_OK);
    } 
  }

  // Created sandeep sahu
  public function qualification_list_post()
  {
    $enq_no = $this->input->post('enquiry_id');
    $user_id = $this->input->post('user_id');
    $this->form_validation->set_rules('enquiry_id','Enquiry ID','required');
    $this->form_validation->set_rules('user_id','User ID','required');
    if ($this->form_validation->run() == true) 
    {
      $this->db->select('Enquery_id,comp_id,name,lastname,aasign_to,phone,email,all_assign');
      $this->db->from('enquiry');
      $this->db->where('enquiry_id',$enq_no);
      $q = $this->db->get()->row();
      if(!empty($q))
      {
        $enq_id=$q->Enquery_id;
        $this->db->where('enquiry_id',$enq_id);
        $res = $this->db->get('tbl_education')->result_array();
       if(!empty($res))
       {
        $this->set_response([
          'status' => true,
          'data' => $res
          ], REST_Controller::HTTP_OK); 
       }
       else
       {
        $this->set_response([
          'status' => false,
          'message' => 'Not found'
          ], REST_Controller::HTTP_OK); 
       }
        
      }
      else
      {
        $msg = 'Invalid Enquiry ID';
        $status = false;
        $this->set_response([
          'status' => $status,
          'message' =>$msg
          ], REST_Controller::HTTP_OK); 
      }
    }
    else
    {
      $str = strip_tags(validation_errors());
      $msg = str_replace("\n","",$str);
      $status = false;
      $this->set_response([
        'status' => $status,
        'message' =>$msg
        ], REST_Controller::HTTP_OK); 
      
    }
    
  }

  public function qualification_post()
  {
    $enq_no = $this->input->post('enquiry_id');
    $comp_id = $this->input->post('company_id');
    $user_id = $this->input->post('user_id');
    $e_member_id = $this->input->post('e_member_id');
    $this->form_validation->set_rules('enquiry_id','Enquiry ID','required');
    $this->form_validation->set_rules('company_id','Company ID','required');
    $this->form_validation->set_rules('user_id','User ID','required');
    if ($this->form_validation->run() == true) 
    {
      $this->db->select('Enquery_id,comp_id,name,lastname,aasign_to,phone,email,all_assign');
      $this->db->from('enquiry');
      $this->db->where('enquiry_id',$enq_no);
      $q = $this->db->get()->row();
      if(!empty($q))
      {
        
        $enq_id=$q->Enquery_id;
        $comp_id = $q->comp_id;
        $aasign_to_id=$q->aasign_to;
        $all_assign=$q->all_assign;
        $edu_person = $this->input->post('edu_person');
        if(empty($edu_person) || $edu_person=='self')
        {
          $person_name = $q->name.' '.$q->lastname;
        }
        else
        {
          $person_name = $this->input->post('edu_person');   
        }
        $e_qualification = $this->input->post('e_qualification');
        $e_from = $this->input->post('e_from');
        $e_to = $this->input->post('e_to');
        $e_crsname = $this->input->post('e_crsname');
        $e_uniname = $this->input->post('e_uniname');
        $e_institutename = $this->input->post('e_institutename');
        $e_yearawarded = $this->input->post('e_yearawarded');
        $e_remark = $this->input->post('e_remark');
        if(!empty($e_member_id))
        {
          if(!empty($e_qualification))
          {
            foreach($e_qualification as $key=>$value)
            {
              $data = array(
                'comp_id'   => $comp_id,
                'enquiry_id'   => $enq_id,
                'e_member_name'   => $person_name,
                'e_qualification'   => $value,
                'e_from' => $e_from[$key],
                'e_to'   => $e_to[$key],
                'e_crsname'   => $e_crsname[$key],
                'e_uniname'   => $e_uniname[$key],
                'e_institutename'   => $e_institutename[$key],
                'e_yearawarded'   => $e_yearawarded[$key],
                'e_remark'   => $e_remark[$key],
                'created_by' => $user_id
              );
             $update = $this->db->set($data)->where('id' , $e_member_id)->update('tbl_education');
            }
            $comment_id = $this->Leads_Model->add_comment_for_events('Education details has been Updated', $enq_id);
            $msg = 'Education Updated';
            $status = true;
          } 
        }
        else
        {
          if(!empty($e_qualification))
          {
            foreach($e_qualification as $key=>$value)
            {
              $data = array(
                'comp_id'   => $comp_id,
                'enquiry_id'   => $enq_id,
                'e_member_name'   => $person_name,
                'e_qualification'   => $value,
                'e_from' => $e_from[$key],
                'e_to'   => $e_to[$key],
                'e_crsname'   => $e_crsname[$key],
                'e_uniname'   => $e_uniname[$key],
                'e_institutename'   => $e_institutename[$key],
                'e_yearawarded'   => $e_yearawarded[$key],
                'e_remark'   => $e_remark[$key],
                'created_by' => $user_id
              );
             $insert = $this->db->insert('tbl_education' ,$data);
            }
            $comment_id = $this->Leads_Model->add_comment_for_events('Education details has been created', $enq_id);
            $msg = 'Education Added';
            $status = true;
          }
        }
      }
      else
      {
        $msg = 'Invalid Enquiry ID';
        $status = false;
      }
    }
    else
    {
      $str = strip_tags(validation_errors());
      $msg = str_replace("\n","",$str);
      $status = false;
    }
    $this->set_response([
      'status' => $status,
      'message' =>$msg
      ], REST_Controller::HTTP_OK); 
    
  }

  public function delete_qualification_post()
  {
    $e_member_id = $this->input->post('e_member_id');
    $this->form_validation->set_rules('e_member_id','Education ID','required');
    if ($this->form_validation->run() == true) 
    {
        $query = $this->db->where('id' , $e_member_id)->get('tbl_education')->row();
        if(!empty($query))
        {
          $enq_id = $query->enquiry_id;
          $this->db->where('id' , $e_member_id)->delete('tbl_education');
          $msg = "Education Deleted";
          $comment_id = $this->Leads_Model->add_comment_for_events('Education details has been deleted', $enq_id);
          $status = false;
        }
        else
        {
          $msg = 'Invalid Education ID';
          $status = false;
        }
    }
    else
    {
      $str = strip_tags(validation_errors());
      $msg = str_replace("\n","",$str);
      $status = false;
    }
    $this->set_response([
      'status' => $status,
      'message' =>$msg
      ], REST_Controller::HTTP_OK); 
  }

//  end by sandeep
        // old code 05-11-2022 start
    // public function active_enquiry_post()
    // {
    //         $user_id= $this->input->post('user_id');
    //   $process_id= $this->input->post('process_id');
    //   if (strpos(',',$process_id) !== false) 
    //   {
    //     $process = implode(',',$process_id);
    //   }
    //   else
    //   {
    //     $process = $process_id;
    //   }
    //   //echo $process;die;
    //   //print_r($process_id);die;
    //         $res= array();
    //   if(!empty($user_id))
    //   {
    //     $user_role1 = $this->User_model->read_by_id($user_id); 
    //     if(!empty($user_role1))
    //     {
    //               $user_role=$user_role1->user_roles;
    //             $data['active_enquiry'] = $this->enquiry_model->active_enqueries_api($user_id,1,$user_role,$process);
    
    //         if(!empty($data['active_enquiry']->result()))
    //       {
    //         $res= array();
    //         foreach($data['active_enquiry']->result() as $value)
    //         {
    //           $customer='';
    //           array_push($res,array('enquery_id'=>$value->enquiry_id,'enquery_code'=>$value->Enquery_id,'org_name'=>$value->company,'customer_name'=>$value->name_prefix.' '.$value->name.' '.$value->lastname,'email'=>$value->email,'phone'=>$value->phone,'state'=>'','source'=>'test','type'=>$customer));  
    //         } 
    //       }
               
    //       if(empty($res))
    //       {
    //         array_push($res,array('error'=>'enquiry not find'));
    //       }
    //     }
    //     else
    //     {
    //       array_push($res,array('error'=>'user not exist'));
    //     }
         
    //           $this->set_response([
    //             'status' => TRUE,
    //             'enquiry' =>$res
    //              ], REST_Controller::HTTP_OK);
        
    //   }
    //   else
    //   {
    
    //     $this->set_response([
    //       'status' => false,
    //       'enquiry' =>'not found'
    //       ], REST_Controller::HTTP_OK);
    //   }
    //     }

    // old code 05-11-2022 end
    public function active_enquiry_post()
    {
      $user_id= $this->input->post('user_id');
      $process_id= $this->input->post('process_id');
      $filter= $this->input->post('drop_status');
      $offset = $this->input->post('offset')??0;
      $limit = $this->input->post('limit')??10;
      if(is_array($process_id)){
        $process = implode(',',$process_id);
      }
      else
      {
        $process = $process_id;
      }
      if(!empty($user_id))
      {
        $user_role1 = $this->User_model->read_by_id($user_id); 
        if(!empty($user_role1))
        {
          $user_role=$user_role1->user_roles;
          $total = $this->enquiry_model->active_enqueries_api($user_id,1,$user_role,$process,$filter)->num_rows();
          $data['active_enquiry'] = $this->enquiry_model->active_enqueries_api($user_id,1,$user_role,$process,$filter,$offset,$limit);   
          if(!empty($data['active_enquiry']->result()))
          {
            $res= array();
            
            $res['offset'] = $offset;
            $res['limit'] = $limit;
            $res['total'] = $total;
            $res['list'] = array();
            foreach($data['active_enquiry']->result() as $value)
            {
              $customer='';
              $tags_row = array();
              if(!empty($value->tag_ids)){
                $this->db->select('title,color,id');
                $tags_ids = '';
                if($value->tag_ids){
                  $tags_ids = trim($value->tag_ids,",");
                }
                if($tags_ids){
                  $this->db->where("id IN(".$tags_ids.")");
                }
                $tags = $this->db->get('tags')->result_array();
                if(!empty($tags)){
                  foreach ($tags as $k => $v) {
                    $tags_row[] = array('color'=>$v['color'],'name'=>$v['title'],'id'=>$v['id']);
                  }
                }
              }
              array_push($res['list'],array('enquery_id'=>$value->enquiry_id,'enquery_code'=>$value->Enquery_id,'org_name'=>'Null','customer_name'=>$value->name_prefix.' '.$value->name.' '.$value->lastname,'email'=>$value->email,'phone'=>$value->phone,'state'=>'','source'=>'test','type'=>$customer,'process_id'=>$value->product_id,'lead_stage'=>$value->lead_stage,'lead_description'=>$value->lead_discription,'tags'=>$tags_row));  
            } 

            $this->set_response([
              'status' => true,
              'data' =>$res,
              ], REST_Controller::HTTP_OK);
          }
          else
          {
            $this->set_response([
              'status' => false,
              'message' =>'data not found'
              ], REST_Controller::HTTP_OK);
          }
        }
        else
        {
          $this->set_response([
            'status' => false,
            'message' =>'user not found'
            ], REST_Controller::HTTP_OK);
        }
      }
      else
      {
        $this->set_response([
          'status' => false,
          'message' =>'user_id missing'
          ], REST_Controller::HTTP_OK);
      }


      
            
          
    }

    

  public function add_english_language_post(){ 
      
    
    $this->form_validation->set_rules('enquiry_id','Enquiry ID','required');  
    //$this->form_validation->set_rules('comment_type','Enquiry Code','required'); 
    $upd =$this->input->post('update');
    $enq_id1 =  $this->input->post('enquiry_id');
    if($this->form_validation->run() == true){   
      $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
      $this->db->from('enquiry');
      $this->db->where('enquiry_id',$enq_id1);
      $q= $this->db->get()->row();
$enq_id=$q->Enquery_id;
$aasign_to_id=$q->aasign_to;
$all_assign=$q->all_assign;

// $this->db->select('pk_i_admin_id');
//       $this->db->from('tbl_admin');
//       $this->db->where('s_user_email',$q->email);
//       $this->db->where('s_phoneno',$q->phone);
//       $stuid= $this->db->get()->row();
// $id_for_bell_noti=$stuid->pk_i_admin_id;

$e_qualification = $this->input->post('e_qualification');
$e_from = $this->input->post('e_from');
$e_to = $this->input->post('e_to');
$e_crsname = $this->input->post('e_crsname');
$e_uniname = $this->input->post('e_uniname');
$e_institutename = $this->input->post('e_institutename');
$e_yearawarded = $this->input->post('e_yearawarded');
$e_remark = $this->input->post('e_remark');
$user_id = $this->input->post('user_id');
$comp_id = $this->input->post('company_id');

//print_r($upd);die;


if(!empty($upd))
           
{		
  foreach($e_qualification as $key=>$value){   

    $data = array(
      'comp_id'   => $comp_id,
      'enquiry_id'   => $enq_id,
      'e_member_name'   => $person_name,
      'e_qualification'   => $value,
      'e_from' => $e_from[$key],
      'e_to'   => $e_to[$key],
      'e_crsname'   => $e_crsname[$key],
      'e_uniname'   => $e_uniname[$key],
      'e_institutename'   => $e_institutename[$key],
      'e_yearawarded'   => $e_yearawarded[$key],
      'e_remark'   => $e_remark[$key],
      'created_by' => $user_id
    );
  //print_r($postData);die;														
  $this->db->where('id',$this->input->post('update'));
  $insert_id = $this->db->update('tbl_education',$data);
  }
  $msg	=	'English Language successfully updated';
//print_r($data);die;
}else{
  foreach($family_name as $key=>$value){  

    $data = array(
      'comp_id'   => $comp_id,
      'enquiry_id'   => $enq_id,
      'e_member_name'   => $person_name,
      'e_qualification'   => $value,
      'e_from' => $e_from[$key],
      'e_to'   => $e_to[$key],
      'e_crsname'   => $e_crsname[$key],
      'e_uniname'   => $e_uniname[$key],
      'e_institutename'   => $e_institutename[$key],
      'e_yearawarded'   => $e_yearawarded[$key],
      'e_remark'   => $e_remark[$key],
      'created_by' => $user_id
    );
    $comment_id = $this->Leads_Model->add_comment_for_events('Education details has been created', $enq_id);
  //print_r($postData);die;														
  $insert_id = $this->Leads_Model->education_all_add($data);
  }
  $msg	=	'English Language added successfully';
}
 
//}
//print_r($data);die;	
      $this->set_response([
      'status' => true,
      'message' =>  $msg  
      ], REST_Controller::HTTP_OK);
   }else{
      $this->set_response([
        'status' => false,
        'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
         ], REST_Controller::HTTP_OK);          
    }
  }
  public function english_language_list_post(){
    $user_id = $this->input->post('user_id');
    $enq_id = $this->input->post('enquiry_id');
    $enquiry_id = $this->Leads_Model->get_leadListDetailsby_id($enq_id);
    $this->db->where('enquiry_id',$enquiry_id->Enquery_id);
    $res = $this->db->get('tbl_education')->result_array();
    if(!empty($res)){
      $this->set_response([
        'status' => TRUE,
        'enquiry' =>$res
         ], REST_Controller::HTTP_OK);
    }else{
      $this->set_response([
        'status' => false,
        'enquiry' =>$res
         ], REST_Controller::HTTP_OK);
    }
  }
  function delete_english_language_post()
  {
     
      $family_id = $this->input->post('member_id');
        $this->db->where(array('id'=>$family_id))->delete('tbl_education');
        
          $res =$this->db->affected_rows(); 
          if($res)
          {
            //$this->Leads_Model->add_comment_for_events($tabname." Deleted ", $enquiry_code);
            $this->set_response([
            'status'      => TRUE,           
            'msg'  => 'success',
            ], REST_Controller::HTTP_OK);   
          }
          else
          {
            $this->set_response([
            'status'  => false,           
            'msg'     => "Unable to delete",
            ], REST_Controller::HTTP_OK); 
          }
      
  }

  public function createEnquiryForm_post()
  {
  $this->load->model(array('Enquiry_model','Leads_Model'));
  $company_id   = $this->input->post('company_id');
  $process_id   = $this->input->post('process_id');
// $user_id      = $this->input->post('user_id');
  $this->session->companey_id = $company_id;
  $this->form_validation->set_rules('company_id','Company ID','trim|required',array('required'=>'You have note provided %s'));
  $this->form_validation->set_rules('process_id','Process ID','trim|required',array('required'=>'You have note provided %s'));

  if($this->form_validation->run() == true)
  {
    $primary_tab= $this->Enquiry_model->getPrimaryTab()->id;
    $basic= $this->location_model->get_company_list1($process_id);
    
    foreach ($basic as $key => $input)
    {

      // if($input['field_id']==13)
      //   unset($basic[$key]);

        switch($input['field_id'])
        { 
          case 1:
          $prefixList = $this->Enquiry_model->name_prefix_list();
          $prefix = array();
          if(!empty($prefixList))
          {
            foreach ($prefixList as $res)
            {
              $prefix[]  = $res->prefix;
            }
          }
          $basic[$key]['extra_field'][] =array('input_values'=>$prefix,
                            'parameter_name'=>'name_prefix');
          $basic[$key]['parameter_name'] = 'fname';
          break;
          case 2:
          $basic[$key]['parameter_name'] = 'lastname';
          break;
          case 3:
          $values = array(
                          array('key'=>"1",
                                'value'=>'Male'),
                          array('key'=>"2",
                                'value'=>'Female'),
                          array('key'=>"3",
                                'value'=>'Other'),
                        );
         
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'gender';
          break;
          case 4:
          $basic[$key]['parameter_name'] = 'mobileno';
          break;
          case 5:
          $basic[$key]['parameter_name'] = 'email';
          break;
          case 6:
          $basic[$key]['parameter_name'] = 'org_name';
          break;
          case 7:
          $leadsource = $this->Leads_Model->get_leadsource_list();
          $values = array();
          foreach ($leadsource as $res)
          {
            $values[] =  array('key'=>$res->lsid,
                              'value'=> $res->lead_name
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'onboarding_source';
          break;
          case 8:
          $subsource = $this->location_model->productcountry();
          $values = array();
          foreach ($subsource as $res)
          {
            $values[] =  array('key'=>$res->id,
                              'value'=> $res->country_name
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'sub_source';
          break;
          case 9:
          $state_list = $this->location_model->estate_list();
          $values = array();
          foreach ($state_list as $res)
          {
            $values[] = array('key'=>$res->id,
                              'value'=> $res->state
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'state_id';
          break;
          case 10:
          $city_list = $this->location_model->ecity_list();
          $values = array();
          foreach ($city_list as $res)
          {
            $values[] = array('key'=>$res->id,
                      'state_id'=>$res->state_id,
                              'value'=> $res->city
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'city';
          break;
          case 11:
          $basic[$key]['parameter_name'] = 'address';
          break;
          case 12:
          $basic[$key]['parameter_name'] = 'remark';
          break;
          case 14: 
          $basic[$key]['parameter_name'] = 'pin_code';
          break;
          case 23: 
          $basic[$key]['parameter_name'] = 'country_stayed';
          break;
          case 15:
          $all_branch = $this->Leads_Model->branch_select();
          $values = array();
          foreach ($all_branch as $res)
          {
            $values[] = array('key'=>$res->id,
                              'value'=> $res->b_name
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'branch_name';
          break;
          case 16:
          $months = array('January','February','March','April','May', 'June', 'July' , 'Auguest' , 'September', 'October','November','December');
          $values = array();
          foreach ($months as $keys=>$res)
          {
            $values[] = array(
                              'key'  => $keys,
                              'value'=> $res
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'in_take';
          break;
          case 17:
          $country_list = $this->location_model->ecountry_list();
          $values = array();
          foreach ($country_list as $res)
          {
            $values[] = array('key'=>$res->id_c,
                              'value'=> $res->country_name
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'residing_country';
          break;
          case 18:
          $country_list = $this->location_model->ecountry_list();
          $values = array();
          foreach ($country_list as $res)
          {
            $values[] = array('key'=>$res->id_c,
                              'value'=> $res->country_name
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'nationality';
          break;
          case 19:
          $country_list = $this->location_model->ecountry_list();
          $values = array();
          foreach ($country_list as $res)
          {
            $values[] = array('key'=>$res->id_c,
                              'value'=> $res->country_name
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'preferred_country[]';
          break;
          case 20:
          $basic[$key]['parameter_name'] = 'age';
          break;
          case 21:
          $married_status = array('Single' , 'Married', 'Widowed', 'Divorced' ,'Separated');
          $values = array();
          foreach ($married_status as $keys=>$res)
          {
            $values[] = array(
                              'key'  => $keys,
                              'value'=> $res
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'marital_status';
          break;
          case 24;
          $basic[$key]['input_values'] = $values;
          $police_case = array('no', 'yes');
          $values = array();
          foreach ($police_case as $keys=>$res)
          {
            $values[] = array(
                              'key'  => $keys,
                              'value'=> $res
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'police_case';
          break;
          case 25;
          $ban_contry = array('no', 'yes');
          $values = array();
          foreach ($ban_contry as $keys=>$res)
          {
            $values[] = array(
                              'key'  => $keys,
                              'value'=> $res
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'ban_country';
          break;
          case 26: 
          $visa_type = $this->Leads_Model->visa_type_select();
          $values = array();
          foreach ($visa_type as $res)
          {
            $values[] = array('key'=>$res->id,
                              'value'=> $res->visa_type
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'visa_type';
          break;
          case 27:
          $basic[$key]['parameter_name'] = 'qualification';
          break;
          case 28:
          $exp = array('no', 'yes');
          $values = array();
          foreach ($exp as $keys=>$res)
          {
            $values[] = array(
                              'key'  => $keys,
                              'value'=> $res
                            );
          }
          $basic[$key]['input_values'] = $values;
          $basic[$key]['parameter_name'] = 'experience';
          break;
        }
    }
    $dynamic = $this->location_model->get_company_list($process_id,$primary_tab);
    $i=0;
    foreach ($dynamic as $key => $value)
    {
        if(in_array($value['input_type'],array('2','3','4','20')))
        {
            $temp  = explode(',', $value['input_values']);
            if(!empty($temp))
            {   $reshape = array();
                foreach ($temp as $k => $v)
                {
                  $reshape[] = array('key'=>$k,
                                    'value'=>$v);
                }
                $dynamic[$key]['input_values'] = $reshape;
            }
        }
        if($value['input_type']=='8')
        {
          $ary =array(
                    array(
                          'key'=>$value['input_id'].'[]',
                          'value' =>'',
                        ),
                    array(
                          'key'=>'inputtype['.$value['input_id'].']',
                          'value' =>'8',
                        ),
                    
          );
                 
        }
        else
        {
          $ary = $value['input_id'];
        }
        $dynamic[$key]['parameter_name'] = $ary;
        // $dynamic[$key]['parameter_name'] = array(
        //                     array('key'=>($value['input_type']=='8'?'enqueryfiles['.$value['input_id'].']':'enqueryfield['.$value['input_id'].']'),
        //                           'value'=>''),
        //                     array('key'=>'inputfieldno['.$i.']',
        //                           'value'=>$value['input_id']),
        //                     array('key'=>'inputtype['.$i.']',
        //                           'value'=>$value['input_type']),
        //                     );
        $i++;
    }
    $data = array_merge($basic,$dynamic);      
    session_destroy();
    if(!empty($data))
    {
      $this->set_response([
      'status'      => TRUE,          
      'data'  => $data, 
      
      ], REST_Controller::HTTP_OK);   
    }
    else
    {
      $this->set_response([
      'status'  => false,           
      'msg'     => "No Data Found"
      ], REST_Controller::HTTP_OK); 
    }
  }
  else
  {
    $msg = strip_tags(validation_errors());
    $this->set_response([
      'status'  => false,
      'msg'     => $msg,//"Please provide a company id"
    ],REST_Controller::HTTP_OK);
  } 
}

// sandeep add tag code
public function tag_list_post()
{
  $this->form_validation->set_rules('company_id','Company ID' ,'required');
  if($this->form_validation->run() == true)
  {
    $comp_id = $this->input->post('company_id');
    $result = $this->db->where('comp_id' , $comp_id)->get('tags')->result();
    if(!empty($result))
    {
      $this->set_response([
        'status' => true,
        'data' => $result
        ], REST_Controller::HTTP_OK);
    }
    else
    {
      $this->set_response([
        'status' => false,
        'message' => 'Not Found'
        ], REST_Controller::HTTP_OK);
    }
  }
  else
  {
    $str = strip_tags(validation_errors());
    $msg = str_replace("\n","",$str);
    $status = false;
    $this->set_response([
      'status' => $status,
      'message' =>$msg
      ], REST_Controller::HTTP_OK);
  }
  
}

public function mark_tag_post()
{  
  $this->form_validation->set_rules('enquiry_id[]','Data','required');
  $this->form_validation->set_rules('tags[]','Tags','required');
  $this->form_validation->set_rules('company_id','Company Id','required');
  if($this->form_validation->run() == true)
  {
    $enq = $this->input->post('enquiry_id[]');
    $comp_id = $this->input->post('company_id');
    $tags = implode(',',$this->input->post('tags[]'));
    foreach ($enq as $key => $value) 
    {
      $erow = $this->db->select('enquiry_id')->where('enquiry_id',$value)->get('enquiry')->row_array();
      if(!empty($erow['enquiry_id']))
      {
        $enq_id = $erow['enquiry_id'];
        if($this->db->where('enq_id',$enq_id)->count_all_results('enquiry_tags'))
        {
          $this->db->where('comp_id',$comp_id);
          $this->db->where('enq_id',$enq_id);
          $this->db->set('tag_ids',$tags);
          $this->db->update('enquiry_tags');
        }
        else
        {
          $this->db->insert('enquiry_tags',array('comp_id'=>$comp_id,'enq_id'=>$enq_id,'tag_ids'=>$tags));
        }
      }
    }
    $this->set_response([
    'status' => TRUE,
    'msg' =>'Tag marked successfully'
    ], REST_Controller::HTTP_OK);
  }
  else
  {
    $this->set_response([
    'status' => false,
    'msg' =>strip_tags(validation_errors())
    ], REST_Controller::HTTP_OK);
  }

}

public function remove_tag_post(){
  $id[] = $this->input->post('id');
  $enq_id = $this->input->post('enq');
  $this->db->select('tag_ids');
  $this->db->from('enquiry_tags');
  $this->db->where('enq_id', $enq_id);
  $res = $this->db->get()->row()->tag_ids;
  $abc = explode(',', $res);
  $result = array_diff($abc, $id);
  $data = implode(",", $result);
  $this->db->where('enq_id', $enq_id);
  $this->db->set('tag_ids', $data);
  $this->db->update('enquiry_tags');
  $this->set_response([
    'status' => TRUE,
    'msg' =>'Success'
     ], REST_Controller::HTTP_OK);
}
  


}