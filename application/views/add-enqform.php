<script src="<?=base_url()?>/assets/summernote/summernote-bs4.min.js"></script>
<script src="<?=base_url()?>/assets/summernote/summernote-bs4.min.js"></script>
<script src="<?=base_url()?>/assets/js/select2-1.min.js"></script>
<link href="<?=base_url()?>/assets/summernote/summernote-bs4.css" rel="stylesheet" />
<link href="<?=base_url()?>/assets/css/select2-1.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous"/>       
 


<!-- Time line css start -->
<style>
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
  left: 20%;
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
  margin: 0 0 15px 25%;
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
  left: 20%;
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
    position: relative;
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
    float: right;
    left: auto;
    margin: -55px 5px 0 0px;
  } 
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
.nav-tabs > li.active > a {
    color: #555 !important;
    background-color: #fff;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<div class="row">
  <?php echo form_open_multipart('enquiry/create2','class="form-inner"') ?> 
   <div class="col-md-12" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
      <div class="col-md-4" > 
        <?php
        //print_r($enquiry);
        if (!empty($enquiry)) {
          if($enquiry->status == 1){
            echo "Enquiry Details";
          }else if($enquiry->status == 2){
            echo "Lead Details";            
          }else if ($enquiry->status == 3) {
            echo "Client Details";                        
          }
        }
        ?>
        <!-- Enquiry / Update Enquiry -->
      </div>
       <div class="form-group col-sm-4">
                        <label> <?php echo display("proccess"); ?> <i class="text-danger"></i></label>
                        <select name="product_id" class="form-control">
                           <option value="">----Select----</option>
                           <?php foreach($products as $product){?>
                           <option value="<?=$product->sb_id ?>" ><?=$product->product_name ?></option>
                           <?php } ?>
                        </select>
                     </div>
      <div class="col-md-4" >
         <div style="float:right">
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" onClick="window.location.reload();" title="Refresh">
               <i class="fa fa-refresh icon_color"></i>
               </a>  
            </div>
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="dropdown-toggle" href="<?php echo base_url()?>enquiry/create" title="<?php echo display('add_new_enquiry');?>"> <i class="fa fa-plus" style="background:#fff !important;border:none!important;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
            </div>
            
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" href="<?php echo base_url(); ?>enquiry" title="Refresh">
               <i class="fa fa-arrow-left icon_color"></i>
               </a>                                                    
            </div>
         </div>
      </div>
   </div>
   
   <div  class="row col-md-12" id="ThreadEnq">
      <div class="col-md-3"  style="text-align:center;min-height: calc(100vh - 105px);background:#F6F8F8; max-height: 1048px;">
        <?php
            $string = $this->session->userdata('fullname');           
            function initials($str) {     
                $ret = '';
                foreach (explode(' ', $str) as $word)
                $ret .= strtoupper(substr($word,0,1));
                return $ret; 
            }       
            ?>
         <div class="avatar" style="margin-top:5%;margin-left:-15%;">
            <p data-lettersbig="<?php echo initials($string);?>"> </p>
         </div>

         <h5 style="text-align:center"><br><br><?= $this->session->userdata('fullname'); ?>
            
            <br><?= $this->session->userdata('email'); ?>       
         </h5>
 

         <table style="width: 100%;margin-top: 5%;" id="dataTable" class="table table-responsive-sm table-hover table-outline mb-0" >
            <tbody>
               <tr>
                  <td><button class="btn btn-basic" type="button" style="width: 100%;">Disposition</button></td>
               </tr>
            </tbody>
         </table>
            <div class="row" >
              

     
               
                <div class="form-group col-sm-12">
                           <!--<label class="col-form-label">Lead Stage</label>-->

                           <?php if(!empty($stagelist_withoutpro)){?>
                            <select class="form-control" id="lead_stage_change" name="lead_stage" onchange="find_description()">
                              <option value="">---Select Stage---</option>
                              <?php foreach($stagelist_withoutpro as $lswp){?>
                              <option value="<?= $lswp->stg_id?>"><?= $lswp->lead_stage_name?></option>
                            <?php }?>
                           </select>


                           <?php }else{?>
                           <select class="form-control" id="lead_stage_change" name="lead_stage" onchange="find_description()">
                              <option value="">---Select Stage---</option>
                             
                           </select>

                         <?php }?>
                    </div>

                    <div class="form-group col-sm-12">
                           <!--<label class="col-form-label">Description</label>-->
                           <select class="form-control" id="lead_description" name="lead_description" onchange="showDiv(this)">
                               <option value="">---Select Description---</option>
                              
                        </div>


                    
                    <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Name</label>
                  <input type="hidden" class="form-control" value="" name="contact_person1"  placeholder="Contact Person Name">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Designation</label>
                  <input type="hidden" class="form-control" name="designation1" value="" placeholder="Contact Person Designation">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Mobile No</label>
                  <input type="hidden" class="form-control" value="" name="mobileno1" placeholder="Mobile No">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Email</label>
                  <input type="hidden" class="form-control" value="" name="email1" placeholder="Email">
               </div>

                     <div class="form-group col-sm-12" id="otherTypev">
                                    <div class="form-group col-sm-12">
                                    <input type="date" name="c_date" class="form-control" placeholder="" >
                                </div>
                                <div class="form-group col-sm-12">
                                    <input type="time" name="c_time" class="form-control" placeholder="" >
                                </div>
                                </div>
                   
                        <div class="form-group col-sm-12">
                                    <!--<label>Remaks</label>-->
                          <textarea class="form-control" name="conversation"></textarea>
                        </div>
        
            
            </div>         
      </div>

      <div class="col-md-6 card card-body" style="background:#fff;">
         <div id="exTab3" class="">
            <ul  class="nav nav-tabs" role="tablist">
                <li class="active"><a  href="#basic" data-toggle="tab" style="padding: 15px 25px; font-size:15px;">Basic</a></li>
               
            </ul>
            <div class="tab-content clearfix">
                      <div class="tab-pane active" id="basic">
                  <hr>                                    
                  
          <div class="row">
            <div class="col-md-12 col-sm-12">
             
                  <div id="error" class='btn btn-danger form-group col-sm-12'style="display:none;text-align:left"></div>
                  <div id="success" class='btn btn-success form-group col-sm-12' style="display:none;text-align:left"></div>
                   <?php
                  if(user_access(230) || user_access(231) || user_access(232) || user_access(233) || user_access(234) || user_access(235) || user_access(236)){ ?>
                  <?php
                  }
                  ?>
                   
                    <div id="basic_form_fields"></div>
                 

                     <div id="process_custom_fields"></div>
        
                  <div class="row">
                  <div class="col-md-12">
                     <div class="form-group"> 
                        <label> <?php echo display('remark'); ?></label>
                        <textarea class="form-control" rows="4" id="remarks"  name="enquiry" placeholder="Remarks"><?php  echo set_value('remarks');?></textarea>
                     </div>
                     <br>
                     <br>
                  </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6"  id="save_button">
                        <div class="row">
                           <div class="col-md-6">                                                
                              <input class="btn btn-success" type="submit" value="Save" >           
                           </div>
                        </div>
                     </div>
                  </div>
     
            </div>
         </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
      </div>
      </div>
      <div class="col-md-3 card card-body" style="max-height: 1048px; overflow-y:scroll;">
        <table style="width: 100%;margin-top: 5%;" id="dataTable" class="table table-responsive-sm table-hover table-outline mb-0" >
            <tbody>
               <tr>
                  <td><button class="btn btn-basic" type="button" style="width: 100%;">Activity Timeline</button></td>
               </tr>
            </tbody>
         </table>
          <ul class="cbp_tmtimeline" style="margin-left:-30px;">
                <li>
                  <div class="cbp_tmicon cbp_tmicon-phone"  style=""></div>
                  <div class="cbp_tmlabel"  style="background:#95a5a6;">
                    <span style="font-weight:900;font-size:15px;"></span></br>                   
                    <span style="font-weight:900;font-size:12px;"></span></br>
                    <span style="font-weight:900;font-size:10px;"></span>
                    </br>
                    <span style="font-weight:900;font-size:10px;"></span>
                    <p></p>
                  </div>
                </li>
            </ul>
      </div>      
      <style>
         #exTab3 .nav-tabs > li > a {
         border-radius: 4px 4px 0 0 ;
         }
         #exTab3 .tab-content {
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

    
      <!---- Create Task Start ---->

