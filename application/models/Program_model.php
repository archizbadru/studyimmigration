<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Program_model extends CI_Model {
    
    public function query_result() {


         $layout = $this->session->userdata('layout');
		 $crs = $this->input->post('crs_id');
         $ins = $this->input->post('ins_id');
         $cntry = $this->input->post('cntry');
		 $dt = $this->input->post('date');
		 $discipline = $this->input->post('discipline');
		 $length = $this->input->post('length');
		 $level = $this->input->post('level');
		 $state = $this->input->post('state_id');
		 $ielts = $this->input->post('ielts');       


   	    $this->db->select("*,tbl_institute.institute_id as insid");
        $this->db->from('tbl_course');
        $this->db->join('tbl_institute','tbl_institute.institute_id=tbl_course.institute_id','left');
        $this->db->join('tbl_country','tbl_country.id_c=tbl_institute.country_id','left');
        $this->db->join('tbl_crsmaster','tbl_crsmaster.id = tbl_course.course_name');
        $this->db->order_by('tbl_course.institute_id','asc');
        //$this->db->where('tbl_course.comp_id',67);
        

		if($ins!=''){
		$this->db->where('tbl_course.institute_id', $ins);
		}
		if($cntry!=''){
		$this->db->where('tbl_institute.country_id', $cntry);
		}
		if($crs!=''){
		$this->db->where('tbl_course.crs_id', $crs);
		}
		if($length!=''){
		$this->db->where('tbl_course.length_id', $length);
		}
		if($level!=''){
		$this->db->where('tbl_course.level_id', $level);
		}
		if($discipline!=''){
		$this->db->where('tbl_course.discipline_id', $discipline);
		}
		if($state!=''){
		$this->db->where('tbl_institute.state_id', $state);
		}
		if($ielts!=''){
		$this->db->where('tbl_course.course_ielts', $ielts);
		}
        
        $comp_id = $this->session->companey_id;
        if ($comp_id) {
            $this->db->where('tbl_course.comp_id',$comp_id);
        }else{
            $this->db->where('tbl_course.comp_id',67);
        }
        if (!empty($_GET['keyword'])) {            
            $this->db->like('tbl_crsmaster.course_name', $_GET['keyword']);           
            $this->db->or_like('tbl_institute.institute_name', $_GET['keyword']);           
        }
        

        $this->db->order_by('tbl_course.crs_id','asc');
        $id    =   $this->input->post('id');
        if (empty($id)) {
        	$id = 0;
        }else{
        	$id = $id-1;
        } 
        $this->db->limit(12,$id);        

    }

    public function get_data(){
    	$this->query_result();
    	$q = $this->db->get()->result();
    	return $q;
    }    
    public function count_filtered_data(){
    	$this->query_result();
    	return $this->db->count_all_results();
    }
    public function count_all_data(){
    	$this->db->select("*,tbl_institute.institute_id as insid");
        $this->db->from('tbl_course');
        $this->db->join('tbl_institute','tbl_institute.institute_id=tbl_course.institute_id','left');
        $this->db->join('tbl_country','tbl_country.id_c=tbl_institute.country_id','left');
        $this->db->join('tbl_crsmaster','tbl_crsmaster.id = tbl_course.course_name');
        $this->db->order_by('tbl_course.institute_id','asc');
        $comp_id = $this->session->companey_id;
        if ($comp_id) {
            $this->db->where('tbl_course.comp_id',$comp_id);
        }else{
            $this->db->where('tbl_course.comp_id',67);
        }
        return $this->db->count_all_results();
    }
}