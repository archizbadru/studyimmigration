                <div class="tab-pane <?php if(empty($this->uri->segment(4))){ echo 'active';};?>" id="profile">
                <div class="content-panel">
<!--------------------------------------------------------Stage list------------------------------------------->
<style>
  .pills{
    background: #51b78c;
  }

  .pills:after {
     content: "";
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid #51b78c;
    position: absolute;
    right: -15px;
    top: 0;
    z-index: 1;
}
  .opills{
    background: #F3F5FA;
  }

  .opills:after {
     content: "";
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid #F3F5FA;
    position: absolute;
    right: -15px;
    top: 0;
    z-index: 1;
}
</style>
                    <div class="content-utilities">
                        <?php
$stage_pipeline  = get_sys_parameter('stage_pipeline','COMPANY_SETTING');
if(!empty($stage_pipeline) && $stage_pipeline=='1')
{
?>
<div class="row">
  <div class="col-lg-12 ">
    <div id="crumbs">
    <ul  style="padding-bottom: 50px;">
    <?php
      if(!empty($all_estage_lists))
      {
        foreach ($all_estage_lists as $stage) 
        { 
          echo '<li class="top_pill" data-stage-id="'.$stage->stg_id.'"><a '.(($stage->stg_id==$current_stage)?"class='pills'":"class='opills'").'>'.$stage->lead_stage_name.'</a></li>';
        }
                
      }
    ?>  

    </ul></div>

<?php
if(!empty($_GET['desposition']))
{
  echo'<script>
  $(document).ready(function(){
         setTimeout(call_to_disposition,1000);
    });

  function call_to_disposition()
  {
    var x = $("li[data-stage-id=\''.$_GET['desposition'].'\'");
       try{
        $(x[0]).trigger("click");
        }catch(e){alert(e);}
  }

  </script>';
}
?> 
   <style type="text/css">   
#crumbs {
  text-align: center;
}

#crumbs ul {
  margin: 0;
  padding: 0; 
  list-style: none;
  display: inline-block;
  height: 40px!important;
  white-space: nowrap;
  overflow-x: auto;
  overflow-y: hidden;
  width: 100%;
}
#crumbs ul li {
  display: inline-block;
  white-space: nowrap;
}
#crumbs ul li a {
display: block;
    float: left;
    height: 30px;
    /*background: #F3F5FA;*/
    text-align: center;
    padding: 6px 10px 0 30px;
    position: relative;
    margin: 0 10px 0 0;
    font-size: 12px;
    text-decoration: none;
    color: #32373c;
    cursor: pointer;
}
#crumbs ul li a:after {
     content: "";
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
   /* border-left: 15px solid #F3F5FA;*/
    position: absolute;
    right: -15px;
    top: 0;
    z-index: 1;
}
#crumbs ul li a:before {
    content: "";
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid #fff;
    position: absolute;
    left: 0px;
    top: 0;
}

/*#crumbs ul li:first-child a {
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}*/

/*#crumbs ul li:first-child a:before {
  display: none;
}
*/
/*#crumbs ul li:last-child a {
  padding-right: 40px;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
}

#crumbs ul li:last-child a:after {
  display: none;
}*/

#crumbs ul li a:hover {
  background: #357DFD;
  border-left-color: #357DFD;
  color: #fff;
}

#crumbs ul li a:hover:after {
  border-left-color: #357DFD;
  color: #fff;
}
#crumbs ul li.top-active a:after
{
  border-left-color: #357DFD;
  color: #fff;
}
#crumbs ul li.top-active a{
  background: #357DFD;
  font-weight: 700;
  color: #fff;
}
   </style>
  
  </div>
</div>

