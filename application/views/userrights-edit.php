<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading no-print">
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('user/update_user_role')?>" method="post">
                    <div class="form-group row">
                        <label for="inputText"
                            class="col-sm-1 col-form-label"><?php echo display('user_function') ?></label>
                        <div class="col-sm-4">
                            <input type="hidden" name="role_id" value="<?= $userRole->use_id ?>">
                            <input type="text" class="form-control" id="inputText" name="user_type"
                                placeholder="<?php echo display('user_function') ?>" value="<?= $userRole->user_role ?>"
                                required>
                        </div>
                    </div>
                    <table class=" table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <!-- <th><?php echo display('serial') ?></th> -->
                                <!-- <th>Emp Id</th> -->
                                <th><?php echo "Module Name"; ?></th>
                                <th><?php echo "Rights"; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                        $permission =  explode(',',$userRole->user_permissions);
                        if (!empty($user_role)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($user_role as $department) { 
                                if($this->user_model->check_user_has_module($department->id,$this->session->user_right)){
                                ?>
                            <tr style="<?php if($department->status==0){echo 'color:red';} ?>" style="cursor: pointer;">
                                <!-- <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php echo $sl; ?></td> -->
                                <td style="<?php if($department->status==0){echo 'color:red';} ?>">
                                    <?php echo $department->title; ?></td>
                                <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php
                                            echo getRightsByid($department->id,$permission);
                                            ?>
                                </td>
                                <?php
                                    }
                                    ?>
                            </tr>
                            <?php $sl++; } ?>
                            <?php } ?>

                        </tbody>
                    </table> <!-- /.table-responsive -->
                    <div class="row text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>