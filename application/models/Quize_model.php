<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quize_model extends CI_Model {
    public function question_list(){
		 $query1=$this->db->get('tbl_question');
		  return $query1->result();
  }
    
    
        public function get_parameter(){
        $this->db->select('*');
        $this->db->from('tbl_parameter');
        $this->db->join('tbl_admin', 'tbl_admin.pk_i_admin_id = tbl_parameter.create_by');
        $this->db->join('tbl_level', 'tbl_parameter.l_id = tbl_level.l_id');
        $this->db->join('tbl_competencies', 'tbl_competencies.c_id = tbl_parameter.c_id');
        return $this->db->get()->result();
        
        }
        
        public function add_question(){
     if($this->input->post('question_type')==2){

             $correct=implode(',',$this->input->post('correct'));  
        
        }
       if($this->input->post('question_type')==1){
          $correct=  $this->input->post('correct');  
        } 
        if($this->input->post('question_type')==4){
          $correct=  $this->input->post('correct');  
        }
        if($this->input->post('question_type')==5){
          $correct=  $this->input->post('correct');  
        }
        
   $ip=$_SERVER['REMOTE_ADDR'];
	        $this->db->set('q_question',$this->input->post('Question'));
	        if(!empty($this->input->post('Paragraph'))){
			$this->db->set('q_paragraph',$this->input->post('Paragraph'));
	        }
			$this->db->set('q_desc',$this->input->post('Discreption'));
			$this->db->set('q_marks',$this->input->post('marks_sccore'));
			$this->db->set('q_type',$this->input->post('question_type'));
			if(!empty($correct)){
			$this->db->set('correct_answer',$correct);
             }
			$this->db->set('created_date',date('Y-m-d'));
			$this->db->set('created_by',$this->session->user_id);
			$this->db->set('ip',$ip);
			$this->db->insert('tbl_question');
            return $this->db->insert_id();
 }
 
       
      public function exist_parameter($id){
       $this->db->select('*');
        $this->db->from('tbl_module');
       	$this->db->where('p_id',$id);
       	 $query1=$this->db->get();
       	 if($query1->num_rows()>0){
       	    return $query1->row()->q_id;  
       	 }else{
       	     return 0;
       	 }
		 
   }
    
/* 
 
 public function add_questions($value1,$value2,$value3,$value4,$value5,$value6){
            $ip=$_SERVER['REMOTE_ADDR'];
	        $this->db->set('q_question',$value1);
	        if(!empty($value2)){
			$this->db->set('q_paragraph',$value2);
	        }
	         if(!empty($value3)){
			$this->db->set('q_desc',$value3);
	         }
			$this->db->set('q_marks',$value5);
			$this->db->set('q_type',$value6);
			if(!empty($value4)){
			$this->db->set('correct_answer',$value4);
             }
			$this->db->set('created_date',date('Y-m-d'));
			$this->db->set('created_by',$this->session->is_admin_id);
			$this->db->set('ip',$ip);
			$this->db->insert('tbl_question');
            return $this->db->insert_id();
          }
 
  public function add_options($q_id,$value7,$value8){
           $ip=$_SERVER['REMOTE_ADDR'];
           $option=explode(',',$value7);
           if(!empty($value8)){
            $option1= explode(',',$value8);
            }
            $i=1;$j=0;
            foreach($option as $value){
            $this->db->set('q_id',$q_id);
	        $this->db->set('op_number',$i);
	        $this->db->set('op_name',$value);
	        if(!empty($option1)){
			$this->db->set('op_match',$option1[$j]);
	        }
			$this->db->set('created_date',date('Y-m-d'));
			$this->db->set('create_by',$this->session->is_admin_id);
			$this->db->set('ipaddress',$ip);
		    $this->db->insert('tbl_option');
            $i++;$j++; }
      
  }
 
 
  public function add_option($q_id){
       $ip=$_SERVER['REMOTE_ADDR'];
       $option=$this->input->post('option');
       if($this->input->post('option1')){
          $option1= $this->input->post('option1');
       }
        
      $i=1;$j=0;
      foreach($option as $value){
            $this->db->set('q_id',$q_id);
	        $this->db->set('op_number',$i);
	        $this->db->set('op_name',$value);
	        if($this->input->post('question_type')==3){
			$this->db->set('op_match',$option1[$j]);
	        }
			$this->db->set('created_date',date('Y-m-d'));
			$this->db->set('create_by',$this->session->is_admin_id);
			$this->db->set('ipaddress',$ip);
		    $this->db->insert('tbl_option');
     $i++;$j++; }
      
       }
           public function quize_list(){
            $this->db->select('*');
        $this->db->from('tbl_module');
       	$this->db->join('tbl_parameter', 'tbl_module.p_id = tbl_parameter.p_id');
       	 $query1=$this->db->get();
       	 if($query1->num_rows()>0){
       	    return $query1->result(); 
       	 }else{
       	     return 0;
       	 }   
           }
        public function  questions($id){
        $this->db->select('*');
        $this->db->from('tbl_module');
       	$this->db->where('p_id',$id);
       	$query1=$this->db->get();
       	$query=$query1->row()->q_id;
       	    $explode = explode(',',$query);
       	    $row_array1=array();$json_response=array();
       	   foreach($explode as $q_id){
       	$this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('q_id',$q_id);
       //	$this->db->join('tbl_option', 'tbl_option.q_id = tbl_question.q_id');  
       	  	$query1=$this->db->get()->result();
       	  	foreach($query1 as $Question){
       	  	$row_array1['q_id'] =$Question->q_id;
       	  	$row_array1['q_question'] =$Question->q_question;
       	  	$row_array1['q_paragraph'] =$Question->q_paragraph;
       	  	$row_array1['q_desc'] =$Question->q_desc;
       	  	$row_array1['correct_answer'] =$Question->correct_answer;
       	  	$row_array1['q_marks'] =$Question->q_marks;
       	  	$row_array1['q_type'] =$Question->q_type;
       	  	$row_array1['q_marks'] =$Question->q_marks;
       	  	$row_array1['q_marks'] =$Question->q_marks;
       	  	$row_array1['q_marks'] =$Question->q_marks;
       	  	$this->db->select('*');
            $this->db->from('tbl_option');
            $this->db->where('q_id',$Question->q_id);
       //	$this->db->join('tbl_option', 'tbl_option.q_id = tbl_question.q_id');  
       	  	$query1=$this->db->get()->result();
       	  	$row_array=array();$json_response2 = array(); 
       	  	foreach($query1 as $option){
       	  	   $row_array['op_name'] =$option->op_name; 
       	  	   $row_array['op_number'] =$option->op_number;
       	  	   $row_array['op_match'] =$option->op_match; 
       	  	  array_push($json_response2,$row_array);  
       	  	}
       	  	
       	  		$row_array1['sub'] = $json_response2;
       	  	array_push($json_response,$row_array1);
       	  	        
       	  	}
       	   	
       	  
       	       
       	   }
       	   return $json_response;
       	   }
           
           
     
 
  */
  
}