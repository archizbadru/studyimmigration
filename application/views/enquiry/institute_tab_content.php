
<hr>
<div class="card card-body" style="overflow-y: scroll;">
  <table class="table table-bordered">                          
    <thead>
      <tr>
        <th>
          Institute Name
        </th>
        <?php if ($this->session->companey_id=='67') { ?>
         <th>
          Course Name
        </th>
         <th>
          Program Lavel
        </th>
          <th>
          Program Length
        </th>
         <th>
          Program Discipline
        </th>
        
        <th>
          Tuition Fee
        </th>
     <?php } if ($this->session->companey_id!='67') { ?>
         
         <!-- <th>
          Offer letter fee
        </th> -->

        <th>
          Application URL
        </th>
        
        <th>
          Major
        </th>
        <th>
          Username                                
        </th>
        <th>
          Password
        </th>
     <?php } ?>
        <th>
          App status
        </th>
        <th>
          App Fee
        </th>
     <?php if ($this->session->companey_id!='67') { ?>                              
        <th>
          Transcripts
        </th>
        <th>
          LORs
        </th>
        <th>
          SOP
        </th>
        <th>
          CV                           
        </th>							             
        <th>
          GRE/GMAT
        </th>
        <th>
          TOEFL/IELTS /PTE
        </th>
     <?php } ?>
        <th>
          Remarks
        </th>
        <th>
          Followup Comments
        </th>
        <th>
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (!empty($institute_data)) {
        foreach ($institute_data as $key => $value) { ?>
          <tr>
              <td><?=$value['institute_name']?></td>
            <?php if ($this->session->companey_id=='67') { ?>
              <td><?php echo $value['course_name_str'];?></td>
              <td><?php foreach($level as $lvl){if($lvl->id==$value['p_lvl']){echo $lvl->level;}}?></td>
              <td><?php foreach($length as $lg){if($lg->id==$value['p_length']){echo $lg->length;}}?></td>
              <td><?php foreach($discipline as $dc){if($dc->id==$value['p_disc']){echo $dc->discipline;}}?></td>                                  

              <td><?=$value['t_fee']?></td>
            <?php
            }
            ?>
           <?php if ($this->session->companey_id!='67') { ?>
              <!-- <td><?=$value['ol_fee']?></td>                                     -->
              <td><?=$value['application_url']?></td>
              <td><?=$value['major']?></td>
              <td><?=$value['user_name']?></td>
              <td><?=$value['password']?></td>
           <?php } ?>
              <td><?=$value['app_status_title']?></td>
              <td><?=$value['app_fee']?></td>
           <?php if ($this->session->companey_id!='67') { ?>
              <td><?=$value['transcript']?></td>
              <td><?=$value['lors']?></td>
              <td><?=$value['sop']?></td>
              <td><?=$value['cv']?></td>
              <td><?=$value['gre_gmt']?></td>
              <td><?=$value['toefl']?></td>
           <?php } ?>
              <td><?=$value['remark']?></td>
              <td><?=$value['followup_comment']?></td>
              <td>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_institute(<?=$value['id']?>)"><i class="fa fa-trash" ></i></a>
                <a href="javascript:void(0)" class="btn btn-primary btn-sm " onclick="open_institute_modal(<?=$value['id']?>)"><i class="fa fa-pencil" ></i></a>
              </td>
          </tr>                                
        <?php
        }
      }else{ ?>
        <tr style="text-align: center;">
          <td colspan=16>No record found</td>
        </tr>
        <?php
      }
      ?>
    </tbody>
      
  </table>
</div>


<div class="card card-body">
<?php echo form_open_multipart('enquiry/add_enquery_institute/'.base64_encode($details->Enquery_id),array('class'=>"form-inner",'id'=>'add_institute_form')) ?>                      
<div class="row">                                          
 <div class="form-group col-sm-4"> 
    <label>Institute Name <i class="text-danger">*</i></label>
    <select class="form-control" name='institute_id' id='institute_id' required>
    <option value="">Please Select</option>
<?php
    if(!empty($institute_list)){
      foreach ($institute_list as $key => $value) { ?>
        <option value="<?=$value->institute_id?>"><?=$value->institute_name?></option>
      <?php
      }
    }
    ?>
    </select>                        
 </div>

