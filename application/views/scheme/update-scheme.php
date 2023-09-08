<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/multipleselect/multiple-select.css">
				<!--Header submenu -->
				<div class="bg-white p-3 header-secondary header-submenu">
					<div class="container ">
						<div class="row">
							<div class="col">
								<div class="d-flex">
								<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="#">Scheme</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Scheme</li>
							</ol><!-- End breadcrumb -->
								</div>
							</div>
							<div class="col col-auto">
								
								<a class="btn btn-success mt-4 mt-sm-0" href="<?= base_url('scheme')?>"><i class="fe fe-plus mr-1 mt-1"></i>Scheme List</a>
							</div>
						</div>
					</div>
				</div><!--End Header submenu -->
<br>
                <!-- app-content-->
				<div class="container content-area">
					<div class="side-app">
						<!-- row -->
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
												<?php echo form_open('scheme/edit/'.$schm->coupan,'id="scheme"') ?>
																						

												<div class="row">
												<div class="form-group col-3">
												     <label>Active</label>
													 <div class="input-group">
												     <div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
													</div>
												</div>
												
												<input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" value ="<?php echo date("m/d/Y", strtotime($schm->from_date)); ?>" type="text" id="fromdate" name="fromdate" required="">
											</div>
											</div>
												<div class="form-group col-3">
												     <label>Expire</label>
													 <div class="input-group">
												     <div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
													</div>
												</div>
												
												<input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" value = "<?php echo date("m/d/Y", strtotime($schm->to_date)); ?>" type="text" id="todate" name="todate" required="">
											</div>
											</div>
											<div class = "col-3">
												<div class = "form-group">
													<label>Calculation Method</label>
													
													<label class="custom-control custom-radio">
														<input type="radio" class="custom-control-input" name="calcmeth" value="1" <?php echo ($schm->calc_mth == 1) ? "checked" : ""; ?>>
														<span class="custom-control-label"> % </span>
													</label> 
													<label class="custom-control custom-radio">
														<input type="radio" class="custom-control-input" name="calcmeth" value="2" <?php echo ($schm->calc_mth == 2) ? "checked" : ""; ?>>
														<span class="custom-control-label"> <i class = "fa fa-rupee"></i> </span>
													</label>
												
												</div>
											</div>	
											<div class = "col-3">
												<div class = "form-group">
													<label>Calculation Type</label>
													<div class = "input-group">
													<label class="custom-control custom-radio">
														<input type="radio" class="custom-control-input" name="calctype" value="1" <?php echo ($schm->calc_type == 1) ? "checked" : ""; ?>>
														<span class="custom-control-label"> Add in Total </span>
													</label> 
													<label class="custom-control custom-radio">
														<input type="radio" class="custom-control-input" name="calctype" value="2" <?php echo ($schm->calc_type == 2) ? "checked" : ""; ?>>
														<span class="custom-control-label"> Highest Apply</span>
													</label>
													</div>
												</div>
											</div>	
						
											</div>
									<div class = "row">
															<?php 
															$role = $utype = $prod = $categ =  $users = $brand = $region = $state = $city = $utype = $whouse = array();
															
															if(!empty($alldata)){
																foreach($alldata as $ind=> $catg){
																	
																	if($catg->type == "categ"){
																		
																		$categ[] = $catg;
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
										<div class = "col-12" id = "scheme-list-area">	
										<?php if(!empty($schm->all_apply)) {

												$allschmarr = explode(",", $schm->all_apply);
												
										foreach($allschmarr as $ind => $scm ) {
											$pind = $ind;
												$schm->scm_apply = $scm;
											?>	
										<div class="row sceme-apply-area">
											<div class = "col-3">
												<div class = "form-group">
													<label>Apply On</label>
													<select class = "form-control sel-show-trg" name ="schmapply[]">
														<option value = "1" <?php echo ($schm->scm_apply == 1) ? "selected" : ""; ?>>All</option>
														<option value = "2" data-target = ".prod-area"  <?php echo ($schm->scm_apply == 2) ? "selected" : ""; ?>>Product</option>
														<option value = "3" data-target = ".loc-area"  <?php echo ($schm->scm_apply == 3) ? "selected" : ""; ?>>Location</option>
														<option value = "4"  data-target = ".payment-area"  <?php echo ($schm->scm_apply == 4) ? "selected" : ""; ?>>Payment</option>
														<option value = "5"  data-target = ".user-area"  <?php echo ($schm->scm_apply == 5) ? "selected" : ""; ?>>User</option>
													</select>
												</div>	
											</div>
											<div class = "col-4">
											<?php 
												$scharr = (!empty($schm->prdt_val)) ? explode(",", $schm->prdt_val) : array();		
											?>
												<label>Choose</label>
													<div class = "input-group  prod-area others-sel-area "  <?php echo ($schm->scm_apply != 2) ? "style ='display:none'" : ""; ?>>
														
															<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="prodschemes" value="CTG" data-target = "#categ-area"  <?php echo ($schm->scm_apply == 2 and $schm->	by_prdt == "CTG") ? "checked" : ""; ?>>
																<span class="custom-control-label"> Category </span>
															</label>&nbsp;
															<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="prodschemes" value="SBCTG" data-target = "#sub-categ-area"  <?php echo ($schm->scm_apply == 2 and $schm->	by_prdt == "SBCTG") ? "checked" : ""; ?>>
																<span class="custom-control-label"> Subcategory </span>
															</label>&nbsp;
															<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="prodschemes" value="PRD" data-target = "#prod-list-area"  <?php echo ($schm->scm_apply == 2 and $schm->	by_prdt == "PRD") ? "checked" : ""; ?>>
																<span class="custom-control-label"> Product </span>
															</label>
														</div>
													
													<div class = "input-group  loc-area others-sel-area"  <?php echo ($schm->scm_apply != 3) ? "style ='display:none'" : ""; ?>>
																<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="locschemes" value="CTY" data-target = "#usr-city-area"  <?php echo ($schm->scm_apply == 3 and $schm->	usr_loc == "CTY") ? "checked" : ""; ?>>
																<span class="custom-control-label"> City </span>
															</label> &nbsp;
													
															<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="locschemes" value="RGN" data-target = "#region-area" <?php echo ($schm->scm_apply == 3 and $schm->	usr_loc == "RGN") ? "checked" : ""; ?>>
																<span class="custom-control-label"> Region </span>
															</label>&nbsp;
															<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="locschemes" value="ST" data-target = "#state-area" <?php echo ($schm->scm_apply == 3 and $schm->	usr_loc == "ST") ? "checked" : ""; ?>>
																<span class="custom-control-label"> State </span>
															</label>					
													</div>
													<div class = "input-group  payment-area others-sel-area"   <?php echo ($schm->scm_apply != 4) ? "style ='display:none'" : ""; ?>>
																<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="payschemes" value="PY-1" data-target = "#pay-mode-area" <?php echo ($schm->scm_apply == 4 and $schm->	by_pay == "PY-1") ? "checked" : ""; ?>>
																<span class="custom-control-label"> Mode </span>
															</label> &nbsp;
															<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="payschemes" value="PY-2" <?php echo ($schm->scm_apply == 4 and $schm->	by_pay == "PY-2") ? "checked" : ""; ?>>
																<span class="custom-control-label">One Payment Time </span>
															</label>&nbsp;
															<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="payschemes" value="PY-3" <?php echo ($schm->scm_apply == 4 and $schm->	by_pay == "PY-3") ? "checked" : ""; ?>>
																<span class="custom-control-label"> Using Debit and Credit Card </span>
															</label>&nbsp;
																			
													</div>
													<div class = "input-group  user-area others-sel-area"   <?php echo ($schm->scm_apply != 5) ? "style ='display:none'" : ""; ?>>
																<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="usrschemes" value="SUSR" data-target = "#usr-list-area" <?php echo ($schm->scm_apply == 5 and $schm->usr_type == "SUSR") ? "checked" : ""; ?>>
																<span class="custom-control-label"> Specific Users </span>
															</label> &nbsp;
															<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="usrschemes" value="RUSR" data-target = "#usr-role-area"  <?php echo ($schm->scm_apply == 5 and $schm->usr_type == "RUSR") ? "checked" : ""; ?>>
																<span class="custom-control-label"> User Role </span>
															</label>&nbsp;
															<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input fade-chk-div" name="usrschemes" value="USRTP" data-target = "#usr-type-area"  <?php echo ($schm->scm_apply == 5 and $schm->usr_type == "USRTP") ? "checked" : ""; ?>>
																<span class="custom-control-label"> User Type </span>
															</label>&nbsp;
													</div>	
											</div>
											
												<div class = "col-3 scheme-specific-box">
							
												<?php if($schm->scm_apply == 2 and $schm->by_prdt == "CTG") {  ?>
													<div  class = "form-group">
														<label>Category</label>
														<select class="form-control add-multi-select"  name="CTG[]" multiple>
																<option value="all">All</option>
																<?php if(!empty($categ)){
																	foreach($categ as $ind =>$ctg) {
																	?><option value = '<?php echo $ctg->id ?>' <?php echo (in_array($ctg->id, $scharr)) ? "selected" : "" ?>><?php echo $ctg->title;  ?></option><?php
																	}
																} ?>
															
														</select>		
												</div>
												<?php } ?>
												<?php if($schm->scm_apply == 2 and $schm->by_prdt == "CTG") {  ?>
												<div  class = "form-group">
														<label>Subcategory</label>
														<select class="form-control  add-multi-select"  name="SBCTG[]" multiple>
															<option value="all">All</option>
														</select>		
												</div>
											<?php } ?>
											
												<?php if($schm->scm_apply == 2 and $schm->by_prdt == "PRD") {  ?>
												 <div  class="form-group">
														<label>Product</label>
														<select class="form-control add-multi-select" name="PRD[]"  multiple>
															<option value="all">All</option>
															<?php if(!empty($prod)){
															foreach($prod as $prolist){
															?>
															<option value="<?= $prolist->id?>"  <?php echo (in_array($prolist->id, $scharr)) ? "selected" : "" ?>><?= $prolist->title?></option>
															<?php }}?>
														</select>
												</div>
											<?php } ?>
											<?php 	$scharr = (!empty($schm->loc_id)) ? explode(",", $schm->loc_id) : array();		
											 ?>
												<?php if($schm->scm_apply == 3 and $schm->usr_loc == "CTY") {  ?>
												<div class = "form-group">
													<label>City</label>
													<select class="form-control add-multi-select"  name="CTY[]"  multiple>
															<option value="all">All</option>
														<?php if(!empty($city)){
															foreach($city as $ind => $cty) {
															?><option value="<?php echo $cty->id; ?>"  <?php echo (in_array($cty->id, $scharr)) ? "selected" : "" ?>><?php echo $cty->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
											<?php } ?>
												<?php if($schm->scm_apply == 3 and $schm->usr_loc == "RGN") {  ?>
>
												<div class = "form-group">
													<label>Region</label>
													<select class="form-control add-multi-select"  name="RGN[]"  multiple>
															<option value="all">All</option>
												<?php  if(!empty($region)){
															foreach($region as $ind => $rgn) {
															?><option value="<?php echo $rgn->id ?>"  <?php echo (in_array($rgn->id, $scharr)) ? "selected" : "" ?>><?php echo $rgn->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
												<?php } ?>
												<?php if($schm->scm_apply == 3 and $schm->usr_loc == "ST") {  ?>
												<div class = "form-group">
													<label>State</label>
													<select class="form-control add-multi-select"  name="ST[]"  multiple>
															<option value="all">All</option>
																				<?php  if(!empty($state)){
															foreach($state as $ind => $st) {
															?><option value="<?php echo $st->id ?>"  <?php echo (in_array($st->id, $scharr)) ? "selected" : "" ?>><?php echo $st->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
											<?php } ?>
											<?php 	$scharr = (!empty($schm->usr_fld)) ? explode(",", $schm->usr_fld) : array();		
											 ?>
											
												<?php if($schm->scm_apply == 3 and $schm->usr_type == "CTG") {  ?>
												<div class = "form-group">
													<label>User</label>
													<select class="form-control add-multi-select"  name="SUSR[]" multiple>
															<option value="all">All</option>
																				<?php  if(!empty($users)){
															foreach($users as $ind => $usr) {
															?><option value="<?php echo $usr->id ?>"  <?php echo (in_array($usr->id, $scharr)) ? "selected" : "" ?>><?php echo $usr->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
										<?php } ?>
												<?php if($schm->scm_apply == 3 and $schm->usr_type == "SUSR") {  ?>
												<div class = "form-group">
													<label>User Type</label>
													<select class="form-control add-multi-select"  name="USRTP[]"  multiple>
															<option value="all">All</option>
																				<?php  if(!empty($utype)){
															foreach($utype as $ind => $typ) {
															?><option value="<?php echo $typ->id ?>"  <?php echo (in_array($typ->id, $scharr)) ? "selected" : "" ?>><?php echo $typ->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
										<?php } ?>
												<?php if($schm->scm_apply == 3 and $schm->usr_type == "RUSR") {  ?>
												<div class = "form-group">
													<label>Role</label>
													<select class="form-control add-multi-select"  name="RUSR[]"  multiple>
															<option value="all">All</option>
																				<?php  if(!empty($state)){
															foreach($state as $ind => $st) {
															?><option value="<?php echo $st->id ?>"  <?php echo (in_array($st->id, $scharr)) ? "selected" : "" ?>><?php echo $st->title; ?></option><?php
															}
														} ?>	
													</select>		
												</div>
												<?php } ?>
												</div>	
												<div class= "col-2 action-btn-area">
													<?php if($pind == count($allschmarr) - 1) { ?>
													<a href = "javascript:void(0)" class = "add-another-schm btn btn-info"> + Add </a>
													<?php }else{
														?><a href = 'javascript:void(0)' class = 'btn btn-danger delete-curr-scheme btn-xs'> X Remove </a><?php
													} ?>
												</div>
												<div class = "col-12">
													<hr />
												</div>
											</div>
										<?php }
										} ?>
										</div>
									</div>	
											<div class = "row">
											
											</div>	
											<div  id="addrow">
											<div class="row">
												<div class="col-2 add-quantity-area" <?php echo ($schm->apply_qty == 0) ? 'style = "display:none;"' : ""; ?>>
													<div class="form-group">
														<label>From (QTY)</label>
														<input type="text" class="form-control" id="fromqty" name="fromqty[]" value = "">
													</div>
													
												</div>
												<div class="col-2 add-quantity-area" <?php echo ($schm->apply_qty == 0) ? 'style = "display:none;"' : ""; ?>>
													<div class="form-group">
														<label>To(QTY)</label>
														<input type="text" class="form-control" id="toqty" name="toqty[]">
														</div>
												</div>
											<div class="col-2">
											<div class="form-group">
											 <label>Discount(%)</label>
											 <input type="text" class="form-control" id="discount" name="discount[]" value = "<?php echo $schm->discount; ?>">
											 </div>	
											</div>
                                            <div class="col-2 add-quantity-area" <?php echo ($schm->apply_qty == 0) ? 'style = "display:none;"' : ""; ?>>
                                            	<div class="form-group" style="margin-top: 31px;">
                                            
												 <a name="add" id="add" class="btn btn-success">Add More</a>
												</div>
												</div>
														<div class = "col-6">
												<br />
													<label class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input slide-chng-div" name="applyonqty" value="qty" data-target=".add-quantity-area" <?php echo ($schm->apply_qty == 1) ? 'checked' : ""; ?>>
														<span class="custom-control-label"><h4 class = "text-info">Apply On Quantity</h4></span>
													</label>
												</div>
											</div>
											</div>											 
											<div class="col-12">
												<input type = "hidden" name  = "schemeno" value = "<?php echo $schm->id ?>">
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
															?><option value="SUSR-<?php echo $usr->id ?>"><?php echo $usr->title; ?></option><?php
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
															?><option value="USRTP-<?php echo $typ->id ?>"><?php echo $typ->title; ?></option><?php
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
															?><option value="RUSR-<?php echo $st->id ?>"><?php echo $st->title; ?></option><?php
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
		<!-- End Page -->
<script src="<?php echo base_url(); ?>assets/plugins/date-picker/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/multipleselect/multiple-select.js"></script>
<script>
	$(document).ready(function(){
		        
		$(".fc-datepicker,.rfc-datepicker,pfc-datepicker").datepicker();
			$('.add-multi-select').multipleSelect({
				filter: true
			})
		
	});
	$(document).on("change", ".sel-show-trg", function(){
		
		var val = $(this).find("option:selected").text();
		
		$(this).closest(".sceme-apply-area").find(".filter-title").text(val);
	});
</script>
<script>
	$(document).ready(function(){
		
		      var i=1;  
      var max_fields = 10;

  $('#add').click(function(){  
           
  if(i< max_fields){
    i++;
           

    $('#addrow').append('<div class="row" id="row'+i+'"><div class="col-2"><div class="form-group"><label>From (QTY)</label><input type="text" class="form-control" id="fromqty" name="fromqty[]"></div></div><div class="col-2"><div class="form-group"><label>To(QTY)</label><input type="text" class="form-control" id="toqty" name="toqty[]"></div></div><div class="col-2"><div class="form-group"><label>Discount(%)</label><input type="text" class="form-control" id="discount" name="discount[]"></div></div><div class="form-group col-md-2" style="margin-top: 31px;"><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');

    }  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
		
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