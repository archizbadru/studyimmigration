<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reminder extends CI_Controller {
	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array(
			'User_model'			
		));
		if(empty($this->session->user_id)){
		 redirect('login');   
		}
	}
 	
 	public function task_reminder(){		
 		$this->load->view('sse_reminder');
 	}

 	public function abc(){ 	
		
		$user_id  = $this->session->user_id;
 		
 		$query  = $this->db->query("select NOW(),query_response.task_time,query_response.task_date,query_response.task_remark,query_response.query_id,enquiry.status,enquiry.enquiry_id as enqid,CONCAT_WS(' ',enquiry.name_prefix,enquiry.name,enquiry.lastname) as enq_name from query_response INNER JOIN enquiry ON query_response.query_id = enquiry.Enquery_id where query_response.create_by=$user_id AND STR_TO_DATE(query_response.task_date,'%d-%m-%Y') = CURDATE() AND query_response.task_time >= TIME_FORMAT(NOW(), '%H:%i:%s')");

	    $result = $query->result_array();
	    echo $this->db->last_query(); 	

    	echo "<pre>";
    	print_r($result);
    	echo "</pre>"; 		
 		$this->load->view('reminder_test');

 	}
}