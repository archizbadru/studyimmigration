<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ticket extends CI_Controller {


    public function __construct()

	{

		parent::__construct();


		$this->load->model(array(

			'Ticket_Model','Client_Model','User_model','Leads_Model','Message_models'

		));	

	

	}

	public function natureOfComplaintList(){
		
		$data['title'] = "Nature Of Complaint List";
		$data["tickets"] = $this->db->select('*')->from('tbl_nature_of_complaint')->where('comp_id',$this->session->companey_id)->get()->result();
		$data['content'] = $this->load->view('ticket/natureofcomplain-list', $data, true);
		$this->load->view('layout/main_wrapper', $data);
		
	}

	public function addNatureOfComplaint(){
		
		$data['title'] = "Add Nature Of Complaint";
		if(!empty($_POST))
        {
            if(empty($this->input->post('complainid')))
            {
                //$added = $this->db->select('id')->from('modulewise_right')->where('module_id',$this->input->post('module'))->get()->num_rows();
                $data = array(
                    'title'         => $this->input->post('title'),
                    'status'     	=> $this->input->post('status'),
                    'comp_id'		=> $this->session->companey_id,
                    'created_by'	=> $this->session->user_id,
                    'created_at'    => date("Y-m-d H:i:s"),
                    'updated_at'    => date("Y-m-d H:i:s"),
                );
                $this->db->insert('tbl_nature_of_complaint',$data);
                $this->session->set_flashdata('message','Data Added successfully');
                redirect('ticket/natureOfComplaintList');
            }
            else
            {
            	$data = array(
                    'title'          => $this->input->post('title'),
                    'status'     => $this->input->post('status'),
                    'comp_id'		=> $this->session->companey_id,
                    'created_by'	=> $this->session->user_id,
                    'created_at'    => date("Y-m-d H:i:s"),
                    'updated_at'    => date("Y-m-d H:i:s"),
                );
                $this->db->where('id',$this->input->post('complainid'));
                $this->db->update('tbl_nature_of_complaint',$data);
                $this->session->set_flashdata('message','Updated successfully');
                redirect('ticket/natureOfComplaintList');
            }
        }
        else
        {
        	$data['content'] = $this->load->view('ticket/addNatureof_complaint', $data, true);
			$this->load->view('layout/main_wrapper', $data);
        }
	}

	public function editNatureOfComplaint($id)
	{
		$data['title'] 	= "Edit Nature Of Complaint";
		$data['detail'] = $this->db->select('*')->from('tbl_nature_of_complaint')->where('id',$id)->get()->row();
		$data['content'] = $this->load->view('ticket/addNatureof_complaint', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function deleteNatureOfComplaint($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('tbl_nature_of_complaint');
		$this->session->set_flashdata('message','Deleted successfully');
        redirect('ticket/natureOfComplaintList');

	}	
	
	public function index(){
		
		$data['title'] = "All Ticket";
		$data["tickets"] = $this->Ticket_Model->getall();
		//print_r($data["tickets"]);die;
		$data['user_list'] = $this->User_model->companey_users();
		$data['content'] = $this->load->view('ticket/list-ticket', $data, true);
		$this->load->view('layout/main_wrapper', $data);
		
	}
	public function view1($tckt = ""){		
		if(isset($_POST["reply"])){
			            $subject = $this->input->post("subjects", true);
						$message = $this->input->post("reply", true);
						$to = $this->input->post("email", true);
					$this->Message_models->send_email($to,$subject,$message);
			$this->Ticket_Model->saveconv();
			redirect(base_url("ticket/view/".$tckt), "refresh");
		}
		if(isset($_POST["issue"])){			
			$this->Ticket_Model->updatestatus();
			redirect(base_url("ticket/view/".$tckt), "refresh");
		}		
		$data["ticket"] = $this->Ticket_Model->get($tckt);
		$data["conversion"] = $this->Ticket_Model->getconv($data["ticket"]->id);
		if(empty($data["ticket"])){
			show_404();
		}		 
		$data['title'] = "View ";
		//$data["problem"] = $this->Ticket_Model->getissues();
		$data['problem'] = $this->Ticket_Model->get_sub_list();
		$data['content'] = $this->load->view('ticket/view-ticket', $data, true);
		$this->load->view('layout/main_wrapper', $data);		
	}
	function view($tckt = ""){ 
		if(isset($_POST["issue"])){			
			$this->Ticket_Model->updatestatus();
			redirect(base_url("ticket/view/".$tckt), "refresh");
		}
		$data = array();
		$data["ticket"] = $this->Ticket_Model->get($tckt);		
		$data['all_description_lists']    =   $this->Leads_Model->find_description();		
		$data["conversion"] = $this->Ticket_Model->getconv($data["ticket"]->id);
		$data['problem'] = $this->Ticket_Model->get_sub_list();
 
		//$data['data'] = $data;
		$this->load->model('enquiry_model');
        $data['enquiry'] = $this->enquiry_model->enquiry_by_id($data["ticket"]->client);
		$data['ticket_stages'] = $this->Leads_Model->find_estage($data['enquiry']->product_id,4);
		$this->load->model(array('form_model','dash_model','location_model'));
        $this->load->helper('custom_form_helper');

        $data['tab_list'] = $this->form_model->get_tabs_list($this->session->companey_id,0,2);

		$content	 =	$this->load->view('ticket/ticket_disposition',$data,true);
		$content    .=  $this->load->view('ticket/ticket_details',$data,true);
		$content    .=  $this->load->view('ticket/timeline',$data,true);

		$data['content'] = $content;        
        $this->load->view('layout/main_wrapper', $data);
	}

	public function ticket_disposition($ticketno){
		$lead_stage	=	$this->input->post('lead_stage');
		$stage_desc	=	$this->input->post('lead_description');
		$stage_remark	=	$this->input->post('conversation');
		$client	=	$this->input->post('client');
		$user_id = $this->session->user_id;
		$this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
        $this->Ticket_Model->saveconv($ticketno,'Stage Updated',$stage_remark,$client,$user_id,$lead_stage,$stage_desc);
        $ticketno	=	$this->input->post('ticketno');

        $this->load->model('rule_model');
		$this->rule_model->execute_rules($ticketno, array(8,10));

        redirect('ticket/view/'.$ticketno);
	}
	
public function assign_tickets() {

        if (!empty($_POST)) {
            $move_enquiry = $this->input->post('enquiry_id[]');
           // echo json_encode($move_enquiry);
            $assign_employee = $this->input->post('epid');
            $notification_data=array();$assign_data=array();
            if (!empty($move_enquiry)) {
                foreach ($move_enquiry as $key) {
$this->db->set('assign_to', $assign_employee);
$this->db->where('id', $key);
$this->db->update('tbl_ticket');    
                }
                echo display('save_successfully');
            } else {
                echo display('please_try_again');
            }
        }
    }	
	
	public function edit($tckt = ""){
		
		if(isset($_POST["ticketno"]))
		{
			
			$res = $this->Ticket_Model->save($this->session->companey_id,$this->session->user_id);
			if($res)
			{
				$this->session->set_flashdata('message', 'Successfully Updated ticket');
            	redirect(base_url('ticket/edit/'.$tckt), "refresh");
			}
		}
		
		$data["ticket"] = $this->Ticket_Model->get($tckt);
		
		if(empty($data["ticket"])){
			show_404();
		}
		
		
		
		$data['title'] = "Edit ";
		$data["conversion"] = $this->Ticket_Model->getconv($data["ticket"]->id);
		$data["clients"] = $this->Ticket_Model->getallclient();
		$data["product"] = $this->Ticket_Model->getproduct();
		//$data["problem"] = $this->Ticket_Model->getissues();
		$data['problem'] = $this->Ticket_Model->get_sub_list();
		$data['issues'] = $this->Ticket_Model->get_issue_list();

		$data['source'] = $this->Leads_Model->get_leadsource_list();
		//$data["source"] = $this->Ticket_Model->getSource($this->session->companey_id);//getting ticket source list
		$data['content'] = $this->load->view('ticket/edit-ticket', $data, true);
		$this->load->view('layout/main_wrapper', $data);
		
	}
	
	function tdelete(){
		
		$cnt = $this->input->post("content", true);
		
		$this -> db -> where('id', $cnt);
		$this -> db -> delete('tbl_ticket');
		$ret = $this->db->affected_rows();
		$this -> db -> where('tck_id', $cnt);
		$this -> db -> delete('tbl_ticket_conv');
		
		if($ret){
			
			$stsarr = array("status" => "success",
							"message" => "Successfully deleted");
			
		}else{
			$stsarr = array("status" => "failed",
							"message" => "Failed to delete");
			
			
		}
		die(json_encode($stsarr));
	}
	
	public function filter(){
		
		$pst = $this->input->post("top_filter", true);
		
		if($pst == "created_today"){
			
			$where =  " tck.send_date = cast((now()) as date)";
			
		}else if($pst == "updated_today"){
			
			$where =  " tck.last_update	 = cast((now()) as date)";
			
		}else if($pst == "droped"){
			
			$where = array(" tck.status" => 3);	
			
		}else if($pst == "unread"){
			
			$where  =  "tck.status = 0";
			
		} else if($pst == "all"){
			$where = false;
		}else{
			$where = false;
		}
		
		$tickets =  $this->Ticket_Model->filterticket($where);

		
		 if(!empty($tickets)){
			foreach($tickets as $ind => $tck){
				?>
				<tr>
					<td><?php echo $ind + 1; ?></td>
					<td><?php echo $tck->ticketno; ?></td>
					<td><?php echo $tck-> clientname; ?></td>
					<td><?php echo $tck->email ; ?></td>
					<td><?php echo $tck->phone	; ?></td>
					<td><?php echo $tck->	product_name ; ?></td>
					
					<td><?php echo $tck->category ; ?></td>
					<td><?php 
						if($tck->priority == 1){
						?><span class="badge badge-info">Low</span><?php	
						}else if($tck->priority == 2){
						?><span class="badge badge-warning">Medium</span><?php		
						}else if($tck->priority == 2){
							?><span class="badge badge-danger">High</span><?php	
						}
					
					?></td>
					<td><?php echo $tck-> message; ?></td>
					<td><?php echo date("d, M, Y", strtotime($tck->	send_date)); ?></td>
					<td style ="min-width:125px;"><a class="btn  btn-success" href="<?php echo base_url("ticket/view/".$tck->ticketno) ?>"><i class="fa fa-eye" aria-hidden="true"></i>
					<a class="btn  btn-default" href="<?php echo base_url("ticket/edit/".$tck->ticketno) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					<a class="btn  btn-danger delete-ticket"  data-ticket = "<?php echo $tck->id; ?>" href="<?php echo base_url("ticket/tdelete") ?>"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
				
				<?php
				
			}	
		}
		
		
	}
	
	
	public function getmail(){
		
		
	//		'smtp_host' => 'ssl://smtp.googlemail.com',
	//					'smtp_port' => 465,
	//					'smtp_user' => 'admin@digitalanthub.com',
	//					'smtp_pass' => 'Digital@123',
		
		/* connect to gmail */
		
	//	pop.gmail.com

//Requires SSL: Yes

//Port: 995
		
		
		$hostname =  '{imappro.zoho.com:993/imap/ssl}INBOX';
		$username = 'shahnawazbx@gmail.com';
		$password = 'BuX@76543210';
		$username = 'shahnawaz@archizsolutions.com';
		$password = 'Archiz321';
		
	//	$hostname =  '{imap.googlemail.com:993/imap/ssl}INBOX';
	//	$username = 'admin@digitalanthub.com';
	//	$password = 'Digital@123';

		echo "Hello 1";
		
		/* try to connect */
		$inbox = imap_open($hostname,$username ,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
		
		echo "<pre>";
			print_r(imap_errors());
		echo "</pre>";
		echo imap_last_error();
		echo "Hello 2";
		/* grab emails */
		$emails = imap_search($inbox,'ALL');

		/* if emails are returned, cycle through each... */
		if($emails) {

			/* begin output var */
			$output = '';

			/* put the newest emails on top */
			rsort($emails);

			/* for every email... */
			foreach($emails as $ind => $email_number) {

				if($ind > 10) break;

				/* get information specific to this email */
				$overview = imap_fetch_overview($inbox,$email_number,0);
				$message  = imap_fetchbody($inbox, $email_number, 1);
				echo "<pre>";
					print_r($message);
				echo "</pre>";
				
				$output.= 'Name:  '.$overview[0]->from.'</br>';
					$output.= 'Email:  '.$overview[0]->message_id.'</br>';



			}

			echo $output;
		} 

		/* close the connection */
		imap_close($inbox);
		
	}
	
	public function add(){
		
		if(isset($_POST["client"])){
			
			$res = $this->Ticket_Model->save($this->session->companey_id,$this->session->user_id);
			if($res)
			{
				$this->load->model('rule_model');
				$this->rule_model->execute_rules($res, array(3,9));
				
				$this->session->set_flashdata('message', 'Successfully added ticket');
				//redirect(base_url("ticket/add") , "refresh");
            	redirect(base_url('ticket/view/'.$res));
			}
		}
		
		$data['title'] = "Add Ticket";
		$data['source'] = $this->Leads_Model->get_leadsource_list();
		$data["clients"] = $this->Ticket_Model->getallclient();
		$data["product"] = $this->Ticket_Model->getproduct();
		//$data["problem"] = $this->Ticket_Model->getissues();
		$data['problem'] = $this->Ticket_Model->get_sub_list();
		$data['issues'] = $this->Ticket_Model->get_issue_list();
		//$data["source"] = $this->Ticket_Model->getSource($this->session->companey_id);//getting ticket source list
		$data['content'] = $this->load->view('ticket/add-ticket', $data, true);
		$this->load->view('layout/main_wrapper', $data);
		
	}
	
	public function loadinfo(){
		
		$usr = $this->input->post("clientno", true);
		
		$user = $this->db->select("*")->where("enquiry_id", $usr)->get("enquiry")->row();
		
		if(!empty($user)){
			
			$jarr = array("name"   => $user->name_prefix." ".$user->name." ".$user->lastname, 
						  "email"  => $user->email,
						  "phone"  => $user->phone);
			
			die(json_encode($jarr));
		}
	
	}
	
	public function loadamc(){
		
		$prodno = $this->input->post("product", true);
		
		$enqno  = $this->input->post("client", true);
		
		$amcarr = $this->db->select("*")->where(array("product_name" => $prodno, "enq_id" => $enqno))->get("tbl_amc")->row();
		
		$amc = array();
		if(!empty($amcarr)){
			
			$amcarr = array("status" 	  => "found",
							"from_date"   => date("d, M Y ", strtotime($amcarr->amc_fromdate)),
							"to_date"     => date("d, M Y ", strtotime($amcarr->amc_todate))
							);
		}else{
			$amcarr = array("status" => "Not Found");
		}
		die(json_encode($amcarr));
	}
	
	public function loadoldticket($prd = ""){
		
		$data['oldticket'] = $this->db->select("*")->where("product", $prd)->where("company", $this->session->companey_id)->get("tbl_ticket")->result();
		
		$this->load->view("ticket/page/tck-table",$data);
	}

	public function addproblems($prblm = ""){
		
		$this->saveticket();
		
		if(empty($prblm)) {
			
			$data['title'] = "Add Problems";
			$data["problem"] = $this->Ticket_Model->getissues();
			
			$data['content'] = $this->load->view("ticket/page/problem-list", $data, true);
		}else{
			
			$data["eproblem"] = $this->db->select("*")->where("cmp", $this->session->companey_id)->where("id", $prblm)->get("tck_mstr")->row();
			
			$data['content'] = $this->load->view("ticket/page/problem-list", $data, true);
			
		}
		
		$this->load->view('layout/main_wrapper', $data);
		
	}
	
	public function saveticket(){
		
		if(isset($_POST["problem"])){
			
		
			
			if(isset($_POST["problemno"])){
				
				$updarr = array("title" 	=> $this->input->post("problem"),
									);
				$prblm  = $this->input->post("problemno", true);					
									
				$this->db->where("id", $prblm);
				$this->db->update("tck_mstr", $updarr);	
				$this->session->set_flashdata('message', 'Successfully Updated Problem');
				redirect(base_url("ticket/addproblems.html/"), "refresh");
				
			}else{
				$insarr = array("title" 	=> $this->input->post("problem"),
						"cmp"   	=> $this->session->companey_id,
						"added_by"	=> $this->session->user_id
						);
				$this->db->insert("tck_mstr", $insarr);
				redirect(base_url("ticket/addproblems.html"), "refresh");
				$this->session->set_flashdata('message', 'Successfully added Problem');
			}
			
			
		}
		
	}
public function add_subject() {
        $data['title'] = display('ticket_problem_master');
        $data['nav1'] = 'nav2';
        #------------------------------# 
        $leadid = $this->uri->segment(3);

        //////////////////////////////////////////////////////
        if (!empty($_POST)) {

            $reason = $this->input->post('subject');

            $data = array(
                'subject_title' => $reason,
				'comp_id' => $this->session->userdata('companey_id')
            );

            $insert_id = $this->Ticket_Model->add_tsub($data);

            redirect('ticket/add_subject');
        }
        //////////////////////////////////////////////////////


        $data['subject'] = $this->Ticket_Model->get_sub_list();

        $data['content'] = $this->load->view('ticket_subject', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
	
	public function update_subject() {

        if (!empty($_POST)) {
            $drop_id = $this->input->post('drop_id');

            $reason = $this->input->post('subject');

            $this->db->set('subject_title', $reason);
            $this->db->where('id', $drop_id);
            $this->db->update('tbl_ticket_subject');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('Ticket/add_subject');
        }
    }
	public function delete_subject($drop = null) {
        if ($this->Ticket_Model->delete_subject($drop)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('Ticket/add_subject');
    }

    // ticket escalatin rule code start
		public function tat_run($comp_id){			
			$current = date('Y-m-d H:i:s');
			$fetchrules = $this->db->where(array('comp_id' => $comp_id, 'type' => 5,'status'=>1))->order_by("id", "ASC")->get('leadrules')->result();

			if(!empty($fetchrules)){
				foreach ($fetchrules as $key => $value) {
					$rule_action = json_decode($value->rule_action);
					$esc_hr = $rule_action->esc_hr;
					$assign_to = $rule_action->assign_to;
					$rule_title = $value->title; 
					$lid = $value->id;					
					$this->db->where($value->rule_sql);					
					$tickets	=	$this->db->get('tbl_ticket_tab')->result_array();					
					
					 /*echo '<pre>';
					 print_r($tickets); 
					 echo '</pre>';exit;
					 echo $lid.' '.$esc_hr.' '.$rule_title.'<br>';exit;*/
					
					if(!empty($tickets)){ 
						foreach($tickets as $tck){

$today = $current;
$today_date = strtotime($today);
$create = $tck['t_date'];
$ticket_date = strtotime($create);
$hours = round(($today_date - $ticket_date) / 3600);

if($esc_hr<=$hours && $tck['t_status']!=1){

	//For bell notification Ticket escalation
$this->db->select('name,lastname,phone,email,Enquery_id,aasign_to,all_assign,comp_id');
        $this->db->where('Enquery_id', $tck['enquiry_id']);
        $val =   $this->db->get('enquiry')->row();

$this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        $this->db->where('pk_i_admin_id',$tck['created_by']);
        $sender_row =   $this->db->get('tbl_admin')->row_array();

if(!empty($sender_row['telephony_agent_no'])){
    $senderno = '0'.$sender_row['telephony_agent_no'];
}else{
    $senderno = $sender_row['s_phoneno'];
}

$sms_message= $this->db->where(array('temp_id'=>'360','comp_id'=>$tck['comp_id']))->get('api_templates')->row();

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

$aa= $assign_to;
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->user_model->add_comment_for_student_user($val->Enquery_id,$aa,$noti_subject,$new_message,$task_date,$task_time,$sender_row['pk_i_admin_id']);
        }

}

							
						}
					}
				}
			}
		}
}