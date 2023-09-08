<?php 
$panel_menu = $this->db->select("tbl_user_role.user_permissions")
            ->where('pk_i_admin_id',$this->session->user_id)
            ->join('tbl_user_role','tbl_user_role.use_id=tbl_admin.user_permissions')
            ->get('tbl_admin')
            ->row();
            if (!empty($panel_menu->user_permissions)) {
              $module=explode(',',$panel_menu->user_permissions);
            }else{
              $module=array();
            }

?>

<script src="<?=base_url()?>/assets/summernote/summernote-bs4.min.js"></script>
<link href="<?=base_url()?>/assets/summernote/summernote-bs4.css" rel="stylesheet" />


<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        
<!-- Time line css start -->
<style>
  .hide-timeline{
    display: none;
  }
  #toggle_timeline{
    position: fixed;
    top: 61px;
    right: 0;
    color:#fff;
    background: #6285a9;
    border: 1px solid #325997;
  }
  <?php if($this->session->companey_id == 29) {        
    $c = 0;
    if ($enquiry->partner_id && $enquiry->status == 3) {
      $this->db->from('enquiry');
      $this->db->where('reference_name',$enquiry->partner_id);        
      $c = $this->db->count_all_results();      
    }            
    if($c == 0){ ?>
      a[href$="amount"],[href$="Payout_Preference"]{
        display: none !important;
      }
    <?php
    }          

  }

  ?>
  .col-height{
    min-height: 700px;
    max-height: 700px;
    overflow-y: auto;
    border-bottom: solid #c8ced3 1px;
  }
  /* select2 css start*/
  .select2-container--default .select2-selection--single .select2-selection__arrow b:before {
    content: "";
  }
  /* select2 css end*/

.cbp_tmtimeline {
  margin: 30px 0 0 0;
  padding: 0;
  list-style: none;
  position: relative;
} 

/* The line */
.cbp_tmtimeline:before {
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  width: 10px;
  background: #afdcf8;
  left: 5%;
  margin-left: -10px;
}

.cbp_tmtimeline > li {
  position: relative;
}

/* The date/time */
.cbp_tmtimeline > li .cbp_tmtime {
  display: block;
  width: 25%;
  padding-right: 100px;
  position: absolute;
}

.cbp_tmtimeline > li .cbp_tmtime span {
  display: block;
  text-align: right;
}

.cbp_tmtimeline > li .cbp_tmtime span:first-child {
  font-size: 0.9em;
  color: #bdd0db;
}

.cbp_tmtimeline > li .cbp_tmtime span:last-child {
  font-size: 2.9em;
  color: #3594cb;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmtime span:last-child {
  color: #6cbfee;
}

/* Right content */
.cbp_tmtimeline > li .cbp_tmlabel {
  margin: 0 0 15px 10%;
  background: #3594cb;
  color: #fff;
  padding: 10px;
  font-size: 1.2em;
  font-weight: 300;
  line-height: 1.4;
  position: relative;
  border-radius: 5px;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel {
  background: #6cbfee;
}

.cbp_tmtimeline > li .cbp_tmlabel h2 { 
  margin-top: 0px;
  padding: 0 0 10px 0;
  border-bottom: 1px solid rgba(255,255,255,0.4);
}

/* The triangle */
.cbp_tmtimeline > li .cbp_tmlabel:after {
  right: 100%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-right-color: #3594cb;
  border-width: 10px;
  top: 10px;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel:after {
  border-right-color: #6cbfee;
}

/* The icons */
.cbp_tmtimeline > li .cbp_tmicon {
  width: 40px;
  height: 40px;
  font-family: 'ecoico';
  speak: none;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  font-size: 1.4em;
  line-height: 40px;
  -webkit-font-smoothing: antialiased;
  position: absolute;
  color: #fff;
  background: #46a4da;
  border-radius: 50%;
  box-shadow: 0 0 0 8px #afdcf8;
  text-align: center;
  left: 5%;
  top: 0;
  margin: 0 0 0 -25px;
}

.cbp_tmicon-phone:before {
  content: "☣";
}

.cbp_tmicon-screen:before {
  content: "☣";
}

.cbp_tmicon-mail:before {
  content: "☣";
}

.cbp_tmicon-earth:before {
  content: "☣";
}

/* Example Media Queries */
@media screen and (max-width: 65.375em) {
  .cbp_tmtimeline > li .cbp_tmtime span:last-child {
    font-size: 1.5em;
  }
}

@media screen and (max-width: 47.2em) {
  .cbp_tmtimeline:before {
    display: none;
  }

  .cbp_tmtimeline > li .cbp_tmtime {
    width: 100%;
    /*position: relative;*/
    padding: 0 0 20px 0;
  }

  .cbp_tmtimeline > li .cbp_tmtime span {
    text-align: left;
  }

  .cbp_tmtimeline > li .cbp_tmlabel {
    margin: 0 0 30px 0;
    padding: 1em;
    font-weight: 400;
    font-size: 95%;
  }

  .cbp_tmtimeline > li .cbp_tmlabel:after {
    right: auto;
    left: 20px;
    border-right-color: transparent;
    border-bottom-color: #3594cb;
    top: -20px;
  }

  .cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel:after {
    border-right-color: transparent;
    border-bottom-color: #6cbfee;
  }

  .cbp_tmtimeline > li .cbp_tmicon {
    position: relative;
    /*float: right;*/
    left: auto;
    margin: -55px 5px 0 10px;
  } 
} 
.dataTables_paginate{
   display: none;
}   
</style>

<!-- Time line css end -->


<style type="text/css">
    [data-lettersEmployee]:before  
   {
    content:attr(data-lettersEmployee);
    display:inline-block;
    font-size:1em;
    width:2.5em;
    height:2.5em;
    line-height:2.5em;
    text-align:center;
    border-radius:50%;
    background:#2F353A;
    vertical-align:middle;
    margin-right:1em;
    color:white;
   }
   [data-black]:before {
    content: attr(data-black);
    display: inline-block;
    font-size: 1em;
    width: 4.5em;
    height: 4.5em;
    line-height: 4.5em;
    text-align: center;
    border-radius: 50%;
    background: #283593;
    vertical-align: middle;
    margin-right: 2em;float:left;
    color: white;
   }
   [data-lettersGenerated]:before {
    content: attr(data-lettersGenerated);
    display: inline-block;
    font-size: 1em;
    width: 2.5em;
    height: 2.5em;
    line-height: 2.5em;
    text-align: center;
    border-radius: 50%;
    background: #5FBD75;
    vertical-align: middle;
    margin-right: 1em;
    color: white;
   }
   .nav-tabs > li.active > a:hover {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: none!important;
   }
   .nav-tabs > li.active > a {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: none!important;
   }
   table th,td{font-size:11px;}
   .list-group{margin-top:10px!important;}
   .btnStatus{
    padding: 0px 4px !important;
    color: #fff !important;
    width: 36% !important; 
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
   .nav-tabs >li {
    background-color: #283593;
}
#exTab3 .nav-tabs > li > a {
    color: #fff;
}
#exTab4 .nav-tabs > li > a {
    color: #fff;
}
.nav-tabs > li.active > a {
    color: #555 !important;
    background-color: #fff;
}
#timeline{
    display: none;
}
#disposition{
  display: none;
}
@media screen and (max-width: 900px) {
  #timeline{
    display: inline-block;
  }
  #disposition{
    display: inline-block;
  }
  .mobile-hide{
    display: none;
  }
  .col-height{
    min-height:unset!important;
  }
  .activitytimelinediv{
    display: none;
  }
}
 
.hoverbox
{
  border: 2px solid black;
  position:absolute;
  color: white;
  font-size:12px;
  text-align: center;
  width:70px;
  background-color: gray;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<div class="row">
   <div class="col-md-12 mobile-center" style="background-color: #fff;border-bottom: 1px solid #C8CED3;">
      <div class="col-md-6" > 
        <p style="margin-top: 6px;">
        <?php
        //print_r($enquiry);
      /*  $back_url = "javascript:void(0)";
        if (!empty($enquiry)) {
          if($enquiry->status == 1){
            echo "Enquiry Details";
            $back_url = base_url().'enq/index';
          }else if($enquiry->status == 2){
            echo "Lead Details";          
            $back_url = base_url().'led/index';  
          }else if ($enquiry->status == 3) {
            echo "Client Details";     
            $back_url = base_url().'client/index';                                 
          }
        }*/
        ?>
      </p>
        <!-- Enquiry / Update Enquiry -->
      </div>
      <div class="col-md-6" >
         <div style="float:right">
          <?php  if($enquiry->status==2) { if($this->session->userdata('companey_id')==29){ ?>

            <div class="btn-group" role="group" aria-label="Button group">
               <a class="dropdown-toggle btn btn-xs btn-success" href="#" data-toggle="modal" data-target="#addbanknewdeal">New Deal</a>&nbsp;&nbsp;&nbsp;
            </div>

            <?php } }?>
            <!-- <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" onClick="window.location.reload();" title="Refresh">
               <i class="fa fa-refresh icon_color"></i>
               </a>  
            </div>
             For invenotry company -->
            <!--<?php  if(in_array(300,$module) || in_array(301,$module) || in_array(302,$module) || in_array(303,$module) || in_array(304,$module) || in_array(305,$module) || in_array(306,$module)){ ?>
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="dropdown-toggle" href="#" data-toggle="modal" data-target="#addnewdeal" title="Add New Deal"> <i class="fa fa-plus" style="background:#fff !important;border:none!important;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
            </div>

            <?php } ?>
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="dropdown-toggle" href="<?php echo base_url()?>enquiry/create" title="<?php echo display('add_new_enquiry');?>"> <i class="fa fa-plus" style="background:#fff !important;border:none!important;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
            </div>
          
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" href="<?php //echo $back_url; ?>" title="Back">
               <i class="fa fa-arrow-left icon_color"></i>
               </a>                                                    
            </div> -->
         </div>
      </div>
   </div>
<!-- For Invnetory COmpany -->
  <div id="addnewdeal" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <form action="<?php echo base_url(); ?>client/re_oreder" method="post" class="form-inner">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Deals</h4>
      </div>
      <div class="modal-body">
        
          <div class="row">
            <div class="form-group col-sm-6">  
            <label>Expected Closure Date</label>                  
            <input class="form-control date2"  name="expected_date" type="text">                
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
            <input class="form-control" value="<?php echo $leadid; ?>" name="child_id" type="hidden">                
            </div>
          
            <div class="form-group col-sm-12">        
            <input  class="btn btn-success" type="submit" value="Create New Deals " >      
            </div>
            </div>
      
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
     </form>
  </div>
</div>
<!-- END -->
<!-- For pasia EXpo -->

  <div id="addbanknewdeal" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <form action="<?php echo base_url(); ?>client/re_oreder1" method="post" class="form-inner">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Deals</h4>
      </div>
      <div class="modal-body">
        
          <div class="row">
            <div class="form-group col-sm-6">  
            <label>Expected Closure Date</label>                  
            <input class="form-control date2"  name="expected_date" type="text" readonly>                
            </div>
            
            <div class="form-group col-sm-6">
            <label class="col-form-label">Conversion Probability</label>
            
            <select class="form-control" id="LeadScore" name="lead_score">
            <option value="">Select</option>                                               
            <?php foreach ($lead_score as $score) {  ?>
                <option value="<?= $score->sc_id?>"><?= $score->score_name?>&nbsp;<?= $score->probability?></option>
                <?php } ?>                       
            </select>
            </div>

            <div class="form-group col-sm-6">
            <label class="col-form-label">Bank applied with</label>
            <input type="text" class="form-control" id="bankname" name="bankname">
            </div>

            <div class="form-group col-sm-6">
            <label class="col-form-label">Product Name</label>
            
            <input type="text" class="form-control" id="proname" name="proname" readonly="" value="<?= $details->country_name ?>">
                            
            </div>

            <div class="form-group col-sm-6">  
            <label>Add Comment</label>                  
            <input class="form-control" id="LastCommentGen" name="comment" type="text">
            <input class="form-control" value="<?php echo $leadid; ?>" name="child_id" type="hidden">                
            </div>
                                    
                </div>
      
    </div>
      <div class="modal-footer">
        <input  class="btn btn-success" type="submit" value="Create New Deals " > 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
     </form>
  </div>
</div>
<!-- END -->

   <div  class="row" id="ThreadEnq">
      <div class="col-md-3 col-xs-12 col-sm-12 col-height" style="text-align:center;background:#fff;">
         <?php
            $string =  $enquiry->name." ".$enquiry->lastname;            
            function initials($str) {     
                $ret = '';
                foreach (explode(' ', $str) as $word)
                $ret .= strtoupper(substr($word,0,1));
                return $ret; 
            }       
            ?>
         <!-- <div class="avatar" style="margin-top:5%;margin-left:-15%;">
            <p data-lettersbig="<?php echo initials($string);?>"> </p>
         </div> -->

         <h5 style="text-align:center"><br><?=ucwords($enquiry->name_prefix." ".$enquiry->name." ".$enquiry->lastname); ?>
            <br><?php if($enquiry->gender == 1) { echo 'Male<br>'; }else if($enquiry->gender == 2){ echo 'Female<br>'; }else if($enquiry->gender == 3){ echo 'Other<br>';} 
            //$p = $enquiry->phone;
            $p = substr($enquiry->phone, -10);
            if (user_access(450)) {
              $p = '##########';
            }
            ?>
            
            <a href='javascript:void(0)' onclick='send_parameters("<?php echo $p ?>")'><?php echo $p ?></a>
            <br><?php if(!empty($enquiry->email)) { echo $enquiry->email; } ?>
  <?php

  if(!empty($enquiry->lead_stage_name)){
            echo  $thtml = '<br><a class="badge" href="javascript:void(0)" style="background:#9B59B6;color:#fffff;padding:4px;">Disp - '.$enquiry->lead_stage_name.'</a>';
  }

  if(!empty($enquiry->call_stage_name)){
            echo  $thtml = '<br><a class="badge" href="javascript:void(0)" style="background:#FFB61E;color:#fffff;padding:4px;">Call Disp - '.$enquiry->call_stage_name.'</a><br>';
  }

            if (!empty($enquiry->tag_ids)) {

               $this->db->select('title,color,id,created_by');
               $this->db->where("id IN(" . $enquiry->tag_ids . ")");
               $tags = $this->db->get('tags')->result_array();

               if (!empty($tags)) {
                   foreach ($tags as $key => $value) { ?>
                       <div>
                           <a class="badge" href="javascript:void(0)"
                              style="background:<?php echo $value['color'] ?> ;padding:4px;"><?php echo $value['title'] ?>
                           </a>
                           <a href="<?= base_url('enq/drop_tag/') . $value['id'] ?>"
                              id="tagDrop" data-id="<?= $value['id'] ?>" data-enq="<?= $enquiry->enq_id; ?>"
                              class="text-danger" title="Drop Tag"><i
                                       class="fa fa-close"></i></a>
                       </div>
                   <?php }
               }
           } 
  ?>          
            <br><?php if(!empty($enquiry->reference_name)) {               
              $this->db->where('TRIM(partner_id)',trim($enquiry->reference_name));
              $this->db->where('comp_id',$this->session->companey_id);
              $ref_row  = $this->db->get('enquiry')->row_array();
              $src = '';
              if ($ref_row['product_id'] == 95) {
                $src = '(Customer)';
              }else if ($ref_row['product_id'] == 91) {
                $src = '(Patner)';
              }
              echo 'Referred by : <a href="'.base_url().'enquiry/view/'.$ref_row['enquiry_id'].'">'.$ref_row['name_prefix'].' '.$ref_row['name'].' '.$ref_row['lastname'].$src.'</a>'; 
            }

            if ($this->session->companey_id==29) {               
               $this->db->where('enquiry_code',$details->Enquery_id);
               $meta_row  = $this->db->get('paisa_expo_enquiry_meta')->row_array();
                if (!empty($meta_row)) { ?>
                  <div class="form-group col-md-12" >
                    PaisaExpo Reference Id : <?=$meta_row['paisaexpo_requestid']?>
                  </div>
                  <?php
                }
              }  
            ?>            
         </h5>
         <div class="row">
            <?php if($enquiry->drop_status>0){ ?>
            <a class="btn btn-danger btn-outline-dark btn-md"  href="<?php echo base_url();?>enquiry/active_enquery/<?php echo $enquiry->enquiry_id ?>" title="Active"  data-toggle="modal">
            <i class="fa fa-user-times"></i>
            </a>
            <?php 
            } else { 
              $enquiry_separation  = get_sys_parameter('enquiry_separation','COMPANY_SETTING');
              if (!empty($enquiry_separation)) {                                        
                $enquiry_separation = json_decode($enquiry_separation,true);          
                $curr_stage  = $enquiry->status;
                $next_stage = $enquiry->status+1;      
              }

              ?>
              <?php if(user_access(220)){ 
                $p = substr($enquiry->phone, -10); ?>
               <a href='javascript:void(0)' class="btn btn-warning btn-sm" onclick='send_parameters(<?php echo $p; ?>)'><i class="fa fa-phone"></i></a>
               <a href='javascript:void(0)' class="btn btn-danger btn-sm" onclick='ban_user(<?php echo $p; ?>)'><i class="fa fa-ban"></i></a>
              <?php } ?>
                <a class="btn btn-primary btn-sm"  data-toggle="modal" type="button" title="Send Notification" data-target="#sendsms<?php echo $enquiry->enquiry_id ?>" data-toggle="modal"  onclick="getTemplates('4','Send Notification')">
                <i class="fa fa-bell-o"></i>
                </a>                
                <a class="btn btn-primary btn-sm"  data-toggle="modal" id="agg_slink" type="button" title="Send SMS" data-target="#sendsms<?php echo $enquiry->enquiry_id ?>" data-toggle="modal"  onclick="getTemplates('2','Send SMS')">
                <i class="fa fa-paper-plane-o"></i>
                </a>
                <a class="btn btn-info btn-sm"  data-toggle="modal" id="agg_elink" type="button" title="Send Email" data-target="#sendsms<?php echo $enquiry->enquiry_id ?>" data-toggle="modal"  onclick="getTemplates('3','Send Email')">
                <i class="fa fa-envelope"></i>
                </a>
                <a class="btn btn-success btn-sm"  data-toggle="modal" id="agg_slink" type="button" title="Send Whatsapp" data-target="#sendsms<?php echo $enquiry->enquiry_id ?>" data-toggle="modal"  onclick="getTemplates('1','Send Whatsapp')">
                <i class="fa fa-whatsapp"></i>
                </a>

                <?php if(user_access(710)){ ?>
                      <a class="btn btn-danger btn-sm" type="button" title="Tag AS" data-toggle="modal" data-target="#tagas"><i class="fa fa-thumb-tack"></i>
                      </a>   
                  <?php } ?>
                <?php if($enquiry->status==1){ ?>
                
                <a class="btn  btn-info btn-sm"  type="button" title="Mark as Application"  data-target="#genLead" data-toggle="modal">
                <i class="fa fa-thumbs-o-up"></i>
                </a>
                <a class="btn btn-danger btn-sm"  type="button" title="Drop Onboarding" data-target="#dropEnquiry" data-toggle="modal">
                <i class="fa fa-thumbs-o-down"></i>
                </a>
                <?php }elseif ($enquiry->status==2) { ?>
                  <!--<a class="btn  btn-info btn-sm" title="Mark as Case Management" href="<?=base_url().'lead/convert_to_lead/'.$enquiry->enquiry_id?>" onclick="return confirm('Are you sure you want to Mark this Application as Case Management ?')" >
                  <i class="fa fa-user"></i>
                </a>-->
                <a class="btn  btn-info btn-sm"  type="button" title="Mark Case Management"  data-target="#genLeadother" data-toggle="modal">
                <i class="fa fa-thumbs-o-up"></i>
                </a>

                  <a class="btn btn-danger btn-sm"  type="button" title="Drop Application" data-target="#dropEnquiry" data-toggle="modal">
                  <i class="fa fa-thumbs-o-down"></i>
                </a>
                  <?php
                }elseif ($enquiry->status==3) { ?>
                  <!--<a class="btn  btn-info btn-sm" title="Mark as Refund Case" href="<?=base_url().'lead/convert_to_lead/'.$enquiry->enquiry_id?>" onclick="return confirm('Are you sure you want to Mark this Case Management as Refund Case ?')" >
                  <i class="fa fa-user"></i>
                </a>-->

                <a class="btn  btn-info btn-sm"  type="button" title="Mark Refund Case"  data-target="#genLeadother" data-toggle="modal">
                <i class="fa fa-thumbs-o-up"></i>
                </a>

                  <a class="btn btn-danger btn-sm"  type="button" title="Drop Case Management" data-target="#dropEnquiry" data-toggle="modal">
                    <i class="fa fa-thumbs-o-down"></i>
                  </a>
                  <?php
                }elseif ($enquiry->status==4) { 
                  if (!empty($enquiry_separation)) {
                    if (!empty($enquiry_separation[$next_stage])) {
                       ?>                   
                        <a class="btn  btn-info btn-sm" title="Mark as <?=$enquiry_separation[$next_stage]['title']?>" href="<?=base_url().'lead/convert_to_lead/'.$enquiry->enquiry_id?>" onclick="return confirm('Are you sure you want to Mark this <?=display('client')?> as <?=$enquiry_separation[$next_stage]['title']?> ?')" > <i class="fa <?=$enquiry_separation[$next_stage]['icon']?>"></i>
                        </a>
                    <?php
                    }
                  }
                  ?>
                  <a class="btn btn-danger btn-sm"  type="button" title="Drop Refund" data-target="#dropEnquiry" data-toggle="modal">
                    <i class="fa fa-thumbs-o-down"></i>
                  </a>
                  <?php
                }else{                
                  if (!empty($enquiry_separation)) {                    
                    if (!empty($enquiry_separation[$next_stage])) {
                      ?>
                      <a class="btn  btn-info btn-sm" title="Mark as <?=$enquiry_separation[$next_stage]['title']?>" href="<?=base_url().'lead/convert_to_lead/'.$enquiry->enquiry_id?>" onclick="return confirm('Are you sure you want to Mark this <?=$enquiry_separation[$curr_stage]['title']?> as <?=$enquiry_separation[$next_stage]['title']?> ?')" > <i class="fa <?=$enquiry_separation[$next_stage]['icon']?>"></i>
                      </a>
                      <?php
                    }
                    ?>
                    <a class="btn btn-danger btn-sm"  type="button" title="Drop" data-target="#dropEnquiry" data-toggle="modal">
                      <i class="fa fa-thumbs-o-down"></i>
                    </a>
                    <?php
                  }
                }
                ?>                
                <?php 

            }
            ?>
            <a class="btn btn-sm  btn-info" title="disposition" id="disposition" href="#" data-toggle="modal" data-target="#dispo_modal" onclick="show_disposition();">
            <i class="fa fa-bars"></i>
            </a>
            <a class="btn btn-sm btn-info" title="Timeline" id="timeline" href="#" onclick="show_timeline();" data-toggle="modal" data-target="#timeline_modal">
                  <i class="fa fa-hourglass-end"></i>
            </a>
         </div>
           <table style="width: 100%;margin-top: 5%;" id="dataTable" class="table table-responsive-sm table-hover table-outline mb-0 mobile-hide" >
              <tbody>
                 <tr>
                    <td><button class="btn btn-basic" type="button" style="width: 100%;">Disposition</button></td>
                 </tr>
              </tbody>
           </table>
         <div id="disposition-section" class="mobile-hide">
              <div class="row" >
                 <?php echo form_open_multipart('lead/update_description/'.$details->enquiry_id,array('id'=>'disposition_save_form','class'=>'form-inner')) ?>
                 <input type="hidden" name="dis_subject">
                 <input type="hidden" name="unique_no" value="<?php echo $details->Enquery_id; ?>" >
                 <input type="hidden" name="url" value="<?php echo $this->uri->segment(1); ?>" >
                 <input type="hidden" name="latest_task_id">

                 <div class="form-group col-sm-12">
                             <select class="form-control" id="call_stage_change" name="call_stage">
                                <option>---Select Call Stage---</option>
                                <?php foreach($all_cstage_lists as $callstg){ ?>                              
                                <option value="<?= $callstg->stg_id?>"><?php echo $callstg->lead_stage_name; ?></option>
                                <?php } ?>
                             </select>
                      </div>

                  <div class="form-group col-sm-12">
                             <!--<label class="col-form-label">Lead Stage</label>-->
                             <select class="form-control" id="lead_stage_change" name="lead_stage" onchange="find_description()">
                                <option>---Select Application Stage---</option>
                                <?php foreach($all_estage_lists as $single){                               
                                  //$id=$single->lead_stage;                                                            
                                ?>                              
                                <option value="<?= $single->stg_id?>" <?php if ($single->stg_id == $details->lead_stage) {echo 'selected';}?>><?php echo $single->lead_stage_name; ?></option>
                                <?php } ?>
                             </select>
                      </div>

                      <div class="form-group col-sm-12">                           
                             <select class="form-control" id="lead_description" name="lead_description" onchange="showDiv(this)">
                                 <option>---Select Description---</option>
                                 <?php foreach($all_description_lists as $discription){ ?>                                   
                                     <option value="<?php echo $discription->id; ?>"><?php echo $discription->description; ?></option>
                                     <?php } ?>
                             </select>
                      </div>

                      <div class="form-group col-sm-12">                           
                             <select class="form-control" id="type_disposition" name="type_disposition">
                                 <option>---Select Reminder Type---</option>
                                 <?php foreach($desp_type as $type){ ?>
                                  <option value="<?php echo $type->id; ?>"><?php echo $type->type_name; ?></option>
                                     <?php } ?>
                             </select>
                      </div>  


                      <input type="hidden" name="enq_code1"  value="<?php echo  $details->Enquery_id; ?>" >
                      <div class="form-group col-sm-6" style="display:none;">
                    <label>Contact Person Name</label>
                    <input type="text" class="form-control" value="<?php if(!empty($details->name)){echo $details->name;} ?>" name="contact_person1"  placeholder="Contact Person Name">
                 </div>
                 <div class="form-group col-sm-6" style="display:none;">
                    <label>Contact Person Designation</label>
                    <input type="text" class="form-control" name="designation1" value="<?= isset($details->designation)?$details->designation:''?>" placeholder="Contact Person Designation">
                 </div>
                 <div class="form-group col-sm-6" style="display:none;">
                    <label>Contact Person Mobile No</label>
                    <input type="text" class="form-control" value="<?php if(!empty($details->phone)){echo $details->phone;} ?>" name="mobileno1" placeholder="Mobile No">
                 </div>
                 <div class="form-group col-sm-6" style="display:none;">
                    <label>Contact Person Email</label>
                    <input type="text" class="form-control" value="<?php if(!empty($details->email)){echo $details->email;} ?>" name="email1" placeholder="Email">
                 </div>

                       <div class="" id="otherTypev">
                                      <div class="form-group col-sm-12">
                                      <input type="date" name="c_date" id='disposition_c_date' class="form-control" placeholder=""  >
                                  </div>
                                  <div class="form-group col-sm-12">
                                      <input type="time" name="c_time" id='disposition_c_time' class="form-control" placeholder=""  >
                                      <input type="hidden" name="dis_notification_id" >
                                  </div>
                                  </div>
                     
                          <div class="form-group col-sm-12">
                                      <!--<label>Remaks</label>-->
                                      <textarea class="form-control" name="conversation"></textarea>
                                  </div>
                 <div class="sgnbtnmn form-group col-md-12">
                    <div class="sgnbtn">
                       <input id="disposition_save_btn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                    </div>
                 </div>
                 <?php echo form_close()?>
              </div>         
            </div>
<hr>
<?php if($details->Pay_status==1 || $details->full_pay==1){  ?>
<div class="form-group col-sm-6">  
    <label><?php echo 'Create Portal'; ?></label>                  
    <input class="form-control" name="create_portal" id="create_portal" type="checkbox" onclick="create_portal(`<?php echo $details->enquiry_id; ?>`,`<?php echo $details->email; ?>`,`<?php echo $details->phone; ?>`)" <?php if($details->portal=='Yes'){ echo 'checked';} ?>>                
</div>
<div class="form-group col-sm-6">  
    <label><?php echo 'Disable Portal'; ?></label>                  
    <input class="form-control" name="disable_portal" id="disable_portal" type="checkbox" onclick="disable_portal(`<?php echo $details->enquiry_id; ?>`,`<?php echo $details->email; ?>`,`<?php echo $details->phone; ?>`)" <?php if($details->portal_status=='disable'){ echo 'checked';} ?>>                
</div>

<div class="form-group col-sm-12">  
    <label><?php echo 'Portal Validity'; ?></label>                  
    <input class="form-control" name="portal_valid" id="portal_valid" type="date" onchange="portal_valid(`<?php echo $details->enquiry_id; ?>`)" value="<?php echo $details->portal_validity; ?>">                
</div>
<?php } ?>

      </div>

 <style type="text/css">
            .nav-tabs
            {
             overflow-x: hidden;
             overflow-y:hidden;
             white-space: nowrap;
             height: 50px;
            }
            .nav-tabs > li
            {
               white-space: nowrap;
               float: none;
               display: inline-block;
            }
           
          </style>

      <div class="col-md-6 col-xs-12 col-sm-12 card card-body col-height details-column" style="background:#fff;border-top: unset;">
         <div id="exTab3" class="">
            <ul  class="nav nav-tabs hideScroll" role="tablist">  
            <span style="position: absolute; left: 0; font-size: 22px; line-height: 40px; z-index: 999"><i class="fa fa-caret-left" onclick="tabScroll('left')"></i></span>            
              <li class="<?php if(empty($this->uri->segment(4))){ echo 'active';};?>"><a  href="#basic" data-toggle="tab" style="padding: 10px 10px; ">Basic</a></li> 
            <?php if (user_access('630')===true) { ?>
                <li><a href="#task" data-toggle="tab" style="padding: 10px 10px;">Task</a></li>
            <?php } ?>
              <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='family'){ echo 'active';}};?>"><a href="#family_new" data-toggle="tab" style="padding: 10px 10px;">Family</a></li>  
             <?php if($this->session->userdata('companey_id')==292) {  if($enquiry->status==3) {?>
              <li><a href="#followup" data-toggle="tab" style="padding: 10px 10px;">AMC</a></li>

               <?php } } if($enquiry->status==3) { 

                 if(in_array(300,$module) || in_array(301,$module) || in_array(302,$module) || in_array(303,$module)){ 
                ?>
                <li><a href="#order" data-toggle="tab" style="padding: 10px 10px;">Order Details</a></li> 
                <?php }
                 }?>     
                 <?php if($this->session->userdata('companey_id')==29){?>  
                <li><a href="#amount" data-toggle="tab" style="padding: 10px 10px;">Amount</a></li> 
                <?php }?>      

                <?php 
              if(!empty($tab_list)){
                //print_r($tab_list);die;
                foreach ($tab_list as $key => $value) { 
                  if ($value['id'] != 1) { ?>
                    <li><a href="#<?=str_replace(' ', '_', $value['title'])?>" data-toggle="tab" style="padding: 10px 10px;"><?=$value['title']?></a></li>
                <?php
                  }
                }
              }
              ?>
      <?php
              if (user_access('240')===true) { ?>
               <!--<li><a href="#institute" id="institute-tab" data-toggle="tab" style="padding: 10px 10px;">Institute</a></li>-->
        <?php } ?>
        <?php
         if (user_access('550')===true) {
        ?>
        <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='education'){ echo 'active';}};?>"><a href="#education" data-toggle="tab" style="padding: 10px 10px;">Qualifications</a></li>
       <?php }
         if (user_access('540')===true) {
            ?>
        <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='qalification'){ echo 'active';}};?>"><a href="#qalification" data-toggle="tab" style="padding: 10px 10px;">English Language Test</a></li>
        <?php }
         if (user_access('560')===true) {
            ?>
      
        <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='jobdetail'){ echo 'active';}};?>"><a href="#jobdetail" data-toggle="tab" style="padding: 10px 10px;">Job Detail</a></li> 
        <?php }
         if (user_access('570')===true) {
            ?>
      <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='experience'){ echo 'active';}};?>"><a href="#experience" data-toggle="tab" style="padding: 10px 10px;">Experience</a></li>     
      <?php }
         if (user_access('580')===true) {
            ?>
        <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='payment'){ echo 'active';}};?>"><a href="#payment" data-toggle="tab" style="padding: 10px 10px;">Payment</a></li>
        <?php }
         if (user_access('590')===true) {
            ?>
      <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='refund'){ echo 'active';}};?>"><a href="#refund" data-toggle="tab" style="padding: 10px 10px;">Refund Request</a></li>
      <?php }
         if (user_access('600')===true) {
            ?>
           <!--<li><a href="#aggrement" data-toggle="tab" style="padding: 10px 10px;">Aggrement</a></li>-->
        <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='agreement'){ echo 'active';}};?>"><a href="#aggrement_new" data-toggle="tab" style="padding: 10px 10px;">Agreement</a></li>
        <?php }
         if (user_access('610')===true && $details->portal=='Yes') { ?>
       <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='document'){ echo 'active';}};?>"><a href="#document_new" id="tab_document_new" data-toggle="tab" style="padding: 10px 10px;">Document</a></li>
       <?php }
       if (user_access('643')===true && $details->portal=='Yes') {
            ?>
        <li><a href="#url-tab" data-toggle="tab" style="padding: 10px 10px;">Url</a></li>
        <?php }
         if (user_access('630')===true && $details->portal=='Yes') {
            ?>
       <li><a href="#login-tab" data-toggle="tab" style="padding: 10px 10px;">Login Trail</a></li>
       <?php }
         if (user_access('620')===true && $details->portal=='Yes') {
            ?>
         <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='ticket'){ echo 'active';}};?>"><a href="#ticket" data-toggle="tab" style="padding: 10px 10px;">Tickets</a></li>
         <?php }
            ?>
      
            <span style="position: absolute; right: 0; font-size: 22px; line-height: 40px; z-index: 999"><i class="fa fa-caret-right"  onclick="tabScroll('right')"></i></span>
            </ul>
            <div class="tab-content clearfix">
                <div class="tab-pane <?php if(empty($this->uri->segment(4))){ echo 'active';};?>" id="basic">
                  <?php echo tab_content(1,$this->session->companey_id,$enquiry_id); ?>
               </div>
