<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Webhook extends REST_Controller {

    function __construct()
    {
        parent::__construct();
           $this->load->database();
           $this->load->library('form_validation');
            
        $this->load->model(array(
            'enquiry_model','Leads_Model','location_model','Task_Model','User_model','Message_models','Client_Model'
        ));
        
        $this->load->library('email'); 

   // $this->lang->load('notifications_lang', 'english');   

        
           $this->load->helper('url');
           $this->methods['users_get']['limit'] = 500; 
           $this->methods['users_post']['limit'] = 100; 
           $this->methods['users_delete']['limit'] = 50; 
        /*   header('Content-type: application/json');
        header('Access-Control-Allow-Origin', '*');
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header('Access-Control-Allow-Headers', 'Content-Type');*/
    }
    public function call_post()
    {
        $users='';
        $call_data = $_POST['myoperator'];
        $call_data_array = json_decode($call_data);
        $FIREBASE = "https://godspeed-11e92.firebaseio.com/";
        $uid=str_replace('.','_',$call_data_array->uid);
        $call_state=$call_data_array->call_state;
        if(!empty($call_data_array->users)){
        $users=$call_data_array->users;
        $this->db->set('users',$users);
        }
        
        $phone=$call_data_array->clid;
        $uid1=str_replace('.','_',$uid);
        $this->db->set('json_data',$call_data);
        $this->db->set('uid',$call_data_array->uid);
        $this->db->set('cll_state',$call_state);
        $this->db->set('phone_number',$phone);
        $this->db->insert('tbl_col_log');
        $insert_id = $this->db->insert_id();
        //  if($call_state=3 || $call_state=5){
            $NODE_PUT ="users/".$insert_id.".json";
        $data = array(
        'user_phone'=>$phone,
        'uid'=>$uid,
        'users'=>$users
        );
        $json = json_encode($data );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PATCH" );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($curl);
        curl_close( $curl );
          ///
    }

  public function click_to_dial_post()
  {
    $phone           = '+91'.$this->input->post("phone_no");
    $token           = $this->input->post("token");
    $support_user_id = $this->input->post("support_user_id");
        $this->db->where('telephony_agent_id',$support_user_id);
    $res=$this->db->get('tbl_admin')->row();
    if(!empty($res)){
    $curl = curl_init();
    curl_setopt_array($curl, array(  CURLOPT_URL => "https://obd-api.myoperator.co/obd-api-v1",
    CURLOPT_RETURNTRANSFER => true,  CURLOPT_CUSTOMREQUEST => "POST", 
    CURLOPT_POSTFIELDS =>'{  "company_id": "'.$res->telephony_compid.'",
    "secret_token": "'.$res->telephony_comp_token.'", 
    "type": "1", 
    "user_id": "'.$support_user_id.'",
    "number": "'.$phone.'",   
    "public_ivr_id":"'.$res->public_ivr_id.'", 
    "reference_id": "",  
    "region": "",
    "caller_id": "",  
    "group": "" }', 
    CURLOPT_HTTPHEADER => array(    "x-api-key:oomfKA3I2K6TCJYistHyb7sDf0l0F6c8AZro5DJh", 
    "Content-Type: application/json"  ),));
    echo $response = curl_exec($curl);
  }
}
    
  public function mark_abilibality_post(){
        
        $atID   =   !empty($_POST['callbreakstatus'])?$_POST['callbreakstatus']:'';
        
        $user_id    =   $this->input->post('user_id');        
        
            $url = "https://developers.myoperator.co/user";
            $data = array(
            'token'=>$this->input->post('telephony_token'),
            'receive_calls '=>$atID,
            'uuid'=>$this->input->post('telephony_agent_id'),
            );
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));   
            $response = curl_exec($ch);
            //$user_id    =   $this->session->user_id;
            $this->db->set('availability',$atID);
            $this->db->where('pk_i_admin_id',$user_id);
            $this->db->update('tbl_admin');         
        
            //unset($this->session->availability);
            
            if($atID == 0){     
            echo json_encode(array('id'=>0,'status'=>$atID));
            }else{
            echo json_encode(array('id'=>0,'status'=>$atID));           
            }
    }
  public function enquiryListByPhone_post()
  {
    $phone   = $this->input->post("phone_no");
    $comp_id = $this->input->post("companey_id");

    $this->form_validation->set_rules('phone_no', 'Phone No', 'required');
    $this->form_validation->set_rules('companey_id', 'Company id', 'required');
    
    if ($this->form_validation->run() == true){
        
        $this->db->select("enquiry_id,Enquery_id");        
        $this->db->from("enquiry");
        $this->db->where("phone",$phone);
        $this->db->where('comp_id',$comp_id);
        $enquiryLst = $this->db->get()->row_array();
        
        if(!empty($enquiryLst))
        {
          $this->set_response([
          'status' => true,
          'message' => $enquiryLst, 
          ], REST_Controller::HTTP_OK);
        }
        else
        {
          $this->set_response([
            'status' => false,
            'message' => array('error'=>'not found!') 
            ], REST_Controller::HTTP_OK);
        }
    }else{
        $this->set_response([
            'status' => false,
            'message' => array('error'=>'fields required!') 
            ], REST_Controller::HTTP_OK);
    }

  }

  public function updateEnquiryStatus_post()
  {
    $phone   = '91'.$this->input->post("phone_no");
    $Enquery_id = $this->input->post("Enquery_id");
    $uid = $this->input->post("user_id");
    $this->db->set('status',1);
    $this->db->set('enq_id',$Enquery_id);
    $this->db->where('phone_number',$phone);
    $this->db->where('uid',$uid);
    $update = $this->db->update('tbl_col_log');
    if($update)
    {
      $this->set_response([
        'status' => true,
        'message' => 'updated', 
        ], REST_Controller::HTTP_OK);
    }
    else
    {
      $this->set_response([
        'status' => false,
        'message' => 'something went wrong', 
        ], REST_Controller::HTTP_OK);
    }
  }
    
    public function in_call_post(){
        $users='';
        $call_data = $_POST['myoperator'];
        $call_data_array = json_decode($call_data);
        $FIREBASE = "https://godspeed-11e92.firebaseio.com/";
        $uid=str_replace('.','_',$call_data_array->uid);
        $call_state=$call_data_array->call_state;
        if(!empty($call_data_array->users)){
        $users=$call_data_array->users;
        $this->db->set('users',$users);
        }
        
        $phone=$call_data_array->clid;
        $uid1=str_replace('.','_',$uid);
        $this->db->set('json_data',$call_data);
        $this->db->set('uid',$call_data_array->uid);
        $this->db->set('cll_state',$call_state);
        $this->db->set('phone_number',$phone);
        $this->db->insert('tbl_col_log');
        $insert_id = $this->db->insert_id();
        if($call_state=3 || $call_state=5){
        $NODE_PUT ="us/".$insert_id.".json";
        $data = array(
        'user_phone'=>$phone,
        'uid'=>$uid,
        'users'=>$users
        );
        $json = json_encode($data );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PATCH" );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($curl);
        curl_close( $curl );
        ///
        }
    }
    
     public function after_call_post(){
        $agent_id='';
        $call_data = $_POST['myoperator'];
        $call_data_array = json_decode($call_data, true);
                $agentname=$agenphone='';
                if(!empty($call_data_array['_ld']['_rr']['_na'])){ $agentname=$call_data_array['_ld']['_rr']['_na'];}
                if(!empty($call_data_array['_ld']['_rr']['_ct'])){ $agenphone=$call_data_array['_ld']['_rr']['_na'];}
                //$agentname=$call_data_array['_ld']['_rr']['_na'];
                $this->db->set('recived_by',$agenphone);
                $this->db->set('recived_name',$agentname);
                $this->db->set('customer_phone',$call_data_array['_cr']);
                $this->db->set('call_status',$call_data_array['_su']);
                $this->db->set('event_type',$call_data_array['_ev']);
                $this->db->set('json_data',$call_data); 
                $this->db->insert('tbl_col_log2'); 
        
    }
    
