<!-- <link rel="stylesheet" href="<?php echo base_url()?>custom_dashboard/assets/css/dashforge.css"> -->
<link rel="stylesheet" href="<?php echo base_url()?>custom_dashboard/assets/css/dashforge.dashboard.css">
<link href="<?php echo base_url()?>custom_dashboard/lib/morris.js/morris.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/aqua.css">
<link href="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/fullcalendar.min.css" rel="stylesheet">
<link href="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/dashforge.calendar.css" rel="stylesheet">
 


 <style>        
        .wd-10{            
            width:58px !important;
        }        
        .rounded-circle {
            border-radius: 0px !important; 
        }        
        #chartdiv {
          width: 100%;
          height: 500px;
        }      
  </style> 
  <style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style> 
  </head>
  <body class="page-profile" style="background-color:#fff;" >
  
  <?php if($this->session->userdata('user_right')==151) { ?>
<?php //include('student/course_wrapper.php'); ?>
 <?php }else{ ?> 
  
  <div class="col-md-6" >  
         <div style="float:right">         
            <?php
            if(user_access(230) || user_access(231) || user_access(232) || user_access(233) || user_access(234) || user_access(235) || user_access(236)){                          
            ?>
            <div class="btn-group dropdown-filter">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter by Process<span class="caret"></span>
              </button>
              <ul class="filter-dropdown-menu dropdown-menu">                
                <?php

                if(!empty($products)){
          if(user_access(270)){
                  foreach ($products as $product) { ?>                                                             
                    <li>
                      <label>
                        <input type="checkbox" name='product_filter[]' value="<?=$product->sb_id ?>" <?php if (in_array($product->sb_id, $this->session->process)) { echo "checked";                         
                        }?>>   <?=$product->product_name ?>
                      </label>
                    </li>                
                    <?php                             
                  }
                }else{
        foreach ($products as $product) { ?>                                                             
                    <li>
                      <label>
                        <input type="radio" name='product_filter[]' value="<?=$product->sb_id ?>" <?php if (in_array($product->sb_id, $this->session->process)) { echo "checked";                         
                        }?>>   <?=$product->product_name ?>
                      </label>
                    </li>                
                    <?php                             
                  } 
        }
        }
                ?>
              </ul>
            </div>
          
            <?php
            }
            ?>
          
          </div>
        </div>
  
</br></br></br>
     <div class="content">
        <?php 
      
     $user_id   = $this->session->user_id;
     $user_role = $this->session->user_role;
     $region_id = $this->session->region_id;
     $assign_country = $this->session->country_id;
     $assign_region = $this->session->region_id;
     $assign_territory = $this->session->territory_id;
     $assign_state = $this->session->state_id;
     $assign_city = $this->session->city_id;
     
     ?>
 </br>

  
        <div id="content_tabs"></div>
        <div id="content_tabs1">


 <!-----------------------------------------------------------------------------html widget----------------------------------------->
<div class="row row-xs">
  <?php if($msg!='') { ?>
  <div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?=$msg;?></strong> 
</div>
<?php } ?>
</div>

 <div class="row">


<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-question-circle-o" style="color:#fff;"></i></span>
            <div class="info-box-content1">
              <div class="box box-widget widget-user-2">
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                
                <li><a href="#"><?php echo display("all_enquiry"); ?> <span class="pull-right badge bg-yellow"><?php if(!empty($counts['enquiry'])){ echo $counts['enquiry'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("created_today"); ?> <span class="pull-right badge bg-yellow"><?php if(!empty($counts['enq_ct'])){ echo $counts['enq_ct'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("updated_today"); ?> <span class="pull-right badge bg-yellow"><?php if(!empty($counts['enq_ut'])){ echo $counts['enq_ut'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("active"); ?> <span class="pull-right badge bg-yellow"><?php if(!empty($counts['enquiry'])){ echo ($counts['enquiry']-$counts['enq_drp']);}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("droped"); ?> <span class="pull-right badge bg-yellow"><?php if(!empty($counts['enq_drp'])){ echo $counts['enq_drp'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("unassigned"); ?> <span class="pull-right badge bg-yellow"><?php if(!empty($counts['enq_assign'])){ echo $counts['enq_assign'];}else{ echo '0';}; ?></span></a></li>
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
                <li><a href="#"><?php echo display("all_leads"); ?> <span class="pull-right badge bg-green"><?php if(!empty($counts['lead'])){ echo $counts['lead'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("created_today"); ?> <span class="pull-right badge bg-green"><?php if(!empty($counts['lead_ct'])){ echo $counts['lead_ct'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("updated_today"); ?> <span class="pull-right badge bg-green"><?php if(!empty($counts['lead_ut'])){ echo $counts['lead_ut'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("active"); ?> <span class="pull-right badge bg-green"><?php if(!empty($counts['lead'])){ echo ($counts['lead']-$counts['lead_drp']);}else{ echo '0';}; ?></span></a></li>
        <li><a href="#"><?php echo display("droped"); ?> <span class="pull-right badge bg-green"><?php if(!empty($counts['lead_drp'])){ echo $counts['lead_drp'];}else{ echo '0';}; ?></span></a></li>
        <li><a href="#"><?php echo display("unassigned"); ?> <span class="pull-right badge bg-green"><?php if(!empty($counts['lead_assign'])){ echo $counts['lead_assign'];}else{ echo '0';}; ?></span></a></li>
              </ul>
            </div>
          </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-teal">
            <span class="info-box-icon"><i class="fa fa-user-circle-o" style="color:#fff;"></i></span>
            <div class="info-box-content1">
              <div class="box box-widget widget-user-2">
            <div class="box-footer no-padding">

              <ul class="nav nav-stacked">
                <li><a href="#"><?php echo display("all_clients"); ?> <span class="pull-right badge bg-teal"><?php if(!empty($counts['client'])){ echo $counts['client'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("created_today"); ?> <span class="pull-right badge bg-teal"><?php if(!empty($counts['client_ct'])){ echo $counts['client_ct'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("updated_today"); ?> <span class="pull-right badge bg-teal"><?php if(!empty($counts['client_ut'])){ echo $counts['client_ut'];}else{ echo '0';}; ?></span></a></li>
                <li><a href="#"><?php echo display("active"); ?> <span class="pull-right badge bg-teal"><?php if(!empty($counts['client'])){ echo ($counts['client']-$counts['client_drp']);}else{ echo '0';}; ?></span></a></li>
        <li><a href="#"><?php echo display("droped"); ?> <span class="pull-right badge bg-teal"><?php if(!empty($counts['client_drp'])){ echo $counts['client_drp'];}else{ echo '0';}; ?></span></a></li>
        <li><a href="#"><?php echo display("unassigned"); ?> <span class="pull-right badge bg-teal"><?php if(!empty($counts['client_assign'])){ echo $counts['client_assign'];}else{ echo '0';}; ?></span></a></li>
              </ul>
            </div>
          </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>












      </div>
    
<!-----------------------------------html widget End------------------------------------------>

<!-----------------------------------html FUNNEL START---------------------------------------->
     
        <div class="row row-xs">
          <div class="col-lg-12 col-xl-12 mg-t-10">
            <hr style="border: 1px solid #3a95e4 !important">
          </div>
           <div class="col-lg-8 col-xl-8 mg-t-10">
             <div class="card">
<style>
#chartdiv {
  width: 100%;
  height: 510px;
}

</style>
<div id="chartdiv"></div>
             </div>
           </div>


            <div class="col-lg-4 col-xl-4 mg-t-10">
            <div class="card" style="height:95%;">
              <div class="card-header pd-y-20 d-md-flex align-items-center">
                <text x="347" text-anchor="middle" class="highcharts-title" data-z-index="4" style="color:#333333;font-size:18px;fill:#333333;font-weight:900;" y="24" aria-hidden="true"><?php echo display("dashclock"); ?></text>
              </div>
<style>
#chartdiv3 {
  width: 100%;
  height: 458px;
}

</style>
<div id="chartdiv3"></div>
              </div> 
            </div>


           <div class="col-lg-12 col-xl-12 mg-t-10">
            <hr style="border: 1px solid #3a95e4 !important">
           </div>
           <div class="col-lg-8 col-xl-7 mg-t-10">
            <div class="card" style="height:100% !important;">
              <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                <text x="347" text-anchor="middle" class="highcharts-title" data-z-index="4" style="color:#333333;font-size:18px;fill:#333333;font-weight:900;" y="24" aria-hidden="true"><?php echo display("enquiries"); ?></text>
              </div><!-- card-header -->
              <canvas id="bar-chart-grouped" width="800" height="450"></canvas>
            </div><!-- card -->
          </div>          
          <div class="col-lg-4 col-xl-5 mg-t-10">
            <div class="card" style="height:100%;">
              <div class="card-header pd-y-20 d-md-flex align-items-center">
                <text x="347" text-anchor="middle" class="highcharts-title" data-z-index="4" style="color:#333333;font-size:18px;fill:#333333;font-weight:900;" y="24" aria-hidden="true"><?php echo display("conversion_probability"); ?></text>
              </div>
                  
              <style>
#chartdiv2 {
  width: 100%;
  height: 400px;
}

</style>
<div id="chartdiv2"></div>
                
              </div> 
            
              
            </div>

 <!------------------------------------Process wise charts------------------------------------------>
<div class="col-lg-12 col-xl-12 mg-t-10">
            <hr style="border: 1px solid #3a95e4 !important">
           </div>

<div class="col-lg-6 col-xl-6 mg-t-10">
            <div class="card" style="height:100%;">
<figure class="highcharts-figure">
  <div id="containersss"></div>
</figure>

</div> 
            
              
            </div>

<div class="col-lg-6 col-xl-6 mg-t-10">
            <div class="card" style="height:100%;">
                  
<figure class="highcharts-figure">
  <div id="container2"></div>
</figure>
                
              </div> 
            
              
            </div>
<!----------------------------Process wise charts End------------------------------------------->      
 <!----------------------------html FUNNEL START END-------------------------------------------->         
          <div class="col-lg-12 col-xl-12 mg-t-10">
            <hr style="border: 1px solid red !important">
          </div>
      
<!-----------------------------HTML Map/Calender START---------------------------------------->
<div class="col-lg-12 col-xl-12 mg-t-10">
            <div class="card" style="height:95%;">
           
<style>
      #calendar {
        height: 500px;
      }
      .highcharts-title {
        color: black;
      }
      .fc-center h2{
        color:#333333;
        font-size:18px !important;
        fill:#333333;
        font-family: 'Montserrat' !important;
        font-weight:900;            
    }
                        </style>        
<div id="calendar" class=""></div>

              </div> 
            </div> 
      
            <div class="col-lg-6 col-xl-6 mg-t-10">
            <div class="card" style="height:95%;">
            
<style>
#container12 {
    height: 500px; 
    margin: 0 auto; 
}
.loading {
    margin-top: 10em;
    text-align: center;
    color: gray;
}

</style>
<div id="container12" style="display: none;"></div>

              </div> 
            </div>      
 <!---------------------------------html map/Calender END--------------------------------------------> 
          <div class="col-lg-12 col-xl-12 mg-t-10">
            <hr style="border: 1px solid red !important">
          </div>
      
<!-----------------------------Disposition/Source START-------------------------------------------->
<div class="col-lg-6 col-xl-6 mg-t-10">
  <style>
    .highcharts-title{
      font-weight:900 !important;
      font-family: 'Montserrat' !important;     
    }
  </style>
            <div class="card" style="height:95%;">
<figure class="highcharts-figure">
  <div id="container"></div>
</figure>

              </div> 
            </div> 
      
            <div class="col-lg-6 col-xl-6 mg-t-10">
            <div class="card" style="height:95%;">
<figure class="highcharts-figure">
  <div id="container1"></div>
</figure>

              </div> 
            </div>      
 <!-----------------------------------Disposition/Source END--------------------------------------->
<!--------------------------------html map/Calender END--------------------------------------------> 
          <div class="col-lg-12 col-xl-12 mg-t-10">
            <hr style="border: 1px solid red !important">
          </div>
      
<!----------------------------------------Timeline START-------------------------------------------->
<!-- <?php
$eldate=array();$lcdate=array();$cdate=array();$all=array();
foreach($all_enquiery as $timeline){
  foreach($cmtdata as $cmt){
    if($timeline->Enquery_id==$cmt->lead_id){
    if($cmt->comment_msg==display('enquery_create')){
      $enqdate = $cmt->created_date;
    }else if($cmt->comment_msg==display('move_to_lead')){
      $leaddate = $cmt->created_date;
    }else if($cmt->comment_msg==display('move_to_client')){
      $clientdate = $cmt->created_date;
    }
    
  if(!empty($leaddate)){
      $leaddate=$leaddate;  
      }else{
        $leaddate='';
      }
  if(!empty($enqdate)){
      $enqdate=$enqdate;  
      }else{
        $enqdate='';
      }
  if(!empty($clientdate)){
      $clientdate=$clientdate;  
      }else{
        $clientdate='';
      }
 
$start_date = strtotime($enqdate); 
$end_date = strtotime($leaddate); 
 
$days=($end_date - $start_date)/60/60/24; 

$start_date1 = strtotime($leaddate); 
$end_date1 = strtotime($clientdate); 
  
$days1=($end_date1 - $start_date1)/60/60/24;

}
  }
  if(!empty($days)){
    $days=$days;
  }else{
    $days=0;
  }
  if(!empty($days1)){
    $days1=$days1;
  }else{
    $days1=0;
  }
$eldate[]= $days;
$lcdate[]= $days1;
$all[]=$timeline->Enquery_id;
}
$d=array_sum($eldate);
$d1=array_sum($lcdate);
$dd = max(0, $d);
$dd1 = max(0, $d1);
$alle=count($all);
if($alle=='0'){
  $alle=1;  
}
if($dd=='0'){
  $dd=1;  
}
if($dd1=='0'){
  $dd1=1;  
}
$avg1=$dd/$alle;
$avg2=$dd1/$alle;

//print_r($eldate);exit;
?> -->
<div class="col-lg-12 col-xl-12 mg-t-10">
            <div class="card" style="height:95%;">

<div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
          <div class="page-header">
            <center><text x="347" text-anchor="middle" class="highcharts-title" data-z-index="4" style="color:#333333;font-size:18px;fill:#333333;font-weight:900;" y="24" aria-hidden="true"><?php echo display('average_follow_up_rate'); ?></text></center>
          </div>
          <div style="display:inline-block;width:100%;">
          <ul class="timeline timeline-horizontal">
            <li class="timeline-item">
              <div class="timeline-badge bg-yellow" style="width:150px !important;border-radius: 30px;">
                  <?php echo display("enquiry"); ?>
              </div>
            </li>
            <li class="timeline-item" style="left:40px !important;">
              <div class="timeline-badge success"><i class="glyphicon glyphicon-check"></i></div>
              <div class="timeline-panel" style="width:100px !important;border-radius: 30px;">
                <div class="timeline-heading">
                  <!--<h4 class="timeline-title">Average</h4>-->
                  <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>&nbsp;<?php echo round($avg1).' '.'Days'; ?></small></p>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <div class="timeline-badge bg-green" style="width:150px !important;border-radius: 30px;">
                 <?php echo display("lead"); ?>
              </div>
              
            </li>
            <li class="timeline-item" style="left:40px !important;">
              <div class="timeline-badge info"><i class="glyphicon glyphicon-check"></i></div>
              <div class="timeline-panel" style="width:100px !important;border-radius: 30px;">
                <div class="timeline-heading">
                  <!--<h4 class="timeline-title">Average</h4>-->
                  <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> &nbsp;<?php echo round($avg2).' '.'Days'; ?></small></p>
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <div class="timeline-badge bg-teal" style="width:150px !important;border-radius: 30px;">
                  <?php echo display("Client"); ?>
              </div>
            </li>
          </ul>
        </div>
        </div>
      </div>
    </div>

              </div> 
            </div>      
 <!--------------------------------------Timeline END-------------------------------------------->  
         <div class="col-lg-12 col-xl-12 mg-t-10">
            <hr style="border: 1px solid #3a95e4 !important">
           </div>
<!---------------------------------------Grapth JS --------------------------------------------->

            
          
<!--------------------------Graph JS End----------------------------------------------->

      </div><!-- container -->

    <script src="<?php echo base_url()?>custom_dashboard/lib/jquery.flot/jquery.flot.js"></script>
    <script src="<?php echo base_url()?>custom_dashboard/lib/jquery.flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url()?>custom_dashboard/lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url()?>custom_dashboard/lib/chart.js/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url()?>custom_dashboard/lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url()?>custom_dashboard/lib/jqvmap/maps/jquery.vmap.usa.js"></script>
    
    <script src="<?php echo base_url()?>custom_dashboard/assets/js/dashforge.sampledata.js"></script>
    <script src="<?php echo base_url()?>assets/js/custom-chart.js"></script>
    <script src="<?php echo base_url()?>custom_dashboard/lib/morris.js/morris.min.js"></script>
    <!----- custom link ---------------->
    <!--<script type="text/javascript" src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/ammap.js"></script>-->
    <script src="<?php echo base_url()?>custom_dashboard/assets/js/india-js-map.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/indiaLow.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/jquery.canvasjs.min.js"></script>
     <script src="<?php echo base_url()?>custom_dashboard/lib/raphael/raphael.min.js"></script>
    <!--<script src="<?php echo base_url()?>custom_dashboard/assets/js/chart.morris.js"></script>-->
    
    <script src="<?php echo base_url()?>custom_dashboard/lib/peity/jquery.peity.min.js"></script>
    
     <script src="<?php echo base_url()?>custom_dashboard/assets/js/chart.chartjs.js"></script>
     
     <script type="text/javascript" src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/loader.js"></script>
     
     <!--------------amcharts funnel-------------------------------------------------------->
<script src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/core.js"></script>
<script src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/charts.js"></script>
<script src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/animated.js"></script>
<script src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/maps.js"></script>
<script src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/worldLow.js"></script>
<script src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/countries2.js"></script>
<script src="https://www.amcharts.com/lib/4/plugins/timeline.js"></script>
     <!--------------End here -------------------------------------------------------------->
   
   <!------------------------------high chart---------------------------------------------->
   <script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/in/in-all.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-------------------------------------------high chart end---------------------------------->

 <?php if(user_access('60')==true||user_access('70')==true||user_access('80')==true){?>
        <script>
        function sales_dash()
        {    
            $("#content_tabs").html('');
            $("#content_tabs1").css('display', 'block');
        }
       </script>
<?php }else if(user_access('100')==true ||user_access('101')==true||user_access('102')==true||user_access('103')==true||user_access('104')==true||user_access('105')==true||user_access('106')==true||user_access('110')==true||user_access('111')==true||user_access('112')==true||user_access('113')==true||user_access('114')==true||user_access('115')==true||user_access('116')==true){?>
                     
    ?>
    <script type='text/javascript'>
    $(window).load(function(){
      $("#content_tabs").load('<?php echo base_url()?>dashboard/sales_dashboard'); 
       $("#content_tabs1").css('display', 'none');
    });  
   </script>
                     <?php  }?>
   <script>
       function changeMenu(menu,submenu,options)
        {    
            $("#content_tabs").load('<?php echo base_url()?>/'+menu+'/'+submenu);
            $("#content_tabs1").css('display', 'none');
            
       }
       function show_funnel1(){
      $("#show_funnel").css('display', 'none'); 
            $("#show_funnel1").css('display', 'block');  
       }
       function show_funnel(){
      $("#show_funnel1").css('display', 'none'); 
            $("#show_funnel").css('display', 'block');  
       }
       
      //Get drop down value..
      function getEventTarget(e) {
            e = e || window.event;
            return e.target || e.srcElement; 
        }
        
        var ul = document.getElementById('droupdown-value');
            ul.onclick = function(event) {
        var target = getEventTarget(event);
            document.getElementById("selectedcountry").innerHTML = target.innerText;
        };
        
        var My_ul = document.getElementById('selecteddashboard');        
        My_ul.onclick = function(event){
            
            var mytarget = getEventTarget(event);
            document.getElementById("selectdashboard").innerHTML = mytarget.innerText;
        }
      
    </script>
    <script>
        
        $(function(){            
            //Getting enquiry data..
            $.ajax({                
                url : '<?php echo base_url()?>Report/enquiry_statitics_report',
                type: 'POST',
                success:function(data){                    
                    var obj = JSON.parse(data);                  
                    var html = '';                    
                    for(var i=0; i < (obj.length); i++){                        
                        html +='<tr>';                        
                            html +='<td class="tx-medium">'+obj[i].state+'</td>';
                            html +='<td class="text-right">'+obj[i].city+'</td>';
                            html +='<td class="text-right">'+obj[i].total+'</td>';                            
                        html +='</tr>';                        
                    }                    
                    //show data in table
                    $('#table-data').html(html);
                }                
            });            
            //Getting Lead data
            $.ajax({                
                url : '<?php echo base_url(); ?>/Report/lead_statitics_report',
                type: 'POST',
                success:function(data){                    
                    var obj = JSON.parse(data);                    
                    var html='';                    
                    $(".cold").html(obj['coldid'].coldid); //Cold total                    
                    $(".warm").html(obj['warmid'].warmid);
                    //Warm total
                    console.log(obj['hotid'].hotid);
                    $(".hot").html(obj['hotid'].hotid);
                    $(".total_revnue_lead").html(obj['total_revnue_lead'].total_revnue_lead);
                    $(".total_lead").html(obj['total_lead'].total_lead);                     
                    $(".cold-total").html(obj['cold'].cold);
                    $(".hot-total").html(obj['hot'].hot);
                    $(".warm-total").html(obj['warm'].warm);          
                    $("#circuit_sheet").html(obj['circuit_sheet'].circuit_sheet); // total circuit_sheet            
                    $("#boq").html(obj['circuit_sheet'].boq);  // total boq.                    
                    $("#po").html(obj['po'].po);                    
                    $(".total-qnq").html(obj['enquiry'][0].total); //Total enquiry..
                    $(".enq-total").html(obj['enquiry'][0].total_value).css('font-weight','bold');
                    //Enquiry total value...
                    $(".enq-active").html(obj['enquiry'][0].active) // Active enquiry..                    
                    $(".total-dead").html(obj['enquiry'][0].dead);
                    $(".total-active").html(obj['active'].total);                    
                    if(obj['dead'].total==null){                        
                       var dead = 0;                        
                    }else{                        
                         var dead = obj['dead'].total;
                     }
                    
                    $(".qne-deadd").html(dead);                    
                    for(var i =0; i < (obj['stage'].length); i++){                        
                        html +='<p>'+(obj['stage'][i].lead_stage_name)+'</p>';
                    }                    
                    $("#stage").html(html);                    
                }                
            });
        });        
    </script>
<!------------------------------------------------------------------knob js Start---------------------------------------------->
<script>
  $(function () {
    /* jQueryKnob */

    $(".knob").knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a = this.angle(this.cv)  // Angle
              , sa = this.startAngle          // Previous start angle
              , sat = this.startAngle         // Start angle
              , ea                            // Previous end angle
              , eat = sat + a                 // End angle
              , r = true;

          this.g.lineWidth = this.lineWidth;

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3);

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value);
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3);
            this.g.beginPath();
            this.g.strokeStyle = this.previousColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
            this.g.stroke();
          }

          this.g.beginPath();
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
          this.g.stroke();

          this.g.lineWidth = 2;
          this.g.beginPath();
          this.g.strokeStyle = this.o.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
          this.g.stroke();

          return false;
        }
      }
    });
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    $(".sparkline").each(function () {
      var $this = $(this);
      $this.sparkline('html', $this.data());
    });

    /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
    drawDocSparklines();
    drawMouseSpeedDemo();

  });
  function drawDocSparklines() {

    // Bar + line composite charts
    $('#compositebar').sparkline('html', {type: 'bar', barColor: '#aaf'});
    $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {composite: true, fillColor: false, lineColor: 'red'});


    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline();

    // Larger line charts for the docs
    $('.largeline').sparkline('html',
        {type: 'line', height: '2.5em', width: '4em'});

    // Customized line chart
    $('#linecustom').sparkline('html',
        {
          height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
          minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3
        });

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', {type: 'bar'});

    $('.barformat').sparkline([1, 3, 5, 3, 8], {
      type: 'bar',
      tooltipFormat: '{{value:levels}} - {{value}}',
      tooltipValueLookups: {
        levels: $.range_map({':2': 'Low', '3:6': 'Medium', '7:': 'High'})
      }
    });

    // Tri-state charts using inline values
    $('.sparktristate').sparkline('html', {type: 'tristate'});
    $('.sparktristatecols').sparkline('html',
        {type: 'tristate', colorMap: {'-2': '#fa7', '2': '#44f'}});

    // Composite line charts, the second using values supplied via javascript
    $('#compositeline').sparkline('html', {fillColor: false, changeRangeMin: 0, chartRangeMax: 10});
    $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10});

    // Line charts with normal range marker
    $('#normalline').sparkline('html',
        {fillColor: false, normalRangeMin: -1, normalRangeMax: 8});
    $('#normalExample').sparkline('html',
        {fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4'});

    // Discrete charts
    $('.discrete1').sparkline('html',
        {type: 'discrete', lineColor: 'blue', xwidth: 18});
    $('#discrete2').sparkline('html',
        {type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4});

    // Bullet charts
    $('.sparkbullet').sparkline('html', {type: 'bullet'});

    // Pie charts
    $('.sparkpie').sparkline('html', {type: 'pie', height: '1.0em'});

    // Box plots
    $('.sparkboxplot').sparkline('html', {type: 'box'});
    $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
        {type: 'box', raw: true, showOutliers: true, target: 6});

    // Box plot with specific field order
    $('.boxfieldorder').sparkline('html', {
      type: 'box',
      tooltipFormatFieldlist: ['med', 'lq', 'uq'],
      tooltipFormatFieldlistKey: 'field'
    });

    // click event demo sparkline
    $('.clickdemo').sparkline();
    $('.clickdemo').bind('sparklineClick', function (ev) {
      var sparkline = ev.sparklines[0],
          region = sparkline.getCurrentRegionFields();
      value = region.y;
      alert("Clicked on x=" + region.x + " y=" + region.y);
    });

    // mouseover event demo sparkline
    $('.mouseoverdemo').sparkline();
    $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
      var sparkline = ev.sparklines[0],
          region = sparkline.getCurrentRegionFields();
      value = region.y;
      $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
    }).bind('mouseleave', function () {
      $('.mouseoverregion').text('');
    });
  }

  /**
   ** Draw the little mouse speed animated graph
   ** This just attaches a handler to the mousemove event to see
   ** (roughly) how far the mouse has moved
   ** and then updates the display a couple of times a second via
   ** setTimeout()
   **/
  function drawMouseSpeedDemo() {
    var mrefreshinterval = 500; // update display every 500ms
    var lastmousex = -1;
    var lastmousey = -1;
    var lastmousetime;
    var mousetravel = 0;
    var mpoints = [];
    var mpoints_max = 30;
    $('html').mousemove(function (e) {
      var mousex = e.pageX;
      var mousey = e.pageY;
      if (lastmousex > -1) {
        mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
      }
      lastmousex = mousex;
      lastmousey = mousey;
    });
    var mdraw = function () {
      var md = new Date();
      var timenow = md.getTime();
      if (lastmousetime && lastmousetime != timenow) {
        var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
        mpoints.push(pps);
        if (mpoints.length > mpoints_max)
          mpoints.splice(0, 1);
        mousetravel = 0;
        $('#mousespeed').sparkline(mpoints, {width: mpoints.length * 2, tooltipSuffix: ' pixels per second'});
      }
      lastmousetime = timenow;
      setTimeout(mdraw, mrefreshinterval);
    };
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
  }
</script>
<!------------------------------------------------------------------knob js End---------------------------------------------->
<!-----------------------------chart js-------------------->

<!-- funnel chart Chart code start -->
<script>
$(document).ready(function(){
  $.ajax({
    url : "<?=base_url('Dashboard/enquiryLeadClientChart')?>",
    type: "post",
    dataType : "json",
    processData: false,
    contentType: false,
    success : function(data)
    { 
      if(data.status == 'success')
      {
        am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        var chart = am4core.create("chartdiv", am4charts.SlicedChart);
        chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

        chart.data = [{
            "name": "<?php echo display("enquiry"); ?>",
            "value": parseInt(data.data.enquiry),
        }, {
            "name": "<?php echo display("lead"); ?>",
            "value": parseInt(data.data.lead),
        }, {
            "name": "<?php echo display("Client"); ?>",
            "value": parseInt(data.data.client),
        }];

        var series = chart.series.push(new am4charts.FunnelSeries());
        series.colors.step = 2;
        series.dataFields.value = "value";
        series.dataFields.category = "name";
        series.alignLabels = true;

        series.labelsContainer.paddingLeft = 15;
        series.labelsContainer.width = 200;

        //series.orientation = "horizontal";
        //series.bottomRatio = 1;

        chart.legend = new am4charts.Legend();
        chart.legend.position = "left";
        chart.legend.valign = "bottom";
        chart.legend.margin(5,5,20,5);

        });
      }
    }
  });
})
 // end am4core.ready()
