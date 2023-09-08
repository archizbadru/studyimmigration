<style>
.morecontent span {
    display: none;
}
.morelink {
    display: block;
}
a:hover, a:focus {
    text-decoration: none;
    outline: none;
    color: #37a000;
	font-weight:900;
}
</style>
					<?php $i=1;
					foreach($courses as $key =>  $movie){ ?>
					<div class="row grid-show" style="border:2px solid #337ab7;border-radius: 20px 0px;">
						<div class="col-md-3 text-center">
					<?php if(!empty($movie->profile_image)){ ?>
							<img class="img-responsive" src="<?php echo 'https://student.spaceinternationals.com/new_crm/'.$movie->profile_image; ?>" style="">
					<?php }else{ ?>
					       <img class="img-responsive" src="<?php echo base_url('assets/images/NoPicAvailable.png'); ?>" style="">
					<?php } ?>
						</div>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-12">
							<h5 class="title" style="color: #000000"><?php echo $movie->institute_name; ?></h5>	
						
								<p class="course-descr more"><?php echo $movie->course_discription; ?></p>
									
								</div>
							</div>
							<div class="row">
									<p class="col-md-6"><b>Course :</b><?php echo $movie->course_name ?>
												</p>
												<?php if ($this->session->companey_id!='67') { ?>
										<p class="col-md-6" style="color:#F1CB0D;"><b>Rating: <?php echo ($movie->course_rating); ?>&nbsp;</b><i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>  
										</p>
												<?php }else{ ?>
										<p class="col-md-6" style="color:#F1CB0D;"><b>IELTS: &nbsp;<?php if(!empty($movie->course_ielts)){ echo ($movie->course_ielts);}else{ echo '0';} ?></b>  
										</p>
												<?php } ?>
									</div>
									<div class="row">
									<?php if ($this->session->companey_id!='67') { ?>
										<h5 class="badge-success-lighten col-md-6" id="h" style="color:#000000;font-size:14px;font-family: monospace;"><b>Schedule Date :</b><?php if(!empty($movie->schdl_dt)){ echo $movie->schdl_dt;}else{ echo 'No Schedule Dtae'; }?></h5>
	                                    <h5 class="badge-success-lighten col-md-6" id="h" style="color:#000000;font-size:14px;font-family: monospace;">Availbility Time :<?php if(!empty($movie->stm)){ echo $movie->stm;}else{ echo 'No Schedule Time'; } ?></h5>
	                                     <h5 class="badge-success-lighten col-md-6" id="h" style="color:#000000;font-size:14px;font-family: monospace;">Queue No. :<?= $i;?></h5>
									<?php } ?>
<div class="col-md-6" style="padding-top:5px;"><a href="<?php echo base_url('dashboard/course_details/'.$movie->institute_id.'/'.$movie->crs_id); ?>" class="btn btn-success"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span></a>&nbsp;&nbsp;
<a href="<?php echo 'add_wishlist/'.$movie->crs_id.'/'.$movie->institute_id;?>" class="btn btn-danger"><span><i class="fa fa-heart-o" aria-hidden="true"></i></span></a>&nbsp;&nbsp;
<?php if ($this->session->companey_id!='67') { ?>
<a href="#" class="btn btn-primary"><span><i class="fa fa-video-camera" aria-hidden="true"></i></span></a>&nbsp;&nbsp;
<a href="#" class="btn btn-warning"><span><i class="fa fa-comments-o" aria-hidden="true"></i></span></a>
<?php } ?>
<a href="" class="btn btn-primary"><span><i class="fa fa-cart-plus" aria-hidden="true"></i></span> Apply</a>&nbsp;&nbsp;
</div>							
							</div>
								</div>
						</div>
					<?php $i++; } ?>	
			  <?php if(!empty($pageno)) {
					?>
					<div class="row">
						<div class="col-md-12">
							<ul class="pagination-area"><?php
								for($i=1;$i<=$pageno; $i++) {	
								?>
								<li><a href="<?php echo base_url("action/getcontent/".$i); ?>"> <?php echo $i; ?> </a></li>
						<?php   } ?>
							</ul>
						</div>
					</div>	
			<?php	} ?>
<script>
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more...";
    var lesstext = "...Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
</script>