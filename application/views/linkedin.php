
<div class="row">
    <!--  table area --> 
    <div class="col-sm-12"> 
<br>
        <div class="panel panel-default thumbnail"> 
       <div class="col-md-12">
          
        <br>
        
        <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                                   <div role="alert" class="alert alert-success">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                           <strong></strong>
                                           <?=$this->session->flashdata('SUCCESSMSG')?>
                                   </div>
                           <?php } ?>
                           
                           <br>
       
        
        </div>
        <br>
        
            <div class="panel-body">
                <div class="col-sm-12">
                    <button class="btn btn-sm btn-success" style="float: left" type="button" data-toggle="modal" data-target="#createnewintegration"><i class="fa fa-plus"></i> <?php echo display('add_new_integration');?></button>
                    
                </div>	
		<br><br>
	
	<table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1">&nbsp; <?php echo display('serial') ?></th>
                            <th class="th1"><?php echo display('integration_name');?></th>
                            <th class="th2"><?php echo display('source');?></th>
                            <th class="th3"><?php echo display('assign_to');?></th>
                            <th><?php echo display('action');?></th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($web_intergrationlist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($web_intergrationlist as $list) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="cursor:pointer;">
                                    <td class="th0">&nbsp; <?php echo $sl;?></td>
                                    
                                    <td class="th1"><?php echo $list->p_integration_name; ?></td>
                                    <td class="th2"><?php echo $list->p_source; ?></td> 
                                    <td class="th3"><?php echo $list->p_assignto; ?></td> 
                                    <td class="center">
                                        <!--<a  class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#Editsource<?php echo $list->wid;?>"><i class="fa fa-edit"></i></a> -->
                                        <a href="<?php echo base_url("configurations/delete_portalintegration/$list->portal_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                                
                                 <!--------------- ADD NEW API ------------->

        
                             
                                
                                
                                
                                
                                
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table> 
		
	
                                      
                                      
                                   
		
				
	 <!-- /.table-responsive -->
                
                

            </div>
        
        
        
        </div>
        
        
        
       
        
    </div>
</div>



<style>


#exTab3 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
  background-color: #f1f3f6;
  padding : 5px 15px;
}

.nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
    color: white;
    background-color: #37a000;
}

.nav-pills > li > a {
    border-radius: 5px;
    padding: 10px;
    color: #000;
    font-weight: 600;
}

.nav-pills > li > a:hover {
    color: #000;
    background-color: transparent;
}


    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

</style>

<!--------------- ADD NEW CLIENT ------------->

        
<div id="createnewintegration" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Use our linkedin integration link to capture enquiries, to create your link provide information below</h4>
      </div>
      <div class="modal-body">
        <!--<form>-->
            <?php echo form_open_multipart('configurations/createportalintegration','class="form-inner"') ?>                      
                                       
           
              <div class="row">
                
                <div class="form-group   col-sm-6">
                    <input type="hidden" name="portal_type" value="3">
                     <label><?php echo display('integration_name');?>*</label>
                            
                <input class="form-control" name="integration_name" type="text" id="IntegrationName" onkeyup="addNameToSource()" required=""> 
                
                </div>  
            
                <div class="form-group  col-sm-6">
                    <label><?php echo display('source');?>*</label>
                    <input type="text" name="source_name" id="Source" class="form-control" value="" readonly>
                </div>
                
                
                <div class="form-group col-sm-6"> 
                  <label><?php echo display('assign_to');?>*</label>
                   <select class="form-control br_25  m-0 icon_left_input" name="assign" id="fstate" >
                                                  <?php  foreach($user_list as $row){ ?>
                                                  <option value="<?php echo $row->pk_i_admin_id; ?>" ><?php echo $row->s_display_name.' '.$row->last_name; ?></option>
                                                  <?php } ?>
                                                  </select> 
                  <!--<input class="form-control" name="assign" type="text" required="">-->  
                </div> 
                
               
              </div>          
              <div class="col-12" style="padding: 0px;">
                <div class="row">              
                  <div class="col-12" style="text-align:center;">                                                
                    <button class="btn btn-success" type="submit"><?php echo display('save');?></button>            
                  </div>
                </div>                                   
              </div> 
                  
         
      </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo display('close');?></button>
      </div>
    </div>

  </div>
</div>
<!---------------------------------------------------------------->
 
<script>
function addNameToSource()
{
    //document.getElementById('Source').value = "Website - "+document.getElementById('IntegrationName').value;
document.getElementById('Source').value = document.getElementById('IntegrationName').value;
}


</script>


