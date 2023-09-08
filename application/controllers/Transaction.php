<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    public function __construct() {
        parent::__construct();

   
     if(empty($this->session->userdata('isLogIn')))
        redirect('login');
    }

    public function sms() {
        // echo "<pre>";
        // print_r($_SESSION);
        // return;
        $data['title'] = display('sms_transaction_detail');
        $data['type'] = 2;
        $data['content'] = $this->load->view('reports/transaction', $data, true);        
        $this->load->view('layout/main_wrapper', $data);
       
    }
    public function email() {
       
        $data['title'] = display('email_transaction_detail');
        $data['type'] = 3;
        $data['content'] = $this->load->view('reports/transaction', $data, true);        
        $this->load->view('layout/main_wrapper', $data);
    }
    public function whatsapp() {
       
        $data['title'] = display('whatsapp_transaction_detail');
        $data['type'] = 1;
        $data['content'] = $this->load->view('reports/transaction', $data, true);        
        $this->load->view('layout/main_wrapper', $data);
    }
    public function telephonic() {
       
        $data['title'] = display('telephonic_transaction_detail');
        $data['type'] = 4;
        $data['content'] = $this->load->view('reports/transaction', $data, true);        
        $this->load->view('layout/main_wrapper', $data);
    }

   
}