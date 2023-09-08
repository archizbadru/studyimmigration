<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<?php
  define('FIRST_NAME',1);
  define('LAST_NAME',2);
  define('GENDER',3);
  define('MOBILE',4);
  define('EMAIL',5);
  define('COMPANY',6);
  define('LEAD_SOURCE',7);
  define('PRODUCT_FIELD',8);
  define('STATE_FIELD',9);
  define('CITY_FIELD',10);
  define('ADDRESS_FIELD',11);  

  $basic_fields = array(
                      array(
                        'field_id'=>1,
                        'input_label'=>'First Name',
                        'input_type'=>1,                        
                        'product_name'=>'',                        
                      ),
                      array(
                        'field_id'=>2,
                        'input_label'=>'Last Name',
                        'input_type'=>1,                        
                        'product_name'=>'',                        
                      ),
                      array(
                        'field_id'=>3,
                        'input_label'=>'Gender',
                        'input_type'=>3,                        
                        'product_name'=>'',                        
                      ),
                      array(
                        'field_id'=>4,
                        'input_label'=>'Mobile',
                        'input_type'=>1,                        
                        'product_name'=>'',                        
                      ),
                      array(
                        'field_id'=>5,
                        'input_label'=>'Email',
                        'input_type'=>1,                        
                        'product_name'=>'',                        
                      ),
                      array(
                        'field_id'=>6,
                        'input_label'=>'Company',
                        'input_type'=>1,                        
                        'product_name'=>'',                        
                      ),
                      array(
                        'field_id'=>7,
                        'input_label'=>'Lead Source',
                        'input_type'=>2,                        
                        'product_name'=>'',                        
                      ),
                      array(
                        'field_id'=>8,
                        'input_label'=>'Product',
                        'input_type'=>2,                        
                        'product_name'=>'',                        
                      ),
                      array(
                        'field_id'=>9,
                        'input_label'=>'State',
                        'input_type'=>2,                        
                        'product_name'=>'',                        
                      ),
                      array(
                        'field_id'=>10,
                        'input_label'=>'City',
                        'input_type'=>2,                        
                        'product_name'=>'',                        
                      ),
                      array(
                        'field_id'=>11,
                        'input_label'=>'Address',
                        'input_type'=>5,                        
                        'product_name'=>'',                        
                      )  ,
                      array(
                        'field_id'=>12,
                        'input_label'=>'Date',
                        'input_type'=>6,                        
                        'product_name'=>'',                        
                      ) ,
                      array(
                        'field_id'=>13,
                        'input_label'=>'Time',
                        'input_type'=>7,                        
                        'product_name'=>'',                        
                      )                                             
                  );  

