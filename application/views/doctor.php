<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("customer/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_doctor') ?> </a>                      
                </div>
                <?php
                echo "<p class='pull-right'>Total Users = ".$this->db->get('tbl_admin')->num_rows().'</p>';                                         
                ?>                    
            </div> 

            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr><th style="width:20px;"><input type="checkbox"></th>
                            <th style="width:20px;"><?php echo display('serial') ?></th>
                            <th><?php echo display('picture') ?></th>
                            <th><?php echo display('first_name') ?></th>
                            <th><?php echo display('last_name') ?></th>
                        
                            <th><?php echo display('email') ?></th> 
                            <th><?php echo display('mobile') ?></th> 
                            <th><?php echo "No of users" ?></th> 
                            <th><?php echo display('status') ?></th> 
                            
                            <th><?php echo display('action') ?></th> 
                            
                          
                       
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($doctors)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($doctors as $doctor) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                        <td style="width:20px;"><input type="checkbox"></td>
                                    <td style="width:20px;"><?php echo $sl; ?></td>
                                
                                    <td><img src="<?php echo base_url($doctor->pictures); ?>" alt="" width="65" height="50"/></td>
                                    <td><?php echo $doctor->firstname; ?></td>
                                    <td><?php echo $doctor->lastname; ?></td>
                                    <td><?php echo $doctor->email; ?></td>
                                    <td><?php echo $doctor->mobile; ?></td>
                                    <td>
                                        <?php 
                                            $this->db->where('companey_id',$doctor->user_id);                                            
                                            echo $this->db->get('tbl_admin')->num_rows(); 
                                        ?>                                                
                                    </td>

                                    <td><?php 
                                    if ($doctor->status) {
                                        echo "Active";
                                    }else{
                                        echo "Inactive";                                        
                                    } ?>
                                    </td>
                                   
                                    <td>
                                        <div class="action-btn">
                                        <a href="<?php echo base_url("customer/profile/$doctor->user_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("customer/edit/$doctor->user_id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("customer/logged-in-as-user/$doctor->user_id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-sign-in"></i></a> 
                                       <!-- <a href="<?php echo base_url("customer/delete/$doctor->user_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?> ')"><i class="fa fa-trash"></i></a>-->
                                        </div> 
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
