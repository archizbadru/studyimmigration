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
   table td,table th{text-align:center;font-size:11px;}
   table th{background:#283593;color:#fff;}
</style>
 <link href="<?php echo base_url('assets/datatables/css/dataTables.min.css')?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script> 

<?php if (!empty($all_active->result())) {
    ?>
<div id="home1" class="tab-pane fade in active">
   <div>
      <ul  class="nav nav-pills">
         <li class="active" onclick="reset_input()">
            <a  href="#tab-all1" data-toggle="tab">All (<?php echo count($all_active->result()) ?>)</a>
         </li>
         <?php $num_led = 0;
    foreach ($leadsource as $post) {

        if ($post->lsid == 4) {
            $num_led = 0;
            foreach ($all_active->result() as $enquiry) {
                if (($enquiry->whatsapp_sent_status == "0") || ($enquiry->whatsapp_sent_status == "99")) {
                    $num_led++;
                }
            }
        } else if ($post->lsid == 5) {

            $num_led = 0;
            foreach ($all_active->result() as $enquiry) {
                if ($enquiry->whatsapp_sent_status == "99") {
                    $num_led++;
                }
            }
        } else {

            $num_led = 0;

            foreach ($all_active->result() as $enquiry) {
                if ($post->lsid == $enquiry->enquiry_source) {
                    $num_led++;
                }
            }
        }
        ?>
         <li onclick="reset_input()"><a href="#tab-<?=$post->lsid?>" data-toggle="tab" title="<?php echo $post->lead_name; ?>"><?=$post->lead_name . ' (' . $num_led . ')';?> </a>
         </li>
         <?php }?>
      </ul>
      <div class="tab-content">
         <br>
         <div class="tab-pane active" id="tab-all1">
            <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%" nowrap>
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

                     <th class="sorting_asc wid-20" nowrap>Created Date</th>
                     <th class="sorting_asc wid-20" nowrap>Created By</th>
                     <th class="sorting_asc wid-20" nowrap>Assigned To</th>
                     <th class="sorting_asc wid-20" nowrap>Data Source</th>
                  </tr>
               </thead>
               <tbody>
                  <?php if (!empty($all_active->result())) {
        ?>
                  <?php $sl = 1;?>
                  <?php foreach ($all_active->result() as $enquiry) {
            ?>
                  <tr style="cursor:pointer; " onclick="window.location='<?php echo base_url('') . 'enquiry/view/' . $enquiry->enquiry_id; ?>'">
                     <td >
                        <input onclick="event.stopPropagation();" type='checkbox' name='enquiry_id[]' class="checkbox1" value='<?php echo $enquiry->enquiry_id; ?>'>
                     </td>
                     <td><?php echo $sl; ?></td>
                     <td title="<?php echo $enquiry->lead_name; ?>"><?php echo $enquiry->icon_url; ?></td>
                      <td> <?=$enquiry->company?></td>
                     <td><?php echo $enquiry->name_prefix . " " . $enquiry->name . " " . $enquiry->lastname ?></td>
                     <td><?php echo $enquiry->email; ?></td>
                     <td><?php echo $enquiry->phone; ?></td>
                    <td><?php echo $enquiry->address; ?></td>
                    <td><?php echo !empty($enquiry->product_name)?$enquiry->product_name:'N/A'; ?></td>

                     <td>
                        <?php echo date('d-m-Y', strtotime($enquiry->created_date)); ?>
                     </td>
                     <td>
                        <?php
                        echo !empty($enquiry->created_by_name)?$enquiry->created_by_name:'N/A';
            ?>
                     </td>
                     <td>
                        <?php
                        echo !empty($enquiry->assign_to_name)?$enquiry->assign_to_name:'N/A';
                   ?>
                     </td>
                    <td>
                      <?php if (!empty($enquiry->datasource_name)) {echo $enquiry->datasource_name;}?>
                    </td>
                  </tr>
                  <?php $sl++;?>
                  <?php }?>
                  <?php }?>
               </tbody>
            </table>
         </div>
         <?php foreach ($leadsource as $post) {
        ?>
         <div class="tab-pane" id="tab-<?=$post->lsid?>" >
            <table class="datatable table table-striped table-bordered " cellspacing="0" width="100%" nowrap>
               <thead>
                 <tr>
                     <th width="10px;"><input type='checkbox' class="checbox_type6<?=$post->lsid?>" onclick="check_all('checbox_type6<?=$post->lsid?>','checbox_checked6<?=$post->lsid?>');" value="check all" ></th>
                     <th width="10px;">S.N</th>
                     <th class="sorting_asc wid-20">Source</th>
                <th class="sorting_asc wid-20">Company Name</th>
                     <th class="sorting_asc wid-20">Name</th>
                     <th class="sorting_asc wid-20">Email</th>
                     <th class="sorting_asc wid-20">Phone</th>
                      <th class="sorting_asc wid-20">Address</th>
                      <th class="sorting_asc wid-20">Process</th>

                     <th class="sorting_asc wid-20" nowrap>Created Date</th>
                     <th class="sorting_asc wid-20" nowrap>Created By</th>
                     <th class="sorting_asc wid-20" nowrap>Assigned To</th>
                     <th class="sorting_asc wid-20" nowrap>Data Source</th>
                     
                  </tr>
               </thead>
               <tbody>
                  <?php
if ($post->lsid == 4) {
            //  print_r($get_sent_whats_app);
            if (!empty($all_active->result())) {
                ?>
                  <?php $sl = 1;?>
                  <?php foreach ($all_active->result() as $enquiry) {

                    if (($enquiry->whatsapp_sent_status == "0") || ($enquiry->whatsapp_sent_status == "99")) {

                        ?>
              <tr style="cursor:pointer;" onclick="window.location='<?php echo base_url("enquiry/view/$enquiry->enquiry_id") ?>';">
                     <td >
                        <input onclick="event.stopPropagation();" type='checkbox' class="checbox_checked6<?=$post->lsid?>" name='enquiry_id[]' value='<?php echo $enquiry->enquiry_id; ?>'>
                     </td>
                     <td ><?php echo $sl; ?></td>
                       <td title="<?php echo $enquiry->lead_name; ?>"><?php echo $enquiry->icon_url; ?></td>
            <td> <?=$enquiry->company?></td>
                     <td><?php echo $enquiry->name_prefix . " " . $enquiry->name . " " . $enquiry->lastname ?></td>
                     <td><?php echo $enquiry->email; ?></td>
                     <td><?php echo $enquiry->phone; ?></td>
                     <td> <?=$enquiry->address?></td>
                    <td><?php echo !empty($enquiry->product_name)?$enquiry->product_name:'N/A'; ?></td>

                     <td nowrap>
                        <?php echo date('d-m-Y', strtotime($enquiry->created_date)); ?>
                     </td>
                     <td>
                        <?php
                        
                        echo !empty($enquiry->created_by_name)?$enquiry->created_by_name:'N/A';

                        ?>
                     </td>
                     <td>
                        <?php
                        echo !empty($enquiry->assign_to_name)?$enquiry->assign_to_name:'N/A';
                          
                        ?>
                        <td>
                      <?php if (!empty($enquiry->datasource_name)) {echo $enquiry->datasource_name;}?>
                    </td>
                     </td>
                  </tr>



           <?php $sl++;}}}} elseif ($post->lsid == 5) {
            if (!empty($all_active->result())) {
                ?>
                  <?php $sl = 1;?>
                  <?php foreach ($all_active->result() as $enquiry) {
                    if ($enquiry->whatsapp_sent_status == "99") {

                        ?>
              <tr style="cursor:pointer;" onclick="window.location='<?php echo base_url("enquiry/view/$enquiry->enquiry_id") ?>';">
                     <td >
                        <input onclick="event.stopPropagation();" type='checkbox' class="checbox_checked6<?=$post->lsid?>" name='enquiry_id[]' value='<?php echo $enquiry->enquiry_id; ?>'>
                     </td>
                     <td ><?php echo $sl; ?></td>
                       <td title="<?php echo $enquiry->lead_name; ?>"><?php echo $enquiry->icon_url; ?></td>
            <td> <?=$enquiry->company?></td>
                     <td><?php echo $enquiry->name_prefix . " " . $enquiry->name . " " . $enquiry->lastname ?></td>
                     <td><?php echo $enquiry->email; ?></td>
                     <td><?php echo $enquiry->phone; ?></td>
                     <td> <?=$enquiry->address;?></td>
                    <td><?php echo !empty($enquiry->product_name)?$enquiry->product_name:'N/A'; ?></td>

                     <td nowrap>
                        <?php echo date('d-m-Y', strtotime($enquiry->created_date)); ?>
                     </td>
                     <td>
                        <?php
if ($enquiry->created_by > 0) {
                            if (!empty($all_user)) {
                                foreach ($all_user as $user) {
                                    if ($enquiry->created_by == $user->pk_i_admin_id) {
                                        echo $user->s_display_name . '&nbsp;' . $user->last_name;
                                    }
                                }}} else {?>
                        N/A
                        <?php }?>
                     </td>
                     <td>
                        <?php
if ($enquiry->aasign_to > 0) {
                            if (!empty($all_user)) {
                                foreach ($all_user as $user) {
                                    if ($enquiry->aasign_to == $user->pk_i_admin_id) {
                                        echo $user->s_display_name . '&nbsp;' . $user->last_name;
                                    }
                                }}} else {?>
                        NA
                        <?php }?>
                     </td>
                     <td>
                      <?php if (!empty($enquiry->datasource_name)) {echo $enquiry->datasource_name;}?>
                    </td>
                  </tr>



           <?php $sl++;}}}} else {
            if (!empty($all_active->result())) {
                ?>
                  <?php $sl = 1;?>
                  <?php foreach ($all_active->result() as $enquiry) {
                    if ($post->lsid == $enquiry->enquiry_source) {

                        ?>
              <tr style="cursor:pointer;" onclick="window.location='<?php echo base_url("enquiry/view/$enquiry->enquiry_id") ?>';">
                     <td >
                        <input onclick="event.stopPropagation();" type='checkbox' class="checbox_checked6<?=$post->lsid?>" name='enquiry_id[]' value='<?php echo $enquiry->enquiry_id; ?>'>
                     </td>
                     <td ><?php echo $sl; ?></td>
                       <td title="<?php echo $enquiry->lead_name; ?>"><?php echo $enquiry->icon_url; ?></td>
            <td> <?=$enquiry->company?></td>
                     <td><?php echo $enquiry->name_prefix . " " . $enquiry->name . " " . $enquiry->lastname ?></td>
                     <td><?php echo $enquiry->email; ?></td>
                     <td><?php echo $enquiry->phone; ?></td>
             <td> <?=$enquiry->address?></td>
                    <td><?php echo !empty($enquiry->product_name)?$enquiry->product_name:'N/A'; ?></td>
             
                     <td nowrap>
                        <?php echo date('d-m-Y', strtotime($enquiry->created_date)); ?>
                     </td>
                     <td>
                        <?php
                        echo !empty($enquiry->assign_to_name)?$enquiry->created_by_name:'N/A';
                          
                        ?>
                     </td>
                     <td>
                        <?php
                        echo !empty($enquiry->assign_to_name)?$enquiry->assign_to_name:'N/A';
                          
                        ?>
                     </td>
                     <td>
                      <?php if (!empty($enquiry->datasource_name)) {echo $enquiry->datasource_name;}?>
                    </td>
                  </tr>



           <?php $sl++;}}}}?>

               </tbody>
            </table>
         </div>
         <?php }?>
      </div>
   </div>
</div>
<?php } else {?>
<table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
   <thead>
      <tr>
        <th width="10px;"> <input type='checkbox' class="checked_all1" value="check all" ></th>
        <th class="sorting_asc wid-20">#</th>
        <th class="sorting_asc wid-20">Source</th>
        <th class="sorting_asc wid-20">Name</th>
        <th class="sorting_asc wid-20">Email</th>
        <th class="sorting_asc wid-20">Phone</th>
        <th class="sorting_asc wid-20">Company Name</th>
        <th class="sorting_asc wid-20">Address</th>
        <th class="sorting_asc wid-20">Process</th>
        <th class="sorting_asc wid-20" nowrap>Created Date</th>
        <th class="sorting_asc wid-20" nowrap>Created By</th>
        <th class="sorting_asc wid-20" nowrap>Assigned To</th>
        <th class="sorting_asc wid-20" nowrap>Data Source</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td colspan="13"> Enquiry Not Found !</td>
      </tr>
   </tbody>
</table>
<?php }?>
<script>
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
</script>
<!-- jquery-ui js -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
<!-- DataTables JavaScript -->
 <script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>
<script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>
<script type="text/javascript">$('datatable').removeClass('sorting_asc');</script> 