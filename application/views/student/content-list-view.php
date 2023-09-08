<style>
.morecontent span {
    display: none;
}
.morelink {
    display: block;
}
</style>
					<?php 
				
					$i=1;
					foreach($courses as $key =>  $movie){ ?>
					<div class="row grid-show" style="border:2px solid #2e6da4;border-radius: 20px 0px;">
						<div class="col-md-3 text-center">
							<?php if(!empty($movie->profile_image)){ ?>
							<img class="img-responsive" src="<?php echo 'https://student.spaceinternationals.com/new_crm/'.$movie->profile_image; ?>" style="width:100%;height:60%;">
					<?php }else{ ?>
					       <img style="width:100%;height:60%;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAYAAACtWK6eAAASX0lEQVR4Xu2cd8xWNRvGCxiNcUQJ4ggB/3BGhThwEAFnRFEcUREnLnAj4sCJIu6JAxWcIBpnUAE1iqDgFowgRsU/GIkT0KhoHIi5mvTJ+fqec9pzn/ep9OvV5E2U5/T07u/u1XG3PW1WrFixSjGRAAnkEmhDgbBlkEAxAQqErYMESghQIGweJECBsA2QgIwARxAZN+ZKhAAFkoijWU0ZAQpExo25EiFAgSTiaFZTRoACkXFjrkQIUCCJOJrVlBGgQGTcmCsRAhRIIo5mNWUEKBAZN+ZKhAAFkoijWU0ZAQpExo25EiFAgSTiaFZTRoACkXFjrkQIUCCJOJrVlBGgQGTcmCsRAhRIIo5mNWUEKBAZN+ZKhAAFkoijWU0ZAQpExo25EiFAgSTiaFZTRoACkXFjrkQIUCCJOJrVlBGgQGTcmCsRAhRIIo5mNWUEKBAZN+ZKhAAFkoijWU0ZAQpExo25EiFAgSTiaFZTRoACkXFjrkQIUCCJOJrVlBGgQGTcmCsRAhRIIo5mNWUEKBAZN+ZKhAAFkoijWU0ZAQpExo25EiFAgSTiaFZTRoACkXFjrkQIUCCJOJrVlBGgQGTcmCsRAhRIIo5mNWUEKBAZN+ZKhAAFkoijWU0ZAQpExo25EiFAgSTiaFZTRoACkXFjrkQIUCCJOJrVlBGgQGTcmCsRAhRIIo5mNWUEKBAZN+ZKhAAFkoijWU0ZAQpExo25EiFAgSTiaFZTRoACkXFjrkQIUCCJOJrVlBGgQGTcmCsRAhRIIo5mNWUEKBAZN+ZKhAAFkoijWU0ZAQpExo25EiFAgSTiaFZTRoACkXFjrkQIUCCJOJrVlBGgQGTcmCsRAhRIIo5mNWUEKBAZN+ZKhAAFkoijWU0ZAQpExo25EiFAgSTiaFZTRoACkXFjrkQIUCCJOJrVlBGgQGTcmCsRAhRIIo5mNWUEKBAZN+ZKhAAFkoijWU0ZAQpExo25EiFAgSTiaFZTRoACkXFjrkQItJpA/vnnH/X555+rZ599Vs2aNUt98skn6tdff1Xrrruu6tatm9pzzz3VkUceqbbZZhvVtm3bSniXL1+uJk2apKZOnaree+899eOPP6oNN9xQ7b777uroo49WBx54oFpvvfUqvRMP//HHH+rtt99WTz31lHr//ffVggUL9Dt23XVX1adPH3XMMceozp07qzZt2lR+dwwZfv/9d/XOO++op59+Ws2bN0/7DAl13mGHHTSDQw45RG200UaVq7NkyRLdFl5//XX10Ucf6baA93bv3l0df/zxqmfPnmrttdeu/N5mtYUiQ1pFIF9++aW67LLL1Msvv+ys8LHHHqtGjBihOnXq5HwWonvhhRfUNddc02i8eZm23HJL/c5DDz3UW3w+NkPcZ555prrwwgu10P9fki9X1Bcd0SWXXKJOO+00rwaNTufRRx9V1157re7IitLOO++sbr75ZrXbbrt5dUC+NkvaQplfawsEo8U555xT2oBtA9CL3HHHHWrHHXcstO3vv/9WEydOVBdffLHufVwJDRjAjzvuOLXGGmuUPv7xxx+roUOHqg8//ND1Wv37ySefrB2OxhJ7Atd77rlH3XDDDV5cTX19GGBEgl+vu+46L0wYUUaPHq3233//UpE0sy24DK0lkK+++kr3LKahoZGeeuqp6sQTT1RbbLGFbqh//vmnQm8NEE888UTDHgzfY8aMURtvvHGujTNnzlSDBg1Sixcv1r+jx8Eo0aNHD92TrVixQr355ptq5MiRenpgpgZjx47Vw3dR+v7779W5556rJk+erB8xPSSEhf9euXKl+uKLL9Stt96qpx4mQSDnnXeeU3wu4P/1788884zu0Eyngx4XnQX80bFjR91Qf/75Zz31uv7669Xs2bMbJl911VVq2LBhuQxWrVql8G6wNe/G1Hf48OGqa9euas0111Q//fSTevHFF7U4jV/RWT7wwANq6623LkTTrLbg4wuxQNCQAPDGG2/U5UAcd999tzrqqKNyewP0AnfddZe68sorG3YBFIDac/wffvhBnX322WrKlCn62YMPPli/Gw60E0DDwa+88or+6YgjjtDPbrDBBi2ehc3o4SA0l6Ds3hC9HUa0nXbayYfravnMt99+qzu06dOna/tcjdPuTDbZZBO9Xttll11a1A/rtxNOOKHRWaFzGzVqlFpnnXVaPGuP4Oh4rr76arXWWmu1eLZZbcHXQWKBLFy4UA0cOLAxepT1LsYY9PqYzz7yyCP6n/bee2/14IMPKoDPJqw7sFYxjdjVMOfMmaOnVhALhPrQQw9pUdnJthlTsrPOOqtweEePBwE///zz+lVljvQF/l8+l+UK5g8//LDq3bt3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" alt="preview image">
					       <!-- <img class="img-responsive" src="<?php echo 'https://student.spaceinternationals.com/new_crm/assets/images/NoPicAvailable.png'; ?>" style="width:100%;height:60%;"> -->
					<?php } ?>
						</div>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-12">
							<h5 class="title" style="color: #000000"><?php echo $movie->institute_name; ?></h5>	
						
								<div class="course-descr more"><?php echo $movie->course_discription; ?></div>
								
										<p class="col-md-6" style="color:#F1CB0D;"><b>IELTS: &nbsp;<?php if(!empty($movie->course_ielts)){ echo ($movie->course_ielts);}else{ echo '0';} ?></b>  
										</p>
											
								</div>
							</div>
							<div class="row">
									<p class="col-md-6"><b>Course :</b><?php echo $movie->course_name ?>
												</p>
									</div>
									<div class="row">
										<div class="col-md-6" style="padding-top:5px;"><a href="<?php echo base_url('dashboard/course_details/'.$movie->insid.'/'.$movie->crs_id); ?>" class="btn btn-success"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span></a>&nbsp;&nbsp;
										<a href="<?php echo 'add_wishlist/'.$movie->crs_id.'/'.$movie->institute_id;?>" class="btn btn-danger"><span><i class="fa fa-heart-o" aria-hidden="true"></i></span></a>&nbsp;&nbsp;
										<?php
										if (user_access(60)) { ?>
											<a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#apply_now" onclick="set_apply_with(<?=$movie->crs_id?>)"><span>
										<?php	
										}else{ ?>
											<a href="javascript:void(0)" onclick="apply_with(<?=$movie->crs_id?>)" class="btn btn-primary"><span>											
										<?php
										}
										?>
											<i class="fa fa-cart-plus" ></i></span> Apply</a>&nbsp;&nbsp;
										</div>							
							</div>
								</div>
						</div>
						<div class="col-md-12">		
						</div>
					<?php $i++; } ?>
					<div class="load-more text-center" lastID="<?php echo $i; ?>">		
						<a href="javascript:void(0)" id="load-more" class="btn btn-primary">Load More ...</a>
					</div>	
			  
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

			
	<!-- Modal -->
	<div class="modal fade" id="apply_now" tabindex="-1" role="dialog" aria-labelledby="apply_nowLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="apply_nowLabel">Basic Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="<?=base_url()?>enquiry/create" method="post">
	        	<div class="row">
	        		<div class="col-md-6">	        			
			        	<label>First Name</label>
			        	<input type="text" name="enquirername" class="form-control">
	        		</div>	        	
	        		<div class="col-md-6">	        			
			        	<label>Last Name</label>
			        	<input type="text" name="lastname" class="form-control">
	        		</div>	
	        	</div>
	        	<div class="row">
	        		<div class="col-md-6">	        			
			        	<label>Mobile</label>
			        	<input type="text" name="mobileno" class="form-control">
			        </div>
	        		<div class="col-md-6">	        			
			        	<label>Email</label>
			        	<input type="email" name="email" class="form-control">
			        </div>
			        <div class="col-md-12 text-center">				        
				        <br>	
				        <input type="hidden" name="apply_with">		        
	        			<input type="submit" name="submit" value="Submit" class="btn btn-primary">			        	
			        </div>
	        </form>
	      </div>	      
	    </div>
	  </div>
	</div>
