<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="row justify-content-center">	
<div class="col-md-3">	
</div>
<div class="col-md-6">	
	<div class="card">
	    <div class="card-body">    
	      <!-- Modal content-->
	      <div class="modal-content" style="border:none;border-radius: 5px;">
	        <div class="card-header" style="background: #d75a4a;border-top-left-radius: 5px;border-top-right-radius: 5px;">          
	          <h4 class="modal-title text-center">
	          	<img src="https://lh3.googleusercontent.com/-ApBj8d4WL1E/Wp0fJeAD6jI/AAAAAAAAD4M/Dh6l_UiA64kln8PS-1SaDQFuhb9KJL40gCL0BGAYYCw/h100/2018-03-05.png" alt="">
	          </h4>
	        </div>
	        <div class="modal-body">
	          <p style="text-align:center;color:#d75a4a;font-size:24px;font-weight:500;">Sorry! your payment failed!</p>
	          <p style="color:#555555;">Transaction ID:&nbsp;
	          	<strong style="font-weight:500;font-size:16px;color: #222222;"><?=$res['txnid']?></strong><br>Payment amount:&nbsp;
	          	<strong style="font-weight:500;font-size:16px;color: #222222;">Rs.<?=$res['amount']?></strong>
	          	<br>If your payment got detucted for above transaction, the same shall be credited back to your account in
	          	<strong style="font-weight:500;font-size:15px;color: #222222;"> 5 working days</strong>
	          </p>
	        </div>
	        <div class="modal-footer">
	          <a class="btn btn-primary" href="<?=base_url()?>">Try Again</a>
	          <a class="btn btn-success" href="http://student.spaceinternationals.com/">Go Home</a>
	        </div>
	      </div>      
	    </div>
	</div>
</div>
</div>