<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
<div class="row">
<?php if(empty($telephony_token)){ $telephony_token='';} ?>
    <!--  table area -->

    <div class="col-sm-12">
       <br>
        <div  class="panel panel-default thumbnail">
             <div class="panel-heading no-print">
                <div class="btn-group"> 
                    Call Report 
                  </div>
               
				<div style="float: right;">                    

            <div class="btn-group dropdown-filter">
               <a href="<?php echo base_url(); ?>enq/index" class="btn btn-default">
                Back
              </a> 	
            </div>
          </div>       

            </div>

            <div class="panel-body" >
			             <form method="get" class="lead-form" id="filter_and_save_form" action="">
                    <input type="hidden" name="employee" value="<?= $this->session->phone?>">
                
                      <div class="col-md-12">
					     
                        <div class="form-group col-md-3">
                          <label for="inputEmail4"><?php echo display("from_date"); ?></label>
                          <input type="date" class="form-control" id="from-date" value="<?php  if(!empty($_GET['from_exp'])){echo $_GET['from_exp'];} ?>"  name="from_exp" style="padding-top:0px;">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("to_date"); ?></label>
                          <input type="date" class="form-control" id="" value="<?php  if(!empty($_GET['to_exp'])){echo $_GET['to_exp'];} ?>" name="to_exp" style="padding-top:0px;">
                        </div>
                       
			            <div class="form-group col-md-6">
                          <label for="enq_product">Criteria</label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control" name="filter[]"   id = "selected-col">
                             <?php $criteria=json_decode($source)->filters;
							 // print_r($criteria);
							 foreach($criteria as $c){?>
                              <option value="<?php echo $c->id; ?>" ><?php echo $c->name; ?></option>
							 <?php } ?>
                          </select>                          
                        </div>
					    <div class="form-group col-md-3">
					      <input type="radio" name="telephony_access_token_id" value="<?= $this->session->telephony_token?>" <?php  if($token_number==$this->session->telephony_token){echo 'checked';} ?>> Outbond Call
						  </div>
					<?php if(!empty($this->session->inbound_token)){?>
					   <div class="form-group col-md-3">
					 <input type="radio" name="telephony_access_token_id" value="<?= $this->session->inbound_token?>" <?php  if($token_number==$this->session->inbound_token){echo 'checked';} ?>> Inbound Call
					 </div>
					<?php } ?>
						<div class="form-group col-md-3">
						<br>
                        <input type="submit" value="Search"    class="btn btn-success"> 
                        <input type=button class="btn btn-warning" onClick="location.href='<?php echo base_url('call_report/report_all'); ?>'" value='Reset'>						
                        </div><br>
					
                      
                    </div><span class="btn btn-info">Total Record's (
			    <?php  if(!empty(json_decode($logs_details)->data->total)){print_r(json_decode($logs_details)->data->total);} ?>) Found 
                </span>	&nbsp;		
                <a class="btn btn-success" onclick="ExportToExcel();" href="#">Export To Excel</a>
                <div style="overflow:scroll">
				<table class="table table-striped table-bordered" style="overflow:scroll" id="table2excel">
                 
                    <thead>

                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Email</th>
							<th>Phone Number</th>
                            <th>Call by</th>
							<th>Status</th>
							<th>Start Time</th>
			                <th>End Time</th>
							<th>Duration</th>
                            <th class="noExl">Recording</th>
							<th class="noExl">Details</th>

                        </tr>

                    </thead>

                    <tbody>
                    <?php $i=1;if(!empty(json_decode($logs_details)->data->total)){
					foreach(json_decode($logs_details)->data->hits as $v){
						$enq=$this->enquiry_model->getenq_by_phone(str_replace('+91','',$v->_source->caller_number));
						//print_r($enq);
						?>
						<tr>
						<td><?=$i++?></td>	
						<td><?php if(!empty($enq)){echo $enq->name_prefix.'&nbsp;'.$enq->name.'&nbsp;'.$enq->lastname;} ?></td>	
					    <td><?php if(!empty($enq)){echo $enq->email;} ?></td>
						<td><?php if(!empty($v->_source->caller_number)){print_r($v->_source->caller_number);} ?></td>
						<td><?php foreach($v->_source->log_details as $recive){if(!empty($recive->received_by[0]->name)){print_r($recive->received_by[0]->name);}} ?></td>
						<td><?php foreach($v->_source->log_details as $recive){if(!empty($recive->action)){print_r($recive->action);}} ?></td>
						<td><?php  echo date("d:m:Y H:i:s",$v->_source->start_time); ?></td>
						<td><?php  echo date("d-m-Y H:i:s", $v->_source->end_time); ?></td>
						<td><?php  print_r($v->_source->duration); ?></td>
						<td class="noExl"><a href="#" onclick="get_video('<?php echo urldecode($v->_source->filename); ?>','<?php echo $token_number;?>');">Play</a></td>
						<td class="noExl"><?php if(!empty($enq)){?><a class="btn btn-info" onclick="window.location.href='<?php echo base_url();?>enquiry/view/<?php echo $enq->enquiry_id; ?>'" >View</a><?php } ?></td>
						</tr>
					<?php }}?>
                    </tbody>

                </table>
					
					</div><?php 
 if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    					
