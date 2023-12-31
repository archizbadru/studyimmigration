<?php $panel_menu = $this->db->select("tbl_user_role.user_permissions")

   ->where('pk_i_admin_id',$this->session->user_id)

   ->join('tbl_user_role','tbl_user_role.use_id=tbl_admin.user_permissions')

   ->get('tbl_admin')

   ->row();

   if (!empty($panel_menu->user_permissions)) {

   $module=explode(',',$panel_menu->user_permissions);

   }else{$module=array();}?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<?php function initials($str) {

   $ret = '';

   foreach (explode(' ', $str) as $word)

   $ret .= strtoupper($word[0]);

   return $ret;

   } ?>

<style>

   [data-letters]:before {

   content: attr(data-letters);

   display: inline-block;

   font-size: 1em;

   width: 2.5em;

   height: 2.5em;

   line-height: 2.5em;

   text-align: center;

   border-radius: 50%;

   background: #37a000;

   vertical-align: middle;

   margin-right: 1em;

   color: white;

   }

   [data-lettersno]:before {

   content: attr(data-lettersno);

   display: inline-block;

   font-size: 1em;

   width: 2.5em;

   height: 2.5em;

   line-height: 2.5em;

   text-align: center;

   border-radius: 50%;

   background:#E5343D;

   vertical-align: middle;

   margin-right: 1em;

   color: white;

   }

   [data-letterasctive]:before {

   content: attr(data-letterasctive);

   display: inline-block;

   font-size: 1em;

   width: 2.5em;

   height: 2.5em;

   line-height: 2.5em;

   text-align: center;

   border-radius: 50%;

   background:#3a95e4;

   vertical-align: middle;

   margin-right: 1em;

   color: white;

   }

   [data-green]:before {

   content: attr(data-green);

   display: inline-block;

   font-size: 1em;

   width: 2.5em;

   height: 2.5em;

   line-height: 2.5em;

   text-align: center;

   border-radius: 50%;

   background:green;

   vertical-align: middle;

   margin-right: 1em;

   color: white;

   }

   [data-black]:before {

   content: attr(data-black);

   display: inline-block;

   font-size: 1em;

   width: 2.5em;

   height: 2.5em;

   line-height: 2.5em;

   text-align: center;

   border-radius: 50%;

   background:#000;

   vertical-align: middle;

   margin-right: 1em;

   color: white;

   }

   .table th {vertical-align: center!important;}

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

   .dropdown_css {

   left:auto!important;

   right: 0 ! important;}

   .dropdown_css a,.dropdown_css a h4{width:100%;text-align:left! important;;

   border-bottom: 1px solid #c8ced3! important;}

   table {

   font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";

   font-size: 1em;

   font-weight: 400;

   line-height: 1.5;

   color: #23282c;

   text-align: left;

   }

   .border_bottom{border-bottom:2px solid #E4E5E6;min-height: 7vh;margin-bottom: 1vh;cursor:pointer;}  

   .border_bottom_active{border-bottom:2px solid #20A8D8;min-height: 7vh;margin-bottom: 1vh;cursor:pointer;} 

</style>

<div class="row">

   <div class="col-md-12" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">

      <div class="col-md-6" >Lead

      </div>

      <div class="col-md-6" >

         <div style="float:right">

            <div  class="btn-group" role="group" aria-label="Button group">

               <a class="dropdown-toggle" href="<?php echo base_url()?>enquiry/create" title="<?php echo display('add_new_enquiry');?>"> <i class="fa fa-plus" style="background:#fff !important;border:none!important;color:green;"></i></a>&nbsp;&nbsp;&nbsp;

            </div>

            <div class="btn-group" role="group" aria-label="Button group">

               <a class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

               <i class="fa fa-check icon_color"></i>

               </a>  

               <div class="dropdown-menu dropdown_css" style="max-height: 400px;overflow: auto;">

                  <h4 class="btn"><?php echo display('action');?></h4>

                  <a class="btn" data-toggle="modal" data-target="#AssignSelected" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #fff;"><?php echo display('assign_selected'); ?></a>

                  <a class="btn" data-toggle="modal" data-target="#pre_sales" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #fff;">Assign To Pre-Sales </a>

                  <a class="btn" data-toggle="modal" data-target="#dropEnquiry" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('drop_lead'); ?></a>

                  <a class="btn"  data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('1','Send Whatssp');"  style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('send_whatsapp'); ?> </a>

                  <a class="btn " data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('2','Send Sms');" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('send_bulk_sms'); ?></a>

     
               </div>

            </div>

         </div>

      </div>

   </div>
   <div class="row">

     <div class="col-md-12 "  id="active_class">
                   
          <div class="col-md-2" style="">
        <div  class="col-12 border_bottom" >
            <p style="margin-top: 2vh;font-weight:bold;"><a class="filtered_by"  data-ci-pagination-page="0/1"  title="<?php echo display('created_today'); ?>"><i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo display('created_today'); ?><span style="float:right;" class="badge badge-pill badge-primary " id="today_created"></span></a></p></div>
            </div>
              <div class="col-md-2" style="margin-left:40px;">
            <div class="col-12 border_bottom" style="min-height:7vh;margin-bottom: 1vh;cursor:pointer;">
                <p style="margin-top: 2vh;font-weight:bold;" ><a class="filtered_by"  data-ci-pagination-page="0/2"  title="<?php echo display('updated_today'); ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;<?php echo display('updated_today'); ?><span style="float:right;background:#ffc107" class="badge badge-pill badge-warning badge badge-dark " id="today_updated"></span></a></p></div>
                </div>
                  <div class="col-md-2" style="margin-left:40px;">
        <div  class="col-12 border_bottom border_bottom_active" >
                <p style="margin-top: 2vh;font-weight:bold;"  title="<?php echo display('active'); ?>"> <a class="filtered_by"  data-ci-pagination-page="0/3" ><i class="fa fa-file" ></i>&nbsp;&nbsp;<?php echo display('active'); ?><span style="float:right;" class="badge badge-pill badge-primary " id="active_all"></span></a></p></div>
                </div>
                  
                  <div class="col-md-2" style="margin-left:40px;">
            <div  class="col-12 border_bottom" >
                <p style="margin-top: 2vh;font-weight:bold;"   title="<?php echo display('droped'); ?>"><a class="filtered_by"  data-ci-pagination-page="0/4" ><i class="fa fa-thumbs-down" ></i>&nbsp;&nbsp;<?php echo display('droped'); ?><span style="float:right;background:#E5343D" class="badge badge-danger" id="active_drop"></span></a></p></div>
                </div>
                  <div class="col-md-2" style="margin-left:40px;">
            <div class="col-12 border_bottom" >
                <p style="margin-top: 2vh;font-weight:bold;"  title="<?php echo display('total'); ?>"><a class="filtered_by"  data-ci-pagination-page="0/5" ><i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo display('total'); ?><span style="float:right;background:#000" class="badge badge-pill badge-dark " id="total_active"></span></a></p></div>
          </div>
   
    </div>
  

      <div class="panel panel-default thumbnail" style="padding:20px;">
	<div class="container">
	<div class="row ">
         <form class="form-inner" method="post" id="enquery_assing_from" >
		 <ul  class="nav nav-pills">
            <li class="active" onclick="reset_input()">
               <a href="#tab-ttoday" data-toggle="tab"><?php echo display('all_leads'); ?></a>
            </li>
            <?php
               foreach ($lead_stages as $stages) {
                   $num_led =0;
                   foreach ($all_active->result() as $enqs) {
                       if ($stages->stg_id == $enqs->lead_stage) {
                           $num_led++;
                       }
                   }
                   ?>
            <li onclick="lead_by_stage('<?php echo $stages->stg_id; ?>','0')"><a href="#tab-<?= $stages->stg_id ?>" data-toggle="tab"><?= $stages->lead_stage_name . ' (' . $num_led . ')' ?> </a>
            </li>
            <?php } ?>
         </ul>
           <table id='employeeList' class="table table-striped table-bordered">
		    <div class="col-md-2" style="float:right;margin-top:-10px;">
		    <input type='text' class="form-control" id="search_row" placeholder="Search" >
			<br></div>
			<thead>
			<tr>
				     <th width="10px;"><input type='checkbox' class="checked_all1" value="check all" ></th>
                     <th width="10px;">S.N</th>
                     <th class="sorting_asc wid-20">Source</th>
					 <th class="sorting_asc wid-20">Company Name</th>
                     <th class="sorting_asc wid-20">Name</th>
                     <th class="sorting_asc wid-20">Email</th>
                     <th class="sorting_asc wid-20">Phone</th>
                     <th class="sorting_asc wid-20">Address</th>
					  <th class="sorting_asc wid-20">Process</th>
					

                     <th class="sorting_asc wid-20" nowrap>TBRO Date</th>
                     <th class="sorting_asc wid-20" nowrap>Created By</th>
                     <th class="sorting_asc wid-20" nowrap>Assigned To</th>
                     <th class="sorting_asc wid-20" nowrap>Data Source</th>
			</tr>
			</thead>
			<tbody>
			<?php  if(!empty($empData)){ $i=1;foreach($empData as $emp){?>
			<tr style="cursor:pointer;" target="_blank" onclick="window.location='<?php echo base_url("lead/lead_details/".$emp->enquiry_id);?>'" >  
			<td> <input onclick='event.stopPropagation();' type='checkbox' name='enquiry_id[]' class='checkbox1' value='<?php echo $emp->enquiry_id; ?>' > </td>
			<td><?php echo $emp->enquiry_id;?></td>
			<td><?php echo $emp->icon_url; ?></td>
			<td><?php echo $emp->company; ?></td>
			<td><?php echo $emp->name_prefix.''.$emp->name.''.$emp->lastname; ?></td>
			<td><?php echo $emp->email; ?></td>
			<td><?php echo $emp->phone; ?></td>
			<td><?php echo $emp->address; ?></td>
			<td><?php echo $emp->product_name; ?></td>
			<td><?php echo $emp->tbro_date; ?></td>
			<td><?php echo $emp->created_by_name; ?></td>
			<td><?php echo $emp->assign_to_name; ?></td>
			<td><?php echo $emp->datasource_name; ?></td>
			
			</tr>
			<?php $i++;}} ?></tbody>
		</table>
		<div id='pagination'><?php if(!empty($pagination)){echo  $pagination; } ?></div>	
		<div id='pagination2'></div>
		</div>	
		</div>	
		   <div id="genLead" class="modal fade" role="dialog">

   <div class="modal-dialog">

   <!-- Modal content-->

   <div class="modal-content">

   <div class="modal-header">

   <button type="button" class="close" data-dismiss="modal">&times;</button>

   <h4 class="modal-title">Enter info and Move to lead</h4>

   </div>

   <div class="modal-body">

   <div class="row">

   <div class="form-group col-sm-6">  

   <label>Opportunity Size</label>                  

   <input class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="opportunity_size" type="text" required>                

   </div>

   <div class="form-group col-sm-6">  

   <label>Expected Closer Date</label>                  

   <input class="form-control date2"  name="expected_date" type="text" readonly>                

   </div>

   <div class="form-group col-sm-6">

   <label class="col-form-label">Conversion Probability</label>

   <select class="form-control" id="LeadScore" name="lead_score">

   <option></option>                                               

   <?php foreach ($lead_score as $score) {  ?>

   <option value="<?= $score->sc_id?>"><?= $score->score_name?>&nbsp;<?= $score->probability?></option>

   <?php } ?>                       

   </select>

   </div>

   <div class="form-group col-sm-6">  

   <label>Add Comment</label>                  

   <input class="form-control" id="LastCommentGen" name="comment" type="text">                

   </div>

   <div class="form-group col-sm-12">        

   <button class="btn btn-success" type="button" onclick="moveto_lead();" >Move to Lead</button>        

   </div>

   </div>

   </div>

   <div class="modal-footer">

   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

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

   <h4 class="modal-title">Lead Assignment</h4>

   </div>

   <div class="modal-body">

   <div class="row">

   <div class="form-group col-md-12">  

   <label>Select Employee</label>                  

   <select class="form-control"  name="assign_employee">                    

   <?php foreach ($user_list as $user) { 

      if (!empty($user->user_permissions)) {

                     $module=explode(',',$user->user_permissions);

                     }

                     

                     if(in_array(60,$module)==true||in_array(61,$module)==true||in_array(62,$module)==true){

      ?>

   <option value="<?php echo $user->pk_i_admin_id; ?>"><?=$user->s_display_name ?>&nbsp;<?=$user->last_name; ?></option>

   <?php } }?>                                                     

   </select> 

   </div>

   <input type="hidden" value="" class="enquiry_id_input" >

   <div class="form-group col-sm-12">        

   <button class="btn btn-success" type="button" onclick="assign_enquiry();"><?php echo display('Save'); ?></button>        

   </div>

   </div>

   </div>

   <div class="modal-footer">

   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

   </div>

   </div>

   </div>

   </div>

   <div id="pre_sales" class="modal fade" role="dialog">

   <div class="modal-dialog">

   <!-- Modal content-->

   <div class="modal-content">

   <div class="modal-header">

   <button type="button" class="close" data-dismiss="modal">&times;</button>

   <h4 class="modal-title">Lead Assignment</h4>

   </div>

   <div class="modal-body">

   <div class="row">

   <div class="form-group col-md-12">  

   <label>Select Employee</label>                  

   <select class="form-control"  name="assign_presales">                    

   <?php foreach ($user_list as $user) { 

      if (!empty($user->user_permissions)) {

                    $module=explode(',',$user->user_permissions);

                    }

      

      if(in_array(150,$module)==true){?>

   <option value="<?php echo $user->pk_i_admin_id; ?>"><?=$user->s_display_name ?>&nbsp;<?=$user->last_name; ?></option>

   <?php }} ?>                                                     

   </select> 

   </div>

   <input type="hidden" value="" class="enquiry_id_input" >

   <div class="form-group col-sm-12">        

   <button class="btn btn-success" type="button" onclick="assign_pre_sales();"><?php echo display('Save'); ?></button>        

   </div>

   </div>

   </div>

   <div class="modal-footer">

   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

   </div>

   </div>

   </div>

   </div>

   <!---------------------------- DROP Enquiry -------------------------------->

   <div id="dropEnquiry" class="modal fade" role="dialog">

   <div class="modal-dialog">

   <!-- Modal content-->

   <div class="modal-content">

   <div class="modal-header">

   <button type="button" class="close" data-dismiss="modal">&times;</button>

   <h4 class="modal-title">Drop Lead</h4>

   </div>

   <div class="modal-body">

   <div class="row">

   <div class="form-group col-sm-12">  

   <label>Drop Status</label>                  

   <select class="form-control"  name="drop_status">                    

   <?php foreach ($drops as $drop) {   ?>

   <option value="<?php echo $drop->d_id; ?>"><?php echo $drop->drop_reason; ?></option>

   <?php } ?>                                             

   </select> 

   </div>

   <div class="form-group col-sm-12"> 

   <label>Drop Reason*</label>

   <input class="form-control" name="reason" type="text" required="">  

   </div> 

   </div>          

   <div class="col-12" style="padding: 0px;">

   <div class="row">              

   <div class="col-12" style="text-align:center;">                                                

   <button class="btn btn-success" type="button" onclick="drop_enquiry()">Save</button>            

   </div>

   </div>                                   

   </div> 

   </div>

   <div class="modal-footer">

   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

   </div>

   </div>

   </div>

   </div>

   <div id="sendsms" class="modal fade" role="dialog">

   <div class="modal-dialog">

   <!-- Modal content-->

   <div class="modal-content card">

   <div class="modal-header">

   <button type="button" class="close" data-dismiss="modal">&times;</button>

   <h4 class="modal-title" id="modal-title"></h4>

   </div>

   <div>

   <div class="form-group col-sm-12">

   <label><?php echo display('template_name');?></label>

   <select class="form-control" name="templates" required id="templates" onchange="getMessage()">

   </select>

   </div>

   <div class="form-group col-sm-12"> 

   <label><?php echo display('message') ?></label>

   <textarea class="form-control" name="message_name" rows="10" type="number" id="template_message"></textarea>  

   </div>

   </div>

   <div class="col-md-12">

   <button class="btn btn-success" type="button" onclick="send_sms()"><?php echo display('send');?></button>            

   <input type="hidden" value="2" id="mesge_type" name="mesge_type">

   </div>

   <div class="modal-footer">

   <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo display('close');?></button>

   </div>

   </div>

   </div>

   </div>

   <div id="deleteselected" class="modal fade" role="dialog">

   <div class="modal-dialog">

   <div class="modal-content">

   <div class="modal-body">

   <i class="fa fa-question-circle" style="font-size:100px;"></i><br><h1>Are you sure, you want to permanently delete selected record?</h1>

   </div>

   <div class="modal-footer">

   <button type="button" class="btn btn-success" onclick="delete_recorde()">Ok</button>

   <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

   </div>

   </div>

   </div>

   </div>

   </form>

</div>
		
		
		
      </div>

   </div>

 


<script type='text/javascript'>
$(document).ready(function() {
		$("#search_row").blur(function () {
		  var value = this.value.toLowerCase().trim();
		   var res = 0;
		createPagination(0,value);
	});
	$('#active_class').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		 var res = pageNum.substr(1, 2);
		 var res1 = pageNum.substr(0, 1);
		createPagination(res1,res);
	});
	
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		createPagination(pageNum,'');
	});
	function createPagination(pageNum,res){

      var format = /[ !@#$%^&*()_+\-=\[\]{};':"|,.<>?]/;

       if(format.test(res)){
         //alert(res);      
         res = encodeURIComponent(res);      
         //alert(res);
       }else{
         //alert(res);
       }
      
		$.ajax({
			url: '<?=base_url()?>led/loaddata/'+pageNum+'/'+res,
			type: 'get',
			dataType: 'json',
			success: function(responseData){
				$('#pagination').html(responseData.pagination);
				paginationData(responseData.empData);
				//alert(responseData.empRecordic);
			}
		});
	}
	function paginationData(data) {
		//$('#employeeList tbody').innerHTML('');
		var empRow='';
		var baseurl="<?php echo base_url("lead/lead_details/");?>";
		var i=1;
		for(emp in data){
			var url="'"+baseurl+ data[emp].enquiry_id+"'";
			empRow+= '<tr style="cursor:pointer;" target="_blank" onclick="window.location='+url+'">'; 
			empRow += "<td> <input onclick='event.stopPropagation();' type='checkbox' name='enquiry_id[]' class='checkbox1' value='"+ data[emp].enquiry_id+"' > </td>";
			empRow += "<td>"+data[emp].enquiry_id+"</td>";
			empRow += "<td>"+ data[emp].icon_url+"</td>";
			empRow += "<td>"+ data[emp].company +"</td>";
			empRow += "<td>"+ data[emp].name_prefix + data[emp].name+ data[emp].lastname+"</td>";
			empRow += "<td>"+ data[emp].email +"</td>";
			empRow += "<td>"+ data[emp].phone +"</td>";
			empRow += "<td>"+ data[emp].address +"</td>";
			empRow += "<td>"+ data[emp].product_name +"</td>";
			empRow += "<td>"+ data[emp].tbro_date +"</td>";
			empRow += "<td>"+ data[emp].created_by_name +"</td>";
			empRow += "<td>"+ data[emp].assign_to_name +"</td>";
			empRow += "<td>"+ data[emp].datasource_name +"</td>";
			
			empRow += "</tr>";
			i++;					
		}
		$('#employeeList tbody').empty().append(empRow);
		//$('#employeeList tbody').html(empRow);
	}
	
	$.ajax({
			url: '<?=base_url()?>led/stages_of_enq',
			type: 'get',
			dataType: 'json',
			success: function(responseData){
			//	alert(responseData);
			$('#today_created').html(responseData.all_creaed_today_num);
			$('#active_all').html(responseData.all_active_num);
			$('#today_updated').html(responseData.all_today_update_num);
			$('#active_drop').html(responseData.all_drop_num);
			$('#total_active').html(responseData.all_enquery_num);
			}
		});
		

	
	
});
       function lead_by_stage(id,res){
        $.ajax({ 
			url: '<?=base_url()?>led/lead_by_stage/'+id+'/'+res,
			type: 'get',
			dataType: 'json',
			success: function(responseData){
				$('#pagination').html(responseData.pagination);
				paginationDatas(responseData.empData);
				//alert(responseData);
			}
		   });}
		function paginationDatas(data) {
		//	alert(data);
		var empRow='';
		var baseurl="<?php echo base_url("lead/lead_details/");?>";
		var i=1;
		for(emp in data){
			var url="'"+baseurl+ data[emp].enquiry_id+"'";
			empRow+= '<tr style="cursor:pointer;" target="_blank" onclick="window.location='+url+'">'; 
			empRow += "<td> <input onclick='event.stopPropagation();' type='checkbox' name='enquiry_id[]' class='checkbox1' value='"+ data[emp].enquiry_id+"' > </td>";
			empRow += "<td>"+i+"</td>";
			empRow += "<td>"+ data[emp].icon_url+"</td>";
			empRow += "<td>"+ data[emp].company +"</td>";
			empRow += "<td>"+ data[emp].name_prefix + data[emp].name+ data[emp].lastname+"</td>";
			empRow += "<td>"+ data[emp].email +"</td>";
			empRow += "<td>"+ data[emp].phone +"</td>";
			empRow += "<td>"+ data[emp].address +"</td>";
			empRow += "<td>"+ data[emp].product_name +"</td>";
			empRow += "<td>"+ data[emp].created_date +"</td>";
			empRow += "<td>"+ data[emp].created_by_name +"</td>";
			empRow += "<td>"+ data[emp].assign_to_name +"</td>";
			empRow += "<td>"+ data[emp].datasource_name +"</td>";
			
			empRow += "</tr>";
			i++;					
		}
		$('#employeeList tbody').empty().append(empRow);
	}
	
		
