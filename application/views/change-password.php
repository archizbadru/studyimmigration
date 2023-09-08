<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url('dashboard/home');?>"><i class="fa fa-arrow-circle-o-left"></i> Back</a> 
                    
                </div>
            </div>
            <div class="panel-body">
                	    
                	    <div class="row">
                	        
                	        <div class="col-md-12">
                	            
                	            <?php if($this->session->error!=''){ ?>
                	                
                	                <div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                         <?php echo $this->session->error; ?>
                                      </div>
                                      
                                   <!--<button  class='btn btn-danger text-left'><?php echo $this->session->error; ?></button>-->
			                        <?php } ?>
									<?php if($this->session->success!=''){ ?>
                                    <!--<button  class='btn  btn-success left'><?php echo $this->session->success; ?></button>-->
                                    
                                    <div class="alert alert-success alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Success!</strong> <?php echo $this->session->success; ?>
                                      </div>
                                    
			                    <?php } ?>
                	        </div>
                	        
                	    </div>
                                  
						<form  action='<?php echo base_url('setting/update_password')?>' method="post" id="changepassword">
						    <div class="row">
                             
                                <div class="col-md-2">
                                    
                                </div>
                                
                                <div class="col-md-8 form-group">
                                    
                                    <div class="form-group col-md-8">
                                        <label for="pwd">Old password:</label>
                                        <input type="password" class="form-control" name="oldpass" id="oldpass" placeholder="Old password" required>
                                    </div>
                                    
                                    <div class="form-group col-md-8">
                                        <label for="pwd">New password:</label>
                                        <input type="password" class="form-control" name="newpass" id="newpass" placeholder="New password" required>
                                    </div>
                                    
                                    <div class="form-group col-md-8">
                                        <label for="pwd">Confirm password:</label>
                                        <input type="password" class="form-control" name="confirmpass" id="confirmpass" placeholder="Confirm password" required>
                                    </div>
                                    
                                    <div class="form-group col-md-12 offset-md-3">
                                        
                                        <button class="btn btn-success" type="submit">Submit</button>
                                        
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                </div>
                                
                                <div class="col-md-2">
                                    
                                </div>
                             
                            
                            </div>
                        </form>
            </div>
        </div>
    </div>
</div>

       