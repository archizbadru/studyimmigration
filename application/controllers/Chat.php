<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chat extends CI_Controller {
	public function __construct(){
		parent::__construct();	
		$this->load->model('enquiry_model');	
	}

	public function index($comp_id=0,$created_by=154){
		$data['comp_id'] = $comp_id;
		$data['created_by'] = $created_by;
		if ($comp_id) {
			$this->load->view('chats/chatbot',$data);
		}else{
			echo "Something went wrong with chat!";
		}
	}
	public function agent_chat(){				
		$data = array();
		$this->load->view('chats/agent_chat',$data);	
	}
	public function chat_admin(){
		$data['title'] = 'Chat';
		$data['content'] = $this->load->view('chats/chat_admin',$data,true);	
        $this->load->view('layout/main_wrapper', $data);		
	}
	public function submit_identity($comp_id,$created_by,$process_id=2){
		
		$name	=	$this->input->post('name');
		$mobile	=	$this->input->post('mobile');
		$email	=	$this->input->post('email');

		$where = " comp_id=".$comp_id;
		$where .= " AND (phone=".$mobile;
		$where .= " OR email='".$email.'\')';

		if ($process_id) {
			$where .= ' AND product_id='.$process_id;
		}
		$row	=	$this->enquiry_model->is_enquiry_exist($where);
		

		if (!empty($row)) {			
			$res  = $row['Enquery_id'];
			$this->session->set_userdata('chat_user_id',$res);
			$this->session->set_userdata('chat_fullname',$row['name'].' '.$row['lastname']);
			
			$this->session->set_userdata('chat_mobile',$row['phone']);
			$this->session->set_userdata('chat_email',$row['email']);
			$this->session->set_userdata('chat_companey_id',$row['comp_id']);
			
		}else{

			$name	=	explode(' ', $name);
			
			$fname  	= !empty($name[0])?$name[0]:'';
			$last_name  = !empty($name[1])?$name[1]:'';

			

			$curl = curl_init();
			$api_url = base_url()."api/enquiry/create";
			curl_setopt_array($curl, array(
			  	CURLOPT_URL => $api_url,
			  	CURLOPT_RETURNTRANSFER => true,
			  	CURLOPT_ENCODING => "",
			  	CURLOPT_MAXREDIRS => 10,
			  	CURLOPT_TIMEOUT => 0,
			  	CURLOPT_FOLLOWLOCATION => true,
			  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  	CURLOPT_SSL_VERIFYPEER =>false, // line added beacuse of SSL Error 60
			  	CURLOPT_CUSTOMREQUEST => "POST",
			  	CURLOPT_POSTFIELDS => array('fname' => $fname,'lastname' => $last_name,'email' => $email,'mobileno' => $mobile,'company_id' => $comp_id,'process_id' => $process_id,'user_id' => 154),
			  	CURLOPT_HTTPHEADER => array(
			    	"Cookie: ci_session=3ba7d4lq4alv2pgpq3sc8t2ojrh41s04"
			  	),
			));
			$response = curl_exec($curl);

			if(curl_error($curl))
				echo curl_error($curl);

			curl_close($curl);	

			$row	=	$this->enquiry_model->is_enquiry_exist($where);	

			//echo $row;
			//echo $response.'by me';
			//echo $this->db->last_query();
			//var_dump($response);
			//var_dump($api_url);
			if (!empty($row)) {			
				$res  = $row['Enquery_id'];
				$this->session->set_userdata('chat_user_id',$res);
				$this->session->set_userdata('chat_fullname',$row['name'].' '.$row['lastname']);
				$this->session->set_userdata('chat_mobile',$row['phone']);
				$this->session->set_userdata('chat_email',$row['email']);
				$this->session->set_userdata('chat_companey_id',$row['comp_id']);
			}
			//echo"Els";
		}
		//print_r($_SESSION);
		echo json_encode(array('user_id'=>$this->session->chat_user_id,'fullname'=>$this->session->chat_fullname,'mobile'=>$this->session->chat_mobile,'email'=>$this->session->chat_email,'companey_id'=>$this->session->chat_companey_id));
	}
	public function get_current_chat_session(){
		echo json_encode(array('user_id'=>$this->session->user_id,'fullname'=>$this->session->fullname,'mobile'=>$this->session->mobile,'email'=>$this->session->email,'companey_id'=>$this->session->companey_id));	
	}
	public function get_current_date_time(){
		echo date('Y-m-d h:i:sa');
	}
}