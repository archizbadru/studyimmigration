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
	        <div class="card-header" style="background: green;border-top-left-radius: 5px;border-top-right-radius: 5px;">          
	          <h4 class="modal-title text-center">
	          	<img src="<?=base_url().'assets/images/icons/ok_circle.png'?>" alt="">
	          </h4>
	        </div>
	        <div class="modal-body">
	          <p style="text-align:center;color:#d75a4a;font-size:24px;font-weight:500;">PAYMENT COMPLETE Thank you for your transfer!</p>
	          <p style="color:#555555;">Transaction ID:&nbsp;
	          	<strong style="font-weight:500;font-size:16px;color: #222222;"><?=$res['txnid']?></strong><br>Payment amount:&nbsp;
	          	<strong style="font-weight:500;font-size:16px;color: #222222;">Rs.<?=$res['amount']?></strong>
	          	<br>	          	
	          </p>
	        </div>
	        <div class="modal-footer">	          
	          <strong style="font-weight:500;font-size:15px;color: #222222;float: left;">Note: Refundable at the time of Submission of Visa Application </strong><a class="btn btn-success" href="<?=base_url()?>">Go Home</a>
	        </div>
	      </div>      
	    </div>
	</div>
</div>
</div>