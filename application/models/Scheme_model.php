<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheme_model extends CI_Model {



	function __construct()
    {
        parent::__construct();
		
    }

	public function getApplyScheme(){
		
		$currdate  = date("Y-m-d");
		

		return $this->db->select("*")
						->where("'$currdate' > from_date and '$currdate' < to_date")
						->where("comp_id", $this->session->companey_id)
						->where("status", 1)
						->order_by("id DESC")
						->get("tbl_scheme")
						->result();	
		
	}
	
	public function getAllApplyscheme(){
	
		$schemes   =  $this->getApplyScheme();
		
		
		$applyschm = $schmarr = $prschemearr = array();
			
			$totdisc    = 0; 
			
			if(!empty($schemes)){
				
				$totdiscount  = 0;	
				$proddiscount = array();
				
				foreach($schemes as $ind => $sch){
							
					 $brandofr = $categofr = $subcategofr = $prodofr = array();
					 
					 if(!empty($sch->prdt_val)){
							
							$spcfval = (!empty($sch->prdt_val)) ? explode(",", $sch->prdt_val) : array();
							foreach($spcfval as $ind => $val) {
								
								$prschemearr[$sch->by_prdt.$val] = $sch;
							
							}	
								
					}else{
							$schmarr[$sch->coupan] = $sch;
					}
						

					
				}
			}
			//$prschemearr = array("brandofr" => $brandofr, "categofr" => $categofr, "subcategofr" => $subcategofr, "prodofr" => $prodofr);
			
			$newschmarr = array("prodscheme" => $prschemearr,
								"allscheme"  => $schmarr);
		
		return $newschmarr;
	}
	
	
public function get_pro_bybrand($id){

$this->db->select('id,pro_name');
$this->db->from('tbl_product');
$this->db->where('brand',$id);
return $this->db->get()->result();
}

public function insert($table,$data){

$this->db->insert($table,$data);
return $this->db->insert_id();

}

public function get_pro_scheme(){

	$this->db->select('*,tbl_scheme.id as sid');
	$this->db->from('tbl_scheme');
	$this->db->where('tbl_scheme.status','1');
	$this->db->where('tbl_scheme.scheme_type','1');
	return $this->db->get()->result();
}

public function get_region_scheme(){

	$this->db->select('*,tbl_scheme.id as sid');
	$this->db->from('tbl_scheme');
	$this->db->where('tbl_scheme.status','1');
	$this->db->where('tbl_scheme.scheme_type','2');
	return $this->db->get()->result();
}

public function get_payment_scheme(){

	$this->db->select('*,tbl_scheme.id as sid');
	$this->db->from('tbl_scheme');
	$this->db->where('tbl_scheme.status','1');
	$this->db->where('tbl_scheme.scheme_type','3');
	return $this->db->get()->result();
}

public function get_scheme_byid($id){

$this->db->select('*');
$this->db->from('tbl_scheme');
$this->db->where('id',$id);
return $this->db->get()->row();

}

public function getSchemeByCoupan($id){
	
	$this->db->select('*');
	$this->db->from('tbl_scheme');
	$this->db->where('coupan',$id);
	return $this->db->get()->result();
}

public function update($data,$id){

return $this->db->where('id',$id)->update('tbl_scheme',$data);

}

public function delete($id){

return $this->db->where('id',$id)->delete('tbl_scheme');

}
		public function cleandate($post){
		
		$pdate = $this->input->post($post, true);
		
		if(empty($pdate)) {
			return NULL;
		}
		$pdate = str_replace("/", "-", $pdate);
		
		$darr  = explode("-", $pdate); 
		
		return date("Y-m-d", strtotime($darr[2]."-".$darr[0]."-".$darr[1]));
		
	}
}
?>