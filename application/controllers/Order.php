<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {
	
    public function __construct() {
		
		 parent::__construct();
		 
		$this->load->model("order_model");
	}
	
	public function index(){
		
		if(isset($_POST["downloadexel"])){
			
			$this->downloadexel();
			
			echo "<script> window.location='".base_url('order') ."';</script>";
			
		}
		$this->load->model("User_model");
		$this->load->model("Product_model");
		$data["orders"] = $this->order_model->orders(1);
		$data['seller_list'] = $this->User_model->read('Seller');
		$data['product_list'] = $this->Product_model->productlist();
	//	$this->load->template("order/order-list", $data);
		
	    $data['content'] = $this->load->view('order/order-list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
		
	}
	
	public function add(){
		
		if(isset($_POST["product"])){
			$this->saveorder2();
		}
		
		$this->load->model("Product_model");
		$this->load->model("warehouse_model");
		
		$data["title"]   = "Add Order";
		$data['products'] = $this->Product_model->productlist();
		$data['brands'] = $this->warehouse_model->brand_list();
		$data['warehouse']    = $this->warehouse_model->warehouse_list();
        $currdate = date("Y-m-d");
		$data['scheme'] = $this->db->select("*")->where("comp_id", $this->session->companey_id)->where("from_date <= '$currdate' and to_date >= '$currdate'")->get("tbl_scheme")->result();
		
		$data['content'] = $this->load->view('order/add-order', $data, true);
		
        $this->load->view('layout/main_wrapper', $data);
		
	}
	public function addorder(){
		
		
		if(isset($_POST["proname"])){
			
			$this->saveorder();
		}
		
		$data['title'] = 'Add Order';
		$this->load->model("warehouse_model");
		$data['warehouse']    = $this->warehouse_model->warehouse_list();
        
		$data['products'] = $this->db->select("tbl_proddetails.*,tbl_product_country.country_name as product_name")
									 ->where("comp_id", $this->session->companey_id)
									 ->from("tbl_product_country")
									 ->join("tbl_proddetails", "tbl_product_country.id = tbl_proddetails.prodid")->get()->result();

		$currdate = date("Y-m-d");
		$data['scheme'] = $this->db->select("*")->where("comp_id", $this->session->companey_id)->where("from_date <= '$currdate' and to_date >= '$currdate'")->get("tbl_scheme")->result();
		
		
		$data['content'] = $this->load->view('product/add-order', $data, true);
        $this->load->view('layout/main_wrapper', $data);
		
	}
	public function saveorder(){
		
		$price 	  = $this->input->post("rate", true);
		$discount = $this->input->post("discount", true);
		$otrprice = $this->input->post("othrprice", true);
		$tax 	  = $this->input->post("tax", true);
		$total    = $price + $otrprice + $tax - $discount;
		
		$ordno = "ORD".strtotime(date("y-m-d h:i:s"));
		
		$tqty = $this->input->post("quantity", true);
		$cqty = $this->input->post("cnfquantity", true);
		$rqty = $tqty - $cqty;
				
		$insarr = array("ord_no"  		=> $ordno, 
						"cus_id"  		=> $this->session->user_id,
						"enq_no"  		=> "",
						"warehouse" 	=> $this->input->post("warehouse", true),
						"product"		=> $this->input->post("proname", true),
						"scheme"    	=> "",
						"quantity"		=> $this->input->post("quantity", true), 
						"price"			=> $price,
						"other_price"	=> $otrprice,
						"conf_delv"     => $cqty,
						"pend_delv"     => $rqty,
						"delvr_date"	=> $this->input->post("delvrdate", true),
						"next_date"		=> $this->input->post("penddelvr", true),
						"total_price"	=> $total,
						"offer"			=> $discount,
						"details"		=> $this->input->post("details", true),
						"disc_meth"		=> "",
						"disc_price"	=> "",
						"disc_type" 	=> "",
						"tax"			=> $this->input->post("tax", true),
						"addedby"		=> $this->session->user_id,
						"order_date"	=> date("Y-m-d h:i:s"),
						"status"		=> 1,
						"company"		=> $this->session->companey_id,
						);
		
			$ret   = $this->db->insert("tbl_order", $insarr);
			$ordid = $this->db->insert_id(); 
			
			if($ret and $ordid and  !empty($_POST["cnfquantity"])){
				
			
				
				$insarr = array("ord_id" 		=> $ordid,
								"ord_no" 		=> $ordno,
								"ord_prdby_id"  => 0,
								"product"		=> $this->input->post("proname", true),
								"price"         => $price,
								"tax"           => $this->input->post("tax", true),
								"tot_price"		=> $total,
								"ofr_price"		=> $discount,
								"tot_qty"		=> $tqty,
								"delv_qty"      => $cqty,
								"pending_qty"   => $rqty,
								"deliver_by"    => "",
								"added_by"		=> "",
								"remark"		=> "",
								"status"		=> $this->input->post("status", true),
								"created_date"	=> date("Y-m-d h:i:s"),
								"delivery_date" => date("Y-m-d", strtotime($this->input->post("delvrdate", true))),
								"pending_deliver" => date("Y-m-d", strtotime($this->input->post("penddelvr", true))),
								"cust_id"		=> $this->session->user_id,
								"company"		=> $this->session->companey_id
								);
				
				$this->db->insert("delivery", $insarr);
				
			}
			
			if ($ret) {
				$this->session->set_flashdata('message', "Successfully saved");
			} else {
				$this->session->set_flashdata('exception', "Failed to saved");
			}
		
	}
	public function saveorder2(){
		
		$ordno = "ORD".strtotime(date("y-m-d h:i:s"));
		
		$this->form_validation->set_rules("warehouse", "Warehouse", "trim|required");
		$this->form_validation->set_rules("product", "Product", "trim|required");
		$this->form_validation->set_rules("quantity", "Quantity", "trim|required");
		$this->form_validation->set_rules("price","Price", "trim|required");
		
		if($this->form_validation->run()) {
		$arr = array("ord_no"    => $ordno,
					"enq_id"     => "",
					"enq_no"     => "",
					"warehouse"  => $this->input->post("warehouse", true),
					"product"	 => $this->input->post("product", true),
					"scheme"	 => "",
					"quantity"   => $this->input->post("quantity", true),
					"price"		 => $this->input->post("price", true) ,
					"offer"      => $this->input->post("discount", true),
					"disc_meth"  => 0,
					"disc_price" => 0,
					"disc_type"   => 0,
					"other_price"  => 0,
					"total_price" => $this->input->post("price", true) ,
					"addedby"	=> $this->session->user_id	,
					"order_date"  => date("Y-m-d h:i:s"),
					"status"      => 1,
					"company"    => $this->session->companey_id,
					"details"    => $this->input->post("details", true),
					"ip"         => ""); 
		
		$ret = $this->db->insert("tbl_order", $arr);
		
		if($ret){
			
			$this->session->set_flashdata("message", "Successfully Order Placed");
			redirect(base_url("order/add"), "refresh");
		}else{
			$this->session->set_flashdata("error", "Failed to Order Placed");
		}	
		}else{
			$this->session->set_flashdata("error", validation_errors());
		}
	}
	
	public function loadorders(){
		//$this->load->model("datatable_model");		
		$ordarr  	  = $this->order_model->orders(1);

		/*echo $this->db->last_query();

		echo "<pre>";
		print_r($ordarr);
		exit();*/
		//$data["pay"]  = $this->payment_model->getpayments();		
		//$data["dlv"] = $this->order_model-> getAllDilevery();
		$neword = array();
		if(!empty($ordarr)){
			foreach($ordarr as $ind => $ord){				 
				$neword[$ord->ord_no][] = $ord;
			}
		}
		$data["neword"] = $neword;
		//$data["permission"] = $this->getpermission();		
		$this->load->view("order/dt-order", $data);	
	}
	
	
	public function downloadexel(){
		
		$this->load->model("datatable_model");
		$this->load->model("payment_model");
		
		$this->load->library("excel");
		$orders = $this->datatable_model->orders(1);
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()
					->setCreator("Cone")
					->setLastModifiedBy($this->session->fname)
					->setTitle("Order Information")
					->setSubject("Order excel")
					->setDescription("Order")
					->setKeywords("Order");

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getFont()->setBold(true);
		
		$rowarr = array("Sr No", "Order No", "Customer","Product", "Quantity","Confirm","Pending","Scheme", "Price","Discount", "Payment Mode", "Pay", "Balance", "Delivery Date","Date" ,"Status");
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		$ltr = 'A';
		foreach($rowarr as $ind => $val){
			
			$objPHPExcel->getActiveSheet()->setCellValue($ltr."1", $val);
			
			$ltr++;
		}


		$convdelv = (!empty($ord->conf_delv) and $ord->conf_delv != "0000-00-00") ?  date("d, M Y", strtotime($ord->conf_delv)) : " - ";
		$pay  = $this->payment_model->getpayments();
		$pending   = $totprice = $totqty = 0;
		$count     = 1;
		
		if(!empty($orders)){
			foreach($orders as $ind => $ord) {
			 	$ltr = 'A';
				$count  =  $count + 1;
				 $totprice = $ord->total_price;
					if(!empty($pay[$ord->ord_id])){
							
							foreach($pay[$ord->ord_id] as $ind => $py){
								
								$payprice = 0;
						
								$paymode =  $py->	pay_mode;
								$paysts =  $py->status;
								$payprice  = $payprice  + $py->pay;
							}
							
							$balance = $totprice - $payprice;
						}else{
							$paymode = $balance =  $payprice  = " - ";
							
						}
				
						if($ord->status  == 1 ){
							 $ord->status  = "Request";
						}else if($ord->status  == 2 ){
							$ord->status  =  "Waiting";
						}else if($ord->status  == 3 ){
							$ord->status  =  "Half Confirm";
						}else if($ord->status  == 4 ){
							$ord->status  = "Full Confirm";
						}else if($ord->status  == 5 ){
							$ord->status  = "Reject";
						}else{
							$ord->status  = $ord->status; 
						} 
				
				$objPHPExcel->getActiveSheet()->SetCellValue( ($ltr++).$count, $count - 1)
											  ->SetCellValue( ($ltr++).$count, $ord->ord_no)
											  ->SetCellValue( ($ltr++).$count, $ord->customer)
											  ->SetCellValue( ($ltr++).$count, $ord->pro_name)
											  ->SetCellValue( ($ltr++).$count, $ord->quantity)
											  ->SetCellValue( ($ltr++).$count, $ord->confirm_order)
											  ->SetCellValue( ($ltr++).$count, $ord->pending_order)
											  ->SetCellValue( ($ltr++).$count, $ord->scheme)
                                              ->SetCellValue( ($ltr++).$count, $ord->total_price)
                                              ->SetCellValue( ($ltr++).$count, $ord->offer)
                                              ->SetCellValue( ($ltr++).$count,   $paymode)
											  ->SetCellValue( ($ltr++).$count,   (!empty($payprice)) ? $payprice : "  - ")
											  ->SetCellValue( ($ltr++).$count,   $balance)
											  ->SetCellValue( ($ltr++).$count,   $convdelv)
											  ->SetCellValue( ($ltr++).$count,   (!empty($ord->order_date )) ?  date("d, M Y", strtotime($ord->order_date))  : " - ")
											  ->SetCellValue( ($ltr).$count,    $ord->status);

			
			}
		}
   $objPHPExcel->getActiveSheet()->setTitle('Orders('.count($orders).')');
   $objPHPExcel->setActiveSheetIndex(0);
   
   $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
   
   $fname = "orders_".date("y_m_d").".xls";
   
   header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$fname.'"');
   header('Cache-Control: max-age=0');
   $writer->save('php://output');
		
		
		
	}
	
	
	public function view($ordno = ""){
		$this->load->model("location_model");
		if(isset($_POST["orderno"])){
			$this->updatedelivery();
			redirect(base_url("order/view/".$ordno), "refresh");	
		}
		if(empty($ordno)) show_404();
		$data['ord'] = $this->order_model->getOrder($ordno);
		$data['orders'] = $this->order_model->getOrders($ordno);
		if(!empty($data["ord"]->ord_no)) {
			$this->load->model('payment_model');
			$data['payments'] = $this->payment_model->getpayment($data["ord"]->ord_no);
		}
		$data["delivery"]    = $this->order_model->getDilevery($ordno);		
		$order_meta = array('fname','email','phone','address','state','city','pincode','gstin');
		$data['order_meta']	=	$this->order_model->get_order_meta($ordno,$order_meta);
		$data["title"] = $data['ord']->ord_no;		
	   	$data['content'] = $this->load->view('order/order-book', $data, true);
        $this->load->view('layout/main_wrapper', $data);
	}
	
	
	
	
	
	public function booking($ordno = ""){
		$this->load->model('location_model');
	//		$this->load->model("payment_model");
		if(isset($_POST["orderno"])){
			$this->savebooking();
			redirect(base_url("order/view/".$ordno), "refresh");	
		}
		 
		if(empty($ordno)) show_404();
		
		$data['ord'] = $this->order_model->getOrder($ordno);
	
		$data['orders'] = $this->order_model->getOrders($ordno);
		
		if(!empty($data["ord"])) {
			//$data['payments'] = $this->payment_model->getpayment($data["ord"]->cus_id);
		}
		
		$data["schemes"]  = $this->order_model->getCurrentScheme();
		
		$this->load->model("scheme_model");
		$data["schemes"]  = $this->scheme_model->getAllApplyscheme();
		
		
		$data["delivery"] = $this->order_model->getDilevery($ordno);
		$order_meta = array('fname','email','phone','address','state','city','pincode','gstin');
		$data['order_meta']	=	$this->order_model->get_order_meta($ordno,$order_meta);
		$data["title"] = "ORDER : ".$data['ord']->ord_no;
		
		$data['content'] = $this->load->view('order/confirm-order', $data, true);
        $this->load->view('layout/main_wrapper', $data);
		
	}
	
	public function savebooking(){
		echo "<pre>";
		print_r($_POST);
		exit();
		$prdarr    =  $this->input->post("productord", true);
		$cnford    = $this->input->post("productconf", true);
		$remord    = $this->input->post("productrem", true);
		$products  = $this->input->post("products", true);
		$ofrprice  = $this->input->post("totaldiscount", true);
		$arr    = array();
		
		$sckupd    = array();
		$totofr    = 0;
		foreach($prdarr as $ind => $prd){
			
			$arr[] = array("ord_id" => $this->input->post("orderid", true),
						   "ord_no"		  => $this->input->post("orderno", true),
						   "product" 	  =>  $prd,
						   "ofr_price"    => $ofrprice[$ind] ,
						   "tot_qty" =>  "",
						   "delv_qty" => $cnford[$ind],
						   "delivery_date" => $this->cleandate("delvdate"),
						   "pending_deliver"  => $this->cleandate("penddate"),
						   "pending_qty" => $remord[$ind],
						   "added_by" => $this->session->user_id,
						//   "cust_id"	  => $this->input->post("customerno", true),	
						   "company"      => $this->session->companey_id
						   );
			
			$prdid          = $products[$ind] ;
			$sckupd[$prdid] = $cnford[$ind];  
			$totofr   = $totofr + $ofrprice[$ind];
		}
		
		
		$ret = $this->db->insert_batch("delivery", $arr);
	
			$updarr = array( "status" 		 => $this->input->post("deliverstatus", true),
							 "conf_delv" => $this->cleandate("delvdate"),
							 "pend_delv"  => $this->cleandate("penddate"),
							 "offer"      => $totofr
							 );
			$this->db->where("id", $this->input->post("orderid", true));
			$this->db->update("tbl_order", $updarr);	
		
		foreach($sckupd as $prd => $cnf){
			
			
			$tstock = $this->db->select("stock")->where("prodid", $prd)->get("tbl_proddetails")->row()->stock;
			
			$stock  = $tstock - $cnf;
			$updarr = array("stock" => $stock);
					  $this->db->where("id", $prd);	
			$ret    = $this->db->update("tbl_proddetails", $updarr);
			
		}
		
		if($ret){
			$this->session->set_flashdata("message", "successfully update delivery");
			
			
		}else{
			$this->session->set_flashdata("error", "Failed to update delivery");	
		}
		 
		
	}
	
	

	public function bookings(){
		
		$this->load->model("datatable_model");
		
		$data["title"] = "Booking";
		
		$data["bookings"] = $this->datatable_model->bookings(1);
		
		$this->load->template("order/booking-list", $data);
	
	}
	
	public function invoice($ordno = ""){ 
		
		////$this->load->model("payment_model");
		$data['orders'] = $this->order_model->getOrders($ordno);
		$data['buyer_details'] = $this->order_model->getBuyers($ordno);
		if(empty($data['orders'])) show_404();
		
		$data['ord']      = $data['orders'][0];
		$data["delivery"] = $this->order_model->getDilevery($data['ord']->ord_no);
		$ordid 			  = "Order".$data['ord']->ord_no;
		//$data["payment"]  = $this->payment_model->getPaymentByOrder($data['ord']->id);
	
		$data["title"] 	  = $data['ord']->ord_no;
		$this->load->model("location_model");
		$order_meta = array('fname','email','phone','address','state','city','pincode','gstin');
		$data['buyer_details']	=	$this->order_model->get_order_meta($ordno,$order_meta);
		
		$data['order_no'] = $ordno;
		$data['content'] = $this->load->view('order/invoice', $data, true);
        $this->load->view('layout/main_wrapper', $data);
		
	}
	
	public function pdfinvoice($ordno){
		
        ob_end_clean();
		$this->load->model("payment_model");
		$data['orders'] = $this->order_model->getOrders($ordno);
		
		if(empty($data['orders'])) show_404();
		
		$data['ord']      = $data['orders'][0];
		$data["delivery"] = $this->order_model->getDilevery($data['ord']->ord_no);
		$ordid 			  = $data['ord']->ord_no;
		$data["payment"]  = $this->payment_model->getPaymentByOrder($data['ord']->id);
	
		$data["title"] 	  = $data['ord']->ord_no;
		$html = $this->load->view("order/invoice", $data, true);
		/*echo $html;
		exit();*/
	//	$html = $this->load->view("patient/pages/report/pdf-report", $data, true);
		
		//$html = $this->load->view("order/pdf-invoice", $data, true );
        // Load pdf library
        $this->load->library('pdf');
        
        // Load HTML content
		
		
		$this->dompdf->set_option('isRemoteEnabled', true);
		$this->dompdf->set_option('enable_html5_parser', TRUE);
        $this->dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait');
        
        // Render the HTML as PDF
        $this->dompdf->render();
        $this->dompdf->stream($ordno."pdf", array("Attachment"=>0));
		
		
	}
	
	public function cleandate($post){
		
		$pdate = $this->input->post($post, true);
		
		if(empty($pdate)) {
			return NULL;
		}
		$pdate = str_replace("/", "-", $pdate);
		
		$darr  = explode("-", $pdate); 
		
		return date("Y-m-d", strtotime($darr[2]."-".$darr[0]."-".$darr[1]));
		
	}
	
	public function updateorder(){
		
		if(isset($_POST["confirmqty"])){
			
			
			
			$arr = array("confirm_order" => $this->input->post("confirmqty", true),
						 "pending_order" => $this->input->post("pendingqty", true),
						 "status" 		 => $this->input->post("orderstatus", true),
						 "delivery_date" => $this->cleandate("delvdate"),
						 "pend_deliver"  => $this->cleandate("penddate")
						 );
			
		}

		
		/*
		$arr = array("confirm_order" => $this->input->post("confirmqty", true),
					 "pending_order" => $this->input->post("pendingqty", true),
					 "pay_mode" 	 => $this->input->post("paymode", true),
					 "pay_status" 	 => $this->input->post("paystatus", true),
					 "pay_price" 	 => $this->input->post("totalpay", true),
					 "balance" 		 => $this->input->post("prevbal", true),
					 "delivery_date" => $this->input->post("delivery_date", true),
					 "pend_deliver"  => $this->input->post("pend_deliver", true),
					 "transaction_no"=> $this->input->post("transno", true),
					 "delivery_by"   => $this->input->post("delvby", true),
					 "status" 		 => $this->input->post("orderstatus", true)
					 );
		*/
		$this->db->where("id", $this->input->post("orderno", true));
		$this->db->update("tbl_order", $arr);	
	}
	
	public function updateorder_product_status(){			
		$arr = array(
				"comp_id"    => $this->session->companey_id,
				"ord_no"     => $this->input->post('order_id'),
				"pid" 		 => $this->input->post('product_id'),
				"status" 	 => $this->input->post('status'),
				"created_by" => $this->session->user_id,
				);
		if($this->db->insert("ord_prod_stage", $arr)){	
			
			$comp_id	=	$this->session->companey_id;
			$pid	=	$this->input->post('product_id');				
			$odr_id	=	$this->input->post('order_id');				

			$this->db->where('ord_no',$odr_id);
			$this->db->where('product',$pid);
			$this->db->where('company',$comp_id);
			$this->db->set('status',$this->input->post('status'));
			$this->db->update('tbl_order');

			if ($this->input->post('status') == 4) {
				$this->db->select('quantity');
				$this->db->where('ord_no',$odr_id);
				$this->db->where('product',$pid);
				$this->db->where('company',$comp_id);
				$order_row	=	$this->db->get('tbl_order')->row_array(); 
				$order_qty = $order_row['quantity'];
				/*echo $order_qty;
				echo $odr_id;
				echo $pid;
				exit();*/
				$this->db->where('comp_id',$comp_id);
				$this->db->where('product_name',$pid);
				$this->db->set('qty',"qty-".$order_qty,false);
				$this->db->limit(1);
				echo $this->db->update('tbl_inventory');
			}else{
				echo 1;
			}		
		}else{
			echo 0;
		}
	}
	public function updateorder_product_deliveredBy(){
		$update_arr = array(
			'deliver_by' => $this->input->post('deliver_by')
		);
		$this->db->where('company',$this->session->companey_id);
		$this->db->where('ord_no',$this->input->post('order_id'));
		$this->db->where('product',$this->input->post('product_id'));
		echo $this->db->update('tbl_order',$update_arr);		
	}
	public function update($ordno = ""){
		
		$data["title"] = "Add Delivery";
		$ordno = base64_decode(base64_decode(urldecode($ordno)));
		$ordno = "ORD820627714";
		
		if(isset($_POST["confirmqty"])){
			$this->updateorders();
		}
		
		//$data["order"] = $this->db->select("*")->where("id", $ordno)->from("tbl_order")->get()->row();
		$data["order"] = $this->order_model->getOrders($ordno);
		
		if(!empty($data["order"])){
		//	$ordno = $data["order"]->id;
			$data["ord"] = $data["order"][0];
		}
		
		$data["payment"]   = $this->db->select("*")->where("ord_id", $ordno)->get("payment")->result();
		$data["delivery"]  = $this->order_model->getDilevery($ordno);
		
		$data['content']	=	$this->load->view("order/update-order", $data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function updateorders(){
		
		$confqty = $this->input->post("confirmqty",true);
		$totqty  = $this->input->post("quantity",true);
		
		if(!empty($totqty)){
			foreach($totqty as $ind => $qty) {
				
				$cnfqty  = $confqty[$ind];
				$pendqty = $qty - $cnfqty;
				
				if($cnfqty  == 0){
					
					$this->db->where("id", $ind);
					$this->db->delete("delivery");
					continue;
				} 
				
				$updarr = array("delv_qty"        => $cnfqty,
								"pending_qty"     => $pendqty,
								"deliver_by"      => $this->input->post("deliverby", true),
								"delivery_date"   => $this->cleandate("delvdate"),
								"pending_deliver" => $this->cleandate("penddate")
								);
				$this->db->where("id", $ind);
				$this->db->update("delivery", $updarr);	
			}
		}
		
		$arr = array(
					 "status" 		 => $this->input->post("deliverstatus", true),
					 "conf_delv" => $this->cleandate("delvdate"),
					 "pend_delv"  => $this->cleandate("penddate")
					 );
		
		$this->db->where("id", $this->input->post("deliveryno", true));
		$this->db->update("tbl_order", $arr);
		
		$ret = $this->db->affected_rows();
		
		if($ret){
			
			$this->session->set_flashdata("msg", "Successfully updated");
		}else{
			$this->session->set_flashdata("error", "Failed to  updated");
			
		}
		
	}
	
	
	public function adddelivery($ordno = ""){
		
		$data["title"] = "Add Delivery";
		$ordno = base64_decode(base64_decode(urldecode($ordno)));
		
		
		if(isset($_POST["orderno"])){
			
			$this->updatedelivery();
			$ord_no = $this->input->post("ordernumb");
			redirect(base_url("order/view/".$ord_no), "refresh");	
		}
		
		if(empty($ordno)) show_404();
		
		$data['ord'] = $this->order_model->getPOrderById($ordno);
		
		$data['delivery'] = $this->order_model->getDileveryByOid($ordno);
		
		//$data['orders']	$data['ord'] = $this->order_model->getOrdProduct($ordno);
		
		$this->load->template("order/add-delivery", $data);
		
	}
	
	public function bookingupdate($bkgno = ""){
		
		if(empty($bkgno)) show_404();
		$data["title"] = "Update Booking";
		$bkgno =  base64_decode(base64_decode(urldecode($bkgno)));
		$data["bkg"]  = $this->order_model->getDileveryById($bkgno);
	
		$this->load->template("order/update-delivery", $data);
	}
	
	public function updatedelivery(){
		
		$arr = array("ord_id" => $this->input->post("orderno", true),
					"ord_no"	=> $this->input->post("ordernumb", true),
					   "product" => $this->input->post("productno", true),
					   "tot_qty" =>  "",
					   "delv_qty" => $this->input->post("confirmqty", true),
					   "pending_qty" => $this->input->post("pendingqty", true),
					   "deliver_by" => $this->input->post("deliverby", true),
					   "added_by" => $this->session->user_id,
					   "status" =>  $this->input->post("deliverstatus", true) ,
					   "created_date" => date("Y-m-d h:i:s"),
					   "delivery_date"  => $this-> cleandate("delvdate"),
					   "pending_deliver" => $this->cleandate("penddate"),
					   "company"      => $this->session->company
					   );
		$ret = $this->db->insert("delivery", $arr);
		
		if($ret){
			$this->session->set_flashdata("message", "successfully update delivery");
		}else{
			$this->session->set_flashdata("error", "Failed to update delivery");	
		}
		
	}
	
	
	public function sendordconf($email){
		
		$subj  =  "New Order is placed";
		
		$msg = "New order is added";
		
		$this->common_model->send_email($email, $subj, $msg);
		
		
	}

	public function check_stock($odr_id,$pid){
		$return = '0';
		$comp_id	=	$this->session->companey_id;
		$this->db->select('quantity');
		$this->db->where('ord_no',$odr_id);
		$this->db->where('product',$pid);
		$this->db->where('company',$comp_id);
		$order_row	=	$this->db->get('tbl_order')->row_array();
		if (!empty($order_row)) {
			$this->db->select('qty');
			$this->db->where('product_name',$pid);		
			$this->db->where('comp_id',$comp_id);		
			$stock_row	=	$this->db->get('tbl_inventory')->row_array();		
			if (!empty($stock_row)) {
				if($stock_row['qty']>=$order_row['quantity']){
					$return = '1';
				}
			}
		}
		echo $return;
	}
}	