<style type="text/css">
  .blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
</style>
<div class="tab-pane <?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='agreement'){ echo 'active';}};?>" id="aggrement_new">
  <div class="content-panel">

<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<link href="<?php echo base_url(); ?>assets/summernote/summernote-bs4.css" rel="stylesheet" />
<div class="row">
   <!--  table area --> 
   <div class="col-sm-12">
      <div class="">
         <br>
         <div class="">
               <div class="tab-content clearfix">                  
                  <div class="tab-pane active" id="tab-templates">
                     <br>
                    <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
                     <button class="btn btn-sm btn-success" style="float: left" type="button" data-toggle="modal" data-target="#createnewtemplate"><i class="fa fa-plus"></i> Make An Agreement</button>
                     &nbsp;&nbsp;&nbsp;
                     <img src='<?= base_url('assets/images/loader_blue.gif'); ?>' width='30px' height='30px' id="loader11" style="display: none;">
                    <?php } ?>
                     <br>
                     <br>
                     <form   action='' method="post" id="temptable">
                     <div style="overflow-x: scroll;">
                        <table width="100%" class="datatable table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <!-- <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1"><input type='checkbox' class="checked_alltemp" value="check all" >&nbsp; <?php echo display('serial') ?></th> -->
                                 <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1"></th>
                                 <th nowrap>Agreement Name</th>
								                 <th nowrap>Applicant Name</th>
								                 <th nowrap>Applicant Sign</th>
                                 <th nowrap>Signed Agreement</th>
								                 <th nowrap>Remark</th>
                                 <th nowrap>Agreement Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if (!empty($all_template)) { ?>
                              <?php $sl = 1; ?>
                              <?php foreach ($all_template as $tlist) { ?>
                              <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="cursor:pointer;">
                                 <!-- <td class="th0"><input type='checkbox' onclick="event.stopPropagation();" name='sel_temp[]' class="checkboxtemp" value="<?php echo $tlist->id;?>">&nbsp; <?php echo $sl;?></td> -->
                                 <td class="th0">&nbsp; <?php echo $sl;?></td>
                                 <td class="th1"><?php echo $tlist->template_name; ?></td>
								 <td class="th1"><?php echo $tlist->applicant_name; ?></td>
                 
								 <td class="th1">
                <?php if(!empty($tlist->applicant_sign)){ ?>
                  <a href="<?php echo 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/'.$this->session->awsfolder.'/'.$tlist->applicant_sign; ?>" target="_blank" class="titlehover" data-title="Sign"><i class="fa fa-file" aria-hidden="true"></i></a>
                <?php } ?>
                </td>
                
                 <td class="th2">
                <?php if(!empty($tlist->signed_file)){ ?>
                  <a href="<?php echo 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/'.$this->session->awsfolder.'/'.$tlist->signed_file; ?>" target="_blank" class="titlehover" data-title="Signed File"><i class="fa fa-file" aria-hidden="true"></i></a>
                <?php } ?>
                </td>

                <td class="th1"><?php echo $tlist->a_remark; ?></td>
               
								 <td class="th2">
                <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
                  <?php if(in_array(700,$module) || in_array(701,$module) || in_array(702,$module)){ ?>
                    <?php if(!empty($tlist->approve_by)){ if($tlist->approve_by==$this->session->user_id){ ?>
								 <a class="titlehover" data-title="Edit" href="#!" data-toggle="modal" data-target="#createnewtemplate<?php echo $tlist->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php }} ?>
                <?php } ?>
                <?php if(in_array(690,$module) || in_array(691,$module) || in_array(692,$module)){ ?>
                 <a class="titlehover" data-title="Approved" href="<?php echo base_url('lead/client_agreement_approve/'.$tlist->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1)); ?>"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;

                 <a class="titlehover" data-title="Sent Mail" href="javascript:void(0)" onclick="email_aggrement(<?php echo $tlist->id; ?>)"><i class="fa fa-envelope" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;

                 <a class="titlehover" data-title="Sent SMS" href="javascript:void(0)" onclick="sms_aggrement(<?php echo $tlist->id; ?>)"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;

                 <!-- <a class="titlehover" data-title="Sent Mail" href="<?php echo base_url('lead/generate_aggrement_for_mail/'.$tlist->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1)); ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; -->
               <?php } ?>
                <?php } ?>
                <a class="titlehover" data-title="Upload" href="#!" data-toggle="modal" data-target="#uploadfinal<?php echo $tlist->id;?>"><i class="fa fa-upload" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <!--<a class="titlehover" data-title="Raise Ticket" href="#!" data-toggle="modal" data-target="#raiseticket<?php echo $tlist->id;?>"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;-->
								<a class="titlehover" data-title="Genarate Pdf" href="<?php echo base_url('lead/generate_client_aggrement/'.$tlist->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1)); ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <!--<?php if(!empty($ticket_list)){ ?>
                <span class="blink_me"><i class="fa fa-flag" aria-hidden="true" style="color:red;font-size: 16px;"></i></span>
                <?php } ?>-->
								 </td>
                              </tr>
                              <?php $sl++; ?>
                              <?php } ?> 
                              <?php } ?> 
                           </tbody>
                        </table>
                     </div>
                        <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
                       <!--  <button class="btn btn-danger" type="button" onclick="return is_deleteTemp()" >
                        <i class="ion-close-circled"></i>
                        Delete
                        </button> -->
                      <?php } ?>
                     </form>
                     <?php foreach ($all_template as $tlist) { ?>
                     <div id="createnewtemplate<?php echo $tlist->id;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Edit Agreement <?php echo $tlist->template_name; ?></h4>
                              </div>
                              <div class="modal-body">
                                 <?php echo form_open_multipart('lead/client_details_update/'.$this->uri->segment(3).'/'.$this->uri->segment(1),'class="form-inner"') ?>                      
                                 <div class="row">
                                    <input type="hidden" name="template_id" value="<?php echo $tlist->id; ?>">
                                    <div class="form-group   col-sm-12" style="display:none;">
                                       <label>Agreement Name</label>
                                       <select class="form-control" name="content_id">
                                        <option value="">---Select---</option>
						                   <?php foreach($all_tempname as $formatname){ ?>
                                        <option value="<?php echo $formatname->id; ?>" <?php if($formatname->id==$tlist->agreement_name){ echo 'selected';} ?>><?php echo $formatname->template_name; ?></option>
						                    <?php } ?>
                                       </select>
                                    </div>
									
									<div class="col-md-6">
                                       <label>Applicant Name<i class="text-danger"></i></label>
                                       <input type="text" class="form-control" placeholder="Applicant Name" name="applicant_name" value="<?php echo $tlist->applicant_name; ?>" required>
                                    </div>
			   
			                        <div class="col-md-6">
                                          <label>Applicant Sign<i class="text-danger"></i></label>
                                          <input type="file" class="form-control" placeholder="Applicant Name" name="applicant_sign">
										  <input type="hidden" class="form-control" placeholder="Applicant Name" name="applicant_sign_old" value="<?php echo $tlist->applicant_sign; ?>">
                                    </div>
									
                                    <div class="form-group col-sm-12">
                                       <label>Agreement Content</label>
                                       <textarea name="agreement_content" class="form-control summernote"   rows="7"><?php echo $tlist->agreement_content; ?></textarea>
                                    </div>

                                  <div class="form-group col-md-5">
                                          <label>Remark</label>
                                          <textarea class="form-control" name="a_remark" value="<?php echo $tlist->a_remark; ?>"><?php echo $tlist->a_remark; ?></textarea>
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

<!-------------------------------------upload final pdf------------------------------------------------>
<div id="uploadfinal<?php echo $tlist->id;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Upload Final <?php echo $tlist->template_name; ?></h4>
                              </div>
                              <div class="modal-body">
                                 <?php echo form_open_multipart('lead/client_final_upload/'.$this->uri->segment(3).'/'.$this->uri->segment(1),'class="form-inner"') ?>                      
                                 <div class="row">
                                    <input type="hidden" name="template_id" value="<?php echo $tlist->id; ?>">
                                    <div class="col-md-12">
                                        <label>Signed Agreement<i class="text-danger"></i></label>
                                        <input type="file" class="form-control" placeholder="Signed Agreement" name="signed_file">
                                        <input type="hidden" class="form-control" placeholder="Signed Agreement" name="signed_file_old" value="<?php echo $tlist->signed_file; ?>">
                                    </div>
                                 </div>
                                 <div class="col-12" style="padding: 10px;">
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
<!-------------------------------------upload final pdf end-------------------------------------------->

<!-------------------------------------Raise Ticket start------------------------------------------------>
<div id="raiseticket<?php echo $tlist->id;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Raise Ticket For <?php echo $tlist->template_name; ?></h4>
                              </div>
                              <div class="modal-body">
                                 <?php echo form_open_multipart('lead/ticket_client_agreement/'.$this->uri->segment(3).'/'.$this->uri->segment(1),'class="form-inner"') ?>                      
                                 <div class="row">
                                    <input type="hidden" name="template_id" value="<?php echo $tlist->id; ?>">
                                    <div class="col-md-12">
                                        <label>Write Here!<i class="text-danger"></i></label>
                                        <textarea type="file" class="form-control" placeholder="Ticket content" name="tkt_content"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-12" style="padding: 10px;">
                                    <div class="row">
                                       <div class="col-12" style="text-align:center;">                                                
                                          <button class="btn btn-success" type="submit">Send</button>            
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
<!-------------------------------------Raise Ticket end-------------------------------------------->                    

                     <?php } ?>
                  </div>
               </div>
            <!-- /.table-responsive -->
         </div>
      </div>
   </div>
