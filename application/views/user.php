<div class="row">

    <!--  table area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">
            <?php if(!isset($_GET['user_role'])){ ?>
            <?php if(!isset($_GET['user_role'])!=''){ ?>
                <?php if(user_access(130)){ ?>
                    <div class="btn-group"> 

                        <a class="btn btn-success" href="<?php echo base_url("user/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_user') ?> </a>  

                    </div>
                <?php }  } } ?>
            </div>

            <div class="panel-body">

                <table class="datatable1 table table-striped table-bordered" cellspacing="0" width="100%">

                    <thead>

                        <tr>

                            <th><?php echo display('serial') ?></th>

                            <th>Emp Id</th>

                            <th><?php echo display('disolay_name') ?></th>

                            <th><?php echo display('user_function') ?></th>


                            <th>Email</th>

                            <th><?php echo display('mobile') ?></th>
                            <th><?php echo display("proccess"); ?></th>
                            <th><?php echo display("created_date"); ?></th>
                            <th><?php echo display("lsat_login"); ?></th>
                            <th><?php echo display('status') ?></th>

                           

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($departments)) { ?>

                            <?php $sl = 1; ?>

                            <?php foreach ($departments as $department) { ?>

                            

                             

                              <tr href="<?php echo base_url("user/edit/$department->pk_i_admin_id") ?>" class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?><?php if($department->b_status==0){echo 'color:red';} ?>" style="cursor: pointer;">

                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $sl; ?></td>

                                     <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->employee_id; ?></td>

                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->s_display_name;echo '&nbsp;';echo $department->last_name; ?></td>

                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->user_role;   ?></td>

                                  

                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->s_user_email; ?></td>

                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->s_phoneno; ?></td>
                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>">
                                        <?php 
                                        
                                        $process_arr = explode(',', $department->process);

                                        $this->db->select('product_name');
                                        $this->db->where_in('sb_id',$process_arr);
                                        $p_res    =   $this->db->get('tbl_product')->result_array();                                        
                                        if (!empty($p_res)) {
                                            foreach ($p_res as $key => $value) {
                                                echo $value['product_name'].', '; 
                                            }
                                        }
                                        ?>
                                            
                                        </td>
                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo !empty($department->dt_create_date)?$department->dt_create_date:'NA'; ?></td>


                                     <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo !empty($department->last_log)?$department->last_log:'NA'; ?></td>
                                     
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
        var a = $(this).attr('href');
        if (a) {
            window.location = $(this).attr('href');
        }
        return false;

    });

});

</script>

