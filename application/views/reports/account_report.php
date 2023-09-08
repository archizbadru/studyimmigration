<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<!------ Filter Div ---------->
    <div class="row" id="filter_pannel">
        <div class="col-lg-12">          
            <div class="panel panel-default">
                <div class="panel-heading no-print">
                  <div class="btn-group"> 
                      <a class="btn btn-primary" href="<?php echo base_url("report/account_report_list") ?>"> <i class="fa fa-list"></i>  <?php echo display('reports_list') ?> </a>
                      <?php if(user_access(220)) { if(!empty($this->session->telephony_token)){  ?>
                      <a class="btn btn-success" href="<?php echo base_url("call_report/index") ?>" style="margin-left: 5 px !important ;" > <i class="fa fa-list"></i>  <?php echo display('telephone_call_reports') ?> </a>
                    <?php } }?>
                  </div>
              </div>
                <div class="panel-body">
                    <div class="widget-title">                        
                        <h3><?=$title?></h3>
                    </div><hr>
                    <form method="post" class="lead-form" id="filter_and_save_form" action="<?php echo base_url('Report/account_mgmt') ?>">

                      <div class="form-row col-md-12">

                        <div class="form-group col-md-3">
                          <label for="inputEmail4"><?php echo display("from_date"); ?></label>
                          <input type="date" class="form-control" id="from-date" value="<?php if (!empty(set_value('from_exp'))) {echo set_value('from_exp');}?>" name="from_exp" style="padding-top:0px;">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("to_date"); ?></label>
                          <input type="date" class="form-control" id="to-date" value="<?php if (!empty(set_value('to_exp'))) {echo set_value('to_exp');}?>" name="to_exp" style="padding-top:0px;">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("employee"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="employee[]" id="employee">
                          

                 <?php foreach ($employee as $user) {?>
                                    <option value="<?=$user->pk_i_admin_id?>" <?php if(!empty(set_value('employee'))){if (in_array($user->pk_i_admin_id,set_value('employee'))) {echo 'selected';}}?>><?=$user->s_display_name . " " . $user->last_name;?> -  <?=$user->s_user_email?$user->s_user_email:$user->s_phoneno;?></option>
                                <?php }?>
                          </select>
                          <input type="checkbox" name="hier_wise" value="1" <?php if (!empty(set_value('hier_wise')) && set_value('hier_wise')==1) {echo 'checked';}?>>
                          Hierarchy wise
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("source"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="source[]" id="source">
                              
                               <?php foreach ($sourse as $row) {?>
                                 <option value="<?=$row->lsid?>" <?php if(!empty(set_value('source'))){if (in_array($row->lsid,set_value('source'))) {echo 'selected';}}?>><?=$row->lead_name?></option>
                              <?php }?>
                          </select>
                        </div>                      
                        
                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("status"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="state[]" id="state" onchange="lead_fields(this)">
                              
  <option value="1" <?php if(!empty(set_value('state'))){ if (in_array('1',set_value('state'))) {echo 'selected';}}?>>Onboarding</option>
  <option value="2" <?php if(!empty(set_value('state'))){ if (in_array('2',set_value('state'))) {echo 'selected';}}?>>Application</option>
  <option value="3" <?php if(!empty(set_value('state'))){ if (in_array('3',set_value('state'))) {echo 'selected';}}?>>Case Management</option>
  <option value="4" <?php if(!empty(set_value('state'))){ if (in_array('4',set_value('state'))) {echo 'selected';}}?>>Refund Case</option>
                          </select>
                        </div>
                        <div class="form-group col-md-3 lead_subsource_class">
                          <label for="lead_source">Disposition</label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="lead_source[]" id="lead_source" >
                              
                              
                              <?php 
                            if (!empty($all_stage_lists)) {
                              foreach ($all_stage_lists as $stage) {?>
                              <option value="<?=$stage->stg_id?>" <?php if(!empty(set_value('lead_source'))){if (in_array($stage->stg_id,set_value('lead_source'))) {echo 'selected';}}?>><?=$stage->lead_stage_name;?></option>
                              <?php }
                            }?>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("final_country "); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="final_country[]" id="final_country">
                            <option value="0"> Select</option>
                              <?php 
                                  if (!empty($all_country_list)) {
                                  foreach ($all_country_list as $country) { ?>
                                  <option value="<?=$country->id_c;?>" <?php if(!empty(set_value('final_country'))){if (in_array($country->id_c,set_value('final_country'))) {echo 'selected';}}?>><?=$country->country_name;?></option>
                              <?php }
                            }?>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("in_take"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="in_take[]" id="in_take">
                            <option value="">Select</option>
                          <option value="January" <?php if(!empty(set_value('in_take'))){if (in_array('January',set_value('in_take'))) {echo 'selected';}}?>> January</option>
                          <option value="February" <?php if(!empty(set_value('in_take'))){if (in_array('February',set_value('in_take'))) {echo 'selected';}}?>> February</option>
                          <option value="March" <?php if(!empty(set_value('in_take'))){if (in_array('March',set_value('in_take'))) {echo 'selected';}}?>> March</option>
                          <option value="April" <?php if(!empty(set_value('in_take'))){if (in_array('April',set_value('in_take'))) {echo 'selected';}}?>> April</option>
                          <option value="May" <?php if(!empty(set_value('in_take'))){if (in_array('May',set_value('in_take'))) {echo 'selected';}}?>> May</option>
                          <option value="June" <?php if(!empty(set_value('in_take'))){if (in_array('June',set_value('in_take'))) {echo 'selected';}}?>> June</option>
                          <option value="July" <?php if(!empty(set_value('in_take'))){if (in_array('July',set_value('in_take'))) {echo 'selected';}}?>> July</option>
                          <option value="August" <?php if(!empty(set_value('in_take'))){if (in_array('August',set_value('in_take'))) {echo 'selected';}}?>> August</option>
                          <option value="September" <?php if(!empty(set_value('in_take'))){if (in_array('September',set_value('in_take'))) {echo 'selected';}}?>> September</option>
                          <option value="October" <?php if(!empty(set_value('in_take'))){if (in_array('October',set_value('in_take'))) {echo 'selected';}}?>> October</option>
                          <option value="November" <?php if(!empty(set_value('in_take'))){if (in_array('November',set_value('in_take'))) {echo 'selected';}}?>> November</option>
                          <option value="December" <?php if(!empty(set_value('in_take'))){if (in_array('December',set_value('in_take'))) {echo 'selected';}}?>> December</option>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("visa_type"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="visa_type[]" id="visa_type">
                            <option value="0"> Select</option>
                              <?php foreach($visa_type as $visa){ ?>
                                  <option value="<?php echo $visa->id; ?>" <?php if(!empty(set_value('visa_type'))){if (in_array($visa->id,set_value('visa_type'))) {echo 'selected';}}?>><?php echo $visa->visa_type; ?>
                                  </option>
                              <?php } ?>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("preferred_country"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="preferred_country[]" id="preferred_country">
                            <option value="0"> Select</option>
                              <?php foreach($all_country_list as $product){ ?>
                              <option value="<?=$product->id_c?>" <?php if(!empty(set_value('preferred_country'))){if (in_array($product->id_c,set_value('preferred_country'))) {echo 'selected';}}?>><?=$product->country_name ?></option>
                          <?php } ?>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("nationality"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="nationality[]" id="nationality">
                            <option value="0"> Select</option>
                              <?php foreach($allcountry_list as $country){ ?>
                               <option value="<?= $country->id_c?>" <?php if(!empty(set_value('nationality'))){if (in_array($country->id_c,set_value('nationality'))) {echo 'selected';}}?>> <?= $country->country_name?></option>
                          <?php } ?>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("residing_country"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="residing_country[]" id="residing_country">
                            <option value="0"> Select</option>
                              <?php foreach($allcountry_list as $country){ ?>
                               <option value="<?= $country->id_c?>" <?php if(!empty(set_value('residing_country'))){if (in_array($country->id_c,set_value('residing_country'))) {echo 'selected';}}?>> <?= $country->country_name?></option>
                          <?php } ?>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("branch "); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="branch_name[]" id="branch_name">
                            <option value="0"> Select</option>
                              <?php 
                                  if (!empty($all_branch_list)) {
                                  foreach ($all_branch_list as $branch) { ?>
                                  <option value="<?=$branch->branch_name;?>" <?php if(!empty(set_value('branch_name'))){if (in_array($branch->branch_name,set_value('branch_name'))) {echo 'selected';}}?>><?=$branch->branch_name;?></option>
                              <?php }
                            }?>
                          </select>
                        </div>
                        
                      </div>
                      <div class="form-row col-md-12">
                        
                        <?php
                        $report_columns = 
                                        array(
                                              'S.No',
                                              'Name',
                                              'Phone',
                                              'Email',
                                              'Created By',
                                              'Assign To',
                                              'Gender',
                                              'Source',
                                              'Lead Description',
                                              'Status',
                                              'Process',
                                              'Updated Date',
                                              'Disposition',
                                              'Disposition Remark',
                                              'Drop Reason',
                                              'Conversion Probability',
                                              'Remark',
                                              'Status',
                                              'Process',
                                              'Updated Date',
                                              'In Take',
                                              'Visa Type',
                                              'Preferred Country',
                                              'Nationality',
                                              'Residing Country',
                                              'State',
                                              'City',
                                              'Branch Name',
                                              'Final Country',
                                              'Refund Status',
                                              'Refund Created Date',
                                              'Total Amount',
                                              'Advanced Recived',
                                              'Amount Paid',
                                              'Amount Due',
                                              'Payment Status',
                                              'Paid Date'
                                            );             
                        ?>
                        <div class="form-group col-md-12">
            
                          <label for="enq_product"><?php echo display("report_columns"); ?><label class="required" style="color:red">*</label></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control" name="report_columns[]" required  id = "selected-col">
                            
                <option <?php if(!empty(set_value('report_columns'))){ if (in_array('S.No',set_value('report_columns'))) {echo 'selected';}}?> selected>S.No</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Name',set_value('report_columns'))) {echo 'selected';}}?> selected>Name</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Phone',set_value('report_columns'))) {echo 'selected';}}?> selected>Phone</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Email',set_value('report_columns'))) {echo 'selected';}}?> selected>Email</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Created By',set_value('report_columns'))) {echo 'selected';}}?>>Created By</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Assign To',set_value('report_columns'))) {echo 'selected';}}?>>Assign To</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Gender',set_value('report_columns'))) {echo 'selected';}}?>>Gender</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Source',set_value('report_columns'))) {echo 'selected';}}?>>Source</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Disposition',set_value('report_columns'))) {echo 'selected';}}?>>Disposition</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Lead Description',set_value('report_columns'))) {echo 'selected';}}?>>Lead Description</option>
                
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Disposition Remark',set_value('report_columns'))) {echo 'selected';}}?>>Disposition Remark</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Drop Reason',set_value('report_columns'))) {echo 'selected';}}?>>Drop Reason</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Conversion Probability',set_value('report_columns'))) {echo 'selected';}}?>>Conversion Probability</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Remark',set_value('report_columns'))) {echo 'selected';}}?>>Remark</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Status',set_value('report_columns'))) {echo 'selected';}}?>>Status</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Process',set_value('report_columns'))) {echo 'selected';}}?>>Process</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Updated Date',set_value('report_columns'))) {echo 'selected';}}?>>Updated Date</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('State',set_value('report_columns'))) {echo 'selected';}}?>>State</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('City',set_value('report_columns'))) {echo 'selected';}}?>>City</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Branch Name',set_value('report_columns'))) {echo 'selected';}}?>>Branch Name</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Final Country',set_value('report_columns'))) {echo 'selected';}}?>>Final Country</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('In Take',set_value('report_columns'))) {echo 'selected';}}?>>In Take</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Visa Type',set_value('report_columns'))) {echo 'selected';}}?>>Visa Type</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Preferred Country',set_value('report_columns'))) {echo 'selected';}}?>>Preferred Country</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Nationality',set_value('report_columns'))) {echo 'selected';}}?>>Nationality</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Residing Country',set_value('report_columns'))) {echo 'selected';}}?>>Residing Country</option>
                
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Refund Status',set_value('report_columns'))) {echo 'selected';}}?> selected>Refund Status</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Refund Created Date',set_value('report_columns'))) {echo 'selected';}}?> selected>Refund Created Date</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Total Amount',set_value('report_columns'))) {echo 'selected';}}?> selected>Total Amount</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Advanced Recived',set_value('report_columns'))) {echo 'selected';}}?> selected>Advanced Recived</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Amount Paid',set_value('report_columns'))) {echo 'selected';}}?> selected>Amount Paid</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Amount Due',set_value('report_columns'))) {echo 'selected';}}?> selected>Amount Due</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Payment Status',set_value('report_columns'))) {echo 'selected';}}?> selected>Payment Status</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Paid Date',set_value('report_columns'))) {echo 'selected';}}?> selected>Paid Date</option>
 
                          </select>                          
                        </div>
                      </div>
                      <div class="row col-md-12">
                       <div class="form-group col-md-3">
                        <label>Dropped</label>
                       <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="drop_status[]" id = "selected-col">
                       
                       <option value="dropped" <?php if(!empty(set_value('drop_status'))){ if (in_array('dropped',set_value('drop_status'))) {echo 'selected';}}?>>Dropped</option>
                       <option value="active" <?php if(!empty(set_value('drop_status'))){ if (in_array('active',set_value('drop_status'))) {echo 'selected';}}?>>Active</option>
                       </select>
                       </div>
                       <div class="form-group col-md-3">
                          <label for="enq_product"><?php echo display("proccess"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="enq_product[]" id="enq_product" >
                                                           
                              <?php 
                              if (!empty($process)) {
                              foreach ($process as $product) {?>
                              <option value="<?=$product->sb_id;?>" <?php if(!empty(set_value('enq_product'))){if (in_array($product->sb_id,set_value('enq_product'))) {echo 'selected';}}?>><?=$product->product_name;?></option>
                              <?php }}?>                              
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="productlst"><?php echo display("product"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="productlst[]" id="productlst" >
                                                           
                              <?php 
                              if (!empty($products)) {
                              foreach ($products as $product) {?>
                              <option value="<?=$product->id;?>" <?php if(!empty(set_value('productlst'))){if (in_array($product->id,set_value('productlst'))) {echo 'selected';}}?>><?=$product->country_name;?></option>
                              <?php }}?>                              
                          </select>
                        </div>                         
                     </div>
                     <div class="row col-md-12">
                       <div class="form-group col-md-4">
                         <label for="enq_product">Follow Up Report</label>
                         <input type="checkbox" name="all" value="all" <?php if(!empty(set_value('all'))){?> checked <?php }?> >
                        </div>
                     </div>
                     <br>
                      <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success" id="filter_report"><?php echo display("filter"); ?></button>
                            <button type="submit" class="btn btn-primary" id="filter_and_save"><?php echo display("filter_and_save"); ?></button>
                            <input type=button class="btn btn-warning" onClick="location.href='<?php echo base_url('report/case_mgmt'); ?>'" value='Reset'>                            
                        </div>
                      </div>
                      <br>                      
                    </form>
                        <div class="form-group col-md-12 table-responsive" id="showResult">
                           <table id="example"  class=" table table-striped table-bordered" style="width:100%">
                              <thead>
                              <tr>                                         
                                  <?php
                                  if (!empty($post_report_columns)) {
                                    foreach ($post_report_columns as $value) { ?>
                                      <th><?=ucfirst($value)?></th>
                                    <?php
                                    }
                                  } 
                                ?>
                              </tr>
                              </thead>
                               <tbody>                                       
                              </tbody>
                          </table>
                      </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    
<!---------------------------->
<script type="text/javascript">
 $("#filter_and_save_form").on('submit',function(e){
  //alert($("input[name='hier_wise']").is(":checked"));
    if ($("input[name='hier_wise']").is(":checked") && $("#employee").select2('data').length!=1) {
      alert("please select one employee for hierarchy wise report");
      e.preventDefault();
    }
 });

  $(document).ready(function(){   
    $("#selected-col").select2();
    $(".chosen-select").select2();
  });

  
  $(document).ready(function(){   
    var d = new Date($.now());
    var report_name = 'Report_'+d.getDate()+"-"+(d.getMonth() + 1)+"-"+d.getFullYear()+" "+d.getHours()+"_"+d.getMinutes()+"_"+d.getSeconds();
    $('#example').DataTable({         
      "processing": true,
      "scrollX": true,      
      "serverSide": true,          
      "lengthMenu": [ [10,30, 50,100,500,1000, -1], [10,30, 50,100,500,1000, "All"] ],
      "ajax": {
          "url": "<?=base_url().'report/all_report_filterdata/2'?>",
          "type": "POST",
      },    
      "columnDefs": [{ "orderable": false, "targets": 0 }],
          "order": [[ 1, "desc" ]],
      dom: 'lBfrtip',
      buttons: [
        {
          extend: 'copyHtml5',
          title: report_name
        },
        {
          extend: 'csvHtml5',
          title: report_name
        },
        {
          extend: 'excelHtml5',
          title: report_name
        }
      ]
  });




$("#filter_and_save").on("click",function(e){
  e.preventDefault();
  var title = window.prompt("Enter Report Name");  
  if(title){    
    var url = "<?=base_url().'report/create_report/2'?>";
    $.ajax({
      url:url,
      type:'POST',
      data:{
       'filters':$("#filter_and_save_form").serialize(),
       'report_name':title 
      },
      success:function(result){                
        result = JSON.parse(result);
        if(result.status){
          $("#filter_and_save_form").submit();
        }else{
          alert(result.msg);
        }
      }
    });
  }else{
    alert("Report not saved");
  }
});


  });
</script>