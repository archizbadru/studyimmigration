<style>
  /*TAG STYLE START*/
.tag {
  background: #eee;
  border-radius: 3px 0 0 3px;
  color: red;
  display: inline-block;
  height: 17px;
  line-height: 17px;
  padding: 0 10px 0 19px;
  position: relative;  
  text-decoration: none;
  -webkit-transition: color 0.2s;
  font-size: xx-small !important;  
}

.tag::before {
  background: #fff;
  border-radius: 10px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
  content: '';
  height: 6px;
  left: 10px;
  position: absolute;
  width: 6px;
  top: 6px;
}

.tag::after {
  background: #fff;
  border-bottom: 8px solid transparent;
  border-left: 10px solid #eee;
  border-top: 9px solid transparent;
  content: '';
  position: absolute;
  right: 0;
  top: 0;
}

.tag:hover {
  background-color: crimson;
  color: white;
}

.tag:hover::after {
   border-left-color: crimson; 
}
/*TAG STYLE END*/


.col-half-offset{
  margin-left:2.166667%;
}
.enq_form_filters{
  width: 0px;
}
#active_class{
  font-size: 12px;
}
.lead_stage_filter{
  padding: 6px;
  background-color: #e6e9ed;
  cursor: pointer;
}
.lead_stage_filter:active{  
  background-color: #20a8d8;  
}
.lead_stage_filter:hover{  
  background-color: #20a8d8;  
}
.border_bottom_active > label{
  cursor: pointer;
}
.nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
    color: white;
    background-color: #37a000;
}

.nav-pills > li > a {
    border-radius: 5px;
    padding: 10px;
    color: #000;
    font-weight: 600;
}

.nav-pills > li > a:hover {
    color: #000;
    background-color: transparent;
}
              .dropdown-header {
    padding: 8px 20px;
    background: #e4e7ea;
    border-bottom: 1px solid #c8ced3;
}

.dropdown-header {
    display: block;
    padding: 0 1.5rem;
    margin-bottom: 0;
   
    color: #73818f;
    white-space: nowrap;
}
input[name=top_filter]{
	visibility: hidden;
}

input[name=lead_stages]{
  visibility: hidden;
}

.dropdown_css {
  left:auto!important;
  right: 0 ! important;
}
.dropdown_css a,.dropdown_css a h4{
  width:100%;text-align:left! important;
  border-bottom: 1px solid #c8ced3! important;
}

.border_bottom{
  border-bottom:2px solid #E4E5E6;min-height: 7vh;margin-bottom: 1vh;cursor:pointer;
}  
.border_bottom_active{
  border-bottom:2px solid #20A8D8;min-height: 7vh;margin-bottom: 1vh;cursor:pointer;
} 

.filter-dropdown-menu li{
  padding-left: 6px;
}

.filter-dropdown-menu li{
  padding-left: 6px;
}

</style>
	
	
	<div class="row" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">  
        <div class="col-md-4 col-sm-4 col-xs-4"> 
          <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>        
          <a class="dropdown-toggle btn btn-danger btn-circle btn-sm fa fa-plus" id="enq-create" href="<?php echo base_url("product/addstock"); ?>" title="Add Stock"></a>         
        </div>
         <div class="col-md-4 col-sm-8 col-xs-8 pull-right">  
          <div style="float: right;"> 
			<a href = "javascript:void(0)" class = "btn btn-warning btn-pill slide-chng-div" data-target = "#filter-area"><i class  = "fa fa-search"></i></a>
			<a href = "javascript:void(0)" class = "btn btn-info btn-pill slide-chng-div" data-target = "#filter-area"><i class  = "fa fa-download"></i></a>
			<div class = "hidden-form" style = "display:none;">	
				 <?php echo form_open_multipart()     ?>
				
				<input type = "hidden" name = "type" value = "all">
				   <label> <input type = "file" class = "btn btn-pill btn-default" name = "csvupload" required> </label>
					<button type = "submit" class="btn btn-square btn-secondary"> <i class="fa fa-upload ml-2"></i> Upload </button>
					<a class="btn btn-square btn-success" href = "<?php echo base_url("assets/upload/stock.csv"); ?>"> <i class="fa fa-download ml-2"></i> Sample </a>
				<?php echo form_close(); ?>
			</div>		
									
        </div>       
      </div>