</script>
<!-- monthwise chart starts -->
<script>
  $(document).ready(function(){
    $.ajax({
      url : "<?=base_url('Dashboard/monthWiseChart')?>",
      type: "post",
      dataType : "json",
      processData: false,
      contentType: false,
      success : function(data)
      { 
        if(data.status == 'success')
        {
          new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: {
              labels: ["JUN", "FEB", "MAR", "APR","MAY","JUNE","JULY","AUG","SEP","OCT","NOV","DEC"],
              datasets: [
                  {
                  label: "<?php echo display('enquiry') ?>",
                  backgroundColor: "#f39c12",
                  data: [ parseInt(data.data.ejan), parseInt(data.data.efeb), parseInt(data.data.emar), parseInt(data.data.eapr), parseInt(data.data.emay), parseInt(data.data.ejun), parseInt(data.data.ejuly), parseInt(data.data.eaug), parseInt(data.data.esep), parseInt(data.data.eoct), parseInt(data.data.enov), parseInt(data.data.edec)]
                }, {
                  label: "<?php echo display('lead') ?>",
                  backgroundColor: "#37a000",
                  data: [ parseInt(data.data.ljan), parseInt(data.data.lfeb), parseInt(data.data.lmar), parseInt(data.data.lapr), parseInt(data.data.lmay), parseInt(data.data.ljun), parseInt(data.datajuly), parseInt(data.data.laug), parseInt(data.data.lsep), parseInt(data.data.loct), parseInt(data.data.lnov), parseInt(data.data.ldec)]
                }, {
                  label: "<?php echo display('Client') ?>",
                  backgroundColor: "#008080",
                  data: [ parseInt(data.data.cjan), parseInt(data.data.cfeb), parseInt(data.data.cmar), parseInt(data.data.capr), parseInt(data.data.cmay), parseInt(data.data.cjun), parseInt(data.data.cjuly), parseInt(data.data.caug), parseInt(data.data.csep), parseInt(data.data.coct), parseInt(data.data.cnov), parseInt(data.data.cdec)]
                }
              ]
            },
            options: {
              title: {
                display: true,
                //text: 'Vertical Bar Graph'
              }
            }
          });
        }
      }
    })
  })


