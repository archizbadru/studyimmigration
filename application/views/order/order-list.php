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
          <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>   <?php
          if (user_access(460)) { ?>
          <a class="dropdown-toggle btn btn-danger btn-circle btn-sm fa fa-plus" id="enq-create" href="<?php echo base_url("order/addorder"); ?>" title="Add Stock"></a>         
          <?php	
          }
          ?>
        </div>
      </div><br>
      <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-12">
              <label>Order Date</label>
              <input type="date" name="date_filter" class="form-control">
            </div>
            <div class="col-md-3 col-xs-12 col-sm-12">
              <label>Product</label>
              <div class="form-group">        
                <select name="productdd" id="productdd" class="form-control">
                  <option value="">Select Product</option>
                  <?php foreach($product_list as $product){ ?>
                    <option value="<?php echo $product->id; ?>"><?php echo $product->country_name; ?></option>
                  <?php } ?>
                </select> 
              </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-12">
              <label>Seller</label>
              <div class="form-group">        
              <select name="sellerdd" id="sellerdd" class="form-control">
                <option value="">Select Seller</option>
                <?php foreach($seller_list as $seller){ ?>
                  <option value="<?php echo $seller->pk_i_admin_id; ?>"><?php echo $seller->s_display_name.' '.$seller->last_name.' - '.$seller->s_user_email; ?></option>
                <?php } ?>
              </select> 
              </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-12">
              <label>Order Status</label>
              <div class="form-group">        
                <select name="statusdd" id="statusdd" class="form-control">
                  <option value="">Select Status</option>
                    <option value="1">Request</option>
                    <option value="2">Waiting</option>
                    <option value="3">Dispatch</option>
                    <option value="4">Delivery Confirm</option>
                    <option value="5">Reject</option>
                  </select> 
              </div>
            </div>
      
</div>
	<br>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
				<div class = "row">
					<div class = "col-md-12">
				<div class="table-responsive">
										<table  class="table table-bordered table-hover mobile-optimised" id = "add-datatable" style="width:100%;">
							<thead>
												<tr>
													<th>S.No.</th>
													<th> Order No </th>												
													<th>Total</th>
                          <th>Buyer Name</th> 
                          <th>Buyer Mobile</th> 
                          <th>Buyer Address</th>	
                          <!-- <th>Payment Mode</th> -->
                          <th>Amount Paid</th>
                          <th>Balance</th>
													<th>Ordered At</th>
													<th>Action</th>													
												</tr>
											</thead>
											<tbody>
											
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
			var orderDataTable  = $("#add-datatable").dataTable({
				"serverSide":"true", 
				"lengthMenu":[10,20,50,100,500,1000,"All"],
        "processing": true,
				"ajax":{
					"url":"<?php echo base_url('order/loadorders'); ?>",
					"type":"post",
          "data": function(data){
               data.sproduct = $('#productdd').val();
               data.sseller = $('#sellerdd').val();
               data.sstatus = $('#statusdd').val();
               data.ord_date = $("input[name='date_filter']").val();
            }
				},
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
        "buttons": [  
            {extend: 'copy', className: 'btn-sm'}, 
            {extend: 'csv', title: 'Orders', className: 'btn-sm'}, 
            {extend: 'excel', title: 'Order', className: 'btn-sm'}, 
            {extend: 'pdf', title: 'Order', className: 'btn-sm'}, 
            {extend: 'print', className: 'btn-sm'} 
        ],								
				createdRow: function( row, data, dataIndex ) {
			        $(row).find('td:eq(0)').attr('data-th', 'S.No.');
			        $(row).find('td:eq(1)').attr('data-th', 'Order No');
			        $(row).find('td:eq(2)').attr('data-th', 'Total');
              $(row).find('td:eq(3)').attr('data-th', 'Buyer Name');
              $(row).find('td:eq(4)').attr('data-th', 'Buyer Mobile');
			        $(row).find('td:eq(5)').attr('data-th', 'Buyer Address');
			        $(row).find('td:eq(6)').attr('data-th', 'Amount Paid');
			        $(row).find('td:eq(7)').attr('data-th', 'Balance');
			        $(row).find('td:eq(8)').attr('data-th', 'Ordered At');
			        $(row).find('td:eq(9)').attr('data-th', 'Action');
			    }
			});
      $('#productdd,#sellerdd,#statusdd,input[name="date_filter"]').change(function(){
          orderDataTable.api().ajax.reload( null, true );
       });
			
		});
	</script>
	<script>
		$(document).on("click", ".slide-chng-div", function(){
			
			var trgt = $(this).data("target");
			$(trgt).slideToggle(trgt);
		});
	</script>

