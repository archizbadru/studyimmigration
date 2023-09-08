<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {
 public function __construct()
        {
               parent::__construct();
               $this->load->helper('url');
			   $this->load->helper('form');
               //$this->load->model('login_model');
               $this->load->model('dash_model');
               $this->load->model('Quize_model','quiz');
               $this->load->database();	
               $this->load->library('form_validation');	
               $this->load->library('session');
               if($this->session->user_id==''){
				$base=base_url();
	            redirect('login');   
			   }
        }

	public function index()
	{
	    $data['get_users']=$this->quiz->question_list();
	    $data['get_parameter']=$this->quiz->get_parameter();
		//$this->load->view('Quize/list-quize',$data);
		$data['content'] = $this->load->view('list-quize',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	
		public function add_questions(){
		    $data['title'] = 'Add Questions'  ;	
		if(!empty($_POST)){
		    	if(!empty($this->input->post('with_paragraph'))){
		    $with_paragraph=$this->input->post('with_paragraph');
		    	}else{$with_paragraph=0;}
		    		if($this->input->post('option')>0){
		   $option=$this->input->post('option');
		    	}else{ $option=4;}
		     
		      $Question_type=$this->input->post('Question_type');
		      //redirect('question');
		   redirect(base_url().'qbank/add-questions_'.$with_paragraph.'/'.$Question_type.'/'.$option); 
		}else{
		//$this->load->view('add-questions');
		$data['content'] = $this->load->view('add-questions',$data,true);
		$this->load->view('layout/main_wrapper',$data);
		}
		}
    
	public function add_qbank(){
	    $data['title'] = 'Add Options'  ;	
     if(!empty($_POST)){
       $q_id= $this->quiz->add_question();
        if($this->input->post('question_type')==1 || $this->input->post('question_type')==2 || $this->input->post('question_type')==3){
        $this->quiz->add_option($q_id);
        }
        $this->session->set_flashdata('success','Record Added Successfully');
     redirect(base_url().'add-questions');
      }else{
     //$this->load->view('add-options');
     $data['content'] = $this->load->view('add-options',$data,true);
		$this->load->view('layout/main_wrapper',$data);
    } 
    }
	
	
	public function assign_test(){
       $ip=$_SERVER['REMOTE_ADDR'];
       $option=implode(',',$this->input->post('user_status'));
       $parameter =$this->input->post('parameter');
         $num = $this->quiz->exist_parameter($parameter);
         if($num==0){
            $this->db->set('p_id',$this->input->post('parameter'));
	        $this->db->set('q_id',$option);
	        
			$this->db->set('created_date',date('Y-m-d'));
			$this->db->set('created_by',$this->session->user_id);
			$this->db->set('ip',$ip);
		   $this->db->insert('tbl_module');
		   echo 'success';
         }else{$array=array();
             $num1 =explode(',',$num);
             foreach($this->input->post('user_status') as $v){
                 
                 if(array_search($v,$array)){
                     
                 }else{
                 array_push($array,$v);   
                 }
              
             }
              $option=implode(',',$array);

	        $this->db->set('q_id',$option);
			$this->db->set('created_date',date('Y-m-d'));
			$this->db->set('created_by',$this->session->user_id);
			$this->db->where('p_id',$this->input->post('parameter'));
			$this->db->set('ip',$ip);
		   $this->db->update('tbl_module');
		   echo 'success';
         }
       
      
        }
	
	
	
	
	/*	public function quize_list()
	{
	    $data['get_quize']=$this->quiz->quize_list();
	   // $data['get_parameter']=$this->dash_model->get_parameter();
		$this->load->view('Quize/quize-list',$data);
	}
	
		public function satart_quiz()
	{
	   $data['get_quize']=$this->quiz->questions($this->uri->segment(2));
	   // $data['get_parameter']=$this->dash_model->get_parameter();
		$this->load->view('Quize/start-quize',$data);
	}
	 
    
     public function upload_questions(){
       $data = array(); 
         if(!empty($_FILES['file']['name'])){
        $config['upload_path'] = 'assets/files/'; 
         $config['allowed_types'] = 'csv'; 
         $config['max_size'] = '1000'; // max_size in kb 
         $config['file_name'] = $_FILES['file']['name'];
            $this->load->library('upload',$config); 
         if($this->upload->do_upload('file')){ 
            // Get data about the file
            $uploadData = $this->upload->data(); 
            $filename = $uploadData['file_name'];

            // Reading file
            $file = fopen("assets/files/".$filename,"r");
            $i = 0;
            $importData_arr = array();
           $option_array=array();
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
               $num = count($filedata );

               for ($c=0; $c < $num; $c++) {
                  $importData_arr[$i][] = $filedata [$c];
               }
               $i++;
            }
            fclose($file);

            $skip = 0;

            // insert import data
            foreach($importData_arr as $userdata){
               if($skip != 0){
        $q_id= $this->quiz->add_questions($userdata[0],$userdata[1],$userdata[2],$userdata[3],$userdata[4],$userdata[5]);
        if($userdata[5]==1 || $userdata[5]==2 || $userdata[5]==3){
        $this->quiz->add_options($q_id,$userdata[7],$userdata[8]);
        }  
               }
               $skip ++;
            }
        //print_r($importData_arr);
        unlink("assets/files/".$filename);
        $this->session->set_flashdata('success','Record Added Successfully');
        redirect(base_url().'upload-questions');
         }
          
     }else{ 
            $this->load->view('Quize/upload-question');
         } 
      
     }
     
     
       
     public function save_answer(){
         
     }*/
		
}