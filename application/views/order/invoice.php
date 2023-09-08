<style type="text/css" media="print">
   
    .noprint { 
      visibility: hidden; 
   }
   img:not(#Lalantop_logo){
   	visibility: hidden;
   }
   .content-wrapper{
   	min-height: unset!important;
   }
</style> 
		
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("order") ?>"> <i class="fa fa-list"></i> Order List </a>  
                </div>
				<button type="button" class="btn btn-primary mb-1 noprint pull-right" id="pdfsave"><i class="fa fa-download"></i> Invoice Pdf</button>

            </div>
			<div class="panel-body panel-form" id="pdf-invoice">
                <div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body content">
										<div class="row">
											<div class="col-md-3 col-sm-12 col-xs-12">
												<img width=300 src="data:image/jpeg;base64,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">
											</div>

											<div class="text-center ml-auto col-md-6">
												<h2 class="mb-1" style="font-family: 'Montserrat';">PROFORMA INVOICE</h2>
												<h3 class="mb-1" style="margin:0px;font-family: 'Montserrat';">LALANTOP CONSUMERS PVT. LTD</h3>
												<p class="mb-1" style="margin:0px;"><span class="font-weight-semibold">1st Floor,office no.9,D-5,Awadh Complex,Laxmi Nagar , Delhi-110092 </p>
											    <p class="mb-1" style="margin:0px;"><span class="font-weight-semibold">Corp.Off.at.IHDP Business Park.7 , Sector-127,Noida-201301 </p>
												<p class="mb-1" style="margin:0px;"><span class="font-weight-semibold">GSTIN/UIN.07AADCL4696D1ZE , CIN:U51909DL2017PTC326524 </p>
											</div>
											<div class="col-md-3 col-sm-12 col-xs-12">
											
											</div>
										</div>
										
										<div class="row">
											<div class="text-center ml-auto col-md-4">
											<p class="mb-1" style="margin:0px;"><span class="font-weight-semibold" style="font-weight: 700;">Contact :</span> 18005722426 </p>
											</div>

											<div class="text-center ml-auto col-md-4">
											<p class="mb-1" style="margin:0px;"><span class="font-weight-semibold" style="font-weight: 700;">Website :</span> www.lalantop.com </p>
											</div>
											<div class="text-center ml-auto col-md-4">
											<p class="mb-1" style="margin:0px;"><span class="font-weight-semibold" style="font-weight: 700;">E-MAIL :</span> accounts@lalantop.com </p>
											</div>
										</div>
										 
										<hr>
								
								        <div class="row">
											<div class="text-left ml-auto col-md-4">
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Buyer :</span> <?php echo $buyer_details['BILLING_DETAILS']['fname']; ?> </p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Prop. :</span> <?php //echo $buyer_details['3']->order_value; ?> </p>
											<p class="mb-1" style="margin:0px;"><span class="font-weight-semibold" style="font-weight: 700;">Contact Person. :</span> <?php echo $buyer_details['SHIPPING_DETAILS']['fname']; ?> </p>
											<p class="mb-1" style="margin:0px;"><span class="font-weight-semibold" style="font-weight: 700;">Contact No :</span> <?php echo $buyer_details['SHIPPING_DETAILS']['phone']; ?> </p>
											<p class="mb-1" style="margin:0px;"><span class="font-weight-semibold" style="font-weight: 700;">GSTIN. :</span> <?php echo $buyer_details['BILLING_DETAILS']['gstin']; ?> </p>
											</div> 
											<div class="text-left ml-auto col-md-4">
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Invoice No :</span>  </p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Delivery Note :</span>  </p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Supplier's Ref. :</span>  </p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Buyer's Order No. :</span>  <?php echo $order_no; ?></p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Dispatch Doc.No. :</span>  </p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Dispatched Thr. :</span>  </p>
											</div>
											<div class="text-left ml-auto col-md-4">
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Date :</span>  <?php echo date("d-m-Y h:i:sa"); ?></p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Terms of Payment :</span>  </p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Other Ref.(s) :</span>  </p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Dated :</span>  </p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Delivery Date :</span>  </p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Destination :</span> <?php echo $buyer_details['SHIPPING_DETAILS']['address']; ?></p>
											</div>
										</div>
								</br>
										<div class="table-responsive push">
											<table class="table table-bordered table-hover mb-0">
												<tbody>
								
												<tr class=" ">
													<th class="text-center " style="width: 1%"></th>
													<th>Item</th>
													<th class="text-right">Brand Name</th>
													<th class="text-right">HSN/SAC</th>
													<th class="text-center" style="width: 1%">Quantity</th>													
													<th class="text-right">Unit Price</th>
