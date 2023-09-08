<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Refund extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
		$this->load->library('aws');
		$this->load->library('upload');
		$this->lang->load("activitylogmsg","english");;
        
        $this->load->model(
                array('Leads_Model','Client_Model','common_model','enquiry_model', 'dashboard_model', 'Task_Model', 'User_model', 'location_model', 'Message_models','Institute_model','Datasource_model','Taskstatus_model','dash_model','Center_model','SubSource_model','Kyc_model','Education_model','SocialProfile_model','Closefemily_model','form_model','report_model','Configuration_Model','Doctor_model')
                );

        if (empty($this->session->user_id)) {
            redirect('login');
        }
    }

    /*public function index() {
        $this->session->unset_userdata('refund_filters_sess');        
        //if (user_role('80') == true) {}  
         if(!empty($this->session->enq_type)){
            $this->session->unset_userdata('enq_type',$this->session->enq_type);
        }       
        $this->load->model('Datasource_model');         
        $data['title'] = display('refund_list');
        $data['created_bylist'] = $this->User_model->read2();     
        $data['all_stage_lists'] = $this->Leads_Model->find_stage_api($this->session->userdata('companey_id'));
        $data['all_branch'] = $this->Leads_Model->branch_select();
        $data['all_country_list'] = $this->location_model->country();
        $data['tags'] = $this->enquiry_model->get_tags();
        
        $data['content'] = $this->load->view('refund_n_old', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }*/

    public function index() {
        $this->session->unset_userdata('enquiry_filters_sess');        
        //if (user_role('80') == true) {}  
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
            $data['title'] = 'Refund Case List';
            $data['data_type'] = 4;
        }
