<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<div class="row">
    <!--  table area --> 
    <div class="col-sm-12"> 

        <div class="panel panel-default thumbnail"> 
       <div class="col-md-12">
           
        <br>
        
        <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                                   <div role="alert" class="alert alert-success">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                           <strong>Well done!</strong>
                                           <?=$this->session->flashdata('SUCCESSMSG')?>
                                   </div>
                           <?php } ?>
                           
                           <br>
        
        <div class="btn-group col-md-1" role="group" aria-label="Button group" style="float: right">
            <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-check-circle"></i>&nbsp;
              
            </button>  
            <div class="dropdown-menu" style="max-height: 400px; overflow: auto; position: absolute; will-change: transform; top: 26px; left: 0px; margin-left: -110px; transform: translate3d(0px, -7px, 0px);" x-placement="top-start">
               <ul style="list-style-type:none;">
                   <li><label><input type="checkbox" onclick="hide_td('th0','tt0')" id="tt0" checked> S.No.</label></li>
                    <li><label><input type="checkbox" onclick="hide_td('th1','tt1')" id="tt1" checked> API Name</label></li>
                    <li><label><input type="checkbox" onclick="hide_td('th2','tt2')" id="tt2" checked> URL</label></li>
               </ul>
            </div>   
            <br>
          </div>
        </div>
        <br>
        
            <div class="panel-body">
                    <div id="exTab3" class="">    
        <ul  class="nav nav-pills">
        
        <!--<li class="active">
        <a  href="#tab-integration" data-toggle="tab">Integration</a>
        </li>
        
        <li>
        <a  href="#tab-templates" data-toggle="tab">Templates</a>
        </li>-->
        
        </ul>
        
        <div class="tab-content clearfix">
        <div class="tab-pane active" id="tab-integration">
            <br>
         <button class="btn btn-sm btn-success" style="float: left" type="button" data-toggle="modal" data-target="#createnewtemplate"><i class="fa fa-plus"></i> &nbsp;Add Mail Signature</button>
        <br>
        <br>
        <form action='' method="post" id="apitable">
    <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1"><input type='checkbox' class="checked_all" value="check all" >&nbsp; <?php echo display('serial') ?></th>
                            <th class="th1">Signature content</th>
                            <th class="th2">Signature logo</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($s_lists as $row){?>
                        <tr  style="cursor:pointer;" data-toggle="modal" data-target="#<?= $row->id ?>">
                            <td class="th0"><input type='checkbox' onclick="event.stopPropagation();"  name='user_status[]' class="checkbox" value='<?=$row->id ?>'>&nbsp; <?= $i++ ?></td>
                            
                            <td class="th1"><?= $row->signature ?></td>
                            <td class="th2"><img src="<?= base_url($row->logo)?>" width="100px" height="100px"></td> 
                            
                        </tr>
                        
                        <!---------------Edit Modal ---------------------->
                        <div id="<?= $row->id?>" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-lg">
                         
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Signature</h4>
                              </div>
                              <div class="modal-body">
                                <!--<form>-->
                                    <?php echo form_open_multipart('dash/updatesignature','class="form-inner"') ?>                      
                                                               
                                   
                                      <div class="row">
                                        
                                       <div class="form-group   col-sm-12">
                                            <label>Signature Content</label>
                                            <textarea name="content" class="form-control tinymce"  placeholder=""  rows="7"><?=$row->signature ?></textarea>
                                            <!--<textarea class="form-control" rows="5" id="comment" name="content"><?=$row->signature ?></textarea>-->
                                            <!--<div id="sample">
                                              <textarea  name="content" style="width: 700px; height: 350px;" class="form-control">
                                                   <?=$row->signature ?>
                                            </textarea>
                                            </div>-->
                                             

                                        </div>
                                       
                                        <!--<div class="form-group   col-sm-6">
                                            <label>Signature logo</label><br>
                                            <img src="<?= base_url($row->logo) ?>" width="100px" height="100px">
                                            <input type="hidden" class="form-control" value="<?= $row->logo ?>" name="old_logo">
                                            <input type="hidden" class="form-control" value="<?= $row->id?>" name="row_id">
                                        
                                        </div>
                                        
                                        <div class="form-group   col-sm-6">
                                            <label>Update logo</label>
                                            <input type="file" name="new_logo" class="form-control">
                                        
                                        
                                        </div>--->
                                        
                                        
                                    
                                        
                                       <!-- <div class="form-group col-sm-6"> 
                                          <label>Template Content</label>
                                          <textarea class="form-control" name="template_content" rowspan="8"></textarea>
                                        </div> -->
                                        
                                        <!--<div class="form-group row col-md-12">
                                            <label for="message" class="col-xs-3 col-form-label"><?php echo display('message') ?> <i class="text-danger">*</i></label>
                                            <div class="col-md-12" style="width:100%;">
                                                <textarea name="template_content" class="form-control tinymce"  placeholder="Enter your message"  rows="12"></textarea>
                                            </div>
                                        </div>-->
                                        
                                        
                                        
                                       </div>          
                                      <div class="col-12" style="padding: 0px;">
                                        <div class="row">              
                                          <div class="col-12" style="text-align:center;">                                                
                                            <button class="btn btn-success" type="submit">Save</button>            
                                          </div>
                                        </div>                                   
                                      </div> 
                                          
                                 
                              </form> 
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                        
                          </div>
                        </div>
                        
                        <?php } ?>
                    </tbody>
                </table> 
        <button class="btn btn-danger" type="button" onclick="return is_delete()" >
                                             <i class="ion-close-circled"></i>
                                                   Delete
                                            </button>
                                      </form>
                                      
                                      
                                      
                                 
                                <!--------------- EDIT API ------------->

        

 <!---------------------------------------------------------------->
     
        </div>
    
        </div>
        </div>

                
     <!-- /.table-responsive -->
                
                

            </div>
         </div>
        
        
        
       
        
    </div>
