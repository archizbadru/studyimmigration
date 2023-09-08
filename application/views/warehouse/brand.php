<div class="row">
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
             <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("warehouse/addbrand") ?>"> <i class="fa fa-plus"></i> Add Brand </a>  
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th>Type of product</th>
                            <th>Brand Name</th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($brand_list)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($brand_list as $brandlist) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php if(!empty($brandlist->proname)) { echo ucwords($brandlist->proname);}else { echo 'NA'; } ?></td>   
                                    <td><?php if(!empty($brandlist->name)) { echo ucwords($brandlist->name);}else{ echo 'NA'; } ?></td>   
                                                                    
                                    <td><?php echo (($brandlist->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("warehouse/editbrand/$brandlist->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("warehouse/deletebrand/$brandlist->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
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