$type = 4;
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
        $data['all_estage_lists'] = $this->Leads_Model->find_estage($data['details']->product_id,4);
        $data['all_cstage_lists'] = $this->Leads_Model->find_cstage($data['details']->product_id,4);
        $data['data_type'] = '4';

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
        $data['all_description_lists']    =   $this->Leads_Model->find_description($data['details']->product_id,4);
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
            $data['title'] = display('refund_list');        
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
        $data['all_subject'] = $this->Leads_Model->ticket_subject_select();
        $data['desp_type'] = $this->Leads_Model->get_desptype_list();
        $data['content'] = $this->load->view('enquiry_details1', $data, true);
        $this->enquiry_model->assign_notification_update($enquiry_code);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function move_to_refund() {
        
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
                    $this->db->set('status', 4);
                    $this->db->where('enquiry_id', $key);
                    $this->db->update('enquiry');
                    
                    $this->load->model('rule_model');
                    $this->rule_model->execute_rules($enq->Enquery_id,array(1,2,3,6,7));  

                    $this->Leads_Model->add_comment_for_events("Move To Refund", $enq->Enquery_id);
                    $insert_id = $this->Leads_Model->LeadAdd($data);

                }
                 echo '1';
            }else{
                echo "Please Check Enquiry";
            }   
           
        } else {
            echo "Something Went Wrong";
        }
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
                    $this->Leads_Model->add_comment_for_events('Refund Assigned', $enquiry_code);
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
                        'subject'=>'Refund Case Assigned',
                        'create_by'=>$this->session->user_id,
                        'task_date'=>date('d-m-Y'),
                        'task_time'=>date('h:i:s'),
                        'task_remark'=>'New ('.count($move_enquiry).') Refund Case Assigned To You! Go To List And Check There.',
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

    public function pay_list() {
        $this->session->unset_userdata('payment_filters_sess');        
        //if (user_role('80') == true) {}  
         if(!empty($this->session->enq_type)){
            $this->session->unset_userdata('enq_type',$this->session->enq_type);
        }       
        $this->load->model('Datasource_model');         
        $data['title'] = display('payment_list');
        
        $data['content'] = $this->load->view('payment_n', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }


    public function payment_load_data(){

        $this->load->model('refund_datatable_model');
        $list = $this->refund_datatable_model->pay_get_datatables();
        //fetch country

        /*echo "<pre>";
        print_r($list);exit;
        echo "</pre>";*/
       
        $data = array();
        $no = $_POST['start'];      
        $acolarr = $dacolarr = array();
        if(isset($_COOKIE["pallowcols"])) {
            $showall = false;
            $acolarr  = explode(",", trim($_COOKIE["pallowcols"], ","));         
        }else{          
            $showall = true;
        }    
        if(isset($_COOKIE["pdallowcols"])) {
            $dshowall = false;
            $dacolarr  = explode(",", trim($_COOKIE["pdallowcols"], ","));       
        }
        if(!empty($enqarr) and !empty($dacolarr)) {
        }

        foreach ($list as $each) { 
            
            $no++;        
            $row = array();        
 
            $row[] = $no;

            if ($showall == true or in_array(1, $acolarr)) { 
                $row[] = (!empty($each->name)) ? $each->name_prefix . " " . $each->name . " " . $each->lastname : "NA";   
            }

            if ($showall == true or in_array(2, $acolarr)) {
                $row[] = (!empty($each->pay_email)) ? $each->pay_email : "NA";
            }

            if ($showall == true or in_array(3, $acolarr)) { 
                $row[] = (!empty($each->pay_mobile)) ? $each->pay_mobile : "NA";
            }

            if ($showall == true or in_array(4, $acolarr)) { 
                $row[] = (!empty($each->txnid)) ? $each->txnid : "NA";
            }

            if ($showall == true or in_array(5, $acolarr)) { 
                $row[] = (!empty($each->amount)) ? $each->amount : "NA";
            }

            /*if ($showall == true or in_array(6, $acolarr)) { 
                $row[] = (!empty($each->response)) ? $each->response : "NA";
            }*/

            if ($showall == true or in_array(7, $acolarr)) { 
                $row[] = (!empty($each->created_date)) ? $each->created_date : "NA";
            }

            $data[] = $row;
        }      
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->refund_datatable_model->pay_count_all(),
            "recordsFiltered" => $this->refund_datatable_model->pay_count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function refund_load_data(){
        $country=$this->db->where('comp_id',$this->session->companey_id)->get('tbl_country')->result();
        $this->load->model('refund_datatable_model');
        $list = $this->refund_datatable_model->get_datatables();
        //fetch country

        /*echo "<pre>";
        print_r($list);
        echo "</pre>";*/

        $dfields = $this->enquiry_model->getformfield();       
        $data = array();
        $no = $_POST['start'];      
        $acolarr = $dacolarr = array();
        if(isset($_COOKIE["rallowcols"])) {
            $showall = false;
            $acolarr  = explode(",", trim($_COOKIE["rallowcols"], ","));         
        }else{          
            $showall = true;
        }    
        if(isset($_COOKIE["rdallowcols"])) {
            $dshowall = false;
            $dacolarr  = explode(",", trim($_COOKIE["rdallowcols"], ","));       
        }
        if(!empty($enqarr) and !empty($dacolarr)) {
        }
        $fieldval =  $this->enquiry_model->getfieldvalue();
        foreach ($list as $each) { 
            
            $no++;        
            $row = array();        
            $row[] = "<input onclick='event.stopPropagation();'' type='checkbox' name='enquiry_id[]'' class='checkbox1' value=".$each->enquiry_id.">";
            $row[] = $no;
$now = time(); // or your date as well
$your_date = strtotime($each->created_date);
$datediff = $now - $your_date;
$days = round($datediff / (60 * 60 * 24));
            $row[] = '<a class="badge" href="javascript:void(0)" style="background:red;">'.$days.'</a>';
            if ($showall == true or in_array(1, $acolarr)) { 
                $row[] = (!empty($each->refund_enq)) ? $each->refund_enq : "NA";          
            }

            if ($showall == true or in_array(2, $acolarr)) {
                $thtml = '';
                if(!empty($each->refund_tagids)){
                    $this->db->select('title,color,id');
                    $this->db->where("id IN(".$each->refund_tagids.")");
                    $tags = $this->db->get('tags')->result_array();
                    if(!empty($tags)){
                        foreach ($tags as $key => $value) {
                            $thtml .= '<br><a class="badge" href="javascript:void(0)" style="background:'.$value['color'].';padding:4px;">'.$value['title'].'</a><a href="'.base_url('refund/drop_tag/') . $value['id'].'/'.$each->enquiry_id.'"
                              id="tagDrop" data-id="'.$value['id'].'" data-enq="'.$each->enquiry_id.'"
                              class="text-danger" title="Drop Tag"><i class="fa fa-close"></i></a>';
                        }
                    }
                }
                $row[] = $each->name_prefix . " " . $each->name . " " . $each->lastname.' '.$thtml;
            }

            if ($showall == true or in_array(3, $acolarr)) { 
                $row[] = (!empty($each->email)) ? $each->email : "NA";          
            }
            if ($showall == true or in_array(4, $acolarr)) { 
                $p = $each->phone;
                if (user_access(450)) {
                    $p = '##########';
                }
                if(user_access(220)){
                    $row[] = "<a href='javascript:void(0)' onclick='send_parameters(".$each->phone.")'>".$p." <button class='fa fa-phone btn btn-xs btn-success'></button></a>";                
                }else{
                    $row[] = (!empty($each->phone)) ? '<a  href="tel:'.$p.'">'.$p.'</a>' : "NA";
                }
            }

            if ($showall == true or in_array(5, $acolarr)) { 
                $row[] = (!empty($each->created_date)) ? $each->created_date : "NA";
            }

            if ($showall == true or in_array(6, $acolarr)) { 
                $row[] = (!empty($each->created_by_name)) ? $each->created_by_name : "NA";
            }

            if ($showall == true or in_array(7, $acolarr)) { 
                $row[] = (!empty($each->assign_to_name)) ? $each->assign_to_name : "NA";
            }

            if ($showall == true or in_array(8, $acolarr)) { 
                $row[] = (!empty($each->r_remark)) ? $each->r_remark : "NA";
            }

            if ($showall == true or in_array(9, $acolarr)) { 
                $row[] = (!empty($each->branch_name)) ? $each->branch_name : "NA";          

            }
                                
            if ($showall == true or in_array(10, $acolarr)) { 
            
                $row[] = (!empty($each->final_country)) ? $each->final_country : "NA";          

             }

            if ($showall == true or in_array(11, $acolarr)) {
            if($each->status==1){
                $status = 'Onboarding';
            }else if($each->status==2){
                $status = 'Application';
            }else if($each->status==3){
                $status = 'Case Management';
            }else{
                $status = 'N/A';
            }
                $row[] = '<a class="badge" href="javascript:void(0)" style="background:#337ab7;">'.$status.'</a>';          

             }

             if ($showall == true or in_array(12, $acolarr)) { 
            
                $row[] = (!empty($each->lead_stage_name)) ? $each->lead_stage_name : "NA";          

             }
            $data[] = $row;
        }      
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->refund_datatable_model->count_all(),
            "recordsFiltered" => $this->refund_datatable_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
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
                    $this->db->set('refund_tagids',$tags);
                    $this->db->update('enquiry_tags');
                }else{
                    $this->db->insert('enquiry_tags',array('comp_id'=>$this->session->companey_id,'enq_id'=>$value,'refund_tagids'=>$tags));
                }
            }
            echo json_encode(array('status'=>true,'msg' =>'Tag marked successfully'));
        }else{
            echo json_encode(array('status'=>false,'msg' =>validation_errors()));
        }

    }

    function drop_tag($tid='',$enqid='')
    {

        $id[] = $tid;
        $enq_id = $enqid;

        $this->db->select('refund_tagids');
        $this->db->from('enquiry_tags');
        $this->db->where('enq_id', $enq_id);
        $res = $this->db->get()->row()->refund_tagids;
        $abc = explode(',', $res);
        $result = array_diff($abc, $id);

        $data = implode(",", $result);


        $this->db->where('enq_id', $enq_id);
        $this->db->set('refund_tagids', $data);
        $this->db->update('enquiry_tags');
redirect('refund');

    }
}