</div>
<script>


$( "#service" ).click(function() {     
    if($('#another-element:visible').length)
        $('#another-element').hide();
    else
        $('#another-element').show();        
});


$( "#task_create_div" ).click(function() {     
    if($('#task_create:visible').length)
        $('#task_create').hide();
    else
        $('#task_create').show();        
});


</script>


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

 
 <!--------------- ADD NEW Template ------------->

        
<div id="createnewtemplate" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Signature</h4>
      </div>
      <div class="modal-body">
        <!--<form>-->
            <?php echo form_open_multipart('dash/createsignature','class="form-inner" id="email_api"') ?>                      
                                       
           
              <div class="row">
                
                <!--<div class="form-group   col-sm-6">
                    <label>Template Name*</label>
                            
                <input class="form-control" name="template_name" type="text" required="">
                
                </div>
                
                <div class="form-group   col-sm-6">
                    <label>Template Response*</label>
                    
                    <select name="template_response" id="template_response" class="form-control" onchange="Myfunction()" >
                        <option value="1">Normal</option>
                        <option value="2">Auto</option>
                    </select>       
                
                
                </div>
                
                <div class="form-group col-sm-12">
                    
                    <div class="form-group col-sm-6" style="display:none;margin-lef:0px !important" id="auto-div">
                    
                    <label>Auto mail for.</label>
                    
                    <select class="form-control" name="auto_mail_for" id="auto-mail-to">
                        
                        <option value="" style="display:none;">---Select---</option>
                        <option value="1">Enquiry  customer introduction mail</option>
                         <option value="4">Enquiry channel partner introduction mail</option>
                        <option value="2">Customer welcome mail</option>
                        <option value="3">Channel partner welcome mail</option>
                        
                    </select>
                    
                    
                </div>
                
                <div class="form-group col-sm-6 " style="margin-lef:0px !important">
                    
                    <label>Mail subject Line*</label>
                    
                    <input type="text" class="form-control" name="mail-subject" id="mail-subject">
                    
                    
                </div> 
                    
                    
                </div>
            
                
               <!-- <div class="form-group col-sm-6"> 
                  <label>Template Content</label>
                  <textarea class="form-control" name="template_content" rowspan="8"></textarea>
                </div> -->
                
                <!--<div class="form-group row col-md-12">
                    <label for="message" class="col-xs-3 col-form-label"><?php echo display('message') ?> <i class="text-danger">*</i></label>
                    <div class="col-md-12" style="width:100%;">
                        <textarea name="template_content" class="form-control tinymce"  placeholder="Enter your message"  rows="12"></textarea>
                    </div>
                </div>-->
                
                <div class="form-group row col-md-12">
                    <label for="message" class="col-xs-3 col-form-label">Add your signature</label>
                     <textarea name="template_content" class="form-control tinymce"  placeholder=""  rows="7"><?=$row->signature ?></textarea>
                </div>
                
                <div class="form-group row col-md-12">
                    <label for="message" class="col-xs-3 col-form-label">Upload signature logo <i class="text-danger">*</i></label>
                    <div class="col-md-12">
                        
                        <div class="file-upload-wrapper">
                          <input type="file" id="input-file-max-fs" name="file" class="file-upload" data-max-file-size="2M" multiple>
                        </div>
                        
                    </div>
                    
                </div>
                
               </div>          
              <div class="col-12" style="padding: 0px;">
                <div class="row">              
                  <div class="col-12" style="text-align:center;">                                                
                    <button class="btn btn-success" type="submit">Save</button>            
                  </div>
                </div>                                   
              </div> 
                  
         
      </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script src="<?php echo base_url('assets/js/editor/editor.js') ?>"></script>
        
        
 

