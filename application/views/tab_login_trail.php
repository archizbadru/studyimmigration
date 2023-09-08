<div id="login-tab" class="tab-pane" style="width:100%;">
  <div class="content-panel">

<div class="row" style="padding-top:4%;">
<div class="col-lg-12">
<div class="table-responsive" style="overflow-y: scroll;">

<table id="dtBasicExampletr" class="table table-striped table-bordered" style="width:100%">
<thead>
<tr>
<th class="" style="font-size: 10px;">S.No</th>
<th style="font-size: 10px;">Login At</th>
<th style="font-size: 10px;">Logout At</th>
<th style="font-size: 10px;">Duration</th>
</tr>
</thead>
<tbody>
<?php if(!empty($login_details)){ ?>
<?php $i=1; foreach($login_details as $ldts){

$date1 = strtotime($ldts->lg_date_time);  
$date2 = strtotime($ldts->lgot_date_time);
 
// Formulate the Difference between two dates 
$diff = abs($date2 - $date1);

// To get the year divide the resultant date into 
// total seconds in a year (365*60*60*24) 
$years = floor($diff / (365*60*60*24));  
  
  
// To get the month, subtract it with years and 
// divide the resultant date into 
// total seconds in a month (30*60*60*24) 
$months = floor(($diff - $years * 365*60*60*24) 
                               / (30*60*60*24));  
  
  
// To get the day, subtract it with years and  
// months and divide the resultant date into 
// total seconds in a days (60*60*24) 
$days = floor(($diff - $years * 365*60*60*24 -  
             $months*30*60*60*24)/ (60*60*24));

  
// To get the hour, subtract it with years,  
// months & seconds and divide the resultant 
// date into total seconds in a hours (60*60) 
$hours = floor(($diff - $years * 365*60*60*24  
       - $months*30*60*60*24 - $days*60*60*24) 
                                   / (60*60));  
  
  
// To get the minutes, subtract it with years, 
// months, seconds and hours and divide the  
// resultant date into total seconds i.e. 60 
$minutes = floor(($diff - $years * 365*60*60*24  
         - $months*30*60*60*24 - $days*60*60*24  
                          - $hours*60*60)/ 60);  
  
  
// To get the minutes, subtract it with years, 
// months, seconds, hours and minutes  
$seconds = floor(($diff - $years * 365*60*60*24  
         - $months*30*60*60*24 - $days*60*60*24 
                - $hours*60*60 - $minutes*60));  
      
    /*$h[] = $hours;
    $m[] = $minutes;
    $s[] = $seconds;

$hou = array_sum($h);
$min = array_sum($m);
$sec = array_sum($s);
$hs = $hou * 3600;
$ms = $min * 60;*/

$sec = $seconds;
$hs = $hours * 3600;
$ms = $minutes * 60;

$secondss=($hs+$ms+$sec);
$tt = gmdate('H:i:s', $secondss);
$ttt = explode(':',$tt);
//print_r($ttt);exit;
 $fhours=$ttt[0];
 $fminuts=$ttt[1];
 $fseconds=$ttt[2];
      ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $ldts->lg_date_time; ?></td>
    <td><?php echo $ldts->lgot_date_time; ?></td>
      <td><?php printf(" %d hours, %d minutes, %d seconds", $fhours, $fminuts, $fseconds); ?></td>
</tr>
<?php $i++; ?>
<?php } ?>
<?php } ?> 
</tbody>
</table>
</div>
</div>
</div>
        </div>
      </div>

 <script>
     $(document).ready(function () {
  $('#dtBasicExampletr').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
 </script>