//FOR CHECK WEBHOOK RESPONCE DATA START//

     public function calldata_post()
    {
        $header = apache_request_headers();
        $call_type = $header['call_type'];
        $data = file_get_contents('php://input');
        $this->db->set('json_data',$data);
        $this->db->insert('tbl_col_log');
    }
//FOR CHECK WEBHOOK RESPONCE DATA END//

// FOR CALL RESPONCE STORE IN TBL CALL TABLE START //
    public function tata_call_post()
    {

        $jsondt = file_get_contents('php://input');
        $header = apache_request_headers();
        $call_type = $header['call_type'];
        $users='';
        $call_data = $jsondt;
        $call_data_array = json_decode($call_data);
        $FIREBASE = "https://godspeed-11e92.firebaseio.com/";
if($call_type=='11'){
        $recphone = substr($call_data_array->caller_id_number, -10);
        $callphone = substr($call_data_array->agent_number, -10);
    }else{
        $recphone = substr($call_data_array->call_to_number, -10);
        $callphone = substr($call_data_array->answered_agent_number, -10);
    }

if(!empty($recphone)){
        $erow = $this->db->select('enquiry_id')->where('phone',$recphone)->or_where('phone',$call_data_array->call_to_number)->get('enquiry')->row_array();
if($call_type=='7' || $call_type=='11'){
        $this->db->set('uid',$call_data_array->uuid);
        $this->db->set('enq_id',$erow['enquiry_id']??'');
        $this->db->set('phone_number',$recphone);
        $this->db->set('cll_state',$call_type);
        $this->db->set('users',$callphone);
        $this->db->set('json_data',$jsondt);
        $this->db->set('call_status',$call_data_array->call_status??'Dialed on Agent');
        $this->db->set('status','1');
        $this->db->insert('tbl_col_log');
        $insert_id = $this->db->insert_id();
}
//For IVR call Start
/*if($call_type=='3'){
        $this->db->set('uid',$call_data_array->uuid);
        $this->db->set('enq_id',$erow['enquiry_id']??'');
        $this->db->set('phone_number',$recphone);
        $this->db->set('cll_state',$call_type);
        $this->db->set('users',$callphone);
        $this->db->set('json_data',$jsondt);
        $this->db->set('call_status',$call_data_array->call_status??'Answered by Agent');
        $this->db->set('status','1');
        $this->db->insert('tbl_col_log');
        $insert_id = $this->db->insert_id();
}
if($call_type=='3'){
        $NODE_PUT ="us/".$insert_id.".json";
        $data = array(
        'user_phone'=>$recphone,
        'uid'=>$call_data_array->uuid,
        'users'=>$callphone
        );
        $json = json_encode($data );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PATCH" );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($curl);
        curl_close( $curl );
}*/
//For IVR call End
if($call_type=='11'){
        $NODE_PUT ="us/".$insert_id.".json";
        $data = array(
        'user_phone'=>$recphone,
        'uid'=>$call_data_array->uuid,
        'users'=>$callphone
        );
        $json = json_encode($data );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PATCH" );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($curl);
        curl_close( $curl );
    }
    }
    }