<?php
}
?>
                    </div>
            <!--------------------------------------------------------Stage list------------------------------------------->       
                    <div class="drive-wrapper drive-grid-view">
                        <div class="grid-items-wrapper">
                            <div class="module text-center col-md-6">
                                <div class="user-info">
                                  <ul class="meta list list-unstyled">
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Full Name :</span><span style="float:right;"> <?php echo $student_Details['name'].' '.$student_Details['lastname']; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Mobile No :</span><span style="float:right;"> <?php echo $student_Details['phone']; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Email Address :</span><span style="float:right;"> <?php echo $student_Details['email']; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Gender :</span><span style="float:right;"> <?php if($student_Details['gender']=='1'){ echo 'Male';}else if($student_Details['gender']=='2'){ echo 'Female';}else{ echo 'Other';}; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">State :</span><span style="float:right;"> <?php foreach ($state_list as $key => $value) {
                                      if($value->id==$student_Details['state_id']){ echo $value->state; } }; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">City :</span><span style="float:right;"> <?php foreach ($city_list as $key => $value) {
                                      if($value->id==$student_Details['city_id']){ echo $value->city; } }; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Preferred Country :</span><span style="float:right;"><?php foreach ($country_list as $key => $value) {
                                      if($value->id_c==$student_Details['preferred_country']){ echo $value->country_name;}}; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Final Country :</span><span style="float:right;"> <?php foreach ($country_list as $key => $value) {
                                      if($value->id_c==$student_Details['country_id']){ echo $value->country_name;}}; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Branch Name :</span><span style="float:right;"> <?php foreach ($all_branch as $key => $value) {
                                      if($value->id==$student_Details['branch_name']){ echo $value->b_name;}}; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">In Take :</span><span style="float:right;"> <?php echo $student_Details['in_take']; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Residing Country :</span><span style="float:right;"><?php foreach ($country_list as $key => $value) {
                                      if($value->id_c==$student_Details['residing_country']){ echo $value->country_name;}}; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Nationality :</span><span style="float:right;"><?php foreach ($country_list as $key => $value) {
                                      if($value->id_c==$student_Details['nationality']){ echo $value->country_name;}}; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Age :</span><span style="float:right;"> <?php echo $student_Details['age']; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Marital Status :</span><span style="float:right;"> <?php echo $student_Details['marital_status']; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Address  :</span><span style="float:right;"> <?php echo $student_Details['address']; ?></span></li>
                                    <li class="activity" style="padding: 20px;"><span style="float:left;font-weight: 900;">Remark :</span><span style="float:right;"> <?php echo $student_Details['enquiry']; ?></span></li>
                                  </ul>
                                </div>
                            </div>
                            <div class="module text-center col-md-6">
                              <div class="panel-body panel-form" style="border: none;padding-top: 50px;">