</script>

<!-- monthwise chart ends -->

<!-- drop wise chart start here -->
<script>
  $(document).ready(function(){
  $.ajax({
    url : "<?=base_url('Dashboard/dropDataChart')?>",
    type: "post",
    dataType : "json",
    processData: false,
    contentType: false,
    success : function(data)
    { 
      var data1 = [];
      var data2 = [];
      var data3 = [];
      var data4 = [];
      
      if(data.status == 'success')
      {
        //response = JSON.parse(data);
        console.log(data.enquiryChartData[0]);
        for(var i = 0;i < data.enquiryChartData.length; i++)
        {
          data1.push(parseInt(data.enquiryChartData[i])); 
          data2.push(parseInt(data.leadChartData[i]));
          data3.push(parseInt(data.clientChartData[i]));
          data4.push(data.droplst[i]['drop_reason']);
        }
        Highcharts.chart('container2', {
        chart: {
          type: 'column'
        },
        title: {
          text: '<?php echo display("dropdata"); ?>'
        },
        xAxis: {
          categories: data4,
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Total drop data'
          },
          stackLabels: {
            enabled: true,
            style: {
              fontWeight: 'bold',
              color: ( // theme
                Highcharts.defaultOptions.title.style &&
                Highcharts.defaultOptions.title.style.color
              ) || 'gray'
            }
          }
        },
        legend: {
          align: 'right',
          x: -30,
          verticalAlign: 'top',
          y: 25,
          floating: true,
          backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || 'white',
          borderColor: '#CCC',
          borderWidth: 1,
          shadow: false
        },
        tooltip: {
          headerFormat: '<b>{point.x}</b><br/>',
          pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
          column: {
            stacking: 'normal',
            dataLabels: {
              enabled: true
            }
          }
        },
        series: [{
          name: '<?php echo display("enquiry"); ?>',
          data: data1,
        }, {
          name: '<?php echo display("lead"); ?>',
          data: data2,
        }, {
          name: '<?php echo display("Client"); ?>',
          data: data3,
        }]
      });
      }
    }
  })
});

