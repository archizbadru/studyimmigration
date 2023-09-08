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
     <label>Test Name</label>
     <select class="form-control"  name="language_test[]"  id="language_test[]"> 
            <option value = "">Select Type</option>
            <?php foreach($all_qualification_test as $test){ ?>
            <option value = "<?php echo $test->id; ?>"><?php echo $test->test_language_name; ?></option>
            <?php } ?>
    </select>
    </div>
    <div class="form-group col-md-6">
        <label>Speaking</label>
        <input type="text" class="form-control" name="speaking[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Reading</label>
        <input type="text" class="form-control" name="reading[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Writing</label>
        <input type="text" class="form-control" name="writing[]" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Listening</label>
        <input type="text" class="form-control" name="listening[]" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Date Of Examination</label>
        <input type="date" class="form-control" name="doe[]" placeholder="">
    </div>
    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="q_remark[]"></textarea>
    </div>
<a href="#" class="delete col-sm-1 btn btn-danger">-</a></div>