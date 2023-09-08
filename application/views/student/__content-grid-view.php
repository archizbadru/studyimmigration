	<div class="row">
	<?php 
    $i=1;
	foreach($courses as $key =>  $movie){ ?>
				
						<div class="col-md-4 col-lg-4 pxpadding" style="height: 500px;">
							<div class="course-box-wrap" style="border:2px solid #337ab7;border-radius: 20px 0px;">
								 <a href="">
									<div class="course-box">
									<?php if ($this->session->companey_id!='67') { ?>
									<div class="course-image containerss"style="width:100%;height:50px;padding-top:5px;padding-left:20%;" >
											<a href="#" class="btn btn-primary"><span><i class="fa fa-video-camera" aria-hidden="true"></i></span></a>&nbsp;&nbsp;
                                            <a href="#" class="btn btn-warning"><span><i class="fa fa-comments-o" aria-hidden="true"></i></span></a>

                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-danger" style="border-radius:20px;"><?= $i;?></span>
                                        </div>
									<?php } ?>
									</div>

									 <div class="course-image containerss"style="width:100%;height:250px;" >
											<img src="<?php echo base_url($movie->course_image); ?>" alt="" class="img-fluid" style="width:60%;height:60px;padding-left:16%;padding-right:16%;margin-left: 40px">
													 <div class="text" style="color:#000000;height:100px;overflow-y: scroll;"><?php echo $movie->course_discription; ?></div>
									</div>
									 <div class="course-details" style="height:200px;margin-top: -85px;">
										 <h4 class="badge-success-lighten" id="h" style="color:#000000;font-size:16px;"><?php echo $movie->institute_name; ?></h5>

			<?php if ($this->session->companey_id!='67') { ?>
										<h5 class="badge-success-lighten" id="h" style="color:#F1CB0D;font-size:16px;">
											<i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>  
											  <?php echo ($movie->course_rating); ?>&nbsp;&nbsp; Rating</h5>
												<?php }else{ ?>
												<h5 class="badge-success-lighten" id="h" style="color:#F1CB0D;font-size:16px;">  
											  <?php if(!empty($movie->course_ielts)){ echo ($movie->course_ielts);}else{ echo '0';} ?>&nbsp;&nbsp; IELTS</h5>
												<?php } ?>											  
										<h5 class="badge-success-lighten" id="h" style="color:#000000;font-size:14px;"><?php echo $movie->course_name ?></h5>
<?php if ($this->session->companey_id!='67') { ?>
										<h5 class="badge-success-lighten" id="h" style="color:#000000;font-size:14px;font-family: serif;"><b>Schedule Date :</b><?php if(!empty($movie->schdl_dt)){ echo $movie->schdl_dt;}else{ echo 'No Schedule Date'; }?></h5>
	                                    <h5 class="badge-success-lighten" id="h" style="color:#000000;font-size:14px;font-family: serif;">Availbility Time :<?php if(!empty($movie->stm)){ echo $movie->stm;}else{ echo 'No Schedule Time'; } ?></h5>
	                                     <h5 class="badge-success-lighten" id="h" style="color:#000000;font-size:14px;font-family: serif;">Queue No.:<?= $i;?></h5>
<?php } ?>
									</div>
								</a>
<div style="padding-left:1%"><a href="<?php echo base_url('dashboard/course_details/'.$movie->institute_id.'/'.$movie->crs_id); ?>" class="btn btn-success"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span></a>&nbsp;&nbsp;
<a href="<?php echo 'add_wishlist/'.$movie->crs_id.'/'.$movie->institute_id;?>" class="btn btn-danger"><span><i class="fa fa-heart-o" aria-hidden="true"></i></span></a>&nbsp;&nbsp;
<a href="" class="btn btn-primary"><span><i class="fa fa-cart-plus" aria-hidden="true"></i></span> Apply</a>&nbsp;&nbsp;
									</div><br>
							</div>
						</div>						
			   <?php $i++;} ?>
			   
	</div>