</div>
      <!---- Create Task End ---->
  
         </div>
      </div>
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

</div>

<!---------------------------- DROP Enquiry -------------------------------->


<!----------------------------------------------------------chat section ---------------------------------------------------------->
     
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




<!-- <script>
jQuery(document).ready(function($) {
  $('#fcity').selectstyle({
    width  : 400,
    height : 300,
    theme  : 'light',
    onchange : function(val){}
  });
});
</script> -->

<script type="text/javascript">

$(document).ready(function(){
       process_id = $("select[name='product_id']").val(); 
       url = "<?=base_url().'form/form/get_basic_field_by_process/'?>";       
      $.ajax({
          type: "POST",
          url: url,
          data: {
            'process_id':process_id
          },
          success: function(data){       
          // alert(data);         
            $("#basic_form_fields").html(data);
          }
        });


 });
   $(function () {
    $("#enquiry_date").datepicker({dateFormat:'yy-mm-dd'});
    get_custom_field_field();
  });
    $("select[name='product_id']").on('change',function(){              
      get_custom_field_field();
      get_basic_field_field();
      get_lead_stage();
    });

   function get_custom_field_field(){
      process_id = $("select[name='product_id']").val();   
      url = "<?=base_url().'form/form/get_custom_field_by_process/'?>";       
      $.ajax({
          type: "POST",
          url: url,
          data: {
            'process_id':process_id
          },
          success: function(data){       
          // alert(data);         
            $("#process_custom_fields").html(data);
          }
        });
   }


     function get_basic_field_field(){
      process_id = $("select[name='product_id']").val();  
       // alert(process_id); 
      url = "<?=base_url().'form/form/get_basic_field_by_process/'?>";       
      $.ajax({
          type: "POST",
          url: url,
          data: {
            'process_id':process_id
          },
          success: function(data){       
          // alert(data);         
            $("#basic_form_fields").html(data);
          }
        });
   }


        function get_lead_stage(){
      process_id = $("select[name='product_id']").val();  
       // alert(process_id); 
      url = "<?=base_url().'lead/get_lead_stage'?>";       
      $.ajax({
          type: "POST",
          url: url,
          data: {
            'id':process_id
          },
          success: function(data){       
          
            $("#lead_stage_change").html(data);
          }
        });
   }


  </script>

  <script>
function find_description(f=0) { 

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
        html +='<option value="new" style="">New</option>';
        html +='<option value="updt" style="">Update</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].description)+'</option>';
                }
                
                $("#lead_description").html(html);
                
            }
            
            
            });
           }

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
        html +='<option value="new" style="">New</option>';
        html +='<option value="updt" style="">Update</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].description)+'</option>';
                }
                
                $("#lead_description1").html(html);
                
            }
            
            
            });
           }

            }
  </script>

 