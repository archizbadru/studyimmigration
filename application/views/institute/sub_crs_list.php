<div class="row">

    <!--  table area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("lead/add_sub_crs") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_sub_course'); ?> </a>  

                </div>

            </div>

            <div class="panel-body">

                <table id="example" class="table table-striped table-bordered" style="width:100%">

                <thead>

                <tr>

                    <th><?php echo display('serial') ?></th>

                    <th><?php echo display('course_name') ?></th>

                    <th><?php echo display('sub_course_name') ?></th> 					

                    <th><?php echo display('status') ?></th>

                    <th><?php echo display('action') ?></th>

                </tr>

                </thead>

                <tbody>

                <?php if (!empty($course_list)) { 

                    $sl =  ($this->uri->segment('3')) ? $this->uri->segment('3')+1 : 1  ; 
                    foreach ($course_list as $course) {?>

                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                            <td><?=$sl; ?></td>

                            <td width=""><?php foreach($cource as $crs){ if($crs->id==$course->course_name){ echo $crs->course_name;}}?></td> 

                            <td width=""><?php echo $course->sub_course; ?></td>							

                            <td><?php echo (($course->status==1)?display('active'):display('inactive')); ?></td>

                            <td class="center">

                                <a href="<?php echo base_url("lead/edit_sub_crs/$course->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 

                                <a href="<?php echo base_url("lead/delete_sub_crs/$course->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 

                            </td>

                        </tr>

                        <?php $sl++; ?>

                    <?php } ?> 

                <?php } ?>

                </tbody>


              </table>
              <?=$links;?>

            </div>

            <!-- /.card-body -->

          </div>

          <!-- /.card -->

        </div>

        <!-- /.col -->

      </div>
<!-- <script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script> -->