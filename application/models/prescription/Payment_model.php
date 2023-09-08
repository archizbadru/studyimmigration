<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {



	function __construct()
    {
        parent::__construct();
		
    }
	
	function getpayment($custno){
		
		return $this->db->select("pay.*,pmode.title as pay_mode,pstatus.title status,ord.ord_no,ord.product,ord.quantity,ord.total_price")
						->where("pay.cust_id", $custno)
						->from("payment pay")
						->join("masters pmode", "pmode.id=pay.pay_mode", "LEFT")
						->join("tbl_order ord", "ord.id= pay.ord_id", "LEFT")
						->join("masters pstatus", "pstatus.id=pay.status", "LEFT")
						->get()
						->result();
		
	}
	function getPaymentByOrder($ordno){
		
		return $this->db->select("pay.*,pmode.title as pay_mode,pstatus.title status")
						->where("pay.ord_id", $ordno)
						->from("payment pay")
						->join("masters pmode", "pmode.id=pay.pay_mode", "LEFT")
						->join("tbl_order ord", "ord.id= pay.ord_id", "LEFT")
						->join("masters pstatus", "pstatus.id=pay.status", "LEFT")
						->get()
						->result();
		
	}
	function getPaymentByOrderno($ordno){
		
		return $this->db->select("pay.*,ord.total_price,pmode.title as pay_mode,pstatus.title status")
						->where("ord.ord_no", $ordno)
						->from("payment pay")
						->join("masters pmode", "pmode.id=pay.pay_mode", "LEFT")
						->join("tbl_order ord", "ord.id= pay.ord_id", "LEFT")
						->join("masters pstatus", "pstatus.id=pay.status", "LEFT")
						->get()
						->result();
		
	}
	
	public function getPayByCustomer(){
		
		 $this->db->select("pay.*,ord.ord_no,ord.total_price,pmode.title as pay_mode,pstatus.title status, concat(usr.fname,' ', usr.lname) as  customer");
			 //  $this->db->where("ord.ord_no", $ordno);
					if(isset($_GET["c"])){
						
							$this->db->where("ord.cus_id", base64_decode(base64_decode(urldecode($this->input->get("c")))));
						
					}else{
					//		$this->db->where("ord.cus_id", $this->session->user_id);
					
					}
				$this->db->from("payment pay");
				$this->db->join("masters pmode", "pmode.id=pay.pay_mode", "LEFT");
				$this->db->join("tbl_order ord", "ord.id= pay.ord_id", "LEFT");
				$this->db->join("users usr", "usr.id= pay.cust_id", "LEFT");
				$this->db->join("masters pstatus", "pstatus.id=pay.status", "LEFT");
		return	$this->db->get()->result();
		
	}
	
	function getpayments(){
		
		$this->db->select("pay.*,pmode.title as pay_mode,pstatus.title status");
		$this->db->from("payment pay");
		$this->db->join("masters pmode", "pmode.id=pay.pay_mode", "LEFT");
		$this->db->join("masters pstatus", "pstatus.id=pay.status", "LEFT");
		if($this->session->mrole != 1){
			
			$this->db->where("pay.cust_id", $this->session->user_id);
		}
		$payarr = 	$this->db->get()
				->result();
		
		$newarr = array();
		if(!empty($payarr)){
			
			foreach($payarr as $ind => $pay){
				$newarr[$pay->ord_id][] = $pay;	
			}
		}
		return $newarr;
	}

	public function getProduct()
	{
		$this->db->select("DISTINCT(tbl_order.product)");
		$this->db->from("tbl_order");
		$this->db->join("payment","payment.ord_id = tbl_order.id","left");
		return $this->db->get()->result();

	}
	
	public function getPaymentById($payno){
		
		return $this->db->select("ord.*,pay.*")
						->where("pay.id", $payno)
						->from("payment pay")
						->join("tbl_order ord", "ord.id=pay.ord_id")
						->get()
						->row();
		
	}
	public function getmaster(){
		
		return  $this->db->select("*")->where("company", $this->session->company)
												  ->where("type = 2 OR type = 3")
												  ->get("masters")
												  ->result();
	}
	
	public function getConfOrder(){
		
		
		
		$this->db->select("cnford.*,pay.prev_balance,pay.pay,pay.balance,pay.id as pay_id, concat(usr.fname,' ', usr.lname) as  customer");
		$this->db->where("cnford.company", $this->session->company);

		
		if(isset($_GET["c"])){
			
				$this->db->where("ord.cus_id", base64_decode(base64_decode(urldecode($this->input->get("c")))));
			
		}else{
				//$this->db->where("ord.cus_id", $this->session->user_id);
		
		}	
		
		if(!empty($_POST["start_date"]) and !empty($_POST["end_date"])){
			
			$str_dt = $this->cleandate("start_date");
			$end_dt = $this->cleandate("end_date");
			
			$this->db->where("cnford.created_date >= '".$str_dt."' and cnford.created_date <= '".$end_dt."'");
			
		}else if(!empty($_POST["start_date"])){
			
			$str_dt = $this->cleandate("start_date");
			
			$this->db->where("cnford.created_date >= '".$str_dt."'");
			
		}else if(!empty($_POST["end_date"])){
			
			$end_dt = $this->cleandate("end_date");
			$this->db->where("cnford.created_date <= '".$end_dt."'");
		}
		if(!empty($_GET["sd"]) and !empty($_GET["ed"])){
			
			$str_dt = $this->gcleandate("sd");
			$end_dt = $this->gcleandate("ed");
			
			$this->db->where("cnford.created_date >= '".$str_dt."' and cnford.created_date <= '".$end_dt."'");
			
		}else if(!empty($_POST["start_date"])){
			
			$str_dt = $this->gcleandate("sd");
			
			$this->db->where("cnford.created_date >= '".$str_dt."'");
			
		}else if(!empty($_POST["end_date"])){
			
			$end_dt = $this->gcleandate("ed");
			$this->db->where("cnford.created_date <= '".$end_dt."'");
		}
		
		
		
		$this->db->order_by("cnford.id DESC");
		$this->db->from("delivery cnford");
		$this->db->join("tbl_order ord", "ord.id=cnford.ord_id", "LEFT");
		$this->db->join("order_prdct ordprd", "ord.id=ordprd.ord_id", "LEFT");
		$this->db->join("users usr", "usr.id= cnford.cust_id", "LEFT");
		$this->db->join("payment pay", "ord.id=pay.ord_id", "LEFT");
		$this->db->join("tbl_product prd", "prd.id=ordprd.product", "LEFT");
		
		return	$this->db->get()->result();
			
	}
	public function cleandate($post){
		
		$pdate = $this->input->post($post, true);
		
		if(!empty($pdate)) {
			$pdate = str_replace("/", "-", $pdate);
			
			$darr  = explode("-", $pdate); 
			
			return date("Y-m-d", strtotime($darr[2]."-".$darr[0]."-".$darr[1]));
		}
		
	}
	public function gcleandate($post){
		
		$pdate = urldecode($this->input->get($post, true));
		
		if(!empty($pdate)) {
			$pdate = str_replace("/", "-", $pdate);
			
			$darr  = explode("-", $pdate); 
			
			return date("Y-m-d", strtotime($darr[2]."-".$darr[0]."-".$darr[1]));
		}
		
	}
	
}	