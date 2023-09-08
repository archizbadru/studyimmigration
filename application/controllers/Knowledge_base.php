<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Knowledge_base extends CI_Controller {
	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array(			
			'knowledge_base_model'			
		));
		  $this->load->helper('text');

		if(empty($this->session->user_id)){
		 redirect('login');   
		}
	}
 
	public function index(){
		$data['title'] = 'Knowledge base';
		#-------------------------------#	
		$data['content'] = $this->load->view('knowledge_base/index',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 
	public function get_kb_feed(){
		$articles = $this->knowledge_base_model->get_all_articles();				

		$feed = array();		
		if(!empty($articles)){
			foreach ($articles as $key => $value) {
				$feed[] = array('value'=>$value['id'],'label'=>$value['title']);
			}
		}
		echo json_encode($feed);

	}
	public function article_read($id){
		$data['title'] = 'Articles';
		#-------------------------------#			
		$data['articles_details']	=	$this->knowledge_base_model->get_article_by_id($id);						
		$data['content'] = $this->load->view('knowledge_base/read_articles',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

	public function articles(){
		$data['title'] = 'Articles';
		#-------------------------------#	

		$data['articles'] = $this->knowledge_base_model->get_all_articles();

		$data['content'] = $this->load->view('knowledge_base/articles',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

	public function create_article($id=0){
		$data['title'] = 'Created Articles';
		#-------------------------------#			
		if($id){
			$articles_details	=	$this->knowledge_base_model->get_article_by_id($id);						
			if(!$articles_details){
				echo "Not allowed here!";
			}else{
				$data['articles_details'] = $articles_details;
				$data['id'] = $id;
			}
		}
		$data['categories'] = $this->knowledge_base_model->get_all_category();		
		$data['content'] = $this->load->view('knowledge_base/create_article',$data,true);
		$this->load->view('layout/main_wrapper',$data);	
	}
	public function saved_articles(){	

		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[5]|max_length[120]');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required|min_length[5]|max_length[120]');
		$this->form_validation->set_rules('kb_category_id', 'Category', 'trim|required');
		//$this->form_validation->set_rules('for_all', 'Scope', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');

		if ($this->form_validation->run() == TRUE) {

			$title 			= $this->input->post('title');
			$slug 			= $this->input->post('slug');
			$category_id 	= $this->input->post('kb_category_id');
			$scope 			= $this->input->post('for_all');
			$status 		= $this->input->post('status');
			$description 	= $this->input->post('description');

			$insert_array   = array(									
									'title' => $title,
									'slug' => $slug,
									'comp_id' => $this->session->companey_id,
									'cat_id' => $category_id,
									'scope' => $scope,
									'status' => $status,
									'description' => $description,									
									'created_by' => $this->session->user_id
								);
			if($this->input->post('edit')){
				$this->db->where('id',$this->input->post('edit'));
				$r	=	$this->db->get('articles')->row_array();
				$attachment_array = 	json_decode($r['attachment'],true);
			}else{
				$attachment_array = array();
			}
			$this->load->library('upload');							
			/*echo "<pre>";
			print_r($_FILES);
			echo "</pre>";*/
			//var_dump($_FILES['kb_attachment']['name']);
			//exit();
			if($_FILES['kb_attachment']['name'][0]){
				/*var_dump($_FILES['kb_attachment']['name']);
				
				echo "string";				
				exit();*/

				$images = array();
				$config['upload_path'] 	 = './uploads/knowledge_base';
				$config['allowed_types'] =  'pdf|doc|docx|mp3|mp4|jpg|png|jpeg';
				$config['encrypt_name']  =  'TRUE';				
				$files = $_FILES['kb_attachment'];
				foreach ($files['name'] as $key => $image) {
			        $_FILES['kb_attachment[]']['name']= $files['name'][$key];
			        $_FILES['kb_attachment[]']['type']= $files['type'][$key];
			        $_FILES['kb_attachment[]']['tmp_name']= $files['tmp_name'][$key];
			        $_FILES['kb_attachment[]']['error']= $files['error'][$key];
			        $_FILES['kb_attachment[]']['size']= $files['size'][$key];
			        $fileName = $image;

			        $images[] = $fileName;

			        $config['file_name'] = $fileName;
			        $this->upload->initialize($config);
			        if ($this->upload->do_upload('kb_attachment[]')) {
			            $upload_data =	$this->upload->data();
						$attachment_array[] = base_url().'uploads/knowledge_base/'.$upload_data['file_name'];
			        } else {
			            $error = $this->upload->display_errors();
		            	$this->session->set_flashdata('exception',$error);
						redirect('knowledge_base/articles','refresh');
			        }
			    }
			}

			$insert_array['attachment'] = json_encode($attachment_array);


			/*
			if($_FILES['kb_attachment']['name']!=""){

				$config['upload_path'] 	 = './uploads/knowledge_base';
				$config['allowed_types'] =  'pdf|doc|docx';
				$config['encrypt_name']  =  'TRUE';
				
				$this->load->library('upload', $config);				

				if (!$this->upload->do_upload('kb_attachment')){
					$error = $this->upload->display_errors();
	            	$this->session->set_flashdata('exception',$error);
					redirect('knowledge_base/articles','refresh');
				}
				else{

					/*$this->db->select('attachment');
					$this->db->where('id',$this->input->post('edit'));
					$attachment	=	$this->db->get('articles')->row_array()['attachment'];
					unlink($attachment);*/
			/*		
					$upload_data = $this->upload->data();					
					$insert_array['attachment'] = base_url().'uploads/knowledge_base/'.$upload_data['file_name'];
				}
			}*/


			if($this->input->post('edit')){
				$this->db->where('id',$this->input->post('edit'));
				$insert_id	=	$this->db->update('articles',$insert_array);
				$msg 		= 'Article updated successfully';			
			}else{				
				$insert_id	=	$this->db->insert('articles',$insert_array);
				$msg = "Article Created successfully";
			}
			
			if($insert_id){				
				$this->session->set_flashdata('message', $msg);
			}else{
				$msg = "Something went wrong!";
				$this->session->set_flashdata('exception', $msg);				
				redirect('knowledge_base/create_article','refresh');
			}
		} else {
			$msg = validation_errors();
			$this->session->set_flashdata('exception', $msg);				
			redirect('knowledge_base/create_article','refresh');
		}
		redirect('knowledge_base/articles','refresh');
	}

	public function remove_article_file(){
		//print_r($_POST);
		$id	=	$this->input->post('id');
		$file_to_remove	=	$this->input->post('file_to_remove');
		$this->db->where('id',$id);
		$article_row	=	$this->db->get('articles')->row_array();		
		if (!empty($article_row)) {
			$attachment_array = json_decode($article_row['attachment'],true);
			if (($key = array_search($file_to_remove, $attachment_array)) !== false) {
			    unset($attachment_array[$key]);
			    $p = parse_url($file_to_remove);							    
				//echo $p['path'];				
			    unlink($_SERVER['DOCUMENT_ROOT'].$p['path']);
			}
			if(empty($attachment_array)){
				$attachment_array = '';
			}else{
				$attachment_array = json_encode($attachment_array);				
			}
			$this->db->where('id',$id);
			$this->db->update('articles',array('attachment'=>$attachment_array));
			
		}
		echo 1;
	}

	public function category(){
		$data['title'] = 'Category';
		#-------------------------------#	
		$data['categories'] = $this->knowledge_base_model->get_all_category();
		$data['content'] = $this->load->view('knowledge_base/category',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 
	
	public function saved_categories(){
		
		$this->form_validation->set_rules('category', 'Category', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');		

		if($this->form_validation->run() == TRUE) {			
			$name			=	$this->input->post('category');
			$description	=	$this->input->post('description');
			$status			=	$this->input->post('status');

			$insert_array = array(
				'name' 			=>$name,
				'description'	=>$description,
				'status'		=>$status,
				'comp_id' => $this->session->companey_id,
				'type'			=>1
			);
			if ($this->input->post('edit')) {
				$this->db->where('id',$this->input->post('edit'));
				$insert	=	$this->db->update('tbl_category',$insert_array);
				$msg = 'Category updated successfully';
			}else{
				$insert	=	$this->db->insert('tbl_category',$insert_array);
				$msg = 'Category created successfully';				
			}

			if($insert){
                $this->session->set_flashdata('message',$msg);				
			}else{
                $this->session->set_flashdata('exception','Something went wrong!');
			}
		} else {	
            $this->session->set_flashdata('exception',validation_errors());
		}
		redirect('Knowledge_base/category','refresh');
	}	
	public function delete_row(){

		$this->form_validation->set_rules('id','Id','required');
		$this->form_validation->set_rules('table','Table','required');

		if ($this->form_validation->run() == TRUE) {
			$id		=	$this->input->post('id');
			$table	=	$this->input->post('table');

			$this->db->where('id',$id);
			$row_array	=	$this->db->get($table)->row_array();
			if(!empty($row_array['attachment'])){
				$att = json_decode($row_array['attachment'],true);
				
				foreach ($att as $key => $value) {
					$p = parse_url($value);							    					
			    	unlink($_SERVER['DOCUMENT_ROOT'].$p['path']);
				}
				

			}



			$this->db->where('id',$id);
			if($this->db->delete($table)){

				echo 1;
			}else{
				echo 0;				
			}
		}else{
			echo 0;
		}
	}

	public function category_details(){
		$this->form_validation->set_rules('id','Id','required');		
		$res = array();		
		if ($this->form_validation->run() == TRUE) {
			$id	=	$this->input->post('id');
			$this->db->where('id',$id);
			$res = $this->db->get('tbl_category')->row_array();
		}
		echo json_encode($res);
	}

}