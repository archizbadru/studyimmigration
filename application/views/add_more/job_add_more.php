 <style>
 .line_break {
    width:100%;
    height: 5px;
    float: left;
    color: black;
    padding-top: 3px;
    background-color: rgba(255,255,255,.5);
}
</style>
<div><hr class="line_break">

    <div class="form-group col-md-12"> <label>Still Working</label>
        &nbsp;&nbsp;<input type="checkbox" class="" id="stillchk<?php echo $daynamic_id; ?>" name="still_work[]" placeholder="" value="1" onclick="hidto(<?php echo $daynamic_id; ?>);">
    </div>

    <div class="form-group col-md-6">
        <label>From</label>
        <input type="date" class="form-control" name="from[]" id="from<?php echo $daynamic_id; ?>" placeholder="">
    </div>
    <div class="form-group col-md-6" id="box<?php echo $daynamic_id; ?>">
        <label>To</label>
        <input type="date" class="form-control" name="to[]" id="to<?php echo $daynamic_id; ?>" onchange="drtn(<?php echo $daynamic_id; ?>);" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Designation</label>
        <input type="text" class="form-control" name="designation[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Company Name</label>
        <input type="text" class="form-control" name="company[]" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Duration In Days</label>
        <input type="text" class="form-control" name="duration[]" id="duration<?php echo $daynamic_id; ?>" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Relevant Experience</label>
      <div class="form-group col-md-6"> Yes 
        &nbsp;&nbsp;<input type="checkbox" class="" name="relevant[]" placeholder="" value="1">
      </div>
      <div class="form-group col-md-6"> No 
        &nbsp;&nbsp;<input type="checkbox" class="" name="relevant[]" placeholder="" value="0">
      </div>
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="j_remark[]"></textarea>
    </div>
<a href="#" class="delete col-sm-1 btn btn-danger">-</a></div>