<script type="text/javascript">
  function tabScroll(side)
  {
    if(side=='left')
    {
      var leftPos = $('.nav-tabs').scrollLeft();
     
        $(".nav-tabs").animate({
            scrollLeft: leftPos - 200
        }, 100);
    }
    else if (side=='right')
    {   
        var leftPos = $('.nav-tabs').scrollLeft();
      
        $(".nav-tabs").animate({
            scrollLeft: leftPos + 200
        }, 100);
    }
  }

  function tabScrollt(side)
  {
    if(side=='left')
    {
      var leftPos = $('.tscroll').scrollLeft();
     
        $(".tscroll").animate({
            scrollLeft: leftPos - 200
        }, 100);
    }
    else if (side=='right')
    {   
        var leftPos = $('.tscroll').scrollLeft();
      
        $(".tscroll").animate({
            scrollLeft: leftPos + 200
        }, 100);
    }
  }
</script>

               
               <div class="tab-pane" id="order">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="width:20px;"><?php echo display('serial') ?></th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Quantity</th> 
                            <th>Price</th>
                            <th>Date</th>                       
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                   </table>
                   </div>


<div class="tab-pane" id="followup">
<div class="action-btn">
<a href="" class="btn btn-xs btn-success" data-toggle="modal" data-target="#addamc">Add AMC</a>                       
</div>
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="width:20px;"><?php echo display('serial') ?></th>
                            <th>Product Name</th>
                           
                            <th>From Date</th> 
                            <th>To Date</th> 
                                                    
                       
                        </tr>
                    </thead>
                    <tbody>
                       <?php if(!empty($amc_list)){
                         $sl=1;
                        foreach($amc_list as $amclist){?>
                          <tr>
                            <td><?= $sl; ?></td>
                            <td><?= ucwords($amclist['country_name']); ?></td>
                            <td><?= $amclist['amc_fromdate']?></td>
                            <td><?= $amclist['amc_todate']?></td>

                          </tr>

                        <?php }  $sl++;

                      } ?>
                    </tbody>
                  </table>
 <div id="addamc" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    
    <div class="modal-content">
       <?php echo form_open_multipart('client/add_amc'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add AMC</h4>
      </div>
     
      <div class="modal-body">
            
              <div class="row">
                  
            <input type="hidden" name="enqid" value="<?= $enquiry_id?>">
            <div class="form-group col-md-12">  
            <label>Select Product</label> 
            <select class="form-control"  name="productlist" id="productlist">   
            <option value="">Select</option>
            <?php if(!empty($prod_list)){

              foreach($prod_list as $prodlist){ ?>

             <option value="<?= $prodlist['id'] ?>"><?= $prodlist['country_name']?></option>

         <?php  }
             }  
             ?>                                                          
            </select> 
            </div>

            <div class="form-group col-md-6">  
            <label>From Date</label>    
            <input type="date" name="fromdate" class="form-control" id="fromdate">       
            </div>

            <div class="form-group col-md-6">  
            <label>To Date</label>    
            <input type="date" name="todate" class="form-control" id="todate">       
            </div>

            <div class="form-group col-md-12" style="display: none">  
            <label>Attach PO</label>    
            <input type="file" name="po" class="form-control" id="po">       
            </div>
            
            <input type="hidden" value="<?= $compid; ?>" class="" name="compid" id="compid">  
            <!-- <input type="hidden" value="<?= $enqid ?>" class="" name="userid" id="userid">          -->
     
            </div>
            
         <div class="modal-footer">
           <button class="btn btn-success" type="submit">Add</button>   
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
               
            <?php echo form_close(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- comission  -->

     <div class="tab-pane" id="amount">
                  <hr>

                  <div class="card card-body" style="overflow-y: scroll;">
                        <table class="table table-bordered">                          
                          <thead>
                            <tr>
                              <th>
                                Amount Disburssed
                              </th>
                              <th>
                                Commission
                              </th>
                              <th>
                              Date of payment
                              </th>
                              <th>
                                TDS
                              </th>
                              <th>
                                Amount Paid
                              </th>
                              <th>
                                Payout Percentage
                              </th>
                              <th>
                                Month
                              </th>
                              <th>
                                Actions
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if (!empty($comission_data)) {
                              foreach ($comission_data as $key => $value) { ?>
                                <tr>
                                    <td><?=$value['amt_disb']?></td>                                    
                                    <td><?=$value['comission']?></td>
                                    <td><?=$value['date_of_payment']?></td>
                                    <td><?=$value['tds']?></td>
                                    <td><?=$value['amt_paid']?></td>
                                    <td><?=$value['payout_per']?></td>
                                    <td><?= ucwords($value['month'])?></td>
                                    <td>
                                     <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_comission(<?=$value['id']?>)"><i class="fa fa-trash" ></i></a>
                                      <a href="javascript:void(0)" class="btn btn-primary btn-sm " onclick="open_comission_modal(<?=$value['id']?>)"><i class="fa fa-pencil" ></i></a>
                                    </td>
                                </tr>                                
                              <?php
                              }
                            }else{ ?>
                              <tr style="text-align: center;">
                                <td colspan=16>No record found</td>
                              </tr>
                              <?php
                            }
                            ?>
                          </tbody>
                            
                        </table>
                     </div>


                  <div class="card card-body">
                    <?php echo form_open_multipart('enquiry/add_enquery_comission/'.base64_encode($details->Enquery_id),array('class'=>"form-inner",'id'=>'add_comission_form')) ?>                      
                      <div class="row">                                          
                       <div class="form-group col-sm-4"> 
                          <label>Amount Disburssed</label>
                          <input type="text" class="form-control" name='amtdisb' required>
                                          
                       </div>
                       <div class="form-group col-sm-4"> 
                          <label>Commission </label>
                          <input class="form-control" name="comission" type="text" placeholder="" required>  
                       </div>

                       <div class="form-group col-sm-4"> 
                          <label>Date of payment</label>
                          <input class="form-control" name="dateofpay" type="date" required>  
                       </div>
                      </div>
                      <div class="row">                                          
                       <div class="form-group col-sm-4"> 
                          <label>TDS</label>
                          <input class="form-control" name="tds" type="text" placeholder="TDS" required>  
                       </div>
                                                               
                       <div class="form-group col-sm-4"> 
                          <label>Amount Paid</label>
                          <input class="form-control" name="amtpaid" type="text" placeholder="AMount Paid" required>  
                       </div>
                        <div class="form-group col-sm-4"> 
                        
                          <label>Payout Percentage</label>
                          <input class="form-control" name="payoutper" type="text" placeholder="Payout percentage" required>                 
                       </div>

                     
                     </div>
                     <div class="row">
                       

                       <div class="form-group col-sm-4"> 
                          <label>Month</label>
                          <Select class="form-control" name="month" required>
                            <option value="">Select</option>
                            <option value="january">January</option>
                            <option value="february">February</option>
                            <option value="march">March</option>
                            <option value="april">April</option>
                            <option value="may">May</option>
                            <option value="june">June</option>
                            <option value="july">July</option>
                            <option value="august">August</option>
                            <option value="september">September</option>
                            <option value="october">October</option>
                            <option value="novmber">Novmber</option>
                            <option value="december">December</option>
                          </Select>  
                       </div>
                                                              
                     </div>                                     
                       <br>
                           <div class=""  id="save_button">                                                
                              <div class="col-md-12">                                                
                                    <button class="btn btn-primary" type="submit" >Save</button>            
                              </div>
                            </div>
                       </form>
                    </div>                                                
               </div>
               <!-- END -->

               <div class="tab-pane" id="institute">
                  <hr>
                  <div class="card card-body" style="overflow-y: scroll;">
                        <table class="table table-bordered">                          
                          <thead>
                            <tr>
                              <th>
                                Institute Name
                              </th>
                              <?php if ($this->session->companey_id=='67') { ?>
                               <th>
                                Course Name
                              </th>
                               <th>
                                Program Lavel
                              </th>
                                <th>
                                Program Length
                              </th>
                               <th>
                                Program Discipline
                              </th>
                              
                              <th>
                                Tuition Fee
                              </th>
                           <?php } if ($this->session->companey_id!='67') { ?>
                               <th>
                                Offer letter fee
                              </th>
                                Application URL
                              </th>
                              <th>
                              <th>
                                Major
                              </th>
                              <th>
                                Username                                
                              </th>
                              <th>
                                Password
                              </th>
                           <?php } ?>
                              <th>
                                App status
                              </th>
                              <th>
                                App Fee
                              </th>
                           <?php if ($this->session->companey_id!='67') { ?>                              
                              <th>
                                Transcripts
                              </th>
                              <th>
                                LORs
                              </th>
                              <th>
                                SOP
                              </th>
                              <th>
                                CV                           
                              </th>                          
                              <th>
                                GRE/GMAT
                              </th>
                              <th>
                                TOEFL/IELTS /PTE
                              </th>
                           <?php } ?>
                              <th>
                                Remarks
                              </th>
                              <th>
                                Followup Comments
                              </th>
                              <th>
                                Actions
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if (!empty($institute_data)) {
                              foreach ($institute_data as $key => $value) { ?>
                                <tr>
                                    <td><?=$value['institute_name']?></td>
                                  <?php if ($this->session->companey_id=='67') { ?>
                                    <td><?php echo $value['course_name_str'];?></td>
                                    <td><?php foreach($level as $lvl){if($lvl->id==$value['p_lvl']){echo $lvl->level;}}?></td>
                                    <td><?php foreach($length as $lg){if($lg->id==$value['p_length']){echo $lg->length;}}?></td>
                                    <td><?php foreach($discipline as $dc){if($dc->id==$value['p_disc']){echo $dc->discipline;}}?></td>                                  

                                    <td><?=$value['t_fee']?></td>
                                  <?php
                                  }
                                  ?>
                                 <?php if ($this->session->companey_id!='67') { ?>
                                    <td><?=$value['ol_fee']?></td>                                    
                                    <td><?=$value['application_url']?></td>
                                    <td><?=$value['major']?></td>
                                    <td><?=$value['user_name']?></td>
                                    <td><?=$value['password']?></td>
                                 <?php } ?>
                                    <td><?=$value['app_status_title']?></td>
                                    <td><?=$value['app_fee']?></td>
                                 <?php if ($this->session->companey_id!='67') { ?>
                                    <td><?=$value['transcript']?></td>
                                    <td><?=$value['lors']?></td>
                                    <td><?=$value['sop']?></td>
                                    <td><?=$value['cv']?></td>
                                    <td><?=$value['gre_gmt']?></td>
                                    <td><?=$value['toefl']?></td>
                                 <?php } ?>
                                    <td><?=$value['remark']?></td>
                                    <td><?=$value['followup_comment']?></td>
                                    <td>
                                      <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_institute(<?=$value['id']?>)"><i class="fa fa-trash" ></i></a>
                                      <a href="javascript:void(0)" class="btn btn-primary btn-sm " onclick="open_institute_modal(<?=$value['id']?>)"><i class="fa fa-pencil" ></i></a>
                                    </td>
                                </tr>                                
                              <?php
                              }
                            }else{ ?>
                              <tr style="text-align: center;">
                                <td colspan=16>No record found</td>
                              </tr>
                              <?php
                            }
                            ?>
                          </tbody>
                            
                        </table>
                     </div>


                  <div class="card card-body">
                    <?php echo form_open_multipart('enquiry/add_enquery_institute/'.base64_encode($details->Enquery_id),array('class'=>"form-inner",'id'=>'add_institute_form')) ?>                      
                      <div class="row">                                          
                       <div class="form-group col-sm-4"> 
                          <label>Institute Name <i class="text-danger">*</i></label>
                          <select class="form-control" name='institute_id' id='institute_id' required>
                          <option value="">Please Select</option>
              <?php
                          if(!empty($institute_list)){
                            foreach ($institute_list as $key => $value) { ?>
                              <option value="<?=$value->institute_id?>"><?=$value->institute_name?></option>
                            <?php
                            }
                          }
                          ?>
                          </select>                        
                       </div>
 
<?php if ($this->session->companey_id=='67') { ?>

<div class="form-group col-sm-4">                         
                          <label><?php echo display('program_discipline')?> </label>                          
                          <select name="p_disc" id="p_disc" class="form-control" onchange="">
                  <option value="">Select</option>
                             <?php foreach($discipline as $dc){ ?>                                   
                        <option value="<?php echo $dc->id; ?>"><?php echo $dc->discipline; ?></option>
                    <?php } ?>
                    </select>               
                          </select>                          
</div>
<div class="form-group col-sm-4">                         
                          <label>Program Lavel </label>                          
                          <select name="p_lvl" id="p_lvl" class="form-control" onchange="find_level()">
                  <option value="">Select</option>
                             <?php foreach($level as $lc){ ?>                                   
                        <option value="<?php echo $lc->id; ?>"><?php echo $lc->level; ?></option>
                    <?php } ?>                
                          </select>                          
</div>
<div class="form-group col-sm-4">                         
                          <label>Program Length </label>                          
                          <select name="p_length" id="p_length" class="form-control" onchange="find_app_crs()">
                
                          </select>                          
</div>

<div class="form-group col-sm-4"> 
                        
                          <label>Select Course </label>                          
                          <select name="app_course" id="app_course" class="form-control">
                                                     
                          </select>                          
                       </div>

<div class="form-group col-sm-4"> 
                          <label>Tuition fee</label>
                          <input class="form-control" name="t_fee" type="text" placeholder="Tuition fee" >  
</div>
<!-- <div class="form-group col-sm-4"> 
                          <label>Offer letter fee</label>
                          <input class="form-control" name="ol_fee" type="text" placeholder="O.letter fee" >  
</div> -->
<?php } ?>             
<?php if ($this->session->companey_id!='67') { ?>
                       <div class="form-group col-sm-4"> 
                          <label>Application URL </label>
                          <input class="form-control" name="application_url" type="text" placeholder="Application Url" >  
                       </div>
                       <div class="form-group col-sm-4"> 
                          <label>Major </label>
                          <input class="form-control" name="major" type="text" placeholder="Major" >  
                       </div>
            
                       <div class="form-group col-sm-4"> 
                          <label>User Name </label>
                          <input class="form-control" name="username" type="text" placeholder="Username" >  
                       </div>
                                                               
                       <div class="form-group col-sm-4"> 
                          <label>Password </label>
                          <input class="form-control" name="password" type="text" placeholder="Password" >  
                       </div>
<?php } ?>
                       <div class="form-group col-sm-4"> 
                        
                          <label>App Status </label>                          
                          <select name="app_status" class="form-control" >
                          <?php                                                    
                          if (!empty($institute_app_status)) {
                            foreach ($institute_app_status as $key => $value) {
                              ?>
                              <option value="<?=$value['id']?>"><?=$value['title']?></option>
                              <?php
                            }
                          }
                          ?>                            
                          </select>                          
                       </div>
                     
                       <div class="form-group col-sm-4"> 
                          <label>App Fee </label>
                          <input class="form-control" name="app_fee" type="text" placeholder="App Fee" >  
                       </div>
                      
                      <?php if ($this->session->companey_id!='67') { ?>
                      
                       <div class="form-group col-sm-4"> 
                          <label>Transcript </label>
                          <input class="form-control" name="transcript" type="text" placeholder="Transcript" >  
                       </div>

                       <div class="form-group col-sm-4"> 
                          <label>LORs </label>
                          <input class="form-control" name="lors" type="text" placeholder="Lors" >  
                       </div>
                      
                       <div class="form-group col-sm-4"> 
                          <label>SOP </label>
                          <input class="form-control" name="sop" type="text" placeholder="SOP" >  
                       </div>

                                                             
                       <div class="form-group col-sm-4"> 
                          <label>CV </label>
                          <input class="form-control" name="cv" type="text" placeholder="cv" >  
                       </div>

                       <div class="form-group col-sm-4"> 
                          <label>GRE/GMAT </label>
                          <input class="form-control" name="gre_gmt" type="text" placeholder="GRE/GMAT" >  
                       </div>
                      
                       <div class="form-group col-sm-4"> 
                          <label>TOEFL/IELTS/PTS </label>
                          <input class="form-control" name="tofel_ielts_pts" type="text" placeholder="TOEFL/IELTS/PTS" >  
                       </div>
<?php } ?>

                                                              
                       <div class="form-group col-sm-4"> 
                          <label>Remarks </label>
                          <textarea class="form-control" placeholder="Remark" name="remark"></textarea>
                       </div>

                       <div class="form-group col-sm-4"> 
                          <label>Followup Comments </label>
                          <textarea class="form-control" placeholder="Followup comments" name="followup_comment"></textarea>
                       </div>
                     
 <?php if ($this->session->companey_id!='67') { ?>                        
                       <div class="form-group col-sm-4"> 
                          <label>Reference No </label>
                          <input class="form-control" name="reference_no" type="text" placeholder="Reference No" >  
                       </div>
                                                           
                       <div class="form-group col-sm-4"> 
                          <label>Courier Status </label>
                          <input class="form-control" name="courier_status" type="text" placeholder="Courier Status" >  
                       </div>
 <?php } ?>
                     </div>                                     
                       <br>
                           <div class=""  id="save_button">                                                
                              <div class="col-md-12">                                                
                                    <button class="btn btn-primary" type="submit" >Save</button>            
                              </div>
                            </div>
                       </form>
                    </div>                                                
               </div>

              <div class="tab-pane" id="personaltab">
                  <hr>
                  <?php echo form_open_multipart('client/updateclientpersonel/'.$details->enquiry_id,'class="form-inner"') ?>  
                  <input type="hidden" name="form" value="client">
                    <!--------------------------------------------------start----------------------------->
                    <?php if(!empty($personel_list)){ ?>
                    <?php foreach($personel_list as $alldetails){ ?>
                        <input class="form-control" name="unique_number" type="hidden" value="<?php echo $alldetails->unique_number; ?>">                      
                     <div class="form-group col-sm-4"> 
                        <label>Date of Birth</label>
                        <input class="form-control" name="date_of_birth" type="date" value="<?php echo $alldetails->date_of_birth; ?>" style="padding:0px !important;">  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Marital status</label>
                        <select class="form-control" name="marital_status" id="marital_status">
                            <option value="">-Select Marital Status-</option>
                            <option value="Single" <?php if(!empty($personel_list)){if($alldetails->marital_status=='Single'){echo 'selected';}} ?>>Single</option>
                            <option value="Married" <?php if(!empty($personel_list)){if($alldetails->marital_status=='Married'){echo 'selected';}} ?>>Married</option>
                            <option value="Widowed" <?php if(!empty($personel_list)){if($alldetails->marital_status=='Widowed'){echo 'selected';}} ?>>Widowed</option>
                            <option value="Separated" <?php if(!empty($personel_list)){if($alldetails->marital_status=='Separated'){echo 'selected';}} ?>>Separated</option>
                            <option value="Divorced" <?php if(!empty($personel_list)){if($alldetails->marital_status=='Divorced'){echo 'selected';}} ?>>Divorced</option>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Last Communication</label>
                        <input class="form-control" name="last_comm" type="date" value="<?php echo $alldetails->last_comm; ?>" style="padding:0px !important;">  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Mode Of Communication</label>
                        <input class="form-control" name="mode_of_comm" type="text" value="<?php echo $alldetails->mode_of_comm; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Remark</label>
                        <input class="form-control" name="remark" type="text" value="<?php echo $alldetails->remark; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Mother Toung</label>
                        <input class="form-control" name="mother_tongue" type="text" value="<?php echo $alldetails->mother_tongue; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Other Language</label>
                        <input class="form-control" name="other_language" type="text" value="<?php echo $alldetails->other_language; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 1</label>
                        <input class="form-control" name="corres_add_line1" type="text" value="<?php echo $alldetails->corres_add_line1; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 2</label>
                        <input class="form-control" name="corres_add_line2" type="text" value="<?php echo $alldetails->corres_add_line2; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 3</label>
                        <input class="form-control" name="corres_add_line3" type="text" value="<?php echo $alldetails->corres_add_line3; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Country</label>
                        <select class="form-control" name="corres_country_id" id="country_id" onchange="find_state()">
                            <option value="">-Select Country-</option>
                            <?php foreach($allcountry_list as $country){ ?>
                            <option value="<?php echo $country->id_c; ?> " <?php if(!empty($allcountry_list)){if($alldetails->corres_country_id==$country->id_c){echo 'selected';}} ?>><?php echo $country->country_name; ?> </option>
                            <?php } ?>
                        </select>


                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence State</label>
                        <select class="form-control" name="corres_state_id" id="state_id">
                            <option value="">-Select State-</option>
                            <?php foreach($allstate_list as $state){ ?>
                            <option value="<?php echo $state->id; ?> " <?php if(!empty($allstate_list)){if($alldetails->corres_state_id==$state->id){echo 'selected';}} ?>><?php echo $state->state; ?> </option>
                            <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence District</label>
                        <select class="form-control" name="corres_district_id" id="corres_district_id">
                            <option value="">-Select District-</option>
                            <?php foreach($allcity_list as $city){ ?>
                            <option value="<?php echo $city->id; ?> " <?php if(!empty($allcity_list)){if($alldetails->corres_district_id==$city->id){echo 'selected';}} ?>><?php echo $city->city; ?> </option>
                            <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Pincode</label>
                        <input class="form-control" name="corres_pincode" type="text" value="<?php echo $alldetails->corres_pincode; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Landmark</label>
                        <input class="form-control" name="corres_landmark" type="text" value="<?php echo $alldetails->corres_landmark; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 1</label>
                        <input class="form-control" name="perm_add_line1" type="text" value="<?php echo $alldetails->perm_add_line1; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 2</label>
                        <input class="form-control" name="perm_add_line2" type="text" value="<?php echo $alldetails->perm_add_line2; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 3</label>
                        <input class="form-control" name="perm_add_line3" type="text" value="<?php echo $alldetails->perm_add_line3; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Country</label>
                        <select class="form-control" name="perm_country_id" id="perm_country_id">
                            <option value="">-Select Country-</option>
                            <?php foreach($allcountry_list as $country){ ?>
                            <option value="<?php echo $country->id_c; ?> " <?php if(!empty($allcountry_list)){if($alldetails->perm_country_id==$country->id_c){echo 'selected';}} ?>><?php echo $country->country_name; ?> </option>
                            <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent State</label>
                      <select class="form-control" name="perm_state_id" id="perm_state_id">
                          <option value="">-Select State-</option>
                          <?php foreach($allstate_list as $state){ ?>
                          <option value="<?php echo $state->id; ?> " <?php if(!empty($allstate_list)){if($alldetails->perm_state_id==$state->id){echo 'selected';}} ?>><?php echo $state->state; ?> </option>
                          <?php } ?>
                      </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent District</label>
                        <select class="form-control" name="perm_district_id" id="perm_district_id">
                            <option value="">-Select District-</option>
                            <?php foreach($allcity_list as $city){ ?>
                            <option value="<?php echo $city->id; ?> " <?php if(!empty($allcity_list)){if($alldetails->perm_district_id==$city->id){echo 'selected';}} ?>><?php echo $city->city; ?> </option>
                            <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Pincode</label>
                        <input class="form-control" name="perm_pincode" type="text" value="<?php echo $alldetails->perm_pincode; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Landmark</label>
                        <input class="form-control" name="perm_landmark" type="text" value="<?php echo $alldetails->perm_landmark; ?>" >  
                     </div>
                      <?php } ?>
                      <?php }else{ ?>
                      <!-----------------------------------------------start-------------------------------------------->
                       <input class="form-control" name="unique_number" type="hidden" value="">  
                    
                     <div class="form-group col-sm-4"> 
                        <label>Date of Birth</label>
                        <input class="form-control" name="date_of_birth" type="date" value="" style="padding:0px !important;">  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Marital status</label>
                        <select class="form-control" name="marital_status" id="marital_status">
                            <option value="">-Select Marital Status-</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Separated">Separated</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Last Communication</label>
                        <input class="form-control" name="last_comm" type="date" value="" style="padding:0px !important;">  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Mode Of Communication</label>
                        <input class="form-control" name="mode_of_comm" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Remark</label>
                        <input class="form-control" name="remark" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Mother Toung</label>
                        <input class="form-control" name="mother_tongue" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Other Language</label>
                        <input class="form-control" name="other_language" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 1</label>
                        <input class="form-control" name="corres_add_line1" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 2</label>
                        <input class="form-control" name="corres_add_line2" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 3</label>
                        <input class="form-control" name="corres_add_line3" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Country</label>
                        <select class="form-control" name="corres_country_id" id="corres_country_id1">
                          <option value="">-Select Country-</option>
                          <?php foreach($allcountry_list as $country){ ?>
                          <option value="<?php echo $country->id_c; ?> "><?php echo $country->country_name; ?> </option>
                          <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence State</label>
                        <select class="form-control" name="corres_state_id" id="corres_state_id1">
                            <option value="">-Select State-</option>
                            <?php foreach($allstate_list as $state){ ?>
                            <option value="<?php echo $state->id; ?> "><?php echo $state->state; ?> </option>
                            <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence District</label>
                        <select class="form-control" name="corres_district_id" id="corres_district_id">
                            <option value="">-Select District-</option>
                            <?php foreach($allcity_list as $city){ ?>
                            <option value="<?php echo $city->id; ?> "><?php echo $city->city; ?> </option>
                            <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Pincode</label>
                        <input class="form-control" name="corres_pincode" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Landmark</label>
                        <input class="form-control" name="corres_landmark" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 1</label>
                        <input class="form-control" name="perm_add_line1" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 2</label>
                        <input class="form-control" name="perm_add_line2" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 3</label>
                        <input class="form-control" name="perm_add_line3" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Country</label>
                        <select class="form-control" name="perm_country_id" id="perm_country_id">
                            <option value="">-Select Country-</option>
                            <?php foreach($allcountry_list as $country){ ?>
                            <option value="<?php echo $country->id_c; ?> "><?php echo $country->country_name; ?> </option>
                            <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent State</label>
                        <select class="form-control" name="perm_state_id" id="perm_state_id">
                            <option value="">-Select State-</option>
                            <?php foreach($allstate_list as $state){ ?>
                            <option value="<?php echo $state->id; ?> "><?php echo $state->state; ?> </option>
                            <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent District</label>
                        <select class="form-control" name="perm_district_id" id="perm_district_id">
                            <option value="">-Select District-</option>
                            <?php foreach($allcity_list as $city){ ?>
                            <option value="<?php echo $city->id; ?>"><?php echo $city->city; ?> </option>
                            <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Pincode</label>
                        <input class="form-control" name="perm_pincode" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Landmark</label>
                        <input class="form-control" name="perm_landmark" type="text" value="" >  
                     </div>
                     <?php } ?>
                     <div class="col-md-6"  id="save_button">
                        <div class="row">
                           <div class="col-md-12">                                                
                              <button class="btn btn-primary" type="submit" >Save</button>            
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
               <!--<div class="tab-pane" id="kyctab">
                  <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>Document Name</th>
                              <th>Document Number</th>
                              <th>Valid Up To</th>
                              <th>Created On</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($kyc_doc_list)){
                              foreach ($kyc_doc_list as $kycDoc) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $kycDoc->doc_name; ?></td>
                              <td><?php echo $kycDoc->doc_number; ?></td>
                              <td><?php echo ($kycDoc->doc_validity !='')?$kycDoc->doc_validity:'N/A'; ?></td>
                              <td><?php echo $kycDoc->created_date; ?></td>
                              <td><a href="<?php echo base_url($kycDoc->doc_file);?>" target="_blank"><i class="fa fa-eye" style="color:green;"></i></a></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewKyc" class="btn btn-primary">Add new</a></h5>
                     </center>
                     <br>              
                  </div>
               </div>
               <div class="tab-pane" id="workhistorytab">
                  <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>Company Name</th>
                              <th>Designation</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Current CTC <small>(Lac)</small></th>
                              <th>Created On</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($work_history_list)){
                              foreach ($work_history_list as $itemObj) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $itemObj->company; ?></td>
                              <td><?php echo $itemObj->designation; ?></td>
                              <td><?php echo date('d-m-Y',strtotime($itemObj->start_date)); ?></td>
                              <td><?php echo date('d-m-Y',strtotime($itemObj->end_date)); ?></td>
                              <td><?php echo $itemObj->current_ctc; ?></td>
                              <td><?php echo $itemObj->created_date; ?></td>
                              <td></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewWork" class="btn btn-primary">Add new</a></h5>
                     </center>
                     <br>              
                  </div>
               </div>
               <div class="tab-pane" id="educationtab">
                  <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>Title</th>
                              <th>University</th>
                              <th>Year of Passing</th>
                              <th>Created On</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($education_list)){
                              foreach ($education_list as $itemObj) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $itemObj->title; ?></td>
                              <td><?php echo $itemObj->university; ?></td>
                              <td><?php echo $itemObj->passing_year; ?></td>
                              <td><?php echo $itemObj->created_date; ?></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewEducation" class="btn btn-primary">Add new</a></h5>
                     </center>
                     <br>              
                  </div>
               </div>
                <div class="tab-pane" id="socialprofiletab">
                  <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>Social Media</th>
                              <th>Profile URL</th>
                              <th>Created On</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($social_profile_list)){
                              foreach ($social_profile_list as $itemObj) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $itemObj->title; ?></td>
                              <td><?php echo $itemObj->profile; ?></td>
                              <td><?php echo $itemObj->created_date; ?></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewSprofile" class="btn btn-primary">Add new</a></h5>
                     </center>
                     <br>              
                  </div>
               </div>
                <div class="tab-pane" id="travelhistorytab">
                  <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>County</th>
                              <th>Travel Date</th>
                              <th>Visa Type</th>
                              <th>Visa Duration</th>
                              <th>Is Rejected</th>
                              <th>Created On</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($travel_history_list)){
                              foreach ($travel_history_list as $itemObj) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $itemObj->country_name; ?></td>
                              <td><?php echo date('d-m-Y',strtotime($itemObj->travel_date)); ?></td>
                              <td><?php echo $itemObj->visa_type; ?></td>
                              <td><?php echo date('d-m-Y',strtotime($itemObj->dfrom_date)).'-'.date('d-m-Y',strtotime($itemObj->dto_date)); ?></td>
                              <td><?php echo ($itemObj->is_rejected ==1)?'Yes':'No'; ?></td>
                              <td><?php echo $itemObj->created_date; ?></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewTravel" class="btn btn-primary">Add new</a></h5>
                     </center>
                     <br>              
                  </div>
               </div> 
                <div class="tab-pane" id="familydetailtab">
                  <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Email</th>
                              <th>County</th>
                              <th>relationship</th>
                              <th>Visa Status</th>
                              <th>They Help</th>
                              <th>Created On</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($close_femily_list)){
                              foreach ($close_femily_list as $itemObj) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $itemObj->name; ?></td>
                              <td><?php echo $itemObj->contact_number; ?></td>
                              <td><?php echo $itemObj->contact_email; ?></td>
                              <td><?php echo $itemObj->country_name; ?></td>
                              <td><?php echo $itemObj->relationship; ?></td>
                              <td><?php echo ($itemObj->visa_status ==1)?'Valid':'Expired'; ?></td>
                              <td><?php echo ($itemObj->they_help ==1)?'Yes':'No'; ?></td>
                              <td><?php echo $itemObj->created_date; ?></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewMember" class="btn btn-primary">Add new</a></h5>
                     </center>
                     <br>              
                  </div>
               </div>-->
              <?php  if (user_access('630')===true) { ?>
               <div class="tab-pane" id="task">
                   <hr>
                <div   style="overflow-x: hidden;overflow-y: auto;" onscroll="scrolled(this)">
                  <link href="<?php echo base_url();?>assets/css/fullcalendar.min.css" rel="stylesheet">
                  <link href="<?php echo base_url();?>assets/css/fullcalendar.print.min.css" media="print">
                  <div id="calendar" style="margin-left:20px;"></div>
               </div>
                  <hr>
                  <div class="col-md-12" style="border:none!important;border-radius:0px!important;">
                     <div  style="overflow-x: hidden;overflow-y: auto;" onscroll="scrolled(this)">
                        <!----------------- Calender View ------------>
                        <link href="<?php echo base_url();?>assets/css/fullcalendar.min.css" rel="stylesheet">
                        <link href="<?php echo base_url();?>assets/css/fullcalendar.print.min.css" media="print">
                        <div id="calendar4"></div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="col-md-6" style="display: none;">
                           <div class="card"   style="margin-top:10px;">
                              <div class="card-body">   
                                 <span style="font-size: 14px;font-weight: bold;">
                                 Enquiry Details: 
                                 </span>
                                 <button class="btn btn-sm btn-primary" style="float: right"  type="button" data-toggle="modal" data-target="#Coment">
                                 <i class="fa fa-dot-circle-o"></i> Add Comment</button>                    
                              </div>
                           </div>
                           <div id="comment_div" style="max-height:300px; overflow-y:scroll;">
                              <?php 
                                 if(!empty($comment_details)){               
                                     foreach ($comment_details as $ld_res) 
                                 {?>
                              <div class="list-group"  style="margin-top:10px;">
                                 <a class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                       <p class="mb-1"><?= $ld_res->comment_msg?></p>
                                       <small><b><?php echo date("j-M-Y h:i:s a",strtotime($ld_res->created_date)); ?></b></small>
                                    </div>
                                 </a>
                              </div>
                              <?php } }?>
                           </div>
                           <div  id="comment_div1" style="display:none;">
                           </div>
                        </div>
                        <div class="col-md-12" >
                           <div class=" card"  style="margin-top:10px;">
                              <div class="card-body">   
                                 <span style="font-size: 14px;font-weight: bold;">
                                 Task Details:
                                 </span>
                                 <button class="btn btn-sm btn-primary" style="float: right"  type="button" data-toggle="modal" data-target="#createTask">
                                 <i class="fa fa-dot-circle-o"></i> Create Task</button> 
                              </div>
                           </div>
                           <div  id="task_div" class='card' style="max-height:300px; overflow-y:scroll;margin-top:10px;">
                              <?php 
                                 foreach ($recent_tasks as $task)
                                 {?>
                              <div class="list-group">
                                 <div class="col-md-12 list-group-item list-group-item-action flex-column align-items-start" style="margin-top:10px;">
                                    <div class="d-flex w-100 justify-content-between">
                                       
                                       <div class="col-md-12">
                                          <b>Subject :</b>
                                          <?=$task->subject?>
                                        </div>                                      
                                     
                                       
                                       <div class="col-md-12">
                                            <b>Remark  : </b>
                                            <?= $task->task_remark?>
                                        </div>
                                       
                                       <div class="col-md-12">
                                          <b>Task Date  : </b>
                                          <?php echo date("d-m-Y",strtotime($task->task_date)); ?>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <b>Task Time  : </b>
                                            <?php echo $task->task_time; ?>
                                        </div>

                                        <div class="col-md-12">
                                          <a href='' class="fa fa-pencil btn btn-primary btn-sm" style="float:right;" data-toggle="modal" data-target="#task_edit" title='Edit Task' onclick="get_modal_content(<?=$task->resp_id?>)"></a>
                                          <?php
                                          if(user_access(92)){ ?>
                                            <i class="fa fa-trash btn btn-danger btn-sm" style="float:right;" onclick="delete_row(<?=$task->resp_id?>)"title='Delete Task'></i>&nbsp;&nbsp;&nbsp;
                                          <?php
                                          }
                                          ?>

                                       </div>
                                    </div>
                                 </div> 
                                 </div>                                
                              <?php } ?>
                           </div>
                           <div class="list-group" id="task_div1" style="display:none;">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>  
               <?php }?>             
               <div class="tab-pane" id="contacts">
                  <hr>
                  <div class="row">
                     <table id="dataTable" class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>
                              <th>#</th>
                              <th style="width: 20%;">Designation</th>
                              <th style="width: 20%;">Name</th>
                              <th style="width: 20%;">Contact Number</th>
                              <th style="width: 20%;">Email ID</th>
                              <th style="width: 20%;">Other Detail</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody id="tblDataContact">
                           <?php $sl = 1;
                              if(!empty($all_contact_list)){
                              foreach ($all_contact_list as $contact) { 
                              ?>
                           <tr>
                              <td>#</td>
                              <td ><?php echo $contact->designation; ?></td>
                              <td ><?php echo $contact->c_name; ?></td>
                              <td ><?php echo $contact->contact_number; ?></td>
                              <td ><?php echo $contact->emailid; ?></td>
                              <td ><?php echo $contact->other_detail; ?></td>
                              <td></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewContact" class="btn btn-primary">Add new contact</a></h5>
                     </center>
                     <br>              
                  </div>
               </div>


               <?php
               if(!empty($tab_list)){
                foreach ($tab_list as $key => $value) { ?>
                  <div class="tab-pane" id="<?=str_replace(' ', '_', $value['title'])?>">
                  <?php
                  if ($value['id'] != 1) {
                    echo tab_content($value['id'],$this->session->companey_id,$enquiry_id,str_replace(' ', '_', $value['title'])); 
                  }
                  ?>
                  </div>
                  <?php
                }
              }
              ?>
        <?php include('tab_family.php'); ?>
        <?php 
          if (user_access('580')===true) {
              include('tab_payment.php'); } ?>
        <?php   if (user_access('590')===true) { include('tab_refund.php'); } ?>
        <?php   if (user_access('643')===true) { include('tab_urls.php'); } ?>
        <?php // include('tab_aggriment.php'); ?>
        <?php   if (user_access('600')===true) { include('tab_aggriment_new.php'); } ?>
        <?php   if (user_access('610')===true) { include('tab_document_new.php');  } ?>
           <?php
         if (user_access('550')===true) {
        ?>
        <?php include('tab_education.php'); ?>
        <?php } ?>
        <?php   if (user_access('540')===true) { include('tab_qualification.php'); } ?>
        <?php   if (user_access('640')===true) { include('tab_login_trail.php');  } ?>
        <?php   if (user_access('560')===true) { include('tab_jobdetail.php'); } ?>
        <?php   if (user_access('570')===true) { include('tab_experience.php'); } ?>
        <?php   if (user_access('620')===true) { include('tab_ticket.php');} ?>
            </div>
      </div>
      </div>
      <div class="col-md-3 col-xs-12 col-sm-12 col-height timeline">
        <!--<h3 class="text-center">Activity Timeline</h3><hr>-->
        <div id="exTab4" class="">
            <ul  class="nav nav-tabs hideScroll tscroll" role="tablist" style="margin-top: 18px;">  
                <span style="position: absolute; left: 0; font-size: 22px; line-height: 40px; z-index: 999"><i class="fa fa-caret-left" onclick="tabScrollt('left')"></i></span> 

          <li class="active" style="background:#34495e;"><a  href="#others" data-toggle="tab" style="padding: 10px 10px; ">Activity</a></li> 
          <li style="background:#0382ae;"><a href="#tsms" data-toggle="tab" onclick="findtimline('2')" style="padding: 10px 10px;">SMS</a></li>        
          <li style="background:#0fda02;"><a href="#twhatsapp" data-toggle="tab" onclick="findtimline('1')" style="padding: 10px 10px;">Whatsapp</a></li>
          <li style="background:#a92e3f;"><a href="#temail" data-toggle="tab" onclick="findtimline('3')" style="padding: 10px 10px;">Emails</a></li>

                <span style="position: absolute; right: 0; font-size: 22px; line-height: 40px; z-index: 999"><i class="fa fa-caret-right"  onclick="tabScrollt('right')"></i></span>
            </ul>
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="others">
                  <div class="activitytimelinediv"></div>
                </div>

                <div class="tab-pane" id="tsms">
                  <div class="activitytimelinedivsms"></div>
                </div>

                <div class="tab-pane" id="twhatsapp">
                  <div class="activitytimelinedivwhatsapp"></div>
                </div>

                <div class="tab-pane" id="temail">
                  <div class="activitytimelinedivemail"></div>
                </div>
            </div>
      </div>          
      </div>

      <i class="fa fa-angle-right btn btn-secondary btn-sm" id="toggle_timeline" data-vis="1"></i>      
      <style>
         #exTab3 .nav-tabs > li > a {
         border-radius: 4px 4px 0 0 ;
         }
         #exTab3 .tab-content {
         /*color : white;*/
         background-color: #fff;
         padding : 5px 15px;
         }
         #exTab4 .nav-tabs > li > a {
         border-radius: 4px 4px 0 0 ;
         }
         #exTab4 .tab-content {
         /*color : white;*/
         background-color: #fff;
         padding : 5px 15px;
         }
         .card {
         position: relative;
         display: -ms-flexbox;
         display: flex;
         -ms-flex-direction: column;
         flex-direction: column;
         min-width: 0;
         word-wrap: break-word;
         /*background-color: #fff;*/
         background-clip: border-box;
         border: 1px solid #c8ced3;
         border-radius: 0.25rem;
         }
         .card-body {
         -ms-flex: 1 1 auto;
         flex: 1 1 auto;
         padding: 1.25rem;
         }
         .list-group {
         display: -ms-flexbox;
         display: flex;
         -ms-flex-direction: column;
         flex-direction: column;
         padding-left: 0;
         margin-bottom: 0;
         }
         .list-group-item {
         position: relative;
         display: block;
         padding: 0.75rem 1.25rem;
         margin-bottom: -1px;
         background-color: #fff;
         border: 1px solid rgba(0, 0, 0, 0.125);
         }
         .list-group-item-action {
         width: 100%;
         color: #5c6873;
         text-align: inherit;
         }
      </style>
 <div id="createnewKyc" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New KYC</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewkyc/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>Document Name</label>
                  <input class="form-control" id="doc_name" name="doc_name" placeholder="Document Name"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Document No.</label>
                  <input class="form-control" id="doc_number" name="doc_number" placeholder="Document No."  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Upload File</label>
                  <input class="form-control" name="doc_file" id="doc_file" placeholder="Upload File"  type="file" >
               </div>
                <div class="form-group col-md-6">
                  <label>Valid Up To</label>
                  <input class="datepicker form-control" id="doc_validity" name="doc_validity" placeholder="Valid Up To"  type="text" >
               </div>
                <input type="hidden" id="kyc_unique_number" name="unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="kyc_enquiry_id" name="kyc_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="createnewWork" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Work History</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewwork/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>Company Name</label>
                  <input class="form-control" id="company" name="company" placeholder="Company Name"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Designation</label>
                  <input class="form-control" id="designation" name="designation" placeholder="Designation"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Start Date</label>
                  <input class="datepicker form-control" id="start_date" name="start_date" placeholder="Start Date"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>End Date</label>
                  <input class="datepicker form-control" id="end_date" name="end_date" placeholder="End Date"  type="text">
               </div>
                <div class="form-group col-md-6">
                  <label>Current CTC <small>(In Lac)</small></label>
                  <input class="form-control" id="current_ctc" name="current_ctc" placeholder="Current CTC"  type="text">
               </div>
                <input type="hidden" id="work_unique_number" name="work_unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="work_enquiry_id" name="work_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>

</div>
<button type="button" data-toggle="modal" data-target="#edit-institute-frm" id='institute_modal_btn' style="visibility: hidden;">  
</button>
<div id="edit-institute-frm" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Institute</h4>
         </div>
         <div class="modal-body" id="edit-institute-content">
            
         </div>
      </div>
   </div>


</div>
<!-- comission -->
<button type="button" data-toggle="modal" data-target="#edit-comission-frm" id='comission_modal_btn' style="visibility: hidden;">  
</button>
<div id="edit-comission-frm" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update</h4>
         </div>
         <div class="modal-body" id="edit-comission-content">
            
         </div>
      </div>
   </div>


</div>
<!-- END -->
<div id="createnewEducation" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Education</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewedu/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>Title of Education</label>
                  <input class="form-control" id="title" name="title" placeholder="Title of Education"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>University Name</label>
                  <input class="form-control" id="university" name="university" placeholder="University Name"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Year of Passing</label>
                  <input class="form-control" id="passing_year" name="passing_year" placeholder="Year of Passing"  type="text"  required>
                </div>
                <input type="hidden" id="edu_unique_number" name="edu_unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="edu_enquiry_id" name="edu_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="createnewSprofile" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Social Profile</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewsprof/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>Name of Social Media</label>
                  <input class="form-control" id="title" name="title" placeholder="Name of Social Media"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Profile URL</label>
                  <input class="form-control" id="profile" name="profile" placeholder="Profile URL"  type="text"  required>
               </div>
                <input type="hidden" id="sprof_unique_number" name="sprof_unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="sprof_enquiry_id" name="sprof_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="createnewTravel" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Travel History</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewtravel/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>County</label>
                  <select name="country_id" class="form-control">
                    <?php foreach($all_country_list as $product){?>
                    <option value="<?=$product->id_c ?>"><?=$product->country_name ?></option>
                    <?php } ?>
                 </select>
               </div>                
               <div class="form-group col-md-6">
                  <label>Travel Date</label>
                  <input class="datepicker form-control" id="travel_date" name="travel_date" placeholder="Travel Date"  type="date" style="padding-top:0px;"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Visa Type</label>
                  <input class="form-control" id="visa_type" name="visa_type" placeholder="Visa Type"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>From Date</label>
                  <input class="datepicker form-control" id="dfrom_date" name="dfrom_date" placeholder="From Date"  type="date" style="padding-top:0px;"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>To Date</label>
                  <input class="datepicker form-control" id="dto_date" name="dto_date" placeholder="To Date"  type="date" style="padding-top:0px;"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Is Rejected</label>
                  <select name="is_rejected" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0" selected>No</option>
                  </select>
               </div>
                <div class="form-group col-md-6">
                  <label>Reject Remark</label>
                  <input class="form-control" id="reject_reason" name="reject_reason" placeholder="Reject Remark"  type="text">
               </div>
                <input type="hidden" id="travel_unique_number" name="travel_unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="travel_enquiry_id" name="travel_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="createnewMember" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Member</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewmember/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>County</label>
                  <select name="country_id" class="form-control">
                    <?php foreach($all_country_list as $product){?>
                    <option value="<?=$product->id_c ?>"><?=$product->country_name ?></option>
                    <?php } ?>
                 </select>
               </div>
                <div class="form-group col-md-6">
                  <label>Name</label>
                  <input class="form-control" id="name" name="name" placeholder="Name"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Contact Number</label>
                  <input class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Contact Email</label>
                  <input class="form-control" id="contact_email" name="contact_email" placeholder="Contact Email"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Relationship</label>
                  <input class="form-control" id="relationship" name="relationship" placeholder="Relationship"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Visa Type</label>
                  <select name="visa_status" class="form-control">
                    <option value="1" selected>Valid</option>
                    <option value="0">Expired</option>
                  </select>
               </div>
               <div class="form-group col-md-6">
                  <label>They Help</label>
                  <select name="they_help" class="form-control">
                    <option value="0">No</option>
                    <option value="1" selected>Yes</option>
                  </select>
               </div>
                <input type="hidden" id="mem_unique_number" name="mem_unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="mem_enquiry_id" name="mem_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="createTicket<?php echo $details->enquiry_id;?>" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Ticket</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('ticket/addticket','class="form-inner"') ?> 
               <input class="form-control" name="clientid"  type="hidden" value="<?php echo $details->enquiry_id; ?>" required>
               <div class="form-group col-md-6">
                  <label>Name</label>
                  <input class="form-control" name="name" placeholder="Name"  type="text" value="<?php echo $details->name; ?>" required>
               </div>
               <div class="form-group col-md-6">
                  <label>Mobile No.</label>
                  <input class="form-control" name="mobile" placeholder="Mobile No."  type="text" value="<?php echo $details->phone; ?>"  maxlength='10' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
               </div>
               <div class="form-group col-md-6">
                  <label>Email</label>
                  <input class="form-control" name="email" placeholder="Email"  type="text" value="<?php echo $details->email; ?>">
               </div>
               <div class="form-group col-md-6">
                  <label>Address</label>
                  <input class="form-control" name="address" placeholder="Address"  type="text" value="<?php echo $details->address; ?>" required>
               </div>
               <div class="form-group col-md-6">
                  <label>Product</label>
                  <input class="form-control" name="product" placeholder="Product"  type="text" value="" required>
               </div>
               <div class="form-group col-md-6">
                  <label>Problem</label>
                  <select class="form-control" name="problem">
                     <option></option>
                     <?php foreach ($problems as $problem) { ?>
                     <option value="<?php echo $problem->tp_id; ?>"><?php echo $problem->problem_name; ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="form-group col-md-6">
                  <label>Priority</label>
                  <select class="form-control" name="priority">
                     <option></option>
                     <?php foreach ($ticketpriority as $priority) { ?>
                     <option value="<?php echo $priority->priority_id; ?>"><?php echo $priority->priority_name; ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="form-group col-md-6">
                  <label>Source</label>
                  <select class="form-control" name="source">
                     <option></option>
                     <?php foreach ($ticketsource as $tsource) { ?>
                     <option value="<?php echo $tsource->ts_id; ?>"><?php echo $tsource->ticket_source; ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="form-group col-md-6">
                  <label>Due Date</label>
                  <input class="form-control" name="due_date" placeholder="Due Date"  type="date" value="" required>
               </div>
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Add Ticket" class="btn btn-primary"  name="Add Ticket">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<div id="createnewContact" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Contact</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('client/create_newcontact/'.$details->enquiry_id.'/'.$details->Enquery_id,'class="form-inner"') ?> 
               <div class="form-group col-md-6">
                  <label>Designation</label>
                  <input class="form-control" name="designation" placeholder="Designation"  type="text" required>
               </div>
               <div class="form-group col-md-6">
                  <label>Name</label>
                  <input class="form-control" name="name" placeholder="Contact Name"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Contact No.</label>
                  <input class="form-control" name="mobileno" placeholder="Mobile No." maxlength="10"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Email</label>
                  <input class="form-control" name="email" placeholder="Email"  type="text"  required>
               </div>
               <div class="form-group col-md-12">
                  <label>Other Details</label>
                  <textarea class="form-control" name="otherdetails" rows="8"></textarea>
               </div>
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Add Contact" class="btn btn-primary"  name="Add Contact">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>     
      <!---- Create Task Start ---->
  <div id="createTask" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Task</h4>
         </div>
         <div class="modal-body">
            <?php echo form_open_multipart('lead/enquiry_response_task',array('class'=>"form-inner",'id'=>'task_form')) ?>
            <div class="profile-edit">
               <div class="form-group col-md-6">
        <label>Department</label>
        <select class="form-control"  name="branch_dept" id="find_branch_change" onchange="find_branch()">
            <option value="">Select department</option>
        <?php foreach ($all_department as $dept) { ?>
            <option value="<?php echo $dept->id; ?>" <?php if($dept->id == $this->session->dept_name){ echo "selected";} ?>><?=$dept->dept_name ?></option>
        <?php } ?>                                                      
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Branch Name</label>
        <select class="form-control"  name="branch_name" id="branch_select" onchange="find_users()">
         <?php foreach ($all_branch as $brnh) { ?>
                            <option value="<?php echo $brnh->id; ?>" <?php if($brnh->id == $this->session->branch_name){ echo "selected";} ?>>
                              <?=$brnh->b_name ?>                               
                            </option>
                            <?php 
                        } ?>                                                      
        </select>
    </div>    
            
            <div class="form-group col-md-12">  
            <label>Select Employee</label> 
            <div id="imgBack"></div>
            <select class="form-control"  name="assign_employee" id="select_user">                    
             <?php foreach ($user_list as $user) { 
                          if (!empty($user->user_permissions)) {
                            $module=explode(',',$user->user_permissions);
                          }                           
                            ?>
                            <option value="<?php echo $user->pk_i_admin_id; ?>">
                              <?=$user->s_display_name ?>&nbsp;<?=$user->last_name.' - '.$user->s_user_email; ?> (<?= $user->user_role ?>)                                
                            </option>
                            <?php 
                        } ?>                                                       
            </select> 
            </div>

                <div class="form-group col-sm-6" >
                  <label>Subject</label>
                  <input type="text" class="form-control" value="<?php if(!empty($details->subject)){echo $details->subject;} ?>" name="subject"  placeholder="Subject">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Name</label>
                  <input type="text" class="form-control" value="<?php if(!empty($details->name)){echo $details->name;} ?>" name="contact_person"  placeholder="Contact Person Name">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Designation</label>
                  <input type="text" class="form-control" name="designation" value="<?= isset($details->designation)?$details->designation:''?>" placeholder="Contact Person Designation">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Mobile No</label>
                  <input type="text" class="form-control" value="<?php if(!empty($details->phone)){echo $details->phone;} ?>" name="mobileno" placeholder="Mobile No">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Email</label>
                  <input type="text" class="form-control" value="<?php if(!empty($details->email)){echo $details->email;} ?>" name="email" placeholder="Email">
               </div>
               <div class="form-group col-sm-6" >
                  <label>Status</label>
                  <select class="form-control" name="task_status">
                     <?php foreach($taskstatus_list as $key=>$val){ ?>
                     <option value="<?php echo $val->taskstatus_id; ?>"><?php echo $val->taskstatus_name; ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="form-group col-sm-6">
                  <label>
                     Task Date <!-----Demo Plan Date--->
                  </label>
                  <input class="form-control" name="task_date"  type="date" placeholder="Task date" id="enq_task_date">
               </div>
               <div class="form-group col-sm-6">
                  <label>
                     Task Time <!-----Demo Plan Date--->
                  </label>
                  <input class="form-control " name="task_time"  type="time" value="" >
               </div>


               <div class="form-group col-sm-12">
                  <label>Remark Details</label>
                  <textarea class="form-control"   name="task_remark" placeholder="Conversaion Details"></textarea>
               </div>               
               <div class="form-group text-center">
                  <input type="hidden" name="enq_code"  value="<?php echo  $details->Enquery_id; ?>" >
                  <input type="hidden" name="task_type" value="1">
                  <input type="hidden" name="notification_id">
                  <input type="submit" name="update" id='submit_task_btn' class="btn btn-primary"  value="<?php echo display('create_Task');?>" >
               </div>
            </div>
            </form> 
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
      <!---- Create Task End ---->
      <div id="genLead" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <?php echo form_open_multipart('enquiry/move_to_lead_details','class="form-inner"') ?>
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Enter info and Move to Application</h4>
               </div>
               <div class="modal-body">
                  <!--<form method="post" action="">-->
                  <!--<?php //echo form_open_multipart('enquiry/move_to_lead','class="form-inner"') ?>   -->
                  <div class="row">
                     <div class="form-group col-sm-6">  
                        <label>Expected Closer Date <i class="text-danger">*</i></label>                  
                        <!-- <input class="form-control date2"  name="expected_date" type="date" placeholder="Expected Closer Date" required> -->
                        <input class="form-control"  name="expected_date" type="date" placeholder="Expected Closer Date" required>                
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
                     <div class="form-group col-md-6">
                        <label><?php echo display('lead_stage') ?> <i class="text-danger">*</i></label>                  
                        <select class="form-control" id="move_lead_stage_change" name="move_lead_stage" onchange="find_description1()" required>
                           <option value="">-- Select Application Stage --</option>
                              <?php foreach($all_estage_lists as $single){                               
                                  //$id=$single->lead_stage;                                                            
                                ?>                              
                                <option value="<?= $single->stg_id?>" <?php if ($single->stg_id == $details->lead_stage) {echo 'selected';}?>><?php echo $single->lead_stage_name; ?></option>
                                <?php } ?>                                        
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label><?php echo display('lead_description') ?></label>                  
                        <select class="form-control" name="lead_description" id="lead_description1">
                           <option value="">Application Description</option>
                          <?php foreach($all_description_lists as $discription){ ?>
                                   
                                   <option value="<?php echo $discription->id; ?>"><?php echo $discription->description; ?></option>
                                   <?php } ?>                                             
                        </select>
                     </div>
                     <div class="form-group col-sm-12">  
                        <label>Select Assign Employee</label> 
                        <select class="form-control"  name="assign_employee" id="select_assign_user">  
                        <option value="">---Select User---</option>                  
                        <?php foreach ($user_list as $user) { ?>
                            <option value="<?php echo $user->pk_i_admin_id; ?>">
                              <?=$user->s_display_name ?>&nbsp;<?=$user->last_name.' - '.$user->s_user_email; ?> (<?= $user->user_role ?>)                                
                            </option>
                            <?php 
                        } ?>                                                       
            </select>               
                     </div>
                     <div class="form-group col-sm-12">  
                        <label><?php echo display('comments') ?></label>                  
                        <input class="form-control" id="LastCommentGen" name="comment" type="text" placeholder="Enter comment">                
                     </div>
                     <!--<div class="form-group col-sm-4">  
                        <label><?php echo 'Applicant Portal'; ?></label>                  
                        <input class="form-control" name="portal" type="checkbox" value="1">                
                     </div>-->
                     <div class="col-md-6"  id="save_button">
                        <div class="row">
                           <div class="col-md-12">                                                
                              <button class="btn btn-primary" type="submit" >Save</button>            
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-6" id="curcit_add" style="display:none;">
                        <div class="col-12" >
                           <div class="row">
                              <div class="col-md-6">                                                
                                 <button class="btn btn-primary" type="submit" >Create Circuit Sheet</button>            
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-6" id="add_po" style="display:none;">
                        <div class="col-12" >
                           <div class="row">
                              <div class="col-md-12">                                                
                                 <button class="btn btn-primary" type="submit" >Attached Po</button>            
                              </div>
                           </div>
                        </div>
                     </div>
                     <input type="hidden" value="<?php echo $enquiry->enquiry_id;?>" name='enquiry_id'>
                  </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
<!--------------------for othe moves popup----------------->
<div id="genLeadother" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <?php echo form_open_multipart('lead/convert_to_lead','class="form-inner"') ?>
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Enter info and Move</h4>
               </div>
               <div class="modal-body">
                  <!--<form method="post" action="">-->
                  <!--<?php //echo form_open_multipart('enquiry/move_to_lead','class="form-inner"') ?>   -->
                  <div class="row">
                     <div class="form-group col-sm-6">  
                        <label>Expected Closer Date <i class="text-danger">*</i></label>                  
                        <!-- <input class="form-control date2"  name="expected_date" type="date" placeholder="Expected Closer Date" required> -->
                        <input class="form-control"  name="expected_date" type="date" placeholder="Expected Closer Date" required>                
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
                     <div class="form-group col-md-6">
                        <label><?php echo display('lead_stage') ?> <i class="text-danger">*</i></label>                  
                        <select class="form-control" id="move_lead_stage_change" name="move_lead_stage" onchange="find_description1()" required>
                           <option value="">-- Select Application Stage --</option>
                              <?php foreach($all_estage_lists as $single){                               
                                  //$id=$single->lead_stage;                                                            
                                ?>                              
                                <option value="<?= $single->stg_id?>" <?php if ($single->stg_id == $details->lead_stage) {echo 'selected';}?>><?php echo $single->lead_stage_name; ?></option>
                                <?php } ?>                                        
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label><?php echo display('lead_description') ?></label>                  
                        <select class="form-control" name="lead_description" id="lead_description1">
                           <option value="">Application Description</option>
                          <?php foreach($all_description_lists as $discription){ ?>
                                   
                                   <option value="<?php echo $discription->id; ?>"><?php echo $discription->description; ?></option>
                                   <?php } ?>                                             
                        </select>
                     </div>

                     <div class="form-group col-sm-12">  
                        <label>Select Assign Employee</label> 
                        <select class="form-control"  name="assign_employee" id="select_assign_user_others">  
                        <option value="">---Select User---</option>                  
                        <?php foreach ($user_list as $user) { ?>
                            <option value="<?php echo $user->pk_i_admin_id; ?>">
                              <?=$user->s_display_name ?>&nbsp;<?=$user->last_name.' - '.$user->s_user_email; ?> (<?= $user->user_role ?>)                                
                            </option>
                            <?php 
                        } ?>                                                       
            </select>               
                     </div>

                     <div class="form-group col-sm-12">  
                        <label><?php echo display('comments') ?></label>                  
                        <input class="form-control" id="LastCommentGen" name="comment" type="text" placeholder="Enter comment">                
                     </div>
                     <!--<div class="form-group col-sm-4">  
                        <label><?php echo 'Applicant Portal'; ?></label>                  
                        <input class="form-control" name="portal" type="checkbox" value="1">                
                     </div>-->
                     <div class="col-md-6"  id="save_button">
                        <div class="row">
                           <div class="col-md-12">                                                
                              <button class="btn btn-primary" type="submit" >Save</button>            
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-6" id="curcit_add" style="display:none;">
                        <div class="col-12" >
                           <div class="row">
                              <div class="col-md-6">                                                
                                 <button class="btn btn-primary" type="submit" >Create Circuit Sheet</button>            
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-6" id="add_po" style="display:none;">
                        <div class="col-12" >
                           <div class="row">
                              <div class="col-md-12">                                                
                                 <button class="btn btn-primary" type="submit" >Attached Po</button>            
                              </div>
                           </div>
                        </div>
                     </div>
                     <input type="hidden" value="<?php echo $enquiry->enquiry_id;?>" name='enquiry_id'>
                  </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
<!--------------------end-------------------->
   </div>
</div>
<style>
   .avatar {
   position: relative;
   display: inline-block;
   width: 36px;
   height: 36px;
   }
   [data-lettersbig]:before {
   content: attr(data-lettersbig);
   display: inline-block;
   font-size: 1.5em;
   width: 4em;
   height: 4em;
   line-height: 4em;
   text-align: center;
   border-radius: 50%;
   background: #37a000;
   vertical-align: middle;
   margin-right: 1em;
   color: white;
   }
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
   .card-body {
   -ms-flex: 1 1 auto;
   flex: 1 1 auto;
   padding: 1.25rem;
   }
   .card {
   position: relative;
   display: -ms-flexbox;
   display: flex;
   -ms-flex-direction: column;
   flex-direction: column;
   min-width: 0;
   word-wrap: break-word;
   background-color: #fff;
   background-clip: border-box;
   border: 1px solid #c8ced3;
   border-radius: 0.25rem;
   }
   .card {
   margin-bottom: 1.5rem;
   }
</style>
<!-------------------------------------UPDATE DETAILS------------------------------------------------>
<div id="updatedetails<?php echo $enquiry->enquiry_id ?>" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Enquiry Details</h4>
         </div>
         <div class="modal-body">
            <?php echo form_open_multipart('enquiry/view/'.$enquiry->enquiry_id,'class="form-inner"') ?>
             <input type="hidden" name="enqCode" value="<?php echo $enquiry->Enquery_id ?>">
            <div class="row">
               <div class="form-group col-sm-6">
                  <label>First Name <i class="text-danger">*</i> </label>
                  <div class = "input-group">
                     <span class = "input-group-addon" style="padding:0px !important;border:0px !important;width:28%;">
                        <select class="form-control" name="name_prefix">
                           <?php foreach($name_prefix as $n_prefix){?>
                           <option value="<?= $n_prefix->prefix ?>" <?php if($n_prefix->prefix==$enquiry->name_prefix){ echo 'selected';} ?>><?= $n_prefix->prefix ?></option>
                           <?php } ?>
                        </select>
                     </span>
                     <input class="form-control" name="enquirername" type="text" value="<?php echo $enquiry->name ?>" placeholder="Enter First Name" style="width:100%;" required=""/>
                  </div>
               </div>
               <div class="form-group col-sm-6"> 
                  <label>Last Name <i class="text-danger">*</i></label>
                  <input class="form-control" value="<?php echo $enquiry->lastname ?>" name="lastname" type="text" placeholder="Last Name" >  
               </div>
               <div class="form-group col-sm-6"> 
                  <label><?php echo display('mobile') ?></label>
                  <input class="form-control" name="mobileno" type="text" maxlength='10' value="<?php echo $enquiry->phone ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >  
               </div>
               <div class="form-group col-sm-6"> 
                  <label><?php echo display('email') ?></label>
                  <input class="form-control" name="email" type="email" value="<?php echo $enquiry->email ?>">  
               </div>

            <div class="form-group col-sm-6">
               <label><?php echo display('lead_source') ?></label>
               <select class="form-control" name="lead_source">
                  <option value=""><?php echo display('lead_source') ?></option>
                  <?php foreach ($leadsource as $post){ ?>
                  <option value="<?= $post->lsid?>" <?php if($enquiry->enquiry_source==$post->lsid){echo 'selected';}?>><?= $post->lead_name?></option>
                  <?php } ?>
               </select>
            </div>   
            <div class="form-group col-sm-6">
              <label><?php echo display('company_name') ?> <i class="text-danger">*</i></label>
              <input class="form-control" name="company" type="company" value="<?php echo $enquiry->company; ?>"> 
            </div>
           <div class="form-group col-sm-6">
              <label><?php echo display('address') ?> <i class="text-danger">*</i></label>
              <input class="form-control" name="address" type="address" value="<?php echo $enquiry->address; ?>">
           </div>

            <div class="form-group col-sm-12"> 
            <label>Remarks</label>
            <textarea class="form-control" rows="3" id="remarks"  name="enquiry" placeholder="Remarks"><?php  echo set_value('remarks');?><?php echo $enquiry->enquiry?></textarea>
            </div>
               <br>
               <div id="task_create1" style="display:none;">
                  <div class="form-group col-md-6">  
                     <label>Task Detail</label>                  
                     <input class="form-control"  name="task_detail" type="text" placeholder="Enter Task Details">                
                  </div>
                  <div class="form-group col-md-6">  
                     <label>Task Date</label>                  
                     <input class="form-control date" name="task_date" type="text" placeholder="Enter Task Date" readonly>                
                  </div>
               </div>
               <div class="col-md-6"  id="save_button">
                  <div class="row">
                     <div class="col-md-12">                                                
                        <button class="btn btn-primary" type="submit" >Save</button>            
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-6" id="curcit_add3" style="display:none;">
                  <div class="col-12" >
                     <div class="row">
                        <div class="col-md-6">                                                
                           <button class="btn btn-primary" type="submit" >Create Circuit Sheet</button>            
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-6" id="add_po3" style="display:none;">
                  <div class="col-12" >
                     <div class="row">
                        <div class="col-md-12">                                                
                           <button class="btn btn-primary" type="submit" >Attached Po</button>            
                        </div>
                     </div>
                  </div>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<style>
#fileList > div > label > span:last-child {
  color: red;
  display: inline-block;
  margin-left: 7px;
  cursor: pointer;
}
#fileList input[type=file] {
  display: none;
}
#fileList > div:last-child > label {
  display: inline-block;
  width: 25px;
  height: 25px;
  font: 16px/22px Tahoma;
  color: orange;
  /*text-align: center;*/
  border: 2px solid orange;
  border-radius: 50%;
}
</style>

<div id="sendsms<?php echo $enquiry->enquiry_id ?>" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <?php echo form_open_multipart('message/send_sms','class="form-inner" id="whatsaap"') ?>
      <div class="modal-content card">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="modal-titlesms"></h4>
         </div>
         <div>
            <div class="form-group col-sm-12">
               <label>Template</label>
               <select class="form-control" name="templates" id="templates"  onchange="getMessage();">
               </select>
            </div>
          <div class="form-group col-sm-12" id="cc_hide">
            <label>Cc</label>
            <input type="text" data-role="tagsinput" placeholder="put cc Mails..." name="cc_ids" id="searched"  />
          </div>
            <!--<div class="form-group col-sm-12" id="cc_input">
               <label>Cc</label>
               <select class="form-control" name="cc_ids[]" id="ccc" multiple>
               </select>
            </div>-->

            <div class="form-group col-sm-12">
               <label><?php echo display('subject') ?></label>
               <input type="text" name="email_subject" class="form-control" id="email_subject">
               <label><?php echo display('message') ?></label>
               <textarea class="form-control" name="message_name"  rows="10" id="template_message"></textarea> 
               <span style="color:red;" id="link_hint"></span> 
            </div>

          <div class="form-group col-sm-12" id="agg_link" style="display:none;">
            <label>Aggrement Url</label>
            <input type="text" class="form-control" id="aggurl" name="aggurl" placeholder="put Link here...">
          </div>
            <!--<div class="form-group row col-md-12" id="file_hide">
                  <label>Upload file</label>
                  <input type="file" name="file" id="file" class="file-upload">
            </div>-->
  <div id="fileList" style="padding:10px;">
    <div id="file_hide">
      <input id="fileInput_0" type="file" name="file[]" multiple>
      <label for="fileInput_0">+</label>      
    </div>
  </div>
         </div>
         <div class="col-md-12">
            <input type="hidden"  id="mesge_type" name="mesge_type">
            <input type="hidden" id="mobile" name="mobile" value="<?php echo $enquiry->phone ?>">
            <input type="hidden" id="mail" name="mail" value="<?php echo $enquiry->email ?>">
            <button class="btn btn-primary" type="submit">Send <img src='<?= base_url('assets/images/loader_blue.gif'); ?>' width='20px' height='20px' id="loader1" style="display: none;"></button>
            <!--<button class="btn btn-primary" onclick="send_sms()" type="button">Send <img src='<?= base_url('assets/images/loader_blue.gif'); ?>' width='20px' height='20px' id="loader1" style="display: none;"></button>-->            
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
      </form>
   </div>
</div>
<script>
var fileInput = document.getElementById('fileInput_0');
var filesList =  document.getElementById('fileList');  
var idBase = "fileInput_";
var idCount = 0;

var inputFileOnChange = function() {

  var existingLabel = this.parentNode.getElementsByTagName("LABEL")[0];
  var isLastInput = existingLabel.childNodes.length<=1;

  if(!this.files[0]) {
    if(!isLastInput) {
      this.parentNode.parentNode.removeChild(this.parentNode);
    }
    return;
  }

  var filename = this.files[0].name;

  var deleteButton = document.createElement('span');
  deleteButton.innerHTML = '&times;';
  deleteButton.onclick = function(e) {
    this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
  }
  var filenameCont = document.createElement('span');
  filenameCont.innerHTML = filename;
  existingLabel.innerHTML = "";
  existingLabel.appendChild(filenameCont);
  existingLabel.appendChild(deleteButton);
  
  if(isLastInput) { 
    var newFileInput=document.createElement('input');
    newFileInput.type="file";
    newFileInput.name="file[]";
    newFileInput.id=idBase + (++idCount);
    newFileInput.onchange=inputFileOnChange;
    var newLabel=document.createElement('label');
    newLabel.htmlFor = newFileInput.id;
    newLabel.innerHTML = '+';
    var newDiv=document.createElement('div');
    newDiv.appendChild(newFileInput);
    newDiv.appendChild(newLabel);
    filesList.appendChild(newDiv);
  } 
}

fileInput.onchange=inputFileOnChange;
</script>
<!---------------------------- DROP Enquiry -------------------------------->
<div id="dropEnquiry" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <?php
            $drop_title = 'Drop';
            if ($enquiry->status == 1) {
              $drop_title = 'Drop Onboarding';
            }else if ($enquiry->status == 2) {
              $drop_title = 'Drop Application';
            }else if ($enquiry->status == 3) {
              $drop_title = 'Drop Case Management';
            }else if ($enquiry->status == 4) {
              $drop_title = 'Drop Refund Case';
            }
            ?>
            <h4 class="modal-title"><?=$drop_title?> <?= ucfirst($enquiry->name); ?></h4>
         </div>
         <div class="modal-body">
            <!--<form>-->
            <?php echo form_open_multipart('enquiry/drop_enquiry/'.$enquiry->enquiry_id,'class="form-inner"') ?>                      
            <div class="row">
               <div class="form-group col-sm-12">
                  <label>Drop Reason</label>                  
                  <select class="form-control"  name="drop_status">
                     <option value="" style="display:none">---Select---</option>
                     <?php foreach ($drops as $drop) {   ?>
                     <option value="<?php echo $drop->d_id; ?>"><?php echo $drop->drop_reason; ?></option>
                     <?php } ?>                                             
                  </select>
               </div>
               <div class="form-group col-sm-12"> 
                  <label>Drop Comment</label>
                  <input class="form-control" name="reason" type="text" required="">  
               </div>
            </div>
            <div class="col-12" style="padding: 0px;">
               <div class="row">
                  <div class="col-12" style="text-align:center;">                                                
                     <button class="btn btn-primary" type="submit">Save</button>            
                  </div>
               </div>
            </div>
            </form> 
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
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
               <input class="form-control" id="FormInfo" name="task_id" type="hidden" value="<?php echo $enquiry->Enquery_id ; ?>" >
               <label>Date From:</label>
               <input class="form-control" id="txtDate" name="task_start" type="text" placeholder="Start Task Date" readonly>                
               <br> 
               <label>Date To:</label>
               <input class="form-control" id="txtDate2" name="task_end" type="text" placeholder="End Task Date" readonly>
               <br>
               <button class="btn btn-sm btn-primary" style="float: right" type="button" onclick="search_comment_and_task()">
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
<div id="Coment" class="modal fade in" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" onclick="closedmodel()">&times;</button>
            <h4 class="modal-title">Add Comment</h4>
         </div>
         <div class="modal-body">
            <form  action="<?php echo base_url(); ?>lead/add_comment" method="POST">  
               <input class="form-control" id="FormInfo" name="lid" type="hidden" value="<?php echo $enquiry->Enquery_id ; ?>" >
               <input class="form-control" id="FormInfo" name="coment_type" type="hidden" value="1" >
               <textarea class="form-control" id="LastComment" name="conversation" type="text" placeholder="Add followup comment"></textarea>
               <br>
               <button class="btn btn-sm btn-primary" style="float: right">
               <i class="fa fa-dot-circle-o"></i> Add Comment</button>                    
               <br>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closedmodel()">Close</button>
         </div>
      </div>
   </div>
</div>
<!---------------------------chat section ------------------------------------>
     
     <!--chat start---->

<style>
.chat-window{
    bottom:0;
    position:fixed;

    right:0;
    margin-left:10px;z-index:9999999;
}
.chat-window > div > .panel{
    border-radius: 5px 5px 0 0;
}
.icon_minim{
    padding:2px 10px;
}
.msg_container_base{background-color:#fff;
  background: #e5e5e5;
  margin: 0;
  padding: 0 10px 10px;
  max-height:300px;
  overflow-x:hidden;
}
.top-bar {
  background: #666;
  color: white;
  padding: 10px;
  position: relative;
  overflow: hidden;
}
.msg_receive{
    padding-left:0;
    margin-left:0;
}
.msg_sent{
    padding-bottom:20px !important;
    margin-right:0;
}
.messages {
  background: white;
  padding: 10px;
  border-radius: 2px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  max-width:100%;
}
.messages > p {
    font-size: 13px;
    margin: 0 0 0.2rem 0;
  }
.messages > time {
    font-size: 11px;
    color: #ccc;
}
.msg_container {
    padding: 10px;
    overflow: hidden;
    display: flex;
}

.avatar {
    position: relative;
}
.base_receive > .avatar:after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border: 5px solid #FFF;
    border-left-color: rgba(0, 0, 0, 0);
    border-bottom-color: rgba(0, 0, 0, 0);
}

.base_sent {
  justify-content: flex-end;
  align-items: flex-end;
}
.base_sent > .avatar:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 0;
    border: 5px solid white;
    border-right-color: transparent;
    border-top-color: transparent;
    box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
}

.msg_sent > time{
    float: right;
}



.msg_container_base::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

.btn-group.dropup{
    position:fixed;
    left:0px;
    bottom:0;
}
</style>

<div class="container">
    <div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="display: none;">
        <div class="col-xs-12 col-md-12">
          <div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h5  style="font-size:9px;"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;<?php echo  $enquiry->name." ".$enquiry->lastname ?></h5>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                        <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                    </div>
                </div>
                <div class="panel-body msg_container_base" id="chat_window">
        <?php
                      
        foreach(json_decode($get_message) as $msg){
        if($msg->type!='OUT'){?>
        <div class="row msg_container base_sent">
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_receive">
                                <p><?php echo $msg->text;  ?></p>
                                <time datetime="2009-11-13T20:00"><?php echo $msg->creation_date; ?></time>
                            </div>
                        </div>
                    </div>
          
        <?php }else{ ?>
         <div class="row msg_container base_receive ">
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_sent">
                                <p><?php echo $msg->text;  ?></p>
                                <time datetime="2009-11-13T20:00"><?php echo $msg->creation_date; ?></time>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                        </div>
                    </div>
        
        <?php } }?>
                    

                 </div>
         <form   id="chat_start">
                <div class="panel-footer">
                    <div class="input-group">
          
           <input value="<?php echo $enquiry->phone; ?>" name="phone" type="hidden"  placeholder="Write your message here..." />
                      <input id="btn-input" type="text" name="message" class="form-control input-sm chat_input" placeholder="Write your message here..." />
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-sm" id="send_message" onclick="chat_start()" o>Send</button>
                        </span>
           
                    </div>
                </div>
         </form>
        </div>
        </div>
    </div>
    
  
</div>



<div id="task_edit" class="modal fade in" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content " id="update-task-content">
      </div>
   </div>
</div>


<div id="dispo_modal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Disposition</h4>
         </div>
         <div class="modal-body">
            
         </div>
      </div>
   </div>
</div>

<div id="timeline_modal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Activity Timeline</h4>
         </div>
         <div class="modal-body">
            
         </div>
      </div>
   </div>
</div>

<!-------------------------------------tags model--------------------------------->
<?php
  if(user_access(710)){
  ?>

<div id="tagas" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Mark Tag to selected data</h4>
         </div>
<form class="form-inner" method="post" id="tag_mark_from">
         <div class="modal-body">
            <div class="row">
               <div class="form-group col-sm-12">
                  <label>Select Tag</label> 
                  <div id="imgBack"></div>                 
                  <select class="multiple-select"  name="tags[]" multiple id="enq_tags">
                     <?php 
                     if(!empty($all_tags)){
                      foreach ($all_tags as $tag) { 
                      if($this->session->user_id==$tag['created_by'] || $tag['visiblity']=='1'){  ?>
                      <option value="<?php echo $tag['id'];?>">
                          <?php echo $tag['title']; ?>
                      </option>
                      <?php }
                      } 
                     }
                     ?>                                             
                  </select>
               </div>
            </div>
            <input type="hidden" name="enqcd" value="<?php echo $enquiry_id ?>">
            <div class="col-12" style="padding: 0px;">
               <div class="row">
                  <div class="col-12" style="text-align:center;">                                                
                     <button class="btn btn-success" type="button" onclick="mark_tags();">Save</button>            
                  </div>
               </div>
            </div>
            
         </div>
</form>
      </div>
   </div>
</div>

<script type="text/javascript">
  function mark_tags(){

    data_type = "<?=$data_type?>";
    enquiry_id = "<?=$enquiry_id?>";
    data_type = parseInt(data_type);

    if (data_type == 1) {
      var p_url = '<?php echo base_url();?>enquiry/mark_all_tags';
      var re_url = '<?php echo base_url();?>enquiry/view/'+enquiry_id;
    }else if(data_type == 2){
      var p_url = '<?php echo base_url();?>enquiry/mark_all_tags';
      var re_url = '<?php echo base_url();?>lead/lead_details/'+enquiry_id;
    }else if(data_type == 3){      
      var p_url = '<?php echo base_url();?>enquiry/mark_all_tags';
      var re_url = '<?php echo base_url();?>client/view/'+enquiry_id;
    }else if(data_type == 4){      
      var p_url = '<?php echo base_url();?>enquiry/mark_all_tags';
      var re_url = '<?php echo base_url();?>refund/view/'+enquiry_id;
    }    

  $.ajax({
    type: 'POST',
    url: p_url,
    data: $('#tag_mark_from').serialize(),
    beforeSend: function(){
                 $("#imgBack").html('uploading').show();
    },
    success:function(data){
         alert(data);
         //document.getElementById('testdata').innerHTML =data;
          window.location.href=re_url;
    }});
}
</script>

<?php
  }
  ?>
<!----------------------end-------------------------> 

<style>
  .swal2-popup {
        width: 53em !important;
        }
</style>
<script type="text/javascript">
  $(document).ready(function()
  {
    $.ajax({
          url: "<?php echo base_url().'enquiry/activityTimeline/'?>"+'4',
          type: 'POST',          
          data: {
              'id':<?=$enquiry_id?>
          },
          success: function(content) {                       
            $(".activitytimelinediv").html(content);
           // $("#task_edit").modal('show');
          }
      });
  })

  function findtimline(tid){            
      $.ajax({
          url: "<?php echo base_url().'enquiry/activityTimeline/'?>"+tid,
          type: 'POST',
          data: {
              'id':<?=$enquiry_id?>
          },
          success: function(content) { 
          if(tid=='1'){                      
            $(".activitytimelinedivwhatsapp").html(content);
          }else if(tid=='2'){
            $(".activitytimelinedivsms").html(content);
          }else if(tid=='3'){
            $(".activitytimelinedivemail").html(content);
          }
          }
      });
    
    }

    function timline_alert(rem){            
     $.ajax({
          url: "<?php echo base_url().'enquiry/get_timline_alert/'?>"+rem,
          type: 'POST',
          
          success: function(content) { 
Swal.fire(
  '',
  content
)
          }
      });
    
    }
</script>

<script>
    function get_modal_content(tid){            
      $.ajax({
          url: "<?php echo base_url().'task/get_update_task_content'?>",
          type: 'POST',          
          data: {
              'id':tid
          },
          success: function(content) {                       
            $("#update-task-content").html(content);
           // $("#task_edit").modal('show');
          }
      });
    
    }
</script>
<!----------------------------chat section end------------------------------------->
<script>
  $('#select_user').select2({});
  $('#ccc').select2({}); 
  $('#select_assign_user').select2({});
  $('#select_assign_user_others').select2({});
  
  $("#branch_select").trigger("change");
  function find_branch() { 
            var id_dpet = $("#find_branch_change").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_branch_by_dept',
            data: {dept_id:id_dpet},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].b_name)+'</option>';
                }
                
                $("#branch_select").html(html);
                
            }            
            });
            }

    function find_users() { 
            var id_dpet = $("#find_branch_change").val();
            var id_brnch = $("#branch_select").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_user_by_change',
            data: {dept_id:id_dpet,branch_id:id_brnch},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].pk_i_admin_id)+'">'+(obj[i].s_display_name)+' '+(obj[i].last_name)+'-'+(obj[i].s_user_email)+'</option>';
                }
                
                $("#select_user").html(html);
                
            }            
            });
            }
  </script>
