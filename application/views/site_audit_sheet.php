<?php function initials($str) {     
        $ret = '';
        foreach (explode(' ', $str) as $word)
        $ret .= strtoupper(substr($word,0,1));
        
        return $ret; 
    } ?>
 <style type="text/css">
  [data-black]:before  
  {
    content:attr(data-black);
    display:inline-block;
    font-size:1em;
    width:2.5em;
    height:2.5em;
    line-height:2.5em;
    text-align:center;
    border-radius:50%;
    background:#2F353A;
    vertical-align:middle;
    margin-right:1em;
    color:white;
  }
  </style>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<div class="row">
    <!--  table area -->
    <div class="col-md-12" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
  

        <div class="col-md-6" > Installation /Site Audit Sheet
        </div>
        <div class="col-md-6" >  
<div style="float:right">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="<?php echo base_url();?>installationprocess" title="Refresh">
               <i class="fa fa-arrow-left icon_color"></i>
            </a>                                                    
          </div>
                         
     
          
          </div>
        </div>

      
</div>
    <div class="col-md-3" style="text-align:center;min-height: calc(100vh - 105px);background:#F6F8F8;"> 
                              <div class="avatar" title="<?php echo $clientDetails->cl_name; ?>" style="margin-top:5%;">
                              <p data-black="<?php $string = $clientDetails->cl_name; echo initials($string);?>"></p>
                              </div>
                             <h5 style="text-align:center"><?php echo $clientDetails->cl_name;?><br>         
                             <?php echo $clientDetails->cl_mobile;?><br> <?php echo $clientDetails->cl_email;?></h5>
                             <div class="row">
                             <button class="btn btn-success btn-sm" data-toggle="modal" type="button" title="Send SMS" data-target="#sendsms<?php echo $clientDetails->cli_id;?>" onclick="getTemplates('2')" >
                             <i class="fa fa-paper-plane-o"></i>
                             </button>
                             <!--<button class="btn btn-info btn-sm" data-toggle="modal" type="button" title="Send Email" data-target="#sendsms<?php echo $clientDetails->cli_id;?>" onclick="getTemplates('3')">
                             <i class="fa fa-envelope"></i>
                             </button>-->
                             <button class="btn btn-info btn-sm" type="button" title="Send Email" onclick="send_form_link()">
                                <i class="fa fa-envelope"></i>
                             </button>
                             
                             <button class="btn btn-success btn-sm" data-toggle="modal" type="button" title="Send Whatsapp" data-target="#sendsms<?php echo $clientDetails->cli_id;?>" onclick="getTemplates('1')">
                             <i class="fa fa-whatsapp"></i>
                             </button>
                             <br>
                             </div>
                  <table style="width: 100%;margin-top: 5%;" id="dataTable" class="table table-responsive-sm table-hover table-outline mb-0" >
                    <tbody>
                      <tr>
                    <td>Client Type</td>
                    <td><?php if($clientDetails->enquiry_cust_type==1) { echo 'Channel Partner'; } ?>
                    <?php if($clientDetails->enquiry_cust_type==11) { echo 'Customer'; } ?></td>
                    </tr>
                    </tr> 
                     <td><?php echo display('Country_name');?></td>
                    <td><?php echo $clientDetails->country_name;?></td>
                    </tr>
                    </tr> 
                     <td><?php echo display('region_name');?></td>
                    <td><?php echo $clientDetails->region_name;?></td>
                    </tr>
                    </tr> 
                     <td><?php echo display('territory_name');?></td>
                    <td><?php echo $clientDetails->territory_name;?></td>
                    </tr>
                    <tr>
                    <td><?php echo display('state_name');?></td>
                    <td><?php echo $clientDetails->state;?></td>
                    </tr> 
                     <td><?php echo display('city_name');?></td>
                    <td><?php echo $clientDetails->city;?></td>
                    </tr>
                    <tr>
                    <td><?php echo display('address');?></td>
                    <td><?php echo $clientDetails->address;?></td>
                    </tr>
                    <tr>
                    <td>Pin code</td>
                    <td><?php echo $clientDetails->pin_code;?></td>
                    </tr>
                    <tr>
                    <td>Created By</td>
                    <td><?= $clientDetails->s_display_name; ?></td>
                    </tr>
                    <tr>
                    <td><?php echo display('create_date');?></td>
                    <td><?php echo date('d-m-Y',strtotime($clientDetails->created_date));?></td>
                    </tr>
                    
                    <tr>
                        <td>Circuit Sheet</td>
                        <td>
                            <?php  $res= $this->Leads_Model->boq_list_byid($clientDetails->customer_code);
                               if(!empty($res->result())){
                                   
                                    foreach($res->result() as $v){?>
                                    
                                        <!--<a style="cursor:pointer" disabled><?php if(!empty($v->circuit_sheet)){echo $v->circuit_sheet;} ?></i></a>-->
                                        <a href="<?php echo base_url();?>cricuit-view/<?php if(!empty($v->baq_number)){echo  base64_encode($v->baq_number);}?>" ><?php  if(!empty($v->circuit_sheet)){echo $v->circuit_sheet;} ?></a>
                                        
                                    <?php }}else{ echo "N/A"; }?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Site Audit Sheet</td>
                        <?php if($clientDetails->cli_id !=$clientDetails->client_id){?>
                        <td><a href="<?php echo  base_url("Installationprocess/site_audit_sheet/$clientDetails->cli_id/$clientDetails->customer_code") ;?>"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
                        <?php }else{?>
                        
                        
                            <td><a href="<?php echo  base_url("Installationprocess/get_site_audit_detail/$clientDetails->cli_id/$clientDetails->customer_code") ;?>"><?php  if(!empty($v->circuit_sheet)){echo str_replace('OSUM','OS',str_replace('CS','SA',$v->circuit_sheet));} ?></a></td>
                        
                        <?php }?>
                    </tr>
                    
                    <tr>
                        <td>Site Readiness Sheet</td>
                        
                            <?php if($clientDetails->cli_id!=$clientDetails->client_id){?>
                            
                                <td><a href="<?php echo  base_url('Installationprocess/installation_process/'.$clientDetails->cli_id) ?>" ><i class="fa fa-plus"></i></a></td>
                                
                            <?php }else{ ?>
                            
                                <td><a href="<?php echo  base_url('Installationprocess/get_site_readiness_detail_by_client/'.$clientDetails->cli_id) ?>" ><?php  if(!empty($v->circuit_sheet)){echo str_replace('OSUM','OS',str_replace('CS','SR',$v->circuit_sheet));} ?></a></td>
                                
                            <?php } ?>
                            
                    </tr>
                    
                     </tbody></table>
   
                                               
           </div> 
    <div class="col-md-9">
        <div class="panel panel-default thumbnail"> 
        <div class="panel-heading no-print">
         <h3>OSUM - Site Audit Report</h3>
        </div>
        
        <div class="panel-body">
                <br>
           <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                                   <div role="alert" class="alert alert-success">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                           
                                           <?=$this->session->flashdata('SUCCESSMSG')?>
                                   </div>
                           <?php } ?>
           
           <br>
                
                <!-- Site Audit Form --->
                <form action="<?php echo base_url('Installationprocess/add_site_audit_report') ?>" class="form-inner " id="MyForm" method="post" accept-charset="utf-8">
                    
                    	<div class="form-group col-md-3">
                    	    <label>Report no.</label>
                    	  <input class="form-control" name="report_no" type="text" value="" required>
                    	  
                    	  <input class="form-control" name="customer_id" type="hidden" value="<?= $clientDetails->cli_id ?>">
                    	</div>
                    	<input type="hidden" name="user_id" id="user_id" value="<?=$clientDetails->cli_id ?> ">
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Date</label>
                    	  <input class="form-control date" id="r_date" name="date" type="text"  required>
                    	</div>
                    	
                        <div class="form-group col-md-3">
                    	    <label>Customer Name</label>
                    	  <input class="form-control" name="customer_name" type="text" value="<?= $clientDetails->cl_name?>" readonly="">
                    	</div>
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Client ID</label>
                    	  <input class="form-control" id="customer_id" name="client_id" type="text" value="<?= $clientDetails->customer_code?>" readonly>
                    	</div>
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Contact Number</label>
                    	  <input class="form-control" name="contact_no" type="text" value="<?= $clientDetails->cl_mobile ?>" readonly="">
                    	</div>
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Email ID</label>
                    	  <input class="form-control" name="email" id="email" type="text" value="<?= $clientDetails->cl_email?>" readonly="">
                    	</div>
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Address</label>
                    	  <textarea class="form-control" id="exampleFormControlTextarea1"  name="address" readonly><?=$clientDetails->address?></textarea>
                    	</div>
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Partner Name</label>
                    	    <select class="form-control" name="partner_name">
                    	        <option value="" style="display:none">Select...</option>
                    	        <option value="">Partner</option>
                    	    </select>
                    	</div>
                    	
                    	<div class="row">
                    	    <div class="col-md-12">
                        	<div class="form-group col-md-3">
                        	    <label>Sales Executive</label>
                        	    <input type="text" class="form-control" name="sale_exc">
                        	</div>
                        	
                        	<div class="form-group col-md-3">
                        	    <label>Pre-sales Executive</label>
                        	    <input type="text" class="form-control" name="pre_sale_exc">
                        	</div>
                        	
                        	<div class="form-group col-md-3">
                        	    <label>Installation Engineer</label>
                        	    <input type="text" class="form-control" name="installation_eng">
                        	</div>
                        	
                        	<div class="form-group col-md-3">
                        	    <label>Type of site</label>
                        	    <select class="form-control" name="resident_type">
                        	        <option value="" style="display:none;">Select...</option>
                        	        <option value="">Residential</option>
                        	        <option value="">Commercial</option>
                        	    </select>
                        	</div>
                        	</div>
                    	</div>
                    	
                    	<div class="form-group col-md-12">
                    	    
                    	    
                    	      <?php echo $detail;?> 
                    
                    
                    
                    </div>
                  
                    <div class="form-group col-md-12 text-center"><br>
                    	  
                    	    <button type="submit" class="btn btn-success">Submit</button>
                            <!--<button type="button" class="btn btn-success ">Edit</button>-->
                    </div>
                   </form>
                </div>
                
        </div>
        
        </div>
    </div>
