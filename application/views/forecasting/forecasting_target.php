<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group">                     
                </div>
            </div>
            <?php
                $months    =   array(
                                'January',
                                'February',
                                'March',
                                'April',
                                'May',
                                'June',
                                'July ',
                                'August',
                                'September',
                                'October',
                                'November',
                                'December',
								'Total',
								'Action',
                            );
            ?>
            <div class="panel-body">


                <table class="table table-striped table-bordered" style="">
                    <thead>
                        <tr>
                            <th>
                                Users
                            </th>
                            <?php
                            if (!empty($months)) { 
                                foreach ($months as $key => $value) { ?>
                                    <th><?=$value?></th>                                
                                <?php
                                }                                
                            }
                            ?>
                        </tr>
                    </thead>

                    <tbody id ="usr">         
                        <?php
                        if(!empty($user_list)){ ?>
						<div class="form-group col-md-3">
								<select class="form-control" name="number" required id="number"  onchange="getproduct()">
								<option value="">Select Product</option>
						<?php foreach ($product_list as $key => $value) { ?>
								<option value="<?php echo $value->id; ?>"><?=$value->country_name?></option>
						<?php } ?>
                                </select>
						</div>
					
                          
                          
							
                        <?php
                        }
                        ?>
						
                    </tbody>
                </table>  <!-- /.table-responsive -->
				
				<div id="addtarget" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <?php echo form_open_multipart('forecasting/save_target','class="form-inner"') ?>
      <div class="modal-content card">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="modal-titlesms"></h4>
         </div>
         <div>
            <div class="form-group col-sm-12" id="user"> 
            </div>
			<div class="form-group col-md-3">
			<label>January</label>
            <input type="text" class="form-control" id="jan" name="jan" value="">            
            </div>
			<div class="form-group col-md-3">
			<label>February</label>
            <input type="text" class="form-control" id="feb" name="feb" value="">            
            </div>
			<div class="form-group col-md-3">
			<label>March</label>
            <input type="text" class="form-control" id="mar" name="mar" value="">            
            </div>
			
			<div class="form-group col-md-3">
			<label>April</label>
            <input type="text" class="form-control" id="apr" name="apr" value="">            
            </div>
			<div class="form-group col-md-3">
			<label>May</label>
            <input type="text" class="form-control" id="may" name="may" value="">            
            </div>
			<div class="form-group col-md-3">
			<label>June</label>
            <input type="text" class="form-control" id="june" name="june" value="">            
            </div>
			
			<div class="form-group col-md-3">
			<label>July</label>
            <input type="text" class="form-control" id="july" name="july" value="">            
            </div>
			<div class="form-group col-md-3">
			<label>August</label>
            <input type="text" class="form-control" id="aug" name="aug" value="">            
            </div>
			<div class="form-group col-md-3">
			<label>September</label>
            <input type="text" class="form-control" id="sep" name="sep" value="">            
            </div>
			
			<div class="form-group col-md-3">
			<label>October</label>
            <input type="text" class="form-control" id="oct" name="oct" value="">            
            </div>
			<div class="form-group col-md-3">
			<label>November</label>
            <input type="text" id="nov" class="form-control" name="nov" value="">            
            </div>
			<div class="form-group col-md-3">
			<label>December</label>
            <input type="text" class="form-control" id="dec" name="dec" value="">            
            </div>
         </div>
		 <div class="col-md-12">
            <button class="btn btn-primary" type="submit">Save</button>            
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
      </form>
   </div>
</div>
				<div id="updatetarget" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <?php echo form_open_multipart('forecasting/update_target','class="form-inner"') ?>
      <div class="modal-content card">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="modal-titlesms"></h4>
         </div>
         <div id="uptar">
           
         </div>
		 <div class="col-md-12">
            <button class="btn btn-primary" type="submit">Save</button>            
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
      </form>
   </div>
</div>
<script>
 function getproduct(){
var number=document.getElementById("number").value; 	
//alert(number); 
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>forecasting/get_product_User/'+number,
   })
   .done(function(data){
       $('#usr').html(data);
   })
   .fail(function() {
   alert( "fail!" );   
   });
   }
</script>
<script>
 function getuid(id,pid){       
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>forecasting/get_user/'+id+'/'+pid,
   })
   .done(function(data){
       $('#user').html(data);
   })
   .fail(function() {
   alert( "fail!" );   
   });
   }
   
    function get_trgt_data(id,pid){       
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>forecasting/get_trgt_datass/'+id+'/'+pid,
   })
   .done(function(data){
       $('#uptar').html(data);
   })
   .fail(function() {
   alert( "fail!" );   
   });
   }




</script>   
            </div>
        </div>
    </div>
</div>