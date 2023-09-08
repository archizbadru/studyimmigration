<div class="row">

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <?php if(0 && user_access(130)){ ?>
                    <div class="btn-group"> 

                        <a class="btn btn-success" href="<?php echo base_url("userrights/create") ?>"> <i class="fa fa-plus"></i>  <?php echo "Add Module Rights" ?> </a>  

                    </div>
                <?php } ?>
            </div>

            <div class="panel-body">
                <form action="<?php echo base_url('user/user_type_add')?>" method="post">
                <div class="form-group row">
                    <label for="inputText" class="col-sm-1 col-form-label"><?php echo display('user_function') ?></label>
                    <div class="col-sm-4">
                        <input type="hidden" name="roleid" value="<?php if(!empty($roleid)){ echo $roleid; }?>">
                      <input type="text"  class="form-control" id="inputText" name="user_type" placeholder="<?php echo display('user_function') ?>" value="<?php if(!empty($urole)){ echo $urole; }?>" required>
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

                        <?php if (!empty($user_role)) { ?>

                            <?php $sl = 1; ?>

                            <?php foreach ($user_role as $department) { 
                                 if($this->user_model->check_user_has_module($department->id,$this->session->user_right)){
                                ?> 
                              <tr style="<?php if($department->status==0){echo 'color:red';} ?>" style="cursor: pointer;">

                                    <!-- <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php echo $sl; ?></td> -->

                                    <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php echo $department->title; ?></td>

                                    <td style="<?php if($department->status==0){echo 'color:red';} ?>"><?php
                                    $user_permission=array();
                                 echo getRightsByid($department->id,$user_permission);
                                       ?></td>

                                   
                                </tr>

                                

                                <?php $sl++; } ?>

                            <?php } ?> 

                        <?php } ?> 

                    </tbody>

                </table>  <!-- /.table-responsive -->
                    <div class="row text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>



