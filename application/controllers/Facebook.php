<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Facebook extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'Product_model','location_model'
        ));
    }
	public function index(){
		$data['title'] = 'Facebook Field Details';
        $this->db->select("tbl_product_country.id as p_id");
		$data['product_list'] = $this->location_model->productcountry();
		$this->db->select('*,fb_from_details.id as form_update,tbl_product_country.country_name as productcountry_name');
		$this->db->join('tbl_product_country','tbl_product_country.id=fb_from_details.course_name');
		$data['form_details'] = $this->db->get('fb_from_details')->result();
		$data['content'] = $this->load->view('facebook/add_facebook_detail', $data, true);
        $this->load->view('layout/main_wrapper', $data);
	   }
    public function add_product() {		
		$this->load->model("location_model");;
        $data['product'] = '';       
        $this->form_validation->set_rules('from_id', display('from_id'), 'required');
        $this->form_validation->set_rules('from_name', display('from_name'), 'required');
        $this->form_validation->set_rules('adset_name', display('adset_name'), 'required');        
        $this->form_validation->set_rules('campaign_name', display('campaign_name'), 'required');
        $this->form_validation->set_rules('ad_name', display('ad_name'), 'required');
        $this->form_validation->set_rules('product_name', display('product_name'), 'required');
        $product =array(
            'comp_id' => $this->session->userdata('companey_id'),
            'from_id' => $this->input->post('from_id', true),
            'from_name' => $this->input->post('from_name', true),
            'compaign_name' => $this->input->post('campaign_name', true),
            'add_set_name' => $this->input->post('adset_name', true),
            'add_name' => $this->input->post('ad_name', true),
            'course_name' => $this->input->post('product_name', true),
            'created_by' => $this->session->userdata('user_id'),
            'created_dtae' => date('Y-m-d'),
        );
        
        if ($this->form_validation->run() === true) {
        	if(empty($this->input->post('form_update'))){
            $this->db->insert('fb_from_details',$product);
              $this->session->set_flashdata('message', display('save_successfully'));
            }else{
               $this->db->where('id',$this->input->post('form_update'));
               $this->db->update('fb_from_details',$product);
                 $this->session->set_flashdata('message', display('update_successfully'));
            }
        }
           redirect('facebook');
    }
    
}