<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Enq extends CI_Controller {
    public function __construct() {
        parent::__construct();
       
         $this->load->model(
                array('enquiry_model','Taskstatus_model','location_model','User_model','dash_model','common_model','report_model','Leads_Model','apiintegration_Model')
                );
        $this->load->library('email');
		$this->load->library('pagination');
        $this->load->library('user_agent');
		$this->lang->load("activitylogmsg","english");
        if (empty($this->session->user_id)) {
            redirect('login');
        }
		
    } 

    // public function test(){
    // 	print_r($this->session->process);
    // }
    public function index($all='') {
	
        if (user_role('60') == true) {} 
        $this->load->model('Datasource_model'); 
        
        $data['sourse'] = $this->report_model->all_source();
		$data['datasourse'] = $this->report_model->all_datasource();
		$data['lead_score'] = $this->enquiry_model->get_leadscore_list();		
		$data['dfields']  = $this->enquiry_model-> getformfield();
		
		$data['data_type'] = 1;		
        $this->session->unset_userdata('enquiry_filters_sess');        
        if(!empty($this->session->enq_type)){
			$this->session->unset_userdata('enq_type',$this->session->enq_type);
		}		
        
        $data['title'] = display('enquiry_list');

        $data['subsource_list'] = $this->Datasource_model->subsourcelist();		
		$data['user_list'] = $this->User_model->read2();
		$data['all_branch'] = $this->Leads_Model->branch_select();
        $data['all_department'] = $this->Leads_Model->dept_select();
		$data['created_bylist'] = $this->User_model->read2();
        $data['products'] = $this->dash_model->get_user_product_list();
        $data['drops'] = $this->enquiry_model->get_drop_list();	
        $type = 1;
        $data['filterData'] = $this->common_model->get_filterData(1);	
	    $data['all_stage_lists'] = $this->Leads_Model->find_stage($type);
	    //print_r($data['all_stage_lists']);

	    $data['prodcntry_list'] = $this->enquiry_model->get_user_productcntry_list();
	    $data['state_list'] = $this->enquiry_model->get_user_state_list();
	    $data['city_list'] = $this->enquiry_model->get_user_city_list();

	    $data['allcountry_list'] = $this->Taskstatus_model->countrylist();
	    $data['all_country_list'] = $this->location_model->country();
	    $data['visa_type'] = $this->Leads_Model->visa_type_select();
		$data['tags'] = $this->enquiry_model->get_tags();
        $data['content'] = $this->load->view('enquiry_n', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    public function ___enq_load_data(){

    	$this->load->model('enquiry_datatable_model');

        $list = $this->enquiry_datatable_model->get_datatables();
       // echo $this->db->last_query();
        $data = array();

        $no = $_POST['start'];
		
		$acolarr = $dacolarr = array();
		if(isset($_COOKIE["allowcols"])) {
			$showall = false;
			$acolarr  = explode(",", trim($_COOKIE["allowcols"], ","));
			
		}else{
			
			$showall = true;
		} 	
		if(isset($_COOKIE["dallowcols"])) {
			$dshowall = false;
			$dacolarr  = explode(",", trim($_COOKIE["dallowcols"], ","));
		
		}
			$enqarr = array();
			foreach ($list as $each) {
				
				$enqarr[] = $each->enquiry_id;
			}
			if(!empty($enqarr) and !empty($dacolarr)) {
		//    $fieldval =  $this->enquiry_model->getfieldvalue($enqarr);
		//	$dfields  = $this->enquiry_model-> getformfield();
			}
		
        foreach ($list as $each) {
        
            $no++;
        
            $row = array();
        
            $row[] = "<input onclick='event.stopPropagation();'' type='checkbox' name='enquiry_id[]'' class='checkbox1' value=".$each->enquiry_id.">";
			if($_POST['data_type'] == 1){
				$url= base_url('enquiry/view/').$each->enquiry_id;
			}else if ($_POST['data_type'] == 2) {
				$url= base_url('lead/lead_details/').$each->enquiry_id;				
			}else if ($_POST['data_type'] == 3) {
				$url= base_url('client/view/').$each->enquiry_id;								
			}

				$row[] = '<a href="'.$url.'">'.$no/*$each->enquiry_id*/.'</a>';
				if ($showall == true or in_array(1, $acolarr)) { 
					  
						  $row[] = (!empty($each->lead_name)) ? ucwords($each->lead_name) : "NA";
					   
				}
				/*if ($showall == true or in_array(2, $acolarr)) { 
						$row[] = $each->company;
				}*/
				if ($showall == true or in_array(3, $acolarr)) {
				$thtml = '';
			    if(!empty($each->tag_ids)){
					$this->db->select('title,color');
					$this->db->where("id IN(".$each->tag_ids.")");
					$tags = $this->db->get('tags')->result_array();
					if(!empty($tags)){
						foreach ($tags as $key => $value) {
							$thtml .= '<br><a class="badge" href="javascript:void(0)" style="background:'.$value['color'].';padding:4px;">'.$value['title'].'</a>';
						}
					}

					if(!empty($each->lead_stage_name)){
							$thtml .= '<br><a class="badge" href="javascript:void(0)" style="background:#9B59B6;color:#fffff;padding:4px;">'.$each->lead_stage_name.'</a>';
					}
				}
				$row[] = '<a href="' . $url . '">' . $each->name_prefix . " " . $each->name . " " . $each->lastname. '</a>'.$thtml;
			}
				/*if ($showall == true or in_array(3, $acolarr)) { 
                $row[] = '<a href="'.$url.'">'.$each->name_prefix . " " . $each->name . " " . $each->lastname.'</a>';
				}*/
				if ($showall == true or in_array(4, $acolarr)) { 
                $row[] = $each->email;
            //user_access(220)?'onclick=send_parameters('+$enquiry->phone+')':''
				}
				if ($showall == true or in_array(5, $acolarr)) { 
            if(user_access(790) || user_access(791) || user_access(792) || user_access(793) || user_access(794) || user_access(795) || user_access(796) || user_access(796)){
            	$p = substr($each->phone, -10);
            	$row[] = "<a href='javascript:void(0)' onclick='send_parameters(".$p.")'>".$p."</a>";            	
            }else{
            	$row[] = $p;
            }
				}
				if ($showall == true or in_array(6, $acolarr)) { 
            $row[] = $each->address;
				}
				if ($showall == true or in_array(7, $acolarr)) { 
            $row[] = $each->product_name;
				}
				if ($showall == true or in_array(8, $acolarr)) { 
            if ($each->lead_stage_name) {
            	$option = '<option value="'.$each->lead_stage_name.'">'.$each->lead_stage_name.'</option>';
            }else{
            	$option = '<option value="0">Select Disposition</option>';
            }
		
            $row[] = '<select class="form-control change_dispositions" style="height: 11px;width: 97%;font-size: smaller;padding: 4px;" data-id='.$each->enquiry_id.'>'.$option.'</select>';
				}
          /*  if($_POST['data_type'] == 2){
            	$row[] = $each->tbro_date;
            }*/


			if ($this->session->companey_id == 29) {
				$row[] = $each->reference_name;
			}
      
			if ($showall == true or in_array(10, $acolarr)) { 
            $row[] = $each->created_date;
			}
			if ($showall == true or in_array(11, $acolarr)) { 
            $row[] = $each->created_by_name;
			}
			if ($showall == true or in_array(12, $acolarr)) { 
            $row[] = $each->assign_to_name;
			}
			if ($showall == true or in_array(13, $acolarr)) { 
            $row[] = $each->datasource_name;
			}
			
			if ($showall == true or in_array(18, $acolarr)) { 
            $row[] = $each->score;
			}
			if ($showall == true or in_array(19, $acolarr)) { 
            $row[] = $each->enquiry;
			}
			if ($showall == true or in_array(17, $acolarr)) { 
            $row[] = $each->EnquiryId;
			}

       
			$enqid = $each->enquiry_id;
			
			if(!empty($dacolarr) and !empty($dfields)){
							
				foreach($dfields as $ind => $flds){
					
					if(in_array($flds->input_id, $dacolarr )){
						
						$row[] = (!empty($fieldval[$enqid][$flds->input_id])) ? $fieldval[$enqid][$flds->input_id]->fvalue : "";	
					}
					
				}
				
			}
			
	/*		if(!empty($dacolarr)){
				
				foreach($dacolarr as $ind => $col){
					
					if(!empty($fieldval[$enqid][$col])){
						
						 $row[] = $fieldval[$enqid][$col]->fvalue;
					}
					
				}
				
			} */
			
            $data[] = $row;

            

        }      
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->enquiry_datatable_model->count_all(),
            "recordsFiltered" => $this->enquiry_datatable_model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function enq_load_data(){
		$country=$this->db->where('comp_id',$this->session->companey_id)->get('tbl_country')->result();
    	$this->load->model('enquiry_datatable_model');
        $list = $this->enquiry_datatable_model->get_datatables();
		//fetch country

        /*echo "<pre>";
        print_r($list);
        echo "</pre>";*/

        $dfields = $this->enquiry_model->getformfield();       
        $data = array();
        $no = $_POST['start'];		
		$acolarr = $dacolarr = array();
		if(isset($_COOKIE["allowcols"])) {
			$showall = false;
			$acolarr  = explode(",", trim($_COOKIE["allowcols"], ","));			
		}else{			
			$showall = true;
		} 	 
		if(isset($_COOKIE["dallowcols"])) {
			$dshowall = false;
			$dacolarr  = explode(",", trim($_COOKIE["dallowcols"], ","));		
		}
		if(!empty($enqarr) and !empty($dacolarr)) {
		}
		$fieldval =  $this->enquiry_model->getfieldvalue();
        foreach ($list as $each) { 
			$preferred_country='';
			if(!empty($each->preferred_country)){
				$countrys=explode(',',$each->preferred_country);
				foreach ($country as $key => $value) {
					 if(in_array($value->id_c,$countrys)){
						 $preferred_country.=$value->country_name.' ,';
					 }
				}
			}
			
            $no++;        
            $row = array();        
            $row[] = "<input onclick='event.stopPropagation();'' type='checkbox' name='enquiry_id[]'' class='checkbox1' value=".$each->enquiry_id.">";
			if($_POST['data_type'] == 1){
				$url= base_url('enquiry/view/').$each->enquiry_id;
			}else if ($_POST['data_type'] == 2) {
				$url= base_url('lead/lead_details/').$each->enquiry_id;				
			}else if ($_POST['data_type'] == 3) {
				$url= base_url('client/view/').$each->enquiry_id;								
			}else if ($_POST['data_type'] == 4) {
				$url= base_url('refund/view/').$each->enquiry_id;								
			}else{
				$url= base_url('refund/view/').$each->enquiry_id.'?stage='.$_POST['data_type'];
			}		

			$row[] = '<a href="'.$url.'">'.$no/*$each->enquiry_id*/.'</a>';
			
			if ($showall == true or in_array(32, $acolarr)) { 													
					$hh = '';
					
                    $assign = $this->db->query("SELECT assign_id FROM tbl_assign_notification WHERE CAST(tbl_assign_notification.assign_date as DATE) = '".date('Y-m-d')."' AND tbl_assign_notification.enq_code='".$each->Enquery_id."'")->result();

                    $new = $this->db->query("SELECT enquiry_id FROM enquiry WHERE CAST(enquiry.created_date as DATE) = '".date('Y-m-d')."' AND enquiry.Enquery_id='".$each->Enquery_id."'")->result();

                    $untouch = $this->db->query("SELECT assign_id FROM tbl_assign_notification WHERE tbl_assign_notification.untouch = '1' AND tbl_assign_notification.enq_code='".$each->Enquery_id."'")->result();

                    $upcoming = $this->db->query("SELECT resp_id FROM query_response WHERE STR_TO_DATE(task_date,'%d-%m-%Y') > '".date('Y-m-d')."' AND query_response.noti_read=0 AND query_response.task_status!=2 AND query_response.notification_id!='' AND query_response.query_id='".$each->Enquery_id."'")->result();

                    $today = $this->db->query("SELECT resp_id FROM query_response WHERE STR_TO_DATE(task_date,'%d-%m-%Y') = '".date('Y-m-d')."' AND query_response.noti_read=0 AND query_response.task_status!=2 AND query_response.notification_id!='' AND query_response.query_id='".$each->Enquery_id."'")->result();

                    $overdue = $this->db->query("SELECT resp_id FROM query_response WHERE STR_TO_DATE(task_date,'%d-%m-%Y') < '".date('Y-m-d')."' AND query_response.noti_read=0 AND query_response.task_status!=2 AND query_response.notification_id!='' AND query_response.query_id='".$each->Enquery_id."'")->result();
                    
					if(!empty($assign)) {
		                  $hh .= '<a class="badge" href="javascript:void(0)" style="background:#DE3163;padding:4px;">Assign Today</a>';
		                   }
		                if(!empty($untouch)) { 
		                  $hh .= '<a class="badge" href="javascript:void(0)" style="background:#FF7F50;padding:4px;">Untouch</a>';
		                }
		                if(!empty($upcoming)) { 
		                  $hh .= '<a class="badge" href="javascript:void(0)" style="background:#58d68d;padding:4px;">Upcoming task-'.count($upcoming).'</a>';
		                   } 
		                if(!empty($today)) { 
		                  $hh .= '<a class="badge" href="javascript:void(0)" style="background:#5dade2;padding:4px;">Today task-'.count($today).'</a>';
		                }
		                if(!empty($overdue)) { 
		                  $hh .= '<a class="badge" href="javascript:void(0)" style="background:#e74c3c;padding:4px;">Overdue task-'.count($overdue).'</a>';
		                }

		                if(!empty($new)) { 
		                  $hh .= '<a class="badge" href="javascript:void(0)" style="background:#439ffc;padding:4px;">Fresh</a>';
		                }

		            $row[] = (!empty($hh)) ? $hh : "NA";
				}

			if ($showall == true or in_array(1, $acolarr)) { 				  
				$row[] = (!empty($each->lead_name)) ? ucwords($each->lead_name) : "NA";				  
			}

			if ($showall == true or in_array(16, $acolarr)) { 				  
				$row[] = (!empty($each->subsource_name)) ? ucwords($each->subsource_name) : "NA";				  
			}
			/*if ($showall == true or in_array(2, $acolarr)) { 
				$row[] = (!empty(trim($each->company))) ? ucwords($each->company) : "NA";
			}*/

			if ($showall == true or in_array(3, $acolarr)) {
				$thtml = '';
			    if(!empty($each->tag_ids)){
					$this->db->select('title,color');
					$this->db->where("id IN(".$each->tag_ids.")");
					$tags = $this->db->get('tags')->result_array();
					if(!empty($tags)){
						foreach ($tags as $key => $value) {
							$thtml .= '<br><a class="badge" href="javascript:void(0)" style="background:'.$value['color'].';padding:4px;">'.$value['title'].'</a>';
						}
					}
				}
				if(!empty($each->lead_stage_name)){
							$thtml .= '<br><a class="badge" href="javascript:void(0)" style="background:#9B59B6;color:#fffff;padding:4px;">Disp - '.$each->lead_stage_name.'</a>';
				}
				$row[] = '<a href="' . $url . '">' . $each->name_prefix . " " . $each->name . " " . $each->lastname. '</a>'.$thtml;
			}
			/*if ($showall == true or in_array(3, $acolarr)) { 
				$row[] = '<a href="'.$url.'">'.$each->name_prefix . " " . $each->name . " " . $each->lastname.'</a>';
			}*/
			if ($showall == true or in_array(4, $acolarr)) { 
				$row[] = (!empty($each->email)) ? $each->email : "NA";			
			}
			if ($showall == true or in_array(5, $acolarr)) { 
				//$p = $each->phone;
				$p = substr($each->phone, -10);
				$p1 = substr($each->phone, -10);
				if (user_access(450)) {
					$p1 = '##########';
				}
				if(user_access(790) || user_access(791) || user_access(792) || user_access(793) || user_access(794) || user_access(795) || user_access(796) || user_access(796)){
            	
					
					$row[] = "<a href='javascript:void(0)' onclick='send_parameters(".$p.")'>".$p1." <button class='fa fa-phone btn btn-xs btn-success'></button></a>";           	
				}else{
					$row[] = (!empty($p)) ? '<a  href="tel:'.$p.'">'.$p1.'</a>' : "NA";
				}
			}
			if ($showall == true or in_array(6, $acolarr)) { 
				$row[] = (!empty(trim($each->address))) ? ucwords($each->address) : "NA";
			}
			if ($showall == true or in_array(7, $acolarr)) { 
				$row[] = (!empty($each->product_name)) ? ucwords($each->product_name) : "NA";
			}
			if ($showall == true or in_array(8, $acolarr)) { 
				if ($each->lead_stage_name) {
					$option = '<option value="'.$each->lead_stage_name.'">'.ucwords($each->lead_stage_name).'</option>';
				}else{
					$option = '<option value="0">Select Disposition</option>';
				}
					$row[] = '<select class="form-control change_dispositions" style="height: 11px;width: 60%;font-size: smaller;padding: 4px;" data-id='.$each->enquiry_id.'>'.$option.'</select>';
			}
			    
			if ($showall == true or in_array(10, $acolarr)) { 
            	$row[] = (!empty($each->created_date)) ? $each->created_date : "NA";
			}
			$c = array();
			$c1 = array();
			$d = array();
        	if (!empty($each->t)) {
        		$b = $each->t;
        		$c	=	explode('_', $b);        		
        		if (!empty($c[0])) {
        			$u	=	explode('#', $c[0]);
        			$d[]	=	$u[0];
        			$c1[]	=	$u[1];
        		}
        		if (!empty($c[1])) {
        			$u	=	explode('#', $c[1]);
        			$d[]	=	$u[1];
        			$c1[]	=	$u[1];        			
        		}
        	}
			if ($showall == true or in_array(11, $acolarr)) { 

            	$a = (!empty($each->created_by_name)) ? ucwords($each->created_by_name) : "NA";            	
            	if (empty($c1[0]) || $c1[0] == 2) {
            		$row[] = $a.'<a class="tag">NEW</a>';            		
            	}else{
            		$row[] = $a;            		            		
            	}

			}
			if ($showall == true or in_array(12, $acolarr)) { 
            	$a = (!empty($each->assign_to_name)) ? ucwords($each->assign_to_name) : "NA";
            	if ((empty($c1[1]) || $c1[1] == 2) && !in_array($each->aasign_to, $d)) {
            		if ($a != 'NA') {
            			$row[] = $a.'<a class="tag">NEW</a>';            		            			
            		}else{
            			$row[] = $a;            		            		
            		}
            	}else{
            		$row[] = $a;            		            		
            	}            	
			}
			if ($showall == true or in_array(13, $acolarr)) { 
            	$row[] = (!empty($each->datasource_name)) ? ucwords($each->datasource_name) : "NA";
			}
			if ($showall == true or in_array(14, $acolarr)) { 
            	$row[] = (!empty($each->country_name)) ? ucwords($each->country_name) : "NA";
			}	
		
			if ($showall == true or in_array(17, $acolarr)) { 
				$row[] = (!empty($each->Enquery_id)) ? $each->Enquery_id : "NA";			
			}
			 if ($showall == true or in_array(18, $acolarr)) { 
				$row[] = (!empty($each->score)) ? $each->score : "NA";			
			}
			 if ($showall == true or in_array(19, $acolarr)) { 
				$row[] = (!empty($each->enquiry)) ? $each->enquiry : "NA";			
			}
			if ($showall == true or in_array(20, $acolarr)) { 
				$row[] = (!empty($each->lead_name)) ? $each->lead_name : "NA";			

				}
				if ($showall == true or in_array(21, $acolarr)) { 
				$row[] = (!empty($each->city)) ? $each->city : "NA";			

					}
					if ($showall == true or in_array(22, $acolarr)) { 
				$row[] = (!empty($each->state)) ? $each->state : "NA";			

						}


				if ($showall == true or in_array(23, $acolarr)) {
				$row[] = (!empty($each->rcName)) ? $each->rcName : "NA";			

							}	
				if ($showall == true or in_array(24, $acolarr)) { 
				$row[] = (!empty($each->b_name)) ? $each->b_name : "NA";			

								}
				if ($showall == true or in_array(25, $acolarr)) { 
				$row[] = (!empty($each->in_take)) ? $each->in_take : "NA";			

									}
				if ($showall == true or in_array(26, $acolarr)) { 										
				$row[] = (!empty($preferred_country)) ? $preferred_country : "NA";			

										}
				if ($showall == true or in_array(31, $acolarr)) { 			
				$row[] = (!empty($each->final_country)) ? $each->final_country : "NA";			

										}
				if ($showall == true or in_array(27, $acolarr)) { 
				$row[] = (!empty($each->visa_type_name)) ? $each->visa_type_name : "NA";			

											}
				if ($showall == true or in_array(28, $acolarr)) { 
				$row[] = (!empty($each->ncountry_name)) ? $each->ncountry_name : "NA";			

												}
				if ($showall == true or in_array(29, $acolarr)) { 
				$row[] = (!empty($each->age)) ? $each->age : "NA";			

													}
				if ($showall == true or in_array(30, $acolarr)) { 													
				$row[] = (!empty($each->marital_status)) ? $each->marital_status : "NA";			

														}
				
           	$enqid = $each->enquiry_id;			
			if(!empty($dacolarr) and !empty($dfields)){
				foreach($dfields as $ind => $flds){					
					if(in_array($flds->input_id, $dacolarr )){						
						$row[] = (!empty($fieldval[$enqid][$flds->input_id])) ? $fieldval[$enqid][$flds->input_id]->fvalue : "NA";	
					}					
				}				
			}
            $data[] = $row;
        }      
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->enquiry_datatable_model->count_all(),
            "recordsFiltered" => $this->enquiry_datatable_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

   
// this is not being  used
    public function index1($all='') {
        if (user_role('60') == true) {}  
         if(!empty($this->session->enq_type)){
			$this->session->unset_userdata('enq_type',$this->session->enq_type);
		}		
        $data['title'] = display('enquiry_list');
		$data['user_list'] = $this->User_model->read();
		$data['drops'] = $this->enquiry_model->get_drop_list();
		$data['lead_score'] = $this->enquiry_model->get_leadscore_list();
		$record=0;
		$num_of_rows = 30;

		$recordPerPage =$num_of_rows;
		  
		$data['all_active'] = $this->enquiry_model->active_enqueries('0', '*');
      	$recordCount = $data['all_active']->num_rows();
		$empRecord = $this->enquiry_model->active_enqueries($record,$recordPerPage);
	//	print_r($this->db->last_query());exit();
		$type = 0;

      	$config['base_url'] = base_url().'enq/loadData'.$num_of_rows.'/'.$type;
      	
      	$config['use_page_numbers'] = TRUE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['empData'] = $empRecord->result();
        $data['content'] = $this->load->view('enquiry', $data, true);
        $this->load->view('layout/main_wrapper', $data);
        }
	public function loaddata($num_of_rows=30,$type,$record) {
		//echo $type;
		if(isset($type) && !empty($type)){
		//	echo $type.'inner';
			$this->session->set_userdata('enq_type',$type);
		}else{
			$this->session->unset_userdata('enq_type');
		}			
		$data['all_active'] = $this->enquiry_model->active_enqueries('0', '*');
      	$recordCount = $data['all_active']->num_rows();

	    if ($num_of_rows == 'all') {
	    	$num_of_rows = $recordCount;
	    }
	    
	    $recordPerPage = $num_of_rows;
		
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  
		//echo $this->db->last_query();
		$empRecord = $this->enquiry_model->active_enqueries($record,$recordPerPage);
		/*echo "session type:".$this->session->userdata('enq_type');*/
		/*
		echo "<pre>";
		echo $this->db->last_query();
		echo "</pre>";*/

		//$curr_page = intdiv($recordPerPage,$recordCount);
      	
      	$config['base_url'] = base_url().'enq/loadData/'.$num_of_rows.'/'.$type;
      	
      	$config['use_page_numbers'] = TRUE;
		
		$config['next_link'] = 'Next';
		
		$config['prev_link'] = 'Previous';
		
		$config['total_rows'] = $recordCount;
		
		$config['per_page'] = $recordPerPage;		
		
		/*$config['page_query_string'] = TRUE;
	    
	    $config['uri_segment'] = 2;*/


		//print_r($config);

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();

		$data['empData'] = $empRecord->result_array();
		
		/*echo "<pre>";
		print_r($data['empData']);
		echo "<pre>";*/

	 	echo json_encode($data);
	}
	   	public function stages_of_enq($data_type=1){
	     $data['all_enquery_num'] = $this->enquiry_model->all_enquery($data_type);        
         $data['all_drop_num'] = $this->enquiry_model->all_drop($data_type);
         $data['all_active_num'] = $this->enquiry_model->active_enqueries($data_type);         
         $data['all_today_update_num'] = $this->enquiry_model->all_today_update($data_type);
         $data['all_creaed_today_num'] = $this->enquiry_model->all_creaed_today($data_type);        
	     echo json_encode($data);
		}
		public function count_stages($data_type=2){
		
       		$all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);

		   $user_id   = $this->session->user_id;
	       $user_role = $this->session->user_role;
	       $assign_country = $this->session->country_id;
	       $assign_region = $this->session->region_id;
	       $assign_territory = $this->session->territory_id;
	       $assign_state = $this->session->state_id;
	       $assign_city = $this->session->city_id;
			$where='';

        	$enquiry_filters_sess    =   $this->session->enquiry_filters_sess;
			$top_filter     = !empty($enquiry_filters_sess['top_filter'])?$enquiry_filters_sess['top_filter']:'';        



			if($top_filter=='all'){    
	        }elseif($top_filter=='droped'){
	            $where.="  enquiry.drop_status>0";
	        }elseif($top_filter=='created_today'){
	            $date=date('Y-m-d');
	            $where.="enquiry.created_date LIKE '%$date%'";
	            $where.=" AND enquiry.drop_status=0";
	        }elseif($top_filter=='updated_today'){
	            $date=date('Y-m-d');
	            $where.="  enquiry.update_date LIKE '%$date%'";        
	            $where.=" AND enquiry.drop_status=0";
	        }elseif($top_filter=='active'){	            
	            $where.="  enquiry.drop_status=0";
	        }else{                        
	            $where.="  enquiry.drop_status=0";
	        } 

	        if(!empty($where)){
	        	$where .= " AND enquiry.status=2 ";
	        }else{
	        	$where .= " enquiry.status=2 ";	        	
	        }


			$where .= " AND ( enquiry.created_by IN (".implode(',', $all_reporting_ids).')';
        	$where .= " OR enquiry.aasign_to IN (".implode(',', $all_reporting_ids).'))'; 


			$enquiry_filters_sess    =   $this->session->enquiry_filters_sess;       
	        
	        $product_filter = !empty($enquiry_filters_sess['product_filter'])?$enquiry_filters_sess['product_filter']:'';

	        if(!empty($this->session->process) && empty($product_filter)){           
	        $arr = $this->session->process;  
	        if (is_array($arr)) {
	            $where.=" AND enquiry.product_id IN (".implode(',', $arr).')';	           	
	        }   
	        }else if (!empty($this->session->process) && !empty($product_filter)) {
	            $where.=" AND enquiry.product_id IN (".implode(',', $product_filter).')';            
	        }
	        
	        $this->db->select('lead_stage,count(lead_stage) as c');
	        $this->db->from('enquiry');
	        $this->db->where($where);
	        $this->db->group_by('lead_stage');
			$res = json_encode($this->db->get()->result_array());
			echo $res;
}
	
 	public function enquiry_set_filters_session(){
 		$this->session->set_userdata('enquiry_filters_sess',$_POST);
 	}

 	public function payment_set_filters_session(){
 		$this->session->set_userdata('payment_filters_sess',$_POST);
 	}

 	public function refund_set_filters_session(){
 		$this->session->set_userdata('refund_filters_sess',$_POST);
 	}

 	public function set_process_session(){
 		$this->session->set_userdata('process',$this->input->post('process'));
 	} 	
 	public function enquiry_disposition($enq){
 		$lead_stages = $this->Leads_Model->find_stage();
 		$dis	=	$this->input->post('disposition');
 		$option = '<option value="0">Select Disposition</option>';
 		if (!empty($lead_stages)) { 			
	 		foreach ($lead_stages as $key => $value) {
	 			if (trim($dis) == trim($value->lead_stage_name)) {
	 				$option .= "<option selected value='".$value->lead_stage_name."'>".$value->lead_stage_name."</option>";	 				
	 			}else{
	 				$option .= "<option value='".$value->lead_stage_name."'>".$value->lead_stage_name."</option>";	 					 				
	 			}
	 		}
 		}
 		echo $option;
 	}
 	
 	public function enquiry_update_disposition($enq){
 		$dis	=	$this->input->post('disposition');
 		$this->db->select('stg_id');
 		$this->db->where('TRIM(lead_stage_name)',trim($dis));
 		$this->db->where('comp_id',$this->session->companey_id);
 		$res	=	$this->db->get('lead_stage')->row_array();
 		$stage_id = $res['stg_id'];

 		$this->db->where('enquiry_id',$enq);
 		$this->db->set('lead_stage',$stage_id);
 		$this->db->update('enquiry');

 		$stage_desc= '';
 		$stage_remark ='';		

 		$this->db->select('status,Enquery_id');
 		$this->db->where('enquiry_id',$enq);
 		$e_res	=	$this->db->get('enquiry')->row_array();

 		$coment_type  = $e_res['status'];
 		$enqs = $e_res['Enquery_id'];

 		$this->Leads_Model->add_comment_for_events_stage('Stage Updated', $enqs,$stage_id,$stage_desc,$stage_remark,$coment_type);

    if($stage_id!=''){
        $this->db->select('Enquery_id,name_prefix,name,lastname,phone');
        $this->db->where('enquiry_id',$enq);
        $enq_id    =   $this->db->get('enquiry')->row_array();

        $this->db->select('pk_i_admin_id');
        $this->db->where('s_phoneno',$enq_id['phone']);
        $visitor_id   =   $this->db->get('tbl_admin')->row_array();


        $this->db->select('id,pay_amt');
        $this->db->where('enq_id',$enq_id['Enquery_id']);
        $this->db->where('remainder_set', '2');
        $this->db->where('reminder_satge', $stage_id);
        $this->db->where('noti_status!=', '1');
        $ins_id    =   $this->db->get('tbl_installment')->row_array();
    }
    if(!empty($ins_id['id'])){

        $enq_ids = $enq_id['Enquery_id'];
        $related_to = $visitor_id['pk_i_admin_id'];
        $create_by = '';
		$subject = 'Payment Reminder';
		   //fetch template from reminter table
		   $tempData = $this->apiintegration_Model->get_reminder_templates(4);
		   $stage_remark='';
		   if($tempData->num_rows()==1){
			   $tempData=$tempData->row();
			   $stage_remark=$tempData->message;
			   $stage_remark = str_replace("@prefix",$enq_id['name_prefix'],$stage_remark);   
			   $stage_remark = str_replace("@amount",$ins_id['pay_amt'],$stage_remark);  
			   $stage_remark = str_replace("@firstname",$enq_id['name'],$stage_remark);  
			   $stage_remark = str_replace("@lastname",$enq_id['lastname'],$stage_remark);  
			   $stage_remark = str_replace("@duedate",'',$stage_remark);  
		   }
        // $stage_remark = 'Dear '.$enq_id['name_prefix'].'. '.$enq_id['name'].' '.$enq_id['lastname'].', Greetings from Godspeed Immigration. We wish to inform you that an EMI of amount '.$ins_id['pay_amt'].' is Pending. If already notify about that please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
        $task_date = date("d-m-Y");
        $task_time = date("h:i:s");
    $this->User_model->add_comment_for_student_user($enq_ids,$related_to,$subject,$stage_remark,$task_date,$task_time,$create_by);

    $this->db->set('noti_status', '1');
    $this->db->where('id',$ins_id['id']);
    $this->db->update('tbl_installment');
    }
 		
 	}

 	public function report_to_correct(){
 		$this->db->where('companey_id',57);
 		$res	=	$this->db->get('tbl_admin')->result_array();

 		foreach ($res as $key => $value) {
 			echo $value['lid'].' '.$value['pk_i_admin_id'].'<br>'; 			
 			$this->db->where('comp_id',57);
 			$this->db->where('created_by',$value['lid']);
 			$this->db->set('created_by',$value['pk_i_admin_id']);
 			$this->db->update('tbl_comment');
 		}
 	}

 	public function lead_stage_correct(){
 		$arr = array(1,2,3,4,11,13,15,16); 		
 		
 		foreach ($arr as $value) {
 			if ($value=='1') {
 				$a = 208;
 			}else if ($value=='2') {
 				$a = 209;
 			}
 			else if ($value=='3') {
 				$a = 210;
 			}
 			else if ($value=='4') {
 				$a = 211;
 			}
 			else if ($value=='11') {
 				$a = 212;
 			}else if ($value=='13') {
 				$a = 213;
 			}else if ($value=='15') {
 				$a = 214;
 			}else if ($value=='16') {
 				$a = 215;
 			}
 			if (!empty($a)) {
	 			$this->db->where('comp_id',57);	
	 			$this->db->where('lead_stage',$value);
	 			$this->db->set('lead_stage',$a);	 				
	 			$this->db->update('enquiry');	 				
 			}
 		}

 	}
 	public function created_date_correct(){
 		$q	=	$this->db->query("SELECT * FROM `enquiry` WHERE enquiry.created_date is null and enquiry.comp_id !=29");
 		$r	=	$q->result_array();
 		foreach ($r as $key => $value) {
 			$v = $value['Enquery_id'] ;
 			$q1 = $this->db->query("SELECT * FROM `tbl_comment` WHERE tbl_comment.lead_id LIKE '%".$v."%' AND tbl_comment.comment_msg LIKE '%Enquiry Created%'");		
 			$r1	=	$q1->row_array();	
 			
 			$where = "Enquery_id LIKE '%".$v."%' AND enquiry.created_date is null and enquiry.comp_id !=29";			
 			$this->db->where($where);
 			$this->db->set('created_date',$r1['created_date']);
 			$this->db->update('enquiry');

 			echo "<pre>";
 			print_r($r1);
 			echo "</pre>";
 		}
 	}

 	function drop_tag()
	{
	//        if (!empty($_POST)) {

		$id[] = $this->input->post('id');
		$enq_id = $this->input->post('enq');

		$this->db->select('tag_ids');
		$this->db->from('enquiry_tags');
		$this->db->where('enq_id', $enq_id);
		$res = $this->db->get()->row()->tag_ids;
		$abc = explode(',', $res);
		$result = array_diff($abc, $id);

		$data = implode(",", $result);
	//        print_r();
	//        exit();


		$this->db->where('enq_id', $enq_id);
		$this->db->set('tag_ids', $data);
		$this->db->update('enquiry_tags');



		//print_r($this->db->last_query());
		//exit();
	//        }


	}

	public function data_save_filter()
	{
		  $type=$this->uri->segment(3);
		 $user_id=$this->session->user_id;
		$comp_id=$this->session->companey_id;
		// print_r($this->input->post());
		// die();
		//check already exist or not
		$count=$this->db->where(array('user_id'=>$user_id,'comp_id'=>$comp_id,'type'=>$type))->count_all_results('tbl_filterdata');
		
		if($count==0){
				
			$filterData=[
				'from_created' =>$this->input->post('from_created'),
				'to_created' =>$this->input->post('to_created'),
				'source' =>$this->input->post('source'), 
				'subsource' => $this->input->post('subsource'),
				'email' => $this->input->post('email'),
				'employee' => $this->input->post('employee'),
				'enq_product' =>$this->input->post('enq_product'),
				'phone' =>$this->input->post('phone'),
				'createdby' =>$this->input->post('createdby'),
				'assign' =>$this->input->post('assign'),
				'address' =>$this->input->post('address'),
				'prodcntry' =>$this->input->post('prodcntry'),
				'state' =>$this->input->post('state'),
				'city' =>$this->input->post('city'),
				'stage' =>$this->input->post('stage'),
				'final' =>$this->input->post('final'),
				'intake' =>$this->input->post('intake'),
				'visatype' =>$this->input->post('visatype'),
				'preferred' =>$this->input->post('preferred'),
				'nationality' =>$this->input->post('nationality'),
				'residing' =>$this->input->post('residing'),
				'tag' =>$this->input->post('tag'),
				];
		$data=[
			'user_id'=>$user_id,
			'comp_id'=>$comp_id,
			'type'=>$type,
			'filter_data'=>json_encode($filterData)];
			$this->db->insert('tbl_filterdata',$data);
			echo'inserted';
			
		}else{
		
			$filterData=[
			    'from_created' =>$this->input->post('from_created'),
				'to_created' =>$this->input->post('to_created'),
				'source' =>$this->input->post('source'), 
				'subsource' => $this->input->post('subsource'),
				'email' => $this->input->post('email'),
				'employee' => $this->input->post('employee'),
				'enq_product' =>$this->input->post('enq_product'),
				'phone' =>$this->input->post('phone'),
				'createdby' =>$this->input->post('createdby'),
				'assign' =>$this->input->post('assign'),
				'address' =>$this->input->post('address'),
				'prodcntry' =>$this->input->post('prodcntry'),
				'state' =>$this->input->post('state'),
				'city' =>$this->input->post('city'),
				'stage' =>$this->input->post('stage'),
				'final' =>$this->input->post('final'),
				'intake' =>$this->input->post('intake'),
				'visatype' =>$this->input->post('visatype'),
				'preferred' =>$this->input->post('preferred'),
				'nationality' =>$this->input->post('nationality'),
				'residing' =>$this->input->post('residing'),
				'tag' =>$this->input->post('tag'),
				];
		$data=[
			'user_id'=>$user_id,
			'comp_id'=>$comp_id,
			'type'=>$type,
			'filter_data'=>json_encode($filterData)];
			$this->db->where(array('user_id'=>$user_id,'comp_id'=>$comp_id,'type'=>$type))->update('tbl_filterdata',$data);
			echo'updated';
			
		}
		
	}

}