<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<?php
if ($tab_details['primary_tab']) {
  }else{
    $basic_fields = array();
  } 
?>
          
        </div>
        <div class="text-center">
          <div class="row">
            <br>
            Tab Active In                
            <select class="form-control tab-process-chosen-select" name="tab_process[]" multiple>
              <?php 
                if (!empty($products)) {                  
                  if (!empty($form_process_row['process_id'])) {
                    $form_process_row = explode(',', $form_process_row['process_id']);
                  }else{
                    $form_process_row = array();
                  }
                  foreach ($products as $key => $value) { ?>
                    <option value="<?=$value->sb_id?>" <?php if (in_array($value->sb_id, $form_process_row)) { echo "selected";} ?> ><?=$value->product_name?></option>                        
                  <?php
                  }
                }
              ?>
            </select>        
          </div>
          <br>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Field Name</th>
                <th>Type</th>                
                <th>Status</th>
                <th width="35%">Choose Process</th>
                <th>Action</th>
              </tr>              
            </thead>
            <tbody>             
              <?php
              $i=1;
              if (!empty($basic_fields)) {                
                foreach ($basic_fields as $key => $value) {
                  $process_ids = array();
                  if(!empty($value['process_id'])){
                    $process_ids = explode(',', $value['process_id']);
                  }
                  ?>
                  <tr>
                    <td><?=$i?></td>
                    <td><?=$value['title']?></td>
                    <td>
                    <?php echo $value['type_title']; ?>
                    (Basic Field)
                    </td>
                    <td>
                      <?php 
                      if($value['status']==1){ ?>                          
                          <input type="checkbox" name="basic_fields_status[<?=$value['id']?>]" checked data-toggle="toggle" data-field="<?=$value['id']?>" class='basic_fields_status'   data-onstyle="success" data-offstyle="danger" data-size="small">
                          <?php
                      }else {  ?>
                          <input type="checkbox" name="basic_fields_status[<?=$value['id']?>]" data-toggle="toggle" data-field="<?=$value['id']?>" class='basic_fields_status'   data-onstyle="success" data-offstyle="danger" data-size="small">
                      <?php
                      }                            
                      ?>
                    </td>
                    <td>                      
                        <select name="product_id[<?=$value['id']?>][]" class="form-control chosen-select" multiple>                           
                           <?php foreach($products as $product){?>
                           <option value="<?=$product->sb_id ?>" <?php if (in_array($product->sb_id, $process_ids)) { echo "selected"; } ?> ><?=$product->product_name ?></option>
                           <?php } ?>
                        </select>
                    </td>
                    <td>                                     
                      <a href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>                      
                      <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="save_form_row(<?=$value['id']?>)"><i class="fa fa-save"></i></a>
                    </td>                    
                    <?php
                    $i++;
                }
               }
              ?>
              <?php
              $query_builder_filter = array();
              if (!empty($form_fields)) {
                foreach ($form_fields as $key => $value) {
                  $process_ids = array();
                  if(!empty($value['process_id'])){
                    $process_ids = explode(',', $value['process_id']);
                  }                  
                  ?>
                  <tr>
                    <td><?=$i?></td>
                    <td><?=$value['input_label']?></td>
                    <td>
                    <?php                    
                      echo ucfirst($value['input_type_title']);
                    ?>
                    (Extra Field)
                    </td>                                      
                    <td>
                      <?php 
                      if($value['status']==1){ ?>
                          <input type="checkbox" checked name="extra_fields_status[<?=$value['input_id']?>]" data-toggle="toggle" data-field="<?=$value['input_id']?>" class='extra_fields_status' data-onstyle="success" data-offstyle="danger" data-size="small">
                          <?php
                      }else {  ?>
                        <input type="checkbox" name="extra_fields_status[<?=$value['input_id']?>]" data-toggle="toggle" data-field="<?=$value['input_id']?>" class='extra_fields_status' data-onstyle="success" data-offstyle="danger" data-size="small">
                      <?php
                      }      
                      ?>
                    </td>
                     <td>
                       <select name="product_id[<?=$value['input_id']?>][]" class="form-control chosen-select" multiple>                           
                           <?php foreach($products as $product){?>
                           <option value="<?=$product->sb_id?>" <?php if (in_array($product->sb_id, $process_ids)) { echo "selected"; } ?> ><?=$product->product_name ?></option>
                           <?php } ?>
                        </select>
                    </td>
                    <td>                     
                      <a href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>                      
                      <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="save_form_row(<?=$value['input_id']?>,false)" ><i class="fa fa-save"></i></a>                      
                    </td>                    
                    <?php
                $i++;

                  $options = explode(',', $value['input_values']);
                  $input = $value['input_type_title']=='Dropdown'?'select':$value['input_type_title'];
                  
                  if ($input=='text'||$input=='number'||$input=='textarea'||$input=='radio'||$input=='checkbox'||$input=='select') {
                      
                  }else{
                    $input = 'text';
                  }

                  $query_builder_filter[] = array(
                                                  'id'=>$value['input_name'],
                                                  'label'=> $value['input_label'],
                                                  'type'=> 'string',
                                                  'input'=> strtolower($input),
                                                  'values'=> $options,
                                                   'operators'=> ['equal','not_equal','in','not_in','less','less_or_equal','greater','greater_or_equal','between','not_between','begins_with','not_begins_with','contains','not_contains','ends_with','not_ends_with','is_empty','is_not_empty','is_null','is_not_null']
                                                );

                }
              }
              ?>
            </tbody>
          </table>          
          <button class="btn btn-primary"  type="button"  data-toggle="modal" data-target="#myModal" >Add Extra Input Field</button>
        </div>
      

