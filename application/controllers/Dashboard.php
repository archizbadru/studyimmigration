<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    $this->load->library('user_agent');
    $this->load->library('upload');
        $this->load->model(array(
            'dashboard_model',
            'setting_model',
            'user_model',
      'website/home_model',
      'Institute_model',
      'schedule_model',
            'report', 'location_model', 'report_model', 'User_model', 'Modules_model',
            'enquiry_model', 'Leads_Model', 'Client_Model','Message_models'
        ));

    }
         public function fb_token() { 
     $challenge = $_REQUEST['hub_challenge'];
        $verify_token = $_REQUEST['hub_verify_token'];
        if ($verify_token === 'abc123') {
        //echo $challenge;
        }
        $input = file_get_contents('php://input');
         $this->db->set('response',$input);
         $this->db->insert('fb_setting');
          $updateid=$this->db->insert_id();
          if(!empty(json_decode($input)->entry[0]->changes[0]->value->leadgen_id)){
                $leadgen_id=json_decode($input)->entry[0]->changes[0]->value->leadgen_id;
                $page_id=json_decode($input)->entry[0]->changes[0]->value->page_id;
                $form_id=json_decode($input)->entry[0]->changes[0]->value->form_id;
                $ad_id=json_decode($input)->entry[0]->changes[0]->value->ad_id;
                $this->db->select('page_token');
                 $this->db->where('page_id',$page_id);
                 $res=$this->db->get('fb_page')->row();
                 $access_token='';
                if(!empty($res)){
                 $access_token=$res->page_token;
                }
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://graph.facebook.com/v8.0/".$leadgen_id."?access_token=".$access_token,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "GET",
                  CURLOPT_POSTFIELDS => "",
                  CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/json"
                  ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                } else {
       foreach(json_decode($response)->field_data as $v){
          $email1 = $phone1  = $name1 = '';
        
      if(!empty($v) && $v->{'name'}==='full_name'){
          $name=$v->{'values'};
          $name1=$name[0];
        }   
        if(!empty($v) && $v->{'name'}==='phone_number'){
         $phone=$v->{'values'};
         $phone1=$phone[0];
        } 
        if(!empty($v) && $v->{'name'}==='email'){
         $email=$v->{'values'};
         $email1= $email[0];
        }     
            }  
         $this->db->select('from_id,from_name,compaign_name,add_set_name,add_name,course_name');
            $this->db->where('from_id',$ad_id);
            $res_db=$this->db->get('fb_from_details')->row();      
            if(!empty($res_db)){
             $from_id=$res_db->from_id;
             $from_name=$res_db->from_name;
             $compaign_name=$res_db->compaign_name;
             $add_set_name=$res_db->add_set_name;
             $add_name=$res_db->add_name;
             $course_name=$res_db->course_name;
             }else{
             $from_id='';
             $from_name='';
             $compaign_name='';
             $add_set_name='';
             $add_name='';
             $course_name='';
             } 
         $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://thecrm360.com/new_crm/api/enquiry/create",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"mobileno\"\r\n\r\n".$phone1."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"company_id\"\r\n\r\n81\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"user_id\"\r\n\r\n511\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"process_id\"\r\n\r\n175\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"fname\"\r\n\r\n".$name1."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"email\"\r\n\r\n".$email1."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"product_id\"\r\n\r\n".$course_name."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"4393\"\r\n\r\n".$compaign_name."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"4394\"\r\n\r\n".$add_name."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"4392\"\r\n\r\n".$add_set_name."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"4395\"\r\n\r\n".$from_name."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"4399\"\r\n\r\n".$response."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"enquiry_source\"\r\n\r\n209\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                  CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                  ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                } else { 
                   $this->db->set('is_status',1);
                   $this->db->where('id',$updateid);
                   $this->db->update('fb_setting');
                }


                        }
                     }
     }
     
    public function fb_page(){ 
        if(!empty($this->input->post('page_id'))){
        $this->db->where('page_id',$this->input->post('page_id'));
        $res=$this->db->get('fb_page')->row();
        if(empty($res)){
         $this->db->set('page_id',$this->input->post('page_id'));
         $this->db->set('page_token',$this->input->post('page_token'));
         $this->db->insert('fb_page');
         }else{
         $this->db->set('page_token',$this->input->post('page_token'));
         $this->db->where('page_id',$this->input->post('page_id'));
         $this->db->update('fb_page');  
        }
       }
       $this->db->select('response,id');
       //$this->db->where('is_status',1);
       $res_fb=$this->db->get('fb_setting')->result();
        if(!empty($res_fb)){
        foreach ($res_fb as $d){
        if(!empty(json_decode($d->response)->entry[0]->changes[0]->value->leadgen_id)){
                $leadgen_id=json_decode($d->response)->entry[0]->changes[0]->value->leadgen_id;
                $page_id=json_decode($d->response)->entry[0]->changes[0]->value->page_id;
                $form_id=json_decode($d->response)->entry[0]->changes[0]->value->form_id;
                $ad_id=json_decode($d->response)->entry[0]->changes[0]->value->ad_id;
                $this->db->select('page_token');
                 $this->db->where('page_id',$page_id);
                 $res=$this->db->get('fb_page')->row();
                 $access_token='';
                if(!empty($res)){
                 $access_token=$res->page_token;
                }
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://graph.facebook.com/v8.0/".$leadgen_id."?access_token=".$access_token,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "GET",
                  CURLOPT_POSTFIELDS => "",
                  CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/json"
                  ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    
                } else {
                foreach(json_decode($response)->field_data as $v){
                   $email1 = $phone1  = $name1 = '';
                 
                  if(!empty($v) && $v->{'name'}==='full_name'){
                      $name=$v->{'values'};
                      $name1=$name[0];
                    }   
                    if(!empty($v) && $v->{'name'}==='phone_number'){
                     $phone=$v->{'values'};
                     $phone1=$phone[0];
                    } 
                    if(!empty($v) && $v->{'name'}==='email'){
                     $email=$v->{'values'};
                     $email1= $email[0];
                    }     
                 } 
            $this->db->select('from_id,from_name,compaign_name,add_set_name,add_name,course_name');
            $this->db->where('from_id',$ad_id);
            $res_db=$this->db->get('fb_from_details')->row();      
            if(!empty($res_db)){
             $from_id=$res_db->from_id;
             $from_name=$res_db->from_name;
             $compaign_name=$res_db->compaign_name;
             $add_set_name=$res_db->add_set_name;
             $add_name=$res_db->add_name;
             $course_name=$res_db->course_name;
             }else{
             $from_id='';
             $from_name='';
             $compaign_name='';
             $add_set_name='';
             $add_name='';
             $course_name='';
             } 
          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://thecrm360.com/new_crm/api/enquiry/create",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"mobileno\"\r\n\r\n".$phone1."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"company_id\"\r\n\r\n81\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"user_id\"\r\n\r\n511\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"process_id\"\r\n\r\n175\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"fname\"\r\n\r\n".$name1."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"email\"\r\n\r\n".$email1."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"product_id\"\r\n\r\n".$course_name."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"4393\"\r\n\r\n".$compaign_name."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"4394\"\r\n\r\n".$add_name."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"4392\"\r\n\r\n".$add_set_name."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"4395\"\r\n\r\n".$from_name."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"4399\"\r\n\r\n".$response."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"enquiry_source\"\r\n\r\n209\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                  CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                  ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                } else { 
                   $this->db->set('is_status',1);
                   $this->db->where('id',$d->id);
                   $this->db->update('fb_setting');
                }
                }
                }
                }
                }
     }
    public function index() { 
       
        
        $sessionId      =   $this->input->get('sessionId');
        $campaignId     =   $this->input->get('campaignId');
        $crtObjectId    =   $this->input->get('crtObjectId');
        $userCrtObjectId=   $this->input->get('userCrtObjectIds');
        $userId         =   $this->input->get('userId');
        $customerId     =   $this->input->get('customerId');
        $phone          =   $this->input->get('phone');

        if ($sessionId && $campaignId && $userCrtObjectId && $userId) {            
            $user_data    =   $this->user_model->get_user_by_email($userId);
            if (!empty($user_data) && $user_data->companey_id == 79) {

                $this->session->set_userdata('user_id',$user_data->pk_i_admin_id);     

                if(user_access(230) || user_access(231) || user_access(232) || user_access(233) || user_access(234) || user_access(235) || user_access(236)){ 

                    $arr = explode(',', $user_data->process);
                    $this->session->set_userdata('companey_id',$user_data->companey_id);                
                    $process_filter =   get_cookie('selected_process');
                    
                    if (!empty($process_filter)) {
                        $process_filter = explode(',', $process_filter);                                
                        $process_filter = array_intersect($process_filter, $arr);
                        if(empty($process_filter)){
                            $this->session->set_userdata('process',$arr);
                        }else{
                            $this->session->set_userdata('process',$process_filter);
                        }
                    }else{
                        $process_filter = array();
                
                        $this->session->set_userdata('process',$arr);
                    }
                    $c = implode(',', $this->session->process);
                    set_cookie('selected_process',$c,'31536000'); 
                 
                } 


                $city_row = $this->db->select("*")
                        ->from("city")
                        ->where('id', $user_data->city_id)
                        ->get();  

                $location_arr = array();
                if(!empty($city_row->row_array())){
                    $location_arr = $city_row->row_array();
                }                      
                $aws_folder   =   $this->user_model->get_user_aws_folder($user_data->companey_id);
                $pament_detail   =   $this->user_model->get_user_payment_detail($user_data->companey_id);
                $data = $this->session->set_userdata([
                'awsfolder'      => $aws_folder->firstname.' '.$aws_folder->lastname,
                'integration_name'        => $pament_detail->integration_name,
                'key_id'         => $pament_detail->key_id,
                'key_secret'     => $pament_detail->key_secret,
                'isLogIn'        => true,
                'user_id'        => $user_data->pk_i_admin_id,
                'companey_id'    => $user_data->companey_id,
                'email'          => $user_data->s_user_email,
                'designation'    => $user_data->designation,
                'phone'          => $user_data->s_phoneno,
                'timline_sts'    => $user_data->timline_access,
                'fullname'       => $user_data->s_display_name.' '.$user_data->last_name,
                'country_id'     => !empty($location_arr)?$location_arr['country_id']:'',
                'region_id'      => !empty($location_arr)?$location_arr['region_id']:'',
                'territory_id'   => !empty($location_arr)?$location_arr['territory_id']:'',
                'state_id'       => !empty($location_arr)?$location_arr['state_id']:'',
                'city_id'        => $user_data->city_id,                   
                'user_right'     => $user_data->user_permissions,
                'picture'        => $user_data->picture,
                'modules'        => $user_data->modules,
                'title'          => (!empty($setting->title) ? $setting->title : null),
                'address'        => (!empty($setting->description) ? $setting->description : null),
                'logo'           => (!empty($setting->logo) ? $setting->logo : null),
                'favicon'        => (!empty($setting->favicon) ? $setting->favicon : null),
                'footer_text'    => (!empty($setting->footer_text) ? $setting->footer_text : null),
                'telephony_type' => $user_data->telephony_type,                    
                'telephony_agent_id'=> $user_data->telephony_agent_id,
                'telephony_token'=> $user_data->telephony_token,
                'telephony_login'=> $user_data->telephony_login_id,
                'telephony_pass' => $user_data->telephony_agent_pass,
                'expiry_date'    => strtotime($user_data->valid_upto),
                'availability'   => $user_data->availability,
                'dept_name'      => $user_data->dept_name,
                'ameyo'          => array(
                                    'sessionId' =>$sessionId,
                                    'campaignId' =>$campaignId,
                                    'crtObjectId'=>$crtObjectId,
                                    'userCrtObjectId'=>$userCrtObjectId,
                                    'userId'=>$userId,
                                    'customerId'=>$customerId,
                                    'phone'=>$phone
                                )   
            ]);
            }else{
                redirect();
            }
        }


        if ($this->session->userdata('isLogIn'))
            $this->redirectTo($this->session->userdata('user_role'));
        $this->form_validation->set_rules('email', display('email'), 'required|max_length[50]|valid_email');
        $this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5');
        
        //$this->form_validation->set_rules('process', 'Process', 'required');

        //$process    =   $this->input->post('process');
        
        $setting = $this->setting_model->read();
        
        $data['title'] = (!empty($setting->title) ? $setting->title : null);
        $data['logo'] = (!empty($setting->logo) ? $setting->logo : null);
        $data['favicon'] = (!empty($setting->favicon) ? $setting->favicon : null);
        $data['footer_text'] = (!empty($setting->footer_text) ? $setting->footer_text : null);
        $data['user'] = (object) $postData = [
            'email' => $this->input->post('email', true),
            'password' => md5($this->input->post('password', true)),
        ];
        $this->load->model('dash_model');
        
        $data['products'] = $this->dash_model->product_list();

        if ($this->form_validation->run() === true) {
            $check_user = $this->dashboard_model->check_user($postData);

            if ($check_user->num_rows() === 1) {
/*                echo "<pre>";
                print_r($check_user);
                echo "</pre>";
                exit();
*/
              /*  if($check_user->row()->user_roles == 8||$check_user->row()->user_roles == 9){
                    $user_process = explode(',', $check_user->row()->process);
                    if (!in_array($process, $user_process)) {
                        $this->session->set_flashdata('exception', 'You are not in this process.');
                        redirect('login');
                    }
                }*/

                $city_id = $this->db->select("*")
                        ->from("city")
                        ->where('id', $check_user->row()->city_id)
                        ->get();
  if($check_user->row()->user_permissions==151){
  $menu=1;
  }else{
    $menu=2;
  }
  $aws_folder   =   $this->user_model->get_user_aws_folder($user_data->companey_id);
  $pament_detail   =   $this->user_model->get_user_payment_detail($user_data->companey_id);
                $data = $this->session->set_userdata([
                    'awsfolder'       => $aws_folder->firstname.' '.$aws_folder->lastname,
                    'integration_name'        => $pament_detail->integration_name,
                    'key_id'         => $pament_detail->key_id,
                    'key_secret'     => $pament_detail->key_secret,
                    'menu' => $menu,
                    'isLogIn' => true,
                    'user_id' => $check_user->row()->pk_i_admin_id,
                    'companey_id' => $check_user->row()->companey_id,
                    'email' => $check_user->row()->s_user_email,
                    'designation' => $check_user->row()->designation,
                    'phone' => $check_user->row()->s_phoneno,
                    'timline_sts'    => $check_user->row()->timline_access,
                    'fullname' => $check_user->row()->s_display_name . ' ' . $check_user->row()->last_name,
                    'country_id' => $city_id->row()->country_id,
                    'region_id' => $city_id->row()->region_id,
                    'territory_id' => $city_id->row()->territory_id,
                    'state_id' => $city_id->row()->state_id,
                    'city_id' => $check_user->row()->city_id,
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
                    // 'process' => $process,
                    'telephony_type'=> $check_user->row()->telephony_type,
                    'telephony_agent_id' => $check_user->row()->telephony_agent_id,
                    'telephony_token'    => $check_user->row()->telephony_token,
                    'telephony_login'=> $user_data->telephony_login_id,
                    'telephony_pass'=> $user_data->telephony_agent_pass,
                    'availability'    => $check_user->row()->availability,
                    'dept_name'     => $check_user->row()->dept_name,
                    'expiry_date'       => strtotime($check_user->row()->valid_upto),
                ]);
               // print_r($_SESSION);die;
                //if()
                //$this->session->set_userdata('token', random_string('alnum', 16));
                // echo "f";
                // return;
                redirect('dashboard/home');
            } else {
                $this->session->set_flashdata('exception', display('incorrect_email_password'));
                redirect('login');
            }
        } else {
            $this->load->view('layout/login_wrapper', $data);
        }
    }


   public function backupDatabase(){  
  if ($this->session->user_right == 1) {    
   $this->load->dbutil();
  $prefs = array(
    'format' => 'zip',
    'filename' => 'crmdata.sql'
  );
  $backup = & $this->dbutil->backup($prefs);
  $db_name = 'crm-on-' . date("Y-m-d-H-i-s") . '.zip';
  $save = 'assets/database_backup/' . $db_name;
  $this->load->helper('file');
  write_file($save, $backup);
  $this->load->helper('download');
  force_download($db_name, $backup); 
  }
}
 public function backupfiles(){ 
   if ($this->session->user_right == 1) { 
$this->load->library('zip');
    $path=$_SERVER["DOCUMENT_ROOT"].'/new_crm/';
    $this->zip->read_dir($path); 
    $this->zip->download('file_backup.zip'); 
   }
 }

    public function validate_login() {  
  
        $this->form_validation->set_rules('email', display('email'), 'required|max_length[50]|trim');
        $this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5');        
        
        $data['user'] = (object) $postData = [
            'email' => trim($this->input->post('email', true)),
            'password' => md5($this->input->post('password', true)),
        ];

        $this->load->model('dash_model');

        if ($this->input->post('remember_me')) {
             $this->rememberme->setCookie($data['user']->email);
        }
        
        if ($this->form_validation->run() === true) {
            $check_user = $this->dashboard_model->check_user($postData);                       
           
            $active = 1;
            // if($check_user->num_rows() && $check_user->row()->user_permissions!=1 && ($check_user->row()->status == 0 || $check_user->row()->status == null) ){
            //     $active = 0;
            // }
            if ($check_user->num_rows() === 1 && $active) {
                
                $city_row = $this->db->select("*")
                        ->from("city")
                        ->where('id', $check_user->row()->city_id)
                        ->get();                        
                
                $user_data = $check_user->row();
                $this->session->set_userdata('user_id',$user_data->pk_i_admin_id);                
                if(user_access(230) || user_access(231) || user_access(232) || user_access(233) || user_access(234) || user_access(235) || user_access(236)){ 

                    $arr = explode(',', $user_data->process);
                    $this->session->set_userdata('companey_id',$user_data->companey_id);                
                    $process_filter =   get_cookie('selected_process');
                    
                    if (!empty($process_filter)) {
                        $process_filter = explode(',', $process_filter);                                
                        $process_filter = array_intersect($process_filter, $arr);
                        if(empty($process_filter)){
                            $this->session->set_userdata('process',$arr);
                        }else{
                            $this->session->set_userdata('process',$process_filter);
                        }
                    }else{
                        $process_filter = array();
                
                        $this->session->set_userdata('process',$arr);
                    }
                    $c = implode(',', $this->session->process);
                    set_cookie('selected_process',$c,'31536000'); 
                 
                }               


                $location_arr = array();
                if(!empty($city_row->row_array())){
                    $location_arr = $city_row->row_array();
                }                

                
                   if(0){                        
                        $user_process = explode(',', $user_data->process);                        

                        $this->db->select('sb_id,product_name');
                        $this->db->where('comp_id',$this->session->companey_id);
                        $this->db->where_in('sb_id',$user_process);
                       $process_arr     =   $this->db->get('tbl_product')->result_array();                      
                       
                       $process = [];
                       
                       $process_html = '';
                       
                       if(!empty($process_arr)){
              
                            if(user_access(270)){               
                $process_html .= "<select class='form-control text-center' name='user_process[]' multiple id='process_elem'>";
              }else{
                $process_html .= "<select class='form-control text-center' name='user_process[]' id='process_elem'>";
              }
                            foreach ($process_arr as $value) {                                
                                $process_html .= "<option value='".$value['sb_id']."'>".$value['product_name']."</option>";
                                $process[$value['sb_id']] = $value['product_name'];
                            }
              $process_html .= "</select>";                                                       

                            $res = array('status'=>true,'message'=>'Successfully Logged In','process'=>$process_html);

                       }else{
                            $res = array('status'=>false,'message'=>'You are not in any process. Please contact your admin!','process'=>$process_html);
                       }
                   }else{
             if($user_data->user_permissions==151){
                         $menu=1;
                      }else{
                         $menu=2;
                      }
                        $aws_folder   =   $this->user_model->get_user_aws_folder($user_data->companey_id);
                        $pament_detail   =   $this->user_model->get_user_payment_detail($user_data->companey_id);
                        if(!empty($pament_detail)){
                         $integration_name = $pament_detail->integration_name;
                         $key_id = $pament_detail->key_id;
                         $key_secret = $pament_detail->key_secret;
                        }else{
                          $integration_name = '';
                         $key_id = '';
                         $key_secret = '';
                        }
                        $data = $this->session->set_userdata([
                            'awsfolder'             => $aws_folder->firstname.' '.$aws_folder->lastname,
                            'integration_name'      => $integration_name,
                            'key_id'                => $key_id,
                            'key_secret'            => $key_secret,
                            'menu'                  => $menu,
                            'isLogIn'               => true,
                            'user_id'               => $user_data->pk_i_admin_id,
                            'companey_id'           => $user_data->companey_id,
                            //'process'               => $check_user->row()->process,
                            'email'                 => $user_data->s_user_email,
                            'designation'           => $user_data->designation,
                            'phone'                 => $user_data->s_phoneno,
                            'timline_sts'           => $user_data->timline_access,
                            'fullname'              => $user_data->s_display_name . ' ' . $user_data->last_name,
                            'country_id'            => !empty($location_arr)?$location_arr['country_id']:'',
                            'region_id'             => !empty($location_arr)?$location_arr['region_id']:'',
                            'territory_id'          => !empty($location_arr)?$location_arr['territory_id']:'',
                            'state_id'              => !empty($location_arr)?$location_arr['state_id']:'',
                            'city_id'               => $user_data->city_id,                   
                            'user_right'            => $user_data->user_permissions,
                            'picture'               => $user_data->picture,
                            'modules'               => $user_data->modules,
                            'title'                 => (!empty($setting->title) ? $setting->title : null),
                            'address'               => (!empty($setting->description) ? $setting->description : null),
                            'logo'                  => (!empty($setting->logo) ? $setting->logo : null),
                            'favicon'               => (!empty($setting->favicon) ? $setting->favicon : null),
                            'footer_text'           => (!empty($setting->footer_text) ? $setting->footer_text : null),
                            'telephony_type'        => $user_data->telephony_type,                    
                            'telephony_agent_id'    => $user_data->telephony_agent_id,
                            'telephony_token'       => $user_data->telephony_token,
                            'telephony_login'=> $user_data->telephony_login_id,
                            'telephony_pass'=> $user_data->telephony_agent_pass,
                            'expiry_date'           => strtotime($user_data->valid_upto),
                            'availability'    => $user_data->availability,
                            'dept_name'       => $user_data->dept_name,
                            'branch_name'     => $user_data->sales_branch,
                        ]);
                        $this->user_model->add_login_history();
                        $res = array('status'=>true,'message'=>'Successfully Logged In');                       
                   }
            } else {
                $res = array('status'=>false,'message'=>display('incorrect_email_password'));
            }
        } else {
            $res = array('status'=>false,'message'=>validation_errors());            
        }
        echo json_encode($res);
    }



