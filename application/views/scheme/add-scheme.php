<style>
	.fc-datepicker{
		width:100%;
	}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/multipleselect/multiple-select.css">
				<!--Header submenu -->

			<div class="row">
    <!--  form area -->
			<div class="col-sm-12">
				<div  class="panel panel-default thumbnail"> 
					<div class="panel-heading no-print">
						<div class="btn-group"> 
							<a class="btn btn-primary" href="<?php echo base_url("scheme") ?>"> <i class="fa fa-list"></i> Scheme List </a>  
						</div>
					</div>
					<div class="panel-body panel-form">
						<div class="row">
			
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Add Scheme</h3>
									</div>
									<div class="card-body p-6">
										<div class="panel panel-primary">
										
											<div class="panel-body tabs-menu-body">
												
											<div>
												<div id="step-10" class="">
												<?php echo form_open('scheme/add_product_scheme','id="scheme"') ?>
												<input type="hidden" name="w_id">
											    <div class="row">
												<div class="form-group col-md-3">
												     <label>Active</label>
													 <div class="input-group">
												     <div class="input-group-addon">
													<div class="input-group-text">
														<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
													</div>
												</div>
												
												<input class="form-control" type="date" id="fromdate" name="fromdate" required="" style = "width:100%;">
											</div>
											</div>
												<div class="form-group col-md-3">
												     <label>Expire</label>
													 <div class="input-group">
												     <div class="input-group-addon">
													<div class="input-group-text">
														<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
													</div>
												</div>
												
												<input class="form-control" type="date" id="todate" name="todate" required="" style = "width:100%;">
											</div>
											</div>
											<div class = "col-md-3">
												<div class = "form-group">
													<label>Calculation Method</label><br />
													
													<label class="custom-control">
														<input type="radio" name="calcmeth" value="1">
														<span class="custom-control-label"> % </span>
													</label> 
													<label class="custom-control ">
														<input type="radio" name="calcmeth" value="2">
														<span class="custom-control-label"> <i class = "fa fa-rupee"></i> </span>
													</label>
												
												</div>
											</div>	
											<div class = "col-md-3">
												<div class = "form-group">
													<label>Calculation Type</label>
													<div class = "input-group">
													<label class="custom-control">
														<input type="radio" name="calctype" value="1">
														<span class="custom-control-label"> Add in Total </span>
													</label> &nbsp;&nbsp;
													<label class="custom-control ">
														<input type="radio" name="calctype" value="2">
														<span class="custom-control-label"> Highest Apply</span>
													</label>
													</div>
												</div>
											</div>	
						
											</div>
					<!--			<div class = "row">
										<div class = "col-md-12" id = "scheme-list-area">	
										<div class="row sceme-apply-area">
											<div class = "col-md-3">
												<div class = "form-group">
													<label>Apply On</label>
													<select class = "form-control sel-show-trg" name ="schmapply[]">
														<option value = "1">All</option>
														<option value = "2" data-target = ".prod-area">Product</option>
														<option value = "3" data-target = ".loc-area">Location</option>
														<option value = "4"  data-target = ".payment-area">Payment</option>
														<option value = "5"  data-target = ".user-area">User</option>
													</select>
												</div>	
											</div>
											<div class = "col-md-4">
												<label>Choose</label>
												<h4 class = "others-sel-area text-success">Apply Scheme to all product</h4>
													<div class = "input-group  prod-area others-sel-area "  style ="display:none">
															<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="prodschemes" value="BR" data-target = "#brand-area">
																<span class="custom-control-label"> Brand </span>
															</label> &nbsp;
															<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="prodschemes" value="CTG" data-target = "#categ-area">
																<span class="custom-control-label"> Category </span>
															</label>&nbsp;
															<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="prodschemes" value="SBCTG" data-target = "#sub-categ-area">
																<span class="custom-control-label"> Subcategory </span>
															</label>&nbsp;
															<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="prodschemes" value="PRD" data-target = "#prod-list-area">
																<span class="custom-control-label"> Product </span>
															</label>
														</div>
													<div class = "input-group  loc-area others-sel-area"  style ="display:none">
																<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="locschemes" value="CTY" data-target = "#usr-city-area">
																<span class="custom-control-label"> City </span>
															</label> &nbsp;
													
															<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="locschemes" value="RGN" data-target = "#region-area">
																<span class="custom-control-label"> Region </span>
															</label>&nbsp;
															<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="locschemes" value="ST" data-target = "#state-area">
																<span class="custom-control-label"> State </span>
															</label>					
													</div>
													<div class = "input-group  payment-area others-sel-area"  style ="display:none">
																<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="payschemes" value="PY-1" data-target = "#pay-mode-area">
																<span class="custom-control-label"> Mode </span>
															</label> &nbsp;
															<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="payschemes" value="PY-2">
																<span class="custom-control-label">One Payment Time </span>
															</label>&nbsp;
															<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="payschemes" value="PY-3">
																<span class="custom-control-label"> Using Debit and Credit Card </span>
															</label>&nbsp;
																			
													</div>
													<div class = "input-group  user-area others-sel-area"  style ="display:none">
																<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="usrschemes" value="SUSR" data-target = "#usr-list-area">
																<span class="custom-control-label"> Specific Users </span>
															</label> &nbsp;
															<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="usrschemes" value="RUSR" data-target = "#usr-role-area">
																<span class="custom-control-label"> User Role </span>
															</label>&nbsp;
															<label class="custom-control ">
																<input type="radio" class="custom-control-input fade-chk-div" name="usrschemes" value="USRTP" data-target = "#usr-type-area">
																<span class="custom-control-label"> User Type </span>
															</label>&nbsp;
													</div>	
											</div>
											
												<div class = "col-md-3 scheme-specific-box">
					
												</div>	
												<div class= "col-md-2 action-btn-area">
													<a href = "javascript:void(0)" class = "add-another-schm btn btn-info"> + Add </a>
												</div>
												<div class = "col-md-12">
													<hr />
												</div>
											</div>
										</div>
									</div>	 -->
											<div class = "row">
										
										
											</div>	
											<div  id="addrow">
											<div class="row">
												<div class="col-md-2 add-quantity-area" style = "display:none;">
													<div class="form-group">
														<label>From (QTY)</label>
														<input type="text" class="form-control" id="fromqty" name="fromqty[]">
													</div>
													
												</div>
												<div class="col-md-2 add-quantity-area" style = "display:none;">
													<div class="form-group">
														<label>To(QTY)</label>
														<input type="text" class="form-control" id="toqty" name="toqty[]">
														</div>
												</div>
											<div class="col-md-2">
											<div class="form-group">
											 <label>Discount(%)</label>
											 <input type="text" class="form-control" id="discount" name="discount[]">
											 </div>	
											</div>
                                            <div class="col-md-2 add-quantity-area" style = "display:none;">
                                            	<div class="form-group" style="margin-top: 23px;">
                                            
												 <a name="add" id="add" class="btn btn-success">Add More</a>
												</div>
												</div>
														<div class = "col-6">
											
												<h4 class = "text-info"  style="margin-top: 31px;">	<label class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input slide-chng-div" name="applyonqty" value="qty" data-target=".add-quantity-area">
														<span class="custom-control-label">Apply On Quantity</span>
													</label>
												</div>	
												</div>
											</div>
											</div>											 
											<div class="col-md-12">
												
												<button type="submit" class="btn btn-primary">Add</button>

											</div>
												<?php echo form_close();?>
											</div>
										
										