<?php
/*echo "<pre>";
print_r($query_builder_filter);*/
$query_builder_filter = !empty($query_builder_filter)?json_encode($query_builder_filter):0;
/*echo $query_builder_filter;
echo "</pre>";*/
?>

<!-- form rules start-->
<div id="form_ruleModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Rules</h4>
      </div>
      <div class="modal-body">         
         <form role="form" method="post" id="set_rules_form">
          <input type="hidden" name="form_id" value="<?=$tid?>">
            <div id="builder"></div>
            <div id="actions">
              <div class="">                
              <div class="panel panel-default" style="padding: 20px 0px;">
                <a href="javascript:void(0)" class="btn btn-success btn-xs pull-right add_action_row"><i class="glyphicon glyphicon-plus"></i> Add Action</a>
                <table class="table" >                  
                    <tbody id="actions_tbody">                      
                      <tr class="action_row"> 
                        <td>
                            <select name="actions[]" class="form-control" required>
                              <option value="">-- Select Actions -- </option>
                              <option value="toshow">Show</option>
                              <option value="tohide">Hide</option>
                              <option value="toenable">Enable</option>
                              <option value="todisable">Disable</option>                
                            </select>                  
                        </td>                     
                        <td>                     
                            <select name="actions_field[]" class="form-control" required>
                              <option value="">-- Select Field -- </option>
                              <?php
                              if (!empty($form_fields)) {
                                foreach ($form_fields as $key => $value) { ?>
                                  <option value="<?=$value['input_id']?>"><?=$value['input_label']?></option>
                                <?php
                                }
                              }
                              ?>
                            </select>                  
                          </td>
                        <td><a href="javascript:void(0)" class="btn btn-danger btn-xs pull-right remove_action_row"><i class="glyphicon glyphicon-remove"></i> Delete</a></td>
                      </tr>
                    </tbody>
                </table>
              </div>
              </div>
            </div>
            <br>
            <br>            
            <button class="btn btn-primary" id="btn-get">Save Rules</button>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- form rules end -->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Field</h4>
      </div>
      <div class="modal-body">         
         <form role="form" method="post" id="custom_field_form" action="<?=base_url().'form/form/enquiry_save_custom_field/'.$comp_id?>">
          <input type="hidden" name="form_id" value="<?=$tid?>">
             <div class="form-row">                
                <div class="form-group col-md-4">
                    <label for="label_name">Field Label<i class="text-danger">*</i></label>
                   	  <input type="text" id="label_name"  class="form-control" placeholder="Label Name" value="" name="label_name" required>
                </div>
				
				<div class="form-group col-md-4">
                    <label for="label_name">Report Label<i class="text-danger"></i></label>
                   	  <input type="text" id="label_rep"  class="form-control" placeholder="Label Name" value="" name="label_rep">
                </div>
				
                <div class="form-group col-md-4">
                  <label for="label_type"> Input Type<i class="text-danger">*</i></label>
                  <select name='label_type' id="label_type" class="form-control" required>
                    <option value='0'>--Select Type---</option>
                    <?php
                    if (!empty($input_types)) {
                      foreach ($input_types as $key => $value) { ?>
                          <option value="<?=$value['id']?>" ><?=ucfirst($value['title'])?></option>                        
                      <?php
                      }
                    }
                    ?>
                  </select>
                </div>           
            
              <div class="form-group col-md-6">
                <label for="label_value">Enter possible values</label>
                <input type="text" id="label_value" class="form-control" name="label_value" placeholder="ex-option1,option2,option3,option4">
                <!-- <small class="text-muted">Enter Option values comma seperated</small> -->
                <!-- <a href="javascript:void(0)" class="btn btn-warning btn-xs">+ Add condition</a> -->
              </div>              
            
              <div class="form-group col-md-6">
                <label for="input_placeholder">Enter Placeholder</label>
                <input type="text" id="input_placeholder" class="form-control" name="label_place" placeholder="">
              </div>
              <div class="form-group col-md-6">
                <label for="input_name">Input Name<i class="text-danger">*</i></label>
                <input type="text" id="input_name" class="form-control" name="input_name" placeholder="" required>
              </div>             
                <div class="form-group col-md-6">
                  <label for="process_list"> Process<i class="text-danger">*</i></label>
                  <select name='process_list[]' id="process_list" class="form-control  chosen-select" multiple required>
                    <?php
                    if (!empty($products)) {
                      foreach ($products as $product) { ?>
                        <option value="<?=$product->sb_id?>" ><?=$product->product_name?></option>                        
                      <?php
                      }
                    }
                    ?>                    
                  </select>
                </div>              

                <div class="form-group col-md-12" style="padding-top:10px;">
                  <input type="checkbox" id="required_type" name="required_type" value="1" class="">
                  <label for="required_type"> Required</label>
                  <input type="checkbox" name="readonly" value="1" class="" id='readonly'>
                  <label for="readonly"> Readonly</label>
                  <input type="checkbox" name="disabled" value="1" class="" id="disabled">
                  <label for="disabled"> Disabled</label>
                </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-md-offset-5">
                <button type="submit" class="btn btn-success" >Create Field</button>                                    
              </div>
            </div>
        </form>                                         
      </div>      
    </div>
  </div>
