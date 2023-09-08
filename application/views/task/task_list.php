<?php $task_list = $this->config->item('task_list');?> 


<style type="text/css">
    .btnStatus{
      padding: 0px 4px !important;
      color: #fff !important;
      width: 79px!important; 
    }
   .Pending{
   background-color: #337ab7 !important;
   border-color: #337ab7 !important;
   }
   .Processing{
   background-color: #f2711c !important;
   border-color: #f2711c !important;
   }
   .Completed{
   background-color: #37a000 !important;
   border-color: #318d01 !important;
   }
   .Closed{
   background-color: #db2828 !important;
   border-color: #db2828 !important;
   }
</style>
<link href="<?php echo base_url();?>assets/css/fullcalendar.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/fullcalendar.print.min.css" media="print">
<div class="col-md-12" >
   <?php
   /*echo "<pre>";
   print_r($recent_tasks);
   echo "<pre>";*/
   ?>
   <div class="card-body">
      <div class="col-md-12">
         <div id="calendar" style="width:100%"></div>
         <br><br>
      </div>
      <span style="font-size: 14px;font-weight: bold;">
      Task Details:
      </span>
      <!-- <button class="btn btn-sm btn-success" style="float: right"  type="button" data-toggle="modal" data-target="#createTask">
      <i class="fa fa-dot-circle-o"></i> Create TBRO</button>  -->
   </div>
   <div  id="task_div" >
      <table class="table table-striped table-bordered dataTable"  cellspacing="0" width="100%">
         <thead>
            <tr>
               <th>Date</th>
               <th>Time</th>
               <th>Task</th>
               <th>Person Name</th>               
               <th>Created By</th>
               <th>Mobile No </th>
               <th>Task Status</th>
            </tr>
         </thead>
         <tbody>
            <?php 
               foreach ($recent_tasks as $task){               
               if(!empty($task->upd_date)){
                  $d = strtotime($task->upd_date);               
                  $nd = date("Y/m/d",$d);               
                  $nd = $task->upd_date?$nd:'NA';                                 
                  $nt = date("H:i:s",$d);
               }else{
                  $nd = 'NA';
                  $nt = 'NA';
               }
               $this->db->where('Enquery_id',$task->query_id);
               $enquiry_row   =    $this->db->get('enquiry')->row_array();
               if (!empty($enquiry_row)) {
                  
                  if ($enquiry_row['status'] == 1) {

                     $url = base_url().'enquiry/view/'.$enquiry_row['enquiry_id'];                  

                  }else if ($enquiry_row['status'] == 2) {
                     
                     $url = base_url().'lead/lead_details/'.$enquiry_row['enquiry_id'];                  

                  }else if ($enquiry_row['status'] == 3) {
                     
                     $url = base_url().'client/view/'.$enquiry_row['enquiry_id'].'/'.$enquiry_row['Enquery_id'];                  

                  }
                  
               }else{
                  $url = 'javascript:void(0)';
               }
               ?>
            <tr onclick='window.location="<?=$url?>"' style="cursor: pointer;">
               <td><?= $nd ?></td>
               <td><?= $nt ?></td>
               <td><?= $task->task_remark ?></td>
               <td><?php echo $enquiry_row['name_prefix'].'&nbsp;'.$enquiry_row['name'].'&nbsp;'.$enquiry_row['lastname']."</a>"; ?> </td>
               <td>
                  <?php
                   echo $task->user_name; 
                  ?> 
               </td>
               <td><?= $task->mobile; ?> </td>
               <td>
               <?php
               $taskStatus = ''; 
                foreach($taskstatus_list as $val){
                    if($task->task_status == $val->taskstatus_id){$taskStatus = $val->taskstatus_name;break;}
                }?>
                <a class="btn btnStatus <?php echo $taskStatus;?>"><?php echo $taskStatus;?></a>
               </td>               
            </tr>
            <?php } ?>
         </tbody>
      </table>
      <br>
   </div>
   <div  id="task_div1" >
   </div>
</div>
<div id="range" class="modal fade in" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" onclick="closedmodel()">&times;</button>
            <h4 class="modal-title">Search</h4>
         </div>
         <div class="modal-body">
            <form  action="" method="POST" id="searc_task">  
               <input class="form-control" id="FormInfo" name="task_id" type="hidden" value=" " >
               <label>Date From:</label>
               <input class="form-control" id="txtDate" name="task_start" type="text" placeholder="Start Task Date" readonly>                
               <br> 
               <label>Date To:</label>
               <input class="form-control" id="txtDate2" name="task_end" type="text" placeholder="End Task Date" readonly>
               <br>
               <button class="btn btn-sm btn-success" style="float: right" type="button" onclick="search_comment_and_task()">
               <i class="fa fa-dot-circle-o"></i> <?php echo display('search'); ?></button>                    
               <br>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closedmodel()">Close</button>
         </div>
      </div>
   </div>
