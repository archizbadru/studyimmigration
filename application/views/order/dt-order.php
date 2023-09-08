<?php   $rows = array();
		if(!empty($neword)){			
				$srno = 0; 
				foreach($neword as $ordno => $allord){
					$ord    = $allord[0]; 					
					$cols   = array();
					$srno   = ++$srno;
					$total  = count($allord);						 		
					$cols[] = $srno;
					if (user_access(463)) {
						$cols[] = "<a href = '".base_url('order/view/'.$ord->ord_no)."'>".$ord->ord_no."</a>";
					}else{
						$cols[] = $ord->ord_no;
					}
					$total = getOrderTotal($allord);
					$cols[]= $total;
					$qtyarr = $prdarr = $payarr = $dlvarr =  array();
					$totconfrm = 0;	
					$pending   = $totprice = $totqty = $disc = 0;				
					$totprice = $ord->price;
					$totqty   =  $ord->quantity;					
					
					$cols[] = $ord->customer;
					$cols[] = $ord->s_phoneno;
					
					$cols[] = $ord->add_ress;
					$paid = getPaidAmount($ord->ord_no);	
						$cols[] = !empty($paid)?$paid:'0';

					$balance = $total - $paid;
					$cols[] = number_format($balance,2);
					$cols[] = $ord->order_date;
				
					$payment_act = $conf_act = $invoice_act = '';

					if (user_access(461)) {
						$conf_act  = '<a class="btn btn-xs btn-info" href="'.base_url("order/booking/".$ord->ord_no).'"><i class="fa fa-gavel" data-toggle="tooltip" title="" data-original-title="Edit"></i>  Status</a>';
						if ($this->session->user_right != 200) {							
							$payment_act = '<a href="'.base_url("payment/add/".$ord->ord_no).'" class="btn btn-xs btn-primary"><i class="fa fa-cc" data-toggle="tooltip" title="" data-original-title="Edit"></i>  Payment</a>';
							$invoice_act	=	'<a class="btn btn-xs btn-default" href="'.base_url("order/invoice/".$ord->ord_no).'"><i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="Edit"></i>  Invoice</a>';					
						}
					}



					$cols[] =  $conf_act.$invoice_act.$payment_act;
					$rows[] = $cols;
				}
				
		
		}
		$total = $this->order_model->orders(2);	
				$output = array(
						"draw" => @$_POST['draw'],
						"recordsTotal" 		=> $total,
						"recordsFiltered"   => $total,  
						"data" => $rows,
						);
			die(json_encode($output));
	