</div>
<script type="text/javascript">  
  /*$(function() {
    $(".chosen-select").chosen({
        width: "100%"
    });
  });*/
/*
  (function($) { 
    $(".chosen-select").chosen({
        width: "100%"
    });
  })(jQuery);*/



    $("#check_process_right").on('click', function() {
        var comp_id = "<?=$comp_id?>";
        url = "<?=base_url().'form/is_process_right/'?>" + comp_id;
        $.ajax({
            type: "POST",
            url: url,
            data: {
                'id': id
            },
            success: function(data) {
                data = JSON.parse(data);
                alert(data.msg);
                if (data.status) {
                    location.reload();
                }
            }
        });
        //alert(comp_id);
    })

    $("#label_type").on('change', function() {
        if ($(this).val() == 2) {
            //alert('yes');
        }
    });
    $("#set_rules_form").submit(function(e) {
        e.preventDefault();
        var url = "<?=base_url().'form/form/save_form_rules'?>";
        var actions = $("select[name='actions']").val();
        var actions_field = $("select[name='actions_field']").val();
        var rules = $('#builder').queryBuilder('getRules');
        var form_data = $("#set_rules_form").serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: {
                form_data: form_data,
                rules: rules
            },
            success: function(data) {}
        });
    });
    $('.enquiry_fileds').on('click', function() {
        field_class = $(this).attr('class');

        if (field_class == 'basic_fields') {
            var id = $(this).closest("tr").find("#statusupdate").val();
            active = $(this).val();
            proc = $(this).closest("tr").find("#product_id").val();

            if (proc == null) {
                Swal.fire("Warning!", "Please select process", "warning");
                // alert('dadd');
            } else {

                url = "<?=base_url().'form/form/change_basic_enquiry_field_status'?>";
                data = {
                    id: id,
                    active: active,
                    comp_id: "<?=$comp_id?>",
                    proc: proc
                }
            }
        } else {
            var id = $(this).closest("tr").find("#statusupdate").val();
            active = $(this).val();
            proc = $(this).closest("tr").find("#product_id").val();
            // alert(proc); 
            if (proc == null) {
                Swal.fire("Warning!", "Please select process", "warning");
                // alert('dadd');
            } else {
                url = "<?=base_url().'customer/update_formfields'?>";
                data = {
                    id: id,
                    active: active,
                    proc: proc
                }
            }
        }
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(data) {
                if (data == 1) {
                    location.reload();
                }
            }
        });
        //alert(comp_id);
    });
    $('.basic_fields_status').on('change', function() {
        id = $(this).data('field');
        if ($(this).is(':checked')) {
            status = 1;
        } else {
            status = 0;
        }
        var url = "<?=base_url()?>form/form/change_basic_enquiry_field_status"
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id: id,
                status: status,
                comp_id: "<?=$comp_id?>"
            },
            success: function(data) {
                if (data == 1) {
                    Swal.fire(
                        'Status Changed Successfully!',
                        '',
                        'success'
                    )
                }
            }
        });
    });


    $('.extra_fields_status').on('change', function() {
        id = $(this).data('field');
        if ($(this).is(':checked')) {
            status = 1;
        } else {
            status = 0;
        }
        var url = "<?=base_url()?>form/form/change_extra_enquiry_field_status"
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id: id,
                status: status,
                comp_id: "<?=$comp_id?>"
            },
            success: function(data) {
                if (data == 1) {
                    Swal.fire(
                        'Status Changed Successfully!',
                        '',
                        'success'
                    )
                }
            }
        });
    });


  function query_builder(){
    var rules_basic = {
        condition: 'AND',
        rules: [{
            id: 'price',
            operator: 'less',
            value: 10.25
        }, {
            condition: 'OR',
            rules: [{
                id: 'category',
                operator: 'equal',
                value: 2
            }, {
                id: 'category',
                operator: 'equal',
                value: 1
            }]
        }]
    };
    var qf = <?=$query_builder_filter?>;
    if (qf) {
        $('#builder').queryBuilder({
            plugins: ['bt-tooltip-errors'],
            filters: <?=$query_builder_filter?>,
            //  rules: rules_basic
        });
    }
  }
    /****************************************************************
                    Triggers and Changers QueryBuilder
     *****************************************************************/

    $('#btn-get').on('click', function() {
        var result = $('#builder').queryBuilder('getRules');
        if (!$.isEmptyObject(result)) {
            alert(JSON.stringify(result, null, 2));
        } else {
            console.log("invalid object :");
        }
        console.log(result);
    });
    

    //When rules changed :
    $("#actions").hide();
    $('#builder').on('getRuleOperatorSelect.queryBuilder.filter', function(e) {
        $("#actions").show();
    });

    $(".add_action_row").on('click', function() {
        var a = $("select[name='actions[]']").val();
        var f = $("select[name='actions_field[]']").val();
        if (a && f) {
            var row_content = $(".action_row").html();
            $("#actions_tbody").append("<tr>" + row_content + "</tr>");
        } else {
            alert('Fill current action');
        }
    });
    $(".remove_action_row").on('click', function() {
        $(this).closest("tr").remove();
    });



function save_form_row(id, basic = true) {
    var comp_id = "<?=$comp_id?>";
    var process_ids = $("select[name='product_id[" + id + "][]']").val();

    var url = "<?=base_url()?>form/form/save_form_row";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: id,
            comp_id: "<?=$comp_id?>",
            process_ids: process_ids,
            basic: basic
        },
        success: function(data) {
            if (data) {
                Swal.fire(
                    'Saved Successfully!',
                    '',
                    'success'
                )
            }
        }
    });

}


$("select[name='tab_process[]']").on('change', function() {
    var p = $(this).val();
    var tid = "<?=$tid?>";
    var comp_id = "<?=$comp_id?>";
    var url = "<?=base_url().'form/form/assign_process_in_tab/'?>";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            comp_id: comp_id,
            tid: tid,
            process_ids: p
        },
        success: function(data) {

        }
    });
})
</script>