<script>
    function add_more_phone(add_more_phone) {
       var html='<div class="form-group col-sm-6"><label>Other No </label><input class="form-control"  name="other_no[]" type="text" placeholder="Other Number"></div>';
        $('#'+add_more_phone).append(html);          
    }

    function add_more_email(add_more_email) {
       var html='<div class="form-group col-sm-6"><label>Other Email </label><input class="form-control"  name="other_email[]" type="text" placeholder="Other Email"></div>';
        $('#'+add_more_email).append(html);          
    }
  function delete_institute(id){
    //alert(id);    
    var url = "<?=base_url().'Enquiry/delete_institute'?>";
    $.ajax({
         type: "POST",
         url: url,
         data: {inst_id:id}, // serializes the form's elements.
         success: function(data)
         {              
            data = JSON.parse(data);
            alert(data.msg);
            if(data.status == true){
              window.location.reload();
            }
         }
    });

  }
   function delete_comission(id){
    //alert(id);    
    var url = "<?=base_url().'Enquiry/delete_comission'?>";
    $.ajax({
         type: "POST",
         url: url,
         data: {id:id}, // serializes the form's elements.
         success: function(data)
         {              
            data = JSON.parse(data);
            alert(data.msg);
            if(data.status == true){
              window.location.reload();
            }
         }
    });

  }


  function open_comission_modal(id){
    //alert(id);
    var enquiry_id = "<?=$enquiry->Enquery_id?>";
    //alert(enquiry_id);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>enquiry/get_update_enquery_comission_content',
        data: {id:id,Enquiry_id:enquiry_id},            
        success:function(data){              
          $("#edit-comission-content").html(data);
          $("#comission_modal_btn").click();
        }
    });
  }

  $("#add_comission_form").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
      $.ajax({
         type: "POST",
         url: url,
         data: form.serialize(), // serializes the form's elements.
         success: function(data)
         {              
            data = JSON.parse(data);
            alert(data.msg);
            if(data.status == true){
              window.location.reload();
            }
         }
       });
  });

