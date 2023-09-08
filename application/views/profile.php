<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail"> 
        
            <div class="panel-heading no-print">
                 <div class="btn-group">
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-success" ><i class="fa fa-print"></i></button>            
                    <a href="<?php echo base_url('dashboard/form/') ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
                </div>
            </div>


            <div class="panel-body">  
                <div class="row">
                    <div class="col-sm-12" align="center">  
                    <br>
                    </div>

                    <div class="col-sm-4" align="center"> 
                        <img alt="Picture" src="<?php if(!empty($department->picture)){}else{echo base_url("assets/images/no-img.png");} ?>" width="150" height="150">
                        <h3>
                            <?php echo $this->session->userdata('fullname') ?> 
                           
                        </h3>
                    </div> 

                    <div class="col-sm-8"> 
                        <dl class="dl-horizontal">
                        <?php if(!empty($user->s_user_email)) { ?>
                            <dt><?php echo display('email') ?></dt><dd><?php echo $user->s_user_email ?></dd>
                        <?php } ?>


                        <?php if(!empty($user->s_phoneno)) { ?>
                            <dt><?php echo display('mobile') ?></dt><dd><?php echo $user->s_phoneno ?></dd>
                        <?php } ?> 
   
                  
  
  
                        <?php if(!empty($user->dt_create_date)) { ?>
                            <dt><?php echo display('create_date') ?></dt><dd><?php echo $user->dt_create_date ?></dd>
                        <?php } ?>  
  
                        <?php if(!empty($user->dt_update_date)) { ?>
                            <dt><?php echo display('update_date') ?></dt><dd><?php echo $user->dt_update_date ?></dd>
                        <?php } ?>  
   
                        <?php if(!empty($user->status)) { ?>
                            <dt><?php echo display('status') ?></dt><dd><?php echo (!empty($user->status)?
                            display('active'):display('inactive')) ?></dd>
                        <?php } ?>  
                        </dl> 
                    </div>
                </div>  

            </div> 

            <div class="panel-footer">
                <div class="text-center">
                    <strong><?php echo $this->session->userdata('title') ?></strong>
                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

