<div class="row">
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
             <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("warehouse/addtypeofproduct") ?>"> <i class="fa fa-plus"></i> Add type of product </a>  
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th>Warehouse Name</th>
                            <th>Type of Product</th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($protype_list)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($protype_list as $protypelist) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $protypelist->wrname; ?></td>   
                                    <td><?php echo $protypelist->name; ?></td>  
                                                                   
                                    <td><?php echo (($protypelist->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("warehouse/edittypeofproduct/$protypelist->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("warehouse/deletetypeofproduct/$protypelist->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
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
