<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Invoice_model extends CI_Model{
	
	public function get_invoice_list(){
		$this->db->where('comp_id',$this->session->companey_id);
		$this->db->order_by('id','desc');
        return $this->db->get('invoice')->result_array();
	}

	public function get_invoice_by_id($id){
		$this->db->where('id',$id);		
        return $this->db->get('invoice')->row_array();
	}
	public function related_to_list($related_to){
		$all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
        $this->db->select("enquiry.name_prefix,enquiry.Enquery_id,enquiry.name,enquiry.lastname");
        $where ="  enquiry.status=$related_to";      
        $where.=" AND enquiry.drop_status=0";                   
        $where .= " AND ( enquiry.created_by IN (".implode(',', $all_reporting_ids).')';
        $where .= " OR enquiry.aasign_to IN (".implode(',', $all_reporting_ids).'))';         
        $this->db->where($where);
        $result =   $this->db->get('enquiry')->result_array(); 
        return $result;        
	}
	public function get_invoice_products_by_id($id){
		$this->db->where('invoice_id',$id);		
		return $this->db->get('invoice_products')->result_array();
	}
	public function get_invoice_items($id){
		$this->db->select('invoice_products.*,tbl_product_country.country_name');
		$this->db->where('invoice_id',$id);				
		$this->db->join('tbl_product_country','tbl_product_country.id=invoice_products.product_id');
		return $this->db->get('invoice_products')->result_array();

	}
}