// FOR CALL RESPONCE STORE IN TBL CALL TABLE END //

// For Payment Success Response //
public function payment_status_post()
    {

        $data = file_get_contents('php://input');
        $payment = json_decode($data);


$phone = substr($payment->payload->payment->entity->contact, -10);
$email = $payment->payload->payment->entity->email;
$amount = substr($payment->payload->payment->entity->amount, 0, -2);

$this->db->select('tbl_installment.id,tbl_installment.comp_id,tbl_admin.pk_i_admin_id,enquiry.enquiry_id,enquiry.product_id');
$this->db->from('tbl_installment');
$this->db->join('enquiry','enquiry.Enquery_id=tbl_installment.enq_id','left');
$this->db->join('tbl_admin','tbl_admin.s_phoneno=enquiry.phone','left');
$this->db->where('enquiry.email',$email);
$this->db->where('enquiry.phone',$phone);
$this->db->where('tbl_installment.link_status','0');
$this->db->order_by('tbl_installment.id','ASC');
$ins_dt = $this->db->get()->row();
if(!empty($ins_dt)){
$company= $ins_dt->comp_id;
$ins_id= $ins_dt->id;
$pay_typ ='m';
if(empty($ins_dt->pk_i_admin_id) && $ins_dt->product_id!='182'){
$user_id = $this->after_payment_portal($ins_dt->enquiry_id);
}else{
$user_id = $ins_dt->pk_i_admin_id;	
}
}
if(empty($ins_dt->id)){
$this->db->select('tbl_payment.id,tbl_payment.cmp_no as comp_id,tbl_admin.pk_i_admin_id,enquiry.enquiry_id,enquiry.product_id');
$this->db->from('tbl_payment');
$this->db->join('enquiry','enquiry.Enquery_id=tbl_payment.enq_id','left');
$this->db->join('tbl_admin','tbl_admin.s_phoneno=enquiry.phone','left');
$this->db->where('enquiry.email',$email);
$this->db->where('enquiry.phone',$phone);
$this->db->where('tbl_payment.link_status','0');
$this->db->order_by('tbl_payment.id','ASC');
$ins_dt = $this->db->get()->row();
if(!empty($ins_dt)){
$company = $ins_dt->comp_id;
$ins_id = $ins_dt->id;
$pay_typ = 's';
if(empty($ins_dt->pk_i_admin_id) && $ins_dt->product_id!='182'){
$user_id = $this->after_payment_portal($ins_dt->enquiry_id);
}else{
$user_id = $ins_dt->pk_i_admin_id;	
}
} 
}
if($payment->payload->payment->entity->status=='captured'){
        $this->db->set('comp_id',$company??'');
        $this->db->set('uid',$user_id??'');
        $this->db->set('status',$payment->payload->payment->entity->status);
        $this->db->set('method',$payment->payload->payment->entity->method);
        $this->db->set('ins_id',$ins_id??'');
        $this->db->set('txnid',$payment->payload->payment->entity->id);
        $this->db->set('amount',$amount??'');
        $this->db->set('pay_email',$email??'');
        $this->db->set('pay_mobile',$phone??'');
        $this->db->set('response',$data);
        $this->db->insert('payment_history');
$insert_id = $this->db->insert_id();
if(!empty($insert_id && $ins_id)){
$this->after_payment_notifications($ins_id,$amount,$user_id,$pay_typ);
}
}

    }
