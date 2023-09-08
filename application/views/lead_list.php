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
<link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
<?php
   function initials($str) {
       $ret = '';
       foreach (explode(' ', $str) as $word)
           $ret = strtoupper(substr($word, 0, 1));
       return $ret;
   }
   ?>
<?php if (!empty($all_active->result())) { ?>                          
<div id="content_tabs1" class="tab-pane fade in active">
   <div id="home1" class="tab-pane">
      <div id="exTab3" class="">
         <ul  class="nav nav-pills">
            <li class="active" onclick="reset_input()">
               <a  href="#tab-ttoday" data-toggle="tab"><?php echo display('all_leads'); ?></a>
            </li>
            <?php
               foreach ($lead_stages as $stages) {
                   $num_led = 0;
                   foreach ($all_active->result() as $enquirys) {
                       if ($stages->stg_id == $enquirys->lead_stage) {
                           $num_led++;
                       }
                   }
                   ?>
            <li onclick="reset_input()"><a href="#tab-<?= $stages->stg_id ?>" data-toggle="tab"><?= $stages->lead_stage_name . ' (' . $num_led . ')' ?> </a>
            </li>
            <?php } ?>
         </ul>
         <div class="tab-content">
            <br>
            <div class="tab-pane active" id="tab-ttoday">
               <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th><input type='checkbox' class="checked_all6" value="check all" ></th>
                        <th title="S.No.">#</th>
                        <th title="Reference"><i class="fa fa-folder"></i></th>
                        <th title="Conversion Probability"><i class="fa fa-fire"></i></th>
                        <th class="sorting_asc wid-20">Lead ID</th>
                        <th class="sorting_asc wid-20">Name</th>
                        <th class="sorting_asc wid-20">Email</th>
                        <th class="sorting_asc wid-20">Phone</th>
                        <th class="sorting_asc wid-20">Company</th>
                        <th class="sorting_asc wid-20">Address</th>
                        <th class="sorting_asc wid-20">Process</th>
                        <th class="sorting_asc wid-20" nowrap>TRBO Date</th>
                        <th class="sorting_asc wid-20" nowrap>Created By</th>
                        <th class="sorting_asc wid-20" nowrap>Assigned To</th>
                        <th class="sorting_asc wid-20" nowrap>Data Source</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        $sl = 1;
                        foreach ($all_active->result() as $enquiry) {
                            $CI = &get_instance();
                            $queryid = $enquiry->enquiry_id;
                            $query_response = $this->Leads_Model->get_lead_response($queryid);
                            ?>
                     <tr style="cursor:pointer;" onclick="window.location = '<?php echo base_url(); ?>lead/lead_details/<?php echo $enquiry->enquiry_id; ?>';">
                        <td>
                           <input onclick="event.stopPropagation();" type='checkbox' name='enquiry_id[]' class="checkbox6" value='<?php echo $enquiry->enquiry_id; ?>'>
                        </td>
                        <td><?php echo $sl; ?></td>
                        <td title="<?php echo $enquiry->name ?>" style="font-size:17px"><?php echo $enquiry->icon_url; ?></td>
                        <td style="font-size:17px;"><?php if ($enquiry->lead_score == 1) { ?>
                           <i class="fa fa-fire" title="Cold" style="color:#06c7e8;"></i>
                           <?php } else if ($enquiry->lead_score == 2) { ?>
                           <i class="fa fa-fire" title="Warm" style="color:#ef9b1a;"></i>
                           <?php } else if ($enquiry->lead_score == 3) { ?>
                           <i class="fa fa-fire" title="Hot" style="color:#ef1a1a;"></i>
                           <?php } ?>
                        </td>
                        <td><?php echo $enquiry->Enquery_id; ?></td>
                        <td><?php echo $enquiry->name_prefix . " " . $enquiry->name . " " . $enquiry->lastname ?></td>
                        <td><?php echo $enquiry->email; ?></td>
                        <td><?php echo $enquiry->phone; ?></td>
                        <td> <?= $enquiry->company ?></td>
                        <td> <?= $enquiry->address ?></td>
                        <td> <?= !empty($enquiry->product_name)?$enquiry->product_name:'N/A' ?></td>
                        <td> 

                           <?php 
                            $this->db->select('task_date');
                            $this->db->where('query_id',$enquiry->Enquery_id);
                            $this->db->order_by('resp_id','DESC');
                            $this->db->limit(1);
                            $task_row  = $this->db->get('query_response')->row_array();
                            if (empty($task_row['task_date']) || $task_row['task_date']=='01-01-1970') {
                            
                             echo "NA";
                            }else{
                              echo $task_row['task_date']; 
                            }
                           ?> 
                        </td>
                        <td>                        
                           <?php
                              if ($enquiry->created_by > 0) {
                                  if (!empty($all_user)) {
                                      foreach ($all_user as $user) {
                                          if ($enquiry->created_by == $user->pk_i_admin_id) {
                                              echo $user->s_display_name . '&nbsp;' . $user->last_name;
                                          }
                                      }
                                  }
                              } else {
                                  ?>
                           N/A
                           <?php } ?> 
                        </td>
                        <td>
                           <?php
                              if ($enquiry->aasign_to > 0) {
                                  if (!empty($all_user)) {
                                      foreach ($all_user as $user) {
                                          if ($enquiry->aasign_to == $user->pk_i_admin_id) {
                                              echo $user->s_display_name . '&nbsp;' . $user->last_name;
                                          }
                                      }
                                  }
                              } else {
                                  ?>
                           N/A
                           <?php } ?> 
                        </td>
                        <td>
                            <?=$enquiry->datasource_name?>
                        </td>
                        
                     </tr>
                     <?php $sl++; ?>
                     <?php } ?> 
                  </tbody>
               </table>
            </div>
            <?php foreach ($lead_stages as $stages) { ?>
            <div class="tab-pane" id="tab-<?= $stages->stg_id ?>">
               <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead class="thead-light">
                     <tr>
                        <th> <input type='checkbox' class="checbox_type6<?= $stages->stg_id ?>" onclick="check_all('checbox_type6<?= $stages->stg_id ?>', 'checbox_checked6<?= $stages->stg_id ?>');" value="check all" ></th>
                        <th title="S.No.">#</th>
                        <th title="Reference"><i class="fa fa-folder"></i></th>
                        <th title="Conversion Probability">
                           <i class="fa fa-fire"></i>
                        </th>
                        <th class="sorting_asc wid-20">Name</th>
                        <th class="sorting_asc wid-20">Email</th>
                        <th class="sorting_asc wid-20">Phone</th>
                        <th class="sorting_asc wid-20">company</th>
                        <th class="sorting_asc wid-20">address</th>
                        <th class="sorting_asc wid-20">Process</th>

                        <th class="sorting_asc wid-20" nowrap>TRBO Date</th>
                        <th class="sorting_asc wid-20" nowrap>Created By</th>
                        <th class="sorting_asc wid-20" nowrap>Assigned To</th>
                        <th class="sorting_asc wid-20" nowrap>Data Source</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        $sl = 1;
                        $stage_Id = $stages->stg_id;
                        foreach ($all_active->result() as $enquiry) {                        
                            $queryid = $enquiry->enquiry_id;
                            $lead_stage = $enquiry->lead_stage;
                            if ($stage_Id == $lead_stage) {
                                $CI = &get_instance();                        
                                $query_response = $this->Leads_Model->get_lead_response($queryid);
                     ?>
                     <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>"  style="cursor:pointer;" onclick="window.location = '<?php echo base_url(); ?>lead/lead_details/<?php echo $enquiry->enquiry_id; ?>';">
                        <td style="width:1%"><input onclick="event.stopPropagation();" type='checkbox'  class="checbox_checked6<?= $stages->stg_id ?>" name='enquiry_id[]' value='<?php echo $enquiry->enquiry_id; ?>'></td>
                        <td><?php echo $sl; ?></td>
                        <td title="<?php echo $enquiry->name ?>" style="font-size:17px">
                            <?php echo $enquiry->icon_url; ?>
                        </td>
                        <td style="font-size:17px;"><?php if ($enquiry->lead_score == 1) { ?>
                           <i class="fa fa-fire" title="Cold" style="color:#06c7e8;"></i>
                           <?php }else if ($enquiry->lead_score == 2) { ?>
                           <i class="fa fa-fire" title="Warm" style="color:#ef9b1a;"></i>
                           <?php }else if ($enquiry->lead_score == 3) { ?>
                           <i class="fa fa-fire" title="Hot" style="color:#ef1a1a;"></i>
                           <?php } ?>
                        </td>
                        <td><?php echo $enquiry->name_prefix . " " . $enquiry->name . " " . $enquiry->lastname ?></td>
                        <td><?php echo $enquiry->email; ?></td>
                        <td><?php echo $enquiry->phone; ?></td>
                        <td> <?= $enquiry->company ?></td>
                        <td> <?= $enquiry->address ?></td>
                        <td> <?= !empty($enquiry->product_name)?$enquiry->product_name:'N/A' ?></td>
                        <td>                        
                           <!-- <?php// echo date('d-m-Y', strtotime($enquiry->created_date)); ?>  -->
                           <?php 
                            $this->db->select('task_date');
                            $this->db->where('query_id',$enquiry->Enquery_id);
                            $this->db->order_by('resp_id','DESC');
                            $this->db->limit(1);
                            $task_row  = $this->db->get('query_response')->row_array();
                            if (empty($task_row['task_date']) || $task_row['task_date']=='01-01-1970') {
                             echo "NA";
                            }else{
                              echo $task_row['task_date']; 
                            }
                           ?> 
                        </td>
                        <td>                        
                           <?php
                              if ($enquiry->created_by > 0) {
                                  if (!empty($all_user)) {
                                      foreach ($all_user as $user) {
                                          if ($enquiry->created_by == $user->pk_i_admin_id) {
                                              echo $user->s_display_name . '&nbsp;' . $user->last_name;
                                          }
                                      }
                                  }
                              } else {
                                  ?>
                           N/A
                           <?php } ?> 
                        </td>
                        <td>
                           <?php
                              if ($enquiry->aasign_to > 0) {
                                  if (!empty($all_user)) {
                                      foreach ($all_user as $user) {
                                          if ($enquiry->aasign_to == $user->pk_i_admin_id) {
                                              echo $user->s_display_name . '&nbsp;' . $user->last_name;
                                          }
                                      }
                                  }
                              } else {
                                  ?>
                           N/A
                           <?php } ?> 
                        </td>
                        <td><?=$enquiry->datasource_name?></td>
                     </tr>
                     <?php $sl++; ?>
                     <?php }
                        }
                        ?> 
                  </tbody>
               </table>
            </div>
            <?php } ?>
         </div>
      </div>
   </div>
</div>
<?php }else{ ?>
<table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
   <thead>
      <tr>
        <th width="10px;"> <input type='checkbox' class="checked_all1" value="check all" ></th>
        <th class="sorting_asc wid-20">#</th>
        <th class="sorting_asc wid-20">Source</th>
        <th class="sorting_asc wid-20">Name</th>
        <th class="sorting_asc wid-20">Email</th>
        <th class="sorting_asc wid-20">Phone</th>
        <th class="sorting_asc wid-20">Product</th>
        <th class="sorting_asc wid-20">Country</th>
        <th class="sorting_asc wid-20" nowrap>TRBO Date</th>
        <th class="sorting_asc wid-20" nowrap>Created By</th>
        <th class="sorting_asc wid-20" nowrap>Assigned To</th>
        <th class="sorting_asc wid-20" nowrap>Data Source</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td colspan="13"> Lead Not Found !</td>
      </tr>
   </tbody>
</table>
<?php }?>
<script>
   $('.checked_all1').on('change', function () {
       $('.checkbox1').prop('checked', $(this).prop("checked"));
   
   });
   $('.checkbox1').change(function () {
       if ($('.checkbox1:checked').length == $('.checkbox1').length) {
           $('.checked_all1').prop('checked', true);
       } else {
           $('.checked_all1').prop('checked', false);
       }
   });