public function login_in_process(){

    $this->form_validation->set_rules('email', display('email'), 'required|max_length[50]|valid_email');
    $this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5');        
    $this->form_validation->set_rules('process_ids[]', 'Process ', 'required');
    $data['user'] = (object) $postData = [
        'email' => $this->input->post('email', true),
        'password' => md5($this->input->post('password', true)),
    ];
    $this->load->model('dash_model');        
    if ($this->form_validation->run() === true) {

        $check_user = $this->dashboard_model->check_user($postData);
        if ($check_user->num_rows() === 1) {                
            $city_row = $this->db->select("*")
                    ->from("city")
                    ->where('id', $check_user->row()->city_id)
                    ->get();            
            $location_arr = array();
            if(!empty($city_row->row_array())){
                $location_arr = $city_row->row_array();
            }
            
            if(user_access(230) || user_access(231) || user_access(232) || user_access(233) || user_access(234) || user_access(235) || user_access(236)){
                
                if(is_array($this->input->post('process_ids'))){
                    $process_ids = $this->input->post('process_ids');
                }else{
                    $process_ids = array($this->input->post('process_ids'));
                }
        if($check_user->row()->user_permissions==151){
  $menu=1;
  }else{
    $menu=2;
  }

                    $data = $this->session->set_userdata([
              'menu'                  => $menu,
                        'isLogIn'               => true,
                        'user_id'               => $check_user->row()->pk_i_admin_id,
                        'companey_id'           => $check_user->row()->companey_id,
                        'email'                 => $check_user->row()->s_user_email,
                        'designation'           => $check_user->row()->designation,
                        'phone'                 => $check_user->row()->s_phoneno,
                        'timline_sts'           => $check_user->row()->timline_access,
                        'fullname'              => $check_user->row()->s_display_name . ' ' . $check_user->row()->last_name,
                        'country_id'            => !empty($location_arr)?$location_arr['country_id']:'',
                        'region_id'             => !empty($location_arr)?$location_arr['region_id']:'',
                        'territory_id'          => !empty($location_arr)?$location_arr['territory_id']:'',
                        'state_id'              => !empty($location_arr)?$location_arr['state_id']:'',
                        'city_id'               => $check_user->row()->city_id,                   
                        'user_right'            => $check_user->row()->user_permissions,
                        'picture'               => $check_user->row()->picture,
                        'modules'               => $check_user->row()->modules,
                        'title'                 => (!empty($setting->title) ? $setting->title : null),
                        'address'               => (!empty($setting->description) ? $setting->description : null),
                        'logo'                  => (!empty($setting->logo) ? $setting->logo : null),
                        'favicon'               => (!empty($setting->favicon) ? $setting->favicon : null),
                        'footer_text'           => (!empty($setting->footer_text) ? $setting->footer_text : null), 
                        'telephony_type'        => $check_user->row()->telephony_type,                
                        'telephony_agent_id'    => $check_user->row()->telephony_agent_id,
                        'telephony_token'       => $check_user->row()->telephony_token,
                        'telephony_login'=> $user_data->telephony_login_id,
                        'telephony_pass'=> $user_data->telephony_agent_pass,
                        'process'               => $process_ids,
                        'expiry_date'           => strtotime($check_user->row()->valid_upto),
                        'account_type'          => $check_user->row()->account_type,
                        'availability'    => $check_user->row()->availability,

                    ]);         
                    $res = array('status'=>true,'message'=>'Logged in');                                        
               }else{                    
                    $res = array('status'=>false,'message'=>'Something went wrong');
               }
            } else {
                $res = array('status'=>false,'message'=>display('incorrect_email_password'));
            }
        } else {
            $res = array('status'=>false,'message'=>validation_errors());            
        }
        echo json_encode($res);
    }   

    public function redirectTo($user_role = null) {
        redirect('dashboard/home');
    }

    public function sales_dashboard() {
        $this->load->view('salesdash');
    }

    public function update_all_whatsapp_received(){        
    
        $received_whats_app = $this->enquiry_model->get_received_whats_app(); 
        if(!empty($received_whats_app)){
            $this->enquiry_model->set_received_whats_app_status($received_whats_app); 
        }
        
    }
    public function home1() {
        if ($this->session->userdata('isLogIn') == false)
            redirect('login');
        $data['content'] = $this->load->view('home', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
  
  public function home() 
    {
        // echo "<pre>";
        // print_r($this->session);
        // return;
        if ($this->session->userdata('isLogIn') == false)
        redirect('login');

        if ($this->session->userdata('user_right') == 201) // lalantop user
        redirect('buy');        
        
        if ($this->session->userdata('user_right') == 200) // lalantop user
        redirect('product');        

        $data = array();
        $this->load->model('dash_model');
        if($this->session->userdata('user_right')==151 || $this->session->userdata('user_right')==180 || $this->session->userdata('user_right')==183)
        {
            $data['ins_list'] = $this->location_model->stu_ins_list();
            redirect('dashboard/search_programs');
        }else if ($this->session->userdata('user_right')==214 || $this->session->userdata('user_right')==219 || $this->session->userdata('user_right')==223 || $this->session->userdata('user_right')==231) {
          $stu_phone=$this->session->userdata('phone');
          $studetails = $this->home_model->studentdetail($stu_phone);
          if(($studetails['portal_validity'] <= date('Y-m-d')) && ($this->session->userdata('user_right')==214 || $this->session->userdata('user_right')==219 || $this->session->userdata('user_right')==223 || $this->session->userdata('user_right')==231)){
            redirect('dashboard/logout');
          }else{
          //print_r($studetails);exit;
            redirect('dashboard/user_profile/'.$studetails['enquiry_id']);
          }
        }
        else
        {
            $data['counts'] = $this->enquiry_model->enquiryLeadClientCount($this->session->user_id,$this->session->companey_id);
            $data['msg'] = '';
            //print_r($_SESSION);die;
            date_default_timezone_set('Asia/Kolkata');
            $from = $this->session->expiry_date;
            $today = time();
            $difference = $from - $today;
            $days = floor($difference / 86400);
            //echo "string".$days;die;
            if($this->session->account_type == 1)
            {
                if($days <= 5 && $days > 0)
                {
                    $data['msg'] = "Your Account will expire after $days days Please contact your site admin to extend validity";
                }
                if($days <= 0)
                {
                    $data['msg'] = "Your Account hs been expired on ".date('d-M-Y',strtotime($this->session->expiry_date))." Please contact your site admin to extend validity";
                }
            }
            else
            {   if($days <= 5 && $days > 0)
                {
                    $data['msg'] = "Your Account will expire after $days days Please contact your site admin to extend validity";
                }
                if($days <= 0)
                {
                    $array['heading'] = "Trial Account Expired";
                    $array['message'] = "Your trial account validity has been ended please contact to site administrator";
                    $this->load->view("errors/html/error_general",$array,true);
                }
            }
            
            $data['state']   = $this->enquiry_model->get_state();
            $data['products'] = $this->dash_model->product_list_graph();
            $data['taskdata'] = $this->dash_model->task_list();
            $data['cmtdata'] = $this->dash_model->all_comments();
        }
        $data['lead_score'] = $this->db->query('select * from lead_score limit 3')->result();
        if(user_access(770) && (!in_array($this->session->userdata('user_right'), admin))){ //For legal department
        $data['aggrement'] = $this->enquiry_model->allaggrementCount($this->session->user_id,$this->session->companey_id);
        $data['allaggrement'] = $this->enquiry_model->get_all_aggrement($this->session->user_id);
        $data['content'] = $this->load->view('dashboard/legal_department', $data, true);
        }else if(user_access(750) && (!in_array($this->session->userdata('user_right'), admin))){ //For Case Mgmt
        $data['refund'] = $this->enquiry_model->allrefundCount($this->session->user_id,$this->session->companey_id);
        $data['allrefund'] = $this->enquiry_model->get_all_refund($this->session->user_id);
        $data['content'] = $this->load->view('dashboard/case_management', $data, true);
        }else if(user_access(760) && (!in_array($this->session->userdata('user_right'), admin))){ //For Account team
        $data['payment'] = $this->enquiry_model->allpaymentCount($this->session->user_id,$this->session->companey_id);
        $data['allrefund'] = $this->enquiry_model->get_all_refund($this->session->user_id);
        $data['allpaid'] = $this->enquiry_model->get_all_paid($this->session->user_id);
        $data['upcoming'] = $this->enquiry_model->get_all_upcoming_payment(date('Y-m-d'),date('Y-m-d'));
        $data['content'] = $this->load->view('dashboard/account_department', $data, true);
        }else{
            // echo "fcx";
            // return;
        $data['content'] = $this->load->view('home', $data, true); 
        }      
        $this->load->view('layout/main_wrapper', $data);
    }


    public function find_payment_detail()
  {
    $from_created = $this->input->post("from_date");   
    $to_created = $this->input->post("to_date");
    
    

      $data['upcoming'] = $this->enquiry_model->get_all_upcoming_payment($from_created,$to_created);
      $data['payment'] = $this->enquiry_model->allpaymentCount($this->session->user_id,$this->session->companey_id);
      $data['allrefund'] = $this->enquiry_model->get_all_refund($this->session->user_id);
      $data['allpaid'] = $this->enquiry_model->get_all_paid($this->session->user_id);
      $data['from_date'] = $from_created;
      $data['to_date'] = $to_created;
      $data['content'] = $this->load->view('dashboard/account_department', $data, true);
      $this->load->view('layout/main_wrapper', $data);
        
  }


    public function processWiseChart()
    {   
       // echo "string";die;
        $process = implode(',',$this->session->process);
        $chartData = $this->enquiry_model->processWiseChart($this->session->user_id,$this->session->companey_id,$process);
        //print_r($chartData);die;
        if(!empty($chartData))
        {
            echo json_encode(array('data'=>$chartData,'status'=>'success'));
        }
        else
        {
            echo json_encode(array('status'=>'fail'));
        }
    }

    public function enquiryLeadClientChart()
    {   
       // echo "string";die;
        $chartData = $this->enquiry_model->enquiryLeadClientChart($this->session->user_id,$this->session->companey_id);
        //print_r($chartData);die;
        if(!empty($chartData))
        {
            echo json_encode(array('data'=>$chartData,'status'=>'success'));
        }
        else
        {
            echo json_encode(array('status'=>'fail'));
        }
    }

    public function conversionProbabilityChart()
    {   
       // echo "string";die;
        $chartData = $this->enquiry_model->conversionProbabilityChart($this->session->user_id,$this->session->companey_id);
        //print_r($chartData);die;
        if(!empty($chartData))
        {
            echo json_encode(array('data'=>$chartData,'status'=>'success'));
        }
        else
        {
            echo json_encode(array('status'=>'fail'));
        }
    }

    public function dropDataChart()
    {   
       // echo "string";die;
        $chartData = $this->enquiry_model->dropDataChart($this->session->user_id,$this->session->companey_id);

        $droplst    = $chartData['droplst'];
        $enquiry    = $chartData['enquiry_dropWise'];
        $lead       = $chartData['lead_dropWise'];
        $client     = $chartData['client_dropWise'];

        $enquiryChartData   = array();
        $leadChartData      = array();
        $clientChartData    = array();

        foreach ($droplst as $key => $value) 
        {
            //echo $value['drop_reason'];
            $enquirycounter = $leadcounter = $clientcounter = 0;
            foreach ($enquiry as $key => $valueArray) 
            {
                if ($value['drop_reason'] == $valueArray['drop_reason']) 
                {
                   $enquirycounter =  $valueArray['counter'];
                   break;
                }
            }
            if ($enquirycounter>0) 
            {
                array_push($enquiryChartData, $enquirycounter);        
            }
            else
            {
                array_push($enquiryChartData, 0);
            }


            foreach ($lead as $key => $valueArray) 
            {
                if ($value['drop_reason'] == $valueArray['drop_reason']) 
                {
                   $leadcounter =  $valueArray['counter'];
                   break;
                }
            }
            if ($leadcounter>0) 
            {
                array_push($leadChartData, $leadcounter);        
            }
            else
            {
                array_push($leadChartData, 0);
            }


            foreach ($client as $key => $valueArray) 
            {
                if ($value['drop_reason'] == $valueArray['drop_reason']) 
                {
                   $clientcounter =  $valueArray['counter'];
                   break;
                }
            }
            if ($clientcounter>0) 
            {
                array_push($clientChartData, $clientcounter);        
            }
            else
            {
                array_push($clientChartData, 0);
            }

        }
        
        if(!empty($enquiryChartData))
        {
            echo json_encode(array('enquiryChartData'=>$enquiryChartData,'leadChartData'=>$leadChartData,'clientChartData'=>$clientChartData,'status'=>'success','droplst'=>$droplst));
        }
        else
        {
            echo json_encode(array('status'=>'fail'));
        }
    }

    public function despositionDataChart()
    {   
       // echo "string";die;
        $chartData = $this->enquiry_model->despositionDataChart($this->session->user_id,$this->session->companey_id);

        /*echo "<pre>";
        print_r($chartData);
        echo "</pre>";
        exit(); */

        $desplst    = $chartData['desplst'];
        $enquiry    = $chartData['despenq'];
        $lead       = $chartData['desplead'];
        $client     = $chartData['despcli'];

        $enquiryChartData   = array();
        $leadChartData      = array();
        $clientChartData    = array();

        foreach ($desplst as $key => $value) 
        {
            //echo $value['drop_reason'];
            $enquirycounter = $leadcounter = $clientcounter = 0;
            foreach ($enquiry as $key => $valueArray) 
            {
                if ($value['lead_stage_name'] == $valueArray['lead_stage_name']) 
                {
                   $enquirycounter =  $valueArray['counternow'];
                   break;
                }
            }
            if ($enquirycounter>0) 
            {
                array_push($enquiryChartData, $enquirycounter);        
            }
            else
            {
                array_push($enquiryChartData, 0);
            }


            foreach ($lead as $key => $valueArray) 
            {
                if ($value['lead_stage_name'] == $valueArray['lead_stage_name']) 
                {
                   $leadcounter =  $valueArray['counternow'];
                   break;
                }
            }
            if ($leadcounter>0) 
            {
                array_push($leadChartData, $leadcounter);        
            }
            else
            {
                array_push($leadChartData, 0);
            }


            foreach ($client as $key => $valueArray) 
            {
                if ($value['lead_stage_name'] == $valueArray['lead_stage_name']) 
                {
                   $clientcounter =  $valueArray['counternow'];
                   break;
                }
            }
            if ($clientcounter>0) 
            {
                array_push($clientChartData, $clientcounter);        
            }
            else
            {
                array_push($clientChartData, 0);
            }

        }
        
        if(!empty($enquiryChartData))
        {
            echo json_encode(array('enquiryChartData'=>$enquiryChartData,'leadChartData'=>$leadChartData,'clientChartData'=>$clientChartData,'status'=>'success','desplst'=>$desplst));
        }
        else
        {
            echo json_encode(array('status'=>'fail'));
        }
    }

    public function sourceDataChart()
    {   
       // echo "string";die;
        $chartData = $this->enquiry_model->sourceDataChart($this->session->user_id,$this->session->companey_id);

        $srclst    = $chartData['srclst'];
        $enquiry    = $chartData['EnquirySrc'];
        $lead       = $chartData['leadSrc'];
        $client     = $chartData['ClientSrc'];

        $enquiryChartData   = array();
        $leadChartData      = array();
        $clientChartData    = array();

        foreach ($srclst as $key => $value) 
        {
            //echo $value['drop_reason'];
            $enquirycounter = $leadcounter = $clientcounter = 0;
            foreach ($enquiry as $key => $valueArray) 
            {
                if ($value['lead_name'] == $valueArray['lead_name']) 
                {
                   $enquirycounter =  $valueArray['counternow'];
                   break;
                }
            }
            if ($enquirycounter>0) 
            {
                array_push($enquiryChartData, $enquirycounter);        
            }
            else
            {
                array_push($enquiryChartData, 0);
            }


            foreach ($lead as $key => $valueArray) 
            {
                if ($value['lead_name'] == $valueArray['lead_name']) 
                {
                   $leadcounter =  $valueArray['counternow'];
                   break;
                }
            }
            if ($leadcounter>0) 
            {
                array_push($leadChartData, $leadcounter);        
            }
            else
            {
                array_push($leadChartData, 0);
            }


            foreach ($client as $key => $valueArray) 
            {
                if ($value['lead_name'] == $valueArray['lead_name']) 
                {
                   $clientcounter =  $valueArray['counternow'];
                   break;
                }
            }
            if ($clientcounter>0) 
            {
                array_push($clientChartData, $clientcounter);        
            }
            else
            {
                array_push($clientChartData, 0);
            }

        }
        
        if(!empty($enquiryChartData))
        {
            echo json_encode(array('enquiryChartData'=>$enquiryChartData,'leadChartData'=>$leadChartData,'clientChartData'=>$clientChartData,'status'=>'success','srclst'=>$srclst));
        }
        else
        {
            echo json_encode(array('status'=>'fail'));
        }
    }

    public function monthWiseChart()
    {   
       // echo "string";die;
        $chartData = $this->enquiry_model->monthWiseChart($this->session->user_id,$this->session->companey_id);
        //print_r($chartData);die;
        if(!empty($chartData))
        {
            echo json_encode(array('data'=>$chartData,'status'=>'success'));
        }
        else
        {
            echo json_encode(array('status'=>'fail'));
        }
    }


    public function home2() {
       /* echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";*/
        
        if ($this->session->userdata('isLogIn') == false)
            redirect('login');

        $data['title']              = display('home');                    
        $data['all_enquery']        = $this->enquiry_model->all_enquery_count();                           
        $data['all_active']         = $this->Leads_Model->all_Active_lead_count(0, '*');                   
        $data['lead_stages']        = $this->Leads_Model->get_leadstage_list();                            
        $data['leadsource']         = $this->Leads_Model->get_leadsource_list();                                        
        $data['all_Active_clients'] = $this->Client_Model->all_Active_clients();                                        
        $data['total_whatsaap']     = $this->Message_models->total_whatsaap();                           
        $data['today_whatsapp']     = $this->Message_models->today_whatsapp();                          
        $data['total_msg']          = $this->Message_models->total_msg();                           
        $data['today_tody_msg']     = $this->Message_models->today_tody_msg();
        $received_whats_app = '';

        //$this->enquiry_model->get_received_whats_app(); 
        
        if(!empty($received_whats_app)){
            $this->enquiry_model->set_received_whats_app_status($received_whats_app); 
        }

        
        $this->load->model('dash_model');
        $data['products'] = $this->dash_model->product_list();

        $data['lead_score'] = $this->db->query('select * from lead_score limit 3')->result();
        $data['content'] = $this->load->view('home2', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function profile() {
        $data['title'] = display('profile');
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->user_model->read_by_id($user_id);
        $data['content'] = $this->load->view('profile', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function email_check($email, $user_id) {
        $emailExists = $this->db->select('email')
                ->where('email', $email)
                ->where_not_in('user_id', $user_id)
                ->get('user')
                ->num_rows();
        if ($emailExists > 0) {
            $this->form_validation->set_message('email_check', 'The {field} field must contain a unique value.');
            return false;
        } else {
            return true;
        }
    }
    public function form() {
        $data['title'] = display('edit_profile');
        $user_id = $this->session->userdata('user_id');
        $this->form_validation->set_rules('Name', display('disolay_name'), 'required');
        $this->form_validation->set_rules('cell', display('cell'), 'required|max_length[10]');
        $this->form_validation->set_rules('state_id', display('state_name'), 'required');
        $this->form_validation->set_rules('city_name', display('city_name'), 'required');
        //$this->form_validation->set_rules('user_role', display('user_role'), 'required');
        //$this->form_validation->set_rules('user_type', display('user_type'), 'required');
        $this->form_validation->set_rules('modules', display('customer_services'));
        $this->form_validation->set_rules('status', display('status'), 'required');
        if (empty($this->input->post('dprt_id'))) {
            $this->form_validation->set_rules('employee_id', display('employee_id'), 'required|is_unique[tbl_admin.employee_id]', array('is_unique' => 'Duplicate Entery For Employee Id '));
            $this->form_validation->set_rules('email', display('email'), 'required|is_unique[tbl_admin.s_user_email]', array('is_unique' => 'Duplicate Entery For email'));
            $this->form_validation->set_rules('password', display('password'), 'required|min_length[8]');
        }
        if (!empty($this->input->post('modules'))) {
            $modules = implode(",", $this->input->post('modules'));
        } else {
            $modules = '';
        }
        if (empty($this->input->post('dprt_id'))) {
            $password = md5($this->input->post('password', true));
        } else {
            $password = $this->input->post('old_pass', true);
        }
        if ($this->input->post('user_type')) {
            $permission = $this->input->post('user_type');
        } else {

            $permission = '';
        }
        $path = 'assets/images/user/';
        $config = array(
        'upload_path' => $path,
        'allowed_types' => "gif|jpg|png|jpeg",        
        'max_size' => "2048000",
        'encrypt_name' => true
        );
        $this->upload->initialize($config);
        $img = $this->upload->do_upload('file'
        );
        // if picture is uploaded then resize the picture
        /*if ($img !== false && $img != null) {
            $this->fileupload->do_resize(
                    $img, 293, 350
            );
        }*/
        //echo $this->upload->display_errors();
        $imageDetailArray = $this->upload->data();
        $img =  $path.$imageDetailArray['file_name'];
        //print_r($imageDetailArray);
        if ($this->session->user_id == 9) {
            $org = $this->input->post('org_name');
            $designation = '';
        } else {
            $org = '';
            $designation = $this->input->post('designation');
        }
        $data['department'] = (object) $postData = [
            'pk_i_admin_id' => $this->input->post('dprt_id', true),
            //'user_roles' => $this->input->post('user_role', true),
            //'user_type' => $this->input->post('user_type', true),
            'employee_id' => $this->input->post('employee_id', true),
            's_user_email' => $this->input->post('email', true),
            's_phoneno' => $this->input->post('cell', true),
            'second_email' => $this->input->post('second_email', true),
            'second_phone' => $this->input->post('second_phone', true),
            's_password' => $password,
            'modules' => $modules,
            's_display_name' => $this->input->post('Name', true),
            'state_id' => $this->input->post('state_id', true),
            'city_id' => $this->input->post('city_name', true),
            //'companey_id' => 1,
            'orgisation_name' => $org,
            //'user_permissions' => $permission,
            'last_name' => $this->input->post('last_name', true),
            'b_status' => $this->input->post('status', true),
            'date_of_birth' => $this->input->post('dob', true),
            'anniversary' => $this->input->post('anniversary', true),
            'contact_pname' => $this->input->post('cname', true),
            'contact_pemail' => $this->input->post('cemail', true),
            'contact_semail' => $this->input->post('csemail', true),
            'contact_phone' => $this->input->post('cphone', true),
            'contact_sphone' => $this->input->post('csphone', true),
            'designation' => $designation,
            'employee_band' => $this->input->post('employee_band', true),
            'country' => $this->input->post('country'),
            'region' => $this->input->post('region', true),
            'territory_name' => $this->input->post('territory', true),
            'add_ress' => $this->input->post('address', true),
            'picture' => (!empty($img) ? $img : $this->input->post('new_file')),
            //'report_to' => $this->input->post('report_to', true)
        ];
        if ($this->form_validation->run() === true) {
            if ($this->user_model->update($postData)) {
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
            if ($postData['pk_i_admin_id'] == $this->session->userdata('pk_i_admin_id')) {
                $this->session->set_userdata([
                    'picture' => $postData['picture'],
                ]);
            }
            redirect('dashboard/form/');
        } else {
            $data['state_list'] = $this->location_model->state_list();
            $data['city_list'] = $this->location_model->city_list();
            $data['region_list'] = $this->location_model->region_list();
            $data['territory_lsit'] = $this->location_model->territory_lsit();
            $data['user_list'] = $this->User_model->user_list();
            $data['department_list'] = $this->Modules_model->modules_list();
            $data['user_role'] = $this->db->get('tbl_user_role')->result();
            $data['department'] = $this->User_model->read_by_id($user_id);
            $data['county_list'] = $this->location_model->country();
            $data['content'] = $this->load->view('profile_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    public function logout() {        
    
      $comp_id = base64_encode($this->session->companey_id);
      
    //   echo "<pre>". print_r((array)$this->session, true) ."</pre>";
    //   return;
      $this->db->select('id');
      $this->db->from('login_history');
      $this->db->where('uid',$this->session->user_id);
      $this->db->order_by('id', 'DESC');
      $this->db->limit(1);
      $q = $this->db->get()->row();

      $std = date('Y-m-d H:i:s', time());
      if(!empty($q)){
        $this->db->set('lgot_date_time',$std);
        $this->db->where('id', $q->id);
        $this->db->update('login_history');
      }

      $this->rememberme->deleteCookie();
      redirect('login/?c='.$comp_id);
    }

    //Select country..
    public function selected_country() {
        $country = $this->input->post('country');
        echo json_encode($this->dashboard_model->location_base_country($country));
    }


     public function forgot_password() {
             
            $email = $this->input->post('femail');
            $email_row = array();
            if(is_numeric($email) == 1)
            {
              $data = $this->dashboard_model->getUserDataByPhone($email);
              //$this->load->library('email');
              if(!empty($data))
              {
                $this->db->where('comp_id',$data->companey_id);
                $this->db->where('api_key','message');
                $email_row  =   $this->db->get('api_integration')->row_array();
              }
              
            }
            else
            {
              $data = $this->dashboard_model->change_pass($email);
              $this->load->library('email');
              $this->db->where('comp_id',$data->companey_id);
              $this->db->where('status',1);
              $email_row  =   $this->db->get('email_integration')->row_array();
            }
            
            
            if(empty($email_row) && $data->companey_id != 83){ 
                echo "4";die;                
            }else{

                if(is_numeric($email) == 1)
                {
                  expirePreviousOTP($data->pk_i_admin_id);
                  $phone= '91'.$this->input->post('femail');
                  $otp = mt_rand(100000, 999999);
                  //$otp = 123456;
                  $otpAry = array(
                    'otp'     => $otp,
                    'user_id' => $data->pk_i_admin_id,
                    'status'  => 1
                  );
                  $this->db->insert('tbl_otp',$otpAry);
                  $message = "Your OTP is $otp";
                  $this->Message_models->smssend($phone,$message,$data->companey_id,$data->pk_i_admin_id);
                  echo "99";
                }
                else
                {
                    $config['smtp_auth']    = true;
                    $config['protocol']     = $email_row['protocol'];
                    $config['smtp_host']    = $email_row['smtp_host'];
                    $config['smtp_port']    = $email_row['smtp_port'];
                    $config['smtp_timeout'] = '7';
                    $config['smtp_user']    = $email_row['smtp_user'];
                    $config['smtp_pass']    = $email_row['smtp_pass'];
                    $config['charset']      = 'utf-8';
                    $config['mailtype']     = 'html'; // or html
                    $config['newline']      = "\r\n";                  
                    $config['validation']   = TRUE; // bool whether to validate email or not 
                   $this->email->initialize($config);
                   $email_data['url'] = $this->config->base_url()."change-password/" . base64_encode($data->pk_i_admin_id);
                   //$this->load->library('email');
                   $this->email->from($email_row['smtp_user'], 'thecrm360');
                   $this->email->to($email);
                   $this->email->subject('Change password');
                   $msg = $this->load->view('templates/forgot_password_email',$email_data,true);
                   $this->email->message($msg);
                }
                
        
        //var_dump($this->email->send());exit();
        
        if ($data->reset_password === 1) {
            echo "2";
        } else {
            if ($data->companey_id == 81) {
              echo $this->forgot_password_email_career_ex ($msg,'Change password',$email);              
            }else{          
            if(is_numeric($email) != 1)
            {
              if ($this->email->send()) {
                  echo "1";
              }else{
                  echo "0";
              }
            }   
              
            }
        }
      }
    }

    public function verifyOTP()
    {
      $mobno  = $this->input->post('mobno');
      $otp    = $this->input->post('otp');
      $data = $this->dashboard_model->getUserDataByPhone($mobno);
      if(!empty($data))
      {

        $getOtp = $this->db->select('*')->from('tbl_otp')->where('user_id',$data->pk_i_admin_id)->where('status',1)->get()->row();
        if($otp == $getOtp->otp)
        {
          $this->db->where('id',$getOtp->id);
          $this->db->set('status',2);
          $this->db->update('tbl_otp');
          echo json_encode(array('status'=>'verified','user'=>base64_encode($data->pk_i_admin_id)));
        }
        else
        {
          echo json_encode(array('status'=>'notverified'));
        }
      }
      else
      {
        echo json_encode(array('status'=>'notverified'));
      }

    }



    public function forgot_password_email_career_ex ($message,$email_subject,$to_email){       
          $curl_fields = array(
            'mail_datas'=>array(
              'message'=>array(
                'html_content'=>$message,
                'subject'=>$email_subject,
                'from_mail'=>'support@corefactors.in',
                'from_name'=>'CareerEx',
                'reply_to'=>'support@corefactors.in'
              )
            )
          );        
          $to[]= array('email_id'=>$to_email,'name'=>'');                 
      
      $curl_fields['mail_datas']['message']['to_recipients'] = $to;
      $curl_fields = json_encode($curl_fields);
      if ($to) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://teleduce.in/send-email-json-otom/8c999fa1-e303-423d-a804-eb0e6210604d/1007/",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>$curl_fields,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        /*echo $response;*/
        $res  = json_decode($response,true);
        if (!empty($res['response']) && $res['response_type'] == 'success') {
          return 1;
        }else{
          return 0;
        }
      }
    }

    //change password mail link...
    public function change_password() {
        //print_r($_POST);
        
        $email = $this->input->post('femail');

        $data = $this->dashboard_model->change_pass($email);
        
        /*print_r($data);
        if (empty($data)) {
            echo "3";
            exit();
        }*/

        $this->load->library('email');

        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.zoho.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'narendra@archizsolutions.com';
        $config['smtp_pass']    = 'Archiz321';
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']     = 'text'; // or html
        $config['validation']   = TRUE; // bool whether to validate email or not 

        $this->email->initialize($config);

        $url = $this->config->base_url()."change-password/" . base64_encode($data->pk_i_admin_id);
        //$this->load->library('email');
        $this->email->from('narendra@archizsolutions.com', 'Lalan Top');
        $this->email->to($email);
        $this->email->subject('Change password');
        $this->email->message($url);
        
        //var_dump($this->email->send());exit();
        
        if ($data->reset_password === 1) {
            echo "2";
        } else {
            if ($this->email->send()) {
                echo "1";
            }else{
                echo "0";
            }
        }
    }

    //Chnage password 
    public function send_change_password_link($user) {
        $user = base64_decode($user);
        $data1['link'] = $this->dashboard_model->disabl_reset_link($user);
        if (isset($_POST['npassword'])) {
            $new_pass = md5($this->input->post('npassword', true));
            $data = array(
                's_password' => $new_pass,
                'reset_password' => 0
            );
            //echo $user;die;
            if ($this->dashboard_model->set_new_pass($user, $data) == true) {
                echo "1";
            }
        } else {
            $this->load->view('mail/change-password', $data1);
        }
    }

    public function qazwsxedc($uid,$token){
        
        if ($token == 'Plmkoijn') {
            $this->db->where('pk_i_admin_id',$uid);
            $check_user    =   $this->db->get('tbl_admin');
            $this->session->set_userdata([
                'isLogIn' => true,
                'user_id' => $check_user->row()->pk_i_admin_id,
                'companey_id' => $check_user->row()->companey_id,
                'email' => $check_user->row()->email,
                'designation' => $check_user->row()->designation,
                'phone' => $check_user->row()->s_phoneno,
                'fullname' => $check_user->row()->s_display_name . ' ' . $check_user->row()->last_name,
                'user_right' => $check_user->row()->user_permissions,
                'picture' => $check_user->row()->picture,
                'modules' => $check_user->row()->modules,                
            ]);
        }else{
            echo "not allowed";
        }
    }

  
  /*******************************************************8student panel****************************************/
  public function select_state() {
        $state = $this->input->post('lead_stage');
        echo json_encode($this->location_model->all_state($state));

       // echo $diesc;
    }
  
  public function select_ins() {
            $ctnry = $this->input->post('l_con');
        $sta = $this->input->post('l_sta');
        $lvl = $this->input->post('l_lvl');
        $lgth = $this->input->post('l_lgth');
        $disc = $this->input->post('l_disc');
        echo json_encode($this->location_model->all_institute($ctnry,$sta,$lvl,$lgth,$disc));
    
    }
  
  public function select_crs() {
            $ctnry = $this->input->post('l_con');
        $sta = $this->input->post('l_sta');
        $lvl = $this->input->post('l_lvl');
        $lgth = $this->input->post('l_lgth');
        $disc = $this->input->post('l_disc');
      $ins = $this->input->post('l_ins');
        echo json_encode($this->location_model->all_course($ctnry,$sta,$lvl,$lgth,$disc,$ins));

       // echo $diesc;
    }
  
  public function search_programs() {
    $data['title'] = display('search_programs');
        $user_id = $this->session->userdata('user_id');
        $comp_id = $this->session->userdata('companey_id');
    $stu_phone = $this->session->userdata('phone');
    
    /*$this->db->select("*,tbl_crsmaster.course_name");
        $this->db->from('tbl_course');
    $this->db->join('tbl_institute','tbl_institute.institute_id = tbl_course.institute_id');
    $this->db->join('tbl_country','tbl_country.id_c=tbl_institute.country_id','left');
    $this->db->join('tbl_crsmaster','tbl_crsmaster.id = tbl_course.course_name');
    if($this->session->userdata('companey_id')!=67){
        $this->db->join('tbl_schdl','tbl_schdl.ins_id=tbl_institute.institute_id','left');
        $this->db->order_by('tbl_institute.institute_id','asc');
            $q = $this->db->get()->result();
    }else{
            $this->db->order_by('tbl_course.institute_id','asc');
        $this->db->where('tbl_course.comp_id',$comp_id);
            $q = $this->db->get()->result();
    }*/

        $this->load->model('program_model');
        $q  =   $this->program_model->get_data();
        $data['count_filtered_data']  =   $this->program_model->count_filtered_data();
        $data['all_data_count']  =   $this->program_model->count_all_data();
        $data['courses'] = $q;
        $data['i'] = 1;
    $data["courses"] = $q;

    
    if($this->session->userdata('companey_id')==67){
      $data['discipline'] = $this->location_model->find_discipline();
      $data['level'] = $this->location_model->find_level();
    }
    $data['vid_list'] = $this->Institute_model->videos();
    $data['state_list'] = $this->location_model->all_states();
    $data['county_list'] = $this->location_model->country();
    $data['ins_list'] = $this->location_model->stu_ins_list();
    $data['crs_list'] = $this->location_model->stu_crs_list();
    $data['course'] = $this->Institute_model->all_crs_list();
        $data['student_Details'] = $this->home_model->studentdetail($stu_phone);
        $data['content'] = $this->load->view('student/search_programs', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
  
  public function get_uni_data(){
         $layout = $this->session->userdata('layout');
     $crs = $this->input->post('crs_id');
         $ins = $this->input->post('ins_id');
         $cntry = $this->input->post('cntry');
     $dt = $this->input->post('date');
     $discipline = $this->input->post('discipline');
     $length = $this->input->post('length');
     $level = $this->input->post('level');
     $state = $this->input->post('state_id');
     $ielts = $this->input->post('ielts');

        $this->load->model('program_model');
        $q  =   $this->program_model->get_data();
        $data['count_filtered_data']  =   $this->program_model->count_filtered_data();
        $data['all_data_count']  =   $this->program_model->count_all_data();
        $data['i'] = 0;
  
      $datafilter = array($dt,$cntry,$level,$length,$discipline,$ins,$crs,$state,$ielts);   
      $data["courses"] = $q;
      $data["filter"] = $datafilter;
    $ttlpagearr  = count($q);     
    $data["totpage"] = (!empty($ttlpagearr[0]->total)) ? $ttlpagearr[0]->total : 0;
    $data["pageno"]  = (!empty($ttlpagearr[0]->total)) ? ceil($ttlpagearr[0]->total/$limit) : 0; 
    $data["currpage"]=  1;
    $grnrid = "";
    $data['vid_list'] = $this->Institute_model->videos();
    $data['state_list'] = $this->location_model->all_states();
    $data['county_list'] = $this->location_model->country();
      $data['ins_list'] = $this->location_model->stu_ins_list();
      $data['crs_list'] = $this->location_model->stu_crs_list();
    $data['course'] = $this->Institute_model->all_crs_list();
    $data['discipline'] = $this->location_model->find_discipline();
      $data['level'] = $this->location_model->find_level();
      $data['length'] = $this->location_model->find_length();
    $data['content'] = $this->load->view('student/search_programs', $data, true);
        $this->load->view('layout/main_wrapper', $data);
 
    }
    
public function user_profile() {
    $data['title'] = 'Applicant Dashboard';
        $user_id = $this->session->userdata('user_id');
        $stu_phone=$this->session->userdata('phone');
        $data['student_Details'] = $this->home_model->studentdetail($stu_phone);
        $studetails = $this->home_model->studentdetail($stu_phone);
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($studetails['enquiry_id']);
        $data['enquiry'] = $this->enquiry_model->enquiry_by_id($studetails['enquiry_id']);
        $en_id=$studetails['Enquery_id'];
        //$enq_id=$studetails['enquiry_id'];
        // print_r($data['details']);die;

    if($this->session->userdata('companey_id')!=67){
            $data['vid_list'] = $this->schedule_model->vid_list();  
            $data['faq_list'] = $this->schedule_model->faq_list(); 
            $data['country'] = $this->location_model->country();
            $data['ins_list'] = $this->location_model->stu_ins_list();
            $data['schdl_list'] = $this->schedule_model->get_schedule_list();
    }
        $data['lead_stage']    =   $this->Leads_Model->find_stage();
        $data['source_list'] = $this->home_model->sour_list();
        $data['process_list'] = $this->home_model->pro_list();
        $data['invoice_details'] = $this->home_model->invoicedetail($en_id);    
        $data['state_list'] = $this->home_model->estate_list();
        $data['city_list'] = $this->home_model->ecity_list();
    $data['agrrem_doc'] = $this->home_model->aggr_doc($en_id);
    $data['country_list'] = $this->home_model->cntry_list();
    $data['all_institute'] = $this->location_model->institute_data($en_id);
    $data['discipline'] = $this->location_model->find_discipline();
    $data['level'] = $this->location_model->find_level();
    $data['length'] = $this->location_model->find_length();
    $data['course_list'] = $this->Institute_model->courselist();
    $data['institute_list'] = $this->Institute_model->institutelist();
    $data['institute'] = $this->Institute_model->findinstitute();
    $data['all_branch'] = $this->Leads_Model->branch_select();
    
    $data['all_faq'] = $this->Leads_Model->faq_select();
    $data['login_details'] = $this->Leads_Model->logdata_select();
    $data['user_enq_id'] = $studetails['Enquery_id'];
    $data['user_enq_no'] = $studetails['enquiry_id'];

    $data['fee_list'] = $this->location_model->get_fee_list($en_id);
    $data['ins_list'] = $this->location_model->get_ins_list($en_id);
    $data['post_doc_list'] = $this->Leads_Model->get_postdoc_list($data['details']->enq_country);
    $data['post_doctab_view'] = $this->Leads_Model->get_tabdoc_list($en_id);
    $data['all_c_vs_d'] = $this->location_model->c_vs_d_select();
    $data['all_c_vs_s'] = $this->location_model->c_vs_s_select();
    $data['all_c_vs_f'] = $this->location_model->c_vs_f_select();
    $data['family_tab_view'] = $this->Leads_Model->get_family_list($en_id);
    $data['all_tab_member'] = $this->Leads_Model->get_member_list($en_id);
    $data['all_qualification_test'] = $this->Leads_Model->get_test_list();
    $data['tab_qualification'] = $this->Leads_Model->get_qualification_list($en_id);
    $data['tab_education'] = $this->Leads_Model->get_education_list($data['details']->Enquery_id);
    $data['all_education_master'] = $this->Leads_Model->get_edumaster_list();
    $data['tab_ticketdata'] = $this->Leads_Model->get_tick_list($data['details']->Enquery_id);
    $data['tab_job_detail'] = $this->Leads_Model->get_job_list($en_id);
    $data['tab_exp_detail'] = $this->Leads_Model->get_exp_list($en_id);
    $data['all_stage_lists'] = $this->Leads_Model->find_stage();
    $data['all_installment'] = $this->Leads_Model->installment_select();
    $data['last_login'] = $this->Leads_Model->last_login_time();
    $data['ref_req_form'] = $this->Leads_Model->get_ref_req($data['details']->Enquery_id);
    //$data['client_aggrement_form'] = $this->location_model->get_client_agg_list($data['details']->Enquery_id);
    $data['all_tempname'] = $this->Leads_Model->agrtemp_name();
    $data['all_template'] = $this->location_model->agrformat_select($en_id);
    $data['country_list'] = $this->location_model->country();
    $data['refund_list'] = $this->location_model->get_refund_list($en_id);
    $data['ticket_list'] = $this->location_model->get_ticket_list($en_id);
    $data['urls_list'] = $this->location_model->get_url_list($data['details']->enq_country);
    //print_r($data['urls_list']);exit();
    $data['all_estage_lists'] = $this->Leads_Model->find_estage($data['details']->product_id);
    $data['data_type']    =   $studetails['status'];
    $data['add_more_pid'] = $data['details']->product_id;
    $data['current_stage']    =   $data['details']->lead_stage;
    $data['all_subject'] = $this->Leads_Model->ticket_subject_select();
   // print_r($data['data_type']);exit;
    $data['all_description_lists']    =   $this->Leads_Model->find_description($data['details']->product_id);
    $data['all_extra'] = $this->location_model->get_qualification_tab($en_id);        
        $data['content'] = $this->load->view('student/profile_wrapper', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }


 public function add_video(){

  if($_POST){

    $id = $this->input->post('vid');
    if(empty($id)){
 
   $data = array(

    'link' => $this->input->post('vlink'),
    'title' => $this->input->post('title'),
    'des' => $this->input->post('des'),
    'meta_key' => $this->input->post('metakey'),
    'comp_id' => $this->session->companey_id,
    'created_by' => $this->session->user_id,
    'status' =>1
   );

   $res = $this->schedule_model->insert('tbl_vid',$data);

   if($res){
    
    redirect(base_url('dashboard/user_profile'));

   }
  }
  else{
  
  $data = array(

    'link' => $this->input->post('vlink'),
    'title' => $this->input->post('title'),
    'des' => $this->input->post('des'),
    'meta_key' => $this->input->post('metakey'),
    'comp_id' => $this->session->companey_id,
    'created_by' => $this->session->user_id,
    'status' =>$this->input->post('status')
   );

  $res = $this->schedule_model->update1('tbl_vid',$data,$id);
  redirect(base_url('dashboard/user_profile'));

  }
}

 } 




 public function delete_vid($id){

    $res = $this->db->where('id',$id)->delete('tbl_vid');
    if($res){
    
      redirect(base_url('dashboard/user_profile'));

    }
    else{
        redirect(base_url('dashboard/user_profile'));
    }
 } 

  public function delete_course($id){

    $res = $this->db->where('id',$id)->delete('tbl_course');
    if($res){
    
      redirect(base_url('dashboard/user_profile'));

    }
    else{
        redirect(base_url('dashboard/user_profile'));
    }
 }

   public function delete_institute($id){

    $res = $this->db->where('id',$id)->delete('tbl_institute');
    if($res){
    
      redirect(base_url('dashboard/user_profile'));

    }
    else{
        redirect(base_url('dashboard/user_profile'));
    }
 }


 
   public function delete_schedule($id){

    $res = $this->db->where('id',$id)->delete('tbl_schdl');
    if($res){
    
      redirect(base_url('dashboard/user_profile'));

    }
    else{
        redirect(base_url('dashboard/user_profile'));
    }
 }


 public function add_faq(){

  if($_POST){

    $id = $this->input->post('faqid');
    if(empty($id)){
 
   $data = array(

    'que_type' => $this->input->post('qtype'),
    'answer' => $this->input->post('answ'),
    'comp_id' => $this->session->companey_id,
    'created_by' => $this->session->user_id,
    'status' =>1
   );

   $res = $this->schedule_model->insert('tbl_faq',$data);

   if($res){
    
    redirect(base_url('dashboard/user_profile'));

   }
  }
  else{
  
  $data = array(

    'que_type' => $this->input->post('qtype'),
    'answer' => $this->input->post('answ'),
    'comp_id' => $this->session->companey_id,
    'created_by' => $this->session->user_id,
    'status' =>$this->input->post('status')
   );

  $res = $this->schedule_model->update1('tbl_faq',$data,$id);
  redirect(base_url('dashboard/user_profile'));

  }
}

 } 


 public function delete_faq($id){

    $res = $this->db->where('id',$id)->delete('tbl_faq');
    if($res){
    
      redirect(base_url('dashboard/user_profile'));

    }
    else{
        redirect(base_url('dashboard/user_profile'));
    }
 } 


  public function add_institute() {

        $data['title'] = display('add_institute');
        $data['institute'] = '';       
        $this->form_validation->set_rules('institute_name', display('institute_name'), 'required');
        $this->form_validation->set_rules('country_id', display('country_name'), 'required');
        if(!empty($_FILES['profile_image']['name'])){           
        //$this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['profile_image']['name'];
                $_FILES['userfile']['type']= $_FILES['profile_image']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['profile_image']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['profile_image']['error'];
                $_FILES['userfile']['size']= $_FILES['profile_image']['size'];    
                
                $image=$_FILES['userfile']['name'];
                $path=  "uploads/".$image;
                $ret = move_uploaded_file($_FILES['userfile']['tmp_name'] ,$path);
                //if($ret){
                //    $this->aws->upload($path);
                //}
        }else{
            $path=$this->input->post('profile_images', true);
        }
    if(!empty($_FILES['agreement_doc']['name'])){
                $_FILES['userfile']['name']= $_FILES['agreement_doc']['name'];
                $_FILES['userfile']['type']= $_FILES['agreement_doc']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['agreement_doc']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['agreement_doc']['error'];
                $_FILES['userfile']['size']= $_FILES['agreement_doc']['size'];    
                
                $image1=$_FILES['userfile']['name'];
                $path1=  "uploads/".$image1;
                $ret1 = move_uploaded_file($_FILES['userfile']['tmp_name'] ,$path1);
                //if($ret1){
                //    $this->aws->upload($path1);
                //}

        }else{
          $path1=$this->input->post('agreement_docs', true);  
        }
        $data['institute'] = (object) $postData = [
            'institute_id' => $this->input->post('institute_id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'institute_name' => $this->input->post('institute_name', true),
            'contact_name' => $this->input->post('contact_name', true),
            'contact_number' => $this->input->post('contact_number', true),
            'address' => $this->input->post('address', true),
            'country_id' => $this->input->post('country_id', true),
            'profile_image' => $path,
            'agreement_comision' => $this->input->post('agreement_comision', true),
            'agreement_doc' => $path1,
            'from_date' => $this->input->post('from_date', true),
            'to_date' => $this->input->post('to_date', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];
        
        if ($this->form_validation->run() === true) {
           // print_r($postData);exit;
            if (empty($this->input->post('institute_id'))) {
               
                if ($this->Institute_model->insertRow($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
               
                if ($this->Institute_model->updateRow($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('dashboard/user_profile');
        } else {
            redirect('dashboard/user_profile');
        }
    }


    public function add_course() {

        $data['title'] = display('add_course');
        $data['institute'] = '';       
        $this->form_validation->set_rules('course_name', display('Course_name'), 'required');
        $this->form_validation->set_rules('institute_id', display('institute_name'), 'required');
        if(!empty($_FILES['course_image']['name'])){            
        //$this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['course_image']['name'];
                $_FILES['userfile']['type']= $_FILES['course_image']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['course_image']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['course_image']['error'];
                $_FILES['userfile']['size']= $_FILES['course_image']['size'];    
                
                $image=$_FILES['userfile']['name'];
                $path=  "uploads/".$image;
                $ret = move_uploaded_file($_FILES['userfile']['tmp_name'] ,$path);
                //if($ret){
                //    $this->aws->upload($path);
                //}
        }else{
            $path=$this->input->post('course_images', true);
        }
        $data['course'] = (object) $postData = [
            'crs_id' => $this->input->post('crs_id', true),
            'institute_id' => $this->input->post('institute_id', true),
            'course_name' => $this->input->post('course_name', true),
            'course_image' => $path,
            'course_rating' => $this->input->post('course_rating', true),
            'course_discription' => $this->input->post('course_discription', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'meta_key' => $this->input->post('metakey'),
            'status' => $this->input->post('status', true),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];
        //print_r($postData);exit;
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('crs_id'))) {
            
                if ($this->Institute_model->insertRowcrs($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
     
                if ($this->Institute_model->updateRowcrs($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('dashboard/user_profile');
        } else {
             redirect('dashboard/user_profile');  
        }
    }


    public function add_schedule()
    {     
$jwt=$this->get_token();
     $action = $this->uri->segment(3);
      $id = $this->uri->segment(4);
      
      $data['course_list'] = $this->schedule_model->get_course_list();
      $data['user_list'] = $this->schedule_model->get_crs_list($this->session->userdata('user_id'));
     
      
if($action==='edit'){

      if($_POST){

      $this->form_validation->set_rules('date', 'Date', 'trim|required');
      $this->form_validation->set_rules('stm', 'Strat Time', 'trim|required');
      $this->form_validation->set_rules('etm', 'End Time', 'trim|required');
      

    if ($this->form_validation->run() == FALSE) {
            redirect('dashboard/add_schedule/edit');
            $this->session->set_flashdata('exception',validation_errors());
    }

     else{

          $dt = explode('-',$this->input->post("date"));
          $newdt = $dt[2].'-'.$dt[1].'-'.$dt[0];

          $stm =  $this->input->post('stm');
          $etm = $this->input->post('etm');

          $tmslt = $stm.' - '.$etm;
          
          $data = array(
          'uni_id'      => $this->session->userdata('user_id'),
          'schdl_dt' => $newdt,
          'stm'      => $tmslt,
          'crs'      => $this->input->post('crs_id'),
          'avblty'   => $this->input->post('avail'),
          'ty'       => $this->input->post('type'),
          'schl_sts' => 2,
    );
       $data = $this->security->xss_clean($data);
       $res_updated = $this->schedule_model->update_schdl('tbl_schdl',$data,$id);
       
        if($res_updated){
            print_r('first');exit;
            //  $this->schedule_model->add_comment_for_events('New Schedule Added', $leadid);
              $this->session->set_flashdata('message',"Schedule has been updated successfuly");
              redirect('dashboard/user_profile');
        } 
        else{
              $this->session->set_flashdata('exception',"Failed");
              redirect('dashboard/add_schedule/edit');
          }
       }

     }
          $data['res_update'] = $this->schedule_model->get_schedule_byid($id);
          $data['institute'] = $this->Institute_model->findinstitute();
          $data['title'] = 'Update Schedule';
          $data['content'] = $this->load->view('student/profile_wrapper',$data,true);
          $this->load->view('layout/main_wrapper',$data);
     }

  if($_POST){

     // print_r($_POST);exit();
      $this->form_validation->set_rules('stm[]', 'Strat Time', 'trim|required');
      $this->form_validation->set_rules('etm[]', 'End Time', 'trim|required');
            
            if ($this->form_validation->run() == FALSE) {
                redirect('dashboard/add_schedule');
                $this->session->set_flashdata('exception',validation_errors());
            }

  else{

          $doctmslt     =  $this->session->userdata('tmslt');
          $avail       = $this->input->post('avail'); 
          $date        = $this->input->post("date");
          $type        = $this->input->post('type');
          $fromdate    = $this->input->post("fromdate");
          $todate      = $this->input->post("todate");
          $starttime         =  $this->input->post('stm');
          $endtime         = $this->input->post('etm');
          $crs      = $this->input->post('crs_id');
          $ins      = $this->input->post('ins_id');
           
        
        $this->db->select("*");
        $this->db->from('tbl_institute');
        $this->db->where('institute_id', $ins);
        $query = $this->db->get();
        $q1= $query->result();
        foreach($q1 as $cq1){
        $topicc=$cq1->institute_name;
        }
foreach($starttime as $st){
     $start=$st;
 }
 foreach($endtime as $et){
     $end=$et;
 }      
$time1 = strtotime($start);
$time2 = strtotime($end);
$drtn = ($time2-$time1)/60;

if(strlen($fromdate[0]) > 0){

          $i=0;
        foreach($fromdate as $fromdt){
          $frmdt = $fromdate[$i];
          $todt = $todate[$i];
          $diff = strtotime($frmdt) - strtotime($todt) ;
          $totaldays= abs(round($diff/ 86400)); 
          $time1 = $starttime[$i];
          $time2 = $endtime[$i];

          $total      = strtotime($time2) - strtotime($time1);
          $hours      = floor($total / 60 / 60);
          $timemins = $hours*60/$doctmslt; 
if($timemins=='0'){
             $total      = strtotime($time2) - strtotime($time1);
             $minut      = floor($total / 60);
             $val = (!empty($doctmslt)) ?  $minut/$doctmslt : 1;
             $timemins = (int)$val;
           }else{
            $timemins=$timemins;   
           }
          $tempdate = $fromdate[$i];
    for($j=0;$j<=$totaldays;$j++){ 
      $stm1 = $starttime[$i];

$newdt = date('Y-m-d',strtotime($tempdate));

 $start_date=date("c",strtotime($newdt.' '.$start));
 $z_id = $this->session->userdata('zoom');
 
                                 $data=json_encode([
                                  "topic"=>$topicc,
                                  "type"=>2,
                                  "host_id"=>"$z_id",
                                  "duration"=>$drtn,
                                  "start_time"=>$start_date,
                                  "timezone"=> "Asia/Kolkata",
                                  "password"=> "@12345",
                                ]);
                   
            
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "https://api.zoom.us/v2/users/$z_id/meetings",
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 30,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "POST",
                              CURLOPT_POSTFIELDS => $data,
                              CURLOPT_HTTPHEADER => array(
                                "authorization: Bearer ".$jwt,
                                "Content-Type: application/json"
                              ),
                            ));
                            $response = curl_exec($curl);
                            $err = curl_error($curl);
                            curl_close($curl);
                            if ($err) {
                               $response=$err;
                            } else {
                               $response;
                    } 
            $datas = array(
                'comp_id' => $this->session->userdata('companey_id'),
                'uni_id' => $this->session->userdata('user_id'),
                'ins_id' => $ins,
                'schdl_dt' => $newdt,
                'crs_id' => $crs,
                'ty' => $type,
                'avblty'   =>$avail,
                'start_tm' => $start,
                'end_tm' => $end,
                'a_duration' => $drtn,
                'zoom_response' => $response
            );
            //print_r($datas);exit;
    $insert_id = $this->schedule_model->register('zoom_link',$datas);

    for($k=1;$k<=$timemins;$k++){ 
     
          $endTime = strtotime("+$doctmslt minutes", strtotime($stm1));
          $temptime = date('H:i', $endTime);
          
          $newdt = date('Y-m-d',strtotime($tempdate));
          $tmslt[$i] = $stm1.' - '.$temptime;
          $stm1 = $temptime;
          $data = array(
          'comp_id' => $this->session->userdata('companey_id'),
          'uni_id' => $this->session->userdata('user_id'),
          'ins_id'      => $ins,
          'avblty'   =>$avail,
          'ty'       => $type,
          'crs_id'   => $crs,
          'schdl_dt' => $newdt,
          'stm'      => $tmslt[$i],
          'schl_sts' => 2,
          'zoom_response' =>$response,
          'sts'      => 1
    );
     //print_r($data);exit;
        $data = $this->security->xss_clean($data);
        $result = $this->schedule_model->register('tbl_schdl',$data);
        
     
    } 
    
    $insid = $this->db->insert_id();
/*************************************notification code here******************************************/

/*************************************notification code End here******************************************/
  $tempdate= date('Y-m-d', strtotime($tempdate. ' + 1 days')); 
    }
   $i++;     
  }
          $this->session->set_flashdata('message',"Schedule has been added successfuly");
          redirect('dashboard/user_profile');

    }   

    if(strlen($date[0]) > 0){
        $i=0;
        $result1='';
        foreach($date as $fromdt){
        //print_r($fromdt);exit;    
          $time1 = $starttime[$i];
          $time2 = $endtime[$i];

          $total      = strtotime($time2) - strtotime($time1);
          $hours      = floor($total / 60 / 60);
           $timemins = (!empty($doctmslt)) ?  $hours*60/$doctmslt : 1;
          
           if($timemins=='0'){
             $total      = strtotime($time2) - strtotime($time1);
             $minut      = floor($total / 60);
             $val = (!empty($doctmslt)) ?  $minut/$doctmslt : 1;
             $timemins = (int)$val;
           }else{
            $timemins=$timemins;   
           }
      $stm1 = $starttime[$i];
      
      
      $newdt = date('Y-m-d',strtotime($fromdt));
 $start_date=date("c",strtotime($newdt.' '.$start));
 $z_id = $this->session->userdata('zoom');
                                 $data=json_encode([
                                  "topic"=>$topicc,
                                  "type"=>2,
                                  "host_id"=>"$z_id",
                                  "duration"=>$drtn,
                                  "start_time"=>$start_date,
                                  "timezone"=> "Asia/Kolkata",
                                  "password"=> "@12345",
                                ]);
                                                   
            
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "https://api.zoom.us/v2/users/$z_id/meetings",
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 30,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "POST",
                              CURLOPT_POSTFIELDS => $data,
                              CURLOPT_HTTPHEADER => array(
                                "authorization: Bearer ".$jwt,
                                "Content-Type: application/json"
                              ),
                            ));
                            $response = curl_exec($curl);
                            $err = curl_error($curl);
                            curl_close($curl);
                            if ($err) {
                               $response=$err;
                            } else {
                               $response;
                            }
         // print_r($type[$i]);exit();
          $datas = array(
                'comp_id' => $this->session->userdata('companey_id'),
                'uni_id' => $this->session->userdata('user_id'),
                'ins_id' => $ins,
                'schdl_dt' => $newdt,
                'crs_id' => $crs,
                'ty' => $type,
                'avblty'   =>$avail,
                'start_tm' => $start,
                'end_tm' => $end,
                'a_duration' => $drtn,
                'zoom_response' => $response
            );
           // print_r($datas);exit;
            $insert_id = $this->schedule_model->register('zoom_link',$datas);
      
       
      
    for($k=1;$k<=$timemins;$k++){ 
     
          $endTime = strtotime("+$doctmslt minutes", strtotime($stm1));
          $temptime = date('H:i', $endTime);
          
          $newdt = date('Y-m-d',strtotime($fromdt));
          $tmslt[$i] = $stm1.' - '.$temptime;
          $stm1 = $temptime;
          $data = array(
         
          'comp_id' => $this->session->userdata('companey_id'),
          'uni_id' => $this->session->userdata('user_id'),
          'ins_id'      => $ins,
          'avblty'   =>$avail,
          'ty'       => $type,
          'crs_id'       => $crs,
          'schdl_dt' => $newdt,
          'stm'      => $tmslt[$i],
          'schl_sts' => 2,
          'zoom_response' =>$response,
          'sts'      => 1
    );
     //print_r($data);exit;
        $data = $this->security->xss_clean($data);
        $result1 = $this->schedule_model->register('tbl_schdl',$data);
            
      
     
    } 
        $insid = $this->db->insert_id();
        
/*************************************notification code here******************************************/

/*************************************notification code End here******************************************/
   $i++;     
  }

          $this->session->set_flashdata('message',"Schedule has been added successfuly");
          redirect('dashboard/user_profile');
    }


         }
       }

}

 function get_token(){

            $header = json_encode([ "alg"=>"HS256", "typ"=>"JWT"]);
            
            $payload = json_encode([
               "iss"=>"daTGFD0BQjiUvaCLiowpOw",
              "exp"=>1496091964000
            ]);

            $base64UrlHeader = base64_encode($header);
            
            $base64UrlPayload = base64_encode($payload);
            
            $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'NQU7iFdFWetrvrKvoUaLBeKDtrjMRh5HIb6e', true);
            
            $base64UrlSignature = base64_encode($signature);
            
            return $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        
    }

public function my_applications() {
  $data['title'] = display('my_applications');
    $user_id = $this->session->userdata('user_id');
  $data['my_app'] = $this->location_model->get_wislist($user_id);
  $data['my_history'] = $this->location_model->get_history($user_id);
    $data['content'] = $this->load->view('student/my_applications', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}
public function remove_from_wish_list($id){
    $this->db->where('id',$id);
    $this->db->where('comp_id',$this->session->companey_id);
    $this->db->delete('tbl_wishlist');
    $this->session->set_flashdata('message','Successfully Removed from wishlist');
    redirect('dashboard/my_applications');
}

public function menu_style() {  
    if($this->session->menu==1){
        $this->session->set_userdata('menu',2);
    }else{
     $this->session->set_userdata('menu',1);  
    }
    redirect($this->agent->referrer());
    }
public function set_layout_to_session() {
        $layout = $this->input->post('layout');
        $this->session->set_userdata('layout', $layout);
    }

    public function add_wishlist() {
        $crs=$this->uri->segment(3);
        $ins=$this->uri->segment(4);
      $stu=$this->session->userdata('user_id');
      $comp=$this->session->userdata('companey_id');
        $data = array(
            'comp_id'=>$comp,
            'stu_id'=>$stu,
        'uni_id'=>$ins,
            'crs_id'=>$crs
        );
        $this->db->insert('tbl_wishlist',$data);
        $this->session->set_flashdata('message','Successfully added to wish list');
      redirect('dashboard/search_programs');
    }
  
  public function course_details() {
    $ins=$this->uri->segment(3);
    $crs=$this->uri->segment(4);
    $data['title'] = display('course_details');
    $data['ins_details'] = $this->location_model->ins_details($ins);
    $data['crs_details'] = $this->location_model->crs_details($crs);
      /* echo '<pre>';
    print_r($data['ins_details']);
    echo '</pre>';exit; */ 
    $data['content'] = $this->load->view('student/detail_page', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
  /********************************************************student panel*******************************************/
 /*public function careerex(){
        $result    =   $this->db->query("select Enquery_id from enquiry where comp_id = 81 AND enquiry_source=209")->result_array();
       
        foreach ($result as $key => $value) {
          $enq_no= $value['Enquery_id'];
            $test    =   $this->db->query("select enq_no,fvalue,parent from extra_enquery where cmp_no = 81 AND enq_no='".$enq_no."' AND input=4016 AND fvalue !=''")->result_array();                
            
          if (!empty($test)) {            
            $i = 1;
              foreach ($test as $k => $v) {
                $fv = addslashes($v['fvalue']);
                $fe = $v['enq_no'];
                $fp = $v['parent'];
                //echo $fv.'<br>'.$fe;
                if($this->db->query("select id from extra_enquery where enq_no='".$fe."' and cmp_no=81 and input=4399")->num_rows()){
                  //var_dump($this->db->query("update extra_enquery set fvalue='".$fv."' where enq_no='".$fe."' and cmp_no=81 and input=4399"));
                }else{
                  $arr  = array(
                                'enq_no'=>$fe,
                                'parent'=>$fp,
                                'input' =>4399,
                                'fvalue' => $fv,
                                'cmp_no' => 81,

                              );

                  var_dump($this->db->insert("extra_enquery",$arr));
                  var_dump($this->db->query("update extra_enquery set fvalue='' where enq_no='".$fe."' and cmp_no=81 and input=4016"));
                }
                 $i++;
                 echo $i;
              }
          }
        }
    }
    */

}