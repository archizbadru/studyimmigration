<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

        <link href="<?= base_url('assets_web/css/bootstrap.min.css') ?>" rel="stylesheet">

        <link href="<?= base_url('assets_web/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('assets_web/css/flaticon.css') ?>" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/elegant-icons.css" type="text/css">

<link rel="stylesheet" href="<?php echo base_url()?>demo/css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/style.css" type="text/css">
<style>

.profile-main{
  width: 100%;
  margin: 0 auto;
  border: 1px solid #aed5e2;
  padding-bottom: 10px;
}
.profile-header{
  height: 200px;
  width: 100%;
  background-color: #EBF6FA;
  border-bottom: 2px solid #E2F3FB;
}
.user-detail{
  position: relative;
  width: 75%;
  margin: 0 auto;
  height: 100%;
}
.user-image{
  float: left;
  position: relative;
  width: 17%;
  height: 135px;
}
.user-image img{
  width: 100%;
  height: 100%;
  border-radius: 50%;
  margin-top: 35px;
}
.prof-label{
  position: absolute;
  background: #8C13A0;
  color: #fff;
  padding: 9px 4px;
  border-radius: 50%;
  top: 155px;
  left: 42px;
  font-size: 12px;
}
.user-data{
  float: left;
  width: 46%;
  padding-left: 27px;
  margin-bottom: 20px;
}
.user-data h2{ 
  margin-bottom: 0px;
  margin-top: 35px;
  font-size: 20px;
  font-weight: 600;
}
.user-data .post-label{
  font-size: 10px;
  border: 1px solid #C3CECB;
  padding: 0px 4px;
  border-radius: 4px;
  background: #F3F5F5;
  margin-right: 5px;
}
.user-data .post-label:hover{
  background-color: #F8EDE7;
  border-color: #F2D4BA;
}
.user-data p{
  font-size: 12px;
  color: #404040;
}
.social-icons{
  float: right;
  width: 30%;
  text-align: right;
}
.social-icons i{
  margin-top: 35px;
  margin-bottom: 15px;
  color: #fff;
  padding: 8px 9px 0px 0px;
  border-radius: 50%;
  font-size: 15px;
  margin-right: 2px;
  height: 30px;
  width: 30px;
}
.social-icons .fa-facebook{
  background-color: #365597;
}
.social-icons .fa-twitter{
  background-color: #01B0F4;
}
.social-icons .fa-linkedin{
  background-color: #0F80BB;
}
.social-icons .fa-google{
  background-color: #D53B1F;
}
.social-icons .fa-instagram{
  background-color: #CF3594;
}



/*tab*/
.tab-panel-main{
  width: 75%;
  margin: 0 auto;
  height: auto;
}
ul.tabs{
  margin: 0px;
  padding: 0px;
  list-style: none;
  display: flex;
  position: absolute;
  top: 207px;
  /*right: 400px;*/
}
ul.tabs li{
  color: #222;
  display: inline-block;
  padding: 10px 15px;
  border-right: 1px solid #E2F3FB;
  border-top: 2px solid #E2F3FB;
  cursor: pointer;
  background: #FAFBFB;
}
ul.tabs li:last-child{
  border-right: 2px solid #E2F3FB;
}
ul.tabs li:first-child{
  border-left: 2px solid #E2F3FB;
}
ul.tabs li.current{
  background: #10A3FF;
  color: #fff;
  font-weight: 600;
}
.tab-content{
height:auto;
  display: none;
  padding: 60px 5px;
}
.tab-content.current{
  display: inherit;
}

#Portfolio{
  height: auto;
  float: left;
  padding-left: 0px;
  padding-right: 0px; 
}

#Edu-detail{
  height: auto;
  float: left;
  padding-right: 0px;
  padding-left: 0px;
  width: inherit;  
}

#payment{
  height: auto;
  float: left;
  padding-right: 0px;
  padding-left: 0px;  
}
#agreement{
  height: auto;
  float: left;
  padding-right: 0px;
  padding-left: 0px;     
}
#english{
  height: auto;
  float: left;
  padding-right: 0px;
  padding-left: 0px;     
}
#qualification{
  height: auto;
  float: left;
  padding-right: 0px;
  padding-left: 0px;     
}



