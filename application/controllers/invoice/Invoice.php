<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoice extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->helper('date');
        $this->load->model(
                array('Leads_Model','common_model','enquiry_model', 'dashboard_model', 'Task_Model', 'User_model', 'location_model', 'Message_models','Institute_model','Datasource_model','Taskstatus_model','dash_model','Center_model','SubSource_model','Kyc_model','Education_model','SocialProfile_model','Closefemily_model','Invoice_model')
                );
        if (empty($this->session->user_id)) {
            redirect('login');
        }
    }
	
	public function index() {
        generate_invoice_id();        
        $aid = $this->session->userdata('user_id');
        $data['title'] = "Invoice List";
        $data['invoice_list']    =   $this->Invoice_model->get_invoice_list();
        $data['content'] = $this->load->view('invoice/index', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function report() {
        $aid = $this->session->userdata('user_id');
        $data['title'] = "Invoice List";
        $data['invoice_list']    =   $this->Invoice_model->get_invoice_list();
        $data['content'] = '';
        $this->load->view('layout/main_wrapper', $data);
    }

    public function settings() {
        $aid = $this->session->userdata('user_id');
        $data['title'] = "Invoice Settings";
        $data['invoice_list']    =   $this->Invoice_model->get_invoice_list();
        $data['content'] = $this->load->view('invoice/settings',$data,true);
        $this->load->view('layout/main_wrapper', $data);
    }



    public function create($id=0) {
        $aid = $this->session->userdata('user_id');
        $data['title'] = "Create Invoice";
        $data['items'] = $this->location_model->products();        
        if($id > 0){
            $data['title'] = "Update Invoice";
            $data['invoice'] = $this->Invoice_model->get_invoice_by_id($id);
            $data['related_to_list'] = $this->Invoice_model->related_to_list($data['invoice']['related_to']);            
            $invoice_products = $this->Invoice_model->get_invoice_products_by_id($id);
            $items = [];
            if(!empty($invoice_products)){
                foreach ($invoice_products as $key => $value) {
                    $items[] = array(
                                'id'=>$value['product_id'],
                                'rate'=>$value['rate'],
                                'qty'=>$value['qty'],
                                'total'=>$value['total'],
                                'disc'=>$value['discount'],
                                'gst'=>$value['gst'],
                                'net_total'=>$value['net_payable'],
                                );
                    
                }
            }
            $data['invoice_items'] = $items;
        }



        $data['content'] = $this->load->view('invoice/create', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    } 

    public function saveInvoice(){        
        $invoice = array(
                            'comp_id'           => $this->session->companey_id,
                            'invoice_code'      => $this->input->post('invoice_id'),
                            'related_to'        => $this->input->post('related_to'),
                            'enquiry_code'      => $this->input->post('enquiry_code'),
                            'invoice_date'      => $this->input->post('invoice_date'),
                            'due_date'          => $this->input->post('due_date'),
                            'note'              => $this->input->post('note'),
                            'total_amount'      => $this->input->post('total_amount'),
                            'total_discount_amount' => $this->input->post('disc_amount'),
                            'total_gst_amount'  => $this->input->post('gst_amount'),
                            'net_payable'       => $this->input->post('net_amount'),                        
                            'created_by'        => $this->session->user_id
                        );

        if($this->input->post('id')){
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('invoice',$invoice);
            $this->db->where('invoice_id',$this->input->post('id'));
            $this->db->delete('invoice_products');
            $msg = "Invoice Updated Successfully";
            $invoice_id    =   $this->input->post('id');            
        }else{
            $this->db->insert('invoice',$invoice);
            $msg = "Invoice Created Successfully";
            $invoice_id    =   $this->db->insert_id();
        }

        $items = $this->input->post('items');
        if(!empty($items)){
            $invoice_items = array();
            foreach ($items as $key => $value) {
                $invoice_items[]    =   array(            
                    'invoice_id' => $invoice_id,
                    'product_id' => $value['id'],
                    'rate' => $value['rate'],
                    'qty' => $value['qty'],
                    'total' => $value['total'],
                    'discount' => $value['disc'],
                    'gst' => $value['gst'],
                    'net_payable' => $value['net_total']
                );
            }        
            $this->db->insert_batch('invoice_products',$invoice_items);
        }

        echo json_encode(array('status'=>true,'msg'=>$msg));
    }   

    public function view($id) {
        $aid = $this->session->userdata('user_id');
        $data['title'] = "Invoice";

        $this->db->where('user_id',$this->session->companey_id);
        $data['company_row']    =   $this->db->get('user')->row_array();        
        $data['invoice'] = $this->Invoice_model->get_invoice_by_id($id);
        $this->db->where('Enquery_id',$data['invoice']['enquiry_code']);
        $data['enquiry_row']    =   $this->db->get('enquiry')->row_array();                   
        $data['invoice_products'] = $this->Invoice_model->get_invoice_items($id);
        $data['content'] = $this->load->view('invoice/view', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function get_related_to_list(){
        $related_to    =   $this->input->post('related_to');
        $result = $this->Invoice_model->related_to_list($related_to);
        $html = '';
        foreach ($result as $key => $value) { 
            $html .= "<option value=".$value['Enquery_id'].">".$value['name_prefix'].' '.$value['name'].' '.$value['lastname']."</option>";
        }
        echo $html;

    }
	public function delete_invoice_row(){
        $id = $this->input->post('id');        
        $this->db->where('id',$id);
        if($this->db->delete('invoice')){
            $this->db->where('invoice_id',$id);
            $this->db->delete('invoice_products');
            
        }
        echo 1;
    }

    public function save_general_setting(){                
        
        $invoice_id_prefix    =     $this->input->post('prefix');
        $invoice_id_suffix    =     $this->input->post('suffix');
        $invoice_nxt_number   =     $this->input->post('nxt_number');
        $invoice_currency     =     $this->input->post('currency');
        $invoice_allowed_download     =     $this->input->post('allow_download');
        $customer_invoice_email =   $this->input->post('customer_invoice_email');
        
        set_sys_parameter('invoice_id_prefix',$invoice_id_prefix,'INVOICE_SETTINGS');
        set_sys_parameter('invoice_id_suffix',$invoice_id_suffix,'INVOICE_SETTINGS');
        set_sys_parameter('invoice_nxt_number',$invoice_nxt_number,'INVOICE_SETTINGS');
        set_sys_parameter('invoice_currency',$invoice_currency,'INVOICE_SETTINGS');
        set_sys_parameter('invoice_allowed_download',$invoice_allowed_download,'INVOICE_SETTINGS');
        set_sys_parameter('invoice_customer_email',$customer_invoice_email,'INVOICE_SETTINGS');
        echo json_encode(array('status'=>1,'msg'=>"Saved Successfully"));

    }

    


}