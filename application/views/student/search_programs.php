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
	<?php if(($this->session->companey_id!=67)){ ?>
			<div class="form-group col-lg-12">
            <label class="col-form-label">Choose Date</label>            
            <input type="date" id="date" class="form-control" name="date" value="<?php if(!empty($filter)){ echo $filter[0];}?>" style="border-radius:0px;">
            </div>
	<?php } ?>
            <div class="form-group col-lg-12">
            <label class="col-form-label">Choose Country</label>            
            <select class="form-control" id="cntry" name="cntry" onchange="find_state()">
			<option value="">----Select Country----</option>
            <?php foreach($county_list as $cntry){ ?>			
                <option value="<?php echo $cntry->id_c; ?>" <?php if(!empty($filter)){ if($cntry->id_c==$filter[1]){echo 'selected';}}?>><?php echo $cntry->country_name; ?></option> 
			<?php } ?>				
            </select>
            </div>
			
			<div class="form-group col-lg-12">
            <label class="col-form-label">Choose State</label>            
            <select class="form-control" id="state_id" name="state_id">
			<option value="">----Select State----</option>
            <?php foreach($state_list as $state){ ?>			
                <option value="<?php echo $state->id; ?>" <?php if(!empty($filter)){ if($state->id==$filter[7]){echo 'selected';}}?>><?php echo $state->state; ?></option> 
			<?php } ?>				
            </select>
            </div>
			
			<?php if($this->session->userdata('companey_id')==67){ ?>
			
			<div class="form-group col-sm-12">
                    <label for="country_name"><?php echo display('course_ielts')?> </label>
                    <select class="form-control" name="ielts" id="ielts">
                        <option value="" selected>Select IELTS</option>                                   
                        <option value="6.5/55" <?php if(!empty($filter)){ if($filter[8]=='6.5/55'){echo 'selected';}}?>>6.5/55</option>
						<option value="6/53" <?php if(!empty($filter)){ if($filter[8]=='6/53'){echo 'selected';}}?>>6/53</option>
						<option value="5.5/50" <?php if(!empty($filter)){ if($filter[8]=='5.5/50'){echo 'selected';}}?>>5.5/50</option>
						<option value="5/48" <?php if(!empty($filter)){ if($filter[8]=='5/48'){echo 'selected';}}?>>5/48</option>
						<option value="Without IELTS" <?php if(!empty($filter)){ if($filter[8]=='Without IELTS'){echo 'selected';}}?>>Without IELTS</option>
                    </select>
                  </div>
			      
			<div class="form-group col-sm-12">
                    <label for="country_name"><?php echo display('program_level')?> </label>
                    <select class="form-control" name="level" id="level" onchange="find_level()">
                        <option value="" selected>Select level</option>
                        <?php foreach($level as $lc){ ?>                                   
                        <option value="<?php echo $lc->id; ?>" <?php if(!empty($filter)){ if($lc->id==$filter[2]){echo 'selected';}}?>><?php echo $lc->level; ?></option>
                    <?php } ?>
                    </select>
                  </div>
				  
			<div class="form-group col-sm-12">
                    <label for="country_name"><?php echo display('program_length')?> </label>
                    <select class="form-control" name="length" id="length">
                        <option value="" selected>Select length</option>
                        <?php 
                            if (!empty($length)) {
                                foreach($length as $lg){ ?>                                   
                                    <option value="<?php echo $lg->id; ?>" <?php if(!empty($filter)){ if($lg->id==$filter[3]){echo 'selected';}}?>><?php echo $lg->length; ?></option>
                                <?php }
                            } ?>
                    </select>
                  </div>
				  
			<div class="form-group col-sm-12">
                    <label for="country_name"><?php echo display('program_discipline')?> </label>
                    <select class="form-control" name="discipline" id="discipline" onchange="find_institute()">
                        <option value="" selected>Select discipline</option>
                        <?php foreach($discipline as $dc){ ?>                                   
                        <option value="<?php echo $dc->id; ?>" <?php if(!empty($filter)){ if($dc->id==$filter[4]){echo 'selected';}}?>><?php echo $dc->discipline; ?></option>
                    <?php } ?>
                    </select>
                  </div>
			<?php } ?>
			
			<div class="form-group col-lg-12">
            <label class="col-form-label">Choose Institute</label>            
            <select class="form-control" id="ins_id" name="ins_id" onchange="find_course()">
			<option value="">----Select Institutes----</option>
            <?php foreach($ins_list as $inst){ ?>			
                <option value="<?php echo $inst->institute_id; ?>" <?php if(!empty($filter)){ if($inst->institute_id==$filter[5]){echo 'selected';}}?>><?php echo $inst->institute_name; ?></option> 
			<?php } ?>	
            </select>
            </div>
			
			<div class="form-group col-lg-12">
            <label class="col-form-label">Choose Course</label>            
            <select class="form-control" id="crs_id" name="crs_id">
			<option value="">----Select Course----</option>
            <?php foreach($crs_list as $crs){ ?>			
                <option value="<?php echo $crs->crs_id; ?>" <?php if(!empty($filter)){ if($crs->crs_id==$filter[6]){echo 'selected';}}?>><?php foreach($course as $cr){ if($cr->id==$crs->course_name){ echo $cr->course_name;}} ?></option> 
			<?php } ?>	
            </select>
            </div>
			
          
            <div class="form-group col-lg-6">        
            <input type="button" class="btn btn-warning col-lg-12" id="reset" onclick="clearFields()"  value="Reset" >      
            </div>
			<div class="form-group col-lg-6">        
            <input  type="submit" class="btn btn-primary col-lg-12" id="get_uni"  value="Explore" >      
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
<input type="text" placeholder="Search Now" name="keyword" value="<?=!empty($_GET['keyword'])?$_GET['keyword']:''?>">
<button type="submit" class="site-btn">SEARCH</button>
</form>
</div>
</div>
<div  id="universities">					    										
<?php if(!empty($courses)) { 
include("course_list.php");
 } ?>
