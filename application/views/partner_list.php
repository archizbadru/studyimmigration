<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("user/add_partner") ?>"> <i class="fa fa-plus"></i>  Channel Partner </a>  
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('partner_id');?></th>
                            <th><?php echo display('disolay_name') ?></th>
                            <th>Organisation Name</th>
                            <th><?php echo display('user_function') ?></th>
                            <th>Partner Type</th>
                            <th>Partner Profile</th>
                            <th>Email</th>
                            <th><?php echo display('mobile') ?></th>
                            <th><?php echo display('status') ?></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($departments)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($departments as $department) { ?>
                              <tr href="<?php echo base_url("user/partner_edit/$department->pk_i_admin_id") ?>" class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?><?php if($department->b_status==0){echo 'color:red';} ?>" style="cursor: pointer;">
                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $sl; ?></td>
                                     <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->employee_id; ?></td>
                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->s_display_name;echo '&nbsp;';echo $department->last_name; ?></td>
                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->orgisation_name;   ?></td>
                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->user_role;   ?></td>
                                     <td style="<?php if($department->b_status==0){echo 'color:red';} ?>">
                                         
                                      <?php if(!empty($type_list)){
                                          foreach($type_list as $list){
                                           if($list->p_tid == $department->p_type){echo $list->type;}}} ?>
                                           
                                     </td>
                                     <td style="<?php if($department->b_status==0){echo 'color:red';} ?>">
                                     
                                     <?php echo $department->channel_partner_type; ?>
                                     
                                      
                                     </td>
                                     
                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->s_user_email; ?></td>
                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->s_phoneno; ?></td>

                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo (($department->b_status==1)?display('active'):display('inactive')); ?></td>
                                   
                                   
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
