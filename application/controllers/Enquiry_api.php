<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Enquiry_api extends CI_Controller {
	
	
    public function __construct() {
		
		
		
        parent::__construct();
       
         $this->load->model(
                array('Leads_Model','setting_model' ,'enquiry_model', 'dashboard_model', 'Task_Model', 'User_model', 'location_model','Message_models','Institute_model','Datasource_model','Taskstatus_model','dash_model','Center_model','SubSource_model','Kyc_model','Education_model','SocialProfile_model','Closefemily_model')
                );
        $this->load->library('email');
        $this->load->library('user_agent');
		$this->lang->load("activitylogmsg","english");
		
		$apiarr = explode("/", $_SERVER['REQUEST_URI']);
		
		if(in_array("viewapi", $apiarr)){
			
		}else if(in_array("viewapi", $apiarr)){
			
		}else if(in_array("re_login", $apiarr)){
			
		}
		
      
    }
  

   public function test(){

    echo "ehllo";
   }

	public function create_form(){

        $userno = $this->uri->segment(3);
        $proccessno = $this->uri->segment(4);

        $this->session->set_userdata('userno',$userno);
        $this->session->set_userdata('proccessno',$proccessno);

        // echo $proccessno;exit();
                
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $data["userno"]     = $userno;
        $data["proccessno"]     = $proccessno;

        // print_r($proccessno);exit();
        
        $data['title'] = display('new_enquiry');
        $this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|required', array('is_unique' => 'Duplicate   Entery for phone'));
        
        $enquiry_date = $this->input->post('enquiry_date');
        if($enquiry_date !=''){
          $enquiry_date = date('Y-m-d', strtotime($enquiry_date));
        }else{
          $enquiry_date = date('Y-m-d', strtotime($enquiry_date));
        } 
       $city_id= $this->db->select("*")
         ->from("city")
         ->where('id',$this->input->post('city_id'))
         ->get();
        $other_phone = $this->input->post('other_no[]');

        $usrarr = $this->db->select("*")
                          ->where("pk_i_admin_id", $userno)
                          ->from("tbl_admin")
                          ->get()
                          ->row();
        if ($this->form_validation->run() === true) {
            $name = $this->input->post('enquirername');
            $name_w_prefix = $name;
            $encode = $this->get_enquery_code();
            if(!empty($other_phone)){
               $other_phone =   implode(',', $other_phone);
            }else{
                $other_phone = '';
            }
            $postData = [
                'Enquery_id' => $encode,
                'user_role' => $this->session->user_role,
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('mobileno', true),
             'comp_id'    => $usrarr->companey_id,
                'other_phone'=> $other_phone,
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
                'created_date' =>$enquiry_date, 
                'status' => 1
            ];
            if ($this->enquiry_model->create($postData)) {
                $insert_id = $this->db->insert_id();
                $res = $this->Leads_Model->add_comment_for_events("Enquiry Created", $encode);   
                // print_r($res);exit(); 
                   
                echo '<br><br>Your Enquiry has been  Successfully created';
               
            }
        } else {
            
        
            
         if(!empty($usrarr)){
                
             $compno = $usrarr->companey_id;
         }else{
             $compno = "";
         }
            
            
            
            
            $this->load->model('Dash_model', 'dash_model');
            $data['name_prefix'] = $this->enquiry_model->name_prefix_list();
           // $user_role    =   $this->session->user_role;
            
            $data['products'] = $this->dash_model->get_user_product_list_api($compno);
            $data['product_contry'] = $this->location_model->productcountry_api($compno);
            $data['institute_list'] = $this->Institute_model->institutelist_api($compno);
            $data['datasource_list'] = $this->Datasource_model->datasourcelist_api($compno);
            $data['datasource_lists'] = $this->Datasource_model->datasourcelist2($compno);
            $data['subsource_list'] = $this->Datasource_model->subsourcelist();
            $data['center_list'] = $this->Center_model->all_center();
            $data['state_list'] = $this->location_model->estate_list_api($compno);
            $data['city_list'] = $this->location_model->ecity_list_api($compno);
            $data['country_list'] = $this->location_model->ecountry_list();
            $data['company_list'] = $this->location_model->get_company_list_api($proccessno, $compno );
            $data['leadsource'] = $this->Leads_Model->get_leadsource_list_api($compno);
            
        //   echo $this->db->last_query();
            $this->load->view('create_newenq', $data);
        }

    }


    public function viewapi(){

        $id = $this->uri->segment(3);
        $enqno = $this->uri->segment(4);
        
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
                    'process' => '',
                    'telephony_agent_id' => $check_user->row()->telephony_agent_id
                ]);
            
               if (!empty($check_user->result())) {
                  
                redirect(base_url("enquiry/mview/".$enqno));
                
            } else {
                $array=array('error'=>'Invalid Username or Password');
                   $this->set_response([
                'status' => false,
                'message' => $array
            ], REST_Controller::HTTP_OK);
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


   


}