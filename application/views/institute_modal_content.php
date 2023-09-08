<div class="card card-body">
  <?php echo form_open_multipart('enquiry/add_enquery_institute/'.base64_encode($Enquiry_id),array('class'=>"form-inner",'id'=>'update_institute_form')) ?>        
  <input type="hidden" name="enq_institute_id" value="<?=$institute_data['id']?>">              
    <div class="row">                                          
                         <div class="form-group col-sm-4"> 
                          <label>Institute Name <i class="text-danger">*</i></label>
                          <select class="form-control" name='institute_id' id='institute_id1' required>
                          <option value="">Please Select</option>
						  <?php
                          if(!empty($institute_list)){
                            foreach ($institute_list as $key => $value) { ?>
                              <option value="<?=$value->institute_id;?>" <?php if($value->institute_id==$institute_data['institute_id']){ echo 'selected';}?>><?=$value->institute_name?></option>
                            <?php
                            }
                          }
                          ?>
                          </select>                        
                       </div>
 
<?php if ($this->session->companey_id=='67') { ?>

<div class="form-group col-sm-4">                         
                          <label><?php echo display('program_discipline')?> </label>                          
                          <select name="p_disc" id="p_disc1" class="form-control" onchange="">
						      <option value="">Select</option>
                             <?php foreach($discipline as $dc){ ?>                                   
                        <option value="<?php echo $dc->id; ?>" <?php if($dc->id==$institute_data['p_disc']){ echo 'selected';}?>><?php echo $dc->discipline; ?></option>
                    <?php } ?>
                    </select>							  
                          </select>                          
</div>
<div class="form-group col-sm-4">                         
                          <label>Program Lavel </label>                          
                          <select name="p_lvl" id="p_lvl1" class="form-control" onchange="find_level1()">
						              <option value="">Select</option>
                             <?php foreach($level as $lc){ ?>                                   
                            <option value="<?php echo $lc->id; ?>" <?php if($lc->id==$institute_data['p_lvl']){ echo 'selected';}?> ><?php echo $lc->level; ?></option>
                          <?php } ?>							  
                          </select>                          
</div>
<div class="form-group col-sm-4">                         
                          <label>Program Length </label>                          
                          <select name="p_length" id="p_length1" class="form-control" onchange="find_app_crs1()">
							  
                          </select>                          
</div>

<div class="form-group col-sm-4"> 
                        
                          <label>Select Course </label>                          
                          <select name="app_course" id="app_course1" class="form-control">
                                                     
                          </select>                          
                       </div>
<div class="form-group col-sm-4"> 
                          <label>Tuition fee</label>
                          <input class="form-control" name="t_fee" value="<?=$institute_data['t_fee']?>" type="text" placeholder="Tuition fee" >  
</div>
<?php } 
?>

<?php if ($this->session->companey_id!='67') { ?>

<div class="form-group col-sm-4"> 
                          <label>Offer letter fee</label>
                          <input class="form-control" name="ol_fee" type="text" value="<?=$institute_data['ol_fee']?>" placeholder="O.letter fee" >  
</div>
     <div class="form-group col-sm-4"> 
        <label>Application URL </label>
        <input class="form-control" name="application_url" type="text" placeholder="Application Url" value="<?=$institute_data['application_url']?>">  
     </div>
     <div class="form-group col-sm-4"> 
        <label>Major </label>
        <input class="form-control" name="major" type="text" placeholder="Major" value="<?=$institute_data['major']?>">  
     </div>
    </div>
    <div class="row">                                          
     <div class="form-group col-sm-4"> 
        <label>User Name </label>
        <input class="form-control" name="username" type="text" placeholder="Username" value="<?=$institute_data['user_name']?>">  
     </div>
                                             
     <div class="form-group col-sm-4"> 
        <label>Password </label>
        <input class="form-control" name="password" type="text" placeholder="Password" value="<?=$institute_data['password']?>">  
     </div>
<?php } ?>
     <div class="form-group col-sm-4"> 
      <?php
      //var_dump($institute_app_status);
      ?>
        <label>App Status </label>                          
        <select name="app_status" class="form-control" >
        <?php                                                    
        if (!empty($institute_app_status)) {
          foreach ($institute_app_status as $key => $value) {
            ?>
            <option value="<?=$value['id']?>" <?php if($institute_data['app_status'] == $value['id']) echo "selected";?>><?=$value['title']?></option>
            <?php
          }
        }
        ?>                            
        </select>                          
     </div>
   </div>
   <div class="row">
     <div class="form-group col-sm-4"> 
        <label>App Fee </label>
        <input class="form-control" name="app_fee" type="text" placeholder="App Fee" value="<?=$institute_data['app_fee']?>">  
     </div>
    
