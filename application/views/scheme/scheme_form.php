
<style>
	.pfc-datepicker{
		width:100%;
	}
</style>
				<!--Header submenu -->
				<div class="bg-white p-3 header-secondary header-submenu">
					<div class="container ">
						<div class="row">
							<div class="col">
								<div class="d-flex">
								<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="#">Scheme</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Scheme</li>
							</ol><!-- End breadcrumb -->
								</div>
							</div>
							<div class="col col-auto">
								
								<a class="btn btn-success mt-4 mt-sm-0" href="<?= base_url('scheme')?>"><i class="fe fe-plus mr-1 mt-1"></i>Scheme List</a>
							</div>
						</div>
					</div>
				</div><!--End Header submenu -->
<br>
                <!-- app-content-->
				<div class="container content-area">
					<div class="side-app">
						<!-- row -->
						<div class="row">
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Add Scheme</h3>
									</div>
									<div class="card-body p-6">
										<div class="panel panel-primary">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1 ">
													<!-- Tabs -->
													<ul class="nav panel-tabs">
														<li class=""><a href="#tab5" class="active" data-toggle="tab">Product Scheme</a></li>
														<li><a href="#tab6" data-toggle="tab">Region Scheme</a></li>
														<li><a href="#tab7" data-toggle="tab">Payment Scheme</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body">
												<div class="tab-content">
											<div class="tab-pane active " id="tab5">
											<div>
												<div id="step-10" class="">
												<?php echo form_open('scheme/add_product_scheme','id="scheme"') ?>
												<input type="hidden" name="w_id">
											    <div class="row">
												<div class="col-md-6">
												     <label>From</label>
													 <div class="input-group">
												     <div class="input-group-addon">
													<div class="input-group-text">
														<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
													</div>
												</div>
												
												<input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" id="fromdate" name="fromdate" required="" style = "width:100%;">
											</div>
											</div>
												<div class="col-md-6">
												     <label>To</label>
													 <div class="input-group">
												     <div class="input-group-addon">
													<div class="input-group-text">
														<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
													</div>
												</div>
												
												<input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" id="todate" name="todate" required=""   style = "width:100%;">
											</div>
											</div>
											
											</div>
												<div class="row">
												<div class="col-md-6">
												<div class="form-group">
												<label>Brand</label>
												<select class="form-control" id="brand" name="brand" onchange="find_product();">
												<option value="">Select</option>
												<?php if(!empty($brand)){
												foreach($brand as $blist){
												?>
												<option value="<?= $blist->id?>"><?= $blist->brand_name?></option>
												<?php }}?>
												</select>		
												 </div>
												</div>
												<div class="col-md-6">
														<div class="form-group">
														<label>Product</label>
														<select class="form-control" id="product" name="product">
															<option value="">Select</option>
															<?php if($pro_list){
															foreach($pro_list as $prolist){
															?>
															<option value="<?= $prolist->pid?>"><?= $prolist->pro_name?></option>
															<?php }}?>
														</select>
														</div>
												</div>
											</div>
										
							
											<div id="addrow">
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<label>From (QTY)</label>
														<input type="text" class="form-control" id="fromqty" name="fromqty[]" required="">
													</div>
													
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>To(QTY)</label>
														<input type="text" class="form-control" id="toqty" name="toqty[]" required="">
														</div>
												</div>
											<div class="col-md-2">
											<div class="form-group">
											 <label>Discount(%)</label>
											 <input type="text" class="form-control" id="discount" name="discount[]">
											 </div>	
											</div>
                                            <div class="col-md-2">
                                            	<div class="form-group" style="margin-top: 31px;">
                                            
												 <a name="add" id="add" class="btn btn-success">Add More</a>
												</div>
												</div>
											</div>
											</div>											 
											<div class="col-12">
												
												<button type="submit" class="btn btn-primary">Add</button>

											</div>
												<?php echo form_close();?>
											</div>
											</div>
											</div>
										