</script>

<!-- drop wise chart ends here -->


<!-- conversion probability chart starts-->
<script>
  $(document).ready(function(){
    $.ajax({
      url : "<?=base_url('Dashboard/conversionProbabilityChart')?>",
      type: "post",
      dataType : "json",
      processData: false,
      contentType: false,
      success : function(data)
      { 

        Highcharts.chart('chartdiv2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'pie chart'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: '<?php echo display("hot"); ?>',
            y: parseInt(data.data.hot),
            sliced: true,
            selected: true
        }, {
            name: '<?php echo display("warm"); ?>',
            y: parseInt(data.data.warm)
        }, {
            name: '<?php echo display("cold"); ?>',
            y: parseInt(data.data.cold)
        }]
    }]
});
      }
    })
  });
 // end am4core.ready()
</script>
<!-- conversion probability chart ends-->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// create chart
var chart = am4core.create("chartdiv3", am4charts.GaugeChart);
chart.exporting.menu = new am4core.ExportMenu();
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.startAngle = -90;
chart.endAngle = 270;

var axis = chart.xAxes.push(new am4charts.ValueAxis());
axis.min = 0;
axis.max = 12;
axis.strictMinMax = true;

axis.renderer.line.strokeWidth = 8;
axis.renderer.line.strokeOpacity = 1;
axis.renderer.minLabelPosition = 0.05; // hides 0 label
axis.renderer.inside = true;
axis.renderer.labels.template.radius = 35;
axis.renderer.axisFills.template.disabled = true;
axis.renderer.grid.template.disabled = true;
axis.renderer.ticks.template.disabled = false
axis.renderer.ticks.template.length = 12;
axis.renderer.ticks.template.strokeOpacity = 1;

