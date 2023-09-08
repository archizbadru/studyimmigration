<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Call_report extends CI_Controller {
    public function __construct() {
        parent::__construct();      
      $this->load->model(
                array('User_model','enquiry_model')
                );
        if (empty($this->session->user_id)) {
            redirect('login');
        }
    }
    
    public function index(){
		if($this->input->get('pageno')==1){ $log_from=1;}else{$log_from=$this->input->get('pageno')*100;}
		$date_from=strtotime($this->input->get('from_exp'));
		$date_to=strtotime($this->input->get('to_exp'));
		$search_key=$this->input->get('employee');
		$token=$this->input->get('telephony_access_token_id');
		$filters=$this->input->get('filter');
        $agenttoken=$this->input->get('agenttoken');
        $phone=$this->input->get('phone');
		if(!empty($filters)){
		$filter=implode('@',$filters);
		}else{$filter='';}
		$page_size=100;
		//$search_key=$this->input->get('search_key');
		///$log_from=$this->input->get('log_from');
	    $url = "https://developers.myoperator.co/search ";
        $search=array(
        'token'=>$token,
        'agent_token'=> $agenttoken,
        'phone'  => $phone,
        'from'=>$date_from,
        'to'=>$date_to,
		'log_from'=>$log_from,
		'page_size'=>100,
        'search_key'=>$search_key,
		'filters'=>$filter
        );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$search);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close( $curl );
	    $data['logs_details']=$response;
		// print_r(json_decode($response));exit();
	    $url = "https://developers.myoperator.co/filters?token=0811613982df3ad6b0ccaef5847364e9";
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close($curl);
        // print_r($response);die;
		$data['source']=$response;
		$data['token_number']=$token;
		$data['all_user']='Call Report';
        $data['content'] = $this->load->view('telephony/admin_call_report', $data, true);
        $this->load->view('layout/main_wrapper', $data);	
    }
	public function report_all(){
		if($this->input->get('pageno')==1){ $log_from=1;}else{$log_from=$this->input->get('pageno')*100;}
		$date_from=strtotime($this->input->get('from_exp'));
		$date_to=strtotime($this->input->get('to_exp'));
		$search_key=$this->input->get('employee');
		$token=$this->input->get('telephony_access_token_id');
		$filters=$this->input->get('filter');
        $agenttoken=$this->input->get('agenttoken');
        $phone=$this->input->get('phone');
		if(!empty($filters)){
		$filter=implode('@',$filters);
		}else{$filter='';}
		$page_size=100;
		//$search_key=$this->input->get('search_key');
		///$log_from=$this->input->get('log_from');
	    $url = "https://developers.myoperator.co/search ";
        $search=array(
        'token'=>'0811613982df3ad6b0ccaef5847364e9',
        'agent_token'=> '',
        'phone'  => '',
        'from'=>$date_from,
        'to'=>$date_to,
		'log_from'=>$log_from,
		'page_size'=>100,
        'search_key'=>$search_key,
		'filters'=>$filter
        );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$search);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close( $curl );
	    $data['logs_details']=$response;
		// print_r(json_decode($response));exit();
	    $url = "https://developers.myoperator.co/filters?token=0bfe070ff5847ce58b4fc0567859dc7d";
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close($curl);
		$data['source']=$response;
		$data['token_number']=$token;
		$data['all_user']='Call Report';
        $data['content'] = $this->load->view('telephony/call_report', $data, true);
        $this->load->view('layout/main_wrapper', $data);	
    }
	public function get_video($token='',$filename=''){
		 $url="https://developers.myoperator.co/recordings/link?token=".$token."&&file=".$filename;
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close( $curl );
		//print_r($response);exit();
		if(json_decode($response)->status=='success'){
	     echo json_decode($response)->url;
		}else{echo 1;}
	}	
    
	public function test(){
	 $i=0;$lg=0;
		for($i=0;$i<=1;$i++){
			echo $i;echo '<br>';
			$lg=$i*100;
	    $url = "https://developers.myoperator.co/search ";
        $search=array(
        'token'=>'0bfe070ff5847ce58b4fc0567859dc7d',
        'agent_token'=>'5ea97b0cc71b2154',
        'phone'  =>'' ,
        'from'=>'',
        'to'=>'',
		'log_from'=>$lg,
		'page_size'=>100,
        'search_key'=>'',
		'filters'=>''
        );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$search);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close( $curl );
	    $response;
        
        if(!empty(json_decode($response)->data->total)){
				foreach(json_decode($response)->data->hits as $v){
					$phone='';$recived_name='';
                $user_phone=$v->_source->caller_number;
				foreach($v->_source->log_details as $recive){if(!empty($recive->received_by[0]->name)){$recived_name=$recive->received_by[0]->name;}}
				foreach($v->_source->log_details as $recive){if(!empty($recive->received_by[0]->contact_number_raw)){$phone=$recive->received_by[0]->contact_number_raw;}} 
				foreach($v->_source->log_details as $recive){if(!empty($recive->action)){$action=$recive->action;}}
				$start_time= date("d:m:Y H:i:s",$v->_source->start_time);
				$end_time= date("d-m-Y H:i:s", $v->_source->end_time);
				$duration=$v->_source->duration;
				$this->db->set('recived_by',$phone);
				$this->db->set('recived_name',$recived_name);
				$this->db->set('customer_phone',$v->_source->caller_number);
				$this->db->set('call_status',$v->_source->status);
				$this->db->set('event_type',$v->_source->event);
				$this->db->set('json_data',json_encode($v)); 
				$this->db->insert('tbl_col_log2'); 

		 } }
		
    }
	}

}