// For Payment Success Response //
public function after_payment_portal($enquiry_id)
    {
$user_right = '214';
                    $this->db->select('*');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enquiry_id);
                    $q= $this->db->get()->row();

                    $pass='12345678';
                    
                     $assign_data=array(
                        // 's_username'=> $q->name_prefix,
                        's_password'=>md5($pass),
                        's_display_name'=>$q->name,
                        'last_name'=>$q->lastname,
                        'date_of_birth'=> '',
                        'joining_date'=>$q->created_date,
                        'state_id'=> $q->state_id,
                        'city_id'=>$q->city_id,
                        'territory_name'=>$q->territory_id,
                        'country'=>$q->country_id,
                        'region'=>$q->region_id,
                        'companey_id'=>$q->comp_id,
                        's_user_email'=>$q->email,
                        's_phoneno'=>$q->phone,
                        'b_status'=>'1',
                        'process'=>$q->product_id,
                        'user_permissions'=>$user_right,
                        'user_type'=>$user_right
                        );
                        
                   $pk_id = $this->db->insert('tbl_admin',$assign_data);
                   $insert_id = $this->db->insert_id();

if(!empty($insert_id)){

            $this->db->set('portal', 'Yes');
            $this->db->set('portal_validity', date('Y-m-d', strtotime('+2 years')));
            $this->db->where('enquiry_id', $enquiry_id);
            $this->db->update('enquiry');

//For SMS and Email sent credential
$message= $this->db->where(array('temp_id'=>'193','comp_id'=>$q->comp_id))->get('api_templates')->row()->template_content;

    //For Sender details
        $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        $this->db->where('companey_id',$q->comp_id);
        $this->db->where('pk_i_admin_id',$q->aasign_to);
        $sender_row =   $this->db->get('tbl_admin')->row_array();

if(!empty($sender_row['telephony_agent_no'])){
    $senderno = '0'.$sender_row['telephony_agent_no'];
}else{
    $senderno = $sender_row['s_phoneno'];
}       

//Email code start here
            $this->db->select('user_protocol as protocol,user_host as smtp_host,user_port as smtp_port,user_email as smtp_user,user_password as smtp_pass');
            $this->db->where('companey_id',$q->comp_id);
            $this->db->where('pk_i_admin_id',$q->aasign_to);
            $email_row  =   $this->db->get('tbl_admin')->row_array();
            if(empty($email_row['smtp_user'] && $email_row['smtp_pass'])){
            $this->db->where('comp_id',$q->comp_id);
            $this->db->where('status',1);
            $email_row  =   $this->db->get('email_integration')->row_array();
            }

            if(empty($email_row)){
                echo "Email is not configured";
                exit();
            }else{

                $config['smtp_auth']    = true;
                $config['protocol']     = $email_row['protocol'];
                $config['smtp_host']    = $email_row['smtp_host'];
                $explode=explode('.',$email_row['smtp_host']);
                if(in_array('secureserver',$explode)){
                $config['smtp_crypto'] = 'ssl'; 
                }
                $config['smtp_port']    = $email_row['smtp_port'];
                $config['smtp_timeout'] = '7';
                $config['smtp_user']    = $email_row['smtp_user'];
                $config['smtp_pass']    = $email_row['smtp_pass'];
                $config['charset']      = 'utf-8';
                $config['mailtype']     = 'html'; // or html
                $config['newline']      = "\r\n";          
            }

$email_subject = 'Portal credentials!';
$stage_remark = 'Poratal credential successfully share to applicant over Mail/SMS.';
            $data['message'] = $message;
            $template = $this->load->view('templates/enquiry_email_template', $data, true);             
            $new_message = $template;

                    $new_message = str_replace('@name', $q->name.' '.$q->lastname,$new_message);
                    $new_message = str_replace('@phone', $q->phone,$new_message);
                    $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
                    $new_message = str_replace('@userphone', $senderno,$new_message);
                    $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
                    $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
                    $new_message = str_replace('@email', $q->email,$new_message);
                    $new_message = str_replace('@password', '12345678',$new_message);
$to = $q->email;

                $this->email->initialize($config);
                $this->email->from($email_row['smtp_user']);                        
                $this->email->to($to);
                $this->email->subject($email_subject); 
                $this->email->message($new_message);               
                if($this->email->send()){
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Sent.', $q->Enquery_id,'0',$q->aasign_to,$new_message,'3','1',$email_subject);
                echo "Email Sent Successfully!";
                }else{
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Failed.', $q->Enquery_id,'0',$q->aasign_to,$new_message,'3','0',$email_subject);
                        echo "Something went wrong";                                
                }
//For bell notification
 $z = explode(',',$q->all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
    if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($q->Enquery_id,$aa,$email_subject,$stage_remark,$task_date,$task_time,'535');
        }
}
//For Sms Sent