function ban_user(mob){

   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>enquiry/tata_block_list/'+btoa(mob),
   })
   .done(function(data){
Swal.fire(
  'Block Status!',
   data,
  'success'
)
   })
   .fail(function() {
   Swal.fire(
  'Block Status!',
  'Something went wrong!',
  'error'
)   
   });
   }

   function search_comment_and_task(){
        $.ajax({
         type: 'POST',
         url: '<?php echo base_url();?>enquiry/search_comment_and_task',
         data: $('#searc_task').serialize()
        })
        .done(function(data){
             $("#comment_div").attr("style", "display:none");
             $("#comment_div1").attr("style", "display:block");
             $("#task_div").attr("style", "display:none");
             $("#task_div1").attr("style", "display:block");
             $("#comment_div1").html(data.details);
             $("#task_div1").html(data.details1);
             $("#range").attr("style", "display:none");
        })
        .fail(function(){
             alert( "fail!" );   
        });
   }   
   function getTemplates(SMS,type){
   var enq = "<?=$details->enquiry_id?>";       
    if(type != 'Send Email'){
      $("#email_subject").hide();
      $("#file_hide").hide();
      $("#cc_hide").hide();
      $("#email_subject").prev().hide();
      $("#template_message").summernote('destroy');
      $("#template_message").html('');
    }else{
      $("#template_message").summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false                 // set focus to editable area after initializing summernote
      });
      $("#email_subject").show();
      $("#file_hide").show();
      $("#cc_hide").show();
      $("#email_subject").prev().show();
    }
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>message/get_templates/<?php echo $enquiry->product_id ?>/<?php echo $enquiry->status ?>/'+SMS,
   })
   .done(function(data){
       $('#modal-titlesms').html(type);
       $('#mesge_type').val(SMS);       
       $('#templates').html(data);
 // getCc(SMS,enq);
   })
   .fail(function() {
   alert( "fail!" );   
   });
   }