<!---------------------------------------------------Region Scheme-------------------------------------------------------------------------------------------------->

										<div class="tab-pane " id="tab6">

										   <div>
											<div id="step-10" class="">
											
												<?php echo form_open('scheme/add_region_scheme') ?>
												<input type="hidden" name="w_id">
											    <div class="row">
												<div class="col-md-6">
												     <label>From</label>
													 <div class="input-group">
												     <div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
													</div>
												</div>
												
												<input class="form-control rfc-datepicker" placeholder="MM/DD/YYYY" type="text" id="fromdate" name="fromdate" required="">
											</div>
											</div>
												<div class="col-md-6">
												     <label>To</label>
													 <div class="input-group">
												     <div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
													</div>
												</div>
												
												<input class="form-control rfc-datepicker" placeholder="MM/DD/YYYY" type="text" id="todate" name="todate" required="">
											</div>
											</div>
											
											</div>
												<div class="row">
												<div class="col-md-6">
												<div class="form-group">
												<label>Region</label>
												<select class="form-control" id="region" name="region" required="">
												<option value="">Select</option>
												<?php if(!empty($region)){
												foreach($region as $rg){
												?>
												<option value="<?= $rg->rid?>"><?= $rg->region_name?></option>
												<?php }}?>
												</select>		
												 </div>
												</div>
												<div class="col-md-6">
														<div class="form-group">
														<label>User Type</label>
														<select class="form-control" id="utype" name="utype" required="">
															<option value="">Select</option>
															<?php if(!empty($utype_list)){
															foreach($utype_list as $utypelist){
															?>
															<option value="<?= $utypelist->id?>"><?= $utypelist->user_type?></option>
															<?php }}?>
														</select>
														</div>
												</div>
											</div>
										
							
											<div id="addrow1">
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<label>From (QTY)</label>
														<input type="text" class="form-control" id="fromqty" name="fromqty[]" required="">
													</div>
													
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>To(QTY)</label>
														<input type="text" class="form-control" id="toqty" name="toqty[]" required="">
														</div>
												</div>
											<div class="col-md-2">
											<div class="form-group">
											 <label>Discount(%)</label>
											 <input type="text" class="form-control" id="discount" name="discount[]">
											 </div>	
											</div>
                                            <div class="col-md-2">
                                            	<div class="form-group" style="margin-top: 31px;">
                                            
												 <a name="add1" id="add1" class="btn btn-success">Add More</a>
												</div>
												</div>
											</div>
											</div>											 
											<div class="col-12">
												<button type="submit" class="btn btn-primary">Add</button>
											</div>
												<?php echo form_close();?>
											</div>
											</div>			
											</div>
											<div class="tab-pane " id="tab7">

											<div>
											<div id="step-10" class="">
											
											<?php echo form_open('scheme/add_payment_scheme') ?>
											<input type="hidden" name="w_id">
											 <div class="row">
											 <div class="col-md-6">
											 <label>From</label>
											 <div class="input-group">
												<div class="input-group-prepend">
												<div class="input-group-text">
													<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
												</div>
												</div>
												
												<input class="form-control pfc-datepicker" placeholder="MM/DD/YYYY" type="text" id="fromdate" name="fromdate" required="">
											</div>
											</div>
												<div class="col-md-6">
												     <label>To</label>
													 <div class="input-group">
												     <div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
													</div>
												</div>
												
												<input class="form-control pfc-datepicker" placeholder="MM/DD/YYYY" type="text" id="todate" name="todate" required="">
											</div>
											</div>
											
											</div>
												<div class="row">
												<div class="col-md-6">
												<div class="form-group">
												<label>Mode of payment</label>
												<select class="form-control" id="mop" name="mop" required="">
												<option value="">Select</option>
											<?php if(!empty($paymode)){
													foreach($paymode as $ind => $pay){
														
														?><option value = "<?php echo $pay->id  ?>"><?php echo $pay->title; ?></option><?php	
													}
													
												} ?>
							
												</select>		
												 </div>
												</div>
											</div>
										
							
											<div id="addrow2">
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<label>From (QTY)</label>
														<input type="text" class="form-control" id="fromqty" name="fromqty[]" required="">
													</div>
													
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>To(QTY)</label>
														<input type="text" class="form-control" id="toqty" name="toqty[]" required="">
														</div>
												</div>
											<div class="col-md-2">
											<div class="form-group">
											 <label>Discount(%)</label>
											 <input type="text" class="form-control" id="discount" name="discount[]">
											 </div>	
											</div>
                                            <div class="col-md-2">
                                            	<div class="form-group" style="margin-top: 31px;">
                                            
												<a name="add2" id="add2" class="btn btn-success">Add More</a>
												</div>
												</div>
											</div>
											</div>											 
											<div class="col-12">
												<button type="submit" class="btn btn-primary">Add</button>
											</div>
												<?php echo form_close();?>
											</div>
											</div>

											</div>
											</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- col end -->
						</div>
						<!-- row end -->
					</div>
				</div>
				<!-- End app-content-->
			</div>
		</div>
		<!-- End Page -->
