<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends CI_Model {
public function report_details($baq_number){
        $this->db->from('tbl_boq');
        $this->db->join('tbl_modular_box', 'tbl_modular_box.m_id = tbl_boq.modular_box','left');
        $this->db->join('tbl_switch_box', 'tbl_switch_box.sb_id = tbl_boq.switch_box','left');
        $this->db->where('tbl_boq.baq_number',$baq_number);
        return $query = $this->db->get()->result();
}

public function circuititems($value){
        $this->db->select('*');
        $this->db->from('tabl_cicuit_item');
        $this->db->join('tbl_itemlist','tbl_itemlist.itemlist_id = tabl_cicuit_item.color');
        $this->db->join('tbl_area', 'tbl_itemlist.room_id = tbl_area.a_id','left');
        $this->db->join('tbl_product', 'tbl_product.sb_id = tbl_itemlist.item_name','left');
        $this->db->where('tabl_cicuit_item.boq_id',$value);
        return $query = $this->db->get()->result();
}

public function requirements($value){
        $this->db->select('*');
        $this->db->from('tabl_cicuit_item');
        $this->db->join('tbl_itemlist','tbl_itemlist.itemlist_id = tabl_cicuit_item.color');
        $this->db->join('tbl_area', 'tbl_itemlist.room_id = tbl_area.a_id','left');
        $this->db->join('tbl_product', 'tbl_product.sb_id = tbl_itemlist.item_name','left');
        $this->db->where('tabl_cicuit_item.boq_id',$value);
        return $query = $this->db->get()->result();
}

public function read_enquiry(){
	
	   /* user roles
	    3 = Country Head
	    4 = Region Head
	    5 = Territory Head
	    6 = State Head
	    7 = City Head 
	    8 = User */
	    
	   $user_id   = $this->session->user_id;
	   $user_role = $this->session->user_role;
	   $region_id = $this->session->region_id;
	   $assign_country = $this->session->country_id;
	   $assign_region = $this->session->region_id;
	   $assign_territory = $this->session->territory_id;
	   $assign_state = $this->session->state_id;
	   $assign_city = $this->session->city_id;
	   
	   if($user_role==3||$user_role==1||$user_role==2){

            $this->db->select("enquiry.*,lead_source.icon_url,lead_source.lsid,");
            $this->db->from("enquiry");
            $this->db->where('enquiry.country_id',$assign_country);
            $this->db->join('lead_source','enquiry.enquiry_source = lead_source.lsid');
            $this->db->where('enquiry.is_delete','1');
	     	
	                   
	       
	   }else if($user_role==4){

			
			$this->db->select("enquiry.*,lead_source.icon_url,lead_source.lsid,");
			$this->db->from("enquiry");
			//$this->db->where('enquiry.region_id',$assign_region);
			$this->db->join('lead_source','enquiry.enquiry_source = lead_source.lsid');
			$this->db->where('enquiry.is_delete','1');
	     
	       
	       
	   }else if($user_role==5){
			$this->db->select("enquiry.*,lead_source.icon_url,lead_source.lsid,");
			$this->db->from("enquiry");
			//$this->db->where('enquiry.territory_id',$assign_territory);
			$this->db->join('lead_source','enquiry.enquiry_source = lead_source.lsid');
			$this->db->where('enquiry.is_delete','1');
	     	
	       
	       
	   }else if($user_role==6){
			$this->db->select("enquiry.*,lead_source.icon_url,lead_source.lsid,");
			$this->db->from("enquiry");
			$this->db->where('enquiry.state_id',$assign_state);
			$this->db->join('lead_source','enquiry.enquiry_source = lead_source.lsid');
			$this->db->where('enquiry.is_delete','1');
	     
	       
	       
	   }else if($user_role==7){
			$this->db->select("enquiry.*,lead_source.icon_url,lead_source.lsid,");
			$this->db->from("enquiry");
			$this->db->where('enquiry.city_id',$assign_city);
			$this->db->join('lead_source','enquiry.enquiry_source = lead_source.lsid');
			$this->db->where('enquiry.is_delete','1');
	     
	                       
	       
	   }elseif($user_role==8||$user_role==9){
	     	$this->db->select("enquiry.*,lead_source.icon_url,lead_source.lsid,");
			$this->db->from("enquiry");
			$this->db->join('lead_source','enquiry.enquiry_source = lead_source.lsid');
			$this->db->where('enquiry.aasign_to',$user_id);
			$this->db->or_where('enquiry.created_by',$user_id);
			$this->db->where('enquiry.is_delete','1');
	     
	   }else{
			$this->db->select("enquiry.*,lead_source.icon_url,lead_source.lsid,");
			$this->db->from("enquiry");
			$this->db->join('lead_source','enquiry.enquiry_source = lead_source.lsid');
			$this->db->where('enquiry.is_delete','1');
	    
	   }
	    
			return $this->db->get()->result();
       
}



	
}
