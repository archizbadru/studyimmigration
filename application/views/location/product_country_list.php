<?php 

 $panel_menu = $this->db->select("tbl_user_role.user_permissions")
            ->where('pk_i_admin_id',$this->session->user_id)
            ->join('tbl_user_role','tbl_user_role.use_id=tbl_admin.user_permissions')
            ->get('tbl_admin')
            ->row();
            if (!empty($panel_menu->user_permissions)) {
              $module=explode(',',$panel_menu->user_permissions);
            }else{
              $module=array();
            }


?>

<div class="row">
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
             <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("lead/addproductcountry") ?>"> <i class="fa fa-plus"></i>  <?php echo 'Add Product' ?> </a>  
                </div>
            </div>
            <div class="panel-body">
             <?php    if(in_array(300,$module) || in_array(301,$module) || in_array(302,$module) || in_array(303,$module) || in_array(304,$module) || in_array(305,$module) || in_array(306,$module)){ ?>

                            <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th>SKU ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Type of Product</th>
                            <th>Brand</th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($country)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($country as $department) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php if(!empty($department->skuid)){  echo $department->skuid; } else{ echo 'NA' ; }?></td> 
                                    <td><?php if(!empty($department->country_name)){  echo $department->country_name; }else{ echo 'NA'; } ?></td> 
                                    <td><?php if(!empty($department->price)){ echo $department->price; }else{ echo 'NA'; }?></td>        
                                    <td><?php if(!empty($department->typroname)){ echo $department->typroname; }else{ echo 'NA'; } ?></td>     
                                    <td><?php  if(!empty($department->brandname)){ echo $department->brandname; } else{ echo 'NA' ; }?></td>                        
                                    <td><?php echo (($department->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("lead/editproductcountry1/$department->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("lead/deleteproductcountry/$department->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>

               <?php } else { ?>


                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th>Product Name</th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($country)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($country as $department) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $department->country_name; ?></td>                                   
                                    <td><?php echo (($department->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("lead/editproductcountry/$department->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("lead/deleteproductcountry/$department->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            <?php } ?>
            </div>
        </div>
    </div>
</div>