.footerp, .footerp strong{
  text-align: center;
}
.footerp p{
  margin-bottom: 0px;
}
.footerp-box-main{
  width: 80%;
  background-color: red;
  margin: 0 auto;
}
.footerp-box{
  height: 50px;
  width: 50px;
  border: 1px solid #939393;
  border-radius: 50%;
  display: inline-block;
  margin-right: 20px;
}
.footerp-box:last-child{
  margin-right: 0px;
}
.footerp-box i{
  line-height: 50px;
  font-size: 20px;
}
.footerp-box .fa-facebook{
  color: #365597;  
}
.footerp-box .fa-twitter{
  color: #01B0F4;  
}
.footerp-box .fa-linkedin{
  color: #0F80BB;  
}
.footerp-box .fa-google{
  color: #D53B1F;  
}
.footerp-box .fa-instagram{
  color: #CF3594;  
}
#Basic-detail{
  height: auto;
  float: left;
  padding-left: 0px;
  padding-right: 0px; 
}

@media (min-width: 320px) and (max-width: 640px){
  .profile-main{
    width: 100%;
  }
  .user-detail{
    width: 95%;
  }
  .user-image {
    width: 33%;
    height: 100px;
  }
  .user-data{
    width: 51%;
    margin-bottom: 27px;
  }
  .social-icons{
    width: 90%;
    float: left;
  }
  .social-icons i{
    margin-top: 0px;
  }

  ul.tabs{
    width: 97%;
    font-size: 13.5px;
    right: 0px;
    top: 261px;
    left: 7px;
  }
  .profile-header{
    height: 250px;
  }
  .bio-box{
    width: 100%;
    margin-bottom: 10px;
  }
  .footerp-box i{
    line-height: 40px;
  }
  .footerp-box {
    height: 42px;
    width: 35px;
  }
  #Portfolio, #Edu-detail, #Basic-detail{
    height: auto;
  }
}
</style>
<style>
	.service-tile {
    margin-bottom: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 1.5rem 1rem;
    box-shadow: 0 .25rem 1rem rgba(0,0,0,.1);
    border-radius: .5rem;
    transition: box-shadow .2s ease,transform .2s ease;
    background-color: #f5f5f5;
}
.a-btn.-orange {
    color: #fff;
    background-color: #ff6d2a;
}
.a-btn {
    border-radius: 10px;
    border: 0;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-size: 1rem;
    font-weight: 500; 
    line-height: 2.5rem;
    outline: none;
    padding: 0 1.5rem;
    text-decoration: none;
    transition: background-color .2s ease;
    white-space: nowrap;
}
.step-bar {
   margin: 0.5em;
   padding: 0;
   list-style: none;
   display: flex;
   flex-direction: column;
}
 @media (min-width: 480px) {
   .step-bar {
     flex-direction: row;
     justify-content: space-between;
  }
}
 .step {
   display: flex;
   flex: 0 1 100%;
   justify-content: center;
   border: 4px solid #009cd2;
   background-color: #009cd2;
   color: white;
   border-radius: 2rem;
   position: relative;
}
 @media (min-width: 480px) {
   .step {
     background-color: transparent;
     color: currentColor;
     border: none;
     flex-direction: column;
     align-items: center;
     border-radius: 0;
     flex-grow: 1;
  }
}
 .step + .step {
   margin-top: 2rem;
}
 @media (min-width: 480px) {
   .step + .step {
     margin-top: 0;
  }
}
 .step + .step:before {
   content: '';
   position: absolute;
   background-color: #009cd2;
   height: calc(100% + 4px);
   width: 4px;
   top: calc(-100% - 4px);
}
 @media (min-width: 480px) {
   .step + .step:before {
     display: none;
  }
}
 @media (min-width: 480px) {
   .step + .step .step__bullet:before {
     content: '';
     position: absolute;
     height: 4px;
     width: calc(100% - 2.5rem - 4px);
     top: 1rem;
     right: calc(50% + 2.5rem / 2);
     background-color: #009cd2;
  }
}
 .step--current ~ .step {
   border-color: #96a0a0;
   background-color: white;
   color: currentColor;
}
 @media (min-width: 480px) {
   .step--current ~ .step {
     background-color: transparent;
  }
}
 .step--current ~ .step:before {
   background-color: #96a0a0;
}
 @media (min-width: 480px) {
   .step--current ~ .step .step__bullet {
     border-color: #96a0a0;
     background-color: white;
     color: currentColor;
  }
}
 .step--current ~ .step .step__bullet:before {
   background-color: #96a0a0;
}
 .step__bullet {
   height: 3rem;
   width: 3rem;
   line-height: 2.5rem;
   text-align: center;
   font-weight: 700;
}
 @media (min-width: 480px) {
   .step__bullet {
     border: 4px solid #009cd2;
     background-color: #009cd2;
     color: white;
     border-radius: 50%;
  }
}
 .step__title {
   height: 2rem;
   line-height: 2rem;
   padding: 0 1rem;
   text-align: center;
}

