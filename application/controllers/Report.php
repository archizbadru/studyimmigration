<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'report_model',
            'doctor_model',
            'representative_model',
            'User_model',
            'Leads_Model',
            'dash_model',
            'location_model',
            'Taskstatus_model'
        ));
        $this->load->library('pagination');
    }
        public function index(){
         
            $data['title'] = display('reports_list');
            $data['reports'] = $this->report_model->get_all_reports('1');
            $data['content'] = $this->load->view('reports/index', $data, true);        
            $this->load->view('layout/main_wrapper', $data);
        }

  public function account_report_list()
    {
        $data['title'] = "Account Management Report";
        $data['reports'] = $this->report_model->get_all_reports('2');             
        $data['content'] = $this->load->view('reports/account_report_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

  public function case_report_list()
    {
        $data['title'] = "CASE Management Report";
        $data['reports'] = $this->report_model->get_all_reports('3');            
        $data['content'] = $this->load->view('reports/case_report_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

  public function legal_report_list()
    {
        $data['title'] = "Legal Management Report";
        $data['reports'] = $this->report_model->get_all_reports('4');            
        $data['content'] = $this->load->view('reports/legal_report_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

  public function call_report()
    {
        $data['title'] = "Telephony Report";
        $data['reports'] = $this->report_model->get_all_reports('5');            
        $data['content'] = $this->load->view('reports/call_report', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function telephony_mgmt()
  {
    
    $data['title'] = 'Report';

            if($this->input->post('from_exp')==''){
             $from ='';  
            }else{
           $dfrom= $this->input->post('from_exp');
           $from = date("d/m/Y", strtotime($dfrom));
            }
            if($this->input->post('to_exp')==''){
                $to ='';
            }else{
               $tto= $this->input->post('to_exp');
               $to = date("d/m/Y", strtotime($tto)); 
            }
            if($this->input->post('employee')==''){
                $employe ='';
            }else{
               $employe= $this->input->post('employee');
            }
            if($this->input->post('phone')==''){
                $phone ='';
            }else{
               $phone= $this->input->post('phone');
            }
            if($this->input->post('country')==''){
                $country ='';
            }else{
               $country= $this->input->post('country');
            }
            
            if($this->input->post('source')==''){
                $source ='';
            }else{
               $source= $this->input->post('source');
            }
            
            if($this->input->post('state')==''){
                $state ='';
            }else{
               $state= $this->input->post('state');
            }
            if($this->input->post('lead_source')==''){ // disposition
              $lead_source = '';
            }else{
               $lead_source = $this->input->post('lead_source');
            }

            if($this->input->post('final_country')==''){ // disposition
              $final_country = '';
            }else{
               $final_country = $this->input->post('final_country');
            }

            if($this->input->post('in_take')==''){ // disposition
              $in_take = '';
            }else{
               $in_take = $this->input->post('in_take');
            }

            if($this->input->post('visa_type')==''){ // disposition
              $visa_type = '';
            }else{
               $visa_type = $this->input->post('visa_type');
            }

            if($this->input->post('preferred_country')==''){ // disposition
              $preferred_country = '';
            }else{
               $preferred_country = $this->input->post('preferred_country');
            }

            if($this->input->post('nationality')==''){ // disposition
              $nationality = '';
            }else{
               $nationality = $this->input->post('nationality');
            }

            if($this->input->post('residing_country')==''){ // disposition
              $residing_country = '';
            }else{
               $residing_country = $this->input->post('residing_country');
            }

            if($this->input->post('branch_name')==''){ // disposition
              $branch_name = '';
            }else{
               $branch_name = $this->input->post('branch_name');
            }
         
            if($this->input->post('enq_product')==''){
                $enq_product = '';
            }else{
               $enq_product = $this->input->post('enq_product');
            }
            if($this->input->post('productlst')==''){
                $productlst = '';
            }else{
               $productlst = $this->input->post('productlst');
            }
            if($this->input->post('drop_status')==''){
                $drop_status = '';
            }else{
               $drop_status = $this->input->post('drop_status');
            }

            if($this->input->post('hier_wise')==''){
                $hier_wise = '';
            }else{
               $hier_wise = $this->input->post('hier_wise');
            }
            
            $data['post_report_columns'] = $this->input->post('report_columns');
             $post_report_columns = $this->input->post('report_columns');
            if($this->input->post('all')==''){ // follow up report
                $all = '';
            }else{
               $all = $this->input->post('all');
            }        
            $data_arr = array(
   
            'final_country1'  =>  $final_country,
            'in_take1'        =>  $in_take,
            'visa_type1'      =>  $visa_type,
            'preferred_country1'  =>  $preferred_country,
            'nationality1'    =>  $nationality,
            'residing_country1'  =>  $residing_country,
            'branch_name1'    =>  $branch_name,
            'from1'           =>  $from,
            'to1'             =>  $to,
            'employe1'        =>  $employe,
            'phone1'          =>  $phone,
            'country1'        =>  $country,
            'source1'         =>  $source,
            'state1'          =>  $state,
            'lead_source1'    =>  $lead_source,
            'enq_product1'    =>  $enq_product,
            'drop_status1'    =>  $drop_status,
            'all1'            =>  $all, 
            'post_report_columns'=>$post_report_columns,
            'productlst'=>$productlst,
            'hier_wise' => $hier_wise
            );
            $this->session->set_userdata($data_arr);   
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        $data['sourse'] = $this->report_model->all_source();
        $this->load->model('User_model');
        $data['employee'] =$this->User_model->read2();
        $data['process'] = $this->dash_model->product_list();
        $data['all_branch_list'] = $this->location_model->branch();  
        $data['products'] = $this->location_model->productcountry();
        $data['allcountry_list'] = $this->Taskstatus_model->countrylist();
        $data['all_country_list'] = $this->location_model->country();
        $data['visa_type'] = $this->Leads_Model->visa_type_select();
    $data['content'] = $this->load->view('reports/telyphony_report', $data, true);
    $this->load->view('layout/main_wrapper', $data);
  }

  public function legal_mgmt()
  {
    
    $data['title'] = 'Report';

            if($this->input->post('from_exp')==''){
             $from ='';  
            }else{
           $dfrom= $this->input->post('from_exp');
           $from = date("d/m/Y", strtotime($dfrom));
            }
            if($this->input->post('to_exp')==''){
                $to ='';
            }else{
               $tto= $this->input->post('to_exp');
               $to = date("d/m/Y", strtotime($tto)); 
            }
            if($this->input->post('employee')==''){
                $employe ='';
            }else{
               $employe= $this->input->post('employee');
            }
             if($this->input->post('phone')==''){
                $phone ='';
            }else{
               $phone= $this->input->post('phone');
            }
              if($this->input->post('country')==''){
                $country ='';
            }else{
               $country= $this->input->post('country');
            }
            
            if($this->input->post('source')==''){
                $source ='';
            }else{
               $source= $this->input->post('source');
            }
            
            if($this->input->post('state')==''){
                $state ='';
            }else{
               $state= $this->input->post('state');
            }
            if($this->input->post('lead_source')==''){ // disposition
              $lead_source = '';
            }else{
               $lead_source = $this->input->post('lead_source');
            }

            if($this->input->post('final_country')==''){ // disposition
              $final_country = '';
            }else{
               $final_country = $this->input->post('final_country');
            }

            if($this->input->post('in_take')==''){ // disposition
              $in_take = '';
            }else{
               $in_take = $this->input->post('in_take');
            }

            if($this->input->post('visa_type')==''){ // disposition
              $visa_type = '';
            }else{
               $visa_type = $this->input->post('visa_type');
            }

            if($this->input->post('preferred_country')==''){ // disposition
              $preferred_country = '';
            }else{
               $preferred_country = $this->input->post('preferred_country');
            }

            if($this->input->post('nationality')==''){ // disposition
              $nationality = '';
            }else{
               $nationality = $this->input->post('nationality');
            }

            if($this->input->post('residing_country')==''){ // disposition
              $residing_country = '';
            }else{
               $residing_country = $this->input->post('residing_country');
            }

            if($this->input->post('branch_name')==''){ // disposition
              $branch_name = '';
            }else{
               $branch_name = $this->input->post('branch_name');
            }
         
            if($this->input->post('enq_product')==''){
                $enq_product = '';
            }else{
               $enq_product = $this->input->post('enq_product');
            }
            if($this->input->post('productlst')==''){
                $productlst = '';
            }else{
               $productlst = $this->input->post('productlst');
            }
            if($this->input->post('drop_status')==''){
                $drop_status = '';
            }else{
               $drop_status = $this->input->post('drop_status');
            }

            if($this->input->post('hier_wise')==''){
                $hier_wise = '';
            }else{
               $hier_wise = $this->input->post('hier_wise');
            }
            
            $data['post_report_columns'] = $this->input->post('report_columns');
             $post_report_columns = $this->input->post('report_columns');
            if($this->input->post('all')==''){ // follow up report
                $all = '';
            }else{
               $all = $this->input->post('all');
            }        
            $data_arr = array(
   
            'final_country1'  =>  $final_country,
            'in_take1'        =>  $in_take,
            'visa_type1'      =>  $visa_type,
            'preferred_country1'  =>  $preferred_country,
            'nationality1'    =>  $nationality,
            'residing_country1'  =>  $residing_country,
            'branch_name1'    =>  $branch_name,
            'from1'           =>  $from,
            'to1'             =>  $to,
            'employe1'        =>  $employe,
            'phone1'          =>  $phone,
            'country1'        =>  $country,
            'source1'         =>  $source,
            'state1'          =>  $state,
            'lead_source1'    =>  $lead_source,
            'enq_product1'    =>  $enq_product,
            'drop_status1'    =>  $drop_status,
            'all1'            =>  $all, 
            'post_report_columns'=>$post_report_columns,
            'productlst'=>$productlst,
            'hier_wise' => $hier_wise
            );
            $this->session->set_userdata($data_arr);
        /*$productlst = implode(',',$this->session->process);
        if(count($this->session->process)>1){
        echo 'Please Select One Process For Report Access';exit;
        }*/    
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        //$data['all_sub_stage_lists'] = $this->Leads_Model->find_description();
        $data['sourse'] = $this->report_model->all_source();
        $this->load->model('User_model');
        $data['employee'] =$this->User_model->read2();
        $data['process'] = $this->dash_model->product_list();
        $data['all_branch_list'] = $this->location_model->branch();  
        $data['products'] = $this->location_model->productcountry();
        $data['allcountry_list'] = $this->Taskstatus_model->countrylist();
        $data['all_country_list'] = $this->location_model->country();
        $data['visa_type'] = $this->Leads_Model->visa_type_select();
    $data['content'] = $this->load->view('reports/legal_report', $data, true);
    $this->load->view('layout/main_wrapper', $data);
  }

  public function case_mgmt()
  {
    
    $data['title'] = 'Report';

            if($this->input->post('from_exp')==''){
             $from ='';  
            }else{
           $dfrom= $this->input->post('from_exp');
           $from = date("d/m/Y", strtotime($dfrom));
            }
            if($this->input->post('to_exp')==''){
                $to ='';
            }else{
               $tto= $this->input->post('to_exp');
               $to = date("d/m/Y", strtotime($tto)); 
            }
            if($this->input->post('employee')==''){
                $employe ='';
            }else{
               $employe= $this->input->post('employee');
            }
             if($this->input->post('phone')==''){
                $phone ='';
            }else{
               $phone= $this->input->post('phone');
            }
              if($this->input->post('country')==''){
                $country ='';
            }else{
               $country= $this->input->post('country');
            }
            
            if($this->input->post('source')==''){
                $source ='';
            }else{
               $source= $this->input->post('source');
            }
            
            if($this->input->post('state')==''){
                $state ='';
            }else{
               $state= $this->input->post('state');
            }
            if($this->input->post('lead_source')==''){ // disposition
              $lead_source = '';
            }else{
               $lead_source = $this->input->post('lead_source');
            }

            if($this->input->post('final_country')==''){ // disposition
              $final_country = '';
            }else{
               $final_country = $this->input->post('final_country');
            }

            if($this->input->post('in_take')==''){ // disposition
              $in_take = '';
            }else{
               $in_take = $this->input->post('in_take');
            }

            if($this->input->post('visa_type')==''){ // disposition
              $visa_type = '';
            }else{
               $visa_type = $this->input->post('visa_type');
            }

            if($this->input->post('preferred_country')==''){ // disposition
              $preferred_country = '';
            }else{
               $preferred_country = $this->input->post('preferred_country');
            }

            if($this->input->post('nationality')==''){ // disposition
              $nationality = '';
            }else{
               $nationality = $this->input->post('nationality');
            }

            if($this->input->post('residing_country')==''){ // disposition
              $residing_country = '';
            }else{
               $residing_country = $this->input->post('residing_country');
            }

            if($this->input->post('branch_name')==''){ // disposition
              $branch_name = '';
            }else{
               $branch_name = $this->input->post('branch_name');
            }
         
            if($this->input->post('enq_product')==''){
                $enq_product = '';
            }else{
               $enq_product = $this->input->post('enq_product');
            }
            if($this->input->post('productlst')==''){
                $productlst = '';
            }else{
               $productlst = $this->input->post('productlst');
            }
            if($this->input->post('drop_status')==''){
                $drop_status = '';
            }else{
               $drop_status = $this->input->post('drop_status');
            }

            if($this->input->post('hier_wise')==''){
                $hier_wise = '';
            }else{
               $hier_wise = $this->input->post('hier_wise');
            }
            
            $data['post_report_columns'] = $this->input->post('report_columns');
             $post_report_columns = $this->input->post('report_columns');
            if($this->input->post('all')==''){ // follow up report
                $all = '';
            }else{
               $all = $this->input->post('all');
            }        
            $data_arr = array(
   
            'final_country1'  =>  $final_country,
            'in_take1'        =>  $in_take,
            'visa_type1'      =>  $visa_type,
            'preferred_country1'  =>  $preferred_country,
            'nationality1'    =>  $nationality,
            'residing_country1'  =>  $residing_country,
            'branch_name1'    =>  $branch_name,
            'from1'           =>  $from,
            'to1'             =>  $to,
            'employe1'        =>  $employe,
            'phone1'          =>  $phone,
            'country1'        =>  $country,
            'source1'         =>  $source,
            'state1'          =>  $state,
            'lead_source1'    =>  $lead_source,
            'enq_product1'    =>  $enq_product,
            'drop_status1'    =>  $drop_status,
            'all1'            =>  $all, 
            'post_report_columns'=>$post_report_columns,
            'productlst'=>$productlst,
            'hier_wise' => $hier_wise
            );
            $this->session->set_userdata($data_arr);
        /*$productlst = implode(',',$this->session->process);
        if(count($this->session->process)>1){
        echo 'Please Select One Process For Report Access';exit;
        }*/   
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        //$data['all_sub_stage_lists'] = $this->Leads_Model->find_description();
        $data['sourse'] = $this->report_model->all_source();
        $this->load->model('User_model');
        $data['employee'] =$this->User_model->read2();
        $data['process'] = $this->dash_model->product_list();
        $data['all_branch_list'] = $this->location_model->branch();  
        $data['products'] = $this->location_model->productcountry();
        $data['allcountry_list'] = $this->Taskstatus_model->countrylist();
        $data['all_country_list'] = $this->location_model->country();
        $data['visa_type'] = $this->Leads_Model->visa_type_select();
    $data['content'] = $this->load->view('reports/case_report', $data, true);
    $this->load->view('layout/main_wrapper', $data);
  }

    public function account_mgmt()
  {
    
    $data['title'] = 'Report';

            if($this->input->post('from_exp')==''){
             $from ='';  
            }else{
           $dfrom= $this->input->post('from_exp');
           $from = date("d/m/Y", strtotime($dfrom));
            }
            if($this->input->post('to_exp')==''){
                $to ='';
            }else{
               $tto= $this->input->post('to_exp');
               $to = date("d/m/Y", strtotime($tto)); 
            }
            if($this->input->post('employee')==''){
                $employe ='';
            }else{
               $employe= $this->input->post('employee');
            }
             if($this->input->post('phone')==''){
                $phone ='';
            }else{
               $phone= $this->input->post('phone');
            }
              if($this->input->post('country')==''){
                $country ='';
            }else{
               $country= $this->input->post('country');
            }
            
            if($this->input->post('source')==''){
                $source ='';
            }else{
               $source= $this->input->post('source');
            }
            
            if($this->input->post('state')==''){
                $state ='';
            }else{
               $state= $this->input->post('state');
            }
            if($this->input->post('lead_source')==''){ // disposition
              $lead_source = '';
            }else{
               $lead_source = $this->input->post('lead_source');
            }

            if($this->input->post('final_country')==''){ // disposition
              $final_country = '';
            }else{
               $final_country = $this->input->post('final_country');
            }

            if($this->input->post('in_take')==''){ // disposition
              $in_take = '';
            }else{
               $in_take = $this->input->post('in_take');
            }

            if($this->input->post('visa_type')==''){ // disposition
              $visa_type = '';
            }else{
               $visa_type = $this->input->post('visa_type');
            }

            if($this->input->post('preferred_country')==''){ // disposition
              $preferred_country = '';
            }else{
               $preferred_country = $this->input->post('preferred_country');
            }

            if($this->input->post('nationality')==''){ // disposition
              $nationality = '';
            }else{
               $nationality = $this->input->post('nationality');
            }

            if($this->input->post('residing_country')==''){ // disposition
              $residing_country = '';
            }else{
               $residing_country = $this->input->post('residing_country');
            }

            if($this->input->post('branch_name')==''){ // disposition
              $branch_name = '';
            }else{
               $branch_name = $this->input->post('branch_name');
            }
         
            if($this->input->post('enq_product')==''){
                $enq_product = '';
            }else{
               $enq_product = $this->input->post('enq_product');
            }
            if($this->input->post('productlst')==''){
                $productlst = '';
            }else{
               $productlst = $this->input->post('productlst');
            }
            if($this->input->post('drop_status')==''){
                $drop_status = '';
            }else{
               $drop_status = $this->input->post('drop_status');
            }

            if($this->input->post('hier_wise')==''){
                $hier_wise = '';
            }else{
               $hier_wise = $this->input->post('hier_wise');
            }
            
            $data['post_report_columns'] = $this->input->post('report_columns');
             $post_report_columns = $this->input->post('report_columns');
            if($this->input->post('all')==''){ // follow up report
                $all = '';
            }else{
               $all = $this->input->post('all');
            }        
            $data_arr = array(
   
            'final_country1'  =>  $final_country,
            'in_take1'        =>  $in_take,
            'visa_type1'      =>  $visa_type,
            'preferred_country1'  =>  $preferred_country,
            'nationality1'    =>  $nationality,
            'residing_country1'  =>  $residing_country,
            'branch_name1'    =>  $branch_name,
            'from1'           =>  $from,
            'to1'             =>  $to,
            'employe1'        =>  $employe,
            'phone1'          =>  $phone,
            'country1'        =>  $country,
            'source1'         =>  $source,
            'state1'          =>  $state,
            'lead_source1'    =>  $lead_source,
            'enq_product1'    =>  $enq_product,
            'drop_status1'    =>  $drop_status,
            'all1'            =>  $all, 
            'post_report_columns'=>$post_report_columns,
            'productlst'=>$productlst,
            'hier_wise' => $hier_wise
            );
            $this->session->set_userdata($data_arr);
        /*$productlst = implode(',',$this->session->process);
        if(count($this->session->process)>1){
        echo 'Please Select One Process For Report Access';exit;
        }*/    
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        //$data['all_sub_stage_lists'] = $this->Leads_Model->find_description($productlst);
        $data['sourse'] = $this->report_model->all_source();
        $this->load->model('User_model');
        $data['employee'] =$this->User_model->read2();
        $data['process'] = $this->dash_model->product_list();
        $data['all_branch_list'] = $this->location_model->branch();  
        $data['products'] = $this->location_model->productcountry();
        $data['allcountry_list'] = $this->Taskstatus_model->countrylist();
        $data['all_country_list'] = $this->location_model->country();
        $data['visa_type'] = $this->Leads_Model->visa_type_select();
    $data['content'] = $this->load->view('reports/account_report', $data, true);
    $this->load->view('layout/main_wrapper', $data);
  }


        public function view($id){ 
            $data['rid'] = $id;
            $data['type'] = $this->uri->segment(5);
            $this->session->set_userdata('reportid',$id);
            $this->db->where('id',$id);
            $report_row =   $this->db->get('reports')->row_array();             
            $filters = json_decode($report_row['filters'],true); 
            $from = $this->session->set_userdata('fromdt',$this->input->post("from"));
            $to =  $this->session->set_userdata('todt',$this->input->post("to"));                                         
            $data['title'] = 'View Report';
            $data['from'] = $this->input->post("from");
            $data['to'] = $this->input->post("to");
            $data['filters'] = $filters;
            $data['report_columns'] = $filters['report_columns'];
            //$data["fieldsval"]        = $this->report_model->getdynfielsval();  
            //$data["dfields"] = $this->report_model->get_dynfields("");
            $data['content'] = $this->load->view('reports/report_view', $data, true);        
            $this->load->view('layout/main_wrapper', $data);
        }
         public function report_view_data($keyword){
            // $fieldsval  = $this->report_model->getdynfielsval();  
            // $dfields    = $this->report_model->get_dynfields("");
            $this->load->model('report_datatable_model');            
            $no = $_POST['start'];
            $this->db->where('id',$this->session->userdata('reportid'));
            $report_row =   $this->db->get('reports')->row_array();             
            $filters = json_decode($report_row['filters'],true);  
            $filters1 = $filters;
            $report_columns = $filters1['report_columns'];      
         
            $data['from'] = '';
            $data['to'] = '';
            $from = $this->session->userdata('fromdt');
            $to =  $this->session->userdata('todt');
            if($from && $to){
                $from = date("d/m/Y", strtotime($from));
                $to = date("d/m/Y", strtotime($to)); 
            }else{                
                if(empty($filters['from_exp'])){
                    $from ='';  
                }else{
                    $dfrom= $filters['from_exp'];
                    $from = date("d/m/Y", strtotime($dfrom));
                    $from1= $filters['from_exp'];
                    $data['from'] = $from1;
                }
                if(empty($filters['to_exp'])){
                    $to ='';
                }else{
                   $tto= $filters['to_exp'];
                   $to = date("d/m/Y", strtotime($tto)); 
                   $to1= $filters['to_exp'];
                    $data['to'] = $to1;
                }
            }
            if(empty($filters['employee'])){
                $employe ='';
            }else{
               $employe= $filters['employee'];
            }
            if(empty($filters['phone'])){
                $phone ='';
            }else{
               $phone= $filters['phone'];
            }
            if(empty($filters['country'])){
                $country ='';
            }else{
               $country= $filters['country'];
            }
            if(empty($filters['institute'])){
                $institute ='';
            }else{
               $institute= $filters['institute'];
            }
            if(empty($filters['center'])){
                $center ='';
            }else{
               $center= $filters['center'];
            }
            if(empty($filters['source'])){
                $source ='';
            }else{
               $source= $filters['source'];
            }
            if(empty($filters['subsource'])){
                $subsource ='';
            }else{
               $subsource= $filters['source'];
            }
            if(empty($filters['datasource'])){
                $datasource ='';
            }else{
               $datasource= $filters['datasource'];
            }
            if(empty($filters['state'])){
                $state ='';
            }else{
               $state= $filters['state'];
            }
            if(empty($filters['lead_source'])){
                $lead_source = '';
            }else{
               $lead_source = $filters['lead_source'];
            }            
            if(empty($filters['lead_subsource'])){
                $lead_subsource = '';
            }else{
               $lead_subsource = $filters['lead_subsource'];
            }
            if(empty($filters['enq_product'])){
                $enq_product = '';
            }else{
               $enq_product = $filters['enq_product'];
            }
            if(empty($filters['drop_status'])){
                $drop_status = '';
            }else{
               $drop_status = $filters['drop_status'];
            }            
            if(empty($filters['all'])){ // follow up report
                $all = '';
            }else{
               $all = $filters['all'];
            }

            if(empty($filters['final_country'])){
                $final_country = '';
            }else{
               $final_country = $filters['final_country'];
            }

            if(empty($filters['branch_name'])){
                $branch_name = '';
            }else{
               $branch_name = $filters['branch_name'];
            }

            if(empty($filters['rep_type'])){
                $rep_type = '';
            }else{
               $rep_type = $filters['rep_type'];
            }
            $rep_details = $this->report_datatable_model->get_datatables($keyword,$from,$to,$employe,$phone,$country,$institute,$center,$source,$subsource,$datasource,$state,$lead_source,$lead_subsource,$enq_product,$drop_status,$all,$final_country,$rep_type,$branch_name);
            $i=1;
            $data = array();
           foreach ($rep_details as  $repdetails) {

//telephony data json start

      $call_data = $repdetails->call_json;
      $call_data_array = json_decode($call_data);
      $new_array = $call_data_array->answered_agent??0;

  $seconds  = $call_data_array->duration??0;
  $hours    = floor($seconds / 3600);
  $minutes  = floor(($seconds / 60) % 60);
  $seconds  = $seconds % 60;
  $duration = $hours.':'.$minutes.':'.$seconds;

//telephony data json end

            $no++;
            $row = array(); 
        
             if (in_array('S.No', $report_columns)){
                $row[] = $i++;
             }
             if (in_array('Name', $report_columns)) { 
              $row[] = $repdetails->name_prefix . " " . $repdetails->name . " " . $repdetails->lastname;
              }
              if (in_array('Phone', $report_columns)) {
                  if (user_access(450)) {
                    $row[] = '##########';                    
                  }else{
                    $row[] = $repdetails->phone;
                  }
              }
              if (in_array('Email', $report_columns)){
                $row[] = $repdetails->email;
              }
              if (in_array('Created By', $report_columns)) {
                $row[] = $repdetails->created_by_name;
              }
              if (in_array('Assign To', $report_columns)){
                $row[] = (!empty($repdetails->assign_to_name))?$repdetails->assign_to_name:'NA'; 
              }
              if (in_array('Gender', $report_columns)) {
                 if ($repdetails->gender == 1) {
                 $gender = 'Male';
                } else if ($repdetails->gender == 2) {
                $gender = 'Female';
                } else {
                $gender = 'Other';
                }
                $row[] = $gender;
              }
              if (in_array('Source', $report_columns)) {
                $row[] = (!empty($repdetails->lead_name))?$repdetails->lead_name:'NA';
              }
              if (in_array('Subsource', $report_columns)){
                $row[] = (!empty($repdetails->subsource_name)) ? $repdetails->subsource_name:'NA'; 
              }
               if (in_array('Disposition', $report_columns)){
                  $row[] = (!empty($repdetails->followup_name)) ? $repdetails->followup_name:'NA';
               }
              if (in_array('Lead Description', $report_columns)){
                $row[] = (!empty($repdetails->description)) ? $repdetails->description :"NA"; 
              }

              if (in_array('Disposition Remark', $report_columns)){
                $row[] = (!empty($repdetails->lead_discription_reamrk)) ? $repdetails->lead_discription_reamrk :"NA"; 
              }

              if (in_array('Drop Reason', $report_columns)){
                $row[] = (!empty($repdetails->drop_status)) ? $repdetails->drop_status :"NA"; 
              }

              if (in_array('Drop Comment', $report_columns)){
                $row[] = (!empty($repdetails->drop_reason)) ? $repdetails->drop_reason :"NA"; 
              }
              if (in_array('Conversion Probability', $report_columns)){
                $row[] = (!empty($repdetails->lead_score)) ? $repdetails->lead_score :"NA"; 
              }
              if (in_array('Remark', $report_columns)){
                $row[] = (!empty($repdetails->enq_remark)) ? $repdetails->enq_remark :"NA"; 
              }              

              if (in_array('Status', $report_columns)) {
                 if ($repdetails->status == 1) {
                 $status = 'Enquiry';
                 } else if ($repdetails->status == 2) {
                 $status = 'Lead';
                 } else {
                 $status = 'Client';
                 }
                 $row[] = $status;
              }
               if (in_array('DOE', $report_columns)) {
                $row[] = $repdetails->inq_created_date;
               }
               if (in_array('Process', $report_columns)) {
               $row[] =  (!empty($repdetails->product_name)) ?$repdetails->product_name:'NA'; 
               }
               if (in_array('Updated Date', $report_columns)){
                $row[] = $repdetails->update_date; 
               }
               if (in_array('State', $report_columns)){
                  $row[] = (!empty($repdetails->state_id)) ? $repdetails->state_id:'NA';
               }
                if (in_array('City', $report_columns)){
                  $row[] = (!empty($repdetails->city_id)) ? $repdetails->city_id:'NA';
               }
               if (in_array('Company Name', $report_columns)){
                  $row[] = (!empty($repdetails->company)) ? $repdetails->company:'NA';
               }
               if (in_array('Product', $report_columns)){
                  $row[] = (!empty($repdetails->enq_product_name)) ? $repdetails->enq_product_name:'NA';
               }
                 if(!empty($dfields)){
                    foreach($dfields as $ind => $dfld){ 
                      if (in_array(trim($dfld['input_label']), $report_columns)) {                  
                        if (!empty($fieldsval)) {                                              
                          if(!empty($fieldsval[$repdetails->enquiry_id])){
                            if(!empty($fieldsval[$repdetails->enquiry_id][$dfld['input_label']])){
                              $row[] = $fieldsval[$repdetails->enquiry_id][$dfld['input_label']]->fvalue;
                            }else{
                              $row[] = "NA";
                            }
                          }else{
                            $row[] = "NA";                                                
                          }
                        }else{
                          $row[] =  "NA";
                        }                                             
                      }
                  } 
                }

                if (in_array('Branch Name', $report_columns)){
                  $row[] = (!empty($repdetails->branch_name)) ? $repdetails->branch_name :'NA';
               }

               if (in_array('Registration Fee', $report_columns)){
                  $row[] = (!empty($repdetails->reg_fee)) ? $repdetails->reg_fee:'NA';
               }

               if (in_array('Family Fee', $report_columns)){
                  $row[] = (!empty($repdetails->family_fee)) ? $repdetails->family_fee:'NA';
               }

               if (in_array('Lawyer Fee', $report_columns)){
                  $row[] = (!empty($repdetails->lawyer_fee)) ? $repdetails->lawyer_fee:'NA';
               }

               if (in_array('Consultancy Fee', $report_columns)){
                  $row[] = (!empty($repdetails->consultancy_fee)) ? $repdetails->consultancy_fee:'NA';
               }

               if (in_array('Stamp Paper Fee', $report_columns)){
                  $row[] = (!empty($repdetails->stamp)) ? $repdetails->stamp :'NA';
               }

               if (in_array('Final Country', $report_columns)){
                  $row[] = (!empty($repdetails->country_name)) ? $repdetails->country_name :'NA';
               }

               if (in_array('In Take', $report_columns)){
                  $row[] = (!empty($repdetails->in_take)) ? $repdetails->in_take :'NA';
               }

               if (in_array('Visa Type', $report_columns)){
                  $row[] = (!empty($repdetails->visa_type_name)) ? $repdetails->visa_type_name :'NA';
               }

               if (in_array('Preferred Country', $report_columns)){
                  $row[] = (!empty($preferred_country)) ? $preferred_country :'NA';
               }

               if (in_array('Nationality', $report_columns)){
                  $row[] = (!empty($repdetails->ncountry_name)) ? $repdetails->ncountry_name :'NA';
               }

               if (in_array('Residing Country', $report_columns)){
                  $row[] = (!empty($repdetails->rcName)) ? $repdetails->rcName :'NA';
               }

               if (in_array('Refund Status', $report_columns)){
                     if($repdetails->refund_eligiblity=='1'){ $ss = 'Done';}else if($repdetails->refund_eligiblity=='0'){ $ss = 'Not elegible';}//else{ $ss = 'Pending';}
                  $row[] = (!empty($ss)) ? $ss :'NA';
               }

               if (in_array('Refund Created Date', $report_columns)){
                  $row[] = (!empty($repdetails->trdate)) ? $repdetails->trdate :'NA';
               }

               if (in_array('Total Amount', $report_columns)){
                  $row[] = (!empty($repdetails->taxabal_amt)) ? $repdetails->taxabal_amt :'NA';
               }

               if (in_array('Advanced Recived', $report_columns)){
                  $row[] = (!empty($repdetails->advance)) ? $repdetails->advance :'NA';
               }

               if (in_array('Amount Paid', $report_columns)){
                if(empty($repdetails->final)){ $pay = $repdetails->installment;}else{ $pay = $repdetails->final;}
                  $row[] = (!empty($pay)) ? $pay :'NA';
               }

               if (in_array('Amount Due', $report_columns)){
                  if(!empty($repdetails->taxabal_amt)){$taxabal_amt = $repdetails->taxabal_amt;}else{$taxabal_amt = '0';}
                  if(!empty($repdetails->advance)){$advance = $repdetails->advance;}else{$advance = '0';}
                  if(!empty($repdetails->final)){$final = $repdetails->final;}else{$final = '0';}
                  if(!empty($repdetails->installment)){$installment = $repdetails->installment;}else{$installment = '0';}
                if(empty($final)){ $due = ($taxabal_amt - $advance - $installment);}else{ $due = ($taxabal_amt - $advance - $final);}
                  $row[] = (!empty($due)) ? $due :'NA';
               }

               if (in_array('Payment Status', $report_columns)){
                if($repdetails->Pay_status=='1'){$status = 'Paid';}else{$status = 'Pending';}
                  $row[] = (!empty($status)) ? $status :'NA';
               }

               if (in_array('Paid Date', $report_columns)){
                  $row[] = (!empty($repdetails->pay_date)) ? $repdetails->pay_date :'NA';
               }

               if (in_array('Aggrement Name', $report_columns)){
                  $row[] = (!empty($repdetails->template_name)) ? $repdetails->template_name :'NA';
               }

               if (in_array('Aggrement Status', $report_columns)){
                if($repdetails->approve_status=='0'){ $asts = 'Pending';}else{ $asts = 'Approved';}
                  $row[] = (!empty($asts)) ? $asts :'NA';
               }

               if (in_array('Signed File', $report_columns)){
                if($repdetails->signed_file=='0'){ $sfile = 'No';}else{ $sfile = 'Yes';}
                  $row[] = (!empty($sfile)) ? $sfile :'NA';
               }

               if (in_array('Aggrement Created Date', $report_columns)){
                  $row[] = (!empty($repdetails->agrmt_date)) ? $repdetails->agrmt_date :'NA';
               }

//Call report column Start
               if (in_array('Agent No', $report_columns)){
                  $row[] = (!empty($new_array->number)) ? substr($new_array->number, -10) :'NA';
               }

               if (in_array('Applicant No', $report_columns)){
                  $row[] = (!empty($call_data_array->call_to_number)) ? substr($call_data_array->call_to_number, -10) :'NA';
               }

               if (in_array('Call At', $report_columns)){
                  $row[] = (!empty($call_data_array->start_stamp)) ? $call_data_array->start_stamp :'NA';
               }

               if (in_array('Call End At', $report_columns)){
                  $row[] = (!empty($call_data_array->end_stamp)) ? $call_data_array->end_stamp :'NA';
               }

               if (in_array('Duration', $report_columns)){
                  $row[] = (!empty($call_data_array->duration)) ? $duration :'NA';
               }

               if (in_array('Call Status', $report_columns)){
                  $row[] = (!empty($call_data_array->call_status)) ? $call_data_array->call_status :'NA';
               }
//Call report column end

           $data[] = $row;
/*echo'<pre>';
print_r($data);exit;
echo'</pre>';*/
           }
            $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->report_datatable_model->count_all($keyword),
            "recordsFiltered" => $this->report_datatable_model->count_filtered($keyword),
            "data" => $data,
        );
        echo json_encode($output);
     }
        
        public function delete_report_row(){
            $id = $this->input->post('id');        
            $this->db->where('id',$id);         
            $this->db->delete('reports');
            echo 1;
        }
        public function view_details(){ 
          
            if($this->input->post('from_exp')==''){
             $from ='';  
            }else{
           $dfrom= $this->input->post('from_exp');
           $from = date("d/m/Y", strtotime($dfrom));
            }
            if($this->input->post('to_exp')==''){
                $to ='';
            }else{
               $tto= $this->input->post('to_exp');
               $to = date("d/m/Y", strtotime($tto)); 
            }
            if($this->input->post('employee')==''){
                $employe ='';
            }else{
               $employe= $this->input->post('employee');
            }
             if($this->input->post('phone')==''){
                $phone ='';
            }else{
               $phone= $this->input->post('phone');
            }
              if($this->input->post('country')==''){
                $country ='';
            }else{
               $country= $this->input->post('country');
            }
            /*  if($this->input->post('institute')==''){
                $institute ='';
            }else{
               $institute= $this->input->post('institute');
            }
             if($this->input->post('center')==''){
                $center ='';
            }else{
               $center= $this->input->post('center');
            }*/
            if($this->input->post('source')==''){
                $source ='';
            }else{
               $source= $this->input->post('source');
            }
            /*if($this->input->post('subsource')==''){
                $subsource ='';
            }else{
               $subsource= $this->input->post('subsource');
            }
            if($this->input->post('datasource')==''){
                $datasource ='';
            }else{
               $datasource= $this->input->post('datasource');
            }*/
            if($this->input->post('state')==''){
                $state ='';
            }else{
               $state= $this->input->post('state');
            }
            if($this->input->post('lead_source')==''){ // disposition
              $lead_source = '';
            }else{
               $lead_source = $this->input->post('lead_source');
            }

            if($this->input->post('final_country')==''){ // disposition
              $final_country = '';
            }else{
               $final_country = $this->input->post('final_country');
            }

            if($this->input->post('in_take')==''){ // disposition
              $in_take = '';
            }else{
               $in_take = $this->input->post('in_take');
            }

            if($this->input->post('visa_type')==''){ // disposition
              $visa_type = '';
            }else{
               $visa_type = $this->input->post('visa_type');
            }

            if($this->input->post('preferred_country')==''){ // disposition
              $preferred_country = '';
            }else{
               $preferred_country = $this->input->post('preferred_country');
            }

            if($this->input->post('nationality')==''){ // disposition
              $nationality = '';
            }else{
               $nationality = $this->input->post('nationality');
            }

            if($this->input->post('residing_country')==''){ // disposition
              $residing_country = '';
            }else{
               $residing_country = $this->input->post('residing_country');
            }

            if($this->input->post('branch_name')==''){ // disposition
              $branch_name = '';
            }else{
               $branch_name = $this->input->post('branch_name');
            }
            
            /*if($this->input->post('lead_subsource')==''){  
                $lead_subsource = '';
            }else{
               $lead_subsource = $this->input->post('lead_subsource');
            }

            if($this->input->post('sub_disposition')==''){  
                $sub_disposition = '';
            }else{
               $sub_disposition = $this->input->post('sub_disposition');
            }*/
            
            

            if($this->input->post('enq_product')==''){
                $enq_product = '';
            }else{
               $enq_product = $this->input->post('enq_product');
            }
            if($this->input->post('productlst')==''){
                $productlst = '';
            }else{
               $productlst = $this->input->post('productlst');
            }
            if($this->input->post('drop_status')==''){
                $drop_status = '';
            }else{
               $drop_status = $this->input->post('drop_status');
            }

            if($this->input->post('hier_wise')==''){
                $hier_wise = '';
            }else{
               $hier_wise = $this->input->post('hier_wise');
            }
            
            $data['post_report_columns'] = $this->input->post('report_columns');
             $post_report_columns = $this->input->post('report_columns');
             //print_r($post_report_columns);exit;
            if($this->input->post('all')==''){ // follow up report
                $all = '';
            }else{
               $all = $this->input->post('all');
            }        
            $data_arr = array(
   
            'final_country1'  =>  $final_country,
            'in_take1'        =>  $in_take,
            'visa_type1'      =>  $visa_type,
            'preferred_country1'  =>  $preferred_country,
            'nationality1'    =>  $nationality,
            'residing_country1'  =>  $residing_country,
            'branch_name1'    =>  $branch_name,
            'from1'           =>  $from,
            'to1'             =>  $to,
            'employe1'        =>  $employe,
            'phone1'          =>  $phone,
            'country1'        =>  $country,
           // 'institute1'      =>  $institute,
           // 'center1'         =>  $center,
            'source1'         =>  $source,
           // 'subsource1'      =>  $subsource,
           // 'datasource1'     =>  $datasource,
            'state1'          =>  $state,
            'lead_source1'    =>  $lead_source,
           // 'lead_subsource1' =>  $lead_subsource,
           // 'sub_disposition' =>  $sub_disposition,
            'enq_product1'    =>  $enq_product,
            'drop_status1'    =>  $drop_status,
            'all1'            =>  $all, 
            'post_report_columns'=>$post_report_columns,
            'productlst'=>$productlst,
            'hier_wise' => $hier_wise
            );
            $this->session->set_userdata($data_arr);
        /*$productlst = implode(',',$this->session->process);
        if(count($this->session->process)>1){
        echo 'Please Select One Process For Report Access';exit;
        }*/    
        $data['title'] = 'Report';
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        //$data['all_sub_stage_lists'] = $this->Leads_Model->find_description();
        $data['sourse'] = $this->report_model->all_source();
       // $data['subsourse'] = $this->report_model->all_subsource();
       // $data['datasourse'] = $this->report_model->all_datasource();
        
      //  $data['datasourse'] = $this->report_model->all_datasource();
        $this->load->model('User_model');
        $data['employee'] =$this->User_model->read2();
        $data['process'] = $this->dash_model->product_list();
        $data['all_branch_list'] = $this->location_model->branch();
        //print_r($data['all_branch_list']);exit;
       // $data["dfields"] = $this->report_model->get_dynfields();
        $data["fieldsval"]        = $this->report_model->getdynfielsval();  
        $data['products'] = $this->location_model->productcountry();

        $data['allcountry_list'] = $this->Taskstatus_model->countrylist();
        $data['all_country_list'] = $this->location_model->country();
        $data['visa_type'] = $this->Leads_Model->visa_type_select();

        $data['content'] = $this->load->view('all_report', $data, true);        
        $this->load->view('layout/main_wrapper', $data);
       
    }
    public function all_report_filterdata($keyword=''){
        $this->load->model('report_datatable_model');

        $no = $_POST['start'];
        $from = $this->session->userdata('from1');
        $to= $this->session->userdata('to1');
        $employe = $this->session->userdata('employe1');
        $phone = $this->session->userdata('phone1');
        $country = $this->session->userdata('country1');
        $institute = $this->session->userdata('institute1');
        $center = $this->session->userdata('center1');
        $source = $this->session->userdata('source1');
        $subsource = $this->session->userdata('subsource1');
        $datasource = $this->session->userdata('datasource1');
        $state = $this->session->userdata('state1');
        $lead_source = $this->session->userdata('lead_source1');
        $lead_subsource = $this->session->userdata('lead_subsource1');
        $enq_product = $this->session->userdata('enq_product1');
        $drop_status = $this->session->userdata('drop_status1');
        $all = $this->session->userdata('all1');
        $productlst = $this->session->userdata('productlst');
        $final_country = $this->session->userdata('final_country1');
        $in_take = $this->session->userdata('in_take1');
        $visa_type = $this->session->userdata('visa_type1');
        $preferred_country = $this->session->userdata('preferred_country1');
        $nationality = $this->session->userdata('nationality1');
        $residing_country = $this->session->userdata('residing_country1');
        $branch_name = $this->session->userdata('branch_name1');
        $rep_details = $this->report_datatable_model->get_datatables1($keyword); 
        $country=$this->db->where('comp_id',$this->session->companey_id)->get('tbl_country')->result(); 
            $i=1;
            $data = array();

        /*echo "<pre>";
        print_r($rep_details);
        echo "</pre>";*/
        foreach ($rep_details as  $repdetails) {

      $preferred_country='';
      if(!empty($repdetails->preferred_country)){
        $countrys=explode(',',$repdetails->preferred_country);
        foreach ($country as $key => $value) {
           if(in_array($value->id_c,$countrys)){
             $preferred_country.=$value->country_name.' ,';
           }
        }
      }

//telephony data json start

      $call_data = $repdetails->call_json;
      $call_data_array = json_decode($call_data);
      $new_array = $call_data_array->answered_agent??0;

  $seconds  = $call_data_array->duration??0;
  $hours    = floor($seconds / 3600);
  $minutes  = floor(($seconds / 60) % 60);
  $seconds  = $seconds % 60;
  $duration = $hours.':'.$minutes.':'.$seconds;

//telephony data json end

            $no++;
            $row = array(); 
        
             if (in_array('S.No', $this->session->userdata('post_report_columns'))){
                $row[] = $i++;
             }
             if (in_array('Name', $this->session->userdata('post_report_columns'))) { 
              $row[] = $repdetails->name_prefix . " " . $repdetails->name . " " . $repdetails->lastname;
              }
              if (in_array('Phone', $this->session->userdata('post_report_columns'))) {
                  if (user_access(450)) {
                    $row[] = '##########';                    
                  }else{
                    $row[] = $repdetails->phone;
                  }
              }
              if (in_array('Email',$this->session->userdata('post_report_columns'))){
                $row[] = $repdetails->email;
              }
              if (in_array('Created By', $this->session->userdata('post_report_columns'))) {
                $row[] = $repdetails->created_by_name;
              }
              if (in_array('Assign To', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->assign_to_name))?$repdetails->assign_to_name:'NA'; 
              }
              if (in_array('Gender', $this->session->userdata('post_report_columns'))) {
                 if ($repdetails->gender == 1) {
                 $gender = 'Male';
                } else if ($repdetails->gender == 2) {
                $gender = 'Female';
                } else {
                $gender = 'Other';
                }
                $row[] = $gender;
              }
              if (in_array('Source', $this->session->userdata('post_report_columns'))) {
                $row[] = (!empty($repdetails->lead_name))?$repdetails->lead_name:'NA';
              }

               if (in_array('Disposition', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->followup_name)) ? $repdetails->followup_name:'NA';
               }
              if (in_array('Lead Description', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->description)) ? $repdetails->description :"NA"; 
              }



              if (in_array('Disposition Remark', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->lead_discription_reamrk)) ? $repdetails->lead_discription_reamrk :"NA"; 
              }

              if (in_array('Drop Reason', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->drop_status)) ? $repdetails->drop_status :"NA"; 
              }

              if (in_array('Drop Comment', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->drop_reason)) ? $repdetails->drop_reason :"NA"; 
              }

              if (in_array('Conversion Probability', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->lead_score)) ? $repdetails->lead_score :"NA"; 
              }

              if (in_array('Remark', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->enq_remark)) ? $repdetails->enq_remark :"NA"; 
              }              



              if (in_array('Status', $this->session->userdata('post_report_columns'))) {
                 if ($repdetails->status == 1) {
                 $status = 'Onboarding';
                 } else if ($repdetails->status == 2) {
                 $status = 'Application';
                 } else {
                 $status = 'Case Management';
                 }
                 $row[] = $status;
              }

               if (in_array('Process', $this->session->userdata('post_report_columns'))) {
               $row[] =  (!empty($repdetails->product_name)) ?$repdetails->product_name:'NA'; 
               }
               if (in_array('Updated Date',$this->session->userdata('post_report_columns'))){
                $row[] = $repdetails->update_date; 
               }
               if (in_array('State', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->state_id)) ? $repdetails->state_id:'NA';
               }
                if (in_array('City', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->city_id)) ? $repdetails->city_id:'NA';
               }

               if (in_array('Branch Name', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->branch_name)) ? $repdetails->branch_name :'NA';
               }

               if (in_array('Registration Fee', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->reg_fee)) ? $repdetails->reg_fee:'NA';
               }

               if (in_array('Family Fee', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->family_fee)) ? $repdetails->family_fee:'NA';
               }

               if (in_array('Lawyer Fee', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->lawyer_fee)) ? $repdetails->lawyer_fee:'NA';
               }

               if (in_array('Consultancy Fee', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->consultancy_fee)) ? $repdetails->consultancy_fee:'NA';
               }

               if (in_array('Stamp Paper Fee', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->stamp)) ? $repdetails->stamp :'NA';
               }

               if (in_array('Final Country', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->country_name)) ? $repdetails->country_name :'NA';
               }

               if (in_array('In Take', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->in_take)) ? $repdetails->in_take :'NA';
               }

               if (in_array('Visa Type', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->visa_type_name)) ? $repdetails->visa_type_name :'NA';
               }

               if (in_array('Preferred Country', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($preferred_country)) ? $preferred_country :'NA';
               }

               if (in_array('Nationality', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->ncountry_name)) ? $repdetails->ncountry_name :'NA';
               }

               if (in_array('Residing Country', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->rcName)) ? $repdetails->rcName :'NA';
               }

               if (in_array('Refund Status', $this->session->userdata('post_report_columns'))){
                     if($repdetails->refund_eligiblity=='1'){ $ss = 'Done';}else if($repdetails->refund_eligiblity=='0'){ $ss = 'Not elegible';}//else{ $ss = 'Pending';}
                  $row[] = (!empty($ss)) ? $ss :'NA';
               }

               if (in_array('Refund Created Date', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->trdate)) ? $repdetails->trdate :'NA';
               }

               if (in_array('Total Amount', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->taxabal_amt)) ? $repdetails->taxabal_amt :'NA';
               }

               if (in_array('Advanced Recived', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->advance)) ? $repdetails->advance :'NA';
               }

               if (in_array('Amount Paid', $this->session->userdata('post_report_columns'))){
                if(empty($repdetails->final)){ $pay = $repdetails->installment;}else{ $pay = $repdetails->final;}
                  $row[] = (!empty($pay)) ? $pay :'NA';
               }

               if (in_array('Amount Due', $this->session->userdata('post_report_columns'))){
                  if(!empty($repdetails->taxabal_amt)){$taxabal_amt = $repdetails->taxabal_amt;}else{$taxabal_amt = '0';}
                  if(!empty($repdetails->advance)){$advance = $repdetails->advance;}else{$advance = '0';}
                  if(!empty($repdetails->final)){$final = $repdetails->final;}else{$final = '0';}
                  if(!empty($repdetails->installment)){$installment = $repdetails->installment;}else{$installment = '0';}
                if(empty($final)){ $due = ($taxabal_amt - $advance - $installment);}else{ $due = ($taxabal_amt - $advance - $final);}
                  $row[] = (!empty($due)) ? $due :'NA';
               }

               if (in_array('Payment Status', $this->session->userdata('post_report_columns'))){
                if($repdetails->Pay_status=='1'){$status = 'Paid';}else{$status = 'Pending';}
                  $row[] = (!empty($status)) ? $status :'NA';
               }

               if (in_array('Paid Date', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->pay_date)) ? $repdetails->pay_date :'NA';
               }

               if (in_array('Aggrement Name', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->template_name)) ? $repdetails->template_name :'NA';
               }

               if (in_array('Aggrement Status', $this->session->userdata('post_report_columns'))){
                if($repdetails->approve_status=='0'){ $asts = 'Pending';}else{ $asts = 'Approved';}
                  $row[] = (!empty($asts)) ? $asts :'NA';
               }

               if (in_array('Signed File', $this->session->userdata('post_report_columns'))){
                if($repdetails->signed_file=='0'){ $sfile = 'No';}else{ $sfile = 'Yes';}
                  $row[] = (!empty($sfile)) ? $sfile :'NA';
               }

               if (in_array('Aggrement Created Date', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->agrmt_date)) ? $repdetails->agrmt_date :'NA';
               }
