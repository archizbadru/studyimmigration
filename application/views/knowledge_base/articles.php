<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                     <a href="<?=base_url().'knowledge_base/create_article'?>" class="btn btn-success"> <i class="fa fa-plus "></i> New Article</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Scope</th>
                            <th>Status</th>                            
                            <th>Created Date</th>
                            <th>Updated Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                        if (!empty($articles)) {
                          foreach ($articles as $key => $value) {?>
                            <tr>
                              <td><?=$value['title']?></td>
                              <td><?=$value['cat_name']?></td>
                              <td>
                                <?=$value['slug']?>                                
                              </td>
                              <td>
                                 <?php
                                  if($value['scope'] == 0){
                                      echo "<label class='badge badge-success'>Public</label>";
                                  }else if($value['status']==1){
                                      echo "<label class='badge badge-warning'>Internal</label>";
                                  } 
                                  ?>                                                                
                              </td>
                              <td>
                                 <?php
                                  if($value['status']==0){
                                      echo "<label class='badge badge-warning'>Inactive</label>";
                                  }else if($value['status']==1){
                                      echo "<label class='badge badge-success'>Active</label>";
                                  } 
                                  ?>                                
                              </td>
                              
                              <td><?=$value['created_date']?></td>
                              <td><?=$value['updated_date']?></td>
                              <td>
                                <a href="<?=base_url().'knowledge_base/create_article/'.$value['id']?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> 
                                
                                <a href="javascript:void(0)" onclick="delete_article(<?=$value['id']?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> 

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



<script type="text/javascript">
    function delete_article(id){           
      if(confirm("Are you sure?")){
         $.ajax({
           url: "<?=base_url().'knowledge_base/delete_row'?>",
           type: "post",
           data: {'id':id,'table':'articles'},
           success: function (response) {
            if(response){
               alert('Article Deleted Succssfully');
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
</script>

