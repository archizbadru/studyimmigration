<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(array(
            'department_model',
            'User_model',
            'location_model',
            'Modules_model',
            'doctor_model',
            'enquiry_model'
        ));
     if(empty($this->session->userdata('isLogIn')))
        redirect('login');
    }

    public function index() {
        if (!empty($_GET['user_role'])) {
            $data['title'] = $this->User_model->get_role_name_by_id($_GET['user_role']).' List';            
        }else{
            $data['title'] = display('user_list');
        }
        $data['departments'] = $this->User_model->read2();
        // echo $this->db->last_query();
        $data['user_role'] = $this->db->get('tbl_user_role')->result();
        $data['content'] = $this->load->view('user', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    function userimport() 
    {
        $data['title'] = display('import');
        $data['content'] = $this->load->view('user_import', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    function upload_user() {
        if (!is_dir('assets/csv')) {
            mkdir('assets/csv', 0777, TRUE);
        }
        $filename = "user" . date('d-m-Y_H_i_s'); //"school_26-07-2018_16_17_51";
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
            $exist = array();
            $ic = 0;
            while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                if ($c > 0) {

                    $firstname  = $filesop[0];
                    $lastname   = $filesop[1];
                    $email      = $filesop[2];
                    $phone      = $filesop[3];
                    $userright  = getUserRight($filesop[4]);
                    $report_to  = getUserByName($filesop[5]);
                    $process    = getProcessBynme($filesop[6]);
                    if(checkAlreadyExist($email,'email') == "no" && checkAlreadyExist($phone,'phone') == "no")
                    {
                        if($userright !='' && $report_to !='' && $process !='')
                        {   
                            $postData = array(
                                's_display_name'        => $firstname,
                                'last_name'             => $lastname,
                                's_user_email'          => $email,
                                's_phoneno'             => $phone,
                                'report_to'             => $report_to,
                                'user_permissions'      => $userright,
                                'process'               => $process,
                                's_password'            => md5('12345678'),
                                'companey_id'           => $this->session->companey_id
                            );
                            $this->db->insert('tbl_admin',$postData);
                            $ic++;
                        }
                    }
                    else
                    {
                        $exist[]= $email;
                    }
                }
                $c++;
            }
            if(!empty($exist))
            {
                $this->session->set_flashdata('message', count($exist)." user skipped and ".$ic." user added successfully");
            }
            else
            {
                $this->session->set_flashdata('message',"".$ic." user added successfully");
            }
            unlink(base_url('assets/csv').$filename);
            
            redirect(base_url() . 'user');
            // echo '<pre>'; print_r ($discCodeArr); print_r ($stateArr); print_r ($cityArr); print_r ($blockArr); die;
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            
            redirect(base_url() . 'user');
        }
    }

    public function company() {
        $data['title'] = display('Company');
        $data['company'] = $this->User_model->display_company_details();
        $data['user_role'] = $this->db->get('tbl_user_role')->result();
        $data['content'] = $this->load->view('company_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function add_company() {
        $data['title'] = display('Company');
        $data['company'] = $this->User_model->display_company_details();
        $data['user_role'] = $this->db->get('tbl_user_role')->result();
        $data['content'] = $this->load->view('company_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function channel_partner() {
        $data['title'] = display('user_list');
        $data['page_title'] = 'Channel Partner';
        $data['departments'] = $this->User_model->partner();
        $data['type_list'] = $this->User_model->types_list();
        $data['user_role'] = $this->db->get('tbl_user_role')->result();
        $data['content'] = $this->load->view('partner_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function user_type() {
        $data['title'] = display('user_list');
        $data['page_title'] = display('user_function');
        $data['nav1'] = 'nav3';       

        $this->db->where('use_id!=',1);
        $this->db->where('comp_id',$this->session->companey_id);
        $data['lead_score'] = $this->db->get('tbl_user_role')->result();


        $data['content'] = $this->load->view('user_role', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function user_type_add() {
        if (!empty($_POST)) {
            $this->load->library('form_validation');
            $user_type = $this->input->post('user_type');
            $permission = $this->input->post('permissions');
            $permissions = implode(',', $permission);
            $this->form_validation->set_rules('user_type', 'user_role', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('FAILMSG', 'User role already exists in the table');
                redirect('user/permissions');
            } else {
                $data = array(
                    'user_role' => $user_type,
                    'comp_id' => $this->session->companey_id,
                    'created_date' => date('Y-m-d h:s:i'),
                    'created_by' => $this->session->user_id,
                    'user_permissions' => $permissions
                );
                $this->db->insert('tbl_user_role', $data);
                $this->session->set_flashdata('SUCCESSMSG', 'User Role Created Successfully');
                redirect('user/permissions');
            }
        } else {
            $data['page_title'] = display('user_function');
            $data['content'] = $this->load->view('user_role', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }

    public function prepare_hierarchy_nodes($data){
        $nodes = array();
        
        //$nodes[] = array('id'=>1,'pid'=>0,'name'=>'abc','txt'=>'','isCollapsed'=>false,'img'=>'');

        $this->db->where_in('pk_i_admin_id',$data);
        
        $user_results    =   $this->db->get('tbl_admin')->result_array();

        if (!empty($user_results)) {
            
            foreach ($user_results as $key => $value) {
                if($this->session->user_id == $value['pk_i_admin_id']){
                    $nodes[] = array(
                        'id'            =>$value['pk_i_admin_id'],
                        'pid'           =>0,
                        'name'          =>"<a href=".base_url()."user/edit/".$value['pk_i_admin_id'].">".$value['s_display_name']."</a>",                    
                        'txt'           =>$value['designation'],
                        'isCollapsed'   =>false,
                        'img'           =>$value['picture']?base_url().$value['picture']:''
                    );
                }else{
                    $nodes[] = array(
                        'id'            =>$value['pk_i_admin_id'],
                        'pid'           =>$value['report_to'],
                        'name'          =>"<a href=".base_url()."user/edit/".$value['pk_i_admin_id'].">".$value['s_display_name']."</a>",                    
                        'txt'           =>$value['designation'],
                        'isCollapsed'   =>false,
                        'img'           =>$value['picture']?base_url().$value['picture']:''
                    );                    
                }
            }
        }        
        return $nodes;        
    }

    public function user_tree(){

        $data['title'] = 'User Hierarchy';

        $this->load->model('common_model');

        $data = $this->common_model->get_categories($this->session->user_id);

        $nodes    =   $this->prepare_hierarchy_nodes($data);

        $data['nodes_data'] = $nodes;
        // echo "<pre>";
        // print_r($data['nodes_data']);
        // return;
        $data['content'] = $this->load->view('user_hierarchy', $data, true);
        $this->load->view('layout/main_wrapper', $data); 

    }

    public function create() {
        // if (user_role('131') == true || user_role('130') == true) {
           
        // } 
    
        $data['page_title'] = display('add_user');
        $this->form_validation->set_rules('Name', display('disolay_name'), 'required');
        $this->form_validation->set_rules('designation', 'designation', 'required');
        $this->form_validation->set_rules('user_type', display('user_type'), 'required');
        //$this->form_validation->set_rules('user_role', display('user_role'), 'required');
        //$this->form_validation->set_rules('modules', display('customer_services'));

        $this->form_validation->set_rules('status', display('status'), 'required');
        //$this->form_validation->set_rules('cname', 'Contact person Name ', 'differs[Name]');
        

        if (empty($this->input->post('dprt_id'))) {
            $this->form_validation->set_rules('employee_id', display('employee_id'), 'required|is_unique[tbl_admin.employee_id]', array('is_unique' => 'Duplicate Entery For Employee Id '));
            $this->form_validation->set_rules('password', display('password'), 'required|min_length[8]');
            $this->form_validation->set_rules('email', display('email'), 'required|is_unique[tbl_admin.s_user_email]', array('is_unique' => 'Duplicate Entery For email'));
            $this->form_validation->set_rules('cell', display('cell'),'required|is_unique[tbl_admin.s_phoneno]');        
        }


        #-------------------------------#
     
        if (empty($this->input->post('dprt_id'))) {
            $password = md5($this->input->post('password', true));
        } else {
            $password = $this->input->post('old_pass', true);
        }
        $img = $this->fileupload->do_upload(
                'assets/images/user/', 'file'
        );
        if ($img !== false && $img != null) {
            $this->fileupload->do_resize(
                    $img, 293, 350
            );
        }

        if ($this->input->post('user_type')) {
            $permission = $this->input->post('user_type');
        } else {
            $permission = '';
        }

$inactive = $this->input->post('status', true);
            if($inactive=="0"){
            $inactive_date = date("Y-m-d h:i:s");   
            }else{
            $inactive_date = '';
            }
        
        $data['department'] = (object) $postData = [
            'pk_i_admin_id' => $this->input->post('dprt_id', true),
            'user_roles' => $this->input->post('user_role', true),
            'user_type' => $this->input->post('user_type', true),
            'employee_id' => $this->input->post('employee_id', true),
            's_user_email' => $this->input->post('email', true),
            's_phoneno' => $this->input->post('cell', true),
            'second_email' => $this->input->post('second_email', true),
            'second_phone' => $this->input->post('second_phone', true),
            's_password' => $password,
           'inactive_date' => $inactive_date,
            's_display_name' => $this->input->post('Name', true),
            'state_id' => $this->input->post('state_id', true),
            'city_id' => $this->input->post('city_name', true),
            'companey_id' =>$this->session->userdata('companey_id'),
            'user_permissions' => $permission,
            'last_name' => $this->input->post('last_name', true),
            'b_status' => $this->input->post('status', true),
            'date_of_birth' => $this->input->post('dob', true),
            'joining_date' => $this->input->post('joining_date', true),
            'anniversary' => $this->input->post('anniversary', true),
            'designation' => $this->input->post('designation', true),
            'employee_band' => $this->input->post('employee_band', true),
            'country' => $this->input->post('country'),
            'region' => $this->input->post('region', true),
            'territory_name' => $this->input->post('territory', true),
            'add_ress' => $this->input->post('address', true),
            'contact_pname' => $this->input->post('cname', true),
            'contact_pemail' => $this->input->post('cemail', true),
            'contact_semail' => $this->input->post('csemail', true),
            'contact_phone' => $this->input->post('cphone', true),
            'contact_sphone' => $this->input->post('csphone', true),

            'user_protocol' => $this->input->post('user_protocol', true),
            'user_host' => $this->input->post('user_host', true),
            'user_port' => $this->input->post('user_port', true),
            'user_email' => $this->input->post('user_email', true),
            'user_password' => $this->input->post('user_password', true),
            'whatsapp_api' => $this->input->post('whatsapp_api', true),

            'dept_name' => $this->input->post('dept_name', true),
            'sales_branch' => $this->input->post('sales_branch', true),

            'picture' => (!empty($img) ? $img : $this->input->post('new_file')),
            'report_to' => $this->input->post('report_to', true),
            'telephony_agent_no' => $this->input->post('telephony_agent_no', true),
            'telephony_type' => $this->input->post('telephony_type', true),
            'telephony_agent_id' => $this->input->post('telephony_agent_id', true),
            'telephony_login_id' => $this->input->post('telephony_login_id', true),
            'telephony_agent_pass' => $this->input->post('telephony_agent_pass', true),
            'process' => !empty($this->input->post('process', true))?implode(',', $this->input->post('process', true)):'',
            'products' => !empty($this->input->post('product', true))?implode(',', $this->input->post('product', true)):'',
        ];
        #-------------------------------#
        if ($this->form_validation->run() === true) {
            #if empty $dprt_id then insert data
            if (empty($this->input->post('dprt_id'))) {
                if ($this->User_model->create($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('user');
            } else {
                if ($this->User_model->update($postData)) {
                    //print_r($this->db->last_query());exit;
                    if (!empty($this->session->password_error)) {
                        $this->session->set_flashdata('exception', 'pasword not updated');
                    } else {
                        $this->session->set_flashdata('message', display('update_successfully'));
                    }
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('user');
            }
        } else {
            $data['state_list'] = $this->location_model->state_list();
            $data['region_list'] = $this->location_model->region_list();
            $data['county_list'] = $this->User_model->display_country();    
            $this->db->where('use_id!=',1);
            $this->db->where('comp_id',$this->session->companey_id);
            $data['user_role'] = $this->db->get('tbl_user_role')->result();
            $data['user_list'] = $this->User_model->read2();
            $data['companey_list']= $this->User_model->companyList();
            $this->load->model('dash_model');
            $data['products'] = $this->dash_model->all_process_list();
            $data['products_list'] = $this->dash_model->all_product_list();
            $data['enq_id'] = 'LT/IN/EI/' . str_pad($this->User_model->get_empid(), 2, '0', STR_PAD_LEFT);
            $this->load->model('Leads_Model');
            $data['all_branch'] = $this->Leads_Model->branch_select();
            $data['all_department'] = $this->Leads_Model->dept_select();
            $data['content'] = $this->load->view('user_from', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }

    public function add_partner() {
        if (user_role('130') == true) {
            
        }
        $data['title'] = display('add_user');
        $data['page_title'] = 'Channel Partner';
        #-------------------------------#
        //  $this->form_validation->set_rules('company_info', display('company_info') ,'required');
        $this->form_validation->set_rules('Name', display('disolay_name'), 'required');
        $this->form_validation->set_rules('cell', display('cell'), 'required|max_length[10]');
        $this->form_validation->set_rules('state_id', display('state_name'), 'required');
        $this->form_validation->set_rules('city_name', display('city_name'), 'required');
        $this->form_validation->set_rules('user_role', display('user_role'), 'required');
        $this->form_validation->set_rules('user_type', display('user_type'), 'required');
        $this->form_validation->set_rules('modules', display('customer_services'));
        $this->form_validation->set_rules('status', display('status'), 'required');
        if (empty($this->input->post('dprt_id'))) {
            $this->form_validation->set_rules('employee_id', display('employee_id'), 'required|is_unique[tbl_admin.employee_id]', array('is_unique' => 'Duplicate Entery For Employee Id '));
            $this->form_validation->set_rules('email', display('email'), 'required|is_unique[tbl_admin.s_user_email]', array('is_unique' => 'Duplicate Entery For email'));
            $this->form_validation->set_rules('password', display('password'), 'required|min_length[8]');
        }

        #-------------------------------#
        if (!empty($this->input->post('modules'))) {
            $modules = implode(",", $this->input->post('modules'));
        } else {
            $modules = '';
        }
        if (empty($this->input->post('dprt_id'))) {
            $password = md5($this->input->post('password', true));
        } else {
            // $this->session->set_flashdata('exception','password not updated');
            $password = $this->input->post('old_pass', true);
        }

        //Upload employee image..
        //picture upload
        $img = $this->fileupload->do_upload(
                'assets/images/user/', 'file'
        );
        // if picture is uploaded then resize the picture
        if ($img !== false && $img != null) {
            $this->fileupload->do_resize(
                    $img, 293, 350
            );
        }

        if ($this->input->post('user_type')) {
            $permission = $this->input->post('user_type');
        } else {

            $permission = '';
        }

        $data['department'] = (object) $postData = [
            'pk_i_admin_id' => $this->input->post('dprt_id', true),
            'user_roles' => $this->input->post('user_role', true),
            'user_type' => $this->input->post('user_type', true),
            'employee_id' => $this->input->post('employee_id', true),
            's_user_email' => $this->input->post('email', true),
            's_phoneno' => $this->input->post('cell', true),
            'second_email' => $this->input->post('second_email', true),
            'second_phone' => $this->input->post('second_phone', true),
            's_password' => $password,
            'modules' => $modules,
            's_display_name' => $this->input->post('Name', true),
            'state_id' => $this->input->post('state_id', true),
            'city_id' => $this->input->post('city_name', true),
            'companey_id' => 1,
            'partner_type' => $this->input->post('channel_ptnr_types', true),
            'p_type' => $this->input->post('channel_ptnr_typ', true),
            'contact_pname' => $this->input->post('cname', true),
            'contact_pemail' => $this->input->post('cemail', true),
            'contact_semail' => $this->input->post('csemail', true),
            'contact_phone' => $this->input->post('cphone', true),
            'contact_sphone' => $this->input->post('csphone', true),
            'user_permissions' => $permission,
            'last_name' => $this->input->post('last_name', true),
            'b_status' => $this->input->post('status', true),
            'date_of_birth' => $this->input->post('dob', true),
            'anniversary' => $this->input->post('anniversary', true),
            'orgisation_name' => $this->input->post('org_name', true),
            'employee_band' => $this->input->post('employee_band', true),
            'country' => $this->input->post('country'),
            'region' => $this->input->post('region', true),
            'territory_name' => $this->input->post('territory', true),
            'add_ress' => $this->input->post('address', true),
            'picture' => (!empty($img) ? $img : $this->input->post('new_file')),
            'report_to' => $this->input->post('report_to', true)
        ];
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            #if empty $dprt_id then insert data
            if (empty($this->input->post('dprt_id'))) {
                if ($this->User_model->create($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('user/channel_partner');
            } else {
                if ($this->User_model->update($postData)) {
                    #set success message
                    if (!empty($this->session->password_error)) {
                        $this->session->set_flashdata('exception', 'pasword not updated');
                    } else {
                        $this->session->set_flashdata('message', display('update_successfully'));
                    }
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('user/channel_partner');
            }
        } else {
            $data['state_list'] = $this->location_model->state_list();
            $data['region_list'] = $this->location_model->region_list();
            $data['county_list'] = $this->User_model->display_country();
            //  $data['companey_list']= $this->doctor_model->reads();
            $data['department_list'] = $this->Modules_model->modules_list();
            $data['user_role'] = $this->db->get('tbl_user_role')->result();
            $data['user_list'] = $this->User_model->user_list();
            $data['channel_p_type'] = $this->enquiry_model->channel_partner_type_list();
            $data['type_list'] = $this->User_model->types_list();
            $data['content'] = $this->load->view('partnerfrom', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }

    public function password_check($str) {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {

            return TRUE;
        }
        $this->form_validation->set_message('password_check', 'Password is invalid formate ');
        return FALSE;
    }

    public function partner_edit($id = null) {
        $data['title'] = display('edit_user');
        $data['page_title'] = 'Channel Partner';
        #-------------------------------#
        $data['state_list'] = $this->location_model->state_list();
        $data['city_list'] = $this->location_model->city_list();
        $data['region_list'] = $this->location_model->region_list();
        $data['territory_lsit'] = $this->location_model->territory_lsit();
//      $data['companey_list']= $this->doctor_model->reads();
        $data['user_list'] = $this->User_model->user_list();
        $data['department_list'] = $this->Modules_model->modules_list();
        $data['user_role'] = $this->db->get('tbl_user_role')->result();
        $data['department'] = $this->User_model->read_by_id($id);
        $data['county_list'] = $this->location_model->country();
        $data['channel_p_type'] = $this->enquiry_model->channel_partner_type_list();
        $data['type_list'] = $this->User_model->types_list();
        $data['content'] = $this->load->view('partnerfrom', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function edit($id = null) {
        $data['title'] = display('edit_user');
        #-------------------------------#
        $data['state_list'] = $this->location_model->state_list();
        $data['city_list'] = $this->location_model->city_list();
        $data['region_list'] = $this->location_model->region_list();
        $data['territory_lsit'] = $this->location_model->territory_lsit();
        $data['companey_list']= $this->User_model->companyList();
       // $data['user_list'] = $this->User_model->user_list();
        $data['user_list'] = $this->User_model->read2();
        $data['department_list'] = $this->Modules_model->modules_list();
        $data['user_role'] = $this->User_model->get_user_role_cid();
        $data['department'] = $this->User_model->read_by_id($id);
        $data['county_list'] = $this->location_model->country();
        
        //echo "<pre>";
        //print_r($data['county_list']);exit();
        
        $this->load->model('dash_model');
        $data['products_list'] = $this->dash_model->all_product_list();
        $data['products'] = $this->dash_model->all_process_list();
        $this->load->model('Leads_Model');
        $data['all_branch'] = $this->Leads_Model->branch_select();
        $data['all_department'] = $this->Leads_Model->dept_select();
        
        $data['content'] = $this->load->view('user_from', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function delete($dprt_id = null) {
        if ($this->User_model->delete($dprt_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('user');
    }

    public function delete_userrole($user_role = null) 
    {
        if (user_role('141') == true)
        {}
        if ($this->User_model->delete_userrole($user_role)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('user/user_type');
        
        
    }

    public function update_role() {

        if (!empty($_POST)) {
            $user_type = $this->input->post('user_type');
            $role_id = $this->input->post('role_id');

            $this->db->set('user_role', $user_type);
            $this->db->where('use_id', $role_id);
            $this->db->update('tbl_user_role');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('user/user_type');
        }
    }

    public function update_status() {

        if (!empty($_POST)) {
            $status = $this->input->post('someSwitchOption001');
            $role_id = $this->input->post('role_id');

            $this->db->set('status', $status);
            $this->db->where('use_id', $role_id);
            $this->db->update('tbl_user_role');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('user/user_type');
        }
    }

    //Define user Permissions..
    public function permissions() {
        $data['title'] = display('user_list');

        $this->db->select('id,title,sub_module');        
        $data['modules']    =   $this->db->get('all_modules')->result_array();

        $data['content'] = $this->load->view('user_permissions', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    //Open Edit user role form
    public function edit_user_role($role_id) {
        // echo "f";
        // return;
        if (user_role('142') == true)
        {}
        $data['title'] = display('user_list');
        $data['user_role'] = $this->User_model->get_user_role($role_id);
        
        $this->db->select('id,title,sub_module');        
        // $this->db->select('id,title');        
        $data['modules']    =   $this->db->get('all_modules')->result_array();
        // echo "<pre>";
        // print_r($data['modules']);
        // return;
        $data['content'] = $this->load->view('edit_user_role', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    //Save updated user role data
    public function update_user_role() {
        $id = $this->input->post('role_id');
        $user_role = $this->input->post('user_type');
        $permissions = $this->input->post('permissions');
        $permissions = implode(',', $permissions);
        $data = array(
            'user_role' => $user_role,
            'user_permissions' => $permissions
        );
        $this->User_model->update_user_role($id, $data);
        $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
        redirect('user/edit_user_role/' . $id);
    }



    public function upload_users(){
        ini_set('max_execution_time', '-1');
        $filename = "enquiry_" . date('d-m-Y_H_i_s');
        $config = array(
            'upload_path' =>$_SERVER["DOCUMENT_ROOT"]."/assets/enquiry", 
            'allowed_types' => "application/vnd.ms-excel|csv|xlsx",
            /*'remove_spaces' => TRUE,*/
            'file_name' => $filename
        );       
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('user')) {

            $upload = $this->upload->data();
            $json['success'] = 1;
            $filePath = $config['upload_path'] . '/' . $upload['file_name'];
            $file = $filePath;
            $handle = fopen($file, "r");
            $c = 0;
            $count = 0;
            $record = 0;
            $failed_record = 0;
            $i=0;
            $u=0;
            $dat_array=array();            
            while (($filesop = fgetcsv($handle, 2000, ",")) !== false) {
                if ($c) {                                        
                   // $right = 166;                                        
                   /* $post_data    =   array(       
                            'user_permissions'      => $right, 
                            'user_type'             => $right, 
                            's_password'            => md5('12345678'),
                            's_display_name'        => $filesop[2],
                            'last_name'             => '',
                            'designation'           => '',                                                
                            'companey_id'           => 57,
                            's_user_email'          => $filesop[7], 
                            's_phoneno'             => $filesop[6],
                            'process'               => "122",
                            'report_to'             => $filesop[3]   
                          );                
*/
            $post_data = array('s_phoneno'=>$filesop['2']);
            //$this->db->where('s_user_email',$post_data['s_user_email']);
            $this->db->where('s_phoneno',$post_data['s_phoneno']); 
            $r    =   $this->db->get('tbl_admin')->row_array();
            
            /*echo "<pre>";
            print_r($r['s_user_email']);
            echo "</pre>";*/
            
                if (empty($r) && $post_data['s_phoneno']) {                    
                    //$this->db->insert('tbl_admin',$post_data);
                    $this->db->set('status',2);
                    $this->db->where('phone',$post_data['s_phoneno']);
                    $this->db->where('status',3);
                    $this->db->where('comp_id',57);
                    $this->db->update('enquiry');
                    $i++;
                }else{
                    /*$this->db->where('s_user_email',$post_data['s_user_email']);
                    $this->db->set('user_permissions',$post_data['user_permissions']);
                    $this->db->set('user_type',$post_data['user_type']);
                    $this->db->update('tbl_admin');*/
                    //$u++;
                }
            }  
            if ($filesop[7]) {                
                $c++;
            }
            } 
        }
echo $this->upload->display_errors();
        echo $i.'<br>';
        echo $c.'<br>';
        echo $u;
        unlink($filePath);        

        echo "<pre>";
        print_r($post_data);
        echo "</pre>";
        exit();        
        
        /*$post_data    =   array(       
            'user_permissions'      => $post_data['user_permissions'],                                                  
            's_password'            => $post_data['password'],
            's_display_name'        => $post_data['firstname'],
            'last_name'             => $post_data['lastname'],
            'date_of_birth'         => $post_data['date_of_birth'],
            'joining_date'          => $post_data['create_date'],            
            'designation'           => $post_data['designation'],
            'employee_band'         => $post_data['blood_group'],
            'orgisation_name'       => $post_data['a_companyname'],            
            'companey_id'           => $post_data['companey_id'],
            's_user_email'          => $post_data['email'],           
            's_phoneno'             => $post_data['mobile'],
            'process'               => NULL
          );*/

        //$this->db->insert('tbl_admin',$post_data);
    
    }

    public function bulk_upload_user(){
        $data['title']  = 'test';
        $data['content'] = $this->load->view('upload_bulk_user', $data, true);
        $this->load->view('layout/main_wrapper', $data);

    }
}