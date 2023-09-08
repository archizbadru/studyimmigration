
<link href="<?= base_url('assets/plugins/') ?>tabs/style.css" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/') ?>time-picker/jquery.timepicker.css" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/') ?>date-picker/spectrum.js"></script>
		<script src="<?= base_url('assets/plugins/') ?>date-picker/jquery-ui.js"></script>

				<!--Header submenu -->
				<div class="bg-white p-3 header-secondary header-submenu">
					<div class="container ">
						<div class="row">
							<div class="col">
								<div class="d-flex">
								<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="#">Scheme</a></li>
								<li class="breadcrumb-item active" aria-current="page">Update Scheme</li>
							</ol><!-- End breadcrumb -->
								</div>
							</div>
							<div class="col col-auto">
								<a class="btn btn-success mt-4 mt-sm-0" href="<?= base_url('scheme')?>">Scheme List</a>
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
										<h3 class="card-title">Update Scheme</h3>
									</div>
									<div class="card-body p-6">
										<div class="panel panel-primary">
											
											<div class="panel-body tabs-menu-body">
												<div class="tab-content">
											<div class="tab-pane active " id="tab5">
											<div>
												<div id="step-10" class="">
												<?php echo form_open('scheme/update_product_scheme','id="scheme"') ?>
												<input type="hidden" name="pscheme_id" value="<?= $proscheme->id?>">
											    <div class="row">
												<div class="col-6">
												     <label>From</label>
													 <div class="input-group">
												     <div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
													</div>
												</div>
												
												<input class="form-control fc-datepicker hasDatepicker" placeholder="MM/DD/YYYY" type="date" id="fromdate" name="fromdate" required="" value="<?= $proscheme->from_date; ?>">
											</div>
											</div>
												<div class="col-6">
												     <label>To</label>
													 <div class="input-group">
												     <div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
													</div>
												</div>
												
												<input class="form-control fc-datepicker hasDatepicker" placeholder="MM/DD/YYYY" type="date" id="todate" name="todate" required="" value="<?= $proscheme->to_date; ?>">
											</div>
											</div>
											
											</div>
												<div class="row">
												<div class="col-6">
												<div class="form-group">
												<label>Brand</label>
												<select class="form-control" id="brand" name="brand" onchange="find_product();">
												<option value="">Select</option>
												<?php if(!empty($brand)){
												foreach($brand as $blist){
												?>
												<option value="<?= $blist->id?>" <?php if(!empty($proscheme->brand)){if($proscheme->brand==$blist->id){?> selected <?php }}?>><?= $blist->brand_name?></option>
												<?php }}?>
												</select>		
												 </div>
												</div>
												<div class="col-6">
														<div class="form-group">
														<label>Product</label>
														<select class="form-control" id="product" name="product">
															<option value="">Select</option>
															<?php if($pro_list){
															foreach($pro_list as $prolist){
															?>
															<option value="<?= $prolist->pid?>" <?php if(!empty($proscheme->product)){if($proscheme->product==$prolist->pid){?> selected <?php }}?>><?= $prolist->pro_name?></option>
															<?php }}?>
														</select>
														</div>
												</div>
											</div>
										
							
											<div id="addrow">
											<div class="row">
												<div class="col-2">
													<div class="form-group">
														<label>From (QTY)</label>
														<input type="text" class="form-control" id="fromqty" name="fromqty" required="" value="<?= $proscheme->from_qty?>">
													</div>
													
												</div>
												<div class="col-2">
												<div class="form-group">
														<label>To(QTY)</label>
														<input type="text" class="form-control" id="toqty" name="toqty" required="" value="<?= $proscheme->to_qty?>">
														</div>
												</div>
											<div class="col-2">
											<div class="form-group">
											 <label>Discount(%)</label>
											 <input type="text" class="form-control" id="discount" name="discount" value="<?= $proscheme->discount?>">
											 </div>	
											</div>

											 <div class="col-2">
													 <div class="form-group">
												     <label class="custom-control custom-radio">
													 <input type="radio" class="custom-control-input" name="status" value="1" checked="">
													 <span class="custom-control-label">Active</span>
												     </label>
												      <label class="custom-control custom-radio">
													 <input type="radio" class="custom-control-input" name="status" value="0">
													 <span class="custom-control-label">Inactive</span>
												     </label>
												 </div>
											 </div>
                                         
											</div>
											</div>											 
											<div class="col-12">
												
												<button type="submit" class="btn btn-primary">Update</button>

											</div>
												<?php echo form_close();?>
											</div>
											</div>
											</div>
										
<!---------------------------------------------------Region Scheme-------------------------------------------------------------------------------------------------->

											</div>
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

<script>
	function find_product() {
       
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>scheme/get_pro_bybrand',
            data: $('#scheme').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('product').innerHTML=data;
            }else{
              document.getElementById('product').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
</script>


		