</div>
    <!---- Send To Client Modal----->
                                    <!--<div id="suggestedDate" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                        <!-- Modal content--
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Suggested Date For Installation</h4>
                                          </div>
                                          <div class="modal-body">
                                              <div class="row">
                                                  
                                               <div class="form-group col-md-6">
                                                    <label>Date1</label>
                                                    <input type="date" class="form-control" name="date1">
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label>Date2</label>
                                                    <input type="date" class="form-control" name="date2">
                                                </div>
                                                
                                                <div class="form-group col-md-12">
                                                      
                                                      <p>Select your convenient date for the installation.</p>
                                                  </div>
                                                
                                              </div>
                                    	  </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-success" onclick="SubmitForm()">Submit</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>-->
<!------------------------------>
<script>

  
 $(function () {
   var bindDatePicker = function() {
		$(".date").datetimepicker({
        format:'DD-MM-YYYY hh:mm:ss a',
			icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			}
		}).find('input:first').on("blur",function () {

			var date = parseDate($(this).val());

			if (! isValidDate(date)) {
				//create date based on momentjs (we have that)
				date = moment().format('YYYY-MM-DD');
			}

			$(this).val(date);
		});
	}
   
   var isValidDate = function(value, format) {
		format = format || false;
		// lets parse the date to the best of our knowledge
		if (format) {
			value = parseDate(value);
		}

		var timestamp = Date.parse(value);

		return isNaN(timestamp) == false;
   }
   
   var parseDate = function(value) {
		var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
		if (m)
			value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

		return value;
   }
   
   bindDatePicker();
 });
  
  
  // $("#r_date").datepicker();
  // $("#r_date").datepicker("show");
  
    
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
<!----------------------------------- Calendar View----------------------------------------->