<!---------------------------------------------------Region Scheme-------------------------------------------------------------------------------------------------->
<!-----------------------------CATEGORY LIST---------------------------------------->
							<div  class = "form-group categ-area others-sel-area specific-area" id ="categ-area"  style = "display:none;">
														<label>Category</label>
														<select class="form-control"  name="CTG[]" multiple>
																<option value="all">All</option>
															<?php 
															$role = $utype = $prod = $users = $brand = $region = $state = $city = $utype = $whouse = array();
															
															if(!empty($alldata)){
																foreach($alldata as $ind=> $catg){
																	
																	if($catg->type == "categ"){
																		
																		?><option value = '<?php echo $catg->id ?>'><?php echo $catg->title;  ?></option><?php
																	}else if($catg->type == "product"){
																		
																		$prod[] =  $catg;
																	}else if($catg->type == "region"){
																		
																		$region[] = $catg;
																	}else if($catg->type == "state"){
																		
																		$state[]  = $catg;
																	}else if($catg->type == "city"){
																		
																		$city[]   = $catg;
																	}else if($catg->type == "utype"){
																		$utype[] = $catg;
																		
																	}else if($catg->type == "brand"){
																		
																		$brand[] = $catg;
																	}else if($catg->type == "warehouse"){
																		
																		$whouse[] = $catg;
																	}else if($catg->type == "users"){
																		
																		$users[] = $catg;
																	}else if($catg->type == "utype"){
																		
																		$utype[] = $catg;
																	}else if($catg->type == "warehouse"){
																		
																		$whouse[] = $catg;
																	}
																	
																}	
																	
															}

															?>	
														</select>		
												</div>
												<div  class = "form-group sub-categ-area specific-area others-sel-area" id = "sub-categ-area"  style = "display:none;">
														<label>Subcategory</label>
														<select class="form-control"  name="SBCTG[]" multiple>
															<option value="all">All</option>
														</select>		
												</div>
												<div  class="form-group brand-area others-sel-area specific-area" id = "brand-area"  style = "display:none;">
													<label>Brand</label>
													
													<select class="form-control" id="brand" name="BR[]" multiple>
													<option value="all">All</option>
													<?php if(!empty($brand)){
													foreach($brand as $blist){
													?>
													<option value="<?= $blist->id?>"><?= $blist->title?></option>
													<?php }}?>
													</select>		
												 </div>
												 
												 <div  class="form-group  prod-list-area specific-area others-sel-area"  id = "prod-list-area"  style = "display:none;">
														<label>Product</label>
														<select class="form-control product" name="PRD[]"  multiple>
															<option value="all">All</option>
															<?php if($prod){
															foreach($prod as $prolist){
															?>
															<option value="<?= $prolist->id?>"><?= $prolist->title?></option>
															<?php }}?>
														</select>
												</div>
												<div class = "form-group others-sel-area specific-area usr-city-area"  id = "usr-city-area"  style = "display:none;">
													<label>City</label>
													<select class="form-control"  name="CTY[]"  multiple>
															<option value="all">All</option>
														<?php if(!empty($city)){
															foreach($city as $ind => $cty) {
															?><option value="<?php echo $cty->id; ?>"><?php echo $cty->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
												<div class = "form-group others-sel-area specific-area warehouse-area"  id = "warehouse-area"  style = "display:none;">
													<label>Warehouse</label>
													<select class="form-control"  name="WH[]"  multiple>
															<option value="all">All</option>
														<?php if(!empty($whouse)){
															foreach($whouse as $ind => $whs) {
															?><option value="<?php echo $whs->id ?>"><?php echo $whs->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
												<div class = "form-group others-sel-area specific-area region-area"  id = "region-area"  style = "display:none;">
													<label>Region</label>
													<select class="form-control"  name="RGN[]"  multiple>
															<option value="all">All</option>
												<?php  if(!empty($region)){
															foreach($region as $ind => $rgn) {
															?><option value="<?php echo $rgn->id ?>"><?php echo $rgn->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
												<div class = "form-group others-sel-area state-area"  id = "state-area"   style = "display:none;">
													<label>State</label>
													<select class="form-control"  name="ST[]"  multiple>
															<option value="all">All</option>
																				<?php  if(!empty($state)){
															foreach($state as $ind => $st) {
															?><option value="<?php echo $st->id ?>"><?php echo $st->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
												<div class = "form-group others-sel-area specific-area usr-list-area"  id = "usr-list-area"  style = "display:none;">
													<label>User</label>
													<select class="form-control"  name="SUSR[]" multiple>
															<option value="all">All</option>
																				<?php  if(!empty($users)){
															foreach($users as $ind => $usr) {
															?><option value="<?php echo $usr->id ?>"><?php echo $usr->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
												<div class = "form-group others-sel-area specific-area usr-type-area"  id = "usr-type-area"  style = "display:none;">
													<label>User Type</label>
													<select class="form-control"  name="USRTP[]"  multiple>
															<option value="all">All</option>
																				<?php  if(!empty($utype)){
															foreach($utype as $ind => $typ) {
															?><option value="<?php echo $typ->id ?>"><?php echo $typ->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
												<div class = "form-group others-sel-area specific-area usr-role-area"  id = "usr-role-area"   style = "display:none;">
													<label>Role</label>
													<select class="form-control"  name="RUSR[]"  multiple>
															<option value="all">All</option>
																				<?php  if(!empty($state)){
															foreach($state as $ind => $st) {
															?><option value="<?php echo $st->id ?>"><?php echo $st->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
<!-----------------------------END CATEGORY------------------------------------------------------>									
											</div>
										</div>
									</div>
								</div>
							</div><!-- col end -->
						</div>
						<!-- row end -->
					</div>
				</div>
				<!-- End app-content-->
			</div>
		</div>
	</div>

		<!-- End Page -->
		<script src="<?php echo base_url(); ?>assets/plugins/multipleselect/multiple-select.js"></script>
<script>
	
	$(document).on("change", ".sel-show-trg", function(){
		
		var val = $(this).find("option:selected").text();
		
		$(this).closest(".sceme-apply-area").find(".filter-title").text(val);
	});
</script>
<script>

	$(document).on("click", "#add", function(){
		
		
		 var i=1;  
		var max_fields = 10;
		  if(i< max_fields){
			i++;
		
			$('#addrow').append('<div class="row" id="row'+i+'"><div class="col-md-2"><div class="form-group"><label>From (QTY)</label><input type="text" class="form-control" id="fromqty" name="fromqty[]"></div></div><div class="col-md-2"><div class="form-group"><label>To(QTY)</label><input type="text" class="form-control" id="toqty" name="toqty[]"></div></div><div class="col-md-2"><div class="form-group"><label>Discount(%)</label><input type="text" class="form-control" id="discount" name="discount[]"></div></div><div class="form-group col-md-2" style="margin-top: 22px;"><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');

			} 
		
		
	});

	/*$(document).ready(function(){
		
		      var i=1;  
      var max_fields = 10;

  $('#add').click(function(){  
           
		   
  if(i< max_fields){
    i++;
           alert("hello");

    $('#addrow').append('<div class="row" id="row'+i+'"><div class="col-md-2"><div class="form-group"><label>From (QTY)</label><input type="text" class="form-control" id="fromqty" name="fromqty[]"></div></div><div class="col-md-2"><div class="form-group"><label>To(QTY)</label><input type="text" class="form-control" id="toqty" name="toqty[]"></div></div><div class="col-md-2"><div class="form-group"><label>Discount(%)</label><input type="text" class="form-control" id="discount" name="discount[]"></div></div><div class="form-group col-md-2" style="margin-top: 31px;"><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');

    }  
      });  
 
		
	}); */
	     $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
</script>
<script>
	$(document).on("click", ".add-another-schm", function(){
		
		var clnobj = $(this).closest(".sceme-apply-area").clone();
		var totlen = $(this).closest(".sceme-apply-area").length;
		
		clnobj.find("div.add-multi-select").remove();
		clnobj.find("select").show().prop('selectedIndex',0);
		clnobj.find(".others-sel-area").hide();
		clnobj.find("input[type=radio]").prop("checked", false);
		clnobj.find(".scheme-specific-box").html('');
		
		
		
		$("#scheme-list-area").append(clnobj);
			$('select.add-multi-select').multipleSelect({
				filter: true
			});
			
		$(this).closest(".sceme-apply-area").find(".action-btn-area").html("<a href = 'javascript:void(0)' class = 'btn btn-danger delete-curr-scheme btn-xs'> X Remove </a>");
		//$(this).closest(".sceme-apply-area").find(".add-another-schm").remove();
	});
	
	$(document).on("click", ".delete-curr-scheme", function(){
		
		$(this).closest(".sceme-apply-area").remove();	
	});
	$(document).on("click",".fade-chk-div",function(){
		
		var trgt = $(this).data("target");
		
		$(this).closest(".sceme-apply-area").find(".specific-area").hide();
			
			 var clnobj = 	$(trgt).clone();
			 clnobj.show().removeAttr("id");
			 clnobj.find("select").addClass("add-multi-select");
			 $(this).closest(".sceme-apply-area").find(".scheme-specific-box").html(clnobj);
			$('select.add-multi-select').multipleSelect({
				filter: true
			});
				
	});
	
</script>
		<script>
			$(document).on("click", ".slide-chng-div", function(){
				
				if($(this).prop("checked") == true) {
					$($(this).data('target')).show();
				}else{
					$($(this).data('target')).hide();
				}
			});
		</script>