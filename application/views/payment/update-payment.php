    <style>
        .prod-details{
            display:none;
        }
    </style>
		
<div class="panel panel-default thumbnail">
     <div class="panel-heading no-print">               
        <div class="btn-group">                   
            <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>
        </div>
    </div>
	<div class="panel-body">            
		<div class="row">
			<div class = "col-md-12">
			<?php echo form_open('payment/update'); ?>
				<div class = "row">
				<?php if(!empty($payments)){ ?>
					
				<?php }else{
				} 

				/*echo "<pre>";
				print_r($paydata);
				echo "</pre>";*/
				?>	
				<input type="hidden" name = "paymentid" value="<?php echo $paydata->id; ?>">
				<input type="hidden" name = "orderid" value="<?php echo $paydata->ord_id; ?>">
					<div class = "form-group col-md-4">
						<label>Previous Balance</label>
						<input type = "text" class = "form-control" name = "prevbalance" value = "<?php echo $paydata->prev_balance; ?>" readonly>
					</div>
					<div class = "form-group col-md-4">
						<label>Payment</label><span class ="mand">*</span>
						<input type = "hidden" name="paymentidss" id = "total-remain" value = "<?php echo $paydata->prev_balance; ?>">
						<input type = "number" class = "form-control" id ="total-paybox"  name = "payment" value = "<?php echo $paydata->pay; ?>">
					</div>
					
					<div class = "form-group col-md-4">
						<label>Balance</label><span class ="mand">*</span>
						<input type = "number" class = "form-control" id = "remain-balance" value = "<?php echo $paydata->balance; ?>" name = "balance" readonly>
					</div>
					<div class = "form-group col-md-4">
						<label>Payment Mode</label><span class ="mand">*</span>
						<select class = "form-control" name = "paymode">
							<option></option>
							<option value = "1"  <?php if($paydata->pay_mode == 1){ echo "selected"; } ?> >Cash</option>
							<option value = "2" <?php if($paydata->pay_mode == 2){ echo "selected"; } ?> >Online</option>	
						</select>
					</div>
					<div class = "form-group col-md-4">
						<label>Transaction No</label>
						<input type = "text" class = "form-control" name = "transactiono" value = "<?php echo $paydata->transaction_no; ?>">
					</div>
					<div class = "form-group col-md-4">
						<label>Pay Date</label><span class ="mand">*</span>
						<input type = "date" class = "form-control" name = "paydate"  value = "<?php echo $paydata->pay_date; ?>">
					</div>
					<div class = "form-group col-md-4">
						<label>Next Date</label>
						<input type = "date" class = "form-control" name = "nextpay"  value = "<?php echo $paydata->next_pay; ?>" >
					</div>
					<?php if($this->session->mrole == 1) { ?>
					<div class = "form-group col-md-4">
						<label>Status</label>
						<select class = "form-control" name="status">
							<option value = ""></option>
							<?php   if(!empty($masters)) { 
								foreach($masters as $key => $mstr) { 
								if($mstr->type == 2) {
								?>
								<option value = "<?php echo $mstr->id; ?>"><?php echo $mstr->title; ?></option>
							<?php }
								}
							}
							?>
						</select>
					</div>
					<?php }else{
						?><input type = "hidden" name = "status" value = "2"><?php
					} ?>
					<div class = "form-group col-md-12">
						<label>Remark</label>
						<textarea class = "form-control" name = "remarks"><?php echo $paydata->remark; ?></textarea>
					</div>
					<div class = "form-group col-md-4">
						<button class="btn btn-primary" type="submit">Save</button>
					</div>					
				<?php echo form_close(); ?>	
				</div>
			</div>
		</div>
	</div>		
</div>
<script>
	$(document).on("keyup", "#total-paybox", function(){				
		var tot     = $("#total-remain").val();		
		var val     = $(this).val();
		var remain  = tot - val;		
		if(val > tot){			
			var tval = $("#total-paybox").val();
			$("#total-paybox").val(val.substr(0, val.length - 1));
			$("#remain-balance").val("");
		}else{
			$("#remain-balance").val(remain);	
		}		
	});			
</script>