<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticketmaster extends CI_Controller {

   
    
    public function __construct()
	{
		parent::__construct();
		
            //$this->load->helper('url');
		   
		$this->load->model(array(
			'Ticket_Model','Client_Model'
		));	
	
	}
    
         
	public function index()
	{
	    
		$data['nav1']='nav5';
		$aid = $this->session->userdata('user_id');
	$data['title'] = 'Ticket Lists';  ;	
	
	$data['ticket_list'] = $this->Ticket_Model->get_ticket_list();
	$data['problems'] = $this->Ticket_Model->get_problem_list();
	
    $data['content'] = $this->load->view('tickets',$data,true);

	$this->load->view('layout/main_wrapper',$data);
	}
	
	
	public function addticket()
       {
           $data['title'] = 'Add New Ticket';
           $data['nav1']='nav5';
		  if(!empty($_POST)){
            
				//$adminid = $this->session->userdata('user_id');
				//$adminid = '1';
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $mobile = $this->input->post('mobile');
                $address = $this->input->post('address');
                $product = $this->input->post('product');
                $problem = $this->input->post('problem');
                $priority = $this->input->post('priority');
                $source = $this->input->post('source');
                $due_date = $this->input->post('due_date');
                $date = date('d-m-Y H:i:s');
                
                $data = array(
                        'name' => $name,
                        'email' => $email,
                        'mobile' => $mobile,
                        'address' => $address,
                        'product' => $product,
                        'problem' => $problem,
                        'priority' => $priority,
                        'source' => $source,
                        'due_date' => $due_date,
                        'created_date' => $date
						);
				
				$insert_id = $this->Ticket_Model->TickectAdd($data);
                $this->session->set_flashdata('SUCCESSMSG','Tickect Add Successfully');
                redirect('ticket');
                
            
			} 
			else{
			    $data['clients'] = $this->Client_Model->get_Client_list();
			    $data['content'] = $this->load->view('ticket_form', $data, true);
                $this->load->view('layout/main_wrapper',$data);
		        }
		        
		        
        }
	   
	
	
	 public function details()
    {  
        $data['title'] = 'Ticket Details';
        $data['nav1']='nav5';
        #------------------------------# 
        $tid = $this->uri->segment(3);
        
        //////////////////////////////////////////////////////
        if(!empty($_POST)){
			
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobileno');
			$problem = $this->input->post('problem');
			$address = $this->input->post('address');
			$priority = $this->input->post('priority');
			$source = $this->input->post('source');
			$due_date = $this->input->post('due_date');
			
	        $this->db->set('mobile',$mobile);
			$this->db->set('email',$email);
			$this->db->set('name',$name);
			$this->db->set('address',$address);
			$this->db->set('source',$source);
			$this->db->set('problem',$problem);
			$this->db->set('priority',$priority);
			$this->db->set('due_date',$due_date);
			$this->db->where('tid',$tid);
			$this->db->update('ticket');
	    
		redirect('ticket/details/'.$tid);
		}
		
        
        
        
        //////////////////////////////////////////////////////
        
        $data['ticket_list'] = $this->Ticket_Model->get_ticket_list();
        $data['details'] = $this->Ticket_Model->get_TicketDetailsby_id($tid);
        
        $data['content'] = $this->load->view('ticket_details', $data, true);
        $this->load->view('layout/main_wrapper',$data);
    }
	
	
	
	public function addproblemtype()
       {$data['nav1']='nav5';
           $data['title'] = 'Add New Problem Type';
		  if(!empty($_POST)){
            
                $problemname = $this->input->post('problem_type');
                
                $data = array(
                        'problem_name' => $problemname
                        
						);
				
				$insert_id = $this->Ticket_Model->problemTypeADD($data);
                $this->session->set_flashdata('SUCCESSMSG','Problem Type Add Successfully');
                redirect('ticketmaster/addproblemtype');
                
            
			} 
			else{
			    $data['problems'] = $this->Ticket_Model->get_problem_list();
			    $data['clients'] = $this->Client_Model->get_Client_list();
			    $data['content'] = $this->load->view('ticket_problem', $data, true);
                $this->load->view('layout/main_wrapper',$data);
		        }
		        
		        
        }
        
        
    public function addproblempriority()
       {$data['nav1']='nav5';
           $data['title'] = 'Add New Problem Priority';
		  if(!empty($_POST)){
            
                $priority_name = $this->input->post('priority_type');
                
                $data = array(
                        'priority_name' => $priority_name
                        
						);
				
				$insert_id = $this->Ticket_Model->priorityTypeADD($data);
                $this->session->set_flashdata('SUCCESSMSG','Priority Type Add Successfully');
                redirect('ticketmaster/addproblempriority');
                
            
			} 
			else{
			    $data['ticketpriority'] = $this->Ticket_Model->get_priority_list();
			    $data['clients'] = $this->Client_Model->get_Client_list();
			    $data['content'] = $this->load->view('ticket_priority', $data, true);
                $this->load->view('layout/main_wrapper',$data);
		        }
		        
		        
        }
        
        
        public function addticketSource()
       {$data['nav1']='nav5';
           $data['title'] = 'Add New Problem Priority';
		  if(!empty($_POST)){
            
                $source_name = $this->input->post('source_type');
                
                $data = array(
                        'ticket_source' => $source_name
                        
						);
				
				$insert_id = $this->Ticket_Model->ticketSourceADD($data);
                $this->session->set_flashdata('SUCCESSMSG','Source Type Add Successfully');
                redirect('ticketmaster/addticketSource');
                
            
			} 
			else{
			    $data['ticketsource'] = $this->Ticket_Model->get_ticketsource_list();
			    
			    $data['content'] = $this->load->view('ticket_source', $data, true);
                $this->load->view('layout/main_wrapper',$data);
		        }
		        
		        
        }
	
	
	public function source_details()
    {  $data['nav1']='nav5';
    
    if(!empty($_POST)){
    $apiid = $this->input->post('sc_id');
    $source_name = $this->input->post('source_type');
    
    $this->db->set('ticket_source',$source_name);
    $this->db->where('ts_id',$apiid);
    $this->db->update('ticket_source');
    $this->session->set_flashdata('SUCCESSMSG','Update Successfully');
    redirect('ticketmaster/addticketSource');
    }
    }
    
    public function problem_details()
    {  
    $data['nav1']='nav5';
    if(!empty($_POST)){
    $apiid = $this->input->post('sc_id');
    $problem_type = $this->input->post('problem_type');
    
    $this->db->set('problem_name',$problem_type);
    $this->db->where('tp_id',$apiid);
    $this->db->update('ticket_problem');
    $this->session->set_flashdata('SUCCESSMSG','Update Successfully');
    redirect('ticketmaster/addproblemtype');
    }
    }
	
	
	
	public function priority_details()
    {  
    $data['nav1']='nav5';
    if(!empty($_POST)){
    $apiid = $this->input->post('sc_id');
    $priority_type = $this->input->post('priority_type');
    
    $this->db->set('priority_name',$priority_type);
    $this->db->where('priority_id',$apiid);
    $this->db->update('ticket_priority');
    $this->session->set_flashdata('SUCCESSMSG','Update Successfully');
    redirect('ticketmaster/addproblempriority');
    }
    }
    
    public function delete_problemtype(){
    if(!empty($_POST)){
    $user_status=$this->input->post('user_status');
    foreach($user_status as $key){
    $this->db->where('tp_id',$key);
    $query = $this->db->delete('ticket_problem');
    }
    }
    }
    
     public function delete_sourcetype(){
    if(!empty($_POST)){
    $user_status=$this->input->post('user_status');
    foreach($user_status as $key){
    $this->db->where('ts_id',$key);
    $query = $this->db->delete('ticket_source');
    }
    }
    }
    
    public function delete_priority(){
    if(!empty($_POST)){
    $user_status=$this->input->post('user_status');
    foreach($user_status as $key){
    $this->db->where('priority_id',$key);
    $query = $this->db->delete('ticket_priority');
    }
    }
    }

}
