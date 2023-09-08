<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lead extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->library('upload');
        $this->load->helper('date');
        $this->load->model(
                array('apiintegration_Model','Leads_Model','common_model','enquiry_model', 'dashboard_model', 'Task_Model', 'User_model', 'location_model', 'Message_models','Institute_model','Datasource_model','Taskstatus_model','dash_model','Center_model','SubSource_model','Kyc_model','Education_model','SocialProfile_model','Closefemily_model','Doctor_model','form_model','warehouse_model')
                );
        if (empty($this->session->user_id)) {
            redirect('login');
        }
    }

public function view_datasource_data($did){    
    $data['title'] = 'Datasource raw data';        
    $data['datasource_id'] = $did;            
    $data['raw_data']    =   $this->db->select('enquiry2.*,tbl_product.product_name')->from('enquiry2')   
                            ->join('tbl_product','tbl_product.sb_id=enquiry2.product_id','left')              
                            ->where('enquiry2.comp_id',$this->session->companey_id)
                            ->where('enquiry2.datasource_id',$did)                 
                            ->where('enquiry2.status!=',3)                 
                            ->get()->result_array();    
    $data['content'] = $this->load->view('datasource/raw_data_list', $data, true);
    $this->load->view('layout/main_wrapper', $data);   
}
public function delete_raw_data(){
    $datasource_id    =   $this->input->post('datasource_id');
    $enq_id    =   $this->input->post('enq_id');        
    if ($datasource_id) {
        $this->db->where_in('enquiry_id',$enq_id);
        $this->db->where('datasource_id',$datasource_id);
        $this->db->where('comp_id',$this->session->companey_id);
        $this->db->delete('enquiry2');
    }        
    $this->session->set_flashdata('message', 'Records Deleted Successfully');
    redirect('lead/datasourcelist');
}
public function select_app_by_ins() {
        $course = $this->input->post('c_course');
        $lvl = $this->input->post('c_lvl');
        $length = $this->input->post('c_length');
        $disc = $this->input->post('c_disc');
        echo json_encode($this->Leads_Model->all_course($course,$lvl,$length,$disc));

       // echo $diesc;
    }

    public function index() {
        $aid = $this->session->userdata('user_id');
        $data['title'] = display('lead_list');
        $data['all_leadss'] = $this->Leads_Model->all_leadss();
        $data['user_list'] = $this->User_model->read();
        $data['all_user'] = $this->User_model->all_user();
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $data['lead_stages'] = $this->Leads_Model->get_leadstage_list();
        $data['enquirys'] = $this->enquiry_model->read();
        $data['state_list'] = $this->location_model->state_list();
        $data['all_enquery'] = $this->Leads_Model->all_leadss();
        $data['all_drop'] = $this->Leads_Model->all_drop_lead();
        $data['all_active'] = $this->Leads_Model->all_Active_lead();
        $data['unassigned'] = $this->enquiry_model->unassigned();
        $data['all_leads'] = $this->Leads_Model->all_lead_toClient();
        $data['all_today_update'] = $this->Leads_Model->all_Updated_today();
        $data['all_creaed_today'] = $this->Leads_Model->all_created_today();
        $data['drops'] = $this->Leads_Model->get_drop_list();
        //$data['checked_enquiry'] = $this->enquiry_model->checked_enquiry();
       // $data['unchecked_enquiry'] = $this->enquiry_model->unchecked_enquiry();
       // $data['scheduled'] = $this->enquiry_model->scheduled();
       // $data['unscheduled'] = $this->enquiry_model->unscheduled();
        $data['customer_types'] = $this->enquiry_model->customers_types();
        $data['channel_p_type'] = $this->enquiry_model->channel_partner_type_list();
        $data['content'] = $this->load->view('leads', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }



    public function enquery_detals_by_status($id = '') {
        if ($id > 0 and $id <= 20) {
            $serach_key = '';
        } else {
            $serach_key = explode('_', $id);
        }

        $data['title'] = display('lead_list');
        $data['all_user'] = $this->User_model->all_user();
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $data['lead_stages'] = $this->Leads_Model->get_leadstage_list();        
        if ($id == 1) {
            $data['all_active'] = $this->Leads_Model->all_created_today();

            /*echo "<pre>";
            print_r($data['all_active']->result_array());*/

        } elseif ($id == 2) {
            $data['all_active'] = $this->Leads_Model->all_Updated_today();
            

        } elseif ($id == 3) {
            $data['all_active'] = $this->Leads_Model->all_Active_lead();
        

        } elseif ($id == 4) {
            $data['all_active'] = $this->Leads_Model->all_lead_toClient();
        } elseif ($id == 5) {
            $data['all_active'] = $this->Leads_Model->all_drop_lead();
                
       /*     echo "<pre>";
            print_r($data['all_active']->result_array());
            echo $this->db->last_query();
            echo "</pre>";*/
            
        } elseif ($id == 6) {
            $data['all_active'] = $this->Leads_Model->all_leadss();
        } elseif ($id == 7) {
          //  $data['all_active'] = $this->enquiry_model->checked_enquiry();
        } elseif ($id == 8) {
          //  $data['all_active'] = $this->enquiry_model->unchecked_enquiry();
        } elseif ($id == 9) {
           // $data['all_active'] = $this->enquiry_model->scheduled();
        } elseif ($id == 10) {
          //  $data['all_active'] = $this->enquiry_model->unscheduled();
        } elseif (!empty($serach_key[1]) == 2) {
            $data['all_active'] = $this->enquiry_model->search_data($serach_key[0]);
        } else {
            $data['all_active'] = $this->Leads_Model->all_Active_lead();
        }
        $data['state_list'] = $this->location_model->state_list();
        $data['drops'] = $this->Leads_Model->get_drop_list();
        $this->load->view('lead_list', $data);
    }
    
    public function lead_details($enquiry_id = null) {
        $data['title'] = 'Application Details';
        $compid = $this->session->userdata('companey_id');
        //$enquiry_id = $this->uri->segment(3);
        if (!empty($_POST)) {
            $enquiry_id = $this->input->post('Enquiryid');
            $name = $this->input->post('enquirername');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobileno');
            $enquiry = $this->input->post('enquiry');
            $name_prefix = $this->input->post('name_prefix');
            $this->db->set('country_id', $this->input->post('country_id'));
            $this->db->set('product_id', $this->input->post('product_id'));
            $this->db->set('lead_stage', $this->input->post('lead_stage'));
            $this->db->set('lead_comment', $this->input->post('lead_comment'));
            $this->db->set('phone', $mobile);
            $this->db->set('email', $email);
            $this->db->set('name_prefix', $name_prefix);
            $this->db->set('name', $name);
            $this->db->set('enquiry', $enquiry);
            $this->db->set('lastname', $this->input->post('lastname'));
            $this->db->where('enquiry_id', $enquiry_id);
            $this->db->update('enquiry');            
            $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);
            $lead_code = $data['details']->Enquery_id;
            $stage_code = $data['details']->lead_stage;
            $this->Leads_Model->add_comment_for_events('Applications details has been updated', $lead_code,$stage_code);
            redirect('lead/lead_details/' . $enquiry_id);
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

         $data['prod_list'] = $this->Doctor_model->product_list($compid); 
        $data['amc_list'] = $this->Doctor_model->amc_list($compid,$enquiry_id); 
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

        //$data['all_estage_lists'] = $this->Leads_Model->find_estage($enquiry_id);
        $data['all_estage_lists'] = $this->Leads_Model->find_estage($data['details']->product_id,2);
        $data['all_cstage_lists'] = $this->Leads_Model->find_cstage($data['details']->product_id,2);
    //print_r($data['all_estage_lists']);exit;    

        $data['all_description_lists']    =   $this->Leads_Model->find_description($data['details']->product_id,2);
        $data['institute_data'] = $this->enquiry_model->institute_data($data['details']->Enquery_id);
        $data['dynamic_field']  = $this->enquiry_model->get_dyn_fld($enquiry_id);
        $data['ins_list'] = $this->location_model->get_ins_list($data['details']->Enquery_id);
        //$data['aggrement_list'] = $this->location_model->get_agg_list($data['details']->Enquery_id);

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
        $data['all_education_master'] = $this->Leads_Model->get_edumaster_list();
        $data['tab_ticketdata'] = $this->Leads_Model->get_tick_list($data['details']->Enquery_id);
        $data['tab_job_detail'] = $this->Leads_Model->get_job_list($data['details']->Enquery_id);
        $data['tab_exp_detail'] = $this->Leads_Model->get_exp_list($data['details']->Enquery_id);
        $data['ref_req_form'] = $this->Leads_Model->get_ref_req($data['details']->Enquery_id);
        //print_r($data['ref_req_form']);exit;
        //$data['client_aggrement_form'] = $this->location_model->get_client_agg_list($data['details']->Enquery_id);
        $data['all_tempname'] = $this->Leads_Model->agrtemp_name();
        $data['all_template'] = $this->location_model->agrformat_select($data['details']->Enquery_id);
        $data['all_installment'] = $this->Leads_Model->installment_select();
        $data['all_gst'] = $this->Leads_Model->gst_select();
        $data['refund_list'] = $this->location_model->get_refund_list($data['details']->Enquery_id);
        $data['ticket_list'] = $this->location_model->get_ticket_list($data['details']->Enquery_id);
        $data['tab_list'] = $this->form_model->get_tabs_list($this->session->companey_id,$data['details']->product_id);
        $data['visa_type'] = $this->Leads_Model->visa_type_select();
        $data['visa_class'] = $this->Leads_Model->visa_mapping_select();
        $data['data_type'] = '2';

        $this->load->helper('custom_form_helper');
        $data['leadid']     = $data['details']->Enquery_id;
        $data['compid']     =  $data['details']->comp_id;
        $data['enquiry_id'] = $enquiry_id;
        if ($this->session->companey_id=='67') { 
        //$data['qualification_data'] = $this->enquiry_model->quali_data($data['details']->Enquery_id);
        //$data['english_data'] = $this->enquiry_model->eng_data($data['details']->Enquery_id);
        $data['discipline'] = $this->location_model->find_discipline();
        $data['level'] = $this->location_model->find_level();
        $data['length'] = $this->location_model->find_length();
        }

        $data['login_user_id'] = $this->user_model->get_user_by_email($data['details']->email);
        if (!empty($data['login_user_id']->pk_i_admin_id)) {
            $data['login_details'] = $this->Leads_Model->logdata_select($data['login_user_id']->pk_i_admin_id);            
        }
        $data['course_list'] = $this->Leads_Model->get_course_list();
        $data['urls_list'] = $this->location_model->get_url_list($data['details']->enq_country);
        $this->enquiry_model->make_enquiry_read($data['details']->Enquery_id);  
        $data['add_more_pid'] = $data['details']->product_id; 
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
    
    public function get_last_task_by_code(){
        $enq_code    =   $this->input->post('enq_code');
        $this->db->select('resp_id,task_time,DATE_FORMAT(STR_TO_DATE(task_date,"%d-%m-%Y"), "%Y-%m-%d") AS task_date,task_remark');
        $this->db->where('query_id',$enq_code);        
        $this->db->order_by('resp_id','DESC');
        $this->db->limit(1);
        echo json_encode($this->db->get('query_response')->row_array());
        //echo $this->db->last_query();
    }
    
    public function select_des_by_stage() {
        $diesc = $this->input->post('lead_stage');
        echo json_encode($this->Leads_Model->all_description($diesc));

       // echo $diesc;
    }

    public function select_visa_by_finalcntry() {
        $diesc = $this->input->post('finalcntry');
        echo json_encode($this->Leads_Model->all_visa_list($diesc));

       // echo $diesc;
    }

    public function select_class_by_cntryandvisa() {
        $diesc = $this->input->post('finalcntry');
        $diesc1 = $this->input->post('visa_id');
        echo json_encode($this->Leads_Model->all_class_list($diesc,$diesc1));

       // echo $diesc;
    }

    public function select_branch_by_dept() {
        $dept = $this->input->post('dept_id');
        echo json_encode($this->Leads_Model->select_branch_by_dept_id($dept));

       // echo $diesc;
    }

    public function select_user_by_change() {
        $dept = $this->input->post('dept_id');
        $branch = $this->input->post('branch_id');
        echo json_encode($this->Leads_Model->select_user_by_deptandbranch($dept,$branch));

       // echo $diesc;
    }

    public function lead_detail() {
        $leadid = $this->uri->segment(3);
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_code($leadid);
        $lead_code = $data['details']->lid;
        redirect('lead/lead_details/' . $lead_code);
    }

    public function add_comment() {
        $CI = &get_instance();
        if (!empty($_POST)) {
            $ld_updt_by = $this->session->userdata('user_id');
            $lead_id = $this->input->post('lid');
            $conversation = trim($this->input->post('conversation'));
            $coment_type = trim($this->input->post('coment_type'));
            $adt = date("Y-m-d H:i:s");
            $msg = $conversation;

            $this->db->set('lead_id', $lead_id);
            $this->db->set('created_date', $adt);
            $this->db->set('coment_type ', $coment_type);
            $this->db->set('comment_msg', $conversation);
            $this->db->set('created_by', $ld_updt_by);
            $this->db->insert('tbl_comment');

            $this->db->set('update_date',$adt);
            $this->db->where('Enquery_id',$lead_id);
            $this->db->update('enquiry');

            $this->session->set_flashdata('message', ' added successfully');
            redirect($this->agent->referrer());
            //  redirect('lead/lead_details/'.$lead_id);
        } else {
            redirect('lead');
        }
    }

    public function enquiry_response_task() {
        
        if (!empty($_POST)) {
            $ld_updt_by = $this->session->userdata('user_id');
            $lead_id = $this->input->post('enq_code');
            $related_to = $this->input->post('assign_employee');
            $task_type = $this->input->post('task_type');
            $meeting_date = $this->input->post('meeting_date');
            $contact_person = $this->input->post('contact_person');
            $mobileno = $this->input->post('mobileno');
            $email = $this->input->post('email');
            $designation = $this->input->post('designation');
            $conversation = trim($this->input->post('conversation'));
            $subject = $this->input->post('subject');
            $task_status = $this->input->post('task_status');
            
            $task_date = date("d-m-Y",strtotime($this->input->post('task_date')));
            
            $task_time = date("h:i:s",strtotime($this->input->post('task_time')));
            
            $task_remark = $this->input->post('task_remark');
            
            $cdate2 = str_replace('/', '-', $meeting_date);
            
            //$adt = date("d-m-Y h:i:s a");
            
            if (!empty($this->input->post('subject'))) {
                $this->db->set('query_id', $this->input->post('subject'));
            }
            $this->db->set('query_id', $lead_id);
            
            $this->db->set('subject', $subject);

            //$this->db->set('upd_date', $adt); //Created Date
            //$this->db->set('nxt_date', $cdate2);

            $this->db->set('contact_person', $contact_person);
            $this->db->set('mobile', $mobileno);
            $this->db->set('email', $email);
            $this->db->set('designation', $designation);
           // $this->db->set('org_name', $org_name);
            $this->db->set('conversation', $conversation);
            $this->db->set('task_type', $task_type);
            $this->db->set('task_status', $task_status);
            
            $this->db->set('task_date', $task_date);
            $this->db->set('task_time', $task_time);
            $this->db->set('task_remark', $task_remark);
            $this->db->set('notification_id', $this->input->post('notification_id'));
            
            $this->db->set('create_by', $this->session->user_id);
            $this->db->set('related_to', $related_to);
            $this->db->insert('query_response');
            
            $this->Leads_Model->add_comment_for_events('Task details has been added', $lead_id);
             
            $this->session->set_flashdata('message', 'Task Added Successfully');
            redirect($this->agent->referrer());
        } else {
            redirect('lead');
        }
    }

    public function enquiry_response_updatetask() {
        if (!empty($_POST)) {
            $ld_updt_by = $this->session->userdata('user_id');
            $lead_id = $this->input->post('enq_code');
            $task_type = $this->input->post('task_type');
            $meeting_date = $this->input->post('meeting_date');
            $contact_person = $this->input->post('contact_person');
            $mobileno = $this->input->post('mobileno');
            $email = $this->input->post('email');
            $designation = $this->input->post('designation');
            $conversation = trim($this->input->post('task_remark'));
            $subject = $this->input->post('subject');
            
             $task_date = date("d-m-Y",strtotime($this->input->post('task_date')));
            
            $task_time = date("H:i:s",strtotime($this->input->post('task_time')));
            
            $task_remark = $this->input->post('task_remark');
            $related_to = $this->input->post('assign_employee');
            $task_status = $this->input->post('task_status');
            //$cdate2 = str_replace('/', '-', $meeting_date);
            $adt = date("d-m-Y h:i:s a");
            
            //$this->db->set('upd_date', $adt);
            //$this->db->set('nxt_date', $cdate2);

            $this->db->set('contact_person', $contact_person);
            $this->db->set('mobile', $mobileno);
            $this->db->set('task_status', $task_status);
            
            $this->db->set('task_date', $task_date);
            $this->db->set('task_time', $task_time);
            $this->db->set('task_remark', $task_remark);
            
            $this->db->set('subject', $subject);
            $this->db->set('email', $email);
            $this->db->set('designation', $designation);
            $this->db->set('conversation', $conversation);
            $this->db->set('task_type', $task_type);
            $this->db->where('resp_id', $lead_id);
            $this->db->set('create_by', $this->session->user_id);
            $this->db->set('related_to', $related_to);
            $this->db->update('query_response');
            $task_enquiry_code = $this->input->post('task_enquiry_code');
             
             $this->Leads_Model->add_comment_for_events_stage('Task details has been updated successfully', $task_enquiry_code,0,0,$subject.'<br>'.$conversation,1,'4');

            $this->session->set_flashdata('message', 'Task Updated Successfully');
            redirect($this->agent->referrer());
        } else {
            redirect('lead');
        }
    }

  ///////////////// STAGE Visibility Mapping ////////////////////

    public function stage_mapping() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $stage_name = $this->input->post('stage_name');
            $visible_status = $this->input->post('visible_status');
            $stage_lang = $this->input->post('stage_lang');
            

            $data = array(
                'stage_id' => $stage_name,
                'visible_status' => $visible_status,
                'lang_name' => $stage_lang,
                'created_by' => $this->session->user_id,
                'comp_id' => $this->session->userdata('companey_id')
            );

            $insert_id = $this->Leads_Model->lead_stagemapp($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Stage Mapping Add Successfully');
            redirect('lead/stage_mapping');
        }

        $data['mapping_stages'] = $this->Leads_Model->get_leadstage_mapping();
        $data['lead_stages'] = $this->Leads_Model->get_leadstage_all();
        $data['title'] = display("lead_stage_mapping");
        $data['content'] = $this->load->view('map_stage_visibility', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function update_stage_map() {

        if (!empty($_POST)) {
            $stage_name = $this->input->post('stage_name');
            $stage_lang = $this->input->post('stage_lang');
            $visible_status = $this->input->post('visible_status');
            $map_id = $this->input->post('map_id');
            
            $this->db->set('stage_id', $stage_name);
            $this->db->set('visible_status', $visible_status);
            $this->db->set('lang_name', $stage_lang);
            $this->db->where('id', $map_id);
            $this->db->update('stage_visible');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/stage_mapping');
        }
    }

    public function delete_stage_map($stage = null) {
        if ($this->Leads_Model->delete_stage_map($stage)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/stage_mapping');
    }

    ///////////////// STAGE ////////////////////

    public function stage() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $lead_stage_name = $this->input->post('stage_name');
            $process = $this->input->post('process');
            $stage_for = $this->input->post('stage_for');
            $stage_for_disp = $this->input->post('stage_for_disp');
            $stage_order = $this->input->post('stage_order');
            $department=$this->input->post('department');
            
            if (!empty($process)) {
                $process    =   implode(',', $process);
            }
            if (!empty($stage_for)) {
                $stage_for    =   implode(',', $stage_for);
            }
            if (!empty($department)) {
            $department =implode(',',$department);
            }
            $data = array(
                'lead_stage_name' => $lead_stage_name,
                'process_id'   => $process,
                'stage_for'   => $stage_for,
                'departments_for'=>$department,
                'stage_for_disp'   => $stage_for_disp,
                'stage_order'   => $stage_order,
                'comp_id' => $this->session->userdata('companey_id')
            );

            $insert_id = $this->Leads_Model->lead_stageadd($data);

            $this->session->set_flashdata('SUCCESSMSG', 'Lead Stage Add Successfully');
            redirect('lead/stage');
        }


        $data['lead_stages'] = $this->Leads_Model->get_leadstage_list();
        // echo $this->db->last_query();
        // print_r($data['lead_stages']);exit();
        // print_r($this->session->userdata('companey_id'));exit();
        $data['products'] = $this->dash_model->get_user_product_list();
        // print_r($data['products']);exit();
        $data['title'] = 'Lead Stage';
        $data['all_department'] = $this->Leads_Model->dept_select();
        $data['content'] = $this->load->view('lead_stage', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function delete_stage($stage = null) {
        if ($this->Leads_Model->delete_stage($stage)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/stage');
    }

  public function update_stage() {

        if (!empty($_POST)) {
            $stage_name = $this->input->post('stage_name');
            $stage_id = $this->input->post('stage_id');
            $process = $this->input->post('process');
            $stage_for = $this->input->post('stage_for');
            $stage_for_disp = $this->input->post('stage_for_disp');
            $stage_order = $this->input->post('stage_order');
            $department=$this->input->post('department');

            if (!empty($process)) {
                $process    =   implode(',', $process);
            }
            if (!empty($stage_for)) {
                $stage_for    =   implode(',', $stage_for);
            }
            if (!empty($department)) {
            $department =implode(',',$department);
            }
            $this->db->set('lead_stage_name', $stage_name);
            $this->db->set('process_id', $process);
            $this->db->set('stage_for', $stage_for);
            $this->db->set('stage_for_disp', $stage_for_disp);
            $this->db->set('stage_order', $stage_order);
            $this->db->set('departments_for', $department);
            $this->db->where('stg_id', $stage_id);
            $this->db->update('lead_stage');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/stage');
        }
    }

//Disposition Type Master Start
public function desp_type() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $type_name = $this->input->post('type_name');

            $data = array(
                'type_name' => $type_name,
                'comp_id' => $this->session->userdata('companey_id'),
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->desp_typeadd($data);

            $this->session->set_flashdata('SUCCESSMSG', 'Disposition type Add Successfully');
            redirect('lead/desp_type');
        }


        $data['desp_type'] = $this->Leads_Model->get_desptype_list();
        $data['title'] = 'Disposition Types';
        $data['content'] = $this->load->view('desp_type', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function update_type() {

        if (!empty($_POST)) {
            $type_name = $this->input->post('type_name');
            $type_id = $this->input->post('type_id');

            $this->db->set('type_name', $type_name);
            $this->db->where('id', $type_id);
            $this->db->update('desposition_type');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/desp_type');
        }
    }

    public function delete_type($type_id = null) {
        if ($this->Leads_Model->delete_type($type_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/desp_type');
    }
    
//Disposition Type Master End

    
    public function update_description() {

       /*echo "<pre>";
        print_r($_POST);*/
       //exit();

       $en_id=$this->uri->segment(3);
       $action = $this->input->post('url');
        if (!empty($_POST)) {

            if($action==='enquiry'){
             $coment_type=1;
            }
            if($action==='lead'){
             $coment_type=2;
            }
            if($action==='client'){
             $coment_type=3;
            }
            if($action==='refund'){
             $coment_type=4;
            }
            $lead_id = $this->input->post('unique_no');
            $stage_id = $this->input->post('lead_stage');
            $call_stage = $this->input->post('call_stage');
            $stage_date = date("d-m-Y",strtotime($this->input->post('c_date')));

            //echo $stage_date;
            
            $stage_time = date("H:i:s",strtotime($this->input->post('c_time')));
            
            $stage_desc = $this->input->post('lead_description');
            $stage_remark = $this->input->post('conversation');
            $contact_person = $this->input->post('contact_person1');
            $mobileno = $this->input->post('mobileno1');
            $email = $this->input->post('email1');
            $designation = $this->input->post('designation1');
            $enq_code = $this->input->post('enq_code1');

            $type_disposition = $this->input->post('type_disposition');
           
        if(!empty($stage_id)){
            $this->db->set('lead_stage', $stage_id);
        }
        if(!empty($call_stage)){
            $this->db->set('call_stage', $call_stage);
        }
            $this->db->set('lead_discription', $stage_desc);
            $this->db->set('lead_discription_reamrk', $stage_remark);

            $this->db->where('enquiry_id', $en_id);
            $this->db->update('enquiry');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            $this->Leads_Model->add_comment_for_events_stage('Stage Updated', $lead_id,$stage_id,$stage_desc,$stage_remark,$coment_type,'4',$type_disposition,$call_stage);
//For bell notification
$this->db->select('email,Enquery_id,name_prefix,name,lastname,phone,comp_id,aasign_to,all_assign');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$en_id);
    $this->db->limit(1);
    $bell = $this->db->get()->row();

$this->db->select('description');
    $this->db->from('lead_description');
    $this->db->where('id',$stage_desc);
    $disc = $this->db->get()->row();

$this->db->select('lead_stage_name');
    $this->db->from('lead_stage');
    $this->db->where('stg_id',$stage_id);
    $stg = $this->db->get()->row();

$task_date = date("d-m-Y");
$task_time = date("h:i:s");
$subject = 'Stage Updated';
$stage = $stg->lead_stage_name??'No stage';
$discription = $disc->description??'No Disposition';
$remark = $stage_remark;
$msg = $stage. ' > ' .$discription.'</br>' .$remark;
$z = explode(',',$bell->all_assign);
foreach ($z as $key => $aa) {
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($bell->Enquery_id,$aa,$subject,$msg,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

            $notification_id = $this->input->post('dis_notification_id');
            $dis_subject = $this->input->post('dis_subject');

            if($stage_desc == 'updt'){                
                $tid    =   $this->input->post('latest_task_id');
                $this->db->set('task_date', $stage_date);
                $this->db->set('task_time', $stage_time);
                $this->db->set('subject', $dis_subject);                
                $this->db->set('task_remark', $stage_remark);
                $this->db->set('notification_id', $notification_id);
                $this->db->set('type_disposition', $type_disposition);
                $this->db->set('call_stage', $call_stage);
                $this->db->where('resp_id',$tid);
                $this->db->update('query_response');
            }else{                
                if (!empty($this->input->post('c_date'))) {
                    $this->Leads_Model->add_comment_for_events_popup($stage_remark,$stage_date,$contact_person,$mobileno,$email,$designation,$stage_time,$enq_code,$notification_id,$dis_subject,$type_disposition,$call_stage);                
                }
            }
//For file upload Notify Student start
if($stage_id=='382'){
$enq_data= $this->db->where(array('enquiry_id'=>$en_id))->get('enquiry')->row();
$this->db->select('pk_i_admin_id');
$this->db->from('tbl_admin');
$this->db->where('s_user_email',$enq_data->email);
$this->db->where('s_phoneno',$enq_data->phone);
$stuid= $this->db->get()->row();
$id_for_bell_noti=$stuid->pk_i_admin_id; 
$conversation = 'File Applied';
$stage_remark = 'Dear Applicant Your File Applied Successfully.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_data->Enquery_id,$enq_data->aasign_to,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_data->Enquery_id,$id_for_bell_noti,$conversation,$stage_remark); 
}
}

//For file upload Notify Student end

//For bell notification Portal Inactive
if($stage_id=='383'){
$this->db->select('name,lastname,phone,email,Enquery_id,aasign_to,all_assign,comp_id');
        $this->db->where('enquiry_id', $en_id);
        $val =   $this->db->get('enquiry')->row();

$this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        $this->db->where('companey_id',$val->comp_id);
        $this->db->where('pk_i_admin_id',$val->aasign_to);
        $sender_row =   $this->db->get('tbl_admin')->row_array();

if(!empty($sender_row['telephony_agent_no'])){
    $senderno = '0'.$sender_row['telephony_agent_no'];
}else{
    $senderno = $sender_row['s_phoneno'];
}

$sms_message= $this->db->where(array('temp_id'=>'358','comp_id'=>$val->comp_id))->get('api_templates')->row();

$noti_subject = $sms_message->template_name;             
            $new_message = $sms_message->template_content;

                    $new_message = str_replace('@name', $val->name.' '.$val->lastname,$new_message);
                    $new_message = str_replace('@phone', $val->phone,$new_message);
                    $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
                    $new_message = str_replace('@userphone', $senderno,$new_message);
                    $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
                    $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
                    $new_message = str_replace('@email', $val->email,$new_message);
                    $new_message = str_replace('@password', '12345678',$new_message);

//$z = explode(',',$val->all_assign);
//foreach ($z as $key => $aa) {
$aa= $val->aasign_to;
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->user_model->add_comment_for_student_user($val->Enquery_id,$aa,$noti_subject,$new_message,$task_date,$task_time,$sender_row['pk_i_admin_id']);
        }
//}
}
//For Sms Bell Notification

            $this->load->model('rule_model');
            $this->rule_model->execute_rules($enq_code,array(1,2,3,4,6,7));
            //print_r($coment_type);exit;
if($coment_type == 1){          
    redirect('enquiry/view/'.$en_id);
}else if($coment_type == 2){
    redirect('lead/lead_details/'.$en_id);
}else if($coment_type == 3){
    redirect('client/view/'.$en_id);
}else if($coment_type == 4){
    redirect('refund/view/'.$en_id);
}
        }
    }

    public function delete_score($score = null) {
        if ($this->Leads_Model->delete_score($score)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/lead_score');
    }

    public function update_score() {
        if (!empty($_POST)) {
            $score_name = $this->input->post('score_name');
            $score_rate = $this->input->post('score_rate');
            $score_id = $this->input->post('score_id');

            $this->db->set('score_name', $score_name);
            $this->db->set('probability', $score_rate);
            $this->db->where('sc_id', $score_id);
            $this->db->update('lead_score');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/lead_score');
        }
    }

    public function delete_source($source = null) {
        if ($this->Leads_Model->delete_source($source)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/lead_source');
    }

    public function update_source() {

        if (!empty($_POST)) {
            $source_id = $this->input->post('source_id');

            $source_name = $this->input->post('source_name');

            $this->db->set('lead_name', $source_name);
            $this->db->where('lsid', $source_id);
            $this->db->update('lead_source');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/lead_source');
        }
    }

    public function delete_dropReason($drop = null) {
        if ($this->Leads_Model->delete_dropReason($drop)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/add_drop');
    }

    public function update_drop() {

        if (!empty($_POST)) {
            $drop_id = $this->input->post('drop_id');

            $reason = $this->input->post('reason');

            $this->db->set('drop_reason', $reason);
            $this->db->where('d_id', $drop_id);
            $this->db->update('tbl_drop');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/add_drop');
        }
    }

    public function delete_ctype($ctype = null) {
        if ($this->Leads_Model->delete_ctype($ctype)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/customer_type');
    }

    public function update_cusType() {

        if (!empty($_POST)) {
            $cid = $this->input->post('cid');

            $c_type = $this->input->post('c_type');
            $c_typename = $this->input->post('c_typename');

            $this->db->set('c_typename', $c_typename);
            $this->db->set('c_type', $c_type);
            $this->db->where('cid', $cid);
            $this->db->update('customer_type');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/customer_type');
        }
    }

    /////////////////////////////////////////////////



    public function lead_source() {
        $data['nav1'] = 'nav2';

        if (!empty($_POST)) {

            $lead_source_name = $this->input->post('source_name');

            $data = array(
                'lead_name' => $lead_source_name,
                'comp_id' => $this->session->userdata('companey_id')
            );

            $insert_id = $this->Leads_Model->lead_sourceadd($data);

            $this->session->set_flashdata('SUCCESSMSG', 'Lead Source Add Successfully');
            redirect('lead/lead_source');
        }

        $data['lead_source'] = $this->Leads_Model->get_leadsource_list();
        $data['content'] = $this->load->view('lead_source', $data, true);

        $this->load->view('layout/main_wrapper', $data);
    }

    public function lead_score() {
        $data['nav1'] = 'nav2';

        if (!empty($_POST)) {

            $score_name = $this->input->post('score_name');
            $score_rate = $this->input->post('score_rate');

            $data = array(
                'score_name' => $score_name,
                'comp_id' => $this->session->userdata('companey_id'),
                'probability' => $score_rate
            );

            $insert_id = $this->Leads_Model->lead_scoreadd($data);

            $this->session->set_flashdata('SUCCESSMSG', 'Lead Score Add Successfully');
            redirect('lead/lead_score');
        }

        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $data['title'] = 'Lead Probability';
        $data['content'] = $this->load->view('lead_score', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function customer_type() {

        if (!empty($_POST)) {

            $c_type = $this->input->post('c_type');
            $c_typename = $this->input->post('c_typename');

            $data = array(
                'c_typename' => $c_typename,
                'c_type' => $c_type
            );

            $insert_id = $this->Leads_Model->add_customerType($data);

            $this->session->set_flashdata('SUCCESSMSG', 'Customer Type Add Successfully');
            redirect('lead/customer_type');
        }

        $data['title'] = 'Customer Type';
        $data['c_type'] = $this->Leads_Model->get_customerType_list();
        $data['content'] = $this->load->view('customer_type', $data, true);

        $this->load->view('layout/main_wrapper', $data);
    }

    /////////////////// Move To Client ////////////////////////////
    public function move_to_lead() {

        if (!empty($_POST)) {
            $move_lead = $this->input->post('lead_status');
            foreach ($move_lead as $key) {

                $this->db->set('lead_stage', 'Account');
                $this->db->where('lid', $key);
                $this->db->update('allleads');

                //////////////// Insert Lead Data Into Client Table ///////////////////////
                $lead = $this->Leads_Model->get_lead_for_account($key);

                $name = $lead->ld_name;
                $email = $lead->ld_email;
                $mobile = $lead->ld_mobile;
                $address = $lead->address;

                $data = array(
                    'cl_name' => $name,
                    'city_id' => $lead->city_id,
                    'customer_code' => $lead->lead_code,
                    'create_by' => $lead->adminid,
                    'updated_by' => $this->session->user_id,
                    'created_date' => date('Y-m-d H:i:s'),
                    'ip_address' => $_SERVER['REMOTE_ADDR'],
                    'cl_email' => $email,
                    'cl_mobile' => $mobile,
                    'address' => $address,
                    'cl_status' => '1'
                );
                $insert_id = $this->Leads_Model->ClientMove($data);

                //////////////////////////////////////////////////////////////////////////
            }
            //echo 'Transfer Lead Successfully';
            redirect('lead');
        } else {
            echo "<script>alert('Something Went Wrong')</script>";
            redirect('lead');
        } 
    }

    public function convert_to_lead() {        
       // $enquiry_id = $this->uri->segment('3');

//New code for popup submit
        $enquiry_id = $this->input->post('enquiry_id');
        $lead_score = $this->input->post('lead_score');
        $lead_stage = $this->input->post('move_lead_stage');
        $lead_discription = $this->input->post('lead_description');
        $comment = $this->input->post('comment'); 
        $expected_date = $this->input->post('expected_date');
        $assign_employee = $this->input->post('assign_employee');

//For update all assign id Start
if(!empty($assign_employee)){
            $this->db->select('all_assign');
            $this->db->where('enquiry_id',$enquiry_id);
            $res=$this->db->get('enquiry');
            $q=$res->row();
            $z=array();$new=array();$allid=array();
                 $z = explode(',',$q->all_assign);
                 $new[]=$assign_employee;
                $allid = array_unique (array_merge ($z, $new));
                //print_r($allid);exit; 
                $string_id=implode(',',$allid);
                
                $this->db->set('all_assign', $string_id);
$this->db->where('enquiry_id',$enquiry_id);
$this->db->update('enquiry');                         
            }
//For update all assign id End

//end
        $lead = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);
               // print_r($lead->status); exit;
        if ($lead->status >= 2) {
           //$this->Leads_Model->ClientMove($data);
            $enquiry_separation  = get_sys_parameter('enquiry_separation','COMPANY_SETTING');
            if (!empty($enquiry_separation)) {                    
                $enquiry_separation = json_decode($enquiry_separation,true);
                $stage    =   $lead->status;
                $next_stage = $stage+1;     
                $title = $enquiry_separation[$next_stage]['title'];
                $url = 'client/index/?stage='.$stage;
                $comment = 'Converted to '.$title;       
                $this->db->set('status', $next_stage);                
            }else{
            if($lead->status=='2'){
                $url = 'led/index';   
                $comment = 'Converted to Case Management';       
                $this->db->set('status', 3);
            }else if($lead->status=='3'){
                $url = 'client/index';   
                $comment = 'Converted to Refund Case';       
                $this->db->set('status', 4);
            }
            }
//New code for popup submit

            $this->db->set('lead_score', $lead_score);
            $this->db->set('lead_stage', $lead_stage);
            $this->db->set('lead_discription', $lead_discription);
            $this->db->set('lead_comment', $comment);
            $this->db->set('lead_expected_date', $expected_date);
        if(!empty($assign_employee)){
            $this->db->set('aasign_to', $assign_employee);
        }

//end 
            $this->db->set('created_date', date('Y-m-d H:i:s'));
            $this->db->set('update_date', '');
            $this->db->where('enquiry_id', $enquiry_id);
            $this->db->update('enquiry'); 
            $data['enquiry'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);
            $lead_code = $data['enquiry']->Enquery_id;
            
            $this->Leads_Model->add_comment_for_events($comment, $lead_code);
            $msg = $comment.' Successfully';

            $this->load->model('rule_model');
            $this->rule_model->execute_rules($lead_code,array(1,2,3,6,7));  

            if ($lead->status == 2 && $this->session->companey_id == 76 || ($this->session->companey_id == 57 && $data['enquiry']->product_id == 122) ) {
                $user_right = '';
                if ($data['enquiry']->product_id == 168) {
                    $user_right = 180;  
                }else if ($data['enquiry']->product_id == 169) {
                    $user_right = 186;
                } 
                $report_to = ''; 
                if($this->session->companey_id == 57){

                    if (!empty($data['enquiry']->email) || !empty($data['enquiry']->phone)) {
                        $user_exist = $this->dashboard_model->check_user_by_mail_phone(array('email'=>$data['enquiry']->email,'phone'=>$data['enquiry']->phone));    
                    }                    
                    $user_right = 200;                    
                    $report_to=$data['enquiry']->created_by;
                }
                $ucid    =   $this->session->companey_id;
                
                $postData = array(
                        's_display_name'  =>    $data['enquiry']->name,
                        'last_name'       =>    $data['enquiry']->lastname,  
                        's_user_email'    =>    $data['enquiry']->email,
                        's_phoneno'       =>    $data['enquiry']->phone,
                        
                        'city_id'         =>    $data['enquiry']->enquiry_city_id,
                        'state_id'        =>    $data['enquiry']->enquiry_state_id,

                        'companey_id'     =>    $ucid,
                        'b_status'        =>    1,
                        'user_permissions'=>    $user_right,
                        'user_roles'      =>    $user_right,
                        'user_type'       =>    $user_right,                        
                        's_password'      =>    md5(12345678),
                        'report_to'       =>    $report_to
                    );
                if (!empty($user_exist)) {
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
                $message = 'Email - '.$data['enquiry']->email.'<br>Password - 12345678';                
                $subject = 'Login Details';

                if ($this->session->companey_id == 57 && $user_id) {
                    $this->db->where('temp_id',125);
                    $this->db->where('comp_id',57);
                    $temp_row    =   $this->db->get('api_templates')->row_array();
                    if (!empty($temp_row)) {
                        $subject = $temp_row['mail_subject'];   
                        $message = str_replace("@{email}",$data['enquiry']->email,$temp_row['template_content']);   
                        $message = str_replace("@{password}",'12345678',$message);   
                    }
                 
                    $this->Message_models->send_email($data['enquiry']->email,$subject,$message);

                    $this->db->where('temp_id',124);
                    $this->db->where('comp_id',57);
                    $temp_row    =   $this->db->get('api_templates')->row_array();
                    if (!empty($temp_row)) {                        
                        $message = str_replace("@{email}",$data['enquiry']->email,$temp_row['template_content']);   
                        $message = str_replace("@{password}",'12345678',$message);   
                    }
                    $this->Message_models->smssend($data['enquiry']->phone,$message);
                    $msg .=    " And user created successfully";
                }else{
                    $msg .=    " And user already exist";                    
                }
            }
            //$mail_access = $this->enquiry_model->access_mail_temp(); //access mail template..
            //$signature = $this->enquiry_model->get_signature();

       /*     $to = 'glahsnigam@gmail.com';
            $from_email = 'info@archizcrm.com';            
                $phone = '91' . $lead->phone;
                $message = "Congratulations and Welcome on board as Authorized Channel Partner.";
                //$this->Message_models->smssend($phone, $message);
                //$this->Message_models->sendwhatsapp($phone, $message);
                if(isset($mail_access)){
                foreach ($mail_access as $rows) {
                    if (trim($rows->response_type) == 2 && trim($rows->auto_mail_for) == 3) {
                        $img = "<img src='" . base_url($signature->logo) . "' width='100px' height='100px' onerror='this.style.display=" . 'none' . "'>";
                        if (strpos($rows->template_content, '@') == true) {
                            $msg = str_replace('@name', $name1, str_replace('@org', $org, str_replace('@phone', $this->session->phone, str_replace('@desg', $this->session->designation, str_replace('@user', $this->session->fullname, $rows->template_content)))));
                        } else {
                            $msg = $rows->template_content;
                        }
                        $this->email->from($from_email, 'Osum');
                        $this->email->to($to);
                        $this->email->subject($rows->mail_subject);
                        $this->email->message($msg);
                        $this->email->set_mailtype('html');
                        //$this->email->send();
                    }
                }
        }*/
            $this->session->set_flashdata('message',$msg );
            redirect($url);
        } else {
            $this->session->set_flashdata('exception', 'Please Complete all Stages');
            redirect($url);            
        }
    }

    public function add_drop() {
        $data['title'] = 'Drop Reasons';
        $data['nav1'] = 'nav2';
        #------------------------------# 
        $leadid = $this->uri->segment(3);

        //////////////////////////////////////////////////////
        if (!empty($_POST)) {

            $reason = $this->input->post('reason');

            $data = array(
                'drop_reason' => $reason,
                'comp_id' => $this->session->userdata('companey_id')
            );

            $insert_id = $this->Leads_Model->add_dropType($data);

            redirect('lead/add_drop');
        }
        //////////////////////////////////////////////////////


        $data['drops'] = $this->Leads_Model->get_drop_list();

        $data['content'] = $this->load->view('drop', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function drop_lead() {
        $data['title'] = 'Drop Reasons';
        $leadid = $this->uri->segment(3);

       // print_r($this->input->post('drop_status'));exit;
        
        if (!empty($_POST)) {
            $reason = $this->input->post('reason');
            $drop_status = $this->input->post('drop_status');

            $this->db->set('drop_status', $drop_status);
            $this->db->set('drop_reason', $reason);

            $this->db->where('enquiry_id', $leadid);
            
            $this->db->update('enquiry');
            
            $this->Leads_Model->add_comment_for_events('Dropped Application', $leadid);

            redirect('led/index');
        }
        $data['drops'] = $this->Leads_Model->get_drop_list();
        $data['content'] = $this->load->view('drop', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function post_po() {
        if (!empty($_POST)) {
            $picture = $this->fileupload->do_upload(
                    'assets/po_order/', 'img_file'
            );
            //if picture is not uploaded
            if ($picture === false) {
                $this->session->set_flashdata('exception', display('Fail Uploading Po order'));
                redirect($this->agent->referrer());
            } else {
                $this->db->set('customer_id ', $this->input->post('lead_id_name'));
                $this->db->set('po_document_img ', $picture);
                $this->db->set('created_date ', date('Y-m-d h:s:i'));
                $this->db->set('created_by', $this->session->user_id);
                $this->db->insert('tbl_po');
                $this->db->set('lead_stage', 9);
                $this->db->where('lead_code', $this->input->post('lead_id_name'));
                $this->db->update('allleads');
                $this->session->set_flashdata('message', display('Uploaded Successfully'));
                redirect('lead');

                $data['enquiry'] = $this->Leads_Model->get_leadListDetailsby_id($this->input->post('lead_id_name'));
                $lead_code = $data['enquiry']->lead_code;
                $this->Leads_Model->add_comment_for_events('Converted to Case Management', $lead_code);
            }
        }
    }

    public function network_digram() {
        if (!empty($_POST)) {
            $picture = $this->fileupload->do_upload(
                    'assets/network_img/', 'img_file'
            );
            //if picture is not uploaded
            //  print_r($picture);exit();
            if ($picture === false) {
                $this->session->set_flashdata('message', display('Fail Uploading Layout Sheet  order'));
                redirect($this->agent->referrer());
            } else {
                if (!empty($picture)) {
                    $this->db->set('customer_id ', $this->input->post('lead_id_name'));
                    $this->db->set('netoek_document_img ', $picture);
                    $this->db->set('created_date ', date('Y-m-d h:s:i'));
                    $this->db->set('created_by', $this->session->user_id);
                    $this->db->insert('tbl_network');
                    $this->db->set('lead_stage', 4);
                    $this->db->where('lead_code', $this->input->post('lead_id_name'));
                    $this->db->update('allleads');
                    $this->session->set_flashdata('message', 'Uploaded Successfully');

                    $data['enquiry'] = $this->Leads_Model->get_leadListDetailsby_id($this->input->post('lead_id_name'));

                    $lead_code = base64_encode($this->input->post('lead_id_name'));

                    $this->Leads_Model->add_comment_for_events('Layout Sheet Added', $lead_code);
                    $this->session->set_flashdata('message', display('Layout Sheet Uploaded successfully'));
                    redirect('lead');
                } else {
                    $this->session->set_flashdata('message', display('Fail Uploading Layout Sheet order'));
                    redirect($this->agent->referrer());
                }
            }
        }

        redirect($this->agent->referrer());
    }

    public function invoice_add() {
        if (!empty($_POST)) {
            $picture = $this->fileupload->do_upload(
                    'assets/inovice_details/', 'img_file'
            );
            //if picture is not uploaded
            if ($picture === false) {
                $this->session->set_flashdata('exception', display('Fail Uploading Po order'));
                redirect($this->agent->referrer());
            } else {
                $this->db->set('customer_id ', $this->input->post('lead_id_name'));
                $this->db->set('netoek_document_img ', $picture);
                $this->db->set('created_date ', date('Y-m-d h:s:i'));
                $this->db->set('created_by', $this->session->user_id);
                $this->db->insert('tbl_network');
                $this->db->set('lead_stage', 4);
                $this->db->where('lid', $this->input->post('lead_id_name'));
                $this->db->update('allleads');
                $this->session->set_flashdata('message', display('Uploaded Successfully'));

                $data['enquiry'] = $this->Leads_Model->get_leadListDetailsby_id($this->input->post('lead_id_name'));
                $lead_code = $data['enquiry']->lead_code;
                $this->Leads_Model->add_comment_for_events('Network Diagram Added', $lead_code);
            }
        }
    }

    public function active_lead($id) {


        $this->db->set('drop_status', 0);

        $this->db->where('enquiry_id', $id);

        $this->db->update('enquiry');

        $data['enquiry'] = $this->Leads_Model->get_leadListDetailsby_ledsonly($id);

        $lead_code = $data['enquiry']->Enquery_id;

        $this->Leads_Model->add_comment_for_events('Application actived ', $lead_code);

        $this->session->set_flashdata('message', "Activated Successfully");

        redirect('lead/lead_details/' . $id);
    }

    /////////////////////////////////////////////////////

    public function assign_lead() {
        if (!empty($_POST)) {
            $move_enquiry = $this->input->post('enquiry_id');
            $assign_dept = $this->input->post('branch_dept');
            $assign_branch = $this->input->post('branch_name');
            $assign_employee = $this->input->post('assign_employee');
            $user = $this->User_model->read_by_id($assign_employee);
            $notification_data=array();$assign_data=array();
            if (!empty($move_enquiry)) {
                foreach ($move_enquiry as $key) {
                    $assign_data[]=array('aasign_to'=> $assign_employee,
                        'assign_dept'=>$assign_dept,
                        'assign_branch'=>$assign_branch,
                        'assign_by'=>$this->session->user_id,
                        'update_date'=>date('Y-m-d H:i:s'),
                        'enquiry_id'=>$key);
                    $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($key);
                    $lead_code = $data['details']->Enquery_id;
                    $notification_data[]=array('assign_to'=>$assign_employee,
                        'assign_by'=> $this->session->user_id,
                        'assign_date'=>date('Y-m-d H:i:s'),
                        'untouch'=>'1',
                        'enq_id'=> $key,
                        'enq_code'=>$lead_code,
                        'assign_status'=> 0);
                    $this->Leads_Model->add_comment_for_events('Assign Applications', $lead_code);
                }
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
                $this->db->update_batch('enquiry',$assign_data,'enquiry_id');
                $this->db->insert_batch('tbl_assign_notification',$notification_data);
// Bell Notification Start
                $bell_data[]=array(
                        //'query_id'=> $lead_code,
                        'subject'=>'Applications Assigned',
                        'create_by'=>$this->session->user_id,
                        'task_date'=>date('d-m-Y'),
                        'task_time'=>date('h:i:s'),
                        'task_remark'=>'New ('.count($move_enquiry).') Applications Assigned To You! Go To List And Check There.',
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

    public function assign_presales() {
        if (!empty($_POST)) {
            $move_enquiry = $this->input->post('enquiry_id');
            $assign_employee = $this->input->post('assign_presales');
            if (!empty($move_enquiry)) {
                foreach ($move_enquiry as $key) {
                    //  $this->db->set('assign_to',$assign_employee);
                    $this->db->set('assign_for_boq', $assign_employee);
                    $this->db->set('update_date', date('Y-m-d H:i:s'));
                    $this->db->where('lid', $key);
                    $this->db->update('allleads');

                    $data['enquiry'] = $this->Leads_Model->get_leadListDetailsby_ledsonly($key);
                    $lead_code = $data['enquiry']->lead_code;
                    $this->Leads_Model->add_comment_for_events('Applications Assigned To Pre-Salses', $lead_code);
                }
                echo '1';
            } else {
                echo display('please_try_again');
            }
        }
    }

    public function drop_leadss() {

        if (!empty($_POST)) {

            $reason = $this->input->post('reason_details');
            $drop_status = $this->input->post('drop_status');
            $move_enquiry = $this->input->post('enquiry_id');

            if (!empty($move_enquiry)) {
                foreach ($move_enquiry as $key) {
                    
                /*    $this->db->set('drop_status', $drop_status);

                    $this->db->set('drop_reason', $reason);

                    $this->db->set('update_date', date('Y-m-d H:i:s'));

                    $this->db->set('ld_status', 0);

                    $this->db->where('lid', $key);

                    $this->db->update('allleads');

                */


                    $this->db->set('drop_status', $drop_status);
                    $this->db->set('drop_reason', $reason);
                    //$this->db->set('update_date', date('Y-m-d H:i:s'));
                    $this->db->where('enquiry_id', $key);
                    $this->db->update('enquiry');


                    $data['enquiry'] = $this->Leads_Model->get_leadListDetailsby_ledsonly($key);
                    
                    /*echo "<pre>";
                    print_r($_POST);
                    exit();*/

                    //$lead_code = $data['enquiry']->lead_code;
                    
                    $lead_code = $data['enquiry']->Enquery_id;

                    $this->Leads_Model->add_comment_for_events('Dropped Applications', $lead_code);
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
                    $this->db->where('lid', $key);
                    $this->db->where('lead_stage!=', 'Account');
                    $this->db->delete('allleads');
                }
                $this->session->set_flashdata('message', "Enquiry Deleted Successfully");
                redirect(base_url() . 'lead');
            } else {
                echo display('please_try_again');
            }
        }
    }
    
    function productcountry() {
        if (user_role('33') == true) {}
        $data['title'] = 'Product List';
        $data['country'] = $this->location_model->productcountry();
        
        // echo "<pre>";
        // print_r($data['country']);exit();
        $data['content'] = $this->load->view('location/product_country_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function addproductcountry() {
        $data['title'] = 'Add Product';
        if (empty($this->input->post('user_id'))) {
          $this->form_validation->set_rules('country_name', display('country_name'), 'required|max_length[200]');
        } else {
          $this->form_validation->set_rules('country_name', display('country_name'), 'required|max_length[200]');
        }     
        $data['formdata'] = (object) $postData = [
            'id' => $this->input->post('id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'country_name' => $this->input->post('country_name', true),
            'price' => $this->input->post('price', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_by' => $this->session->userdata('user_id'),
            'updated_date' => date('Y-m-d'),
        ];
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('id'))) {
                if (user_role('30') == true) {}
                if ($this->location_model->addproductcountry($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('lead/productcountry');
            } else {
                if (user_role('31') == true) {                    
                }
                if ($this->location_model->updateProductCountry($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('lead/productcountry');
            }
        } else {
             $data['typeofpro_list'] = $this->warehouse_model->typeofproduct_list();
            $data['brand_list'] = $this->warehouse_model->brand_list();
            $data['content'] = $this->load->view('location/product_country_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    
    public function addproduct() {
         $data['title'] = 'Add Product';
        if (empty($this->input->post('user_id'))) {
          $this->form_validation->set_rules('proname', display('name'), 'required|max_length[50]');
        } else {
          $this->form_validation->set_rules('proname', display('name'), 'required|max_length[50]');
        }     
        $data['formdata'] = (object) $postData = [
            'id' => $this->input->post('id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'country_name' => $this->input->post('proname', true),
            'skuid' => $this->input->post('skuid', true),
            'typeofpro' => $this->input->post('top', true),
            'brand' => $this->input->post('brand', true),
            'price' => $this->input->post('price', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_by' => $this->session->userdata('user_id'),
            'updated_date' => date('Y-m-d'),
        ];
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('id'))) {
                if (user_role('30') == true) {}
                if ($this->location_model->addproductcountry($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('lead/productcountry');
            } else {
                if (user_role('31') == true) {                    
                }
                if ($this->location_model->updateProductCountry($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('lead/productcountry');
            }
        } else {
            $data['typeofpro_list'] = $this->warehouse_model->typeofproduct_list();
            $data['brand_list'] = $this->warehouse_model->brand_list();
            $data['content'] = $this->load->view('location/product_country_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }

    public function editproductcountry($param_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = 'Edit Product';
        $data['formdata'] = $this->location_model->readProductCountry($param_id);
        $data['content'] = $this->load->view('location/product_country_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

     public function editproductcountry1($param_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = 'Edit Product';
        $data['formdata'] = $this->location_model->readProductCountry($param_id);
        $data['typeofpro_list'] = $this->warehouse_model->typeofproduct_list();
        $data['brand_list'] = $this->warehouse_model->brand_list();
        $data['content'] = $this->load->view('location/product_country_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    
    public function deleteproductcountry($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->location_model->deleteproductcountry($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/productcountry');
    }
        

    public function institutelist() {
        if (user_role('30') == true) {}
        $data['title'] = display('institute_list');
        $data['institute_list'] = $this->Institute_model->institutelist();
        /*echo $this->db->last_query();
        print_r($data['institute_list']);*/
        $data['content'] = $this->load->view('institute/institute_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function courselist() { 
        if (user_role('30') == true) {}
        $data['title']          = display('course_list');
        $this->load->library('pagination');
        $config                 = array();
        $config["base_url"]     = base_url() . "lead/courselist";
        $config["total_rows"]   = $this->Institute_model->courselist('','','count');
        $config["per_page"]     = 10;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"]          = $this->pagination->create_links();

        $data['course_list']    = $this->Institute_model->courselist($config["per_page"], $page);
        /*echo $this->db->last_query();
        print_r($data['institute_list']);*/
        $data['courses']        = $this->Institute_model->findcourse();
        $data['discipline']     = $this->location_model->find_discipline();
        $data['level']          = $this->location_model->find_level();
        $data['length']         = $this->location_model->find_length();
        $data['content']        = $this->load->view('institute/course_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function upload_course(){
        /*echo "<pre>";    
        print_r($_FILES);
        echo "</pre>";   */
        $comp_id = $this->session->companey_id;
        $user_id = $this->session->user_id;
        $filename=$_FILES["course_file"]["tmp_name"];        
        $i = 0;
        $c = 0;
        if($_FILES["course_file"]["size"] > 0){
            $file = fopen($filename, "r");
            while (($courseData = fgetcsv($file, 10000, ",")) !== FALSE){
                if ($i) {                    
                    $course_name    = $courseData[0];                    
                    $rating         = $courseData[1];                                        
                    $course_ielet   = $courseData[2];
                    $discipline     = $courseData[3];
                    $level          = $courseData[4];
                    $length         = $courseData[5];
                    $institute      = $courseData[6];
                    $tuition_fees   = $courseData[7];
                    $description    = $courseData[8];
                    $status         = $courseData[9];
                    
                    /*echo "<pre>";
                    print_r($courseData);
                    echo "</pre>";*/

                    $this->db->select('id');                    
                    $this->db->where('course_name',$course_name);
                    $this->db->where('comp_id',$comp_id);
                    $course_row    =   $this->db->get('tbl_crsmaster')->row_array();
                    if (!empty($course_row)) {
                        $course_id = $course_row['id'];
                    }else{
                        $this->db->insert('tbl_crsmaster',array('course_name'=>$course_name,'status'=>1,'comp_id'=>$comp_id,'created_by'=>$user_id));
                        $course_id = $this->db->insert_id();
                    }
                    $this->db->select('id');                    
                    $this->db->where('discipline',$discipline);
                    $this->db->where('comp_id',$comp_id);
                    $discipline_row    =   $this->db->get('tbl_discipline')->row_array();
                    if (!empty($discipline_row)) {
                        $discipline_id = $discipline_row['id'];
                    }else{
                        $this->db->insert('tbl_discipline',array('comp_id'=>$comp_id,'discipline'=>$discipline,'status'=>1,'created_by'=>$user_id));
                        $discipline_id   =  $this->db->insert_id();
                    }
                    $this->db->select('id');                    
                    $this->db->where('level',$level);
                    $this->db->where('comp_id',$comp_id);
                    $level_row    =   $this->db->get('tbl_levels')->row_array();
                    if (!empty($level_row)) {
                        $level_id = $level_row['id'];
                    }else{
                        $this->db->insert('tbl_levels',array('comp_id'=>$comp_id,'level'=>$level,'status'=>1,'created_by'=>$user_id));
                        $level_id   =  $this->db->insert_id();
                    }
                    $this->db->select('id');                    
                    $this->db->where('length',$length);
                    $this->db->where('comp_id',$comp_id);
                    $length_row    =   $this->db->get('tbl_length')->row_array();
                    if (!empty($length_row)) {
                        $length_id = $length_row['id'];
                    }else{
                        $this->db->insert('tbl_length',array('comp_id'=>$comp_id,'length'=>$length,'status'=>1,'created_by'=>$user_id));
                        $length_id   =  $this->db->insert_id();
                    }
                    $this->db->select('institute_id');                    
                    $this->db->where('institute_name',$institute);
                    $this->db->where('comp_id',$comp_id);
                    $institute_row    =   $this->db->get('tbl_institute')->row_array();
                    if (!empty($institute_row)) {
                        $institute_id = $institute_row['institute_id'];
                    }else{
                        $this->db->insert('tbl_institute',array('comp_id'=>$comp_id,'institute_name'=>$institute,'status'=>1,'created_by'=>$user_id));
                        $institute_id   =  $this->db->get()->insert_id();
                    }
                    $crs_data = array(
                                    'comp_id'       => $comp_id,
                                    'institute_id'  => $institute_id,
                                    'length_id'     => $length_id,
                                    'level_id'      => $level_id,
                                    'discipline_id' => $discipline_id,
                                    'course_name'   => $course_id,
                                    'course_ielts'  => $course_ielet,
                                    'tuition_fees'  => $tuition_fees,
                                    'created_by'    => $user_id,
                                    'status'        => $status,
                                    'course_rating' => $rating,
                                    'course_discription'    => $description
                                );
                    if ($this->db->insert('tbl_course',$crs_data)) {
                        $c++;
                    }
                }
                $i++;
             }
            fclose($file);            
        }
        $this->session->set_flashdata('message',$c.' Data inserted successfully.');
        redirect('lead/courselist');             
    }
    
    public function crslist() {
        if (user_role('30') == true) {}
        $data['title'] = display('course_master');
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = base_url() . "lead/crslist";
        $config["total_rows"] = $this->Institute_model->crslist('','','count');
        $config["per_page"] = 10;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['course_list'] = $this->Institute_model->crslist($config["per_page"], $page);
        
        /*echo $this->db->last_query();
        print_r($data['institute_list']);*/
        $data['content'] = $this->load->view('institute/crs_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function sub_course() {
        if (user_role('30') == true) {}
        $data['title'] = display('sub_course');
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = base_url() . "lead/sub_course";
        $config["total_rows"] = $this->Institute_model->sub_course('','','count');
        $config["per_page"] = 10;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['course_list'] = $this->Institute_model->sub_course($config["per_page"], $page);
        $data['cource'] = $this->Institute_model->crsmstrlist();
        /*echo $this->db->last_query();
        print_r($data['institute_list']);*/
        $data['content'] = $this->load->view('institute/sub_crs_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function vidlist() {
        if (user_role('30') == true) {}
        $data['title'] = display('vedio_list');
        $data['vid_list'] = $this->Institute_model->vidlist();
        /*echo $this->db->last_query();
        print_r($data['institute_list']);*/
        $data['content'] = $this->load->view('institute/vid_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
/**************************************** Discipline*****************************************/  
    public function discipline() {
        if (user_role('30') == true) {}
        $data['title'] = display('program_discipline');
        $data['discipline_list'] = $this->Institute_model->disciplinelist();
        /*echo $this->db->last_query();
        print_r($data['institute_list']);*/
        $data['content'] = $this->load->view('institute/discipline_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function add_discipline() {
        $data['title'] = display('add_discipline');
        $data['discipline'] = '';       
        $this->form_validation->set_rules('discipline_name', display('program_discipline'), 'required');

        $data['discipline'] = (object) $postData = [
            'id' => $this->input->post('discipline_id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'discipline' => $this->input->post('discipline_name', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'create_date' => date('Y-m-d')
        ];
        
        if ($this->form_validation->run() === true) {
           // print_r($postData);exit;
            if (empty($this->input->post('discipline_id'))) {
                if (user_role('30') == true) {}
                if ($this->Institute_model->insertRowdisci($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('31') == true) {}
                if ($this->Institute_model->updateRowdisci($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/discipline');
        } else {
            $data['content'] = $this->load->view('institute/discipline_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    
    public function edit_discipline($id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_discipline');
        $data['discipline'] = $this->Institute_model->readRowdisci($id);  
        $data['content'] = $this->load->view('institute/discipline_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_discipline($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->Institute_model->deletediscipline($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/discipline');
    }
/**************************************** Discipline End*****************************************/

/**************************************** Level *****************************************/  
    public function level() {
        if (user_role('30') == true) {}
        $data['title'] = display('program_level');
        $data['level_list'] = $this->Institute_model->levellist();
        /*echo $this->db->last_query();
        print_r($data['institute_list']);*/
        $data['content'] = $this->load->view('institute/level_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function add_level() {
        $data['title'] = display('add_level');
        $data['level'] = '';       
        $this->form_validation->set_rules('level_name', display('program_level'), 'required');

        $data['level'] = (object) $postData = [
            'id' => $this->input->post('level_id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'level' => $this->input->post('level_name', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'create_date' => date('Y-m-d')
        ];
        
        if ($this->form_validation->run() === true) {
           // print_r($postData);exit;
            if (empty($this->input->post('level_id'))) {
                if (user_role('30') == true) {}
                if ($this->Institute_model->insertRowlvl($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('31') == true) {}
                if ($this->Institute_model->updateRowlvl($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/level');
        } else {
            $data['content'] = $this->load->view('institute/level_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    
    public function edit_level($id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_level');
        $data['level'] = $this->Institute_model->readRowlvl($id);  
        $data['content'] = $this->load->view('institute/level_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_level($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->Institute_model->deletelevel($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/level');
    }
/**************************************** Lavel End*****************************************/

/**************************************** Length *****************************************/ 
    public function length() {
        if (user_role('30') == true) {}
        $data['title'] = display('program_length');
        $data['length_list'] = $this->Institute_model->lengthlist();
        /*echo $this->db->last_query();
        print_r($data['institute_list']);*/
        $data['level'] = $this->Institute_model->levellist();
        $data['content'] = $this->load->view('institute/length_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function add_length() {
        $data['title'] = display('add_length');
        $data['level'] = '';       
        $this->form_validation->set_rules('length_name', display('program_length'), 'required');

        $data['length'] = (object) $postData = [
            'id' => $this->input->post('length_id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'level_id' => $this->input->post('level_id', true),
            'length' => $this->input->post('length_name', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d')
        ];
        
        if ($this->form_validation->run() === true) {
           // print_r($postData);exit;
            if (empty($this->input->post('length_id'))) {
                if (user_role('30') == true) {}
                if ($this->Institute_model->insertRowlgh($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('31') == true) {}
                if ($this->Institute_model->updateRowlgh($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/length');
        } else {
            $data['level'] = $this->Institute_model->levellist();
            $data['content'] = $this->load->view('institute/length_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    
    public function edit_length($id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_length');
        $data['length'] = $this->Institute_model->readRowlgh($id);
        $data['level'] = $this->Institute_model->levellist();       
        $data['content'] = $this->load->view('institute/length_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_length($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->Institute_model->deletelength($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/length');
    }
    
    public function select_length_lvl() {
        $diesc = $this->input->post('lead_stage');
        echo json_encode($this->location_model->all_length($diesc));

       // echo $diesc;
    }
/**************************************** Length End*****************************************/
    
    public function add_institute() {
        $data['title'] = display('add_institute');
        $data['institute'] = '';       
        $this->form_validation->set_rules('institute_name', display('institute_name'), 'required');
        $this->form_validation->set_rules('country_id', display('country_name'), 'required');
        if(!empty($_FILES['profile_image']['name'])){           
        $this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['profile_image']['name'];
                $_FILES['userfile']['type']= $_FILES['profile_image']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['profile_image']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['profile_image']['error'];
                $_FILES['userfile']['size']= $_FILES['profile_image']['size'];    
                
                $_FILES['userfile']['name'] = $image = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
                
                if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }
        }else{
            $image=$this->input->post('profile_images', true);
        }
    if(!empty($_FILES['agreement_doc']['name'])){
                $_FILES['userfile']['name']= $_FILES['agreement_doc']['name'];
                $_FILES['userfile']['type']= $_FILES['agreement_doc']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['agreement_doc']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['agreement_doc']['error'];
                $_FILES['userfile']['size']= $_FILES['agreement_doc']['size'];    
                
                $_FILES['userfile']['name'] = $image1 = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path1= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image1;
                                                 $ret1 = move_uploaded_file($_FILES['userfile']['tmp_name'],$path1);
                
                if($ret1)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path1);

                    if($rt == true)
                    {
                        unlink($path1); 
                    }
                }

        }else{
          $image1=$this->input->post('agreement_docs', true);  
        }
        $data['institute'] = (object) $postData = [
            'institute_id' => $this->input->post('institute_id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'institute_name' => $this->input->post('institute_name', true),
            'contact_name' => $this->input->post('contact_name', true),
            'contact_number' => $this->input->post('contact_number', true),
            'address' => $this->input->post('address', true),
            'country_id' => $this->input->post('country_id', true),
            'state_id' => $this->input->post('state_id', true),
            'profile_image' => $image,
            'agreement_comision' => $this->input->post('agreement_comision', true),
            'agreement_doc' => $image1,
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
                if (user_role('30') == true) {}
                if ($this->Institute_model->insertRow($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('31') == true) {}
                if ($this->Institute_model->updateRow($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/institutelist');
        } else {
            $data['country'] = $this->location_model->country();
            $data['content'] = $this->load->view('institute/institute_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
   
    public function edit_institute($institute_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_institute');
        $data['institute'] = $this->Institute_model->readRow($institute_id);  
        $data['country'] = $this->location_model->country();
        $data['content'] = $this->load->view('institute/institute_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_institute($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->Institute_model->deleteInstitute($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/institutelist');
    }
    
/*    public function datasourcelist() {
        if (user_role('20') == true) {}
        $data['title'] = display('datasource_list');
        $data['datasource_list'] = $this->Datasource_model->datasourcelist();
        $data['content'] = $this->load->view('datasource/datasource_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }*/
    
     public function datasourcelist() {
        if (user_role('30') == true) {}
        $data['title'] = display('datasource_list');
        $data['all_user'] = $this->User_model->all_user(); 
        $data['products'] = $this->dash_model->get_user_product_list();
        $data['datasource_list'] = $this->Datasource_model->datasourcelist2();
         $data['datasource_list2'] = $this->Datasource_model->datasourcelist();
        $data['content'] = $this->load->view('datasource/datasource_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
        /********************************************create CSV file*********************************/
public function createcsv($pd) {    
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="sample.csv"');
 
// do not cache the file
header('Pragma: no-cache');
header('Expires: 0');
 
// create a file pointer connected to the output stream
$file = fopen('php://output', 'w');

$input=array();
/*$this->db->select('*');
$this->db->from('tbl_input');
$this->db->or_where('process_id',$pd);
$this->db->or_where('company_id',$this->session->userdata('companey_id'));
$this->db->order_by('input_id', 'asc');
$q=$this->db->get()->result();
if(!empty($q)){
foreach($q as $value){
$daynamic[] = $value->input_label;  
}
$static=array('Company name', 'Name prefixed', 'First Name', 'Last Name', 'Mobile No', 'other_number', 'Email Address', 'state', 'city', 'address','process', 'source', 'datasource', 'Remarks','Services');
$allcoulmn=array_merge($static,$daynamic); 
// send the column headers
fputcsv($file, $allcoulmn); 
}else{*/
$static=array('Company name', 'Name prefixed', 'First Name', 'Last Name', 'Mobile No', 'other_number', 'Email Address', 'state', 'city', 'address','process', 'source', 'datasource', 'Remarks','Services');
fputcsv($file, $static);    
/*}*/
exit();
}
    /************************************************end CSV create********************************/
    
    public function add_datasource() {
        $data['title'] = display('add_datasource');     
        $this->form_validation->set_rules('datasource_name', display('datasource_name'), 'required');
        $data['datasource'] = (object) $postData = [
            'datasource_id' => $this->input->post('datasource_id', true),
            'datasource_name' => $this->input->post('datasource_name', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'comp_id' => $this->session->userdata('companey_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];
        
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('datasource_id'))) {
                if (user_role('30') == true) {}
                if ($this->Datasource_model->insertRow($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('31') == true) {}
                if ($this->Datasource_model->updateRow($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/datasourcelist');
        } else {
            $data['country'] = $this->location_model->productcountry();
            $data['content'] = $this->load->view('datasource/datasource_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
   
    public function edit_datasource($datasource_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_datasource');
        $data['datasource'] = $this->Datasource_model->readRow($datasource_id);  
        $data['country'] = $this->location_model->productcountry();
        $data['content'] = $this->load->view('datasource/datasource_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_datasource($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->Datasource_model->deleteDatasource($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/datasourcelist');
    }
   
    public function taskstatuslist() {
        if (user_role('30') == true) {}
        $data['title'] = display('taskstatus_list');
        $data['taskstatus_list'] = $this->Taskstatus_model->taskstatuslist();
        $data['content'] = $this->load->view('taskstatus/taskstatus_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function add_taskstatus() {
        $data['title'] = display('add_taskstatus');     
        $this->form_validation->set_rules('taskstatus_name', display('taskstatus_name'), 'required');
        $data['formdata'] = (object) $postData = [
            'taskstatus_id' => $this->input->post('taskstatus_id', true),
            'taskstatus_name' => $this->input->post('taskstatus_name', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'comp_id' => $this->session->userdata('companey_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];
        
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('taskstatus_id'))) {
                if (user_role('30') == true) {}
                if ($this->Taskstatus_model->insertRow($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('31') == true) {}
                if ($this->Taskstatus_model->updateRow($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/taskstatuslist');
        } else {
            $data['content'] = $this->load->view('taskstatus/taskstatus_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
   
    public function edit_taskstatus($taskstatus_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_taskstatus');
        $data['formdata'] = $this->Taskstatus_model->readRow($taskstatus_id);
        $data['content'] = $this->load->view('taskstatus/taskstatus_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_taskstatus($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->Taskstatus_model->deleteTaskstatus($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/taskstatuslist');
    }    
    
    public function centerlist() {
        if (user_role('30') == true) {}
        $data['title'] = display('center_list');
        $data['center_list'] = $this->Center_model->centerlist();
        $data['content'] = $this->load->view('center/center_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function add_center() {
        $data['title'] = display('add_center');
        $data['center'] = '';       
        $this->form_validation->set_rules('center_name', display('center_name'), 'required');
        $this->form_validation->set_rules('country_id', display('country_name'), 'required');
        $data['center'] = (object) $postData = [
            'center_id' => $this->input->post('center_id', true),
            'comp_id' => $this->session->companey_id,
            'center_name' => $this->input->post('center_name', true),
            'contact_name' => $this->input->post('contact_name', true),
            'contact_number' => $this->input->post('contact_number', true),
            'address' => $this->input->post('address', true),
            'country_id' => $this->input->post('country_id', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];
        
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('center_id'))) {
                if (user_role('30') == true) {}
                if ($this->Center_model->insertRow($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('31') == true) {}
                if ($this->Center_model->updateRow($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/centerlist');
        } else {
            $data['country'] = $this->location_model->country();            
            $data['content'] = $this->load->view('center/center_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
   
    public function edit_center($center_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_center');
        $data['center'] = $this->Center_model->readRow($center_id);  
        $data['country'] = $this->location_model->country();            
        $data['content'] = $this->load->view('center/center_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_center($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->Center_model->deleteCenter($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/centerlist');
    }
    
    public function subsourcelist() {
        if (user_role('30') == true) {}
        $data['title'] = display('subsource_list');
        $data['subsource_list'] = $this->SubSource_model->subsourcelist();
        $data['content'] = $this->load->view('subsource/subsource_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function get_subsource_by_source(){

        $id = $this->input->post('src_id');
        $subid = $this->input->post('sub_src_id');

        $res = $this->SubSource_model->get_subsource($id);

     $opt = "<option>---Select Subsource---</option>";
     foreach($res as $result)
     {
            if($subid == $result['subsource_id']){
             
             $opt .= "<option value='".$result['subsource_id']."' selected>".ucwords($result['subsource_name']) . "</option>";

            }
            else{
            $opt .= "<option value='".$result['subsource_id']."'>".ucwords($result['subsource_name']) . "</option>";
        }
     }

     echo $opt;
    }
    public function description() {
        if (user_role('30') == true) {}
        $data['title'] = display('Description_list');
        $data['description_list'] = $this->SubSource_model->descriptionlist();
        $data['content'] = $this->load->view('lead_description', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function add_subsource() {
        $data['title'] = display('add_subsource');
        $data['subsource'] = '';       
        $this->form_validation->set_rules('subsource_name', display('subsource_name'), 'required');
        $this->form_validation->set_rules('lead_source_id', display('lead_source'), 'required');
        $data['subsource'] = (object) $postData = [
            'subsource_id' => $this->input->post('subsource_id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'subsource_name' => $this->input->post('subsource_name', true),
            'lead_source_id' => $this->input->post('lead_source_id', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];        
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('subsource_id'))) {
                if(user_role('30') == true) {}
                if($this->SubSource_model->insertRow($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if(user_role('31') == true) {}
                if($this->SubSource_model->updateRow($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/subsourcelist');
        } else {
            $data['lead_source_list'] = $this->SubSource_model->all_lead_source();
            $data['content'] = $this->load->view('subsource/subsource_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    
    
    public function add_description()
    {
        $data['title'] = display('add_description');
        $data['description'] = '';
        $this->form_validation->set_rules('description_name', display('description_name'), 'required');
        $this->form_validation->set_rules('lead_stage_id[]', display('lead_stage_id'), 'required');
        $stage_list = '';
        if($_POST)
        {
            $stage_list = implode(',', $this->input->post('lead_stage_id', true));
        }
        $data['description'] = (object) $postData = [
            'id' => $this->input->post('description_id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'lead_stage_id' => $stage_list,
            'description' => $this->input->post('description_name', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];
        //print_r($postData);exit;
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('description_id'))) {
                if (user_role('30') == true) {
                }
                if ($this->SubSource_model->insertRowdeis($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            } else {
                if (user_role('30') == true) {
                }
                if ($this->SubSource_model->updateRowdes($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/description');
        } else {
            $data['lead_description_list'] = $this->SubSource_model->all_stage_list();
            $data['content'] = $this->load->view('description_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }

    public function get_process_bystage(){

        $id = $this->input->post('id');

        $this->db->select('tbl_product.product_name');
        $this->db->from('tbl_product');
        $this->db->join('lead_stage','tbl_product.sb_id=lead_stage.process_id');

        $this->db->where('lead_stage.stg_id',$id);
        $this->db->where('lead_stage.comp_id',$this->session->companey_id);

        $res = $this->db->get()->row();

        // print_r($res);exit();

        echo json_encode($res);

    }
   
    public function edit_subsource($subsource_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_subsource');
        $data['subsource'] = $this->SubSource_model->readRow($subsource_id);  
        $data['lead_source_list'] = $this->SubSource_model->all_lead_source();
        $data['content'] = $this->load->view('subsource/subsource_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function edit_discription($description_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_deiscription');
        $data['description'] = $this->SubSource_model->readRowdes($description_id);  
        $data['lead_description_list'] = $this->SubSource_model->all_stage_des();
        $data['content'] = $this->load->view('description_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_subsource($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->SubSource_model->deleteSubsource($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/subsourcelist');
    }
    
    public function delete_description($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->SubSource_model->delete_description($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/description');
    }
    
    public function addnewkyc(){
        $postData = $this->input->post();
        if(!empty($postData)){
        $doc_file = $this->fileupload->do_upload(
                'assets/kyc/', 'doc_file'
        );
        $unique_number = $this->input->post('unique_number', true);
        $enquiry_id = $this->input->post('kyc_enquiry_id', true);
        $postData = [
            'unique_number' => $unique_number,
            'doc_name' => $this->input->post('doc_name', true),
            'doc_number' => $this->input->post('doc_number', true),
            'doc_validity' => $this->input->post('doc_validity', true),
            'doc_file' => $doc_file,
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];        
        if (user_role('20') == true) {}
        if ($this->Kyc_model->insertRow($postData)) {
            $this->session->set_flashdata('message', 'KYC document added successfully');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/lead_details/' . $enquiry_id.'#kyctab');
    }else{
       $this->session->set_flashdata('exception', display('please_try_again')); 
    }
    redirect($this->agent->referrer());
    }
    
    
    public function addnewwork(){
        $postData = $this->input->post();
        if(!empty($postData)){
        $unique_number = $this->input->post('work_unique_number', true);
        $enquiry_id = $this->input->post('work_enquiry_id', true);
        $postData = [
            'unique_number' => $unique_number,
            'company' => $this->input->post('company', true),
            'designation' => $this->input->post('designation', true),
            'start_date' => $this->input->post('start_date', true),
            'end_date' => $this->input->post('end_date', true),
            'current_ctc' => $this->input->post('current_ctc', true),
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];        
        if (user_role('20') == true) {}
        if ($this->Workhistory_model->insertRow($postData)) {
            $this->session->set_flashdata('message', 'Work history added successfully');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/lead_details/' . $enquiry_id);
    }else{
       $this->session->set_flashdata('exception', display('please_try_again')); 
    }
    redirect($this->agent->referrer());
    }   
    
    public function addnewedu(){
        $postData = $this->input->post();
        if(!empty($postData)){
        $unique_number = $this->input->post('edu_unique_number', true);
        $enquiry_id = $this->input->post('edu_enquiry_id', true);
        $postData = [
            'unique_number' => $unique_number,
            'title' => $this->input->post('title', true),
            'university' => $this->input->post('university', true),
            'passing_year' => $this->input->post('passing_year', true),
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];        
        if (user_role('20') == true) {}
        if ($this->Education_model->insertRow($postData)) {
            $this->session->set_flashdata('message', 'Education added successfully');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect($this->agent->referrer());
    }else{
       $this->session->set_flashdata('exception', display('please_try_again')); 
    }
    redirect($this->agent->referrer());
    }
    
    public function addnewsprof(){
        $postData = $this->input->post();
        if(!empty($postData)){
        $unique_number = $this->input->post('sprof_unique_number', true);
        $enquiry_id = $this->input->post('sprof_enquiry_id', true);
        $postData = [
            'unique_number' => $unique_number,
            'title' => $this->input->post('title', true),
            'profile' => $this->input->post('profile', true),
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];        
        if (user_role('20') == true) {}
        if ($this->SocialProfile_model->insertRow($postData)) {
            $this->session->set_flashdata('message', 'Social profile added successfully');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect($this->agent->referrer());
    }else{
       $this->session->set_flashdata('exception', display('please_try_again')); 
    }
    redirect($this->agent->referrer());
    }
    
    public function addnewtravel(){
        $postData = $this->input->post();
        if(!empty($postData)){
        $unique_number = $this->input->post('travel_unique_number', true);
        $enquiry_id = $this->input->post('travel_enquiry_id', true);
        $postData = [
            'unique_number' => $unique_number,
            'country_id' => $this->input->post('country_id', true),
            'travel_date' => $this->input->post('travel_date', true),
            'visa_type' => $this->input->post('visa_type', true),
            'dfrom_date' => $this->input->post('dfrom_date', true),
            'dto_date' => $this->input->post('dto_date', true),
            'is_rejected' => $this->input->post('is_rejected', true),
            'reject_reason' => $this->input->post('reject_reason', true),            
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d'),
            'status'=>1
        ];        
        if (user_role('20') == true) {}
        if ($this->Travelhistory_model->insertRow($postData)) {
            $this->session->set_flashdata('message', 'Travel history added successfully');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect($this->agent->referrer());
    }else{
       $this->session->set_flashdata('exception', display('please_try_again')); 
    }
    redirect($this->agent->referrer());
    }

    public function addnewmember(){
        $postData = $this->input->post();
        if(!empty($postData)){
        $unique_number = $this->input->post('mem_unique_number', true);
        $enquiry_id = $this->input->post('mem_enquiry_id', true);
        $postData = [
            'unique_number' => $unique_number,
            'name' => $this->input->post('name', true),
            'contact_number' => $this->input->post('contact_number', true),
            'contact_email' => $this->input->post('contact_email', true),
            'country_id' => $this->input->post('country_id', true),
            'relationship' => $this->input->post('relationship', true),
            'visa_status' => $this->input->post('visa_status', true),
            'they_help' => $this->input->post('they_help', true),           
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d'),
            'status'=>1
        ];        
        if (user_role('20') == true) {}
        if ($this->Closefemily_model->insertRow($postData)) {
            $this->session->set_flashdata('message', 'Member added successfully');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect($this->agent->referrer());
    }else{
       $this->session->set_flashdata('exception', display('please_try_again')); 
    }
    redirect($this->agent->referrer());
    }
    
   /******************************************notification start***********************************************/
    function alertList() 
                    {    
                         $this->db->select('*'); 
                         $this->db->where('create_by',$this->session->user_id);
                         $this->db->where('status','0');
                         $alertData= $this->db->get('query_response')->result();
                         
                         if(!empty($alertData)){
$myalertdate = array();
$myalertmsg = array();
if(!empty($alertData)){
    foreach($alertData as $alert){
        $myalertdate[] = $alert->task_date;
        $myalerttime = $alert->task_time;
        $myalertmsg[] = $alert->task_remark;
        $myalertperson = $alert->contact_person;
        $myalertmobile = $alert->mobile;
        $myalertid = $alert->resp_id;
    }
}
$ttt=explode(' ',$myalerttime);
 $t=$ttt[0];
$date = date('d-m-Y H:i:s'); 
$d=explode(' ',$date);
$dd=$d[0];
 $tt=$d[1];
}
      
      if((!empty($alertData)) && in_array($dd,$myalertdate) && (strtotime($tt) == strtotime($t))){ 
          $status= 1;
          $popup='
<h4 style="color:red;">'.$myalertperson.'</h4>
<h5 style="color:red;">'.$myalertmobile.'</h5>
                <p style="color:#000;">'.$alert->task_remark.'</p>
                </div>
            ';
           $status_id='<span  onclick="hide('.$myalertid.')"  style="height:0px;width:0px;float:right;margin-top:-30px;"><i class="fa fa-times-circle-o" aria-hidden="true" style="height:20px;width:20px;color:red;margin-left:-5px;"></i>
</span>';
            echo json_encode(array('status1'=>$status,'status_data'=>$popup,'status_id'=>$status_id));
      }else{echo 0;}
                    }
public function alertstatus() {
        $this->db->set('status', 1);
        $this->db->where('resp_id', $this->uri->segment(3));
        $this->db->update('query_response');
    }
   /*********************************************notification end*****************************************************/

   function lead_search() // route created for this function
   {
       
        $global_search    =   get_sys_parameter('master_search_global','COMPANY_SETTING'); // get master search setting
        $comp_id = $this->session->companey_id;
        $filter = (!empty($_GET["search"])) ? trim($_GET["search"]) : ""; 
        
        if(!empty($filter)){
            
            $qpart = " (enq.Enquery_id LIKE '%{$filter}%' OR enq.email LIKE '%{$filter}%' OR enq.phone LIKE '%{$filter}%' OR enq.name LIKE '%{$filter}%' OR enq.lastname LIKE '%{$filter}%' OR usr.s_display_name LiKE '%{$filter}%' OR usr.last_name LiKE '%{$filter}%' OR asgn.s_display_name LiKE '%{$filter}%' OR asgn.last_name LiKE '%{$filter}%') AND";
        }else{
            $qpart = "";
        }
        
        $retuser   = $this->common_model-> get_categories($this->session->user_id);
        $impuser   = implode("," , $retuser);
        
        $qry    = "SELECT  enq.*, concat(usr.s_display_name,' ' , usr.last_name) as username,  concat(asgn.s_display_name,' ' , asgn.last_name) as asignuser  FROM enquiry enq
                                            LEFT JOIN tbl_admin usr ON usr.pk_i_admin_id = enq.created_by 
                                            LEFT JOIN tbl_admin asgn ON asgn.pk_i_admin_id = enq.aasign_to 
                                            WHERE $qpart  ";   
        if($global_search){
            $qry .= "enq.comp_id=$comp_id";
        }else{
            $qry .= "(enq.created_by  IN ($impuser) OR enq.aasign_to  IN ($impuser))";
        }
        $data["result"] = $this->db->query($qry)->result();
        
        $data["filter"]  = $filter; 
        $data['title']   = "Lead Search";
        $data['content'] = $this->load->view('lead_search', $data, true);
        $this->load->view('layout/main_wrapper', $data);
   }
   function get_number_details()
   {
    $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
    $number = $this->input->post("number");
    $company_id = $this->session->companey_id;
    $where='';
    $this->db->select("enquiry.name_prefix,enquiry.enquiry_id,enquiry.company,enquiry.created_by,enquiry.drop_status,enquiry.status,enquiry.aasign_to,enquiry.name,enquiry.lastname,enquiry.email,enquiry.phone,enquiry.address,DATE_FORMAT(enquiry.created_date,'%d-%m-%Y') as created_date,enquiry.enquiry_source,lead_source.icon_url,lead_source.lsid,lead_source.score_count,lead_source.lead_name,tbl_datasource.datasource_name,tbl_product.product_name as product_name,tbl_admin.s_display_name as member_name,tbl_admin.last_name as lname,t2.s_display_name as assign_to_name,t2.last_name as assign_lname");
    $this->db->from("enquiry");
    $this->db->join('tbl_product','enquiry.product_id = tbl_product.sb_id','left');
    $this->db->join('lead_source','enquiry.enquiry_source = lead_source.lsid','left');
    $this->db->join('tbl_datasource','enquiry.datasource_id = tbl_datasource.datasource_id','left');
    $this->db->join('tbl_admin','enquiry.created_by=tbl_admin.pk_i_admin_id','left');
    $this->db->join('tbl_admin t2','enquiry.aasign_to=t2.pk_i_admin_id','left');
    $where.="enquiry.phone=".$number;
    $where .= " AND  enquiry.created_by IN (".implode(',', $all_reporting_ids).")";
    $this->db->where($where);
    $result = $this->db->get()->result();
    // echo $this->db->last_query();exit;
    echo json_encode($result);
   }

   
    //Switch box master....
    public function product_list(){
        $data['title'] = 'Process';
        $data['nav1']='nav1';
        $data['get_users']=$this->dash_model->area_list();
        $data['product_list']=$this->dash_model->all_process_list();
        
        $data['content'] =$this->load->view('product-list', $data,true);
            $this->load->view('layout/main_wrapper',$data);
        
    }
   //Master setup for Customer type or channel partner..
    public function load_customer_channel_mater() {
        $data['page_title'] = 'Customer type';
        $data['nav1'] = 'nav2';
        $data['customer_types'] = $this->enquiry_model->customers_types();
        $data['name_prefix'] = $this->enquiry_model->name_prefix_list();
        $data['content'] = $this->load->view('master_enquiry_type', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function select_state_by_city() {
        $city=$this->input->post('city_id');
        echo json_encode($this->Leads_Model->all_csc($city));
    }

    public function get_lead_stage(){

     $id=$this->input->post('id');
     
     $res = $this->Leads_Model->get_leadstage_name($id);
     $opt = "<option>---Select Stage---</option>";
     foreach($res as $result)
     {
            $opt .= "<option value='".$result['stg_id']."'>".ucwords($result['lead_stage_name']) . "</option>";
     }

     echo $opt;
     // exit();

    }
    
    public function add_course() {
        $data['title'] = display('add_course');
        $data['institute'] = '';       
        $this->form_validation->set_rules('course_name', display('Course_name'), 'required');
        $this->form_validation->set_rules('institute_id', display('institute_name'), 'required');
        if(!empty($_FILES['course_image']['name'])){            
        $this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['course_image']['name'];
                $_FILES['userfile']['type']= $_FILES['course_image']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['course_image']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['course_image']['error'];
                $_FILES['userfile']['size']= $_FILES['course_image']['size'];    
                
                $_FILES['userfile']['name'] = $image = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
                
                if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }
        }else{
            $image=$this->input->post('course_images', true);
        }
        $data['course'] = (object) $postData = [
            'crs_id' => $this->input->post('crs_id', true),
            'institute_id' => $this->input->post('institute_id', true),
            'course_name' => $this->input->post('course_name', true),
            'course_ielts' => $this->input->post('course_ielts', true),
            'course_image' => $image,
            'course_rating' => $this->input->post('course_rating', true),
            'course_discription' => $this->input->post('course_discription', true),
            'tuition_fees' => $this->input->post('tuition_fees', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'discipline_id' => $this->input->post('discipline', true),
            'level_id' => $this->input->post('level', true),
            'length_id' => $this->input->post('length', true),
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'status' => $this->input->post('status', true),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];
        //print_r($postData);exit;
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('crs_id'))) { 
                if (user_role('30') == true) {}
                if ($this->Institute_model->insertRowcrs($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('31') == true) {}
                if ($this->Institute_model->updateRowcrs($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/courselist');
        } else {
            $data['courses'] = $this->Institute_model->findcourse();
            $data['institute'] = $this->Institute_model->findinstitute();
            $data['discipline'] = $this->location_model->find_discipline();
            $data['level'] = $this->location_model->find_level();
            $data['length'] = $this->location_model->find_length();
            $data['content'] = $this->load->view('institute/course_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    
    public function add_crs() {
        $data['title'] = display('add_course');
        $data['institute'] = '';       
        $this->form_validation->set_rules('course_name', display('Course_name'), 'required');

        $data['crs'] = (object) $postData = [
            'id' => $this->input->post('crs_id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'course_name' => $this->input->post('course_name', true),
            'created_by' => $this->session->userdata('user_id'),
            'status' => $this->input->post('status', true),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d')
        ];
        //print_r($postData);exit;
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('crs_id'))) {
                if (user_role('30') == true) {}
                if ($this->Institute_model->insertcrs($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('31') == true) {}
                if ($this->Institute_model->updatecrs($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/crslist');
        } else {            
            $data['content'] = $this->load->view('institute/crs_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    
    public function add_sub_crs() {
        $data['title'] = display('add_sub_crs');
        $data['institute'] = '';       
        $this->form_validation->set_rules('sub_course', display('Sub Course'), 'required');

        $data['subcrs'] = (object) $postData = [
            'id' => $this->input->post('sub_crs_id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'sub_course' => $this->input->post('sub_course', true),
            'course_name' => $this->input->post('course_name', true),
            'created_by' => $this->session->userdata('user_id'),
            'status' => $this->input->post('status', true),
            'created_date' => date('Y-m-d')
        ];
        //print_r($postData);exit;
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('sub_crs_id'))) {
                if (user_role('30') == true) {}
                if ($this->Institute_model->insertsubcrs($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('31') == true) {}
                if ($this->Institute_model->updatesubcrs($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/sub_course');
        } else {
            $data['cource'] = $this->Institute_model->crsmstrlist();            
            $data['content'] = $this->load->view('institute/sub_crs_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    
    public function add_video() {
        $data['title'] = display('add_course');
        $data['institute'] = '';       
        $this->form_validation->set_rules('title_name', 'Title Name', 'required');
        $this->form_validation->set_rules('link_name', 'Link Name', 'required');
        $this->form_validation->set_rules('discription_name', 'Description', 'required');

        $data['vid'] = (object) $postData = [
            'id' => $this->input->post('vid_id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'title' => $this->input->post('title_name', true),
            'link' => $this->input->post('link_name', true),
            'des' => $this->input->post('discription_name', true),
            'meta_key' => $this->input->post('key_name', true),
            'created_by' => $this->session->userdata('user_id'),
            'status' => $this->input->post('status', true),
            'created_date' => date('Y-m-d')
        ];
        //print_r($postData);exit;
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('vid_id'))) {
                if (user_role('30') == true) {}
                if ($this->Institute_model->insertvid($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('31') == true) {}
                if ($this->Institute_model->updatevid($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('lead/vidlist');
        } else {
            $data['title'] = display('add_vid');
            $data['content'] = $this->load->view('institute/vid_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    
    public function edit_course($crs_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_course');
        $data['courses'] = $this->Institute_model->findcourse();
        $data['discipline'] = $this->location_model->find_discipline();
        $data['level'] = $this->location_model->find_level();
        $data['length'] = $this->location_model->find_length();
        $data['course'] = $this->Institute_model->readRowcrs($crs_id);  
        $data['institute'] = $this->Institute_model->findinstitute();
        $data['content'] = $this->load->view('institute/course_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function edit_crs($crs_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_course');
        $data['crs'] = $this->Institute_model->readcrs($crs_id);  
        $data['content'] = $this->load->view('institute/crs_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function edit_sub_crs($crs_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_Sub_course');
        $data['subcrs'] = $this->Institute_model->readsubcrs($crs_id);
        $data['cource'] = $this->Institute_model->crsmstrlist();        
        $data['content'] = $this->load->view('institute/sub_crs_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function edit_vid($vid_id = null) {
        if (user_role('31') == true) {}
        $data['title'] = display('update_vedio');
        $data['vid'] = $this->Institute_model->readvid($vid_id);  
        $data['content'] = $this->load->view('institute/vid_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_course($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->Institute_model->deletecourse($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/courselist');
    }
    
    public function delete_crs($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->Institute_model->deletecrs($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/crslist');
    }
    
    public function delete_sub_crs($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->Institute_model->deletesubcrs($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/sub_course');
    }
    
    public function delete_vid($paramId = null) {
        if (user_role('32') == true) {}
        if ($this->Institute_model->deletevid($paramId)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/vidlist');
    }

    ///////////////// Department SECTION START////////////////////
    public function department() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $dept_name = $this->input->post('dept_name');

            $data = array(
                'dept_name'   => $dept_name,
                'comp_id' => $this->session->userdata('companey_id'),
                'created_by' => $this->session->userdata('user_id'),
                'status' => '1'
            );

            $insert_id = $this->Leads_Model->dept_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Department Add Successfully');
            redirect('lead/department');
        }


        $data['all_department'] = $this->Leads_Model->dept_select();
        $data['title'] = 'Department master';
        $data['content'] = $this->load->view('setting/department_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function update_dept() {
        if (!empty($_POST)) {
            $dept_name = $this->input->post('dept_name');
            $dept_id = $this->input->post('dept_id');            
            $this->db->set('dept_name', $dept_name);
            $this->db->where('id', $dept_id);
            $this->db->update('tbl_department');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/department');
        }
    }

    public function delete_department($dept_id = null) {
        if ($this->Leads_Model->delete_dept($dept_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/department');
    }

    ///////////////// Department SECTION END////////////////////

     ///////////////// Branch SECTION START////////////////////
    public function branch() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $branch_name = $this->input->post('branch_name');

            $data = array(
                'b_name'   => $branch_name,
                'comp_id' => $this->session->userdata('companey_id'),
                'created_by' => $this->session->userdata('user_id'),
                'status' => '1'
            );

            $insert_id = $this->Leads_Model->branch_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Branch Add Successfully');
            redirect('lead/branch');
        }


        $data['all_branch'] = $this->Leads_Model->branch_select();
        $data['title'] = 'Branch master';
        $data['content'] = $this->load->view('setting/branch_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function update_branch() {
        if (!empty($_POST)) {
            $branch_name = $this->input->post('branch_name');
            $branch_id = $this->input->post('branch_id');            
            $this->db->set('b_name', $branch_name);
            $this->db->where('id', $branch_id);
            $this->db->update('tbl_branch');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/branch');
        }
    }

    public function delete_branch($branch_id = null) {
        if ($this->Leads_Model->delete_brnh($branch_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/branch');
    }

    ///////////////// Branch SECTION END////////////////////

     ///////////////// Branch master SECTION START////////////////////
    public function branch_master() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $branch_name = $this->input->post('branch_name');
            $branch_dept = $this->input->post('branch_dept');
            $assign_employee = $this->input->post('assign_employee');
            
            if (!empty($branch_name)) {
                $branch_name    =   implode(',', $branch_name);
            }

            $data = array(
                'branch_name'   => $branch_name,
                'branch_dept'   => $branch_dept,
                'assign_employee'   => $assign_employee,
                'comp_id' => $this->session->userdata('companey_id'),
                'created_by' => $this->session->userdata('user_id'),
                'status' => '1'
            );

            $insert_id = $this->Leads_Model->branch_master_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Branch Add Successfully');
            redirect('lead/branch_master');
        }


        $data['all_branch_master'] = $this->Leads_Model->branch_master_select();
        $data['all_branch'] = $this->Leads_Model->branch_select();
        $data['all_department'] = $this->Leads_Model->dept_select();
        $data['user_list'] = $this->User_model->read2();
        $data['title'] = 'Branch master Mapping';
        $data['content'] = $this->load->view('setting/branch_master_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function update_branch_master() {
        if (!empty($_POST)) {
            $branch_name = $this->input->post('branch_name');
            $branch_dept = $this->input->post('branch_dept');
            $assign_employee = $this->input->post('assign_employee');
            $branch_master_id = $this->input->post('branch_master_id'); 
            if (!empty($branch_name)) {
                $branch_name    =   implode(',', $branch_name);
            }           
            $this->db->set('branch_name', $branch_name);
            $this->db->set('branch_dept', $branch_dept);
            $this->db->set('assign_employee', $assign_employee);
            $this->db->where('id', $branch_master_id);
            $this->db->update('tbl_branch_master');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/branch_master');
        }
    }

    public function delete_branch_master($branch_id = null) {
        if ($this->Leads_Model->delete_branch($branch_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/branch_master');
    }

    ///////////////// Branch master SECTION END////////////////////

    ///////////////// URL SECTION START////////////////////
    public function url() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {
            
            $url_name = $this->input->post('url_name');
            $url_counrty = $this->input->post('url_counrty');
            $url_link = $this->input->post('url_link');

            $data = array(
                'url_name'   => $url_name,
                'url_counrty'   => $url_counrty,
                'url_link'   => $url_link,
                'comp_id' => $this->session->userdata('companey_id'),
                'created_by' => $this->session->userdata('user_id'),
                'status' => '1'
            );

            $insert_id = $this->Leads_Model->url_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Url Add Successfully');
            redirect('lead/url');
        }


        $data['all_url'] = $this->Leads_Model->url_select();
        $data['country'] = $this->location_model->country();
        $data['title'] = 'Urls';
        $data['content'] = $this->load->view('setting/url_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function update_url() {
        if (!empty($_POST)) {
            $url_name = $this->input->post('url_name');
            $url_counrty = $this->input->post('url_counrty');
            $url_link = $this->input->post('url_link');
            $url_id = $this->input->post('url_id'); 
            $this->db->set('url_name', $url_name);           
            $this->db->set('url_counrty', $url_counrty);
            $this->db->set('url_link', $url_link);
            $this->db->where('id', $url_id);
            $this->db->update('tbl_url');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/url');
        }
    }

    public function delete_url($url_id = null) {
        if ($this->Leads_Model->delete_url($url_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/url');
    }

    ///////////////// URL SECTION END////////////////////

// Ticket Subject master Start
    public function ticket_subjects() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {
            
            $ticket_subjects_name = $this->input->post('ticket_subjects_name');

            $data = array(
                'subject_title'   => $ticket_subjects_name,
                'comp_id' => $this->session->userdata('companey_id'),
                'created_by' => $this->session->userdata('user_id'),
                'status' => '1'
            );

            $insert_id = $this->Leads_Model->ticket_subject_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Ticket Subjects Add Successfully');
            redirect('lead/ticket_subjects');
        }


        $data['all_subject'] = $this->Leads_Model->ticket_subject_select();
        $data['title'] = 'Ticket Subjects';
        $data['content'] = $this->load->view('setting/ticket_subjects', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function update_ticket_subjects() {
        if (!empty($_POST)) {
            $ticket_subjects_name = $this->input->post('ticket_subjects_name');
            $ticket_subject_id = $this->input->post('ticket_subject_id');

            $this->db->set('subject_title', $ticket_subjects_name);
            $this->db->where('id', $ticket_subject_id);
            $this->db->update('tbl_ticket_subject');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/ticket_subjects');
        }
    }

    public function delete_ticket_subjects($ticket_subject_id = null) {
        if ($this->Leads_Model->delete_ticket_subject($ticket_subject_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/ticket_subjects');
    }
// Ticket Subject master End
    
    ///////////////// FAQ SECTION START////////////////////
    public function faq() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $faq_title = $this->input->post('faq_title');
            $faq_dscptn = $this->input->post('faq_dscptn');

            $data = array(
                'que_type'   => $faq_title,
                'answer'   => $faq_dscptn,
                'comp_id' => $this->session->userdata('companey_id'),
                'created_by' => $this->session->userdata('user_id'),
                'status' => '1'
            );

            $insert_id = $this->Leads_Model->faq_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Lead Stage Add Successfully');
            redirect('lead/faq');
        }


        $data['all_faq'] = $this->Leads_Model->faq_select();
        $data['title'] = 'FAQ';
        $data['content'] = $this->load->view('faq/faq_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function delete_faq($faq_id = null) {
        if ($this->Leads_Model->delete_faq($faq_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('lead/faq');
    }

    public function update_faq() {
        if (!empty($_POST)) {
            $faq_title = $this->input->post('faq_title');
            $faq_dscptn = $this->input->post('faq_dscptn');
            $faq_id = $this->input->post('faq_id');            
            $this->db->set('que_type', $faq_title);
            $this->db->set('answer', $faq_dscptn);
            $this->db->where('id', $faq_id);
            $this->db->update('tbl_faq');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('lead/faq');
        }
    }   
    ///////////////// FAQ SECTION END////////////////////
    
///////////////// Agreement template SECTION START////////////////////
    public function agreement_template() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $template_name = $this->input->post('template_name');
            $template_content = $this->input->post('template_content');

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'template_name'   => $template_name,
                'template_content' => $template_content,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->agreement_template_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Agreement Template Add Successfully');
            redirect('lead/agreement_template');
        }


        $data['all_template'] = $this->Leads_Model->agrtemp_select();
        $data['title'] = 'Create Template';
        $data['content'] = $this->load->view('agreement/agreement_template', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function template_details_update()
    {  
    if(!empty($_POST)){
    $tmpid = $this->input->post('template_id');
    $template_name = $this->input->post('template_name');
    $template_content = $this->input->post('template_content');
    $this->db->set('template_name',$template_name);
    $this->db->set('template_content',$template_content);
    $this->db->where('id',$tmpid);
    $this->db->update('tbl_agreement_template');
    redirect('lead/agreement_template');
    }
    $data['content'] = $this->load->view('agreement/agreement_template', $data, true);
    $this->load->view('layout/main_wrapper', $data);
    }

public function delete_template(){
        if(!empty($_POST)){
        $user_status=$this->input->post('sel_temp');
        foreach($user_status as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_agreement_template');
        }
        }
        }

public function select_content_by_id() {
        $content = $this->input->post('content_id');
        $data['content']=$this->Leads_Model->all_content($content);
        $this->load->view('agreement/summernote', $data);
    }       
    ///////////////// Agreement template SECTION END////////////////////

    ///////////////// install SECTION START////////////////////
    public function create_installment() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $installment_name = $this->input->post('installment_name');

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'install_name'   => $installment_name,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->installment_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Installment Add Successfully');
            redirect('lead/create_installment');
        }


        $data['all_installment'] = $this->Leads_Model->installment_select();
        $data['title'] = 'Create Installment';
        $data['content'] = $this->load->view('payment/installment', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function installment_update()
    {  
    if(!empty($_POST)){
    $ins_id = $this->input->post('install_id');
    $installment_name = $this->input->post('installment_name');
    $this->db->set('install_name',$installment_name);
    $this->db->where('id',$ins_id);
    $this->db->update('tbl_installment_master');
    redirect('lead/create_installment');
    }
    $data['content'] = $this->load->view('payment/installment', $data, true);
    $this->load->view('layout/main_wrapper', $data);
    }

public function delete_installment(){
        if(!empty($_POST)){
        $user_status=$this->input->post('sel_temp');
        foreach($user_status as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_installment_master');
        }
        }
        }   
    ///////////////// Install SECTION END////////////////////


///////////////// GST Master SECTION START////////////////////
    public function create_gst() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $gst_name = $this->input->post('gst_name');
            $gst_value = $this->input->post('gst_value');

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'gst_name'   => $gst_name,
                'gst_value'   => $gst_value,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->gst_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Gst Add Successfully');
            redirect('lead/create_gst');
        }


        $data['all_gst'] = $this->Leads_Model->gst_select();
        $data['title'] = 'Create Gst';
        $data['content'] = $this->load->view('payment/gst', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function gst_update()
    {  
    if(!empty($_POST)){
    $gst_id = $this->input->post('gst_id');
    $gst_name = $this->input->post('gst_name');
    $gst_value = $this->input->post('gst_value');
    $this->db->set('gst_name',$gst_name);
    $this->db->set('gst_value',$gst_value);
    $this->db->where('id',$gst_id);
    $this->db->update('tbl_gst');
    redirect('lead/create_gst');
    }
    $data['content'] = $this->load->view('payment/gst', $data, true);
    $this->load->view('layout/main_wrapper', $data);
    }

public function delete_gst(){
        if(!empty($_POST)){
        $user_status=$this->input->post('sel_temp');
        foreach($user_status as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_gst');
        }
        }
        }   
    ///////////////// GST Master SECTION END////////////////////


    ///////////////// Language test SECTION START////////////////////
    public function create_test_language() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $test_language_name = $this->input->post('test_language_name');

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'test_language_name'   => $test_language_name,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->test_language_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Language Tast Add Successfully');
            redirect('lead/create_test_language');
        }


        $data['all_test'] = $this->Leads_Model->test_language_select();
        $data['title'] = 'Create Test Language';
        $data['content'] = $this->load->view('language_test', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function language_test_update()
    {  
    if(!empty($_POST)){
    $test_id = $this->input->post('test_id');
    $test_language_name = $this->input->post('test_language_name');
    $this->db->set('test_language_name',$test_language_name);
    $this->db->where('id',$test_id);
    $this->db->update('tbl_test_master');
    redirect('lead/create_test_language');
    }
    $data['content'] = $this->load->view('language_test', $data, true);
    $this->load->view('layout/main_wrapper', $data);
    }

    public function delete_language_test(){
        if(!empty($_POST)){
        $user_status=$this->input->post('sel_temp');
        foreach($user_status as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_test_master');
        }
        }
        }

///////////////// Language test SECTION END////////////////////

///////////////// visa type  SECTION START////////////////////
    public function create_visa_type() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $visa_type = $this->input->post('visa_type');

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'visa_type'   => $visa_type,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->visa_type_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Visa Type Add Successfully');
            redirect('lead/create_visa_type');
        }


        $data['visa_type'] = $this->Leads_Model->visa_type_select();
        $data['title'] = 'Create Visa Type';
        $data['content'] = $this->load->view('visa_type', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function visa_type_update()
    {  
    if(!empty($_POST)){
    $test_id = $this->input->post('test_id');
    $visa_type = $this->input->post('visa_type');
    $this->db->set('visa_type',$visa_type);
    $this->db->where('id',$test_id);
    $this->db->update('tbl_visa_type');
    redirect('lead/create_visa_type');
    }
    $data['content'] = $this->load->view('visa_type', $data, true);
    $this->load->view('layout/main_wrapper', $data);
    }

    public function delete_visa_type(){
        if(!empty($_POST)){
        $user_status=$this->input->post('sel_temp');
        foreach($user_status as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_visa_type');
        }
        }
        }
///////////////// visa type SECTION End////////////////////

///////////////// country visa class type  SECTION START////////////////////
    public function create_visa_mapping() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $cntry = $this->input->post('cntry');
            $visa_type = $this->input->post('visa_type');
            $sub_class = $this->input->post('sub_class');

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'cntry_id'   => $cntry,
                'visa_type'   => $visa_type,
                'sub_class'   => $sub_class,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->visa_mapping_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Visa Mapping Add Successfully');
            redirect('lead/create_visa_mapping');
        }

        $data['visa_mapping'] = $this->Leads_Model->visa_mapping_select();
        $data['visa_type'] = $this->Leads_Model->visa_type_select();
        $data['country'] = $this->location_model->country();
        $data['title'] = 'Create Visa Mapping';
        $data['content'] = $this->load->view('visa_mapping', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function visa_mapping_update()
    {  
    if(!empty($_POST)){
    $test_id = $this->input->post('test_id');
    $cntry = $this->input->post('cntry');
    $visa_type = $this->input->post('visa_type');
    $sub_class = $this->input->post('sub_class');
    $this->db->set('cntry_id',$cntry);
    $this->db->set('visa_type',$visa_type);
    $this->db->set('sub_class',$sub_class);
    $this->db->where('id',$test_id);
    $this->db->update('tbl_visa_mapping');
    redirect('lead/create_visa_mapping');
    }
    $data['content'] = $this->load->view('visa_mapping', $data, true);
    $this->load->view('layout/main_wrapper', $data);
    }

    public function delete_visa_mapping(){
        if(!empty($_POST)){
        $user_status=$this->input->post('sel_temp');
        foreach($user_status as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_visa_mapping');
        }
        }
        }
///////////////// country visa class type SECTION End////////////////////

///////////////// EDUCATION  SECTION START////////////////////
    public function create_edu() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $edu_name = $this->input->post('edu_name');

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'edu_name'   => $edu_name,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->edu_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Education Add Successfully');
            redirect('lead/create_edu');
        }


        $data['education'] = $this->Leads_Model->edu_select();
        $data['title'] = 'Create Education';
        $data['content'] = $this->load->view('edu_master', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function edu_update()
    {  
    if(!empty($_POST)){
    $test_id = $this->input->post('test_id');
    $edu_name = $this->input->post('edu_name');
    $this->db->set('edu_name',$edu_name);
    $this->db->where('id',$test_id);
    $this->db->update('tbl_edu_master');
    redirect('lead/create_edu');
    }
    $data['content'] = $this->load->view('edu_master', $data, true);
    $this->load->view('layout/main_wrapper', $data);
    }

    public function delete_edu(){
        if(!empty($_POST)){
        $user_status=$this->input->post('sel_temp');
        foreach($user_status as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_edu_master');
        }
        }
        }

public function geteducationHtml($x)
    {
        $data['daynamic_id'] = $x;
        $data['all_education_master'] = $this->Leads_Model->get_edumaster_list();
        $html = $this->load->view('add_more/education_add_more',$data,true);
        echo json_encode(array('html'=>$html));
    }

    public function member_education_save($enq_no='',$keyword = null) {
        if (!empty($_POST)) {

        $this->db->select('Enquery_id,name,lastname');
                    $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
            $all_assign=$q->all_assign;
            $edu_person = $this->input->post('edu_person');
            if($edu_person=='self'){
            $person_name = $q->name.' '.$q->lastname;
            }else{
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
            if(!empty($e_qualification)){         
            foreach($e_qualification as $key=>$value){  

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
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
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->education_all_add($data);
            }
            $comment_id = $this->Leads_Model->add_comment_for_events('Education details has been created', $enq_id);
                    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Education Details';
$stage_remark = 'Education Details Created.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}
            }
            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('education'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('education'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('education'));
            }else{
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('education'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('education'));
            }
        }
    }

    public function member_education_update($enquiry_id = null,$keyword = null)
    {  
    if(!empty($_POST)){        
    $e_qualification = $this->input->post('e_qualification');
    $e_from = $this->input->post('e_from');
    $e_to = $this->input->post('e_to');
    $e_crsname = $this->input->post('e_crsname');
    $e_uniname = $this->input->post('e_uniname');
    $e_institutename = $this->input->post('e_institutename');
    $e_yearawarded = $this->input->post('e_yearawarded');
    $e_member_id = $this->input->post('e_member_id');
    $e_remark = $this->input->post('e_remark');
    $this->db->set('e_qualification',$e_qualification);
    $this->db->set('e_from',$e_from);
    $this->db->set('e_to',$e_to);
    $this->db->set('e_crsname',$e_crsname);
    $this->db->set('e_uniname',$e_uniname);
    $this->db->set('e_institutename',$e_institutename);
    $this->db->set('e_yearawarded',$e_yearawarded);
    $this->db->set('e_remark',$e_remark);
    $this->db->where('id',$e_member_id);
    $this->db->update('tbl_education');

    $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enquiry_id);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
            $all_assign=$q->all_assign;
    $comment_id = $this->Leads_Model->add_comment_for_events('Education details has been updated', $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Education Details';
$stage_remark = 'Education Details Updated.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('education'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('education'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('education'));
            }else{
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('education'));
            }
    }else{
    redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('education'));
    }
    }
    }

   public function member_education_edit_right($edit_id,$enq_no = null,$keyword = null)
    {

    $this->db->select('edit_access');
    $this->db->from('tbl_education');
    $this->db->where('id',$edit_id);
    $qq= $this->db->get()->row();
    if($qq->edit_access==1){
        $edit_status = '0';
        $msg = 'Education detail edit access has been hide';
    }else{
       $edit_status = '1';
       $msg = 'Education detail edit access has been allow'; 
    }
    

    $this->db->set('edit_access',$edit_status);
    $this->db->where('id',$edit_id);
    $this->db->update('tbl_education');

    $this->db->select('Enquery_id,aasign_to,phone,email');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
    $comment_id = $this->Leads_Model->add_comment_for_events($msg, $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Edit Access';
$stage_remark = 'Dear Applicant '.$msg.'.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('education'));
            }else if($keyword=='lead'){
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('education'));
            }else if($keyword=='client'){
                redirect('client/view/'.$enq_no.'/'.base64_encode('education'));
            }else{
                redirect('refund/view/'.$enq_no.'/'.base64_encode('education'));
            }
    }else{
    $this->session->set_flashdata('SUCCESSMSG', 'Client Family Update Successfully');
    redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('education'));
    }
    }


    public function member_education_delete($del_id,$enquiry_id = null,$keyword = null){       
        $this->db->where('id',$del_id);
        $query = $this->db->delete('tbl_education');

        $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enquiry_id);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
            $all_assign=$q->all_assign;
            $comment_id = $this->Leads_Model->add_comment_for_events('Education details has been deleted', $enq_id);

        $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Education Delete';
$stage_remark = 'Education Details Deleted.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

        if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('education'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('education'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('education'));
            }else{
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('education'));
            }
        }else{
        redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('education'));
        }
        }
///////////////// education SECTION START////////////////////
    
    /////////////////Client Agreement save SECTION START////////////////////
    public function client_agreement_save($enquiry_id = null,$keyword = null) {
        $date = date("Y-m-d", strtotime('3 days', strtotime(date("Y-m-d"))));
        if (!empty($_POST)) {
            $enq_no = $this->input->post('enq_id');
        $this->db->select('Enquery_id,email,name_prefix,name,lastname,phone,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $all_assign=$q->all_assign;
            $agreement_name = $this->input->post('content_id');
            $agreement_content = $this->input->post('agreement_content');
            $applicant_name = $this->input->post('applicant_name');
            $a_remark = $this->input->post('a_remark');
            if(!empty($_FILES['applicant_sign']['name'])){          
            $this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['applicant_sign']['name'];
                $_FILES['userfile']['type']= $_FILES['applicant_sign']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['applicant_sign']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['applicant_sign']['error'];
                $_FILES['userfile']['size']= $_FILES['applicant_sign']['size'];    
                
                $_FILES['userfile']['name'] = $image = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
                
                if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }
        }

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'enq_id'   => $enq_id,
                'agreement_name'   => $agreement_name,
                'applicant_name'   => $applicant_name,
                'applicant_sign'   => $image,
                'agreement_content' => $agreement_content,
                'reminder_date'   => $date,
                'a_remark'   => $a_remark,
                'reminder_status'   => '0',
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->agreement_format_add($data);

            $comment_id = $this->Leads_Model->add_comment_for_events('Agreement details has been created', $enq_id);

    /*******************************************notification start********************************************/
$conversation = 'Agreement Details';
$stage_remark = 'Aggrement created.If already notify about that please ignore.';
//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

    $this->db->select('pk_i_admin_id');
    $this->db->from('tbl_admin');
    $this->db->where('s_phoneno',$q->phone);
    $this->db->limit(1);
    $q3 = $this->db->get()->row();

    $enq_id = $enq_id;
    $related_to = $q3->pk_i_admin_id;
    $create_by = '';
    $subject = 'Agreement Reminder';
    $tempData = $this->apiintegration_Model->get_reminder_templates(1);
    $stage_remark='';
    if($tempData->num_rows()==1){
        $tempData=$tempData->row();
        $stage_remark=$tempData->message;
        $stage_remark = str_replace("@prefix",$q->name_prefix,$stage_remark);   
        $stage_remark = str_replace("@firstname",$q->name,$stage_remark);  
        $stage_remark = str_replace("@lastname",$q->lastname,$stage_remark);  
    }

    // $stage_remark = 'Dear '.$q->name_prefix.'. '.$q->name.' '.$q->lastname.', Greetings from Godspeed Immigration. We wish to inform you that an agreement generate. If already notify about that please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
    $task_date = date("d-m-Y");
    $task_time = date("h:i:s");
     $this->User_model->add_comment_for_student_user($enq_id,$related_to,$subject,$stage_remark,$task_date,$task_time,$create_by);
    /*******************************************notification end**********************************************/
            
            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else{
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('agreement'));
            }
        }
    }

///////////////////////////////////////////Agrrement Approve////////////////////////////////////
    public function client_agreement_approve($ager_id='',$enquiry_id = null,$keyword = null)
    { 

    if(!empty($ager_id)){
    $this->db->set('approve_status',1);
    $this->db->set('approve_by',$this->session->user_id);
    $this->db->where('id',$ager_id);
    $this->db->update('tbl_client_agreement');

    $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enquiry_id);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $all_assign=$q->all_assign;
    $comment_id = $this->Leads_Model->add_comment_for_events('Agreement details has been approved', $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Agreement approved';
$stage_remark = 'Agreement Details Approve.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else{
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('agreement'));
            }
    }
    }
////////////////////////////////////////////////Aggrement Approve End////////////////////////////////////////

    public function client_details_update($enquiry_id = null,$keyword = null)
    {  
    if(!empty($_POST)){
        
        if(!empty($_FILES['applicant_sign']['name'])){          
        $this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['applicant_sign']['name'];
                $_FILES['userfile']['type']= $_FILES['applicant_sign']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['applicant_sign']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['applicant_sign']['error'];
                $_FILES['userfile']['size']= $_FILES['applicant_sign']['size'];    
                
                $_FILES['userfile']['name'] = $image = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
                
                if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }
        }else{
              $image=$this->input->post('applicant_sign_old', true);
        }
        
    $tmpid = $this->input->post('template_id');
    $agreement_name = $this->input->post('content_id');
    $applicant_name = $this->input->post('applicant_name');
    $agreement_content = $this->input->post('agreement_content');
    $a_remark = $this->input->post('a_remark');
    $this->db->set('agreement_name',$agreement_name);
    $this->db->set('applicant_name',$applicant_name);
    $this->db->set('applicant_sign',$image);
    $this->db->set('agreement_content',$agreement_content);
    $this->db->set('a_remark',$a_remark);
    $this->db->where('id',$tmpid);
    $this->db->update('tbl_client_agreement');

    $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enquiry_id);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $all_assign=$q->all_assign;
    $comment_id = $this->Leads_Model->add_comment_for_events('Agreement details has been updated', $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Agreement Details';
$stage_remark = 'Agreement Details Updated.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else{
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('agreement'));
            }
    }
    }

    public function client_final_upload($enquiry_id = null,$keyword = null)
    {
    if(!empty($_POST)){
        
        if(!empty($_FILES['signed_file']['name'])){          
        $this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['signed_file']['name'];
                $_FILES['userfile']['type']= $_FILES['signed_file']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['signed_file']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['signed_file']['error'];
                $_FILES['userfile']['size']= $_FILES['signed_file']['size'];    
                
                $_FILES['userfile']['name'] = $image = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
                
                if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }
        }else{
              $image=$this->input->post('signed_file_old', true);
        }
        
    $tmpid = $this->input->post('template_id');
    $this->db->set('signed_file',$image);
    $this->db->where('id',$tmpid);
    $this->db->update('tbl_client_agreement');

    $this->db->select('Enquery_id,aasign_to,phone,email,name_prefix,name,lastname,all_assign');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enquiry_id);
    $qq= $this->db->get()->row();
    $enqq_id=$qq->Enquery_id;
    $aasign_to_id=$qq->aasign_to;
    $all_assign=$qq->all_assign;
    $comment_id = $this->Leads_Model->add_comment_for_events('Final Agreement details has been uploaded', $enqq_id);

     $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$qq->email);
                    $this->db->where('s_phoneno',$qq->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$tempData = $this->apiintegration_Model->get_reminder_templates(7);
$stage_remark='';
if($tempData->num_rows()==1){
    $tempData=$tempData->row();
    $stage_remark=$tempData->message;
    $stage_remark = str_replace("@prefix",$qq->name_prefix,$stage_remark);   
    $stage_remark = str_replace("@firstname",$qq->name,$stage_remark);  
    $stage_remark = str_replace("@lastname",$qq->lastname,$stage_remark);
    $stage_remark = str_replace("@enquiry_id",$qq->Enquery_id,$stage_remark);  
}
$conversation = 'Final Agreement Submited!';
$stage_remark = $stage_remark;

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

//$stage_remark = 'Final Agreement Details Uploaded.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    /*******************************************notification start********************************************/
    $this->db->select('created_by,enq_id');
    $this->db->from('tbl_client_agreement');
    $this->db->where('id',$tmpid);
    $this->db->limit(1);
    $q3 = $this->db->get()->row();

    $this->db->select('email,name_prefix,name,lastname,phone');
    $this->db->from('enquiry');
    $this->db->where('Enquery_id',$q3->enq_id);
    $this->db->limit(1);
    $q = $this->db->get()->row();
//final agreement submitted
    $enq_id = $q3->enq_id;
    $related_to = '0';
    $create_by = $q3->created_by;
    $subject = 'Agreement Reminder';
    $stage_remark='';
    $tempData = $this->apiintegration_Model->get_reminder_templates(2);
    if($tempData->num_rows()==1){
        $tempData=$tempData->row();
        $stage_remark=$tempData->message;
        $stage_remark = str_replace("@prefix",$q->name_prefix,$stage_remark);   
        $stage_remark = str_replace("@firstname",$q->name,$stage_remark);  
        $stage_remark = str_replace("@lastname",$q->lastname,$stage_remark);  
        $stage_remark = str_replace("@enquiry_id",$q3->enq_id,$stage_remark);  
    }
    // $stage_remark = 'Dear '.$q->name_prefix.'. '.$q->name.' '.$q->lastname.', and user id '..' is Submited his final agreement. If already notify about that please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
    $task_date = date("d-m-Y");
    $task_time = date("h:i:s");
     $this->User_model->add_comment_for_student_user($enq_id,$related_to,$subject,$stage_remark,$task_date,$task_time,$create_by);
    /*******************************************notification end**********************************************/

    if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else{
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('agreement'));
            }
    }
    }

public function delete_client_agreement(){
        if(!empty($_POST)){
        $user_status=$this->input->post('sel_temp');
        foreach($user_status as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_client_agreement');
        }
        }
        }

public function ticket_client_agreement(){

    $tmpid=$this->input->post('template_id');
    $tkt_content=$this->input->post('tkt_content');
    /*******************************************notification start********************************************/
    $this->db->select('created_by,enq_id,applicant_name');
    $this->db->from('tbl_client_agreement');
    $this->db->where('id',$tmpid);
    $this->db->limit(1);
    $q3 = $this->db->get()->row();

    $this->db->select('phone,enquiry_id');
    $this->db->from('enquiry');
    $this->db->where('Enquery_id',$q3->enq_id);
    $this->db->limit(1);
    $q2 = $this->db->get()->row();

    $this->db->select('pk_i_admin_id');
    $this->db->from('tbl_admin');
    $this->db->where('s_phoneno',$q2->phone);
    $this->db->limit(1);
    $q1 = $this->db->get()->row();

    $enq_id = $q3->enq_id;
    if(!in_array($this->session->userdata('user_right'), applicant)){
    $related_to = $q1->pk_i_admin_id;
    $create_by = '0';
    $stage_remark = 'Dear '.$q3->applicant_name.' ,and user id '.$enq_id.' Your ticket response by Godspeed team is '.$tkt_content.'.';
    }else{
     $related_to = '0';
     $create_by = $q3->created_by;
     $stage_remark = 'Student '.$q3->applicant_name.' ,and user id '.$enq_id.' is raise a ticket.Ticket content is '.$tkt_content.'.';
    }
    $subject = 'Agreement Ticket';
    $task_date = date("d-m-Y");
    $task_time = date("h:i:s");
     $this->User_model->add_comment_for_student_user($enq_id,$related_to,$subject,$stage_remark,$task_date,$task_time,$create_by);
    /*******************************************notification end**********************************************/
    if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Send successfully');
                redirect('enquiry/view/'.$q2->enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Send successfully');
                redirect('lead/lead_details/'.$q2->enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Send successfully');
                redirect('client/view/'.$q2->enquiry_id.'/'.base64_encode('agreement'));
            }else{
                $this->session->set_flashdata('message', 'Send successfully');
                redirect('refund/view/'.$q2->enquiry_id.'/'.base64_encode('agreement'));
            }
            }else{
            redirect('dashboard/user_profile/'.$q2->enquiry_id.'/'.base64_encode('agreement'));
            }
}

 /**************************Grenerate aggriment**************************/
public function generate_client_aggrement($ager_id='',$enquiry_id = null,$keyword = null) {
        $pdf_name = $ager_id;
$this->db->select('tbl_client_agreement.agreement_content,tbl_agreement_template.template_name,tbl_client_agreement.applicant_name,tbl_client_agreement.applicant_sign');
                    $this->db->from('tbl_client_agreement');
                    $this->db->join('tbl_agreement_template', 'tbl_agreement_template.id=tbl_client_agreement.agreement_name','left');
                    $this->db->where('tbl_client_agreement.id',$pdf_name);
                    $q= $this->db->get()->row();
$data['content']=$q;

$this->load->helpers('dompdf');
            $viewfile = $this->load->view('agreement/common-aggrement', $data, TRUE);
            pdf_create($viewfile,$q->template_name.'-'.$this->session->user_id);
            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }else{
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('agreement'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('agreement'));
            }
            
    }

public function generate_aggrement_for_mail($ager_id='') {
        $pdf_name = base64_decode($ager_id);
$this->db->select('enquiry.email,enquiry.name,enquiry.lastname,enquiry.phone,tbl_client_agreement.enq_id,tbl_client_agreement.agreement_content,tbl_agreement_template.template_name,tbl_client_agreement.applicant_name,tbl_client_agreement.applicant_sign');
                    $this->db->from('tbl_client_agreement');
                    $this->db->join('tbl_agreement_template', 'tbl_agreement_template.id=tbl_client_agreement.agreement_name','left');
                    $this->db->join('enquiry', 'enquiry.Enquery_id=tbl_client_agreement.enq_id','left');
                    $this->db->where('tbl_client_agreement.id',$pdf_name);
                    $q= $this->db->get()->row();
$data['content']=$q;
$file_names = $q->template_name.'-'.$q->enq_id.".pdf";
$to = $q->email;

/*$this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno');
$this->db->where('companey_id',$this->session->companey_id);
$this->db->where('pk_i_admin_id',$this->session->user_id);
$sender_row =   $this->db->get('tbl_admin')->row_array();*/

$this->load->helpers('dompdf');
$viewfile = $this->load->view('agreement/common-aggrement', $data, TRUE);
$folder  = pdf_create_mail($viewfile,$q->template_name.'-'.$q->enq_id);
if($folder)
    {
        $this->load->library("aws");
        $rt = $this->aws->uploadinfolder($this->session->awsfolder,$folder);

        $this->db->set('mail_pdf_link', $q->template_name.'-'.$q->enq_id.".pdf");
        $this->db->where('id', $pdf_name);
        $this->db->update('tbl_client_agreement');
echo $url = 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/God%20Speed/'.$file_names;
            /*$this->db->select('user_protocol as protocol,user_host as smtp_host,user_port as smtp_port,user_email as smtp_user,user_password as smtp_pass');
            $this->db->where('companey_id',$this->session->companey_id);
            $this->db->where('pk_i_admin_id',$this->session->user_id);
            $email_row  =   $this->db->get('tbl_admin')->row_array();
            if(empty($email_row['smtp_user'] && $email_row['smtp_pass'])){
            $this->db->where('comp_id',$this->session->companey_id);
            $this->db->where('status',1);
            $email_row  =   $this->db->get('email_integration')->row_array();
            }*/

            /*if(empty($email_row)){
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
            }*/

/*$email_subject = 'Agrrement Template';
 $message = 'Hi Find This Agrrement With Link abd Attachment! @link';
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
            $new_message = str_replace('@link', 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/God%20Speed/'.$file_names,$new_message);
$attach = $folder;
                $this->email->initialize($config);
                $this->email->from($email_row['smtp_user']);                        
                $this->email->to($to);
                $this->email->subject($email_subject); 
                $this->email->message($new_message);           
                $this->email->attach($attach);               
                if($this->email->send()){
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Sent.', $q->enq_id,'0','0',$new_message,'3','1',$email_subject,$file_names);
                echo "Email Sent Successfully With Attachment Link!";
                }else{
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Failed.', $q->enq_id,'0','0',$new_message,'3','0',$email_subject,$file_names);
                        echo "Something went wrong";                                
                }*/
if($rt == true)
    {
            unlink($folder); 
    }
/*echo 'Email Sent Successfully With Attachment Link!';
    }else{
echo 'Something went wrong!';*/            
    }else{
        echo '0';
    }
}
/***********************End Generate aggriment*****************************/
#------------------------------------------client ticket section start----------------------------------------------#

public function member_refund_form($enq_no='',$keyword = null) {

        $this->db->select('Enquery_id,name,lastname,email,phone,aasign_to');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
              
            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'enquiry_id'   => $enq_id,
                'status'   => '0',
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->refund_req_sent($data);
            $comment_id = $this->Leads_Model->add_comment_for_events('Refund Form has been allowed', $enq_id);
    /*******************************************notification start********************************************/
    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_phoneno',$q->phone);
                    $q2= $this->db->get()->row();

    $related_to = $q2->pk_i_admin_id;
    $create_by = $this->session->userdata('user_id');
    $subject = 'Refund Form Allow';
    $tempData = $this->apiintegration_Model->get_reminder_templates(2);
    if($tempData->num_rows()==1){
        $tempData=$tempData->row();
        $stage_remark=$tempData->message;
        $stage_remark = str_replace("@prefix",'',$stage_remark);   
        $stage_remark = str_replace("@firstname",$q->name,$stage_remark);  
        $stage_remark = str_replace("@lastname",$q->lastname,$stage_remark);  
        $stage_remark = str_replace("@enquiry_id",$q->Enquery_id,$stage_remark);  
    }

    $task_date = date("d-m-Y");
    $task_time = date("h:i:s");
     $this->User_model->add_comment_for_student_user($enq_id,$related_to,$subject,$stage_remark,$task_date,$task_time,$create_by);

//Email code start here
$company = $this->session->userdata('companey_id');
$aasign_to = $this->session->userdata('user_id');
$message= $this->db->where(array('temp_id'=>'361','comp_id'=>$company))->get('api_templates')->row();
/*if(!empty($send_url)){
$pay_link = '<a href="'.$send_url.'" targrt="_blank" style="text-decoration: underline;color:blue;">'.$send_url.'</a>';
}*/
    //For Sender details
        $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        $this->db->where('companey_id',$company);
        $this->db->where('pk_i_admin_id',$aasign_to);
        $sender_row =   $this->db->get('tbl_admin')->row_array();
if(!empty($sender_row['telephony_agent_no'])){
    $senderno = '0'.$sender_row['telephony_agent_no'];
}else{
    $senderno = $sender_row['s_phoneno'];
}

//For mail credential details
            $this->db->select('user_protocol as protocol,user_host as smtp_host,user_port as smtp_port,user_email as smtp_user,user_password as smtp_pass');
            $this->db->where('companey_id',$company);
            $this->db->where('pk_i_admin_id',$aasign_to);
            $email_row  =   $this->db->get('tbl_admin')->row_array();
            if(empty($email_row['smtp_user'] && $email_row['smtp_pass'])){
            $this->db->where('comp_id',$company);
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

$email_subject = $message->mail_subject;
$stage_remark = 'Payment Link Sent On Email And SMS Please Check!';
            $data['message'] = $message->template_content;
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
                /*if(!empty($pay_link)){
                    $new_message = str_replace('@link', $pay_link,$new_message);
                }*/
$to = $q->email;

                $this->email->initialize($config);
                $this->email->from($email_row['smtp_user']);                        
                $this->email->to($to);
                $this->email->subject($email_subject); 
                $this->email->message($new_message);               
                if($this->email->send()){
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Sent.', $enq_id,'0',$sender_row['pk_i_admin_id'],$new_message,'3','1',$email_subject);
                echo "Email Sent Successfully!";
                }else{
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Failed.', $enq_id,'0',$sender_row['pk_i_admin_id'],$new_message,'3','0',$email_subject);
                        echo "Something went wrong";                                
                }
    /*******************************************notification end**********************************************/
            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('refund'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('refund'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('refund'));
            }else{
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('refund'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('refund'));
            }
    }

    public function member_refund_form_close($enq_no='',$keyword = null) {

        $this->db->select('Enquery_id,name,lastname,phone,aasign_to,email');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
              
    $this->db->set('status',1);
    $this->db->where('enquiry_id',$enq_id);
    $this->db->update('tbl_refund_form_request');
    $comment_id = $this->Leads_Model->add_comment_for_events('Refund Form has been disallowed', $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Refund Details';
$stage_remark = 'Refund request Disallowed.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}
    
            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('refund'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('refund'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('refund'));
            }else{
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('refund'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('refund'));
            }
    }

    public function member_ticket_save($enq_no='',$keyword = null) {
        if (!empty($_POST)) {

        $this->db->select('Enquery_id,name,lastname,phone,aasign_to,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $all_assign=$q->all_assign;
            $t_sub = $this->input->post('t_sub');
            $t_desc = $this->input->post('t_desc');
              
            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'enquiry_id'   => $enq_id,
                't_subject'   => $t_sub,
                't_description'   => $t_desc,
                't_date'   => date("Y-m-d H:i:s"),
                't_status'   => '0',
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->ticket_all_add($data);
            $comment_id = $this->Leads_Model->add_comment_for_events('Ticket details has been created', $enq_id);
    /*******************************************notification start********************************************/
$conversation = 'Ticket Details';
$stage_remark = 'Ticket Created.If already notify about that please ignore.';
//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_phoneno',$q->phone);
                    $q2= $this->db->get()->row();
    if(!in_array($this->session->userdata('user_right'), applicant)){
    $related_to = $q2->pk_i_admin_id;
    $create_by = $this->session->userdata('user_id');
    $subject = 'Raise Ticket';
    $stage_remark='';
    $tempData = $this->apiintegration_Model->get_reminder_templates(3);
    if($tempData->num_rows()==1){
        $tempData=$tempData->row();
        $stage_remark=$tempData->message;
        $stage_remark = str_replace("@prefix",'',$stage_remark);   
        $stage_remark = str_replace("@firstname",$q->name,$stage_remark);  
        $stage_remark = str_replace("@lastname",$q->lastname,$stage_remark);  
        $stage_remark = str_replace("@enquiry_id",$q->Enquery_id,$stage_remark);  
    }
    // $stage_remark = 'Dear '.$q->name.' '.$q->lastname.', and user id '.$q->Enquery_id.' got a ticket. If already notify about that please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
  
    $task_date = date("d-m-Y");
    $task_time = date("h:i:s");
}else{
    $related_to = $q->aasign_to;
    $create_by = $this->session->userdata('user_id');
    $subject = 'Raise Ticket';
    $stage_remark='';
    $tempData = $this->apiintegration_Model->get_reminder_templates(5);
    if($tempData->num_rows()==1){
        $tempData=$tempData->row();
        $stage_remark=$tempData->message;
        $stage_remark = str_replace("@prefix",$q->name_prefix,$stage_remark);   
        $stage_remark = str_replace("@firstname",$q->name,$stage_remark);  
        $stage_remark = str_replace("@lastname",$q->lastname,$stage_remark);  
        $stage_remark = str_replace("@enquiry_id",$q->Enquery_id,$stage_remark);  
    }
    // $stage_remark = 'Dear '.$q->name_prefix.'. '.$q->name.' '.$q->lastname.', and user id '.$q->Enquery_id.' is raise a ticket. If already notify about that please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
    $task_date = date("d-m-Y");
    $task_time = date("h:i:s");
}
     $this->User_model->add_comment_for_student_user($enq_id,$related_to,$subject,$stage_remark,$task_date,$task_time,$create_by);
    /*******************************************notification end**********************************************/
            }
            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('ticket'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('ticket'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('ticket'));
            }else{
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('ticket'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('ticket'));
            }
    }



    public function member_ticket_update($enquiry_id = null,$keyword = null)
    {  
    if(!empty($_POST)){ 
    $t_preority = $this->input->post('priority');       
    $t_sub = $this->input->post('t_sub');
    $t_desc = $this->input->post('t_desc');
    $t_ticket_id = $this->input->post('t_ticket_id');

    $this->db->set('t_preority',$t_preority);
    $this->db->set('t_subject',$t_sub);
    $this->db->set('t_description',$t_desc);
    $this->db->where('id',$t_ticket_id);
    $this->db->update('tbl_ticket_tab');

    $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enquiry_id);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $all_assign=$q->all_assign;
    $comment_id = $this->Leads_Model->add_comment_for_events('Ticket details has been updated', $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Ticket Details';
$stage_remark = 'Ticket Details Updated.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('ticket'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('ticket'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('ticket'));
            }else{
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('ticket'));
            }
    }else{
    redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('ticket'));
    }
    }
    }

    public function member_ticket_reply($enquiry_id = null,$keyword = null)
    {  
    if(!empty($_POST)){        

    $t_rply = $this->input->post('t_rply');
    $t_ticket_id = $this->input->post('t_ticket_id');

    $this->db->set('t_reply',$t_rply);
    $this->db->set('r_date',date("Y-m-d H:i:s"));
    $this->db->set('t_status','1');
    $this->db->where('id',$t_ticket_id);
    $this->db->update('tbl_ticket_tab');

    $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enquiry_id);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $all_assign=$q->all_assign;
    $comment_id = $this->Leads_Model->add_comment_for_events('Ticket has been replied', $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Ticket Details';
$stage_remark = 'Ticket replied has been done go to ticket section and explore.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('ticket'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('ticket'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('ticket'));
            }else{
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('ticket'));
            }
    }else{
    redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('ticket'));
    }
    }
    }

    public function member_ticket_edit_right($edit_id,$enq_no = null,$keyword = null)
    {

    $this->db->select('edit_access');
    $this->db->from('tbl_ticket_tab');
    $this->db->where('id',$edit_id);
    $qq= $this->db->get()->row();
    if($qq->edit_access==1){
        $edit_status = '0';
        $msg = 'Ticket details edit access has been hide';
    }else{
       $edit_status = '1';
       $msg = 'Ticket details edit access has been allow'; 
    }
    

    $this->db->set('edit_access',$edit_status);
    $this->db->where('id',$edit_id);
    $this->db->update('tbl_ticket_tab');

    $this->db->select('Enquery_id,aasign_to,phone,email');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enq_no);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $comment_id = $this->Leads_Model->add_comment_for_events($msg, $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Ticket Details';
$stage_remark = 'Dear Applicant '.$msg.'.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('ticket'));
            }else if($keyword=='lead'){
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('ticket'));
            }else if($keyword=='client'){
                redirect('client/view/'.$enq_no.'/'.base64_encode('ticket'));
            }else{
                redirect('refund/view/'.$enq_no.'/'.base64_encode('ticket'));
            }
    }else{
    $this->session->set_flashdata('SUCCESSMSG', 'Client Ticket Update Successfully');
    redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('ticket'));
    }
    }

    public function member_ticket_delete($del_id,$enquiry_id = null,$keyword = null){       
        $this->db->where('id',$del_id);
        $query = $this->db->delete('tbl_ticket_tab');

        $this->db->select('Enquery_id,aasign_to,phone,email');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enquiry_id);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $aasign_to_id=$q->aasign_to;
        $comment_id = $this->Leads_Model->add_comment_for_events('Ticket details has been deleted', $enq_id);

                    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Ticket Details';
$stage_remark = 'Ticket Details Deleted.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

        if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('ticket'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('ticket'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('ticket'));
            }else{
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('ticket'));
            }
        }else{
        redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('ticket'));
        }
        }
#--------------------------------------------client ticket section end------------------------------------------#
#-------------------------------------------------document tab View start--------------------------------------------#
/*public function select_file_type() {
        $diesc = $this->input->post('file_id');
        echo json_encode($this->Leads_Model->all_filetype($diesc));

       // echo $diesc;
    }*/
public function select_file_type() {
        $diesc = $this->input->post('file_id');
        $doc_type = $this->input->post('doc_type');
        $enq_no = $this->input->post('enq_no');

        /*$this->db->select("tbl_doc_vs_file.*,tbl_doccheklist.checklist,tbl_doccheklist.required,tbl_doccheklist.enq_no as chkenq");
        $this->db->from('tbl_doc_vs_file');
        $this->db->join('tbl_doccheklist','tbl_doccheklist.document_type=tbl_doc_vs_file.id','left');
if(in_array($this->session->userdata('user_right'), applicant)){
        $this->db->where('tbl_doccheklist.enq_no',$enq_no);
        $this->db->where('tbl_doccheklist.checklist',1);
}        
        $this->db->where('tbl_doc_vs_file.stream',$diesc);
        $this->db->where('tbl_doc_vs_file.document_type',$doc_type);
        $this->db->where('tbl_doc_vs_file.comp_id', $this->session->userdata('companey_id'));
        $query = $this->db->get()->result();*/
if(in_array($this->session->userdata('user_right'), applicant)){
        $this->db->select("tbl_doc_vs_file.*,tbl_doccheklist.checklist,tbl_doccheklist.required,tbl_doccheklist.enq_no as chkenq");
        $this->db->from('tbl_doc_vs_file');
        $this->db->join('tbl_doccheklist','tbl_doccheklist.document_type=tbl_doc_vs_file.id','left');

        $this->db->where('tbl_doccheklist.enq_no',$enq_no);
        $this->db->where('tbl_doccheklist.checklist',1);

        $this->db->where('tbl_doc_vs_file.stream',$diesc);
        $this->db->where('tbl_doc_vs_file.document_type',$doc_type);
        $this->db->where('tbl_doc_vs_file.comp_id', $this->session->userdata('companey_id'));
        $query = $this->db->get()->result();
}else{

    $this->db->select("tbl_doc_vs_file.*,tbl_doccheklist.checklist,tbl_doccheklist.required,tbl_doccheklist.enq_no as chkenq");
        $this->db->from('tbl_doc_vs_file');
        $this->db->join('tbl_doccheklist','tbl_doccheklist.document_type=tbl_doc_vs_file.id','left');

        $this->db->where('tbl_doccheklist.enq_no',$enq_no);

        $this->db->where('tbl_doc_vs_file.stream',$diesc);
        $this->db->where('tbl_doc_vs_file.document_type',$doc_type);
        $this->db->where('tbl_doc_vs_file.comp_id', $this->session->userdata('companey_id'));
        $query = $this->db->get()->result();
if(empty($query)){
        $this->db->select("*");
        $this->db->from('tbl_doc_vs_file');
        $this->db->where('tbl_doc_vs_file.stream',$diesc);
        $this->db->where('tbl_doc_vs_file.document_type',$doc_type);
        $this->db->where('tbl_doc_vs_file.comp_id', $this->session->userdata('companey_id'));
        $querynew = $this->db->get()->result();
    }

}

        /*echo "<pre>";
        print_r($query);
        echo "</pre>";exit;*/
echo '<form id="docuform" method="post" enctype="multipart/form-data">';
        echo '<table class="table">';
        echo '<thead>
            <tr>
                <th>S.No</th>
                <th style="display:none;">Enq No</th>
                <th style="display:none;">Document Type</th>
                <th style="display:none;">Stream Name</th>
                <th style="display:none;">Document Id</th>
                <th>Document Name</th>
                <th>Upload File</th>
                <th>Remark</th>';
             if(!in_array($this->session->userdata('user_right'), applicant)){
        if (user_access('650')===true || user_access('651')===true || user_access('652')===true) {
          echo '<th>Checklist</th>';
        }
        if (user_access('660')===true || user_access('661')===true || user_access('662')===true) {
          echo '<th>Required</th>';
        }
        if (user_access('670')===true || user_access('671')===true || user_access('672')===true) {
          echo '<th>Edit</th>';
        }
        if (user_access('680')===true || user_access('681')===true || user_access('682')===true) {
          echo '<th>Approved</th>';
        }
            }
          echo '<th>Action</th>
            </tr>
        </thead>'; 
    echo '<tbody>';
if(!empty($query)){
    $i='1'; foreach($query as $value){

        if($value->chkenq==$enq_no){

        $this->db->select("id,browse_file,d_remark,tbl_documents.status as dsts,tbl_documents.edit_access,enquiry.enquiry_id as enqids");
        $this->db->from('tbl_documents');
        $this->db->join('enquiry','enquiry.Enquery_id=tbl_documents.enquiry_id','left');
        $this->db->where('tbl_documents.doc_stream',$value->stream);
        $this->db->where('enquiry.enquiry_id',$enq_no);
        $this->db->where('tbl_documents.doc_file',$value->id);
        $this->db->where('tbl_documents.doc_type',$value->document_type);
        $this->db->where('tbl_documents.comp_id', $this->session->userdata('companey_id'));
        $query1 = $this->db->get()->row();
        if(!empty($query1->d_remark)){
          $d_remark = $query1->d_remark;
        }else{
           $d_remark = ''; 
        }
       
            echo '<tr>';
                echo '<td>'.$i.'</td>';
    echo '<td style="display:none;"><input type="text" value="'.$enq_no.'" id="enq_no'.$i.'" name="enq_no'.$i.'"></td>';
    echo '<td style="display:none;">
        <input type="text" value="'.$value->document_type.'" id="doc_type'.$i.'" name="doc_type'.$i.'"></td>';
    echo '<td style="display:none;">
        <input type="text" value="'.$value->stream.'" id="stream_name'.$i.'" name="stream_name'.$i.'"></td>';
    echo '<td style="display:none;">
        <input type="text" value="'.$value->id.'" id="file_name'.$i.'" name="file_name'.$i.'"></td>';
    echo '<td>'.$value->file_name.' '.(($value->required=='1')?"<span style='color:red;font-size:15px;'>*</span>":"").'</td>';
    if(empty($query1->browse_file)){
        echo '<td><input type="file" id="browse_file'.$i.'" name="browse_file'.$i.'" style="width:150px;" '.(($value->required=='1')?"required":"").'></td>';
    }else{
    echo '<td><a href="https://studyandimmigration.s3.ap-south-1.amazonaws.com/God Speed/'.$query1->browse_file.'" target="_blank" style="cursor: pointer;font-size: 20px;"><i class="fa fa-file" aria-hidden="true"></i></a>'; 
if($query1->edit_access=='1'){
    echo '<input type="file" id="browse_file'.$i.'" name="browse_file'.$i.'" style="width:150px;" '.(($value->required=='1')?"required":"").'>';
}
    echo '</td>';
    }
    echo '<td><textarea class="form-control" id="d_remark'.$i.'" name="d_remark'.$i.'" style="width:150px;" value="'. $d_remark.'" '.(($value->required=='1')?"required":"").'>'.$d_remark.'</textarea></td>';

    if(!in_array($this->session->userdata('user_right'), applicant)){
        if (user_access('650')===true || user_access('651')===true || user_access('652')===true) {
    echo '<td><input type="checkbox" onclick="document_check('.$i.','.$value->id.','.$enq_no.')" id="checklist'.$i.'" name="checklist" '.(($value->checklist=='1' && $value->chkenq==$enq_no)?"checked":"").'></td>';
        }
        if (user_access('660')===true || user_access('661')===true || user_access('662')===true) {
    echo '<td><input type="checkbox" onclick="document_required('.$i.','.$value->id.','.$enq_no.')" id="required'.$i.'" name="required" '.(($value->required=='1' && $value->chkenq==$enq_no)?"checked":"").'></td>';
        }
        if (user_access('670')===true || user_access('671')===true || user_access('672')===true) {
    echo '<td><input type="checkbox" onclick="document_edit('.$i.','.$value->id.','.$enq_no.')" id="edit'.$i.'" name="edit" '.((!empty($query1->edit_access) && $query1->edit_access=='1'  && $query1->enqids==$enq_no)?"checked":"").'></td>';
        }
        if (user_access('680')===true || user_access('681')===true || user_access('682')===true) {
    echo '<td><input type="checkbox" onclick="document_approve('.$i.','.$value->id.','.$enq_no.')" id="approved'.$i.'" name="approved" '.((!empty($query1->dsts) && $query1->dsts=='1' && $query1->enqids==$enq_no)?"checked":"").'></td>';
       }
    }
    echo '<td>';
if(!empty($query1->dsts) && $query1->dsts=='1'){
    echo '';
}else{
    echo '<a onclick="document_save('.$i.')" style="cursor: pointer;font-size: 20px;"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>';
}
    echo '</td>';                          
    echo '</tr>';
        $i++;  
            }
        }
    }else{
if(!empty($querynew)){
        $i='1'; foreach($querynew as $value){
       
            echo '<tr>';
                echo '<td>'.$i.'</td>';
    echo '<td style="display:none;"><input type="text" value="'.$enq_no.'" id="enq_no'.$i.'" name="enq_no'.$i.'"></td>';
    echo '<td style="display:none;">
        <input type="text" value="'.$value->document_type.'" id="doc_type'.$i.'" name="doc_type'.$i.'"></td>';
    echo '<td style="display:none;">
        <input type="text" value="'.$value->stream.'" id="stream_name'.$i.'" name="stream_name'.$i.'"></td>';
    echo '<td style="display:none;">
        <input type="text" value="'.$value->id.'" id="file_name'.$i.'" name="file_name'.$i.'"></td>';
    echo '<td>'.$value->file_name.'</td>';

    echo '<td><input type="file" id="browse_file'.$i.'" name="browse_file'.$i.'" style="width:150px;"></td>';

    echo '<td><textarea class="form-control" id="d_remark'.$i.'" name="d_remark'.$i.'" style="width:150px;"></textarea></td>';

    if(!in_array($this->session->userdata('user_right'), applicant)){
        if (user_access('650')===true || user_access('651')===true || user_access('652')===true) {
    echo '<td><input type="checkbox" onclick="document_check('.$i.','.$value->id.','.$enq_no.')" id="checklist'.$i.'" name="checklist"></td>';
        }
        if (user_access('660')===true || user_access('661')===true || user_access('662')===true) {
    echo '<td><input type="checkbox" onclick="document_required('.$i.','.$value->id.','.$enq_no.')" id="required'.$i.'" name="required"></td>';
        }
        if (user_access('670')===true || user_access('671')===true || user_access('672')===true) {
    echo '<td><input type="checkbox" onclick="document_edit('.$i.','.$value->id.','.$enq_no.')" id="edit'.$i.'" name="edit"></td>';
        }
        if (user_access('680')===true || user_access('681')===true || user_access('682')===true) {
    echo '<td><input type="checkbox" onclick="document_approve('.$i.','.$value->id.','.$enq_no.')" id="approved'.$i.'" name="approved"></td>';
       }
    }
    echo '<td>';
    echo '<a onclick="document_save('.$i.')" style="cursor: pointer;font-size: 20px;"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>';
    echo '</td>';                          
    echo '</tr>';
        $i++;  
            }

        }else{

            //Write here msg which want to show student if his checklist not create

        }
        
    }
    echo '</tbody>';
echo '</table>';
echo '</form>';

       // echo $diesc;
}
public function select_file_stream() {
        $diesc = $this->input->post('stream_id');
        echo json_encode($this->Leads_Model->all_filestream($diesc));

       // echo $diesc;
    }
public function getHtml($enq_country,$x)
    {
        $data['daynamic_id'] = $x;
        $data['post_doc_list'] = $this->Leads_Model->get_postdoc_list($enq_country);
        $html = $this->load->view('document/add_more',$data,true);
        echo json_encode(array('html'=>$html));
    }

public function select_file_download($enq_no) {
        $this->db->select('Enquery_id,name_prefix,name,lastname');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enq_no);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;

        $this->db->select("id,browse_file");
        $this->db->from('tbl_documents');
        $this->db->where('enquiry_id',$enq_id);
        $this->db->where('comp_id', $this->session->userdata('companey_id'));
        $queries = $this->db->get()->result();

        $this->load->library('zip');
        foreach($queries as $kay=>$value){
            if(!empty($value->browse_file)){
                $filename = $value->browse_file;
                $filedata = 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/God Speed/'.$value->browse_file;
            $this->zip->add_data($filename, $filedata);
            }
        }
        $this->zip->archive($_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/Document_backup.zip");
        $this->zip->download('Document_backup.zip');
        $path = $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/Document_backup.zip";
        unlink($path);
    }

public function client_document_save($index='') {
        if (!empty($_POST)) {    
        $enq_no = $this->input->post('enq_no');
        
        $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
            $all_assign=$q->all_assign;
            $doc_type = $this->input->post('doc_type');
            $stream_name = $this->input->post('stream_name');
            $file_name = $this->input->post('file_name');
            $d_remark = $this->input->post('d_remark');
            if(!empty($_FILES['browse_file']['name'])){         
            $this->load->library("aws"); 

                $_FILES['userfile']['name']= $_FILES['browse_file']['name'];
                $_FILES['userfile']['type']= $_FILES['browse_file']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['browse_file']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['browse_file']['error'];
                $_FILES['userfile']['size']= $_FILES['browse_file']['size'];    
                
                $_FILES['userfile']['name'] = $image = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
                
                if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }


                $this->db->select('id');
                $this->db->from('tbl_documents');
                $this->db->where('enquiry_id',$enq_id);
                $this->db->where('doc_type',$doc_type);
                $this->db->where('doc_stream',$stream_name);
                $this->db->where('doc_file',$file_name);
                $exist= $this->db->get()->row();

if(empty($exist->id)){

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'enquiry_id'   => $enq_id,
                'doc_type'   => $doc_type,
                'doc_stream'   => $stream_name,
                'doc_file' => $file_name,
                'd_remark' => $d_remark,
                'browse_file'   => $image,
                'status'   => '0',
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->document_all_add($data);
            $comment_id = $this->Leads_Model->add_comment_for_events('Document details has been added', $enq_id);
               $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Document Details';
$stage_remark = 'Document Details Created.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}
}else{

    $this->db->set('browse_file',$image);
    $this->db->set('d_remark',$d_remark);
    $this->db->where('id',$exist->id);
    $this->db->update('tbl_documents');

    $comment_id = $this->Leads_Model->add_comment_for_events('Document details has been update', $enq_id);
               $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Document Details';
$stage_remark = 'Document Details Updated.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

}
echo '1';
            }else{
                echo '0';
            }
            
        }
    }

public function client_document_checklist() {
        if (!empty($_POST)) {    
        $s_no = $this->input->post('sn');
        $doc_id = $this->input->post('doc');
        $enq_no = $this->input->post('enq_no');
        $check = $this->input->post('check');
        
        $this->db->select('id');
        $this->db->from('tbl_doccheklist');
        $this->db->where('document_type',$doc_id);
        $this->db->where('enq_no',$enq_no);
        $q= $this->db->get()->row();

            if(empty($q->id)){           

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'enq_no'   => $enq_no,
                'document_type'   => $doc_id,
                'checklist'   => $check,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->document_add_checklist($data);

$this->db->select('Enquery_id,aasign_to,phone,email');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
$enq_id=$q->Enquery_id;
$aasign_to_id=$q->aasign_to;
$comment_id = $this->Leads_Model->add_comment_for_events('Document details has been added', $enq_id);
               $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Document Details';
$stage_remark = 'Document Details Created.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}
echo '1';
            }else{

                $this->db->set('checklist',$check);
                $this->db->where('id',$q->id);
                $this->db->update('tbl_doccheklist');

echo '0';
            }
            
        }
    }

public function client_document_required() {
        if (!empty($_POST)) {    
        $s_no = $this->input->post('sn');
        $doc_id = $this->input->post('doc');
        $enq_no = $this->input->post('enq_no');
        $check = $this->input->post('check');
        
        $this->db->select('id');
        $this->db->from('tbl_doccheklist');
        $this->db->where('document_type',$doc_id);
        $this->db->where('enq_no',$enq_no);
        $q= $this->db->get()->row();

            if(empty($q->id)){           

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'enq_no'   => $enq_no,
                'document_type'   => $doc_id,
                'required'   => $check,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->document_add_checklist($data);
echo '1';
            }else{

                $this->db->set('required',$check);
                $this->db->where('id',$q->id);
                $this->db->update('tbl_doccheklist');

echo '0';
            }
            
        }
    }

public function client_document_edit() {
        if (!empty($_POST)) {    
        $s_no = $this->input->post('sn');
        $doc_id = $this->input->post('doc');
        $enq_no = $this->input->post('enq_no');
        $check = $this->input->post('check');

$this->db->select('Enquery_id,aasign_to,phone,email');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
$enq_id=$q->Enquery_id;
$aasign_to_id=$q->aasign_to;
        
        $this->db->select('id');
        $this->db->from('tbl_documents');
        $this->db->where('doc_file',$doc_id);
        $this->db->where('enquiry_id',$enq_id);
        $q1= $this->db->get()->row();
        if(!empty($q1->id)){  
                $this->db->set('edit_access',$check);
                $this->db->where('id',$q1->id);
                $this->db->update('tbl_documents');

$comment_id = $this->Leads_Model->add_comment_for_events('Document details has been edit', $enq_id);
               $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Document Edit Details';
$stage_remark = 'Document Edit Details Created.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

echo '1';
            }else{
                echo '0';
            }
            
        }
    }

public function client_document_approve() {
        if (!empty($_POST)) {    
        $s_no = $this->input->post('sn');
        $doc_id = $this->input->post('doc');
        $enq_no = $this->input->post('enq_no');
        $check = $this->input->post('check');

$this->db->select('Enquery_id,aasign_to,phone,email');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
$enq_id=$q->Enquery_id;
$aasign_to_id=$q->aasign_to;
        
        $this->db->select('id');
        $this->db->from('tbl_documents');
        $this->db->where('doc_file',$doc_id);
        $this->db->where('enquiry_id',$enq_id);
        $q1= $this->db->get()->row();
        if(!empty($q1->id)){  
                $this->db->set('status',$check);
                $this->db->where('id',$q1->id);
                $this->db->update('tbl_documents');

$comment_id = $this->Leads_Model->add_comment_for_events('Document details has been approved', $enq_id);
               $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Document Approved Details';
$stage_remark = 'Document Approved Details Created.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

echo '1';
            }else{
                echo '0';
            }
            
        }
    }

    public function client_document_edit_right($edit_id,$enq_no = null,$keyword = null)
    {

    $this->db->select('edit_access');
    $this->db->from('tbl_documents');
    $this->db->where('id',$edit_id);
    $qq= $this->db->get()->row();
    if($qq->edit_access==1){
        $edit_status = '0';
        $msg = 'Document details edit access has been hide';
    }else{
       $edit_status = '1';
       $msg = 'Document details edit access has been allow'; 
    }
    

    $this->db->set('edit_access',$edit_status);
    $this->db->where('id',$edit_id);
    $this->db->update('tbl_documents');

    $this->db->select('Enquery_id,aasign_to,phone,email');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enq_no);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $comment_id = $this->Leads_Model->add_comment_for_events($msg, $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Document Details';
$stage_remark = 'Dear Applicant '.$msg.'.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('document'));
            }else if($keyword=='lead'){
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('document'));
            }else if($keyword=='client'){
                redirect('client/view/'.$enq_no.'/'.base64_encode('document'));
            }else{
                redirect('refund/view/'.$enq_no.'/'.base64_encode('document'));
            }
    }else{
    $this->session->set_flashdata('SUCCESSMSG', 'Client Family Update Successfully');
    redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('document'));
    }
    }

public function client_document_delete($del_id,$enq_no = null,$keyword = null){       
        $this->db->where('id',$del_id);
        $query = $this->db->delete('tbl_documents');

        $this->db->select('Enquery_id,aasign_to,phone,email');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enq_no);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $aasign_to_id=$q->aasign_to;
        $comment_id = $this->Leads_Model->add_comment_for_events('Document details has been deleted', $enq_id);

                    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Document Details';
$stage_remark = 'Document Details Deleted.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

        if(!in_array($this->session->userdata('user_right'), applicant)){
        if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('document'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('document'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('document'));
            }else{
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('document'));
            }
        }else{
        redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('document'));
        }
        }

        public function client_document_approved($del_id,$enq_no = null,$keyword = null){       
        $this->db->set('status','1');
        $this->db->where('id',$del_id);
        $this->db->update('tbl_documents');

        $this->db->select('Enquery_id,aasign_to,phone,email');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enq_no);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $aasign_to_id=$q->aasign_to;
        $comment_id = $this->Leads_Model->add_comment_for_events('Document details has been approved', $enq_id);

            $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Document Details';
$stage_remark = 'Document Details Approved.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

        if(!in_array($this->session->userdata('user_right'), applicant)){
        if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Approved successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('document'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Approved successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('document'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Approved successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('document'));
            }else{
                $this->session->set_flashdata('message', 'Approved successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('document'));
            }
        }else{
        redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('document'));
        }
        }
        
public function client_document_update($enq_no = null,$keyword = null)
    {  
    if(!empty($_POST)){
        
        if(!empty($_FILES['browse_file']['name'])){         
        $this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['browse_file']['name'];
                $_FILES['userfile']['type']= $_FILES['browse_file']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['browse_file']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['browse_file']['error'];
                $_FILES['userfile']['size']= $_FILES['browse_file']['size'];    
                
                $_FILES['userfile']['name'] = $image = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
                
                if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }
        }else{
            $image=$this->input->post('browse_file_old', true);
        }
        
    $tmpid = $this->input->post('doc_id');
    $doc_type = $this->input->post('doc_type');
    $stream_name = $this->input->post('stream_name');
    $file_name = $this->input->post('file_name');
    $d_remark = $this->input->post('d_remark');
    $this->db->set('doc_type',$doc_type);
    $this->db->set('doc_stream',$stream_name);
    $this->db->set('doc_file',$file_name);
    $this->db->set('browse_file',$image);
    $this->db->set('d_remark',$d_remark);
    $this->db->where('id',$tmpid);
    $this->db->update('tbl_documents');

    $this->db->select('Enquery_id,aasign_to,phone,email');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enq_no);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $aasign_to_id=$q->aasign_to;
        $comment_id = $this->Leads_Model->add_comment_for_events('Document details has been updated', $enq_id);

            $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Document Details';
$stage_remark = 'Document Details Updated.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
        if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Update successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('document'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Update successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('document'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Update successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('document'));
            }else{
                $this->session->set_flashdata('message', 'Update successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('document'));
            }
        }else{
        redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('document'));
        }
    }
    }
#-------------------------------------------------document tab View start End--------------------------------------------#
#-------------------------------------------------Family tab View start--------------------------------------------#
    public function client_family_save($enq_no='',$keyword = null) {
        if (!empty($_POST)) {

        $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
            $all_assign=$q->all_assign;

            $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

            $family_name = $this->input->post('family_name');
            $family_relation = $this->input->post('family_relation');
            $family_mobile = $this->input->post('family_mobile');
            $family_email = $this->input->post('family_email');
            $family_age = $this->input->post('family_age');
            $family_remark = $this->input->post('f_remark');
            if(!empty($family_name)){         
            foreach($family_name as $key=>$value){  

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'enquiry_id'   => $enq_id,
                'f_member_name'   => $value,
                'f_relation'   => $family_relation[$key],
                'f_mobile' => $family_mobile[$key],
                'f_email'   => $family_email[$key],
                'f_age'   => $family_age[$key],
                'f_remark'   => $family_remark[$key],
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->family_all_add($data);
            }
            $comment_id = $this->Leads_Model->add_comment_for_events('Family details has been created', $enq_id);
    $conversation = 'Family Create';
    $stage_remark = 'Family Details Created.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

    if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
    }else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
    }
            }
            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('SUCCESSMSG', 'Family Created Successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('family'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('SUCCESSMSG', 'Family Created Successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('family'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('SUCCESSMSG', 'Family Created Successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('family'));
            }else{
                $this->session->set_flashdata('SUCCESSMSG', 'Family Created Successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('family'));
            }
            }else{
            $this->session->set_flashdata('SUCCESSMSG', 'Family Created Successfully');
            redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('family'));  
            }
        }
    }

public function getfamilyHtml($x)
    {
        $data['daynamic_id'] = $x;
        $html = $this->load->view('add_more/family_add_more',$data,true);
        echo json_encode(array('html'=>$html));
    }

    public function client_family_edit_right($edit_id,$enq_no = null,$keyword = null)
    {

    $this->db->select('edit_access');
    $this->db->from('tbl_family');
    $this->db->where('id',$edit_id);
    $qq= $this->db->get()->row();
    if($qq->edit_access==1){
        $edit_status = '0';
        $msg = 'Family details edit Aaccess has been hide';
    }else{
       $edit_status = '1';
       $msg = 'Family details edit Aaccess has been allow'; 
    }
    

    $this->db->set('edit_access',$edit_status);
    $this->db->where('id',$edit_id);
    $this->db->update('tbl_family');

    $this->db->select('Enquery_id,aasign_to,phone,email');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enq_no);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $comment_id = $this->Leads_Model->add_comment_for_events($msg, $enq_id);

            $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Family Details';
$stage_remark = 'Dear Applicant '.$msg.'.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('family'));
            }else if($keyword=='lead'){
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('family'));
            }else if($keyword=='client'){
                redirect('client/view/'.$enq_no.'/'.base64_encode('family'));
            }else{
                redirect('refund/view/'.$enq_no.'/'.base64_encode('family'));
            }
    }else{
    $this->session->set_flashdata('SUCCESSMSG', 'Client Family Update Successfully');
    redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('family'));
    }
    }

public function client_url_visible($edit_id,$enq_no = null,$keyword = null)
    {

    $this->db->select('visibility');
    $this->db->from('tbl_url');
    $this->db->where('id',$edit_id);
    $qq= $this->db->get()->row();
    if($qq->visibility==1){
        $edit_status = '0';
        $msg = 'Url details visibility accsess has been hide';
    }else{
       $edit_status = '1';
       $msg = 'Url details visibility accsess has been allow'; 
    }
    

    $this->db->set('visibility',$edit_status);
    $this->db->where('id',$edit_id);
    $this->db->update('tbl_url');

    $this->db->select('Enquery_id,aasign_to,phone,email');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enq_no);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $comment_id = $this->Leads_Model->add_comment_for_events($msg, $enq_id);

            $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Url Details';
$stage_remark = 'Dear Applicant '.$msg.'.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('url'));
            }else if($keyword=='lead'){
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('url'));
            }else if($keyword=='client'){
                redirect('client/view/'.$enq_no.'/'.base64_encode('url'));
            }else{
                redirect('refund/view/'.$enq_no.'/'.base64_encode('url'));
            }
    }else{
    $this->session->set_flashdata('SUCCESSMSG', 'Client Family Update Successfully');
    redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('url'));
    }
    }

    public function client_family_delete($del_id,$enq_no = null,$keyword = null){       
        $this->db->where('id',$del_id);
        $query = $this->db->delete('tbl_family');

        $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
            $all_assign=$q->all_assign;
        $comment_id = $this->Leads_Model->add_comment_for_events('Family details has been delete', $enq_id);

                    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Family Delete';
$stage_remark = 'Family Details Deleted.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

        if(!in_array($this->session->userdata('user_right'), applicant)){
        if($keyword=='enquiry'){
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('family'));
            }else if($keyword=='lead'){
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('family'));
            }else if($keyword=='client'){
                redirect('client/view/'.$enq_no.'/'.base64_encode('family'));
            }else{
                redirect('refund/view/'.$enq_no.'/'.base64_encode('family'));
            }
        }else{
        redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('family'));
        }
        }

    public function client_family_update($enq_no = null,$keyword = null)
    {  
    if(!empty($_POST)){        
    $family_name = $this->input->post('family_name');
    $family_relation = $this->input->post('family_relation');
    $family_mobile = $this->input->post('family_mobile');
    $family_email = $this->input->post('family_email');
    $family_age = $this->input->post('family_age');
    $member_id = $this->input->post('member_id');
    $family_remark = $this->input->post('f_remark');
    $this->db->set('f_member_name',$family_name);
    $this->db->set('f_relation',$family_relation);
    $this->db->set('f_mobile',$family_mobile);
    $this->db->set('f_email',$family_email);
    $this->db->set('f_age',$family_age);
    $this->db->set('f_remark',$family_remark);
    $this->db->where('id',$member_id);
    $this->db->update('tbl_family');

    $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enq_no);
    $q= $this->db->get()->row();

    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $all_assign=$q->all_assign;
    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

    $comment_id = $this->Leads_Model->add_comment_for_events('Family details has been updated', $enq_id);
$conversation = 'Family Update';
$stage_remark = 'Family Details Upadated.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('family'));
            }else if($keyword=='lead'){
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('family'));
            }else if($keyword=='client'){
                redirect('client/view/'.$enq_no.'/'.base64_encode('family'));
            }else{
                redirect('refund/view/'.$enq_no.'/'.base64_encode('family'));
            }
    }else{
    $this->session->set_flashdata('SUCCESSMSG', 'Client Family Update Successfully');
    redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('family'));
    }
    }
    }
#-------------------------------------------------Family tab View End--------------------------------------------#
#-------------------------------------------------qualification tab View Start--------------------------------------------#
    public function getqualificationHtml($x)
    {
        $data['daynamic_id'] = $x;
        $data['all_qualification_test'] = $this->Leads_Model->get_test_list();
        $html = $this->load->view('add_more/qalification_add_more',$data,true);
        echo json_encode(array('html'=>$html));
    }

    public function member_qualification_save($enq_no='',$keyword = null) {
        if (!empty($_POST)) {

        $this->db->select('Enquery_id,name,lastname,aasign_to,phone,email,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
            $all_assign=$q->all_assign;
            $test_person = $this->input->post('test_person');
            if($test_person=='self'){
            $person_name = $q->name.' '.$q->lastname;
            }else{
             $person_name = $this->input->post('test_person');   
            }
            $language_test = $this->input->post('language_test');
            $speaking = $this->input->post('speaking');
            $reading = $this->input->post('reading');
            $writing = $this->input->post('writing');
            $listening = $this->input->post('listening');
            $doe = $this->input->post('doe');
            $q_remark = $this->input->post('q_remark');
            if(!empty($language_test)){         
            foreach($language_test as $key=>$value){  

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'enquiry_id'   => $enq_id,
                'q_member_name'   => $person_name,
                'q_test'   => $value,
                'q_speaking' => $speaking[$key],
                'q_reading'   => $reading[$key],
                'q_writing'   => $writing[$key],
                'q_listening'   => $listening[$key],
                'q_doe'   => $doe[$key],
                'q_remark'   => $q_remark[$key],
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->qualification_all_add($data);
            }
            $comment_id = $this->Leads_Model->add_comment_for_events('Qalification details has been created', $enq_id);
            $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Qalification Details';
$stage_remark = 'Qalification Details Created.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent 

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}
            }
            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('qalification'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('qalification'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('qalification'));
            }else{
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('qalification'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('qalification'));
            }
        }
    }

    public function member_qualification_update($enquiry_id = null,$keyword = null)
    {  
    if(!empty($_POST)){        
    $language_test = $this->input->post('language_test');
    $speaking = $this->input->post('speaking');
    $reading = $this->input->post('reading');
    $writing = $this->input->post('writing');
    $listening = $this->input->post('listening');
    $doe = $this->input->post('doe');
    $q_member_id = $this->input->post('q_member_id');
    $q_remark = $this->input->post('q_remark');
    $this->db->set('q_test',$language_test);
    $this->db->set('q_speaking',$speaking);
    $this->db->set('q_reading',$reading);
    $this->db->set('q_writing',$writing);
    $this->db->set('q_listening',$listening);
    $this->db->set('q_doe',$doe);
    $this->db->set('q_remark',$q_remark);
    $this->db->where('id',$q_member_id);
    $this->db->update('tbl_qualification');

    $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enquiry_id);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $all_assign=$q->all_assign;
    $comment_id = $this->Leads_Model->add_comment_for_events('Qalification details has been Updated', $enq_id);
              $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Qalification Details';
$stage_remark = 'Qalification Details Updated.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('qalification'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('qalification'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('qalification'));
            }else{
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('qalification'));
            }
    }else{
    redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('qalification'));
    }
    }
    }

    public function member_qualification_edit_right($edit_id,$enq_no = null,$keyword = null)
    {

    $this->db->select('edit_access');
    $this->db->from('tbl_qualification');
    $this->db->where('id',$edit_id);
    $qq= $this->db->get()->row();
    if($qq->edit_access==1){
        $edit_status = '0';
        $msg = 'Qalification details edit access has been hide';
    }else{
       $edit_status = '1';
       $msg = 'Qalification details edit access has been allow'; 
    }
    

    $this->db->set('edit_access',$edit_status);
    $this->db->where('id',$edit_id);
    $this->db->update('tbl_qualification');

    $this->db->select('Enquery_id,aasign_to,phone,email');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enq_no);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $comment_id = $this->Leads_Model->add_comment_for_events($msg, $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Qalification Details';
$stage_remark = 'Dear Applicant '.$msg.'.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('qalification'));
            }else if($keyword=='lead'){
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('qalification'));
            }else if($keyword=='client'){
                redirect('client/view/'.$enq_no.'/'.base64_encode('qalification'));
            }else{
                redirect('refund/view/'.$enq_no.'/'.base64_encode('qalification'));
            }
    }else{
    $this->session->set_flashdata('SUCCESSMSG', 'Client Qalification Update Successfully');
    redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('qalification'));
    }
    }

    public function member_qualification_delete($del_id,$enquiry_id = null,$keyword = null){       
        $this->db->where('id',$del_id);
        $query = $this->db->delete('tbl_qualification');

        $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enquiry_id);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $aasign_to_id=$q->aasign_to;
        $all_assign=$q->all_assign;
        $comment_id = $this->Leads_Model->add_comment_for_events('Qalification details has been deleted', $enq_id);

                    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Qalification Details';
$stage_remark = 'Qalification Details Deleted.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

        if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('qalification'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('qalification'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('qalification'));
            }else{
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('qalification'));
            }
        }else{
        redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('qalification'));
        }
        }
#-------------------------------------------------qualification tab View End--------------------------------------------#
#-------------------------------------------------Job tab View Start--------------------------------------------#
    public function getjobHtml($x)
    {
        $data['daynamic_id'] = $x;
        $html = $this->load->view('add_more/job_add_more',$data,true);
        echo json_encode(array('html'=>$html));
    }

    public function member_job_save($enq_no='',$keyword = null) {
        if (!empty($_POST)) {

        $this->db->select('Enquery_id,name,lastname,aasign_to,phone,email,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
            $all_assign=$q->all_assign;

            $job_person = $this->input->post('job_person');
            if($job_person=='self'){
            $person_name = $q->name.' '.$q->lastname;
            }else{
             $person_name = $this->input->post('job_person');   
            }
            
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
            if(!empty($from)){         
            foreach($from as $key=>$value){  

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
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
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->job_all_add($data);
            }
            $comment_id = $this->Leads_Model->add_comment_for_events('Job details has been created', $enq_id);
            $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Job Details';
$stage_remark = 'Job Details Created.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}
            }
            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('jobdetail'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('jobdetail'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('jobdetail'));
            }else{
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('jobdetail'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('jobdetail'));
            }
        }
    }

    public function member_job_update($enquiry_id = null,$keyword = null)
    {  
    if(!empty($_POST)){        
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

    $j_member_id = $this->input->post('j_member_id');
 
    $this->db->set('j_from',$from);
    $this->db->set('j_to',$to);
    $this->db->set('still_work',$still_work);
    $this->db->set('j_designation',$designation);
    $this->db->set('j_company',$company);
    $this->db->set('j_duration',$duration);
    $this->db->set('jy_duration',$jy_duration);
    $this->db->set('jm_duration',$jm_duration);
    $this->db->set('j_relevant',$relevant);
    $this->db->set('j_remark',$j_remark);
    $this->db->where('id',$j_member_id);
    $this->db->update('tbl_job_details');

    $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enquiry_id);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $all_assign=$q->all_assign;
    $comment_id = $this->Leads_Model->add_comment_for_events('Job details has been updated', $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Job Details';
$stage_remark = 'Job Details Updated.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('jobdetail'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('jobdetail'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('jobdetail'));
            }else{
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('jobdetail'));
            }
    }else{
    redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('jobdetail'));
    }
    }
    }

    public function member_job_edit_right($edit_id,$enq_no = null,$keyword = null)
    {

    $this->db->select('edit_access');
    $this->db->from('tbl_job_details');
    $this->db->where('id',$edit_id);
    $qq= $this->db->get()->row();
    if($qq->edit_access==1){
        $edit_status = '0';
        $msg = 'Job details edit access has been hide';
    }else{
       $edit_status = '1';
       $msg = 'Job details edit access has been allow'; 
    }
    

    $this->db->set('edit_access',$edit_status);
    $this->db->where('id',$edit_id);
    $this->db->update('tbl_job_details');

    $this->db->select('Enquery_id,aasign_to,phone,email');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enq_no);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $comment_id = $this->Leads_Model->add_comment_for_events($msg, $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Job Details';
$stage_remark = 'Dear Applicant '.$msg.'.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('jobdetail'));
            }else if($keyword=='lead'){
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('jobdetail'));
            }else if($keyword=='client'){
                redirect('client/view/'.$enq_no.'/'.base64_encode('jobdetail'));
            }else{
                redirect('refund/view/'.$enq_no.'/'.base64_encode('jobdetail'));
            }
    }else{
    $this->session->set_flashdata('SUCCESSMSG', 'Client Job Update Successfully');
    redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('jobdetail'));
    }
    }

    public function member_job_delete($del_id,$enquiry_id = null,$keyword = null){       
        $this->db->where('id',$del_id);
        $query = $this->db->delete('tbl_job_details');

        $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enquiry_id);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $aasign_to_id=$q->aasign_to;
        $all_assign=$q->all_assign;
        $comment_id = $this->Leads_Model->add_comment_for_events('Job detail has been deleted', $enq_id);

                    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Job Details';
$stage_remark = 'Job Details Deleted.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

        if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('jobdetail'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('jobdetail'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('jobdetail'));
            }else{
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('jobdetail'));
            }
        }else{
        redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('jobdetail'));
        }
        }
#-------------------------------------------------Job tab View End--------------------------------------------#

#-------------------------------------------------Experiance tab View Start--------------------------------------------#

    public function member_exp_save($enq_no='',$keyword = null) {
        if (!empty($_POST)) {

        $this->db->select('Enquery_id,name,lastname,aasign_to,phone,email,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
            $all_assign=$q->all_assign;

            $exp_person = $this->input->post('exp_person');
            if($exp_person=='self'){
            $person_name = $q->name.' '.$q->lastname;
            }else{
             $person_name = $this->input->post('exp_person');   
            }
            
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
            if(!empty($total_experience)){         
            foreach($total_experience as $key=>$value){  

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
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
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->Leads_Model->exp_all_add($data);
            }
            $comment_id = $this->Leads_Model->add_comment_for_events('Experience details has been created', $enq_id);

                    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Experience Details';
$stage_remark = 'Experience Details Created.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}
            }
            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('experience'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('experience'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('experience'));
            }else{
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('experience'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('experience'));
            }
        }
    }

    public function member_exp_edit_right($edit_id,$enq_no = null,$keyword = null)
    {

    $this->db->select('edit_access');
    $this->db->from('tbl_experience_details');
    $this->db->where('id',$edit_id);
    $qq= $this->db->get()->row();
    if($qq->edit_access==1){
        $edit_status = '0';
        $msg = 'Experience details edit access has been hide';
    }else{
       $edit_status = '1';
       $msg = 'Experience details edit access has been allow'; 
    }
    

    $this->db->set('edit_access',$edit_status);
    $this->db->where('id',$edit_id);
    $this->db->update('tbl_experience_details');

    $this->db->select('Enquery_id,aasign_to,phone,email');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enq_no);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $comment_id = $this->Leads_Model->add_comment_for_events($msg, $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Experience Details';
$stage_remark = 'Dear Applicant '.$msg.'.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('experience'));
            }else if($keyword=='lead'){
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('experience'));
            }else if($keyword=='client'){
                redirect('client/view/'.$enq_no.'/'.base64_encode('experience'));
            }else{
                redirect('refund/view/'.$enq_no.'/'.base64_encode('experience'));
            }
    }else{
    $this->session->set_flashdata('SUCCESSMSG', 'Client Experience Update Successfully');
    redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('experience'));
    }
    }

    public function member_exp_delete($del_id,$enquiry_id = null,$keyword = null){       
        $this->db->where('id',$del_id);
        $query = $this->db->delete('tbl_experience_details');

        $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enquiry_id);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $aasign_to_id=$q->aasign_to;
        $all_assign=$q->all_assign;
        $comment_id = $this->Leads_Model->add_comment_for_events('Experience detail has been deleted', $enq_id);

                    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Experience Details';
$stage_remark = 'Experience Details deleted.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

        if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('experience'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('experience'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('experience'));
            }else{
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('experience'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('experience'));
            }
        }

    public function member_exp_update($enquiry_id = null,$keyword = null)
    {  
    if(!empty($_POST)){        
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

    $e_member_id = $this->input->post('e_member_id');
 
    $this->db->set('total_experience',$total_experience);
    $this->db->set('relevant_experience',$relevant_experience);
    $this->db->set('tax_payer',$tax_payer);
    $this->db->set('whole_eperience',$whole_eperience);
    $this->db->set('return_filed',$return_filed);
    $this->db->set('professional_tax',$professional_tax);
    $this->db->set('insurance_benefit',$insurance_benefit);
    $this->db->set('any_contribution',$any_contribution);
    $this->db->set('payment_mode',$payment_mode);
    $this->db->set('ex_remark',$ex_remark);
    $this->db->where('id',$e_member_id);
    $this->db->update('tbl_experience_details');

    $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enquiry_id);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $aasign_to_id=$q->aasign_to;
        $all_assign=$q->all_assign;
        $comment_id = $this->Leads_Model->add_comment_for_events('Experience details has been updated', $enq_id);

                    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Experience Details';
$stage_remark = 'Experience Details Updated.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('experience'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('experience'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('experience'));
            }else{
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('experience'));
            }
            }else{
                redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('experience'));
            }
    }
    }

    public function getexpHtml($x,$id)
    {
        $member = base64_decode($x);
        $enq_no = base64_decode($id);
if($member=='self'){
        $this->db->select('name,lastname');
        $this->db->from('enquiry');
        $this->db->where('Enquery_id',$enq_no);
        $q= $this->db->get()->row();
        $enq_name=$q->name.' '.$q->lastname;
}else{
    $enq_name = $member; 
}
        $this->db->select('sum(total_experience) as experience,sum(relevant_experience) as relevant');
        $this->db->where('e_member_name',$enq_name);
        $query = $this->db->get('tbl_experience_details');
        $result = $query->result();
        //print_r($result['0']->relevant);exit();
        echo json_encode(array('experience'=>$result['0']->experience,'relevant'=>$result['0']->relevant));
    }

#-------------------------------------------------Experiance tab View End--------------------------------------------#
    #-------------------------------------------------refund tab View Start--------------------------------------------#

    public function member_refund_save($enq_no='',$keyword = null) {
        if (!empty($_POST)) {

        $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
            $enq_id=$q->Enquery_id;
            $aasign_to_id=$q->aasign_to;
            $all_assign=$q->all_assign;
            
            if(!in_array($this->session->userdata('user_right'), applicant)){
                $updated_by = $this->session->userdata('user_id');
            }else{
                $created_by = $this->session->userdata('user_id');
            }

            if(!empty($_FILES['provide_proof']['name'])){         
        $this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['provide_proof']['name'];
                $_FILES['userfile']['type']= $_FILES['provide_proof']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['provide_proof']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['provide_proof']['error'];
                $_FILES['userfile']['size']= $_FILES['provide_proof']['size'];    
                
                $_FILES['userfile']['name'] = $image = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
                
                if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }
        }else{
            $image=$this->input->post('provide_proof_old', true);
        }

        if(!empty($_FILES['signature']['name'])){         
        $this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['signature']['name'];
                $_FILES['userfile']['type']= $_FILES['signature']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['signature']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['signature']['error'];
                $_FILES['userfile']['size']= $_FILES['signature']['size'];    
                
                $_FILES['userfile']['name'] = $image1 = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path1= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image1;
                                                 $ret1 = move_uploaded_file($_FILES['userfile']['tmp_name'],$path1);
                
                if($ret1)
                {
                    $rt1 = $this->aws->uploadinfolder($this->session->awsfolder,$path1);

                    if($rt1 == true)
                    {
                        unlink($path1); 
                    }
                }
        }else{
            $image1=$this->input->post('signature_old', true);
        } 

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'enquiry_id'   => $enq_id,
                'pr_awarness'   => $this->input->post('pr_awarness'),
                'consultant_name'   => $this->input->post('consultant_name'),
                'explaine_benifit'   => $this->input->post('explaine_benifit'),
                'cancellation_date'   => $this->input->post('cancellation_date'),
                'cancellation_person' => $this->input->post('cancellation_person'),
                'language_score'   => $this->input->post('language_score'),
                'medical_reason'   => $this->input->post('medical_reason'),
                'provide_proof'   => $image,
                'other_options'   => $this->input->post('other_options'),
                'proceed_further'   => $this->input->post('proceed_further'),
                'refund_eligiblity'   => $this->input->post('refund_eligiblity'),
                'signature'   => $image1,
                'place'   => $this->input->post('place'),
                'approve_date'   => $this->input->post('approve_date'),
                'r_remark'   => $this->input->post('r_remark'),
                'created_by' => $created_by,
                'updated_by' => $updated_by
            );

            $insert_id = $this->Leads_Model->refund_all_add($data);

            $comment_id = $this->Leads_Model->add_comment_for_events('Refund details has been created', $enq_id);

                        $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Refund Details';
$stage_remark = 'Refund Details Created.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('refund'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('refund'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('refund'));
            }else{
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('refund/view/'.$enq_no.'/'.base64_encode('refund'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('refund'));
            }
        }
    }

    public function member_refund_update($enquiry_id = null,$keyword = null)
    {  
    if(!empty($_POST)){
    if(!in_array($this->session->userdata('user_right'), applicant)){
        $updated_by = $this->session->userdata('user_id');
    }else{
        $created_by = $this->session->userdata('user_id');
    }        
    if(!empty($_FILES['provide_proof']['name'])){         
        $this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['provide_proof']['name'];
                $_FILES['userfile']['type']= $_FILES['provide_proof']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['provide_proof']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['provide_proof']['error'];
                $_FILES['userfile']['size']= $_FILES['provide_proof']['size'];    
                
                $_FILES['userfile']['name'] = $image = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
                
                if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }
        }else{
            $image=$this->input->post('provide_proof_old', true);
        }

        if(!empty($_FILES['signature']['name'])){         
        $this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['signature']['name'];
                $_FILES['userfile']['type']= $_FILES['signature']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['signature']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['signature']['error'];
                $_FILES['userfile']['size']= $_FILES['signature']['size'];    
                
                $_FILES['userfile']['name'] = $image1 = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path1= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image1;
                                                 $ret1 = move_uploaded_file($_FILES['userfile']['tmp_name'],$path1);
                
                if($ret1)
                {
                    $rt1 = $this->aws->uploadinfolder($this->session->awsfolder,$path1);

                    if($rt1 == true)
                    {
                        unlink($path1); 
                    }
                }
        }else{
            $image1=$this->input->post('signature_old', true);
        }

        $r_member_id = $this->input->post('r_member_id');
 
    $this->db->set('pr_awarness',$this->input->post('pr_awarness'));
    $this->db->set('consultant_name',$this->input->post('consultant_name'));
    $this->db->set('explaine_benifit',$this->input->post('explaine_benifit'));
    $this->db->set('cancellation_date',$this->input->post('cancellation_date'));
    $this->db->set('cancellation_person',$this->input->post('cancellation_person'));
    $this->db->set('language_score',$this->input->post('language_score'));
    $this->db->set('medical_reason',$this->input->post('medical_reason'));
    $this->db->set('provide_proof',$image);
    $this->db->set('other_options',$this->input->post('other_options'));
    $this->db->set('proceed_further',$this->input->post('proceed_further'));
    $this->db->set('refund_eligiblity',$this->input->post('refund_eligiblity'));
    $this->db->set('signature',$image1);
    $this->db->set('place',$this->input->post('place'));
    $this->db->set('approve_date',$this->input->post('approve_date'));
    $this->db->set('created_by',$created_by);
    $this->db->set('updated_by',$updated_by);
    $this->db->set('r_remark',$this->input->post('r_remark'));
    $this->db->where('id',$r_member_id);
    $this->db->update('tbl_refund');

    $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enquiry_id);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $all_assign=$q->all_assign;
    $comment_id = $this->Leads_Model->add_comment_for_events('Refund details has been updated', $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Refund Details';
$stage_remark = 'Refund Details Updated.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('refund'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('refund'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('refund'));
            }else{
                $this->session->set_flashdata('message', 'Updated successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('refund'));
            }
            }else{
                redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('refund'));
            }
    }
    }

    public function member_refund_edit_right($edit_id,$enq_no = null,$keyword = null)
    {

    $this->db->select('edit_access');
    $this->db->from('tbl_refund');
    $this->db->where('id',$edit_id);
    $qq= $this->db->get()->row();
    if($qq->edit_access==1){
        $edit_status = '0';
        $msg = 'Refund detail edit access has been hide';
    }else{
       $edit_status = '1';
       $msg = 'Refund detail edit access has been allow'; 
    }
    

    $this->db->set('edit_access',$edit_status);
    $this->db->where('id',$edit_id);
    $this->db->update('tbl_refund');

    $this->db->select('Enquery_id,aasign_to,phone,email');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enq_no);
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $aasign_to_id=$q->aasign_to;
    $comment_id = $this->Leads_Model->add_comment_for_events($msg, $enq_id);

                $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Refund Details';
$stage_remark = 'Dear Applicant '.$msg.'.If already notify about that please ignore.';
if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

    if(!in_array($this->session->userdata('user_right'), applicant)){
    if($keyword=='enquiry'){
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('refund'));
            }else if($keyword=='lead'){
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('refund'));
            }else if($keyword=='client'){
                redirect('client/view/'.$enq_no.'/'.base64_encode('refund'));
            }else{
                redirect('refund/view/'.$enq_no.'/'.base64_encode('refund'));
            }
    }else{
    $this->session->set_flashdata('SUCCESSMSG', 'Client Refund Update Successfully');
    redirect('dashboard/user_profile/'.$enq_no.'/'.base64_encode('refund'));
    }
    }

    public function member_refund_delete($del_id,$enquiry_id = null,$keyword = null){       
        $this->db->where('id',$del_id);
        $query = $this->db->delete('tbl_refund');

        $this->db->select('Enquery_id,aasign_to,phone,email,all_assign');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enquiry_id);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $aasign_to_id=$q->aasign_to;
        $all_assign=$q->all_assign;
        $comment_id = $this->Leads_Model->add_comment_for_events('Refund details has been deleted', $enq_id);

                    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
            $id_for_bell_noti=$stuid->pk_i_admin_id;

$conversation = 'Refund Details';
$stage_remark = 'Refund Details Deleted.If already notify about that please ignore.';

//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end

if(in_array($this->session->userdata('user_right'), applicant)){
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$aasign_to_id,$conversation,$stage_remark);
}else{
    $notification_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark); 
}

        if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('refund'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('refund'));
            }else if($keyword=='client'){
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('refund'));
            }else{
                $this->session->set_flashdata('message', 'Delete successfully');
                redirect('refund/view/'.$enquiry_id.'/'.base64_encode('refund'));
            }
            }else{
            redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('refund'));
            }
        }

#-------------------------------------------------Refund tab View End--------------------------------------------#
    public function get_payment_notification(){
        $pid = base64_decode($this->input->post('kwd'));
    if($pid!=''){
        $this->db->select('Enquery_id,name_prefix,name,lastname,lead_stage');
        $this->db->where('phone',$pid);
        $enq_id    =   $this->db->get('enquiry')->row_array();

        $today = date('Y-m-d');
        $this->db->select('id,pay_amt,pay_date');
        $this->db->where('enq_id',$enq_id['Enquery_id']);
        $this->db->where('from_date <=', $today);
        $this->db->where('to_date >=', $today);
        $this->db->where('noti_status!=', '1');
        $ins_id    =   $this->db->get('tbl_installment')->row_array();

        $this->db->select('id,pay_amt,pay_date');
        $this->db->where('enq_id',$enq_id['Enquery_id']);
        $this->db->where('reminder_satge', $enq_id['lead_stage']);
        $this->db->where('noti_status!=', '1');
        $ins_id_stage    =   $this->db->get('tbl_installment')->row_array();


    }
    if(!empty($ins_id['id'])){

        $enq_ids = $enq_id['Enquery_id'];
        $related_to = $this->session->user_id;
        $create_by = '';
        $subject = 'Payment Reminder';
        $tempData = $this->apiintegration_Model->get_reminder_templates(4);
        $stage_remark='';
        if($tempData->num_rows()==1){
            $tempData=$tempData->row();
            $stage_remark=$tempData->message;
            $stage_remark = str_replace("@prefix",$enq_id['name_prefix'],$stage_remark);   
            $stage_remark = str_replace("@firstname",$enq_id['name'],$stage_remark);  
            $stage_remark = str_replace("@lastname",$enq_id['lastname'],$stage_remark);  
            $stage_remark = str_replace("@amount",$ins_id['pay_amt'],$stage_remark);  
            $stage_remark = str_replace("@duedate",$ins_id['pay_date'],$stage_remark);  
        }
         $stage_remark = 'Dear '.$enq_id['name_prefix'].'. '.$enq_id['name'].' '.$enq_id['lastname'].', Greetings from Godspeed Immigration. We wish to inform you that an EMI date <b>'.date("d-m-Y", strtotime($ins_id['pay_date'])).'</b> of amount <b>'.$ins_id['pay_amt'].'</b> is Pending. If already notify about that please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
        $task_date = date("d-m-Y");
        $task_time = date("h:i:s");
    $this->User_model->add_comment_for_student_user($enq_ids,$related_to,$subject,$stage_remark,$task_date,$task_time,$create_by);

    $this->db->set('noti_status', '1');
    $this->db->where('id',$ins_id['id']);
    //$this->db->where('Pay_status','1');
    $this->db->update('tbl_installment');

        echo  $stage_remark;

    }else if(!empty($ins_id_stage['id'])){

        $enq_ids = $enq_id['Enquery_id'];
        $related_to = $this->session->user_id;
        $create_by = '';
        $subject = 'Payment Reminder';
        $tempData = $this->apiintegration_Model->get_reminder_templates(4);
        $stage_remark='';
        if($tempData->num_rows()==1){
            $tempData=$tempData->row();
            $stage_remark=$tempData->message;
            $stage_remark = str_replace("@prefix",$enq_id['name_prefix'],$stage_remark);   
            $stage_remark = str_replace("@firstname",$enq_id['name'],$stage_remark);  
            $stage_remark = str_replace("@lastname",$enq_id['lastname'],$stage_remark);  
            $stage_remark = str_replace("@amount",$ins_id_stage['pay_amt'],$stage_remark);  
            $stage_remark = str_replace("@duedate",$ins_id_stage['pay_date'],$stage_remark);  
        }
         $stage_remark = 'Dear '.$enq_id['name_prefix'].'. '.$enq_id['name'].' '.$enq_id['lastname'].', Greetings from Godspeed Immigration. We wish to inform you that an EMI date <b>'.date("d-m-Y", strtotime($ins_id_stage['pay_date'])).'</b> of amount <b>'.$ins_id_stage['pay_amt'].'</b> is Pending. If already notify about that please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
        $task_date = date("d-m-Y");
        $task_time = date("h:i:s");
    $this->User_model->add_comment_for_student_user($enq_ids,$related_to,$subject,$stage_remark,$task_date,$task_time,$create_by);

    $this->db->set('noti_status', '1');
    $this->db->where('id',$ins_id_stage['id']);
    //$this->db->where('Pay_status','1');
    $this->db->update('tbl_installment');

        echo  $stage_remark;
    }
       
    }

    public function tags(){               
        if (!empty($_POST)) {            
            $title = $this->input->post('title');
            $data = array(
                'title' => $title,
                'comp_id' => $this->session->userdata('companey_id'),
                'color' => $this->input->post('color'),
                'visiblity' => $this->input->post('visible'),
                'created_by' => $this->session->user_id,

            );
            $insert_id = $this->db->insert('tags',$data);
            $this->session->set_flashdata('message', 'Tag Added Successfully');
            redirect('lead/tags');
        }
        $data['title'] = 'Tags List';
        $data['tags'] = $this->enquiry_model->get_tags();
        $data['content'] = $this->load->view('tags_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function delete_tag($id){
        $this->db->where('id',$id);
        $this->db->delete('tags');
        $this->session->set_flashdata('message', 'Tag Deleted Successfully');
        redirect('lead/tags');
    }
}