//FOR GET CC CODE EMAILS
function getCc(SMS,enq){

    if(SMS != '3'){
      $("#cc_input").hide();
      $("#ccc").val('');
    }else{

      $("#cc_input").show();

  $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>message/get_cc_email/'+SMS+'/'+enq,
   })
   .done(function(data){       
       $('#ccc').html(data);
   })
  }
   
   }
   // FOR CC EMAIL GET CODE END

$(document).ready(function(){
    $("#whatsaap").on('submit', function(e){
      $("#loader1").show();
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>message/send_sms',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            })
            .done(function(data){
              $("#loader1").hide();
Swal.fire({
  icon: 'success',
  title: 'Get Response!',
  text: data,
  confirmButtonText: `OK`,
}).then((result) => {
  if (result.isConfirmed) {
    location.reload();
  }
}) 
           })
           .fail(function() {
            $("#loader1").hide();
Swal.fire({
  icon: 'error',
  title: 'Get Response!',
  text: 'Something went wrong!',
  confirmButtonText: `OK`,
}).then((result) => {
  if (result.isConfirmed) {
    location.reload();
  }
})      
       });
       
  });

});
       
       function  chat_start(){
       $.ajax({            
           type: 'POST',
           url: '<?php echo base_url();?>message/chat_start',
           data: $('#chat_start').serialize()
           })
           .done(function(data){               
               alert(data);
              location.reload();
           })
           .fail(function() {
           alert( "fail!" );
       });  
      }
       
       $(document).ready(function(){
       $('#chat_window').animate({
        scrollTop: $('#chat_window')[0].scrollHeight}, 2000);
       });

    document.getElementById('chat_start').addEventListener('keypress', function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
          $.ajax({
           type: 'POST',
           url: '<?php echo base_url();?>message/chat_start',
           data: $('#chat_start').serialize()
           })
           .done(function(data){               
              alert(data);
              location.reload();
           })
           .fail(function() {
           alert( "fail!" );
       });
      }
    });
       
   $( "#service1" ).click(function() {     
       if($('#another-element1:visible').length)
           $('#another-element1').hide();
       else
           $('#another-element1').show();        
   });   
   $( "#task_create_div1" ).click(function() {     
       if($('#task_create1:visible').length)
           $('#task_create1').hide();
       else
           $('#task_create1').show();        
   });   
   function check_stage3(id){
       if(id==5){
          document.getElementById('curcit_add3').style.display='block'; 
           document.getElementById('add_po3').style.display='none';
       }else if(id==8){
           document.getElementById('add_po3').style.display='block'; 
           document.getElementById('curcit_add3').style.display='none';
       }else{
          document.getElementById('add_po3').style.display='none';
         document.getElementById('curcit_add3').style.display='none';
       }       
       }
      function check_stage(id){
       if(id==5){
          document.getElementById('curcit_add').style.display='block'; 
           document.getElementById('add_po').style.display='none';
       }else if(id==8){
           document.getElementById('add_po').style.display='block'; 
           document.getElementById('curcit_add').style.display='none';
       }else{
          document.getElementById('add_po').style.display='none';
         document.getElementById('curcit_add').style.display='none';
       }       
       }
   
    function closedmodel(){
     $("#range").attr("style", "display:none");
    }  

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
          var date = parseDate($(this).val());   
          if (! isValidDate(date)) {
            date = moment().format('YYYY-MM-DD');
          }   
          $(this).val(date);
        });
    }      
      var isValidDate = function(value, format) {
        format = format || false;
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
          var date = parseDate($(this).val());   
          if (! isValidDate(date)) {
            date = moment().format('YYYY-MM-DD');
          }   
          $(this).val(date);      
        });
      }
      
    var isValidDate = function(value, format) {
      format = format || false;
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
</script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
   $(function () {   
     function init_events(ele) {
       ele.each(function () {
         var eventObject = {
           title: $.trim($(this).text())
         }
         $(this).data('eventObject', eventObject)
         $(this).draggable({
           zIndex        : 1070,
           revert        : true,
           revertDuration: 0
         })
       })
     }   
     init_events($('#external-events div.external-event'))
     var date = new Date()
     var d    = date.getDate(),
         m    = date.getMonth(),
         y    = date.getFullYear()
     $('#calendar__').fullCalendar({
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
       events    : [
           <?php foreach ($recent_tasks as $task):
      ?>
         {
           title          : '<?php echo $task->contact_person;?>',
           start          : new Date(y, m, <?php $dt = strtotime($task->nxt_date); echo date('d',$dt); ?>),
           backgroundColor: '#0073b7', 
           url            : '',
           borderColor    : '#0073b7'           
         },
         <?php endforeach; ?>        
       ],
      /* dayClick:function(date,isEvent,view,resourseobj){
         $('td').dblclick(function(){             
              $("#range").attr("style", "display:block");           
        });         
                     $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url();?>enquiry/search_comment_and_task/'+date.format()+'/<?php echo $enquiry->Enquery_id ?>',
                     })
                     .done(function(data){
                          $("#comment_div").attr("style", "display:none");
                         $("#comment_div1").attr("style", "display:block");
                        
                         $("#task_div").attr("style", "display:none");
                         $("#task_div1").attr("style", "display:block");
                         $("#comment_div1").html(data.details);
                         $("#task_div1").html(data.details1);
                     })
                     .fail(function() {
                     alert( "fail!" );                     
                     });        
       }*/  
     })


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
       
       events    : function(start, end, timezone, callback) {
        jQuery.ajax({
            url: "<?php echo base_url().'task/get_calandar_feed/'.$enquiry->Enquery_id?>",
            type: 'POST',
            dataType: 'json',
            data: {
                start: start.format(),
                end: end.format()
            },
            success: function(doc) {
                var events = doc;                
                callback(events);
            }
        });
    }
       ,
       dayClick:function(date,isEvent,view,resourseobj){
        /* $('td').dblclick(function(){           
        }); 
         
         ser_date = date.format();

                     $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url();?>task/search_comment_and_task/'+ser_date,
                     })
                     .done(function(data){
                       
                         $("#task_div1").html(data);
                     })*/
   
        
       },
   
     })

   })
   
   
   
    function getMessage(){           
     var tmpl_id = document.getElementById('templates').value;           
     $.ajax({               
         url : '<?php echo base_url('enquiry/msg_templates') ?>',
         type: 'POST',
         data: {tmpl_id:tmpl_id},
         success:function(data){
          //alert(data);
             var obj = JSON.parse(data);
              $('#templates option[value='+tmpl_id+']').attr("selected", "selected");
              $("#template_message").summernote('destroy');
                
              if($("#email_subject").is(':visible'))
              {
                   $("#template_message").summernote("code", obj.template_content);
                   $("#email_subject").val(obj.mail_subject);
              }
              else
              {
                $("#template_message").html(obj.template_content);
              }           
             
         }               
     });        
    }  
     
  function check_status(s){
    if(s==1){  
        $(".dynamic_field").css("display","block")
    } else{
        $(".dynamic_field").css("display","none")
    }  
  }
