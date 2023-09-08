<style>
 .line_break {
    width:1000px;
    height: 5px;
    float: left;
    color: black;
    padding-top: 3px;
    background-color: rgba(255,255,255,.5);
}
</style>
<div><hr class="line_break"><div class="form-group col-md-6">
        <label>Installments</label>
        <select class="form-control"  name="ini_set[]"  id="ini_set"> 
            <option>Select Installment</option>
            <?php foreach($all_installment as $installment){ ?>
            <option value = "<?php echo $installment->id; ?>"><?php echo $installment->install_name; ?></option>
			<?php } ?>
        </select>
    </div>
 	<div class="form-group col-md-6">
        <label>Set reminder</label>
        <select class="form-control"  name="remainder_set[]"  id="remainder_set" onchange="showreminders(this.value,<?php echo $daynamic_id; ?>)"> 
            <option>Select Type</option>
            <option value = "1">By date</option>
            <option value = "2">By Stage</option>
        </select>
    </div>
<div class="bydate<?php echo $daynamic_id; ?>" style="display:none;">    
    <div>
	<div class="form-group col-md-6">
        <label>From Date</label>
        <input type="date" class="form-control" name="from_date[]" placeholder="">
    </div>
	<div class="form-group col-md-6">
        <label>To Date</label>
        <input type="date" class="form-control" name="to_date[]" placeholder="">
    </div>
	</div>
</div>	
<div class="bystage<?php echo $daynamic_id; ?>" style="display:none;">    
    <div>
	<div class="col-md-6">
		<label>Reminder Stage<i class="text-danger"></i></label>
        <select class="form-control"  name="reminder_satge[]"  id="reminder_satge"> 
            <option>Select Stage</option>
			<?php foreach($all_estage_lists as $stage){ ?>
            <option value = "<?php echo $stage->stg_id; ?>"><?php echo $stage->lead_stage_name; ?></option>
			<?php } ?>
        </select>
    </div>
	</div>
</div>
    <div class="form-group col-md-6">
        <label>Pay Amount</label>
        <input type="text" class="form-control" name="pay_amt[]" placeholder="Paid Amount">
    </div>
	<div class="form-group col-md-6">
        <label>Pay Date</label>
        <input type="date" class="form-control" name="pay_date[]" placeholder="Paid date">
    </div>

    <div class="form-group col-md-6">
        <label>Attach Invoice</label>
        <input type="file" class="form-control" name="ins_invoice[]" placeholder="Invoice">
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="pi_remark[]"></textarea>
    </div>
<a href="#" class="delete col-sm-1 btn btn-danger">-</a></div>