<script>
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 300;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >";
    var lesstext = "Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 			
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><div class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></div>';
 
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

<script type="text/javascript">
	$("#load-more").on('click',function(){
	    var lastID = $('.load-more').attr('lastID');        
	    $.ajax({
	        type:'POST',
	        url:"<?=base_url().'programs/load_programs'?>",
	        data:{'id':lastID},
	        beforeSend:function(){
	            $('.load-more').show();
	        },
	        success:function(html){
	            $('.load-more').remove();
	            $('#courses-area').append(html);
	        } 
	    });
    });
	
	function set_apply_with(id){
		$("input[name='apply_with']").val(id);
	}
	
	function apply_with(id){
		var enquiry_code = "<?=$student_Details['Enquery_id']?>";
		if (confirm('Are you sure ?')) {
			$.ajax({
		        type:'POST',
		        url:"<?=base_url().'enquiry/apply_to_course'?>",
		        data:{
	        		'id':id,
	        		'enquiry_code':enquiry_code
		    	},
		        success:function(data){
		            if (data) {
		            	Swal.fire(
						  'Good job!',
						  'Successfully Applied!',
						  'success'
						)
		            }else{
		            	Swal.fire({
						  icon: 'error',
						  title: 'Oops...',
						  text: 'Something went wrong!'					
						})
		            }
		        }
	    	});	
		}
	}
	</script>