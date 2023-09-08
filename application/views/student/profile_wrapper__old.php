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
                        if ($stud_details->lead_stage == '') { ?>
                          <li class="step step--current">
                            <span class="step__bullet">0</span>
                            <span class="step__title">Nothing</span>
                          </li>
                        <?php
                        }
                        foreach ($s as $key => $value) {                      
                        ?>
                        <li class="step <?=($value->stg_id==$stud_details->lead_stage)?'step--current':''?>">
                          <span class="step__bullet"><?=$i?></span>
                          <span class="step__title"><?=$value->lead_stage_name?></span>
                        </li>                        
                        <?php
                        $i++;
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
<!--------------------------------------------------------------------------University Tabs----------------------------------------------->
        <div id="pramotional" class="tab-content">
          
        <div class="col-sm-12">
           <button class="btn-success btn" data-toggle="modal" data-target="#videoadd">Add</button>
        <table width="100%" class="table table-striped table-bordered table-sm" id="dtBasicExample4">


                    <thead>

                        <tr> 


                            <th><?php echo display('serial') ?></th>

                            <th>Video</th>

                            <th>Title</th>

                            <th>Description</th>
                            <th>Meta Key</th>
                            <th>Status</th>
                            <th>Action</th>
              
                        </tr>


                    </thead>


              <tbody>


                 <?php if (!empty($vid_list)) { ?>


                            <?php $sl = 1; ?>


                            <?php foreach ($vid_list as $vidlist) { ?>


                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">


                                    <td><?php echo $sl; ?></td>


                                    <td>
                                     <iframe width="100%" height="100%" src="<?php echo $vidlist['link']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                     </td>


                                    <td><?php echo $vidlist['title']; ?></td>


                                    <td><?php echo $vidlist['des'];?></td>
                                    <td><?php echo $vidlist['meta_key'];?></td>
                                    <td><?php if($vidlist['status']==1){ echo 'Active'; }else{ echo "Inactive"; }?></td>
                                    <td>
                                      
                                      <a class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#videoupdate"><i class="fa fa-edit"></i></a> 

                                <a href="<?php echo base_url('dashboard/delete_vid/'.$vidlist['id']) ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>



                                  

  <div class="modal" tabindex="-1" role="dialog" id="videoupdate">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo  form_open('dashboard/add_video')?>
        <input type="hidden" name="vid" value="<?= $vidlist['id']?>">
        <div class="row">
           <div class="form-group col-md-6">

        <label>Video Link</label>

      <input class="form-control" name="vlink" placeholder="Add Video URL"  type="text" value="<?= $vidlist['link']?>" required>

    </div>
    <div class="form-group col-md-6">

        <label>Title</label>
      <input type="text" class="form-control" name="title" placeholder="MBA Courses" value="<?= $vidlist['title']?>">
       

    </div>
        </div>

      <div class="row">
           <div class="form-group col-md-6">

        <label>Description</label>

      <textarea class="form-control" name="des" required><?= $vidlist['des']?></textarea>

    </div>
    <div class="form-group col-md-6">

        <label>Meta Keyword</label>
      <input type="text" class="form-control" name="metakey" placeholder="e.g. MBA Course" value="<?= $vidlist['meta_key']?>">
       

    </div>
    </div>
      
    </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close()?>
  </div>
</div>
                                </tr>


                                <?php $sl++; ?>
                           
                            <?php } ?> 


                        <?php } ?> 
             </tbody>
           </table>
         </div>
				</div>
<!-- Modal for add video -->

<div class="modal" tabindex="-1" role="dialog" id="videoadd">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo  form_open('dashboard/add_video')?>
        <div class="row">
           <div class="form-group col-md-6">

        <label>Video Link</label>

      <input class="form-control" name="vlink" placeholder="Add Video URL"  type="text" required>

    </div>
    <div class="form-group col-md-6">

        <label>Title</label>
      <input type="text" class="form-control" name="title" placeholder="MBA Courses">
       

    </div>
        </div>

      <div class="row">
           <div class="form-group col-md-6">

        <label>Description</label>

      <textarea class="form-control" name="des" required></textarea>

    </div>
    <div class="form-group col-md-6">

        <label>Meta Keyword</label>
      <input type="text" class="form-control" name="metakey" placeholder="e.g. MBA Course">
       

    </div>
    </div>
      
    </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close()?>
  </div>
</div>
<!-- END -->
<div id="faq" class="tab-content">
				 <div class="col-sm-12">
           <button class="btn-success btn" data-toggle="modal" data-target="#faqadd">Add</button>
        <table width="100%" class="table table-striped table-bordered table-sm" id="dtBasicExample3">


                    <thead>

                        <tr> 


                            <th><?php echo display('serial') ?></th>

                            <th>Question Type</th>

                            <th>Answer</th>

                            <th>status</th>
                            <th>Action</th>
              
                        </tr>


                    </thead>


              <tbody>


                 <?php if (!empty($faq_list)) { ?>


                            <?php $sl = 1; ?>


                            <?php foreach ($faq_list as $faqlist) { ?>


                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">


                                    <td><?php echo $sl; ?></td>


                                   
                                    <td><?php echo $faqlist['que_type']; ?></td>


                                    <td><?php echo $faqlist['answer'];?></td>
                                    <td><?php if($faqlist['status']==1){ echo 'Active'; } else{ echo 'Inactive'; }?></td>
                                    <td>
                                      
                                <a class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#faqupdate"><i class="fa fa-edit"></i></a> 

                                <a href="<?php echo base_url('dashboard/delete_faq/'.$faqlist['id']) ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>



                                  

  <div class="modal" tabindex="-1" role="dialog" id="faqupdate">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update FAQ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo  form_open('dashboard/add_faq')?>
        <input type="hidden" name="faqid" value="<?= $faqlist['id']?>">
        <div class="row">
           <div class="form-group col-md-6">

        <label>Question Type</label>

      <input class="form-control" name="qtype" placeholder="Add Video URL"  type="text" value="<?= $faqlist['que_type']?>" required>

    </div>
    <div class="form-group col-md-6">

        <label>Answer</label>
      <input type="text" class="form-control" name="answ" placeholder="MBA Courses" value="<?= $faqlist['answer']?>">
       

    </div>
        </div>

      <div class="row">
       <div class="form-group">
                                <label for="status">Status</label>
                                    <div class="form-check">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1" <?php  if(!empty($faqlist['status'])){if($faqlist['status']==1){?> checked <?php }}?>>Active
                                          </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" <?php  if(!empty($faqlist['status'])){if($faqlist['status']==0){?> checked <?php }}?>>Inactive   
                                            </label>
                                    </div>
                                </div>    
    </div>
      
    </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close()?>
  </div>
</div>
                
                </tr>


                                <?php $sl++; ?>
                           
                            <?php } ?> 


                        <?php } ?> 
             </tbody>
           </table>
         </div>
				</div>

        <!-- Moda for FAQ -->

<div class="modal" tabindex="-1" role="dialog" id="faqadd">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add FAQ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo  form_open('dashboard/add_faq')?>
        <div class="row">
           <div class="form-group col-md-6">

        <label>Question Type</label>

      <input class="form-control" name="qtype"  type="text" required>

    </div>
    <div class="form-group col-md-6">

      <label>Answer</label>
      <input type="text" class="form-control" name="answ" placeholder="">
       

    </div>
        </div>
      
    </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close()?>
  </div>
</div>
        <!-- END -->
				<div id="institute" class="tab-content">
           <div class="col-sm-12">
            <button class="btn-success btn" data-toggle="modal" data-target="#instadd">Add</button>
				          <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="dtBasicExample2">

                <thead>

                <tr>

                    <th><?php echo display('serial') ?></th>

                    <th><?php echo display('institute_name') ?></th>
                    
                    <th><?php echo display('profile_image') ?></th>
                    
                    <th><?php echo display('agreement_comision') ?></th>
                    
                    <th><?php echo display('agreement_doc') ?></th>
                    
                    <th><?php echo display('from_date') ?></th>
                    
                    <th><?php echo display('to_date') ?></th>

                    <th><?php echo display('country_name') ?></th>   
                    <th><?php echo display('meta_keywords') ?></th>                          

                    <th><?php echo display('status') ?></th>

                    <th><?php echo display('action') ?></th>

                </tr>

                </thead>

                <tbody>

                <?php if (!empty($institute_list)) { 

                    $sl = 1;foreach ($institute_list as $institute) {?>

                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                            <td><?php echo $sl; ?></td>

                            <td><?php echo ucfirst($institute->institute_name); ?></td>
                            
                            <td><img src="<?php echo base_url($institute->profile_image); ?>" alt="<?php echo display('profile_image') ?>" width="50" height="50"></td> 
                            
                            <td><?php echo $institute->agreement_comision; ?></td> 
                            
                            <td><a href="<?php echo base_url($institute->agreement_doc); ?>" target="_blank"><i class="fa fa-file" aria-hidden="true" style="color:#37a000"></i></a></td> 
                            
                            <td><?php echo $institute->from_date; ?></td> 
                            
                            <td><?php echo $institute->to_date; ?></td> 
                            
                            <td><?php echo $institute->country_name; ?></td>
                            <td><?php echo ucfirst($institute->meta_key); ?></td>

                            <td><?php echo (($institute->status==1)?display('active'):display('inactive')); ?></td>

                            <td class="center">

                                <a  class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#instupdate"><i class="fa fa-edit"></i></a> 

                                <a href="<?php echo base_url("dashboard/delete_institute/$institute->institute_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 

                            </td>

                        </tr>

                        <?php $sl++; ?>

                     <div class="modal" tabindex="-1" role="dialog" id="instupdate">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Institute</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo  form_open_multipart('dashboard/add_institute')?>
        <input type="hidden" name="institute_id" value="<?=$institute->institute_id ?>">
                   <div class="form-group col-sm-6">
                    <label for="institute_name"><?php echo display('institute_name')?> <i class="text-danger">*</i></label>
                    <input name="institute_name" type="text" class="form-control" placeholder="<?php echo display('institute_name')?>" value="<?php echo $institute->institute_name ?>" >
                  </div>
          
                  <div class="form-group col-sm-6">
                    <label for="profile_image"><?php echo display('profile_image')?> <i class="text-danger">*</i></label>
                    <input name="profile_image" type="file" class="form-control" placeholder="<?php echo display('profile_image')?>" value="<?php echo $institute->profile_image ?>" >
                  </div>
                  
                  <input name="profile_images" type="hidden" class="form-control" placeholder="<?php echo display('profile_image')?>" value="<?php echo $institute->profile_image ?>" >
                  
                  <div class="form-group col-sm-6">
                    <label for="agreement_comision"><?php echo display('agreement_comision')?>(%) <i class="text-danger">*</i></label>
                    <input name="agreement_comision" type="text" class="form-control" placeholder="<?php echo display('agreement_comision')?>" value="<?php echo $institute->agreement_comision ?>" >
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="agreement_doc"><?php echo display('agreement_doc')?> <i class="text-danger">*</i></label>
                    <input name="agreement_doc" type="file" class="form-control" placeholder="<?php echo display('agreement_doc')?>" value="<?php echo $institute->agreement_doc ?>" >
                  </div>
                  
                   <input name="agreement_docs" type="hidden" class="form-control" placeholder="<?php echo display('agreement_doc')?>" value="<?php echo $institute->agreement_doc ?>" >
                  
                  <div class="form-group col-sm-6">
                    <label for="from_date"><?php echo display('from_date')?> <i class="text-danger">*</i></label>
                    <input name="from_date" type="date" class="form-control" placeholder="<?php echo display('from_date')?>" value="<?php echo $institute->from_date ?>" >
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="to_date"><?php echo display('to_date')?> <i class="text-danger">*</i></label>
                    <input name="to_date" type="date" class="form-control" placeholder="<?php echo display('to_date')?>" value="<?php echo $institute->to_date ?>" >
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('country_name')?> </label>
                    <select class="form-control" name="country_id" id="country_id">
                        <option value="" selected>Select Country</option>
                        <?php 
                        if (!empty($country)) {                                                  
                        foreach($country as $c){ ?>                                   
                        <option value="<?php echo $c->id_c; ?>" <?php if($institute->country_id==$c->id_c){echo 'selected';}?>><?php echo $c->country_name; ?></option>
                    <?php } 
                        }
                    ?>
                    </select>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('meta_keywords')?> </label>
                    <input type="text" class="form-control" name="metakey" id="metakey" value="<?= $institute->meta_key?>">
                       
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="status"><?php echo display('status') ?></label>
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php if($institute->status == 1) { echo 'checked'; } ?> ><?php echo display('active') ?>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php if($institute->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
                        </label>
                    </div>
                  </div>
      
    </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close()?>
  </div>
</div>





                    <?php } ?> 

                <?php } ?>

                </tbody>

              </table>
            </div>
				</div>
        <!-- Modal for INSt -->

<div class="modal" tabindex="-1" role="dialog" id="instadd">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Institute</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <?php echo  form_open_multipart('dashboard/add_institute')?>
             <div class="form-group col-sm-6">
                    <label for="institute_name"><?php echo display('institute_name')?> <i class="text-danger">*</i></label>
                    <input name="institute_name" type="text" class="form-control" placeholder="<?php echo display('institute_name')?>" value="" >
                  </div>
          
                  <div class="form-group col-sm-6">
                    <label for="profile_image"><?php echo display('profile_image')?> <i class="text-danger">*</i></label>
                    <input name="profile_image" type="file" class="form-control" placeholder="<?php echo display('profile_image')?>" value="" >
                  </div>
                  
                  <input name="profile_images" type="hidden" class="form-control" placeholder="<?php echo display('profile_image')?>" value="" >
                  
                  <div class="form-group col-sm-6">
                    <label for="agreement_comision"><?php echo display('agreement_comision')?> <i class="text-danger">*</i></label>
                    <input name="agreement_comision" type="text" class="form-control" placeholder="<?php echo display('agreement_comision')?>" value="" >
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="agreement_doc"><?php echo display('agreement_doc')?> <i class="text-danger">*</i></label>
                    <input name="agreement_doc" type="file" class="form-control" placeholder="<?php echo display('agreement_doc')?>" value="" >
                  </div>
                  
                   <input name="agreement_docs" type="hidden" class="form-control" placeholder="<?php echo display('agreement_doc')?>" value="" >
                  
                  <div class="form-group col-sm-6">
                    <label for="from_date"><?php echo display('from_date')?> <i class="text-danger">*</i></label>
                    <input name="from_date" type="date" class="form-control" placeholder="<?php echo display('from_date')?>" value="" >
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="to_date"><?php echo display('to_date')?> <i class="text-danger">*</i></label>
                    <input name="to_date" type="date" class="form-control" placeholder="<?php echo display('to_date')?>" value="" >
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('country_name')?> </label>
                    <select class="form-control" name="country_id" id="country_id">
                        <option value="" selected>Select Country</option>
                        <?php 
                        if (!empty($country)) {                        
                        foreach($country as $c){ ?>                                   
                        <option value="<?php echo $c->id_c; ?>"><?php echo $c->country_name; ?></option>
                    <?php } 
                      }
                    ?>
                    </select>
                  </div>
                     <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('meta_keywords')?> </label>
                    <input type="text" class="form-control" name="metakey" id="metakey">
                       
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="status"><?php echo display('status') ?></label>
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" ><?php echo display('active') ?>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" ><?php echo display('inactive') ?>
                        </label>
                    </div>
                  </div>
      
    </div>
  </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close()?>
  </div>
</div>
        <!-- ENd -->
				<div id="course" class="tab-content">
         <div class="col-sm-12">
          <button class="btn-success btn" data-toggle="modal" data-target="#crsadd">Add</button>
				 <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="dtBasicExample1">

                <thead>

                <tr>

                    <th><?php echo display('serial') ?></th>

                    <th><?php echo display('course_name') ?></th>
          
          <th><?php echo display('course_image') ?></th>
          
          <th><?php echo display('course_rating') ?></th>
          
          <th><?php echo display('course_discription') ?></th>

                    <th><?php echo display('institute_name') ?></th>      
                    <th><?php echo display('meta_keywords') ?></th>                     

                    <th><?php echo display('status') ?></th>

                    <th><?php echo display('action') ?></th>

                </tr>

                </thead>

                <tbody>

                <?php if (!empty($course_list)) { 

                    $sl = 1;foreach ($course_list as $course) {?>

                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                            <td><?php echo $sl; ?></td>

                            <td width=""><?php echo $course->course_name; ?></td>
              
              <td width=""><img src="<?php echo base_url($course->course_image); ?>" alt="<?php echo display('course_image') ?>" width="50" height="50"></td>
              
              <td width=""><?php echo $course->course_rating; ?></td>
              
              <td width=""><?php echo $course->course_discription; ?></td>

                            <td><?php echo $course->institute_name; ?></td>  
                            <td><?php echo $course->meta_key; ?></td>                               

                            <td><?php echo (($course->status==1)?display('active'):display('inactive')); ?></td>

                            <td class="center">

                                <a class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#crsupdate"><i class="fa fa-edit"></i></a> 

                                <a href="<?php echo base_url("dashboard/delete_course/$course->crs_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 

                            </td>

                        </tr>

                        <?php $sl++; ?>


 
      <div class="modal" tabindex="-1" role="dialog" id="crsupdate">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <?php echo  form_open_multipart('dashboard/add_course')?>
          <input type="hidden" name="crs_id " value="<?= $course->crs_id?>">
                      <div class="form-group col-sm-6">
                    <label for="course_name"><?php echo display('course_name')?> <i class="text-danger">*</i></label>
                    <input name="course_name" type="text" class="form-control" placeholder="<?php echo display('course_name')?>" value="<?php echo $course->course_name ?>" >
                  </div>
          <div class="form-group col-sm-6">
                    <label for="profile_image"><?php echo display('course_image')?> <i class="text-danger">*</i></label>
                    <input name="course_image" type="file" class="form-control" placeholder="<?php echo display('course_image')?>" value="<?php echo $course->course_image ?>" >
                  </div>
                  
                  <input name="course_images" type="hidden" class="form-control" placeholder="<?php echo display('course_image')?>" value="<?php echo $course->course_image ?>" >
                  
          <div class="form-group col-sm-6">
                    <label for="course_rating"><?php echo display('course_rating')?> <i class="text-danger">*</i></label>
                    <input name="course_rating" type="text" class="form-control" placeholder="<?php echo display('course_rating')?>" value="<?php echo $course->course_rating ?>" >
                  </div>
          <div class="form-group col-sm-6">
                    <label for="course_discription"><?php echo display('course_discription')?> <i class="text-danger">*</i></label>
                    <textarea name="course_discription" type="text" class="form-control" placeholder="<?php echo display('course_discription')?>" value="<?php echo $course->course_discription ?>" ><?php echo $course->course_discription ?></textarea>
                  </div>
          
                  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('institute_name')?> </label>
                    <select class="form-control" name="institute_id" id="institute_id">
                        <option value="" selected>Select Institute</option>
                        <?php 
                        if (!empty($ins_list)) {                        
                        foreach($ins_list as $c){ ?>                                   
                        <option value="<?php echo $c->institute_id; ?>" <?php if($course->institute_id==$c->institute_id){echo 'selected';}?>><?php echo $c->institute_name; ?></option>
                    <?php } 
                      }
                    ?>
                    </select>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('meta_keywords')?> </label>
                    <input type="text" class="form-control" name="metakey" id="metakey" required="" value="<?= $course->meta_key?>">
                       
                  </div>
          
                  <div class="form-group col-sm-6">
                    <label for="status"><?php echo display('status') ?></label>
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php if($course->status == 1) { echo 'checked'; } ?> ><?php echo display('active') ?>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php if($course->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
                        </label>
                    </div>
                  </div>          
      
    </div>
  </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close()?>
  </div>
</div>








                    <?php } ?> 

                <?php } ?>

                </tbody>

              </table>

				</div>
      </div>

      <!-- modal For course -->
      
      <div class="modal" tabindex="-1" role="dialog" id="crsadd">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <?php echo  form_open_multipart('dashboard/add_course')?>
                       <div class="form-group col-sm-6">
                    <label for="course_name"><?php echo display('course_name')?> <i class="text-danger">*</i></label>
                    <input name="course_name" type="text" class="form-control" placeholder="<?php echo display('course_name')?>" value="" >
                  </div>
          <div class="form-group col-sm-6">
                    <label for="profile_image"><?php echo display('course_image')?> <i class="text-danger">*</i></label>
                    <input name="course_image" type="file" class="form-control" placeholder="<?php echo display('course_image')?>" value="" >
                  </div>
                  
                  <input name="course_images" type="hidden" class="form-control" placeholder="<?php echo display('course_image')?>" value="" >
                  
          <div class="form-group col-sm-6">
                    <label for="course_rating"><?php echo display('course_rating')?> <i class="text-danger">*</i></label>
                    <input name="course_rating" type="text" class="form-control" placeholder="<?php echo display('course_rating')?>" value="" >
                  </div>
          <div class="form-group col-sm-6">
                    <label for="course_discription"><?php echo display('course_discription')?> <i class="text-danger">*</i></label>
                    <textarea name="course_discription" type="text" class="form-control" placeholder="<?php echo display('course_discription')?>" value="" ></textarea>
          </div>
          
                  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('institute_name')?> </label>
                    <select class="form-control" name="institute_id" id="institute_id">
                        <option value="">Select Institute</option>
                        <?php if(!empty($ins_list)){ foreach($ins_list as $c){ ?>                                   
                        <option value="<?php echo $c->institute_id; ?>"><?php echo $c->institute_name; ?></option>
                    <?php } }?>
                    </select>
                  </div>
                   <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('meta_keywords')?> </label>
                    <input type="text" class="form-control" name="metakey" id="metakey" required="">
                       
                  </div>
          
                  <div class="form-group col-sm-6">
                    <label for="status"><?php echo display('status') ?></label>
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" ><?php echo display('active') ?>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" ><?php echo display('inactive') ?>
                        </label>
                    </div>
                  </div>
      
    </div>
  </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close()?>
  </div>
</div>

      <!-- END -->
				<div id="schedule" class="tab-content">
				
           <div class="col-sm-12">
          <button class="btn-success btn" data-toggle="modal" data-target="#schadd">Add</button>
                <table width="100%" id="dtBasicExample" class="table table-striped table-bordered table-sm">


                    <thead>

                        <tr> 


                            <th><?php echo display('serial') ?></th>


                            <th><?php echo display('date') ?></th>


                            <th><?php echo display('time') ?></th>

                            <th><?php echo display('availbility') ?></th>
              <th><?php echo display('type') ?></th>
              <th><?php echo display('Schedule_Status') ?></th>
                            <th><?php echo display('status') ?></th>


                            <th><?php echo display('action') ?></th>


                        </tr>


                    </thead>


                    <tbody>


                        <?php if (!empty($schdl_list)) { ?>


                            <?php $sl = 1; ?>


                            <?php foreach ($schdl_list as $schedule) { ?>


                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">


                                    <td><?php echo $sl; ?></td>


                                    <td><?php echo $schedule['schdl_dt']; ?></td>


                                    <td><?php echo $schedule['stm']; ?></td>


                                    <td><?php echo $schedule['avblty']; ?></td>


                                    <td><?php echo $schedule['ty']; ?></td>


                                    <td><?php if($schedule['schl_sts']==1){echo 'Booked';}else{ echo 'Not Booked';}; ?></td>

                                    <td><?php echo (($schedule['sts']==1)?display('active'):display('inactive')); ?></td>


                                    <td class="center">


                                        <a  class="btn btn-xs btn-primary" data-toggle="modal" data-target="#schupdate"><i class="fa fa-edit"></i></a> 


                                        <a href="<?php echo base_url("dashboard/delete_schedule/$schedule[id]") ?>" onclick="return confirm('<?php echo display('are_you_sure') ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> 


                                    </td>


                                </tr>


                                <?php $sl++; ?>

<!-- modal for update -->


 <div class="modal" tabindex="-1" role="dialog" id="schupdate">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Update Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo  form_open('dashboard/add_schedule/edit/'.$schedule['id'])?>
      
      <div class="row">
    <div class="col-xs-3">
 <label for="doctor_id" class="col-form-label"><?php echo display('institute_name') ?></label>                                
<select name="ins_id" id="ins_id" class="form-control" onchange="find_crs();">
  <option value="">----Select----</option>
  <?php foreach($ins_list as $c){ ?>                                   
                        <option value="<?php echo $c->institute_id; ?>" <?php if($course->institute_id==$c->institute_id){echo 'selected';}?>><?php echo $c->institute_name; ?></option>
                    <?php } ?>
</select>

                                </div>
                
                <div class="col-xs-3">
 <label for="doctor_id" class="col-form-label"><?php echo display('course_name') ?></label>                                
<select name="crs_id" id="crs_id" class="form-control">

</select>

                                </div>
                            

                                <div class="col-xs-3">
 <label for="doctor_id" class="col-form-label"><?php echo display('type') ?></label>                                
<select name="type" id="type" class="form-control">
                    <option value="">Select</option>
                    <option value="general" <?php if($schedule['ty']=='general'){ echo 'selected';}?>>General</option>
                    <option value="premium" <?php if($schedule['ty']=='premium'){ echo 'selected';}?>>Premium</option>
                    <option value="urgent" <?php if($schedule['ty']=='urgent'){ echo 'selected';}?>>Urgent</option>
</select>

                                </div>
                
                <div class="col-xs-3">
 <label for="doctor_id" class="col-form-label"><?php echo display('availablity') ?></label>                                
<select name="avail" id="avail" class="form-control">
                    <option value="">Select</option>
                    <option value="video" <?php if($schedule['avblty']=='video'){ echo 'selected';}?>>Video</option>
</select>

                                </div>
                
                <div class="col-xs-3 single">
 <label for="doctor_id" class="col-form-label"><?php echo display('date') ?></label>                                
<input type="date" class="form-control" name='date[]' id="date" value="<?php echo $schedule['schdl_dt']; ;?>" style="padding-top: 0px;">

                                </div>
 <div class="multiple">                           
<div class="form-group col-md-3" id="daterange1">
                  <label for="date">From</label>
                  <input type="date" class="form-control datepicker" name="fromdate[]" id="fromdate" style="padding-top: 0px;">
                </div>
                  <div class="form-group col-md-3" id="daterange2">
                  <label for="date">To</label>
                  <input type="date" class="form-control datepicker" name="todate[]" id="todate" style="padding-top: 0px;">
                </div>
</div>
      
                <div class="col-md-3">
                  <label for="stm">Start Time</label>
                  <input type="time" class="form-control" name="stm[]" id="stm" value="<?php $tm = explode('-',$schedule['stm']); echo $stm = $tm[0]; ?>" placeholder="Start Time" required style="padding-top: 0px;">
                 

                </div>
                <div class="col-md-3">
                  <label for="etm">End Time</label>
                  <input type="time" class="form-control" name="etm[]" id="etm" value="<?php $tm = explode('-',$schedule['stm']); echo $etm = $tm[1]; ?>" placeholder="End Time" required style="padding-top: 0px;">
                </div>
</div>
</div>


      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close()?>
  </div>
</div>


<!-- END -->




                            <?php } ?> 


                        <?php } ?> 


                    </tbody>


                </table>
              </div>
				</div>


        <!-- Modal for schedule -->
        
   <div class="modal" tabindex="-1" role="dialog" id="schadd">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo  form_open('dashboard/add_schedule')?>
        <div class="row">
       <div class="col-md-12">
<label class="form-group col-md-4"></label>
                                <div class="form-group col-md-8">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="dayrange" value="1" checked><?php echo display('single') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="dayrange" value="0"><?php echo display('multiple') ?>
                                        </label>
                                    </div>
                                </div>
</div>
</br></br>

  <div class="form-group col-md-3">
 <label for="doctor_id" class="col-form-label"><?php echo display('institute_name') ?></label>                                
<select name="ins_id" id="ins_id" class="form-control" onchange="find_crs();">
  <option value="">----Select----</option>
 <?php foreach($ins_list as $c){ ?>                                   
                        <option value="<?php echo $c->institute_id; ?>"><?php echo $c->institute_name; ?></option>
                    <?php } ?>
</select>
</div>
                
<div class="form-group col-md-3">
 <label for="doctor_id" class="col-form-label"><?php echo display('course_name') ?></label>                                
<select name="crs_id" id="crs_id" class="form-control">

</select>

</div>
<div class="form-group col-md-3">
 <label for="doctor_id" class="col-form-label"><?php echo display('type') ?></label>                                
<select name="type" id="type" class="form-control">
                    <option value="">Select</option>
                    <option value="general">General</option>
                    <option value="premium">Premium</option>
                    <option value="urgent">Urgent</option>
</select>

</div>
                
<div class="form-group col-md-3">
<label for="doctor_id" class="col-form-label"><?php echo display('availablity') ?></label>                                
<select name="avail" id="avail" class="form-control">
                    <option value="">Select</option>
                    <option value="video">Video</option>
</select>
</div>
<div class="form-group col-md-3 single">
 <label for="doctor_id" class="col-form-label"><?php echo display('date') ?></label>                                
<input type="date" class="form-control" name='date[]' id="date" value="" style="padding-top: 0px;">
</div>
 <div class="multiple">                           
<div class="form-group col-md-3" id="daterange1">
                  <label for="date">From</label>
                  <input type="date" class="form-control datepicker" name="fromdate[]" id="fromdate" style="padding-top: 0px;">
                </div>
                  <div class="form-group col-md-3" id="daterange2">
                  <label for="date">To</label>
                  <input type="date" class="form-control datepicker" name="todate[]" id="todate" style="padding-top: 0px;">
                </div>
</div>
      
                <div class="col-md-3">
                  <label for="stm">Start Time</label>
                  <input type="time" class="form-control" name="stm[]" id="stm" value="" placeholder="Start Time" required style="padding-top: 0px;">
                 

                </div>
                <div class="col-md-3">
                  <label for="etm">End Time</label>
                  <input type="time" class="form-control" name="etm[]" id="etm" value="" placeholder="End Time" required style="padding-top: 0px;">
                </div>
</div>

      
    </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close()?>
  </div>
</div>

        <!-- END -->
<!--------------------------------------------------------------------------University Tabs Ends----------------------------------------------->				
				
				
				
				<div id="Basic-detail" class="tab-content current">
				<?php // foreach($student_Details as $pdetail){ ?>
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
                <?php // } ?>
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
<th style="font-size: 10px;">Offer Letter fee</th>
<th style="font-size: 10px;">Application URL</th>
<th style="font-size: 10px;">App status</th>
<th style="font-size: 10px;">App Fee</th>
<th style="font-size: 10px;">Transcripts</th>
<th style="font-size: 10px;">LORs</th>
<th style="font-size: 10px;">SOP</th>
<th style="font-size: 10px;">CV</th>
<th style="font-size: 10px;">TOEFL/IELTS /PTE</th>
<th style="font-size: 10px;">F Comments </th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($all_institute as $ins_data){ ?>
<tr>
<td class=""><?php echo $i; ?></td>
<td><?php foreach($institute_list as $ins){if($ins->institute_id==$ins_data->institute_id){echo $ins->institute_name;}}?></td>
<td><?php foreach($course_list as $cl){if($cl->crs_id==$ins_data->course_id){echo $cl->course_name;}}?></td>
<td><?php foreach($discipline as $dc){if($dc->id==$ins_data->p_disc){echo $dc->discipline;}}?></td>
<td><?php foreach($level as $lvl){if($lvl->id==$ins_data->p_lvl){echo $lvl->level;}}?></td>
<td><?php foreach($length as $lg){if($lg->id==$ins_data->p_length){echo $lg->length;}}?></td>
<td class=""><?php echo $ins_data->t_fee; ?></td>
<td class=""><?php echo $ins_data->ol_fee; ?></td>
<td class=""><?php echo $ins_data->application_url; ?></td>
<td class=""><?php echo $ins_data->app_status; ?></td>
<td class=""><?php echo $ins_data->app_fee; ?></td>
<td class=""><?php echo $ins_data->transcript; ?></td>
<td class=""><?php echo $ins_data->lors; ?></td>
<td class=""><?php echo $ins_data->sop; ?></td>
<td class=""><?php echo $ins_data->cv; ?></td>
<td class=""><?php echo $ins_data->toefl; ?></td>
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