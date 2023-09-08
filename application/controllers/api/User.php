<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class User extends REST_Controller 
{
    function __construct() 
    {
    	parent::__construct();
    	$this->load->model('user_model');
    }

    public function getUser_post()
    {
    	$this->form_validation->set_rules('user_id','user_id', 'trim|required');
    	$this->form_validation->set_rules('company_id','company_id','trim|required',array('required'=>'You have note provided %s'));
    	// $this->form_validation->set_rules('process_id','process_id','trim|required',array('required'=>'You have note provided %s'));
    	
    	if($this->form_validation->run()==true)
    	{	
    		$this->load->model(array('location_model','Modules_model'));

    		$company_id   = $this->input->post('company_id');
    		//$process_id   = $this->input->post('process_id');
	        $user_id    =   $this->input->post('user_id');

	       	// $backup =  $this->session->userdata()??'';

	        // $this->session->companey_id = $company_id;
	        // $this->session->user_id = $user_id;

	       	// $data['user_data'] =  $this->user_model->read_by_id($user_id);

	       	// $data['state_list'] = $this->location_model->state_list();
         //    $data['city_list'] = $this->location_model->city_list();
         //    $data['region_list'] = $this->location_model->region_list();
         //    $data['territory_lsit'] = $this->location_model->territory_lsit();
            //$data['user_list'] = $this->user_model->user_list();
           // $data['department_list'] = $this->Modules_model->modules_list();
            //$data['user_role'] = $this->db->get('tbl_user_role')->result();
            //$data['county_list'] = $this->location_model->country();

        
        $data =   $this->db->select('pk_i_admin_id,s_display_name,last_name,s_user_email,s_phoneno,picture')
                        ->from('tbl_admin')
                        ->where('pk_i_admin_id',$user_id)
                        ->where('companey_id',$company_id)
                        ->get()->row();

            if(!empty($data))
            {
                $data->picture = base_url('/').$data->picture;
                $this->set_response([
                'status' => TRUE,
                'data' => array('user_data'=>$data),
            ], REST_Controller::HTTP_OK);
            }
            else{
                $this->set_response([
                'status' => FALSE,
                'message' => 'No user found'
            ], REST_Controller::HTTP_OK);
            }
    		
  		} 
  		else 
        {		     
  		     $this->set_response([
                  'status' => false,
                  'message' =>strip_tags(validation_errors())
               ], REST_Controller::HTTP_OK);
  		}
    }

    
    public function updateUser_post()
    {
        
        $this->form_validation->set_rules('user_id','user_id', 'trim|required');
    	$this->form_validation->set_rules('company_id','company_id','trim|required',array('required'=>'You have note provided %s'));

    	if($this->form_validation->run()==true)
    	{	
    		$user_id    =   $this->input->post('user_id');
			$company_id    =   $this->input->post('comp_id');

	       	$backup =  $this->session->userdata()??'';

	       	$this->session->companey_id = $company_id;
	        $this->session->user_id = $user_id;

    		if ($this->session->user_id == 9) 
    		{
	            $org = $this->input->post('org_name');
	            $designation = '';
	        } else {
	            $org = '';
	            $designation = $this->input->post('designation');
	        }

    		$postData = [
            'pk_i_admin_id' => $this->input->post('dprt_id', true),
            //'user_roles' => $this->input->post('user_role', true),
            //'user_type' => $this->input->post('user_type', true),
            'employee_id' => $this->input->post('employee_id', true),
            's_user_email' => $this->input->post('email', true),
            's_phoneno' => $this->input->post('cell', true),
            'second_email' => $this->input->post('second_email', true),
            'second_phone' => $this->input->post('second_phone', true),
            // 's_password' => $password,
            // 'modules' => $modules,
            's_display_name' => $this->input->post('Name', true),
            'state_id' => $this->input->post('state_id', true),
            'city_id' => $this->input->post('city_name', true),
            //'companey_id' => 1,
            // 'orgisation_name' => $org,
            //'user_permissions' => $permission,
            'last_name' => $this->input->post('last_name', true),
            'b_status' => $this->input->post('status', true),
            'date_of_birth' => $this->input->post('dob', true),
            'anniversary' => $this->input->post('anniversary', true),
            'contact_pname' => $this->input->post('cname', true),
            'contact_pemail' => $this->input->post('cemail', true),
            'contact_semail' => $this->input->post('csemail', true),
            'contact_phone' => $this->input->post('cphone', true),
            'contact_sphone' => $this->input->post('csphone', true),
            'designation' => $designation,
            'employee_band' => $this->input->post('employee_band', true),
            'country' => $this->input->post('country'),
            'region' => $this->input->post('region', true),
            'territory_name' => $this->input->post('territory', true),
            'add_ress' => $this->input->post('address', true),
        ];
			$this->session->set_userdata($backup);
	       
	        if($this->user_model->update($postData))
	        {
	        	$this->set_response([
                'status' => TRUE,
                'data' => 'Profile Updated Successfully.'
            	], REST_Controller::HTTP_OK);
	        }
	        else
	        {
				$this->set_response([
                'status' => TRUE,
                'data' => 'Unable to Update.'
            	], REST_Controller::HTTP_OK);
	        }
  		} 
  		else 
        {		     
  		     $this->set_response([
                  'status' => false,
                  'message' =>strip_tags(validation_errors())
               ], REST_Controller::HTTP_OK);
  		}
    }

    public function updateUserImage_post()
    {
		 $this->form_validation->set_rules('user_id','user_id', 'trim|required');
         //print_r($this->form_validation->run());die;
    	if($this->form_validation->run()==true)
    	{	
    		 	$path = 'assets/images/user/';

	            if(!file_exists($path))
	            {
	              mkdir($path);
	            }
	            
		        $config = array(
		        'upload_path' => $path,
		        'allowed_types' => "gif|jpg|png|jpeg",        
		        'max_size' => "2048000",
		        'encrypt_name' => true
		        );
		        $this->load->library('upload');
		        $this->upload->initialize($config);
		      
	     	if($this->upload->do_upload('profile_image'))
	      	{
	      		$imageDetailArray = $this->upload->data();
                //print_r($imageDetailArray);die;
        		$img =  $path.$imageDetailArray['file_name'];

        		$postData = array('pk_i_admin_id' => $this->input->post('dprt_id', true),
        							'picture'=>$img,
        					);
        		
        		$this->user_model->update($postData);

		      	$this->set_response([
	            'status' => TRUE,
	            'data' => 'Profile Image Updated Successfully.'
	        	], REST_Controller::HTTP_OK);
	      	}
		    else
			{
                $reason = $this->upload->display_errors();
					$this->set_response([
	                'status' => FALSE,
	                'data' => strip_tags($reason),
	            	], REST_Controller::HTTP_OK);
			}   		 
    	} 
  		else 
        {		     
  		     $this->set_response([
                  'status' => false,
                  'message' =>strip_tags(validation_errors())
               ], REST_Controller::HTTP_OK);
  		}
    }


	public function create_trial_account_post(){        
        $this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
        $this->form_validation->set_rules('lastname', display('last_name'), 'required|max_length[50]');
        if ($this->input->post('user_id', true) == null) {
            $this->form_validation->set_rules('email', display('email'), 'required|max_length[50]|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5');
        }
        $this->form_validation->set_rules('a_name', display('customer_account_name'), 'max_length[50]');
        $this->form_validation->set_rules('a_account_number', display('customer_account_number'), 'max_length[50]');
        $this->form_validation->set_rules('a_ifsc', display('customer_ifsc'), 'max_length[50]');
        $this->form_validation->set_rules('a_branch', display('customer_account_branch'), 'max_length[150]');
        $this->form_validation->set_rules('a_companyname', display('customer_company_name'), 'max_length[100]');
        $this->form_validation->set_rules('a_companyaddress', display('Company_address'), 'max_length[250]');
        $this->form_validation->set_rules('modules', display('customer_services'));
        $this->form_validation->set_rules('phone', display('phone'), 'max_length[20]');
        $this->form_validation->set_rules('mobile', display('mobile'), 'required|max_length[20]');
        $this->form_validation->set_rules('blood_group', display('blood_group'), 'max_length[10]');
        $this->form_validation->set_rules('sex', display('sex'), 'required|max_length[10]');
        $this->form_validation->set_rules('date_of_birth', display('date_of_birth'), 'max_length[10]');
        $this->form_validation->set_rules('address', display('address'), 'required|max_length[255]');
        $this->form_validation->set_rules('status', display('status'), 'required');
        $this->form_validation->set_rules('a_validupto', 'Valid Upto', 'required');
        $this->form_validation->set_rules('a_accounttype', 'Account Type', 'required');
        #-------------------------------#
        //picture upload
        $picture = $this->fileupload->do_upload(
            'assets/images/doctor/',
            'picture'
        );
        // if picture is uploaded then resize the picture
        if ($picture !== false && $picture != null) {
            $this->fileupload->do_resize(
                $picture,
                293,
                350
            );
        }
        //if picture is not uploaded
        if ($picture === false) {
            $this->session->set_flashdata('exception', display('invalid_picture'));
        }
        #-------------------------------# 
        if (!empty($this->input->post('modules'))) {
            $modules = implode(",", $this->input->post('modules'));
        } else {
            $modules = '';
        }
        //when create a user
        if ($this->input->post('user_id', true) == null) {
            $data['doctor'] = (object) $postData = [
                'user_id' => $this->input->post('user_id', true),
                'firstname' => $this->input->post('firstname', true),
                'lastname' => $this->input->post('lastname', true),
                'email' => $this->input->post('email', true),
                'password' => md5($this->input->post('password', true)),
                'user_role' => 2,
                'company_rights' => '10,11,12,13,30,31,32,33,60,61,62,63,70,71,72,73,80,81,82,83,90,91,92,93,120,121,122,123,130,131,132,133,140,141,142,143',
                'designation' => $this->input->post('designation', true),
                'department_id' => $this->input->post('department_id', true),
                'address' => $this->input->post('address', true),
                'phone' => $this->input->post('phone', true),
                'mobile' => $this->input->post('mobile', true),
                'short_biography' => $this->input->post('short_biography', true),
                'pictures' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
                'a_name' => $this->input->post('a_name', true),
                'a_account_number' => $this->input->post('a_account_number', true),
                'a_ifsc' => $this->input->post('a_ifsc', true),
                'a_branch' => $this->input->post('a_branch', true),
                'a_companyname' => $this->input->post('a_companyname', true),
                'a_companyaddress' => $this->input->post('a_companyaddress', true),
                'modules' => $modules,
                'date_of_birth' => date('Y-m-d', strtotime(($this->input->post('date_of_birth', true) != null) ? $this->input->post('date_of_birth', true) : date('Y-m-d'))),
                'sex' => $this->input->post('sex', true),
                'blood_group' => $this->input->post('blood_group', true),
                'degree' => $this->input->post('degree', true),
                'created_by' => $this->session->userdata('user_id'),
                'create_date' => date('Y-m-d'),
                'account_type' => ($this->input->post("a_accounttype")) ? $this->input->post("a_accounttype") : "",
                'valid_upto' => ($this->input->post("a_validupto")) ? date('Y-m-d', strtotime($this->input->post("a_validupto"))) : "",
                'status' => $this->input->post('status', true),
            ];
        } else { //update a user
            
        }
        if ($this->form_validation->run() === true) {
            if (empty($postData['user_id'])) {
                $companey_id    =   $this->doctor_model->create($postData);
                $companey_insert_id = $this->db->insert_id();
                $tbl_user_role = array(
                    'comp_id' => $companey_insert_id,
                    'user_role' => 'Admin',
                    'user_permissions' => '10,11,12,13,30,31,32,33,60,61,62,63,70,71,72,73,80,81,82,83,90,91,92,93,120,121,122,123,130,131,132,133,140,141,142,143',
                    'status' => '1'
                );
                $user_right    =   $this->db->insert('tbl_user_role', $tbl_user_role);
                $right_insert_id = $this->db->insert_id();

                if ($companey_id) {
                    $post_data = $postData;
                    $post_data['companey_id'] = $companey_insert_id;
                    $post_data['user_permissions'] = $right_insert_id;
                    $this->create_user($post_data);
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                if ($postData['user_id'] == $this->session->userdata('user_id')) {
                    $this->session->set_userdata([
                        'pictures' => $postData['picture'],
                        'fullname' => $postData['firstname'] . ' ' . $postData['lastname']
                    ]);
                }
                redirect('customer/create');
            } else {
                $permissions = $this->input->post('permissions');
                $permissions_str = implode(',', $permissions);
                $postData['company_rights'] = $permissions_str;
                
                if ($this->doctor_model->update($postData)) {
                    $id = $this->input->post('role_id');
                    $user_role = $this->input->post('user_type');

                    if (in_array(230, $permissions) || in_array(231, $permissions) || in_array(232, $permissions) || in_array(233, $permissions) || in_array(234, $permissions) || in_array(235, $permissions) || in_array(236, $permissions)) {
                        $this->db->where('comp_id', $this->input->post('user_id', true));
                        $c_product    =    $this->db->get('tbl_product')->num_rows();
                        if ($c_product == 0) {
                            $product_name = 'Demo Process';
                            $main_fun_name = '';
                            $process_data = array(
                                'product_name' => $product_name,
                                'comp_id' => $this->input->post('user_id', true),
                                'main_fun' => $main_fun_name,
                                'status' => 1,
                                'added_by'  => 1,
                                'added_on'  => date('d-m-Y')
                            );
                            $this->load->model('dash_model');
                            $this->dash_model->add_product($process_data);
                            $process_id    =    $this->db->insert_id();
                            $this->db->where('user_permissions', $id);
                            $this->db->update('tbl_admin', array('process' => $process_id));
                        }
                    }

                    $data = array(
                        'user_role' => $user_role,
                        'user_permissions' => $permissions_str
                    );
                    $this->User_model->update_user_role($id, $data);

                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                if ($postData['user_id'] == $this->session->userdata('user_id')) {
                    $this->session->set_userdata([
                        'pictures' => $postData['picture'],
                        'fullname' => $postData['firstname'] . ' ' . $postData['lastname']
                    ]);
                }
                redirect('customer/edit/' . $postData['user_id']);
            }
        } else {
            $data['department_list'] = $this->Modules_model->modules_list();
            $data['content'] = $this->load->view('company_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }    
	}
}