<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
      
      events    : [
          <?php foreach ($recent_tasks as $task):
              if($task->task_type==1){
                    $url = "";
                     
                    //$url = "window.location='http://archizsolutions.online/osum/enquiry/view/1';";
                    }
                    else if($task->task_type==2){
                    $leadcode = $task->query_id;
                    $getid = $this->Leads_Model->get_leadid_byCODE($leadcode);
                    foreach($getid as $user){
                    $leadid = $user->lid;
                    }
                    
                     $url = "<a href='http://archizsolutions.online/osum/lead/lead_details/$leadid'>";
                    //$url = "window.location='http://archizsolutions.online/osum/lead/lead_details/$leadid';";
                    }
                    else if($task->task_type==3){
                    $leadcode = $task->query_id;
                    $getid = $this->Client_Model->get_clientid_bycustomerCODE($leadcode);
                    foreach($getid as $user){
                    $clientid = $user->cli_id;
                    }
                    $url = "<a href='http://archizsolutions.online/osum/client/view/$clientid'>";
                    //$url = "window.location='http://archizsolutions.online/osum/client/view/$clientid';";
                    }
                    else if($task->task_type==4){
                    $ticketid = $task->query_id;
                    
                    $url = "<a href='http://archizsolutions.online/osum/ticket/details/$ticketid'>";
                    //$url = "window.location='';";
                    }
          
          ?>
        {
          title          : '<?php //echo $url;?><?php echo $task->contact_person."--".$task->conversation?>',
          start          : new Date(y, m, <?php $dt = $task->nxt_date; echo date('d',$dt); ?>),
          backgroundColor: '#0073b7', 
          borderColor    : '#0073b7' 
          
        },
        <?php endforeach; ?>
      
      ],
      
      editable  : false,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')


        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

       

      }
    })

   
  })