// serves as a clock face fill
var range = axis.axisRanges.create();
range.startValue = 0;
range.endValue = 12;
range.grid.visible = false;
range.tick.visible = false;
range.label.visible = false;

var axisFill = range.axisFill;
axisFill.fillOpacity = 1;
axisFill.disabled = false;
axisFill.fill = new am4core.InterfaceColorSet().getFor("fill");

// hands
var hourHand = chart.hands.push(new am4charts.ClockHand());
hourHand.radius = am4core.percent(60);
hourHand.startWidth = 10;
hourHand.endWidth = 10;
hourHand.rotationDirection = "clockWise";
hourHand.pin.radius = 8;
hourHand.zIndex = 0;
var minutesHand = chart.hands.push(new am4charts.ClockHand());
minutesHand.rotationDirection = "clockWise";
minutesHand.startWidth = 7;
minutesHand.endWidth = 7;
minutesHand.radius = am4core.percent(78);
minutesHand.zIndex = 1;
var secondsHand = chart.hands.push(new am4charts.ClockHand());
secondsHand.fill = am4core.color("#DD0000");
secondsHand.stroke = am4core.color("#DD0000");
secondsHand.radius = am4core.percent(85);
secondsHand.rotationDirection = "clockWise";
secondsHand.zIndex = 2;
secondsHand.startWidth = 1;
updateHands();

