<div class="row"> 
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("lead/add_description") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_lead_description') ?> </a>  
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th><?php echo display('serial') ?></th>
                    <th><?php echo display('Description')?></th>
                    <th><?php echo display('lead_stage') ?></th>   
                    <th><?php echo 'Process';?></th>                        
                    <th><?php echo display('status') ?></th>
                    <th><?php echo display('action') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($description_list)) { 
                    $sl = 1;foreach ($description_list as $description) {?>
                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $description->description; ?></td>
                            <td> <?php echo $description->stage_list; ?></td>
                            <td><?php echo !empty($description->product_name)?$description->product_name:'NA';?></td>                    
                            <td><?php echo (($description->status==1)?display('active'):display('inactive')); ?></td>
                            <td class="subsource">
                                <a href="<?php echo base_url("lead/edit_discription/$description->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                <a href="<?php echo base_url("lead/delete_description/$description->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                            </td>
                        </tr>
                        <?php $sl++; ?>
                    <?php } ?> 
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>