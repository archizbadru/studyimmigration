<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    private $table  = "language";
    private $phrase = "phrase";

    public function __construct()
    {
        parent::__construct();  
        $this->load->database();
        $this->load->dbforge(); 
        $this->load->helper('language');
        
     		$panel_menu = $this->db->select("modules")
    ->where('pk_i_admin_id',$this->session->user_id)
    ->get('tbl_admin')
    ->row();
        $module=explode(',',$panel_menu->modules);
		if (in_array(10,$module)){ 
		}else{
        
    } 

    public function index()
    {
        $data['content']      = $this->load->view('language/main',$data,true); 
        $this->load->view('layout/main_wrapper', $data);
    }

    public function phrase()
    {
        $data['languages']    = $this->languages();
        $data['content']      = $this->load->view('language/phrase',$data,true); 
        $this->load->view('layout/main_wrapper', $data);
    }
 

    public function languages()
    { 
        if ($this->db->table_exists($this->table)) { 

                $fields = $this->db->field_data($this->table);
				
                $i = 1;
                foreach ($fields as $field)
                {  
                    if ($i++ > 3)
                    $result[$field->name] = ucfirst($field->name);
                }

                if (!empty($result)) return $result;
 

        } else {
            return false; 
        }
    }


    public function addLanguage()
    { 
        $language = preg_replace('/[^a-zA-Z0-9_]/', '', $this->input->post('language',true));
        $language = strtolower($language);

        if (!empty($language)) {
            if (!$this->db->field_exists($language, $this->table)) {
                $this->dbforge->add_column($this->table, [
                    $language => [
                        'type' => 'TEXT'
                    ]
                ]); 
                $this->session->set_flashdata('message', 'Language added successfully');
                redirect('language');
            } 
        } else {
            $this->session->set_flashdata('exception', 'Please try again');
        }
        redirect('language');
    }


    public function editPhrase($language = null)
    { 
        $data['language'] = $language;
        $phrsearr  = $this->phrases($page, $filter);
        $data['content']  = $this->load->view('language/phrase_edit', $data, true); 
        $this->load->view('layout/main_wrapper', $data);

    }

    public function addPhrase() {  

        $lang   = $this->input->post('phrase'); 

        if (sizeof($lang) > 0) {

            if ($this->db->table_exists($this->table)) {

                if ($this->db->field_exists($this->phrase, $this->table)) {
					
                    foreach ($lang as $key => $value) {
                        $value = preg_replace('/[^a-zA-Z0-9_]/', '', $value);
                        $value = strtolower($value);

                        if (!empty($value)) {
                            $num_rows = $this->db->get_where($this->table,[$this->phrase => $value , "comp_id" =>  $this->session->companey_id ] )->num_rows();

                            if ($num_rows == 0) { 
                                $this->db->insert($this->table,[$this->phrase => $value, "english"  =>  $pvalue[$key] , "comp_id" =>  $this->session->companey_id]); 
                                $this->session->set_flashdata('message', 'Phrase added successfully');
                            } else {
                                $this->session->set_flashdata('exception', 'Phrase already exists!');
                            }
                        }   
                    }  

                    redirect('language/phrase');
                }  

            }
        } 

        $this->session->set_flashdata('exception', 'Please try again');
        redirect('language/phrase');
    }
 
    public function phrases($page, $filter)
    {
        if ($this->db->table_exists($this->table)) {

            if ($this->db->field_exists($this->phrase, $this->table)) {
			
            }  
        } 
        return false;
    }

    public function addLebel() { 
        $language = $this->input->post('language', true);
        $phrase   = $this->input->post('phrase', true);
        $lang     = $this->input->post('lang', true);
		$cmpno    = $this->session->companey_id;	
        if (!empty($language)) {
            if ($this->db->table_exists($this->table)) {

                if ($this->db->field_exists($language, $this->table)) {

                    if (sizeof($phrase) > 0)
                    foreach ($phrase as $i => $phars) {
					
                    }  
                    $this->session->set_flashdata('message', 'Label added successfully!');
                    redirect('language/editPhrase/'.$language);
                }  
            }
        } 

        $this->session->set_flashdata('exception', 'Please try again');
      //  redirect('language/editPhrase/'.$language);
    }
}



 