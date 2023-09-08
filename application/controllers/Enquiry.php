<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Enquiry extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(
                array('Leads_Model','setting_model' ,'website/home_model','schedule_model','enquiry_model', 'dashboard_model', 'Task_Model', 'User_model', 'location_model','Message_models','Institute_model','Datasource_model','Taskstatus_model','dash_model','Center_model','SubSource_model','Kyc_model','Education_model','SocialProfile_model','Closefemily_model','form_model','Doctor_model')
                );
        $this->load->library('email');
        $this->load->library('user_agent');
        $this->lang->load("activitylogmsg","english");      
        $apiarr = explode("/", $_SERVER['REQUEST_URI']);
        
        if(in_array("viewapi", $apiarr)){
            
        }else if(in_array("viewapi", $apiarr)){
            
        }else if(in_array("re_login", $apiarr)){
            
        }else{
            if (empty($this->session->user_id) ) {
                redirect('login');
            }
        }
        
      
    }

      public function add_enquery_comission($enq_code){

        $enq_code = base64_decode($enq_code);

        $this->form_validation->set_rules('amtdisb','Amount Disbursed','trim|required');

        if ($this->form_validation->run() == TRUE) {

            $amtdisb       =   $this->input->post('amtdisb');
            $comission    =   $this->input->post('comission');
            $dateofpay     =   $this->input->post('dateofpay');
            $tds          =   $this->input->post('tds');
            $amtpaid          =   $this->input->post('amtpaid');
            $payoutper         =   $this->input->post('payoutper');
            $month         =   $this->input->post('month');


            $amt_data = array(                                
                        'Enquiry_code'  => $enq_code,
                        'amt_disb'      => $amtdisb,
                        'comission'     => $comission,
                        'date_of_payment'    => $dateofpay,
                        'tds'           => $tds,
                        'amt_paid'      => $amtpaid,
                        'payout_per'    => $payoutper,
                        'month'         => $month,
                        'created_by'    => $this->session->userdata('user_id'),                     
                    );
            if($this->input->post('enq_com_id')){
                $this->db->where('id',$this->input->post('enq_com_id'));
                $ins    =   $this->db->update('tbl_comission',$amt_data);
                $msg = 'updated successfully';

            }else{
                $ins    =   $this->db->insert('tbl_comission',$amt_data);
                $msg = ' added successfully';
            }

            if($ins){
                echo json_encode(array('status'=>true,'msg'=>$msg));                
            }else{
                echo json_encode(array('status'=>false,'msg'=>'Something went wrong!'));
            }
        } else {            
            echo json_encode(array('status'=>false,'msg'=>validation_errors()));
        }



    }
    public function get_update_enquery_comission_content(){
        $id            =   $this->input->post('id');
        $Enquiry_id    =   $this->input->post('Enquiry_id');
        $this->db->where('id',$id);
        $data['comission_data']    =   $this->db->get('tbl_comission')->row_array();
        $data['Enquiry_id'] =   $Enquiry_id;   
        $data['details']    =   $this->enquiry_model->enquiry_by_code($Enquiry_id);     
        $content    =   $this->load->view('comission_modal_content',$data,true);
        echo $content;
    }

     public function move_to_client() {
        
        if (!empty($_POST)) {
            $move_enquiry = $this->input->post('enquiry_id');
            $date = date('d-m-Y H:i:s');

            $lead_score = $this->input->post('lead_score');
            $lead_stage = $this->input->post('lead_stage');
            $comment = $this->input->post('comment');
            $assign_to = $this->session->user_id;
            if (!empty($lead_score)) {
                $lead_score = $this->input->post('lead_score');
            } else {
                $lead_score = '';
            }

            if (!empty($lead_stage)) {
                $lead_stage = $this->input->post('lead_stage');
            } else {
                $lead_stage = '';
            }
            if (!empty($comment)) {
                $comment = $this->input->post('comment');
            } else {
                $comment = '';
            }
            
            if(!empty($move_enquiry)) {
                foreach ($move_enquiry as $key) {
                    $enq = $this->enquiry_model->enquiry_by_id($key);
                    $data = array(
                       // 'adminid' => $enq->created_by,
                        'ld_name' => $enq->name,
                        'ld_email' => $enq->email,
                        'ld_mobile' => $enq->phone,
                        'lead_code' => $enq->Enquery_id,
                      //'city_id' => $enq->city_id,
                       //'state_id' => $enq->state_id,
                       //'country_id' => $enq->country_id,
                       //'region_id' => $enq->region_id,
                       //'territory_id' => $enq->territory_id,
                        'ld_created' => $date,
                        'ld_for' => $enq->enquiry,
                        'lead_score' => $lead_score,
                        'lead_stage' => 1,
                        'comment' => $comment,
                        'ld_status' => '1'
                    );
                    $this->db->set('status', 3);
                    $this->db->where('enquiry_id', $key);
                    $this->db->update('enquiry');
                    
                    $this->load->model('rule_model');
                    $this->rule_model->execute_rules($enq->Enquery_id,array(1,2,3,6,7));  

                    $this->Leads_Model->add_comment_for_events(display("move_to_client"), $enq->Enquery_id);
                    $insert_id = $this->Leads_Model->LeadAdd($data);


                    if ($this->session->companey_id == 76 || ($this->session->companey_id == 57 && $enq->product_id == 122) ) {
                        $user_right = '';
                        if ($enq->product_id == 168) {
                            $user_right = 180; 
                        }else if ($enq->product_id == 169) {
                            $user_right = 186;
                        } 
                        $report_to = '';
                        if($this->session->companey_id == 57){

                            if (!empty($enq->email) || !empty($enq->phone)) {
                                $user_exist = $this->dashboard_model->check_user_by_mail_phone(array('email'=>$enq->email,'phone'=>$enq->phone));    
                            } 
                            $user_right = 200;
                            $report_to=$enq->created_by;
                            
                        }
                        $ucid    =   $this->session->companey_id;
                        
                        $postData = array(
                                's_display_name'  =>    $enq->name,
                                'last_name'       =>    $enq->lastname,  
                                's_user_email'    =>    $enq->email,
                                's_phoneno'       =>    $enq->phone,
                                'city_id'         =>    $enq->enquiry_city_id,
                                'state_id'        =>    $enq->enquiry_state_id,
                                'companey_id'     =>    $ucid,
                                'b_status'        =>    1,
                                'user_permissions'=>    $user_right,
                                'user_roles'      =>    $user_right,
                                'user_type'       =>    $user_right,                        
                                's_password'      =>    md5(12345678),
                                'report_to'       =>    $report_to
                            );
                        
                        if (!empty($user_exist->pk_i_admin_id)) {
                            
                            $this->db->where('tbl_admin.companey_id',57);
                            $this->db->where('tbl_admin.pk_i_admin_id',$user_exist->pk_i_admin_id);

                            if($this->db->update('tbl_admin',array('user_permissions'=>200,'user_roles'=>200,'user_type'=>200))){
                                $user_id = $user_exist->pk_i_admin_id;
                            }else{
                                $user_id = '';
                            }

                        }else{
                            $user_id    =   $this->user_model->create($postData);
                        }

                        $message = 'Email - '.$enq->email.'<br>Password - 12345678';                
                        $subject = 'Login Details';

                        if ($this->session->companey_id == 57 && $user_id) {
                            $this->db->where('temp_id',125);
                            $this->db->where('comp_id',57);
                            $temp_row    =   $this->db->get('api_templates')->row_array();
                            if (!empty($temp_row)) {
                                $subject = $temp_row['mail_subject'];   
                                $message = str_replace("@{email}",$enq->email,$temp_row['template_content']);   
                                $message = str_replace("@{password}",'12345678',$message);   
                            }
                         
                            $this->Message_models->send_email($enq->email,$subject,$message);

                            $this->db->where('temp_id',124);
                            $this->db->where('comp_id',57);
                            $temp_row    =   $this->db->get('api_templates')->row_array();
                            if (!empty($temp_row)) {                        
                                $message = str_replace("@{email}",$enq->email,$temp_row['template_content']);   
                                $message = str_replace("@{password}",'12345678',$message);   
                            }
                            $this->Message_models->smssend($enq->phone,$message);
                        }
                       // $msg .=    " And user created successfully";
                    }

                }
                 echo '1';
            }else{
                echo "Please Check Enquiry";
            }   
           
        } else {
            echo "Something Went Wrong";
        }
    }

     public function assign_rowdata() {
        
        if (!empty($_POST)) {
            
            $id = $this->input->post('datasource_name');
            
            $limit = '*';
            
            $move_enquiry =$this->enquiry_model->datasourcelist($id);
            
            $assign_employee = $this->input->post('assign_employee');
            
            $this->db->select('companey_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('pk_i_admin_id',$assign_employee);
                    $c_id= $this->db->get()->row();
            
            $postData=array();

            $change_status=array();
            $commentData = array();
            //print_r($move_enquiry);
            $adt = date("Y-m-d H:i:s");
            $ld_updt_by = $this->session->user_id;
            /*echo count($move_enquiry);
            exit();*/
            if (!empty($move_enquiry)) {
                $sendarr = array();
                
                foreach($move_enquiry as $res) {
                    $postData = array();
                    $enquiry_code = $res->Enquery_id;

                    $this->db->where('phone',$res->phone);
                    
                    if(!empty($res->product_id)){
                        $this->db->where('product_id',$res->product_id);
                    }
                    $this->db->where('email',$res->email);
                    $this->db->where('comp_id',$c_id->companey_id);                    
                    $res_phone = $this->db->get('enquiry')->result();
                    if(!empty($res_phone)){
                    }else{
                         $encode = $this->get_enquery_code();
                        // echo "id ".$encode;                        
                        $postData = array(
                            'Enquery_id' => $encode,
                            'comp_id' => $c_id->companey_id,
                            'email' => $res->email,
                            'phone' =>$res->phone,
                            'name_prefix' =>$res->name_prefix,
                            'name' => $res->name,
                            'lastname' => $res->lastname,
                            'enquiry' =>  $res->enquiry,
                            'enquiry_source' =>  $res->enquiry_source,
                            'enquiry_subsource' =>  $res->enquiry_subsource,
                            'address' =>  $res->address,
                            'company' =>  $res->org_name,
                            'checked' => 0,
                            'product_id' =>  $res->product_id,
                            'institute_id' => $res->institute_id,
                            'datasource_id' => $res->datasource_id,
                            'ip_address' =>  $res->ip_address,
                            'created_by' =>  $res->created_by,
                            'city_id' =>  $res->city_id,
                            'country_id'  => $res->country_id,
                            'state_id'  => $res->state_id,
                            'territory_id'=> $res->territory_id,
                            'region_id'=> $res->region_id,
                            'created_date' =>  $res->created_date,
                            'aasign_to'=>$assign_employee,
                            'assign_by'=> $this->session->user_id,
                            'status' => 1,
                            'drop_status' => 0,
                        );
                        
                        $commentData = array(
                            'lead_id'       =>$encode,
                            'created_date'  =>$adt,
                            'comment_msg'   =>'Raw Data Assigned',
                            'created_by'    =>$ld_updt_by
                        );

                        $sendarr[] = array( 
                                            "camp_name" => $res->product_name,
                                            "mobile"    => $res->phone);
            
                    }
                    $change_status    =   array(
                                            'status'=>3,
                                            'phone'=>$res->phone
                                        );                          
                
              
                if(!empty($postData)){    
                    $this->enquiry_model->update_tbleqry2($res->enquiry_id);                        
                    $this->db->insert('enquiry', $postData);
                    $lid=$this->db->insert_id();
                    $this->enquiry_model->update_tblextra($lid,$res->enquiry_id,$encode);
                    $this->db->insert('tbl_comment', $commentData);
                }
        }

        /* if($this->input->post('automated_call') == 1){
             $sendp = $this->curlpost($sendarr);
           }
        */
                        //$this->Leads_Model->add_comment_for_events('Row Data Assigned', $encode);

                $this->session->set_flashdata('message', display('save_successfully'));
                redirect(base_url() . 'lead/datasourcelist');
            }else {                 
                $this->session->set_flashdata('exception', display('please_try_again'));
                redirect(base_url() . 'lead/datasourcelist');
            }
        }
    }


     public function curlpost($sendarr=''){   

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://czadmin.c-zentrixcloud.com/apps/addlead_bulk.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>json_encode($sendarr),
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $this->db->insert('czentrix',array('comp_id'=>$this->session->companey_id,'res'=>$response,'created_by'=>$this->session->user_id));            
    }


    public function index() {
    //$this->output->enable_profiler(TRUE);

        if (user_role('60') == true) {}

        //$this->benchmark->mark('all_inq_start');    
                $data['all_enquery_num'] = $this->enquiry_model->all_enquery()->num_rows();
        //$this->benchmark->mark('all_inq_end');

    
        $data['user_list'] = $this->User_model->read();

        $data['title'] = display('enquiry_list');
    
        //$data['leadsource'] = $this->Leads_Model->get_leadsource_list();
    
        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
    
        //$data['lead_stages'] = $this->Leads_Model->get_leadstage_list();
    
        //$data['enquirys'] = $this->enquiry_model->read();
    
        //$data['state_list'] = $this->location_model->state_list();
    
        //$data['raw_enquery'] = $this->enquiry_model->raw_enquery();
    
    
        $data['all_drop_num'] = $this->enquiry_model->all_drop()->num_rows();
    
        $data['all_active'] = $this->enquiry_model->active_enqueries('0','*');
        
        $data['all_active_num'] = $data['all_active']->num_rows();
    
        //$data['unassigned'] = $this->enquiry_model->unassigned();
    
        //$data['all_leads'] = $this->enquiry_model->all_leads();
    
        //$data['all_user'] = $this->User_model->all_user();
    
        $data['all_today_update_num'] = $this->enquiry_model->all_today_update()->num_rows();
    
        $data['all_creaed_today_num'] = $this->enquiry_model->all_creaed_today()->num_rows();
    
        $data['drops'] = $this->Leads_Model->get_drop_list();
    
        //$data['checked_enquiry'] = $this->enquiry_model->checked_enquiry();
    
        //$data['unchecked_enquiry'] = $this->enquiry_model->unchecked_enquiry();
    
        //$data['scheduled'] = $this->enquiry_model->scheduled();
    
        //$data['unscheduled'] = $this->enquiry_model->unscheduled();
    
        //Total duplicate entry...
    
        //$data['dublicate'] = $this->enquiry_model->all_duplicate();
    
        //$data['customer_types'] = $this->enquiry_model->customers_types();
    
       // $data['channel_p_type'] = $this->enquiry_model->channel_partner_type_list();
    
        $data['content'] = $this->load->view('enquiry', $data, true);
    
        $this->load->view('layout/main_wrapper', $data);
    
    }

    public function send_sms() {
        $this->input->post('mesge_type');
        $this->db->where('temp_for', $for);
        $this->db->where('temp_addby', $this->session->companey_id);
        $res = $this->db->get('api_templates');
        $q = $res->result();
        foreach ($q as $value) {
            echo '<option value="' . $value->temp_id . '">' . $value->template_name . '<option>';
        }
    }

    function phone_check($phone)
    {
        $product_id    =   $this->input->post('product_id');                
        if($product_id){
            $query = $this->db->query("select phone from enquiry where product_id=$product_id AND phone=$phone");
            if ($query->num_rows()>0) {
                $this->form_validation->set_message('phone_check', 'The Mobile no field can not be dublicate in current process');
                return false;
            }else{
                return TRUE;
            }
        }else{
            $comp_id = $this->session->companey_id;
            $query = $this->db->query("select phone from enquiry where comp_id=$comp_id AND phone=$phone");                
            if ($query->num_rows()>0) {
                $this->form_validation->set_message('phone_check', 'The Mobile no field can not be dublicate');
                return false;
            }else{
                return TRUE;
            }
        }
    }

    function email_check($email)
    {
        $product_id    =   $this->input->post('product_id');                
        if($product_id){
            $query = $this->db->query("select email from enquiry where product_id=$product_id AND email = '$email'");
            if ($query->num_rows()>0) {
                $this->form_validation->set_message('email_check', 'The Email field can not be dublicate in current process');
                return false;
            }else{
                return TRUE;
            }
        }else{
            $comp_id = $this->session->companey_id;
            $query = $this->db->query("select phone from enquiry where comp_id=$comp_id AND email = '$email' ");                
            if ($query->num_rows()>0) {
                $this->form_validation->set_message('email_check', 'The Email field can not be dublicate');
                return false;
            }else{
                return TRUE;
            }
        }
    }


    public function create()
    {   
        //print_r($_POST);die;
        $process = $this->session->userdata('process');                 
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $data['title'] = display('new_enquiry');

        // $ruledata   = $this->db->select("*")->from("tbl_new_settings")->where('comp_id',$this->session->companey_id)->get()->row();
        // if($ruledata->duplicacy_status == 0)
        // { 
            
        //     if($ruledata->field_for_identification == 'email')
        //     {
        //         $this->form_validation->set_rules('email', display('email'), 'xss_clean|required|is_unique[enquiry.email]', array('is_unique'=>'Email already exist'));
        //     }
        //     elseif ($ruledata->field_for_identification == 'phone')
        //     {
        //        $this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|callback_phone_check|required', array('phone_check' => 'Duplicate Entry for phone'));
        //     }
        //     else
        //     {
        //         $this->form_validation->set_rules('email', display('email'), 'xss_clean|required|is_unique[enquiry.email]', array('is_unique'=>'Email already exist'));
        //         $this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|callback_phone_check|required', array('phone_check' => 'Duplicate Entry for phone'));
        //     }
        // }
        $this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|required');
        if(!empty($this->input->post('email')))
        {
            $this->form_validation->set_rules('email', display('email'), 'required');
        }

        $enquiry_date = $this->input->post('enquiry_date');
        if($enquiry_date !=''){
          $enquiry_date = date('d/m/Y');
        }else{
          $enquiry_date = date('d/m/Y');
        } 
       $city_id= $this->db->select("*")
            ->from("city")
            ->where('id',$this->input->post('city_id'))
            ->get();
        $other_phone = $this->input->post('other_no[]');
        $other_email = $this->input->post('other_email[]');

        if ($this->form_validation->run() === true) {
            
            if (empty($this->input->post('product_id'))) {
                $process_id    =   $this->session->process[0];                
            }else{
                $process_id    =   $this->input->post('product_id');
            }

            $name = $this->input->post('enquirername');
            
            $name_w_prefix = $name;            
            if($this->session->companey_id=='83'){
                $branch_code = $this->input->post('branch_name');
                $bnm = $this->db->where('id',$branch_code)->get('tbl_branch')->row();
                //print_r($bnm->b_name);exit;
                $branch=strtoupper($bnm->b_name);
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

            if($this->input->post('preferred_country')){
                 $preferred_country = implode(',',$this->input->post('preferred_country'));
            }else{
                $preferred_country = '';
            }


            //$encode = $this->get_enquery_code();
            if(!empty($other_phone)){
               $other_phone =   implode(',', $other_phone);
            }else{
                $other_phone = '';
            }

            if(!empty($other_email)){
               $other_email =   implode(',', $other_email);
            }else{
                $other_email = '';
            }
            $sourse = $this->input->post('lead_source');
            if($sourse=='new'){
                $data = array(
                'lead_name' => $this->input->post('new_agent'),
                'comp_id' => $this->session->userdata('companey_id')
                );

                $e_sourse = $this->Leads_Model->lead_sourceadd($data);
                $e_sourse = $e_sourse;
            }else{
                $e_sourse = $sourse;
            }
            $postData = [
                'Enquery_id' => $encode,
                'comp_id' => $this->session->userdata('companey_id'),
                'user_role' => $this->session->user_role,
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('mobileno', true),
                'other_phone'=> $other_phone,
                'other_email'=> $other_email,
                'name_prefix' => $this->input->post('name_prefix', true),
                'name' => $name_w_prefix,
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'reference_type' => $this->input->post('reference_type'),
                'reference_name' => $this->input->post('reference_name'),
                'enquiry' => $this->input->post('enquiry', true),
                'enquiry_source' => $e_sourse,
                'enquiry_subsource' => $this->input->post('sub_source'),
                'req_program' => $this->input->post('req_program'),
                'company' => $this->input->post('company'),
                'address' => $this->input->post('address'),
                'pin_code' => $this->input->post('pin_code'),
                'checked' => 0,
                'product_id' => $process_id,
                'institute_id' => $this->input->post('institute_id'),
                'datasource_id' => $this->input->post('datasource_id'),
                'center_id' => $this->input->post('center_id'),
                'ip_address' => $this->input->ip_address(),
                'created_by' => $this->session->user_id,
                'city_id' => !empty($city_id->row()->id)?$city_id->row()->id:'',
                'state_id' => !empty($city_id->row()->state_id)?$city_id->row()->state_id:'',
                'country_id'  =>!empty($city_id->row()->country_id)?$city_id->row()->country_id:'',
                'region_id'  =>!empty($city_id->row()->region_id)?$city_id->row()->region_id:'',
                'territory_id'  =>!empty($city_id->row()->territory_id)?$city_id->row()->territory_id:'',

                'branch_name' => $this->input->post('branch_name'),
                'in_take' => $this->input->post('in_take'),
                'qualification' => $this->input->post('qualification'),
                'experience' => $this->input->post('experience'),
                'residing_country' => $this->input->post('residing_country'),
                'nationality' => $this->input->post('nationality'),
                'preferred_country' => $preferred_country,
                'age' => $this->input->post('age'),
                'marital_status' => $this->input->post('marital_status'),
                'apply_person' => $this->input->post('apply_person'),
                'country_stayed' => $this->input->post('country_stayed'),
                'police_case' => $this->input->post('police_case'),
                'ban_country' => $this->input->post('ban_country'),
                'visa_type'   => $this->input->post('visa_type'),
                'code_prefix'   => $this->input->post('code_prefix'),
                //'created_date' =>$enquiry_date, 
                'status' => 1
            ];
           // print_r($postData);exit();
    $this->db->select('enquiry_id,drop_status');
    $this->db->or_where('phone',$this->input->post('mobileno', true));
    $this->db->or_where('email',$this->input->post('email', true));
    $res=$this->db->get('enquiry')->row();
    if(!empty($res->enquiry_id) && empty($res->drop_status)){

    $this->session->set_flashdata('exception', 'Same Credential Data Already Exist!');
    redirect(base_url() . 'enquiry/create');

    }else if(empty($res->enquiry_id) && empty($res->drop_status)){

        $insert_id    =   $this->enquiry_model->create($postData);

    }else if(!empty($res->enquiry_id) && !empty($res->drop_status)){

        $this->db->set('drop_status', '0');
        $this->db->set('drop_reason', '');
        $this->db->set('update_date', date('Y-m-d H:i:s'));
        $this->db->where('enquiry_id', $res->enquiry_id);
        $this->db->update('enquiry');
    $this->session->set_flashdata('message', 'Your Enquiry has been  Successfully Activated');
    redirect(base_url() . 'enquiry/view/'.$res->enquiry_id);

    }
            if ($this->input->post('apply_with')) {
                $course_apply = $this->Institute_model->readRowcrs($this->input->post('apply_with'));  
                $institute_data = array(                                
                        'institute_id'      => $course_apply->institute_id,
                        'course_id'         => $course_apply->crs_id,
                        'p_lvl'             => $course_apply->level_id, 
                        'p_disc'            => $course_apply->discipline_id,
                        'p_length'          => $course_apply->length_id,
                        't_fee'             => $course_apply->tuition_fees,
                        'ol_fee'            => '',
                        'enquery_code'      => $encode,
                        'application_url'   => '',
                        'major'             => '',
                        'user_name'         => '',
                        'password'          => '',
                        'app_status'        => 1,
                        'app_fee'           => '',
                        'transcript'        => '',
                        'lors'              => '',
                        'sop'               => '',
                        'cv'                => '',
                        'gre_gmt'           => '',
                        'toefl'             => '',
                        'remark'            => '',
                        'followup_comment'  => '',
                        'ref_no'            => '',
                        'courier_status'    => '',
                        'created_by'        => $this->session->user_id                                
                    );
                $ins    =   $this->db->insert('institute_data',$institute_data);                
            }
            $this->load->model('rule_model');
            $this->rule_model->execute_rules($encode,array(1,2,3,6,7));            
            if ($insert_id) {                
                $this->Leads_Model->add_comment_for_events($this->lang->line("enquery_create"), $encode);       
                if($this->input->is_ajax_request())
                {
                    echo json_encode(array('status'=>'success'));
                }
                else
                {
                    $this->session->set_flashdata('message', 'Your Enquiry has been  Successfully created');
                    redirect(base_url() . 'enquiry/view/'.$insert_id);
                }
                
            }
        } else {
            if($this->input->is_ajax_request())
            {
                echo json_encode(array('status'=>'fail','error'=>validation_errors()));
                exit();
            }
            $this->load->model('Dash_model', 'dash_model');
            $data['name_prefix'] = $this->enquiry_model->name_prefix_list();
            $user_role    =   $this->session->user_role;
            
            $data['products'] = $this->dash_model->get_user_product_list();
            $data['product_contry'] = $this->location_model->productcountry();
            $data['institute_list'] = $this->Institute_model->institutelist();
            $data['datasource_list'] = $this->Datasource_model->datasourcelist();
            $data['datasource_lists'] = $this->Datasource_model->datasourcelist2();
            $data['subsource_list'] = $this->Datasource_model->subsourcelist();
            $data['center_list'] = $this->Center_model->all_center();
            $data['state_list'] = $this->location_model->estate_list();
            $data['city_list'] = $this->location_model->ecity_list();
            $data['country_list'] = $this->location_model->ecountry_list();
            $data['all_branch'] = $this->Leads_Model->branch_select();
             //print_r($data['all_branch']);exit();
            $data['process_id'] = 0;            
            if (is_array($process)) {                
                if(count($process) == 1){
                    $data['invalid_process'] = 0;                    
                    $data['process_id'] = $process[0];
                }else{
                    $data['invalid_process'] = 1;                    
                }                
            }else{
                $data['invalid_process'] = 1;
            }
            
            if (!(user_access(230) || user_access(231) ||user_access(232) ||user_access(233) ||user_access(234) ||user_access(235) ||user_access(236))) {
                $data['invalid_process'] = 0;                                    
            }
//TELEPHONY NEW MOBILE CREATE USER
if(!empty($this->uri->segment(3))){
    $data['mobi'] = base64_decode($this->uri->segment(3));
  }else{
    $data['mobi'] = '';
  }
//TELEPHONY NEW MOBILE CREATE USER
            $data['content'] = $this->load->view('add-equiry1', $data, true);                
            $this->load->view('layout/main_wrapper', $data);
        }

    }

    public function apply_to_course(){
        $crs_id          =   $this->input->post('id');
        $enquiry_code    =   $this->input->post('enquiry_code');
        $status = 0;
        if ($crs_id && $enquiry_code) {
            $course_apply = $this->Institute_model->readRowcrs($crs_id);  
            $institute_data = array(                                
                    'institute_id'      => $course_apply->institute_id,
                    'course_id'         => $course_apply->crs_id,
                    'p_lvl'             => $course_apply->level_id, 
                    'p_disc'            => $course_apply->discipline_id,
                    'p_length'          => $course_apply->length_id,
                    't_fee'             => $course_apply->tuition_fees,
                    'ol_fee'            => '',
                    'enquery_code'      => $enquiry_code,
                    'application_url'   => '',
                    'major'             => '',
                    'user_name'         => '',
                    'password'          => '',
                    'app_status'        => 1,
                    'app_fee'           => '',
                    'transcript'        => '',
                    'lors'              => '',
                    'sop'               => '',
                    'cv'                => '',
                    'gre_gmt'           => '',
                    'toefl'             => '',
                    'remark'            => '',
                    'followup_comment'  => '',
                    'ref_no'            => '',
                    'courier_status'    => '',
                    'created_by'        => $this->session->user_id                                
                );
            $ins    =   $this->db->insert('institute_data',$institute_data);    
            if ($ins) {
                $status = 1;
            }            
        }
        echo $status;
    }
    public function create2(){
        $process = $this->session->userdata('process');
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $data['title'] = display('new_enquiry');
        $this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|required', array('is_unique' => 'Duplicate   entry for phone'));
        $enquiry_date = $this->input->post('enquiry_date');
        if($enquiry_date !=''){
          $enquiry_date = date('d/m/Y');
        }else{
          $enquiry_date = date('d/m/Y');
        } 
        $city_id= $this->db->select("*")
            ->from("city")
            ->where('id',$this->input->post('city_id'))
            ->get();
        $other_phone = $this->input->post('other_no[]');
        $other_email = $this->input->post('other_email[]');
        if ($this->form_validation->run() === true) {
           $name = $this->input->post('enquirername');
            $name_w_prefix = $name;
            $encode = $this->get_enquery_code();
            if(!empty($other_phone)){
               $other_phone =   implode(',', $other_phone);
            }else{
                $other_phone = '';
            }

            if(!empty($other_email)){
               $other_email =   implode(',', $other_email);
            }else{
                $other_email = '';
            }
            $postData = [
                'Enquery_id' => $encode,
                'user_role' => $this->session->user_role,
                'comp_id' => $this->session->userdata('companey_id'),
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('mobileno', true),
                'other_phone'=> $other_phone,
                'other_email'=> $other_email,
                'name_prefix' => $this->input->post('name_prefix', true),
                'name' => $name_w_prefix,
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'reference_type' => $this->input->post('reference_type'),
                'reference_name' => $this->input->post('reference_name'),
                'enquiry' => $this->input->post('enquiry', true),
                'enquiry_source' => $this->input->post('lead_source'),
                'enquiry_subsource' => $this->input->post('sub_source'),
                'company' => $this->input->post('company'),
                'address' => $this->input->post('address'),
                'checked' => 0,
                'product_id' => $this->input->post('product_id'),
                'institute_id' => $this->input->post('institute_id'),
                'datasource_id' => $this->input->post('datasource_id'),
                'center_id' => $this->input->post('center_id'),
                'ip_address' => $this->input->ip_address(),
                'created_by' => $this->session->user_id,
                'city_id' => $city_id->row()->id,
                'state_id' => $city_id->row()->state_id,
                'country_id'  =>$city_id->row()->country_id,
                'region_id'  =>$city_id->row()->region_id,
                'territory_id'  =>$city_id->row()->territory_id,
                'status' => 1
            ];
            if ($this->enquiry_model->create($postData)) {
                $coment_type = 1;
                $lead_id = $this->input->post('unique_no');
                $stage_id = $this->input->post('lead_stage');
                $stage_date = date("d-m-Y",strtotime($this->input->post('c_date')));                
                $stage_time = date("H:i:s",strtotime($this->input->post('c_time')));
                $stage_desc = $this->input->post('lead_description');
                $stage_remark = $this->input->post('conversation');
                $contact_person = $this->input->post('contact_person1');
                $mobileno = $this->input->post('mobileno1');
                $email = $this->input->post('email1');
                $designation = $this->input->post('designation1');
                $this->db->set('lead_stage', $stage_id);
                $this->db->set('lead_discription', $stage_desc);
                $this->db->set('lead_discription_reamrk', $stage_remark);
                $this->db->where('enquiry_id', $insert_id);
                $this->db->update('enquiry');
                $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
                $this->Leads_Model->add_comment_for_events_stage('Stage Updated', $encode,$stage_id,$stage_desc,$stage_remark,$coment_type);
                if($stage_desc == 'updt'){                
                    $tid    =   $this->input->post('latest_task_id');
                    $this->db->set('task_date', $stage_date);
                    $this->db->set('task_time', $stage_time);
                    $this->db->set('task_remark', $stage_remark);
                    $this->db->where('resp_id',$tid);
                    $this->db->update('query_response');
                }else{                
                    if (!empty($this->input->post('c_date'))) {
                        $this->Leads_Model->add_comment_for_events_popup($stage_remark,$stage_date,$contact_person,$mobileno,$email,$designation,$stage_time,$encode);                
                    }
                }
                $this->Leads_Model->add_comment_for_events($this->lang->line("enquery_create"), $encode);               
                $this->session->set_flashdata('message', 'Your Enquiry has been  Successfully created');
                redirect(base_url() . 'enquiry');
          }
        } else {
            $this->load->model('Dash_model', 'dash_model');
            $user_role    =   $this->session->user_role;
            $data['company_list'] = $this->location_model->get_company_list($process);
            $data['products'] = $this->dash_model->get_user_product_list();
            $data['stagelist_withoutpro'] = $this->Leads_Model->get_leadstage_withoutprocess();
            $data['taskstatus_list'] = $this->Taskstatus_model->taskstatuslist();
            $data['content'] = $this->load->view('add-enqform', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }

    }

    public function create1() {
        $process = $this->session->userdata('process');
        // print_r($process);
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $data['title'] = display('new_enquiry');
        $this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|callback_phone_check|required', array('phone_check' => 'Duplicate entry for phone'));
        
        $enquiry_date = $this->input->post('enquiry_date');
        if($enquiry_date !=''){
          $enquiry_date = date('d/m/Y');
        }else{
          $enquiry_date = date('d/m/Y');
        } 
       $city_id= $this->db->select("*")
            ->from("city")
            ->where('id',$this->input->post('city_id'))
            ->get();
        $other_phone = $this->input->post('other_no[]');
        $other_email = $this->input->post('other_email[]');
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('product_id'))) {
                $process_id    =   $this->session->process[0];                
            }else{
                $process_id    =   $this->input->post('product_id');
            }
            $name = $this->input->post('enquirername');
            $name_w_prefix = $name;
            $encode = $this->get_enquery_code();
            if(!empty($other_phone)){
               $other_phone =   implode(',', $other_phone);
            }else{
                $other_phone = '';
            }
            if(!empty($other_email)){
               $other_email =   implode(',', $other_email);
            }else{
                $other_email = '';
            }
            $postData = [
                'Enquery_id' => $encode,
                'comp_id' => $this->session->userdata('companey_id'),
                'user_role' => $this->session->user_role,
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('mobileno', true),
                'other_phone'=> $other_phone,
                'other_email'=> $other_email,
                'name_prefix' => $this->input->post('name_prefix', true),
                'name' => $name_w_prefix,
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'reference_type' => $this->input->post('reference_type'),
                'reference_name' => $this->input->post('reference_name'),
                'enquiry' => $this->input->post('enquiry', true),
                'enquiry_source' => $this->input->post('lead_source'),
                'enquiry_subsource' => $this->input->post('sub_source'),
                'company' => $this->input->post('company'),
                'address' => $this->input->post('address'),
                'checked' => 0,
                'product_id' => $process_id,
                'institute_id' => $this->input->post('institute_id'),
                'datasource_id' => $this->input->post('datasource_id'),
                'center_id' => $this->input->post('center_id'),
                'ip_address' => $this->input->ip_address(),
                'created_by' => $this->session->user_id,
                'city_id' => $city_id->row()->id,
                'state_id' => $city_id->row()->state_id,
                'country_id'  =>$city_id->row()->country_id,
                'region_id'  =>$city_id->row()->region_id,
                'territory_id'  =>$city_id->row()->territory_id,
                //'created_date' =>$enquiry_date, 
                'status' => 1
            ];
            if ($this->enquiry_model->create($postData)) {
                $insert_id = $this->db->insert_id();
                $this->Leads_Model->add_comment_for_events($this->lang->line("enquery_create"), $encode);               
               
                $this->session->set_flashdata('message', 'Your Onboarding has been  Successfully created');
                redirect(base_url() . 'enquiry/view/'.$insert_id);
            }
        } else {
            $this->load->model('Dash_model', 'dash_model');
            $data['name_prefix'] = $this->enquiry_model->name_prefix_list();
            $user_role    =   $this->session->user_role;
            
            $data['products'] = $this->dash_model->get_user_product_list();
            $data['product_contry'] = $this->location_model->productcountry();
            $data['institute_list'] = $this->Institute_model->institutelist();
            $data['datasource_list'] = $this->Datasource_model->datasourcelist();
            $data['datasource_lists'] = $this->Datasource_model->datasourcelist2();
            $data['subsource_list'] = $this->Datasource_model->subsourcelist();
            $data['center_list'] = $this->Center_model->all_center();
            $data['state_list'] = $this->location_model->estate_list();
            $data['city_list'] = $this->location_model->ecity_list();
            $data['country_list'] = $this->location_model->ecountry_list();
            // print_r($data['company_list']);exit();
            $data['content'] = $this->load->view('add-equiry', $data, true);

            $this->load->view('layout/main_wrapper', $data);
        }
    }

    public function attach_po($enquiry_id = null) {
        $data['page_title'] = 'PO';
        $data['title'] = 'Attach PO';
        $data['enquiry_id'] = base64_decode($enquiry_id);
        $data['state_list'] = $this->location_model->state_list();
        $data['content'] = $this->load->view('attach_po', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
     function get_sub_byid() {

        $sub_id = $this->input->post('lead_source');
        $data['sub'] = $this->Datasource_model->get_sub_byid($sub_id);
        echo '<option value="" style="display:none">---Select subsource---</option>';
        foreach ($data['sub'] as $r) {
            echo '<option value="' . $r->subsource_id . '">' . $r->subsource_name . '</option>';
        }
    }
    function get_sub_byid1() {

        $sub_id = $this->input->post('sid');
        $data['sub'] = $this->Datasource_model->get_sub_byid($sub_id);
        echo '<option value="" style="display:none">---Select subsource---</option>';
        foreach ($data['sub'] as $r) {
            echo '<option value="' . $r->subsource_id . '">' . $r->subsource_name . '</option>';
        }
    }

    public function attach_network($enquiry_id = null) {
        $data['page_title'] = 'Layout Sheet';
        $data['title'] = 'Layout Sheet';
        $data['enquiry_id'] = base64_decode($enquiry_id);
        $data['state_list'] = $this->location_model->state_list();
        $data['content'] = $this->load->view('network_diagram', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function add_invoice($enquiry_id = null) {
        $data['page_title'] = 'Add Inovice';
        $data['title'] = 'Add Inovice';
        $data['enquiry_id'] = base64_decode($enquiry_id);
        $data['state_list'] = $this->location_model->state_list();
        $data['content'] = $this->load->view('invoice_add', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }


   /* public function autoDial()
    {
        $allenquiry = $this->input->post('enquiry_id[]');
        $enq = implode(",", $allenquiry);
        $res = $this->db->query("SELECT `phone` FROM `enquiry` WHERE enquiry_id IN ( $enq )");
        $phoneArr = $res->result_array();

        // $phone           = $this->input->post("phone_no");
        // $token           = $this->input->post("token");
        // $support_user_id = $this->input->post("support_user_id");
        //$url             = "https://developers.myoperator.co/clickOcall";
        // $data = array(
        //   'token'=>,
        //   'customer_number'=>$phone,
        //   'customer_cc'=>91,
        //   'support_user_id'=>$this->session->telephony_agent_id,
        // );
        foreach ($phoneArr as $key => $value) 
        {
            
        
        $curl = curl_init();
          curl_setopt_array($curl, array(  CURLOPT_URL => "https://obd-api.myoperator.co/obd-api-v1",
          CURLOPT_RETURNTRANSFER => true,  CURLOPT_CUSTOMREQUEST => "POST", 
          CURLOPT_POSTFIELDS =>'{  "company_id": "5f1545a391ac6734", 
          "secret_token": "ff0bda40cbdb92a4f1eb7851817de3510a175345a16c59a9d98618a559019f73", 
          "type": "1", 
            "user_id": "'.$this->session->telephony_agent_id.'",
            "number": "+91'.$value['phone'].'",   
            "public_ivr_id":"5f16e49954ad3197", 
            "reference_id": "",  
            "region": "",
            "caller_id": "",  
            "group": ""   }', 
            CURLOPT_HTTPHEADER => array(    "x-api-key:oomfKA3I2K6TCJYistHyb7sDf0l0F6c8AZro5DJh", 
            "Content-Type: application/json"  ),));
            $response = curl_exec($curl);
        
        // print_r($response);
      
        // $this->db->select('phone');
        // $this->db->from('enquiry');
        // $this->db->where('enquiry_id IN',"( ".$enq." )");
        // $arr = $this->db->get()->result_array();
        print_r($response);
        }
    }*/

    public function autoDial()
    {
        $allenquiry = $this->input->post('enquiry_id[]');
        $enq = implode(",", $allenquiry);
        $res = $this->db->query("SELECT aasign_to,phone FROM `enquiry` WHERE enquiry_id IN ( $enq )");
        $phoneArr = $res->result_array();

        // $phone           = $this->input->post("phone_no");
        // $token           = $this->input->post("token");
        // $support_user_id = $this->input->post("support_user_id");
        //$url             = "https://developers.myoperator.co/clickOcall";
        // $data = array(
        //   'token'=>,
        //   'customer_number'=>$phone,
        //   'customer_cc'=>91,
        //   'support_user_id'=>$this->session->telephony_agent_id,
        // );
        foreach ($phoneArr as $key => $value) 
        {$assignto=$value['aasign_to'];
         if(!empty($assignto)){
            $this->db->select('telephony_agent_id');
            $this->db->from('tbl_admin');
            $this->db->where('pk_i_admin_id',$assignto);  
            $user= $this->db->get()->row(); 
            $user_id=$user->telephony_agent_id;
             $public_ivr_id=$user->public_ivr_id;
            }else{
            $user_id=$this->session->telephony_agent_id;
             $this->db->where('telephony_agent_id',$user_id);
              $res=$this->db->get('tbl_admin')->row();
              if(!empty($res)){
               $public_ivr_id= $res->public_ivr_id;
              }
            }
        $curl = curl_init();
          curl_setopt_array($curl, array(  CURLOPT_URL => "https://obd-api.myoperator.co/obd-api-v1",
          CURLOPT_RETURNTRANSFER => true,  CURLOPT_CUSTOMREQUEST => "POST", 
          CURLOPT_POSTFIELDS =>'{  "company_id": "5f1545a391ac6734", 
          "secret_token": "ff0bda40cbdb92a4f1eb7851817de3510a175345a16c59a9d98618a559019f73", 
          "type": "1", 
            "user_id": "'.$user_id.'",
            "number": "+91'.$value['phone'].'",   
            "public_ivr_id":"'.$public_ivr_id.'", 
            "reference_id": "",  
            "region": "",
            "caller_id": "",  
            "group": ""   }', 
            CURLOPT_HTTPHEADER => array(    "x-api-key:oomfKA3I2K6TCJYistHyb7sDf0l0F6c8AZro5DJh", 
            "Content-Type: application/json"  ),));
            $response = curl_exec($curl);
        
        // print_r($response);
      
        // $this->db->select('phone');
        // $this->db->from('enquiry');
        // $this->db->where('enquiry_id IN',"( ".$enq." )");
        // $arr = $this->db->get()->result_array();
     
   print_r($response);
        }
    }

    public function assign_enquiry() {

        if (!empty($_POST)) {
            $move_enquiry = $this->input->post('enquiry_id[]');
           // echo json_encode($move_enquiry);
            $assign_employee = $this->input->post('assign_employee');
            $assign_dept = $this->input->post('branch_dept');
            $assign_branch = $this->input->post('branch_name');
            $user = $this->User_model->read_by_id($assign_employee);
            $notification_data=array();$assign_data=array();
            if (!empty($move_enquiry)) {
                foreach ($move_enquiry as $key) {
                    $data['enquiry'] = $this->enquiry_model->enquiry_by_id($key);
                    $enquiry_code = $data['enquiry']->Enquery_id;
                   // $this->enquiry_model->assign_enquery($key, $assign_employee, $enquiry_code);
                  $assign_data[]=array('aasign_to'=> $assign_employee,
                        'assign_dept'=>$assign_dept,
                        'assign_branch'=>$assign_branch,
                        'assign_by'=>$this->session->user_id,
                        'update_date'=>date('Y-m-d H:i:s'),
                        'enquiry_id'=>$key);
                        $notification_data[]=array('assign_to'=>$assign_employee,
                        'assign_by'=> $this->session->user_id,
                        'assign_date'=>date('Y-m-d H:i:s'),
                        'untouch'=>'1',
                        'enq_id'=> $key,
                        'enq_code'=>$enquiry_code,
                        'assign_status'=> 0);
                        $this->Leads_Model->add_comment_for_events($this->lang->line("enquery_assign") , $enquiry_code);
//For update all assign id Start
if(!empty($assign_employee)){
            $this->db->select('all_assign');
            $this->db->where('enquiry_id',$key);
            $res=$this->db->get('enquiry');
            $q=$res->row();
            $z=array();$new=array();$allid=array();
                 $z = explode(',',$q->all_assign);
                 $new[]=$assign_employee;
                $allid = array_unique (array_merge ($z, $new));
                //print_r($allid);exit; 
                $string_id=implode(',',$allid);
                
                $this->db->set('all_assign', $string_id);
$this->db->where('enquiry_id',$key);
$this->db->update('enquiry');                         
            }
//For update all assign id End
                }
                $this->db->update_batch('enquiry',$assign_data,'enquiry_id');
                $this->db->insert_batch('tbl_assign_notification',$notification_data);
// Bell Notification Start
                $bell_data[]=array(
                        //'query_id'=> $enquiry_code,
                        'subject'=>'Onboarding Assigned',
                        'create_by'=>$this->session->user_id,
                        'task_date'=>date('d-m-Y'),
                        'task_time'=>date('h:i:s'),
                        'task_remark'=>'New ('.count($move_enquiry).') Onboardings Assigned To You! Go To List And Check There.',
                        'related_to'=>$assign_employee
                    );
                $this->db->insert_batch('query_response',$bell_data);
// Bell Notification End
                echo display('save_successfully');
            } else {
                echo display('please_try_again');
            }
        }
    }


    public function mark_all_tags() {

        if (!empty($_POST)) {
            $tags = $this->input->post('tags[]');
            $enqcd = $this->input->post('enqcd');

            if (!empty($enqcd)) {

//For update all tag id Start
$this->db->select('tag_ids,enq_id');
$this->db->from('enquiry_tags');
$this->db->where('enq_id',$enqcd);
$res=$this->db->get()->row();
if(!empty($res->enq_id)){
            $z=array();$new=array();$allid=array();
                if(!empty($res->tag_ids)){
                 $z = explode(',',$res->tag_ids);
                }
                 $new=$tags;
                $allid = array_unique (array_merge ($z, $new)); 
                $string_id=implode(',',$allid);
                $this->db->set('tag_ids', $string_id);
$this->db->where('enq_id',$enqcd);
$this->db->update('enquiry_tags');                         
            }else{
                $new=$tags;
                $string_id=implode(',',$new);

                $tag_data =array(
                        'tag_ids'=>$string_id,
                        'enq_id'=>$enqcd,
                        'comp_id'=>$this->session->userdata('companey_id'),
                        'marked_by'=>$this->session->user_id,
                    );
                $this->db->insert('enquiry_tags',$tag_data);
            }
//For update all tag id End

//For Rule Notification
$this->db->where('enquiry_id',$enqcd);
$this->db->set('tag_status',$string_id);
$this->db->update('enquiry');
$enquery_id = $this->db->where(array('enquiry_id'=>$enqcd))->get('enquiry')->row()->Enquery_id;
$this->load->model('rule_model');
$this->rule_model->execute_rules($enquery_id,array(1,2,3,6,7,12));


                echo display('save_successfully');
            } else {
                echo display('please_try_again');
            }
        }
    }

    public function get_assigned() {
        $res = $this->enquiry_model->get_assigned();
        $resultSet = array();
        if ($res) {
            $resultSet = $res->result();
        }
        echo json_encode($resultSet);
    }

    public function enquery_detals_by_status($id = '') {

        /*
        if ($id > 0 and $id <= 20) {
            $serach_key = '';
        } else {
            $id2 = urldecode($id);
            $serach_key = explode('_', $id2);
        }
        */
//print_r($id2);exit;
        
        //$data['title'] = display('enquiry_list');
        
        $data['user_list'] = $this->User_model->read();
        
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        
        //$data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        
        //$data['lead_stages'] = $this->Leads_Model->get_leadstage_list();
        
        //$data['customer_types'] = $this->enquiry_model->customers_types();
        
        //$data['channel_p_type'] = $this->enquiry_model->channel_partner_type_list();
        
        $data['all_user'] = $this->User_model->all_user();
        
        if ($id == 1) {
        
            $data['all_active'] = $this->enquiry_model->all_creaed_today();
        
        } elseif ($id == 2) {
        
            $data['all_active'] = $this->enquiry_model->all_today_update();
        
        } elseif ($id == 3) {
            
            $data['all_active'] = $this->enquiry_model->active_enqueries();
            
            //echo "<pre>";
            //echo 'fffffffffffffff'.$id;
            //print_r($data['all_active']->result());
            
            //exit();
            
        } elseif ($id == 4) {
            //$data['all_active'] = $this->enquiry_model->all_leads();
        } elseif ($id == 5) {
            $data['all_active'] = $this->enquiry_model->all_drop();
        } elseif ($id == 6) {
            $data['all_active'] = $this->enquiry_model->all_enquery();
        } elseif ($id == 7) {
            //$data['all_active'] = $this->enquiry_model->checked_enquiry();
        } elseif ($id == 8) {
            //$data['all_active'] = $this->enquiry_model->unchecked_enquiry();
        } elseif ($id == 9) {
            //$data['all_active'] = $this->enquiry_model->scheduled();
        } elseif ($id == 10) {
            //$data['all_active'] = $this->enquiry_model->unscheduled();
        } elseif ($id == 11) {
            //$data['dublicate'] = $this->enquiry_model->all_duplicate();
        } elseif (!empty($serach_key[1]) == 2) {
            //$data['all_active'] = $this->enquiry_model->search_data($serach_key[0]);
        } else {
            $data['all_active'] = $this->enquiry_model->all_creaed_today();
        }
        
        $data['get_sent_whats_app'] = $this->enquiry_model->get_sent_whats_app();
        
        $data['get_received_whats_app'] = $this->enquiry_model->get_received_whats_app();
        
        $data['state_list'] = $this->location_model->state_list();
        
        $data['city_list'] = $this->location_model->city_list();
        
        $data['drops'] = $this->Leads_Model->get_drop_list();
        
        $this->load->view('enquiry_list', $data);
    }

    public function view1($enquiry_id = null) {
        if (user_role('63') == true) {            
        }
        $data['title'] = display('information');

        if (!empty($_POST)) {
            $name = $this->input->post('enquirername');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobileno');
            $lead_source = $this->input->post('lead_source');
            $enquiry = $this->input->post('enquiry');
            $en_comments = $this->input->post('enqCode');
            $company = $this->input->post('company');
            $address = $this->input->post('address');
            $name_prefix = $this->input->post('name_prefix');
            $this->db->set('country_id', $this->input->post('country_id'));
            $this->db->set('product_id', $this->input->post('product_id'));
            $this->db->set('institute_id', $this->input->post('institute_id'));
            $this->db->set('datasource_id', $this->input->post('datasource_id'));
            $this->db->set('phone', $mobile);
            $this->db->set('enquiry_subsource',$this->input->post('sub_source'));
            $this->db->set('email', $email);
            $this->db->set('company', $company);
            $this->db->set('address', $address);
            $this->db->set('name_prefix', $name_prefix);
            $this->db->set('name', $name);
            $this->db->set('enquiry_source', $lead_source);
            $this->db->set('enquiry', $enquiry);
            $this->db->set('coment_type',1);
            $this->db->set('lastname', $this->input->post('lastname'));
            $this->db->where('enquiry_id', $enquiry_id);
            $this->db->update('enquiry');
            $this->Leads_Model->add_comment_for_events('Onboarding Updated', $en_comments);
            $this->session->set_flashdata('message', 'Save successfully');
            redirect('enquiry/view/' . $enquiry_id);
        }
        
        
       
        
        
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);   

        //$data['state_city_list'] = $this->location_model->get_city_by_state_id($data['details']->enquiry_state_id);
        //$data['state_city_list'] = $this->location_model->ecity_list();



        $data['allleads'] = $this->Leads_Model->get_leadList();
        if (!empty($data['details'])) {
            $lead_code = $data['details']->Enquery_id;
        }        
        $data['check_status'] = $this->Leads_Model->get_leadListDetailsby_code($lead_code);       
        $data['all_drop_lead'] = $this->Leads_Model->all_drop_lead();
        $data['products'] = $this->dash_model->get_user_product_list(); 

        $data['allcountry_list'] = $this->Taskstatus_model->countrylist();
        $data['allstate_list'] = $this->Taskstatus_model->statelist();
        $data['allcity_list'] = $this->Taskstatus_model->citylist();
        $data['personel_list'] = $this->Taskstatus_model->peronellist($enquiry_id);        
        $data['kyc_doc_list'] = $this->Kyc_model->kyc_doc_list($lead_code);        
        $data['education_list'] = $this->Education_model->education_list($lead_code);
        $data['social_profile_list'] = $this->SocialProfile_model->social_profile_list($lead_code);        
        $data['close_femily_list'] = $this->Closefemily_model->close_femily_list($lead_code);
        $data['all_country_list'] = $this->location_model->country();
        $data['all_contact_list'] = $this->location_model->contact($enquiry_id);                
        $data['subsource_list'] = $this->Datasource_model->subsourcelist();
        $data['drops'] = $this->Leads_Model->get_drop_list();
        $data['name_prefix'] = $this->enquiry_model->name_prefix_list();
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        $data['enquiry'] = $this->enquiry_model->enquiry_by_id($enquiry_id);
        $data['lead_stages'] = $this->Leads_Model->get_leadstage_list();
        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $enquiry_code = $data['enquiry']->Enquery_id;
        $phone_id = '91'.$data['enquiry']->phone;        
        $data['recent_tasks'] = $this->Task_Model->get_recent_taskbyID($enquiry_code);        
        $data['comment_details'] = $this->Leads_Model->comment_byId($enquiry_code);        
        $user_role    =   $this->session->user_role;
        $data['country_list'] = $this->location_model->productcountry();

        $data['institute_list'] = $this->Institute_model->institutelist_by_country($data['details']->enq_country);
        
        $data['institute_app_status'] = $this->Institute_model->get_institute_app_status();
        

        $data['datasource_list'] = $this->Datasource_model->datasourcelist();
        $data['taskstatus_list'] = $this->Taskstatus_model->taskstatuslist();
        $data['state_list'] = $this->location_model->estate_list();
        $data['city_list'] = $this->location_model->ecity_list();
        $data['product_contry'] = $this->location_model->productcountry();
        $data['get_message'] = $this->Message_models->get_chat($phone_id);
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        $data['all_estage_lists'] = $this->Leads_Model->find_estage($enquiry_id);

        $data['institute_data'] = $this->enquiry_model->institute_data($data['details']->Enquery_id);
        $data['dynamic_field']  = $this->enquiry_model->get_dyn_fld($enquiry_id);
        

        $data['content'] = $this->load->view('enquiry_details', $data, true);
        $this->enquiry_model->assign_notification_update($enquiry_code);
        $this->load->view('layout/main_wrapper', $data);
    }




    public function view($enquiry_id = null) {

        
        $compid = $this->session->userdata('companey_id');

        if (user_role('63') == true) {            
        }
        $data['title'] = 'Onboarding Details';

        if (!empty($_POST)) {
            $name = $this->input->post('enquirername');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobileno');
            $lead_source = $this->input->post('lead_source');
            $enquiry = $this->input->post('enquiry');
            $en_comments = $this->input->post('enqCode');
            $company = $this->input->post('company');
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $name_prefix = $this->input->post('name_prefix');
            $this->db->set('country_id', $this->input->post('country_id'));
            $this->db->set('product_id', $this->input->post('product_id'));
            $this->db->set('institute_id', $this->input->post('institute_id'));
            $this->db->set('datasource_id', $this->input->post('datasource_id'));
            $this->db->set('phone', $mobile);
            $this->db->set('enquiry_subsource',$this->input->post('sub_source'));
            $this->db->set('email', $email);
            $this->db->set('company', $company);
            $this->db->set('address', $address);
            $this->db->set('pin_code', $pin_code);
            $this->db->set('name_prefix', $name_prefix);
            $this->db->set('name', $name);
            $this->db->set('enquiry_source', $lead_source);
            $this->db->set('enquiry', $enquiry);
            $this->db->set('coment_type',1);
            $this->db->set('lastname', $this->input->post('lastname'));
            $this->db->set('branch_name', $this->input->post('branch_name'));
            $this->db->set('in_take', $this->input->post('in_take'));
            $this->db->set('residing_country', $this->input->post('residing_country'));
            $this->db->set('nationality', $this->input->post('nationality'));
            $this->db->set('preferred_country', $this->input->post('preferred_country'));
            $this->db->set('age', $this->input->post('age'));
            $this->db->set('marital_status', $this->input->post('marital_status'));
            $this->db->set('apply_person', $this->input->post('apply_person'));
            $this->db->set('country_stayed', $this->input->post('country_stayed'));
            $this->db->set('police_case', $this->input->post('police_case'));
            $this->db->set('ban_country', $this->input->post('ban_country'));
            $this->db->set('visa_type', $this->input->post('visa_type'));
            $this->db->where('enquiry_id', $enquiry_id);
            $this->db->update('enquiry');
            $this->Leads_Model->add_comment_for_events('Onboarding Updated', $en_comments);
            $this->session->set_flashdata('message', 'Save successfully');
            redirect('enquiry/view/' . $enquiry_id);
        }

        $this->db->set('untouch', '0');
        $this->db->where('enq_id', $enquiry_id);
        $this->db->where('assign_to', $this->session->user_id);
        $this->db->update('tbl_assign_notification');
        
        
       
        
        
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);   
        
        //$data['state_city_list'] = $this->location_model->get_city_by_state_id($data['details']->enquiry_state_id);
        //$data['state_city_list'] = $this->location_model->ecity_list();



        $data['allleads'] = $this->Leads_Model->get_leadList();
        if (!empty($data['details'])) {
            $lead_code = $data['details']->Enquery_id;
        }        
        $data['check_status'] = $this->Leads_Model->get_leadListDetailsby_code($lead_code);       
        $data['all_drop_lead'] = $this->Leads_Model->all_drop_lead();
        $data['products'] = $this->dash_model->get_user_product_list(); 
         $data['bank_list'] = $this->dash_model->get_bank_list(); 

        $data['allcountry_list'] = $this->Taskstatus_model->countrylist();
        $data['allstate_list'] = $this->Taskstatus_model->statelist();
        $data['allcity_list'] = $this->Taskstatus_model->citylist();
        //$data['personel_list'] = $this->Taskstatus_model->peronellist($enquiry_id);        
        //$data['kyc_doc_list'] = $this->Kyc_model->kyc_doc_list($lead_code);        
        //$data['education_list'] = $this->Education_model->education_list($lead_code);
        //$data['social_profile_list'] = $this->SocialProfile_model->social_profile_list($lead_code);        
        //$data['close_femily_list'] = $this->Closefemily_model->close_femily_list($lead_code);
        $data['all_country_list'] = $this->location_model->country();
        $data['all_contact_list'] = $this->location_model->contact($enquiry_id);                
        $data['subsource_list'] = $this->Datasource_model->subsourcelist();
        $data['drops'] = $this->Leads_Model->get_drop_list();
        $data['name_prefix'] = $this->enquiry_model->name_prefix_list();
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        $data['enquiry'] = $this->enquiry_model->enquiry_by_id($enquiry_id);
        $data['lead_stages'] = $this->Leads_Model->get_leadstage_list();
        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $enquiry_code = $data['enquiry']->Enquery_id;
        $phone_id = '91'.$data['enquiry']->phone;        
        $data['recent_tasks'] = $this->Task_Model->get_recent_taskbyID($enquiry_code);        
               
        $user_role    =   $this->session->user_role;
        $data['country_list'] = $this->location_model->productcountry();

        $data['institute_list'] = $this->Institute_model->institutelist_by_country($data['details']->enq_country); 
        $data['course_list'] = $this->Leads_Model->get_course_list();
        $data['institute_app_status'] = $this->Institute_model->get_institute_app_status();

        $data['prod_list'] = $this->Doctor_model->product_list($compid); 
        $data['amc_list'] = $this->Doctor_model->amc_list($compid,$enquiry_id); 
        $data['comission_data'] = $this->enquiry_model->comission_data($data['details']->Enquery_id);
        

        $data['login_user_id'] = $this->user_model->get_user_by_email($data['details']->email);
        if (!empty($data['login_user_id']->pk_i_admin_id)) {
            $data['login_details'] = $this->Leads_Model->logdata_select($data['login_user_id']->pk_i_admin_id);            
        }

        $data['datasource_list'] = $this->Datasource_model->datasourcelist();
        $data['taskstatus_list'] = $this->Taskstatus_model->taskstatuslist();
        $data['state_list'] = $this->location_model->estate_list();
        $data['city_list'] = $this->location_model->ecity_list();
        $data['product_contry'] = $this->location_model->productcountry();
        $data['get_message'] = $this->Message_models->get_chat($phone_id);
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        $data['all_installment'] = $this->Leads_Model->installment_select();
        $data['all_gst'] = $this->Leads_Model->gst_select();
        $data['all_estage_lists'] = $this->Leads_Model->find_estage($data['details']->product_id,1);
        $data['all_cstage_lists'] = $this->Leads_Model->find_cstage($data['details']->product_id,1);
        $data['all_description_lists']    =   $this->Leads_Model->find_description($data['details']->product_id,1);
        $data['data_type'] = '1';

        $data['institute_data'] = $this->enquiry_model->institute_data($data['details']->Enquery_id);
        $data['dynamic_field']  = $this->enquiry_model->get_dyn_fld($enquiry_id);
        $data['fee_list'] = $this->location_model->get_fee_list($data['details']->Enquery_id);
        $data['ins_list'] = $this->location_model->get_ins_list($data['details']->Enquery_id);
        $data['post_doc_list'] = $this->Leads_Model->get_postdoc_list($data['details']->enq_country);
        $data['post_doctab_view'] = $this->Leads_Model->get_tabdoc_list($data['details']->Enquery_id);
        $data['all_c_vs_d'] = $this->location_model->c_vs_d_select();
        $data['all_c_vs_s'] = $this->location_model->c_vs_s_select();
        $data['all_c_vs_f'] = $this->location_model->c_vs_f_select();
        $data['family_tab_view'] = $this->Leads_Model->get_family_list($data['details']->Enquery_id);
        $data['all_tab_member'] = $this->Leads_Model->get_member_list($data['details']->Enquery_id);
        $data['all_qualification_test'] = $this->Leads_Model->get_test_list();
        $data['tab_qualification'] = $this->Leads_Model->get_qualification_list($data['details']->Enquery_id);
        $data['tab_education'] = $this->Leads_Model->get_education_list($data['details']->Enquery_id);
        $data['tab_education'] = $this->Leads_Model->get_education_list($data['details']->Enquery_id);
        $data['all_education_master'] = $this->Leads_Model->get_edumaster_list();
        $data['tab_job_detail'] = $this->Leads_Model->get_job_list($data['details']->Enquery_id);
        $data['tab_ticketdata'] = $this->Leads_Model->get_tick_list($data['details']->Enquery_id);
        $data['ref_req_form'] = $this->Leads_Model->get_ref_req($data['details']->Enquery_id);
        $data['tab_exp_detail'] = $this->Leads_Model->get_exp_list($data['details']->Enquery_id);
        //$data['client_aggrement_form'] = $this->location_model->get_client_agg_list($data['details']->Enquery_id);
        $data['all_tempname'] = $this->Leads_Model->agrtemp_name();
        $data['visa_type'] = $this->Leads_Model->visa_type_select();
        $data['visa_class'] = $this->Leads_Model->visa_mapping_select();
        $data['refund_list'] = $this->location_model->get_refund_list($data['details']->Enquery_id);
        $data['ticket_list'] = $this->location_model->get_ticket_list($data['details']->Enquery_id);
        $data['all_template'] = $this->location_model->agrformat_select($data['details']->Enquery_id);
        $data['tab_list'] = $this->form_model->get_tabs_list($this->session->companey_id,$data['details']->product_id);
        $this->load->helper('custom_form_helper');
        $data['leadid']     = $data['details']->Enquery_id;
        $data['enquiry_id'] = $enquiry_id;
        $data['compid']     =  $data['details']->comp_id;
        if ($this->session->companey_id=='67') { 
            $data['discipline'] = $this->location_model->find_discipline();
            $data['level'] = $this->location_model->find_level();
            $data['length'] = $this->location_model->find_length();
        }
        $data['add_more_pid'] = $data['details']->product_id;
        $this->enquiry_model->make_enquiry_read($data['details']->Enquery_id);
        $data['urls_list'] = $this->location_model->get_url_list($data['details']->enq_country);
       // echo"<pre>";print_r($data['details']);die;
        $data['all_branch'] = $this->Leads_Model->branch_select();
        $data['all_department'] = $this->Leads_Model->dept_select();
        $data['user_list'] = $this->User_model->read2();
        $data['all_tags'] = $this->enquiry_model->get_tags();
        $data['desp_type'] = $this->Leads_Model->get_desptype_list();
        $data['all_subject'] = $this->Leads_Model->ticket_subject_select();
        $data['content'] = $this->load->view('enquiry_details1', $data, true);
        $this->enquiry_model->assign_notification_update($enquiry_code);
        $this->load->view('layout/main_wrapper', $data);
    }

    function activityTimeline($type='')
    {        
        $enqid = $this->input->post('id');
        $data['enquiry'] = $this->enquiry_model->enquiry_by_id($enqid);
        $enquiry_code = $data['enquiry']->Enquery_id;

if(!in_array($this->session->userdata('user_right'), applicant)){
        $comment_details = $this->Leads_Model->comment_byId($enquiry_code,$type);
    }else{
        $comment_details = $this->Leads_Model->comment_byId_applicant($enquiry_code,$type); 
    }

        $html='<br><br><ul class="cbp_tmtimeline" >';
              foreach($comment_details as $comments)
              { 
        $html.= '<li>
                  <div class="cbp_tmicon cbp_tmicon-phone" style="background:#cb4335;"></div>
                  <div class="cbp_tmlabel"  style="background:#95a5a6;">
                    <span style="font-size:25px;font-family:Calibri, sans-serif;font-weight:500;">'.ucfirst($comments->comment_msg).' '.(($comments->st=='1')?"<a class='badge' href='javascript:void(0)'' style='background:#21ba45;padding:4px;color:#fff !important;'>Success</a>":"").'</span>';
        if($comments->comment_msg=='Stage Updated'){
        $html.=  '</br>
                  <b><span style="font-size:16px;font-family:Calibri, sans-serif;color:#0d6dcc;">Reminder Type:- </span>
                  <span style="font-size:14px;font-family:Calibri, sans-serif;color:#0d6dcc;">[' .$comments->type_name. ']</span></b>

               </br><span style="font-size:20px;font-family:Calibri, sans-serif;">Call Stage:- </span><span style="font-size:18px;font-family:Calibri, sans-serif;">'.ucfirst($comments->call_stage).'</span>

               </br><span style="font-size:20px;font-family:Calibri, sans-serif;">Stage:- </span><span style="font-size:18px;font-family:Calibri, sans-serif;">'.ucfirst($comments->stage_name).'</span>

               </br> <span style="font-size:20px;font-family:Calibri, sans-serif;">Description:- </span><span style="font-size:18px;font-family:Calibri, sans-serif;">'. ucfirst($comments->description).'</span>';

        }
        if($comments->comment_msg=='Onboarding dropped' || $comments->comment_msg=='Application dropped' || $comments->comment_msg=='Case Management dropped'){
        $html.='</br><span style="font-size:20px;font-family:Calibri, sans-serif;">Reason:- </span><span style="font-size:18px;font-family:Calibri, sans-serif;">'; 
                if(!empty($comments->drop_status)) 
                {
                $html.= ''.get_drop_status_name($comments->drop_status).'</span>
                    <br>';
                }
        $html.= '<span style="font-size:20px;font-family:Calibri, sans-serif;">Remark:- </spna><span style="font-size:18px;font-family:Calibri, sans-serif;">'; if(!empty($comments->drop_reason))
                    {
                        $html.=''.$comments->drop_reason.'</span>';
                    }
            }
    if(!empty($comments->rmk)){
        if($comments->msg_type=='3'){
         $pos=substr($comments->mail_header, 0, 100);   
        }else{
         $pos=substr($comments->rmk, 0, 250);
        }
        $html.= '</br>
                    <span style="font-size:18px;font-family:Calibri, sans-serif;">'.$pos.'.....<button onclick="timline_alert('.$comments->comm_id.')" class="btn btn-primary btn-sm" style="float:right;">view</button></span><br>'; 
    }
        $html.= '<p style="font-size:14px;padding:10px 0px;font-family:Calibri, sans-serif;">'.date("j-M-Y h:i:s a",strtotime($comments->ddate)).'<br>
                    Updated By : <strong style="color:black;font-family:Calibri, sans-serif;">'.ucfirst($comments->comment_created_by . ' ' .$comments->lastname).' ['.$comments->role_name.']</strong></p>
                  </div>
                </li>';                 
                }
                            
     $html.='</ul>';
     echo $html; 
    }

    function get_timline_alert($rem='')
    {        
        $this->db->select('remark');
        $this->db->where('comm_id',$rem);
            $res=$this->db->get('tbl_comment');
            $remark=$res->row();
        if(!empty($remark->remark)){
            $html = $remark->remark;
        }else{
            $html = '<span style="font-size:20px;font-family:Calibri, sans-serif;">Sorry, No Content Found! </spna>';
        }
    echo $html; 
    }

    function deleteDocument($cmmnt_id,$enqcode,$tabname)
    {
        // echo "$cmmnt_id";die;

        $dataAry = $this->db->select('fvalue')->from('extra_enquery')->where("comment_id",$cmmnt_id)->get()->result_array();

        $this->db->where("comment_id",$cmmnt_id);
        $this->db->delete('extra_enquery');
        $tabname = base64_decode($tabname);
        if($this->db->affected_rows() > 0)
        {   
            if ($tabname == "Documents")
            {

               foreach ($dataAry as $k)
                {   //echo "ddd".$k['fvalue'];die;
                    //echo"<pre>";print_r($k);die;
                    unlink($k['fvalue']);
                }
            }
            
            $this->Leads_Model->add_comment_for_events("$tabname Deleted  From This Onboarding", $enqcode);
        }
        redirect($this->agent->referrer());
    }


    
    public function mview($enquiry_id) {
        
        
        $usrno = $this->input->post("user_id", true);
        $enqno = $this->input->post("enquiry_id", true);
    
        if (user_role('63') == true) {            
        }
        $data['title'] = display('information');

        if (!empty($_POST)) {
            
            $name = $this->input->post('enquirername');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobileno');
            $lead_source = $this->input->post('lead_source');
            $enquiry = $this->input->post('enquiry');
            $en_comments = $this->input->post('enqCode');
            $company = $this->input->post('company');
            $address = $this->input->post('address');
            $name_prefix = $this->input->post('name_prefix');
            $this->db->set('country_id', $this->input->post('country_id'));
            $this->db->set('product_id', $this->input->post('product_id'));
            $this->db->set('institute_id', $this->input->post('institute_id'));
            $this->db->set('datasource_id', $this->input->post('datasource_id'));
            $this->db->set('phone', $mobile);
            $this->db->set('enquiry_subsource',$this->input->post('sub_source'));
            $this->db->set('email', $email);
            $this->db->set('company', $company);
            $this->db->set('address', $address);
            $this->db->set('name_prefix', $name_prefix);
            $this->db->set('name', $name);
            $this->db->set('enquiry_source', $lead_source);
            $this->db->set('enquiry', $enquiry);
            $this->db->set('coment_type',1);
            $this->db->set('lastname', $this->input->post('lastname'));
            $this->db->where('Enquery_id', $enquiry_id);
            $this->db->update('enquiry');
            $this->Leads_Model->add_comment_for_events('Onboarding Updated', $en_comments);
            $this->session->set_flashdata('message', 'Save successfully');
            redirect('enquiry/view2/' . $enquiry_id);
        }
        
        
       
        
        
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id2($enquiry_id);   

        //$enqcode  = (!empty($data['details']))? $data['details']->Enquery_id : "";  
        $data['state_city_list'] = $this->location_model->get_city_by_state_id($data['details']->enquiry_state_id);
        $data['allleads'] = $this->Leads_Model->get_leadList();
        if (!empty($data['details'])) {
            $lead_code  = $data['details']->Enquery_id;
            $enquiry_id = $data['details']->enquiry_id;
        }        
        $data['check_status'] = $this->Leads_Model->get_leadListDetailsby_code($lead_code);       
        $data['all_drop_lead'] = $this->Leads_Model->all_drop_lead();
        $data['products'] = $this->dash_model->get_user_product_list(); 

        $data['allcountry_list'] = $this->Taskstatus_model->countrylist();
        $data['allstate_list'] = $this->Taskstatus_model->statelist();
        $data['allcity_list'] = $this->Taskstatus_model->citylist();
        $data['personel_list'] = $this->Taskstatus_model->peronellist($enquiry_id);        
        $data['kyc_doc_list'] = $this->Kyc_model->kyc_doc_list($lead_code);        
        $data['education_list'] = $this->Education_model->education_list($lead_code);
        $data['social_profile_list'] = $this->SocialProfile_model->social_profile_list($lead_code);        
        $data['close_femily_list'] = $this->Closefemily_model->close_femily_list($lead_code);
        $data['all_country_list'] = $this->location_model->country();
        $data['all_contact_list'] = $this->location_model->contact($enquiry_id);                
        $data['subsource_list'] = $this->Datasource_model->subsourcelist();
        $data['drops'] = $this->Leads_Model->get_drop_list();
        $data['name_prefix'] = $this->enquiry_model->name_prefix_list();
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        $data['enquiry'] = $this->enquiry_model->enquiry_by_id($enquiry_id);
      //  $data['lead_stages'] = $this->Leads_Model->get_leadstage_list();
     //   $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $enquiry_code = $data['enquiry']->Enquery_id;
        $phone_id = '91'.$data['enquiry']->phone;        
        $data['recent_tasks'] = $this->Task_Model->get_recent_taskbyID($enquiry_code);        
    //    $data['comment_details'] = $this->Leads_Model->comment_byId($enquiry_code);        
        $user_role    =   $this->session->user_role;
        $data['country_list'] = $this->location_model->productcountry();

        $data['institute_list'] = $this->Institute_model->institutelist_by_country($data['details']->enq_country);
        
        $data['institute_app_status'] = $this->Institute_model->get_institute_app_status();
        

        $data['datasource_list'] = $this->Datasource_model->datasourcelist();
        $data['taskstatus_list'] = $this->Taskstatus_model->taskstatuslist();
        $data['state_list'] = $this->location_model->estate_list();
        $data['city_list'] = $this->location_model->ecity_list();
        $data['product_contry'] = $this->location_model->productcountry();
        $data['get_message'] = $this->Message_models->get_chat($phone_id);
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        $data['all_estage_lists'] = $this->Leads_Model->find_estage($enquiry_id);

        $data['institute_data'] = $this->enquiry_model->institute_data($data['details']->Enquery_id);
        $data['dynamic_field']  = $this->enquiry_model->get_dyn_fld_api($enquiry_id);
    
       // print_r($data['dynamic_field']);exit();
    
        /*var_dump($data['institute_data']);
        exit();*/

       // $data['content'] = $this->load->view('menquiry_details', $data, true);
       
       $this->enquiry_model->assign_notification_update($enquiry_code);
        $this->load->view('menquiry_details', $data);
    }
    
    public function add_enquery_institute($enq_code){
        $enq_code = base64_decode($enq_code);
   /*     echo "<pre>";
        print_r($_POST);
        echo "</pre>";
Array
(
    [application_url] => app
    [major] => major
    [username] => username
    [app_fee] => app fee
    [transcript] => transcript
    [lors] => lors
    [sop] => sop
    [cv] => cv
    [gre_gmt] => gre
    [tofel_ielts_pts] => tofel
    [remark] => remark
    [followup_comment] => followup
    [reference_no] => refeeq
    [courier_status] => courer status
)*/
        /*$this->form_validation->set_rules('application_url','Application Url','trim|required');
        $this->form_validation->set_rules('major','Major','trim|required');
        $this->form_validation->set_rules('username','User Name','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');
        $this->form_validation->set_rules('app_fee','App Fee','trim|required');
        $this->form_validation->set_rules('transcript','Transcript','trim|required');
        $this->form_validation->set_rules('lors','Lors','trim|required');
        $this->form_validation->set_rules('sop','Sop','trim|required');
        $this->form_validation->set_rules('cv','CV','trim|required');
        $this->form_validation->set_rules('gre_gmt','GRE/GMT','trim|required');
        $this->form_validation->set_rules('tofel_ielts_pts','TOFEL/IELTS/PTS','trim|required');
        $this->form_validation->set_rules('remark','Remark','trim');
        $this->form_validation->set_rules('followup_comment','Followup Comment','trim');
        $this->form_validation->set_rules('reference_no','Reference No','trim');
        $this->form_validation->set_rules('courier_status','Courier Status','trim');
        $this->form_validation->set_rules('app_status','App Status','trim|required');
        */
        $this->form_validation->set_rules('institute_id','Institute','trim|required');

        if ($this->form_validation->run() == TRUE) {

            $institute_id       =   $this->input->post('institute_id');
            $course_id          =   $this->input->post('app_course');
            $p_lvl              =   $this->input->post('p_lvl');
            $p_disc              =   $this->input->post('p_disc');
            $p_length           =   $this->input->post('p_length');
            $t_fee              =   $this->input->post('t_fee');
            $ol_fee             =   $this->input->post('ol_fee');
            $application_url    =   $this->input->post('application_url');
            $major              =   $this->input->post('major');
            $username           =   $this->input->post('username');
            $password           =   $this->input->post('password');
            $app_fee            =   $this->input->post('app_fee');
            $transcript         =   $this->input->post('transcript');
            $lors               =   $this->input->post('lors');
            $sop                =   $this->input->post('sop');
            $cv                 =   $this->input->post('cv');
            $gre_gmt            =   $this->input->post('gre_gmt');
            $tofel_ielts_pts    =   $this->input->post('tofel_ielts_pts');
            $remark             =   $this->input->post('remark');
            $followup_comment   =   $this->input->post('followup_comment');
            $reference_no       =   $this->input->post('reference_no');
            $courier_status     =   $this->input->post('courier_status');
            $app_status         =   $this->input->post('app_status');


            $institute_data = array(                                
                        'institute_id'      => $institute_id,
                        'course_id'         => $course_id,
                        'p_lvl'             => $p_lvl,
                        'p_disc'             => $p_disc,
                        'p_length'          => $p_length,
                        't_fee'             => $t_fee,
                        'ol_fee'            => $ol_fee,
                        'enquery_code'      => $enq_code,
                        'application_url'   => $application_url,
                        'major'             => $major,
                        'user_name'         => $username,
                        'password'          => $password,
                        'app_status'        => $app_status,
                        'app_fee'           => $app_fee,
                        'transcript'        => $transcript,
                        'lors'              => $lors,
                        'sop'               => $sop,
                        'cv'                => $cv,
                        'gre_gmt'           => $gre_gmt,
                        'toefl'             => $tofel_ielts_pts,
                        'remark'            => $remark,
                        'followup_comment'  => $followup_comment,
                        'ref_no'            => $reference_no,
                        'courier_status'    => $courier_status,
                        'created_by'        => $this->session->user_id                                
                    );
            if($this->input->post('enq_institute_id')){
                $this->db->where('id',$this->input->post('enq_institute_id'));
                $ins    =   $this->db->update('institute_data',$institute_data);
                $msg = 'Institute updated successfully';

            }else{
                $ins    =   $this->db->insert('institute_data',$institute_data);
                $msg = 'Institute added successfully';
            }

            if($ins){
                echo json_encode(array('status'=>true,'msg'=>$msg));                
            }else{
                echo json_encode(array('status'=>false,'msg'=>'Something went wrong!'));
            }
        } else {            
            echo json_encode(array('status'=>false,'msg'=>validation_errors()));
        }

    }
    public function delete($enquiry_id = null) {
        if (user_role('12') == true) {}
        if ($this->enquiry_model->delete($enquiry_id)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('enquiry');
    }

    public function move_to_lead() {
        
        if (!empty($_POST)) {
            $portal = $this->input->post('portal');
           // print_r($portal);exit;
            $move_enquiry = $this->input->post('enquiry_id');
            $date = date('d-m-Y H:i:s');

            $lead_score = $this->input->post('lead_score');
            $lead_stage = $this->input->post('lead_stage');
            $comment = $this->input->post('comment');
            $assign_to = $this->session->user_id;
            if (!empty($lead_score)) {
                $lead_score = $this->input->post('lead_score');
            } else {
                $lead_score = '';
            }

            if (!empty($lead_stage)) {
                $lead_stage = $this->input->post('lead_stage');
            } else {
                $lead_stage = '';
            }
            if (!empty($comment)) {
                $comment = $this->input->post('comment');
            } else {
                $comment = '';
            }
            
            if((!empty($move_enquiry)) && $this->session->companey_id=='83' || $this->session->companey_id=='85' || $this->session->companey_id=='86'){ 
                if($this->session->companey_id=='83'){
                    $user_right = '214';
                }else if($this->session->companey_id=='85'){
                    $user_right = '219';
                }else if($this->session->companey_id=='86'){
                    $user_right = '223';
                }

                foreach ($move_enquiry as $key) {
                    $enq = $this->enquiry_model->enquiry_by_id($key);
                    $data = array(
                       // 'adminid' => $enq->created_by,
                        'ld_name' => $enq->name,
                        'ld_email' => $enq->email,
                        'ld_mobile' => $enq->phone,
                        'lead_code' => $enq->Enquery_id,
                       // 'city_id' => $enq->city_id,
                       // 'state_id' => $enq->state_id,
                       // 'country_id' => $enq->country_id,
                       // 'region_id' => $enq->region_id,
                       // 'territory_id' => $enq->territory_id,
                        'ld_created' => $date,
                        'ld_for' => $enq->enquiry,
                        'lead_score' => $lead_score,
                        'lead_stage' => 1,
                        'comment' => $comment,
                        'ld_status' => '1'
                    );

                    $this->db->set('status', 2);
                    $this->db->where('enquiry_id', $key);
                    $this->db->update('enquiry');
if(!empty($portal)){
/******************************************Create login credential****************************/
                   
                    $this->create_client_portal($key);

/******************************************Create login credential End****************************/
}
                    $this->load->model('rule_model');
                    $this->rule_model->execute_rules($enq->Enquery_id,array(1,2,3,6,7));      

                    $this->Leads_Model->add_comment_for_events($this->lang->line("move_to_lead"), $enq->Enquery_id);
                    $insert_id = $this->Leads_Model->LeadAdd($data);
                }
                 echo '1';
            }else{
                echo "Please Check Onboarding";
            }   
           
        } else {
            echo "Something Went Wrong";
        }
    }

    public function move_to_lead_details() {
        if (!empty($_POST)) {
            $portal = $this->input->post('portal');           
            $move_enquiry = $this->input->post('enquiry_id');
            $enquiry = $this->enquiry_model->read_by_id($move_enquiry);
            $lead_score = $this->input->post('lead_score');
            $lead_stage = $this->input->post('move_lead_stage');
            $lead_discription = $this->input->post('lead_description');
            $assign_employee = $this->input->post('assign_employee');
            
            $comment = $this->input->post('comment');
            $expected_date = $this->input->post('expected_date');
            if (!empty($lead_score)) {
                $lead_score = $this->input->post('lead_score');
            }
            if (!empty($lead_stage)) {
                $lead_stage = $this->input->post('move_lead_stage');
            }
            if (!empty($comment)) {
                $comment = $this->input->post('comment');
            }
if(!empty($portal)){            
 if((!empty($move_enquiry)) && $this->session->companey_id=='83' || $this->session->companey_id=='85' || $this->session->companey_id=='86'){

            $this->create_client_portal($move_enquiry);
}
}

//For update all assign id Start
if(!empty($assign_employee)){
            $this->db->select('all_assign');
            $this->db->where('enquiry_id',$move_enquiry);
            $res=$this->db->get('enquiry');
            $q=$res->row();
            $z=array();$new=array();$allid=array();
                 $z = explode(',',$q->all_assign);
                 $new[]=$assign_employee;
                $allid = array_unique (array_merge ($z, $new));
                //print_r($allid);exit; 
                $string_id=implode(',',$allid);
                
                $this->db->set('all_assign', $string_id);
$this->db->where('enquiry_id',$move_enquiry);
$this->db->update('enquiry');                         
            }
//For update all assign id End

            
            $this->db->set('lead_score', $lead_score);
            $this->db->set('lead_stage', $lead_stage);
            $this->db->set('lead_discription', $lead_discription);
            $this->db->set('lead_comment', $comment);
            $this->db->set('lead_expected_date', $expected_date);
            $this->db->set('lead_drop_status', 0);
            $this->db->set('lead_created_date', date('Y-m-d H:i:s'));
            $this->db->set('status', 2);
        if(!empty($assign_employee)){
            $this->db->set('aasign_to', $assign_employee);
        }
            $this->db->set('update_date', date('Y-m-d H:i:s'));
            $this->db->where('enquiry_id', $move_enquiry);
            $this->db->update('enquiry');
            
            $this->load->model('rule_model');
            $this->rule_model->execute_rules($enquiry->row()->Enquery_id,array(1,2,3,6,7));            

            $this->Leads_Model->add_comment_for_events('Onboarding Moved ', $enquiry->row()->Enquery_id,$lead_stage);
            $this->session->set_flashdata('message', 'Onboarding Convert to Application Successfully');
            redirect('enquiry');
        } else {
            echo "<script>alert('Something Went Wrong')</script>";
            redirect('enquiry');
        }
    }

    function create_client_portal_checkbox() {

    $enq_no = $this->input->post('enq_no');
    $email = $this->input->post('email');
    $mobile = $this->input->post('mobile');
    $check = $this->input->post('check');
    if(!empty($check)){
        $this->db->select('pk_i_admin_id');
        $this->db->from('tbl_admin');
        $this->db->where('s_user_email',$email);
        $this->db->where('s_phoneno',$mobile);
        $q= $this->db->get()->row();
    if(empty($q->pk_i_admin_id)){
        $this->create_client_portal($enq_no);
       echo 1;
    }else{
      echo 0;  
    }
    }else{
      echo 0;  
    }    
    }

    function disable_client_portal_checkbox() {

    $enq_no = $this->input->post('enq_no');
    $email = $this->input->post('email');
    $mobile = $this->input->post('mobile');
    $check = $this->input->post('check');
    if(!empty($check)){

        $this->db->set('portal_status', 'disable');
        $this->db->set('portal_validity', date('Y-m-d'));
        $this->db->where('enquiry_id', $enq_no);
        $this->db->update('enquiry');

        $this->db->set('b_status','0');
        $this->db->where('s_user_email',$email);
        $this->db->where('s_phoneno',$mobile);
        $this->db->update('tbl_admin');

       echo 1;
    }else{

        $this->db->set('portal_status', 'Enable');
        $this->db->where('enquiry_id', $enq_no);
        $this->db->update('enquiry');

        $this->db->set('b_status','1');
        $this->db->where('s_user_email',$email);
        $this->db->where('s_phoneno',$mobile);
        $this->db->update('tbl_admin');

      echo 0;  
    }    
    }

    function client_portal_validity() {

    $enq_no = $this->input->post('enq_no');
    $date = $this->input->post('date');

        $this->db->set('portal_validity', $date);
        $this->db->where('enquiry_id', $enq_no);
        $this->db->update('enquiry');
       echo 1;    
    }

     function create_client_portal($move_enquiry) {

        if($this->session->companey_id=='83'){
                    $user_right = '214';
                }else if($this->session->companey_id=='85'){
                    $user_right = '219';
                }else if($this->session->companey_id=='86'){
                    $user_right = '223';
                }else if($this->session->companey_id=='88'){
                    $user_right = '231';
                } 

                    $this->db->select('*');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$move_enquiry);
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
            if($q->product_id!='182'){            
                   $pk_id = $this->db->insert('tbl_admin',$assign_data);
            }else{
                   $pk_id = '';
            }
//Send Email/SMS Start

if(!empty($pk_id)){

    $this->db->set('portal', 'Yes');
    $this->db->set('portal_validity', date('Y-m-d', strtotime('+2 years')));
    $this->db->where('enquiry_id', $move_enquiry);
    $this->db->update('enquiry');

//For SMS and Email sent credential
$message= $this->db->where(array('temp_id'=>'193','comp_id'=>$q->comp_id))->get('api_templates')->row()->template_content;

    //For Sender details
        $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno');
        $this->db->where('companey_id',$q->comp_id);
        $this->db->where('pk_i_admin_id',$q->aasign_to);
        $sender_row =   $this->db->get('tbl_admin')->row_array();
       

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
                    $new_message = str_replace('@userphone', $sender_row['s_phoneno'],$new_message);
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
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Sent.', $q->Enquery_id,'0',$sender_row['pk_i_admin_id'],$new_message,'3','1',$email_subject);
                echo "Email Sent Successfully!";
                }else{
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Failed.', $q->Enquery_id,'0',$sender_row['pk_i_admin_id'],$new_message,'3','0',$email_subject);
                        echo "Something went wrong";                                
                }
//For bell notification
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
            $this->User_model->add_comment_for_student_user($q->Enquery_id,$q->aasign_to,$email_subject,$stage_remark,$task_date,$task_time,$sender_row['pk_i_admin_id']);

//For Sms Sent

if(!empty($q->phone)){
 $sms_message= $this->db->where(array('temp_id'=>'345','comp_id'=>$q->comp_id))->get('api_templates')->row()->template_content;

            $new_message = $sms_message;
            $new_message = str_replace('@name', $q->name.' '.$q->lastname,$new_message);
            $new_message = str_replace('@phone', $q->phone,$new_message);
            $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
            $new_message = str_replace('@userphone', $sender_row['s_phoneno'],$new_message);
            $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
            $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
            $new_message = str_replace('@email', $q->email,$new_message);
            $new_message = str_replace('@password', '12345678',$new_message);
    $phone = $q->phone;               
                $this->Message_models->smssend($phone,$new_message,$q->comp_id,$sender_row['pk_i_admin_id']);
    
    $enq_id=$q->Enquery_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('SMS Sent.', $enq_id,'0',$sender_row['pk_i_admin_id'],$new_message,'2','1');
                echo "Message sent successfully"; 
                }
//For Whatsapp Sent

if(!empty($q->phone)){
 $sms_message= $this->db->where(array('temp_id'=>'293','comp_id'=>$q->comp_id))->get('api_templates')->row()->template_content;

            $new_message = $sms_message;
            $new_message = str_replace('@name', $q->name.' '.$q->lastname,$new_message);
            $new_message = str_replace('@phone', $q->phone,$new_message);
            $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
            $new_message = str_replace('@userphone', $sender_row['s_phoneno'],$new_message);
            $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
            $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
            $new_message = str_replace('@email', $q->email,$new_message);
            $new_message = str_replace('@password', '12345678',$new_message);

    $phone='91'.$q->phone;               
                $this->Message_models->sendwhatsapp($phone,$new_message,$q->comp_id,$sender_row['pk_i_admin_id']);
    
    $enq_id=$q->Enquery_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('Whatsapp Sent.', $enq_id,'0',$sender_row['pk_i_admin_id'],$new_message,'1','1');
                echo "Message sent successfully"; 
                }
}

//Send Email/SMS/Whatsapp End

                    return true;
    }

    public function active_enquery($id) {
        $this->db->set('drop_status', 0);
        $this->db->where('enquiry_id', $id);
        $this->db->update('enquiry');
        $data['enquiry'] = $this->enquiry_model->enquiry_by_id($id);
        $enquiry_code = $data['enquiry']->Enquery_id;
        
        $enquiryid  = $id;
        if($data['enquiry']->status==1){
            $url = 'enquiry/view/'.$enquiryid;                
            $comment = display('enquiry').' Activated';
        }else if ($data['enquiry']->status == 2) {
            $url = 'lead/lead_details/' . $enquiryid;                
            $comment = display('lead').' Activated';

        } else if ($data['enquiry']->status == 3) {
            $url = 'client/view/'.$enquiryid;
            $comment = display('Client').' Activated';            
        } else if ($data['enquiry']->status == 4) {
            $url = 'refund/view/'.$enquiryid;
            $comment = display('refund_list').' Activated';            
        }else{
            $enquiry_separation  = get_sys_parameter('enquiry_separation','COMPANY_SETTING');                             
            if (!empty($enquiry_separation)) {                    
                $enquiry_separation = json_decode($enquiry_separation,true);
                $stage    =   $data['enquiry']->status;
                $title = $enquiry_separation[$stage]['title'];
                $url = 'client/view/'.$enquiryid.'?stage='.$stage;
                $comment = $title.' Activated';            
            }
            
        }

        $this->Leads_Model->add_comment_for_events($comment, $enquiry_code);
        $this->session->set_flashdata('message', $comment." Successfully");        
        redirect($url,'refresh');

/*
        $this->Leads_Model->add_comment_for_events('Active Enquiry', $enquiry_code);
        $this->session->set_flashdata('message', "Activated Successfully");

        redirect('enquiry/view/' . $id);*/
    }

       public function drop_enquiry() {
        $data['title'] = 'Drop Reasons';
        $enquiryid = $this->uri->segment(3);
        if (!empty($_POST)) {
            $reason = $this->input->post('reason');
            $drop_status = $this->input->post('drop_status');

            $this->db->set('drop_status', $drop_status);
            $this->db->set('drop_reason', $reason);
            $this->db->set('update_date', date('Y-m-d H:i:s'));
            $this->db->where('enquiry_id', $enquiryid);
            $this->db->update('enquiry');

            $data['enquiry'] = $this->enquiry_model->enquiry_by_id($enquiryid);
            $enquiry_code = $data['enquiry']->Enquery_id;
            
            if($data['enquiry']->status==1){
                $url = 'enquiry/view/'.$enquiryid;                
                $comment = 'Onboarding dropped';
            }else if ($data['enquiry']->status == 2) {
                $url = 'lead/lead_details/' . $enquiryid;                
                $comment = 'Application dropped';

            } else if ($data['enquiry']->status == 3) {
                $url = 'client/view/'.$enquiryid;
                $comment = display('Client').' dropped';            
            }else if ($data['enquiry']->status == 4) {
                $url = 'refund/view/'.$enquiryid;
                $comment = display('refund_list').' dropped';            
            }else{
                $enquiry_separation  = get_sys_parameter('enquiry_separation','COMPANY_SETTING');                             
                if (!empty($enquiry_separation)) {                    
                    $enquiry_separation = json_decode($enquiry_separation,true);
                    $stage    =   $data['enquiry']->status;
                    $title = $enquiry_separation[$stage]['title'];
                    $url = 'client/view/'.$enquiryid.'?stage='.$stage;
                    $comment = $title.' dropped';            
                }
                
            }
            $this->load->model('rule_model');
            $this->rule_model->execute_rules($enquiry_code,array(1,2,3,4,6,7,12));
            $this->Leads_Model->add_comment_for_events1($comment, $enquiry_code,$reason,$drop_status); // to insert drop status and reason
            $this->session->set_flashdata('message', "Dropped Successfully");
            //echo $url; exit();
            redirect($url,'refresh');
        }
    }

public function tata_block_list($mob){
$mob = base64_decode($mob);
$agent_login = $this->session->telephony_login;
$agent_pass = $this->session->telephony_pass;
if(!empty($agent_login && $agent_pass)){
$authcode = $this->get_authorization_code($agent_login,$agent_pass);
$authcode = json_decode($authcode);
$auth_token = $authcode->access_token;
$curl = curl_init();

  curl_setopt_array($curl, [
  CURLOPT_URL => "https://api-smartflo.tatateleservices.com/v1/blocked_number",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"block_key\":\"account\",\"src_number\":$mob}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Authorization: $auth_token",
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $response = json_decode($response);
    $response = $response->message;
  echo $response;
}
}else{
    echo 'Please Map Telephony credentials!';
}
}

public function get_authorization_code($agent_login,$agent_pass){
  $curl = curl_init();

  curl_setopt_array($curl, [
  CURLOPT_URL => "https://api-smartflo.tatateleservices.com/v1/auth/login",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"password\":\"$agent_pass\",\"email\":\"$agent_login\"}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return "cURL Error #:" . $err;
} else {
  return $response;
}
}

    public function drop_enquiries() {
        if (!empty($_POST)) {
            $reason = $this->input->post('reason');
            $drop_status = $this->input->post('drop_status');
            $move_enquiry = $this->input->post('enquiry_id');
            if (!empty($move_enquiry)) {
                foreach ($move_enquiry as $key) {
                    $this->db->set('drop_status', $drop_status);
                    $this->db->set('drop_reason', $reason);
                    $this->db->set('update_date', date('Y-m-d H:i:s'));
                    $this->db->where('enquiry_id', $key);
                    $this->db->update('enquiry');
                    $data['enquiry'] = $this->enquiry_model->enquiry_by_id($key);
                    $enquiry_code = $data['enquiry']->Enquery_id;
                    $this->Leads_Model->add_comment_for_events($this->lang->line("enquery_dropped"), $enquiry_code);
                }
                echo '1';
            } else {
                echo display('please_try_again');
            }
        }
    }

    public function delete_recorde() {
        if (!empty($_POST)) {
            $move_enquiry = $this->input->post('enquiry_id');
            if (!empty($move_enquiry)) {
                foreach ($move_enquiry as $key) {
                    $this->db->where('enquiry_id', $key);
                    //$this->db->where('status!=', 2);
                    $this->db->where('comp_id',$this->session->companey_id);
                    $this->db->delete('enquiry');
                }
                $this->session->set_flashdata('message', "Enquiry Deleted Successfully");
                redirect(base_url() . 'enquiry');
            } else {
                echo display('please_try_again');
            }
        }
    }

function upload_enquiry() {
        ini_set('max_execution_time', '-1');
        $filename = "enquiry_" . date('d-m-Y_H_i_s');
        $config = array(
            'upload_path' =>$_SERVER["DOCUMENT_ROOT"]."/assets/enquiry", 
            'allowed_types' => "text/plain|text/csv|csv",
            'remove_spaces' => TRUE,
            'file_name' => $filename
        );
       
        $this->load->library('upload', $config);
          $this->upload->initialize($config);
          if(empty($this->input->post('datasource_name'))){
            $this->session->set_flashdata('exception', "Data Source empty");
            redirect(base_url() . 'lead/datasourcelist');
            }else{$datasource_name=$this->input->post('datasource_name');}
          
        if ($this->upload->do_upload('img_file')) {
            $upload = $this->upload->data();
            $json['success'] = 1;
            $filePath = $config['upload_path'] . '/' . $upload['file_name'];
            $file = $filePath;
            $handle = fopen($file, "r");
            $c = 0;
            $count = 0;
            $record = 0;
            $failed_record = 0;
            $i=0;

            $dat_array=array();
            
            while (($filesop = fgetcsv($handle, 2000, ",")) !== false) {
                $dat_array = array();
                $count++;
                if ($count == 1) {
                     
                } else {           
                
                    if(!empty($filesop[8]) && !empty($this->location_model->get_city_by_name($filesop[8]))){                        
                        $res=$this->location_model->get_city_by_name($filesop[8]);
                        $country_id= !empty($res->country_id)?$res->country_id:'';
                        $region_id=!empty($res->region_id)?$res->region_id:'';
                        $territory_id=!empty($res->territory_id)?$res->territory_id:'';
                        $state_id=!empty($res->state_id)?$res->state_id:'';
                        $city_id=!empty($res->cid)?$res->cid:'';
                    }else{                        
                        $country_id='';
                        $region_id='';
                        $territory_id='';
                        $state_id='';
                        $city_id='';                     
                    }
                    $product_name='';

                    $product_row    =   !empty($filesop[10])?$this->enquiry_model->name_product_list_byname($filesop[10]):'';   // process                  

                    if(!empty($product_row)){
                        $sb_id =  $product_row->sb_id;                  
                    }                    
                    if(!empty($sb_id)){
                        $product_name=$sb_id;
                    }else{
                        $product_name='';
                    }

                    $enquiry_source = !empty($filesop[11])?$this->enquiry_model->enquiry_source_byname($filesop[11]):'';       //     source         
                    

                    $enquiry_source_id = '';
                    if(!empty($enquiry_source)){
                        $enquiry_source_id =  $enquiry_source->lsid;                  
                    }                    

                    $service_row    =   !empty($filesop[14])?$this->enquiry_model->name_services_list_byname($filesop[14]):'';                  
                    if(!empty($service_row)){
                        $ser_id =  $service_row->id;                  
                    }
                    if(!empty($ser_id)){
                        $service_name=$ser_id;
                    }else{
                        $service_name='';
                    }
                    if(!empty($filesop[0])){$zero=$filesop[0];}else{$zero='';} // Company name

                    if(!empty($filesop[1])){$one=$filesop[1];}else{$one='';} // Name prefixed

                    if(!empty($filesop[2])){$two=$filesop[2];}else{$two='';} // First Name

                    if(!empty($filesop[3])){$three=$filesop[3];}else{$three='';} //Last Name

                    if(!empty($filesop[4])){$phone_no=$filesop[4];}else{$phone_no=0;} //Mobile No

                    if(!empty($filesop[5])){$five=$filesop[5];}else{$five='';} //other_number

                    if(!empty($filesop[6])){$six=$filesop[6];}else{$six='';} // Email Address
                                                                              // 7 state
                                                                              // 8 city

                    if(!empty($filesop[9])){$nine=$filesop[9];}else{$nine='';} // address
                                                                               //10 process
                                                                               //11 source
                                                                               // 12 datasource

                    //if(!empty($filesop[11])){$eleven=$filesop[11];}else{$eleven='';}
                    if(!empty($filesop[13])){$therteen=$filesop[13];}else{$therteen='';} // remark
                    
                      // $product_country_id = '';                    
                    /*if($fourteen){
                        $this->db->select('id');    
                        $this->db->where('TRIM(country_name)',$fourteen);
                        $product_contry_row    =   $this->db->get('tbl_product_country')->row_array();                        
                        if(!empty($product_contry_row)){
                            $product_country_id    =  $product_contry_row['id'];
                        }
                    }
                    */

                    //$phone=preg_match('/^[0-9]{10}+$/', $phone_no);                    
                    //$phone=preg_replace('/[^0-9]/i', '',$phone_no);
                    $phone = $phone_no;
                    $this->db->where('phone',$phone);
                    $this->db->where('comp_id',$this->session->companey_id);
                    if(!empty($product_name)){
                        $this->db->where('product_id',$product_name);
                    }
                    $res_phone = $this->db->get('enquiry2')->num_rows();
                    //$encode=$this->get_enquery_code();                    
                   // if($res_phone==0) {                 
                        $dat_array=array(
                            'Enquery_id'=> 'as',
                            'email'=> $six,
                            'comp_id'=> $this->session->companey_id,
                            'phone'=> $phone_no,
                            'other_no'=>$five,
                            'org_name'=> $zero,
                            'name_prefix'=>$one,
                            'name'=> $two,
                            'lastname'=>$three,
                            'enquiry'=> $therteen,
                            'product_id'=>$product_name,
                            'enquiry_subsource'=>$service_name,
                             'datasource_id'=>$datasource_name,
                            'enquiry_source'=> $enquiry_source_id,                          
                            'address'=> trim($nine),
                            'user_role'=> $this->session->user_role,
                            'status'=> 1,
                            'country_id'=>$country_id,
                            'region_id'=>$region_id,
                            'territory_id'=>$territory_id,
                            'state_id'=>$state_id,
                            'city_id'=>$city_id,
                            'created_by'=>$this->session->user_id,
                            //'created_date'=>date('Y-m-d')
                        );
                        $record++;                       
                    /*}else{
                        $failed_record++;
                    }*/
                    if(!empty($dat_array)){
                    $this->db->insert('enquiry2', $dat_array);
                    $l_id=$this->db->insert_id();
             
             //print_r($l_id);exit;
/**************************************daynamic fields inserts****************************/
            /*if(!empty($filesop[10])){
                $colmn_data    =   $this->enquiry_model->all_list_colmn($filesop[10]);

                        if(!empty($colmn_data)){
                            $j=15;
                            foreach($colmn_data as $cdata){
                            $column_id =  $cdata->input_id; 
                            $biarr = array( "enq_no"  => "",
                                      "input"   => $column_id,
                                      "parent"  => $l_id, 
                                      "fvalue"  => $filesop[$j],
                                      "cmp_no"  => $this->session->companey_id,
                                     ); 
                                    // print_r($biarr);exit;
                            $this->db->insert('extra_enquery', $biarr);                              
                $j++;                       
                }
                        }

            }*/
                    
            
/**************************************daynamic fields inserts End****************************/ 
            }
                
                }
                echo $i;
                $i++;

            }
                    
            
            if ($record > 0) {
                $res = 'Record(' . $record . ') inserted';                
            } else {
                $res = 'No Unique record Found !';
            }
            if($failed_record){
                $res .= ' ('.$failed_record . ') duplicate record ';
            }
           unlink($filePath);
            $this->session->set_flashdata('message', "File Uploaded successfully." . $res);
            redirect(base_url() . 'lead/datasourcelist');
        } else {
            $this->session->set_flashdata('exception', $this->upload->display_errors());
           redirect(base_url() . 'lead/datasourcelist');
        }
    }

    public function search_comment_and_task($date = '', $id = '') {
        if (!empty($date)) {
            $details = '';
            $details1 = '';
            $task_start = date('d-m-Y', strtotime($date));
            $task_id = $id;
            $data['recent_tasks'] = $this->Task_Model->search_taskby_date($task_start, $task_id);
            $data['search_task'] = $this->Task_Model->search_task($task_start, $task_id);
            foreach ($data['search_task'] as $comment) {
                $details .= '<div class="list-group" id="comment_div">
                            <a class="list-group-item list-group-item-action flex-column align-items-start">
                               <div class="d-flex w-100 justify-content-between">
                                  <p class="mb-1">' . $comment->comment_msg . '</p>
                                  <small><b>' . date("j-M-Y h:i:s a", strtotime($comment->created_date)) . '</b></small>
                               </div>
                            </a>
                         </div>';
            }

            foreach ($data['recent_tasks'] as $task) {
                $details1 = '<div class="list-group" >
   <div class="col-md-12 list-group-item list-group-item-action flex-column align-items-start" style="margin-top:10px;">
      <div class="d-flex w-100 justify-content-between">
         <div class="col-md-12"><b>Name :</b>' . $task->contact_person . '</div>
         <div class="col-md-12"><b>Mobile No :</b>' . $task->mobile . '</div>
         <div class="col-md-12"><b>Email :</b>' . $task->email . '</div>
         <div class="col-md-12"><b>Designation :</b>' . $task->designation . '</div>
         <div class="col-md-12"><b>Conversaion  :</b>' . $task->conversation . '</div>
         <div class="col-md-12"><b>' . date("j-M-Y h:i:s a", strtotime($task->nxt_date)) . '</b></div>
         <div class="col-md-12">
            <i class="fa fa-pencil color-success" style="float:right;" data-toggle="modal" data-target="#task_redit' . $task->resp_id . '"></i>
         </div>
      </div>
   </div>
   <div id="task_redit' . $task->resp_id . '" class="modal fade in" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" onclick="closedmodel()">&times;</button>
               <h4 class="modal-title">Edit Task</h4>
            </div>
            <div class="modal-body">
               <form action="lead/enquiry_response_updatetask" method="post">
                  <div class="profile-edit">
                     <div class="form-group col-sm-6">
                        <label>Actual Meet Date</label>
                        <input class="form-control date" name="meeting_date" value="' . date("d-m-Y h:i:s a", strtotime($task->upd_date)) . '" type="text" placeholder="yyyy-mm-dd" readonly>
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Contact Person Name</label>
                        <input type="text" class="form-control" name="contact_person" value="' . $task->contact_person . '" placeholder="Contact Person Name">
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Contact Person Mobile No</label>
                        <input type="text" class="form-control" name="mobileno" value="' . $task->mobile . '">
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Contact Person Email</label>
                        <input type="text" class="form-control" name="email" value="' . $task->email . '">
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Contact Person Designation</label>
                        <input type="text" class="form-control" name="designation" value="' . $task->designation . '">
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Conversaion Details</label>
                        <textarea class="form-control" name="conversation">' . $task->conversation . '
                        </textarea>
                     </div>
                     <div class="form-group">
                        <input type="hidden" name="enq_code"  value="' . $task->resp_id . '" >
                        <input type="hidden" name="task_type" value="1">
                        <input type="submit" name="update" class="btn btn-primary"  value="' . display('update') . '" >
                     </div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closedmodel()">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>';
            }

            //  echo json_encode($d); 
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('details' => $details, 'details1' => $details1)));
        } else {
            $details = '';
            $details1 = '';
            $task_start = $this->input->post('task_start');
            $task_id = $this->input->post('task_id');
            $task_end = $this->input->post('task_end');
            $data['recent_tasks'] = $this->Task_Model->search_task_btw_date($task_start, $task_id, $task_end);
            $data['search_task'] = $this->Task_Model->search_btw_task($task_start, $task_id, $task_end);
            foreach ($data['search_task'] as $comment) {
                $details .= '<div class="list-group" id="comment_div">
                            <a class="list-group-item list-group-item-action flex-column align-items-start">
                               <div class="d-flex w-100 justify-content-between">
                                  <p class="mb-1">' . $comment->comment_msg . '</p>
                                  <small><b>' . date("j-M-Y h:i:s a", strtotime($comment->created_date)) . '</b></small>
                               </div>
                            </a>
                         </div>';
            }

            foreach ($data['recent_tasks'] as $task) {
                $details1 = '<div class="list-group" >
   <div class="col-md-12 list-group-item list-group-item-action flex-column align-items-start" style="margin-top:10px;">
      <div class="d-flex w-100 justify-content-between">
         <div class="col-md-12"><b>Name :</b>' . $task->contact_person . '</div>
         <div class="col-md-12"><b>Mobile No :</b>' . $task->mobile . '</div>
         <div class="col-md-12"><b>Email :</b>' . $task->email . '</div>
         <div class="col-md-12"><b>Designation :</b>' . $task->designation . '</div>
         <div class="col-md-12"><b>Conversaion  :</b>' . $task->conversation . '</div>
         <div class="col-md-12"><b>' . date("j-M-Y h:i:s a", strtotime($task->nxt_date)) . '</b></div>
         <div class="col-md-12">
            <i class="fa fa-pencil color-success" style="float:right;" data-toggle="modal" data-target="#task_redit' . $task->resp_id . '"></i>
         </div>
      </div>
   </div>
   <div id="task_redit' . $task->resp_id . '" class="modal fade in" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" onclick="closedmodel()">&times;</button>
               <h4 class="modal-title">Edit Task</h4>
            </div>
            <div class="modal-body">
               <form action="lead/enquiry_response_updatetask" method="post">
                  <div class="profile-edit">
                     <div class="form-group col-sm-6">
                        <label>Actual Meet Date</label>
                        <input class="form-control date" name="meeting_date" value="' . date("d-m-Y h:i:s a", strtotime($task->upd_date)) . '" type="text" placeholder="yyyy-mm-dd" readonly>
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Contact Person Name</label>
                        <input type="text" class="form-control" name="contact_person" value="' . $task->contact_person . '" placeholder="Contact Person Name">
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Contact Person Mobile No</label>
                        <input type="text" class="form-control" name="mobileno" value="' . $task->mobile . '">
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Contact Person Email</label>
                        <input type="text" class="form-control" name="email" value="' . $task->email . '">
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Contact Person Designation</label>
                        <input type="text" class="form-control" name="designation" value="' . $task->designation . '">
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Conversaion Details</label>
                        <textarea class="form-control" name="conversation">' . $task->conversation . '
                        </textarea>
                     </div>
                     <div class="form-group">
                        <input type="hidden" name="enq_code"  value="' . $task->resp_id . '" >
                        <input type="hidden" name="task_type" value="1">
                        <input type="submit" name="update" class="btn btn-primary"  value="' . display('update') . '" >
                     </div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closedmodel()">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>';
            }

            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('details' => $details, 'details1' => $details1)));
        }
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

    //Get Message Templates enquiry_model
    public function msg_templates() {

        $template = $this->input->post('tmpl_id');

        echo json_encode($this->enquiry_model->get_templates($template));
    }    

    //Insert customer type in table..
    public function add_customer_types() {
        $customer_type = $this->input->post('input_cus_type');
        $is_active = $this->input->post('status');
        $created_on = date('d-m-Y');
        $added_by = $this->session->user_id;
        $data = array(
            'customer_type' => $customer_type,
            'comp_id' => $this->session->userdata('companey_id'),
            'is_active' => $is_active,
            'added_on' => $created_on,
            'added_by' => $added_by
        );
        $this->enquiry_model->add_customer_type($data);
        $this->session->set_flashdata('message', 'Customer type added successfully');
        return redirect('Enquiry/load_customer_channel_mater');
    }

    public function edit_customer_types() {
        $customer_type = $this->input->post('input_cus_type');
        $is_active = $this->input->post('status');
        $id = $this->input->post('row_id');
        $updated_on = date('d-m-Y');
        $updated_by = $this->session->user_id;
        $data = array(
            'customer_type' => $customer_type,
            'is_active' => $is_active,
            'updated_on' => $updated_on,
            'updated_by' => $updated_by
        );
        $this->enquiry_model->update_customer_type($data, $id);
        $this->session->set_flashdata('message', 'Customer type updated successfully');
        return redirect('Enquiry/load_customer_channel_mater');
    }

    public function delete_customer_type() {
        $delete_ids = $this->input->post('favorite');
        $this->enquiry_model->delete_customer_types($delete_ids);
    }

    public function add_channel_partner_types() {
        $channel_partner = $this->input->post('channel_partner');
        $is_active = $this->input->post('status');
        $created_on = date('d-m-Y');
        $added_by = $this->session->user_id;
        $data = array(
            'channel_partner_type' => $channel_partner,
            'is_active' => $is_active,
            'added_on' => $created_on,
            'added_by' => $added_by
        );
        $this->enquiry_model->add_channel_partner($data);
        $this->session->set_flashdata('message', 'Channel partner added successfully');
        return redirect('Enquiry/load_customer_channel_mater');
    }

    public function update_channel_partner() {
        $input_cus_type = $this->input->post('input_cus_type');
        $is_active = $this->input->post('status');
        $id = $this->input->post('row_id');
        $updated_on = date('d-m-Y');
        $updated_by = $this->session->user_id;
        $data = array(
            'channel_partner_type' => $input_cus_type,
            'is_active' => $is_active,
            'updated_on' => $updated_on,
            'updated_by' => $updated_by
        );

        $this->enquiry_model->update_channel_partner($data, $id);
        $this->session->set_flashdata('message', 'Channel partner updated successfully');
        return redirect('Enquiry/load_customer_channel_mater');
    }

    public function delete_channel_partner() {
        $delete_ids = $this->input->post('favorite');
        $this->enquiry_model->delete_channel_partner_type($delete_ids);
    }

    public function add_name_prefix() {
        $name_prefix = $this->input->post('name_prefix');
        $is_active = $this->input->post('status');
        $created_on = date('d-m-Y');
        $added_by = $this->session->user_id;
        $data = array(
            'prefix' => $name_prefix,
            'comp_id' => $this->session->userdata('companey_id'),
            'is_active' => $is_active,
            'added_on' => $created_on,
            'added_by' => $added_by
        );
        $this->enquiry_model->name_prefix($data);
        $this->session->set_flashdata('message', 'Name Prefix added successfully');
        return redirect('lead/load_customer_channel_mater');
    }

    public function add_partner_type() {
        $name_prefix = $this->input->post('name_type');
        $created_on = date('d-m-Y');
        $added_by = $this->session->user_id;
        $data = array(
            'type' => $name_prefix,
            'date' => $created_on,
            'added_by' => $added_by
        );
        $this->enquiry_model->name_partner($data);
        $this->session->set_flashdata('message', 'Partner Type added successfully');
        return redirect('Enquiry/load_customer_channel_mater');
    }

    public function update_name_prefix() {
        $name_prefix = $this->input->post('name-prefix');
        $is_active = $this->input->post('status');
        $id = $this->input->post('row_id');
        $updated_on = date('d-m-Y');
        $updated_by = $this->session->user_id;
        $data = array(
            'prefix' => $name_prefix,
            'is_active' => $is_active,
            'updated_on' => $updated_on,
            'updated_by' => $updated_by
        );
        $this->enquiry_model->update_name_prefixes($id, $data);
        $this->session->set_flashdata('message', 'Name prefix updated successfully');
        return redirect('lead/load_customer_channel_mater');
    }

    public function update_name_partner() {
        $name_prefix = $this->input->post('name-type');
        $id = $this->input->post('row_id');
        $updated_on = date('d-m-Y');
        $updated_by = $this->session->user_id;
        $data = array(
            'type' => $name_prefix,
            'updated_on' => $updated_on,
            'updated_by' => $updated_by
        );
        $this->enquiry_model->update_name_partner($id, $data);
        $this->session->set_flashdata('message', 'Partner Type updated successfully');
        return redirect('Enquiry/load_customer_channel_mater');
    }

    public function delete_name_prefix() {
        $delete_ids = $this->input->post('favorite');
        $this->enquiry_model->delete_name_prefixes($delete_ids);
    }

    public function delete_name_partners() {
        $delete_ids = $this->input->post('favorite');
        $this->enquiry_model->delete_name_ptype($delete_ids);
    }
    /******************************************************personel tab data ajax**********************************************/
    public function select_state_by_con() {
        $states = $this->input->post('enq_state');
        echo json_encode($this->enquiry_model->all_states($states));

       // echo $diesc;
    }


    // enquiry datatable

    public function enquiry_load(){
        $this->load->model('enquiry_datatable_model');

        $list = $this->enquiry_datatable_model->get_datatables();

        $data = array();

        $no = $_POST['start'];
        
        $i = 1;
        
        foreach ($list as $each) {
        
            $no++;
        
            $row = array();
        
            $row[] = '<input onclick="event.stopPropagation();" type="checkbox" name="enquiry_id[]" class="checkbox1" value="<?php echo $each->enquiry_id; ?>">';
            
            $row[] = $i;

            $row[] = $each->icon_url;

            $row[] = $each->company;

            $row[] = $each->name_prefix . " " . $each->name . " " . $each->lastname;

            $row[] = $each->email;

            $row[] = $each->phone;

            $row[] = $each->address;

            $row[] = $each->created_date;

            $row[] = $each->created_by;

            $row[] = $each->aasign_to;

            $row[] = $each->datasource_name;

            
            $data[] = $row;

            $i++;

        }

            /*[0] => stdClass Object
        (
            [enquiry_id] => 3859
            [Enquery_id] => ENQ080009806847
            [email] => demo@mgail.com
            [phone] => 8965457812
            [name_prefix] => Mr.
            [name] => DEMO DATA
            [lastname] => Test
            [gender] => 1
            [reference_type] => 
            [reference_name] => 
            [enquiry] => Noida
            [org_name] => 
            [enquiry_source] => 0
            [enquiry_subsource] => 
            [ip_address] => 14.143.74.69
            [status] => 1
            [drop_status] => 0
            [drop_reason] => 
            [country_id] => 1
            [product_id] => 3
            [institute_id] => 
            [center_id] => 
            [datasource_id] => 
            [created_date] => 2019-11-12 11:49:27
            [created_by] => 107
            [update_date] => 
            [aasign_to] => 
            [assign_by] => 
            [checked] => 0
            [checked_by] => 
            [user_role] => 3
            [lead_score] => 
            [lead_stage] => 
            [lead_discription] => 
            [lead_discription_reamrk] => 
            [lead_comment] => 
            [lead_expected_date] => 
            [lead_created_date] => 
            [lead_updated_date] => 
            [lead_drop_status] => 0
            [lead_drop_reason] => 
            [client_drop_status] => 0
            [client_drop_reason] => 
            [company] =>  test
            [address] =>  Noida
            [city_id] => 1102
            [state_id] => 2
            [territory_id] => 2
            [region_id] => 1
            [is_delete] => 1
            [whatsapp_sent_status] => 
            [whatsapp_sent_mobile_no] => 
            [whatsapp_msg] => 
            [icon_url] => 
            [lsid] => 
            [score_count] => 
            [lead_name] => 
            [datasource_name] => 
        )*/
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->enquiry_datatable_model->count_all(),
            "recordsFiltered" => $this->enquiry_datatable_model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);

    }
    public function delete_institute(){
        $this->db->where('id',$this->input->post('inst_id'));
        if($this->db->delete('institute_data')){
            echo json_encode(array('status'=>true,'msg'=>'Successfully Deleted'));
        }else{
            echo json_encode(array('status'=>false,'msg'=>'Something went wrong'));            
        }
    }

      public function delete_comission(){
        $this->db->where('id',$this->input->post('id'));
        if($this->db->delete('tbl_comission')){
            echo json_encode(array('status'=>true,'msg'=>'Successfully Deleted'));
        }else{
            echo json_encode(array('status'=>false,'msg'=>'Something went wrong'));            
        }
    }

    public function get_update_enquery_institute_content(){
        $id    =   $this->input->post('id');
        $Enquiry_id    =   $this->input->post('Enquiry_id');
        $this->db->where('id',$id);
        $data['institute_data']    =   $this->db->get('institute_data')->row_array();
        $data['Enquiry_id'] =   $Enquiry_id;   
        $data['details']    =   $this->enquiry_model->enquiry_by_code($Enquiry_id);
        $data['institute_app_status'] = $this->Institute_model->get_institute_app_status();
        if ($this->session->companey_id=='67') { 
        //$data['qualification_data'] = $this->enquiry_model->quali_data($data['details']->Enquery_id);
        //$data['english_data'] = $this->enquiry_model->eng_data($data['details']->Enquery_id);
        $data['discipline'] = $this->location_model->find_discipline();
        $data['level'] = $this->location_model->find_level();
        $data['length'] = $this->location_model->find_length();
        }
        $data['institute_list'] = $this->Institute_model->institutelist_by_country($data['details']->country_id);        
        $content    =   $this->load->view('institute_modal_content',$data,true);
        echo $content;
    }
    
    
    
      public function re_login($id, $process){
         $user_id=$id;
           $check_user = $this->dashboard_model->check_user_enquiry($user_id); 
          $city_id = $this->db->select("*")
                        ->from("city")
                        ->where('id', $check_user->row()->city_id)
                        ->get();
                          $setting = $this->setting_model->read();
        
        $data['title'] = (!empty($setting->title) ? $setting->title : null);
        $data['logo'] = (!empty($setting->logo) ? $setting->logo : null);
        $data['favicon'] = (!empty($setting->favicon) ? $setting->favicon : null);
        $data['footer_text'] = (!empty($setting->footer_text) ? $setting->footer_text : null);
                $data = $this->session->set_userdata([
                     'isLogIn' => true,
                    'user_id' => $check_user->row()->pk_i_admin_id,
                    'companey_id' => $check_user->row()->companey_id,
                    'email' => $check_user->row()->email,
                    'designation' => $check_user->row()->designation,
                    'phone' => $check_user->row()->s_phoneno,
                    'fullname' => $check_user->row()->s_display_name . '&nbsp;' . $check_user->row()->last_name,
                    'country_id' =>0,
                    'region_id' => 0,
                    'territory_id' => 0,
                    'state_id' => 0,
                    'city_id' => 0,
                    /*'user_role' => $check_user->row()->user_roles,
                    'user_type' => $check_user->row()->user_type,*/
                    'user_right' => $check_user->row()->user_permissions,
                    'picture' => $check_user->row()->picture,
                    'modules' => $check_user->row()->modules,
                    'title' => (!empty($setting->title) ? $setting->title : null),
                    'address' => (!empty($setting->description) ? $setting->description : null),
                    'logo' => (!empty($setting->logo) ? $setting->logo : null),
                    'favicon' => (!empty($setting->favicon) ? $setting->favicon : null),
                    'footer_text' => (!empty($setting->footer_text) ? $setting->footer_text : null),
                    'process' => $process,
                    'telephony_agent_id' => $check_user->row()->telephony_agent_id
                ]);
            
               if (!empty($check_user->result())) {
                redirect(base_url().'enquiry/create_from.html');
            } else {
                $array=array('error'=>'Invalid Username or Password');
                   $this->set_response([
                'status' => false,
                'message' => $array
            ], REST_Controller::HTTP_OK);
            }           
       
   }
   
   /***************************************************************student edit profile******************************************/
   public function viewpro($enquiry_id = null) {

        $compid = $this->session->userdata('companey_id');
       
        $data['title'] = display('information');

        if (!empty($_POST)) {
            $name = $this->input->post('enquirername');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobileno');
            $lead_source = $this->input->post('lead_source');
            $enquiry = $this->input->post('enquiry');
            $en_comments = $this->input->post('enqCode');
            $company = $this->input->post('company');
            $address = $this->input->post('address');
            $name_prefix = $this->input->post('name_prefix');
            $this->db->set('country_id', $this->input->post('country_id'));
            $this->db->set('product_id', $this->input->post('product_id'));
            $this->db->set('institute_id', $this->input->post('institute_id'));
            $this->db->set('datasource_id', $this->input->post('datasource_id'));
            $this->db->set('phone', $mobile);
            $this->db->set('enquiry_subsource',$this->input->post('sub_source'));
            $this->db->set('email', $email);
            $this->db->set('company', $company);
            $this->db->set('address', $address);
            $this->db->set('name_prefix', $name_prefix);
            $this->db->set('name', $name);
            $this->db->set('enquiry_source', $lead_source);
            $this->db->set('enquiry', $enquiry);
            $this->db->set('coment_type',1);
            $this->db->set('lastname', $this->input->post('lastname'));
            $this->db->where('enquiry_id', $enquiry_id);
            $this->db->update('enquiry');
            $this->Leads_Model->add_comment_for_events(display("enquiry_updated"), $en_comments);
            $this->session->set_flashdata('message', 'Save successfully');
            redirect('enquiry/view/' . $enquiry_id);
        }
        
        
       
        
        
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id); 
        $data['ins_list'] = $this->location_model->stu_ins_list();
        $data['vid_list'] = $this->schedule_model->vid_list();  
        $data['course_list'] = $this->Institute_model->courselist();
        $data['institute_list'] = $this->Institute_model->institutelist();
        // $compid = $data['details']->comp_id;

        // print_r($data['vid_list']);exit();

        //$data['state_city_list'] = $this->location_model->get_city_by_state_id($data['details']->enquiry_state_id);
        //$data['state_city_list'] = $this->location_model->ecity_list();

         $stu_phone=$this->session->userdata('phone');
        $data['student_Details'] = $this->home_model->studentdetail($stu_phone);
        $studetails = $this->home_model->studentdetail($stu_phone);
        
        $en_id=$studetails['Enquery_id'];
        $comp_id=$studetails['comp_id'];
        
        //print_r($data['student_Details']);exit;
        $data['invoice_details'] = $this->home_model->invoicedetail($en_id);
        $data['agrrem_doc'] = $this->home_model->aggr_doc($en_id);
        $data['schdl_list'] = $this->schedule_model->get_schedule_list();

        $data['allleads'] = $this->Leads_Model->get_leadList();
        if (!empty($data['details'])) {
            $lead_code = $data['details']->Enquery_id;
        }        
        $data['check_status'] = $this->Leads_Model->get_leadListDetailsby_code($lead_code);       
        $data['all_drop_lead'] = $this->Leads_Model->all_drop_lead();
        $data['products'] = $this->dash_model->get_user_product_list();

        $this->enquiry_model->change_enq_status( $data['details']->Enquery_id);
       

         // print_r($data['amc_list']);exit();
        $data['allcountry_list'] = $this->Taskstatus_model->countrylist();
        $data['allstate_list'] = $this->Taskstatus_model->statelist();
        $data['allcity_list'] = $this->Taskstatus_model->citylist();
        $data['personel_list'] = $this->Taskstatus_model->peronellist($enquiry_id);        
        $data['kyc_doc_list'] = $this->Kyc_model->kyc_doc_list($lead_code);        
        $data['education_list'] = $this->Education_model->education_list($lead_code);
        $data['social_profile_list'] = $this->SocialProfile_model->social_profile_list($lead_code);        
        $data['close_femily_list'] = $this->Closefemily_model->close_femily_list($lead_code);
        $data['all_country_list'] = $this->location_model->country();
        $data['all_contact_list'] = $this->location_model->contact($enquiry_id);                
        $data['subsource_list'] = $this->Datasource_model->subsourcelist();
        $data['drops'] = $this->Leads_Model->get_drop_list();
        $data['name_prefix'] = $this->enquiry_model->name_prefix_list();
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        $data['enquiry'] = $this->enquiry_model->enquiry_by_id($enquiry_id);
        $data['lead_stages'] = $this->Leads_Model->get_leadstage_list();
        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $enquiry_code = $data['enquiry']->Enquery_id;
        $phone_id = '91'.$data['enquiry']->phone;        
        $data['recent_tasks'] = $this->Task_Model->get_recent_taskbyID($enquiry_code);        
        $data['comment_details'] = $this->Leads_Model->comment_byId($enquiry_code);        
        $user_role    =   $this->session->user_role;
        $data['country_list'] = $this->location_model->productcountry();

        $data['institute_list'] = $this->Institute_model->institutelist_by_country($data['details']->enq_country);
        
        $data['institute_app_status'] = $this->Institute_model->get_institute_app_status();
        

        $data['datasource_list'] = $this->Datasource_model->datasourcelist();
        $data['taskstatus_list'] = $this->Taskstatus_model->taskstatuslist();
        $data['state_list'] = $this->location_model->estate_list();
        $data['city_list'] = $this->location_model->ecity_list();
        $data['product_contry'] = $this->location_model->productcountry();
        $data['get_message'] = $this->Message_models->get_chat($phone_id);
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        $data['all_estage_lists'] = $this->Leads_Model->find_estage($enquiry_id);

        $data['institute_data'] = $this->enquiry_model->institute_data($data['details']->Enquery_id);
         $data['comission_data'] = $this->enquiry_model->comission_data($data['details']->Enquery_id);
        $data['dynamic_field']  = $this->enquiry_model->get_dyn_fld($enquiry_id);
         $data['ins_list'] = $this->location_model->get_ins_list($data['details']->Enquery_id);
        //$data['aggrement_list'] = $this->location_model->get_agg_list($data['details']->Enquery_id);
        $data['prod_list'] = $this->Doctor_model->product_list($compid); 
        $data['amc_list'] = $this->Doctor_model->amc_list($compid,$enquiry_id); 
        
        $data['tab_list'] = $this->form_model->get_tabs_list($this->session->companey_id,$data['details']->product_id);
        $this->load->helper('custom_form_helper');
        $data['discipline'] = $this->location_model->find_discipline();
        $data['level'] = $this->location_model->find_level();
        $data['length'] = $this->location_model->find_length();
        $data['enquiry_id'] = $enquiry_id;
        $data['all_description_lists']    =   $this->Leads_Model->find_description();
        
        $data['compid']     =  $data['details']->comp_id;
        $data['content'] = $this->load->view('enq_proedit', $data, true);
        $this->enquiry_model->assign_notification_update($enquiry_code);
        $this->load->view('layout/main_wrapper', $data);
    }



    function enq_redirect($id){     
        $this->db->select('status');
        $this->db->where('enquiry_id',$id);
        $r  =   $this->db->get('enquiry')->row_array();     

        if ($r['status']  == 1) {
            $url= 'enquiry/view/'.$id;              
        }else if ($r['status']  == 2) {
            $url= 'lead/lead_details/'.$id;             
        }else if ($r['status']  == 3) {
            $url= 'client/view/'.$id;                               
        }else if ($r['status']  == 4) {
            $url= 'refund/view/'.$id;                               
        }
        redirect($url,'refresh');
    }

    /****************************************************student edit profile********************************************/

    // public function create_from() {
        
    //  $userno     = $this->session->user_id;
    //  $proccessno = $this->session->process;
        
 //        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
 //        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
    //  $data["userno"]     = $userno;
    //  $data["proccessno"]     = $proccessno;

 //        // print_r($proccessno);exit();
        
 //        $data['title'] = display('new_enquiry');
 //        $this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|required', array('is_unique' => 'Duplicate   entry for phone'));
        
 //        $enquiry_date = $this->input->post('enquiry_date');
 //        if($enquiry_date !=''){
 //          $enquiry_date = date('Y-m-d', strtotime($enquiry_date));
 //        }else{
 //          $enquiry_date = date('Y-m-d', strtotime($enquiry_date));
 //        } 
 //       $city_id= $this->db->select("*")
    //      ->from("city")
    //      ->where('id',$this->input->post('city_id'))
    //      ->get();
 //        $other_phone = $this->input->post('other_no[]');

    //  $usrarr = $this->db->select("*")
    //                       ->where("pk_i_admin_id", $userno)
    //                       ->from("tbl_admin")
    //                       ->get()
    //                       ->row();

 //        if ($this->form_validation->run() === true) {
 //            $name = $this->input->post('enquirername');
 //            $name_w_prefix = $name;
 //            $encode = $this->get_enquery_code();
 //            if(!empty($other_phone)){
 //               $other_phone =   implode(',', $other_phone);
 //            }else{
 //                $other_phone = '';
 //            }
 //            $postData = [
 //                'Enquery_id' => $encode,
 //                'user_role' => $this->session->user_role,
 //                'email' => $this->input->post('email', true),
 //                'phone' => $this->input->post('mobileno', true),
    //          'comp_id'    => $usrarr->companey_id,
 //                'other_phone'=> $other_phone,
 //                'name_prefix' => $this->input->post('name_prefix', true),
 //                'name' => $name_w_prefix,
 //                'lastname' => $this->input->post('lastname'),
 //                'gender' => $this->input->post('gender'),
 //                'reference_type' => $this->input->post('reference_type'),
 //                'reference_name' => $this->input->post('reference_name'),
 //                'enquiry' => $this->input->post('enquiry', true),
 //                'enquiry_source' => $this->input->post('lead_source'),
 //                'enquiry_subsource' => $this->input->post('sub_source'),
 //                'company' => $this->input->post('company'),
 //                'address' => $this->input->post('address'),
 //                'checked' => 0,
 //                'product_id' => $this->input->post('product_id'),
 //                'institute_id' => $this->input->post('institute_id'),
 //                'datasource_id' => $this->input->post('datasource_id'),
 //                'center_id' => $this->input->post('center_id'),
 //                'ip_address' => $this->input->ip_address(),
 //                'created_by' => $this->session->user_id,
 //                'city_id' => $city_id->row()->id,
    //          'state_id' => $city_id->row()->state_id,
    //          'country_id'  =>$city_id->row()->country_id,
 //                'region_id'  =>$city_id->row()->region_id,
 //                'territory_id'  =>$city_id->row()->territory_id,
 //                'created_date' =>$enquiry_date, 
 //                'status' => 1
 //            ];
 //            if ($this->enquiry_model->create($postData)) {
 //                $insert_id = $this->db->insert_id();
 //                $this->Leads_Model->add_comment_for_events($this->lang->line("enquery_create"), $encode);                
 //                echo '<br><br>Your Enquiry has been  Successfully created';
                
 //            }
 //        } else {
            
        
            
    //      if(!empty($usrarr)){
                
    //          $compno = $usrarr->companey_id;
    //      }else{
    //          $compno = "";
    //      }
            
            
            
            
 //            $this->load->model('Dash_model', 'dash_model');
 //            $data['name_prefix'] = $this->enquiry_model->name_prefix_list();
 //           // $user_role    =   $this->session->user_role;
            
 //            $data['products'] = $this->dash_model->get_user_product_list();
 //            $data['product_contry'] = $this->location_model->productcountry();
 //            $data['institute_list'] = $this->Institute_model->institutelist();
 //            $data['datasource_list'] = $this->Datasource_model->datasourcelist();
 //            $data['datasource_lists'] = $this->Datasource_model->datasourcelist2();
 //            $data['subsource_list'] = $this->Datasource_model->subsourcelist();
 //            $data['center_list'] = $this->Center_model->all_center();
 //            $data['state_list'] = $this->location_model->estate_list();
 //            $data['city_list'] = $this->location_model->ecity_list();
 //            $data['country_list'] = $this->location_model->ecountry_list();
 //            $data['company_list'] = $this->location_model-> get_company_list_api($proccessno, $compno );
            
    //  //  echo $this->db->last_query();
 //            $this->load->view('create_newenq', $data);
 //        }
 //    }

        /*public function zip_extract(){         
             $zip = new ZipArchive;
             $filename = 'aws.zip';
             $res = $zip->open("third_party/".$filename);
             if ($res === TRUE) {
               // Unzip path
               $extractpath = "third_party/aws/";
               // Extract file
               $zip->extractTo($extractpath); 
               $zip->close();
               echo "success";
               
             } else { 
                echo "error"; 
             }
                
        }*/
        public function get_enquiry_by_code($enquiry_code){
            $data    =   $this->enquiry_model->enquiry_by_code($enquiry_code);
            if (!empty($data)) {
                echo json_encode($data);
            }else{
                echo 0;
            }
        } 

    public function get_institute_tab_content($enquiry_id){
        $data = array();
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);           
        $data['institute_list'] = $this->Institute_model->institutelist_by_country($data['details']->enq_country); 
        $data['course_list'] = $this->Leads_Model->get_course_list();
        $data['institute_app_status'] = $this->Institute_model->get_institute_app_status();
        
        $data['institute_data'] = $this->enquiry_model->institute_data($data['details']->Enquery_id);
        //echo $this->db->last_query();
        $data['ins_list'] = $this->location_model->get_ins_list($data['details']->Enquery_id);
        
        if ($this->session->companey_id=='67') {
            $data['discipline'] = $this->location_model->find_discipline();
            $data['level'] = $this->location_model->find_level();
            $data['length'] = $this->location_model->find_length();
        }
        
        //echo "string";
        //print_r($data['institute_data']);

        echo $this->load->view('enquiry/institute_tab_content',$data,true);
    }

    public function get_document_tab_content($enquiry_id){
        $data = array();
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);
    
        $data['post_doc_list'] = $this->Leads_Model->get_postdoc_list($data['details']->enq_country);
        $data['post_doctab_view'] = $this->Leads_Model->get_tabdoc_list($data['details']->Enquery_id);
        $data['all_c_vs_d'] = $this->location_model->c_vs_d_select();
        $data['all_c_vs_s'] = $this->location_model->c_vs_s_select();
        $data['all_c_vs_f'] = $this->location_model->c_vs_f_select();

        echo $this->load->view('tab_document_new',$data,true);
    }

    public function get_family_tab_content($enquiry_id){
        $data = array();
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);

        $data['family_tab_view'] = $this->Leads_Model->get_family_list($data['details']->Enquery_id);
        $data['all_tab_member'] = $this->Leads_Model->get_member_list($data['details']->Enquery_id);

        echo $this->load->view('tab_family',$data,true);
    }

    public function get_education_tab_content($enquiry_id){
        $data = array();
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);
        
        $data['all_qualification_test'] = $this->Leads_Model->get_test_list();
        $data['tab_qualification'] = $this->Leads_Model->get_qualification_list($data['details']->Enquery_id);
        $data['all_tab_member'] = $this->Leads_Model->get_member_list($data['details']->Enquery_id);

        echo $this->load->view('tab_qualification',$data,true);
    }

    public function get_job_tab_content($enquiry_id){
        $data = array();
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);
        
        $data['tab_job_detail'] = $this->Leads_Model->get_job_list($data['details']->Enquery_id);
        $data['all_tab_member'] = $this->Leads_Model->get_member_list($data['details']->Enquery_id);

        echo $this->load->view('tab_jobdetail',$data,true);
    }

    public function get_experience_tab_content($enquiry_id){
        $data = array();
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);
        
        $data['tab_exp_detail'] = $this->Leads_Model->get_exp_list($data['details']->Enquery_id);
        $data['all_tab_member'] = $this->Leads_Model->get_member_list($data['details']->Enquery_id);

        echo $this->load->view('tab_experience',$data,true);
    }

    public function get_payment_tab_content($enquiry_id){
        $data = array();
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);
        
        $data['fee_list'] = $this->location_model->get_fee_list($data['details']->Enquery_id);
        $data['all_installment'] = $this->Leads_Model->installment_select();
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        $data['ins_list'] = $this->location_model->get_ins_list($data['details']->Enquery_id);

        echo $this->load->view('tab_payment',$data,true);
    }

    public function get_agreement_tab_content($enquiry_id){
        $data = array();
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);
        
        $data['all_tempname'] = $this->Leads_Model->agrtemp_name();
        $data['all_template'] = $this->location_model->agrformat_select($data['details']->Enquery_id);

        echo $this->load->view('tab_aggriment_new',$data,true);
    }

    public function get_logintrail_tab_content($enquiry_id){
        $data = array();
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);
        
        $data['login_user_id'] = $this->user_model->get_user_by_email($data['details']->email);
        if (!empty($data['login_user_id']->pk_i_admin_id)) {
            $data['login_details'] = $this->Leads_Model->logdata_select($data['login_user_id']->pk_i_admin_id);            
        }

        echo $this->load->view('tab_login_trail',$data,true);
    }

        public function mark_tag(){        
        $this->form_validation->set_rules('enquiry_id[]','Data','required');
        $this->form_validation->set_rules('tags[]','Tags','required');
        
        if($this->form_validation->run() == true){
            $enq = $this->input->post('enquiry_id[]');
            $tags = implode(',',$this->input->post('tags[]'));

            foreach ($enq as $key => $value) {
                if($this->db->where('enq_id',$value)->count_all_results('enquiry_tags')){
                    $this->db->where('comp_id',$this->session->companey_id);
                    $this->db->where('enq_id',$value);
                    $this->db->set('tag_ids',$tags);
                    $this->db->update('enquiry_tags');
                }else{
                    $this->db->insert('enquiry_tags',array('comp_id'=>$this->session->companey_id,'enq_id'=>$value,'tag_ids'=>$tags));
                }

//For Rule Notification
$this->db->where('enquiry_id',$value);
$this->db->set('tag_status',$tags);
$this->db->update('enquiry');
$enquery_id = $this->db->where(array('enquiry_id'=>$value))->get('enquiry')->row()->Enquery_id;
$this->load->model('rule_model');
$this->rule_model->execute_rules($enquery_id,array(1,2,3,6,7,12));              
            }
            echo json_encode(array('status'=>true,'msg' =>'Tag marked successfully'));
        }else{
            echo json_encode(array('status'=>false,'msg' =>validation_errors()));
        }

    }
