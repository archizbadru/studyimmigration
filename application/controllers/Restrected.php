<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restrected extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'enquiry_model','Leads_Model','location_model','Task_Model','User_model'
		));
		
		
	}
public function	index(){
	   echo 'Unauthorized Access'; 
	}
}