if(isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
if(!empty(json_decode($logs_details)->data->total)){
$total=((json_decode($logs_details)->data->total));
}else{$total=0;}
$no_of_records_per_page = 100;
$offset = ($pageno-1) * $no_of_records_per_page; 
$total_pages = ceil($total / $no_of_records_per_page);
?>
<ul class="pagination">
    <li><a href="<?php echo $url ?>&&pageno=1">First</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php echo $url ?><?php if($pageno <= 1){ echo '#'; } else { echo "&&pageno=".($pageno - 1); } ?>">Prev</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php echo $url ?><?php if($pageno >= $total_pages){ echo '#'; } else { echo "&&pageno=".($pageno + 1); } ?>">Next</a>
    </li>
    <li><a href="<?php echo $url ?>&&pageno=<?php echo $total_pages-1; ?>">Last</a></li>
</ul>
            </div>

        </div>

    </div>

</div>
<script>
  $(document).ready(function(){
    
    $("#selected-col").select2();
  });
    $(document).ready(function(){

    $('table tr').click(function(){
        var a = $(this).attr('href');
        if (a) {
            window.location = $(this).attr('href');
        }
        return false;

    });

});
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?= base_url('assets/js/excel/jquery.table2excel.js');?>"></script>
<!-- <script src="<?= base_url('assets/js/excel/jquery.table2excel.min.js');?>"></script> -->

<script>
function get_video(id,id2){
  var url="<?=base_url().'call_report/get_video/'?>" + id2+"/"+id; 
              $.ajax({
                  url:url,
                  type: 'POST',
                   beforeSend: function(){
                      Swal.fire({            
					// icon: 'info',
					 html:'<strong>Loading..</strong>',
					 showCancelButton: false,
					 confirmButtonColor: '#3085d6',
					 cancelButtonColor: '#d33',
					 confirmButtonText: 'ok'              
                    }).then((result) => {
                    if (result.value) {                                 
                   }
                   });
                   },
                  success: function (data) {
					if(data!=1){
					Swal.fire({            
					// icon: 'info',
					 html:' <audio width="320" height="240" controls> <source src="'+data+'" type="audio/mp3"></audio>',
					 showCancelButton: false,
					 confirmButtonColor: '#3085d6',
					 cancelButtonColor: '#d33',
					// confirmButtonText: 'ok'              
                    }).then((result) => {
                    if (result.value) {                                 
                   }
                   });	
					}else{ 
                     Swal.fire({            
                 html:'<strong> Recording not found </strong>',
                 showCancelButton: false,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',             
               }).then((result) => {
                 if (result.value) {                                 
                 }});
					}
                  }

              });	

}
</script>

<script>
  function ExportToExcel(){
  $("#table2excel").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Worksheet Name",
    filename: "Call-Log", //do not include extension
    fileext: ".xlsx", // file extension
    type: "text/plain;charset=utf-8;"
  }); 
}
</script>