</style>
        <!-- Comment Form -->

        <section class="comment-form">
            <div class="container-fluid">
              <br>
              <br>
                <div class="col-md-12">
                  <?php
                  if ($this->session->companey_id == 76) {
                    $s  = $lead_stage;
                    if (!empty($s)) {
                    ?>
                    <ul class="step-bar">
                      <?php
                        $i = 1;
                        $stud_details = $student_Details;
                        if (empty($stud_details->lead_stage)) { ?>
                          <li class="step step--current">
                            <span class="step__bullet">0</span>
                            <span class="step__title">Nothing</span>
                          </li>
                        <?php
                        }
                        if (!empty($s)) {                          
                        foreach ($s as $key => $value) {                      
                        ?>
                        <li class="step <?=(!empty($stud_details->lead_stage) && $value->stg_id==$stud_details->lead_stage)?'step--current':''?>">
                          <span class="step__bullet"><?=$i?></span>
                          <span class="step__title"><?=$value->lead_stage_name?></span>
                        </li>                        
                        <?php
                        $i++;
                        }
                      }
                      ?>
                    </ul>
                    <?php
                    }
                  }
                  ?>
                </div>
                <div class="col-sm-12">

               

	<div class="profile-main" style="background: aliceblue;">
		<div class="profile-header">
		<?php //foreach($student_Details as $pdetail){ ?>
			<div class="user-detail">
				<div class="user-image">
					<img src="http://nicesnippets.com/demo/up-profile.jpg">
				</div>
				<div class="user-data">
					<h2><?php echo $student_Details['name_prefix'].''.$student_Details['name'].' '.$student_Details['lastname']; ?></h2>
					<span class="post-label"><?php echo $student_Details['Enquery_id']; ?></span>
          <?php
          if ($this->session->companey_id == 67) {          
          ?>
					<p>Applied at <strong>Space Internationals</strong><br>
          <?php
          }
          ?>
					<i class="fa fa-map-marker" aria-hidden="true"></i>  <?php echo $student_Details['address']; ?>
					</p>
				</div>
				<div style="padding-top:5%;">
				<a href="<?= base_url('enquiry/viewpro/'.$student_Details['enquiry_id']);?>" class="btn btn-warning"><i class="fa fa-pencil-square-o" style="color:#fff;"></i> Edit</a>
			</div>
			</div>
		<?php //} ?>
			<div class="tab-panel-main">
				<ul class="tabs">
					<li class="tab-link current" data-tab="Basic-detail">Basic Detail</li>
				    <?php if($this->session->userdata('user_right')==151 || $this->session->userdata('user_right')==180 || $this->session->userdata('user_right')==186){ ?>
					<li class="tab-link" data-tab="Edu-detail">Document</li>
					<li class="tab-link" data-tab="Portfolio">Institute</li>
					<li class="tab-link" data-tab="qualification">Qualification</li>
					<li class="tab-link" data-tab="english">English Language</li>
					<li class="tab-link" data-tab="payment">Payment</li>
					<li class="tab-link" data-tab="agreement">Agreement</li>
					<?php } ?>
					<?php if($this->session->userdata('user_right')==110){ ?>
					<li class="tab-link" data-tab="pramotional">Promotional Videos</li>
					<li class="tab-link" data-tab="faq">University FAQ</li>
					<li class="tab-link" data-tab="institute">Create Institute</li>
					<li class="tab-link" data-tab="course">Create Course</li>
					<li class="tab-link" data-tab="schedule">Create Schedule</li>
					<?php } ?>
				</ul>
				
				<div id="Basic-detail" class="tab-content current">
			
                                        <div class="col-sm-12">
                                            <div class="col-md-8"><label>Email ID</label></div>
                                            <div class="col-md-4"><p><?php echo $student_Details['email']; ?></p></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-md-8"><label>Phone No</label></div>
                                            <div class="col-md-4"><p><?php echo $student_Details['phone']; ?></p></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-md-8"><label>State</label></div>
                                            <div class="col-md-4"><p><?php foreach($state_list as $st){if($st->id==$student_Details['state_id']){ echo $st->state;}} ?></p></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-md-8"><label>City</label></div>
                                            <div class="col-md-4"><p><?php foreach($city_list as $ct){if($ct->id==$student_Details['city_id']){ echo $ct->city;}} ?></p></div>
                                        </div>
										<div class="col-sm-12">
                                            <div class="col-md-8"><label>Process</label></div>
                                            <div class="col-md-4"><p><?php foreach($process_list as $pl){if($pl->sb_id==$student_Details['product_id']){ echo $pl->product_name;}} ?></p></div>
                                        </div>
										<div class="col-sm-12">
                                            <div class="col-md-8"><label>Gender</label></div>
                                            <div class="col-md-4"><p><?php if($student_Details['gender']=='1'){ echo 'Male';}else if($student_Details['gender']=='2'){echo 'Female';}else{ echo 'Other';} ?></p></div>
                                        </div>
										<div class="col-sm-12">
                                            <div class="col-md-8"><label>Enquiry Source</label></div>
                                            <div class="col-md-4"><p><?php foreach($source_list as $sl){if($sl->lsid==$student_Details['enquiry_source']){ echo $sl->lead_name;}} ?></p></div>
                                        </div>
										<div class="col-sm-12">
                                            <div class="col-md-8"><label>Preferd Country</label></div>
                                            <div class="col-md-4"><p>
							<?php  
				                $cntry_ids=explode(',',$student_Details['country_id']);
                        $cname = '';
                        if (!empty($cntry_ids)) {                        
                              foreach($cntry_ids as $ids){
                                foreach($country_list as $c_name){  
                                if($c_name->id_c == $ids){
                                  $cname= $c_name->country_name;
                                  }
                                }
				                      echo $cname.''.',';
				                  }
                        } ?>
											
											</p></div>
                                        </div>
										<div class="col-sm-12">
                                            <div class="col-md-8"><label>Remark</label></div>
                                            <div class="col-md-4"><p><?php echo $student_Details['lead_comment']; ?></p></div>
                                        </div>
                
				</div>
				<div id="Edu-detail" class="tab-content">
				<?php 
        //print_r($all_extra);
        foreach($all_extra as $extrad){ ?>
				<?php if($extrad->fvalue!='' && $extrad->form_id==13 && $extrad->input_type==8){ ?>
					<div class="col-md-3">
					<a class="service-tile" aria-current="false" href="<?php echo $extrad->fvalue; ?>" target="_blank">
					<div class="fa fa-file" style="color:orange;font-size:45px;"><i class="service-icon -react"></i></div><div class="service-tile__content">
					<div><h3><span><?php echo $extrad->input_label; ?></span></h3></div><span class="a-btn -orange">View Doc</span></div></a>
					</div>
				<?php } ?>
				<?php } ?>
				</div>
				<div id="Portfolio" class="tab-content" style="overflow-x:scroll;width:100%;">
					<div class="row" style="padding-top:4%;">
