<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<style>
    
    td{
        
        font-size:12px;
    }
    
    th{
        
        font-size:12px;
    }
    .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
    color: white !important;
    background-color: #37a000 !important; }
    
    .nav-pills > li > a {
    color:black !important; }
</style>

    <div class="row">
        <div class="col-md-6 col-md-offset-4"><br>
            <!--<ul class="nav nav-pills">
                <li class="active">
        		    <a href="#tab-all" data-toggle="tab" aria-expanded="true">Readiness Form 1</a>
        		</li>
        		
                <li>
        		    <a href="#tab-all1" data-toggle="tab" aria-expanded="true">Readiness Form 2</a>
        		</li>
            </ul>-->
        </div>
    </div><br>

<div class="col-md-1"></div>
<div class="col-md-9" style="margin-left:63px;">
    
   <div class="tab-content">
   <div id="tab-all" class="tab-pane active">
    
        <div class="panel panel-default thumbnail"> 
                <div class="panel-heading no-print">
         <h3>OSUM - Checklist for Site Readiness before Installation</h3>
        </div>
        
            <div class="panel-body">
                <br>
                      
           <br>
           <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                                   <div role="alert" class="alert alert-success">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                           
                                           <?=$this->session->flashdata('SUCCESSMSG')?>
                                   </div>
                           <?php }
                           
                           if($submitted==0){
                               
                               $d= 'block';
                               
                               $dis = 'none';
                               
                            }elseif($submitted==1){
                                
                                $d = 'none';
                                
                                $dis = 'block';
                            }
                           
                           ?>
                           
                           <div class="alert alert-success" style="display:<?=$dis?>">
                               
                              <strong>Your Site Readiness Sheet has submitted successfully...</strong>
                              
                           </div>
           
                    <div style="display:<?=$d?>">
                    <form action="http://0903.ga/Installationprocess/add_readiness_sheet_submitted_by_client" class="form-inner" method="post" accept-charset="utf-8" id="form_one">
                    
                    	<div class="form-group col-md-6">
                    	    <label>Client Name</label>
                    	  <input class="form-control" name="client_name" type="text" value="<?= $clientDetails->cl_name ?>" readonly="">
                    	  <input type="hidden" value="<?= $clientDetails->cli_id ?>" name="user_id" class="form-control">
                    	</div>
                    	
                    	<div class="form-group col-md-6">
                    	    <label>Client Mail id</label>
                    	  <input class="form-control" name="mail" type="text" value="<?= $clientDetails->cl_email ?>" readonly="">
                    	</div>
                    	
                        <div class="form-group col-md-6">
                    	    <label>Client Mobile Number</label>
                    	  <input class="form-control" name="mobile" type="text" value="<?= $clientDetails->cl_mobile ?>" readonly="">
                    	</div>
                    	
                    	<div class="form-group col-md-6">
                    	    <label>Channel partner</label>
                    	  <input class="form-control" name="channel_partner" type="text" value="" required="">
                    	</div>
                    	
                    	<div class="form-group col-md-6">
                    	    <label>Site Address</label>
                    	  <input class="form-control" name="site_address" type="text" value="<?= $clientDetails->address?>" readonly="">
                    	</div>
                    	
                    	<div class="form-group col-md-6">
                    	    <label>Tech Support Engineer</label>
                    	  <input class="form-control" name="tech_support_engg" type="text" value="" required="">
                    	</div>
                    
                    <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead style="background-color:black;color:#ffff;">
                          <tr>
                            <th class="text-center">Sno.</th>
                            <th class="text-center" nowrap>Check points</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          <?php $i=1; 
                          
                          foreach($readiness_list as $row){?>
                          
                          <tr>
                            <td class="text-center"><?= $i++ ?>  <input type="hidden" value="<?= $row->install_id ?>" name="desc_id[]"></td>
                            <td class="text-center"><?= $row->check_points ?></td>
                            <td class="text-center"><?= $row->description?></td>
                            <td class="text-center" style="width:117px">
                            
                            <?php 
                                
                                 $val = explode(',',$row->status_val);
                                
                                $totl = count($val);
                                
                                    if($row->readiness_status_type==1){
                                        $k=1;
                                        for($j=0; $j <$totl; $j++){?>
                                        
                                           <div class="form-check">
                                              <input class="form-check-input" name="status_val[]" type="checkbox" value="<?= $val[$j] ?>" id="defaultCheck<?= $k ?>">
                                              <label class="form-check-label" for="defaultCheck<?= $k ?>">
                                                <?= $val[$j] ?>
                                              </label>
                                            </div>
                                            
                                    <?php $k++;}}else if($row->readiness_status_type==2){?>
                                        
                                        <div class="col-sm-6"><?php $k=1; 
                                            for($j=0; $j<$totl; $j++){?>
                                            <div class="radio radio-danger">
                                                <input type="radio" name="status_val[]"  id="radio<?= $k ?>" value="<?= $val[$j]?>">
                                                <label for="radio<?= $k ?>">
                                                    <?= $val[$j] ?>
                                                </label>
                                            </div>
                                            <?php $k++;} ?>
                                        </div>
                                        
                                    <?php }else if($row->readiness_status_type==3){?>
                                        
                                        <input class="form-control" name="status_val[]"  type="text" >
                                        
                                    <?php }else{
                                        
                                        if($i==1){
                                            
                                            $r = 'required';
                                            
                                        }else{
                                            
                                            $r='';
                                        }
                                        
                                        ?>
                                         
                                        <select class="form-control" name="status_val[]" <?= $r ?>>
                                         
                                            <option value="" style="display:none;">Select...</option>
                                            
                                            <?php for($j=0; $j < $totl; $j++ ){ ?>
                                                
                                                 <option value="<?= $val[$j] ?>"><?= $val[$j] ?></option>
                                                 
                                            <?php } ?>
                                            
                                        </select>
                                   <?php  } ?>
                            </td>
                          </tr><?php } ?>
                                                  </tbody>
                    </table>
                    </div>
                    <div class="form-group col-md-12 text-center">
                            
                            <!--<button type="submit" class="btn btn-success">Submit</button>-->
                            <!--<button type="button" class="btn btn-success">Edit</button>-->
                            <a href="#tab-all1" class="btn btn-success" data-toggle="tab" aria-expanded="true">Next &#8677;</a>
                        
                    </div>
                    </form>
                    </div>
                </div>
            </div>
            </div>
            
            <!--------------------- second tab ----------------------->
             <div id="tab-all1" class="tab-pane">
                 
                 <div class="panel panel-default thumbnail"> 
                <div class="panel-heading no-print">
         <h3>OSUM - Checklist for Site Readiness before Installation</h3>
        </div>
            <div class="panel-body">
                <br>
           <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                                   <!--<div role="alert" class="alert alert-success">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                           
                                           <?=$this->session->flashdata('SUCCESSMSG')?>
                                   </div>-->
                           <?php } ?>
                    
                    <form class="form-inner" id="form_two" action="<?php echo base_url('Installationprocess/mail_sitereadiness_form_two')?>" method="POST">
                    
                    <div class="col-md-12">
                        <input value="<?= base64_decode($this->uri->segment('2'))?>" name="user_id" type="hidden">
                    <table class="table table-bordered">
                        <thead style="background-color:black;color:#ffff;">
                          <tr>
                            <th class="text-center" style="font-size:12px;">Sno.</th>
                            <th class="text-center" style="font-size:12px;" nowrap>Device Type</th>
                            <th class="text-center" style="font-size: 12px;">Device Brand Name</th>
                            <th class="text-center" style="width:10px;width:124px;font-size: 12px;">Device Model No.</th>
                            <th class="text-center" style="width:10px;width:124px;font-size: 12px;">Qty</th>
                            <th class="text-center" style="width:10px;width:124px;font-size: 12px;">Device Load</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $devices = array('Router','Dimming Lights','On/Off Lights','Fan','Ac','Curtain Motors','Digital Door Lock','TV','Set Top Box','Music System');
                            $j=1;
                            for($i=0; $i < count($devices); $i++){?>
                            <tr>
                                <td><?= $j++ ?></td>
                                <td><?= $devices[$i] ?><input type="hidden" value="<?=$devices[$i] ?>" class="form-control" name="device_type[]"></td>
                                <td><input type="text" class="form-control" name="device_brand[]"></td>
                                <td><input type="text" class="form-control" name="device_model[]"></td>
                                <td><input type="text" class="form-control" name="quantity[]"></td>
                                <td><input type="text" class="form-control" name="devices_load[]"></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="6"><strong>Please specify if any Site specific need or observation that we should know</strong></td>
                            </tr>
                             <tr>
                                <td colspan="6"><textarea class="form-control" rows="5" name="additional"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <div class="form-group col-md-12 text-center">
                            
                             <a href="#tab-all" data-toggle="tab" aria-expanded="true" class="btn btn-success">&#8676; Back</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                            <!--<button type="button" class="btn btn-success">Edit</button>-->
                        
                    </div>
                    </form>
                </div>
            </div>
                 
             </div>
             
            
            </div>
            
        </div>
        
        
        <script>
            
            
            /*function submitForm(){
                
                //document.getElementById("form_one").submit();
               
               //document.getElementById("form_two").submit();
               
               
               
               
            }*/
            
            $(function(){
                
                $("#form_two").submit(function(e){
                    
                    e.preventDefault();
                    
                    $.ajax({
                        
                        url : "<?php echo base_url('Installationprocess/mail_sitereadiness_form_two')?>",
                        type: "POST",
                        data: $(this).serialize(),
                        success:function(data){
                            
                            document.getElementById("form_one").submit();
                        }
                        
                        
                    });
                    
                    
                    
                });
                
                
                
            });
            
            
        </script>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        