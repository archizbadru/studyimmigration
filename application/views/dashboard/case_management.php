<link rel="stylesheet" href="<?php echo base_url()?>assets/css/aqua.css">

<div class="row" style="padding-top:20px;">

<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-purple">
            <span class="info-box-icon"><i class="fa fa-question-circle-o" style="color:#fff;"></i></span>
            <div class="info-box-content1">
              <div class="box box-widget widget-user-2">
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#"><?php echo display("all_enquiry"); ?> <span class="pull-right badge bg-blue"><?php if(!empty($counts['enquiry'])){ echo $counts['enquiry'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("created_today"); ?> <span class="pull-right badge bg-aqua"><?php if(!empty($counts['enq_ct'])){ echo $counts['enq_ct'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("updated_today"); ?> <span class="pull-right badge bg-green"><?php if(!empty($counts['enq_ut'])){ echo $counts['enq_ut'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("active"); ?> <span class="pull-right badge bg-red"><?php if(!empty($counts['enquiry'])){ echo ($counts['enquiry']-$counts['enq_drp']);}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("droped"); ?> <span class="pull-right badge bg-purple"><?php if(!empty($counts['enq_drp'])){ echo $counts['enq_drp'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("unassigned"); ?> <span class="pull-right badge bg-maroon"><?php if(!empty($counts['enq_assign'])){ echo $counts['enq_assign'];}else{ echo '0';}; ?></span></a></li>
              </ul>
            </div>
          </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


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
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-user-circle-o" style="color:#fff;"></i></span>
            <div class="info-box-content1">
              <div class="box box-widget widget-user-2">
            <div class="box-footer no-padding">

              <ul class="nav nav-stacked">
                <li><a href="#"><?php echo display("all_clients"); ?> <span class="pull-right badge bg-blue"><?php if(!empty($counts['client'])){ echo $counts['client'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("created_today"); ?> <span class="pull-right badge bg-aqua"><?php if(!empty($counts['client_ct'])){ echo $counts['client_ct'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("updated_today"); ?> <span class="pull-right badge bg-green"><?php if(!empty($counts['client_ut'])){ echo $counts['client_ut'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("active"); ?> <span class="pull-right badge bg-red"><?php if(!empty($counts['client'])){ echo ($counts['client']-$counts['client_drp']);}else{ echo '0';}; ?></span></a></li>
        <li><a href="#"><?php echo display("droped"); ?> <span class="pull-right badge bg-purple"><?php if(!empty($counts['client_drp'])){ echo $counts['client_drp'];}else{ echo '0';}; ?></span></a></li>
        <li><a href="#"><?php echo display("unassigned"); ?> <span class="pull-right badge bg-maroon"><?php if(!empty($counts['client_assign'])){ echo $counts['client_assign'];}else{ echo '0';}; ?></span></a></li>
              </ul>
            </div>
          </div>
            </div>
          </div>
        </div>

<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-user-circle-o" style="color:#fff;"></i></span>
            <div class="info-box-content1">
              <div class="box box-widget widget-user-2">
            <div class="box-footer no-padding">

              <ul class="nav nav-stacked">
                <li><a href="#"><?php echo 'All Refund'; ?> <span class="pull-right badge bg-blue"><?php if(!empty($refund['allrefund'])){ echo $refund['allrefund'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("created_today"); ?> <span class="pull-right badge bg-maroon"><?php if(!empty($refund['createtoday'])){ echo $refund['createtoday'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo 'Refund Done'; ?> <span class="pull-right badge bg-aqua"><?php if(!empty($refund['done'])){ echo $refund['done'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo 'Refund Pending'; ?> <span class="pull-right badge bg-green"><?php if(!empty($refund['pending'])){ echo $refund['pending'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo 'Not elegible'; ?> <span class="pull-right badge bg-red"><?php if(!empty($refund['notelegible'])){ echo ($refund['notelegible']);}else{ echo '0';}; ?></span></a></li>
              </ul>
            </div>
          </div>
            </div>
          </div>
        </div>

</div>

<div class="row" style="padding-top:20px;">
<div class="panel-body">
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