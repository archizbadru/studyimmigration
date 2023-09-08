<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group">             
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable1 table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th>Emp Id</th>
                            <th><?php echo display('disolay_name') ?></th>                            
                            <th>Email</th>
                            <th><?php echo display('mobile') ?></th>                                                        
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($departments)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($departments as $department) { ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $department->employee_id; ?></td>
                                    <td><?php echo $department->s_display_name;echo '&nbsp;';echo $department->last_name; ?></td>                                    
                                    <td><?php echo $department->s_user_email; ?></td>
                                    <td><?php echo $department->s_phoneno; ?></td>
                                    <td><a href="javascript:void(0)" onclick="get_modal_content(<?=$department->id?>)" class="btn btn-sm btn-primary">View In Map</a></td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

<button type="button" id='modal_btn' data-toggle="modal" data-target="#myModal" style="visibility: hidden;"></button>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 70%">
      <div class="modal-content" id="map_model_content">
        
      </div>
    </div>
  </div>

  <script type="text/javascript">
      function get_modal_content(id){        
            $.ajax({
            url: "<?=base_url().'field_map/map_model_content/'?>",
            type: 'post',
            dataType: 'json',
            data:{'id':id},
            success: function(responseData){
                if(responseData.status == true){
                    $("#map_model_content").html(responseData.data);
                    $("#modal_btn").click();
                }else{
                    $("#map_model_content").html('');                    
                    alert(responseData.msg);
                }
            }
        });
      }
  </script>