</div>
	<?php echo form_open(base_url("product/stock"), array("id"=> "filter-form-ajx")); ?>
									<div class = "row" id = "filter-area" style = "display:none;">
										<div class = "form-group col-md-3">
											<label>Start Date</label>
													
													<input class="form-control" name="startdate" id = "start-date" placeholder="DD/MM/YYYY" value="" type="date" autocomplete = "off"  style = "width:100%">
										</div>
										<div class = "form-group col-md-3">
											<label>End Date</label>
										<input class="form-control fc-datepicker" name="enddate" id = "end-date" placeholder="DD/MM/YYYY" value="" type="date" autocomplete = "off" style = "width:100%">
										</div>
										<div class = "form-group col-md-3">
											<br />
								<!--			<a class = "btn btn-warning btn-pill addit-filter-ord"><i class  = "fa fa-search"></i> Search</a> -->
											<button type = "submit" name = "downloadexel" value = "downloadexel" class = "btn btn-info btn-pill"><i class  = "fa fa-download"></i> Excel</button>
										</div>
									</div>
									<?php echo form_close(); ?>
<div class="row" id="active_class">                   
          	<div class="col-xs-12 col-sm-12  col-md-2 col-lg-2 col-half-offset" style="">
		        <div class="col-12 border_bottom">
		            <p style="margin-top: 2vh;font-weight:bold;">
		            	<input id="created_today_radio" value="created_today" type="radio" name="top_filter" class="enq_form_filters"><i class="fa fa-edit"></i><label for="created_today_radio">&nbsp;&nbsp;Created Today</label>
		            	<span style="float:right;" class="badge badge-pill badge-primary " id="today_created"><?php  echo $todaycreate; ?></span>
		            </p>
		        </div>
            </div>
            <div class="col-xs-12 col-sm-12  col-md-2 col-lg-2 col-half-offset">
	            <div class="col-12 border_bottom">
	                <p style="margin-top: 2vh;font-weight:bold;">
	                	<input type="radio" name="top_filter" value="updated_today" class="enq_form_filters" id="updated_today_radio"><i class="fa fa-pencil"></i><label for="updated_today_radio">&nbsp;&nbsp;Updated Today</label><span style="float:right;background:#ffc107" class="badge badge-pill badge-warning badge badge-dark " id="today_updated"><?php  echo $todayupdate; ?></span>
	                </p>
	            </div>
            </div>
            
        <!--    <div class="col-xs-12 col-sm-12  col-md-2 col-lg-2 col-half-offset">
	        	<div class="col-12 border_bottom border_bottom_active">
	                <p style="margin-top: 2vh;font-weight:bold;" title="Active"> 
	                	<input type="radio" name="top_filter" value="active" checked="checked" class="enq_form_filters" id="active_radio"><i class="fa fa-file"></i><label for="active_radio">&nbsp;&nbsp;Active</label><span style="float:right;" class="badge badge-pill badge-primary " id="active_all">31</span>
	                </p>
	            </div>
            </div>
                  
            <div class="col-xs-12 col-sm-12  col-md-2 col-lg-2 col-half-offset">
	            <div class="col-12 border_bottom">
	                <p style="margin-top: 2vh;font-weight:bold;" title="Dropped">
	                		<input type="radio" name="top_filter" value="droped" class="enq_form_filters" id="droped_radio">
	                		<i class="fa fa-thumbs-down"></i><label for="droped_radio">&nbsp;&nbsp;Dropped</label><span style="float:right;background:#E5343D" class="badge badge-danger" id="active_drop">5</span>	                	
	                </p>
	            </div>
            </div> -->
            <div class="col-xs-12 col-sm-12  col-md-2 col-lg-2 col-half-offset">
	            <div class="col-12 border_bottom border_bottom_active">

	                <p style="margin-top: 2vh;font-weight:bold;" title="Total">
	                	<input type="radio" name="top_filter" value="all" class="enq_form_filters" id="total_active_radio" checked>
	                	<i class="fa fa-list"></i><label for="total_active_radio">&nbsp;&nbsp;Total</label><span style="float:right;background:#000" class="badge badge-pill badge-dark " id="total_active"><?php echo $totalstock; ?></span>
	                </p>
	            </div>
          </div>   
    </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
				<div class = "row">
					<div class = "col-md-12">
				<div class="table-responsive">
										<table  class="table table-bordered table-hover" id = "add-datatable" style="width:100%;">
											<thead>
												<tr class = "bg-info">
													<th class="wd-15p">S.No.</th>
													<th class="wd-15p" width="20%">Product</th>
													<th class="wd-15p">Quantity</th>
													<th class="wd-15p">Purchase Price</th>
													<th class="wd-15p">Supplier</th>
													<th class="wd-15p">Stock Date</th>
													<th class="wd-15p">Action</th>
													
												</tr>
											</thead>

											<tbody>
												<?php if(!empty($stocks)){

												   $sl=1;
                                                  foreach($stocks as $ind =>  $stck){
												?>
												<tr>

													<td><?= $ind + 1; ?></td>
													<td><?= ucwords($stck->product_name)  ?></td>
													<td>
															<?= $stck->quantity; ?>	<br  />
														<span class = "badge badge-info"> Old Stock :<?php echo $stck->old_stock; ?></span>
													</td>
													<td><?= $stck->price; ?></td>
													<td><?= $stck->supplier; ?></td>
													<td><?= date("m/d/Y", strtotime($stck->stock_date)); ?></td>
													<td>
														<a href="<?php echo base_url("product/stockupdate/".urlencode(base64_encode(base64_encode($stck->id)))); ?>" class="btn btn-info">
														<i class="fa fa-pencil" data-toggle="tooltip" title="" data-original-title="Edit"></i></a>

														<a href="<?php echo urlencode(base64_encode(base64_encode($stck->id))); ?>"  class="btn btn-danger delete-stocks">
														<i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>

													</td>
												</tr>
												<?php  $sl++; }

											}?>
											</tbody>
										</table>
									</div>
								</div>
							</div>			
        						<!-- table-wrapper -->
		 </div>
		</div>
	</div>	
	<script>
	$(document).ready(function(){
			$("#add-datatable").dataTable({"serverSide":"true","lengthMenu":[10,10,100,500,1000,-1,50,100,500,1000,"All"],"ajax":{"url":"<?php echo base_url('product/loadstock'); ?>","type":"post"},"columnDefs":{"orderable":"false","target":0},"order":[1,"desc"]});
			
		});
	</script>
	<script>
		$(document).on("click", ".enq_form_filters",function(){
				
			var val = $(this).val();
			
			$(".border_bottom").removeClass("border_bottom_active");
			$(this).closest(".border_bottom").addClass("border_bottom_active");
			$('#add-datatable').dataTable().fnDestroy();
			 $("#add-datatable").dataTable({"serverSide":"true","lengthMenu":[10,10,100,500,1000,-1,50,100,500,1000,"All"],"ajax":{"url":"<?php echo base_url('product/loadstock'); ?>?action="+val,"type":"post"},"columnDefs":{"orderable":"false","target":0},"order":[1,"desc"]});
			 
		});
	</script>
	<script>
		$(document).on("click", ".slide-chng-div", function(){
			
			var trgt = $(this).data("target");
			$(trgt).slideToggle(trgt);
		});
	</script>