<div class="col-lg-12">
<table id="example" class="table table-striped table-bordered" style="width:100%">
<thead>
<tr>
<th class="" style="font-size: 10px;">S.N</th>
<th style="font-size: 10px;">Institute </th>
<th style="font-size: 10px;">Course</th>
<th style="font-size: 10px;">Program Discpline</th>
<th style="font-size: 10px;">Program Lavel</th>
<th style="font-size: 10px;">Program Length</th>
<th style="font-size: 10px;">Tution Fee</th>
<?php 
if ($this->session->companey_id !=67) { ?>
  <th style="font-size: 10px;">Offer Letter fee</th>
  <th style="font-size: 10px;">Application URL</th>
  <th style="font-size: 10px;">App status</th>
  <th style="font-size: 10px;">App Fee</th>
  <th style="font-size: 10px;">Transcripts</th>
  <th style="font-size: 10px;">LORs</th>
  <th style="font-size: 10px;">SOP</th>
  <th style="font-size: 10px;">CV</th>
  <th style="font-size: 10px;">TOEFL/IELTS /PTE</th>
<?php
}
?>

<th style="font-size: 10px;">F Comments </th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($all_institute as $ins_data){ ?>
<tr>
<td class=""><?php echo $i; ?></td>
<td><?php foreach($institute_list as $ins){if($ins->institute_id==$ins_data->institute_id){echo $ins->institute_name;}}?></td>
<td><?php echo $ins_data->course_name_str;?></td>
<td><?php foreach($discipline as $dc){if($dc->id==$ins_data->p_disc){echo $dc->discipline;}}?></td>
<td><?php foreach($level as $lvl){if($lvl->id==$ins_data->p_lvl){echo $lvl->level;}}?></td>
<td><?php foreach($length as $lg){if($lg->id==$ins_data->p_length){echo $lg->length;}}?></td>
<td class=""><?php echo $ins_data->t_fee; ?></td>
<?php 
if ($this->session->companey_id !=67) { ?>
<td class=""><?php echo $ins_data->ol_fee; ?></td>
<td class=""><?php echo $ins_data->application_url; ?></td>
<td class=""><?php echo $ins_data->app_status; ?></td>
<td class=""><?php echo $ins_data->app_fee; ?></td>
<td class=""><?php echo $ins_data->transcript; ?></td>
<td class=""><?php echo $ins_data->lors; ?></td>
<td class=""><?php echo $ins_data->sop; ?></td>
<td class=""><?php echo $ins_data->cv; ?></td>
<td class=""><?php echo $ins_data->toefl; ?></td>
<?php
}
?>
<td class=""><?php echo $ins_data->followup_comment; ?></td>
</tr>
<?php $i++; } ?>
</tbody>
</table>
</div>
</div>
				</div>
				<div id="qualification" class="tab-content">
					<?php foreach($all_extra as $extra){ ?>
					<?php if($extra->form_id==2 && $extra->fvalue!=''){ ?>
					<div class="col-md-12">
                        <div class="col-md-10"><label><?php echo $extra->rep_label; ?></label></div>
                        <div class="col-md-2"><p><?php echo $extra->fvalue; ?></p></div>
					</div>
					<div class="col-md-12"><hr></div>
					<?php } ?>
				<?php } ?>
				</div>
				<div id="english" class="tab-content">
					<?php foreach($all_extra as $extra1){ ?>
					<?php if($extra1->form_id==43 && $extra1->fvalue!='' && $extra1->input_label!='' && $extra1->rep_label!=''){ ?>
					<div class="col-md-12">
                        <div class="col-md-10"><label><?php echo $extra1->rep_label; ?></label></div>
                        <div class="col-md-2"><p><?php echo $extra1->fvalue; ?></p></div>
					</div>
					<div class="col-md-12"><hr></div>
                 <?php } ?>
				<?php } ?>
				</div>
