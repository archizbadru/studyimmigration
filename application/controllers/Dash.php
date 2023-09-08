<?php  	/****  Creadte By Narendra Verma ***********/
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

	 public function __construct()
        {
               parent::__construct();
               $this->load->helper('url');
			   $this->load->helper('form');
			   $this->load->helper('file');
			   $this->load->model('Dash_model','dash_model');
               $this->load->database();	
               $this->load->library('form_validation');	
               $this->load->library('session');	
                $this->load->library('user_agent');
          	if(empty($this->session->user_id)){
        		 redirect('login');   
        		}
		      
			   
        }
	public function index()
	{   $data['nav1']='nav1';
     $data['get_users']=$this->dash_model->get_users();
     $data['number_of_boq']=$this->dash_model->noumber_of_boq();
	$data['user_no']=$this->db->get('tbl_admin')->num_rows();
		$this->load->view('index',$data);
	}
/****  Created By Archiz Solutions ***********/
/**** Area start ***********/
	public function area_list()
	{  
	    $data['page_title']='Main Function';
	    $data['get_users']=$this->dash_model->area_list();
	      $data['nav1']='nav1';
	     $data['content'] =$this->load->view('area-list', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		
	    
	}
	
	
		public function moduler_box()
	{  
	    $data['page_title']='Modular Box';
	     $data['nav1']='nav1';
	    $data['moduler_box']=$this->dash_model->moduler_box();
	    $data['content'] =$this->load->view('mastertest', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		
	    
	}
	
		public function add_modulerbox()
	{  
	      if(!empty($_POST)){
		 $this->form_validation->set_rules('m_name','modular box','required|is_unique[tbl_modular_box.m_name]',array('required' => 'You must provide a %s.','is_unique'=>'This %s already exists.'));
		if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error',validation_errors());
				redirect(base_url().'dash/moduler_box/');  
		}else{
		    $this->dash_model->insert_modular();
		    	$this->session->set_flashdata('success','Records Added Successfully');
		  	redirect(base_url().'dash/moduler_box/');  
		}
	    
	}
	}
	
		public function update_modularbox()
	{  
	      if(!empty($_POST)){
		
		    $this->dash_model->update_modularbox();
		    	$this->session->set_flashdata('success','Records Updated Successfully');
		  	redirect(base_url().'dash/moduler_box/');  
		}else{
		    	redirect(base_url().'dash/moduler_box/');  
		}
	    
	
	}
	
	
   	public function area_add()
	{   $data['page_title']='Main Function';
	  $data['nav1']='nav1';
	    if(!empty($_POST)){
		 $this->form_validation->set_rules('area_name','main function','required|is_unique[tbl_area.a_name]',array('required' => 'You must provide a %s.','is_unique'=>'This %s already exists.'));
		if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error',validation_errors());
				
		      
		 $data['content'] =$this->load->view('add_area', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->dash_model->area_add();
			$this->session->set_flashdata('success','Main function Added Successfully');
		        redirect(base_url().'main-function');
        }
	    }else{
		$data['content'] =$this->load->view('add_area', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}
	}
	 public function edit_mainfun()
	{    $data['page_title']='Main Function';
	     $data['nav1']='nav1';
	     $id=base64_decode($this->uri->segment(2));
	    if(!empty($_POST)){
		 $this->form_validation->set_rules('area_name','main function','required|is_unique[tbl_area.a_name]',array('required' => 'You must provide a %s.','is_unique'=>'This %s already exists.'));
		if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error',validation_errors());
				 $data['edit_main']=$this->dash_model->area_byid($id);
		        $data['content'] =$this->load->view('edit-area', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->dash_model->area_updaete($id);
			$this->session->set_flashdata('success','Main function Added Successfully');
		        redirect(base_url().'main-function');
        }
	    }else{
	    $data['edit_main']=$this->dash_model->area_byid($id);
		       $data['content'] =$this->load->view('edit-area', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}
	}
	
		public function delete_area()
	{   
	        $id=base64_decode($this->uri->segment(3));
	  	     $this->db->where('a_id',$id);
			 $this->db->delete('tbl_area');
			 $this->session->set_flashdata('success','Main function Deleted Successfully');
		       redirect(base_url().'main-function');
	
	}
	public function active_area()
	{   
	    if(!empty($_POST)){
		$user_status=$this->input->post('user_status');
		foreach($user_status as $key){
				$this->db->set('updated_by',$this->session->user_id);
			$this->db->set('ubdated_date',date('Y-m-d h:s:i'));
			$this->db->set('area_status',1);
			$this->db->where('a_id',$key);
			$this->db->update('tbl_area');
		}
			echo 'Record(s) Active Successfully ';
	  }
	}
	public function dactive_area()
	{  
	    if(!empty($_POST)){
		$user_status=$this->input->post('user_status');
		foreach($user_status as $key){
			$this->db->where('a_id',$key);
			$this->db->delete('tbl_area');
		}
				echo 'Record(s) Deleted Successfully';
	    }
	}
	
	
    /****  Creadte By Narendra Verma ***********/
    public function installation()
	{  $data['nav1']='nav5';
	    $this->load->model('Installation_Model');
	    $data['get_data']=$this->Installation_Model->readiness_list();
	    //print_r($data['get_data']);exit();
	    $data['content'] =$this->load->view('installationmaster', $data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
     	
     	
     	
 /**** room list ***********/
	public function room_list()
	{   $data['page_title']='Room List';
	    $data['get_users']=$this->dash_model->room_list();
	      $data['nav1']='nav1';
	    $data['content'] =$this->load->view('room-list', $data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

   	public function room_add()
	{   $data['page_title']='Room List';
	    $data['nav1']='nav1';
	    if(!empty($_POST)){
		 $this->form_validation->set_rules('area_name','Room Name','required|is_unique[tbl_room.r_name]',array('required' => 'You must provide a %s.','is_unique'=>'This %s already exists.'));
		if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error',validation_errors());
		       $data['content'] =$this->load->view('add-room', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->dash_model->room_add();
			$this->session->set_flashdata('success','Room Added Successfully');
		        redirect(base_url().'room-list');
        }
	    }else{
		$data['content'] =$this->load->view('add-room', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}
	}
	
	public function edit_room()
	{     $data['page_title']='Room List';
	      $data['nav1']='nav1';
	     $id=base64_decode($this->uri->segment(2));
	    if(!empty($_POST)){
		 $this->form_validation->set_rules('area_name','Room Name','required|is_unique[tbl_room.r_name]',array('required' => 'You must provide a %s.','is_unique'=>'This %s already exists.'));
		if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error',validation_errors());
					$data['room_byid']=$this->dash_model->room_byid($id);
		        $data['content'] =$this->load->view('edit-room', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->dash_model->room_update($id);
			$this->session->set_flashdata('success','Room Updated Successfully');
		        redirect(base_url().'room-list');
        }
	    }else{
	    	$data['room_byid']=$this->dash_model->room_byid($id);
		  $data['content'] =$this->load->view('edit-room', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}
	}
	
	public function delete_room()
	{  $data['page_title']='Room List';
	        $id=base64_decode($this->uri->segment(3));
	  	     $this->db->where('r_id',$id);
			 $this->db->delete('tbl_room');
			 $this->session->set_flashdata('success','Room Deleted Successfully');
		     redirect('room-list');
	}
	public function active_room()
	{ 
	    if(!empty($_POST)){
		$user_status=$this->input->post('user_status');
		foreach($user_status as $key){
				$this->db->set('updated_by',$this->session->user_id);
			$this->db->set('ubdated_date',date('Y-m-d h:s:i'));
			$this->db->set('room_status',1);
			$this->db->where('r_id',$key);
			$this->db->update('tbl_room');
		}
			echo 'Record(s) Active Successfully ';
	  }
	}
	public function dactive_room()
	{  
	    if(!empty($_POST)){
		$user_status=$this->input->post('user_status');
		foreach($user_status as $key){
			
			$this->db->where('r_id',$key);
			$this->db->delete('tbl_room');
		}
				echo 'Record(s) Deleted Successfully';
	    }
	}
   
    /**** room list ***********/
	public function floor_list()
	{  
	    $data['page_title']='Floor List';
	    $data['get_users']=$this->dash_model->floor_list();
	    $data['nav1']='nav1';
		$data['content'] =$this->load->view('floor-list', $data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
   	public function floor_add()
	{  	$data['page_title']='Floor List';
	    $data['nav1']='nav1';
	    if(!empty($_POST)){
		 $this->form_validation->set_rules('area_name','Floor Name','required|is_unique[tbl_floor.f_name]',array('required' => 'You must provide a %s.','is_unique'=>'This %s already exists.'));
		if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error',validation_errors());
				
		        	$data['content'] =$this->load->view('add-floor', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->dash_model->floor_add();
			$this->session->set_flashdata('success','Floor Added Successfully');
		        redirect(base_url().'floor-list');
        }
	    }else{
		$data['content'] =$this->load->view('add-floor', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}
	} 
	
public function	edit_floor()
	{   $data['page_title']='Floor List';
	    $data['nav1']='nav1';
	        $id=base64_decode($this->uri->segment(2));
	    if(!empty($_POST)){
		 $this->form_validation->set_rules('area_name','Floor Name','required|is_unique[tbl_floor.f_name]',array('required' => 'You must provide a %s.','is_unique'=>'This %s already exists.'));
		if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error',validation_errors());
				$data['floor_byid']=$this->dash_model->floor_byid($id);
		        $data['content'] =$this->load->view('edit-floor', $data,true);
		        $this->load->view('layout/main_wrapper',$data);
		}else{
			$this->dash_model->floor_update($id);
			$this->session->set_flashdata('success','Floor Updated Successfully');
		        redirect(base_url().'floor-list');
        }
	    }else{
	     $data['floor_byid']=$this->dash_model->floor_byid($id);
			$data['content'] =$this->load->view('edit-floor', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}
	}
   

	public function delete_floor()
	{  
	        $id=base64_decode($this->uri->segment(3));
	  	     $this->db->where('f_id',$id);
			 $this->db->delete('tbl_floor');
			 $this->session->set_flashdata('success','Floor Deleted Successfully');
		     redirect('floor-list');
	}
	public function active_floor()
	{   
	    if(!empty($_POST)){
		$user_status=$this->input->post('user_status');
		foreach($user_status as $key){
				$this->db->set('updated_by',$this->session->user_id);
			$this->db->set('ubdated_date',date('Y-m-d h:s:i'));
			$this->db->set('foolr_status',1);
			$this->db->where('f_id',$key);
			$this->db->update('tbl_floor');
		}
			echo 'Record(s) Active Successfully ';
	  }
	}
	public function dactive_floor()
	{   
	    if(!empty($_POST)){
		$user_status=$this->input->post('user_status');
		foreach($user_status as $key){
		
			$this->db->where('f_id',$key);
			$this->db->delete('tbl_floor');
		}
			echo 'Record(s) Deleted Successfully';
	    }
	}


/**** end room ***********/
     	/****  Creadte By Narendra Verma ***********/
/**** item start ***********/
	public function item_list()
	{     
	    $data['page_title']='Function List';
	    $data['all_item']=$this->dash_model->item_list();
	  $data['nav1']='nav1';
		  $data['content'] =$this->load->view('item-list', $data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
		public function add_item()
	{ 
	    $data['page_title']='Function List';
	     $data['nav1']='nav1';
	    if(!empty($_POST)){
		 $this->form_validation->set_rules('funtion_name','Function Name','required',array('required' => 'You must provide a %s.'));
		 $this->form_validation->set_rules('color','color','required',array('required' => 'You must provide a %s.'));
		 $this->form_validation->set_rules('item_shn','Code','required',array('required' => 'You must provide a %s.'));
		 $this->form_validation->set_rules('Unite_p','Price','required',array('required' => 'You must provide a %s.'));
		// $this->form_validation->set_rules('item_shn','color','required',array('required' => 'You must provide a %s.'));
		if($this->form_validation->run()==FALSE){
		$this->session->set_flashdata('error',validation_errors());
		redirect('function-list');
		}else{
			$this->dash_model->add_item();
	         $id_insert=$this->db->insert_id();
			if (!is_dir('uploads/function')) {
            mkdir('uploads/function', 0777, TRUE);
        }
			 $config = array(
            'upload_path' => "uploads/function",
            'allowed_types' => "jpg|png|jpeg",
            'remove_spaces' => TRUE,
            'max_size' => "20000",
            'file_name' => $id_insert
          );
          $this->load->library('upload', $config);
          if ($this->upload->do_upload('file')) {
              $upload = $this->upload->data();
             $this->db->set('img_name',$upload['file_name']);
	        $this->db->where('itemlist_id',$id_insert);
			$this->db->update('tbl_itemlist');
              
          }
			$this->session->set_flashdata('success','Item added successfully');
			 redirect('function-list');
        }
	    }else{
		$data['all_active_item']=$this->dash_model->product_list();
	    $data['content'] =$this->load->view('add_item', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}
	   }
	
		public function edit_items()
	{   $data['page_title']='Function Edit';
	     $data['nav1']='nav1';
	    $id=base64_decode($this->uri->segment(2));
	    if(!empty($_POST)){
	 $this->form_validation->set_rules('funtion_name','Function Name','required',array('required' => 'You must provide a %s.'));
		 $this->form_validation->set_rules('color','color','required',array('required' => 'You must provide a %s.'));
		 $this->form_validation->set_rules('item_shn','Code','required',array('required' => 'You must provide a %s.'));
		 $this->form_validation->set_rules('Unite_p','Price','required',array('required' => 'You must provide a %s.'));
		if($this->form_validation->run()==FALSE){
		$this->session->set_flashdata('error',validation_errors());
		redirect('function-list');
		}else{
			$this->dash_model->update_item($id);
			 	 $config = array(
            'upload_path' => "uploads/function",
            'allowed_types' => "jpg|png|jpeg",
            'remove_spaces' => TRUE,
            'max_size' => "20000",
            'file_name' => $id
          );
          $this->load->library('upload', $config);
          if ($this->upload->do_upload('file')) {
              $upload = $this->upload->data();
             $this->db->set('img_name',$upload['file_name']);
	        $this->db->where('itemlist_id',$id);
			$this->db->update('tbl_itemlist');
              
          }
			$this->session->set_flashdata('success','Item Updated successfully');
			 redirect('function-list');
        }
	    }else{
		$data['all_active_item']=$this->dash_model->product_list();
		$data['all_item_byid']=$this->dash_model->item_listbyid($id);
		 $data['content'] =$this->load->view('edit-item', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}
	}
	
	
	
	   	public function edit_item()
	{  
	    
	    
	       	 $id=base64_decode($this->uri->segment(2));
	  	     $this->db->where('itemlist_id',$id);
			 $this->db->delete('tbl_itemlist');
			 $this->session->set_flashdata('success','Function Deleted Successfully');
		     redirect('function-list');

	 
	}
	  		public function active_item()
	{   
	    if(!empty($_POST)){
		$user_status=$this->input->post('user_status');
		foreach($user_status as $key){
			$this->db->set('updated_by',$this->session->user_id);
			$this->db->set('update_date',date('Y-m-d h:s:i'));
			$this->db->set('item_status',1);
			$this->db->where('itemlist_id',$key);
			$this->db->update('tbl_itemlist');
		}
			echo 'Record(s) Active Successfully ';
	    }
	}

	public function deactive_item()
	{   
	    
	    if(!empty($_POST)){
		$user_status=$this->input->post('user_status');
		foreach($user_status as $key){
			
			$this->db->where('itemlist_id',$key);
			$this->db->delete('tbl_itemlist');
		}
			echo 'Record(s) Deleted Successfully';
	    }

	}
	public function deactive_products()
	{   
		/*print_r($_POST);
		exit();
	    */
	    if(!empty($_POST)){
		$pro_status=$this->input->post('product_status');
		foreach($pro_status as $key){
			
			$this->db->where('sb_id',$key);
			$this->db->delete('tbl_product');
		}
			echo '1';
	    }else{
	      echo '0';  
	    }

	}
	
/**** end tax ***********/

/**** item start ***********/
	public function sub_list()
	{    $data['page_title']='Sub Function List';
	    
	    $data['all_item']=$this->dash_model->sub_function_list();
	  $data['nav1']='nav1';

		 $data['content'] =$this->load->view('sub-function-list', $data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
		public function add_sub_function()
	{  $data['page_title']='Sub Function List';
	   $data['nav1']='nav1';
	    if(!empty($_POST)){
		 $this->form_validation->set_rules('item_name','Function Name','required|is_unique[tbl_itemlist.item_name]',array('required' => 'You must provide a %s.','is_unique'=>'This %s already exists.'));
		 $this->form_validation->set_rules('rooms','Room','required',array('required' => 'You must provide a %s.'));
		if($this->form_validation->run()==FALSE){
		$this->session->set_flashdata('error',validation_errors());
		$data['all_active_item']=$this->dash_model->item_list();
			 $data['content'] =$this->load->view('add-sub-function', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->dash_model->add_sub_function();
			$this->session->set_flashdata('success','Item added successfully');
			 redirect('sub-function-list');
        }
	    }else{
		$data['all_active_item']=$this->dash_model->item_list();
		$data['content'] =$this->load->view('add-sub-function', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}
	   }
	
	
		public function edit_sub_functions()
	{   $data['page_title']='Sub Function List';
	    $data['nav1']='nav1';
	    $id=base64_decode($this->uri->segment(2));
	    if(!empty($_POST)){
		$this->form_validation->set_rules('rooms','Room','required',array('required' => 'You must provide a %s.'));
		if($this->form_validation->run()==FALSE){
		$this->session->set_flashdata('error',validation_errors());
		$data['all_active_item']=$this->dash_model->item_list();
			$data['all_subactive_item']=$this->dash_model->item_sublistbyid();
		$data['content'] =$this->load->view('edit-sub-function', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->dash_model->edit_sub_function($id);
			$this->session->set_flashdata('success','Item added successfully');
			 redirect('sub-function-list');
        }
	    }else{
		$data['all_active_item']=$this->dash_model->item_list();
		$data['all_subactive_item']=$this->dash_model->item_sublistbyid($id);
		$data['content'] =$this->load->view('edit-sub-function', $data,true);
		$this->load->view('layout/main_wrapper',$data);
		}
	   }
	
	
	   	public function delete_sub_function()
	{  
	    
	    
	       	 $id=base64_decode($this->uri->segment(2));
	  	     $this->db->where('s_itemlist_id',$id);
			 $this->db->delete('sub_function');
			 $this->session->set_flashdata('success','Function Deleted Successfully');
		     redirect('sub-function-list');

	  
	}
	  		public function active_sub_function()
	{    
	    if(!empty($_POST)){
		$user_status=$this->input->post('user_status');
		foreach($user_status as $key){
			$this->db->set('updated_by',$this->session->user_id);
			$this->db->set('update_date',date('Y-m-d h:s:i'));
			$this->db->set('item_status',1);
			$this->db->where('s_itemlist_id',$key);
			$this->db->update('sub_function');
		}
			echo 'Record(s) Active Successfully ';
	    }
	}

	public function deactive_sub_function()
	{   
	    
	    if(!empty($_POST)){
		$user_status=$this->input->post('user_status');
		foreach($user_status as $key){
		
			$this->db->where('s_itemlist_id',$key);
			$this->db->delete('sub_function');
		}
			echo 'Record(s) DeActive Successfully';
	    }
	}
	
	
	//Load Signature master...
	public function signature_master(){
	    $data['nav1']='nav5';
	    $data['page_title']='Mail Signature';
	    $data['s_lists']=$this->dash_model->signaturList();
	    $data['content'] =$this->load->view('mail-signature-master', $data,true);
		$this->load->view('layout/main_wrapper',$data);
	    
	    
	}
	
	
	public function createsignature(){
	    
	    $signature = $this->input->post('template_content');
	    
	    $config['upload_path'] = 'assets/attachments/signature/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        
        $this->load->library('upload', $config);
	    
	    if($_FILES['file']['size']!=0){
	    
    	    if($this->upload->do_upload('file')){
    	        
    	        $logo = 'assets/attachments/signature/'.$this->upload->data('file_name');
    	    }
	    
	    }else{
	        
	        $logo=0;
	    }
	    
	    $data = array(
	        
	        'user_id'=>$this->session->user_id,
	        'signature'=>$signature,
	        'logo'     =>$logo
	    );
	    
	    if($this->dash_model->add_mail_signature($data)){
	        
	        $this->session->set_flashdata('SUCCESSMSG','Signature Added Successfully');
            redirect('dash/signature_master');
	        
	    }
	    
	    
	}
	
	//Update user signature
	public function updatesignature(){
	    
	    $content = $this->input->post('content');
	    
	    echo $content;exit();
	    
	    $row_id = $this->input->post('row_id');
	    
	    if($_FILES['new_logo']['size']==0){
	        
	         $logo = $this->input->post('old_logo');
	        
	    }else{
	        
	        $config['upload_path'] = 'assets/attachments/signature/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            
            $this->load->library('upload', $config);
    	    
    	    if($this->upload->do_upload('new_logo')){
    	        
    	        $logo = 'assets/attachments/signature/'.$this->upload->data('file_name');
    	    }
	        
	    }
	    
	    $data = array(
	        
	        'signature'=>$content,
	        'logo'     =>$logo
	    );
	    
	     if($this->dash_model->edit_user_signature($row_id,$data)){
	        
	        $this->session->set_flashdata('SUCCESSMSG','Signature Updated Successfully');
            redirect('dash/signature_master');
	        
	    }
	    
	    
	    
	    
	    
	}
	
	//Delete Signature...
	public function delete_signature(){
	    
	    $ids = $this->input->post('user_status');
	    
	    $this->dash_model->Delete_signatures($ids);
	    
	    
	}
	
	//Switch box master....
	public function load_switc_box_master(){
	     $data['nav1']='nav1';
	    $data['page_title']='Switch Box Master';
	    
	    $data['switch']=$this->dash_model->switch_box_list();
	    
	    $data['content'] =$this->load->view('switch_box', $data,true);
		$this->load->view('layout/main_wrapper',$data);
	    
	}
	
	
	
	
	//Insert switch box master data
	public function add_switch_box(){
	    
	    $switch_box = $this->input->post('switch_box');
	    
	    $data = array(
	        
	        'switch_box'=>$switch_box,
	        'added_by'  =>$this->session->user_id,
	        'added_on'  =>date('d-m-Y')
	   );
	   
	   if($this->dash_model->add_switch_box($data)){
	       
	        $this->session->set_flashdata('success','Switch box added sucessfully...');
            redirect('dash/load_switc_box_master');
	   }
	}
	public function update_switch_box(){
	    
	    $switch_box = $this->input->post('switch_box');
	    
	    $data = array(
	        
	        'switch_box'=>$switch_box,
	        'added_by'  =>$this->session->user_id,
	        'added_on'  =>date('d-m-Y')
	   );
	   
	   if($this->dash_model->update_switch_box($data)){
	       
	        $this->session->set_flashdata('success','Switch box updated sucessfully...');
            redirect('dash/load_switc_box_master');
	   }
	}
	
	
		//Insert switch box master data
	public function add_product(){
	    
	    $product_name = $this->input->post('product_name');
	    $main_fun_name=$this->input->post('main_fun_name');
	    $data = array(
	        
	        'product_name'=>$product_name,
			'comp_id'=>$this->session->userdata('companey_id'),
	        'main_fun'=>$main_fun_name,
	        'status'=>1,
	        'added_by'  =>$this->session->user_id,
	        'added_on'  =>date('d-m-Y')
	   );
	   
	   if($this->dash_model->add_product($data)){
	       
	        $this->session->set_flashdata('success','Process added sucessfully...');
            redirect('lead/product-list');
	   }
	}
	public function update_product(){	    
	    $product_name = $this->input->post('product_name');
	     //$main_fun_name =$this->input->post('main_fun_name');
	     $status = $this->input->post('status');
	     $product_id =$this->input->post('sb_id');
	    $data = array(	        
	        'product_name'=>$product_name,
	        'status'=>$status,
	        'main_fun'=>0
	   );
	  // print_r($data);exit;
	   if($this->dash_model->update_product($data)){	       
	        $this->session->set_flashdata('success','Process updated sucessfully...');
            redirect('lead/product-list');
	   }
	}
	//Delete switch box...
	public function delete_switch_box(){
	    
	    $ids = $this->input->post('ids');
	    
	    $this->dash_model->delete_switch_boxes($ids);
	    
	}
	
	
	
	
/**** end tax ***********/

     	/****  Creadte By Narendra Verma ***********/


}