</script>
<script>
   function reset_input() {
       $('input:checkbox').removeAttr('checked');
   }
   function check_all(checkclass, checkbox) {
       $('.' + checkclass).on('change', function () {
           $('.' + checkbox).prop('checked', $(this).prop("checked"));
   
       });
       $('.' + checkbox).change(function () {
           if ($('.' + checkbox + ':checked').length == $('.' + checkbox).length) {
               $('.' + checkclass).prop('checked', true);
           } else {
               $('.' + checkclass).prop('checked', false);
           }
       });
   }
   $('.checked_all1').on('change', function () {
       $('.checkbox1').prop('checked', $(this).prop("checked"));
   });
   $('.checkbox1').change(function () {
       if ($('.checkbox1:checked').length == $('.checkbox1').length) {
           $('.checked_all1').prop('checked', true);
       } else {
           $('.checked_all1').prop('checked', false);
       }
   });
   
   $('.checked_all2').on('change', function () {
       $('.checkbox2').prop('checked', $(this).prop("checked"));
   });
   $('.checkbox1').change(function () {
       if ($('.checkbox2:checked').length == $('.checkbox2').length) {
           $('.checked_all2').prop('checked', true);
       } else {
           $('.checked_all2').prop('checked', false);
       }
   });
   
   $('.checked_all3').on('change', function () {
       $('.checkbox3').prop('checked', $(this).prop("checked"));
   });
   $('.checkbox3').change(function () {
       if ($('.checkbox3:checked').length == $('.checkbox3').length) {
           $('.checked_all3').prop('checked', true);
       } else {
           $('.checked_all3').prop('checked', false);
       }
   });
   
   $('.checked_all4').on('change', function () {
       $('.checkbox4').prop('checked', $(this).prop("checked"));
   });
   $('.checkbox4').change(function () {
       if ($('.checkbox4:checked').length == $('.checkbox4').length) {
           $('.checked_all4').prop('checked', true);
       } else {
           $('.checked_all4').prop('checked', false);
       }
   });
   $('.checked_all5').on('change', function () {
       $('.checkbox5').prop('checked', $(this).prop("checked"));
   });
   $('.checkbox5').change(function () {
       if ($('.checkbox5:checked').length == $('.checkbox5').length) {
           $('.checked_all5').prop('checked', true);
       } else {
           $('.checked_all5').prop('checked', false);
       }
   });
   $('.checked_all6').on('change', function () {
       $('.checkbox6').prop('checked', $(this).prop("checked"));
   });
   $('.checkbox5').change(function () {
       if ($('.checkbox6:checked').length == $('.checkbox6').length) {
           $('.checked_all6').prop('checked', true);
       } else {
           $('.checked_all6').prop('checked', false);
       }
   });
</script>
<!-- jquery-ui js -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script> 
<!-- DataTables JavaScript -->
<script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>  
<script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>