<div id="payment" class="tab-content" style="overflow-x:scroll;width:100%;">

<div class="row" style="padding-top:4%;">
<div class="col-lg-12">
<table id="example1" class="table table-striped table-bordered" style="width:100%">
<thead>
<tr>
<th class="" style="font-size: 10px;">S.N</th>
<th style="font-size: 10px;">Amount</th>
<th style="font-size: 10px;">Date</th>
<th style="font-size: 10px;">Status</th>
</tr>
</thead>
<tbody>
<?php if(!empty($invoice_details)){ ?>
<?php $i=1; foreach($invoice_details as $ins){ ?>
<tr>
<td class="">
<?php echo $i; ?>
</td>
<td class="">
<?php echo $ins->ins_amt; ?>
</td>
<td class="">
<?php echo $ins->ins_dt; ?>
</td>
<td class="">
<?php if($ins->pay_status=='1'){ ?>
                <div class="col-md-3"><span class="btn btn-success">Paid </span></div>
                    <?php }else{ ?>
                <div class="col-md-3"><span class="btn btn-danger">Unpaid </span></div>
      <?php } ?>
</td>
</tr>
<?php $i++; ?>
<?php } ?> 
<?php } ?> 
</tbody>
</table>
</div>
</div>
				</div>
<div id="agreement" class="tab-content"  style="overflow-x:scroll;width:100%;">
<div class="row" style="padding-top:4%;">
<div class="col-lg-12">
<table id="example2" class="table table-striped table-bordered" style="width:100%">
<thead>
<tr>
      <th style="font-size: 10px;">S.N</th>
      <th style="font-size: 10px;">Name</th>
      <th style="font-size: 10px;">Mobile</th>
      <th style="font-size: 10px;">Email Id</th>
	  <th style="font-size: 10px;">Address</th>
	  <th style="font-size: 10px;">Document</th> 
	  <th style="font-size: 10px;">Date</th>
