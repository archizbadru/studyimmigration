<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
            $this->load->helper('url');
		
		$this->load->model(array(
			'Client_Model','Apiintegration_Model','Message_models','Leads_Model','enquiry_model','Whatsapp_model'
		));
		$this->password = "67";
		 $this->load->library('email');
		 $this->load->library('upload');

	}
   function mail_fun(){
//print_r($_FILES['file']['name']);exit;
   	if(!empty($_FILES['file']['name'])){
   		$this->load->library("aws");
   		$attachments = array();
   		$file_names = array();
   	foreach($_FILES['file']['name'] as $key => $files){ 

   	    if(!empty($files)){

                $_FILES['userfile']['name']= $_FILES['file']['name'][$key];
                $_FILES['userfile']['type']= $_FILES['file']['type'][$key];
                $_FILES['userfile']['tmp_name']= $_FILES['file']['tmp_name'][$key];
                $_FILES['userfile']['error']= $_FILES['file']['error'][$key];
                $_FILES['userfile']['size']= $_FILES['file']['size'][$key];    
                
                $_FILES['userfile']['name'] = $image = 'GS-'.$_FILES['userfile']['name'];
                                                 $path= $_SERVER["DOCUMENT_ROOT"]."/uploads/email_attach/".$image;
                                                 $ret = move_uploaded_file($_FILES['userfile']['tmp_name'],$path);
             
             $attachments[] = $path;
             $file_names[] = $image;
                /*if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }*/
            }
	        }
        }else{
        	$path ='';
        	$image ='';
        	$ret ='';
        }
		/* $config['smtp_auth']    = true;
        		$config['protocol']     = 'smtp';
		        $config['smtp_host']    = 'ssl://smtp.gmail.com';
		        $config['smtp_port']    = '465';
		        $config['smtp_timeout'] = '7';
		        $config['smtp_user']    = 'rajkumar@croyez.in';
		        $config['smtp_pass']    = 'ejrdpixanepoprdu';
		        $config['charset']      = 'utf-8';
        		$config['mailtype']     = 'html'; // or html
		        $config['newline']      = "\r\n"; 
				$this->load->library('email');
				    $this->email->initialize($config);
			        $this->email->from('rajkumar@croyez.in');
	                $this->email->to('slowet@yopmail.com');
	                $this->email->subject(''); 
	                $this->email->message('test');
					$this->email->send();
					//echo 'll';exit; */
		////////////////////For chenges @exmple data//////////////////////////
            $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        	$this->db->where('companey_id',$this->session->companey_id);
        	$this->db->where('pk_i_admin_id',$this->session->user_id);
        	$sender_row	=	$this->db->get('tbl_admin')->row_array();
if(!empty($sender_row['telephony_agent_no'])){
	$senderno = '0'.$sender_row['telephony_agent_no'];
}else{
	$senderno = $sender_row['s_phoneno'];
}
 ////////////////////For chenges @exmple data//////////////////////////       	

        	$temp_id = $this->input->post('templates');
        	$rows	=	$this->db->select('*')
                        ->from('api_templates')
                        ->join('mail_template_attachments', 'mail_template_attachments.templt_id=api_templates.temp_id', 'left')                    
                        ->where('temp_id',$temp_id)                        
                        ->get()
                        ->row();
            $message = $this->input->post('message_name');
            $email_subject = $this->input->post('email_subject');
            $agg_link = $this->input->post('aggurl');
//}
//}
if(!empty($agg_link)){
            $agg_link = '<a href="'.$agg_link.'" targrt="_blank" style="text-decoration: underline;color:blue;">'.$agg_link.'</a>';
}
	        $to = $this->input->post('mail');
	        $move_enquiry = $this->input->post('enquiry_id');
#--------------------------userwise  mail sent code Start ---------------------->
	        $this->db->select('user_protocol as protocol,user_host as smtp_host,user_port as smtp_port,user_email as smtp_user,user_password as smtp_pass');
	        $this->db->where('companey_id',$this->session->companey_id);
        	$this->db->where('pk_i_admin_id',$this->session->user_id);
        	$email_row	=	$this->db->get('tbl_admin')->row_array();
	        if(empty($email_row['smtp_user'] && $email_row['smtp_pass'])){
        	$this->db->where('comp_id',$this->session->companey_id);
        	$this->db->where('status',1);
        	$email_row	=	$this->db->get('email_integration')->row_array();
            }
#--------------------------userwise  mail sent code end ---------------------->            
        	if(empty($email_row)){
  				echo "Email is not configured";
  				exit();
        	}else{


        		/*
        		$config['protocol']     = $email_row['protocol'];
		        $config['smtp_host']    = $email_row['smtp_host'];
		        $config['smtp_port']    = $email_row['smtp_port'];
		        $config['smtp_timeout'] = '7';
		        $config['smtp_user']    = "prokanhaiya@gmail.com";
		        $config['smtp_pass']    = "oallgykmylkthohu";
		        $config['charset']      = 'utf-8';
        		$config['mailtype']     = 'text'; // or html
		        $config['newline']      = "\r\n";        
		        */


		        $config['smtp_auth']    = true;
        		$config['protocol']     = $email_row['protocol'];
		        $config['smtp_host']    = $email_row['smtp_host'];
				$explode=explode('.',$email_row['smtp_host']);
				if(in_array('secureserver',$explode)){
				$config['smtp_crypto'] = 'ssl';	
				}
		        $config['smtp_port']    = $email_row['smtp_port'];
		        $config['smtp_timeout'] = '7';
		        $config['smtp_user']    = $email_row['smtp_user'];
		        $config['smtp_pass']    = $email_row['smtp_pass'];
		        $config['charset']      = 'utf-8';
        		$config['mailtype']     = 'html'; // or html
		        $config['newline']      = "\r\n";        
		        //$config['validation']   = TRUE; // bool whether to validate email or not   
//echo 'ds';	exit;			
        	}

        	$this->load->library('email');

            if(!empty($move_enquiry)){
	      	    foreach($move_enquiry as $key){
	      	        $enq = $this->enquiry_model->enquiry_by_id($key);

	      	        $data['message'] = $message;
                    $template = $this->load->view('templates/enquiry_email_template', $data, true);
	      	        
	      	        $new_message = $template;

	      	        $new_message = str_replace('@name', $enq->name.' '.$enq->lastname,$new_message);
	      	        $new_message = str_replace('@phone', $enq->phone,$new_message);
	      	        $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
	      	        $new_message = str_replace('@userphone', $senderno,$new_message);
	      	        $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
	      	        $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
	      	        $new_message = str_replace('@email', $enq->email,$new_message);
	      	        $new_message = str_replace('@password', '12345678',$new_message);
	      	        if(!empty($agg_link)){
	      	        $new_message = str_replace('@link', $agg_link,$new_message);
                    }
			        $this->email->initialize($config);
			        $this->email->from($email_row['smtp_user']);
	                $to=$enq->email;
	                $this->email->to($to);
	                $this->email->subject($email_subject); 
	                $this->email->message($new_message);
if(!empty($attachments)){
foreach($attachments as $attach)
{
            
            $this->email->attach($attach);
}
}

	    $this->db->select('Enquery_id');
        $this->db->from('enquiry');
        $this->db->where('phone',$this->input->post('mobile'));
        $q= $this->db->get()->row();
        $enq_id=$q->Enquery_id;
	                if($this->email->send()){
      	$comment_id = $this->Leads_Model->add_comment_for_events('Email Sent.', $enq_id,'0','0',$new_message,'3','1',$email_subject,json_encode($file_names));
							echo "Mail sent successfully";
	                }else{
	    $comment_id = $this->Leads_Model->add_comment_for_events('Email Failed.', $enq_id,'0','0',$new_message,'3','0',$email_subject,json_encode($file_names));
							echo "Something went wrong";			                	
	                }
	  			}
				
				//echo 'exit';exit(); 
        	}else{
    /*$cc_ids = $this->input->post('cc_ids');*/
    $this->db->select('Enquery_id,name,lastname,phone,email');
    $this->db->from('enquiry');
    $this->db->where('phone',$this->input->post('mobile'));
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $cc_id = $this->input->post('cc_ids');
    $cc_ids = explode(",",$cc_id);

        	$data['message'] = $message;
            $template = $this->load->view('templates/enquiry_email_template', $data, true); 	        
	      	$new_message = $template;
              
        	$new_message = str_replace('@name', $q->name.' '.$q->lastname,$new_message);
	      	$new_message = str_replace('@phone', $q->phone,$new_message);
	      	$new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
	      	$new_message = str_replace('@userphone', $senderno,$new_message);
	      	$new_message = str_replace('@designation', $sender_row['designation'],$new_message);
	      	$new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
	      	$new_message = str_replace('@email', $q->email,$new_message);
	      	$new_message = str_replace('@password', '12345678',$new_message);
	      	if(!empty($agg_link)){
	      	$new_message = str_replace('@link', $agg_link,$new_message);
            }
		        $this->email->initialize($config);
		        $this->email->from($email_row['smtp_user']);		                
	            $this->email->to($to);
	            $this->email->cc($cc_ids);
	            $this->email->subject($email_subject); 
	            $this->email->message($new_message);
if(!empty($attachments)){
foreach($attachments as $attach)
{
            
                $this->email->attach($attach);
}
}				
	            if($this->email->send()){
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Sent.', $enq_id,'0','0',$new_message,'3','1',$email_subject,json_encode($file_names));
				echo "Mail sent successfully";
	            }else{
	        $comment_id = $this->Leads_Model->add_comment_for_events('Email Failed.', $enq_id,'0','0',$new_message,'3','0',$email_subject,json_encode($file_names));
						echo "Something went wrong";			                	
	            }                 
    		}
if(!empty($attachments)){
foreach($attachments as $attach)
{
	unlink($attach);
}
}
    		/*if($ret)
                {
                    $rt = $this->aws->uploadinfolder($this->session->awsfolder,$path);

                    if($rt == true)
                    {
                        unlink($path); 
                    }
                }*/
					
         }
    	public function get_templates($product_id='0',$stage_id='0',$for='0'){
			$product_id=$this->uri->segment(3);
			$stage_id=$this->uri->segment(4);
			$for=$this->uri->segment(5);
    	    $this->db->where('temp_for',$for);
    	    $this->db->where('comp_id',$this->session->companey_id);
    	    //$this->db->where("FIND_IN_SET(".$this->session->dept_name.", departments)");
    	    //$this->db->where_in('departments',$this->session->dept_name);
    	    $res=$this->db->get('api_templates');
			$q=$res->result();
			// print_r($q);
			// return;
    	    if(!empty($q)){
    	        echo '<option value="0" selected style="display:none">Select Templates</option>';
    	    foreach($q as $value){
				 $stage = explode(',', $value->stage);
				 $process = explode(',', $value->process); 
				 if ($product_id==0) {
				$extprocess=$this->session->userdata('process');
				 $count_array=count(array_intersect($extprocess,$process));
				if(in_array($stage_id,$stage) AND $count_array!=0){
					echo '<option value="'.$value->temp_id.'">'.$value->template_name.'</option>';
					}
				}else{
					$process = explode(',', $value->process); 
					if(in_array($stage_id,$stage) AND in_array($product_id,$process)){
						echo '<option value="'.$value->temp_id.'">'.$value->template_name.'</option>';
						}

				}
				
    	    		}
    	    
    	    }
		}


		public function get_cc_email($for,$enq=''){
			$this->db->select('enquiry.other_email,tbl_family.f_email');
			$this->db->from('enquiry');
			$this->db->join('tbl_family', 'tbl_family.enquiry_id=enquiry.Enquery_id', 'left');
    	    $this->db->where('enquiry.enquiry_id',$enq);
    	    $res=$this->db->get();
			$q=$res->result();
		$all_email = array();	
    	    if(!empty($q)){
    	        echo '<option>Select Cc</option>';
    	    foreach($q as $value){
				 $enq_email = explode(',', $value->other_email);
				 $all_email=array_unique(array_merge($enq_email,$all_email));
				 $family_email = $value->f_email;
				 array_push($all_email,$family_email); 
				}

				
			foreach($all_email as $val){	
			    echo '<option value="'.$val.'">'.$val.'</option>';
					
			}	

    	    }
		}
	
	
		public function getMessage($id){
		if((int)$id){
	    $this->db->where('temp_id',$id);
	    $res=$this->db->get('api_templates');
	    if(!empty($res->result())){
	    echo $q=$res->row()->template_content;}
		}else{
		   
		    
		}
	   
	}
	
	public function send_sms_career_ex(){
		if ($this->input->post('mesge_type')== 3) {
			$temp_id = $this->input->post('templates');
	    	$rows	=	$this->db->select('*')
	                    ->from('api_templates')
	                    ->join('mail_template_attachments', 'mail_template_attachments.templt_id=api_templates.temp_id', 'left')                    
	                    ->where('temp_id',$temp_id)                        
	                    ->get()
	                    ->row();
	        $message = $this->input->post('message_name');
	        $email_subject = $this->input->post('email_subject');
	        $to_email = $this->input->post('mail');
	        $move_enquiry = $this->input->post('enquiry_id'); 
	        $curl_fields = array(
	        	'mail_datas'=>array(
	        		'message'=>array(
	        			'html_content'=>$message,
	        			'subject'=>$email_subject,
	        			'from_mail'=>'support@corefactors.in',
	        			'from_name'=>'CareerEx',
	        			'reply_to'=>'support@corefactors.in'
	        		)
	        	)
	        );
	        $to = array();
	        if(!empty($move_enquiry)){
	      	    foreach($move_enquiry as $key){
	      	        $enq = $this->enquiry_model->enquiry_by_id($key);
			        $to[]= array('email_id'=>$enq->email,'name'=>$enq->name.' '.$enq->lastname);	                
	  			}
	    	}else{					
		        $to[]= array('email_id'=>$to_email,'name'=>'');	                
			}
			$curl_fields['mail_datas']['message']['to_recipients'] = $to;
			$curl_fields = json_encode($curl_fields);
			/*echo $curl_fields;
			exit();*/
			if ($to) {
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://teleduce.in/send-email-json-otom/8c999fa1-e303-423d-a804-eb0e6210604d/1007/",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$curl_fields,
				  CURLOPT_HTTPHEADER => array(
				    "Content-Type: application/json"
				  ),
				));

				$response = curl_exec($curl);

				curl_close($curl);
				/*echo $response;*/
				$res	=	json_decode($response,true);
				if (!empty($res['response']) && $res['response_type'] == 'success') {
					echo "Email Sent Successfully.";	
				}
			}
		}else if ($this->input->post('mesge_type')== 2) {
			$message = $this->input->post('message_name');
	        $move_enquiry = $this->input->post('enquiry_id');
	        $phone = '';
			if(!empty($this->input->post('mobile'))){	              	
				$phone= $this->input->post('mobile');
			}else{
				if(!empty($move_enquiry)){
				  $i = 0;
				  foreach($move_enquiry as $key){
				    $enq = $this->enquiry_model->enquiry_by_id($key);
				    if ($i==0) {
				    	$phone .= $enq->phone;
				    }else{
				    	$phone .= ','.$enq->phone;
				    }
				    $i++;
				  }
				}
			}
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://teleduce.corefactors.in/sendsms/?key=8c999fa1-e303-423d-a804-eb0e6210604d&text=$message&route=0&from=CORFCT&to=$phone",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			));
			$response = curl_exec($curl);
			echo "SMS Sent Successfully.";
			//echo $response;
		}
	}

   
	public function send_sms(){
		
	    $signature   = $this->enquiry_model->get_signature();
	     
        if($this->input->post('mesge_type')== 1){

////////////////////For chenges @exmple data//////////////////////////
            $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        	$this->db->where('companey_id',$this->session->companey_id);
        	$this->db->where('pk_i_admin_id',$this->session->user_id);
        	$sender_row	=	$this->db->get('tbl_admin')->row_array();
if(!empty($sender_row['telephony_agent_no'])){
	$senderno = '0'.$sender_row['telephony_agent_no'];
}else{
	$senderno = $sender_row['s_phoneno'];
}
 ////////////////////For chenges @exmple data//////////////////////////
        	//print_r($_POST);exit;
	      	$templates_id	=	$this->input->post('templates');
	      	$this->db->where('temp_id',$templates_id);
	      	$template_row	=	$this->db->get('api_templates')->row_array();
	        $message_name=$this->input->post('message_name');
            $phone= '91'.$this->input->post('mobile');
            $move_enquiry = $this->input->post('enquiry_id');

        	if(!empty($move_enquiry)){
      	      foreach($move_enquiry as $key){
      	        $enq = $this->enquiry_model->enquiry_by_id($key);

      	        $new_message = $message_name;

	      	        $new_message = str_replace('@name', $enq->name.' '.$enq->lastname,$new_message);
	      	        $new_message = str_replace('@phone', $enq->phone,$new_message);
	      	        $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
	      	        $new_message = str_replace('@userphone', $senderno,$new_message);
	      	        $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
	      	        $new_message = str_replace('@email', $enq->email,$new_message);
	      	        $new_message = str_replace('@password', '12345678',$new_message);

      	        $phone='91'.$enq->phone;
			  
      	        $this->Message_models->sendwhatsapp($phone,$new_message);
    $this->db->select('Enquery_id');
    $this->db->from('enquiry');
    $this->db->where('phone',$this->input->post('mobile'));
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
      	$comment_id = $this->Leads_Model->add_comment_for_events('Whatsapp Sent.', $enq_id,'0','0',$new_message,'1','1');
      	        if($template_row['media']){	      	        	
      	        	$media_url	=	$template_row['media'];
      	        	$this->Message_models->sendwhatsapp($phone,base_url().$media_url);
      	        }
      	      }
      	       echo "Message sent successfully";
            }else{
 
    $this->db->select('Enquery_id,name,lastname,phone,email');
    $this->db->from('enquiry');
    $this->db->where('phone',$this->input->post('mobile'));
    $q= $this->db->get()->row();

             $new_message = $message_name;

        	$new_message = str_replace('@name', $q->name.' '.$q->lastname,$new_message);
	      	$new_message = str_replace('@phone', $q->phone,$new_message);
	      	$new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
	      	$new_message = str_replace('@userphone', $senderno,$new_message);
	      	$new_message = str_replace('@designation', $sender_row['designation'],$new_message);
	      	$new_message = str_replace('@email', $q->email,$new_message);
	      	$new_message = str_replace('@password', '12345678',$new_message);

	      	$this->Message_models->sendwhatsapp($phone,$new_message);

    $enq_id=$q->Enquery_id;
      	$comment_id = $this->Leads_Model->add_comment_for_events('Whatsapp Sent.', $enq_id,'0','0',$new_message,'1','1');
              	if($template_row['media']){	      	   
              		$media_url = $template_row['media'];     	
      	        	$this->Message_models->sendwhatsapp($phone,base_url().$media_url);      	        		      	
      	        }
              echo "Message sent successfully";
           }
        }else if($this->input->post('mesge_type')== 3){
         $this->mail_fun();    
    	}else if($this->input->post('mesge_type')== 2){

////////////////////For chenges @exmple data//////////////////////////
            $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        	$this->db->where('companey_id',$this->session->companey_id);
        	$this->db->where('pk_i_admin_id',$this->session->user_id);
        	$sender_row	=	$this->db->get('tbl_admin')->row_array();
		
if(!empty($sender_row['telephony_agent_no'])){
	$senderno = '0'.$sender_row['telephony_agent_no'];
}else{
	$senderno = $sender_row['s_phoneno'];
}
 ////////////////////For chenges @exmple data//////////////////////////
    		
	        $message = $this->input->post('message_name');
	        $move_enquiry = $this->input->post('enquiry_id');
	        $agg_link = $this->input->post('aggurl');
	        if(!empty($agg_link)){
	        $agg_link = '<a href="'.$agg_link.'" targrt="_blank" style="text-decoration: underline;color:blue;">Click here</a>';  
	        } 
		 
			if(!empty($this->input->post('mobile'))){
			//$phone= '91'.$this->input->post('mobile');

					$this->db->select('Enquery_id,name,lastname,phone,email');
				$this->db->from('enquiry');
				$this->db->where('phone',$this->input->post('mobile'));
				$q= $this->db->get()->row();

			$new_message = $message;
			
        	$new_message = str_replace('@name', $q->name.' '.$q->lastname,$new_message);
	      	$new_message = str_replace('@phone', $q->phone,$new_message);
	      	$new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
	      	$new_message = str_replace('@userphone', $senderno,$new_message);
	      	$new_message = str_replace('@designation', $sender_row['designation'],$new_message);
	      	$new_message = str_replace('@email', $q->email,$new_message);
	      	$new_message = str_replace('@password', '12345678',$new_message);
	      	if(!empty($agg_link)){
	      	$new_message = str_replace('@link', $agg_link,$new_message);
	        }      	
			$phone= $this->input->post('mobile');
				
			$check = $this->Whatsapp_model->sms_email_whatsapp_validate($this->session->companey_id,
			         $this->input->post('mesge_type'));
			
			if($check=="1"){
				$smsMsg = $this->Message_models->smssend($phone,$new_message);
				$res = $this->Whatsapp_model->get_balance($this->input->post('mesge_type'),$this->session->companey_id);
				$qty = 1;
				$data = array(
					'comp_id'=>$this->session->companey_id,
					'comp_admin_id'=>$this->session->companey_id,
					'user_id'=>$this->session->user_id,
					'type'=>$this->input->post('mesge_type'),
					'qty_used'=>$qty,
					'balance'=>$res->total_quantity - ($res->used_quantity+$qty),
				  );
				$this->Whatsapp_model->add_balance($data);
			}else{
				print_r($check);
				return false;
			}
			
	           
    $enq_id=$q->Enquery_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('SMS Sent.', $enq_id,'0','0',$new_message,'2','1');
				echo "Message sent successfully";
			}else{
				if(!empty($move_enquiry)){
				  foreach($move_enquiry as $key){
				    $enq = $this->enquiry_model->enquiry_by_id($key);

				    $new_message = $message;

	      	        $new_message = str_replace('@name', $enq->name.' '.$enq->lastname,$new_message);
	      	        $new_message = str_replace('@phone', $enq->phone,$new_message);
	      	        $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
	      	        $new_message = str_replace('@userphone', $senderno,$new_message);
	      	        $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
	      	        $new_message = str_replace('@email', $enq->email,$new_message);
	      	        $new_message = str_replace('@password', '12345678',$new_message);
	      	        if(!empty($agg_link)){
	      	        $new_message = str_replace('@link', $agg_link,$new_message);
                    }
				    $phone=$enq->phone;
				    $this->Message_models->smssend($phone,$new_message);
	$this->db->select('Enquery_id');
    $this->db->from('enquiry');
    $this->db->where('phone',$this->input->post('mobile'));
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('SMS Sent.', $enq_id,'0','0',$new_message,'2','1');
				  }

				  echo "Message sent successfully";
				}
			}
    	}else if($this->input->post('mesge_type')== 4){

 ////////////////////For chenges @exmple data//////////////////////////
            $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        	$this->db->where('companey_id',$this->session->companey_id);
        	$this->db->where('pk_i_admin_id',$this->session->user_id);
        	$sender_row	=	$this->db->get('tbl_admin')->row_array();
if(!empty($sender_row['telephony_agent_no'])){
	$senderno = '0'.$sender_row['telephony_agent_no'];
}else{
	$senderno = $sender_row['s_phoneno'];
}
 ////////////////////For chenges @exmple data//////////////////////////

    $this->db->select('Enquery_id,name,lastname,phone,email');
    $this->db->from('enquiry');
    $this->db->where('phone',$this->input->post('mobile'));
    $this->db->where('email',$this->input->post('mail'));
    $q= $this->db->get()->row();
    $enq_id=$q->Enquery_id;
    $this->db->select('pk_i_admin_id');
                    $this->db->from('tbl_admin');
                    $this->db->where('s_user_email',$q->email);
                    $this->db->where('s_phoneno',$q->phone);
                    $stuid= $this->db->get()->row();
if(!empty($stuid->pk_i_admin_id)){
$id_for_bell_noti=$stuid->pk_i_admin_id;
$templates_id	=	$this->input->post('templates');
$this->db->where('temp_id',$templates_id);
$template_row	=	$this->db->get('api_templates')->row_array();
$message_name=$this->input->post('message_name');

$new_message = $message_name;

            $new_message = str_replace('@name', $q->name.' '.$q->lastname,$new_message);
	      	$new_message = str_replace('@phone', $q->phone,$new_message);
	      	$new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
	      	$new_message = str_replace('@userphone', $senderno,$new_message);
	      	$new_message = str_replace('@designation', $sender_row['designation'],$new_message);
	      	$new_message = str_replace('@email', $q->email,$new_message);
	      	$new_message = str_replace('@password', '12345678',$new_message);

    $conversation = $template_row['template_name'];
    $stage_remark = $new_message;
        $this->Leads_Model->add_comment_for_events('Notification Sent.', $enq_id,'0','0',$stage_remark,'4','1');
        $comment_id = $this->Leads_Model->add_notifications_for_events($enq_id,$id_for_bell_noti,$conversation,$stage_remark);
        echo "Bell Notification sent successfully";
    }else{
    	$this->Leads_Model->add_comment_for_events('Notification Sent.', $enq_id,'0','0','Bell Notification Not Sent Because User Have No Portal!','4','0');
    	echo "Bell Notification Not Sent Because User Have No Portal!";
    	}
    }
	}	
public function chat_start(){
   	$message=$this->input->post('message');
   	$phone= '91'.$this->input->post('phone');
   	$this->Message_models->sendwhatsapp($phone,$message);
    echo "Message sent successfully";
   }

   public function get_templates_without_process($for){			
			$this->db->where('temp_for',$for);			
    	    $this->db->where('comp_id',$this->session->companey_id);
    	    $res=$this->db->get('api_templates');
			$q=$res->result();
    	    if(!empty($q)){
				echo '<option value="0" selected style="display:none">Select Templates</option>';
				foreach($q as $value){
				   echo '<option value="'.$value->temp_id.'">'.$value->template_name.'</option>';
				}
    	    }
	    }
}