<script>
    
function hide_td(id,id2){
 var a=   document.getElementById(id2);
 if(a.checked==true){   
  $('.'+id).css('visibility','visible');
$('.'+id).css('display','table-cell');  
  //  document.getElementsByClassName("th1").style.visibility = "hidden";
}else{
    $('.'+id).css('visibility','hidden');
$('.'+id).css('display','none');
    

}
}
    
    
</script>


<script>

$('.checked_all').on('change', function() {     
                $('.checkbox').prop('checked', $(this).prop("checked"));              
        });
        $('.checkbox').change(function(){ 
            if($('.checkbox:checked').length == $('.checkbox').length){
                   $('.checked_all').prop('checked',true);
            }else{
                   $('.checked_all').prop('checked',false);
            }
        });


$('.checked_alltemp').on('change', function() {     
                $('.checkboxtemp').prop('checked', $(this).prop("checked"));              
        });
        $('.checkboxtemp').change(function(){ 
            if($('.checkboxtemp:checked').length == $('.checkboxtemp').length){
                   $('.checked_alltemp').prop('checked',true);
            }else{
                   $('.checked_alltemp').prop('checked',false);
            }
        });
        
        


function is_delete(){
  var x=  confirm('Are you sure want to delete ? ');
  if(x==true){
$.ajax({
type: 'POST',
url: '<?php echo base_url('dash/delete_signature');?>',
data: $('#apitable').serialize()
})
.done(function(data){
alert( "success!" );
location.reload(); 
})
.fail(function() {
alert( "fail!" );

});
}else{
    location.reload(); 
}
}


function is_deleteTemp(){
  var x=  confirm('Are you sure want to delete ? ');
  if(x==true){
$.ajax({
type: 'POST',
url: '<?php echo base_url();?>emailapi/delete_template',
data: $('#temptable').serialize()
})
.done(function(data){
alert( "success!" );
location.reload(); 
})
.fail(function() {
alert( "fail!" );

});
}else{
    location.reload(); 
}
}

</script>

<script>
    
 function Myfunction(){
     
     var v = document.getElementById('template_response').value;
     
     if(v==2){
         
         document.getElementById('auto-div').style.display='block';
         
     }else{
         
         document.getElementById('auto-div').style.display='none';
     }
     
     
 }
    
</script>
</script>
        <script type="text/javascript">
  
           // bkLib.onDomLoaded(function(){ nicEditors.allTextAreas() });
		
        </script>