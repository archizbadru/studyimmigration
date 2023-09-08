</form>
<form role="form" method="post" action="<?=base_url().'form/form/enquiry_save_custom_field/'.$comp_id?>">
<input type="hidden" name="fld_id" value="<?=$field_row['input_id']?>">


   <div class="form-row">                
      <div class="form-group col-md-6">
          <label for="label_name"> Label Name <i class="text-danger">*</i></label>
            <input type="text" id="label_name"  class="form-control" placeholder="Label Name" value="<?=$field_row['input_label']?>" name="label_name" required>
      </div>
      <div class="form-group col-md-6">
        <label for="label_type"> Input Type<i class="text-danger">*</i></label>
        <select name='label_type' id="label_type" class="form-control" required>
          <option value='0'>--Select Type---</option>
          <?php
          if (!empty($input_types)) {
            foreach ($input_types as $key => $value) { ?>
                <option value="<?=$value['id']?>" <?php if ($value['id']==$field_row['input_type']) { echo "selected"; } ?>><?=ucfirst($value['title'])?></option>                        
            <?php
            }
          }
          ?>
        </select>
      </div>           
  
    <div class="form-group col-md-6">
      <label for="label_value">Enter possible values</label>
      <input type="text" id="label_value" class="form-control" name="label_value" placeholder="ex-option1,option2,option3,option4" value="<?=$field_row['input_values']?>">
    </div>              
  
    <div class="form-group col-md-6">
      <label for="input_placeholder">Enter Placeholder</label>
      <input type="text" id="input_placeholder" class="form-control" name="label_place" placeholder="" value="<?=$field_row['input_place']?>">
    </div>
    <div class="form-group col-md-6">
      <label for="input_name">Input Name<i class="text-danger">*</i></label>
      <input type="text" id="input_name" class="form-control" name="input_name" placeholder="" required value="<?=$field_row['input_name']?>" readonly>
    </div>                   
      <div class="form-group col-md-12">
        <input type="checkbox" id="required_type" name="required_type" value="1" class="" <?php if (1==$field_row['label_required']) { echo "checked"; } ?>>
        <label for="required_type"> Required</label>
        <input type="checkbox" name="readonly" value="1" class="" id='readonly' <?php if (1==$field_row['readonly']) { echo "checked"; } ?>>
        <label for="readonly"> Readonly</label>
        <input type="checkbox" name="disabled" value="1" class="" id="disabled" <?php if (1==$field_row['disabled']) { echo "checked"; } ?>>
        <label for="disabled"> Disabled</label>
      </div>
  </div>
  <div class="row">
    <div class="col-md-2 col-md-offset-5">
      <button type="submit" class="btn btn-success" >Update Field</button>                                    
    </div>
  </div>
</form>                                         
      