<?php echo form_open_multipart('client/client_update_his_profile/'.$details->phone,'class="form-inner" id="territory"') ?>
    <?php echo form_hidden('phone_id',$student_Details['phone']) ?>
        <div class="form-row">
            <?php if(!empty($this->session->picture)){?>
                <div class="col-sm-6" align="center"> 
                    <img alt="Picture" src="<?php echo (!empty($this->session->picture)?('https://studyandimmigration.s3.ap-south-1.amazonaws.com/'.$this->session->awsfolder.'/'.$this->session->picture):base_url("assets/images/no-img.png")) ?>" id="picture" width="150" height="150">
                    <input class="form-control" name="file" type="file" id="file" value="<?= $this->session->picture ?>" onchange="document.getElementById('picture').src = window.URL.createObjectURL(this.files[0])">
                    <input type="hidden" name="new_file" value="<?= $this->session->picture ?>" class="form-control" >
                    <h3></h3>
                </div>
            <?php }else{ ?>
                <div class="col-sm-6" align="center"> 
                    <img alt="Picture" src="<?php echo (!empty($this->session->picture)?base_url($this->session->picture):base_url("assets/images/no-img.png")) ?>" id="picture" width="150" height="150">
                    <input class="form-control" name="file" type="file" id="file" value="<?= $this->session->picture ?>" onchange="document.getElementById('picture').src = window.URL.createObjectURL(this.files[0])">
                    <input type="hidden" name="new_file" value="<?= $this->session->picture ?>" class="form-control" >
                    <h3></h3>
                </div>
            <?php } ?> 

                <div class="form-group col-md-6">
                    <label for="description" style="float:left;"><?php echo display('employee_id') ?> </label>
                    <input type="text" class="form-control br_25  m-0 icon_left_input" name="employee_id" value="<?php  if(!empty($student_Details['Enquery_id'])){ echo $student_Details['Enquery_id']; }else{echo $student_Details['Enquery_id'];} ?>" placeholder="<?php echo display('employee_id') ?>" readonly>
                </div>
                <div class="form-group  col-md-6">
                    <label for="description" class="col-form-label" style="float:left;">First Name </label>
                    <input type="text" class="form-control br_25  m-0 icon_left_input" name="Name" value="<?php echo $student_Details['name'];?>" placeholder="First Name">
                </div>
                <div class="form-group  col-md-6">
                    <label for="description" class="col-form-label" style="float:left;">Last Name </label>
                    <input type="text" id="last_name" class="form-control br_25  m-0 icon_left_input" name="last_name" value="<?php echo $student_Details['lastname'];?>" placeholder="Last Name">
                </div>

                <div class="form-group col-md-6">
                    <label for="description" style="float:left;">Primary Email </label>
                    <input type="email" id="emailid" class="form-control br_25  m-0 icon_left_input" value="<?php echo $student_Details['email']; ?>"  placeholder="Email" name="email" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="exampleFormControlTextarea1" style="float:left;">Phone Number</label>
                    <input type="text" id="mobile" class="form-control br_25  m-0 icon_left_input" maxlength="10"  placeholder="Primary Phone Number" value="<?php echo $student_Details['phone']; ?>" name="cell" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label style="float:left;"><?php echo 'Age';?></label>
                    <input type="text" id="age" class="form-control br_25  m-0 icon_left_input" placeholder="Age" value="<?php echo $student_Details['age']; ?>" name="age">
                </div>

   <div class="form-group col-md-6">
      <label style="float:left;"><?php echo 'Marital Status';?></label>
      <select class="form-control marital_status" name="marital_status" id="marital_status" required>
      <option value="single" <?php if($student_Details['marital_status']=='single'){echo 'selected';} ?>> Single</option>
      <option value="married" <?php if($student_Details['marital_status']=='married'){echo 'selected';} ?>> Married</option>
      <option value="widowed" <?php if($student_Details['marital_status']=='widowed'){echo 'selected';} ?>> Widowed</option>
      <option value="divorced" <?php if($student_Details['marital_status']=='divorced'){echo 'selected';} ?>> Divorced</option>
      <option value="separated" <?php if($student_Details['marital_status']=='separated'){echo 'selected';} ?>> Separated</option>
     </select>
  </div>

            </div>

            <div class="form-row">
                    <div class="form-group col-md-6">
                        <label style="float:left;"><?php echo display('country_name')?></label>
                        <select class="form-control" name="country" id="country">
                            <option value="" style="display:none;">---Select country---</option>
                            <?php  foreach($country_list as $c){ ?>
                            <option value="<?php echo $c->id_c; ?>" <?php if($c->id_c==$student_Details['residing_country']){echo 'selected';}?>><?php echo $c->country_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label style="float:left;"><?php echo display('state_name')?></label>
                        <select class="form-control state_id" name="state_id" id="state_id">
                        <?php foreach($state_list as $state){?>
                            <option value="<?= $state->id?>" <?php if($state->id==$student_Details['state_id']){echo 'selected';} ?>><?=$state->state ?></option>
                        <?php } ?>
                        </select>
                    </div>

                        <div class="form-group col-md-6">
                            <label style="float:left;"><?php echo display('city_name')?></label>
                            <select class="form-control city_name" name="city_name" id="city_name" required>
                                <?php foreach($city_list as $city){?>
                                <option value="<?= $city->id?>" <?php if($city->id==$student_Details['city_id']){echo 'selected';} ?>><?= $city->city ?></option>
                                <?php } ?>
                            </select>
                        </div>

                  <div class="form-group col-md-6">
                    <label for="exampleFormControlTextarea1" style="float:left;">Address</label>
                    <textarea class="form-control" id="address" name="address"><?php echo $student_Details['address'];?></textarea>
                  </div>
                     
                    <div class="form-group col-md-12 text-center">
                        <div class="ui buttons">
                            <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                            <div class="or"></div>
                            <button class="ui positive button"><?php echo display('save') ?></button>
                        </div>
                    </div>
                </div>
<?php echo form_close() ?>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>