</tr>
</thead>
<tbody>
<tr>
<?php if(!empty($agrrem_doc)){ ?>
                        <?php $i=1; foreach($agrrem_doc as $agrmt){ ?>                             
                                <tr style="cursor: pointer;">
      <td><?php echo $i; ?></td>
      <td><?php echo $agrmt->agg_name; ?></td>
      <td><?php echo $agrmt->agg_phone; ?></td>
	  <td><?php echo $agrmt->agg_email; ?></td>
	  <td><?php echo $agrmt->agg_adrs; ?></td>
	  <td><a target="_blank" href="<?php echo base_url($agrmt->file); ?>"><i class="fa fa-file-image-o" aria-hidden="true" style="font-size:20px;margin-top:-30px;color:#10A3FF;"></i></a></td>
      <td><?php echo $agrmt->created_date; ?></td>
									</tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
</tr>
</tbody>
</table>
</div>
</div>
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('ul.tabs li').click(function(){
			var tab_id = $(this).attr('data-tab');

			$('ul.tabs li').removeClass('current');
			$('.tab-content').removeClass('current');

			$(this).addClass('current');
			$("#"+tab_id).addClass('current');
		});
	});
</script>
                </div>

                <div class="col-sm-4"></div>

            </div>

        </section>
<script>
    // $(document).ready(function(){

//     $('table tr').click(function(){

//         window.location = $(this).attr('href');

//         return false;

//     });
// });
</script>

<script>
           
            function find_crs() { 
            var u_id = $("#ins_id").val();
            //var uid = btoa(u_id);
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>schedule/read_crs_by_id',
            data: {un_id:u_id},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="">---Select---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].crs_id)+'">'+(obj[i].course_name)+'</option>';
                }
                
                $("#crs_id").html(html);
                
            }
            
            
            });

            }
</script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script>
$(document).ready(function(){
  $("div.single").show();
  $("div.multiple").hide();
    $("input[name$='dayrange']").click(function(){
        var test = $(this).val();
            if(test=='1'){
        $("div.multiple").hide();
        $("div.single").show();
      }else{
         $("div.multiple").show();
         $("div.single").hide();  
      }

    });

});

</script>

<script>
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
    $('#dtBasicExample1').DataTable();
      $('#dtBasicExample2').DataTable();
        $('#dtBasicExample3').DataTable();
          $('#dtBasicExample4').DataTable();
		  $('#example').DataTable();
		  $('#example1').DataTable();
		  $('#example2').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>

<script src="<?php echo base_url()?>demo/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/jquery.slicknav.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/mixitup.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/main.js" type="text/javascript"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="text/javascript"></script>
<script src="<?= base_url('assets_web/js/custom.js') ?>" type="text/javascript"></script> 