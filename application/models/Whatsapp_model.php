<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp_model extends CI_Model {



	function __construct()
    {
        parent::__construct();
		
    }

	public function get_list($type){
		
		// return $this->session->companey_id;
		return $this->db->select(" CONCAT(tbl_admin.s_display_name,' ',tbl_admin.last_name) as created_by_name,tbl_email_whatapp_sms_trans.*,DATE_FORMAT(created_date, '%d-%m-%Y %h:%i %p') as created_date,DATE_FORMAT(expiry_date, '%d-%m-%Y %h:%i %p') as expiry_date")
				     ->join('tbl_admin', 'tbl_admin.pk_i_admin_id=tbl_email_whatapp_sms_trans.user_id')
						->where("comp_id", $this->session->companey_id)
						->where("type",$type)
						->order_by("id DESC")
						->limit(10)
						->get("tbl_email_whatapp_sms_trans")
						->result();	
						

	}
	public function get_comp_list($type,$comp_id){
		
		return $this->db->select(" CONCAT(tbl_admin.s_display_name,' ',tbl_admin.last_name) as created_by_name,swe.*, CONCAT(user.firstname,' ',user.lastname) as comp_admin_name, DATE_FORMAT(created_date, '%d-%m-%Y %h:%i %p') as created_date,DATE_FORMAT(expiry_date, '%d-%m-%Y %h:%i %p') as expiry_date")
				     ->join('tbl_admin', 'tbl_admin.pk_i_admin_id=swe.user_id')
				     ->join('user', 'user.user_id=swe.comp_admin_id')
						->where("swe.comp_id", $comp_id)
						->where("swe.type",$type)
						->order_by("swe.id DESC")
						->limit(10)
						->get("tbl_email_whatapp_sms_trans as swe")
						->result();	
						

	}

	public function sms_email_whatsapp_validate($comp_id,$type){
		
		$res =  $this->db->where(['comp_id'=>$comp_id,'type'=>$type])
		                ->get("tbl_email_whatapp_sms_trans")
				    ->row();	
			if(!empty($res)){
				$today = date("Y-m-d H:i:s");
				$date = $res->expiry_date;
				if($date > $today) {
                            $total_qty = $res->qty;
				    $qty_used = $res->qty_used;
				    if($total_qty >=  $qty_used){
					return true;
				    }else{
					return "You don't have enough transaction plan!";
				    }
				}else{
					return "You Transaction plan has been expired!";
				}
			}else{
				return "You don't have any transaction plan!";
			}	    
						

	}


	public function get_report($type){
		
		return $this->db->select(" CONCAT(tbl_admin.s_display_name,' ',tbl_admin.last_name) as created_by_name,tbl_email_whatapp_sms_trans.*,DATE_FORMAT(created_date, '%d-%m-%Y %h:%i %p') as created_date,DATE_FORMAT(expiry_date, '%d-%m-%Y %h:%i %p') as expiry_date")
				     ->join('tbl_admin', 'tbl_admin.pk_i_admin_id=tbl_email_whatapp_sms_trans.user_id')
						->where("type",$type)
						->order_by("id DESC")
						->limit(10)
						->get("tbl_email_whatapp_sms_trans")
						->result();	    
						

	}
	public function get_balance($type,$comp){
		$sql = "SELECT  SUM(qty) as total_quantity, SUM(qty_used) as used_quantity,SUM(balance) 
                    as total_balance FROM tbl_email_whatapp_sms_trans WHERE type = $type AND comp_id = $comp AND DATE(expiry_date) > DATE(NOW())";  
		return $this->db->query($sql)->row();
		
								

	}
	public function add_balance($data){
		
		return  $this->db->insert('tbl_email_whatapp_sms_trans',$data);
								

	}

     



}
?>