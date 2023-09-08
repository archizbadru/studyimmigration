<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                     <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-placement="top" data-target="#myModal" id="create_cat"> <i class="fa fa-plus "></i> New Category</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                        if (!empty($categories)) { 
                            foreach ($categories as $key => $value) {
                            ?>                            
                            <tr>
                                <td><?=$value['name']?></td>
                                <td><?=!empty($value['description'])?$value['description']:'NA'?></td>
                                
                                <td>
                                    <?php 
                                    
                                    if($value['status']==0){
                                        echo "<label class='badge badge-warning'>Inactive</label>";
                                    }else if($value['status']==1){
                                        echo "<label class='badge badge-success'>Active</label>";
                                    } 
                                    ?>
                                </td>

                                <td>
                                    <a href="javascript:void(0)" onclick="edit_category(<?=$value['id']?>)" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> 
                                    <a href="javascript:void(0)" onclick="delete_category(<?=$value['id']?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> 
                                </td>
                            </tr>                            
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="panel panel-custom">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"id="myModalLabel">New Category</h4>
                </div>
                <div class="modal-body wrap-modal wrap">
                    <form id="form_validation" data-parsley-validate="" novalidate="" enctype="multipart/form-data"
                          action="<?=base_url()?>knowledge_base/saved_categories/" method="post" class="form-horizontal">
                          <input type="hidden" name="edit" value="">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Category <span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="category" required class="form-control"/>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-8">
                                <label class="radio-inline"><input type="radio" name="status" value="1" checked="checked">Active</label>
                                <label class="radio-inline"><input type="radio" name="status" value="0">Inactive</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-2">
                                <button type="submit" id="sbtn" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    function delete_category(id){           
      if(confirm("Are you sure?")){
         $.ajax({
           url: "<?=base_url().'knowledge_base/delete_row'?>",
           type: "post",
           data: {'id':id,'table':'tbl_category'},
           success: function (response) {
            if(response){
               alert('Category Deleted Succssfully');
               location.reload();
            }else{
               alert('Something went wrong!');
               location.reload();            
            }
           },
           error: function(jqXHR, textStatus, errorThrown) {
               alert('Something went wrong!');           
               location.reload();                        
           }
         });
      }
   }
   function edit_category(id){
        $.ajax({
           url: "<?=base_url().'knowledge_base/category_details'?>",
           type: "post",
           data: {'id':id},
           success: function (response) {
            console.log(response);
            if(response){
               response            = JSON.parse(response);               
               id                  = response.id;
               cat                 = response.name;
               description         = response.description;               
               status              = response.status;                 

               $("input[name='category']").val(cat);               
               $("input[name='edit']").val(id);               
               $("textarea[name='description']").val(description);
               $("input[name=status][value=" + status + "]").prop('checked', true);
               $("#create_cat").click();
            }else{

               alert('Something went wrong!');
               location.reload();            

            }
           },
           error: function(jqXHR, textStatus, errorThrown) {
               alert('Something went wrong!');           
               location.reload();                        
           }
        });
   }
   $('#myModal').on('hidden.bs.modal', function () {
   location.reload();                        
})
</script>

