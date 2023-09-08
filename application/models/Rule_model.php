<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Rule_model extends CI_Model {
    
    public function get_rule($id,$comp_id=0){
        if ($comp_id == 0) {
            $comp_id    =   $this->session->companey_id;
        }
        $this->db->where('id',$id);
        $this->db->where('comp_id',$comp_id);
        return $this->db->get('leadrules')->row_array(); 
    }

    public function get_rules($type=array(),$comp_id=0,$process){        
        if ($comp_id == 0) {
            $comp_id    =   $this->session->companey_id;
        }
        if ($process == 0) {
            $process  =   $this->session->process[0];
        }
        $this->db->where('comp_id',$comp_id);
        $this->db->where('status',1);
        $this->db->where("FIND_IN_SET(".$process.", process_id)");
        //$this->db->where('process_id',$process);
        if (!empty($type)) {
            $this->db->where_in('type',$type);
        }
        return $this->db->get('leadrules')->result_array();
    }
    
    public function get_probability_by_score($score,$comp_id){        
        return $this->db->query("select * from lead_score where comp_id=$comp_id ")->row_array();
    }

    public function execute_rule($id,$enquiry_code=0,$comp_id=0,$user_id=0){
        $this->load->model('Leads_Model');
        if ($comp_id == 0) {
            $comp_id    =   $this->session->companey_id;
        }
        if ($user_id == 0) {
            $user_id = $this->session->user_id;
        }
        //$this->load->model('rule_model');
        $rule_data    =   $this->get_rule($id,$comp_id);

        $affected = 0;
        if (!empty($rule_data)) {
            if (!empty($rule_data['rule_sql']) && $rule_data['status'] == 1) {
                if ($rule_data['type'] == 1) {                    
                    
                    $score_name    =   $this->get_probability_by_score($rule_data['rule_action'],$comp_id);                    
                    $sid = 0;
                    if(!empty($score_name['score_name'])){
                        $sid = $score_name['sc_id'];
                    }

                    $this->db->where('('.$rule_data['rule_sql'].')');                    
                    if ($enquiry_code) {
                        $this->db->where('Enquery_id',$enquiry_code);                
                    }
                    $this->db->where('comp_id',$comp_id);                
                    if(!empty($sid)){
                        $this->db->set('lead_score',$sid);
                    }
                    $this->db->set('score',$rule_data['rule_action']);
                    $this->db->update('enquiry');                    
                    $affected = $this->db->affected_rows();
                }else if ($rule_data['type'] == 2) {
                    if (!empty($rule_data['rule_action'])) {
                        $assign_to = explode(',', $rule_data['rule_action']);
                        if (!empty($assign_to[0])) {
                            $this->db->where('('.$rule_data['rule_sql'].')');
                            if ($enquiry_code) {
                                $this->db->where('Enquery_id',$enquiry_code);                
                            }
                            $this->db->where('comp_id',$comp_id);                
                            $this->db->where('aasign_to is null'); 
                            $this->db->set('aasign_to',$assign_to[0]);
                            $this->db->update('enquiry');                            
                            $affected = $this->db->affected_rows();

//For update all assign id Start
if(!empty($enquiry_code)){
            $this->db->select('all_assign');
            $this->db->where('Enquery_id',$enquiry_code);
            $res=$this->db->get('enquiry');
            $q=$res->row();
            $z=array();$new=array();$allid=array();
                 $z = explode(',',$q->all_assign);
                 $new[]=$assign_to[0];
                $allid = array_unique (array_merge ($z, $new));
                //print_r($allid);exit; 
                $string_id=implode(',',$allid);
                
                $this->db->set('all_assign', $string_id);
$this->db->where('Enquery_id',$enquiry_code);
$this->db->update('enquiry');                         
            }
//For update all assign id End
                            //echo $affected.'<br>'.$assign_to[0].$this->db->last_query();
                            if ($affected) { 
                                //$this->Leads_Model->add_comment_for_events('Converted to client', $enquiry_code);
                                //$this->Leads_Model->add_comment_for_events_stage(, ,'','',$rule_data['title'].' '.'Rule Applied','');

                                $this->Leads_Model->add_comment_for_events_stage_api('Enquiry Assigned', $enquiry_code,'','',$rule_data['title'].' '.'Rule Applied',$user_id);
                                array_push($assign_to, array_shift($assign_to));
                                $assign_to = implode(',', $assign_to);
                                $this->db->where('id',$id);
                                $this->db->update('leadrules',array('rule_action'=>$assign_to));       
                            }                                   
                        }
                    } 
                }else if ($rule_data['type'] == 3) {

                    $this->db->where('('.$rule_data['rule_sql'].')');

                    $rule_for = (substr($enquiry_code,0,3)=='TCK')?'ticket':'enquiry';

                    
                    
                    if ($enquiry_code)
                    {
                        if($rule_for == 'ticket'){
                            $this->db->select('tbl_ticket.*');
                            $this->db->join('enquiry','enquiry.enquiry_id=tbl_ticket.ticketno','left');
                            $this->db->where('tbl_ticket.ticketno',$enquiry_code); 
                            $this->db->where('tbl_ticket.company',$comp_id);
                        }
                        else{
                            $this->db->select('enquiry.*');
                            $this->db->join('tbl_ticket','enquiry.enquiry_id=tbl_ticket.ticketno','left');
                            $this->db->where('enquiry.Enquery_id',$enquiry_code);                
                            $this->db->where('enquiry.comp_id',$comp_id);
                        }
                    }                                    
                    //$this->db->where('rule_executed!=',$id);   
                    if($rule_for=='ticket')
                        $enq_row = $this->db->get('tbl_ticket')->row_array();
                    else                                 
                        $enq_row = $this->db->get('enquiry')->row_array();

                    if (!empty($enq_row['email']) && !empty($rule_data['rule_action'])) {
                        
                        $this->db->where('pk_i_admin_id',$user_id);
                        $user_row  = $this->db->get('tbl_admin')->row_array();
                        
                        $row   =   $this->db->select('*')
                                    ->from('api_templates')
                                    ->join('mail_template_attachments', 'mail_template_attachments.templt_id=api_templates.temp_id', 'left')                    
                                    ->where('temp_id',$rule_data['rule_action'])                        
                                    ->get()
                                    ->row_array();
                        
                        if (!empty($row)) {

                            $this->db->where('comp_id',$comp_id);
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
                           
                            $this->load->model('Message_models');
                            $subject = $row['mail_subject'];
                            $message = $row['template_content'];

                            if($rule_for=='ticket')
                            {


                                $find = array('@name',
                                                '@phone',
                                                '@username',
                                                '@userphone',
                                                '@designation',
                                                  '@ticket_no',
                                                    '@tracking_no'
                                            );
                                $replace = array(
                                    $enq_row['name'],
                                    $user_row['contact_phone'],
                                    $user_row['s_username'],
                                    $enq_row['phone'],
                                    $user_row['designation'],
                                    $enquiry_code,
                                    $enq_row['tracking_no'],
                                    );
                                $message  =str_replace($find, $replace, $message);

                                $subject  = str_replace($find, $replace, $subject);
                            }
                            else
                            {
        //For template add
            $data['message'] = $message;
            $template = $this->load->view('templates/enquiry_email_template', $data, true);             
            $message = $template;                    

                    $message = str_replace('@name', $enq_row['name'].' '.$enq_row['lastname'],$message);
                    $message = str_replace('@phone', $enq_row['phone'],$message);
                    $message = str_replace('@username', $user_row['s_display_name'].' '.$user_row['last_name'],$message);
                    $message = str_replace('@userphone', $user_row['s_phoneno'],$message);
                    $message = str_replace('@designation', $user_row['designation'],$message);
                    $message = str_replace('@email', $enq_row['email'],$message);
                    $message = str_replace('@password', '12345678',$message);

                    $subject = str_replace('@name', $enq_row['name'].' '.$enq_row['lastname'],$subject);
                    $subject = str_replace('@phone', $enq_row['phone'],$subject);
                    $subject = str_replace('@username', $user_row['s_display_name'].' '.$user_row['last_name'],$subject);
                    $subject = str_replace('@userphone', $user_row['s_phoneno'],$subject);
                    $subject = str_replace('@designation', $user_row['designation'],$subject);
                    $subject = str_replace('@email', $enq_row['email'],$subject);
                    $subject = str_replace('@password', '12345678',$subject);

                            } 

                            if($this->Message_models->send_email($enq_row['email'],$subject,$message,$comp_id,$cc)){
                            //$this->Leads_Model->add_comment_for_events('Email Sent.', $enquiry_code,'0','0',$message,'3');
                            $this->Leads_Model->add_comment_for_events('Email Sent.', $enquiry_code,'0',$user_row['pk_i_admin_id'],$message,'3','1',$subject);
                                //$this->db->where('Enquery_id',$enquiry_code);
                                //$this->db->update('enquiry',array('rule_executed'=>$id));
                            }
                        }

                    }
                }else if($rule_data['type'] == 6){
                    $this->db->where('('.$rule_data['rule_sql'].')');
                     $rule_for = (substr($enquiry_code,0,3)=='TCK')?'ticket':'enquiry';
                    
                    
                     if ($enquiry_code)
                     {
                         if($rule_for == 'ticket'){
                             $this->db->select('tbl_ticket.*');
                             $this->db->join('enquiry','enquiry.enquiry_id=tbl_ticket.ticketno','left');
                             $this->db->where('tbl_ticket.ticketno',$enquiry_code); 
                             $this->db->where('tbl_ticket.company',$comp_id);
                         }
                         else{
                            $this->db->select('enquiry.*');
                             $this->db->join('tbl_ticket','enquiry.enquiry_id=tbl_ticket.ticketno','left');
                             $this->db->where('enquiry.Enquery_id',$enquiry_code);                
                             $this->db->where('enquiry.comp_id',$comp_id);
                         }
                     }                    

                    //$this->db->where('rule_executed!=',$id);                                    
                     if($rule_for=='ticket')
                        $enq_row = $this->db->get('tbl_ticket')->row_array();
                    else                                 
                        $enq_row = $this->db->get('enquiry')->row_array();


                    if (!empty($enq_row['phone']) && !empty($rule_data['rule_action'])) {

                        $this->db->where('pk_i_admin_id',$user_id);
                        $user_row  = $this->db->get('tbl_admin')->row_array();

                        $phone    =   $enq_row['phone'];

                        $row   =   $this->db->select('*')
                                    ->from('api_templates')                                    
                                    ->where('temp_id',$rule_data['rule_action'])                        
                                    ->get()
                                    ->row_array();
                        
                        if (!empty($row)) { 
                           
                            $this->load->model('Message_models');                            
                            $message = $row['template_content'];


                            if($rule_for=='ticket')
                            {


                                $find = array('@name',
                                                '@phone',
                                                '@username',
                                                '@userphone',
                                                '@designation',
                                                 '@ticket_no',
                                                    '@tracking_no'
                                            );
                                $replace = array(
                                    $enq_row['name'],
                                    $user_row['contact_phone'],
                                    $user_row['s_username'],
                                    $enq_row['phone'],
                                    $user_row['designation'],
                                    $enquiry_code,
                                    $enq_row['tracking_no'],
                                    );
                                $message  =str_replace($find, $replace, $message);
                            }
                            else
                            {
                            $message = str_replace('@name', $enq_row['name'].' '.$enq_row['lastname'],$message);
                            $message = str_replace('@phone', $enq_row['phone'],$message);
                            $message = str_replace('@username', $user_row['s_display_name'].' '.$user_row['last_name'],$message);
                            $message = str_replace('@userphone', $user_row['s_phoneno'],$message);
                            $message = str_replace('@designation', $user_row['designation'],$message);
                            $message = str_replace('@email', $enq_row['email'],$message);
                            $message = str_replace('@password', '12345678',$message);
                            } 

                            if($this->Message_models->smssend($phone,$message,$comp_id,$user_id)){
                                //$this->Leads_Model->add_comment_for_events('SMS Sent.', $enquiry_code,'0','0',$message,'2');
                                $this->Leads_Model->add_comment_for_events('SMS Sent.', $enquiry_code,'0',$user_row['pk_i_admin_id'],$message,'2','1');
                                //$this->db->where('Enquery_id',$enquiry_code);
                                //$this->db->update('enquiry',array('rule_executed'=>$id));
                            }
                        }

                    }
                    
                }else if($rule_data['type'] == 7){
                    $this->db->where('('.$rule_data['rule_sql'].')');


                    $rule_for = (substr($enquiry_code,0,3)=='TCK')?'ticket':'enquiry';
                    
                    if ($enquiry_code)
                    {
                        if($rule_for == 'ticket'){
                            $this->db->select('tbl_ticket.*');
                            $this->db->join('enquiry','enquiry.enquiry_id=tbl_ticket.ticketno','left');
                            $this->db->where('tbl_ticket.ticketno',$enquiry_code); 
                            $this->db->where('tbl_ticket.company',$comp_id);
                        }
                        else{
                            $this->db->select('enquiry.*');
                            $this->db->join('tbl_ticket','enquiry.enquiry_id=tbl_ticket.ticketno','left');
                            $this->db->where('enquiry.Enquery_id',$enquiry_code);                
                            $this->db->where('enquiry.comp_id',$comp_id);
                        }
                    }
                    //$this->db->where('rule_executed!=',$id);                                    
                    
                     if($rule_for=='ticket')
                        $enq_row = $this->db->get('tbl_ticket')->row_array();
                    else                                 
                        $enq_row = $this->db->get('enquiry')->row_array();

                    if (!empty($enq_row['phone']) && !empty($rule_data['rule_action'])) {

                         $this->db->where('pk_i_admin_id',$user_id);
                        $user_row  = $this->db->get('tbl_admin')->row_array();

                        $phone    =   $enq_row['phone'];
                        $row   =   $this->db->select('*')
                                    ->from('api_templates')                                    
                                    ->where('temp_id',$rule_data['rule_action'])                        
                                    ->get()
                                    ->row_array();
                        
                        if (!empty($row)) { 
                            $this->load->model('Message_models');                            
                            $message = $row['template_content'];

                            if($rule_for=='ticket')
                            {


                                $find = array('@name',
                                                '@phone',
                                                '@username',
                                                '@userphone',
                                                '@designation',
                                                  '@ticket_no',
                                                    '@tracking_no'
                                            );
                                $replace = array(
                                    $enq_row['name'],
                                    $user_row['contact_phone'],
                                    $user_row['s_username'],
                                    $enq_row['phone'],
                                    $user_row['designation'],
                                    $enquiry_code,
                                    $enq_row['tracking_no'],
                                    );
                                $message  =str_replace($find, $replace, $message);
                            }
                            else
                            {
                            $message = str_replace('@name', $enq_row['name'].' '.$enq_row['lastname'],$message);
                            $message = str_replace('@phone', $enq_row['phone'],$message);
                            $message = str_replace('@username', $user_row['s_display_name'].' '.$user_row['last_name'],$message);
                            $message = str_replace('@userphone', $user_row['s_phoneno'],$message);
                            $message = str_replace('@designation', $user_row['designation'],$message);
                            $message = str_replace('@email', $enq_row['email'],$message);
                            $message = str_replace('@password', '12345678',$message);
                            } 
$phone='91'.$phone;
                            if($this->Message_models->sendwhatsapp($phone,$message,$comp_id,$user_id))
                            {
                            //$this->Leads_Model->add_comment_for_events('Whatsapp Sent.', $enquiry_code,'0','0',$message,'1');
                            $this->Leads_Model->add_comment_for_events('Whatsapp Sent.', $enquiry_code,'0',$user_row['pk_i_admin_id'],$message,'1','1');
                                //$this->db->where('Enquery_id',$enquiry_code);
                                //$this->db->update('enquiry',array('rule_executed'=>$id));
                            }
                        }

                    }
                }else if($rule_data['type'] == 8){ // ticket auto priority
                    $this->db->where('('.$rule_data['rule_sql'].')');
                    if ($enquiry_code) {
                        $this->db->where('ticketno',$enquiry_code);                
                    }
                    $this->db->where('company',$comp_id);
                    //$this->db->where('rule_executed!=',$id);                                    
                    $enq_row = $this->db->get('tbl_ticket')->row_array();                    
                    if (!empty($rule_data['rule_action']) && !empty($enq_row)) {
                        $this->db->where('tbl_ticket.ticketno',$enquiry_code);
                        $this->db->where('tbl_ticket.company',$comp_id);
                        $this->db->update('tbl_ticket',array('tbl_ticket.priority'=>$rule_data['rule_action']));
                    }
                }else if($rule_data['type'] == 9){                                        
                    if(!empty($rule_data['rule_action'])){
                        $action = json_decode($rule_data['rule_action'],true);                        
                    }
                    if(!empty($action)){

                        $this->db->where('('.$rule_data['rule_sql'].')');
                        $this->db->where('ticketno',$enquiry_code);

                        $enq_row = $this->db->get('tbl_ticket')->row_array();  

                        if (!empty($rule_data['rule_action']) && !empty($enq_row)) {                                                     
                            $this->load->model('Ticket_Model');
                            $this->Ticket_Model->saveconv($enq_row['id'],'Stage Updated',$rule_data['title']. ' Rule Applied','',$user_id,$action['stage'],$action['sub_stage'],$action['ticket_status'],$comp_id);
                           // echo'Rule done'; exit();
                        }
                    }
                }else if($rule_data['type'] == 10){                                        
                    if(!empty($rule_data['rule_action'])){
                        $action = json_decode($rule_data['rule_action'],true);                        
                    }
                    if(!empty($action)){
                        $this->db->where('('.$rule_data['rule_sql'].')');
                        $this->db->where('ticketno',$enquiry_code);                                        
                        $this->db->where('company',$comp_id);                                           
                        $enq_row = $this->db->get('tbl_ticket')->row_array();                    
                        if (!empty($rule_data['rule_action']) && !empty($enq_row)) {  
                            if(empty($action['source'])){
                                $action['source']=0;
                            } 
                            $this->load->model('Ticket_Model');
                            $this->Ticket_Model->moveTicketToEnq($enq_row['id'],'Stage Updated',$rule_data['title'],'Rule Applied',$user_id,$action['stage'],$action['assignto'],$action['defaultProcess'],$action['source']);
                        
                        }
                    }
                }else if($rule_data['type'] == 12){                                        
                    if(!empty($rule_data['rule_action'])){
                        //$this->db->where('('.$rule_data['rule_sql'].')');
                        $tag_id = explode('=', $rule_data['rule_sql']);
                        //print_r($tag_id);exit;
                        $this->db->where("FIND_IN_SET(".$tag_id[1].", tag_status)");
                        $this->db->where('Enquery_id',$enquiry_code);                                        
                        $this->db->where('comp_id',$comp_id);
                        $this->db->join('tbl_admin','tbl_admin.s_phoneno=enquiry.phone','left');
                        $enq_row = $this->db->get('enquiry')->row_array();                    
                        if (!empty($enq_row)) {
//For Sender details
        $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        $this->db->where('companey_id',$enq_row['comp_id']);
        $this->db->where('pk_i_admin_id',$enq_row['aasign_to']);
        $sender_row =   $this->db->get('tbl_admin')->row_array();
if(!empty($sender_row['telephony_agent_no'])){
    $senderno = '0'.$sender_row['telephony_agent_no'];
}else{
    $senderno = $sender_row['s_phoneno'];
} 

//For Sent bell Ntification 
$this->load->model('User_model');
if(!empty($enq_row['pk_i_admin_id'])){
$sms_message= $this->db->where(array('temp_id'=>$rule_data['rule_action'],'comp_id'=>$comp_id))->get('api_templates')->row();

$email_subject = $sms_message->template_name;
            $new_message = $sms_message->template_content;
            $new_message = str_replace('@name', $enq_row['name'].' '.$enq_row['lastname'],$new_message);
            $new_message = str_replace('@phone', $enq_row['phone'],$new_message);
            $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
            $new_message = str_replace('@userphone', $senderno,$new_message);
            $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
            $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
            $new_message = str_replace('@email', $enq_row['email'],$new_message);
            $new_message = str_replace('@password', '12345678',$new_message);

    $task_date = date("d-m-Y");
    $task_time = date("h:i:s");
        $this->User_model->add_comment_for_student_user($enq_row['Enquery_id'],$enq_row['pk_i_admin_id'],$email_subject,$new_message,$task_date,$task_time,$sender_row['pk_i_admin_id']);

    $comment_id = $this->Leads_Model->add_comment_for_events('Notification Sent.', $enq_row['Enquery_id'],'0',$sender_row['pk_i_admin_id'],$new_message,'1','1'); 
}
                        
                        }
                    }
                }
            }
        }
        return $affected;
    }
    public function execute_rules($enquiry_code,$type,$comp_id=0,$user_id=0,$process=0){ // for multiple rule execution
       //print_r($process);exit;
        if ($comp_id == 0) {
            $comp_id    =   $this->session->companey_id;
        }
        if ($user_id == 0) {
            $user_id = $this->session->user_id;
        }
        //echo $comp_id.'<br>'.$user_id; 
        $results    =   $this->get_rules($type,$comp_id,$process);
       // echo '<pre>';print_r($results);exit;
        if (!empty($results)) {
            foreach ($results as $key => $value) {
                if($value['execution']=='1'){
                    $rule_executed    =   $this->db->select('id')->where(array('rule_id'=>$value['id'],'enq_id'=>$enquiry_code))->get('tbl_rule_execution')->row();
                    if(empty($rule_executed)){
                    
                    $this->db->set('comp_id', $comp_id);
                    $this->db->set('rule_id', $value['id']);
                    $this->db->set('enq_id', $enquiry_code);
                    $this->db->insert('tbl_rule_execution');

                    $this->execute_rule($value['id'],$enquiry_code,$comp_id,$user_id);  
                    }
                }else{
                $this->execute_rule($value['id'],$enquiry_code,$comp_id,$user_id); 
                }               
            }
        }
    }
    public function get_rule_by_type($type){
        $comp_id = $this->session->companey_id;
        $this->db->where('type',$type);
        $this->db->where('comp_id',$comp_id);
        $this->db->where('status',1);
        return $this->db->get('leadrules')->result_array();
    }
}