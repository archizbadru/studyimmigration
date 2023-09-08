<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Dashboard extends REST_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model(array('User_model'));
    }

    public function dashboard_post()
    {   
        $user_id = $this->input->post('user_id');
        $company_id = $this->input->post('company_id');
        $process_id =  $this->input->post('process_id');//can be multiple
        
        $process = 0;
        if(!empty($process_id))
        {
            if(is_array($process_id))
                $process = implode(',',$process_id);
            else 
                $process = $process_id;
        }
        
        $this->load->model('enquiry_model');
        $funneldata = $this->enquiry_model->all_enqueries_api($user_id,$company_id,$process);
        $this->set_response([
            'status' => TRUE,            
            'funneldata' => $funneldata
        ], REST_Controller::HTTP_OK);        
    }

function daily_mail_report_get() {

$message= 'This is daily report!';

    //For Sender details
        $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        $this->db->where('companey_id','83');
        $this->db->where('pk_i_admin_id','535');
        $sender_row =   $this->db->get('tbl_admin')->row_array();
        
if(!empty($sender_row['telephony_agent_no'])){
    $senderno = '0'.$sender_row['telephony_agent_no'];
}else{
    $senderno = $sender_row['s_phoneno'];
}   

//Email code start here
            $this->db->select('user_protocol as protocol,user_host as smtp_host,user_port as smtp_port,user_email as smtp_user,user_password as smtp_pass');
            $this->db->where('pk_i_admin_id',$sender_row['pk_i_admin_id']);
            $email_row  =   $this->db->get('tbl_admin')->row_array();
            if(empty($email_row['smtp_user'] && $email_row['smtp_pass'])){
            $this->db->where('comp_id','83');
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

$email_subject = 'Daily report!';
$stage_remark = 'Daily report sent on mail go and check please.';
            $data['message'] = $message;
            $data['links'] = 'https://desk.godspeedvisa.com/login';

            $date = date("Y-m-d");
    //For today onboarding
            $where = " DATE(created_date) = '".$date."' AND status=1";
            $all_onboarding = $this->db->select('enquiry_id')->from('enquiry')->where($where)->get()->result();
            $onboarding = count($all_onboarding);

    //For today application
            $where = " DATE(created_date) = '".$date."' AND status=2";
            $all_application = $this->db->select('enquiry_id')->from('enquiry')->where($where)->get()->result();
            $application = count($all_application);

    //For today case management
            $where = " DATE(created_date) = '".$date."' AND status=3";
            $all_casemgmt = $this->db->select('enquiry_id')->from('enquiry')->where($where)->get()->result();
            $casemgmt = count($all_casemgmt);

    //For today refund
            $where = " DATE(created_date) = '".$date."' AND status=4";
            $all_refund = $this->db->select('enquiry_id')->from('enquiry')->where($where)->get()->result();
            $refund = count($all_refund);

            $data['ob'] = $onboarding;
            $data['ap'] = $application;
            $data['cm'] = $casemgmt;
            $data['rc'] = $refund;

            $template = $this->load->view('templates/daily_mail_report', $data, true);             
            $new_message = $template;

                    $sendername  = $sender_row['s_display_name'].' '.$sender_row['last_name'];
                    $new_message = str_replace('@username', $sendername,$new_message);
                    $new_message = str_replace('@userphone', $senderno,$new_message);
                    $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
                    $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);

$to = 'harshit@archizsolutions.com';

                $this->email->initialize($config);
                $this->email->from($email_row['smtp_user']);                        
                $this->email->to($to);
                $this->email->subject($email_subject); 
                $this->email->message($new_message);               
                if($this->email->send()){
                    $data = array(
                        'comp_id'=>'83',
                        'report_subject'=>$email_subject,
                        'report_content'=>$new_message,
                        'status'=>'1'
                    );

                    $this->db->insert('tbl_dailymail_report',$data);
                }else{
            $data = array(
                        'comp_id'=>'83',
                        'report_subject'=>$email_subject,
                        'report_content'=>$new_message,
                        'status'=>'0'
                    );

                    $this->db->insert('tbl_dailymail_report',$data);                               
                }
//For bell notification
$notificationto = $sender_row['pk_i_admin_id'];

            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($notificationto)){
            $this->User_model->add_comment_for_student_user('',$notificationto,$email_subject,$stage_remark,$task_date,$task_time,$sender_row['pk_i_admin_id']);
        }


}

public function other_stages_post()
{
    $base_url='https://thecrm360.com/new_crm/assets/images/icons/';
    $user_id = $this->input->post('user_id');
    $company_id = $this->input->post('company_id');
    $this->form_validation->set_rules('user_id','user_id', 'trim|required');
    $this->form_validation->set_rules('company_id','company_id', 'trim|required');
    $data=[];
    if($this->form_validation->run()==true)
    {
        $enquiry_separation  = get_sys_parameter('enquiry_separation', 'COMPANY_SETTING',$company_id);
        //featch 
        $dydata[]=['key'=>1,'title'=>'enquiry','icon'=>$base_url.'enquiry.jpeg' ];                        
        $dydata[]=['key'=>2,'title'=>'lead','icon'=>$base_url.'lead.jpeg' ];                        
        $dydata[]=['key'=>3,'title'=>'client','icon'=>$base_url.'client.jpeg' ];                        
        if (!empty($enquiry_separation)) {
            $enquiry_separation = json_decode($enquiry_separation, true);
                foreach ($enquiry_separation as $key => $value) {
                   if($key==4){ $img='orders.jpeg'; }else{
                    $img='fit.jpeg';
                   }
                $data[]=['key'=>$key,'title'=>$value['title'],'icon'=>$base_url.$img ];                        
                }
            }              
        $res['basic_menu'] =$dydata;
        $res['dynamic_menu'] =$data;
        $this->set_response([
            'status' => TRUE,            
            'data' => $res
        ], REST_Controller::HTTP_OK); 
    }
    else
    {
        $this->set_response([
            'status' => FALSE,            
            'message' => strip_tags(validation_errors()),
        ], REST_Controller::HTTP_OK); 
    }

} 

}