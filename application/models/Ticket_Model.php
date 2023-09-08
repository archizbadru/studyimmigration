<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Ticket_Model extends CI_Model {

    

        public function TickectAdd($data)

        {

             $this->db->insert('ticket', $data); 

			 

        }

    /*	public function save($companey_id='',$user_id='')
    	{		
			$cdate = explode("/", $this->input->post("complaindate", true));			
			$ndate = (!empty($cdate[2])) ? $cdate[2]."-".$cdate[0]."-".$cdate[1] : date("Y-m-d"); 			
			$arr = array(
				"message"    => ($this->input->post("remark", true)) ? $this->input->post("remark", true) : '' ,
				"category"   => $this->input->post("relatedto", true),
				"other"      => ($_POST["relatedto"] == "Others") ? $this->input->post("otherrel", true ) : "",
				"product"	 => ($this->input->post("product", true)) ? $this->input->post("product", true) : "",
				"sourse"     => ($this->input->post("source", true)) ? $this->input->post("source", true) : "",
				"complaint_type" => $this->input->post("complaint_type", true),
				"coml_date"	 => $ndate,
				"last_update"=> date("Y-m-d h:i:s"),
				"priority"	 => ($this->input->post("priority", true)) ? $this->input->post("priority", true) : "", 
			);			
			if(!empty($_FILES["attachment"]["name"]))
			{				
				$retdata =  $this->do_upload();			
				if(!empty($retdata["upload_data"]["file_name"])){					
					$arr["attachment"] = $retdata["upload_data"]["file_name"];
				}	
			}			
			if(isset($_POST["ticketno"]))
			{	
				$this->db->where("ticketno", $this->input->post("ticketno", true));
				$this->db->update("tbl_ticket", $arr);				
				if($this->db->affected_rows()){
					return $_POST["ticketno"];					
				}else{
					return false;
				}
			}
			else 
			{				
				$arr["name"]   		= ($this->input->post("name", true)) ? $this->input->post("name", true) : "";
				$arr["email"]  		= ($this->input->post("email", true)) ? $this->input->post("email", true) : "";
				$arr["send_date"]  	= date("Y-m-d h:i:s");
				$arr["client"]     	= ($this->input->post("client", true)) ? $this->input->post("client", true) : "";
				$arr["company"]	 	= $companey_id ;
				$arr["category"]    = $this->input->post("relatedto", true);
				$arr["added_by"] 	= $user_id ;
				$arr["complaint_type"] = $this->input->post("complaint_type", true);
				$arr["ticketno"] 	= "";
				$arr["status"]   	= 0;
				$this->db->insert("tbl_ticket", $arr);				
				$insid = $this->db->insert_id();				
				$tckno = "TCK".$insid.strtotime(date("y-m-d h:i:s"));				
				$updarr = array("ticketno" => $tckno);
				$this->db->where("id", $insid);
				$this->db->update("tbl_ticket", $updarr);				
				if(!empty($insid))
				{					
					$insarr = array("tck_id" 	=> $insid,
									"parent" 	=> 0,
									'comp_id'	=> $this->session->companey_id,
									"subj"   	=> "Ticked Created",
									"msg"    	=> ($this->input->post("remark", true)) ? $this->input->post("remark", true) : '' ,
									"attacment" => "",
									"status"  	=> 0,
									"send_date" =>	date("Y-m-d h:i:s"),
									"client"   	=> ($this->input->post("client", true)) ? $this->input->post("client", true) : '',
									"added_by" 	=> $user_id,									
									);
					if ($this->db->insert("tbl_ticket_conv", $insarr)) {
						return $tckno;
					}else{
						return false;
					}
				}
				else
				{
					$this->session->set_flashdata('message', 'Failed to add ticket');
					return false;
          
				}	
			}	
		}*/

		public function save($companey_id='',$user_id='')
    	{	
    		if(empty($_POST['client']) && count($_SESSION['process']) == 1)
    		{
    			$encode = get_enquery_code();
    			$postData = array(
                            'Enquery_id' 	=> $encode,
							'comp_id' 		=> $this->session->companey_id,
                            'email' 		=> $this->input->post("email", true),
                            'phone' 		=> $this->input->post("phone", true),
                            'name' 			=> $this->input->post("name", true),
                            'checked' 		=> 0,
                            'product_id' 	=>  $_SESSION['process'][0],
                            'created_date' 	=>  date("Y-m-d H:i:s"),
                            'status' 		=> 1,
                            'created_by' 	=> $this->session->user_id,
                            'phone'			=> $this->input->post('phone'),
                        );
    			$this->db->insert('enquiry', $postData);
				$cid = $this->db->insert_id();
    		}
			$cdate = explode("/", $this->input->post("complaindate", true));			
			$ndate = (!empty($cdate[2])) ? $cdate[2]."-".$cdate[0]."-".$cdate[1] : date("Y-m-d"); 			
			$arr = array(
				"message"    => ($this->input->post("remark", true)) ? $this->input->post("remark", true) : '' ,
				"category"   => $this->input->post("relatedto", true),
				"other"      => ($_POST["relatedto"] == "Others") ? $this->input->post("otherrel", true ) : "",
				"product"	 => ($this->input->post("product", true)) ? $this->input->post("product", true) : "",
				"sourse"     => ($this->input->post("source", true)) ? $this->input->post("source", true) : "",
				"complaint_type" => $this->input->post("complaint_type", true),
				"coml_date"	 => $ndate,
				"last_update"=> date("Y-m-d h:i:s"),
				"priority"	 => ($this->input->post("priority", true)) ? $this->input->post("priority", true) : "",
				"issue"	 => ($this->input->post("issue", true)) ? $this->input->post("issue", true) : "",
				 
			);			
			if(!empty($_FILES["attachment"]["name"]))
			{				
				$retdata =  $this->do_upload();			
				if(!empty($retdata["upload_data"]["file_name"])){					
					$arr["attachment"] = $retdata["upload_data"]["file_name"];
				}	
			}			
			if(isset($_POST["ticketno"]))
			{	
				$arr["name"]   		= ($this->input->post("name", true)) ? $this->input->post("name", true) : "";
				$arr["email"]  		= ($this->input->post("email", true)) ? $this->input->post("email", true) : "";
				$arr["client"]     	= ($this->input->post("client", true)) ? $this->input->post("client", true) : "";
				$this->db->where("ticketno", $this->input->post("ticketno", true));
				$this->db->update("tbl_ticket", $arr);				
				if($this->db->affected_rows()){
					return $_POST["ticketno"];					
				}else{
					return false;
				}
			}
			else 
			{				
				$arr["name"]   		= ($this->input->post("name", true)) ? $this->input->post("name", true) : "";
				$arr["email"]  		= ($this->input->post("email", true)) ? $this->input->post("email", true) : "";
				$arr["send_date"]  	= date("Y-m-d h:i:s");
				$arr["client"]     	= ($this->input->post("client", true)) ? $this->input->post("client", true) : $cid;
				$arr["company"]	 	= $companey_id ;
				$arr["category"]    = $this->input->post("relatedto", true);
				$arr["added_by"] 	= $user_id ;
				$arr["complaint_type"] = $this->input->post("complaint_type", true);
				$arr["ticketno"] 	= "";
				$arr["status"]   	= 0;
				$this->db->insert("tbl_ticket", $arr);				
				$insid = $this->db->insert_id();				
				$tckno = "TCK".$insid.strtotime(date("y-m-d h:i:s"));				
				$updarr = array("ticketno" => $tckno);
				$this->db->where("id", $insid);
				$this->db->update("tbl_ticket", $updarr);				
				if(!empty($insid))
				{					
					$insarr = array("tck_id" 	=> $insid,
									"parent" 	=> 0,
									'comp_id'	=> $this->session->companey_id,
									"subj"   	=> "Ticked Created",
									"msg"    	=> ($this->input->post("remark", true)) ? $this->input->post("remark", true) : '' ,
									"attacment" => "",
									"status"  	=> 0,
									"send_date" =>	date("Y-m-d h:i:s"),
									"client"   	=> ($this->input->post("client", true)) ? $this->input->post("client", true) : $cid,
									"added_by" 	=> $user_id,									
									);
					if ($this->db->insert("tbl_ticket_conv", $insarr)) {
						return $tckno;
					}else{
						return false;
					}
				}
				else
				{
					$this->session->set_flashdata('message', 'Failed to add ticket');
					return false;
          
				}	
			}	
		}
		
		public function do_upload()
        {
                $config['upload_path']          = './uploads/ticket/';
                $config['allowed_types']        = '*';
            

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('attachment'))
                {
                        $error = array('error' => $this->upload->display_errors());

                       return $error;
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                      return $data;
                }
        }
		
		public function saveconv($tckno,$subjects,$msg,$client,$user_id,$stage=0,$sub_stage=0){			
			$insarr = array("tck_id" => $tckno,
							"comp_id" => $this->session->companey_id,
							"parent" => 0,
							"subj"   => $subjects,
							"msg"    => $msg,
							"attacment" => "",
							"status"  => 0,							
							"stage"  => $stage,							
							"sub_stage"  => $sub_stage,							
							"client"   => $client,
							"added_by" => $user_id,							
							);						
			$ret = $this->db->insert("tbl_ticket_conv", $insarr);			
			if($ret){				
				$this->session->set_flashdata('message', 'Successfully saved');			
			}else{
				$this->session->set_flashdata('message', 'Failed to save');		
			}					
		}
		
		function updatestatus(){
			
			$updarr = array("category" 	=> $this->input->post("issue", true),
							"solution" => $this->input->post("solution", true),
							"status"    => $this->input->post("status", true),
							"review"    => $this->input->post("review", true)
							);
			$this->db->where("id", $this->input->post("ticketno", true));
			$this->db->update("tbl_ticket", $updarr);
			$ret = $this->db->affected_rows();
			if($ret){
				
					$this->session->set_flashdata('message', 'Successfully added ticket');
			
			}else{
					$this->session->set_flashdata('message', 'Failed to add ticket');
		
			}
		}
		
		function getissues(){
			
			return $this->db->select("*")->where("cmp", $this->session->companey_id)->get("tck_mstr")->result();
			
		}

		// function of getting ticket source
		function getSource($companyid)
		{
			return $this->db->select("s_id,source_name")->where("comp_id",$companyid )->get("tbl_ticket_source")->result();
		}

		function getIssuesByCompnyID($companyid){
			
			return $this->db->select("title")->where("cmp", $companyid)->get("tck_mstr")->result();
			
		}

		
		function getconv($conv){
			$compid = $this->session->companey_id;
			return $this->db->select("cnv.*,lead_stage.lead_stage_name,lead_description.description as sub_stage")
				 ->where("cnv.tck_id", $conv)
				 ->where("cnv.comp_id", $compid)
				 ->from("tbl_ticket_conv cnv")
				 ->join("lead_stage",'lead_stage.stg_id=cnv.stage','left')
				 ->join("lead_description",'lead_description.id=cnv.sub_stage','left')				 
				 ->order_by("cnv.id ASC")
				 ->get()
				 ->result();
			
		}
		public function getall(){
$all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
$where = '';
$where .= "( tck.added_by IN (".implode(',', $all_reporting_ids).')';
$where .= " OR tck.assign_to IN (".implode(',', $all_reporting_ids).'))';
			return $this->db->select("tck.*,enq.phone,enq.gender,prd.country_name, concat(enq.name_prefix,' ' , enq.name,' ', enq.lastname) as clientname , COUNT(cnv.id) as tconv, cnv.msg, tbl_admin.s_display_name,tbl_admin.last_name")
				 ->where($where)
				 ->where("tck.company", $this->session->companey_id)
				
				 ->from("tbl_ticket tck")
				 ->join("tbl_ticket_conv cnv", "cnv.tck_id = tck.id", "LEFT")
				 ->join("enquiry enq", "enq.enquiry_id = tck.client", "LEFT")
				 ->join("tbl_admin", "tbl_admin.pk_i_admin_id = tck.assign_to", "LEFT")
				 ->join("tbl_product_country prd", "prd.id = tck.product", "LEFT")
				 ->order_by("tck.id DESC")
				 ->group_by("tck.id")
				 ->get()
				 ->result();
		
		}

		public function getTicketListByCompnyID($companyid,$userid){
			$all_reporting_ids    =   $this->common_model->get_categories($userid);
			$where = '';
			$where .= "( tck.added_by IN (".implode(',', $all_reporting_ids).')';
			$where .= " OR tck.assign_to IN (".implode(',', $all_reporting_ids).'))';
			return $this->db->select("tck.*,enq.phone,enq.gender,prd.country_name, concat(enq.name_prefix,' ' , enq.name,' ', enq.lastname) as clientname , COUNT(cnv.id) as tconv, cnv.msg")
				 ->where($where)
				 ->where("tck.company",$companyid )
				
				 ->from("tbl_ticket tck")
				 ->join("tbl_ticket_conv cnv", "cnv.tck_id = tck.id", "LEFT")
				 ->join("enquiry enq", "enq.enquiry_id = tck.client", "LEFT")
				 ->join("tbl_product_country prd", "prd.id = tck.product", "LEFT")
				 ->order_by("tck.id DESC")
				 ->group_by("tck.id")
				 ->get()
				 ->result();
		
		}
		
		public function filterticket($where){

			 $this->db->select("tck.*,enq.phone,enq.gender,prd.product_name, concat(enq.name_prefix,' ' , enq.name,' ', enq.lastname) as clientname , COUNT(cnv.id) as tconv, cnv.msg");
				 $this->db->where("tck.company", $this->session->companey_id );
				
				if(!empty($where)){
					
					$this->db->where($where);
					
				}
				
				 $this->db->from("tbl_ticket tck");
				 $this->db->join("tbl_ticket_conv cnv", "cnv.tck_id = tck.id", "LEFT");
				 $this->db->join("enquiry enq", "enq.enquiry_id = tck.client", "LEFT");
				 $this->db->join("tbl_product prd", "prd.sb_id = tck.product", "LEFT");
				 $this->db->order_by("tck.id DESC");
				 $this->db->group_by("tck.id");
				 
			return	 $this->db->get()
				 ->result();
		
		}
		
		
		public function getproduct()
		{
			
			return $this->db->select("*")->where(array("comp_id" => $this->session->companey_id, "status" => 1))->get("tbl_product_country")->result();
	
			
		}
		
		public function get($tctno){

			return $this->db->select("tck.*,tbl_ticket_subject.subject_title,lead_source.lead_name as ticket_source,enq.phone,enq.email,enq.gender,prd.country_name, concat(enq.name,' ', enq.lastname) as clientname")
				 ->where("tck.ticketno", $tctno)
				 ->where("tck.company", $this->session->companey_id)
				 ->from("tbl_ticket tck")
				 ->join("enquiry enq", "enq.enquiry_id = tck.client", "LEFT")
				 ->join("tbl_product_country prd", "prd.id = tck.product", "LEFT")
				 ->join("tbl_ticket_subject", "tbl_ticket_subject.id = tck.category", "LEFT")				 
				 ->join("lead_source", "lead_source.lsid = tck.sourse", "LEFT")				 
				 ->order_by("tck.id DESC")
				 ->get()
				 ->row();
		
		}
		public function get_issue_list(){
			$this->db->where('comp_id',$this->session->companey_id);
			return $this->db->get('tbl_nature_of_complaint')->result();
		}
		public function getallclient(){
			
			if(($this->session->userdata('user_right')==214)){
			return $this->db->select("*")->where(array("status" => 3, "phone" => $this->session->phone))->get("enquiry")->result();
			}else{
			return $this->db->select("*")->where(array("status" => 3, "comp_id" => $this->session->companey_id))->get("enquiry")->result();
			}
		}
	public function add_tsub($data) 
	{
        $insert = $this->db->insert('tbl_ticket_subject', $data);
        return $insert;

    }
	
	public function get_sub_list($compid='') {
		if($compid!='')
		{
			$this->db->where('comp_id', $compid);
		}
		else
		{
			$this->db->where('comp_id', $this->session->userdata('companey_id'));
		}
		
        $query = $this->db->get('tbl_ticket_subject');
        return $query->result();
    }
	
	public function delete_subject($drop = null) {
        $this->db->where('id', $drop)->delete('tbl_ticket_subject');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    public function get_ticket_status(){
    	$this->db->where('comp_id',$this->session->companey_id);
    	return $this->db->get('support_ticket_status')->result();
    }
}