</div>

<!--------------- ADD NEW Template ------------->
<div id="createnewtemplate" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Template</h4>
         </div>
         <div class="modal-body">
            <!--<form>-->
            <?php echo form_open_multipart('lead/client_agreement_save/'.$this->uri->segment(3).'/'.$this->uri->segment(1),'class="form-inner" id="client_agreement"') ?>                      
            <div class="row">

               <div class="form-group col-sm-12">
			               <input type="hidden" name="enq_id" value="<?php echo $this->uri->segment(3); ?>">
                     <label>Agreement Name</label>
                     <select class="form-control" name="content_id" id="content_id" onchange="find_content()">
                        <option value="">---Select---</option>
						<?php foreach($all_tempname as $formatname){ ?>
                        <option value="<?php echo $formatname->id; ?>"><?php echo $formatname->template_name; ?></option>
						<?php } ?>
                     </select>
               </div>
			   
			   <div class="col-md-6">
                    <label>Applicant Name<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="Applicant Name" name="applicant_name" required>
               </div>
			   
			   <div class="col-md-6">
                    <label>Applicant Sign<i class="text-danger"></i></label>
                    <input type="file" class="form-control" placeholder="Applicant Name" name="applicant_sign">
               </div>
			   
               <div class="form-group row col-md-12" id="content_form">
                  
               </div>

               <div class="form-group col-md-5">
                  <label>Remark</label>
                  <textarea class="form-control" name="a_remark"></textarea>
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
</div>
<script src="<?php echo base_url('assets/js/editor/editor.js') ?>"></script>