setInterval(function() {
  updateHands();
}, 1000);

function updateHands() {
  // get current date
  var date = new Date();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var seconds = date.getSeconds();

  // set hours
  hourHand.showValue(hours + minutes / 60, 0);
  // set minutes
  minutesHand.showValue(12 * (minutes + seconds / 60) / 60, 0);
  // set seconds
  secondsHand.showValue(12 * date.getSeconds() / 60, 300);
}

}); // end am4core.ready()
</script>

<!--------------------------------------------process wise data graph ------------------------------->



<script>
  $(document).ready(function(e){
    $.ajax({
      url : "<?=base_url('Dashboard/processWiseChart')?>",
      type: "post",
      dataType : "json",
      processData: false,
      contentType: false,
      success : function(data)
      {  
        //response = JSON.parse(data);
        
        if(data.status == 'success')
        {
          Highcharts.chart('containersss', {
          chart: {
          type: 'column'
          },
          title: {
            text: 'Process Wise Data'
          },
          subtitle: {
            text: ''
          },
          xAxis: {
            categories: [
              '<?php echo display("enquiry"); ?>',
              '<?php echo display("lead"); ?>',
              '<?php echo display("Client"); ?>'
            ],
            crosshair: true
          },
          yAxis: {
            min: 0,
            title: {
              text: 'No of Data'
            }
          },
          tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
          },
          plotOptions: {
            column: {
              pointPadding: 0.2,
              borderWidth: 0
            }
          },
          series: [
            { name:data.data['enquiry_processWise'][0]['product_name'],
              data:[parseInt(data.data['enquiry_processWise'][0]['counter']),parseInt(data.data['lead_processWise'][0]['counter']),parseInt(data.data['client_processWise'][0]['counter'])],
            },
            { name:data.data['enquiry_processWise'][1]['product_name'],
              data:[parseInt(data.data['enquiry_processWise'][1]['counter']),parseInt(data.data['lead_processWise'][1]['counter']),parseInt(data.data['client_processWise'][1]['counter'])],
            },
            { name:data.data['enquiry_processWise'][2]['product_name'],
              data:[parseInt(data.data['enquiry_processWise'][2]['counter']),parseInt(data.data['lead_processWise'][2]['counter']),parseInt(data.data['client_processWise'][2]['counter'])],
            }
            ]
          });
        
        } 
      }
    }); 
  });

  