</script>
<script>

   function reset_input(){

   $('input:checkbox').removeAttr('checked');

   }

   function check_all(checkclass,checkbox){

       $('.'+ checkclass).on('change', function() {     

                   $('.'+ checkbox).prop('checked', $(this).prop("checked"));

                   

           });

           $('.'+checkbox).change(function(){ 

               if($('.'+ checkbox +':checked').length == $('.'+ checkbox).length){

                      $('.'+ checkclass).prop('checked',true);

               }else{

                      $('.'+ checkclass).prop('checked',false);

               }

           });

   }  

           

           

           $('.checked_all1').on('change', function() {     

                   $('.checkbox1').prop('checked', $(this).prop("checked"));

                   

           });

           $('.checkbox1').change(function(){ 

               if($('.checkbox1:checked').length == $('.checkbox1').length){

                      $('.checked_all1').prop('checked',true);

               }else{

                      $('.checked_all1').prop('checked',false);

               }

           });

           

            $('.checked_all2').on('change', function() {     

                   $('.checkbox2').prop('checked', $(this).prop("checked"));              

           });

           $('.checkbox1').change(function(){ 

               if($('.checkbox2:checked').length == $('.checkbox2').length){

                      $('.checked_all2').prop('checked',true);

               }else{

                      $('.checked_all2').prop('checked',false);

               }

           });

           

            $('.checked_all3').on('change', function() {     

                   $('.checkbox3').prop('checked', $(this).prop("checked"));              

           });

           $('.checkbox3').change(function(){ 

               if($('.checkbox3:checked').length == $('.checkbox3').length){

                      $('.checked_all3').prop('checked',true);

               }else{

                      $('.checked_all3').prop('checked',false);

               }

           });

           

            $('.checked_all4').on('change', function() {     

                   $('.checkbox4').prop('checked', $(this).prop("checked"));              

           });

           $('.checkbox4').change(function(){ 

               if($('.checkbox4:checked').length == $('.checkbox4').length){

                      $('.checked_all4').prop('checked',true);

               }else{

                      $('.checked_all4').prop('checked',false);

               }

           });

           

            $('.checked_all5').on('change', function() {     

                   $('.checkbox5').prop('checked', $(this).prop("checked"));              

           });

           $('.checkbox5').change(function(){ 

               if($('.checkbox5:checked').length == $('.checkbox5').length){

                      $('.checked_all5').prop('checked',true);

               }else{

                      $('.checked_all5').prop('checked',false);

               }

           });

           

            $('.checked_all6').on('change', function() {     

                   $('.checkbox6').prop('checked', $(this).prop("checked"));              

           });

           $('.checkbox5').change(function(){ 

               if($('.checkbox6:checked').length == $('.checkbox6').length){

                      $('.checked_all6').prop('checked',true);

               }else{

                      $('.checked_all6').prop('checked',false);

               }

           });

           

           

   

   

       