</script>

<script type="text/javascript">
  
  function open_institute_modal(id){
    //alert(id);
    var enquiry_id = "<?=$enquiry->Enquery_id?>";
    //alert(enquiry_id);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>enquiry/get_update_enquery_institute_content',
        data: {id:id,Enquiry_id:enquiry_id},            
        success:function(data){              
          $("#edit-institute-content").html(data);
          $("#institute_modal_btn").click();
        }
    });
  }
   function find_description(f=0) { 
        auto_followup();
           if(f==0){
            var l_stage = $("#lead_stage_change").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_des_by_stage',
            data: {lead_stage:l_stage},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select---</option>';
       // html +='<option value="new" style="">New</option>';
       // html +='<option value="updt" style="">Update</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].description)+'</option>';
                }
                
                $("#lead_description").html(html);
                
            }
            
            
            });
           }

            }
      
  function auto_followup(){
    var lead_stage = $("#lead_stage_change").val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>leadRules/auto_followup_rule',            
      success:function(data){
        if (data) {
          data = JSON.parse(data);
          $.each(data,function(key,val){
            str = val.rule_sql;
            var res = str.replace(/=/g, "==");
            var res = res.replace(/OR/g, "||");
            var res = res.replace(/AND/g, "&&");
            if (eval(res)) {
              ac = val.rule_action;              
              if (ac) {
                $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url();?>leadRules/data_time_add_hr/'+ac,            
                  success:function(data){                    
                    if(data){
                      data = JSON.parse(data);
                      console.log(data);
                      $("#disposition_c_date").val(data[0]);
                      $("#disposition_c_time").val(data[1]);
                    }
                  }
                });
              }
            }
          });
        }
      }
    });
  }

  function find_description1(f=0) { 

           if(f==0){
            var l_stage = $("select[name='move_lead_stage']").val();
            //console.log('l_stage'+l_stage);
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_des_by_stage',
            data: {lead_stage:l_stage},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select---</option>';
      //  html +='<option value="new" style="">New</option>';
       // html +='<option value="updt" style="">Update</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].description)+'</option>';
                }
                
                $("#lead_description1").html(html);
                
            }
            
            
            });
           }

            }
           // set_default_disposition();
            function set_default_disposition(){
              //$("#lead_stage_change").change();
              var lead_stage = $("#lead_stage_change").val();
              var unique_no = $("input[name='unique_no']").val();           
               $.ajax({
                type: 'POST',
                url: '<?php echo base_url();?>lead/get_last_task_by_code',
                data: {enq_code:unique_no},            
                success:function(data){              
                  res = JSON.parse(data);
                  if(res){              
                    task_date  = res.task_date;
                    task_time  = res.task_time;              
                    $("input[name='c_date']").val(task_date);
                    $("input[name='c_time']").val(task_time);                
                    $("input[name='latest_task_id']").val(res.resp_id);
                    $("textarea[name='conversation']").val(res.task_remark);              
                  }              
                }
              });
            }

   document.getElementById("lead_description").onchange = function() {    
    var lead_stage = $("#lead_description").val();

          if(lead_stage == 'new'){
            document.getElementById("otherTypev").style.display = "block"; 
          }else if(lead_stage == 'updt'){            
            var lead_stage = $("#lead_stage_change").val();
            var unique_no = $("input[name='unique_no']").val();           
           $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/get_last_task_by_code',
            data: {enq_code:unique_no},            
            success:function(data){              
              res = JSON.parse(data);
              if(res){              
                task_date  = res.task_date;
                task_time  = res.task_time;              
                $("input[name='c_date']").val(task_date);
                $("input[name='c_time']").val(task_time);                
                $("input[name='latest_task_id']").val(res.resp_id);
                $("textarea[name='conversation']").val(res.task_remark);              
              }              
            }
          });
        }else{
         //document.getElementById("otherTypev").style.display = "none"; 
          $("input[name='c_date']").val('');
          $("input[name='c_time']").val('');                
          $("input[name='latest_task_id']").val('');
          $("textarea[name='conversation']").val(''); 
        }
      } 