<script>   
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
   
function email_aggrement(aggid){
$("#loader11").show();
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>lead/generate_aggrement_for_mail/'+btoa(aggid),
   })
   .done(function(data){
$("#loader11").hide();
if(data!=0){
$("#agg_elink").click();
$("input[name='aggurl']").val(data);
$("#link_hint").html('Note:- Please put @link anotation in content where you want to send Link!');
}
   })
}

function sms_aggrement(aggid){
$("#loader11").show();
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>lead/generate_aggrement_for_mail/'+btoa(aggid),
   })
   .done(function(data){
$("#loader11").hide();
if(data!=0){
$("#agg_slink").click();
$("input[name='aggurl']").val(data);
$("#link_hint").html('Note:- Please put @link anotation in content where you want to send Link!');
}
   })
}

function is_deleteTemp(){  
     var x=  confirm('Are you sure want to delete ? ');
     if(x==true){  
   $.ajax({   
   type: 'POST',  
   url: '<?php echo base_url();?>lead/delete_client_agreement',   
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
   
 function find_content() { 
            var c_id = $("#content_id").val();
			//alert(c_id);
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_content_by_id',
            data: {content_id:c_id},           
            success:function(data){                
                $("#content_form").html(data);                
            }            
            });

    }  
   
</script>
<script src="<?=base_url()?>/assets/summernote/summernote-bs4.min.js"></script>
<link href="<?=base_url()?>/assets/summernote/summernote-bs4.css" rel="stylesheet" />
<script>
   jQuery(document).ready(function(){
   
       $('.summernote').summernote({
   
           height: 200,                 // set editor height
   
           minHeight: null,             // set minimum height of editor
   
           maxHeight: null,             // set maximum height of editor
   
           focus: false                 // set focus to editable area after initializing summernote
   
       });
   
   });
   
</script>

</div>