// TIMLINE SHOW HIDE CASE
    public function timeline_access()
    {

            $pk_id = $this->input->post('pk_id');
            $status = $this->input->post('status');
            //print_r($pk_id);exit;
            $this->db->set('timline_access', $status);
            $this->db->where('pk_i_admin_id', $pk_id);
            $this->db->update('tbl_admin');
            if ( $this->db->affected_rows() > 0 )
            {
                $data = array(
                    'timline_sts'  => $status, 
                );
                $this->session->set_userdata($data);
                echo '1';
            }

    }

 function get_exist_alert()
    {    
        $type = $this->input->post('type');
        $parameter = $this->input->post('parameter');
        $process_id = $this->input->post('process_id');
        $enq_no = $this->input->post('enq_no');
        $company = $this->session->companey_id;
    
        $this->db->select('enquiry_id,Enquery_id,name_prefix,name,lastname,status,phone,email,tbl_admin.s_display_name,tbl_admin.last_name,assign.s_display_name as assign_first,assign.last_name as assign_last');
        $this->db->join('tbl_admin','tbl_admin.pk_i_admin_id=enquiry.created_by','left');
        $this->db->join('tbl_admin as assign','assign.pk_i_admin_id=enquiry.aasign_to','left');
        if($parameter=='mobile'){
        $this->db->where('phone',$type);
        }
        if($parameter=='email'){
        $this->db->where('email',$type);
        }
        $this->db->where('comp_id',$company);
        //$this->db->where('product_id',$process_id);
        $res=$this->db->get('enquiry');
        $enq_id=$res->row();
        
        
        if(!empty($enq_id->enquiry_id)){
            if($enq_id->status==1){
                $url = 'enquiry/view/'.$enq_id->enquiry_id;
            }else if($enq_id->status==2){
                $url = 'lead/lead_details/'.$enq_id->enquiry_id;
            }else if($enq_id->status==3){
                $url = 'client/view/'.$enq_id->enquiry_id;
            }else if ($enq_id->status==4) {
                $url = 'refund/view/'.$enq_id->enquiry_id;;
            }else{
                $url = 'javascript:void(0)';
            }
            $html = '<table class="table table-bordered table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created By</th>
                            <th>Assign To</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>'.$enq_id->name_prefix.' '.$enq_id->name.' '.$enq_id->lastname.'</td>
                            <td>'.$enq_id->email.'</td>
                            <td>'.$enq_id->phone.'</td>
                            <td>'.$enq_id->s_display_name.' '.$enq_id->last_name.'</td>
                            <td>'.$enq_id->assign_first.' '.$enq_id->assign_last.'</td>
                            <td><a href="'.base_url($url).'" target="_blank">View Lead</a></td>
                        </tr>
                    </table>';

//For old contact no and email auto fill
        if(empty($enq_no)){
            $enq_no = $enq_id->Enquery_id;
        }
        $this->db->select('phone,email');
        $this->db->where('Enquery_id',$enq_no);
        $old_res=$this->db->get('enquiry');
        $enq_old=$old_res->row();

    echo json_encode(array('table_content'=>$html,'old_phone'=>$enq_old->phone,'old_email'=>$enq_old->email));
        }           
    }

}