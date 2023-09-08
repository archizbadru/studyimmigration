<?php
$comp = $tab_row['comp_id'];
$comp_ids = array();
if(!empty($comp)) {
	$comp_ids = explode(',', $comp);
}
?>
<input type="hidden" name="tab_id" value="<?=$tab_row['id']?>">
<div class="row">
    <div class="form-group col-md-12">
        <label>Tab Name</label>
        <input class="form-control" name="tab_name" placeholder="Tab name" type="text" value="<?=$tab_row['title']?>" required>
    </div>
    <div class="form-group col-md-12">
        <input type="checkbox" name="isqueryform" class="form-control" value="1" <?php if($tab_row['is_query_type'] == 1) { echo "checked";}?> >Is Query Type Form

    </div>

    <div class="form-group col-md-12 rights" style="display:<?php if($tab_row['is_query_type'] == 1){echo "block"; }else { echo "none"; }?> ">
        <label>Rights</label>
        <input type="checkbox" name="edit" value="1" <?php if($tab_row['is_edit'] == 1) { echo "checked";}?> >Edit
        <input type="checkbox" name="delete" value="1" <?php if($tab_row['is_delete'] == 1) { echo "checked";}?> >Delete

    </div>
    <div class="form-group col-md-12">
        <label>Company</label>                                            
        <select class="form-control " name="comp_ids[]" multiple id="edit_tab_comp">                                                
            <?php foreach($company_list as $key=>$company){?>
                <option value="<?=$company->user_id ?>" <?php if (in_array($company->user_id, $comp_ids)) { echo "selected"; } ?> >
                    <?php echo empty($company->a_companyname)?$company->firstname.' '.$company->lastname:$company->a_companyname ?>
                </option>
                <?php } ?>
        </select>
    </div>
    <div class="sgnbtnmn form-group col-md-12">
        <div class="sgnbtn">
            <input type="submit" value="Update" class="btn btn-success" name="addTab">
        </div>
    </div>
</div>


<script type="text/javascript">
    $('input[type="checkbox"][name="isqueryform"]').change(function() {
     if(this.checked) {
         // do something when checked
         $(".rights").css("display","block");
     }
     else
     {
        $(".rights").css("display","none");  
     }
 });
</script>