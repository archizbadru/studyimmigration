<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Setting extends CI_Controller {



	public function __construct()

	{

		parent::__construct();

		

		$this->load->model(array(

			'setting_model'

		));



		/*if ($this->session->userdata('isLogIn') == false 

			|| $this->session->userdata('user_role') != 1 

		){

		    

		    	redirect('login'); 

		}*/

	

	}

 



	public function index()

	{

		$data['title'] = display('application_setting');

		#-------------------------------#

		//check setting table row if not exists then insert a row

		$this->check_setting();

		#-------------------------------#

		$data['languageList'] = $this->languageList(); 

		$data['setting'] = $this->setting_model->read();

		$data['content'] = $this->load->view('setting',$data,true);

		$this->load->view('layout/main_wrapper',$data);

	} 



	public function remindermsg()

	{
		$data['title'] = 'Reminder Message';
		$data['content'] = $this->load->view('setting/reminder_setting',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

	public function fetchTemplate()
	{
	   $type= $this->input->post('type');
	   $fetch=$this->uri->segment('3');
	   // $message= $this->input->post('type');
		 $comp_id=$this->session->companey_id;
		 if($fetch==0){
		     if($type==1){
				 echo '@prefix<br>@firstname<br>@lastname ';
			 }elseif($type==2 OR $type==3 OR $type==7 OR $type==5){
				 //Agreement Reminder submited
				// Refund Form Allow
				//Final Agreement Submited
				echo '@prefix<br>@firstname<br>@lastname<br>@enquiry_id ';
			 }elseif($type==4){
				//payment reminder
				echo '@prefix<br>@firstname<br>@lastname<br>@amount<br>@duedate ';
			 }elseif($type==6){
				 //website_form
				 echo '<center> Website Form </center>@name<br>@email<br>@phone<br><center> User </center><br>@firstname<br>@lastname<br>@userphone<br>@useremail';
			 }
		 }else{
			$data= $this->db->where(array('comp_id'=>$comp_id,'reminder_type'=>$type))->get('reminder_message');
		if($data->num_rows()==1){
			echo $data->row()->message;
		 }else{
			 echo 'none';
		 }
		 
		}
		
	} 
	public function insertSetting()
	{
		$type=$this->input->post('type');
		$message=$this->input->post('message');
		$comp_id=$this->session->companey_id;
		$checkreminder=$this->db->where(array('comp_id'=>$comp_id,'reminder_type'=>$type,))->count_all_results('reminder_message');
		if($checkreminder==0){
			$data=['comp_id'=>$comp_id,'message'=>$message,'reminder_type'=>$type,'created_by'=>$this->session->user_id];
			$this->db->insert('reminder_message',$data);
		}else{
			$data=['comp_id'=>$comp_id,'message'=>$message,'reminder_type'=>$type,'created_by'=>$this->session->user_id];
			$this->db->where(array('comp_id'=>$comp_id,'reminder_type'=>$type))->update('reminder_message',$data);
			
		}
		$this->session->set_flashdata('message',display('save_successfully'));
		redirect($this->agent->referrer());
	}

	public function create()

	{

		$data['title'] = display('application_setting');

		#-------------------------------#

		$this->form_validation->set_rules('title',display('website_title'),'required|max_length[50]');

		$this->form_validation->set_rules('description', display('address') ,'max_length[255]');

		$this->form_validation->set_rules('email',display('email'),'max_length[100]|valid_email');

		$this->form_validation->set_rules('phone',display('phone'),'max_length[20]');

		$this->form_validation->set_rules('language',display('language'),'max_length[250]'); 

		$this->form_validation->set_rules('footer_text',display('footer_text'),'max_length[255]'); 

		$this->form_validation->set_rules('time_zone',display('time_zone'),'required|max_length[100]'); 

		#-------------------------------#

		//logo upload

		$logo = $this->fileupload->do_upload(

			'assets/images/apps/',

			'logo'

		);

		// if logo is uploaded then resize the logo

		if ($logo !== false && $logo != null) {

			$this->fileupload->do_resize(

				$logo, 

				210,

				48

			);

		}

		//if logo is not uploaded

		if ($logo === false) {

			$this->session->set_flashdata('exception', display('invalid_logo'));

		}





		//favicon upload

		$favicon = $this->fileupload->do_upload(

			'assets/images/icons/',

			'favicon'

		);

		// if favicon is uploaded then resize the favicon

		if ($favicon !== false && $favicon != null) {

			$this->fileupload->do_resize(

				$favicon, 

				32,

				32

			);

		}

		//if favicon is not uploaded

		if ($favicon === false) {

			$this->session->set_flashdata('exception',  display('invalid_favicon'));

		}		

		#-------------------------------#



		$data['setting'] = (object)$postData = [

			'setting_id'  => $this->input->post('setting_id'),

			'title' 	  => $this->input->post('title'),

			'description' => $this->input->post('description', false),

			'email' 	  => $this->input->post('email'),

			'phone' 	  => $this->input->post('phone'),

			'logo' 	      => (!empty($logo)?$logo:$this->input->post('old_logo')),

			'favicon' 	  => (!empty($favicon)?$favicon:$this->input->post('old_favicon')),

			'language'    => $this->input->post('language'), 

			'time_zone'   => $this->input->post('time_zone'), 

			'site_align'  => $this->input->post('site_align'), 

			'footer_text' => $this->input->post('footer_text', false),

		]; 

		#-------------------------------#

		if ($this->form_validation->run() === true) {



			#if empty $setting_id then insert data

			if (empty($postData['setting_id'])) {

				if ($this->setting_model->create($postData)) {

					#set success message

					$this->session->set_flashdata('message',display('save_successfully'));

				} else {

					#set exception message

					$this->session->set_flashdata('exception',display('please_try_again'));

				}

			} else {

				if ($this->setting_model->update($postData)) {

					#set success message

					$this->session->set_flashdata('message',display('update_successfully'));

				} else {

					#set exception message

					$this->session->set_flashdata('exception', display('please_try_again'));

				} 

			}



			//update session data

			$this->session->set_userdata([

				'title' 	  => $postData['title'],

				'address' 	  => $postData['description'],

				'email' 	  => $postData['email'],

				'phone' 	  => $postData['phone'],

				'logo' 		  => $postData['logo'],

				'favicon' 	  => $postData['favicon'],

				'language'    => $postData['language'], 

				'footer_text' => $postData['footer_text'],

				'time_zone'   => $postData['time_zone'],

			]);



			redirect('setting');



		} else { 

			$data['languageList'] = $this->languageList(); 

			$data['content'] = $this->load->view('setting',$data,true);

			$this->load->view('layout/main_wrapper',$data);

		} 

	}



	public function enquiryDuplicacySetting()
	{	
		$data['title']		= "Enquiry Duplicacy";
		$data['ruledata']	= $this->db->select("*")->from("tbl_new_settings")->where('comp_id',$this->session->companey_id)->get()->result_array();
		$data['content'] 	= $this->load->view('enq_duplicacy_setting',$data,true);

			$this->load->view('layout/main_wrapper',$data);
	}
	public function saveEnquiryRule()
	{	
		//print_r($_POST);die;
		$data = array(
			'comp_id'					=> $this->session->companey_id,
			'duplicacy_status'			=> $this->input->post('allowornot'),
			'field_for_identification'	=> $this->input->post('fields'),
			'status'					=> 1,
		);
		if(!empty($this->input->post('ruleid')))
		{	
			$this->db->where('id',$this->input->post('ruleid'));
			$this->db->update('tbl_new_settings',$data);
			$this->session->set_flashdata("msg","Updated Successfully");
			redirect('setting/enquiryDuplicacySetting');
		}
		else
		{
			$insert = $this->db->insert('tbl_new_settings',$data);
			$this->session->set_flashdata("msg","Inserted Successfully");
			redirect('setting/enquiryDuplicacySetting');
		}
		
		
	}

	public function deleteEnquiryRule($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('tbl_new_settings');
		$this->session->set_flashdata("msg","Deleted Successfully");
		redirect('setting/enquiryDuplicacySetting');
	}

	//check setting table row if not exists then insert a row

	public function check_setting()

	{

		if ($this->db->count_all('setting') == 0) {

			$this->db->insert('setting',[

				'title' => 'Demo Hospital Limited',

				'description' => '123/A, Street, State-12345, Demo',

				'time_zone' => 'Asia/Dhaka',

				'footer_text' => '2016&copy;Copyright',

			]);

		}

	}





    public function languageList()

    { 

        if ($this->db->table_exists("language")) { 



                $fields = $this->db->field_data("language");



                $i = 1;

                foreach ($fields as $field)

                {  

                    if ($i++ > 2)

                    $result[$field->name] = ucfirst($field->name);

                }



                if (!empty($result)) return $result;

 



        } else {

            return false; 

        }

    }

    

    //Change password load view....

    public function change_password(){

        

        $data['page_title'] = 'Change password';

		

		$data['content'] = $this->load->view('change-password',$data,true);

		$this->load->view('layout/main_wrapper',$data);

    }

    

    //change password..

    public function update_password(){

        

        $oldpas    = md5($this->input->post('oldpass'));

        $newpass   = md5($this->input->post('newpass'));

        $confrpass = md5($this->input->post('confirmpass'));

        

        if($newpass!=$confrpass){

            

            $this->session->set_flashdata('error','Confirm password is not matched');

            redirect('setting/change_password');

            exit();

        }

        

        

        if($this->setting_model->update_pass($oldpas,$newpass)==TRUE){

            

            $this->session->set_flashdata('success','Your password has changed successfully...');

            redirect('setting/change_password');

            

        }else{

            

            $this->session->set_flashdata('error','Your old password is not matched...');

            redirect('setting/change_password');

            

        }

        

        

    }





}

