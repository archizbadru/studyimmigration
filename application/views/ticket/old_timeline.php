<link rel="stylesheet" type="text/css" href="<?=base_url().'assets/css/activity_timeline.css'?>">
<div class="col-md-3 col-height">
	<h3 class="text-center">Activity Timeline</h3><hr>
  	<ul class="cbp_tmtimeline" style="margin-left:-30px;">
      <?php
	  if(!empty($conversion)){		
      foreach($conversion as $cnv){ ?>
        <li>
          <div class="cbp_tmicon cbp_tmicon-phone" style="background:#cb4335;"></div>
          <div class="cbp_tmlabel"  style="background:#95a5a6;">
            <span style="font-weight:900;font-size:15px;"><?php echo $cnv->subj; ?></span><br>
            <?php
            if (!empty($cnv->lead_stage_name)) { ?>
              <br><span style="font-weight:900;font-size:12px;">Stage - </span>  <span style="font-weight:900;font-size:12px;"><?php echo $cnv->lead_stage_name; ?></span>
              <?php
            }
            if (!empty($cnv->sub_stage)) { ?>
              <br><span style="font-weight:900;font-size:12px;">Sub Stage - </span><span style="font-weight:900;font-size:12px;"><?php echo $cnv->sub_stage; ?></span><br>
              <?php
            }
            if (!empty($cnv->msg)) { ?>
            <span style="font-weight:900;font-size:12px;">Remark - </span><span style="font-weight:900;font-size:12px;"><?php echo $cnv->msg; ?></span>               
              <?php
            }
            ?>
            <p><?php echo date("j-M-Y h:i:s a",strtotime($cnv->send_date)); ?><br>
           </p>
          </div>
        </li>
        <?php } 
      }
      ?>              
    </ul>
</div>


 		</div>
	</div>
</div>




<div id="sendsms<?php echo $enquiry->enquiry_id ?>" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <?php echo form_open_multipart('message/send_sms','class="form-inner" id="whatsaap"') ?>
      <div class="modal-content card">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="modal-titlesms"></h4>
         </div>
         <div>
            <div class="form-group col-sm-12">
               <label>Template</label>
               <select class="form-control" name="templates" required id="templates"  onchange="getMessage(),this.form.reset();">
               </select>
            </div>
            <div class="form-group col-sm-12">
               <label><?php echo display('subject') ?></label>
               <input type="text" name="email_subject" class="form-control" id="email_subject">
               <label><?php echo display('message') ?></label>
               <textarea class="form-control summernote" name="message_name"  rows="10" id="template_message"></textarea>  
            </div>
         </div>
         <div class="col-md-12">
            <input type="hidden"  id="mesge_type" name="mesge_type">
            <input type="hidden" id="mobile" name="mobile" value="<?php echo $enquiry->phone ?>">
            <input type="hidden" id="mail" name="mail" value="<?php echo $enquiry->email ?>">
            <button class="btn btn-primary" onclick="send_sms()" type="button">Send</button>            
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
      </form>
   </div>
</div>



<script type="text/javascript">
	function getTemplates(SMS,type){       
    if(type != 'Send Email'){
      $("#email_subject").hide();
      $("#email_subject").prev().hide();
    }else{
      $("#email_subject").show();
      $("#email_subject").prev().show();
    }
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>message/get_templates/'+SMS,
   })
   .done(function(data){
       $('#modal-titlesms').html(type);
       $('#mesge_type').val(SMS);       
       $('#templates').html(data);
   })
   .fail(function() {
   alert( "fail!" );   
   });
   } 
   function  send_sms(){   
     var sms_type = $("#mesge_type").val();
      if ("<?=$this->session->companey_id?>" == 81 && sms_type!=1) {
        url =  '<?php echo base_url();?>message/send_sms_career_ex';
      }else{
       url =  '<?php echo base_url();?>message/send_sms';
      }    
       $.ajax({            
           type: 'POST',
           url: url,
           data: $('#whatsaap').serialize()
           })
           .done(function(data){               
              //console.log(data);
               alert(data);
               location.reload();
           })
           .fail(function() {
           alert( "fail!" );       
       });     
       }

    function getMessage(){           
     var tmpl_id = document.getElementById('templates').value;           
     $.ajax({               
         url : '<?php echo base_url('enquiry/msg_templates') ?>',
         type: 'POST',
         data: {tmpl_id:tmpl_id},
         success:function(data){
             var obj = JSON.parse(data);
              $('#templates option[value='+tmpl_id+']').attr("selected", "selected");
              $(".summernote").summernote("code", obj.template_content);
              $("#email_subject").val(obj.mail_subject);
             //$("#template_message").html(obj.template_content);
         }               
     });        
    } 
     function find_description() { 
        var l_stage = $("#lead_stage_change").val();
        $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>lead/select_des_by_stage',
        data: {lead_stage:l_stage},            
        success:function(data){
            var html='';
            var obj = JSON.parse(data);                
            html +='<option value="">---Select---</option>';            
            for(var i=0; i <(obj.length); i++){                    
              html +='<option value="'+(obj[i].id)+'">'+(obj[i].description)+'</option>';
            }                
            $("#lead_description").html(html);                
        }
        });
       }

            
</script>

