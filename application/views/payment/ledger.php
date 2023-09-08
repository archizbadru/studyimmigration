<link rel = "stylesheet" href = "<?php echo base_url("assets/plugins/sweet-alert/sweetalert.css"); ?>">
<div class="bg-white p-3 header-secondary header-submenu">
					<div class="container ">
						<div class="row">
							<div class="col">
									<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="">Ledger</a></li>
								<li class="breadcrumb-item active" aria-current="page">Ledger List</li>
							</ol><!-- End breadcrumb -->
							</div>
							<div class="col col-auto">
								<a href="<?php echo base_url("order"); ?>" class="btn btn-pill btn-secondary"><i class="fe fe-plus"></i>Orders</a>
								<?php if($this->session->mrole == 1){
										if(isset($_GET["c"])){
									
										?><a href="<?php echo base_url("user"); ?>" class="btn btn-pill btn-info"><i class="fe fe-arrow-left"></i>Back</a><?php
										
									}
								} ?>
							</div>
						</div>
					</div>
				</div><!--End Header submenu -->

                <!-- app-content-->
				<div class="container content-area">
					<div class="side-app">

						<!-- page-header -->
					<!--	<div class="page-header">
							
							<div class="ml-auto">
								
							</div>
						</div> -->
						<!-- End page-header -->

						<!-- row -->
						<div class="row">
							<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
										<div class = "row col-12">
										<div class = "col-12">
									
								<div class = "row col-12">
									<div class = " col-10">
										<div class="card-title">
													Ledger List
										</div>
									</div>
										
										
									<div class = "col-2">
										<a href = "javascript:void(0)" class = "btn btn-warning btn-pill slide-chng-div" data-target = "#filter-area"><i class  = "fa fa-search"></i></a>
											<a href = "javascript:void(0)" class = "btn btn-info btn-pill slide-chng-div" data-target = "#filter-area"><i class  = "fa fa-download"></i></a>
									</div>
								</div>
														<?php   $othrurl = "";
											if(isset($_GET)){
												
												foreach($_GET as $ind => $gt){
													
													if($ind == 0){
														$othrurl = "?".$ind."=".$gt;
													}else{
														$othrurl = "&".$ind."=".$gt;
													}
													
												}
												
											} ?>
									<?php 
									
									echo form_open(base_url("report/ledger"), array("id"=> "filter-form-ajx", "method"=>"get")); ?>
									<div class = "row" id = "filter-area" style = "display:none;">
										<div class = "col-12">
											<hr />
										</div>
										<?php echo form_close(); ?>
										<div class = "form-group col-3">
											<label>Start Date</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
														</div>
													</div>
													<input class="form-control fc-datepicker" name="sd" id = "start-date" placeholder="DD/MM/YYYY" value="" type="text" autocomplete = "off">
												</div>
										</div>
										<div class = "form-group col-3">
											<label>End Date</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
														</div>
													</div><input class="form-control fc-datepicker" name="ed" id = "end-date" placeholder="DD/MM/YYYY" value="" type="text" autocomplete = "off">
												</div>
										</div>
										<?php 
										if(isset($_GET)){
											foreach($_GET as $ind  =>$gt){
												
												?><input type = "hidden" name ="<?php echo $ind; ?>" value = "<?php echo $gt; ?>"><?php
												
											}
											
										} ?>
										<!--<div class = "form-group col-3">
											<label>Filter</label>
												<div class="input-group">
													<select name="status" id="fltr-status" class="form-control">
														<option value =""></option>
															<?php foreach($product as $p)
															{?>
																<option value = "<?php echo $p->product; ?>"><?php echo $p->product; ?></option>
															<?php }?>
															<!-- <?php   if(!empty($product)) { 
																foreach($product as $key => $mstr) { 
																
																if($mstr->type == 2) {
																?>
															
																<option value = "<?php echo $mstr->id; ?>"><?php echo $mstr->title; ?></option>
															<?php }
																}
															}
															?> -->
												<!--	</select>
												</div>
										</div> -->
										<div class = "form-group col-2">
											<br />
											<?php 
											$curl = "";
											if(isset($_GET["c"])) {
												
												$curl = "?c=".urlencode($_GET["c"]);	
											} ?>
											<a href = "<?php echo base_url("report/ledger/".$curl); ?>" class = "btn btn-secondary btn-pill"><i class="fa fa-refresh" aria-hidden="true"></i></a>
											<button type ="submit"  class = "btn btn-warning btn-pill addit-filter-ord"><i class  = "fa fa-search"></i> </button>
										</div>
										<?php echo form_close(); ?>
										<div class = "form-group col-4 text-right">
										<?php echo form_open("", array("id" => "dwn-exel-frm")); ?>
										<a href="javascript:void(0)" class="btn btn-dark btn-sm btn-pill slide-chng-div float-right" data-target="#filter-area"><i class  = "fe fe-arrow-up"></i></a>
											<br />
											
											<input type = "hidden" name = "start_date" id = "str-date-xls">
											<input type = "hidden" name = "end_date" id = "end-date-xls">
											
											<button type = "submit" name = "downloadexel" id = "exel-dwn-btn" value = "downloadexel" class = "btn btn-info btn-pill"><i class  = "fa fa-download"></i> Excel</button>
											<?php echo form_close(); ?>
										</div>
									</div>
									
									</div>
								</div>	
								
								</div>
								<div class="card-body">
							
                                	<div class="table-responsive">
										<table class="table table-striped table-bordered text-nowrap w-100 dataTable no-footer" id = "add-datatable">
											<thead>
												<tr>
													<th class="wd-15p">Date</th>
												
												<?php if(!isset($_GET["c"])) {

														$isnotcust = false;
													?>
													<th class="wd-15p">		Customer</th>
												<?php }else {
														$isnotcust = true;
													} ?>
												<!--<th class="wd-15p">Product</th>
													<th class="wd-15p">Quantity</th> -->
													<th class="wd-15p" colspan = "2">Particlar</th>
													<th class="wd-15p">V Type</th>
													<th class="wd-15p">Order</th>
											
													<th class="wd-15p">Debit</th>
													<th class="wd-15p">Credit</th>
												</tr>
											</thead>

											<tbody>
												<?php if(!empty($records)){

												   $sl=1;
												   $ordno = "";
												   $totdebit = $totcredit = 0;
                                                  foreach($records as $ind =>  $ord){
													  
													  if($ordno == $ord->ord_no){
														  $neword  = false;
													  }else{
														  $neword  = true;
													  }
												?>
												<tr>

													<td><?php echo date("d, M Y h:i A", strtotime($ord->created_date));  ?></td>
													<?php if(!isset($_GET["c"]) or $this->session->user_id != $ord->cust_id) { 
													?>
													<th class="wd-15p">		 <?php echo $ord->customer; ?></th>
													<?php } ?>
													<td><?php if($ord->type == "pay") { ?>
															Cr
														<?php }else{
															echo "Dr";
														} ?>
													</td>
													<td>
											<?php if($ord->type == "pay") {
													 echo  (!empty($ord->remark)) ? $ord->remark : "payment"; 
												  }else{
													echo  (!empty($ord->remark)) ? $ord->remark : "Purchase"; 	
													} ?>
													</td> 
													<td>
															<?php 
														if($ord->type == "pay") {
															?>Payment <?php
														}else{
															?>Purchase<?php
														}
														
														?>
													</td>
													<td><a href ="<?php echo base_url("order/view/".$ord->ord_no); ?>" target = "_blank"><?php echo $ord->ord_no; ?></td>
													
													<td>
												<?php if($ord->type == "order") {
													
															echo "<i class = 'fa fa-rupee'></i> ".$ord->tot_price;
															$totdebit += $ord->tot_price; 
													  }else{
														  
													  } ?>
													</td>
													<td><?php if($ord->type == "pay") {
																$totcredit += $ord->pay;
															echo "<i class = 'fa fa-rupee'></i> ".$ord->pay;
													  } ?></td>
												
												</tr>
												<?php  $sl++; }

											}?>
											<tr>
												<td colspan = "<?php echo ($isnotcust == true)? "6" : "5" ?>" class ="text-right">
													Total
												</td>
												<td><i class = "fa fa-rupee"></i> <?php echo $totdebit; ?></td>
												<td><i class = "fa fa-rupee"></i> <?php echo $totcredit; ?></td>
											</tr>
											<tr>
												<td></td>
												<td><?php echo ($totcredit< $totdebit)  ? "Cr" : "Dr";  ?>  </td>
												<td colspan = "<?php echo ($isnotcust == true)? "5" : "4" ?>" class = "text-right">Closing Balance</td>
												<td> <?php echo ($totcredit< $totdebit) ? $totdebit -  $totcredit : ""; ?></td>
												<td> <?php echo ($totcredit> $totdebit) ? '<i class = "fa fa-rupee"></i>'.($totcredit - $totdebit) : ""; ?></td>
											</tr>
											
											</tbody>
										</table>
									</div>
                                </div>
								<!-- table-wrapper -->
							</div>
							<!-- section-wrapper -->
							</div>
						</div>
						<!-- row end -->

					</div>

				</div>
				<!-- End app-content-->
			</div>
		</div>
		<div class="modal fade" id="mdl-details" tabindex="-1" role="dialog" aria-labelledby="mdl-details" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modl-det-ttl">Order</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12 text-center">
											<i class ="fa fa-spinner fa-pulse" style = "font-size:64px;"></i>
										</div>
										
									</div>
						
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Save changes</button>
								</div>
							</div>
						</div>
					</div>
		<script src="<?php echo base_url(); ?>assets/plugins/date-picker/jquery-ui.js"></script>
	<?php echo form_open(base_url("ajax/deletesingle/payment"), array("id" => "hide-ajx-form")); ?>
			<input type = "hidden" name = "contentno" id = "contentno-no">
		<?php echo form_close(); ?>
		<script src = "<?php echo base_url("assets/plugins/sweet-alert/sweetalert.min.js"); ?>"></script>
				
		<?php
			
			$urlarr["ajax"]["url"] =  base_url('table/payments');	
	//	echo datatable("#add-datatable" , $urlarr); ?>
	<script>
		$(document).on("click",".get-details", function(){
			
			var type = $(this).data("type");
			
			if(type == "ord-no"){
				$("#modl-det-ttl").text("Order:"+$(this).data("val"));
			}
			
			$.ajax({
				url     : "<?php echo base_url('ledger/getdetails') ?>",
				type    : "post",
				data    : {type:type, value: $(this).data('val')},
				success :function(resp){
					
						
				}
			});
			
		});
	</script>
	<script>
		$(document).on("submit","#dwn-exel-frm", function(){
			
			$("#str-date-xls").val($("#start-date").val());
			$("#end-date-xls").val($("#end-date").val());
			
		});
	</script>
	<script>
			$(document).on("click", ".delete-content", function(e){
				
				e.preventDefault();
				
				$("#contentno-no").val($(this).attr("href"));
				
			
					
					swal({
					  title: "Are you sure?",
					  text: "Once deleted, you will not be able to recover this imaginary file!",
					  type: "warning",
					  showCancelButton: true,
					  buttons: true,
					  dangerMode: true,
					  confirmButtonText: 'Delete',
					  confirmButtonColor: '#f52b3e',
					  cancelButtonText: 'Close'
					});	
			});
		</script>
		<script>
			$(document).on("click", "button.confirm", function(e){
				
				e.preventDefault();
				$.ajax({
					url     : $("#hide-ajx-form").attr("action"),
					type    : "post",
					data    : $("#hide-ajx-form").serialize(),
					success : function(resp){
						
						var jresp = JSON.parse(resp);
						
						if(jresp.status == "success"){
							
							location.reload();
						}
						
					}
				});
			});
		</script>
				<script>
			$(document).on("click", ".approve-pay", function(e){
				
				e.preventDefault();
				
				var r = confirm("Are you sure to confirm payment");
					if (r == true) {
					 
					} else {
					  txt = "You pressed Cancel!";
					}
				
				$.ajax({
					url  	: "<?php echo base_url('ajax/approve/payment'); ?>",
					type 	: "post",
					data 	: {"contentno" : $(this).attr("href"), "status" : 1},
					success	: function (resp){
						
						resp = JSON.parse(resp);
						
						if(resp.status == "success"){
							
							location.reload();
						}
						
						
					}
				});
				
			});
		</script>		
		<script>
			$(document).ready(function(){
		        
				$(".fc-datepicker").datepicker();
					$('.add-multi-select').multipleSelect({
						filter: true
					})
				
			});
		</script>
		<script>
			$(document).on("click", ".addit-filter-ord", function(){
				

				  $('#add-datatable').DataTable().destroy();		
				$("#add-datatable").dataTable({
						serverSide:"true",
						lengthMenu:[10,30,100,500,1000,-1,50,100,500,1000,"All"],
						ajax:{url: $("#filter-form-ajx").attr("action"),
							  type:"post", data: {"startdate":$("#start-date").val(),"enddate":$("#end-date").val(),"action":$("#fltr-status").val(),'type':"ajaxfilter" } },
						columnDefs:{orderable:"false",target:0},
						order:[1,"desc"]
						});
			
		});
	
		</script>