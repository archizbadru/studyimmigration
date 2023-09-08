<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        

        <!-- Facebook -->

        <meta property="og:url"           content="<?= current_url() ?>" />

        <meta property="og:type"          content="website" />

        <meta property="og:title"         content="<?= (!empty($setting->title)?strip_tags($setting->title):null) ?>" />

        <meta property="og:description"   content="<?= (!empty($item->description)?character_limiter(strip_tags($item->description),140):null) ?>" />

        <meta property="og:image"         content="<?= (!empty($setting->logo)?base_url($setting->logo):base_url('assets_web/images/icons/logo.png')) ?>" />





        <!-- Favicon -->

        <link rel="shortcut icon" href="<?= (!empty($setting->favicon)?base_url($setting->favicon):base_url('assets_web/images/icons/favicon.png')) ?>"/>

        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title><?= (!empty($setting->title)?$setting->title:null) ?></title>

        <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

        <!-- Bootstrap -->

        <link href="<?= base_url('assets_web/css/bootstrap.min.css') ?>" rel="stylesheet">

        <!-- Jquery Ui -->

        <link href="<?= base_url('assets_web/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- Font Awesome -->

        <link href="<?= base_url('assets_web/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- Flaticon -->

        <link href="<?= base_url('assets_web/css/flaticon.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- Owl Carousel -->

        <link href="<?= base_url('assets_web/owl-carousel/owl.carousel.css') ?>" rel="stylesheet" type="text/css"/>

        <link href="<?= base_url('assets_web/owl-carousel/owl.theme.css') ?>" rel="stylesheet" type="text/css"/>

        <link href="<?= base_url('assets_web/owl-carousel/owl.transitions.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- Custom Style Sheet -->

        <link href="<?= base_url('assets_web/css/style.css') ?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>

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
  width: 25%;
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
  padding-right: 0;
  padding-left: 0;     
}

#payment{
  height: auto;
  float: left;
  padding-right: 0;
  padding-left: 0;     
}
#agreement{
  height: auto;
  float: left;
  padding-right: 0;
  padding-left: 0;     
}
#english{
  height: auto;
  float: left;
  padding-right: 0;
  padding-left: 0;     
}
#qualification{
  height: auto;
  float: left;
  padding-right: 0;
  padding-left: 0;     
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

    

    <body id="page-top">

        <!-- Load Facebook SDK for JavaScript -->

        <div id="fb-root"></div>

        <script>(function(d, s, id) {

          var js, fjs = d.getElementsByTagName(s)[0];

          if (d.getElementById(id)) return;

          js = d.createElement(s); js.id = id;

          js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";

          fjs.parentNode.insertBefore(js, fjs);

        }(document, 'script', 'facebook-jssdk'));</script>





        <!-- Loader icon -->

        <div class="se-pre-con"></div> 



        <!-- Header section-->

        <?php @$this->load->view('website/includes/header2') ?>

 

        <!-- Slider section--> 

        <section class="">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12">

                        <div class="header-content">

                            <div class="header-content-inner"> 

                                <div class="ui breadcrumb">

                                    <a href="index.html" class="section"><?php echo display('home') ?></a>

                                    <div class="divider"> / </div>

                                    <div class="active section"><?php echo display('Profile') ?></div>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>










        <!-- Comment Form -->

        <section class="comment-form">

            <div class="container">

                <div class="col-sm-12">

               

	<div class="profile-main">
		<div class="profile-header">
		<?php foreach($student_Details as $pdetail){ ?>
			<div class="user-detail">
				<div class="user-image">
					<img src="http://nicesnippets.com/demo/up-profile.jpg">
				</div>
				<div class="user-data">
					<h2><?php echo $pdetail->name_prefix.''.$pdetail->name.' '.$pdetail->lastname; ?></h2>
					<span class="post-label"><?php echo $pdetail->Enquery_id; ?></span>
					<p>Applied at <strong>Space Internationals</strong><br>
					<i class="fa fa-map-marker" aria-hidden="true"></i>  <?php echo $pdetail->address; ?>
					</p>
				</div>
				<div class="social-icons">
					<i class="fa fa-facebook"></i>
					<i class="fa fa-twitter"></i>
					<i class="fa fa-linkedin"></i>
					<i class="fa fa-google"></i>
					<i class="fa fa-instagram"></i>
					<a href="#" type="button" class="btn btn-warning" style="display: unset;"><i class="fa fa-pencil-square-o" style="color:#fff;"></i></a>
				</div>
			</div>
		<?php } ?>
			<div class="tab-panel-main">
				<ul class="tabs">
					<li class="tab-link current" data-tab="Basic-detail">Basic Detail</li>
					<li class="tab-link" data-tab="Edu-detail">Document</li>
					<li class="tab-link" data-tab="Portfolio">Institute</li>
					<li class="tab-link" data-tab="qualification">Qualification</li>
					<li class="tab-link" data-tab="english">English Language</li>
					<li class="tab-link" data-tab="payment">Payment</li>
					<li class="tab-link" data-tab="agreement">Agreement</li>
				</ul>
				<div id="Basic-detail" class="tab-content current">
				<?php foreach($student_Details as $pdetail){ ?>
                                        <div class="col-sm-12">
                                            <div class="col-md-8"><label>Email ID</label></div>
                                            <div class="col-md-4"><p><?php echo $pdetail->email; ?></p></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-md-8"><label>Phone No</label></div>
                                            <div class="col-md-4"><p><?php echo $pdetail->phone; ?></p></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-md-8"><label>State</label></div>
                                            <div class="col-md-4"><p><?php foreach($state_list as $st){if($st->id==$pdetail->state_id){ echo $st->state;}} ?></p></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-md-8"><label>City</label></div>
                                            <div class="col-md-4"><p><?php foreach($city_list as $ct){if($ct->id==$pdetail->city_id){ echo $ct->city;}} ?></p></div>
                                        </div>
										<div class="col-sm-12">
                                            <div class="col-md-8"><label>Process</label></div>
                                            <div class="col-md-4"><p><?php foreach($process_list as $pl){if($pl->sb_id==$pdetail->product_id){ echo $pl->product_name;}} ?></p></div>
                                        </div>
										<div class="col-sm-12">
                                            <div class="col-md-8"><label>Gender</label></div>
                                            <div class="col-md-4"><p><?php if($pdetail->gender=='1'){ echo 'Male';}else if($pdetail->gender=='2'){echo 'Female';}else{ echo 'Other';} ?></p></div>
                                        </div>
										<div class="col-sm-12">
                                            <div class="col-md-8"><label>Enquiry Source</label></div>
                                            <div class="col-md-4"><p><?php foreach($source_list as $sl){if($sl->lsid==$pdetail->enquiry_source){ echo $sl->lead_name;}} ?></p></div>
                                        </div>
										<div class="col-sm-12">
                                            <div class="col-md-8"><label>Preferd Country</label></div>
                                            <div class="col-md-4"><p>
							<?php  
				                $cntry_ids=explode(',',$pdetail->country_id);
                                foreach($cntry_ids as $ids){
                                foreach($country_list as $c_name){  
                                if($c_name->id_c == $ids){
                                $cname= $c_name->country_name;
                                     }
                                }
				   echo $cname.''.',';
				            } ?>
											
											</p></div>
                                        </div>
										<div class="col-sm-12">
                                            <div class="col-md-8"><label>Remark</label></div>
                                            <div class="col-md-4"><p><?php echo $pdetail->lead_comment; ?></p></div>
                                        </div>
                <?php } ?>
				</div>
				<div id="Edu-detail" class="tab-content">
					
				</div>
				<div id="Portfolio" class="tab-content">
					
				</div>
				<div id="qualification" class="tab-content">
					qualification
				</div>
				<div id="english" class="tab-content">
					english
				</div>
				<div id="payment" class="tab-content">
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Sr.No</th>
      <th class="th-sm">Payment Date</th>
      <th class="th-sm">Payment Amount</th>
      <th class="th-sm">Payment Status</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($invoice_details)){ ?>
  <?php $i=1; foreach($invoice_details as $ins){ ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $ins->ins_dt; ?></td>
      <td><?php echo $ins->ins_amt; ?></td>
	  <td>
	  <?php if($ins->pay_status=='1'){ ?>
                <div class="col-md-3"><span class="btn btn-success">Paid </span></div>
                    <?php }else{ ?>
                <div class="col-md-3"><span class="btn btn-danger">Unpaid </span></div>
      <?php } ?>
	  </td>
	</tr>
  <?php $i++; } ?>
  <?php }else{?>
  <tr>
  <td colspan="6"><?php echo 'No Data Found'; ?></td>
  </tr>
  <?php } ?>
  </tbody>