if(!empty($q->phone)){
 $sms_message= $this->db->where(array('temp_id'=>'345','comp_id'=>$q->comp_id))->get('api_templates')->row()->template_content;

            $new_message = $sms_message;
            $new_message = str_replace('@name', $q->name.' '.$q->lastname,$new_message);
            $new_message = str_replace('@phone', $q->phone,$new_message);
            $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
            $new_message = str_replace('@userphone', $senderno,$new_message);
            $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
            $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
            $new_message = str_replace('@email', $q->email,$new_message);
            $new_message = str_replace('@password', '12345678',$new_message);
    $phone = $q->phone;               
                $this->Message_models->smssend($phone,$new_message,$q->comp_id,$sender_row['pk_i_admin_id']);
    
    $enq_id=$q->Enquery_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('SMS Sent.', $enq_id,'0',$q->aasign_to,$new_message,'2','1');
                echo "Message sent successfully"; 
                }
//For Whatsapp Sent

if(!empty($q->phone)){
 $sms_message= $this->db->where(array('temp_id'=>'293','comp_id'=>$q->comp_id))->get('api_templates')->row()->template_content;

            $new_message = $sms_message;
            $new_message = str_replace('@name', $q->name.' '.$q->lastname,$new_message);
            $new_message = str_replace('@phone', $q->phone,$new_message);
            $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
            $new_message = str_replace('@userphone', $senderno,$new_message);
            $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
            $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
            $new_message = str_replace('@email', $q->email,$new_message);
            $new_message = str_replace('@password', '12345678',$new_message);
    $phone='91'.$phone;               
                $this->Message_models->sendwhatsapp($phone,$new_message,$q->comp_id,$sender_row['pk_i_admin_id']);
    
    $enq_id=$q->Enquery_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('Whatsapp Sent.', $enq_id,'0',$sender_row['pk_i_admin_id'],$new_message,'1','1');
                echo "Message sent successfully"; 
                }
}

                    return $insert_id;
    }

