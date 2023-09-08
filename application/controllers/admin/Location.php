<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class location extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array( 
            'location_model',
        ));  
    } 
 

    function country() {
       $data['title'] = display('country_list');
        $data['country']=$this->location_model->country();
        $data['content'] =$this->load->view('Admin/location/country_list', $data,true);
		$this->load->view('Admin/main_wrapper',$data);
    }
   
   function region() {
        $data['title'] = display('region_list');
        $data['country']=$this->location_model->region_list();
        $data['content'] =$this->load->view('Admin/location/region_list', $data,true);
		$this->load->view('Admin/main_wrapper',$data);
    }
    function territory() {
       $data['title'] = display('country_list');
        $data['country']=$this->location_model->territory_lsit();
        $data['content'] =$this->load->view('Admin/location/territory_list', $data,true);
		$this->load->view('Admin/main_wrapper',$data);
    }
     function get_region_byid() {
         $country_id=$this->input->post('country_id');
        
         $data['country']=$this->location_model->get_region_byid($country_id);
         echo '<option value="" selected>Select</option>';
         foreach( $data['country'] as $r){
             echo '<option value="'.$r->region_id.'">'.$r->region_name.'</option>';
         }
       
     }
     function get_tretory_byid() {
         $country_id=$this->input->post('country_id');
           $region_id=$this->input->post('region_id');
         $data['country']=$this->location_model->get_tretory_byid($country_id,$region_id);
         echo '<option value="" selecte>Select</option>';
         foreach( $data['country'] as $r){
             echo '<option value="'.$r->territory_id.'">'.$r->territory_name.'</option>';
         }
       
     }
       function get_state_byid() {
         $country_id=$this->input->post('country_id');
           $region_id=$this->input->post('region_id');
             $territory_id=$this->input->post('territory_id');
         $data['country']=$this->location_model->get_state_byid($country_id,$region_id,$territory_id);
          echo '<option value="" selecte>Select</option>';
         foreach( $data['country'] as $r){
             echo '<option value="'.$r->id.'">'.$r->state.'</option>';
         }
       
     }
       function get_city_byid() {
         $country_id=$this->input->post('country_id');
           $region_id=$this->input->post('region_id');
             $territory_id=$this->input->post('territory_id');
                $state_id=$this->input->post('state_id');
         $data['country']=$this->location_model->get_city_byid($country_id,$region_id,$territory_id,$state_id);
          echo '<option value="" selecte>Select</option>';
         foreach( $data['country'] as $r){
             echo '<option value="'.$r->id.'">'.$r->city.'</option>';
         }
       
     }
    
    function state() {
       $data['title'] = display('country_list');
        $data['country']=$this->location_model->state_list();
        $data['content'] =$this->load->view('Admin/location/state_list', $data,true);
		$this->load->view('Admin/main_wrapper',$data);
    }
    function city() {
       $data['title'] = display('country_list');
        $data['country']=$this->location_model->city_list();
        $data['content'] =$this->load->view('Admin/location/city_list', $data,true);
		$this->load->view('Admin/main_wrapper',$data);
    }
    
    public function create()
	{
		$data['title'] = display('add_country');
		$data['doctor'] ='';
		#-------------------------------#
		if(empty($this->input->post('user_id'))){
		
		$this->form_validation->set_rules('country_name', display('country_name') ,'required|max_length[50]|is_unique[tbl_country.country_name]',array('is_unique'=>'Duplicate entery'));
	  
		#-------------------------------#
		}else{
		        	$this->form_validation->set_rules('country_name', display('country_name') ,'required|max_length[50]');
		}
	
	
		#-------------------------------# 
		//when create a user
		if (empty($this->input->post('user_id'))) {
			$data['doctor'] = (object)$postData = [
			    'id_c' =>$this->input->post('user_id',true),
				'country_name'    => $this->input->post('country_name',true),
				'c_status' 	   => $this->input->post('status',true),
				'created_by'   => $this->session->userdata('user_id'),
				'created_date'  => date('Y-m-d'),
			]; 
		} else { //update a user
			$data['doctor'] = (object)$postData = [
			    'id_c' =>$this->input->post('user_id',true),
				'country_name'    => $this->input->post('country_name',true),
				'c_status' 	   => $this->input->post('status',true),
				'created_by'   => $this->session->userdata('user_id'),
				'created_date'  => date('Y-m-d'),
			]; 
		}
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $user_id then insert data
			if (empty($this->input->post('user_id'))) {
				if ($this->location_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				

				redirect('admin/location/create');
			} else {
				if ($this->location_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
					redirect('admin/location/create');
			}

		} else {
		
			$data['content'] = $this->load->view('Admin/location/country_from',$data,true);
			$this->load->view('Admin/main_wrapper',$data);
		} 
	}
	
	
	
	public function add_region()
	{
		$data['title'] = display('add_region');
		$data['doctor'] ='';
		#-------------------------------#
		if(empty($this->input->post('user_id'))){
		
		$this->form_validation->set_rules('region_name', display('region_name') ,'required|max_length[50]|is_unique[tbl_region.region_name]',array('is_unique'=>'Duplicate entery'));
	   
		#-------------------------------#
		}else{
		        	$this->form_validation->set_rules('country_name', display('country_name') ,'required|max_length[50]');
		}
	
	
		#-------------------------------# 
		//when create a user
		if (empty($this->input->post('user_id'))) {
			$data['doctor'] = (object)$postData = [
			    'region_id' =>$this->input->post('user_id',true),
				'country_id'    => $this->input->post('country_id',true),
				'region_name'    => $this->input->post('region_name',true),
				'status' 	   => $this->input->post('status',true),
				'created_by'   => $this->session->userdata('user_id'),
				'created_date'  => date('Y-m-d'),
			]; 
		} else { //update a user
			$data['doctor'] = (object)$postData = [
			    'region_id' =>$this->input->post('user_id',true),
				'country_id'    => $this->input->post('country_id',true),
				'region_name'    => $this->input->post('region_name',true),
				'status' 	   => $this->input->post('status',true),
				'created_by'   => $this->session->userdata('user_id'),
				'created_date'  => date('Y-m-d'),
			]; 
		}
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $user_id then insert data
			if (empty($this->input->post('user_id'))) {
				if ($this->location_model->create_region($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				

				redirect('admin/location/create');
			} else {
				if ($this->location_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
					redirect('admin/location/create');
			}

		} else {
		  $data['country']=$this->location_model->country();
			$data['content'] = $this->load->view('Admin/location/region_from',$data,true);
			$this->load->view('Admin/main_wrapper',$data);
		} 
	}
	
	
	
		public function add_territory()
	{
		$data['title'] = display('add_teretory');
		$data['doctor'] ='';
		#-------------------------------#
		if(empty($this->input->post('user_id'))){
		
		$this->form_validation->set_rules('territory_name', display('territory_name') ,'required|max_length[50]|is_unique[tbl_territory.territory_name]',array('is_unique'=>'Duplicate entery'));
	   
		#-------------------------------#
		}else{
		        	$this->form_validation->set_rules('country_name', display('country_name') ,'required|max_length[50]');
		}
	$this->form_validation->set_rules('country_id', display('country_name') ,'required|max_length[50]');
	$this->form_validation->set_rules('region_id', display('region_name') ,'required|max_length[50]');
		#-------------------------------# 
		//when create a user
		if (empty($this->input->post('user_id'))) {
			$data['doctor'] = (object)$postData = [
			    'territory_id' =>$this->input->post('user_id',true),
			    'territory_name'    => $this->input->post('territory_name',true),
				'country_id'    => $this->input->post('country_id',true),
				'region_id'    => $this->input->post('region_id',true),
				'status' 	   => $this->input->post('status',true),
				'created_by'   => $this->session->userdata('user_id'),
				'created_date'  => date('Y-m-d'),
			]; 
		} else { //update a user
			$data['doctor'] = (object)$postData = [
			    'territory_id' =>$this->input->post('user_id',true),
			    'territory_name'    => $this->input->post('territory_name',true),
				'country_id'    => $this->input->post('country_id',true),
				'region_id'    => $this->input->post('region_name',true),
				'status' 	   => $this->input->post('status',true),
				'created_by'   => $this->session->userdata('user_id'),
				'created_date'  => date('Y-m-d'),
			]; 
		}
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $user_id then insert data
			if (empty($this->input->post('user_id'))) {
				if ($this->location_model->create_tretory($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				

				redirect('admin/location/territory');
			} else {
				if ($this->location_model->update_tretory($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
					redirect('admin/location/territory');
			}

		} else {
		  $data['country']=$this->location_model->country();
		   $data['region_list']=$this->location_model->region_list();
			$data['content'] = $this->load->view('Admin/location/territory_from',$data,true);
			$this->load->view('Admin/main_wrapper',$data);
		} 
	}
	
		public function add_state()
	{
		$data['title'] = display('add_state');
		$data['doctor'] ='';
		#-------------------------------#
		if(empty($this->input->post('user_id'))){
		
		$this->form_validation->set_rules('state_name', display('state_name') ,'required|max_length[50]|is_unique[state.id]',array('is_unique'=>'Duplicate entery'));
	   
		#-------------------------------#
		}else{
		        	$this->form_validation->set_rules('state_name', display('state_name') ,'required|max_length[50]');
		}
	$this->form_validation->set_rules('country_id', display('country_name') ,'required|max_length[50]');
	$this->form_validation->set_rules('region_id', display('region_name') ,'required|max_length[50]');
	$this->form_validation->set_rules('territory_id', display('territory_name') ,'required|max_length[50]');
		#-------------------------------# 
		//when create a user
		if (empty($this->input->post('user_id'))) {
			$data['doctor'] = (object)$postData = [
			    'id' =>$this->input->post('user_id',true),
			    'state' =>$this->input->post('state_name',true),
			    'territory_id'    => $this->input->post('territory_id',true),
				'country_id'    => $this->input->post('country_id',true),
				'region_id'    => $this->input->post('region_id',true),
				'status' 	   => $this->input->post('status',true),
				'created_by'   => $this->session->userdata('user_id'),
				'date_modify'  => date('Y-m-d'),
			]; 
		} else { //update a user
			$data['doctor'] = (object)$postData = [
			    'id' =>$this->input->post('user_id',true),
			    'state' =>$this->input->post('state_name',true),
			    'territory_id'    => $this->input->post('territory_id',true),
				'country_id'    => $this->input->post('country_id',true),
				'region_id'    => $this->input->post('region_id',true),
				'status' 	   => $this->input->post('status',true),
				'created_by'   => $this->session->userdata('user_id'),
				'date_modify'  => date('Y-m-d'),
			]; 
		}
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $user_id then insert data
			if (empty($this->input->post('user_id'))) {
				if ($this->location_model->create_state($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				

				redirect('admin/location/state');
			} else {
				if ($this->location_model->update_state($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
					redirect('admin/location/state');
			}

		} else {
		  $data['country']=$this->location_model->country();
		   $data['region_list']=$this->location_model->region_list();
			$data['content'] = $this->load->view('location/state_from',$data,true);
			$this->load->view('Admin/main_wrapper',$data);
		} 
	}
	
	public function add_city()
	{
		$data['title'] = display('add_city');
		$data['doctor'] ='';
		#-------------------------------#
		if(empty($this->input->post('user_id'))){
		
		$this->form_validation->set_rules('city_name', display('city_name') ,'required|max_length[50]|is_unique[city.city]',array('is_unique'=>'Duplicate entery'));
	   
		#-------------------------------#
		}else{
		        	$this->form_validation->set_rules('city_name', display('city_name') ,'required|max_length[50]');
		}
	$this->form_validation->set_rules('country_id', display('country_name') ,'required|max_length[50]');
	$this->form_validation->set_rules('region_id', display('region_name') ,'required|max_length[50]');
	$this->form_validation->set_rules('territory_id', display('territory_name') ,'required|max_length[50]');
	$this->form_validation->set_rules('state_id', display('state_name') ,'required|max_length[50]');
		#-------------------------------# 
		//when create a user
		if (empty($this->input->post('user_id'))) {
			$data['doctor'] = (object)$postData = [
			    'id' =>$this->input->post('user_id',true),
			    'city' =>$this->input->post('city_name',true),
			    'state_id' =>$this->input->post('state_id',true),
			    'territory_id'    => $this->input->post('territory_id',true),
				'country_id'    => $this->input->post('country_id',true),
				'region_id'    => $this->input->post('region_id',true),
				'status' 	   => $this->input->post('status',true),
				'created_by'   => $this->session->userdata('user_id'),
				'date_modify'  => date('Y-m-d'),
			]; 
		} else { //update a user
			$data['doctor'] = (object)$postData = [
			    'id' =>$this->input->post('user_id',true),
			    'city' =>$this->input->post('city_name',true),
			    'state_id' =>$this->input->post('state_id',true),
			    'territory_id'    => $this->input->post('territory_id',true),
				'country_id'    => $this->input->post('country_id',true),
				'region_id'    => $this->input->post('region_id',true),
				'status' 	   => $this->input->post('status',true),
				'created_by'   => $this->session->userdata('user_id'),
				'date_modify'  => date('Y-m-d'),
			]; 
		}
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $user_id then insert data
			if (empty($this->input->post('user_id'))) {
				if ($this->location_model->create_city($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				

				redirect('admin/location/state');
			} else {
				if ($this->location_model->update_city($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
					redirect('admin/location/state');
			}

		} else {
		  $data['country']=$this->location_model->country();
		   $data['region_list']=$this->location_model->region_list();
			$data['content'] = $this->load->view('location/city_from',$data,true);
			$this->load->view('Admin/main_wrapper',$data);
		} 
	}
	
	
		public function edit($user_id = null) 
	{
		
		$data['doctor'] = $this->location_model->read_by_id($user_id);
	
		$data['content'] = $this->load->view('Admin/location/country_from',$data,true);
		$this->load->view('Admin/main_wrapper',$data);
	}
	
	
	public function delete($user_id = null) 
	{ 
		if ($this->location_model->delete($user_id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('admin/location/country');
	}


    
    function import() {
        
        $data['title'] = display('import');
        $data['content'] = $this->load->view('Admin/location/import',$data,true);
       	$this->load->view('Admin/main_wrapper',$data);
    }
    function upload_location() {
        if (!is_dir('assets/csv')) {
            mkdir('assets/csv', 0777, TRUE);
        }
      
        $filename = "school_" . date('d-m-Y_H_i_s'); //"school_26-07-2018_16_17_51";
        $config = array(
            'upload_path' => "assets/csv",
            'allowed_types' => "text/plain|text/csv|csv",
            'remove_spaces' => TRUE,
            'max_size' => "10000",
            'file_name' => $filename
        );

        $this->load->library('upload', $config);
        // $this->upload->do_upload('file')
        if ($this->upload->do_upload('file')) {
            $upload = $this->upload->data();
            $json['success'] = 1;

            // $upload['file_name'] = "school_26-07-2018_16_17_51.csv";
            $filePath = $config['upload_path'] . '/' . $upload['file_name'];
         $file = $filePath;
			$handle = fopen($file, "r");
			$c = 0;
			while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
			{
			 $this->db->where('country_name',$filesop[0]);
			 $id=$this->db->get('tbl_country');
			 $id1=$id->num_rows();
			 if($id1>0){
			  $country_id= $id->row()->id_c;	
			 }else{
			 
			  $this->db->set('country_name',$filesop[0]);
			  $this->db->set('created_by',$this->session->userdata('user_id'));
			  $this->db->set('created_date',date('Y-m-d'));
			  $this->db->insert('tbl_country');
			  $country_id = $this->db->insert_id();
			 }
			 
			 $this->db->where('country_id',$country_id);
			 $this->db->where('region_name',$filesop[1]);
			 $id2=$this->db->get('tbl_region');
			 $id3=$id2->num_rows();
			 if($id3>0){
			  $region_id= $id2->row()->region_id;	
			 }else{
			
			  $this->db->set('country_id',$country_id);
			  $this->db->set('region_name',$filesop[1]);
			  $this->db->set('created_by',$this->session->userdata('user_id'));
			  $this->db->set('created_date',date('Y-m-d'));
			  $this->db->insert('tbl_region');
			  $region_id = $this->db->insert_id();
			 }
			 
			 $this->db->where('country_id',$country_id);
			 $this->db->where('region_id',$region_id);
			 $this->db->where('territory_name',$filesop[2]);
			 $id4=$this->db->get('tbl_territory');
			 $id5=$id4->num_rows();
			 if($id5>0){
			  $territory_id= $id4->row()->territory_id;	
			 }else{
			 
			  $this->db->set('country_id',$country_id);
			  $this->db->set('region_id',$region_id);
			  $this->db->set('territory_name',$filesop[2]);
			  $this->db->set('created_by',$this->session->userdata('user_id'));
			  $this->db->set('created_date',date('Y-m-d'));
			  $this->db->insert('tbl_territory');
			  $territory_id = $this->db->insert_id();
			 }
			 
			 $this->db->where('country_id',$country_id);
			 $this->db->where('territory_id',$territory_id);
			 $this->db->where('region_id',$region_id);
			 $this->db->where('state',$filesop[3]);
			 $id5=$this->db->get('state');
			 $id6=$id5->num_rows();
			 if($id6>0){
			   $state_id= $id5->row()->id;	
			 }else{
			 
			  $this->db->set('country_id',$country_id);
			  $this->db->set('region_id',$region_id);
			  $this->db->set('territory_id',$territory_id);
			  $this->db->set('state',$filesop[3]);
			  $this->db->set('created_by',$this->session->userdata('user_id'));
			  $this->db->set('date_modify',date('Y-m-d'));
			  $this->db->insert('state');
			  $state_id = $this->db->insert_id();
			 }
			 
			 
			 
			 $this->db->where('country_id',$country_id);
			 $this->db->where('territory_id',$territory_id);
			 $this->db->where('region_id',$region_id);
			 $this->db->where('state_id',$state_id);
			  $this->db->where('city',$filesop[4]);
			 $id7=$this->db->get('city');
			 $id8=$id7->num_rows();
			 if($id8>0){
			  $id7->row()->id;	
			 }else{
			 
			  $this->db->set('country_id',$country_id);
			  $this->db->set('region_id',$region_id);
			  $this->db->set('territory_id',$territory_id);
			  $this->db->set('state_id',$state_id);
			  $this->db->set('city',$filesop[4]);
			  $this->db->set('created_by',$this->session->userdata('user_id'));
			  $this->db->set('date_modify',date('Y-m-d'));
			  $this->db->insert('city');
			  
			 }
		
				
			}
           

                $this->session->set_flashdata('message', "Data successfully added.");
                redirect(base_url() . 'admin/location/import');

                // echo '<pre>'; print_r ($discCodeArr); print_r ($stateArr); print_r ($cityArr); print_r ($blockArr); die;
            } 
         else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect(base_url() . 'admin/location/import');
        }
    }


}
