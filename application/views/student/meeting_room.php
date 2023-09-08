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

.owl-nav{
	    position: absolute;
    top: 0px;
    width: 100%;
	    height: 10px;
}
button.owl-prev{
	left: 10px;
    font-size: 142px;
    float: left;
}
button.owl-next{
	right: 10px;
    font-size: 142px;
    float: right;
}
button.owl-prev span, button.owl-next span{
	    font-size: 148px;
}

.containerss {
  position: relative;
  width: 100%;
}

.image {
  display: block;
  width: 100%;
  height: auto;
}

.overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(127,173,57,.9);
  overflow: hidden;
  width: 100%;
  height: 0;
  transition: .5s ease;
}

.containerss:hover .overlay {
  height: 50%;
  opacity:1.8;
}

.text {
  color: white;
  padding:10px;
  font-size: 12px;
}
</style>


        <!-- Loader icon -->

        <div class="se-pre-con"></div> 
        <!-- Comment Form -->
		
        <section class="comment-form" style="padding-top:2%;">

            <div class="container-fluid">

                <div class="col-lg-12">

               

	
<section class="hero">
<div class="container-fluid">
<div class="row">
<div class="col-lg-2" style="height:800px;overflow-y: scroll;">
<div class="hero__categories">
<div class="hero__categories__all">
<span>Filter Panel</span>
</div>
<div class="card card-body" style="padding-top:10%;">
<form action="<?php echo base_url('dashboard/get_uni_data');?>" method="post" class="form-inner">      
        <div class="row">
            
			<div class="form-group col-lg-12">
            <label class="col-form-label">Choose Date</label>            
            <input type="date" id="date" class="form-control" name="date">
            </div>
			
            <div class="form-group col-lg-12">
            <label class="col-form-label">Choose Country</label>            
            <select class="form-control" id="cntry" name="cntry">
			<option value="">----Select Country----</option>
            <?php foreach($county_list as $cntry){ ?>			
                <option value="<?php echo $cntry->id_c; ?>"><?php echo $cntry->country_name; ?></option> 
			<?php } ?>				
            </select>
            </div>
			
			<div class="form-group col-lg-12">
            <label class="col-form-label">Choose Institute</label>            
            <select class="form-control" id="ins_id" name="ins_id">
			<option value="">----Select Institutes----</option>
            <?php foreach($ins_list as $inst){ ?>			
                <option value="<?php echo $inst->institute_id; ?>"><?php echo $inst->institute_name; ?></option> 
			<?php } ?>	
            </select>
            </div>
			
			<div class="form-group col-lg-12">
            <label class="col-form-label">Choose Course</label>            
            <select class="form-control" id="crs_id" name="crs_id">
			<option value="">----Select Course----</option>
            <?php foreach($crs_list as $crs){ ?>			
                <option value="<?php echo $crs->course_name; ?>"><?php echo $crs->course_name; ?></option> 
			<?php } ?>	
            </select>
            </div>
          
            <div class="form-group col-lg-6">        
            <input type="button" class="btn btn-warning col-lg-12" id="reset" onclick="clearFields()"  value="Reset" >      
            </div>
			<div class="form-group col-lg-6">        
            <input  type="submit" class="btn btn-success col-lg-12" id="get_uni"  value="Explore" >      
            </div>
                          
        </div>
</form>
</div>
</div>
</div>
<div class="col-lg-7" style="height:800px;overflow-y: scroll;">
<div class="hero__search">
<div class="hero__search__form">
<form action="#">
<div class="hero__search__categories">
All Categories
</div>
<input type="text" placeholder="What do yo u need?">
<button type="submit" class="site-btn">SEARCH</button>
</form>
</div>
</div>
<div  id="universities">					    										
<video width="100%" height="600px" controls>
  <source src="videos/1.mp4" type="video/mp4">
</video>	                        
</div>
</div>
<div class="col-lg-3" style="height:800px;overflow-y: scroll;">
<div class="checkout__order">
<h4>Latest Programs</h4>
<iframe width="100%" height="100%" src="https://www.youtube.com/embed/poLa_d1SjZ0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<div class="checkout__order__subtotal">Watch <span><a href="#" class="btn btn-warning"><span><i class="fa fa-comments-o" aria-hidden="true"></i></span></a></span></div>
<p>Are you keen on pursuing higher education from a foreign University but doubts about the courses, colleges, exams and application process holding you back to choose study abroad option?</p>
</div>

<div class="checkout__order">
<h4>Latest Programs</h4>
<iframe width="100%" height="100%" src="https://www.youtube.com/embed/KKI6-qGZM3E" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><div class="checkout__order__subtotal">Watch <span><a href="#" class="btn btn-warning"><span><i class="fa fa-comments-o" aria-hidden="true"></i></span></a></span></div>
<p>This 29th episode will give you a broad idea about the education loan repayment process in India. For assistance on your education loan, request a call back .</p>
</div>

</div>
</div>
</div>
</section>


             </div>      

                </div>

        </section>

<script>
        $(document).ready(function() { $("#ins_id").select2(); });
		$(document).ready(function() { $("#cntry").select2(); });
		$(document).ready(function() { $("#crs_id").select2(); });
</script>
    <script type="text/javascript">
function clearFields() {
    document.getElementById("date").value=""
	$( "#ins_id" ).val('').trigger('change');
	$( "#cntry" ).val('').trigger('change');
	$( "#crs_id" ).val('').trigger('change');
}
</script>
<script>
    /* $("#get_uni").click(function(){
    var cntyid = $("#cntry").val();
	var insid = $("#ins_id").val();
	var crsid = $("#crs_id").val();	
	var crs = btoa(crsid);
	var ins = btoa(insid);
	var cntry = btoa(cntyid);
    $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>dashboard/get_uni_data',
   data: {s_cont:cntry,s_ins:ins,s_crs:crs},
   })
   .done(function(data){
       $('#universities').html(data);
   })
   .fail(function() {
   alert( "fail!" );   
   });  
   }); */	
</script>
<script src="<?php echo base_url()?>demo/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/jquery.slicknav.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/mixitup.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/main.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="text/javascript"></script>


        <script src="<?= base_url('assets_web/js/custom.js') ?>" type="text/javascript"></script> 