</script>

<script>

   function getTemplates(SMS,type){

       

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>message/get_templates/'+SMS,

   })

   .done(function(data){

       

       $('#modal-titlesms').html(type);

       $('#mesge_type').val(SMS);

       $('#templates').html(data);

   })

   .fail(function() {

   alert( "fail!" );

   

   });

   }

 function  send_sms(){
     $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>message/send_sms',
    data: $('#enquery_assing_from').serialize()
    })
    .done(function(data){
        
        alert(data);
      location.reload();
    })
    .fail(function() {
    alert( "fail!" );
    
    });   
}

    

</script>

<script>

     function getMessage(){
       id=document.getElementById('templates').value;
$.ajax({
type: 'POST',
url: '<?php echo base_url();?>message/getMessage/'+id,
})
.done(function(data){
    $("#template_message").html(data);
})
.fail(function() {
alert( "fail!" );

});
}

   

   function save_enquery(){

      

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>enquiry/create',

   cache: false,

   data: $('#enquery_from').serialize(),

   dataType: 'json',

   success:function(data){

   if(data.status === true )	

   	  document.location.href = data.redirect;

   else  

        document.getElementById('success').style.display='none';

   	 document.getElementById('error').style.display='inline';

   	 $('#error').html(data.error);

          

   }});

   }

   

   function assign_enquiry(){

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>lead/assign_lead',

   data: $('#enquery_assing_from').serialize(),

   success:function(data){

      if(data=='1'){

            alert('<?php  echo display('save_successfully');?>'); 

         window.location.href='<?php echo base_url();?>lead'

       }else{

        alert(data);

       }

   }});

   }

   function assign_pre_sales(){

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>lead/assign_presales',

   data: $('#enquery_assing_from').serialize(),

   success:function(data){

      if(data=='1'){

            alert('<?php  echo display('save_successfully');?>'); 

         window.location.href='<?php echo base_url();?>lead'

       }else{

        alert(data);

       }

   }});

   }

   

   function moveto_lead(){

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>enquiry/move_to_lead',

   data: $('#enquery_assing_from').serialize(),

   success:function(data){

       if(data=='1'){

            alert('Successfully Moved in Leads'); 

         window.location.href='<?php echo base_url();?>enquiry'

       }else{

        alert(data);

       }

   }});

   }

   

   function drop_enquiry(){

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>lead/drop_leadss',

   data: $('#enquery_assing_from').serialize(),

   success:function(data){

           if(data=='1'){

          alert('Successfully Droped Lead'); 

         window.location.href='<?php echo base_url();?>lead'

       }else{

         alert(data); 

       }

   }});

   }

   

   

   function delete_recorde() {

       $('#enquery_assing_from').attr('action','<?php echo base_url();?>lead/delete_recorde')

       $('#enquery_assing_from').submit()

   }

   

   

   

   

