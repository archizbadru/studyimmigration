<div class="row">
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
             <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("warehouse/addwarehouse") ?>"> <i class="fa fa-plus"></i> Add Warehouse </a>  
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Address</th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($warehouse_list)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($warehouse_list as $warehouselist) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $warehouselist->name; ?></td>   
                                    <td><?php echo $warehouselist->email; ?></td>  
                                    <td><?php echo $warehouselist->phone; ?></td>    
                                    <td><?php echo $warehouselist->cntryname; ?></td>   
                                    <td><?php echo $warehouselist->statename; ?></td>   
                                    <td><?php echo $warehouselist->cityname; ?></td>    
                                    <td><?php echo $warehouselist->address; ?></td>                                  
                                    <td><?php echo (($warehouselist->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("warehouse/editwarehouse/$warehouselist->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("warehouse/deletewarehouse/$warehouselist->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
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