?>
<!-- <div class="col-sm-1"></div> -->
<div class="col-sm-12">
 <div  class="panel panel-default">    
    <div class="panel-body panel-form">
      <div class="row">
        <div class="col-md-12 col-sm-12">        
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Field Name</th>
                <th>Type</th>
                <th>Process</th>
                <th>Status</th>
                <th>Choose Process</th>
                <th>Action</th>
              </tr>              
            </thead>
            <tbody>             
              <?php
              $i=1;
              if (!empty($basic_fields)) {
                // print_r($basic_fields);exit();
                foreach ($basic_fields as $key => $value) {
                   
                  ?>
                  <tr>
                    <td><?=$i?></td>
                    <td><?=$value['input_label']?></td>
                    <td>
                    <?php if($value['input_type']==1){
                      echo "Text";                      
                    }
                    else if($value['input_type']==2){
                      echo "Dropdown";
                    }
                    else if($value['input_type']==3){
                      echo "Radio";
                    }                  
                    else if($value['input_type']==4){
                      echo "CheckBox";
                    }
                    else if($value['input_type']==5){ 
                      echo "Textarea";
                    }
                    else if($value['input_type']==6){ 
                      echo "Date";
                    }
                    else if($value['input_type']==7){ 
                      echo "Time";
                    }
                    else{
                      echo "NA";
                    }
                    ?>
                    (Basic Field)
                    </td>
                    <td>

                      <?php 
                      
                      $this->db->select('process_id');
                      $this->db->where('field_id',$value['field_id']);
                      $this->db->where('comp_id',$comp_id);
                      $row_status  = $this->db->get('enquiry_fileds_basic')->row_array();
                         
                         $result = explode(",",$row_status['process_id']);

                      foreach( $result as $value1){
                        if(!empty($value1)){
                         echo get_process_name($value1).' ';
                        }

                      }  
                      //  if(!empty($row_status)){
                      // echo get_process_name(explode(",",$row_status['process_id']));
                      
                  
                
                      ?>
                      


                    </td>
                    <td>
                       <?php 
                      
                      $this->db->select('status');
                      $this->db->where('field_id',$value['field_id']);
                      $this->db->where('comp_id',$comp_id);
                      $row_status  = $this->db->get('enquiry_fileds_basic')->row_array();
                         
                       if(!empty($row_status)){
                        // echo $value['status'];
                    if($row_status['status']==1){
                        echo "Active";                       
                    }else { echo "Inactive";

                    }   
                  
                }
                      ?>
                    </td>
                    <td style="width: 2000px;">
                      
                        <select name="product_id[]" class="form-control chosen-select" multiple id="product_id">
                           <option value="" style="display:none;">Select</option>
                           <?php foreach($products as $product){?>
                           <option value="<?=$product->sb_id ?>"><?=$product->product_name ?></option>
                           <?php } ?>
                        </select>
                    </td>
                    <td>               
                      <?php
                      $this->db->select('status');
                      $this->db->where('field_id',$value['field_id']);
                      $this->db->where('comp_id',$comp_id);
                      $row  = $this->db->get('enquiry_fileds_basic')->row_array();
                        $active = '';
                        $inactive = '';
                        if(!empty($row) && $row['status']==1){
                          $active = 'checked';
                        }else{
                          if(empty($row)){
                            $active = 'checked';
                          }else{
                            $inactive = 'checked';
                          }
                        }
                      ?>
                      <input type="hidden" name="statusupdate" value="<?= $value['field_id']?>" id="statusupdate">
                      <label>Active</label>
                      <input type="radio" value="1" name="bas_<?=$value['field_id']?>" <?=$active?> class='basic_fields enquiry_fileds'>
                      <label>Inactive</label>
                      <input type="radio"  name="bas_<?=$value['field_id']?>" value="0" <?=$inactive?> class='basic_fields enquiry_fileds'>
                    </td>                    
                    <?php
                    $i++;
                }
               }
              
              ?>



              <?php
              if (!empty($form_fields)) {
                foreach ($form_fields as $key => $value) {
                  ?>
                  <tr>
                    <td><?=$i?></td>
                    <td><?=$value['input_label']?></td>
                    <td>
                    <?php if($value['input_type']==1){
                      echo "Text";                      
                    }
                    else if($value['input_type']==2){
                      echo "Dropdown";
                    }
                    else if($value['input_type']==3){
                      echo "Radio";
                    }                  
                    else if($value['input_type']==4){
                      echo "CheckBox";
                    }
                    else if($value['input_type']==5){ 
                      echo "Textarea";
                    }
                    else if($value['input_type']==6){ 
                      echo "Date";
                    }
                    else if($value['input_type']==7){ 
                      echo "Time";
                    }
                    else{
                      echo "NA";
                    }
                    ?>
                    (Extra Field)
                    </td>
                    <td>
                    
                      <?php 
                      
                      $this->db->select('process_id');
                      $this->db->where('input_id',$value['input_id']);
                      $this->db->where('company_id',$comp_id);
                      $row_status  = $this->db->get('tbl_input')->row_array();
                        // echo $row_status;
                      $result = explode(",",$row_status['process_id']);

                      foreach( $result as $value1){
                        if(!empty($value1)){
                         echo get_process_name($value1).' ';
                        }

                      }  
                                            
                      ?>
                    </td>
                   
                    <td>
                      
                      <?php 
                    if($value['status']==1){
                        echo "Active";                       
                    }else { echo "Inactive";

                    }      

                      ?>
                    </td>
                     <td style="width: 200px;">
                       <select name="product_id[]" class="form-control chosen-select" multiple id="product_id">
                           <option value="" style="display:none;">Select</option>
                           <?php foreach($products as $product){?>
                           <option value="<?=$product->sb_id ?>"><?=$product->product_name ?></option>
                           <?php } ?>
                        </select>

                    </td>
                    <td>
                     
                      <input type="hidden" name="statusupdate" value="<?= $value['input_id']?>" id="statusupdate">
                   
                      <label>Active</label>
                      <input type="radio" value="1" name="<?=$value['input_id']?>" <?php if($value['status']==1){?> checked <?php }?> class='extra_fields enquiry_fileds'>
                      <label>Inactive</label>
                      <input type="radio" value="0" name="<?=$value['input_id']?>" <?php if($value['status']==0){?> checked <?php }?> class='extra_fields enquiry_fileds'>
                      
                    </td>                    
                    <?php
                $i++;
                }
              }
              ?>
            </tbody>
          </table>          
          <button class="btn btn-primary"  type="button"  data-toggle="modal" data-target="#myModal" >Add Extra Input Field</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Inputs</h4>
      </div>
      <div class="modal-body">         
         <form role="form" method="post" id="custom_field_form" action="<?=base_url().'form/form/enquiry_save_custom_field/'.$comp_id?>">
             <div class="form-row">                
                <div class="form-group col-md-12">
                    <label for="label_name"> Label Name</label>
                   	  <input type="text" id="label_name"  class="form-control br_25  m-0 icon_left_input" placeholder="Label Name" value="" name="label_name">                   
                </div>

                <div class="form-group col-md-12">
                  <label for="label_type"> Input Type</label>
                  <select name='label_type' id="label_type" class="form-control  br_25  m-0 icon_left_input">
                    <option value='0'>--Select Type---</option>
                    <option value='1' >Text</option>
                    <option value='2' >Dropdown </option>
                    <option value='3' >Radio</option>
                    <option value='4' >CheckBox</option>
                    <option value='5' >Text Area</option> 
                    <option value='6' >Date</option>
                    <option value='7' >Time</option>                   
                  </select>
                </div>

            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="label_value">Enter possible values</label>
                <input type="text" id="label_value" class="form-control br_25  m-0 icon_left_input" name="label_value" placeholder="">
              </div>
              <div class="form-group col-md-12">
                <label for="name">Enter Function</label>
                <input type="text" id="name" class="form-control br_25  m-0 icon_left_input" name="label_function" value="" placeholder="Enter Function">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="input_placeholder">Enter Placeholder</label>
                <input type="text" id="input_placeholder" class="form-control br_25  m-0 icon_left_input" name="label_place" placeholder="">
              </div>
              <div class="form-group col-md-12">
                <label for="input_name">Input Name</label>
                <input type="text" id="input_name" class="form-control br_25  m-0 icon_left_input" name="input_name" placeholder="">
              </div>             

                <div class="form-group col-md-12">
                  <label for="required_type"> Required</label>
                  <select name='required_type' id="required_type" class="form-control  br_25  m-0 icon_left_input">
                    <option value='1' >Yes</option>
                    <option value='0' >No </option>
                  </select>
                </div>

                <div class="form-group col-md-12">
                  <label for="process_list"> Process</label>
                  <select name='process_list[]' id="process_list" class="form-control  br_25  m-0 icon_left_input chosen-select" multiple="">
                    <?php
                    if (!empty($process_list)) {
                      foreach ($process_list as $key => $value) { ?>
                        <option value="<?=$value['sb_id']?>" ><?=$value['product_name']?></option>                        
                      <?php
                      }
                    }
                    ?>                    
                  </select>
                </div>              
              <button type="submit" class="btn btn-purple waves-effect waves-light" >Save</button>

            </div>
        </form>                                         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $("#check_process_right").on('click',function(){
    var comp_id = "<?=$comp_id?>";
    url = "<?=base_url().'form/is_process_right/'?>"+comp_id; 
    $.ajax({
      type: "POST",
      url: url,
      data: {
        'id':id
      },
      success: function(data){                
        data = JSON.parse(data);
        alert(data.msg);
        if(data.status){
          location.reload();
        }
      }
    });
    //alert(comp_id);
  })

  $("#label_type").on('change',function(){
    if($(this).val() == 2){
      //alert('yes');
    }
  });
