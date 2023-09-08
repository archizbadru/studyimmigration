<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller {
	
    public function __construct() {
		
		 parent::__construct();
		$this->load->model("common_model");
		$this->load->model('Payment_model');
		$this->load->model('user_model');
		$this->load->model('Message_models');
		$this->load->model('Leads_Model');
		$this->load->model('apiintegration_Model');
		
		if (empty($this->session->user_id)) {
			redirect('login');
		}
	}
	public function make_payment_mojo(){
		$this->session->unset_userdata('part_payment_amount');
		$this->form_validation->set_rules('fname','Name','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('phone','Mobile No','trim|required|numeric|min_length[10]|max_length[10]');		
		$this->form_validation->set_rules('pincode','Pincode','trim|required|numeric');		
		$this->form_validation->set_rules('address','Address','trim|required');		
		$this->form_validation->set_rules('dbt','Mode of Payment','trim|required');		
		/*$this->form_validation->set_rules('amount','Amount','trim|required|numeric');*/		
		if ($this->form_validation->run() == true) {
			$name		=	$this->input->post('fname');
			$email		=	$this->input->post('email');
			$phone		=	$this->input->post('phone');
			$address    =	$this->input->post('address');
			
			$ship_address	=	$this->input->post('ship_address');
			$state			=	$this->input->post('state');
			$city			=	$this->input->post('city');
			$pincode 		=	$this->input->post('pincode');
			$gstin  		=	$this->input->post('gstin');

			$this->session->set_userdata('payment_mode',$this->input->post('dbt'));
			$this->user_model->set_user_meta($this->session->user_id,array(
				'postal_code'=>$this->input->post('pincode'),
				'gstin' => $this->input->post('gstin')
				)
			);

			$comp_id	=	$this->session->companey_id;
			$user_id	=	$this->session->user_id;

			$this->db->where('companey_id',$comp_id);
			$this->db->where('pk_i_admin_id',$user_id);
			$this->db->set('add_ress',$address);
			$this->db->update('tbl_admin');
			
			if ($this->input->post('part_payment') == 1) {
				$amount = $this->input->post('part_payment_amount');				
				$this->session->set_userdata('part_payment_amount',$amount);
			}else{
				$this->load->library('cart');
				$amount	=	$this->cart->total();							
			}

			if ($this->input->post('dbt') == 2) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt($ch, CURLOPT_HTTPHEADER,
				             array("X-Api-Key:ca7a223092cfaf2317db5fc00fc83502",
				                  "X-Auth-Token:b6224670c580b470d7951eaf697e2e9f"));
				$payload = Array(
				    'purpose' => 'Product Purchage',
				    'amount' => $amount,
				    'phone' => $phone,
				    'buyer_name' => $name,
				    'redirect_url' => base_url().'buy/thankyou',
				    'send_email' => true,
				    'webhook' => 'http://www.example.com/webhook/',
				    'send_sms' => true,
				    'email' => $email,
				    'allow_repeated_payments' => false
				);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
				$response = curl_exec($ch);
				curl_close($ch); 
				//echo $response.'test';
				$decodedText = html_entity_decode($response);
				$myArray = array(json_decode($response, true));
				if (!empty($myArray[0]["payment_request"]["longurl"])) {
					$longu = $myArray[0]["payment_request"]["longurl"];				
					header('Location:' .$longu);
				}else{
					//echo $response;
					echo "Something went wrong!";
				}	
			}else{
				$this->load->model('order_model');
				
				$emp_id    =	$this->input->post('preferd');
				$pk_i_admin_id	=	$this->order_model->get_pk_admin_id($emp_id);
				$ord_no	=	!empty($pk_i_admin_id->pk_i_admin_id)?$this->order_model->placeorder($pk_i_admin_id->pk_i_admin_id):$this->order_model->placeorder();

		//$ord_no	=	$this->order_model->placeorder($pk_i_admin_id->pk_i_admin_id);

				if($ord_no){ 
					$this->order_model->set_order_meta($ord_no,$comp_id,$user_id,array(
							'fname' =>	$this->input->post('fname'),
							'email' =>	$this->input->post('email'),
							'phone' =>	$this->input->post('phone'),
							'address' =>	$this->input->post('address'),			
							'state' =>	$this->input->post('state'),
							'city' =>	$this->input->post('city'),
							'pincode' =>	$this->input->post('pincode'),
							'gstin' =>	$this->input->post('gstin')
						),'BILLING_DETAILS'
					);
					$this->order_model->set_order_meta($ord_no,$comp_id,$user_id,array(
							'fname' =>	$this->input->post('shipping_fname'),
							'email' =>	$this->input->post('shipping_email'),
							'phone' =>	$this->input->post('shipping_phone'),
							'address' =>	$this->input->post('shipping_address'),			
							'state' =>	$this->input->post('shipping_state'),
							'city' =>	$this->input->post('shipping_city'),
							'pincode' =>	$this->input->post('shipping_pincode'),
						),'SHIPPING_DETAILS'
					);
					$this->session->set_flashdata('message','Your order is successfully placed');
					redirect(base_url("order/invoice/".$ord_no), "refresh");			
				}
			}		
		}else{
			$this->session->set_flashdata('message', validation_errors());
			redirect('buy/checkout');
		}
	}


	
	public function index(){
		$data = array();
		$this->load->view('payment/payment-pending',$data);        
	  }
	  public function payment_success(){	       
		$data['res'] = $res = $_POST;
		$ins_arr = array(
					'uid'   => $this->session->user_id,
					'status'=> $res['status'],
					'txnid' => $res['txnid'],
					'amount'=> $res['amount'],
					'response'   => json_encode($res)
				  );    
		if ($res['status'] == 'success') {
		  $this->user_model->set_user_meta($this->session->user_id,array('payment_status'=>1));
		}
		if(!$this->db->where('txnid',$ins_arr['txnid'])->from('payment_history')->count_all_results()){      
		  $this->Payment_model->save_payment_response($ins_arr);          
		}    
			$this->load->view('payment/order-success',$data);    
	  }
	  public function payment_failed(){	   
		$data['res'] = $res = $_POST;
		$ins_arr = array(
					'uid'   => $this->session->user_id,
					'status'=> $res['status'],
					'txnid' => $res['txnid'],
					'amount'=> $res['amount'],
					'response'   => json_encode($res)
				  );
		if(!$this->db->where('txnid',$ins_arr['txnid'])->from('payment_history')->count_all_results()){      
		  $this->Payment_model->save_payment_response($ins_arr);          
		}
			$this->load->view('payment/order-fail',$data);    
	  }  
	  public function pay_method($amt_id = null,$keyword = null) {
		  if($keyword=='payumoney'){
		$data['title'] = 'Payment';
		$data['content'] = $this->load->view('payment/payment-form', $data);
		$this->load->view('layout/main_wrapper', $data);
		  }else if($keyword=='razorpay'){
		$data['title'] = 'Razor Pay';
		$data['content'] = $this->load->view('razorpay/index', $data, true);
		$this->load->view('layout/main_wrapper', $data);	  
		  }
	  }
	  
	 public function razorpay_success($id) {
		//$this->db->set('pay_status', '1');//if 2 columns
        //$this->db->where('id', $id);
        //$this->db->update('tbl_payment');
		$data['title'] = 'Razor Pay Success';
		$data['content'] = $this->load->view('razorpay/success', $data, true);
		$this->load->view('layout/main_wrapper', $data);	  
	  }
    
	public function razorpay_failed($id) {
		//$this->db->set('pay_status', '0');//if 2 columns
        //$this->db->where('id', $id);
        //$this->db->update('tbl_payment');
		$data['title'] = 'Razor Pay Success';
		$data['content'] = $this->load->view('razorpay/failed', $data, true);
		$this->load->view('layout/main_wrapper', $data);	  
	  }
	  
	  
	  public function razorpay_payment_final() {
		if (!empty($_POST['razorpay_payment_id']) && !empty($_POST['merchant_order_id'])) {
			$json = array();
			$razorpay_payment_id = $_POST['razorpay_payment_id'];
			$merchant_order_id = $_POST['merchant_order_id'];
			$currency_code = $_POST['currency_code_id'];
			$pay_typ = $_POST['merchant_pay_typ'];
			// store temprary data
			$dataFlesh = array(
			    'card_holder_name' => $_POST['card_holder_name_id'],
			    'merchant_amount' => $_POST['merchant_amount'],
			    'merchant_total' => $_POST['merchant_total'],
			    'surl' => $_POST['merchant_surl_id'],
			    'furl' => $_POST['merchant_furl_id'],
			    'currency_code' => $currency_code,
			    'order_id' => $_POST['merchant_order_id'],
			    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
			);

			$paymentInfo = $dataFlesh;
			$order_info = array('order_status_id' => $_POST['merchant_order_id']);
			$amount = $_POST['merchant_total'];
			$currency_code = $_POST['currency_code_id'];
			// bind amount and currecy code
			$data = array(
			    'amount' => $amount,
			    'currency' => $currency_code,
			);
			$success = false;
			$error = '';
			try {
			    $ch = $this->get_curl_handle($razorpay_payment_id, $data);
			    //execute post
			    $result = curl_exec($ch);
			    $data = json_decode($result);
			  
			    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			    if ($result === false) {
			        $success = false;
			        $error = 'Curl error: ' . curl_error($ch);
			    } else {
			        $response_array = json_decode($result, true);
			        //Check success response
			        if ($http_status === 200 and isset($response_array['error']) === false) {
			            $success = true;
			        } else {
			            $success = false;
			            if (!empty($response_array['error']['code'])) {
			                $error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
			            } else {
			                $error = 'Invalid Response <br/>' . $result;
			            }
			        }
			    }
			    //close connection
			    curl_close($ch);
			} catch (Exception $e) {
			    $success = false;
			    $error = 'Request to Razorpay Failed';
			}
			if ($success === true) {
				/*$data = array(
			        'uid'=>$this->session->user_id,
			        'method'=>'Rozar Pay',
					'ins_id'=>$_POST['merchant_insid'],
			        'status'=>'Success',
					'txnid'=>$_POST['razorpay_payment_id'],
			        'amount'=>$_POST['merchant_amount'],
					'response'=>$result
			    );*/

			    //$this->db->insert('payment_history',$data);

                if($pay_typ=='s'){

                    /*$this->db->set('onetime_mode','2');
                    $this->db->set('link_status','1');
                    $this->db->set('onetime_pay_amt',$_POST['merchant_amount']);
                    $this->db->where('id',$_POST['merchant_insid']);
                    $this->db->update('tbl_payment');*/

                    $this->db->select('tbl_payment.id,enquiry.aasign_to,enquiry.enquiry_id,enquiry.Enquery_id,tbl_admin.s_display_name,tbl_admin.last_name,');
                    $this->db->from('tbl_payment');
                    $this->db->join('enquiry','enquiry.Enquery_id=tbl_payment.enq_id','left');
                    $this->db->join('tbl_admin','tbl_admin.pk_i_admin_id=enquiry.aasign_to','left');
                    $this->db->where('tbl_payment.id',$_POST['merchant_insid']);
                    $noti = $this->db->get()->row();

                    $redirect_id = $noti->enquiry_id;
                    /*$task_date = date("d-m-Y");
	                $task_time = date("h:i:s");
	                $create_by = $this->session->user_id;
	                $subject = 'Payment Done!';
	                $stage_remark = 'Dear '.$noti->s_display_name.' '.$noti->last_name.', Greetings from Godspeed Immigration. We wish to Inform you that a payment Amount '.$_POST['merchant_amount'].' by User '.$noti->Enquery_id.'. If already notified please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
                    $this->user_model->add_comment_for_student_user($noti->Enquery_id,$noti->aasign_to,$subject,$stage_remark,$task_date,$task_time,$create_by);

                    $this->Leads_Model->add_comment_for_events('Payment Done Successfully of Amount '.$_POST['merchant_amount'].' Rs.', $noti->Enquery_id);*/

                }else{

                	/*$this->db->set('typpay','2');
                	$this->db->set('link_status','1');
                    $this->db->set('recieved_amt',$_POST['merchant_amount']);
                    $this->db->where('id',$_POST['merchant_insid']);
                    $this->db->update('tbl_installment');*/


                    $this->db->select('tbl_installment.id,enquiry.aasign_to,enquiry.enquiry_id,enquiry.Enquery_id,tbl_admin.s_display_name,tbl_admin.last_name,');
                    $this->db->from('tbl_installment');
                    $this->db->join('enquiry','enquiry.Enquery_id=tbl_installment.enq_id','left');
                    $this->db->join('tbl_admin','tbl_admin.pk_i_admin_id=enquiry.aasign_to','left');
                    $this->db->where('tbl_installment.id',$_POST['merchant_insid']);
                    $noti = $this->db->get()->row();

                    $redirect_id = $noti->enquiry_id;
                    /*$task_date = date("d-m-Y");
	                $task_time = date("h:i:s");
	                $create_by = $this->session->user_id;
	                $subject = 'Payment Done!';
	                $stage_remark = 'Dear '.$noti->s_display_name.' '.$noti->last_name.', Greetings from Godspeed Immigration. We wish to Inform you that a payment Amount '.$_POST['merchant_amount'].' by User '.$noti->Enquery_id.' has been Done. If already notified please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
                    $this->user_model->add_comment_for_student_user($noti->Enquery_id,$noti->aasign_to,$subject,$stage_remark,$task_date,$task_time,$create_by);

                    $this->Leads_Model->add_comment_for_events('Payment Done Successfully of Amount '.$_POST['merchant_amount'].' Rs.', $noti->Enquery_id);*/

                }

			    if (!$order_info['order_status_id']) {
			       $json['redirectURL'] = $_POST['merchant_surl_id'].'/'.$redirect_id.'/'.base64_encode('payment');
			    } else {
			       $json['redirectURL'] = $_POST['merchant_surl_id'].'/'.$redirect_id.'/'.base64_encode('payment');
			    }
			} else {
				/*$data = array(
			        'uid'=>$this->session->user_id,
			        'method'=>'Rozar Pay',
					'ins_id'=>$_POST['merchant_insid'],
			        'status'=>'Failed',
					'txnid'=>$_POST['razorpay_payment_id'],
			        'amount'=>$_POST['merchant_amount'],
					'response'=>$result
			    );

			    $this->db->insert('payment_history',$data);*/

			    $this->db->select('tbl_installment.id,enquiry.aasign_to,enquiry.enquiry_id,enquiry.Enquery_id,tbl_admin.s_display_name,tbl_admin.last_name,');
                    $this->db->from('tbl_installment');
                    $this->db->join('enquiry','enquiry.Enquery_id=tbl_installment.enq_id','left');
                    $this->db->join('tbl_admin','tbl_admin.pk_i_admin_id=enquiry.aasign_to','left');
                    $this->db->where('tbl_installment.id',$_POST['merchant_insid']);
                    $noti = $this->db->get()->row();

                    $redirect_id = $noti->enquiry_id;
                    /*$task_date = date("d-m-Y");
	                $task_time = date("h:i:s");
	                $create_by = $this->session->user_id;
	                $subject = 'Payment Failed!';
	                $stage_remark = 'Dear '.$noti->s_display_name.' '.$noti->last_name.', Greetings from Godspeed Immigration. We wish to Inform you that a payment Amount '.$_POST['merchant_amount'].' by User '.$noti->Enquery_id.' has been Failed. If already notified please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
                    $this->user_model->add_comment_for_student_user($noti->Enquery_id,$noti->aasign_to,$subject,$stage_remark,$task_date,$task_time,$create_by);

                    $this->Leads_Model->add_comment_for_events('Payment Failed of Amount '.$_POST['merchant_amount'].' Rs.', $noti->Enquery_id);*/

			    $json['redirectURL'] = $_POST['merchant_furl_id'].'/'.$redirect_id.'/'.base64_encode('payment');
			}
			  $json['msg'] = '';
			} else {
			 $json['msg'] = 'An error occured. Contact site administrator, please!';
			}
			echo json_encode($json);	  
	  }
	  
	  
	function get_curl_handle($payment_id, $data) {
	    $url = 'https://api.razorpay.com/v1/payments/' . $payment_id . '/capture';
	    $key_id = $this->session->key_id;
	    $key_secret = $this->session->key_secret;
	    $params = http_build_query($data);
	    //cURL Request
	    $ch = curl_init();
	    //set the url, number of POST vars, POST data
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	    return $ch;
	}
	  
	
	public function paylist()
	{
		if(isset($_POST["downloadexel"])){
            $sdate = $this->common_model->cleandate('startdate');
            $edate = $this->common_model->cleandate('enddate');
			$this->downloadexel($sdate,$edate);			
			echo "<script> window.location='".base_url('payment')."';</script>";
		}
		$this->load->model("payment_model");
		$data["payments"] = $this->payment_model->payments(1);		
		$data['product'] = $this->payment_model->getProduct();
		if(isset($_POST['type']))
		{
			//$this->load->template("datatable/payment", $data);
		}
		$data['content'] = $this->load->view('payment/payment-list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
	}

	public function downloadexel($sdate,$edate)
    {
		
		$this->load->model("datatable_model");
		$this->load->model("payment_model");
		
		$this->load->library("excel");
        $payment = $this->datatable_model->payments(1);
        //print_r($payment);die;
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()
					->setCreator("Cona")
					->setLastModifiedBy($this->session->fname)
					->setTitle("Payment Information")
					->setSubject("Payment excel")
					->setDescription("Payment")
					->setKeywords("Payment");
					
	    /*	$objPHPExcel->getActiveSheet()
            ->getStyle("A1:P1")
            ->getFont()
            ->setSize(18); */
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getFont()->setBold(true);
		
		$rowarr = array("Sr No", "Order", "Product", "Total Pay","Pay","Balance","Mode", "Transaction No","Status","Payment Date");
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		$ltr = 'A';
		foreach($rowarr as $ind => $val){
			
			$objPHPExcel->getActiveSheet()->setCellValue($ltr."1", $val);
			
			$ltr++;
		}
		$pending   = $totprice = $totqty = 0;
		$count     = 1;
		
		if(!empty($payment)){
			foreach($payment as $ind => $ord) {
			 	$ltr = 'A';
				$count  =  $count + 1;
				
				$objPHPExcel->getActiveSheet()->SetCellValue( ($ltr++).$count, $count - 1)
											  ->SetCellValue( ($ltr++).$count, $ord->ord_no)
											  ->SetCellValue( ($ltr++).$count, $ord->product)
											  ->SetCellValue( ($ltr++).$count, $ord->tot_pay)
											  ->SetCellValue( ($ltr++).$count, $ord->pay)
											  ->SetCellValue( ($ltr++).$count, $ord->balance)
											  ->SetCellValue( ($ltr++).$count, $ord->pay_mode)
											  ->SetCellValue( ($ltr++).$count, $ord->transaction_no)
                                              ->SetCellValue( ($ltr++).$count, $ord->status)
                                              ->SetCellValue( ($ltr++).$count, date("d-M-Y",strtotime($ord->pay_date)));

			
			}
		}
            $objPHPExcel->getActiveSheet()->setTitle('Payment('.count($payment).')');
            $objPHPExcel->setActiveSheetIndex(0);
            
            $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
            
            $fname = "payments_".date("y_m_d").".xls";
            
            header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$fname.'"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
		
		
		
	}
	
	public function add($ordno = ""){
		
		if(isset($_POST["orderid"])){ 
			
			$this->savepayment();
			redirect(base_url("payment/add/".$ordno), "refresh");
		}
		
		$this->load->model("order_model");
		$this->load->model("payment_model");
		$data["title"] = "Add Payment";
		
		$data["ord"]      = $this->order_model->getOrder($ordno);
		$data["orders"]   = $this->order_model->getOrdersProduct($ordno);
		
		//$data["masters"]  = $this->payment_model->getmaster();	
		
		if(!empty($data["ord"]->ord_no)){
			
			$data["payments"] = $this->payment_model->getpayment($data["ord"]->ord_no);
			
		}
		
		$data['content'] = $this->load->view('payment/add-payment', $data, true);
        $this->load->view('layout/main_wrapper', $data);
	}
	
	public function update($payno = ""){
		
		if(isset($_POST["paymentid"])){
			
			$this->savepayment();
			redirect(base_url("payment/add/".$_POST["orderid"]), "refresh");
		}
		
		$this->load->model("order_model");
		$this->load->model("payment_model");
		$payno = base64_decode($payno);
		//echo $payno;
		$data['paydata'] = $this->db->select('*')->from('payment')->where('id',$payno)->get()->row();
	//	$data["masters"]  = $this->payment_model->getmaster();	
		$data["title"] = "Update Payment";
		$data['content'] = $this->load->view("payment/update-payment", $data,true);
		$this->load->view('layout/main_wrapper', $data);
	}
	
	public function savepayment(){
		
		
		$arr = array(
					"pay" 			 => $this->input->post("payment", true),
					"balance" 		 => $this->input->post("balance", true),
					"pay_mode" 		 => $this->input->post("paymode", true),
					"transaction_no" => $this->input->post("transactiono", true),
					"status" 		=> $this->input->post("status", true),
					"pay_date" 		=> date("Y-m-d",strtotime($this->input->post("paydate", true))), 
					"next_pay"		=> date("Y-m-d",strtotime($this->input->post("nextpay", true))),
					"remark" 		=> $this->input->post("remarks", true),
				//	"advance_pay"	 => (!empty($_POST["advbalance"])) ? $this->input->post("advbalance", true) : 0,
						
					);
		//print_r($arr);die;
	
		if(isset($_POST["paymentid"])){
			
			$this->db->where("id", $this->input->post("paymentid", true));
			$this->db->where("company", $this->session->companey_id);
			$this->db->update("payment", $arr);
			$ret  = $this->db->affected_rows();
		}else{
			$arr["prev_balance"] = (!empty($_POST["prevbalance"])) ? $this->input->post("prevbalance", true) : 0;
				
			$arr["ord_id"] 		 = $this->input->post("orderid", true);
			$arr["tot_pay"]		 = $this->input->post("totalpay", true);
			$arr["company"]      = $this->session->companey_id;		
			$arr["cust_id"] 	 = $this->input->post("customer", true);
			$arr["added_by"]	 = $this->session->user_id;
			$arr["created_date"] = date("Y-m-d h:i:s");
			$arr["approve"] = 1;
			
			
			$ret  = $this->db->insert("payment", $arr);  
		
		}
		
		if($ret){
			
		
			$this->session->set_flashdata("message", "Successfully saved");
		}else{
			$this->session->set_flashdata("message", "Failed to saved");
			
		}
	
	}
	
	public function cleandate($post){
		
		$pdate = $this->input->post($post, true);
		
		if(!empty($pdate)) {
			$pdate = str_replace("/", "-", $pdate);
			
			$darr  = explode("-", $pdate); 
			
			return date("Y-m-d", strtotime($darr[2]."-".$darr[0]."-".$darr[1]));
		}
		
	}
#--------------------send payment link to student godspeed Start--------------------------------#
public function payment_link_send($ins_id = null,$enq_no = null,$keyword = null,$hint = null){
if($hint=='m'){
	$this->db->set('link_status','0');
    $this->db->where('id',$ins_id);
    $this->db->update('tbl_installment');
}else if($hint=='s'){
	$this->db->set('link_status','0');
    $this->db->where('id',$ins_id);
    $this->db->update('tbl_payment');
}	
    $this->db->select('email,Enquery_id,name_prefix,name,lastname,phone,comp_id,aasign_to,all_assign');
    $this->db->from('enquiry');
    $this->db->where('enquiry_id',$enq_no);
    $this->db->limit(1);
    $q = $this->db->get()->row();
    //$subject = 'Payment Reminder From Godspeed Team';
    //$message = 'Login To Portal OR Click On Payment link : '.base_url('payment/pay_method').'';	
	//$this->Message_models->send_email($q->email,$subject,$message);

	/*******************************************notification start********************************************/
	if($hint=='m'){
	$this->db->select('pay_date,pay_amt');
    $this->db->from('tbl_installment');
    $this->db->where('id',$ins_id);
    $this->db->limit(1);
    $q2 = $this->db->get()->row();
    $rdate = $q2->pay_date;
    $pamt = $q2->pay_amt;
	}else if($hint=='s'){
	$this->db->select('onetime_pay_date,taxabal_amt,advance');
    $this->db->from('tbl_payment');
    $this->db->where('id',$ins_id);
    $this->db->limit(1);
    $q2 = $this->db->get()->row();
    if(!empty($q2->advance)){ $adv=$q2->advance;}else{$adv='0';}
    $rdate = $q2->onetime_pay_date;
    $pamt  = $q2->taxabal_amt-$adv;	
	}
//For sent mail and SMS Payment Link Start
	$email = $q->email;
	$phone = $q->phone;
	$prefix = $q->name_prefix??'';
	$name = $q->name;
	$company = $q->comp_id;
	$enq_id = $q->Enquery_id;
	$aasign_to = $q->aasign_to;
	$lastname = $q->lastname??'';
	$all_assign = $q->all_assign??'';
	$resp = $this->create_payment_link($email,$phone,$pamt,$prefix,$name,$lastname);

$send_url =	json_decode($resp)->short_url;
$this->send_ms_payment_link($send_url,$company,$aasign_to,$email,$phone,$prefix,$name,$lastname,$enq_id,$all_assign);
//For sent mail and SMS Payment Link end 

    $this->db->select('pk_i_admin_id');
    $this->db->from('tbl_admin');
    $this->db->where('s_phoneno',$q->phone);
    $this->db->limit(1);
    $q3 = $this->db->get()->row();

	$related_to = $q3->pk_i_admin_id;
	$create_by = '0';
	$subject = 'Payment Reminder';
	$tempData = $this->apiintegration_Model->get_reminder_templates(4);
	$stage_remark='';
	if($tempData->num_rows()==1){
		$tempData=$tempData->row();
		$stage_remark=$tempData->message;
		$duedate=date("d-m-Y", strtotime($rdate));
		$stage_remark = str_replace("@prefix",$q->name_prefix,$stage_remark);   
        $stage_remark = str_replace("@firstname",$q->name,$stage_remark);  
        $stage_remark = str_replace("@lastname",$q->lastname,$stage_remark);  
		$stage_remark = str_replace("@amount",$pamt,$stage_remark);  
		$stage_remark = str_replace("@duedate",$duedate,$stage_remark);  
	}
	// $stage_remark = 'Dear '.$q->name_prefix.'. '.$q->name.' '.$q->lastname.', Greetings from Godspeed Immigration. We wish to remind you that an payment Amount '.$pamt.' due on '.date("d-m-Y", strtotime($rdate)).'. If already paid please ignore. GODSPEED IMMIGRATION & STUDY ABROAD PVT LTD.';
	$task_date = date("d-m-Y");
	$task_time = date("h:i:s");
	 $this->user_model->add_comment_for_student_user($enq_id,$related_to,$subject,$stage_remark,$task_date,$task_time,$create_by);
	/*******************************************notification end**********************************************/
		if($keyword=='enquiry'){
                $this->session->set_flashdata('message', 'Send successfully');
                redirect('enquiry/view/'.$enq_no.'/'.base64_encode('payment'));
            }else if($keyword=='lead'){
                $this->session->set_flashdata('message', 'Send successfully');
                redirect('lead/lead_details/'.$enq_no.'/'.base64_encode('payment'));
            }else{
                $this->session->set_flashdata('message', 'Send successfully');
                redirect('client/view/'.$enq_no.'/'.base64_encode('payment'));
            }
}	
#----------------send payment link to student godspeed End-------------------------#	
//----------------For Create Payment Link Start-------------------//
public function create_payment_link($email,$phone,$pamt,$name_prefix,$name,$lastname){
$phone = '+91'.$phone;
$name = $name_prefix.' '.$name.' '.$lastname;
$pamt = $pamt.'00';

$RAZOR_KEY_ID = $this->session->key_id;
$RAZOR_KEY_SECRET =  $this->session->key_secret;
$fourRandomDigit = mt_rand(1000,9999);
$ref_id = 'GS'.$fourRandomDigit;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.razorpay.com/v1/payment_links/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{  "amount": '.$pamt.',  "currency": "INR",  "accept_partial": false,  "first_min_partial_amount": 0,  "expire_by": 1691097057,  "reference_id": "'.$ref_id.'",  "description": "Payment for policy no #23456",  "customer": {    "name": "'.$name.'",    "contact": "'.$phone.'",    "email": "'.$email.'"  },  "notify": {    "sms": false,    "email": false  },  "reminder_enable": true,  "notes": {    "policy_name": "Jeevan Bima"  },  "callback_url": "https://desk.godspeedvisa.com/login",  "callback_method": "get"}',
  CURLOPT_HTTPHEADER => array(
    'Content-type: application/json',
    '$RAZOR_KEY_ID: $RAZOR_KEY_SECRET',
    'Authorization: Basic cnpwX3Rlc3RfbGRUSDlhaXdkaFFIeDc6MnJZcXdieFBHZUx4RFh4NkVzVm5DSG1x'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;
}
//----------------For Create Payment Link End-------------------//

//Link sent on SMS and Email
public function send_ms_payment_link($send_url,$company,$aasign_to,$email,$phone,$prefix,$name,$lastname,$enq_id,$all_assign){
    $message= $this->db->where(array('temp_id'=>'341','comp_id'=>$company))->get('api_templates')->row();
if(!empty($send_url)){
$pay_link = '<a href="'.$send_url.'" targrt="_blank" style="text-decoration: underline;color:blue;">'.$send_url.'</a>';
}
    //For Sender details
        $this->db->select('pk_i_admin_id,s_display_name,last_name,designation,s_user_email,s_phoneno,telephony_agent_no');
        $this->db->where('companey_id',$company);
        $this->db->where('pk_i_admin_id',$aasign_to);
        $sender_row =   $this->db->get('tbl_admin')->row_array();
if(!empty($sender_row['telephony_agent_no'])){
	$senderno = '0'.$sender_row['telephony_agent_no'];
}else{
	$senderno = $sender_row['s_phoneno'];
}
//Email code start here
            $this->db->select('user_protocol as protocol,user_host as smtp_host,user_port as smtp_port,user_email as smtp_user,user_password as smtp_pass');
            $this->db->where('companey_id',$company);
            $this->db->where('pk_i_admin_id',$aasign_to);
            $email_row  =   $this->db->get('tbl_admin')->row_array();
            if(empty($email_row['smtp_user'] && $email_row['smtp_pass'])){
            $this->db->where('comp_id',$company);
            $this->db->where('status',1);
            $email_row  =   $this->db->get('email_integration')->row_array();
            }

            if(empty($email_row)){
                echo "Email is not configured";
                exit();
            }else{

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
            }

$email_subject = $message->mail_subject;
$stage_remark = 'Payment Link Sent On Email And SMS Please Check!';
            $data['message'] = $message->template_content;
            $template = $this->load->view('templates/enquiry_email_template', $data, true);             
            $new_message = $template;

                    $new_message = str_replace('@name', $name.' '.$lastname,$new_message);
                    $new_message = str_replace('@phone', $phone,$new_message);
                    $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
                    $new_message = str_replace('@userphone', $senderno,$new_message);
                    $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
                    $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
                    $new_message = str_replace('@email', $email,$new_message);
                    $new_message = str_replace('@password', '12345678',$new_message);
                if(!empty($pay_link)){
                    $new_message = str_replace('@link', $pay_link,$new_message);
                }
$to = $email;

                $this->email->initialize($config);
                $this->email->from($email_row['smtp_user']);                        
                $this->email->to($to);
                $this->email->subject($email_subject); 
                $this->email->message($new_message);               
                if($this->email->send()){
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Sent.', $enq_id,'0',$sender_row['pk_i_admin_id'],$new_message,'3','1',$email_subject);
                echo "Email Sent Successfully!";
                }else{
            $comment_id = $this->Leads_Model->add_comment_for_events('Email Failed.', $enq_id,'0',$sender_row['pk_i_admin_id'],$new_message,'3','0',$email_subject);
                        echo "Something went wrong";                                
                }
//For bell notification
$z = explode(',',$all_assign);
foreach ($z as $key => $aa) {
            $task_date = date("d-m-Y");
            $task_time = date("h:i:s");
        if(!empty($aa)){
            $this->user_model->add_comment_for_student_user($enq_id,$aa,$email_subject,$stage_remark,$task_date,$task_time,$sender_row['pk_i_admin_id']);
        }
}
//For Sms Sent

if(!empty($phone)){
 $sms_message= $this->db->where(array('temp_id'=>'340','comp_id'=>$company))->get('api_templates')->row()->template_content;

            $new_message = $sms_message;
            $new_message = str_replace('@name', $name.' '.$lastname,$new_message);
            $new_message = str_replace('@phone', $phone,$new_message);
            $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
            $new_message = str_replace('@userphone', $senderno,$new_message);
            $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
            $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
            $new_message = str_replace('@email', $email,$new_message);
            $new_message = str_replace('@password', '12345678',$new_message);
        if(!empty($send_url)){
            $new_message = str_replace('@link', $send_url,$new_message);
        }
    $phone = $phone;               
                $this->Message_models->smssend($phone,$new_message,$company,$sender_row['pk_i_admin_id']);
    
    $enq_id=$enq_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('SMS Sent.', $enq_id,'0',$sender_row['pk_i_admin_id'],$new_message,'2','1');
                echo "Message sent successfully"; 
                }
//For Whatsapp Sent

if(!empty($phone)){
 $sms_message= $this->db->where(array('temp_id'=>'339','comp_id'=>$company))->get('api_templates')->row()->template_content;

            $new_message = $sms_message;
            $new_message = str_replace('@name', $name.' '.$lastname,$new_message);
            $new_message = str_replace('@phone', $phone,$new_message);
            $new_message = str_replace('@username', $sender_row['s_display_name'].' '.$sender_row['last_name'],$new_message);
            $new_message = str_replace('@userphone', $senderno,$new_message);
            $new_message = str_replace('@designation', $sender_row['designation'],$new_message);
            $new_message = str_replace('@useremail', $sender_row['s_user_email'],$new_message);
            $new_message = str_replace('@email', $email,$new_message);
            $new_message = str_replace('@password', '12345678',$new_message);
        if(!empty($send_url)){
            $new_message = str_replace('@link', $send_url,$new_message);
        }

    $phone='91'.$phone;               
                $this->Message_models->sendwhatsapp($phone,$new_message,$company,$sender_row['pk_i_admin_id']);
    
    $enq_id=$enq_id;
    $comment_id = $this->Leads_Model->add_comment_for_events('Whatsapp Sent.', $enq_id,'0',$sender_row['pk_i_admin_id'],$new_message,'1','1');
                echo "Message sent successfully"; 
                } 

}

//For Payment Details
public function get_pay_details($pid='',$type){
	if($type=='m'){
        $this->db->select('*');
        $this->db->from('payment_history');
        $this->db->where('ins_id',base64_decode($pid));
        $res=$this->db->get()->row();
        $payment = json_decode($res->response);
    }
$amount = substr($payment->payload->payment->entity->amount, 0, -2)??'NA';
$card   = $payment->payload->payment->entity->card->type??'NA';
$last4   = $payment->payload->payment->entity->card->last4??'NA';
$card_network   = $payment->payload->payment->entity->card->network??'NA';
$bank   = $payment->payload->payment->entity->bank??'NA';
        if(!empty($res->ins_id)){

        echo '<table class="table table-bordered table-hover">
                        <tr>
                            <th>Amount</th>
                            <th>Card Type</th>
                            <th>Last 4</th>
                            <th>Network</th>
                            <th>Bank</th>
                        </tr>';                  
            echo    '<tr>
                        <td>'.$amount.'</td>
                        <td>'.$card.'</td>
                        <td>'.$last4.'</td>
                        <td>'.$card_network.'</td>
                        <td>'.$bank.'</td>
                    </tr>';
            echo '</table>';

        }else{
        	echo '0';
        }
    }

}	
?>