<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Led extends CI_Controller {
    public function __construct() {
        parent::__construct();
       
         $this->load->model(
                array('Leads_Model','User_model','dash_model','enquiry_model','report_model','Taskstatus_model','location_model')
                );
        $this->load->library('email');
		$this->load->library('pagination');
        $this->load->library('user_agent');
        if (empty($this->session->user_id)) {
            redirect('login');
        }
    }

   	public function index() { 
        $this->session->unset_userdata('enquiry_filters_sess');
        $process_id = $this->session->userdata('process');
        if (user_role('70') == true) {}  
         if(!empty($this->session->enq_type)){
			$this->session->unset_userdata('enq_type',$this->session->enq_type);
		}		
        $this->load->model('Datasource_model'); 
        $data['title'] = display('lead_list');
		$data['user_list'] = $this->User_model->read2();
        $data['products'] = $this->dash_model->get_user_product_list();        
        $data['sourse'] = $this->report_model->all_source();
		$data['datasourse'] = $this->report_model->all_datasource();
        $data['drops'] 		= $this->enquiry_model->get_drop_list();
        $type = 2;		
	    $data['all_stage_lists'] = $this->Leads_Model->find_stage($type);
        
		$data['lead_score'] = $this->enquiry_model->get_leadscore_list();	
		$data['created_bylist'] = $this->User_model->read2();	
		$data['data_type'] = 2;
		$data['dfields']  = $this->enquiry_model-> getformfield();
		$data['subsource_list'] = $this->Datasource_model->subsourcelist();
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

    public function get_leadstage_list_byprocess(){

    	$id = $this->input->post('id');
        // print_r($id);exit();
    	$res = $this->Leads_Model->get_leadstage_list_byprocess1($id);

    	// print_r($res);exit();
    	$radio='';
    	if($res){

    		foreach ($res as $result) {

    			$radio .= "<input type='radio' value='".$result->stg_id."' id='".$result->lead_stage_name."' name='lead_stages'><label>".$result->lead_stage_name. "</label>";
    		
    		}

    	}
        // print_r($res);
    	 echo $radio;

    	 exit();

    }

    public function index1($all='') {
        if (user_role('60') == true) {}  
         if(!empty($this->session->enq_type)){
			$this->session->unset_userdata('enq_type',$this->session->enq_type);
		}		
        $data['title'] = display('lead_list');
		$data['user_list'] = $this->User_model->read();
		$data['drops'] = $this->Leads_Model->get_drop_list();
		 $data['lead_stages'] = $this->Leads_Model->get_leadstage_list();
		 $record=0;
		$recordPerPage =30;
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  
		$data['all_active'] = $this->Leads_Model->all_Active_lead('0', '*');
      	$recordCount = $data['all_active']->num_rows();
		$empRecord = $this->Leads_Model->all_Active_lead($record,$recordPerPage);
      	$config['base_url'] = base_url().'led/loadData';
      	$config['use_page_numbers'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['empData'] = $empRecord->result();
        $data['content'] = $this->load->view('leads', $data, true);
        $this->load->view('layout/main_wrapper', $data);
        }
	public function loaddata($record='',$type='') {
		if($type!=''){
			$this->session->set_userdata('enq_type',$type);
		}			
	    $recordPerPage =30;
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  
		$data['all_active'] = $this->Leads_Model->all_Active_lead('0', '*');
      	$recordCount = $data['all_active']->num_rows();
		$empRecord = $this->Leads_Model->all_Active_lead($record,$recordPerPage);
      	$config['base_url'] = base_url().'led/loadData';
      	$config['use_page_numbers'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['empData'] = $empRecord->result_array();

/*
		echo "<pre>";
		echo $this->db->last_query();
		echo "</pre>";*/


	 	echo json_encode($data);
	}
	   	public function stages_of_enq(){
	      $data['all_enquery_num'] = $this->Leads_Model->all_leadss()->num_rows();
          $data['all_drop_num'] = $this->Leads_Model->all_drop_lead()->num_rows();
          $data['all_active_num'] = $this->Leads_Model->all_Active_lead('0', '*')->num_rows();
          $data['all_today_update_num'] = $this->Leads_Model->all_Updated_today()->num_rows();
          $data['all_creaed_today_num'] = $this->Leads_Model->all_created_today()->num_rows();
	      echo json_encode($data);
		}
		
		public function lead_by_stage($satge='',$record='') {			
	    $recordPerPage =30;
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  
		$data['all_active'] = $this->Leads_Model->lead_by_stage('0', '*',$satge);
		/*echo "<pre>";
		echo $this->db->last_query();
		echo "</pre>";*/
        $recordCount = $data['all_active']->num_rows();
		$empRecord = $this->Leads_Model->lead_by_stage($record,$recordPerPage,$satge);
      	$config['base_url'] = base_url().'led/lead_by_stage/'.$satge;
      	$config['use_page_numbers'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['empData'] = $empRecord->result_array();
	 	echo json_encode($data);
	}
	
 
}