</script>
<script>
    function find_sub() {
     var sid =  document.getElementById("lead_source").value; 
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>enquiry/get_sub_byid1',
        data: {'sid': sid},
      })
      .done(function(data){
        if(data!=''){
          document.getElementById('sub_source').innerHTML=data;
        }else{
          document.getElementById('sub_source').innerHTML='';   
        }
      })
      .fail(function() {
      });
    }
</script>
<script type="text/javascript">
    function find_state() {    
      var enq_state = $("#country_id").val();
      $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>enquiry/select_state_by_con',
      data: {enq_state:enq_state},      
      success:function(data){         
          var html='';
          var obj = JSON.parse(data);          
          html +='<option value="" style="display:none">---Select---</option>';
          for(var i=0; i <(obj.length); i++){              
              html +='<option value="'+(obj[i].id)+'">'+(obj[i].state)+'</option>';
          }          
          $("#state_id").html(html);
      }
      });
    }
</script>
        
<script>
  $(document).on('click', '.panel-heading span.icon_minim', function (e) {
      var $this = $(this);
      if (!$this.hasClass('panel-collapsed')) {
          $this.parents('.panel').find('.panel-body').slideUp();
          $this.addClass('panel-collapsed');
          $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
      } else {
          $this.parents('.panel').find('.panel-body').slideDown();
          $this.removeClass('panel-collapsed');
          $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
      }
  });

  $(document).on('focus', '.panel-footer input.chat_input', function (e) {
      var $this = $(this);
      if ($('#minim_chat_window').hasClass('panel-collapsed')) {
          $this.parents('.panel').find('.panel-body').slideDown();
          $('#minim_chat_window').removeClass('panel-collapsed');
          $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
      }
  });

  $(document).on('click', '#new_chat', function (e) {
      var size = $( ".chat-window:last-child" ).css("margin-left");
       size_total = parseInt(size) + 400;
      alert(size_total);
      var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
      clone.css("margin-left", size_total);
  });
  $(document).on('click', '.icon_close', function (e) {
      //$(this).parent().parent().parent().parent().remove();
      $( "#chat_window_1" ).remove();
  });
</script>
<script src="<?php echo base_url();?>assets/js/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>assets/js/moment.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
   $(function () {
    $("#enquiry_date").datepicker({dateFormat:'yy-mm-dd'});
  });

   jQuery(document).ready(function(){
    $('.summernote').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false                 // set focus to editable area after initializing summernote
    });
  });

   // delete task
    function delete_row(id){
      var result = confirm("Want to delete?");
      if (result) { 
        url = "<?=base_url().'task/delete_task_row'?>"
        $.ajax({
          type: "POST",
          url: url,
          data: {'id':id},
          success: function(data){                
            data = JSON.parse(data);
            alert(data.msg);
            if(data.status){
              location.reload();
            }
          }
        });
      }
    }
   // $("select[name='institute_id']").select2();
    $("#fcity").select2();
    $("#fstate").select2();



    $(document).on("change",'#fcity',function () {
      var selDpto = $(this).val();
      if (selDpto) {        
        $.ajax({
          url: "<?php echo base_url();?>lead/select_state_by_city",
          async: false,
          type: "POST",
          data: {city_id:selDpto},
          dataType: 'html',
          success: function(data) {
          var obj=JSON.parse(data);
          console.log(obj);
            //$('#fstate option[value="'+obj.state_id+'"]').attr("selected","selected");
            $('#fstate').val(obj.state_id);
            $('#myList').select2("val", obj.state_id);

            //$('#fstate').trigger('change');
          }
        })
      } 
    });

</script>


    <?php
    if ($this->session->companey_id==51) {
    ?>

<script type="text/javascript">
    function hide_all_dependent_field(){
      $(".service_related_issue_type").hide();                       
      $(".service_related_issue_sub_type").hide();                       
      $(".detail_of_issue").hide();                       
      $(".error_coming").hide();                       
      $(".dnd_sender_id").hide();                       
      $(".issue_date").hide();                       
      $(".promotional_sms_call_date_for_dnd").hide(); 

      $(".balace_deduction_issue_type").hide();            
      $(".balance_deduction_issue_sub_type").hide();            
      $(".amount_deducted").hide();            
      $(".date_of_deduction").hide();            
      $(".waiver_required").hide();            
      $(".blacklist_consent").hide(); 

      $(".recharge_issue_type").hide();
      $(".recharge_issue_sub_type").hide();
      $(".recharge_denomination").hide();
      $(".mode_of_recharge").hide();
      $(".date_of_recharge").hide(); 


      $(".network_issue_type").hide();
      $(".network_issue_sub_type").hide();
      $(".technology").hide();     

      $(".alt_number").hide();            
      $(".sim_service_issue_type").hide();            
      $(".sim_service_issue_sub_type").hide();            
      $(".date_of_simex").hide();            
      $(".vms_name").hide();     

      
      $(".self_help_issue_type").hide();            
      $(".self_help_issue_sub_type").hide();            
      $(".date_of_problem").hide();

      $(".other-issue-type").hide();
      $(".voc").hide();
    }

    function show_dependent_field(service){
      
      hide_all_dependent_field();

      if (service==103) {
        $(".network_issue_type").show();
        $(".network_issue_sub_type").show();
        $(".technology").show();


      }else if (service==104) {
        $(".recharge_issue_type").show();
        $(".recharge_issue_sub_type").show();
        $(".recharge_denomination").show();
        $(".mode_of_recharge").show();
        $(".date_of_recharge").show(); 

       
      }else if (service==105) {
        $(".balace_deduction_issue_type").show();            
        $(".balance_deduction_issue_sub_type").show();            
        $(".amount_deducted").show();            
        $(".date_of_deduction").show();            
        $(".waiver_required").show();            
        $(".blacklist_consent").show(); 
        
      }else if (service==106) {
        $(".alt_number").show();            
        $(".sim_service_issue_type").show();            
        $(".sim_service_issue_sub_type").show();            
        $(".date_of_simex").show();            
        $(".vms_name").show();   


      }else if (service==107) {
        $(".self_help_issue_type").show();            
        $(".self_help_issue_sub_type").show();            
        $(".date_of_problem").show(); 

      }else if (service==108) {
        $(".service_related_issue_type").show();                       
        $(".service_related_issue_sub_type").show();                       
        $(".detail_of_issue").show();                       
        $(".error_coming").show();                       
        $(".dnd_sender_id").show();                       
        $(".issue_date").show();                       
        $(".promotional_sms_call_date_for_dnd").show(); 
      }
      else if (service==110) {
        $(".other-issue-type").show();
        $(".voc").show();
      }

    }
      
  $("#sub_source").on('change',function(){
    var service  = $("#sub_source").val();
    show_dependent_field(service);
  });
  var service  = $("#sub_source").val();
  show_dependent_field(service);

</script>
<?php
}else if($this->session->companey_id == 29){ ?>
  <script type="text/javascript">
      function hide_all_dependent_field(){
        $(".desired-loan-amount").hide();
        $(".net-monthly-income").hide();
        $(".bank-name").hide();
        $(".personal-details").hide();        

        $(".gross-annual-turnover").hide();
        $(".net-profit-after-tax").hide();
        
        $(".company-name").hide();
        $(".company-type").hide();
        $(".occupation-type").hide();
        $(".credit-card-name").hide();        

        $(".profession").hide();
        $(".years-in-occupation").hide();
        $(".years-in-occupation").hide();
        $(".annual-income").hide();

      }

      function show_dependent_field(service){        
        hide_all_dependent_field();
        if (service == 83) {
          $(".desired-loan-amount").show();
          $(".net-monthly-income").show();
          $(".bank-name").show();
          $(".personal-details").show();
        
        }else if (service == 84) {
          $(".desired-loan-amount").show();          
          $(".gross-annual-turnover").show();
          $(".net-profit-after-tax").show();
          $(".company-name").show();
          $(".company-type").show();
          $(".bank-name").show();

        }else if (service == 111) {
          $(".occupation-type").show();
          $(".net-monthly-income").show();          
          $(".bank-name").show();
          $(".credit-card-name").show();

        }else if (service == 112) {
          $(".desired-loan-amount").show();          
          $(".profession").show();
          $(".years-in-occupation").show();
          $(".bank-name").show();   
          $(".annual-income").show();
        }        
      }
        
    $("#sub_source").on('change',function(){
      var service  = $("#sub_source").val();
      show_dependent_field(service);
    });  
    var service  = $("#sub_source").val();
    show_dependent_field(service);
  </script>
<?php
}
?>

<script type="text/javascript">
$('div.ieltsappeard').hide();
  $('div.ieltsnappeard').hide();
  $('div.ieltsdt').hide();
  $('div.ieltslisten').hide();
  $('div.ieltsread').hide();
  $('div.ieltswrite').hide();
  $('div.ieltsspeak').hide();
  $('div.ieltsfinal').hide();
  
  $('div.pteappeard').hide();
  $('div.ptenappeard').hide();
  $('div.ptedt').hide();
  $('div.ptelisten').hide();
  $('div.pteread').hide();
  $('div.ptewrite').hide();
  $('div.ptespeak').hide();
  $('div.ptefinal').hide();
  
  
$('#ielts').change(function(){
  if($(this).prop("checked")) {
    $('div.ieltsappeard').show();

  } else {
    $('div.ieltsappeard').hide();
  $('div.ieltsnappeard').hide();
  $('div.ieltsdt').hide();
  $('div.ieltslisten').hide();
  $('div.ieltsread').hide();
  $('div.ieltswrite').hide();
  $('div.ieltsspeak').hide();
  $('div.ieltsfinal').hide();
  }
}); 
 

$("input[id=ieltsappeard]").on( "click", function() {

var test = $(this).val();
  if(test=='Appeared'){
    $('div.ieltsdt').show();
  $('div.ieltslisten').show();
  $('div.ieltsread').show();
  $('div.ieltswrite').show();
  $('div.ieltsspeak').show();
  $('div.ieltsfinal').show();
     }else{
  $('div.ieltsdt').hide();
  $('div.ieltslisten').hide();
  $('div.ieltsread').hide();
  $('div.ieltswrite').hide();
  $('div.ieltsspeak').hide();
  $('div.ieltsfinal').hide();    
     }
    } );
 

$('#pte').change(function(){
  if($(this).prop("checked")) {
    $('div.pteappeard').show();

  } else {
    $('div.pteappeard').hide();
  $('div.ptenappeard').hide();
  $('div.ptedt').hide();
  $('div.ptelisten').hide();
  $('div.pteread').hide();
  $('div.ptewrite').hide();
  $('div.ptespeak').hide();
  $('div.ptefinal').hide();
  }
}); 

$("input[id=pteappeard]").on( "click", function() {

var test = $(this).val();
  if(test=='Appeared'){
    $('div.ptedt').show();
  $('div.ptelisten').show();
  $('div.pteread').show();
  $('div.ptewrite').show();
  $('div.ptespeak').show();
  $('div.ptefinal').show();
     }else{
  $('div.ptedt').hide();
  $('div.ptelisten').hide();
  $('div.pteread').hide();
  $('div.ptewrite').hide();
  $('div.ptespeak').hide();
  $('div.ptefinal').hide();    
     }
    } ); 
</script>
<script>
function find_app_crs() { 
            var c_stage = $("#institute_id").val();
      var l_stage = $("#p_lvl").val();
      var lg_stage = $("#p_length").val();
      var d_stage = $("#p_disc").val();
      //alert(c_stage);
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_app_by_ins',
            data: {c_course:c_stage,c_lvl:l_stage,c_length:lg_stage,c_disc:d_stage},
            
            success:function(data){                
                var html='';
                var obj = JSON.parse(data);                
                html +='<option value="" style="display:none">---Select---</option>';
                for(var i=0; i <(obj.length); i++){                    
                    html +='<option value="'+(obj[i].crs_id)+'">'+(obj[i].course_name_str)+'</option>';
                }                
                $("#app_course").html(html);                
            }            
            });

    }
</script>
<script>
  function create_portal(x,y,z){
if ($('#create_portal').is(':checked')){ 
  var check = 1;
}else{
  var check = 0;
}
//alert(y);    
$.ajax({
type: 'POST',
url: '<?=base_url()?>enquiry/create_client_portal_checkbox',
data: {enq_no:x,email:y,mobile:z,check:check},
success: function(responseData){
  if(responseData=='1'){
  Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Applicant Portal Create successfully',
  showConfirmButton: false,
  timer: 1500
});
}else{
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Already Applicant Portal Created!',
  showConfirmButton: false,
  timer: 1500
});
}
}
});
  }

  function disable_portal(x,y,z){
if ($('#disable_portal').is(':checked')){ 
  var check = 1;
}else{
  var check = 0;
}
//alert(y);    
$.ajax({
type: 'POST',
url: '<?=base_url()?>enquiry/disable_client_portal_checkbox',
data: {enq_no:x,email:y,mobile:z,check:check},
success: function(responseData){
  if(responseData=='1'){
  Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Applicant Portal Disable successfully',
  showConfirmButton: false,
  timer: 1500
});
}else{
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Applicant Portal Enable successfully',
  showConfirmButton: false,
  timer: 1500
});
}
}
});
  }

function portal_valid(x,y){ 
var y = $('#portal_valid').val();
  
$.ajax({
type: 'POST',
url: '<?=base_url()?>enquiry/client_portal_validity',
data: {enq_no:x,date:y},
success: function(responseData){
  if(responseData=='1'){
  Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Portal Validity Updated successfully',
  showConfirmButton: false,
  timer: 1500
});
}
}
});
}
</script>
<script type="text/javascript">
$( ".titlehover" ).hover(
  function() {   
   var title = $(this).attr("data-title");
    $('<div/>', {
        text: title,
        class: 'hoverbox'
    }).appendTo(this); 
  }, function() {
    $(document).find("div.hoverbox").remove();
  }
);
</script>

<script>
   $(document).on("click", "#tagDrop", function (e) {
        let id = $(this).attr('data-id');
        let enqId = $(this).attr('data-enq');
        // alert(enqId);
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to Delete This Tag',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {

            if (result.value) {
                $.ajax({
                    url: "<?= base_url('enq/drop_tag/')?>",
                    type: "POST",
                    data: {
                        tag_delete: true,
                        id: id,
                        enq: enqId
                    },
                    success: function (data) {
                        // console.log(data);
                        Swal.fire(
                            'Deleted!',
                            'Your Tag deleted.',
                            'success',
                            5000
                        );
                        location.reload();
                    },
                    error: function (err) {
                        // console.log('err');
                        Swal.fire(
                            'Error!',
                            'Something Was Worng!',
                            'error',
                            5000
                        );
                    }
                });

            }
        })

        // alert("asdfghj");
    });
  
function find_level() { 
  var l_stage = $("#p_lvl").val();
  $.ajax({
  type: 'POST',
  url: '<?php echo base_url();?>lead/select_length_lvl',
  data: {lead_stage:l_stage},  
  success:function(data){
      var html='';
      var obj = JSON.parse(data);      
      html +='<option value="" style="display:none">---Select length---</option>';
      for(var i=0; i <(obj.length); i++){          
          html +='<option value="'+(obj[i].id)+'">'+(obj[i].length)+'</option>';
      }
      $("#p_length").html(html);
  }
  });
} 


//AUTO HIDE SHOW TIMELINE SESSION CODE
 $(document).ready(function()
  {
    var t_id = <?=$this->session->timline_sts;?>;
    if(t_id == 1){
    $(this).data('vis','0');
    $("#toggle_timeline").removeClass('fa-angle-right');
    $("#toggle_timeline").addClass('fa-angle-left');
    $(".details-column").removeClass('col-md-6');
    $(".details-column").addClass('col-md-9');
    $(".timeline").hide(500);
  }else{
    $(this).data('vis','1');
    $("#toggle_timeline").removeClass('fa-angle-right');
    $("#toggle_timeline").addClass('fa-angle-left');
    $(".details-column").removeClass('col-md-9');
    $(".details-column").addClass('col-md-6');
    $(".timeline").show(500); 
  }
  })

