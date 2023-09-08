
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("scheme/add") ?>"> <i class="fa fa-plus"></i> Add Scheme </a>  
                </div>
            </div>
                <!-- app-content-->
				<div class="panel-body panel-form">
						<div class="row">
			
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Scheme Lists</h3>
									</div>
									<div class="card-body p-6">
										<div class="panel panel-primary">
								
											<div class="panel-body tabs-menu-body">
										
								            <table id="example" class="table table-striped table-bordered text-nowrap w-100 no-footer" id = "pro-datatable">
											<thead>
												<tr>
													<th class="wd-15p">S.No.</th>
													<th>Code</th>
													<th class="wd-15p">From Date</th>
													<th class="wd-15p">To Date</th>
													<th class="wd-15p">QTY</th>
													<th class="wd-15p">Discount(%)</th>
													<th class="wd-20p">Status</th>
													<th class="wd-15p">Action</th>
													
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($pscheme_list)){
												   $sl=1;
                                                  foreach($pscheme_list as $pschemelist){
												?>
												<tr>
													<td><?= $sl; ?></td>
													<td><?php echo $pschemelist->coupan; ?></td>
													<td><?= $pschemelist->from_date; ?></td>
													<td><?= $pschemelist->to_date; ?></td>
											
													<td>
														<span class="badge badge-info  mr-1 mb-1 mt-1">From(Qty): <?= $pschemelist->from_qty;?></span><br>
														<span class="badge badge-info  mr-1 mb-1 mt-1">To(Qty): <?= $pschemelist->to_qty;?></span>

													</td>
													<td><?= $pschemelist->discount;?></td>
													<td>
													<?php if($pschemelist->status==1){ echo 'Active'; } else{ echo 'Inactive'; }?>

													</td>
													<td>
														<a href="<?= base_url('scheme/edit/'.$pschemelist->coupan); ?>" class="btn btn-info">
														<i class="fa fa-pencil" data-toggle="tooltip" title="" data-original-title="Edit"></i></a>
														<a href="<?php echo base_url("scheme/delete_scheme/$pschemelist->sid") ?>" onclick="return confirm('<?php echo "are you sure" ?>')" class="btn btn-danger">
														<i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>

													</td>
												</tr>

												<?php  $sl++; }
											}else{?>	
											<tr><td></td><td></td><td></td><td>No records found</td><td></td><td></td><td></td><td></td></tr>
											<?php }?>	
										</tbody>
										</table>
											
										
<!---------------------------------------------------Region Scheme-------------------------------------------------------------------------------------------------->

							

									
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
		
