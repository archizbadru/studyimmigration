<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->library('aws');
        $this->load->library('upload');
        $this->lang->load("activitylogmsg","english");;
        
        $this->load->model(
                array('Leads_Model','Client_Model','common_model','enquiry_model', 'dashboard_model', 'Task_Model', 'User_model', 'location_model', 'Message_models','Institute_model','Datasource_model','Taskstatus_model','dash_model','Center_model','SubSource_model','Kyc_model','Education_model','SocialProfile_model','Closefemily_model','form_model','report_model','Configuration_Model','Doctor_model')
                );
/*'dashboard_model', 'Installation_Model', 'Message_models','Institute_model','Datasource_model','Taskstatus_model','Center_model','SubSource_model','Kyc_model','Education_model','SocialProfile_model','Closefemily_model'*/

        if (empty($this->session->user_id)) {
            redirect('login');
        }
    }
    public function index1() {
        $aid = $this->session->userdata('user_id');
        $data['title'] = display('client_list');
        $data['user_list'] = $this->User_model->read();
        $data['clients'] = $this->Client_Model->get_Client_list();

        $data['all_clients'] = $this->Client_Model->all_clients();
        
        $data['all_created_today'] = $this->Client_Model->all_created_today();
        
        $data['all_Updated_today'] = $this->Client_Model->all_Updated_today();
        
        $data['all_Active_clients'] = $this->Client_Model->all_Active_clients();
        
        $data['all_InActive_clients'] = $this->Client_Model->all_InActive_clients();
        
        $data['all_clients_Tickets'] = $this->Client_Model->all_clients_Tickets();
        
        $data['state_list'] = $this->location_model->state_list();
        
        $data['customer_types'] = $this->enquiry_model->customers_types();
       
        
        $data['channel_p_type'] = $this->enquiry_model->channel_partner_type_list();
        
        
        //echo '<pre>';print_r($data);die;
        $data['content'] = $this->load->view('clients', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function index() {
        $this->session->unset_userdata('enquiry_filters_sess');        
        if (user_role('80') == true) {}  
         if(!empty($this->session->enq_type)){
            $this->session->unset_userdata('enq_type',$this->session->enq_type);
        }       
        $this->load->model('Datasource_model');         
        $data['title'] = display('client_list');
        $data['user_list'] = $this->User_model->read2();
        $data['products'] = $this->dash_model->get_user_product_list();        
        $data['drops']      = $this->enquiry_model->get_drop_list();        
        $data['lead_score'] = $this->enquiry_model->get_leadscore_list(); 
        $data['created_bylist'] = $this->User_model->read2();
        $data['sourse'] = $this->report_model->all_source();
        $data['datasourse'] = $this->report_model->all_datasource(); 
        $data['dfields']  = $this->enquiry_model-> getformfield();       
        $data['subsource_list'] = $this->Datasource_model->subsourcelist();     

        $enquiry_separation  = get_sys_parameter('enquiry_separation','COMPANY_SETTING');                  
        if (!empty($enquiry_separation) && !empty($_GET['stage'])) {                    
            $enquiry_separation = json_decode($enquiry_separation,true);
            $stage    =   $_GET['stage'];
            $data['title'] = $enquiry_separation[$stage]['title'];
            $data['data_type'] = $stage;
        }else{
            $data['title'] = 'Case Management List';
            $data['data_type'] = 3;
        }
$type = 3;
        $data['all_stage_lists'] = $this->Leads_Model->find_stage($type);
        $data['all_branch'] = $this->Leads_Model->branch_select();
        $data['all_department'] = $this->Leads_Model->dept_select();
        $data['filterData'] = $this->common_model->get_filterData(1);

        $data['allcountry_list'] = $this->Taskstatus_model->countrylist();
        $data['all_country_list'] = $this->location_model->country();
        $data['visa_type'] = $this->Leads_Model->visa_type_select();
        $data['tags'] = $this->enquiry_model->get_tags();
        
        $data['content'] = $this->load->view('enquiry_n', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function enquery_detals_by_status($id = '') {
        if ($id > 0 and $id <= 20) {
            $serach_key = '';
        } else {
            $serach_key = explode('_', $id);
        }
        $data['title'] = display('enquiry_list');
        $data['user_list'] = $this->User_model->read();
        $data['leadsource'] = $this->Leads_Model->get_leadsource_list();
        $data['lead_score'] = $this->Leads_Model->get_leadscore_list();
        $data['lead_stages'] = $this->Leads_Model->get_leadstage_list();
        
        if ($id == 1) {
            $data['all_clients'] = $this->Client_Model->all_created_today();
        } elseif ($id == 2) {
            
            $data['all_clients'] = $this->Client_Model->all_Updated_today();
            
            /*
            echo "<pre>";

            print_r($data['all_clients']->result_array());
            */


        } elseif ($id == 3) {
            $data['all_clients'] = $this->Client_Model->all_Active_clients();


        } elseif ($id == 4) {
            $data['all_clients'] = $this->Client_Model->all_InActive_clients();
        } elseif ($id == 5) {
            $data['all_clients'] = $this->Client_Model->all_clients_Tickets();
        } elseif ($id == 6) {
            $data['all_clients'] = $this->Client_Model->all_clients();
        } elseif ($id == 7) {
            $data['all_clients'] = $this->Client_Model->checked_enquiry();
        } elseif ($id == 8) {
            $data['all_clients'] = $this->Client_Model->unchecked_enquiry();
        } elseif ($id == 9) {
            $data['all_clients'] = $this->Client_Model->scheduled();
        } elseif ($id == 10) {
            $data['all_clients'] = $this->Client_Model->unscheduled();
        } elseif (!empty($serach_key[1]) == 2) {
            $data['all_clients'] = $this->Client_Model->search_data($serach_key[0]);
        } else {
            $data['all_clients'] = $this->Client_Model->all_creaed_today();
        }
        //echo $this->db->last_query();
        $data['customer_types'] = $this->enquiry_model->customers_types();
        $data['channel_p_type'] = $this->enquiry_model->channel_partner_type_list();
        $data['state_list'] = $this->location_model->state_list();
        $data['drops'] = $this->Leads_Model->get_drop_list();

        $this->load->view('client_list', $data);
        
    }

    public function view($enquiry_id) {

        $this->db->set('untouch', '0');
        $this->db->where('enq_id', $enquiry_id);
        $this->db->where('assign_to', $this->session->user_id);
        $this->db->update('tbl_assign_notification');
        
        $data['details'] = $this->Leads_Model->get_leadListDetailsby_id($enquiry_id);   

        //$data['state_city_list'] = $this->location_model->get_city_by_state_id($data['details']->enquiry_state_id);
        //$data['state_city_list'] = $this->location_model->ecity_list();

        $compid = $this->session->userdata('companey_id');

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
        $data['comment_details'] = $this->Leads_Model->comment_byId($enquiry_code);        
        $user_role    =   $this->session->user_role;
        $data['country_list'] = $this->location_model->productcountry();

        $data['institute_list'] = $this->Institute_model->institutelist_by_country($data['details']->enq_country);
        
        $data['institute_app_status'] = $this->Institute_model->get_institute_app_status();
        
          $data['prod_list'] = $this->Doctor_model->product_list($compid); 
        $data['amc_list'] = $this->Doctor_model->amc_list($compid,$enquiry_id); 

        $data['datasource_list'] = $this->Datasource_model->datasourcelist();
        $data['taskstatus_list'] = $this->Taskstatus_model->taskstatuslist();
        $data['state_list'] = $this->location_model->estate_list();
        $data['city_list'] = $this->location_model->ecity_list();
        $data['product_contry'] = $this->location_model->productcountry();
        $data['get_message'] = $this->Message_models->get_chat($phone_id);
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        //$data['all_estage_lists'] = $this->Leads_Model->find_estage($enquiry_id);
        $data['all_estage_lists'] = $this->Leads_Model->find_estage($data['details']->product_id,3);
        $data['all_cstage_lists'] = $this->Leads_Model->find_cstage($data['details']->product_id,3);
        $data['data_type'] = '3';

        $data['all_installment'] = $this->Leads_Model->installment_select();
        $data['all_gst'] = $this->Leads_Model->gst_select();
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
        //$data['client_aggrement_form'] = $this->location_model->get_client_agg_list($data['details']->Enquery_id);
        $data['all_tempname'] = $this->Leads_Model->agrtemp_name();
        $data['visa_type'] = $this->Leads_Model->visa_type_select();
        $data['visa_class'] = $this->Leads_Model->visa_mapping_select();
        $data['all_template'] = $this->location_model->agrformat_select($data['details']->Enquery_id);
        $data['refund_list'] = $this->location_model->get_refund_list($data['details']->Enquery_id);
        $data['ticket_list'] = $this->location_model->get_ticket_list($data['details']->Enquery_id);       

        $data['institute_data'] = $this->enquiry_model->institute_data($data['details']->Enquery_id);
        $data['dynamic_field']  = $this->enquiry_model->get_dyn_fld($enquiry_id);
        
        $data['tab_list'] = $this->form_model->get_tabs_list($this->session->companey_id,$data['details']->product_id);
        $this->load->helper('custom_form_helper');
        $data['all_description_lists']    =   $this->Leads_Model->find_description($data['details']->product_id,3);
        $data['leadid']     = $data['details']->Enquery_id;
        $data['compid']     =  $data['details']->comp_id;
        $data['ins_list'] = $this->location_model->get_ins_list($data['details']->Enquery_id);
        //$data['aggrement_list'] = $this->location_model->get_agg_list($data['details']->Enquery_id);
        $data['enquiry_id'] = $enquiry_id;
        $this->enquiry_model->make_enquiry_read($data['details']->Enquery_id);
        if ($this->session->companey_id=='67') { 
        $data['qualification_data'] = $this->enquiry_model->quali_data($data['details']->Enquery_id);
        $data['english_data'] = $this->enquiry_model->eng_data($data['details']->Enquery_id);
        }
        if ($this->session->companey_id=='67') { 
            $data['discipline'] = $this->location_model->find_discipline();
            $data['level'] = $this->location_model->find_level();
            $data['length'] = $this->location_model->find_length();
        }
        $data['course_list'] = $this->Leads_Model->get_course_list();

        $enquiry_separation  = get_sys_parameter('enquiry_separation','COMPANY_SETTING');                  
        if (!empty($enquiry_separation) && !empty($_GET['stage'])) {                    
            $enquiry_separation = json_decode($enquiry_separation,true);
            $stage    =   $_GET['stage'];
            $data['title'] = $enquiry_separation[$stage]['title'];            
        }else{
            $data['title'] = display('client');        
        }
        $data['login_user_id'] = $this->user_model->get_user_by_email($data['details']->email);
        if (!empty($data['login_user_id']->pk_i_admin_id)) {
            $data['login_details'] = $this->Leads_Model->logdata_select($data['login_user_id']->pk_i_admin_id);            
        }
        $data['urls_list'] = $this->location_model->get_url_list($data['details']->enq_country);
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

    public function views() {
        $leadid = $this->uri->segment(3);
        $data['details'] = $this->Client_Model->get_clientid_bycustomerCODE($leadid);
        foreach ($data['details'] as $v) {
            $lead_code = $v->cli_id;
            $Enquery_id = $v->Enquery_id;
        }
        redirect('client/view/' . $lead_code . '/' . $Enquery_id);
    }
    public function update_details() {
        $data['title'] = 'Client Details';
        $clientid = $this->uri->segment(3);
        if (!empty($_POST)) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $address = $this->input->post('address');
            $status = $this->input->post('status');
            $updateDate = date('d-m-Y');
            $this->db->set('cl_mobile', $mobile);
            $this->db->set('cl_email', $email);
            $this->db->set('cl_name', $name);
            $this->db->set('address', $address);
            $this->db->set('cl_status', $status);
            $this->db->set('updated_date', $updateDate);
            $this->db->where('cli_id', $clientid);
            $this->db->update('clients');
            $data['clientDetails'] = $this->Client_Model->clientdetail_by_id($clientid);
            $enquiry_code = $data['clientDetails']->Enquery_id;
            $this->Leads_Model->add_comment_for_events($this->lang->line("information_updated"), $enquiry_code);
            $this->session->set_flashdata('message', 'Informanation Updated Successfully');
            redirect('client/view/' . $clientid);
        }
    }

    public function create_newcontact() {
        $clientid = $this->uri->segment(3);
        if (!empty($_POST)) {
            $name = $this->input->post('name');
            $mobile = $this->input->post('mobileno');
            $email = $this->input->post('email');
            $otherdetails = $this->input->post('otherdetails');
            $data = array(
                'client_id' => $this->uri->segment(3),
                'c_name' => $name,
                'emailid' => $email,
                'contact_number' => $mobile,
                'designation' => $this->input->post('designation'),
                'other_detail' => $otherdetails
            );
           // $clientDetails = $this->Client_Model->clientdetail_by_id($clientid);
            $enquiry_code = $this->uri->segment(4);
            $this->Leads_Model->add_comment_for_events($this->lang->line("new_contact_detail_added") , $enquiry_code);
            $insert_id = $this->Client_Model->clientContact($data);
            $this->session->set_flashdata('message', 'Case Management Contact Add Successfully');
            redirect($this->agent->referrer());
        }
    }

    public function create_Invoice() {
        $clientid = $this->uri->segment(3);
        if (!empty($_POST)) {
            $name = $this->input->post('name');
            $mobile = $this->input->post('mobileno');
            $email = $this->input->post('email');
            $otherdetails = $this->input->post('otherdetails');
            $data = array(
                'client_id' => $this->uri->segment(3),
                'c_name' => $name,
                'emailid' => $email,
                'contact_number' => $mobile,
                'designation' => $this->input->post('designation'),
                'other_detail' => $otherdetails
            );
            $clientDetails = $this->Client_Model->clientdetail_by_id($clientid);
            $enquiry_code = $clientDetails->Enquery_id;
            $this->Leads_Model->add_comment_for_events($this->lang->line("new_contact_detail_added") , $enquiry_code);
            $insert_id = $this->Client_Model->clientContact($data);
            $this->session->set_flashdata('message', 'Case Management Contact Add Successfully');
            redirect('client/view/' . $clientid);
        } else {

            $data['page_title'] = display('Invoice');
            $data['all_item'] = $this->dash_model->item_list();
            $data['content'] = $this->load->view('invoice', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }

    function get_item_cost($id) {
        $idarr = explode('_', $id);
        $itmeprice = $this->dash_model->item_listbyid($idarr[0]);
        foreach ($itmeprice as $price) {
            $price1 = $price->Unite_p;
        }
        echo $price1;
    }

    public function re_oreder() {
        if (!empty($_POST)) {
            $encode = $this->get_enquery_code();
            $key = $this->input->post('child_id');
            $enq = $this->enquiry_model->enquiry_by_code($key);
            $data = array(
                'comp_id' => $this->session->userdata('companey_id'),
                'Enquery_id' => $encode,
                'email' => $enq->email,
                'phone' => $enq->phone,
                'name_prefix' => $enq->name_prefix,
                'name' => $enq->name,
                'lastname' => $enq->lastname,
                'gender' => $enq->gender,
                'enquiry' => $enq->enquiry,
                'org_name' => $enq->org_name,
                'created_by' => $enq->created_by,
                'city_id' => $enq->city_id,
                'state_id' => $enq->state_id,
                'country_id' => $enq->country_id,
                'region_id' => $enq->region_id,
                'territory_id' => $enq->territory_id,
                'created_date' => date('Y-m-d H:i:s'),
                'enquiry_source' => $enq->enquiry_source,
                'enquiry_subsource' => $enq->enquiry_subsource,
                'product_id' => $enq->product_id,
                'lead_score' => $enq->lead_score,
                'company' => $enq->company,
                'address' => $enq->address,
                'ip_address' => $this->input->ip_address(),
                'status' => 2
            );
            $insert_id = $this->Configuration_Model->web_enquiry($data);

            $enquiry = $this->enquiry_model->enquiry_by_code($encode);

            $adminid = $enquiry->created_by;
            $name = $enquiry->name;
            $email = $enquiry->email;
            $mobile = $enquiry->phone;
            $intrested = $enquiry->enquiry;
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

            $data = array(
                'adminid' => $adminid,
                'ld_name' => $name,
                'ld_email' => $email,
                'ld_mobile' => $mobile,
                'lead_code' => $enquiry->Enquery_id,
                'city_id' => $enquiry->city_id,
                'state_id' => $enquiry->state_id,
                'ld_created' => $date,
                'ld_for' => $intrested,
                'lead_score' => $lead_score,
                'lead_stage' => $lead_stage,
                'comment' => $comment,
                'ld_status' => '1',
                'child_id' => $key
            );
            $insert_id = $this->Leads_Model->LeadAdd($data);

            if ($lead_stage == 5) {
                $this->Leads_Model->add_comment_for_events( $this->lang->line("circuit_sheet_created") , $enquiry->Enquery_id);

                redirect(base_url() . 'boq-add/' . base64_encode($enquiry->Enquery_id));
            } elseif ($lead_stage == 8) {
                $this->Leads_Model->add_comment_for_events($this->lang->line("po_attached"), $enquiry->Enquery_id);
                redirect(base_url() . 'enquiry/attach_po/' . base64_encode($enquiry->Enquery_id));
            } else {
                $this->Leads_Model->add_comment_for_events($this->lang->line("enquiry_moved"), $enquiry->Enquery_id);
                redirect('lead');
            }
        } else {
            echo "<script>alert('Something Went Wrong')</script>";
            redirect('enquiry');
        }
    }



        public function re_oreder1() {
        if (!empty($_POST)) {
            $encode = $this->get_enquery_code();
            $key = $this->input->post('child_id');
            $enq = $this->enquiry_model->enquiry_by_code($key);
            $data = array(
                'comp_id' => $this->session->userdata('companey_id'),
                'Enquery_id' => $encode,
                'email' => $enq->email,
                'phone' => $enq->phone,
                'name_prefix' => $enq->name_prefix,
                'name' => $enq->name,
                'lastname' => $enq->lastname,
                'gender' => $enq->gender,
                'enquiry' => $enq->enquiry,
                'org_name' => $enq->org_name,
                'created_by' => $enq->created_by,
                'city_id' => $enq->city_id,
                'state_id' => $enq->state_id,
                'country_id' => $enq->country_id,
                'region_id' => $enq->region_id,
                'territory_id' => $enq->territory_id,
                'created_date' => date('Y-m-d H:i:s'),
                'enquiry_source' => $enq->enquiry_source,
                'enquiry_subsource' => $this->input->post('proname'),
                'product_id' => $enq->product_id,
                'lead_score' => $enq->lead_score,
                'company' => $enq->company,
                'address' => $enq->address,
                'ip_address' => $this->input->ip_address(),
                'status' => 2
            );

            $data_bank = array(

            'comp_id'  =>$this->session->userdata('companey_id'),
            'bank'     => $this->input->post('bankname'),
            'product'     => $this->input->post('proname'),
            'enq_id'   => $encode,
            'created_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d H:i:s')
            );

            // print_r($data_bank);exit();

            $this->enquiry_model->add_newbankdeal($data_bank);

            $insert_id = $this->Configuration_Model->web_enquiry($data);

            $enquiry = $this->enquiry_model->enquiry_by_code($encode);

            $adminid = $enquiry->created_by;
            $name = $enquiry->name;
            $email = $enquiry->email;
            $mobile = $enquiry->phone;
            $intrested = $enquiry->enquiry;
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

            $data = array(
                'adminid' => $adminid,
                'ld_name' => $name,
                'ld_email' => $email,
                'ld_mobile' => $mobile,
                'lead_code' => $enquiry->Enquery_id,
                'city_id' => $enquiry->city_id,
                'state_id' => $enquiry->state_id,
                'ld_created' => $date,
                'ld_for' => $intrested,
                'lead_score' => $lead_score,
                'lead_stage' => $lead_stage,
                'comment' => $comment,
                'ld_status' => '1',
                'child_id' => $key
            );
            $insert_id = $this->Leads_Model->LeadAdd($data);

           $this->Leads_Model->add_comment_for_events($this->lang->line("enquiry_moved"), $enquiry->Enquery_id);
           $this->session->set_flashdata('message', 'New deal added successfully');
            redirect('led');
            
        } else {
            echo "<script>alert('Something Went Wrong')</script>";
            redirect('led');
        }
    }


    public function delete_recorde() {
        if (!empty($_POST)) {
            $move_enquiry = $this->input->post('enquiry_id');
            if (!empty($move_enquiry)) {
                foreach ($move_enquiry as $key) {
                    $c = $this->Client_Model->clientdetail_by_id($key);
                    $this->db->where('cli_id', $key);
                    $this->db->delete('clients');

                    $this->db->where('Enquiry_id', $c->Enquery_id);
                    $this->db->delete('enquiry');

                    $this->db->where('lead_code', $c->Enquery_id);
                    $this->db->delete('allleads');
                }
                echo "Client Deleted Successfully";
            } else {
                echo display('please_try_again');
            }
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
        }
        exit;
    }
    function genret_code() {
        $pass = "";
        $chars = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        for ($i = 0; $i < 4; $i++) {
            $pass .= $chars[mt_rand(0, count($chars) - 1)];
        }
        return $pass;
    }
    public function updateclient($enquiry_id = null) {  
       
            $res = $this->enquiry_model->get_deal($enquiry_id);
            $name_prefix = $this->input->post('name_prefix');
            $firstname = $this->input->post('enquirername');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobileno');
            
            $other_phone = $this->input->post('other_no[]');
            $other_email = $this->input->post('other_email[]');
            $lead_source = $this->input->post('lead_source');
            $subsource = $this->input->post('subsource');
            $enquiry = $this->input->post('enquiry');
            $en_comments = $this->input->post('en_comments');
            $city_id = $this->input->post('city_id');
            $state_id = $this->input->post('state_id');
            
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $company = $this->input->post('company');
            $lead_score = $this->input->post('lead_score');
            $expected_date = $this->input->post("expected_date");
            
            if(!empty($expected_date)){
                $expected_date = date('Y-m-d',strtotime($expected_date));
            }
            
            if($this->input->post('country_id')){
                 $country_id = implode(',',$this->input->post('country_id'));
            }else{
                $country_id = '';
            }

            if($this->input->post('preferred_country')){
                 $preferred_country = implode(',',$this->input->post('preferred_country'));
            }else{
                $preferred_country = '';
            }
       
            $enqarr = $this->db->select('*')->where('enquiry_id',$enquiry_id)->get('enquiry')->row();           

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

            if (empty($this->input->post('product_id'))) {
                $process_id    =   $this->session->process[0];                
            }else{
                $process_id    =   $this->input->post('product_id');
            }
            if(!empty($mobile)){
            $this->db->set('phone', $mobile);
            }
            $this->db->set('other_phone', $other_phone);
            $this->db->set('other_email', $other_email);
            $this->db->set('country_id', $country_id);
            if(!empty($email)){            
            $this->db->set('email', $email);
            }
            $this->db->set('name_prefix', $name_prefix);
            $this->db->set('name', $firstname);
            $this->db->set('enquiry_source', $lead_source);
            $this->db->set('sub_source', $subsource);
            $this->db->set('address', $address);
            $this->db->set('pin_code', $pin_code);
            $this->db->set('company', $company);
            $this->db->set('enquiry', $enquiry);
            $this->db->set('lastname', $lastname);
            $this->db->set('state_id', $state_id);
            $this->db->set('city_id', $city_id);
            $this->db->set('enquiry_subsource',$this->input->post('sub_source'));
            $this->db->set('product_id', $process_id);
            $this->db->set('branch_name', $this->input->post('branch_name'));
            $this->db->set('in_take', $this->input->post('in_take'));
            $this->db->set('residing_country', $this->input->post('residing_country'));
            $this->db->set('nationality', $this->input->post('nationality'));
            $this->db->set('preferred_country', $preferred_country);
            $this->db->set('age', $this->input->post('age'));
            $this->db->set('marital_status', $this->input->post('marital_status'));
            $this->db->set('apply_person', $this->input->post('apply_person'));
            $this->db->set('country_stayed', $this->input->post('country_stayed'));
            $this->db->set('police_case', $this->input->post('police_case'));
            $this->db->set('ban_country', $this->input->post('ban_country'));
            $this->db->set('visa_type', $this->input->post('visa_type'));
            $this->db->set('sub_class', $this->input->post('sub_class'));   
            $this->db->set('code_prefix',$this->input->post('code_prefix'));
            if(!empty($lead_score)){
            $this->db->set('lead_score', $lead_score);
            }
            if(!empty($expected_date)){ 
            $this->db->set('lead_expected_date', $expected_date);
            }
            $this->db->set('qualification',$this->input->post('qualification'));
            $this->db->set('experience',$this->input->post('experience'));
            $this->db->set('point_calc',$this->input->post('point_calc'));
            $this->db->set('gender', $this->input->post('gender'));


            $this->db->where('enquiry_id', $enquiry_id);            
            $this->db->update('enquiry');  

            $this->load->model('rule_model');
            $this->rule_model->execute_rules($en_comments,array(1,2));
            
            $type = $enqarr->status;                

            if($type == 1){                 
                $comment_id = $this->Leads_Model->add_comment_for_events($this->lang->line('enquery_updated'), $en_comments);                    
            }else if($type == 2){                   
                $comment_id  = $this->Leads_Model->add_comment_for_events($this->lang->line('lead_updated'), $en_comments);                   
            }else if($type == 3){
                $comment_id = $this->Leads_Model->add_comment_for_events($this->lang->line('client_updated'), $en_comments);
            }else if($type == 4){
             $comment_id = $this->Leads_Model->add_comment_for_events('Refund updated', $en_comments);
            
            }else{
                $enquiry_separation  = get_sys_parameter('enquiry_separation','COMPANY_SETTING');
                if (!empty($enquiry_separation)) {                    
                    
                    $enquiry_separation = json_decode($enquiry_separation,true);                    
                    $title = $enquiry_separation[$type]['title'];                    
                    $comment_msg = $title.' Updated'; 
                    $comment_id = $this->Leads_Model->add_comment_for_events($comment_msg, $en_comments);
                    
                }
            }

            if($this->session->userdata('companey_id')==29){
            
                $bank = $this->input->post('bankname');
                if(!empty($this->input->post('sub_source'))) 
                {
                    $subsrc = $this->input->post('sub_source');
                }else{
                    $subsrc='';
                }
                

                 $res = $this->enquiry_model->get_deal($en_comments);

                 if($res){
                 
                 $array_newdeal = array(

                    'bank'=> $bank,
                    'product' => $subsrc,
                    'updated_by' => $this->session->user_id

                );          

                $this->db->where('enq_id',$en_comments);
                $this->db->update('tbl_newdeal',$array_newdeal);

                 }
                 else{

                     $array_newdeal = array(
                    'comp_id' => $this->session->companey_id,
                    'enq_id'  => $en_comments,
                    'bank'=> $bank,
                    'product' => $subsrc,
                    'created_by' => $this->session->user_id

                );     

                    $this->db->insert('tbl_newdeal',$array_newdeal);
                 }
                 
                

              
            }
            
            /*echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            exit();*/
            
            if(!empty($enqarr)){                
                if(isset($_POST['inputfieldno'])) {                    
                    $inputno   = $this->input->post("inputfieldno", true);
                    $enqinfo   = $this->input->post("enqueryfield", true);
                    $inputtype = $this->input->post("inputtype", true);
                    
                    foreach($inputno as $ind => $val){                        
                        $biarr = array( 
                                        "enq_no"  => $en_comments,
                                        "input"   => $val,
                                        "parent"  => $enquiry_id, 
                                        "fvalue"  => $enqinfo[$ind],
                                        "cmp_no"  => $this->session->companey_id,
                                        "comment_id"  => $comment_id,
                                    );  

                            $this->db->where('enq_no',$en_comments);        
                            $this->db->where('input',$val);        
                            $this->db->where('parent',$enquiry_id);
                            if($this->db->get('extra_enquery')->num_rows()){                                
                                $this->db->where('enq_no',$en_comments);        
                                $this->db->where('input',$val);        
                                $this->db->where('parent',$enquiry_id);
                                $this->db->set('fvalue',$enqinfo[$ind]);
                                $this->db->set('comment_id',$comment_id);
                                $this->db->update('extra_enquery');
                            }else{
                                $this->db->insert('extra_enquery',$biarr);
                            }
                    }                    
                }
                 
            }
            if ($this->session->companey_id==29 && $en_comments == 'ENQ188474867063') {
                $prop    =   $this->enquiry_model->get_extra_enquiry_property($en_comments,'paisaexporef',29);
                $data = $this->enquiry_model->get_enquiry_all_data($en_comments);
                $product = $data['product_name'];
                $paisaexpo_form_id = '';
                if (empty($prop['fvalue'])) {                    
                    $data = array('type'=>$product);                    
                    $options = array(
                                    'url'  => 'http://dev.paisaexpo.com/rest/all/V1/api/crm/create',
                                    'data' => $data,
                                    'request_type' => 'POST'
                                );
                    $res = curl($options);   
                    if (!empty($res)) {
                        $res = json_decode($res,true);
                        print_r($res);
                        var_dump($res);
                        echo $res['form_id'];
                        exit();
                        if ($res['form_id']) {
                            $paisaexpo_form_id =  $res['form_id'];                            
                            $this->enquiry_model->set_extra_enquiry_property($en_comments,'paisaexporef',$paisaexpo_form_id,29);
                        }
                    }
                }else{
                    $paisaexpo_form_id    =   $prop['fvalue'];
                }
                $formid  = $paisaexpo_form_id;
                $data = array('params'=>json_encode($data),'product'=>$product,'formId'=>$formid);
                $options = array(
                                'url'  => 'https://dev.paisaexpo.com/rest/all/V1/api/crm/update',
                                'data' => $data,
                                'request_type' => 'POST'
                            );
                $res = curl($options);
                echo "<pre>";
                echo $res;
                echo "</pre>";
                exit();
                
            }
             if (!$this->input->is_ajax_request()) {           
                $this->session->set_flashdata('message', 'Save successfully');
                redirect($this->agent->referrer()); //updateclient
            }else{
                echo json_encode(array('msg'=>'Saved Successfully','status'=>1));
            }
            
    }


    public function update_enquiry_tab($enquiry_id){        
        if($this->session->companey_id=='67'){
        }
        $tid    =   $this->input->post('tid');
        $form_type    =   $this->input->post('form_type');
        $enqarr = $this->db->select('*')->where('enquiry_id',$enquiry_id)->get('enquiry')->row();
        $en_comments = $enqarr->Enquery_id;

        $type = $enqarr->status;                
        if($type == 1){                 
            $comment_id = $this->Leads_Model->add_comment_for_events($this->lang->line('enquery_updated'), $en_comments);                    
        }else if($type == 2){                   
             $comment_id = $this->Leads_Model->add_comment_for_events($this->lang->line('lead_updated'), $en_comments);                   
        }else if($type == 3){
             $comment_id = $this->Leads_Model->add_comment_for_events($this->lang->line('client_updated'), $en_comments);
        
        }else if($type == 4){
             $comment_id = $this->Leads_Model->add_comment_for_events('Refund updated', $en_comments);
        }
        
        if(!empty($enqarr)){        
            if(isset($_POST['inputfieldno'])) {                    
                $inputno   = $this->input->post("inputfieldno", true);
                $enqinfo   = $this->input->post("enqueryfield", true);
                $inputtype = $this->input->post("inputtype", true);                
                $file_count = 0;                
                $file = !empty($_FILES['enqueryfiles'])?$_FILES['enqueryfiles']:'';                
                foreach($inputno as $ind => $val){
    

                 if ($inputtype[$ind] == 8) {                                                
                        $file_data    =   $this->doupload($file,$file_count);

                        if (!empty($file_data['imageDetailArray']['file_name'])) {
                            $file_path = base_url().'uploads/enq_documents/'.$this->session->companey_id.'/'.$file_data['imageDetailArray']['file_name'];
                            $biarr = array( 
                                            "enq_no"  => $en_comments,
                                            "input"   => $val,
                                            "parent"  => $enquiry_id, 
                                            "fvalue"  => $file_path,
                                            "cmp_no"  => $this->session->companey_id,
                                            "comment_id" => $comment_id
                                        );

                            $this->db->where('enq_no',$en_comments);        
                            $this->db->where('input',$val);        
                            $this->db->where('parent',$enquiry_id);
                            if($this->db->get('extra_enquery')->num_rows()){
                                if ($form_type == 1) {
                                    $this->db->insert('extra_enquery',$biarr);                                       
                                }else{                                    
                                    $this->db->where('enq_no',$en_comments);        
                                    $this->db->where('input',$val);        
                                    $this->db->where('parent',$enquiry_id);
                                    $this->db->set('fvalue',$file_path);
                                    $this->db->set('comment_id',$comment_id);
                                    $this->db->update('extra_enquery');
                                }
                            }else{
                                $this->db->insert('extra_enquery',$biarr);
                            }         
                        }
                        $file_count++;          
                    }else{
                        $biarr = array( "enq_no"  => $en_comments,
                                      "input"   => $val,
                                      "parent"  => $enquiry_id, 
                                      "fvalue"  => $enqinfo[$val],
                                      "cmp_no"  => $this->session->companey_id,
                                      "comment_id" => $comment_id
                                     );                                 
                        $this->db->where('enq_no',$en_comments);        
                        $this->db->where('input',$val);        
                        $this->db->where('parent',$enquiry_id);
                        if($this->db->get('extra_enquery')->num_rows()){  
                            if ($form_type == 1) {
                                $this->db->insert('extra_enquery',$biarr);                                       
                            }else{                                                              
                                $this->db->where('enq_no',$en_comments);        
                                $this->db->where('input',$val);        
                                $this->db->where('parent',$enquiry_id);
                                $this->db->set('fvalue',$enqinfo[$val]);
                                $this->db->set('comment_id',$comment_id);
                                $this->db->update('extra_enquery');
                            }
                        }else{
                            $this->db->insert('extra_enquery',$biarr);
                        }
                    }                                      
                } //foreach loop end               
            }            
             
        }

//For bell notification
$all_assign = $enqarr->all_assign;       
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
            $conversation = 'Pre Documents';
            $stage_remark = 'Pre Documents Save successfully. If already notify about that please ignore.';
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($en_comments,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For Sms Sent

        if (!$this->input->is_ajax_request()) {           
            $this->session->set_flashdata('message', 'Save successfully');
            redirect($this->agent->referrer()); //updateclient
        }else{
            echo json_encode(array('msg'=>'Saved Successfully','status'=>1));
        }

    }


    public function doupload($file,$key){        
        $upload_path    =   "./uploads/enq_documents/";
        $comp_id        =   $this->session->companey_id; //creare seperate folder for each company
        $upPath         =   $upload_path.$comp_id;
        
        if(!file_exists($upPath)){
            mkdir($upPath, 0777, true);
        }        
        $config = array(
            'upload_path'   => $upPath,            
            'overwrite'     => TRUE,
            'max_size'      => "2048000",
            'overwrite'    => false

        );
        $config['allowed_types'] = '*';


        $this->load->library('upload');
        $this->upload->initialize($config);

        $_FILES['enqueryfiles']['name']      = $file['name'][$key];
        $_FILES['enqueryfiles']['type']      = $file['type'][$key];
        $_FILES['enqueryfiles']['tmp_name']  = $file['tmp_name'][$key];
        $_FILES['enqueryfiles']['error']     = $file['error'][$key];
        $_FILES['enqueryfiles']['size']      = $file['size'][$key];        
        
        if(!$this->upload->do_upload('enqueryfiles')){             
            $data['imageError'] =  $this->upload->display_errors();
        }else{
            $data['imageDetailArray'] = $this->upload->data();        
        }
        return $data;
    }

public function updateclientpersonel() {  
                $unique_number = $this->input->post('unique_number');
            if(empty($unique_number)){
        $data = array(   
            'unique_number' => $this->uri->segment(3),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'marital_status' => $this->input->post('marital_status'),
            'last_comm' => $this->input->post('last_comm'),
            'mode_of_comm' => $this->input->post('mode_of_comm'),
            'remark' => $this->input->post('remark'),
            'mother_tongue' => $this->input->post('mother_tongue'),
            'other_language' => $this->input->post('other_language'),
            'corres_add_line1' => $this->input->post('corres_add_line1'),
            'corres_add_line2' => $this->input->post('corres_add_line2'),
            'corres_add_line3' => $this->input->post('corres_add_line3'),
            'corres_country_id' => $this->input->post('corres_country_id'),
            'corres_state_id' => $this->input->post('corres_state_id'),
            'corres_district_id' => $this->input->post('corres_district_id'),
            'corres_pincode' => $this->input->post('corres_pincode'),
            'corres_landmark' => $this->input->post('corres_landmark'),
            'perm_add_line1' => $this->input->post('perm_add_line1'),
            'perm_add_line2' => $this->input->post('perm_add_line2'),
            'perm_add_line3' => $this->input->post('perm_add_line3'),
            'perm_country_id' => $this->input->post('perm_country_id'),
            'perm_state_id' => $this->input->post('perm_state_id'),
            'perm_district_id' => $this->input->post('perm_district_id'),
            'perm_pincode' => $this->input->post('perm_pincode'),
            'perm_landmark' => $this->input->post('perm_landmark'),
            'created_by' => $this->session->user_id
           ); 
           $this->Taskstatus_model->insertpersonel($data);
           $this->Leads_Model->add_comment_for_events( $this->lang->line('Personel Details Inserted') , $unique_number);
            $this->session->set_flashdata('message', 'Save successfully');
           }else{
                $data = array(   
            'unique_number' => $this->input->post('unique_number'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'marital_status' => $this->input->post('marital_status'),
            'last_comm' => $this->input->post('last_comm'),
            'mode_of_comm' => $this->input->post('mode_of_comm'),
            'remark' => $this->input->post('remark'),
            'mother_tongue' => $this->input->post('mother_tongue'),
            'other_language' => $this->input->post('other_language'),
            'corres_add_line1' => $this->input->post('corres_add_line1'),
            'corres_add_line2' => $this->input->post('corres_add_line2'),
            'corres_add_line3' => $this->input->post('corres_add_line3'),
            'corres_country_id' => $this->input->post('corres_country_id'),
            'corres_state_id' => $this->input->post('corres_state_id'),
            'corres_district_id' => $this->input->post('corres_district_id'),
            'corres_pincode' => $this->input->post('corres_pincode'),
            'corres_landmark' => $this->input->post('corres_landmark'),
            'perm_add_line1' => $this->input->post('perm_add_line1'),
            'perm_add_line2' => $this->input->post('perm_add_line2'),
            'perm_add_line3' => $this->input->post('perm_add_line3'),
            'perm_country_id' => $this->input->post('perm_country_id'),
            'perm_state_id' => $this->input->post('perm_state_id'),
            'perm_district_id' => $this->input->post('perm_district_id'),
            'perm_pincode' => $this->input->post('perm_pincode'),
            'perm_landmark' => $this->input->post('perm_landmark'),
            'created_by' => $this->session->user_id
           ); 
             $this->Taskstatus_model->updatepersonel($data); 
             $this->Leads_Model->add_comment_for_events($this->lang->line("personel_details_updated") , $unique_number);
           }  
            $this->session->set_flashdata('message', 'Save successfully');
            redirect($this->agent->referrer()); //updateclient
    }



    public function assign_enquiry() {
        if (!empty($_POST)) {
            $move_enquiry = $this->input->post('enquiry_id[]');
           // echo json_encode($move_enquiry);
            $assign_employee = $this->input->post('assign_employee');
            $user = $this->User_model->read_by_id($assign_employee);
            $notification_data=array();$assign_data=array();
            if (!empty($move_enquiry)) {
                foreach ($move_enquiry as $key) {
                    $data['enquiry'] = $this->enquiry_model->enquiry_by_id($key);
                    $enquiry_code = $data['enquiry']->Enquery_id;
                   // $this->enquiry_model->assign_enquery($key, $assign_employee, $enquiry_code);
                    $assign_data[]=array('aasign_to'=> $assign_employee,
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
                    $this->Leads_Model->add_comment_for_events($this->lang->line('client_assigned'), $enquiry_code);
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
                        'subject'=>'Case Management Assigned',
                        'create_by'=>$this->session->user_id,
                        'task_date'=>date('d-m-Y'),
                        'task_time'=>date('h:i:s'),
                        'task_remark'=>'New ('.count($move_enquiry).') Case Management Assigned To You! Go To List And Check There.',
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

     public function add_amc(){

        $enqid = $this->input->post('enqid');

        // echo $enqid;exit();

         // $path = './uploads/amc_po/';
         //    if(!file_exists($path))
         //    {
         //      mkdir($path);
         //    }

         //     $config['upload_path']   = $path; 
         //    $config['allowed_types'] = 'jpeg|jpg|png|pdf'; 
         //    $config['max_size']      = 3486000; 
         //    $config['encrypt_name'] = true; 

         //    $this->load->library('upload', $config);

        // if ( !$this->upload->do_upload('po')) {

        //     // echo "string";exit();
        //    // $this->session->set_flashdata('message', "Upload Failed");
        //    $error = array('error' => $this->upload->display_errors());
        //     $this->session->set_flashdata('message',$error['error']);
        //    redirect(base_url('client/view/'.$enqid), 'refresh');
        //  }
        //  else{

        //     $fileData = $this->upload->data();
            $arr = array(
           
                 'enq_id'       =>  $enqid,
                 'comp_id'      => $this->session->userdata('companey_id'),
                 'product_name' => $this->input->post('productlist'), 
                 'amc_fromdate' => $this->input->post('fromdate'),  
                 'amc_todate'   =>   $this->input->post('todate'), 
                );

            // print_r($arr);exit();

            $result = $this->Doctor_model->add_amc($arr);

        if($result){
         $this->session->set_flashdata('message', "Added Successfuly");
            redirect(base_url('enquiry/view/'.$enqid), 'refresh');
           }
    }
    
    /***********************************qualification Tab **************************************/
public function create_qualification() {  
      $eid=$this->input->post("enquiryid", true);
if(empty($eid)){

                    $this->db->select('*');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$this->uri->segment(3));
                    $q= $this->db->get()->row();
         $enq_no=$q->Enquery_id;
         $cmp_no=$q->comp_id;

                $biarr[] = array( "enq_id"  => $enq_no,
                                  "xiipassfrom"   => $this->input->post("xiipassfrom", true),
                                  "xiipassto"   => $this->input->post("xiipassto", true),
                                  "xiiper"  => $this->input->post("xiiper", true), 
                                  "xiimb"  => $this->input->post("xiimb", true),
                                  "xiieng"  => $this->input->post("xiieng", true),
                                  "xiistrm"  => $this->input->post("xiistrm", true),
                                  "xiispec"  => $this->input->post("xiispec", true),
                                  "dpassfrom"  => $this->input->post("dpassfrom", true),
                                  "dpassto"  => $this->input->post("dpassto", true),
                                  "dper"  => $this->input->post("dper", true),
                                  "dback"  => $this->input->post("dback", true),
                                  "dtype"  => $this->input->post("dtype", true),
                                  "bpassfrom"  => $this->input->post("bpassfrom", true),
                                  "bpassto"  => $this->input->post("bpassto", true),
                                  "bper"  => $this->input->post("bper", true),
                                  "bback"  => $this->input->post("bback", true),
                                  "btype"  => $this->input->post("btype", true),
                                  "bspec"  => $this->input->post("bspec", true),
                                  "pgpassfrom"  => $this->input->post("pgpassfrom", true),
                                  "pgpassto"  => $this->input->post("pgpassto", true),
                                  "pgper"  => $this->input->post("pgper", true),
                                  "pgback"  => $this->input->post("pgback", true),
                                  "pgmtype"  => $this->input->post("pgmtype", true),
                                  "pgexp"  => $this->input->post("pgexp", true),
                                  "pgjob"  => $this->input->post("pgjob", true),
                                  "created_by" => $this->session->user_id,
                                  "cmp_no"  => $cmp_no,
                                  "created_date"  => date('d/m/Y')
                                 );     
                                 
            if(!empty($biarr)){
                $this->db->insert_batch('tbl_qualification', $biarr); 
            }               
            $this->session->set_flashdata('message', 'Save successfully');
}else{
    
          $this->db->set('xiipassfrom',$this->input->post("xiipassfrom", true));
                                  $this->db->set('xiipassto', $this->input->post("xiipassto", true));
                                  $this->db->set('xiiper', $this->input->post("xiiper", true)); 
                                  $this->db->set('xiimb', $this->input->post("xiimb", true));
                                  $this->db->set('xiieng', $this->input->post("xiieng", true));
                                  $this->db->set('xiistrm', $this->input->post("xiistrm", true));
                                  $this->db->set('xiispec', $this->input->post("xiispec", true));
                                  $this->db->set('dpassfrom', $this->input->post("dpassfrom", true));
                                  $this->db->set('dpassto', $this->input->post("dpassto", true));
                                  $this->db->set('dper', $this->input->post("dper", true));
                                  $this->db->set('dback', $this->input->post("dback", true));
                                  $this->db->set('dtype', $this->input->post("dtype", true));
                                  $this->db->set('bpassfrom', $this->input->post("bpassfrom", true));
                                  $this->db->set('bpassto', $this->input->post("bpassto", true));
                                  $this->db->set('bper', $this->input->post("bper", true));
                                  $this->db->set('bback', $this->input->post("bback", true));
                                  $this->db->set('btype', $this->input->post("btype", true));
                                  $this->db->set('bspec', $this->input->post("bspec", true));
                                  $this->db->set('pgpassfrom', $this->input->post("pgpassfrom", true));
                                  $this->db->set('pgpassto', $this->input->post("pgpassto", true));
                                  $this->db->set('pgper', $this->input->post("pgper", true));
                                  $this->db->set('pgback', $this->input->post("pgback", true));
                                  $this->db->set('pgmtype', $this->input->post("pgmtype", true));
                                  $this->db->set('pgexp', $this->input->post("pgexp", true));
                                  $this->db->set('pgjob', $this->input->post("pgjob", true));
                                  $this->db->set('updated_by',$this->session->user_id);
                                  $this->db->set('updated_date',date('d/m/Y'));

            $this->db->where('enq_id', $eid);
            $this->db->update('tbl_qualification');
            $this->session->set_flashdata('message', 'Updated successfully');
    
}
            redirect($this->agent->referrer()); //updateclient
    }
    /*************************************qualification tab End **********************************/

    /***********************************English Tab **************************************/
        public function create_english() {  
    $eid=$this->input->post("enquiryid", true);
if(empty($eid)){
                    $this->db->select('*');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$this->uri->segment(3));
                    $q= $this->db->get()->row();
         $enq_no=$q->Enquery_id;
         $cmp_no=$q->comp_id;

                $biarr[] = array( "enq_id"  => $enq_no,
                
                                  "exam_ielts"   => $this->input->post("ielts", true), 
                                  "ieltsappeard"  => $this->input->post("ieltsappeard", true),
                                  "ieltsdate"  => $this->input->post("ieltsdt", true),
                                  "ieltslisten"  => $this->input->post("ieltslisten", true),
                                  "ieltsread"  => $this->input->post("ieltsread", true),
                                  "ieltswrite"  => $this->input->post("ieltswrite", true),
                                  "ieltsspeak"  => $this->input->post("ieltsspeak", true),
                                  "ieltsfinal"  => $this->input->post("ieltsfinal", true),
                                  
                                  "exam_pte"   => $this->input->post("pte", true), 
                                  "pteappeard"  => $this->input->post("pteappeard", true),
                                  "ptedt"  => $this->input->post("ptedt", true),
                                  "ptelisten"  => $this->input->post("ptelisten", true),
                                  "pteread"  => $this->input->post("pteread", true),
                                  "ptewrite"  => $this->input->post("ptewrite", true),
                                  "ptespeak"  => $this->input->post("ptespeak", true),
                                  "ptefinal"  => $this->input->post("ptefinal", true),
                                  
                                  "cmp_no"  => $cmp_no,
                                  "created_by" => $this->session->user_id,
                                  "created_date"  => date('d/m/Y')
                                 );     
                                 
            if(!empty($biarr)){
                $this->db->insert_batch('tbl_english', $biarr); 
            }
                
            $this->session->set_flashdata('message', 'Save successfully');
        }else{
            
                                  $this->db->set('exam_ielts',$this->input->post("ielts", true)); 
                                  $this->db->set('ieltsappeard',$this->input->post("ieltsappeard", true));
                                  $this->db->set('ieltsdate', $this->input->post("ieltsdt", true));
                                  $this->db->set('ieltslisten', $this->input->post("ieltslisten", true));
                                  $this->db->set('ieltsread', $this->input->post("ieltsread", true));
                                  $this->db->set('ieltswrite', $this->input->post("ieltswrite", true));
                                  $this->db->set('ieltsspeak', $this->input->post("ieltsspeak", true));
                                  $this->db->set('ieltsfinal', $this->input->post("ieltsfinal", true));
                                  
                                  $this->db->set('exam_pte', $this->input->post("pte", true)); 
                                  $this->db->set('pteappeard', $this->input->post("pteappeard", true));
                                  $this->db->set('ptedt', $this->input->post("ptedt", true));
                                  $this->db->set('ptelisten', $this->input->post("ptelisten", true));
                                  $this->db->set('pteread', $this->input->post("pteread", true));
                                  $this->db->set('ptewrite', $this->input->post("ptewrite", true));
                                  $this->db->set('ptespeak',$this->input->post("ptespeak", true));
                                  $this->db->set('ptefinal',$this->input->post("ptefinal", true));
                                  $this->db->set('updated_by',$this->session->user_id);
                                  $this->db->set('updated_date',date('d/m/Y'));

            $this->db->where('enq_id', $eid);
            $this->db->update('tbl_english');
            $this->session->set_flashdata('message', 'Updated successfully');
        }
            redirect($this->agent->referrer()); //updateclient
    }
    /*************************************English tab End **********************************/
    

       /***********************************payment tab **************************************/
        public function create_payment($enquiry_id = null,$keyword = null) {      
            $this->db->select('*');
            $this->db->from('enquiry');
            $this->db->where('enquiry_id',$this->uri->segment(3));
            $q = $this->db->get()->row();
            $enq_no = $q->Enquery_id;
            $cmp_no = $q->comp_id;

//For Invoice upload
    if(!empty($_FILES['onetime_invoice']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['onetime_invoice']['name'];
                $_FILES['userfile']['type']= $_FILES['onetime_invoice']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['onetime_invoice']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['onetime_invoice']['error'];
                $_FILES['userfile']['size']= $_FILES['onetime_invoice']['size'];    
                
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
            $image   = '';
    }
//End

            $biarr[] = array( "enq_id"  => $enq_no,
                              "cmp_no"  => $cmp_no,
                              "reg_fee"   => $this->input->post("reg_fee", true),
                              "app_fee"   => $this->input->post("app_fee", true),
                              "family_fee"  => $this->input->post("family_fee", true), 
                              "lawyer_fee"  => $this->input->post("lawyer_fee", true),
                              "consultancy_fee"  => $this->input->post("consultancy_fee", true),
                              "stamp"  => $this->input->post("stamp_fee", true),
                              
                              "tax_value_reg"   => $this->input->post("tax_value_reg", true),
                              "tax_value_app"   => $this->input->post("tax_value_app", true),
                              "tax_value_family"  => $this->input->post("tax_value_family", true), 
                              "tax_value_lawyer"  => $this->input->post("tax_value_lawyer", true),
                              "tax_value_consultancy"  => $this->input->post("tax_value_consultancy", true),
                              "tax_value_stamp"  => $this->input->post("tax_value_stamp", true),
                              
                              "total_reg"   => $this->input->post("total_reg", true),
                              "total_app"   => $this->input->post("total_app", true),
                              "total_family"  => $this->input->post("total_family", true), 
                              "total_lawyer"  => $this->input->post("total_lawyer", true),
                              "total_consultancy"  => $this->input->post("total_consultancy", true),
                              "total_stamp"  => $this->input->post("total_stamp", true),
                              "notax_amt"  => $this->input->post("notax_amt", true),
                              "taxabal_amt"  => $this->input->post("taxabal_amt", true),
                              
                              "advance"  => $this->input->post("advance", true),
                              "typepay"   => $this->input->post("typepay", true),
                              "onetime_mode"  => $this->input->post("onetime_mode", true), 
                              "onetime_type_card"  => $this->input->post("onetime_type_card", true),
                              "onetime_card_bank"   => $this->input->post("onetime_card_bank", true),
                              "onetime_card_digit"  => $this->input->post("onetime_card_digit", true), 
                              "onetime_cheque_no"  => $this->input->post("onetime_cheque_no", true),
                              "onetime_cheque_bank_name"   => $this->input->post("onetime_cheque_bank_name", true),
                              "onetime_cheque_account_no"  => $this->input->post("onetime_cheque_account_no", true), 
                              "onetime_dd_no"  => $this->input->post("onetime_dd_no", true),
                              "onetime_pay_amt"   => $this->input->post("onetime_pay_amt", true),
                              "onetime_pay_date"  => $this->input->post("onetime_pay_date", true), 
                              "status"  => '', 
                              "onetime_invoice"  => $image,
                              "p_remark"  => $this->input->post("p_remark", true),                             
                              "created_by" => $this->session->user_id
                             );
                                 
            if(!empty($biarr)){
              $last_id = $this->db->insert_batch('tbl_payment', $biarr); 
            }
            if(!empty($last_id) && ($this->input->post("typepay", true)=='2')){ 
                $installment = $this->input->post("ini_set", true);
                $remainder_set= $this->input->post("remainder_set", true);
                $from_date   = $this->input->post("from_date", true);
                $to_date   = $this->input->post("to_date", true);
                $reminder_satge   = $this->input->post("reminder_satge", true);
                $pay_amt   = $this->input->post("pay_amt", true);
                $pay_date   = $this->input->post("pay_date", true);
                $pi_remark   = $this->input->post("pi_remark", true);
                foreach($installment as $key=>$value){
//For Installment Invoice upload
    if(!empty($_FILES['ins_invoice']['name'][$key])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['ins_invoice']['name'][$key];
                $_FILES['userfile']['type']= $_FILES['ins_invoice']['type'][$key];
                $_FILES['userfile']['tmp_name']= $_FILES['ins_invoice']['tmp_name'][$key];
                $_FILES['userfile']['error']= $_FILES['ins_invoice']['error'][$key];
                $_FILES['userfile']['size']= $_FILES['ins_invoice']['size'][$key];    
                
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
            $image1   = '';
    }
//End
                    $biarr1 = array("comp_id"  => $cmp_no, 
                                    "enq_id"  => $enq_no,
                                    "payment_id"   => $last_id,
                                    "ini_set"   => $value,
                                    "remainder_set"   => $remainder_set[$key],
                                    "from_date"   => $from_date[$key],
                                    "to_date"   => $to_date[$key],
                                    "reminder_satge"   => $reminder_satge[$key],
                                    "pay_amt"   => $pay_amt[$key],
                                    "pay_date"   => $pay_date[$key],
                                    "ins_invoice"  => $image1,
                                    "pi_remark"   => $pi_remark[$key],
                                    "created_by" => $this->session->user_id
                                );
                    $this->Client_Model->insert_installment($biarr1);
                }
            }

//Auto Assign To Account Team
$assign_employee = '551';
if(!empty($assign_employee)){
            $this->db->select('all_assign');
            $this->db->where('Enquery_id',$enq_no);
            $res=$this->db->get('enquiry');
            $q=$res->row();
            $z=array();$new=array();$allid=array();
                 $z = explode(',',$q->all_assign);
                 $new[]=$assign_employee;
                $allid = array_unique (array_merge ($z, $new));
                //print_r($allid);exit; 
                $string_id=implode(',',$allid);
                
                $this->db->set('all_assign', $string_id);
                $this->db->set('aasign_to', $assign_employee);
                $this->db->set('assign_by', $this->session->user_id);
$this->db->where('Enquery_id',$enq_no);
$this->db->update('enquiry');


//For bell notification
$conversation = 'Payment Details';
$stage_remark = 'Payments Details Created.If already notify about that please ignore.';

$z = explode(',',$q->all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_no,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end                         
}
//End


            
            $comment_id = $this->Leads_Model->add_comment_for_events('Payment details has been created', $enq_no);

            if(!in_array($this->session->userdata('user_right'), applicant)){
            if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('payment'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('payment'));
            }else{
                $this->session->set_flashdata('message', 'Save successfully');
                redirect('client/view/'.$enquiry_id.'/'.base64_encode('payment'));
            }
            }else{
                redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('document'));
            }
            
    }

    public function update_payment_installment($enquiry_id = null,$keyword = null) { 

//Update Invoice Code
if(!empty($_FILES['ins_invoice']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['ins_invoice']['name'];
                $_FILES['userfile']['type']= $_FILES['ins_invoice']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['ins_invoice']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['ins_invoice']['error'];
                $_FILES['userfile']['size']= $_FILES['ins_invoice']['size'];    
                
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
            $image   = '';
    }
//End      
    
        $ini_set   = $this->input->post("ini_set", true);
        $remainder_set   = $this->input->post("remainder_set", true);
        $from_date   = $this->input->post("from_date", true);
        $to_date   = $this->input->post("to_date", true);
        $reminder_satge   = $this->input->post("reminder_satge", true);
        $pay_amt   = $this->input->post("pay_amt", true);
        $pay_date   = $this->input->post("pay_date", true);
        $pi_remark   = $this->input->post("pi_remark", true);

        $ins_id   = $this->input->post("ins_id", true);

        $this->db->set('ini_set', $ini_set);
        $this->db->set('remainder_set', $remainder_set);
        $this->db->set('from_date', $from_date);
        $this->db->set('to_date', $to_date);
        $this->db->set('reminder_satge', $reminder_satge);
        $this->db->set('pay_amt', $pay_amt);
        $this->db->set('pay_date', $pay_date);
if(!empty($image)){
        $this->db->set('ins_invoice', $image);
    }
        $this->db->set('pi_remark', $pi_remark);

        $this->db->where('id', $ins_id);
        $this->db->update('tbl_installment');

        $this->db->select('Enquery_id,all_assign');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enquiry_id);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $all_assign=$q->all_assign;
        $comment_id = $this->Leads_Model->add_comment_for_events('Payment details has been updated', $enq_id);

//For bell notification
$conversation = 'Payment Details';
$stage_remark = 'Payment Details Updated.If already notify about that please ignore.';

$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($enq_id,$aa,$conversation,$stage_remark,$task_date,$task_time,$this->session->user_id);
        }
}
//For bell notification end
        
        if(!in_array($this->session->userdata('user_right'), applicant)){
        if($keyword=='enquiry'){
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('payment'));
        }else if($keyword=='lead'){
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('payment'));
        }else{
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('client/view/'.$enquiry_id.'/'.base64_encode('payment'));
        }
        }else{
        redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('payment'));
        }
    }
    
    public function update_setlled($enquiry_id = null,$keyword = null) {
        
        if(!empty($_FILES['account_sign']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['account_sign']['name'];
                $_FILES['userfile']['type']= $_FILES['account_sign']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['account_sign']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['account_sign']['error'];
                $_FILES['userfile']['size']= $_FILES['account_sign']['size'];    
                
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
            $image   = '';
    }

//Update Invoice Code
if(!empty($_FILES['ins_invoice']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['ins_invoice']['name'];
                $_FILES['userfile']['type']= $_FILES['ins_invoice']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['ins_invoice']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['ins_invoice']['error'];
                $_FILES['userfile']['size']= $_FILES['ins_invoice']['size'];    
                
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
            $image1   = '';
    }
//End
    
        $typpay   = $this->input->post("typpay", true);
        $type_card   = $this->input->post("type_card", true);
        $card_bank   = $this->input->post("card_bank", true);
        $card_digit   = $this->input->post("card_digit", true);
        $cheque_no   = $this->input->post("cheque_no", true);
        $bank_name   = $this->input->post("bank_name", true);
        $account_no   = $this->input->post("account_no", true);
        $dd_no   = $this->input->post("dd_no", true);
        $recieved_amt   = $this->input->post("recieved_amt", true);
        $recieved_date   = $this->input->post("recieved_date", true);
        
        $account_name   = $this->input->post("account_name", true);
        $account_sign   = $image;
        $pay_id   = $this->input->post("pay_id", true);

        $this->db->set('typpay', $typpay);
        $this->db->set('type_card', $type_card);
        $this->db->set('card_bank', $card_bank);
        $this->db->set('card_digit', $card_digit);
        $this->db->set('cheque_no', $cheque_no);
        $this->db->set('bank_name', $bank_name);
        $this->db->set('account_no', $account_no);
        $this->db->set('dd_no', $dd_no);
        $this->db->set('recieved_amt', $recieved_amt);
        $this->db->set('recieved_date', $recieved_date);
        $this->db->set('account_name', $account_name);
        $this->db->set('account_sign', $account_sign);
if(!empty($image1)){
        $this->db->set('ins_invoice', $image1);
    }
        $this->db->set('Pay_status', '1');
        $this->db->where('id', $pay_id);
        $this->db->update('tbl_installment');

        $this->db->select('Enquery_id,email,phone,product_id');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enquiry_id);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;

if(!empty($q->phone)){

    $this->db->select('pk_i_admin_id');
    $this->db->from('tbl_admin');
    $this->db->where('s_user_email',$q->email);
    $this->db->where('s_phoneno',$q->phone);
    $q1= $this->db->get()->row();
    if(empty($q1->pk_i_admin_id) && $q->product_id!='182'){
        $this->create_client_portal_manual($enquiry_id);
    }
}
        $comment_id = $this->Leads_Model->add_comment_for_events('Payment has been done', $enq_id);

        if(!in_array($this->session->userdata('user_right'), applicant)){
        if($keyword=='enquiry'){
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('payment'));
        }else if($keyword=='lead'){
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('payment'));
        }else{
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('client/view/'.$enquiry_id.'/'.base64_encode('payment'));
        }
        }else{
        redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('payment'));
        }
    }

    public function update_payment_onetime($enquiry_id = null,$keyword = null) {
//Update Invoice Code
if(!empty($_FILES['onetime_invoice']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['onetime_invoice']['name'];
                $_FILES['userfile']['type']= $_FILES['onetime_invoice']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['onetime_invoice']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['onetime_invoice']['error'];
                $_FILES['userfile']['size']= $_FILES['onetime_invoice']['size'];    
                
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
            $image   = '';
    }
//End
        
    
        $reg_fee   = $this->input->post("reg_fee", true);
        $reg_tax   = $this->input->post("reg_tax", true);
        $reg_amt   = $this->input->post("reg_amt", true);

        $app_fee   = $this->input->post("app_fee", true);
        $app_tax   = $this->input->post("app_tax", true);
        $app_amt   = $this->input->post("app_amt", true);

        $family_fee   = $this->input->post("family_fee", true);
        $family_tax   = $this->input->post("family_tax", true);
        $family_amt   = $this->input->post("family_amt", true);
        $lawyer_fee   = $this->input->post("lawyer_fee", true);
        $lawyer_tax   = $this->input->post("lawyer_tax", true);
        $lawyer_amt   = $this->input->post("lawyer_amt", true);
        $consultancy_fee   = $this->input->post("consultancy_fee", true);       
        $consultancy_tax   = $this->input->post("consultancy_tax", true);
        $consultancy_amt   = $this->input->post("consultancy_amt", true);
        $stamp_fee   = $this->input->post("stamp_fee", true);
        $stamp_tax   = $this->input->post("stamp_tax", true);
        $stamp_amt   = $this->input->post("stamp_amt", true);
        $t_no_tax   = $this->input->post("t_no_tax", true);
        $t_with_tax   = $this->input->post("t_with_tax", true);
        $advance   = $this->input->post("advance", true);
        $pay_amt   = $this->input->post("pay_amt", true);
        $pay_date   = $this->input->post("pay_date", true);
        $remark   = $this->input->post("remark", true);
        $pay_id   = $this->input->post("pay_id", true);

        $this->db->set('reg_fee', $reg_fee);
        $this->db->set('tax_value_reg', $reg_tax);
        $this->db->set('total_reg', $reg_amt);

        $this->db->set('app_fee', $app_fee);
        $this->db->set('tax_value_app', $app_tax);
        $this->db->set('total_app', $app_amt);

        $this->db->set('family_fee', $family_fee);
        $this->db->set('tax_value_family', $family_tax);
        $this->db->set('total_family', $family_amt);
        $this->db->set('lawyer_fee', $lawyer_fee);
        $this->db->set('tax_value_lawyer', $lawyer_tax);
        $this->db->set('total_lawyer', $lawyer_amt);
        $this->db->set('consultancy_fee', $consultancy_fee);
        $this->db->set('tax_value_consultancy', $consultancy_tax);
        $this->db->set('total_consultancy', $consultancy_amt);
        $this->db->set('stamp', $stamp_fee);
        $this->db->set('tax_value_stamp', $stamp_tax);
        $this->db->set('total_stamp', $stamp_amt);
        $this->db->set('notax_amt', $t_no_tax);
        $this->db->set('taxabal_amt', $t_with_tax);
        $this->db->set('advance', $advance);
        $this->db->set('onetime_pay_amt', $pay_amt);
        $this->db->set('onetime_pay_date', $pay_date);
    if(!empty($image)){
        $this->db->set('onetime_invoice', $image);
    }
        $this->db->set('p_remark', $remark);
        $this->db->where('id', $pay_id);
        $this->db->update('tbl_payment');

        $this->db->select('Enquery_id');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enquiry_id);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        $comment_id = $this->Leads_Model->add_comment_for_events('Payment details has been updated', $enq_id);
        
        if(!in_array($this->session->userdata('user_right'), applicant)){
        if($keyword=='enquiry'){
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('payment'));
        }else if($keyword=='lead'){
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('payment'));
        }else{
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('client/view/'.$enquiry_id.'/'.base64_encode('payment'));
        }
        }else{
        redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('payment'));
        }
    }

    public function update_setlled_onetime($enquiry_id = null,$keyword = null) {
        
        if(!empty($_FILES['onetime_pay_sign']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['onetime_pay_sign']['name'];
                $_FILES['userfile']['type']= $_FILES['onetime_pay_sign']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['onetime_pay_sign']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['onetime_pay_sign']['error'];
                $_FILES['userfile']['size']= $_FILES['onetime_pay_sign']['size'];    
                
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
            $image   = '';
    }

//Update Invoice Code
if(!empty($_FILES['onetime_invoice']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['onetime_invoice']['name'];
                $_FILES['userfile']['type']= $_FILES['onetime_invoice']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['onetime_invoice']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['onetime_invoice']['error'];
                $_FILES['userfile']['size']= $_FILES['onetime_invoice']['size'];    
                
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
            $image1   = '';
    }
//End

    
        $onetime_mode   = $this->input->post("onetime_mode", true);
        $onetime_type_card   = $this->input->post("onetime_type_card", true);
        $onetime_card_bank   = $this->input->post("onetime_card_bank", true);
        $onetime_card_digit   = $this->input->post("onetime_card_digit", true);
        $onetime_cheque_no   = $this->input->post("onetime_cheque_no", true);
        $onetime_cheque_bank_name   = $this->input->post("onetime_cheque_bank_name", true);
        $onetime_cheque_account_no   = $this->input->post("onetime_cheque_account_no", true);
        $onetime_dd_no   = $this->input->post("onetime_dd_no", true);
        $onetime_pay_amt   = $this->input->post("onetime_pay_amt", true);
        $onetime_pay_date   = $this->input->post("onetime_pay_date", true);
        
        $onetime_pay_name   = $this->input->post("onetime_pay_name", true);
        $onetime_pay_sign   = $image;
        $pay_id   = $this->input->post("pay_id", true);

        $this->db->set('onetime_mode', $onetime_mode);
        $this->db->set('onetime_type_card', $onetime_type_card);
        $this->db->set('onetime_card_bank', $onetime_card_bank);
        $this->db->set('onetime_card_digit', $onetime_card_digit);
        $this->db->set('onetime_cheque_no', $onetime_cheque_no);
        $this->db->set('onetime_cheque_bank_name', $onetime_cheque_bank_name);
        $this->db->set('onetime_cheque_account_no', $onetime_cheque_account_no);
        $this->db->set('onetime_dd_no', $onetime_dd_no);
        $this->db->set('onetime_pay_amt', $onetime_pay_amt);
        $this->db->set('onetime_pay_date', $onetime_pay_date);
        $this->db->set('onetime_pay_name', $onetime_pay_name);
        $this->db->set('onetime_pay_sign', $onetime_pay_sign);
if(!empty($image1)){
        $this->db->set('onetime_invoice', $image1);
    }
        $this->db->set('status', '1');
        $this->db->where('id', $pay_id);
        $this->db->update('tbl_payment');

        $this->db->select('Enquery_id,phone,email,product_id');
        $this->db->from('enquiry');
        $this->db->where('enquiry_id',$enquiry_id);
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
if(!empty($q->phone)){

    $this->db->select('pk_i_admin_id');
    $this->db->from('tbl_admin');
    $this->db->where('s_user_email',$q->email);
    $this->db->where('s_phoneno',$q->phone);
    $q1= $this->db->get()->row();
    if(empty($q1->pk_i_admin_id) && $q->product_id!='182'){
        $this->create_client_portal_manual($enquiry_id);
    }
}
        $comment_id = $this->Leads_Model->add_comment_for_events('Payment has been Done', $enq_id);
        
        if(!in_array($this->session->userdata('user_right'), applicant)){
        if($keyword=='enquiry'){
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('enquiry/view/'.$enquiry_id.'/'.base64_encode('payment'));
        }else if($keyword=='lead'){
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('lead/lead_details/'.$enquiry_id.'/'.base64_encode('payment'));
        }else{
        $this->session->set_flashdata('message', 'Updated successfully');
        redirect('client/view/'.$enquiry_id.'/'.base64_encode('payment'));
        }
        }else{
        redirect('dashboard/user_profile/'.$enquiry_id.'/'.base64_encode('payment'));
        }
    }   
    
    public function getHtml($x,$y,$z)
    {
        $data['daynamic_id'] = $x;
        $data['all_estage_lists'] = $this->Leads_Model->find_estage($y,$z);
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        $data['all_installment'] = $this->Leads_Model->installment_select();
        $html = $this->load->view('payment/add_more',$data,true);
        echo json_encode(array('html'=>$html));
    }
    /*************************************payment tab End **********************************/
/************************************************add aggriment******************************************************/
public function create_aggrement() {
        $enq_no=$this->uri->segment(3);
        $cmp_no=$this->session->userdata('companey_id');

if(!empty($_FILES['pass_file']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['pass_file']['name'];
                $_FILES['userfile']['type']= $_FILES['pass_file']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['pass_file']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['pass_file']['error'];
                $_FILES['userfile']['size']= $_FILES['pass_file']['size'];    
                
                $image=$_FILES['userfile']['name'];
                $pass_file=  "uploads/agrmnt/".$image;
                $ret = move_uploaded_file($_FILES['userfile']['tmp_name'] ,$pass_file);
    }
                            
if(!empty($_FILES['co_file']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['co_file']['name'];
                $_FILES['userfile']['type']= $_FILES['co_file']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['co_file']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['co_file']['error'];
                $_FILES['userfile']['size']= $_FILES['co_file']['size'];    
                
                $image1=$_FILES['userfile']['name'];
                $co_file=  "uploads/agrmnt/".$image1;
                $ret1 = move_uploaded_file($_FILES['userfile']['tmp_name'] ,$co_file);              
    }   
        
if(!empty($_FILES['sign_file']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['sign_file']['name'];
                $_FILES['userfile']['type']= $_FILES['sign_file']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['sign_file']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['sign_file']['error'];
                $_FILES['userfile']['size']= $_FILES['sign_file']['size'];    
                
                $image2=$_FILES['userfile']['name'];
                $sign_file=  "uploads/agrmnt/".$image2;
                $ret2 = move_uploaded_file($_FILES['userfile']['tmp_name'] ,$sign_file);
            /* if($ret2){
                $this->aws->upload("",$sign_file);                                  }   
            } */    
    }       
                
$this->Client_Model->set_agreement_meta($enq_no,$cmp_no,array(
                            'main_applicant'          =>    $this->input->post('main_applicant'),
                            'main_applicant_passport' =>    $pass_file,
                            'co_applicants'           =>    $this->input->post('co_applicants'),
                            'co_applicants_passport'  =>    $co_file,
                            'signing_party'           =>    $this->input->post('sign_party'),
                            'signing_party_passport'     => $sign_file,         
                            'father_name'             =>    $this->input->post('father_name'),
                            'mail_id_first'           =>    $this->input->post('m_both'),
                            'phone_first'             =>    $this->input->post('p_both'),
                            'mail_id_second'          =>    $this->input->post('m_both2'),
                            'phone_second'            =>    $this->input->post('p_both2'),
                            'address_of_sign_party'   =>    $this->input->post('add_sparty'),
                            'address_of_courier'      =>    $this->input->post('add_courier'),
                            'apply_country'           =>    $this->input->post('aply_cntry'),
                            'no_of_person_apply'      =>    $this->input->post('nop_apply'),
                            'assistance_visa_category'=>    $this->input->post('assistance_visa_cetogry'),
                            'education_qualification' =>    $this->input->post('edu_qulification'),
                            'mode_of_payment'         =>    $this->input->post('payment_mode'),
                            'cash_amount'             =>    $this->input->post('cash_amt'),
                            'cheque_no'               =>    $this->input->post('cheque_no'),
                            'bank_no'                 =>    $this->input->post('bank_no'),
                            'account_no'              =>    $this->input->post('ac_no'),
                            'others'                  =>    $this->input->post('others'),
                            'date_of_payment'         =>    $this->input->post('dop'),
                            'amount_paid'             =>    $this->input->post('amt_paid')
                        ),'CLIENT_AGREEMENT_DETAILS'
                    );
                
            $this->session->set_flashdata('message', 'Save successfully');
            redirect($this->agent->referrer()); //updateclient
    }
    
    public function create_officeuse_only() {

        $enq_no=$this->uri->segment(3);
        $cmp_no=$this->session->userdata('companey_id');
                
$this->Client_Model->set_agreement_meta($enq_no,$cmp_no,array(
                            'visa_category'     =>  $this->input->post('visa_category'),
                            'sub_class'         =>  $this->input->post('sub_class'),
                            'assessment_body'   =>  $this->input->post('edu_assessment'),
                            'consultancy_fees'  =>  $this->input->post('consultancy_fees')
                        ),'CLIENT_AGREEMENT_DETAILS'
                    );
                
            $this->session->set_flashdata('message', 'Save successfully');
            redirect($this->agent->referrer()); //updateclient
    }
    
    public function generate_payment() {

        $enq_no=$this->uri->segment(3);
        $cmp_no=$this->session->userdata('companey_id');
        
        if(!empty($_FILES['emp_sign']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['emp_sign']['name'];
                $_FILES['userfile']['type']= $_FILES['emp_sign']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['emp_sign']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['emp_sign']['error'];
                $_FILES['userfile']['size']= $_FILES['emp_sign']['size'];    
                
                $image=$_FILES['userfile']['name'];
                $emp_sign=  "uploads/agrmnt/".$image;
                $ret2 = move_uploaded_file($_FILES['userfile']['tmp_name'] ,$emp_sign);
            /* if($ret2){
                $this->aws->upload("",$emp_sign);                                   }   
            } */    
    }
                
$this->Client_Model->set_agreement_meta($enq_no,$cmp_no,array(
                            'registration_fees'     =>  $this->input->post('registration_fees'),
                            'family_fees'           =>  $this->input->post('family_fees'),
                            'first_ins'             =>  $this->input->post('first_ins'),
                            'second_ins'   =>   $this->input->post('second_ins'),
                            'third_ins'    =>   $this->input->post('third_ins'),
                            'fourth_ins'   =>   $this->input->post('fourth_ins'),
                            'five_ins'     =>   $this->input->post('five_ins'),
                            'six_ins'      =>   $this->input->post('six_ins'),
                            'lawyer_fees'           =>  $this->input->post('lawyer_fees'),
                            'form_submiting_date'   =>  $this->input->post('fsd'),
                            'expected_signing_date' =>  $this->input->post('easd'),
                            'analytic_feedback'     =>  $this->input->post('feed_back'),
                            'employee_name'   =>    $this->input->post('emp_name'),
                            'employee_code'   =>    $this->input->post('emp_code'),
                            'employee_signature'   =>   $emp_sign
                        ),'CLIENT_AGREEMENT_DETAILS'
                    );
                
            $this->session->set_flashdata('message', 'Save successfully');
            redirect($this->agent->referrer()); //updateclient
    }
    
    public function account_confirmation() {

        $enq_no=$this->uri->segment(3);
        $cmp_no=$this->session->userdata('companey_id');
        
        if(!empty($_FILES['accteam_sign']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['accteam_sign']['name'];
                $_FILES['userfile']['type']= $_FILES['accteam_sign']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['accteam_sign']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['accteam_sign']['error'];
                $_FILES['userfile']['size']= $_FILES['accteam_sign']['size'];    
                
                $image=$_FILES['userfile']['name'];
                $accteam_sign=  "uploads/agrmnt/".$image;
                $ret2 = move_uploaded_file($_FILES['userfile']['tmp_name'] ,$accteam_sign);
            /* if($ret2){
                $this->aws->upload("",$accteam_sign);                                   }   
            } */    
    }
        
           $data = array(
                            'enq_id'         => $enq_no,
                            'cmp_no'         => $cmp_no,
                            'received_amt'   => $this->input->post('received_amt'),
                            'received_date'  => $this->input->post('received_date'),
                            'accteam_name'   => $this->input->post('accteam_name'),
                            'accteam_sign'   => $accteam_sign,
                            'created_by'   =>   $this->session->user_id
                        );
                
$this->Client_Model->payment_by_account($data);
                
            $this->session->set_flashdata('message', 'Save successfully');
            redirect($this->agent->referrer()); //updateclient
    }
/***********************************************end aggriment part 1 and 2***************************************************/  
    
    public function find_same() {
        $smae_id = $this->input->post('cdata');
        echo json_encode($this->location_model->get_same($smae_id));
    }
    
    public function find_same_data() {
        $smae_id = $this->input->post('cdata');
        //print_r($smae_id);exit;
        echo json_encode($this->location_model->get_same_data($smae_id));
    }
    
    public function upload_aggrement_team() {
    $enquiry_id = $this->input->post('ide');
    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enquiry_id);
                    $q= $this->db->get()->row();
    $enq_id =$q->Enquery_id;
    $phone =$q->phone;
    
                    $this->db->where('s_phoneno',$phone);
    $this->db->from('tbl_admin');
                    $q1= $this->db->get()->row();
   $noti_id =$q1->pk_i_admin_id;
if(!empty($noti_id)){
    $noti_id = $noti_id;
   }else{
    $noti_id = $this->session->user_id;
   }    
if(!empty($_FILES['file']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['file']['name'];
                $_FILES['userfile']['type']= $_FILES['file']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['file']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['file']['error'];
                $_FILES['userfile']['size']= $_FILES['file']['size'];    
                
                $image=$_FILES['userfile']['name'];
                $path=  "uploads/agrmnt/".$image;
                $ret = move_uploaded_file($_FILES['userfile']['tmp_name'] ,$path);
            if($ret){                                       $this->aws->upload("",$path);                                   }

            $this->db->set('file',$path);
            $this->db->where('enq_id', $enq_id);
            $this->db->update('tbl_aggriment'); 
            }
            $assign_data_noti[]=array('create_by'=> $noti_id,
                        'subject'=>'Agrrement Uploded',
                        'query_id'=>$enq_id,
                        'task_date'=>date('d-m-Y'),
                        'task_time'=>date('H:i:s')
                        );
           $this->db->insert_batch('query_response',$assign_data_noti);
           $this->load->library('user_agent');
redirect($this->agent->referrer());
}
/*******************************************************************************end add aggriment***************************************************/
    public function upload_aggrement_student() {
    $enquiry_id = $this->input->post('ide');
    $this->db->from('tbl_aggriment');
                    $this->db->where('id',$enquiry_id);
                    $q= $this->db->get()->row();
    $enq_id =$q->enq_id;
    $noti_id =$q->created_by;
    
            
if(!empty($_FILES['file']['name'])){
                $this->load->library("aws");
                $_FILES['userfile']['name']= $_FILES['file']['name'];
                $_FILES['userfile']['type']= $_FILES['file']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['file']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['file']['error'];
                $_FILES['userfile']['size']= $_FILES['file']['size'];    
                
                $image=$_FILES['userfile']['name'];
                $path=  "uploads/agrmnt/".$image;
                $ret = move_uploaded_file($_FILES['userfile']['tmp_name'] ,$path);
            if($ret){                                       $this->aws->upload("",$path);                                   }

            $this->db->set('sign_file',$path);
            $this->db->set('updated_by',$this->session->user_id);
            $this->db->where('id', $enquiry_id);
            $this->db->update('tbl_aggriment'); 
            }
            $assign_data_noti[]=array('create_by'=> $noti_id,
                        'subject'=>'Agrrement Uploded By Student',
                        'query_id'=>$enq_id,
                        'task_date'=>date('d-m-Y'),
                        'task_time'=>date('H:i:s')
                        );
           $this->db->insert_batch('query_response',$assign_data_noti);
           $this->load->library('user_agent');
    redirect($this->agent->referrer());
    }
    /***********************end add aggriment***********************/

    /**************************Grenerate aggriment**************************/
    public function generate_aggrement() {
        $pdf_name = $this->input->post('agg_frmt');
        
        $enq_id = $this->input->post('enq_id');
        if($pdf_name=='BAA'){
            $data['title'] = 'Bangalore-Australia-Agreement';
            $this->load->helpers('dompdf');
            $data['client_aggrement_form'] = $this->location_model->get_client_form($enq_id,'CLIENT_AGREEMENT_DETAILS');
            $viewfile = $this->load->view('agreement/Bangalore-Australia-Agreement', $data, TRUE);
            pdf_create($viewfile,'Bangalore-Australia-Agreement'.$this->session->user_id);
            redirect($this->agent->referrer());
        }
    } 
    /***********************end Generate aggriment*****************************/
    
    /**************************Find Form**************************/
    public function read_form() {
        $pdf_name = $this->input->post('agg_frmt');
        $enq_no = $this->input->post('enq_id');
        
        $this->db->select('Enquery_id');
                    $this->db->from('enquiry');
                    $this->db->where('enquiry_id',$enq_no);
                    $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
        
        $data['all_country_list'] = $this->location_model->country();
        if($pdf_name=='CDF'){
            $data['enq_id'] = $enq_id;
            $data['client_aggrement_form'] = $this->location_model->get_client_form($enq_id,'CLIENT_AGREEMENT_DETAILS');
            $viewfile = $this->load->view('agreement_form/client_agreement_form', $data, TRUE);
            echo $viewfile;
        }
    } 
    /***********************end Find form*****************************/
/*******************************student update his profile********************************/
public function client_update_his_profile($phone_no = null)
    {  
    if(!empty($_POST)){
        
        if(!empty($_FILES['file']['name'])){         
        $this->load->library("aws");
                
                $_FILES['userfile']['name']= $_FILES['file']['name'];
                $_FILES['userfile']['type']= $_FILES['file']['type'];
                $_FILES['userfile']['tmp_name']= $_FILES['file']['tmp_name'];
                $_FILES['userfile']['error']= $_FILES['file']['error'];
                $_FILES['userfile']['size']= $_FILES['file']['size'];    
                
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
            $image=$this->input->post('new_file', true);
        }
        
    $name = $this->input->post('Name');
    $last_name = $this->input->post('last_name');
    $email = $this->input->post('email');
    $cell = $this->input->post('cell');
    $age = $this->input->post('age');
    $marital_status = $this->input->post('marital_status');
    $country = $this->input->post('country');
    $state_id = $this->input->post('state_id');
    $city_name = $this->input->post('city_name');
    $address = $this->input->post('address');

    $this->db->set('name',$name);
    $this->db->set('lastname',$last_name);
    $this->db->set('email',$email);
    $this->db->set('phone',$cell);
    $this->db->set('age',$age);
    $this->db->set('marital_status',$marital_status);
    $this->db->set('residing_country',$country);
    $this->db->set('state_id',$state_id);
    $this->db->set('city_id',$city_name);
    $this->db->set('address',$address);
    $this->db->where('phone',$phone_no);
    $this->db->update('enquiry');

    
    $this->db->set('s_display_name',$name);
    $this->db->set('last_name',$last_name);
    $this->db->set('s_user_email',$email);
    $this->db->set('s_phoneno',$cell);
    $this->db->set('country',$country);
    $this->db->set('state_id',$state_id);
    $this->db->set('city_id',$city_name);
    $this->db->set('add_ress',$address);
    $this->db->set('picture',$image);
    $this->db->where('s_phoneno',$phone_no);
    $this->db->update('tbl_admin');
 /*********************************************set session picture***********************************/   
$_SESSION['picture'] = $image;
/*********************************************set session picture end***********************************/
$enq_no = $this->db->select('enquiry_id')->from('enquiry')->where('phone',$phone_no)->get()->row();
    if(!in_array($this->session->userdata('user_right'), applicant)){
        redirect('enquiry/view/'.$enq_no->enquiry_id);
        }else{
        redirect('dashboard/user_profile/'.$enq_no->enquiry_id);
        }
    }
    }
/********************student update profile end**************************/
//Send Email/SMS Start
function create_client_portal_manual($move_enquiry) {

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
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Sent.', $q->Enquery_id,'0',$sender_row['pk_i_admin_id'],$new_message,'3','1',$email_subject);
                echo "Email Sent Successfully!";
                }else{
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Failed.', $q->Enquery_id,'0',$sender_row['pk_i_admin_id'],$new_message,'3','0',$email_subject);
                        echo "Something went wrong";                                
                }
//For bell notification
$z = explode(',',$q->all_assign);
foreach ($z as $key => $aa) {

            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->User_model->add_comment_for_student_user($q->Enquery_id,$aa,$email_subject,$stage_remark,$task_date,$task_time,$sender_row['pk_i_admin_id']);
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

//Send Email/SMS End
    }
}