</script>
<!---------------------------------process wise data graph End------------------------------->
<!---------------------------------------calendar------------------------------------->
<script type="text/javascript">
  // sample calendar events data
$(document).ready(function(){


var curYear = moment().format('YYYY');
var curMonth = moment().format('MM');


// Calendar Event Source
var calendarEvents = {
  backgroundColor: '#1abc9c',
  borderColor: '#0b6352',
  events: [
  <?php $cnt=1; foreach($taskdata as $task){
$t_date = $task->task_date;
if(!empty($task->subject)){
$ttl = $task->subject;  
}else{
$ttl = 'None';  
}
if(!empty($task->task_remark)){
$remrk = $task->task_remark;  
}else{
$remrk = 'None';  
} 
$newDate = date("Y-m-d", strtotime($t_date));
?>
       {
      id: <?= $cnt;?>,
      start:'<?php echo $newDate; ?>',
      end: '<?php echo $newDate; ?>',
      title:'<?php echo $ttl; ?>',
      description:''
    },
  <?php  $cnt++; } ?>   
  ]
};
var pendingEvents = {
  backgroundColor: 'rgba(16,183,89, .25)',
  borderColor: '#10b759',
  events: [
   
  ]
};
var waitEvents = {
  backgroundColor: 'rgba(241,0,117,.25)',
  borderColor: '#f10075',
  events: [
   
  ]
};
var notapprovedEvents = {
 backgroundColor: 'rgba(253,126,20,.25)',
  borderColor: '#fd7e14',
  events: [
   
  ]
};

// ..............................................................
 'use strict'

  // Initialize tooltip
  $('[data-toggle="tooltip"]').tooltip()

  // Sidebar calendar
  $('#calendarInline').datepicker({
    showOtherMonths: true,
    selectOtherMonths: true,
    beforeShowDay: function(date) {

      // add leading zero to single digit date
      var day = date.getDate();
      console.log(day);
      return [true, (day < 10 ? 'zero' : '')];
    }
  });

  // Initialize fullCalendar
  $('#calendar').fullCalendar({
    height: 'parent',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listWeek'
    },
    navLinks: true,
    selectable: true,
    selectLongPressDelay: 100,
    editable: true,
    nowIndicator: true,
    defaultView: 'listMonth',
  eventLimit: 2,
    views: {
    
      agenda: {
        columnHeaderHtml: function(mom) {
          return '<span>' + mom.format('ddd') + '</span>' +
                 '<span>' + mom.format('DD') + '</span>';
        }
      },
      day: { columnHeader: false },
      listMonth: {
        listDayFormat: 'ddd DD',
        listDayAltFormat: false
      },
      listWeek: {
        listDayFormat: 'ddd DD',
        listDayAltFormat: false
      },
      agendaThreeDay: {
        type: 'agenda',
        duration: { days: 3 },
        titleFormat: 'MMMM YYYY'
      }
    },

    eventSources: [calendarEvents,pendingEvents,waitEvents,notapprovedEvents],
    eventAfterAllRender: function(view) {
      if(view.name === 'listMonth' || view.name === 'listWeek') {
        var dates = view.el.find('.fc-list-heading-main');
        dates.each(function(){
          var text = $(this).text().split(' ');
          var now = moment().format('DD');

          $(this).html(text[0]+'<span>'+text[1]+'</span>');
          if(now === text[1]) { $(this).addClass('now'); }
        });
      }

      console.log(view.el);
    },
    eventRender: function(event, element) {

      if(event.description) {
        element.find('.fc-list-item-title').append('<span class="fc-desc">' + event.description + '</span>');
        element.find('.fc-content').append('<span class="fc-desc">' + event.description + '</span>');
      }

      var eBorderColor = (event.source.borderColor)? event.source.borderColor : event.borderColor;
      element.find('.fc-list-item-time').css({
        color: eBorderColor,
        borderColor: eBorderColor
      });

      element.find('.fc-list-item-title').css({
        borderColor: eBorderColor
      });

      element.css('borderLeftColor', eBorderColor);
    },
  });

  var calendar = $('#calendar').fullCalendar('getCalendar');

  // change view to week when in tablet
  if(window.matchMedia('(min-width: 576px)').matches) {
    calendar.changeView('agendaWeek');
  }

  // change view to month when in desktop
  if(window.matchMedia('(min-width: 992px)').matches) {
    calendar.changeView('month');
  }

  // change view based in viewport width when resize is detected
  calendar.option('windowResize', function(view) {
    if(view.name === 'listWeek') {
      if(window.matchMedia('(min-width: 992px)').matches) {
        calendar.changeView('month');
      } else {
        calendar.changeView('listWeek');
      }
    }
  });


  $('.select2-modal').select2({
    minimumResultsForSearch: Infinity,
    dropdownCssClass: 'select2-dropdown-modal',
  });

  $('.calendar-add').on('click', function(e){
    e.preventDefault()

    $('#modalCreateEvent').modal('show');
  });

});

