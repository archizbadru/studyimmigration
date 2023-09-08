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
        <label>Document Type</label>
        <select class="form-control"  name="doc_type[]"  id="all_type<?php echo $daynamic_id; ?>" onchange="find_stream_name(this.value,<?php echo $daynamic_id; ?>)"> 
            <option value = "">Select Stream</option>
            <?php foreach($post_doc_list as $doc_type){ ?>
            <option value = "<?php echo $doc_type->id; ?>"><?php echo $doc_type->document_type; ?></option>
			<?php } ?>
        </select>
    </div>
	<div class="form-group col-md-6">
        <label>Document Stream Name</label>
        <select class="form-control"  name="stream_name[]"  id="all_stream<?php echo $daynamic_id; ?>" onchange="find_file_name(this.value,<?php echo $daynamic_id; ?>)"> 

        </select>
    </div>
	<div class="form-group col-md-6">
        <label>Document File Name</label>
        <select class="form-control"  name="file_name[]"  id="all_files<?php echo $daynamic_id; ?>"> 
        
        </select>
    </div>
	<div class="form-group col-md-6">
        <label>Browse File</label>
        <input type="file" class="form-control" name="browse_file[]" placeholder="">
    </div>
    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="d_remark[]"></textarea>
    </div>
<a href="#" class="delete col-sm-1 btn btn-danger">-</a></div>