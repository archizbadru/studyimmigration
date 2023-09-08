<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class location extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'location_model','User_model',
        ));
    }
    function country() {
        if (user_role('13') == true) {
        }
        $data['title'] = display('country_list');
        $data['country'] = $this->location_model->country();
        $data['content'] = $this->load->view('location/country_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    function region() {
        if (user_role('13') == true) {
        }
        $data['title'] = display('region_list');
        $data['country'] = $this->location_model->region_list();
        $data['content'] = $this->load->view('location/region_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    function territory() {
        if (user_role('13') == true) {
        }
        $data['title'] = display('country_list');
        $data['country'] = $this->location_model->territory_lsit();
        $data['content'] = $this->load->view('location/territory_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    function get_region_byid() {
        $country_id = $this->input->post('country_id');
        $data['country'] = $this->location_model->get_region_byid($country_id);
        echo '<option value="" selected>Select</option>';
        foreach ($data['country'] as $r) {
            echo '<option value="' . $r->region_id . '">' . $r->region_name . '</option>';
        }
    }

     public function find_state_country() {
        $country = $this->input->post('country');
        $data = $this->location_model->get_state($country);
        echo json_encode($data);
    }

  public function select_city_by_state() {
        $state_id = $this->input->post('state_id');
        echo json_encode($this->location_model->all_city_state($state_id));
    }
    
    function get_tretory_byid() {
        $country_id = $this->input->post('country_id');
        $region_id = $this->input->post('region_id');
        $data['country'] = $this->location_model->get_tretory_byid($country_id, $region_id);
        echo '<option value="" selecte>Select</option>';
        foreach ($data['country'] as $r) {
            echo '<option value="' . $r->territory_id . '">' . $r->territory_name . '</option>';
        }
    }
     public function select_city_bystate(){

        $stateid = $this->input->post('state_id');
        echo json_encode($this->location_model->all_city_bystate($stateid));


    }
    function get_state_byid() {
        $country_id = $this->input->post('country_id');
        $region_id = $this->input->post('region_id');
        //$territory_id=$this->input->post('territory_id');
        $data['country'] = $this->location_model->get_state_byid($country_id, $region_id);
        echo '<option value="" selecte>Select</option>';
        foreach ($data['country'] as $r) {
            echo '<option value="' . $r->id . '">' . $r->state . '</option>';
        }
    }
    function get_city_byid() {
        $state_id = $this->input->post('state_id');
        $data['country'] = $this->location_model->get_city_byid($state_id);
        echo '<option value="" style="display:none">---Select City---</option>';
        foreach ($data['country'] as $r) {
            echo '<option value="' . $r->id . '">' . $r->city . '</option>';
        }
    }

    function get_city_byidqr() {
        $state_id = $this->input->post('state_id');
        $data['country'] = $this->location_model->get_city_byidqr($state_id);
        echo '<option value="" style="display:none">---Select City---</option>';
        foreach ($data['country'] as $r) {
            echo '<option value="' . $r->id . '">' . $r->city . '</option>';
        }
    }

    function state() {
        if (user_role('13') == true) {
        }
        $data['title'] = display('country_list');
        $data['country'] = $this->location_model->state_list();
        $data['content'] = $this->load->view('location/state_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    function city() {
        if (user_role('13') == true) {
        }
        $data['title'] = display('country_list');
        $data['country'] = $this->location_model->city_list();
        $data['content'] = $this->load->view('location/city_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    public function create() {
        $data['title'] = display('add_country');
        if (empty($this->input->post('user_id'))) {
            $this->form_validation->set_rules('country_name', display('country_name'), 'required|max_length[50]');
        } else {
            $this->form_validation->set_rules('country_name', display('country_name'), 'required|max_length[50]');
        }
        $data['doctor'] = (object) $postData = [
            'id_c' => $this->input->post('user_id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'country_name' => $this->input->post('country_name', true),
            'c_status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
        ];
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('user_id'))) {
                if (user_role('10') == true) {
                }
                if ($this->location_model->create($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('location/country');
            } else {
                if (user_role('11') == true) {
                }
                if ($this->location_model->update($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('location/country');
            }
        } else {
            $data['content'] = $this->load->view('location/country_from', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    public function dublicate_region($id) {
        $region = $this->location_model->get_region_byname($this->input->post('region_name'), $this->input->post('country_id'));
        if (!empty($region)) {
            $this->form_validation->set_message('dublicate_region', 'Allready Exist');
            return false;
        } else {
            return true;
        }
    }
    
    public function add_region() {
        $data['title'] = display('add_region');
        $data['doctor'] = '';
        #-------------------------------#
        if (empty($this->input->post('user_id'))) {
            $this->form_validation->set_rules('region_name', display('region_name'), 'required|max_length[50]|callback_dublicate_region');
            #-------------------------------#
        } else {
            $this->form_validation->set_rules('region_name', display('region_name'), 'required|max_length[50]');
        }
        #-------------------------------# 
        //when create a user
        if (empty($this->input->post('user_id'))) {
            $data['doctor'] = (object) $postData = [
                'comp_id' => $this->session->userdata('companey_id'),
                'region_id' => $this->input->post('user_id', true),
                'country_id' => $this->input->post('country_id', true),
                'region_name' => $this->input->post('region_name', true),
                'status' => $this->input->post('status', true),
                'created_by' => $this->session->userdata('user_id'),
                'created_date' => date('Y-m-d'),
            ];
        } else { //update a user
            $data['doctor'] = (object) $postData = [
                'comp_id' => $this->session->userdata('companey_id'),
                'region_id' => $this->input->post('user_id', true),
                'country_id' => $this->input->post('country_id', true),
                'region_name' => $this->input->post('region_name', true),
                'status' => $this->input->post('status', true),
                'created_by' => $this->session->userdata('user_id'),
                'created_date' => date('Y-m-d'),
            ];
        }
        #-------------------------------#
        if ($this->form_validation->run() === true) {
            #if empty $user_id then insert data
            if (empty($this->input->post('user_id'))) {
                if (user_role('10') == true) {
                }
                if ($this->location_model->create_region($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('location/add_region');
            } else {
                if (user_role('11') == true) {
                }
                if ($this->location_model->update_region($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('location/add_region');
            }
        } else {
            $data['country'] = $this->location_model->country();
            $data['content'] = $this->load->view('location/region_from', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    
    public function dublicate_territory($id) {
        $region = $this->location_model->get_territory_byname($this->input->post('territory_name'), $this->input->post('region_id'), $this->input->post('country_id'));
        if (!empty($region)) {
            $this->form_validation->set_message('dublicate_territory', 'Allready Exist');
            return false;
        } else {
            return true;
        }
    }
    public function add_territory() {
        $data['title'] = display('add_teretory');
        $data['doctor'] = '';
        $data['states'] = $this->location_model->all_states();
        #-------------------------------#
        if (empty($this->input->post('user_id'))) {
            $this->form_validation->set_rules('territory_name', display('territory_name'), 'required|max_length[50]|callback_dublicate_territory');
            $this->form_validation->set_rules('country_id', display('country_name'), 'required|max_length[50]');
            $this->form_validation->set_rules('region_id', display('region_name'), 'required|max_length[50]');
            #-------------------------------#
        } else {
            $this->form_validation->set_rules('country_id', display('country_name'), 'required|max_length[50]');
        }
        #-------------------------------# 
        //when create a user
        if (empty($this->input->post('user_id'))) {
            $data['doctor'] = (object) $postData = [
                'territory_id' => $this->input->post('user_id', true),
                'comp_id' => $this->session->userdata('companey_id'),
                'territory_name' => $this->input->post('territory_name', true),
                'country_id' => $this->input->post('country_id', true),
                'region_id' => $this->input->post('region_id', true),
                'status' => $this->input->post('status', true),
                'created_by' => $this->session->userdata('user_id'),
                'created_date' => date('Y-m-d'),
                'state_id' => $this->input->post('state_id')
            ];
        } else { //update a user
            $data['doctor'] = (object) $postData = [
                'territory_id' => $this->input->post('user_id', true),
                'comp_id' => $this->session->userdata('companey_id'),
                'territory_name' => $this->input->post('territory_name', true),
                'country_id' => $this->input->post('country_id', true),
                'region_id' => $this->input->post('region_id', true),
                'status' => $this->input->post('status', true),
                'created_by' => $this->session->userdata('user_id'),
                'created_date' => date('Y-m-d'),
                'state_id' => $this->input->post('state_id')
            ];
        }
        #-------------------------------#
        if ($this->form_validation->run() === true) {
            #if empty $user_id then insert data
            if (empty($this->input->post('user_id'))) {
                if (user_role('10') == true) {
                }
                if ($this->location_model->create_tretory($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('location/territory');
            } else {
                if (user_role('11') == true) {
                }
                if ($this->location_model->update_tretory($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('location/territory');
            }
        } else {
            $data['country'] = $this->location_model->country();
            $data['region_list'] = $this->location_model->region_list();
            $data['content'] = $this->load->view('location/territory_from', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    public function dublicate_state($id) {
        $region = $this->location_model->get_state_byname($this->input->post('territory_name'), $this->input->post('region_name'), $this->input->post('country_name'), $this->input->post('state_name'));
        if (!empty($region)) {
            $this->form_validation->set_message('dublicate_state', 'Allready Exist');
            return false;
        } else {
            return true;
        }
    }
    public function add_state() {
        $data['title'] = display('add_state');
        $data['doctor'] = '';
        #-------------------------------#
        if (empty($this->input->post('user_id'))) {
            $this->form_validation->set_rules('state_name', display('state_name'), 'required|max_length[50]|callback_dublicate_state');
            #-------------------------------#
        } else {
            $this->form_validation->set_rules('state_name', display('state_name'), 'required|max_length[50]|callback_dublicate_state');
        }
        $this->form_validation->set_rules('country_id', display('country_name'), 'required|max_length[50]');
        $this->form_validation->set_rules('region_id', display('region_name'), 'required|max_length[50]');
        //$this->form_validation->set_rules('territory_id', display('territory_name') ,'required|max_length[50]');
        #-------------------------------# 
        //when create a user
        if (empty($this->input->post('user_id'))) {
            $data['doctor'] = (object) $postData = [
                'id' => $this->input->post('user_id', true),
                'comp_id' => $this->session->userdata('companey_id'),
                'state' => $this->input->post('state_name', true),
                //'territory_id'    => $this->input->post('territory_id',true),
                'country_id' => $this->input->post('country_id', true),
                'region_id' => $this->input->post('region_id', true),
                'status' => $this->input->post('status', true),
                'created_by' => $this->session->userdata('user_id'),
                'date_modify' => date('Y-m-d'),
            ];
        } else { //update a user
            $data['doctor'] = (object) $postData = [
                'id' => $this->input->post('user_id', true),
                'comp_id' => $this->session->userdata('companey_id'),
                'state' => $this->input->post('state_name', true),
                //'territory_id'    => $this->input->post('territory_id',true),
                'country_id' => $this->input->post('country_id', true),
                'region_id' => $this->input->post('region_id', true),
                'status' => $this->input->post('status', true),
                'created_by' => $this->session->userdata('user_id'),
                'date_modify' => date('Y-m-d'),
            ];
        }
        #-------------------------------#
        if ($this->form_validation->run() === true) {
            #if empty $user_id then insert data
            if (empty($this->input->post('user_id'))) {
                if (user_role('10') == true) {
                }
                if ($this->location_model->create_state($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('location/state');
            } else {
                if (user_role('11') == true) {
                }
                if ($this->location_model->update_state($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('location/state');
            }
        } else {
            $data['country'] = $this->location_model->country();
            $data['region_list'] = $this->location_model->region_list();
            $data['content'] = $this->load->view('location/state_from', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    public function dublicate_city($id) {
        $region = $this->location_model->get_city_byname($this->input->post('territory_id'), $this->input->post('region_id'), $this->input->post('country_id'), $this->input->post('state_id'), $this->input->post('city_name'));
        if (!empty($region)) {
            $this->form_validation->set_message('dublicate_city', 'Allready Exist');
            return false;
        } else {
            return true;
        }
    }
    public function add_city() {
        $data['title'] = display('add_city');
        $data['doctor'] = '';
        #-------------------------------#
        if (empty($this->input->post('user_id'))) {
            $this->form_validation->set_rules('city_name', display('city_name'), 'required|max_length[50]|callback_dublicate_city');
            #-------------------------------#
        } else {
            $this->form_validation->set_rules('city_name', display('city_name'), 'required|max_length[50]|callback_dublicate_city');
        }
        $this->form_validation->set_rules('country_id', display('country_name'), 'required|max_length[50]');
        $this->form_validation->set_rules('region_id', display('region_name'), 'required|max_length[50]');
        $this->form_validation->set_rules('territory_id', display('territory_name'), 'required|max_length[50]');
        $this->form_validation->set_rules('state_id', display('state_name'), 'required|max_length[50]');
        #-------------------------------# 
        //when create a user
        if (empty($this->input->post('user_id'))) {
            $data['doctor'] = (object) $postData = [
                'id' => $this->input->post('user_id', true),
                'comp_id' => $this->session->userdata('companey_id'),
                'city' => $this->input->post('city_name', true),
                'state_id' => $this->input->post('state_id', true),
                'territory_id' => $this->input->post('territory_id', true),
                'country_id' => $this->input->post('country_id', true),
                'region_id' => $this->input->post('region_id', true),
                'status' => $this->input->post('status', true),
                'created_by' => $this->session->userdata('user_id'),
                'date_modify' => date('Y-m-d'),
            ];
        } else { //update a user
            $data['doctor'] = (object) $postData = [
                'id' => $this->input->post('user_id', true),
                'comp_id' => $this->session->userdata('companey_id'),
                'city' => $this->input->post('city_name', true),
                'state_id' => $this->input->post('state_id', true),
                'territory_id' => $this->input->post('territory_id', true),
                'country_id' => $this->input->post('country_id', true),
                'region_id' => $this->input->post('region_id', true),
                'status' => $this->input->post('status', true),
                'created_by' => $this->session->userdata('user_id'),
                'date_modify' => date('Y-m-d'),
            ];
        }
        #-------------------------------#
        if ($this->form_validation->run() === true) {
            #if empty $user_id then insert data
            if (empty($this->input->post('user_id'))) {
                if (user_role('10') == true) {
                }
                if ($this->location_model->create_city($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('location/city');
            } else {
                if (user_role('11') == true) {
                }
                if ($this->location_model->update_city($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('location/city');
            }
        } else {
            $data['country'] = $this->location_model->country();
            $data['region_list'] = $this->location_model->region_list();
            $data['content'] = $this->load->view('location/city_from', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }
    public function edit_contry($user_id = null) {
        if (user_role('11') == true) {
        }
        $data['doctor'] = $this->location_model->read_by_id($user_id);
        $data['content'] = $this->load->view('location/country_from', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    public function edit_region($user_id = null) {
        if (user_role('11') == true) {
        }
        $data['doctor'] = $this->location_model->read_by_region($user_id);
        $data['country'] = $this->location_model->country();
        $data['content'] = $this->load->view('location/region_from', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    public function edit_territory($user_id = null) {
        if (user_role('11') == true) {
        }
        $data['doctor'] = $this->location_model->read_by_territory($user_id);
        $data['state'] = $this->location_model->Find_state($territory_id = $user_id);
        $data['country'] = $this->location_model->country();
        $data['region_list'] = $this->location_model->region_list();
        $data['content'] = $this->load->view('location/territory_from', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    public function edit_state($user_id = null) {
        if (user_role('11') == true) {
        }
        $data['doctor'] = $this->location_model->read_by_state($user_id);
        $data['country'] = $this->location_model->country();
        $data['region_list'] = $this->location_model->region_list();
        $data['territory_list'] = $this->location_model->territory_lsit();
        $data['content'] = $this->load->view('location/state_from', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    public function edit_city($user_id = null) {
        if (user_role('11') == true) {
        }
        $data['doctor'] = $this->location_model->read_by_city($user_id);
        $data['country'] = $this->location_model->country();
        $data['region_list'] = $this->location_model->region_list();
        $data['territory_list'] = $this->location_model->territory_lsit();
        $data['state_list'] = $this->location_model->state_list();
        $data['content'] = $this->load->view('location/city_from', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    public function delete($user_id = null) {
        if (user_role('12') == true) {
        }
        if ($this->location_model->delete($user_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('location/country');
    }
    public function delete_region($user_id = null) {
        if (user_role('12') == true) {
        }
        if ($this->location_model->delete_region($user_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('location/region');
    }
    public function delete_territory($user_id = null) {
        if (user_role('12') == true) {
        }
        if ($this->location_model->delete_territory($user_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('location/territory');
    }
    public function delete_state($user_id = null) {
        if (user_role('12') == true) {
        }
        if ($this->location_model->delete_state($user_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('location/state');
    }
    public function delete_city($user_id = null) {
        if (user_role('12') == true) {
        }
        if ($this->location_model->delete_city($user_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('location/state');
    }
    function import() {
        if (user_role('10') == true) {
        }
        $data['title'] = display('import');
        $data['content'] = $this->load->view('location/import', $data, true);
        $this->load->view('layout/main_wrapper', $data);
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
            while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                if ($c > 0) {
                    $this->db->where('country_name', $filesop[0]);
                    $this->db->where('comp_id', $this->session->companey_id);
                    $id = $this->db->get('tbl_country');
                    $id1 = $id->num_rows();
                    if ($id1 > 0) {
                        $country_id = $id->row()->id_c;
                    } else {
                        $this->db->set('country_name', $filesop[0]);
                        $this->db->set('comp_id', $this->session->userdata('companey_id'));
                        $this->db->set('created_by', $this->session->userdata('user_id'));
                        $this->db->set('created_date', date('Y-m-d'));
                        $this->db->insert('tbl_country');
                        $country_id = $this->db->insert_id();
                    }
                    $this->db->where('country_id', $country_id);
                    $this->db->where('region_name', $filesop[1]);
                    $id2 = $this->db->get('tbl_region');
                    $id3 = $id2->num_rows();
                    if ($id3 > 0) {
                        $region_id = $id2->row()->region_id;
                    } else {
                        $this->db->set('country_id', $country_id);
                        $this->db->set('comp_id', $this->session->userdata('companey_id'));
                        $this->db->set('region_name', $filesop[1]);
                        $this->db->set('created_by', $this->session->userdata('user_id'));
                        $this->db->set('created_date', date('Y-m-d'));
                        $this->db->insert('tbl_region');
                        $region_id = $this->db->insert_id();
                    }
                    $this->db->where('country_id', $country_id);
                    //$this->db->where('territory_id',$territory_id);
                    $this->db->where('region_id', $region_id);
                    $this->db->where('state', $filesop[2]);
                    $id5 = $this->db->get('state');
                    $id6 = $id5->num_rows();
                    if ($id6 > 0) {
                        $state_id = $id5->row()->id;
                    } else {
                        $this->db->set('country_id', $country_id);
                        $this->db->set('region_id', $region_id);
                        $this->db->set('comp_id', $this->session->userdata('companey_id'));
                        //$this->db->set('territory_id',$territory_id);
                        $this->db->set('state', $filesop[2]);
                        $this->db->set('created_by', $this->session->userdata('user_id'));
                        $this->db->set('date_modify', date('Y-m-d'));
                        $this->db->insert('state');
                        $state_id = $this->db->insert_id();
                    }
                    $this->db->where('country_id', $country_id);
                    $this->db->where('region_id', $region_id);
                    $this->db->where('territory_name', $filesop[3]);
                    $id4 = $this->db->get('tbl_territory');
                    $id5 = $id4->num_rows();
                    if ($id5 > 0) {
                        $territory_id = $id4->row()->territory_id;
                    } else {
                        $this->db->set('country_id', $country_id);
                        $this->db->set('comp_id', $this->session->userdata('companey_id'));
                        $this->db->set('region_id', $region_id);
                        $this->db->set('state_id', $state_id);
                        $this->db->set('territory_name', $filesop[3]);
                        $this->db->set('created_by', $this->session->userdata('user_id'));
                        $this->db->set('created_date', date('Y-m-d'));
                        $this->db->insert('tbl_territory');
                        $territory_id = $this->db->insert_id();
                    }
                    $this->db->where('country_id', $country_id);
                    $this->db->where('territory_id', $territory_id);
                    $this->db->where('region_id', $region_id);
                    $this->db->where('state_id', $state_id);
                    $this->db->where('city', $filesop[4]);
                    $id7 = $this->db->get('city');
                    $id8 = $id7->num_rows();
                    if ($id8 > 0) {
                        $id7->row()->id;
                    } else {
                        $this->db->set('country_id', $country_id);
                        $this->db->set('comp_id', $this->session->userdata('companey_id'));
                        $this->db->set('region_id', $region_id);
                        $this->db->set('territory_id', $territory_id);
                        $this->db->set('state_id', $state_id);
                        $this->db->set('city', $filesop[4]);
                        $this->db->set('created_by', $this->session->userdata('user_id'));
                        $this->db->set('date_modify', date('Y-m-d'));
                        $this->db->insert('city');
                    }
                }
                $c++;
            }
            $this->session->set_flashdata('message', "Data successfully added.");
            redirect(base_url() . 'location/import');
            // echo '<pre>'; print_r ($discCodeArr); print_r ($stateArr); print_r ($cityArr); print_r ($blockArr); die;
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            
            redirect(base_url() . 'location/import');
        }
    }
    //Find region on the base of country...
    public function find_region() {
        $country = $this->input->post('country');
        $data = $this->location_model->get_region($country);
        echo json_encode($data);
    }
    //Find Territory  on the base of region...
    public function find_territory() {
        $region_id = $this->input->post('region_id');
        $data = $this->location_model->get_find_territory($region_id);
        echo json_encode($data);
    }
    //Find state based on Territory....
    public function find_state() {
        $territory_id = $this->input->post('territory_id');
        $data = $this->location_model->Find_state($territory_id);
        echo json_encode($data);
    }
    //Get state by region
    public function select_state_by_region() {
        $region = $this->input->post('region_id');
        echo json_encode($this->location_model->all_statess($region));
        //echo $region;
    }
    //Find territory by state
    public function select_territory_by_state() {
        $state_id = $this->input->post('state_id');
        echo json_encode($this->location_model->all_territory($state_id));
    }
    //Find city by territory
    public function select_city() {
        $territory_id = $this->input->post('territory_id');
        echo json_encode($this->location_model->all_city($territory_id));
    }
    
#-----------------------------------------All document Master setup Start-------------------------------------------------#
public function country_vs_document() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $preferd_country = $this->input->post('preferd_country');
            $document_type = $this->input->post('document_type');

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'country_id'   => $preferd_country,
                'document_type'   => $document_type,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->location_model->country_vs_document_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Document Type Add Successfully');
            redirect('location/country_vs_document');
        }

        $data['country'] = $this->location_model->country();
        $data['all_c_vs_d'] = $this->location_model->c_vs_d_select();
        $data['title'] = 'Create Document';
        $data['content'] = $this->load->view('document/country -vs-document', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function cvd_update()
    {  
    if(!empty($_POST)){
    $cvd_id = $this->input->post('cvd_id');
    $preferd_country = $this->input->post('preferd_country');
    $document_type = $this->input->post('document_type');
    
    $this->db->set('country_id',$preferd_country);
    $this->db->set('document_type',$document_type);
    $this->db->where('id',$cvd_id);
    $this->db->update('tbl_doc_vs_country');
    redirect('location/country_vs_document');
    }
    $data['content'] = $this->load->view('document/country -vs-document', $data, true);
    $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_cvd(){
        if(!empty($_POST)){
        $cvd_id=$this->input->post('sel_temp');
        foreach($cvd_id as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_doc_vs_country');
        }
        }
        }
/******************************************************************************/        
        public function country_vs_stream() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $preferd_country = $this->input->post('preferd_country');
            $document_type = $this->input->post('document_type');
            $stream = $this->input->post('stream');

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'country_id'   => $preferd_country,
                'document_type'   => $document_type,
                'stream'   => $stream,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->location_model->country_vs_stream_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'Stream Add Successfully');
            redirect('location/country_vs_stream');
        }

        $data['country'] = $this->location_model->country();
        $data['all_c_vs_d'] = $this->location_model->c_vs_d_select();
        $data['all_c_vs_s'] = $this->location_model->c_vs_s_select();
        $data['title'] = 'Create Document Stream';
        $data['content'] = $this->load->view('document/country-vs-stream', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    public function fetch_documentType()
    {
        $comp_id= $this->session->userdata('companey_id');
        $id=$this->input->post('id');
        $get=$this->db->where(array('comp_id'=>$comp_id,'country_id'=>$id))->get('tbl_doc_vs_country')->result();
            echo '<option value="">Select Type</option>';
        foreach ($get as $key => $value) {
            echo '<option value="'.$value->id.'">'.$value->document_type.'</option>';
        }
      

    }
    public function fetch_stream()
    {
        $comp_id= $this->session->userdata('companey_id');
        $id=$this->input->post('id');
        $all_c_vs_s=$this->db->where(array('comp_id'=>$comp_id,'document_type'=>$id))->get('tbl_doc_vs_sream')->result();
        echo '<option value="">Select Stream</option>';
       foreach($all_c_vs_s as $cvs){ 
            echo'<option value ="'.$cvs->id.'">'.$cvs->stream.'</option>';
         }
      

    }
   
    public function cvs_update()
    {  
    if(!empty($_POST)){
    $cvs_id = $this->input->post('cvs_id');
    $preferd_country = $this->input->post('preferd_country');
    $document_type = $this->input->post('document_type');
    $stream = $this->input->post('stream');
    
    $this->db->set('country_id',$preferd_country);
    $this->db->set('document_type',$document_type);
    $this->db->set('stream',$stream);
    $this->db->where('id',$cvs_id);
    $this->db->update('tbl_doc_vs_sream');
    redirect('location/country_vs_stream');
    }
    $data['content'] = $this->load->view('document/country-vs-stream', $data, true);
    $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_cvs(){
        if(!empty($_POST)){
        $cvs_id=$this->input->post('sel_temp');
        foreach($cvs_id as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_doc_vs_sream');
        }
        }
        }
        
/******************************************************************************/        
        public function country_vs_file() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

            $preferd_country = $this->input->post('preferd_country');
            $document_type = $this->input->post('document_type');
            $stream = $this->input->post('stream');
            $file_name = $this->input->post('file_name');

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'country_id'   => $preferd_country,
                'document_type'   => $document_type,
                'stream'   => $stream,
                'file_name'   => $file_name,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->location_model->country_vs_file_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'File Name Add Successfully');
            redirect('location/country_vs_file');
        }

        $data['country'] = $this->location_model->country();
        $data['all_c_vs_d'] = $this->location_model->c_vs_d_select();
        $data['all_c_vs_s'] = $this->location_model->c_vs_s_select();
        $data['all_c_vs_f'] = $this->location_model->c_vs_f_select();
        $data['title'] = 'Create File Name';
        $data['content'] = $this->load->view('document/country-vs-file', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function cvf_update()
    {  
    if(!empty($_POST)){
    $cvf_id = $this->input->post('cvf_id');
    $preferd_country = $this->input->post('preferd_country');
    $document_type = $this->input->post('document_type');
    $stream = $this->input->post('stream');
    $file_name = $this->input->post('file_name');
    
    $this->db->set('country_id',$preferd_country);
    $this->db->set('document_type',$document_type);
    $this->db->set('stream',$stream);
    $this->db->set('file_name',$file_name);
    $this->db->where('id',$cvf_id);
    $this->db->update('tbl_doc_vs_file');
    redirect('location/country_vs_file');
    }
    $data['content'] = $this->load->view('document/country-vs-file', $data, true);
    $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_cvf(){
        if(!empty($_POST)){
        $cvf_id=$this->input->post('sel_temp');
        foreach($cvf_id as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_doc_vs_file');
        }
        }
        }   
#-----------------------------------------All document Master setup End-------------------------------------------------#
        #-----------------------------------------File manager setup Start-------------------------------------------------#
public function file_manager() {
        $data['nav1'] = 'nav2';
        if (!empty($_POST)) {

        if(!empty($_FILES['file_data']['name'])){      
        $this->load->library("aws");
        
        $_FILES['userfile']['name']= $_FILES['file_data']['name'];
        $_FILES['userfile']['type']= $_FILES['file_data']['type'];
        $_FILES['userfile']['tmp_name']= $_FILES['file_data']['tmp_name'];
        $_FILES['userfile']['error']= $_FILES['file_data']['error'];
        $_FILES['userfile']['size']= $_FILES['file_data']['size'];    
        
        $_FILES['userfile']['name'] = $image = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
                
                if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }
        }else{
              $image=$this->input->post('file_data_old', true);
        }

            $file_title = $this->input->post('file_name');

            $data = array(
                'comp_id'   => $this->session->userdata('companey_id'),
                'file_title'   => $file_title,
                'data_file'   => $image,
                'created_by' => $this->session->userdata('user_id')
            );

            $insert_id = $this->location_model->file_manager_add($data);
            $this->session->set_flashdata('SUCCESSMSG', 'File Added Successfully');
            redirect('location/file_manager');
        }

        $data['all_files'] = $this->location_model->file_select();
        $data['title'] = 'All Files';
        $data['content'] = $this->load->view('document/file_manager', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function file_manager_update()
    {  
    if(!empty($_POST)){
    $file_id = $this->input->post('file_id');
    $file_name = $this->input->post('file_name');
    
    if(!empty($_FILES['file_data']['name'])){      
        $this->load->library("aws");
        
        $_FILES['userfile']['name']= $_FILES['file_data']['name'];
        $_FILES['userfile']['type']= $_FILES['file_data']['type'];
        $_FILES['userfile']['tmp_name']= $_FILES['file_data']['tmp_name'];
        $_FILES['userfile']['error']= $_FILES['file_data']['error'];
        $_FILES['userfile']['size']= $_FILES['file_data']['size'];    
        
        $_FILES['userfile']['name'] = $image = strtotime(date('Y-m-d H:i:s')).'_'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/enq_documents/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
                
                if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }
        }else{
              $image=$this->input->post('file_data_old', true);
        }
    
    $this->db->set('file_title',$file_name);
    $this->db->set('data_file',$image);
    $this->db->where('id',$file_id);
    $this->db->update('tbl_filemanager');
    redirect('location/file_manager');
    }
    $data['content'] = $this->load->view('document/file_manager', $data, true);
    $this->load->view('layout/main_wrapper', $data);
    }
    
    public function delete_file_manager(){
        if(!empty($_POST)){
        $cvd_id=$this->input->post('sel_temp');
        foreach($cvd_id as $key){
        $this->db->where('id',$key);
        $query = $this->db->delete('tbl_filemanager');
        }
        }
        }
/**************************************file manager end****************************************/
}