</div>
<script>
   function search_comment_and_task(){
           var id= $("#user_id_fortask").val();
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>task/search_comment_and_task/'+date.format()+'/'+id,
   data: $('#searc_task').serialize()
   })
   .done(function(data){
    $("#task_div").attr("style", "display:none");
    $("#task_div1").attr("style", "display:block");
    $("#task_div1").html(data.details1);     
    $("#range").attr("style", "display:none");
   })
   .fail(function(){
    alert( "fail!" );   
   });
   }   
</script>
<script>
   function closedmodel(){
     $("#range").attr("style", "display:none");
   }  
    $(function () {
      var bindDatePicker = function() {
   		$(".date").datetimepicker({
           format:'DD-MM-YYYY hh:mm:ss a',   minDate : 0,
   			icons: {
   				time: "fa fa-clock-o",
   				date: "fa fa-calendar",
   				up: "fa fa-arrow-up",
   				down: "fa fa-arrow-down"
   			}
   		}).find('input:first').on("blur",function () {
   			// check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
   			// update the format if it's yyyy-mm-dd
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
    $(function () {
      var bindDatePicker = function() {
   		$(".date2").datetimepicker({
           format:'DD-MM-YYYY',minDate : 0,
   			icons: {
   				time: "fa fa-clock-o",
   				date: "fa fa-calendar",
   				up: "fa fa-arrow-up",
   				down: "fa fa-arrow-down"
   			}
   		}).find('input:first').on("blur",function () {
   			// check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
   			// update the format if it's yyyy-mm-dd
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
      
      $(document).ready(function() {
      $('#txtDate').datepicker({format:'DD-MM-YYYY'});
      $('#txtDate').focus(function() {
        $(this).datepicker("show");
        setTimeout(function() {
          $('#txtDate').datepicker("hide");
          $('#txtDate').blur();
        }, 2000)
      })    
      });
    $(document).ready(function() {
      $('#txtDate2').datepicker({format:'DD-MM-YYYY'});
      $('#txtDate2').focus(function() {
        $(this).datepicker("show");
        setTimeout(function() {
          $('#txtDate2').datepicker("hide");
          $('#txtDate2').blur();
        }, 2000)
      })    
   });
     
     
       $( ".datepicker-avaiable-days" ).datepicker({
           dateFormat: "yy-mm-dd",
           changeMonth: true,
           changeYear: true,
           showButtonPanel: false,
           minDate: 0,  
           // beforeShowDay: DisableDays 
        });  
</script>
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
           <?php  foreach ($recent_tasks as $task){
            $task_date1   =  date_create($task->task_date);
            $this->db->where('Enquery_id',$task->query_id);
            $enquiry_row   =    $this->db->get('enquiry')->row_array();
            
            if(!empty($task_date1)){

                 $name = $enquiry_row['name_prefix'].''.$enquiry_row['name'].''.$enquiry_row['lastname'];
                 if ($name == '') {
                     $name = $task->mobile;
                     if (!$name) {
                        $name = 'NA';
                     }
                 }

               $dt = date_format($task_date1,'Y-m-d'); ?>
               {
                 title          : "<?php echo $name; ?>",
                 start          : "<?php echo $dt; ?>",//new Date(<?php //echo date('Y',$dt); ?>, <?php //echo date('m',$dt); ?>, <?php //echo date('d',$dt); ?>),
                 backgroundColor: '#0073b7', 
                 url            : '',
                 borderColor    : '#0073b7'                  
               },
               <?php
            }
        }
      ?>
       ],
       dayClick:function(date,isEvent,view,resourseobj){
         $('td').dblclick(function(){           
        }); 
         
         //var id= $("#user_id_fortask").val();

         //alert('keny');
         ser_date = date.format();



                     $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url();?>task/search_comment_and_task/'+ser_date,
                     })
                     .done(function(data){
                         
                         $("#task_div").attr("style", "display:none");
                         $("#task_div1").attr("style", "display:block");
                        
                         $("#task_div1").html(data);
                     })
   
        
       },
   
     })
   
   
   })
</script> 
<script>
   function isNumber(evt) {
   evt = (evt) ? evt : window.event;
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode > 31 && (charCode < 48 || charCode > 57)) {
       return false;
   }
   return true;
   }
   function check_status(s){
   
   if(s==1){  
    $(".dynamic_field").css("display","block")
   } else{
    $(".dynamic_field").css("display","none")
   }  
   }
</script>