//Update timeline and send notification start
public function after_payment_notifications($ins_id,$amount,$user_id,$pay_typ)
    {
    if($pay_typ=='s'){

                    $this->db->set('onetime_mode','2');
                    $this->db->set('link_status','1');
                    $this->db->set('onetime_pay_amt',$amount);
                    $this->db->where('id',$ins_id);
                    $this->db->update('tbl_payment');

                    $this->db->select('tbl_payment.id,enquiry.aasign_to,enquiry.enquiry_id,enquiry.Enquery_id,tbl_admin.s_display_name,tbl_admin.last_name,');
                    $this->db->from('tbl_payment');
                    $this->db->join('enquiry','enquiry.Enquery_id=tbl_payment.enq_id','left');
                    $this->db->join('tbl_admin','tbl_admin.pk_i_admin_id=enquiry.aasign_to','left');
                    $this->db->where('tbl_payment.id',$ins_id);
                    $noti = $this->db->get()->row();

                    $redirect_id = $noti->enquiry_id;
                    $task_date = date("d-m-Y");
	                $task_time = date("h:i:s");
	                $create_by = $user_id;
	                $subject = 'Payment Done!';
	                $stage_remark = 'Dear '.$noti->s_display_name.' '.$noti->last_name.', Greetings from Godspeed Immigration. We wish to Inform you that a payment Amount '.$amount.' by User '.$noti->Enquery_id.' has been Done. If already notified please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
                    $this->User_model->add_comment_for_student_user($noti->Enquery_id,$noti->aasign_to,$subject,$stage_remark,$task_date,$task_time,$create_by);

                    $this->Leads_Model->add_comment_for_events('Payment Done Successfully of Amount '.$amount.' Rs.', $noti->Enquery_id,'',$create_by);

                }else{

                	$this->db->set('typpay','2');
                	$this->db->set('link_status','1');
                    $this->db->set('recieved_amt',$amount);
                    $this->db->where('id',$ins_id);
                    $this->db->update('tbl_installment');


                    $this->db->select('tbl_installment.id,enquiry.aasign_to,enquiry.enquiry_id,enquiry.Enquery_id,tbl_admin.s_display_name,tbl_admin.last_name,');
                    $this->db->from('tbl_installment');
                    $this->db->join('enquiry','enquiry.Enquery_id=tbl_installment.enq_id','left');
                    $this->db->join('tbl_admin','tbl_admin.pk_i_admin_id=enquiry.aasign_to','left');
                    $this->db->where('tbl_installment.id',$ins_id);
                    $noti = $this->db->get()->row();

                    $redirect_id = $noti->enquiry_id;
                    $task_date = date("d-m-Y");
	                $task_time = date("h:i:s");
	                $create_by = $user_id;
	                $subject = 'Payment Done!';
	                $stage_remark = 'Dear '.$noti->s_display_name.' '.$noti->last_name.', Greetings from Godspeed Immigration. We wish to Inform you that a payment Amount '.$amount.' by User '.$noti->Enquery_id.' has been Done. If already notified please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
                    $this->User_model->add_comment_for_student_user($noti->Enquery_id,$noti->aasign_to,$subject,$stage_remark,$task_date,$task_time,$create_by);

                    $this->Leads_Model->add_comment_for_events('Payment Done Successfully of Amount '.$amount.' Rs.', $noti->Enquery_id,'',$create_by);

                }
    }
//Update payment and sent notification end
}