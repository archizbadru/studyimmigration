<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sell_model extends CI_Model {
	function __construct(){
        parent::__construct();		
    }	
	function getCategory(){		
		return $this->db->select("*")->where("comp_id", $this->session->companey_id)->get("tbl_category")->result();
		
	}	
	function subCategory(){		
		/*$category =  $this->db->select("tbl_subcategory.*,tbl_category.id as categid,tbl_category.name as category")
									 ->where("tbl_category.comp_id", $this->session->companey_id)
									 ->from("tbl_category")
									 ->join("tbl_subcategory", "tbl_category.id=tbl_subcategory.cat_id", "LEFT")
									->get()->result();	
		$newcateg  = array();		
		if(!empty($category)){
			foreach($category as $ind => $categ){					
				$newcateg[$categ->cat_id][] = $categ;		
			}
		}
		return $newcateg;
		*/
		$arr = array();
		$category	=	$this->db->where('comp_id',$this->session->companey_id)->get('tbl_category')->result_array();
		
		if (!empty($category)) {
			foreach ($category as $key => $value) {
				$cat_id = $value['id'];				
				$this->db->select('id,subcat_name');
				$this->db->where('cat_id',$cat_id);
				$subCategory	=	$this->db->get('tbl_subcategory')->result_array();				
				$arr[$cat_id]['title'] = $value['name']; 		
				if (!empty($subCategory)) {
					$arr[$cat_id]['sub'] = 	$subCategory; 		
				}
			}
		}
		return $arr;
	}	
}	