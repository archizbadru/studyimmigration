<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("user/create") ?>"> <i class="fa fa-plus"></i>Add Company </a>  
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th>Com ID</th>
                            <th>company Name</th>
                            <th>Company Rights</th>
                            <th>Permission Level</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Status</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($company)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($company as $department) { ?>
                            
                             
                              <tr href="<?php echo base_url("user/edit/$department->uid") ?>" class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?><?php if($department->status==0){echo 'color:red';} ?>" style="cursor: pointer;">
                                    <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php echo $sl; ?></td>
                                     <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php echo $department->uc_key; ?></td>
                                    <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php echo $department->company_name ?></td>
                                    <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php echo $department->user_role;   ?></td>
                                     <td style="<?php if($department->status==0){echo 'color:red';} ?>">
                                     
                                     <?php if($department->user_roles==2){echo display('admin_level');}?>
                                        <?php if($department->user_roles==3){echo display('country_level');}?>
                                        <?php if($department->user_roles==4){echo display('region_level');}?>
                                      <?php if($department->user_roles==5){echo display('state_level');}?>
                                         <?php if($department->user_roles==6){echo display('territory_level');}?>
                                      <?php if($department->user_roles==7){echo display('city_level');}?>
                                         <?php if($department->user_roles==8){echo display('user_level');}?>
                                     
                                     </td>
                                    <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php echo $department->fullname;   ?></td>
                                    <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php echo $department->email;   ?></td>
                                    <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php echo $department->mobile;   ?></td>

                                    <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php echo (($department->status==1)?display('active'):display('inactive')); ?></td>
                                   
                                   
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
<script>
    $(document).ready(function(){
    $('table tr').click(function(){
        window.location = $(this).attr('href');
        return false;
    });
});
</script>