<?php if($buyer_details['SHIPPING_DETAILS']['state']=='442'){	?>												
<th class="text-right">CGST</th>
<th class="text-right">SGST</th>
<?php }else{ ?>
<th class="text-right">IGST</th>
<?php } ?>													
													<th class="text-right">Discount</th>
													<th class="text-right">Sub Total</th>
												</tr>
											<?php $total =  0; 
												$mord = $ord;	
												if(!empty($orders)) { 
													foreach($orders as $ind => $ord){ ?>
														
													<tr>
														<td class="text-center"><?php echo $ind + 1; ?></td>
														<td><?php echo $ord->product_name; ?></td>
														<td class="text-right"><?php echo $ord->brand; ?></td>
														<td class="text-right"><?php echo $ord->hsn; ?></td>
														<td class="text-center"><?php echo $qty = $ord->quantity; ?></td>														
														<td class="text-right"><i class ="fa fa-rupee"></i> <i ><?php echo $price = $ord->unit_price; ?></td>
<?php if($buyer_details['SHIPPING_DETAILS']['city']=='442'){	?>												
<td class="text-right"><?php echo  (!empty($ord->tax)) ? ($ord->tax/2)."%" : ""; ?></td>
<td class="text-right"><?php echo  (!empty($ord->tax)) ? ($ord->tax/2)."%" : ""; ?></td>
<?php }else{ ?>
<td class="text-right"><?php echo  (!empty($ord->tax)) ? $ord->tax."%" : ""; ?></td>
<?php } ?>														
														<td class="text-right"><?php echo $ord->offer; ?></td>
														<td class="text-right"><i class ="fa fa-rupee"></i>
															<?php 
															if ($ord->tax) {
																$p = $qty * (float)$price;
															//	echo $ptotal = $p+($p*($ord->tax/100)  - (float)$ord->offer); 	
															}else{
															//	echo $ptotal = (($qty * (float)$price)  - (float)$ord->offer); 
															}
																echo $ptotal = (float)$ord->total_price  - (float)$ord->offer; 

															?>
														</td>
													</tr>		
														
											<?php	 $total = $total  + $ptotal;
											
													}
												} ?>
								
												<tr>
													<td colspan="<?php if($buyer_details['SHIPPING_DETAILS']['state']=='442'){	echo '9';}else{ echo '8';} ?>" class="font-weight-bold text-uppercase text-right">Total</td>
													<td class="font-weight-bold text-right h4"> <i class ="fa fa-rupee"></i>  <?php echo $total; ?></td>
												</tr>
											</tbody></table>
											
										</div>
										
										<div class="row">
											<div class="text-left ml-auto col-md-6">
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Amt.Chargeable (in words) Rs. :</span> 

 <?php
$number = $total;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  echo $result . "Rupees  " . $points . " Paise Only";
 ?> 
											</p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">HSN/SAC :</span>  </p>
											<!--<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Total IGST Amt. (in words) Rs. :</span> Seventy Six Thousand Six Hundred Thirty Seven Only. </p>-->
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Company's PAN :</span> AADCL4696D </p>
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Declaration :</span>  We declar that this invoice shows the actual price of the goods described
and that all particulars are true and correct.</br>
This is Computer generated invoice,so no signature in required. </p>
											</div>
											<div class="text-right ml-auto col-md-6">
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Total Value(Rs.) :</span> <?php echo $total; ?> </p>
											</div>
											<!--<div class="text-left ml-auto col-md-2">
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Taxable Value(Rs.) :</span> 425760.00 </p>
											</div>
											<div class="text-left ml-auto col-md-2">
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">Rate :</span> 18% </p>
											</div>
											<div class="text-left ml-auto col-md-2">
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">IGST Amt.(Rs.) :</span> 76636.80 </p>
											</div>-->
										</div>
											<div class="text-center ml-auto col-md-6 pull-right">
											<p class="mb-1" style=""><span class="font-weight-semibold" style="font-weight: 700;">For Lalantop Consumers Pvt.Ltd. :</span></br></br> Authorised Signatory </p>
											</div>
										
									</br>
									</br>
									</br>
										<div>
									<?php if(!empty($payment)) { 
											$data["payments"] = $payment;
											$data["totprice"] = $mord->total_price;
											$data["hideact"]      = true;
											$data["orderno"]   = $ord->ord_no;
											$this->load->view("payment/pages/payment-list",$data);
									}else{ ?>
									<?php 
									if(!empty($delivery[$ord->product])){
								        $isanyconf = true;
									
									if($isanyconf == true) { ?>
												<div class = "card">
										
											<div class="card-body">
												<div class = "col-md-12 text-center">
												
													<h4>	Balance :  <i class = "fa fa-rupee"></i> <?php echo $mord->total_price; ?> <a class = "btn btn-info btn-pill" href = "<?php echo base_url("payment/add/".$mord->ord_no); ?>"> Add Payment </a> </h4>
												</div>
													</div>
									</div>	
									<?php } } ?>	
							<?php	}  ?>
										</div>
									</div>
									<div class="card-footer text-right no-print">
										<!-- <a href = "<?php echo base_url("order/pdfinvoice/".$mord->ord_no); ?>" class="btn btn-primary mb-1" target = "_blank"><i class="si si-wallet"></i> Pdf</a> -->
									    
										<!-- <button type="button" class="btn btn-info mb-1 noprint" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>  -->
									</div>
								</div>
							</div>
						</div>	<!-- end row -->
					</div>	
				</div>
			</div>
		</div>
		

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>	
<script type="text/javascript">     
//location.reload();
$('#pdfsave').click(function () {
	let doc = new jsPDF('p','pt','a4');
	$('.no-print').hide();
	$('.alert').hide();
doc.addHTML($('.content')[0], function () {
	var title = 'Invoice-'+"<?=$order_no?>"+'.pdf';
     doc.save(title);
 });
location.reload();
});
$('.no-print').show();
 </script>