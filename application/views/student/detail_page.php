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


        <!-- Loader icon -->

        <div class="se-pre-con"></div> 
        <!-- Comment Form -->
		
        <section class="comment-form" style="padding-top:2%;">

            <div class="container-fluid">

                <div class="col-lg-12">

               

	
<section class="hero">
<div class="container-fluid">
<div class="row">
<div class="col-lg-8" style="height:600px;overflow-y: scroll;">
<?php foreach ($ins_details as $key => $value) {  ?>
<?php if(!empty($value->profile_image)){ ?>
							<img class="img-responsive" src="<?php echo 'https://student.spaceinternationals.com/new_crm/'.$value->profile_image; ?>" style="">
					<?php }else{ ?>
					       <img class="img-responsive" src="<?php echo base_url('assets/images/NoPicAvailable.png'); ?>" style="">
					<?php } ?>
<?php } ?>
<div  id="universities">	
<div class="blog__details__text">
<div class="cycle-tab-container">
<div class="tab-content">
<?php foreach($ins_details as $keys => $value){ ?>
</br>
<h4><?php echo $value->institute_name; ?></h4>
</br>
 <div><?php echo $value->ins_desc; ?></div>
  <?php } ?>
</div>
</div>
</div>                        
</div>

</div>
<div class="col-lg-4" style="height:600px;overflow-y: scroll;">
<?php foreach($crs_details as $crs){ ?>
<div class="blog__sidebar__item">
<h4>1-Course Name</h4>
<div class="blog__sidebar__item__tags">
<a href="#"><?php echo $crs->course_name; ?></a>
</div></hr>
<h4>2-IELTS Name</h4>
<div class="blog__sidebar__item__tags">
<a href="#"><?php echo $crs->course_ielts; ?></a>
</div></hr>
<h4>3-Discipline Name</h4>
<div class="blog__sidebar__item__tags">
<a href="#"><?php echo $crs->discipline; ?></a>
</div></hr>
<h4>4-Level Name</h4>
<div class="blog__sidebar__item__tags">
<a href="#"><?php echo $crs->level; ?></a>
</div></hr>
<h4>5-Length Name</h4>
<div class="blog__sidebar__item__tags">
<a href="#"><?php echo $crs->length; ?></a>
</div></hr>
</div>
<?php } ?>
</div>
</div>
</div>
</section>


             </div>      

                </div>

        </section>

<script src="<?php echo base_url()?>demo/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/jquery.slicknav.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/mixitup.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/main.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="text/javascript"></script>
<script src="<?= base_url('assets_web/js/custom.js') ?>" type="text/javascript"></script> 