$("#toggle_timeline").click(function(){
  //alert($(this).data('vis'));
    if($(this).data('vis')=='1')
      { 
        $.ajax({
          url: "<?php echo base_url().'enquiry/timeline_access'?>",
          type: 'POST',          
          data: {
              'pk_id':<?=$this->session->user_id;?>,
        'status':'1'
          },
        });   
    $(this).data('vis','0');
    $("#toggle_timeline").removeClass('fa-angle-right');
    $("#toggle_timeline").addClass('fa-angle-left');
    $(".details-column").removeClass('col-md-6');
    $(".details-column").addClass('col-md-9');
    $(".timeline").hide(500);
      }
    else
    {
        $.ajax({
          url: "<?php echo base_url().'enquiry/timeline_access'?>",
          type: 'POST',          
          data: {
              'pk_id':<?=$this->session->user_id;?>,
        'status':'0'
          },
        }); 
    
    $(this).data('vis','1');
    $("#toggle_timeline").removeClass('fa-angle-right');
    $("#toggle_timeline").addClass('fa-angle-left');
    $(".details-column").removeClass('col-md-9');
    $(".details-column").addClass('col-md-6');
    $(".timeline").show(500);
    }
    //setTimeout(manageScroll,1000);
});
//AUTO HIDE SHOW TIMELINE SESSION CODE END

  $("input[name='submit_and_next']").on('click',function(){
    $(this).next().val('save_and_new');
  });

  $("input[name='submit_only']").on('click',function(){
    $(this).next().next().val('save_only');
  });
  
  /*ajax form submit*/
  $('.tabbed_form').on('submit',function(e) {    
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    var formData = new FormData($(this)[0]);

    $.ajax({
       type: "POST",
       url: url,
       data: formData, // serializes the form's elements.
       async: false,
       cache: false,
       contentType: false,
       processData: false,
       success: function(data)
       {
           res = JSON.parse(data);
           if (res.status) {
              Swal.fire(
                'Good job!',
                res.msg,
                'success'
              );
              var btn = form.find("input[name='go_new_tab']").val();              
              if (btn == 'save_and_new') {                
                var next = jQuery('.nav-tabs > .active').next('li');
                if(next.length){
                  next.find('a').trigger('click');
                }else{
                  jQuery('#myTabs a:first').tab('show');
                }
              }
           }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!'
            })
           }           
       }
     });
  });
   function show_disposition(){
    h  = $("#disposition-section").html();
    $("#dispo_modal .modal-body").html(h);
  }
  function show_timeline(){
    h  = $(".activitytimelinediv").html();    
    $("#timeline_modal .modal-body").html(h);    
  }
  $("#institute-tab").on('click',function(){
    $("#institute").load("<?=base_url().'enquiry/get_institute_tab_content/'.$enquiry_id?>");
  })
  $("#tab_document_new").on('click',function(){
    $("#document_new").load("<?=base_url().'enquiry/get_document_tab_content/'.$enquiry_id?>");
  })
</script>

<style>
  .bootstrap-tagsinput {
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  display: inline-block;
  padding: 0px 6px;
  color: #555;
  vertical-align: middle;
  border-radius: 4px;
  max-width: 100%;
  line-height: 35px;
  cursor: text;
  width:850px;
}
.bootstrap-tagsinput input {
  border: none;
  box-shadow: none;
  outline: none;
  background-color: transparent;
  padding: 0 6px;
  margin: 0;
  width: 450px;
  max-width: inherit;
}
@media only screen and (max-width: 600px) {
  .bootstrap-tagsinput input {
  border: none;
  box-shadow: none;
  outline: none;
  background-color: transparent;
  padding: 0 6px;
  margin: 0;
  width: auto;
  max-width: inherit;
}
}
.bootstrap-tagsinput.form-control input::-moz-placeholder {
  color: #777;
  opacity: 1;
}
.bootstrap-tagsinput.form-control input:-ms-input-placeholder {
  color: #777;
}
.bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
  color: #777;
}
.bootstrap-tagsinput input:focus {
  border: none;
  box-shadow: none;
}
.bootstrap-tagsinput .tag {
  margin-right: 2px;
  color: white;
}
.bootstrap-tagsinput .tag [data-role="remove"] {
  margin-left: 8px;
  cursor: pointer;
}
.bootstrap-tagsinput .tag [data-role="remove"]:after {
  content: "x";
  padding: 0px 2px;
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover {
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
</style>
<!-- <center>

</center> -->
<script type="text/javascript">
  (function ($) {
  "use strict";

  var defaultOptions = {
    tagClass: function(item) {
      return 'label label-info';
    },
    itemValue: function(item) {
      return item ? item.toString() : item;
    },
    itemText: function(item) {
      return this.itemValue(item);
    },
    itemTitle: function(item) {
      return null;
    },
    freeInput: true,
    addOnBlur: true,
    maxTags: undefined,
    maxChars: undefined,
    confirmKeys: [13, 44],
    delimiter: ',',
    delimiterRegex: null,
    cancelConfirmKeysOnEmpty: true,
    onTagExists: function(item, $tag) {
      $tag.hide().fadeIn();
    },
    trimValue: false,
    allowDuplicates: false
  };

  /**
   * Constructor function
   */
  function TagsInput(element, options) {
    this.itemsArray = [];

    this.$element = $(element);
    this.$element.hide();

    this.isSelect = (element.tagName === 'SELECT');
    this.multiple = (this.isSelect && element.hasAttribute('multiple'));
    this.objectItems = options && options.itemValue;
    this.placeholderText = element.hasAttribute('placeholder') ? this.$element.attr('placeholder') : '';
    this.inputSize = Math.max(1, this.placeholderText.length);

    this.$container = $('<div class="bootstrap-tagsinput"></div>');
    this.$input = $('<input type="text" placeholder="' + this.placeholderText + '"/>').appendTo(this.$container);

    this.$element.before(this.$container);

    this.build(options);
  }

  TagsInput.prototype = {
    constructor: TagsInput,

    /**
     * Adds the given item as a new tag. Pass true to dontPushVal to prevent
     * updating the elements val()
     */
    add: function(item, dontPushVal, options) {
      var self = this;

      if (self.options.maxTags && self.itemsArray.length >= self.options.maxTags)
        return;

      // Ignore falsey values, except false
      if (item !== false && !item)
        return;

      // Trim value
      if (typeof item === "string" && self.options.trimValue) {
        item = $.trim(item);
      }

      // Throw an error when trying to add an object while the itemValue option was not set
      if (typeof item === "object" && !self.objectItems)
        throw("Can't add objects when itemValue option is not set");

      // Ignore strings only containg whitespace
      if (item.toString().match(/^\s*$/))
        return;

      // If SELECT but not multiple, remove current tag
      if (self.isSelect && !self.multiple && self.itemsArray.length > 0)
        self.remove(self.itemsArray[0]);

      if (typeof item === "string" && this.$element[0].tagName === 'INPUT') {
        var delimiter = (self.options.delimiterRegex) ? self.options.delimiterRegex : self.options.delimiter;
        var items = item.split(delimiter);
        if (items.length > 1) {
          for (var i = 0; i < items.length; i++) {
            this.add(items[i], true);
          }

          if (!dontPushVal)
            self.pushVal();
          return;
        }
      }

      var itemValue = self.options.itemValue(item),
          itemText = self.options.itemText(item),
          tagClass = self.options.tagClass(item),
          itemTitle = self.options.itemTitle(item);

      // Ignore items allready added
      var existing = $.grep(self.itemsArray, function(item) { return self.options.itemValue(item) === itemValue; } )[0];
      if (existing && !self.options.allowDuplicates) {
        // Invoke onTagExists
        if (self.options.onTagExists) {
          var $existingTag = $(".tag", self.$container).filter(function() { return $(this).data("item") === existing; });
          self.options.onTagExists(item, $existingTag);
        }
        return;
      }

      // if length greater than limit
      if (self.items().toString().length + item.length + 1 > self.options.maxInputLength)
        return;

      // raise beforeItemAdd arg
      var beforeItemAddEvent = $.Event('beforeItemAdd', { item: item, cancel: false, options: options});
      self.$element.trigger(beforeItemAddEvent);
      if (beforeItemAddEvent.cancel)
        return;

      // register item in internal array and map
      self.itemsArray.push(item);

      // add a tag element

      var $tag = $('<span class="tag ' + htmlEncode(tagClass) + (itemTitle !== null ? ('" title="' + itemTitle) : '') + '">' + htmlEncode(itemText) + '<span data-role="remove"></span></span>');
      $tag.data('item', item);
      self.findInputWrapper().before($tag);
      $tag.after(' ');

      // add <option /> if item represents a value not present in one of the <select />'s options
      if (self.isSelect && !$('option[value="' + encodeURIComponent(itemValue) + '"]',self.$element)[0]) {
        var $option = $('<option selected>' + htmlEncode(itemText) + '</option>');
        $option.data('item', item);
        $option.attr('value', itemValue);
        self.$element.append($option);
      }

      if (!dontPushVal)
        self.pushVal();

      // Add class when reached maxTags
      if (self.options.maxTags === self.itemsArray.length || self.items().toString().length === self.options.maxInputLength)
        self.$container.addClass('bootstrap-tagsinput-max');

      self.$element.trigger($.Event('itemAdded', { item: item, options: options }));
    },

    /**
     * Removes the given item. Pass true to dontPushVal to prevent updating the
     * elements val()
     */
    remove: function(item, dontPushVal, options) {
      var self = this;

      if (self.objectItems) {
        if (typeof item === "object")
          item = $.grep(self.itemsArray, function(other) { return self.options.itemValue(other) ==  self.options.itemValue(item); } );
        else
          item = $.grep(self.itemsArray, function(other) { return self.options.itemValue(other) ==  item; } );

        item = item[item.length-1];
      }

      if (item) {
        var beforeItemRemoveEvent = $.Event('beforeItemRemove', { item: item, cancel: false, options: options });
        self.$element.trigger(beforeItemRemoveEvent);
        if (beforeItemRemoveEvent.cancel)
          return;

        $('.tag', self.$container).filter(function() { return $(this).data('item') === item; }).remove();
        $('option', self.$element).filter(function() { return $(this).data('item') === item; }).remove();
        if($.inArray(item, self.itemsArray) !== -1)
          self.itemsArray.splice($.inArray(item, self.itemsArray), 1);
      }

      if (!dontPushVal)
        self.pushVal();

      // Remove class when reached maxTags
      if (self.options.maxTags > self.itemsArray.length)
        self.$container.removeClass('bootstrap-tagsinput-max');

      self.$element.trigger($.Event('itemRemoved',  { item: item, options: options }));
    },

    /**
     * Removes all items
     */
    removeAll: function() {
      var self = this;

      $('.tag', self.$container).remove();
      $('option', self.$element).remove();

      while(self.itemsArray.length > 0)
        self.itemsArray.pop();

      self.pushVal();
    },

    /**
     * Refreshes the tags so they match the text/value of their corresponding
     * item.
     */
    refresh: function() {
      var self = this;
      $('.tag', self.$container).each(function() {
        var $tag = $(this),
            item = $tag.data('item'),
            itemValue = self.options.itemValue(item),
            itemText = self.options.itemText(item),
            tagClass = self.options.tagClass(item);

          // Update tag's class and inner text
          $tag.attr('class', null);
          $tag.addClass('tag ' + htmlEncode(tagClass));
          $tag.contents().filter(function() {
            return this.nodeType == 3;
          })[0].nodeValue = htmlEncode(itemText);

          if (self.isSelect) {
            var option = $('option', self.$element).filter(function() { return $(this).data('item') === item; });
            option.attr('value', itemValue);
          }
      });
    },

    /**
     * Returns the items added as tags
     */
    items: function() {
      return this.itemsArray;
    },

    /**
     * Assembly value by retrieving the value of each item, and set it on the
     * element.
     */
    pushVal: function() {
      var self = this,
          val = $.map(self.items(), function(item) {
            return self.options.itemValue(item).toString();
          });

      self.$element.val(val, true).trigger('change');
    },

    /**
     * Initializes the tags input behaviour on the element
     */
    build: function(options) {
      var self = this;

      self.options = $.extend({}, defaultOptions, options);
      // When itemValue is set, freeInput should always be false
      if (self.objectItems)
        self.options.freeInput = false;

      makeOptionItemFunction(self.options, 'itemValue');
      makeOptionItemFunction(self.options, 'itemText');
      makeOptionFunction(self.options, 'tagClass');

      // Typeahead Bootstrap version 2.3.2
      if (self.options.typeahead) {
        var typeahead = self.options.typeahead || {};

        makeOptionFunction(typeahead, 'source');

        self.$input.typeahead($.extend({}, typeahead, {
          source: function (query, process) {
            function processItems(items) {
              var texts = [];

              for (var i = 0; i < items.length; i++) {
                var text = self.options.itemText(items[i]);
                map[text] = items[i];
                texts.push(text);
              }
              process(texts);
            }

            this.map = {};
            var map = this.map,
                data = typeahead.source(query);

            if ($.isFunction(data.success)) {
              // support for Angular callbacks
              data.success(processItems);
            } else if ($.isFunction(data.then)) {
              // support for Angular promises
              data.then(processItems);
            } else {
              // support for functions and jquery promises
              $.when(data)
               .then(processItems);
            }
          },
          updater: function (text) {
            self.add(this.map[text]);
            return this.map[text];
          },
          matcher: function (text) {
            return (text.toLowerCase().indexOf(this.query.trim().toLowerCase()) !== -1);
          },
          sorter: function (texts) {
            return texts.sort();
          },
          highlighter: function (text) {
            var regex = new RegExp( '(' + this.query + ')', 'gi' );
            return text.replace( regex, "<strong>$1</strong>" );
          }
        }));
      }

      // typeahead.js
      if (self.options.typeaheadjs) {
          var typeaheadConfig = null;
          var typeaheadDatasets = {};

          // Determine if main configurations were passed or simply a dataset
          var typeaheadjs = self.options.typeaheadjs;
          if ($.isArray(typeaheadjs)) {
            typeaheadConfig = typeaheadjs[0];
            typeaheadDatasets = typeaheadjs[1];
          } else {
            typeaheadDatasets = typeaheadjs;
          }

          self.$input.typeahead(typeaheadConfig, typeaheadDatasets).on('typeahead:selected', $.proxy(function (obj, datum) {
            if (typeaheadDatasets.valueKey)
              self.add(datum[typeaheadDatasets.valueKey]);
            else
              self.add(datum);
            self.$input.typeahead('val', '');
          }, self));
      }

      self.$container.on('click', $.proxy(function(event) {
        if (! self.$element.attr('disabled')) {
          self.$input.removeAttr('disabled');
        }
        self.$input.focus();
      }, self));

        if (self.options.addOnBlur && self.options.freeInput) {
          self.$input.on('focusout', $.proxy(function(event) {
              // HACK: only process on focusout when no typeahead opened, to
              //       avoid adding the typeahead text as tag
              if ($('.typeahead, .twitter-typeahead', self.$container).length === 0) {
                self.add(self.$input.val());
                self.$input.val('');
              }
          }, self));
        }


      self.$container.on('keydown', 'input', $.proxy(function(event) {
        var $input = $(event.target),
            $inputWrapper = self.findInputWrapper();

        if (self.$element.attr('disabled')) {
          self.$input.attr('disabled', 'disabled');
          return;
        }

        switch (event.which) {
          // BACKSPACE
          case 8:
            if (doGetCaretPosition($input[0]) === 0) {
              var prev = $inputWrapper.prev();
              if (prev.length) {
                self.remove(prev.data('item'));
              }
            }
            break;

          // DELETE
          case 46:
            if (doGetCaretPosition($input[0]) === 0) {
              var next = $inputWrapper.next();
              if (next.length) {
                self.remove(next.data('item'));
              }
            }
            break;

          // LEFT ARROW
          case 37:
            // Try to move the input before the previous tag
            var $prevTag = $inputWrapper.prev();
            if ($input.val().length === 0 && $prevTag[0]) {
              $prevTag.before($inputWrapper);
              $input.focus();
            }
            break;
          // RIGHT ARROW
          case 39:
            // Try to move the input after the next tag
            var $nextTag = $inputWrapper.next();
            if ($input.val().length === 0 && $nextTag[0]) {
              $nextTag.after($inputWrapper);
              $input.focus();
            }
            break;
         default:
             // ignore
         }

        // Reset internal input's size
        var textLength = $input.val().length,
            wordSpace = Math.ceil(textLength / 5),
            size = textLength + wordSpace + 1;
        $input.attr('size', Math.max(this.inputSize, $input.val().length));
      }, self));

      self.$container.on('keypress', 'input', $.proxy(function(event) {
         var $input = $(event.target);

         if (self.$element.attr('disabled')) {
            self.$input.attr('disabled', 'disabled');
            return;
         }

         var text = $input.val(),
         maxLengthReached = self.options.maxChars && text.length >= self.options.maxChars;
         if (self.options.freeInput && (keyCombinationInList(event, self.options.confirmKeys) || maxLengthReached)) {
            // Only attempt to add a tag if there is data in the field
            if (text.length !== 0) {
               self.add(maxLengthReached ? text.substr(0, self.options.maxChars) : text);
               $input.val('');
            }

            // If the field is empty, let the event triggered fire as usual
            if (self.options.cancelConfirmKeysOnEmpty === false) {
               event.preventDefault();
            }
         }

         // Reset internal input's size
         var textLength = $input.val().length,
            wordSpace = Math.ceil(textLength / 5),
            size = textLength + wordSpace + 1;
         $input.attr('size', Math.max(this.inputSize, $input.val().length));
      }, self));

      // Remove icon clicked
      self.$container.on('click', '[data-role=remove]', $.proxy(function(event) {
        if (self.$element.attr('disabled')) {
          return;
        }
        self.remove($(event.target).closest('.tag').data('item'));
      }, self));

      // Only add existing value as tags when using strings as tags
      if (self.options.itemValue === defaultOptions.itemValue) {
        if (self.$element[0].tagName === 'INPUT') {
            self.add(self.$element.val());
        } else {
          $('option', self.$element).each(function() {
            self.add($(this).attr('value'), true);
          });
        }
      }
    },

    /**
     * Removes all tagsinput behaviour and unregsiter all event handlers
     */
    destroy: function() {
      var self = this;

      // Unbind events
      self.$container.off('keypress', 'input');
      self.$container.off('click', '[role=remove]');

      self.$container.remove();
      self.$element.removeData('tagsinput');
      self.$element.show();
    },

    /**
     * Sets focus on the tagsinput
     */
    focus: function() {
      this.$input.focus();
    },

    /**
     * Returns the internal input element
     */
    input: function() {
      return this.$input;
    },

    /**
     * Returns the element which is wrapped around the internal input. This
     * is normally the $container, but typeahead.js moves the $input element.
     */
    findInputWrapper: function() {
      var elt = this.$input[0],
          container = this.$container[0];
      while(elt && elt.parentNode !== container)
        elt = elt.parentNode;

      return $(elt);
    }
  };

  /**
   * Register JQuery plugin
   */
  $.fn.tagsinput = function(arg1, arg2, arg3) {
    var results = [];

    this.each(function() {
      var tagsinput = $(this).data('tagsinput');
      // Initialize a new tags input
      if (!tagsinput) {
          tagsinput = new TagsInput(this, arg1);
          $(this).data('tagsinput', tagsinput);
          results.push(tagsinput);

          if (this.tagName === 'SELECT') {
              $('option', $(this)).attr('selected', 'selected');
          }

          // Init tags from $(this).val()
          $(this).val($(this).val());
      } else if (!arg1 && !arg2) {
          // tagsinput already exists
          // no function, trying to init
          results.push(tagsinput);
      } else if(tagsinput[arg1] !== undefined) {
          // Invoke function on existing tags input
            if(tagsinput[arg1].length === 3 && arg3 !== undefined){
               var retVal = tagsinput[arg1](arg2, null, arg3);
            }else{
               var retVal = tagsinput[arg1](arg2);
            }
          if (retVal !== undefined)
              results.push(retVal);
      }
    });

    if ( typeof arg1 == 'string') {
      // Return the results from the invoked function calls
      return results.length > 1 ? results : results[0];
    } else {
      return results;
    }
  };

  $.fn.tagsinput.Constructor = TagsInput;

  /**
   * Most options support both a string or number as well as a function as
   * option value. This function makes sure that the option with the given
   * key in the given options is wrapped in a function
   */
  function makeOptionItemFunction(options, key) {
    if (typeof options[key] !== 'function') {
      var propertyName = options[key];
      options[key] = function(item) { return item[propertyName]; };
    }
  }
  function makeOptionFunction(options, key) {
    if (typeof options[key] !== 'function') {
      var value = options[key];
      options[key] = function() { return value; };
    }
  }
  /**
   * HtmlEncodes the given value
   */
  var htmlEncodeContainer = $('<div />');
  function htmlEncode(value) {
    if (value) {
      return htmlEncodeContainer.text(value).html();
    } else {
      return '';
    }
  }

  /**
   * Returns the position of the caret in the given input field
   * http://flightschool.acylt.com/devnotes/caret-position-woes/
   */
  function doGetCaretPosition(oField) {
    var iCaretPos = 0;
    if (document.selection) {
      oField.focus ();
      var oSel = document.selection.createRange();
      oSel.moveStart ('character', -oField.value.length);
      iCaretPos = oSel.text.length;
    } else if (oField.selectionStart || oField.selectionStart == '0') {
      iCaretPos = oField.selectionStart;
    }
    return (iCaretPos);
  }

  /**
    * Returns boolean indicates whether user has pressed an expected key combination.
    * @param object keyPressEvent: JavaScript event object, refer
    *     http://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
    * @param object lookupList: expected key combinations, as in:
    *     [13, {which: 188, shiftKey: true}]
    */
  function keyCombinationInList(keyPressEvent, lookupList) {
      var found = false;
      $.each(lookupList, function (index, keyCombination) {
          if (typeof (keyCombination) === 'number' && keyPressEvent.which === keyCombination) {
              found = true;
              return false;
          }

          if (keyPressEvent.which === keyCombination.which) {
              var alt = !keyCombination.hasOwnProperty('altKey') || keyPressEvent.altKey === keyCombination.altKey,
                  shift = !keyCombination.hasOwnProperty('shiftKey') || keyPressEvent.shiftKey === keyCombination.shiftKey,
                  ctrl = !keyCombination.hasOwnProperty('ctrlKey') || keyPressEvent.ctrlKey === keyCombination.ctrlKey;
              if (alt && shift && ctrl) {
                  found = true;
                  return false;
              }
          }
      });

      return found;
  }

  /**
   * Initialize tagsinput behaviour on inputs and selects which have
   * data-role=tagsinput
   */
  $(function() {
    $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
  });
})(window.jQuery);
</script>