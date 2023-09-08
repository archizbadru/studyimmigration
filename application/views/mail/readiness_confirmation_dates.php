<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<div class="col-md-1"></div>
<div class="col-md-9 " style="margin-left:63px;">
        <div class="panel panel-default thumbnail"> 
        <div class="panel-heading no-print">
         <h3>OSUM - Installation Confirmation Date</h3>
        </div>
        
        <div class="panel-body">
                <br>
           <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                                   <div role="alert" class="alert alert-success">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                           
                                           <?=$this->session->flashdata('SUCCESSMSG')?>
                                   </div>
                           <?php } ?>
           
           <br>
           
                <?php 
                
                if($dates->is_confirm!=2){
                    
                    $display='block';
                    
                    $d = 'none';
                    
                }else{
                   
                   $display='none'; 
                   $d = 'block';
                    
                }?>
                
                 <div class="col-md-12 text-center" style="display:<?= $d ?>"><h3 style="color:green">Thank you!! Your requested date for installation has submitted successfully..</h3></div>
           
                <div id="hide-info" style="display:<?=$display ?>">
                    
                <!-- Site Audit Form --->
                    <form method="POST" action="<?php echo base_url('Installationprocess/installation_final_date_readiness')?>">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4 text-center">
                        
                        <?php
                            
                            $date1=date_create($dates->suggested_date1);
                            
                            $new_date1 = date_format($date1,"d-m-Y");
                            
                            $date2=date_create($dates->suggested_date2);
                            
                            $new_date2 = date_format($date2,"d-m-Y");
                        
                        
                        
                        ?>
                        
                        
                        <div class="radio">
                          <label><input type="radio" name="dates" value="<?=$dates->suggested_date1 ?>"> <?= $new_date1 ?></label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="dates" value="<?=$dates->suggested_date2 ?>"><?= $new_date2 ?></label>
                        </div>
                        
                        <input type="hidden" name="user" value="<?= $dates->client_id ?>">
                       
                    </div>
                    <div class="col-md-4"> </div>
                    
                    <div class="col-md-12 text-center"><p style="color:red">Note: Please select convenient date for the installation</p></div>
                    
                    <div class="form-group col-md-12 text-center"><br>
                    	    <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                    </div>
                   </form>
                </div>
        </div>
    </div>