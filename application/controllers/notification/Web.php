<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Web extends CI_Controller{

    public function __construct()
    {
        parent::__construct();      
    
         $this->load->model(
                array('Leads_Model','User_model','Message_models')
                );
    }
    
    /**
     * Send to a single device
     */

    public function get_pop_reminder_content(){
        $notification_id    =   $this->input->post('notication_id');
        $enq_id =   $this->input->post('enq_id');
        $this->db->select('query_response.*,desposition_type.type_name,lead_stage.lead_stage_name');
        $this->db->where('notification_id',$notification_id);
        $this->db->join('desposition_type','desposition_type.id=query_response.type_disposition','left');
        $this->db->join('lead_stage','lead_stage.stg_id=query_response.call_stage','left');
        $res    =   $this->db->get('query_response')->row_array();
        $html = '';
        if(!empty($res)){
            $this->db->select('enquiry_id,name_prefix,name,lastname,status');
            $this->db->where('Enquery_id',$enq_id);
            $enq_res    =   $this->db->get('enquiry')->row_array();         
            //echo $this->db->last_query();
            if ($enq_res['status'] == 1) {
              $url  = base_url().'enquiry/view/'.$enq_res['enquiry_id'];
            }else if($enq_res['status'] == 2) {
              $url  = base_url().'lead/lead_details/'.$enq_res['enquiry_id'];
            }else if($enq_res['status'] == 3) {
              $url  = base_url().'client/view/'.$enq_res['enquiry_id'];
            }else if($enq_res['status'] == 4) {
              $url  = base_url().'refund/view/'.$enq_res['enquiry_id'];
            }else{
              $url  = 'javascript:void(0)';
            }

            $html .= '<b>Subject :'.$res['subject'].'</b><b style="color:#3392f1;"><br>Reminder Type:- ('.$res['type_name'].')<br></b>'.'</b><b style="color:#3392f1;">Call Disposition:- ('.$res['lead_stage_name'].')</b><br>'.$res['task_remark'].'<br><a href="'.$url.'"><b>'.$enq_res['name_prefix'].' '.$enq_res['name'].' '.$enq_res['lastname'].'</b></a><br>';
            /*$html .= `<div class='col-md-4'>
                    <label>Snooze Till? (Time)</label>
                    <input name='snooze_till' type='time' class='form-control'>
            </div>`;*/
        }
        echo $html;
    }
    public function notification_redirect($enq_id){
        $this->db->select('enquiry_id,status');
        $this->db->where('Enquery_id',$enq_id);
        $enq_res    =   $this->db->get('enquiry')->row_array();                 
        if ($enq_res['status'] == 1) {
          $url  = base_url().'enquiry/view/'.$enq_res['enquiry_id'];
        }else if($enq_res['status'] == 2) {
          $url  = base_url().'lead/lead_details/'.$enq_res['enquiry_id'];
        }else if($enq_res['status'] == 3) {
          $url  = base_url().'client/view/'.$enq_res['enquiry_id'];
        }else{
          $url  = 'javascript:void(0)';
        }
        redirect($url,'refresh');
    }

    public function get_bell_notification_content()
    {   
        $limit = ($this->input->post('limit')) ? $this->input->post('limit') : 20;
        $load = $this->input->post('loaddata');
        $this->db->from('query_response');              
        $user_id = $this->session->user_id;              
        $this->db->select("lead_stage.lead_stage_name,query_response.resp_id,query_response.noti_read,query_response.query_id,query_response.upd_date,query_response.task_date,query_response.task_time,query_response.task_remark,query_response.subject,query_response.task_status,query_response.mobile,CONCAT_WS(' ',enquiry.name_prefix,enquiry.name,enquiry.lastname) as user_name,enquiry.enquiry_id,enquiry.status as enq_status");
    if(in_array($this->session->userdata('user_right'), applicant)){  
         
        $this->db->join('tbl_admin', 'tbl_admin.pk_i_admin_id=query_response.create_by', 'left');
        $this->db->join('enquiry', 'enquiry.Enquery_id=query_response.query_id', 'left');
        $this->db->join('lead_stage', 'lead_stage.stg_id=enquiry.lead_stage', 'left');
        $where = " query_response.related_to=$user_id AND CONCAT(str_to_date(task_date,'%d-%m-%Y'),' ',task_time) <= NOW() ORDER BY CONCAT(str_to_date(task_date,'%d-%m-%Y'),' ',task_time) DESC";
    }else{
        $this->db->join('tbl_admin', 'tbl_admin.pk_i_admin_id=query_response.create_by', 'left');
        $this->db->join('enquiry', 'enquiry.Enquery_id=query_response.query_id', 'left');
        $this->db->join('lead_stage', 'lead_stage.stg_id=enquiry.lead_stage', 'left');
        $where = " ((enquiry.created_by=$user_id OR enquiry.aasign_to=$user_id ) OR query_response.create_by=$user_id OR query_response.related_to=$user_id)  AND CONCAT(str_to_date(task_date,'%d-%m-%Y'),' ',task_time) <= NOW() ORDER BY CONCAT(str_to_date(task_date,'%d-%m-%Y'),' ',task_time) DESC"; 
    }
    // print_r($this->session->userdata('user_right')); 

        $this->db->where($where);
        $this->db->limit($limit);
        $data['res']    =   $this->db->get()->result_array();
        $data['limit']  = ($limit + 20);
        if($load!='')
        {
            echo json_encode(array('html'=>$this->load->view('notifications/bell_notification',$data,true)));
        }
        else
        {
            echo $this->load->view('notifications/bell_notification',$data,true);
        }
        
    }
    public function mark_as_read(){
        $id    =   $this->input->post('id');
        $this->db->where('resp_id',$id);
        $this->db->set('noti_read',1);
        $this->db->update('query_response');
    }
    public function mark_as_unread(){
        $id    =   $this->input->post('id');
        $this->db->where('resp_id',$id);
        $this->db->set('noti_read',0);
        $this->db->update('query_response');
    }
    public function count_bell_notification(){
        $this->db->from('query_response');              
        $user_id = $this->session->user_id;              
        $this->db->select("query_response.resp_id,query_response.noti_read,query_response.query_id,query_response.upd_date,query_response.task_date,query_response.task_time,query_response.task_remark,query_response.subject,query_response.task_status,query_response.mobile,tbl_admin.s_display_name as user_name,");

    if(in_array($this->session->userdata('user_right'), applicant)){
        $this->db->join('tbl_admin', 'tbl_admin.pk_i_admin_id=query_response.related_to', 'left');
        $where = "query_response.related_to=$user_id AND query_response.noti_read=0 AND CONCAT(str_to_date(task_date,'%d-%m-%Y'),' ',task_time) <= NOW() ORDER BY CONCAT(str_to_date(task_date,'%d-%m-%Y'),' ',task_time) DESC";
    }else{
        $this->db->join('tbl_admin', 'tbl_admin.pk_i_admin_id=query_response.create_by', 'left');
        $this->db->join('enquiry', 'enquiry.Enquery_id=query_response.query_id', 'left');
        $where = " ((enquiry.created_by=$user_id OR enquiry.aasign_to=$user_id) OR query_response.create_by=$user_id OR query_response.related_to=$user_id)  AND query_response.noti_read=0 AND CONCAT(str_to_date(task_date,'%d-%m-%Y'),' ',task_time) <= NOW() ORDER BY CONCAT(str_to_date(task_date,'%d-%m-%Y'),' ',task_time) DESC";
    }
        $this->db->where($where);
        echo $this->db->get()->num_rows();
    }

#---------------------------------------------not fill notification start------------------------------------#
    public function get_agreement_notification()
    {
        $date = date("Y-m-d");
        $resp = $this->db->select('id,applicant_name')->from('tbl_client_agreement')->where('created_by',$this->session->user_id)->where('signed_file','0')->where('reminder_date',$date)->where('reminder_status','0')->get()->result();       
        echo json_encode($resp);
    }
    public function update_agreement_status($id)
    {    
       $this->db->set('reminder_status',1);
       $this->db->where('id',$id);
       $this->db->update('tbl_client_agreement');
    }

#---------------------------------------------------not fill notification end-------------------------------#

#---------------------------------------------Payment notification start------------------------------------#
    public function get_payment_notification()
    {
        $today = date("Y-m-d");
        $pay_dt = $this->db->select('tbl_installment.id,tbl_installment.pay_amt,tbl_installment.pay_date,enquiry.name_prefix,enquiry.name,enquiry.lastname')->from('tbl_installment')->join('enquiry','enquiry.Enquery_id=tbl_installment.enq_id')->where('tbl_installment.created_by',$this->session->user_id)->where('tbl_installment.noti_status_admin','0')->where('tbl_installment.from_date <=', $today)->where('tbl_installment.to_date >=', $today)->get()->result();
        
        echo json_encode($pay_dt);
    }
    public function update_payment_status($id)
    {    
       $this->db->set('noti_status_admin',1);
       $this->db->where('id',$id);
       $this->db->update('tbl_installment');
    }

#---------------------------------------------------Payment notification end-------------------------------#

#---------------------------------Payment All Notification/SMS/Email Start cronjob-----------------------------------#
public function Installment_payment_notifications()
    {

//Date wise Reminder
        $today = date('Y-m-d');
        $this->db->select('id,pay_amt,pay_date,enquiry.name_prefix,enquiry.name,enquiry.lastname,enquiry.email,tbl_installment.enq_id,enquiry.comp_id,enquiry.aasign_to,enquiry.phone,enquiry.all_assign,tbl_installment.ini_set');
        $this->db->join('enquiry','enquiry.Enquery_id=tbl_installment.enq_id','left');
        $this->db->where('from_date <=', $today);
        $this->db->where('to_date >=', $today);
        $this->db->where('recieved_amt', null);
        $this->db->where('tbl_installment.comp_id', '83');
        $ins_id    =   $this->db->get('tbl_installment')->result();

//Stage wise Reminder
        $this->db->select('id,pay_amt,pay_date,tbl_installment.enq_id,tbl_installment.reminder_satge,tbl_installment.comp_id,enquiry.all_assign,tbl_installment.ini_set');
        $this->db->join('enquiry','enquiry.Enquery_id=tbl_installment.enq_id','left');
        $this->db->where('pay_date >=', $today);
        $this->db->where('reminder_satge!=', '');
        $this->db->where('recieved_amt', null);
       // $this->db->where('noti_status!=', '1');
        $ins_id_stage    =   $this->db->get('tbl_installment')->result();

 
if(!empty($ins_id)){
foreach($ins_id as $key => $val){
    $message= $this->db->where(array('id'=>'12','comp_id'=>$val->comp_id))->get('reminder_message')->row()->message;

    //For Sender details
        $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        $this->db->where('companey_id',$val->comp_id);
        $this->db->where('pk_i_admin_id',$val->aasign_to);
        $sender_row =   $this->db->get('tbl_admin')->row_array();

if(!empty($sender_row['telephony_agent_no'])){
    $senderno = '0'.$sender_row['telephony_agent_no'];
}else{
    $senderno = $sender_row['s_phoneno'];
}

    $stage_remark='';
        if(!empty($message)){
            $stage_remark=$message;
            $stage_remark = str_replace("@prefix",$val->name_prefix,$stage_remark);   
            $stage_remark = str_replace("@firstname",$val->name,$stage_remark);  
            $stage_remark = str_replace("@lastname",$val->lastname,$stage_remark);  
            $stage_remark = str_replace("@amount",$val->pay_amt,$stage_remark);  
            $stage_remark = str_replace("@duedate",$val->pay_date,$stage_remark);  
        }

//Email code start here
            $this->db->select('user_protocol as protocol,user_host as smtp_host,user_port as smtp_port,user_email as smtp_user,user_password as smtp_pass');
            $this->db->where('companey_id',$val->comp_id);
            $this->db->where('pk_i_admin_id',$val->aasign_to);
            $email_row  =   $this->db->get('tbl_admin')->row_array();
            if(empty($email_row['smtp_user'] && $email_row['smtp_pass'])){
            $this->db->where('comp_id',$val->comp_id);
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

$email_subject = 'Payment Reminder!';
            $data['message'] = $stage_remark;
            $template = $this->load->view('templates/enquiry_email_template', $data, true);             
            $new_message = $template;

                    $new_message = str_replace('@name', $val->name.' '.$val->lastname,$new_message);
                    $new_message = str_replace('@phone', $val->phone,$new_message);
                    $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
                    $new_message = str_replace('@userphone', $senderno,$new_message);
                    $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
                    $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
                    $new_message = str_replace('@email', $val->email,$new_message);
                    $new_message = str_replace('@password', '12345678',$new_message);
$to = $val->email;

                $this->email->initialize($config);
                $this->email->from($email_row['smtp_user']);                        
                $this->email->to($to);
                $this->email->subject($email_subject); 
                $this->email->message($new_message);               
                if($this->email->send()){
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Sent.', $val->enq_id,'0',$val->aasign_to,$new_message,'3','1',$email_subject);
                echo "Email Sent Successfully!";
                }else{
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Failed.', $val->enq_id,'0',$val->aasign_to,$new_message,'3','0',$email_subject);
                        echo "Something went wrong";                                
                }
//For bell notification
    $z = explode(',',$val->all_assign);
foreach ($z as $key => $aa) {
 
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
    if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($val->enq_id,$aa,$email_subject,$stage_remark,$task_date,$task_time,'535');
        }
}
//For Sms Sent

if(!empty($val->phone)){
 $sms_message= $this->db->where(array('temp_id'=>'342','comp_id'=>$val->comp_id))->get('api_templates')->row()->template_content;

 if($val->ini_set==1){
    $ins = '1st';
 }else if($val->ini_set==2){
    $ins = '2nd';
 }else if($val->ini_set==3){
    $ins = '3rd';
 }else if($val->ini_set==4){
    $ins = '4th';
 }else if($val->ini_set==5){
    $ins = '5th';
 }else if($val->ini_set==6){
    $ins = '6th';
 }else if($val->ini_set==7){
    $ins = '7th';
 }else if($val->ini_set==8){
    $ins = '8th';
 }

            $new_message = $sms_message;
            $new_message = str_replace('@name', $val->name.' '.$val->lastname,$new_message);
            $new_message = str_replace('@phone', $val->phone,$new_message);
            $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
            $new_message = str_replace('@userphone', $senderno,$new_message);
            $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
            $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
            $new_message = str_replace('@email', $val->email,$new_message);
            $new_message = str_replace('@password', '12345678',$new_message);
            $new_message = str_replace('@installmentno', $ins,$new_message);
            $new_message = str_replace('@paydate', $val->pay_date,$new_message);
            $new_message = str_replace('@payamt', $val->pay_amt,$new_message);
    $phone = $val->phone;               
                $this->Message_models->smssend($phone,$new_message,$val->comp_id,$sender_row['pk_i_admin_id']);
    
    $enq_id=$val->enq_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('SMS Sent.', $enq_id,'0','0',$new_message,'2','1');
                echo "Message sent successfully"; 
                }
//For Whatsapp Sent

if(!empty($val->phone)){
 $sms_message= $this->db->where(array('temp_id'=>'343','comp_id'=>$val->comp_id))->get('api_templates')->row()->template_content;

 if($val->ini_set==1){
    $ins = '1st';
 }else if($val->ini_set==2){
    $ins = '2nd';
 }else if($val->ini_set==3){
    $ins = '3rd';
 }else if($val->ini_set==4){
    $ins = '4th';
 }else if($val->ini_set==5){
    $ins = '5th';
 }else if($val->ini_set==6){
    $ins = '6th';
 }else if($val->ini_set==7){
    $ins = '7th';
 }else if($val->ini_set==8){
    $ins = '8th';
 }

            $new_message = $sms_message;
            $new_message = str_replace('@name', $val->name.' '.$val->lastname,$new_message);
            $new_message = str_replace('@phone', $val->phone,$new_message);
            $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
            $new_message = str_replace('@userphone', $senderno,$new_message);
            $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
            $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
            $new_message = str_replace('@email', $val->email,$new_message);
            $new_message = str_replace('@password', '12345678',$new_message);
            $new_message = str_replace('@installmentno', $ins,$new_message);
            $new_message = str_replace('@paydate', $val->pay_date,$new_message);
            $new_message = str_replace('@payamt', $val->pay_amt,$new_message);


    $phone='91'.$val->phone;               
                $this->Message_models->sendwhatsapp($phone,$new_message,$val->comp_id,$sender_row['pk_i_admin_id']);
    
    $enq_id=$val->enq_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('Whatsapp Sent.', $enq_id,'0',$sender_row['pk_i_admin_id'],$new_message,'1','1');
                echo "Message sent successfully"; 
                } 

}
    }

if(!empty($ins_id_stage)){
        foreach ($ins_id_stage as $key => $value) {
           $message= $this->db->where(array('id'=>'12','comp_id'=>$value->comp_id))->get('reminder_message')->row()->message;

    //For User details
        $this->db->select('name_prefix,name,lastname,email,comp_id,aasign_to,phone');
        $this->db->where('Enquery_id',$value->enq_id);
        $user_row =   $this->db->get('enquiry')->row();
if(!empty($user_row)){
    //For Sender details
        $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        $this->db->where('companey_id',$user_row->comp_id);
        $this->db->where('pk_i_admin_id',$user_row->aasign_to);
        $sender_row =   $this->db->get('tbl_admin')->row_array();
if(!empty($sender_row['telephony_agent_no'])){
    $senderno = '0'.$sender_row['telephony_agent_no'];
}else{
    $senderno = $sender_row['s_phoneno'];
}
       
    $stage_remark='';
        if(!empty($message)){
            $stage_remark=$message;
            $stage_remark = str_replace("@prefix",$user_row->name_prefix,$stage_remark);   
            $stage_remark = str_replace("@firstname",$user_row->name,$stage_remark);  
            $stage_remark = str_replace("@lastname",$user_row->lastname,$stage_remark);  
            $stage_remark = str_replace("@amount",$value->pay_amt,$stage_remark);  
            $stage_remark = str_replace("@duedate",$value->pay_date,$stage_remark);  
        }

//Email code start here
            $this->db->select('user_protocol as protocol,user_host as smtp_host,user_port as smtp_port,user_email as smtp_user,user_password as smtp_pass');
            $this->db->where('companey_id',$user_row->comp_id);
            $this->db->where('pk_i_admin_id',$user_row->aasign_to);
            $email_row  =   $this->db->get('tbl_admin')->row_array();
            if(empty($email_row['smtp_user'] && $email_row['smtp_pass'])){
            $this->db->where('comp_id',$user_row->comp_id);
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

$email_subject = 'Payment Reminder!';
            $data['message'] = $stage_remark;
            $template = $this->load->view('templates/enquiry_email_template', $data, true);             
            $new_message = $template;

                    $new_message = str_replace('@name', $user_row->name.' '.$user_row->lastname,$new_message);
                    $new_message = str_replace('@phone', $user_row->phone,$new_message);
                    $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
                    $new_message = str_replace('@userphone', $senderno,$new_message);
                    $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
                    $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
                    $new_message = str_replace('@email', $user_row->email,$new_message);
                    $new_message = str_replace('@password', '12345678',$new_message);
$to = $user_row->email;

                $this->email->initialize($config);
                $this->email->from($email_row['smtp_user']);                        
                $this->email->to($to);
                $this->email->subject($email_subject); 
                $this->email->message($new_message);               
                if($this->email->send()){
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Sent.', $value->enq_id,'0','0',$new_message,'3','1',$email_subject);
                echo "Email Sent Successfully!";
                }else{
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Failed.', $value->enq_id,'0','0',$new_message,'3','0',$email_subject);
                        echo "Something went wrong";                                
                }
//For bell notification
$zx = explode(',',$value->all_assign);
foreach ($zx as $key => $aax) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
            $this->User_model->add_comment_for_student_user($value->enq_id,$aax,$email_subject,$stage_remark,$task_date,$task_time,'535');
}
//For Sms Sent

    if(!empty($user_row->phone)){
 $sms_message= $this->db->where(array('temp_id'=>'342','comp_id'=>$value->comp_id))->get('api_templates')->row()->template_content;

 if($value->ini_set==1){
    $ins = '1st';
 }else if($value->ini_set==2){
    $ins = '2nd';
 }else if($value->ini_set==3){
    $ins = '3rd';
 }else if($value->ini_set==4){
    $ins = '4th';
 }else if($value->ini_set==5){
    $ins = '5th';
 }else if($value->ini_set==6){
    $ins = '6th';
 }else if($value->ini_set==7){
    $ins = '7th';
 }else if($value->ini_set==8){
    $ins = '8th';
 }

            $new_message = $sms_message;
            $new_message = str_replace('@name', $user_row->name.' '.$user_row->lastname,$new_message);
            $new_message = str_replace('@phone', $user_row->phone,$new_message);
            $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
            $new_message = str_replace('@userphone', $senderno,$new_message);
            $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
            $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
            $new_message = str_replace('@email', $user_row->email,$new_message);
            $new_message = str_replace('@password', '12345678',$new_message);
            $new_message = str_replace('@installmentno', $ins,$new_message);
            $new_message = str_replace('@paydate', $value->pay_date,$new_message);
            $new_message = str_replace('@payamt', $value->pay_amt,$new_message);
    $phone = $user_row->phone;               
                $this->Message_models->smssend($phone,$new_message,$value->comp_id);
    
    $enq_id=$value->enq_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('SMS Sent.', $enq_id,'0','0',$new_message,'2','1');
                echo "Message sent successfully";  
}

//For Whatsapp Sent

if(!empty($user_row->phone)){
 $sms_message= $this->db->where(array('temp_id'=>'343','comp_id'=>$value->comp_id))->get('api_templates')->row()->template_content;

 if($value->ini_set==1){
    $ins = '1st';
 }else if($value->ini_set==2){
    $ins = '2nd';
 }else if($value->ini_set==3){
    $ins = '3rd';
 }else if($value->ini_set==4){
    $ins = '4th';
 }else if($value->ini_set==5){
    $ins = '5th';
 }else if($value->ini_set==6){
    $ins = '6th';
 }else if($value->ini_set==7){
    $ins = '7th';
 }else if($value->ini_set==8){
    $ins = '8th';
 }

            $new_message = $sms_message;
            $new_message = str_replace('@name', $user_row->name.' '.$user_row->lastname,$new_message);
            $new_message = str_replace('@phone', $user_row->phone,$new_message);
            $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
            $new_message = str_replace('@userphone', $senderno,$new_message);
            $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
            $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
            $new_message = str_replace('@email', $user_row->email,$new_message);
            $new_message = str_replace('@password', '12345678',$new_message);
            $new_message = str_replace('@installmentno', $ins,$new_message);
            $new_message = str_replace('@paydate', $value->pay_date,$new_message);
            $new_message = str_replace('@payamt', $value->pay_amt,$new_message);
        if(!empty($pay_link)){
            $new_message = str_replace('@link', $pay_link,$new_message);
        }

    $phone='91'.$user_row->phone;               
                $this->Message_models->sendwhatsapp($phone,$new_message,$value->comp_id,$sender_row['pk_i_admin_id']);
    
    $enq_id=$value->enq_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('Whatsapp Sent.', $enq_id,'0',$sender_row['pk_i_admin_id'],$new_message,'1','1');
                echo "Message sent successfully"; 
                } 

        }
}
        }
    }
#---------------------------------Payment All Notification/SMS/Email cronjob End-----------------------------------#
}