// ....................................calander end
</script>

<!-- desposition graph start here -->
<script>
$(document).ready(function(){
  $.ajax({
    url : "<?=base_url('Dashboard/despositionDataChart')?>",
    type: "post",
    dataType : "json",
    processData: false,
    contentType: false,
    success : function(data)
    { 
      var data1 = [];
      var data2 = [];
      var data3 = [];
      var data4 = [];

      if(data.status == 'success')
      {
        //response = JSON.parse(data);
        console.log(data.enquiryChartData[0]);
        for(var i = 0;i < data.enquiryChartData.length; i++)
        {
          data1.push(parseInt(data.enquiryChartData[i])); 
          data2.push(parseInt(data.leadChartData[i]));
          data3.push(parseInt(data.clientChartData[i]));
          data4.push(data.desplst[i]['lead_stage_name']);
        }
        Highcharts.chart('container', {
        chart: {
          type: 'column'
        },
        title: {
          text: '<?php echo display("disposition_data"); ?>'
        },
        subtitle: {
          //text: 'Source: WorldClimate.com'
        },
        xAxis: {
          categories: data4,
          crosshair: true
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Data (No.)'
          }
        },
        tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
        },
        plotOptions: {
          column: {
            pointPadding: 0.2,
            borderWidth: 0
          }
        },
        series: [{
          name: '<?php echo display("enquiry"); ?>',
          data: data1,

        }, {
          name: '<?php echo display("lead"); ?>',
          data: data2,

        },{
          name: '<?php echo display("Client"); ?>',
          data: data3,

        }]
      });
      }
    }
  })
})

</script>

<!-- desposition graph ends here -->


<!-- source graph start here -->
<script>
  $(document).ready(function(){
  $.ajax({
    url : "<?=base_url('Dashboard/sourceDataChart')?>",
    type: "post",
    dataType : "json",
    processData: false,
    contentType: false,
    success : function(data)
    { 
      var data1 = [];
      var data2 = [];
      var data3 = [];
      var data4 = [];
      
      if(data.status == 'success')
      {
        //response = JSON.parse(data);
        console.log(data.enquiryChartData[0]);
        for(var i = 0;i < data.enquiryChartData.length; i++)
        {
          data1.push(parseInt(data.enquiryChartData[i])); 
          data2.push(parseInt(data.leadChartData[i]));
          data3.push(parseInt(data.clientChartData[i]));
          data4.push(data.srclst[i]['lead_name']);
        }
        Highcharts.chart('container1', {
        chart: {
          type: 'column'
        },
        title: {
          text: '<?php echo display("lead_source"); ?>'
        },
        subtitle: {
          //text: 'Source: WorldClimate.com'
        },
        xAxis: {
          categories: data4,
          crosshair: true
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Data (No.)'
          }
        },
        tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
        },
        plotOptions: {
          column: {
            pointPadding: 0.2,
            borderWidth: 0
          }
        },
        series: [{
          name: '<?php echo display("enquiry"); ?>',
          data: data1,

        }, {
          name: '<?php echo display("lead"); ?>',
          data: data2,

        },{
          name: '<?php echo display("Client"); ?>',
          data: data3,

        }]
      });
      }
    }
  })
})

</script>
<!-- source graph ends here -->
<!------------------------------------------timline JS---------------------------------------------------->
<!---------------------------------------------india map------------------------------------------------->


<script>
// Prepare demo data
// Data is joined to map using value of 'hc-key' property by default.
// See API docs for 'joinBy' for more info on linking data and map.
var data = [
    ['in-py', 0],
    ['in-ld', 0],
    ['in-wb', 0],
    ['in-or', 0],
    ['in-br', 0],
    ['in-sk', 0],
    ['in-ct', 0],
    ['in-tn', 0],
    ['in-mp', 0],
    ['in-2984', 0],
    ['in-ga', 0],
    ['in-nl', 0],
    ['in-mn', 0],
    ['in-ar', 0],
    ['in-mz', 0],
    ['in-tr', 0],
    ['in-3464', 0],
    ['in-dl', 0],
    ['in-hr', 0],
    ['in-ch', 0],
    ['in-hp', 0],
    ['in-jk', 0],
    ['in-kl', 0],
    ['in-ka', 0],
    ['in-dn', 0],
    ['in-mh', 0],
    ['in-as', 0],
    ['in-ap', 0],
    ['in-ml', 0],
    ['in-pb', <?php /* echo $allpb=$pballe+$pballl+$pballc;  */?>],
    ['in-rj', 0],
    ['in-up', <?php /* echo $allup=$upalle+$upalll+$upallc; */ ?>],
    ['in-ut', 0],
    ['in-jh', 0]
];

// Create the chart
Highcharts.mapChart('container12', {
    chart: {
        map: 'countries/in/in-all'
    },

    title: {
        text: '<?php echo display("state_map"); ?>'
    },

    subtitle: {
        text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/in/in-all.js">India</a>'
    },

    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'bottom'
        }
    },

    colorAxis: {
        min: 0
    },

    series: [{
        data: data,
        name: 'Total data',
        states: {
            hover: {
                color: '#BADA55'
            }
        },
        dataLabels: {
            enabled: true,
            format: ''
        }
    }]
});
</script>
<!----------------------------------------------map end-------------------------------------------------->

<script src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/moment.min.js"></script>
<script src="<?php echo base_url()?>custom_dashboard/assets/js/amcharts/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/knob.js"></script>
<?php } ?>
  </body>
</html>