</script>


<script type="text/javascript">
  $('.enquiry_fileds').on('click',function(){

      

    field_class = $(this).attr('class');    
    //alert(field_class);
    
    if(field_class == 'basic_fields'){
      var id = $(this).closest("tr").find("#statusupdate").val();
      active = $(this).val();  
      proc = $(this).closest("tr").find("#product_id").val();
 
      if(proc==null){
         Swal.fire("Warning!", "Please select process", "warning"); 
         // alert('dadd');
      }
      else{

      url = "<?=base_url().'form/form/change_basic_enquiry_field_status'?>";       
      data = {
        id:id,
        active:active,     
        comp_id:"<?=$comp_id?>",
        proc:proc
      }
    }
    }else{
      var id = $(this).closest("tr").find("#statusupdate").val();
      active = $(this).val(); 
      proc = $(this).closest("tr").find("#product_id").val();
      // alert(proc); 
       if(proc==null){
         Swal.fire("Warning!", "Please select process", "warning"); 
         // alert('dadd');
      }
      else{
      url = "<?=base_url().'customer/update_formfields'?>"; 
      data = {
        id:id,
        active:active,  
        proc:proc   
      }
     }
    }
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){                
      // alert(data);
        if(data==1){
          location.reload();
        }
      }
    });
    //alert(comp_id);
  })
</script>