//Call report column Start
               if (in_array('Agent No', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($new_array->number)) ? substr($new_array->number, -10) :'NA';
               }

               if (in_array('Applicant No', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($call_data_array->call_to_number)) ? substr($call_data_array->call_to_number, -10) :'NA';
               }

               if (in_array('Call At', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($call_data_array->start_stamp)) ? $call_data_array->start_stamp :'NA';
               }

               if (in_array('Call End At', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($call_data_array->end_stamp)) ? $call_data_array->end_stamp :'NA';
               }

               if (in_array('Duration', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($call_data_array->duration)) ? $duration :'NA';
               }

               if (in_array('Call Status', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($call_data_array->call_status)) ? $call_data_array->call_status :'NA';
               }
//Call report column End               
           $data[] = $row;
           }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->report_datatable_model->count_all($keyword),
            "recordsFiltered" => $this->report_datatable_model->count_filtered($keyword),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function create_report($rep_type){
        parse_str($_POST['filters'], $filters);
        $report_name    = $this->input->post('report_name');
        $this->form_validation->set_rules('report_name','Report Name','required|trim');
        if ($this->form_validation->run() == TRUE) {
            $insert_array = array(
                            'name'      =>  $report_name,
                            'comp_id'   =>  $this->session->companey_id,
                            'type'      =>  $rep_type,
                            'filters'   =>  json_encode($filters),
                            'created_by'=>  $this->session->user_id
                            );
            if($this->db->insert('reports',$insert_array)){
                echo json_encode(array('status'=>true,'msg'=>'Report Saved Successfully'));
            }else{
                echo json_encode(array('status'=>false,'msg'=>'Something went wrong!'));
            }           
        } else {
            echo json_encode(array('status'=>false,'msg'=>validation_errors()));            
        }
    }
    public function all_reports() {
        $data['title'] = 'Report';
        $data['countries'] = $this->report_model->all_country();
        $data['institute'] = $this->report_model->all_institute();
        $data['center'] = $this->report_model->all_center();
        $data['sourse'] = $this->report_model->all_source();
        $data['subsourse'] = $this->report_model->all_subsource();
        $data['datasourse'] = $this->report_model->all_datasource();
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        $data['products'] = $this->dash_model->product_list();        
        $data['employee'] = $this->report_model->all_company_employee($this->session->userdata('companey_id'));        
        $data['content'] = $this->load->view('all_report', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    //Dashboard statitics reports for enquiry..
    public function enquiry_statitics_report() {
        echo json_encode($this->report_model->enquiry_statitics_data());
    }
    //Dashboard statitics reports for Leads..
    public function lead_statitics_report() {
        echo json_encode($this->report_model->lead_statitics_data());
    }
    public function lead_opportunity() {
        echo json_encode($this->report_model->lead_opportunities_status());
    }
    public function client_opportunities() {
        echo json_encode($this->report_model->client_opportunity_status());
    }
    public function all_source() {
        echo json_encode($this->report_model->enquiry_source_data());
    }
    public function funnel_reports() {
        echo json_encode($this->report_model->funnel_report());
    }
}