</table>
				</div>
				<div id="agreement" class="tab-content">
					<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Sr.No</th>
      <th class="th-sm">Agreement Name</th>
      <th class="th-sm">Mobile No</th>
      <th class="th-sm">Email Id</th>
	  <th class="th-sm">Address</th>
	  <th class="th-sm">Document file</th>
	  <th class="th-sm">Created Date</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($agrrem_doc)){ ?>
  <?php $i=1; foreach($agrrem_doc as $agrmt){ ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $agrmt->agg_name; ?></td>
      <td><?php echo $agrmt->agg_phone; ?></td>
	  <td><?php echo $agrmt->agg_email; ?></td>
	  <td><?php echo $agrmt->agg_adrs; ?></td>
	  <td><a target="_blank" href="<?php echo base_url($agrmt->file); ?>"><i class="fa fa-file-image-o" aria-hidden="true" style="font-size:20px;margin-top:-30px;color:#10A3FF;"></i></a></td>
      <td><?php echo $agrmt->created_date; ?></td>
	</tr>
  <?php $i++; } ?>
  <?php }else{?>
  <tr>
  <td colspan="6"><?php echo 'No Data Found'; ?></td>
  </tr>
  <?php } ?>
  </tbody>
</table> 
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
		<div class="footerp">
			<p><strong>Web Social</strong></p><br>
			<div class="footerp-box"><i class="fa fa-facebook"></i></div>
			<div class="footerp-box"><i class="fa fa-twitter"></i></div>
			<div class="footerp-box"><i class="fa fa-linkedin"></i></div>
			<div class="footerp-box"><i class="fa fa-google"></i></div>
			<div class="footerp-box"><i class="fa fa-instagram"></i></div>
		</div>
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



        <!-- Footer Section -->

        <?php @$this->load->view('website/includes/footer') ?>







        

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

        <script src="<?= base_url('assets_web/js/jquery.min.js" type="text/javascript') ?>"></script> 

        <!-- Include all compiled plugins (below), or include individual files as needed -->

        <script src="<?= base_url('assets_web/js/bootstrap.min.js') ?>"></script> 

        <!-- owl carousel js -->

        <script src="<?= base_url('assets_web/owl-carousel/owl.carousel.min.js') ?>" type="text/javascript"></script>

        <!-- Plugin JavaScript -->

        <script src="<?= base_url('assets_web/js/jquery.easing.min.js') ?>" type="text/javascript"></script>

        <!-- Jquery Ui -->

        <script src="<?= base_url('assets_web/js/jquery-ui.min.js') ?>" type="text/javascript"></script>

        <!-- Custom Js -->

        <script src="<?= base_url('assets_web/js/custom.js') ?>" type="text/javascript"></script> 
 <script>
     $(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
 </script>


    </body>

</html>



 