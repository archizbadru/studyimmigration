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
				                '',
                                'Target',
                                'Forecast',
                                'target',
								'Forecast',
								'Action',
                            );
            ?>
            <div class="panel-body">


                <table class="table table-striped table-bordered" style="">
                    <thead>
					<tr>
					    <th colspan="">Product</th>
                        <th colspan="2">Year To Date</th>
						<th colspan="2">Current Month</th>
                        </tr>
                        <tr>
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
                    <tbody id="forecast">         
                        <?php
                        if(!empty($user_list)){ ?>
						<div class="form-group col-md-3">
								<select class="form-control" name="number" required id="number"  onchange="getforecast()">
								<option value="">Select User</option>
						<?php foreach ($user_list as $key => $value) { ?>
								<option value="<?php echo $value->pk_i_admin_id; ?>"><?=$value->s_display_name.' '.$value->last_name?></option>
						<?php } } ?>
                                </select>
						</div>
                           
						   
						   
                    </tbody>
                </table>
<script>
 function getforecast(){
var number=document.getElementById("number").value; 	
//alert(number); 
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>forecasting/get_user_forecast/'+number,
   })
   .done(function(data){
       $('#forecast').html(data);
   })
   .fail(function() {
   alert( "fail!" );   
   });
   }
</script>
<script>
 function ins_forcast(uid,pid,num,cid,crrmonth){
var val_forcast=document.getElementById("cmforecast"+num).value; 		
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>forecasting/save_forcast/'+uid+'/'+pid+'/'+cid+'/'+val_forcast+'/'+crrmonth,
   })
   .done(function(data){
	   location.reload();
      // $('#forecast').html(data);
   })
   .fail(function() {
   alert( "fail!" );   
   });
   }
   
function update_forcast(uid,pid,num,cid,crrmonth){
var val_forcast=document.getElementById("cmforecast"+num).value;  		
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>forecasting/update_forcast/'+uid+'/'+pid+'/'+cid+'/'+val_forcast+'/'+crrmonth,
   })
   .done(function(data){
	   location.reload();
      // $('#forecast').html(data);
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