<?php if ($this->session->companey_id=='67') { ?>

<div class="form-group col-sm-4">                         
    <label><?php echo display('program_discipline')?> </label>                          
    <select name="p_disc" id="p_disc" class="form-control" onchange="">
<option value="">Select</option>
       <?php foreach($discipline as $dc){ ?>                                   
  <option value="<?php echo $dc->id; ?>"><?php echo $dc->discipline; ?></option>
<?php } ?>
</select>							  
    </select>                          
</div>
<div class="form-group col-sm-4">                         
    <label>Program Lavel </label>                          
    <select name="p_lvl" id="p_lvl" class="form-control" onchange="find_level()">
<option value="">Select</option>
       <?php foreach($level as $lc){ ?>                                   
  <option value="<?php echo $lc->id; ?>"><?php echo $lc->level; ?></option>
<?php } ?>							  
    </select>                          
</div>
<div class="form-group col-sm-4">                         
    <label>Program Length </label>                          
    <select name="p_length" id="p_length" class="form-control" onchange="find_app_crs()">

    </select>                          
</div>

<div class="form-group col-sm-4"> 
  
    <label>Select Course </label>                          
    <select name="app_course" id="app_course" class="form-control">
                               
    </select>                          
 </div>

<div class="form-group col-sm-4"> 
    <label>Tuition fee</label>
    <input class="form-control" name="t_fee" type="text" placeholder="Tuition fee" >  
</div>
<!-- <div class="form-group col-sm-4"> 
    <label>Offer letter fee</label>
    <input class="form-control" name="ol_fee" type="text" placeholder="O.letter fee" >  
</div> -->
<?php } ?>					   
<?php if ($this->session->companey_id!='67') { ?>
 <div class="form-group col-sm-4"> 
    <label>Application URL </label>
    <input class="form-control" name="application_url" type="text" placeholder="Application Url" >  
 </div>
 <div class="form-group col-sm-4"> 
    <label>Major </label>
    <input class="form-control" name="major" type="text" placeholder="Major" >  
 </div>

 <div class="form-group col-sm-4"> 
    <label>User Name </label>
    <input class="form-control" name="username" type="text" placeholder="Username" >  
 </div>
                                         
 <div class="form-group col-sm-4"> 
    <label>Password </label>
    <input class="form-control" name="password" type="text" placeholder="Password" >  
 </div>
<?php } ?>
 <div class="form-group col-sm-4"> 
  
    <label>App Status </label>                          
    <select name="app_status" class="form-control" >
    <?php                                                    
    if (!empty($institute_app_status)) {
      foreach ($institute_app_status as $key => $value) {
        ?>
        <option value="<?=$value['id']?>"><?=$value['title']?></option>
        <?php
      }
    }
    ?>                            
    </select>                          
 </div>

 <div class="form-group col-sm-4"> 
    <label>App Fee </label>
    <input class="form-control" name="app_fee" type="text" placeholder="App Fee" >  
 </div>

<?php if ($this->session->companey_id!='67') { ?>

 <div class="form-group col-sm-4"> 
    <label>Transcript </label>
    <input class="form-control" name="transcript" type="text" placeholder="Transcript" >  
 </div>

 <div class="form-group col-sm-4"> 
    <label>LORs </label>
    <input class="form-control" name="lors" type="text" placeholder="Lors" >  
 </div>

 <div class="form-group col-sm-4"> 
    <label>SOP </label>
    <input class="form-control" name="sop" type="text" placeholder="SOP" >  
 </div>

                                       
 <div class="form-group col-sm-4"> 
    <label>CV </label>
    <input class="form-control" name="cv" type="text" placeholder="cv" >  
 </div>

 <div class="form-group col-sm-4"> 
    <label>GRE/GMAT </label>
    <input class="form-control" name="gre_gmt" type="text" placeholder="GRE/GMAT" >  
 </div>

 <div class="form-group col-sm-4"> 
    <label>TOEFL/IELTS/PTS </label>
    <input class="form-control" name="tofel_ielts_pts" type="text" placeholder="TOEFL/IELTS/PTS" >  
 </div>
<?php } ?>

                                        
 <div class="form-group col-sm-4"> 
    <label>Remarks </label>
    <textarea class="form-control" placeholder="Remark" name="remark"></textarea>
 </div>

 <div class="form-group col-sm-4"> 
    <label>Followup Comments </label>
    <textarea class="form-control" placeholder="Followup comments" name="followup_comment"></textarea>
 </div>

<?php if ($this->session->companey_id!='67') { ?>                        
 <div class="form-group col-sm-4"> 
    <label>Reference No </label>
    <input class="form-control" name="reference_no" type="text" placeholder="Reference No" >  
 </div>
                                     
 <div class="form-group col-sm-4"> 
    <label>Courier Status </label>
    <input class="form-control" name="courier_status" type="text" placeholder="Courier Status" >  
 </div>
<?php } ?>
</div>                                     
 <br>
     <div class=""  id="save_button">                                                
        <div class="col-md-12">                                                
              <button class="btn btn-primary" type="submit" >Save</button>            
        </div>
      </div>
 </form>
</div>                                                
<script type="text/javascript">
    // this is the id of the form 
$("#add_institute_form").submit(function(e) {
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