<?php if ($this->session->companey_id!='67') { ?>
    
     <div class="form-group col-sm-4"> 
        <label>Transcript </label>
        <input class="form-control" name="transcript" type="text" placeholder="Transcript" value="<?=$institute_data['transcript']?>">  
     </div>

     <div class="form-group col-sm-4"> 
        <label>LORs </label>
        <input class="form-control" name="lors" type="text" placeholder="Lors" value="<?=$institute_data['lors']?>">  
     </div>
    </div>
    <div class="row">
     <div class="form-group col-sm-4"> 
        <label>SOP </label>
        <input class="form-control" name="sop" type="text" placeholder="SOP" value="<?=$institute_data['sop']?>">  
     </div>

                                           
     <div class="form-group col-sm-4"> 
        <label>CV </label>
        <input class="form-control" name="cv" type="text" placeholder="cv" value="<?=$institute_data['cv']?>">  
     </div>
     <div class="form-group col-sm-4"> 
        <label>GRE/GMAT </label>
        <input class="form-control" name="gre_gmt" type="text" placeholder="GRE/GMAT" value="<?=$institute_data['gre_gmt']?>">  
     </div>
    </div>
    <div class="row">
     <div class="form-group col-sm-4"> 
        <label>TOEFL/IELTS/PTS </label>
        <input class="form-control" name="tofel_ielts_pts" type="text" placeholder="TOEFL/IELTS/PTS" value="<?=$institute_data['toefl']?>">  
     </div>
<?php } ?>

                                            
     <div class="form-group col-sm-4"> 
        <label>Remarks </label>
        <textarea class="form-control" placeholder="Remark" name="remark"><?=$institute_data['remark']?></textarea>
     </div>

     <div class="form-group col-sm-4"> 
        <label>Followup Comments </label>
        <textarea class="form-control" placeholder="Followup comments" name="followup_comment"><?=$institute_data['followup_comment']?></textarea>
     </div>
   </div>
<?php if ($this->session->companey_id!='67') { ?> 
   <div class="row">
    
     <div class="form-group col-sm-4"> 
        <label>Reference No </label>
        <input class="form-control" name="reference_no" type="text" placeholder="Reference No" value="<?=$institute_data['ref_no']?>">  
     </div>
    


                                            
     <div class="form-group col-sm-4"> 
        <label>Courier Status </label>
        <input class="form-control" name="courier_status" type="text" placeholder="Courier Status" value="<?=$institute_data['courier_status']?>">  
     </div>
   </div> 
<?php } ?>   
     <br>
         <div class=""  id="save_button">                                                
            <div class="col-md-12">                                                
                  <button class="btn btn-primary" type="submit" >Save</button>            
            </div>
          </div>
     </form>
  </div>

  <script type="text/javascript">
    $("#update_institute_form").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
      $.ajax({
         type: "POST",
         url: url,
         data: form.serialize(), // serializes the form's elements.
         success: function(data)
         {              
            data = JSON.parse(data);
            alert(data.msg);
            if(data.status == true){
              window.location.reload();
            }
         }
       });
  });
  </script>
<script>    
$(document).ajaxStop(function() {
  find_app_crs1();
});
function find_app_crs1() { 
      var c_stage = $("#institute_id1").val();
			var l_stage = $("#p_lvl1").val();
			var lg_stage = $("#p_length1").val();
			var d_stage = $("#p_disc1").val();			
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_app_by_ins',
            data: {c_course:c_stage,c_lvl:l_stage,c_length:lg_stage,c_disc:d_stage},
            success:function(data){               
                var html='';
                var obj = JSON.parse(data);                
                var crs  = "<?=$institute_data['course_id']?>";                
                html +='<option value="" style="display:none">---Select---</option>';
                for(var i=0; i <(obj.length); i++){                    
                    sel  = (crs==obj[i].crs_id)?"selected":"";
                    html +='<option '+sel+' value="'+(obj[i].crs_id)+'">'+(obj[i].course_name_str)+'</option>';
                }                
                $("#app_course1").html(html);                
            }            
            });

    }

</script>
<script>
  find_level1();
function find_level1() { 

            var l_stage = $("#p_lvl1").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_length_lvl',
            data: {lead_stage:l_stage},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);

                var length  = "<?=$institute_data['p_length']?>";
                
                html +='<option value="" style="display:none">---Select length---</option>';
                for(var i=0; i <(obj.length); i++){
                    sel  = (length==obj[i].id)?"selected":"";
                    html +='<option '+sel+' value="'+(obj[i].id)+'">'+(obj[i].length)+'</option>';
                }
                
                $("#p_length1").html(html);
                
            }
            
            
            });

            }	  
</script>