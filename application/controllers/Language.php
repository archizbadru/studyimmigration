<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    private $table  = "language";
    private $phrase = "phrase";	private $limit  = "100";

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
		}else{			//redirect('login');			}
        
    } 

    public function index()
    {		$data['languages']    = $this->languages();
        $data['content']      = $this->load->view('language/main',$data,true); 
        $this->load->view('layout/main_wrapper', $data);
    }

    public function phrase()
    {	//	$page   = (!empty($_GET['page'])) ? $_GET['page'] : 1;	//	$filter = (!empty($_GET['filter'])) ? $_GET['filter'] : false;
        $data['languages']    = $this->languages();			$phrsearr  = $this->phrases(0, "");		$newphrsarr = $temparr = array();				if(!empty($phrsearr["total"])){						//$data['total']  =  $phrsearr["total"];			//$data["page"]   = 0;			//$data["limit"]  = $this->limit;			unset($phrsearr["total"]);		} 					if(!empty( $phrsearr )){											$cmpno = $this->session->companey_id;			foreach( $phrsearr  as $ind => $phrs){																if($phrs->comp_id == $cmpno and $phrs->comp_id > 0){										$newphrsarr[$phrs->phrase] = $phrs;					$temparr[$phrs->phrase] = $phrs;				}else{					$newphrsarr[$phrs->phrase] =$phrs;				}					 				}					}			if(!empty($temparr)){						foreach($temparr as $ind => $phrs){								$newphrsarr[$phrs->phrase] = $phrs;			} 		}				$data['phrases']  = $newphrsarr; 		//$data['phrases']      = $newphsarr;
        $data['content']      = $this->load->view('language/phrase',$data,true); 		$data["compnno"]   = $cmpno;
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
    { 		$page   = (!empty($_GET['page'])) ? $_GET['page'] : 1;		$filter = (!empty($_GET['filter'])) ? $_GET['filter'] : false;	
        $data['language'] = $language;
        $phrsearr  = $this->phrases($page, $filter);		if(!empty($phrsearr["total"])){						$data['total']  =  $phrsearr["total"];			$data["page"]   = $page;			$data["limit"]  = $this->limit;			unset($phrsearr["total"]);		} 					$newphrsarr = $temparr = array();		if(!empty( $phrsearr )){						$cmpno = $this->session->companey_id;			foreach( $phrsearr  as $ind => $phrs){																if($phrs->comp_id == $cmpno and $phrs->comp_id > 0){										$temparr[$phrs->phrase] = $phrs;					$newphrsarr[$phrs->phrase] =$phrs;				}else{					$newphrsarr[$phrs->phrase] =$phrs;				}					 				}					}			if(!empty($temparr)){						foreach($temparr as $ind => $phrs){								$newphrsarr[$phrs->phrase] = $phrs;			} 		}				$data['phrases']  = $newphrsarr; 		$data['filter']   = $filter;
        $data['content']  = $this->load->view('language/phrase_edit', $data, true); 
        $this->load->view('layout/main_wrapper', $data);

    }

    public function addPhrase() {  

        $lang   = $this->input->post('phrase'); 		$pvalue = $this->input->post("value", true);	

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
    {		$limit  = $this->limit;		$offset = ($page - 1) * $limit; 		$lmtpart = "";		if(!empty($page) and $page > 0){						$lmtpart = " LIMIT {$offset} , {$limit}";		}
        if ($this->db->table_exists($this->table)) {

            if ($this->db->field_exists($this->phrase, $this->table)) {				$cmpno = $this->session->companey_id;
							if(!empty($cmpno) and $cmpno > 0){										$ordby = "desc";					$cmpno = " OR comp_id = '$cmpno'";									}else{					$ordby = "asc";					$cmpno = "";				}				$qpart = "";				if(!empty($filter)){										$filter = strtolower($filter);										$fields = $this->db->field_data($this->table);					$qpart  = "AND (";					foreach($fields as $ind => $fld){												if($ind > 1){							$qpart .= $fld->name ." LIKE '%".$filter."%' OR ";						}					}					$qpart = trim($qpart, " OR ");					$qpart .= ")";								}			$qry = "SELECT  * FROM $this->table WHERE (comp_id = '0' {$cmpno} ) {$qpart} ORDER BY  id desc, comp_id $ordby $lmtpart";											$resarr = $this->db->query($qry)->result();								$qry = "SELECT  * FROM $this->table WHERE (comp_id = '0' {$cmpno}) {$qpart}  ORDER BY  id desc";								$resarr["total"] = $this->db->query($qry)->num_rows();					return $resarr;
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
                    foreach ($phrase as $i => $phars) {						if(!empty($cmpno) and $cmpno > 0){														$phrs = $phrase[$i];							$lval = $lang[$i];																		$cmpno = $this->session->companey_id;								if(!empty($cmpno) and $cmpno > 0){										$ord = 'desc';					}else{					$ord = 'asc';										}														$qry  = "SELECT * FROM `language` WHERE (comp_id = '$cmpno' OR comp_id = '0') AND $this->phrase = '$phrs' ORDER BY comp_id $ord";														$lng = $this->db->query($qry)->row(); 														if($lng -> english ==  $lang[$i]){																continue;							}else{																if($lng->comp_id == $cmpno){																		$this->db->where(array("id" => $lng->id, "comp_id" => $cmpno) );																	 $this->db->update('language', array($language =>  $lang[$i]));																	}else{									$this->db->insert('language', array($this->phrase => $phrs, $language =>  $lang[$i], "comp_id" => $cmpno));								}															}												}else{													$this->db->where(array("id" => $i))										->set($language,$lang[$i])								->update($this->table); 						}
																				$ret = $this->db->affected_rows();				
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



 