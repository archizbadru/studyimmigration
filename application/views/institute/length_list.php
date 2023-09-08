<div class="row">

    <!--  table area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("lead/add_length") ?>"> <i class="fa fa-plus"></i>  <?php echo display('program_length') ?> </a>  

                </div>

            </div>

            <div class="panel-body">

                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">

                <thead>

                <tr>

                    <th><?php echo display('serial') ?></th>

                    <th><?php echo display('level_list') ?></th>

                    <th><?php echo display('program_length') ?></th>					

                    <th><?php echo display('status') ?></th>

                    <th><?php echo display('action') ?></th>

                </tr>

                </thead>

                <tbody>

                <?php if (!empty($length_list)) { 

                    $sl = 1;foreach ($length_list as $length) {?>

                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                            <td><?php echo $sl; ?></td>

                            <td><?php 
							foreach($level as $lvl){
								if($length->level_id==$lvl->id){
							echo $lvl->level;
							}}
							?></td>
							
							<td><?php echo $length->length; ?></td>

                            <td><?php echo (($length->status==1)?display('active'):display('inactive')); ?></td>

                            <td class="center">

                                <a href="<?php echo base_url("lead/edit_length/$length->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 

                                <a href="<?php echo base_url("lead/delete_length/$length->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 

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