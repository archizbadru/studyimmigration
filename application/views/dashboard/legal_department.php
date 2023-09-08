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
          <div class="info-box bg-purple">
            <span class="info-box-icon"><i class="fa fa-user-circle-o" style="color:#fff;"></i></span>
            <div class="info-box-content1">
              <div class="box box-widget widget-user-2">
            <div class="box-footer no-padding">

              <ul class="nav nav-stacked">
                <li><a href="#"><?php echo 'All Aggrement'; ?> <span class="pull-right badge bg-blue"><?php if(!empty($aggrement['allaggrement'])){ echo $aggrement['allaggrement'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("created_today"); ?> <span class="pull-right badge bg-maroon"><?php if(!empty($aggrement['createtoday'])){ echo $aggrement['createtoday'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo 'Aggrement Done'; ?> <span class="pull-right badge bg-aqua"><?php if(!empty($aggrement['done'])){ echo $aggrement['done'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo 'Aggrement Pending'; ?> <span class="pull-right badge bg-green"><?php if(!empty($aggrement['pending'])){ echo $aggrement['pending'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo 'Signed upload'; ?> <span class="pull-right badge bg-red"><?php if(!empty($aggrement['signed'])){ echo ($aggrement['signed']);}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo 'Signed pending'; ?> <span class="pull-right badge bg-purple"><?php if(!empty($aggrement['nosigned'])){ echo $aggrement['nosigned'];}else{ echo '0';}; ?></span></a></li>
              </ul>
            </div>
          </div>
            </div>
          </div>
        </div>


<div class="panel-body">
          <table width="100%" class="datatable1 table table-striped table-bordered table-hover ">
            <thead>
                <tr>
                  <th>Onboarding Id</th>
                  <th>Applicant Name</th>
                  <th>Aggrement Name</th>
                  <th>Aggrement Status</th>
                  <th>Signed File Upload</th>
                  <th>created Date</th>
                </tr>
            </thead>
            <tbody>
      <?php foreach($allaggrement as $agrmnt){ ?>
                <tr>
                  <td><?php echo $agrmnt->enq_id; ?></td>
                  <td><?php echo $agrmnt->applicant_name; ?></td>
                  <td><?php echo $agrmnt->template_name; ?></td>
                  <td><?php if($agrmnt->approve_status=='0'){ echo 'Pending';}else{ echo 'Approved';} ?></td>
                  <td><?php if($agrmnt->signed_file=='0'){ echo 'No';}else{ echo 'Yes';} ?></td>
                  <td><?php echo $agrmnt->created_date; ?></td>
                </tr>
      <?php } ?>
            </tbody>            
          </table>
        </div>

      </div>
  </body>
</html>