</script>

<script type="text/javascript">

   function find_city() {

    $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>location/get_city_byid',

   data: $('#enquery_from').serialize()

   })

   .done(function(data){

   if(data!=''){

     document.getElementById('city_name').innerHTML=data;

   }else{

     document.getElementById('city_name').innerHTML='';   

   }

   })

   .fail(function() {

   

   });

   }

</script>

<script>

   function hide_td(id,id2){

    var a=   document.getElementById(id2);

    if(a.checked==true){   

     $('.'+id).css('visibility','visible');

   $('.'+id).css('display','table-cell');  

     //  document.getElementsByClassName("th1").style.visibility = "hidden";

   }else{

       $('.'+id).css('visibility','hidden');

   $('.'+id).css('display','none');

       

   

   }

   }

</script>

<style>

   input[type=number]::-webkit-inner-spin-button, 

   input[type=number]::-webkit-outer-spin-button { 

   -webkit-appearance: none; 

   margin: 0; 

   }

   input[type=number]::-webkit-inner-spin-button, 

   input[type=number]::-webkit-outer-spin-button { 

   -webkit-appearance: none;

   -moz-appearance: none;

   appearance: none;

   margin: 0; 

   }

</style>

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

          format:'DD-MM-YYYY',

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

      

</script>
<script type='text/javascript'>

   $(window).load(function(){

   $("#active_class p").click(function() {

       $('.border_bottom_active').removeClass("border_bottom_active");

       $(this).removeClass("border_bottom");

       $(this).addClass("border_bottom_active");

   });

   });  

</script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>