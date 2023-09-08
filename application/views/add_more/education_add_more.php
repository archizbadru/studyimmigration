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
<div><hr class="line_break"><div class="form-group col-md-6">
     <label>Education Name</label>
     <select class="form-control"  name="e_qualification[]"  id="e_qualification[]"> 
            <option value = "">Select Type</option>
            <?php foreach($all_education_master as $test){ ?>
            <option value = "<?php echo $test->id; ?>"><?php echo $test->edu_name; ?></option>
            <?php } ?>
    </select>
    </div>
    <div class="form-group col-md-6">
        <label>From</label>
        <input type="date" class="form-control" name="e_from[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>To</label>
        <input type="date" class="form-control" name="e_to[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Course Name</label>
        <input type="text" class="form-control" name="e_crsname[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>University Name</label>
        <input type="text" class="form-control" name="e_uniname[]" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Institute Name</label>
        <input type="text" class="form-control" name="e_institutename[]" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Year Awarded</label>
        <input type="text" class="form-control" name="e_yearawarded[]" placeholder="">
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="e_remark[]"></textarea>
    </div>
<a href="#" class="delete col-sm-1 btn btn-danger">-</a></div>