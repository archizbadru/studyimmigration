       	<div class="row">
			<div class="col-md-12"> 
					<div class="panel-heading no-print" style ="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
						<div class="row">
							<div class="btn-group"> 
				                <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>        
				                <a class="dropdown-toggle btn btn-danger btn-circle btn-sm fa fa-plus" href="<?=base_url().'ticket/addNatureOfComplaint'?>" title="New Ticket"></a>                       
				            </div>
							<div class="col-md-2 col-sm-2 col-xs-2 pull-right" >  
					          <div style="float: left;">     
					            <div class="btn-group" role="group" aria-label="Button group">
					              <!-- <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="Actions">
					                <i class="fa fa-sliders"></i>
					              </a> -->  
					            <div class="dropdown-menu dropdown_css" style="max-height: 400px;overflow: auto;">
					                  <a class="btn" data-toggle="modal" data-target="#AssignSelected" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #fff;"><?php echo display('assign_selected'); ?></a>                                        
					            </div>                                         
					          </div>  
					        </div>       
					      </div>
						</div>
					</div>
					<div class="row">
						<div class="">
							<div class="panel-body">
							<form class="form-inner" method="post" id="enquery_assing_from" >
							<!--<?php echo form_open(base_url("ticket/add")); ?>-->
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-12">
									<table class="datatable1 table table-striped table-bordered" style="width:100%;">
										<thead>
											<th>S.No.</th>
											<th>Title</th>
											<th>Status</th>
											<th>Action</th>
										</thead>
										<tbody id = "table-body">
									<?php if(!empty($tickets)){
										        $sl=1;
												foreach($tickets as $ind => $tck){
													?>
													<tr>
														<td><?= $sl;?></td>
														<td><?php echo $tck->title; ?></td>
														<td><?php echo ($tck->status == 1) ? "Active" : "InActive"; ?></td>
														<td style ="min-width:125px;"><?php if($this->session->user_right!=214){ ?>
															 <a class="btn  btn-success btn-sm" href="<?php echo base_url("ticket/editNatureOfComplaint/".$tck->id) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
														<!--<a class="btn  btn-default btn-sm" href="<?php echo base_url("ticket/edit/".$tck->ticketno) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"> </i> </a>-->
														
														<a class="btn  btn-danger btn-sm"   href="<?php echo base_url("ticket/deleteNatureOfComplaint/$tck->id") ?>"><i class="fa fa-trash-o"></i></a> 
														</td>
													</tr>
													<?php
													$sl++;
												}	
											} ?>
										</tbody>
									</table>
								</div>
							</div>
							</form>
								<!--<?php echo form_close(); ?>-->
						</div>
					</div>
				</div>
			</div>
		</div>

 <div id="AssignSelected" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ticket Assignment</h4>
      </div>
      <div class="modal-body">
      
                <div class="row">
                  
            
            <div class="form-group col-md-12">  
            <label>Select Employee</label> 
            <div id="imgBack"></div>
            <select class="form-control"  name="assign_employee" id="emply">                    
            <?php foreach ($user_list as $user) { 
                            
                          if (!empty($user->user_permissions)) {
                            $module=explode(',',$user->user_permissions);
                          }                           
                            
                            ?>
                            <option value="<?php echo $user->pk_i_admin_id; ?>">
                              <?=$user->s_display_name ?>&nbsp;<?=$user->last_name; ?>                                
                            </option>
                            <?php 
                          //}
                        } ?>                                                      
            </select> 
            </div>
            
          <input type="hidden" value="" class="enquiry_id_input" >
          
            <div class="form-group col-sm-12">        
            <button class="btn btn-success" type="button" onclick="assign_tickets();">Assign</button>        
            </div>
    
                </div>          
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
	$(document).on("click", ".delete-ticket", function(e){
		e.preventDefault();
		var r = confirm("Are you sure to delete");
		if (r == true) {
		} else {
		  return false;
		}
		$.ajax({
			url  	: $(this).attr("href"),
			type 	: "post",
			data 	: {content : $(this).data("ticket")},
			success : function(resp){
					var jresp = JSON.parse(resp);
					if(jresp.status == "success"){
						location.reload();
					}else{						
					}
			}
		});
	});
</script>
<script>
function reset_input(){
$('input:checkbox').removeAttr('checked');
}

$('.checked_all1').on('change', function() {     
    $('.checkbox1').prop('checked', $(this).prop("checked"));    
}); 
</script>
<script>
function assign_tickets(){
  if($('.checkbox1:checked').size() > 1000){
    alert('You can not assign more that 1000 enquiry at once');
  }else{
      var p_url = '<?php echo base_url();?>ticket/assign_tickets';
      var re_url = '<?php echo base_url();?>ticket'; 
		var epid = $("#emply").val();	  

  $.ajax({
    type: 'POST',
    url: p_url,
    data: $('#enquery_assing_from').serialize()+ "&epid="+epid+"",
    beforeSend: function(){
                 $("#imgBack").html('uploading').show();
    },
    success:function(data){
         alert(data);
         //document.getElementById('testdata').innerHTML =data;
          window.location.href=re_url;
    }});
  }
}
</script>