</div>
</div>
<div class="col-lg-3" style="height:800px;overflow-y: scroll;">
<?php foreach($vid_list as $vedio){ ?>
<div class="checkout__order">
<h4><?php echo $vedio->title; ?></h4>
<iframe width="100%" height="100%" src="<?php echo $vedio->link; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<div class="checkout__order__subtotal">Watch Now<span><a href="#" class="btn btn-warning"><span><i class="fa fa-comments-o" aria-hidden="true"></i></span></a></span></div>
<p><?php echo $vedio->des; ?></p>
</div>
<?php } ?>
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
		$(document).ready(function() { $("#level").select2(); });
		$(document).ready(function() { $("#length").select2(); });
		$(document).ready(function() { $("#discipline").select2(); });
		$(document).ready(function() { $("#state_id").select2(); });
		$(document).ready(function() { $("#ielts").select2(); });
</script>
    <script type="text/javascript">
function clearFields() {
    //document.getElementById("date").value=""
	$( "#ins_id" ).val('').trigger('change');
	$( "#cntry" ).val('').trigger('change');
	$( "#crs_id" ).val('').trigger('change');
	$( "#level" ).val('').trigger('change');
	$( "#length" ).val('').trigger('change');
	$( "#discipline" ).val('').trigger('change');
	$( "#state_id" ).val('').trigger('change');
	$( "#ielts" ).val('').trigger('change');
}
</script>
<script>
function find_level() { 
            var l_stage = $("#level").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_length_lvl',
            data: {lead_stage:l_stage},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select Level---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].length)+'</option>';
                }
                
                $("#length").html(html);
                
            }
            
            
            });
            }	
</script>
<script>
function find_state() { 
            var l_stage = $("#cntry").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>dashboard/select_state',
            data: {lead_stage:l_stage},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select State---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].state)+'</option>';
                }
                
                $("#state_id").html(html);
                
            }
            
            
            });
            }
			
function find_institute() { 
            var ctnry = $("#cntry").val();
			var sta = $("#state_id").val();
			var lvl = $("#level").val();
			var lgth = $("#length").val();
			var disc = $("#discipline").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>dashboard/select_ins',
            data: {l_con:ctnry,l_sta:sta,l_lvl:lvl,l_lgth:lgth,l_disc:disc},
            
            success:function(data){
                //alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select Institute---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].institute_id)+'">'+(obj[i].institute_name)+'</option>';
                }
                
                $("#ins_id").html(html);
                
            }
            
            
            });
            }
function find_course() { 
            var ctnry = $("#cntry").val();
			var sta = $("#state_id").val();
			var lvl = $("#level").val();
			var lgth = $("#length").val();
			var disc = $("#discipline").val();
			var ins = $("#ins_id").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>dashboard/select_crs',
            data: {l_con:ctnry,l_sta:sta,l_lvl:lvl,l_lgth:lgth,l_disc:disc,l_ins:ins},
            
            success:function(data){
                //alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select Course---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].crs_id)+'">'+(obj[i].cname)+'</option>';
                }
                
                $("#crs_id").html(html);
                
            }
            
            
            });
            }			
</script>
<script src="<?php echo base_url()?>demo/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/jquery.slicknav.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/mixitup.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/main.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?= base_url('assets_web/js/custom.js') ?>" type="text/javascript"></script> 