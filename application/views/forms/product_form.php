<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="<?=base_url().'assets/js/RowSorter.js'?>"></script>
<style type="text/css">
  /*#fields_table>tbody>tr{
    cursor: move;
  }*/
</style>
        <div class="text-center">
          <br>
          <table class="table table-bordered" id="fields_table">
            <thead style="background: #333; color: white;">
              <tr>
                <th>#</th>
                <th>Field Name</th>
                <th>Type</th>                
                <th>Status</th>
                <th width="35%">Choose Category</th>
                <th>Action</th>
              </tr>              
            </thead>
            <tbody>             
              <?php
              $i = 1;
              
              if (!empty($form_fields)) {
                foreach ($form_fields as $key => $value) {
                  $process_ids = array();
                  if(!empty($value['process_id'])){
                    $category_ids = explode(',', $value['process_id']);
                  }                  
                  ?>
                  <tr id="<?=$value['input_id']?>" data-fldtype="extra">
                    <td><?=$i?></td>
                    <td><?=$value['input_label']?></td>
                    <td>
                    <?php                    
                      echo ucfirst($value['input_type_title']);
                    ?>
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
                           <?php foreach($category as $cat){?>
                           <option value="<?=$cat->id?>" <?php if (in_array($cat->id, $category_ids)) { echo "selected"; } ?> ><?=$cat->name?></option>
                           <?php } ?>
                        </select>
                    </td>
                    <td>                     
                      <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_tab_field" onclick="edit_form_row(<?=$value['input_id']?>)"><i class="fa fa-edit"></i></a>                      
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
                }
              }
              ?>
            </tbody>
          </table>          
        </div>
        <div class="text-center">
          <button class="btn btn-primary btn-primary"  type="button"  data-toggle="modal" data-target="#myModal" >Add New Field</button>               
        </div>
        <br>

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
             <div class="form-row">                
                <div class="form-group col-md-6">
                    <label for="label_name"> Label Name <i class="text-danger">*</i></label>
                      <input type="text" id="label_name"  class="form-control" placeholder="Label Name" value="" name="label_name" required>
                </div>
                <div class="form-group col-md-6">
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
                  <label for="process_list"> Product Category<i class="text-danger">*</i></label>
                  <select name='process_list[]' id="process_list" class="form-control  chosen-select" multiple required>
                    <?php
                    if (!empty($category)) {
                      foreach ($category as $cat) { ?>
                        <option value="<?=$cat->id?>" ><?=$cat->name?></option>                        
                      <?php
                      }
                    }
                    ?>                    
                  </select>
                </div>              
                
                <div class="form-group col-md-12">
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
            <input type="hidden" name="page_id" value="1">
        </form>                                         
      </div>      
    </div>
  </div>
</div>



<!-- edit tab field start -->
<div id="edit_tab_field" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Form Field</h4>
      </div>
      <div class="modal-body" id="edit_tab_field_content">         
      </div>
    </div>
  </div>
</div>
<!-- edit tab field end -->

<script type="text/javascript">  
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
    })

    $("#label_type").on('change', function() {
        if ($(this).val() == 2) {
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
            if (proc == null) {
                Swal.fire("Warning!", "Please select process", "warning");
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

function edit_form_row(id) {    
    var url = "<?=base_url()?>form/form/edit_tab_field";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: id,
            comp_id: "<?=$comp_id?>",
            id:id
        },
        success: function(data) {
          $("#edit_tab_field_content").html(data);          
        }
    });

}


function gebi(id){
  return document.getElementById(id);
}
RowSorter(gebi('fields_table'), {    
  onDrop: function(tbody, row, new_index, old_index) {
      var fld_type  = row.getAttribute('data-fldtype');      
      var comp_id = "<?=$comp_id?>";
      var url = "<?=base_url().'form/form/reorder_field/'?>";
      
      if (fld_type == 'basic' && new_index > 10) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Basic field can not go into extra field!'          
        })
      }else{
        $.ajax({
          type: "POST",
          url: url,
          data: {
              comp_id: comp_id,
              fid: row.id,
              type: fld_type,
              fld_order: new_index
          },
          success: function(data) {
            console.log(data);
          }
        });        
      }
  }
});
</script>