<script src="<?php echo base_url(); ?>assets/plugins/date-picker/jquery-ui.js"></script>
<script>
	function find_product() {
       
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>scheme/get_pro_bybrand',
            data: $('#scheme').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('product').innerHTML=data;
            }else{
              document.getElementById('product').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
</script>

<script>  
 $(document).ready(function(){  
      var i=1;  
      var max_fields = 10;

  $('#add').click(function(){  
           
  if(i< max_fields){
    i++;
           // $('#addrow').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  

    // $('#addrow').append('<div class="row" id="row'+i+'"><div class="form-group col-md-2"><label>From(QTY)</label></div><div class="form-group col-md-2"><div\n\ class="custom-file"><input type="file" class="custom-file-input" id="file" name="file[]"><label class="custom-file-label" for="customFile">Choose file</label>\n\</div></div><div class="form-group col-md-4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div>\n\</div>');


    $('#addrow').append('<div class="row" id="row'+i+'"><div class="col-md-2"><div class="form-group"><label>From (QTY)</label><input type="text" class="form-control" id="fromqty" name="fromqty[]"></div></div><div class="col-md-2"><div class="form-group"><label>To(QTY)</label><input type="text" class="form-control" id="toqty" name="toqty[]"></div></div><div class="col-md-2"><div class="form-group"><label>Discount(%)</label><input type="text" class="form-control" id="discount" name="discount[]"></div></div><div class="form-group col-md-2" style="margin-top: 31px;"><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');

    }  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      // $('#submit').click(function(){            
      //      $.ajax({  
      //           url:"name.php",  
      //           method:"POST",  
      //           data:$('#add_name').serialize(),  
      //           success:function(data)  
      //           {  
      //                alert(data);  
      //                $('#add_name')[0].reset();  
      //           }  
      //      });  
      // }); 


   $('#add1').click(function(){  
           
  if(i< max_fields){
    i++;
           // $('#addrow').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  

    // $('#addrow').append('<div class="row" id="row'+i+'"><div class="form-group col-md-2"><label>From(QTY)</label></div><div class="form-group col-md-2"><div\n\ class="custom-file"><input type="file" class="custom-file-input" id="file" name="file[]"><label class="custom-file-label" for="customFile">Choose file</label>\n\</div></div><div class="form-group col-md-4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div>\n\</div>');


    $('#addrow1').append('<div class="row" id="row'+i+'"><div class="col-md-2"><div class="form-group"><label>From (QTY)</label><input type="text" class="form-control" id="fromqty" name="fromqty[]"></div></div><div class="col-md-2"><div class="form-group"><label>To(QTY)</label><input type="text" class="form-control" id="toqty" name="toqty[]"></div></div><div class="col-md-2"><div class="form-group"><label>Discount(%)</label><input type="text" class="form-control" id="discount" name="discount[]"></div></div><div class="form-group col-md-2" style="margin-top: 31px;"><button name="remove" id="'+i+'" class="btn btn-danger btn_remove1">X</button></div></div>');

    }  
      }); 

      $(document).on('click', '.btn_remove1', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 

 $('#add2').click(function(){  
      
	  
  if(i< max_fields){
    i++;
           // $('#addrow').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  

    // $('#addrow').append('<div class="row" id="row'+i+'"><div class="form-group col-md-2"><label>From(QTY)</label></div><div class="form-group col-md-2"><div\n\ class="custom-file"><input type="file" class="custom-file-input" id="file" name="file[]"><label class="custom-file-label" for="customFile">Choose file</label>\n\</div></div><div class="form-group col-md-4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div>\n\</div>');


    $('#addrow2').append('<div class="row" id="row'+i+'"><div class="col-md-2"><div class="form-group"><label>From (QTY)</label><input type="text" class="form-control" id="fromqty" name="fromqty[]"></div></div><div class="col-md-2"><div class="form-group"><label>To(QTY)</label><input type="text" class="form-control" id="toqty" name="toqty[]"></div></div><div class="col-md-2"><div class="form-group"><label>Discount(%)</label><input type="text" class="form-control" id="discount" name="discount[]"></div></div><div class="form-group col-md-2" style="margin-top: 31px;"><button name="remove" id="'+i+'" class="btn btn-danger btn_remove2">X</button></div></div>');

    }  
      }); 

      $(document).on('click', '.btn_remove2', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 

 });  
</script>
<script>
	$(document).on("click", ".tabs-menu1 li", function(){
		
		setTimeout(function(){
			$(".fc-datepicker,.rfc-datepicker,pfc-datepicker").datepicker();
			$(".rfc-datepicker,pfc-datepicker").datepicker();
			$(".pfc-datepicker").datepicker();
		},900);
	});


	$(document).ready(function(){
		        
		$(".fc-datepicker,.rfc-datepicker,pfc-datepicker").datepicker();
		
	});
</script>		