</script>
<?php 
$new='';

    
     $new.='<select class="form-control" name="functions[]">';
                                    
        $new.='<option value="" style="display:none">---Select---</option>';
                                        
                                      foreach($function as $fun){
                                            
                                            $new.='<option value="'.$fun->a_id.'">'.$fun->a_name.'</option>';
                                        }
                                    
     $new.='</select>';

  ?>

<script>
    
    $(function(){
        
        $('.description').change(function(){
            
            var val = $(this).val();
            
            var html='';
            var html2='';
            var html3='';
            var new_field='';
            
            var  total = val.replace ( /[^\d.]/g, '' ); 
            
            //Get functions list
             $.ajax({
                    
                    url : '<?php echo base_url('Installationprocess/get_functions') ?>',
                    type:'POST',
                    success:function(data){
                        
                        var obj = JSON.parse(data);
                  
                        for(var i=0;  i < parseInt(total); i++){
                            
                            html +='<input type="text" class="form-control" style="border-color:#696969" value="CH'+(i+1)+'" name="load_type[]"><br>';
                            
                            html2 +='<?php echo $new?><br>';
                            
                            html3 +='<input type="text" name="remarks[]" class="form-control" style="border-color:#696969"><br>';
                            
                                    
                                         new_field +='<select class="form-control" name="functions[]">';
                                    
                                         new_field +='<option value="" style="display:none">---Select---</option>';
                                        
                                        for(var j=0; j < (obj.length); j++){
                                            
                                            new_field +='<option value="'+obj[j].item_name+'">'+obj[j].item_name+'</option>';
                                        }
                                    
                                    new_field +='</select><br>';
                        }
            
                        $('.create_text_box').html(html);
                        
                        $('.total_load_input').html(html2);
                        
                        $('.add_new').html(new_field);
                        
                        $('.remarks').html(html3);
                }
            
                });
        });
    });
    
    /*function SubmitForm(){
        
        document.getElementById('MyForm').submit();
    } */
    
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    
    function send_form_link(){
        
        var email       = $("#email").val();
        var customer_id = $("#customer_id").val();
        var user_id     = $("#user_id").val();
        
        swal({
            
              title: "Are you sure?",
              text: "Want to sent site audit sheet to this client!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  
                     $.ajax({
            
                        url : '<?php echo base_url('Installationprocess/send_site_audit_sheet') ?>',
                        type: 'POST',
                        data: {email:email,customer_id:customer_id,user_id:user_id},
                        success:function(data){
                            
                            swal("Mail sent successfully...", {
                              icon: "success",
                              
                            });
                            
                            
                        }
                        
                        
                    });
                  
               
              } 
        });
    }
    
    
</script>



<script src="<?php echo base_url();?>assets/js/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>assets/js/moment.js"></script>

 