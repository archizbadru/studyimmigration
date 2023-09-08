<div class="row">

    <!--  table area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("lead/add_video") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_vid') ?> </a>  

                </div>

            </div>

            <div class="panel-body">

                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">

                <thead>

                <tr>

                    <th><?php echo display('serial') ?></th>

                    <th><?php echo display('title_name') ?></th> 
                    <th><?php echo display('link_name') ?></th>
                    <th><?php echo display('description') ?></th>
                    <th><?php echo display('meta_keyword') ?></th>					

                    <th><?php echo display('status') ?></th>

                    <th><?php echo display('action') ?></th>

                </tr>

                </thead>

                <tbody>

                <?php if (!empty($vid_list)) { 

                    $sl = 1;foreach ($vid_list as $vid) {?>

                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                            <td><?php echo $sl; ?></td>

                            <td width=""><?php echo $vid->title; ?></td>
                            <td width=""><?php echo $vid->link; ?></td>
                            <td width=""><?php echo $vid->des; ?></td>
                            <td width=""><?php echo $vid->meta_key; ?></td>							

                            <td><?php echo (($vid->status==1)?display('active'):display('inactive')); ?></td>

                            <td class="center">

                                <a href="<?php echo base_url("lead/edit_vid/$vid->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 

                                <a href="<?php echo base_url("lead/delete_vid/$vid->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 

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