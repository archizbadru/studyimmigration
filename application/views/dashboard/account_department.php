<link rel="stylesheet" href="<?php echo base_url()?>assets/css/aqua.css">

<div class="row" style="padding-top:20px;">


<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-line-chart" style="color:#fff;"></i></span>
            <div class="info-box-content1">
              <div class="box box-widget widget-user-2">
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#"><?php echo display("all_leads"); ?> <span class="pull-right badge bg-blue"><?php if(!empty($counts['lead'])){ echo $counts['lead'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("created_today"); ?> <span class="pull-right badge bg-aqua"><?php if(!empty($counts['lead_ct'])){ echo $counts['lead_ct'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("updated_today"); ?> <span class="pull-right badge bg-green"><?php if(!empty($counts['lead_ut'])){ echo $counts['lead_ut'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("active"); ?> <span class="pull-right badge bg-red"><?php if(!empty($counts['lead'])){ echo ($counts['lead']-$counts['lead_drp']);}else{ echo '0';}; ?></span></a></li>
        <li><a href="#"><?php echo display("droped"); ?> <span class="pull-right badge bg-purple"><?php if(!empty($counts['lead_drp'])){ echo $counts['lead_drp'];}else{ echo '0';}; ?></span></a></li>
        <li><a href="#"><?php echo display("unassigned"); ?> <span class="pull-right badge bg-maroon"><?php if(!empty($counts['lead_assign'])){ echo $counts['lead_assign'];}else{ echo '0';}; ?></span></a></li>
              </ul>
            </div>
          </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-user-circle-o" style="color:#fff;"></i></span>
            <div class="info-box-content1">
              <div class="box box-widget widget-user-2">
            <div class="box-footer no-padding">

              <ul class="nav nav-stacked">
                <li><a href="#"><?php echo 'All Payment'; ?> <span class="pull-right badge bg-blue"><?php if(!empty($payment['allpayment'])){ echo $payment['allpayment'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("created_today"); ?> <span class="pull-right badge bg-maroon"><?php if(!empty($payment['createtoday'])){ echo $payment['createtoday'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo 'Payment Done'; ?> <span class="pull-right badge bg-aqua"><?php if(!empty($payment['done'])){ echo $payment['done'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo 'Payment Pending'; ?> <span class="pull-right badge bg-green"><?php if(!empty($payment['pending'])){ echo $payment['pending'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo 'Payment recived'; ?> <span class="pull-right badge bg-red"><?php if(!empty($payment['recived'])){ echo ($payment['recived']);}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo 'Refund Payment'; ?> <span class="pull-right badge bg-maroon"><?php if(!empty($payment['refund'])){ echo $payment['refund'];}else{ echo '0';}; ?></span></a></li>
              </ul>
            </div>
          </div>
            </div>
          </div>
        </div>

</div>

<div class="row" style="padding-top:20px;">
<div class="panel-body">
<!-------------------------Date Filter Start----------------------->
 <div class="row"  style="margin-top: 15px;">
    <form method="POST" action="<?php echo base_url('dashboard/find_payment_detail'); ?>">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="form-row" style="padding: 10px;">
    <div class="col-lg-3">
        <div class="form-group">
          <label>From</label>
          <input  class="form-control" type="date" name="from_date" id="from_date" value="<?php if(!empty($from_date)){echo $from_date;} ?>" style="padding-top: 0px;">        
        </div>
      </div>

      <div class="col-lg-3">
        <div class="form-group">
          <label>To</label>
           <input  class="form-control" type="date" name="to_date" value="<?php if(!empty($to_date)){echo $to_date;} ?>" style="padding-top: 0px;">
        </div>
      </div>
                     <div class=" col-lg-2">
                        <div class="form-group" style="padding:20px;">
                          <button name="submit" type="submit" class="btn btn-primary" >Filter</button>
                        </div>
                     </div>
                </div>
                      
            </div>
            
        </div>
        
    </form>
</div>
<!-------------------------Date Filter End----------------------->

          <table width="100%" id="upcoming" class="datatable1 table table-striped table-bordered table-hover ">
            <thead>
                <tr>
                  <th>Onboarding Id</th>
                  <th>Applicant Name</th>
                  <th>Amount</th>
                  <th>Paid Date</th>
                  <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
           <?php foreach ($upcoming as $upcoming) { 
            if($upcoming->Pay_status=='1'){$status = 'Paid';}else{$status = 'Pending';}
          ?>
                <tr>
                  <td><?php echo $upcoming->enq_id; ?></td>
                  <td><?php echo $upcoming->name.' '.$upcoming->lastname; ?></td>
                  <td><?php echo $upcoming->pay_amt; ?></td>
                  <td><?php echo $upcoming->pay_date; ?></td>
                  <td><?php echo $status; ?></td>
                </tr>
       <?php } ?>
            </tbody>            
          </table>

          <table width="100%" class="datatable1 table table-striped table-bordered table-hover ">
            <thead>
                <tr>
                  <th>Onboarding Id</th>
                  <th>Applicant</th>
                  <th>Total</th>
                  <th>Advance</th>
                  <th>Received</th>
                  <th>Due</th>
                </tr>
            </thead>
            <tbody>
      <?php foreach($allpaid as $paid){ 
          if(!empty($paid->taxabal_amt)){$taxabal_amt = $paid->taxabal_amt;}else{$taxabal_amt = '0';}
          if(!empty($paid->advance)){$advance = $paid->advance;}else{$advance = '0';}
          if(!empty($paid->final)){$final = $paid->final;}else{$final = '0';}
          if(!empty($paid->installment)){$installment = $paid->installment;}else{$installment = '0';}
        ?>
                <tr>
                  <td><?php echo $paid->enq_id; ?></td>
                  <td><?php echo $paid->name.' '.$paid->lastname; ?></td>
                  <td><?php echo $taxabal_amt; ?></td>
                  <td><?php echo $advance; ?></td>
                  <td><?php if(empty($final)){ echo $installment;}else{ echo $final;} ?></td>
                  <td><?php if(empty($final)){ echo $due = ($taxabal_amt - $advance - $installment);}else{ echo $due = ($taxabal_amt - $advance - $final);} ?></td>
                </tr>
      <?php } ?>
            </tbody>            
          </table>

          <table width="100%" class="datatable1 table table-striped table-bordered table-hover ">
            <thead>
                <tr>
                  <th>Onboarding Id</th>
                  <th>Applicant Name</th>
                  <th>Refund Status</th>
                  <th>created Date</th>
                </tr>
            </thead>
            <tbody>
      <?php foreach($allrefund as $rfnd){ ?>
                <tr>
                  <td><?php echo $rfnd->enquiry_id; ?></td>
                  <td><?php echo $rfnd->name.' '.$rfnd->lastname; ?></td>
                  <td><?php if($rfnd->refund_eligiblity=='1'){ echo 'Done';}else if($rfnd->refund_eligiblity=='0'){ echo 'Not elegible';}else{ echo 'Pending';} ?></td>
                  <td><?php echo $rfnd->created_date; ?></td>
                </tr>
      <?php } ?>
            </tbody>            
          </table>

        </div>
      </div>
  </body>
</html>
<!--<script type="text/javascript">
  $("#find_filter_data").click(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var url =  '<?php echo base_url();?>dashboard/find_payment_detail';
      $.ajax({
         type: "POST",
         url: url,
         data: $('#filter').serialize(),    // serializes the form's elements.
         success: function(data)
         {
          $("#upcoming").html(data);
         }
       });
  });
</script>-->