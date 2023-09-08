<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("lead/add_center") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_center') ?> </a>  
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th><?php echo display('serial') ?></th>
                    <th><?php echo display('center_name') ?></th>
                    <th><?php echo display('contact_name') ?></th>
                    <th><?php echo display('contact_number') ?></th>
                    <th><?php echo display('country_name') ?></th>                          
                    <th><?php echo display('status') ?></th>
                    <th><?php echo display('action') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($center_list)) { 
                    $sl = 1;foreach ($center_list as $center) {?>
                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $center->center_name; ?></td>
                            <td><?php echo $center->contact_name; ?></td>
                            <td><?php echo $center->contact_number; ?></td>
                            <td><?php echo $center->country_name; ?></td>                               
                            <td><?php echo (($center->status==1)?display('active'):display('inactive')); ?></td>
                            <td class="center">
                                <a href="<?php echo base_url("lead/edit_center/$center->center_id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                <a href="<?php echo base_url("lead/delete_center/$center->center_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
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