<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Vitels {        

    public function __construct(){           
       $this->CI =& get_instance();
       $this->CI->load->library('rememberme');
       $this->CI->load->model('dashboard_model');
       $this->CI->load->model('user_model');
    }

    // public function only_one_login_check(){

    //     $router_class = $this->CI->router->class;                
        
    //     $router_method = $this->CI->router->method;
        
    //     if(!empty($_SESSION['user_id'])){
    //         $record = $this->CI->db->select('token')
    //         ->from('login_log')
    //         ->where('uid',$_SESSION['user_id'])            
    //         ->get()
    //         ->row_array();

    //         if(!empty($record)){
    //             if($record['token'] == $_SESSION['token']){                    
    //                 $this->db->where('uid',$_SESSION['user_id']);
    //                 $this->db->update('login_log',array('created_date'=>date("Y-m-d H:i:s")));
    //             }else{
    //                 $last_min = date('Y-m-d H:i:s', strtotime('-10 minutes'));
    //                 $where = "uid=$_SESSION['user_id'] AND created_date < $last_min";                    
    //                 $this->CI->db->select('token');
    //                 $this->db->from('login_log');
    //                 $this->db->where($where);
    //                 $record =$this->db->get()->row_array();                    
    //                 if (!empty($record)) {
    //                     $this->db->where('uid',$_SESSION['user_id']);
    //                     $this->db->update('login_log',array('created_date'=>date("Y-m-d H:i:s"),'token'=>random_string('alnum', 16)));
    //                 }else{
    //                     echo "Your id is already login somewhere";
    //                 }   

    //             }
    //         }
            
    //     }
    // }


    public function varify_cookies(){ // remember login
        if ($this->CI->session->user_id && $this->CI->session->companey_id == 67 && $this->CI->session->user_right == 151) {
            $res    =   $this->CI->user_model->get_user_meta($this->CI->session->user_id,array('payment_status'));            
            
            $router_class = $this->CI->router->class;                
            $router_method = $this->CI->router->method;
            
            if ($res['payment_status'] == 0 && $router_class!='payment' && $router_method!='logout' && $router_method!='logout') {
                redirect('payment');
            }
        }

        $cookie_user = $this->CI->rememberme->verifyCookie();                    
        if (!empty($cookie_user) && !$this->CI->session->user_id) {            
            $user_row    =   $this->CI->dashboard_model->find_user_by_email($cookie_user);
            if (!empty($user_row)) {                
            $this->CI->session->set_userdata('user_id',$user_row->pk_i_admin_id);                                
            if (!empty($user_row->pk_i_admin_id)) {
                $city_row = $this->CI->db->select("*")
                        ->from("city")
                        ->where('id', $user_row->city_id)
                        ->get();     
                $location_arr = array();
                if(!empty($city_row->row_array())){
                    $location_arr = $city_row->row_array();
                }                    
                if(user_access(230) || user_access(231) || user_access(232) || user_access(233) || user_access(234) || user_access(235) || user_access(236)){ 
                    $arr = explode(',', $user_row->process);
                    $this->CI->session->set_userdata('companey_id',$user_row->companey_id);                
                    $process_filter =   get_cookie('selected_process');                    
                    if (!empty($process_filter)) {
                        $process_filter = explode(',', $process_filter);                                
                        $process_filter = array_intersect($process_filter, $arr);
                        if(empty($process_filter)){
                            $this->CI->session->set_userdata('process',$arr);
                        }else{
                            $this->CI->session->set_userdata('process',$process_filter);
                        }
                    }else{
                        $process_filter = array();                
                        $this->CI->session->set_userdata('process',$arr);
                    }
                    $c = implode(',', $this->CI->session->process);
                    set_cookie('selected_process',$c,'31536000');                  
                }

                    $data = $this->CI->session->set_userdata([                        
                        'isLogIn'               => true,                                                
                        'companey_id'           => $user_row->companey_id,                       
                        'email'                 => $user_row->email,
                        'designation'           => $user_row->designation,
                        'phone'                 => $user_row->s_phoneno,
                        'fullname'              => $user_row->s_display_name . '&nbsp;' . $user_row->last_name,
                        'country_id'            => !empty($location_arr)?$location_arr['country_id']:'',
                        'region_id'             => !empty($location_arr)?$location_arr['region_id']:'',
                        'territory_id'          => !empty($location_arr)?$location_arr['territory_id']:'',
                        'state_id'              => !empty($location_arr)?$location_arr['state_id']:'',
                        'city_id'               => $user_row->city_id,                   
                        'user_right'            => $user_row->user_permissions,
                        'picture'               => $user_row->picture,
                        'modules'               => $user_row->modules,
                        'title'                 => (!empty($setting->title) ? $setting->title : null),
                        'address'               => (!empty($setting->description) ? $setting->description : null),
                        'logo'                  => (!empty($setting->logo) ? $setting->logo : null),
                        'favicon'               => (!empty($setting->favicon) ? $setting->favicon : null),
                        'footer_text'           => (!empty($setting->footer_text) ? $setting->footer_text : null),                    
                        'telephony_agent_id'    => $user_row->telephony_agent_id,
                        'telephony_token'       => $user_row->telephony_token
                    ]);
            }
            }
        }
    }
}