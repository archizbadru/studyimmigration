<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Knowledge_base_model extends CI_Model {   	
	public function get_all_category(){
		$this->db->where('type',1);		
		$this->db->where('comp_id',$this->session->companey_id);					
		return $this->db->get('tbl_category')->result_array();
	}
	public function get_all_articles(){
		$this->db->select('articles.*,tbl_category.name as cat_name');	
		$this->db->where('articles.comp_id',$this->session->companey_id);			
		$this->db->join('tbl_category','tbl_category.id=articles.cat_id','inner');
		return $this->db->get('articles')->result_array();	
	}
	public function get_article_by_id($id){
		$this->db->select('articles.*,tbl_category.name as cat_name');				
		$this->db->where('articles.id',$id);
		$this->db->join('tbl_category','tbl_category.id=articles.cat_id','inner');		
		return $this->db->get('articles')->row_array();
	}
}