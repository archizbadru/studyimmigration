<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> 
<script src="<?=base_url()?>/assets/summernote/summernote-bs4.min.js"></script>
<link href="<?=base_url()?>/assets/summernote/summernote-bs4.css" rel="stylesheet" />


<style>
  /*TAG STYLE START*/
.tag {
  background: #eee;
  border-radius: 3px 0 0 3px;
  color: red;
  display: inline-block;
  height: 17px;
  line-height: 17px;
  padding: 0 10px 0 19px;
  position: relative;  
  text-decoration: none;
  -webkit-transition: color 0.2s;
  font-size: xx-small !important;  
}

.tag::before {
  background: #fff;
  border-radius: 10px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
  content: '';
  height: 6px;
  left: 10px;
  position: absolute;
  width: 6px;
  top: 6px;
}

.tag::after {
  background: #fff;
  border-bottom: 8px solid transparent;
  border-left: 10px solid #eee;
  border-top: 9px solid transparent;
  content: '';
  position: absolute;
  right: 0;
  top: 0;
}

.tag:hover {
  background-color: crimson;
  color: white;
}

.tag:hover::after {
   border-left-color: crimson; 
}
/*TAG STYLE END*/


.col-half-offset{
  margin-left:2.166667%;
}
.enq_form_filters{
  width: 0px;
}
#active_class{
  font-size: 12px;
}
.lead_stage_filter{
  padding: 6px;
  background-color: #e6e9ed;
  cursor: pointer;
}
.lead_stage_filter:active{  
  background-color: #20a8d8;  
}
.lead_stage_filter:hover{  
  background-color: #20a8d8;  
}
.border_bottom_active > label{
  cursor: pointer;
}
.nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
    color: white;
    background-color: #37a000;
}

.nav-pills > li > a {
    border-radius: 5px;
    padding: 10px;
    color: #000;
    font-weight: 600;
}

.nav-pills > li > a:hover {
    color: #000;
    background-color: transparent;
}
              .dropdown-header {
    padding: 8px 20px;
    background: #e4e7ea;
    border-bottom: 1px solid #c8ced3;
}

.dropdown-header {
    display: block;
    padding: 0 1.5rem;
    margin-bottom: 0;
   
    color: #73818f;
    white-space: nowrap;
}
input[name=top_filter]{
  visibility: hidden;
}

input[name=lead_stages]{
  visibility: hidden;
}

.dropdown_css {
  left:auto!important;
  right: 0 ! important;
}
.dropdown_css a,.dropdown_css a h4{
  width:100%;text-align:left! important;
  border-bottom: 1px solid #c8ced3! important;
}

.border_bottom{
  border-bottom:2px solid #E4E5E6;min-height: 7vh;margin-bottom: 1vh;cursor:pointer;
}  
.border_bottom_active{
  border-bottom:2px solid #20A8D8;min-height: 7vh;margin-bottom: 1vh;cursor:pointer;
} 

.filter-dropdown-menu li{
  padding-left: 6px;
}

.filter-dropdown-menu li{
  padding-left: 6px;
}
@media screen and (max-width: 900px) {
  #active_class{
    display: none;
  }
}

.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 34px !important;
    user-select: none;
    -webkit-user-select: none;
}
</style>


<form method="post" id="enq_filter" >
<div class="row">
 <div class="row" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">  
        <div class="col-md-4 col-sm-4 col-xs-4" > 
          <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>
          <?php if($this->uri->segment(1)=='enq'){ ?>        
          <a class="dropdown-toggle btn btn-danger btn-circle btn-sm fa fa-plus" id="enq-create" href="<?php echo base_url()?>enquiry/create" title="<?php echo display('add_new_enquiry');?>"></a>
          <?php } ?>
        </div>
         <div class="col-md-4 col-sm-8 col-xs-8 pull-right" >  
          <div style="float: right;">     
      <?php if(!empty($this->session->telephony_token)){ ?>
              <div class="btn-group dropdown-filter">
                      <?php if($this->session->availability == 1) { ?>
                      <button class="btn btn-success" type="button" data-toggle="modal" data-target="#callbreak" >Available</button>
                    <?php } elseif($this->session->availability == 2) { ?>
                      <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#callbreak" > Not Available</button>
                    <?php } ?>
              </div>  
            <?php } ?> 
            <div class="btn-group dropdown-filter">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter by <span class="caret"></span>
              </button>              
              <ul class="filter-dropdown-menu dropdown-menu">   
                    <li>
                      <label>
                      <input type="checkbox" value="date" id="datecheckbox" name="filter_checkbox"> Date </label>
                    </li>  
                    <li>
                      <label>
                      <input type="checkbox" value="emp" id="empcheckbox" name="filter_checkbox"> Name</label>
                    </li> 
                    <li>
                      <label>
                      <input type="checkbox" value="source" id="sourcecheckbox" name="filter_checkbox"> Source</label>
                    </li>                
                    <li>
                      <label>
                      <input type="checkbox" value="subsource" id="subsourcecheckbox" name="filter_checkbox">Sub Source</label>
                    </li>                
                   <li>
                      <label>
                      <input type="checkbox" value="email" id="emailcheckbox" name="filter_checkbox"> Email</label>
                    </li> 
                    <li>
                      <label>
                      <input type="checkbox" value="phone" id="phonecheckbox" name="filter_checkbox"> Phone</label>
                    </li>
                    <li>
                      <label>
                      <input type="checkbox" value="address" id="addcheckbox" name="filter_checkbox"> Address</label>
                    </li>
                    <li>
                      <label>
                      <input type="checkbox" value="datasource" id="datasrccheckbox" name="filter_checkbox"> Datasource</label>
                    </li> 
                    <!-- <li>
                      <label>
                      <input type="checkbox"  value="company" id="companycheckbox" name="filter_checkbox"> Company Name</label>
                    </li>  -->
                    <li>
                      <label>
                      <input type="checkbox" value="created_by" id="createdbycheckbox" name="filter_checkbox"> Created By</label>
                    </li> 
                    <li>
                      <label>
                      <input type="checkbox" value="assign_to" id="assigncheckbox" name="filter_checkbox"> Assign To</label>
                    </li>
                    <li>
                      <label>
                      <input type="checkbox" value="process" id="proccheckbox" name="filter_checkbox"> Process</label>
                    </li> 
                    <li>
                      <label>
                      <input type="checkbox" value="product" id="prodcheckbox" name="filter_checkbox"> Prog. Required</label>
                    </li> 
                    <li>
                      <label>
                      <input type="checkbox" value="state" id="statecheckbox" name="filter_checkbox"> State</label>
                    </li> 
                    <li>
                      <label>
                      <input type="checkbox" value="city" id="citycheckbox" name="filter_checkbox"> City</label>
                    </li> 
                     <li>
                      <label>
                      <input type="checkbox" value="stage" id="stageheckbox" name="filter_checkbox"> Stage</label>
                    </li>

                    <li>
                      <label>
                      <input type="checkbox" value="final" id="finalcheckbox" name="filter_checkbox"> Final Country</label>
                    </li>
                    <li>
                      <label>
                      <input type="checkbox" value="intake" id="intakecheckbox" name="filter_checkbox"> In Take</label>
                    </li>
                    <li>
                      <label>
                      <input type="checkbox" value="visatype" id="visacheckbox" name="filter_checkbox"> Visa Type</label>
                    </li>
                    <li>
                      <label>
                      <input type="checkbox" value="preferred" id="preferredcheckbox" name="filter_checkbox"> Preferred Country</label>
                    </li>
                    <li>
                      <label>
                      <input type="checkbox" value="nationality" id="nationalitycheckbox" name="filter_checkbox"> Nationality </label>
                    </li>
                    <li>
                      <label>
                      <input type="checkbox" value="residing" id="residingcheckbox" name="filter_checkbox"> Residing Country</label>
                    </li>
                    <?php
                    if(user_access(710)){
                    ?>  
                    <li>
                      <label>
                      <input type="checkbox" value="tag" id="tagcheckbox" name="filter_checkbox"> Tag</label>
                    </li> 
                    <?php
                    }
                    ?> 
                    <li class="text-center">
                      <a href="javascript:void(0)" class="btn btn-sm btn-primary " id='save_advance_filters' title="Save Filters Settings"><i class="fa fa-save"></i></a>
                    </li>                   
                </ul>                
            </div>

            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="Actions">
                <i class="fa fa-sliders"></i>
              </a>  
            <div class="dropdown-menu dropdown_css" style="max-height: 400px;overflow: auto;">
              <?php
              if ($data_type == 1) { ?>                                
                <a class="btn" data-toggle="modal" data-target="#AssignSelected" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #fff;"><?php echo display('assign_selected'); ?></a>
                <a class="btn" data-toggle="modal" data-target="#genLead" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #fff;"><?php echo display('move_to_lead'); ?> </a>
                <a class="btn" data-toggle="modal" data-target="#dropEnquiry" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('drop_enquiry'); ?></a>      
                <a class="btn"  data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('1','Send Whatssp');"  style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('send_whatsapp'); ?> </a>
                <a class="btn " data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('2','Send Sms');" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('send_bulk_sms'); ?></a>               
              <?php
              }else if ($data_type == 2) { ?>
                  <a class="btn" data-toggle="modal" data-target="#AssignSelected" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #fff;"><?php echo display('assign_selected'); ?></a>
                  <a class="btn" data-toggle="modal" data-target="#genclient" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #fff;">Move To Case Management </a>
                  <a class="btn" data-toggle="modal" data-target="#dropEnquiry" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('drop_lead'); ?></a>
                  <a class="btn"  data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('1','Send Whatssp');"  style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('send_whatsapp'); ?> </a>
                  <a class="btn " data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('2','Send Sms');" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('send_bulk_sms'); ?></a>
              <?php
              }else if ($data_type == 3) { ?>
                  <a class="btn" data-toggle="modal" data-target="#AssignSelected" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #fff;"><?php echo display('assign_selected'); ?></a>
                  <a class="btn"  data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('1','Send Whatssp');"  style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('send_whatsapp'); ?> </a>
                  <a class="btn " data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('2','Send Sms');" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('send_bulk_sms'); ?></a>
              <?php
              }
              ?>
              
              <a class="btn " data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('3','Send Email');" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('send_bulk_email'); ?></a>               

              <?php if(user_access(220)) { if(!empty($this->session->telephony_token)){ ?>
                <a class="btn "  onclick="autoDial()" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('bulk_autodial'); ?></a>
              <?php } } ?>
              <a class="btn" data-toggle="modal" data-target="#table-col-conf" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('table_config'); ?></a>
              <?php if(user_access(710)){ ?>
                  <a class="btn" href="<?php echo base_url()?>lead/tags" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo 'Create Tag'; ?></a> 
                  <a class="btn" data-toggle="modal" data-target="#tagas" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo 'Tag AS'; ?></a>   
                  <?php } ?>                         
              <a class="btn" data-toggle="modal" data-target="#deleteselected" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff; display: none;"><?php echo 'Delete Data'; ?></a>                         
            </div>                                         
          </div>  
        </div>       
      </div>
</div>

<div id="genclient" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter info and Move to Case management</h4>
      </div>
      <div class="modal-body">        
          <div class="row">
            <div class="form-group col-sm-6">  
            <label>Expected Closer Date</label>                  
            <input class="form-control date2"  name="expected_date" type="text" readonly>                
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
            </div>
          </div>          
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="button" onclick="moveto_client();" >Move to Case management</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div style="float:right;">
  <a class="btn btn-xs  btn-primary" href="javascript:void(0)" id="show_quick_counts" title="Show Quick Dashboard"><i class="fa fa-bar-chart"></i></a>
</div>
<div class="row"  id="active_class" style="display: none;">                   
            <div class="col-xs-12 col-sm-12  col-md-2 col-lg-2 col-half-offset" style="">
            <div  class="col-12 border_bottom" >
                <p style="margin-top: 2vh;font-weight:bold;">
                  <input id='created_today_radio' value="created_today" type="radio" name="top_filter" class="enq_form_filters"><i class="fa fa-edit" ></i><label for="created_today_radio">&nbsp;&nbsp;<?php echo display('created_today'); ?></label>
                  <span  style="float:right;" class="badge badge-pill badge-primary " id="today_created"><i class="fa fa-spinner fa-spin"></i></span>
                </p>
            </div>
            </div>
            <div class="col-xs-12 col-sm-12  col-md-2 col-lg-2 col-half-offset">
              <div class="col-12 border_bottom">
                  <p style="margin-top: 2vh;font-weight:bold;" >
                    <input type="radio" name="top_filter" value="updated_today" class="enq_form_filters" id="updated_today_radio"><i class="fa fa-pencil"></i><label for="updated_today_radio">&nbsp;&nbsp;<?php echo display('updated_today'); ?></label><span style="float:right;background:#ffc107" class="badge badge-pill badge-warning badge badge-dark " id="today_updated"><i class="fa fa-spinner fa-spin"></i></span>
                  </p>
              </div>
            </div>
            
            <div class="col-xs-12 col-sm-12  col-md-2 col-lg-2 col-half-offset">
            <div  class="col-12 border_bottom border_bottom_active" >
                  <p style="margin-top: 2vh;font-weight:bold;"  title="<?php echo display('active'); ?>"> 
                    <input type="radio" name="top_filter" value="active" checked="checked" class="enq_form_filters" id="active_radio"><i class="fa fa-file" ></i><label for="active_radio">&nbsp;&nbsp;<?php echo display('active'); ?></label><span style="float:right;" class="badge badge-pill badge-primary " id="active_all"><i class="fa fa-spinner fa-spin"></i></span>
                  </p>
              </div>
            </div>
                  
            <div class="col-xs-12 col-sm-12  col-md-2 col-lg-2 col-half-offset">
              <div  class="col-12 border_bottom" >
                  <p style="margin-top: 2vh;font-weight:bold;"   title="<?php echo display('droped'); ?>">
                      <input type="radio" name="top_filter" value="droped" class="enq_form_filters" id="droped_radio">
                      <i class="fa fa-thumbs-down" ></i><label for="droped_radio">&nbsp;&nbsp;<?php echo display('droped'); ?></label><span style="float:right;background:#E5343D" class="badge badge-danger" id="active_drop"><i class="fa fa-spinner fa-spin"></i></span>                   
                  </p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12  col-md-2 col-lg-2 col-half-offset">
              <div class="col-12 border_bottom" >

                  <p style="margin-top: 2vh;font-weight:bold;"  title="<?php echo display('total'); ?>">
                    <input type="radio" name="top_filter" value="all" class="enq_form_filters" id="total_active_radio">
                    <i class="fa fa-list"></i><label for="total_active_radio">&nbsp;&nbsp;<?php echo display('total'); ?></label><span style="float:right;background:#000" class="badge badge-pill badge-dark " id="total_active"><i class="fa fa-spinner fa-spin"></i></span>
                  </p>
              </div>
          </div>   
    </div>
</div>
<script type="text/javascript">
$(window).load(function(){  
$("#active_class p").click(function() {
    $('.border_bottom_active').removeClass('border_bottom_active');
    $(this).addClass("border_bottom_active");

    $(this).find('label').trigger('click');
});
});
$("#show_quick_counts").on('click',function(){
  document.getElementById('active_class').style.display='block';
  $(this).hide();
        $("#active_class").removeClass('hide_countings');    
  update_top_filter_counter();   
 

});  

</script>

<?php
$stage_pipeline  = get_sys_parameter('stage_pipeline','COMPANY_SETTING');
if(!empty($stage_pipeline) && $stage_pipeline=='1')
{
?>
<div class="row">
  <div class="col-lg-12 " style="padding-top: 5px;">
    <div id="crumbs">
    <ul>
    <?php
      if(!empty($all_stage_lists))
      {
        foreach ($all_stage_lists as $stage) 
        { 
          echo '<li class="top_pill" data-stage-id="'.$stage->stg_id.'"><a>'.$stage->lead_stage_name.'</a></li>';
        }
                
      }
    ?>  

    </ul></div>

<?php
if(!empty($_GET['desposition']))
{
  echo'<script>
  $(document).ready(function(){
         setTimeout(call_to_disposition,1000);
    });

  function call_to_disposition()
  {
    var x = $("li[data-stage-id=\''.$_GET['desposition'].'\'");
       try{
        $(x[0]).trigger("click");
        }catch(e){alert(e);}
  }

  </script>';
}
?> 
   <style type="text/css">   
#crumbs {
  text-align: center;
}

#crumbs ul {
  margin: 0;
  padding: 0; 
  list-style: none;
  display: inline-block;
  height: 40px!important;
  white-space: nowrap;
  overflow-x: auto;
  overflow-y: hidden;
  width: 100%;
}
#crumbs ul li {
  display: inline-block;
  white-space: nowrap;
}
#crumbs ul li a {
display: block;
    float: left;
    height: 30px;
    background: #F3F5FA;
    text-align: center;
    padding: 6px 10px 0 30px;
    position: relative;
    margin: 0 10px 0 0;
    font-size: 12px;
    text-decoration: none;
    color: #32373c;
    cursor: pointer;
}
#crumbs ul li a:after {
     content: "";
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid #F3F5FA;
    position: absolute;
    right: -15px;
    top: 0;
    z-index: 1;
}
#crumbs ul li a:before {
    content: "";
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid #fff;
    position: absolute;
    left: 0px;
    top: 0;
}

/*#crumbs ul li:first-child a {
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}*/

/*#crumbs ul li:first-child a:before {
  display: none;
}
*/
/*#crumbs ul li:last-child a {
  padding-right: 40px;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
}

#crumbs ul li:last-child a:after {
  display: none;
}*/

#crumbs ul li a:hover {
  background: #357DFD;
  border-left-color: #357DFD;
  color: #fff;
}

#crumbs ul li a:hover:after {
  border-left-color: #357DFD;
  color: #fff;
}
#crumbs ul li.top-active a:after
{
  border-left-color: #357DFD;
  color: #fff;
}
#crumbs ul li.top-active a{
  background: #357DFD;
  font-weight: 700;
  color: #fff;
}
   </style>
  
  </div>
</div>

<?php
}
?>

<br>

<!------ Filter Div ---------->
 <div class="row" id="filter_pannel">
        <div class="col-lg-12">
            <div class="panel panel-default">
               
                      <div class="form-row">
                       
                        <div class="form-group col-md-3" id="fromdatefilter">
                          <label for="from-date"><?php echo display("from_date"); ?></label>
                          <input type="date" class="form-control" id="from-date" value="<?=$filterData['from_created']==''||$filterData['from_created']=='0000-00-00'?'':$filterData['from_created']?>" name="from_created" style="padding-top:0px;">
                        </div>
                        <div class="form-group col-md-3" id="todatefilter">
                          <label for="to-date"><?php echo display("to_date"); ?></label>
                          <input type="date" class="form-control" id="to-date" name="to_created" value="<?=$filterData['to_created']==''||$filterData['to_created']=='0000-00-00'?'':$filterData['to_created']?>" style="padding-top:0px;">
                        </div> 

                        <div class="form-group col-md-3" id="empfilter">
                          <label for=""><?php echo 'Name'; ?></label>
                          <input type="text" class="form-control chosen-select" name="employee" id="employee" value="<?= $filterData['employee'] ?>">                             
                        </div>

                        <div class="form-group col-md-3" id="phonefilter">
                          <label for="">Phone</label>
                         <input type="text" name="phone" class="form-control" value="<?= $filterData['phone'] ?>">
                       </div>

                        <div class="form-group col-md-3" id="emailfilter">
                          <label for=""><?php echo display("email"); ?></label>
                          <input type="text" name="email" class="form-control" value="<?= $filterData['email'] ?>">
                        </div>

                        <div class="form-group col-md-3" id="addfilter">
                          <label for="">Address</label>
                         <input type="text" name="address" class="form-control" value="<?= $filterData['address'] ?>">                        
                        </div>

                         <div class="form-group col-md-3" id="sourcefilter">
                          <label for="source"><?php echo display("source"); ?></label>
                          <select class="form-control" name="source" id="source">
                              <option value="" style="display:">---Select Source---</option>
                               <?php foreach ($sourse as $row) {?>
                                
                                 <option value="<?=$row->lsid?>" <?php if($row->lsid==$filterData['source']) {echo 'selected';}?> <?php if(!empty(set_value('source'))){if (in_array($row->lsid,set_value('source'))) {echo 'selected';}}?>><?=$row->lead_name?></option>
                              <?php }?>

                          </select>
                        </div>

                        <div class="form-group col-md-3" id="subsourcefilter">
                          <label for="subsource"><?php echo display("subsource"); ?></label>
                          <select class="form-control" name="subsource" id="subsource">
                              <option value="" style="display:">---Select Sub Source---</option>
                               <?php foreach ($subsource_list as $row) {?>                                
                                 <option value="<?=$row->subsource_id?>" <?php if($row->subsource_id==$filterData['subsource']) {echo 'selected';}?> <?php if(!empty(set_value('subsource'))){if (in_array($row->lsid,set_value('subsource'))) {echo 'selected';}}?>><?=$row->subsource_name?></option>
                              <?php }?>

                          </select>
                        </div>

                      
                         
                        <div class="form-group col-md-3" id="datasourcefilter">
                          <label for=""><?php echo display("datasource"); ?></label>
                          <select  class="form-control" name="datasource" id="datasource">
                              <option value="" style="display:">---Select Datasource---</option>
                               <?php foreach ($datasourse as $row) {?>
                                 <option value="<?=$row->datasource_id?>" <?php if($row->datasource_id==$filterData['datasource']) {echo 'selected';}?> <?php if(!empty(set_value('datasource_id'))){if (in_array($row->datasource_id,set_value('datasource_id'))) {echo 'selected';}}?>><?=$row->datasource_name?></option>
                              <?php }?>
                          </select>
                        </div>
                        <!-- <div class="form-group col-md-3" id="companyfilter">
                          <label for="">Company Name</label>
                          <input type="text" name="company" class="form-control" value="<?= $filterData['company'] ?>">
                        </div> -->
                        <div class="form-group col-md-3" id="proccessfilter">
                          <label for="enq_product"><?php echo display("proccess"); ?></label>
                          <select  class="form-control" name="enq_product" id="enq_product" >
                              <option value="">---Select process ---</option>                              
                              <?php 
                              if (!empty($products)) {
                              foreach ($products as $product) {?>
                              <option value="<?=$product->sb_id;?>" <?php if($product->sb_id==$filterData['enq_product']) {echo 'selected';}?> <?php if(!empty(set_value('enq_product'))){if (in_array($product->sb_id,set_value('enq_product'))) {echo 'selected';}}?>><?=$product->product_name;?></option>
                              <?php }}?>                              
                          </select>
                        </div>
                                          
                        
                         <div class="form-group col-md-3" id="createdbyfilter">
                          <label for="">Created By</label>
                         <select name="createdby" class="form-control" id="createdby"> 
                          <option value="">Select</option>
                         <?php 
                          if (!empty($created_bylist)) {
                              foreach ($created_bylist as $createdbylist) {?>
                              <option value="<?=$createdbylist->pk_i_admin_id;?>" <?php if($createdbylist->pk_i_admin_id==$filterData['createdby']) {echo 'selected';}?> <?php if(!empty(set_value('createdby'))){if (in_array($product->sb_id,set_value('createdby'))) {echo 'selected';}}?>><?=$createdbylist->s_display_name.' '.$createdbylist->last_name;?> -  <?=$createdbylist->s_user_email?$createdbylist->s_user_email:$createdbylist->s_phoneno;?>                               
                              </option>
                              <?php }}?>    
                         </select>                       
                        </div>

                         <div class="form-group col-md-3" id="assignfilter">
                          <label for="">Assign To</label>  
                         <select name="assign" class="form-control" id="assign"> 
                          <option value="">Select</option>
                         <?php 
                              if (!empty($created_bylist)) {
                              foreach ($created_bylist as $createdbylist) {?>
                              <option value="<?=$createdbylist->pk_i_admin_id;?>" <?php if($createdbylist->pk_i_admin_id==$filterData['assign']) {echo 'selected';}?> <?php if(!empty(set_value('assign'))){if (in_array($product->sb_id,set_value('assign'))) {echo 'selected';}}?>><?=$createdbylist->s_display_name.' '.$createdbylist->last_name;?> -  <?=$createdbylist->s_user_email?$createdbylist->s_user_email:$createdbylist->s_phoneno;?></option>
                              <?php }}?>    
                         </select>                          
                        </div>
                   
                    <div class="form-group col-md-3" id="prodfilter">
                    <label for="">Program required</label>  
                    <select name="prodcntry" class="form-control" id="prodcntry"> 
                          <option value="">Select</option>
                         <?php 
                              if (!empty($prodcntry_list)) {
                              foreach ($prodcntry_list as $prodcntrylist) {?>
                              <option value="<?=$prodcntrylist->id;?>" <?php if($prodcntrylist->id==$filterData['prodcntry']) {echo 'selected';}?> <?php if(!empty(set_value('prodcntry'))){if (in_array($prodcntrylist->id,set_value('prodcntry'))) {echo 'selected';}}?>><?= $prodcntrylist->country_name ?></option>
                              <?php }}?>    
                    </select> 
                    </div>

                    <div class="form-group col-md-3" id="statefilter">
                    <label for="">State</label>  
                    <select name="state" class="form-control" id="state"> 
                          <option value="">Select</option>
                         <?php 
                              if (!empty($state_list)) {
                              foreach ($state_list as $statelist) {?>
                              <option value="<?=$statelist->id;?>" <?php if($statelist->id==$filterData['state']) {echo 'selected';}?> <?php if(!empty(set_value('state'))){if (in_array($statelist->id,set_value('state'))) {echo 'selected';}}?>><?= $statelist->state ?></option>
                              <?php }}?>    
                    </select> 
                    </div> 

                    <div class="form-group col-md-3" id="cityfilter">
                    <label for="">City</label>  
                    <select name="city" class="form-control" id="city_name"> 
                      <option value="">Select</option>
                           <?php 
                              if (!empty($city_list)) {
                              foreach ($city_list as $citylist) {?>
                              <option value="<?=$citylist->id;?>" <?php if($citylist->id==$filterData['city']) {echo 'selected';}?> <?php if(!empty(set_value('city'))){if (in_array($citylist->id,set_value('city'))) {echo 'selected';}}?>><?= $citylist->city ?></option>
                              <?php }}?>   
                    </select> 
                    </div> 

                    <div class="form-group col-md-3" id="stagefilter">
                        <label for="">Stage</label> 
                        <select name="stage" class="form-control" id="stage">
                          <option value="">Select</option>
                          <?php foreach ($all_stage_lists as $stage) {  ?>
                              <option value="<?= $stage->stg_id?>" <?php if($stage->stg_id==$filterData['stage']) {echo 'selected';}?> <?php if(!empty(set_value('stage'))){if (in_array($stage->stg_id,set_value('stage'))) {echo 'selected';}}?>><?php echo $stage->lead_stage_name; ?></option>
                              <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-md-3" id="finalfilter">
                        <label for="">Final Country</label> 
                        <select name="final" class="form-control" id="final">
                          <option value="">Select</option>
                          <?php foreach($all_country_list as $product){ ?>
                          <option value="<?=$product->id_c?>" <?php if($product->id_c==$filterData['final']) {echo 'selected';}?> <?php if(!empty(set_value('final'))){if (in_array($product->id_c,set_value('final'))) {echo 'selected';}}?>><?=$product->country_name ?></option>
                        <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-md-3" id="intakefilter">
                        <label for="">In Take</label> 
                        <select name="intake" class="form-control" id="intake">
                          <option value="">Select</option>
                          <option value="January" <?php if($filterData['intake']=='January') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('January',set_value('intake'))) {echo 'selected';}}?>> January</option>
                          <option value="February" <?php if($filterData['intake']=='February') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('February',set_value('intake'))) {echo 'selected';}}?>> February</option>
                          <option value="March" <?php if($filterData['intake']=='March') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('March',set_value('intake'))) {echo 'selected';}}?>> March</option>
                          <option value="April" <?php if($filterData['intake']=='April') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('April',set_value('intake'))) {echo 'selected';}}?>> April</option>
                          <option value="May" <?php if($filterData['intake']=='May') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('May',set_value('intake'))) {echo 'selected';}}?>> May</option>
                          <option value="June" <?php if($filterData['intake']=='June') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('June',set_value('intake'))) {echo 'selected';}}?>> June</option>
                          <option value="July" <?php if($filterData['intake']=='July') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('July',set_value('intake'))) {echo 'selected';}}?>> July</option>
                          <option value="August" <?php if($filterData['intake']=='August') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('August',set_value('intake'))) {echo 'selected';}}?>> August</option>
                          <option value="September" <?php if($filterData['intake']=='September') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('September',set_value('intake'))) {echo 'selected';}}?>> September</option>
                          <option value="October" <?php if($filterData['intake']=='October') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('October',set_value('intake'))) {echo 'selected';}}?>> October</option>
                          <option value="November" <?php if($filterData['intake']=='November') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('November',set_value('intake'))) {echo 'selected';}}?>> November</option>
                          <option value="December" <?php if($filterData['intake']=='December') {echo 'selected';}?> <?php if(!empty(set_value('intake'))){if (in_array('December',set_value('intake'))) {echo 'selected';}}?>> December</option>
                        </select>
                      </div>

                      <div class="form-group col-md-3" id="visafilter">
                        <label for="">Visa Type</label> 
                        <select name="visatype" class="form-control" id="visatype">
                          <option value="">Select</option>
                          <?php foreach($visa_type as $visa){ ?>
                            <option value="<?php echo $visa->id; ?>" <?php if($visa->id==$filterData['visatype']) {echo 'selected';}?> <?php if(!empty(set_value('visatype'))){if (in_array($visa->id,set_value('visatype'))) {echo 'selected';}}?>><?php echo $visa->visa_type; ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-md-3" id="preferredfilter">
                        <label for="">Preferred Country</label> 
                        <select name="preferred" class="form-control" id="preferred">
                          <option value="">Select</option>
                          <?php foreach($all_country_list as $product){ ?>
                           <option value="<?=$product->id_c?>" <?php if($product->id_c==$filterData['preferred']) {echo 'selected';}?> <?php if(!empty(set_value('preferred'))){if (in_array($product->id_c,set_value('preferred'))) {echo 'selected';}}?>><?=$product->country_name ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-md-3" id="nationalityfilter">
                        <label for="">Nationality </label> 
                        <select name="nationality" class="form-control" id="nationality">
                          <option value="">Select</option>
                          <?php foreach($allcountry_list as $country){ ?>
                           <option value="<?= $country->id_c?>" <?php if($country->id_c==$filterData['nationality']) {echo 'selected';}?> <?php if(!empty(set_value('nationality'))){if (in_array($country->id_c,set_value('nationality'))) {echo 'selected';}}?>> <?= $country->country_name?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-md-3" id="residingfilter">
                        <label for="">Residing Country </label> 
                        <select name="residing" class="form-control" id="residing">
                          <option value="">Select</option>
                          <?php foreach($allcountry_list as $country){ ?>
                          <option value="<?= $country->id_c?>" <?php if($country->id_c==$filterData['residing']) {echo 'selected';}?> <?php if(!empty(set_value('residing'))){if (in_array($country->id_c,set_value('residing'))) {echo 'selected';}}?>> <?= $country->country_name?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <?php
                      if(user_access(710)){
                      ?>
                      <div class="form-group col-md-3" id="tagfilter">
                        <label for="">Tag</label> 
                        <select name="tag" class="form-control" id="tag">
                          <option value="">Select</option>
                          <?php 
                          if(!empty($tags)){
                            foreach ($tags as $t=>$tag) {  ?>
                              <option value="<?=$tag['id']?>"  <?php if($tag['id']==$filterData['tag']) {echo 'selected';}?> <?php if(!empty($filterData['tag']) && $tag['id']==$filterData['tag']) {echo 'selected';}?>><?php echo $tag['title']; ?></option>
                              <?php } 
                          } ?>
                        </select>
                      </div>                   
                      <?php
                      }
                      ?>

                      <div class="form-group col-md-3">
                    <button class="btn btn-success" id="save_filterbutton" type="button" onclick="enq_save_filter();" style="margin: 20px;">Save</button>        
                        </div>

                    </div>
          
            </div>
        </div>
    </div>   
</form>
<br>
<br>

<form class="form-inner" method="post" id="enquery_assing_from" >  
<div class="card-body">
      <?php 
        $acolarr = array();
        $dacolarr = array();
        if(isset($_COOKIE["allowcols"])) {
          $showall = false;
          $acolarr  = explode(",", trim($_COOKIE["allowcols"], ","));       
        }else{          
          $showall = true;
        }         
        if(isset($_COOKIE["dallowcols"])) {
          $dshowall = false;
          $dacolarr  = explode(",", trim($_COOKIE["dallowcols"], ","));       
        }else{
          $dshowall = false;
        }       
      ?>
  <div class="row">
    <div class="col-md-12" >    
            <table id="enq_table" class="table table-bordered table-hover mobile-optimised" style="width:100%;">
        <thead>
          <tr class="bg-info table_header">
              <th class="noExport">
                <input type='checkbox' class="checked_all1" value="check all" >
              </th>
                  <th>S.N</th>
              <?php if ($showall == true or in_array(32, $acolarr)) {  ?>
                  <th >Actions Tag</th>
            <?php } ?>
             <?php if ($showall == true or in_array(1, $acolarr)) {  ?>
                  <th><?php echo display("source"); ?></th>
             <?php } ?>
              <?php if ($showall == true or in_array(16, $acolarr)) {  ?>
                  <th >Sub Source</th>
            <?php } ?>
              <!-- <?php if ($showall == true or in_array(2, $acolarr)) {  ?>
                  <th><?php echo display("company_name"); ?></th>
                   <?php } ?> -->
              <?php if ($showall == true or in_array(3, $acolarr)) {  ?>
            <th>Name</th>
                   <?php } ?>
              <?php if ($showall == true or in_array(4, $acolarr)) {  ?>
            <th>Email </th>
                   <?php } ?>
              <?php if ($showall == true or in_array(5, $acolarr)) {  ?>
            <th>Phone <?=user_access(220)?' (Click to dial)':''?></th>
                   <?php } ?>
              <?php if ($showall == true or in_array(6, $acolarr)) {  ?>
            <th>Address</th>
                   <?php } ?>
              <?php if ($showall == true or in_array(7, $acolarr)) {  ?>
            <th>Process</th>
             <?php } ?>
              <?php if ($showall == true or in_array(8, $acolarr)) {  ?>
                  <th><?php if(display("disposition_table")){echo display("disposition_table"); }else{ echo 'Disposition'; } ?></th>
             <?php } ?>                  
           
            <?php if ($showall == true or in_array(10, $acolarr)) {  ?>
                  <th ><?php echo display("create_date"); ?></th>
          <?php } ?>
              <?php if ($showall == true or in_array(11, $acolarr)) {  ?>
                  <th ><?php echo display("created_by"); ?></th>
            <?php } ?>
             <?php if ($showall == true or in_array(12, $acolarr)) {  ?>
                  <th ><?php echo display("assign_to"); ?></th>
                <?php } ?>
             <?php if ($showall == true or in_array(13, $acolarr)) {  ?>
                  <th ><?php echo display("data_source"); ?></th>
            <?php } ?>
             <?php if ($showall == true or in_array(14, $acolarr)) {  ?>
                  <th >Program Required</th>
            <?php } ?>

            <?php if ($showall == true or in_array(17, $acolarr)) {  ?>
                  <th>EnquiryId</th>
             <?php } ?> 

             <?php if ($showall == true or in_array(18, $acolarr)) {  ?>
                  <th>Score</th>
             <?php } ?> 

               <?php if ($showall == true or in_array(19, $acolarr)) {  ?>
                  <th>Remark</th>
             <?php } ?> 
              
           
            <?php if ($showall == true or in_array(20, $acolarr)) {  ?>
                  <th >Onboarding Source</th>
            <?php } ?>
            <?php if ($showall == true or in_array(21, $acolarr)) {  ?>
                  <th >City</th>
            <?php } ?>
            <?php if ($showall == true or in_array(22, $acolarr)) {  ?>
                  <th >State</th>
            <?php } ?>
            <?php if ($showall == true or in_array(23, $acolarr)) {  ?>
                  <th >Residing Country</th>
            <?php } ?>
            <?php if ($showall == true or in_array(24, $acolarr)) {  ?>
                  <th >Branch Name</th>
            <?php } ?>
            <?php if ($showall == true or in_array(25, $acolarr)) {  ?>
                  <th >In take</th>
            <?php } ?>
            <?php if ($showall == true or in_array(26, $acolarr)) {  ?>
                  <th >Preferred Country</th>
            <?php } ?>
            <?php if ($showall == true or in_array(31, $acolarr)) {  ?>
                  <th >Final Country</th>
            <?php } ?>
            <?php if ($showall == true or in_array(27, $acolarr)) {  ?>
                  <th >Visa Type</th>
            <?php } ?>
            <?php if ($showall == true or in_array(28, $acolarr)) {  ?>
                  <th >Nationality</th>
            <?php } ?>
            <?php if ($showall == true or in_array(29, $acolarr)) {  ?>
                  <th >Age</th>
            <?php } ?>
            <?php if ($showall == true or in_array(30, $acolarr)) {  ?>
                  <th >Marital Status</th>
            <?php } ?>
            
              <!-- //new start-->
              
             <?php if(!empty($dacolarr) and !empty($dfields)){
              foreach($dfields as $ind => $flds){                
                if(!empty(in_array($flds->input_id, $dacolarr ))){                  
                ?><th><?php echo $flds->input_label; ?></th><?php 
                }
              }
            } ?>
          </tr>
        </thead>
        <tbody>             
        </tbody>
      </table>
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
         <div class="modal-body">
            <div class="row">
               <div class="form-group col-sm-12">
                  <label>Select Tag</label>                  
                  <select class="multiple-select"  name="tags[]" multiple id="enq_tags">
                     <?php 
                     if(!empty($tags)){
                      foreach ($tags as $tag) { 
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
            
            <div class="col-12" style="padding: 0px;">
               <div class="row">
                  <div class="col-12" style="text-align:center;">                                                
                     <button class="btn btn-success" type="button" onclick="mark_tag()">Save</button>            
                  </div>
               </div>
            </div>
            
         </div>
      </div>
   </div>
</div>

<?php
  }
  ?>
<!----------------------end------------------------->       
<div id="dropEnquiry" class="modal fade" role="dialog">
  <div class="modal-dialog">
 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Drop Lead</h4>
      </div>
      <div class="modal-body">
                        
                                       
           
              <div class="row">
                
                <div class="form-group col-sm-12">  
                <label>Drop Reason</label>                  
                <select class="form-control"  name="drop_status">                    
                <?php foreach ($drops as $drop) {   ?>
                <option value="<?php echo $drop->d_id; ?>"><?php echo $drop->drop_reason; ?></option>
                <?php } ?>                                             
                </select> 
                </div>
                
                <div class="form-group col-sm-12"> 
                  <label>Drop Reason*</label>
                  <input class="form-control" name="reason" type="text" required="">  
                </div> 
                
              </div>          
              <div class="col-12" style="padding: 0px;">
                <div class="row">              
                  <div class="col-12" style="text-align:center;">                                                
                    <button class="btn btn-success" type="button" onclick="drop_enquiry()">Save</button>            
                  </div>
                </div>                                   
              </div> 
                  
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="sendsms" class="modal fade " role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-titlesms"></h4>
      </div>
      <div class="modal-body">
      <div>
          <div class="form-group col-sm-12">
                <label>Template</label>
                <select class="form-control" name="templates" required id="templates"   onchange="getMessage()">
               
                </select>
                </div>
                <div class="form-group col-sm-12"> 
                  
                  <label><?php echo display('subject') ?></label>
                  <input type="text" name="email_subject" class="form-control" id="email_subject">

                <label><?php echo display('message') ?></label>
                <textarea class="form-control" name="message_name"  rows="10" id="template_message"></textarea>  
                </div>
      </div>
      
       <div class="col-md-12">
                       <input type="hidden"  id="mesge_type" name="mesge_type">                                         
                    <button class="btn btn-success" onclick="send_sms()" type="button">Send <img src='<?= base_url('assets/images/loader_blue.gif'); ?>' width='20px' height='20px' id="loader1" style="display: none;"></button>            
                 

              </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="genLead" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter info and Move to Application</h4>
      </div>
      <div class="modal-body">
        
          <div class="row">
            <div class="form-group col-sm-6">  
            <label>Expected Closer Date</label>                  
            <input class="form-control date2"  name="expected_date" type="text" readonly>                
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
            </div>

            <div class="form-group col-sm-4">  
                <label><?php echo 'Applicant Portal'; ?></label>                  
                <input class="form-control" name="portal" type="checkbox" value="1">                
            </div>
          
            <div class="form-group col-sm-12">        
            <button class="btn btn-success" type="button" onclick="moveto_lead();" >Move to Application</button>        
            </div>
          
     
                    
                    
                </div>
    
        
          
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

 <div id="AssignSelected" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Onboarding Assignment</h4>
      </div>
      <div class="modal-body">
      
                <div class="row">

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
            
          <input type="hidden" value="" class="enquiry_id_input" >
          
            <div class="form-group col-sm-12">        
            <button class="btn btn-success" type="button" onclick="assign_enquiry();">Assign</button>        
            </div>
          
     
                    
                    
                </div>
                

        
          
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--------------------TABLE COLOUMN CONFIG----------------------------------------------->
<div id="table-col-conf" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width: 96%;">
 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Table Column Configuration</h4>
      </div>
      <div class="modal-body">         
           <div class="row">
             <div class="col-md-3">
                <label class=""><input type="checkbox" id="selectall" onclick="select_all()">&nbsp;Select All</label>
             </div>
           </div>
        <hr>
          <div class="row">
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "32"  <?php echo ($showall == true or in_array(32, $acolarr)) ? "checked" : ""; ?>> Actions Tag</label>  &nbsp; 
          </div>
          <div class = "col-md-4">             
          <label class=""><input type="checkbox" class="choose-col" id="choose-col" value = "1" <?php echo ($showall == true or in_array(1, $acolarr)) ? "checked" : ""; ?>> <?php echo display("source"); ?></label>
          </div>
          <!-- <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "2"  <?php echo ($showall == true or in_array(2, $acolarr)) ? "checked" : ""; ?>>  Company</label> 
          </div> -->
          <div class = "col-md-4">  
          <label  class=""><input type="checkbox" class="choose-col"  value = "3"  <?php echo ($showall == true or in_array(3, $acolarr)) ? "checked" : ""; ?>> Name</label>
          </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "4"  <?php echo ($showall == true or in_array(4, $acolarr)) ? "checked" : ""; ?>>  Email </label>
          </div>
          
          
          
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "5"  <?php echo ($showall == true or in_array(5, $acolarr)) ? "checked" : ""; ?>>  Phone </label>
              </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "6"  <?php echo ($showall == true or in_array(6, $acolarr)) ? "checked" : ""; ?>>  Address</label>  &nbsp;
          </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "7"  <?php echo ($showall == true or in_array(7, $acolarr)) ? "checked" : ""; ?>> Process</label>  &nbsp;
          </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "8"  <?php echo ($showall == true or in_array(8, $acolarr)) ? "checked" : ""; ?>>  Disposition</label>  &nbsp;
          </div>
  
          
                  <?php
                  if ($this->session->companey_id == 29) {
                   ?>
          
          <div class = "col-md-4">  
          
           <label  class=""><input type="checkbox" class="choose-col"  value = "9"  <?php echo ($showall == true or in_array(9, $acolarr)) ? "checked" : ""; ?>> <?php echo "<th>Referred By</th>"; ?></label>  &nbsp; </div><?php
                  }
                  ?>
         
          <div class = "col-md-4">  
          
              <label class=""><input type="checkbox" class="choose-col"  value = "10"  <?php echo ($showall == true or in_array(10, $acolarr)) ? "checked" : ""; ?>>     <?php echo display("create_date"); ?></label> &nbsp;
          </div>
          <div class = "col-md-4">  
          
              <label class=""><input type="checkbox" class="choose-col"  value = "11"  <?php echo ($showall == true or in_array(11, $acolarr)) ? "checked" : ""; ?>>     <?php echo display("created_by"); ?></label>  &nbsp;
          </div>
          <div class = "col-md-4">  
          
              <label class=""><input type="checkbox" class="choose-col"  value = "12"  <?php echo ($showall == true or in_array(12, $acolarr)) ? "checked" : ""; ?>>     <?php echo display("assign_to"); ?></label>  &nbsp;
          </div>
          
          <div class = "col-md-4">  
          
               <label class=""><input type="checkbox" class="choose-col"  value = "13"  <?php echo ($showall == true or in_array(13, $acolarr)) ? "checked" : ""; ?>>   <?php echo display("data_source"); ?></label>  &nbsp; 
           </div>
              <div class = "col-md-4">  
          
               <label class=""><input type="checkbox" class="choose-col"  value = "14"  <?php echo ($showall == true or in_array(14, $acolarr)) ? "checked" : ""; ?>> Prog. Required</label>  &nbsp; 
           </div>

          <div class = "col-md-4">  
            <label class=""><input type="checkbox" class="choose-col"  value = "18"  <?php echo ($showall == true or in_array(18, $acolarr)) ? "checked" : ""; ?>>  Score</label>  &nbsp;
          </div>

          <div class = "col-md-4">  
            <label class=""><input type="checkbox" class="choose-col"  value = "19"  <?php echo ($showall == true or in_array(19, $acolarr)) ? "checked" : ""; ?>>  Remark</label>  &nbsp;
          </div>
          <div class = "col-md-4">  
            <label class=""><input type="checkbox" class="choose-col"  value = "17"  <?php echo ($showall == true or in_array(17, $acolarr)) ? "checked" : ""; ?>>OnboardingId</label>  &nbsp;
          </div>

           <?php if($this->session->userdata('companey_id')==29){?>
            <div class = "col-md-4">  
          
               <label class=""><input type="checkbox" class="choose-col"  value = "15"  <?php echo ($showall == true or in_array(15, $acolarr)) ? "checked" : ""; ?>> Bank</label>  &nbsp; 
           </div>
         <?php }?>

            <div class = "col-md-4">  
          
               <label class=""><input type="checkbox" class="choose-col"  value = "16"  <?php echo ($showall == true or in_array(16, $acolarr)) ? "checked" : ""; ?>> Sub Source</label>  &nbsp; 
           </div>
           <!-- //new -->
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "20"  <?php echo ($showall == true or in_array(20, $acolarr)) ? "checked" : ""; ?>> Onboarding Source</label>  &nbsp; 
           </div>
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "21"  <?php echo ($showall == true or in_array(21, $acolarr)) ? "checked" : ""; ?>> City</label>  &nbsp; 
           </div>
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "22"  <?php echo ($showall == true or in_array(22, $acolarr)) ? "checked" : ""; ?>> State</label>  &nbsp; 
           </div>
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "23"  <?php echo ($showall == true or in_array(23, $acolarr)) ? "checked" : ""; ?>> Residing Country</label>  &nbsp; 
           </div>
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "24"  <?php echo ($showall == true or in_array(24, $acolarr)) ? "checked" : ""; ?>> Branch Name</label>  &nbsp; 
           </div>
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "25"  <?php echo ($showall == true or in_array(25, $acolarr)) ? "checked" : ""; ?>> In take</label>  &nbsp; 
           </div>
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "26"  <?php echo ($showall == true or in_array(26, $acolarr)) ? "checked" : ""; ?>> Preferred Country</label>  &nbsp; 
           </div>
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "31"  <?php echo ($showall == true or in_array(31, $acolarr)) ? "checked" : ""; ?>> Final Country</label>  &nbsp; 
           </div>
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "27"  <?php echo ($showall == true or in_array(27, $acolarr)) ? "checked" : ""; ?>> Visa Type</label>  &nbsp; 
           </div>
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "28"  <?php echo ($showall == true or in_array(28, $acolarr)) ? "checked" : ""; ?>> Nationality</label>  &nbsp; 
           </div>
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "29"  <?php echo ($showall == true or in_array(29, $acolarr)) ? "checked" : ""; ?>> Age</label>  &nbsp; 
           </div>
           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "30"  <?php echo ($showall == true or in_array(30, $acolarr)) ? "checked" : ""; ?>> Marital Status</label>  &nbsp; 
           </div>
         
          <!--<?php
        
          if(!empty($dfields)) {          
            foreach($dfields as $ind => $fld){              
            ?>
            <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="dchoose-col choose-col"  value = "<?php echo $fld->input_id; ?>"  <?php echo (in_array($fld->input_id, $dacolarr)) ? "checked" : ""; ?>>   <?php echo ucwords($fld->input_label); ?></label>  &nbsp;
          </div>
            <?php   
              
            }?>
             </div>
          <?php } ?>-->
                
              <div class="col-12" style="padding: 0px;">
                <div class="row">              
                  <div class="col-12" style="text-align:center;">                                                
                               
                  </div>
                </div>                                   
              </div> 
                  
         
      </div>
      <div class="modal-footer">
        <button class="btn btn-success set-col-table" type="button">Save</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
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
  function select_all(){

var select_all = document.getElementById("selectall"); //select all checkbox
var checkboxes = document.getElementsByClassName("choose-col"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
  for (i = 0; i < checkboxes.length; i++) { 
    checkboxes[i].checked = select_all.checked;
  }
});


for (var i = 0; i < checkboxes.length; i++) {
  checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(this.checked == false){
      select_all.checked = false;
    }
    //check "select all" if all checkbox items are checked
    if(document.querySelectorAll('.choose-col:checked').length == checkboxes.length){
      select_all.checked = true;
    }
  });
}

}

</script>
<!---------------------------- DROP Lead -------------------------------->


  


<div id="deleteselected" class="modal fade" role="dialog">
  <div class="modal-dialog">

     <div class="modal-content">
        
        <div class="modal-body">
          <i class="fa fa-question-circle" style="font-size:100px;"></i><br><h1>Are you sure, you want to permanently delete selected record?</h1>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="delete_recorde()">Ok</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
     
  </div>
</div>
</form>

<script>
$(document).ready(function(){ 
  $('#enq_tags').select2({
  }); 
 });

function mark_tag(){
    var form_data = $("#enquery_assing_from").serialize();       
    console.log(form_data);
    $.ajax({
      url: '<?=base_url()?>enquiry/mark_tag',
      type: 'post',
      data: form_data,
      success: function(responseData){
        res = JSON.parse(responseData);
        if(res.status){
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Tags Marked',
            showConfirmButton: false,
            timer: 500
          });
          $('#enq_table').DataTable().ajax.reload();   
        }else{
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: res.msg,
            showConfirmButton: true,
            //timer: 1500
          });
        }
      }
    });
  }
</script>

<script type="text/javascript">

  $(document).on("click", ".set-col-table", function(e){
    
    e.preventDefault();
    if($(".choose-col:checked").length == 0 && $(".dchoose-col:checked").length == 0 ){
      
      return false;
    }
    var chkval = "";
    $(".choose-col:checked").each(function(){
      
      chkval += $(this).val()+",";
    });
    var dchkval = "";
    $(".dchoose-col:checked").each(function(){
      
      dchkval += $(this).val()+",";
    });
    
    document.cookie = "allowcols="+chkval+"; expires=Thu, 18 Dec 2053 12:00:00 UTC; path=/";
    document.cookie = "dallowcols="+dchkval+"; expires=Thu, 18 Dec 2053 12:00:00 UTC; path=/";
    location.reload();    
  });

  $(document).ready(function() {
       
      $('#enq_table').DataTable(
        {         
          "processing": true,
          "scrollX": true,
          "scrollY": 520,
          "serverSide": true,          
          "lengthMenu": [ [10,30, 50,100,500,1000, -1], [10,30, 50,100,500,1000, "All"] ],
          "ajax": {
              "url": "<?=base_url().'Enq/enq_load_data'?>",
              "type": "POST",
              "data":{'data_type':"<?=$data_type?>"}
          },
        <?php if(user_access(500)) { ?>
          dom: "<'row text-center'<'col-sm-12 col-xs-12 col-md-4'l><'col-sm-12 col-xs-12 col-md-4 text-center'B><'col-sm-12 col-xs-12 col-md-4'f>>tp", 
        // "lengthMenu": [[30, 60, 90, -1], [30, 60, 90, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-xs btn',exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }}, 
            {extend: 'csv', title: 'list<?=date("Y-m-d H:i:s")?>', className: 'btn-xs btn',exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }}, 
            {extend: 'excel', title: 'list<?=date("Y-m-d H:i:s")?>', className: 'btn-xs btn', title: 'exportTitle',exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }}, 
            {extend: 'pdf', title: 'list<?=date("Y-m-d H:i:s")?>', className: 'btn-xs btn',exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }}, 
            {extend: 'print', className: 'btn-xs btn',exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }} 
        ] ,
        <?php
        }
        ?>
          "columnDefs": [{ "orderable": false, "targets": 0 }],
              "order": [[ 1, "desc" ]],
          createdRow: function( row, data, dataIndex ) {            
            var th = $("table>th");            
            l = $("table").find('th').length;
            for(j=1;j<=l;j++){
              h = $("table").find('th:eq('+j+')').html();
              $(row).find('td:eq('+j+')').attr('data-th',h);
            }                       
        }
      });
    //   $('#enq_table').DataTable({ 
    //     //responsive: true, 
    //     scrollX: true,
    //     scrollY: 800,
    //     dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
    //     "lengthMenu": [[30, 60, 90, -1], [30, 60, 90, "All"]], 
    //     buttons: [  
    //         {extend: 'copy', className: 'btn-sm'}, 
    //         {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, 
    //         {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle'}, 
    //         {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, 
    //         {extend: 'print', className: 'btn-sm'} 
    //     ] 
    // });



      $.ajax({
      url: "<?=base_url().'enq/stages_of_enq/'.$data_type?>",
      type: 'get',
      dataType: 'json',
      success: function(responseData){
      $('#today_created').html(responseData.all_creaed_today_num);
      $('#active_all').html(responseData.all_active_num);
      $('#today_updated').html(responseData.all_today_update_num);
      $('#active_drop').html(responseData.all_drop_num);
      $('#total_active').html(responseData.all_enquery_num);
      all_lead_stage_c  = $("input[name='top_filter']:checked").next().next().next().html();
//      console.log(all_lead_stage_c);
      $('#lead_stage_-1').text(all_lead_stage_c);     
      }
    });

      function process_change_fun(){
        update_top_filter_counter();
        var count=0;
        var checkboxes = document.getElementsByName('product_filter[]');
        var id = [];
        // loop over them all
        for (var i=0; i<checkboxes.length; i++) {
           // And stick the checked ones onto an array...
           if (checkboxes[i].checked) {
              id.push(checkboxes[i].value);
              count++;
           }
        }

        if(count==1){
          $("#enq-create").show();
        } 
        else{
         $("#enq-create").hide();
        }  
        url = "<?=base_url().'led/get_leadstage_list_byprocess'?>";       
        $.ajax({
            type: "POST",
            url: url,
            data: {
              'id':id
            },
            success: function(data){       
            $(".nav-stage").html(data);  
            $("#nav-process").hide();   
            stage_counter();               
            }
          });
      }

      $("input[name='product_filter[]']").on('change',function(){    
        $('#enq_table').DataTable().ajax.reload();
        process_change_fun();
      });

      function update_top_filter_counter(){
        $.ajax({
        url: "<?=base_url().'enq/stages_of_enq/'.$data_type?>",
        type: 'get',
        dataType: 'json',
        success: function(responseData){
        $('#today_created').html(responseData.all_creaed_today_num);
        $('#active_all').html(responseData.all_active_num);
        $('#today_updated').html(responseData.all_today_update_num);
        $('#active_drop').html(responseData.all_drop_num);
        $('#total_active').html(responseData.all_enquery_num);
        
        all_lead_stage_c  = $("input[name='top_filter']:checked").next().next().next().html();

        //console.log(all_lead_stage_c);
        
        $('#lead_stage_-1').text(all_lead_stage_c);     
        }
    });
      }


      $('#enq_filter').change(function() {
        update_top_filter_counter(); 
        var form_data = $("#enq_filter").serialize();       
        $.ajax({
        url: '<?=base_url()?>enq/enquiry_set_filters_session',
        type: 'post',
        data: form_data,
        success: function(responseData){
          $('#enq_table').DataTable().ajax.reload();
          stage_counter();      
        }
      });
      });
      

  } );
</script>

<script>
function reset_input(){
$('input:checkbox').removeAttr('checked');
}

$('.checked_all1').on('change', function() {     
    $('.checkbox1').prop('checked', $(this).prop("checked"));    
});
        
</script>

<script>
  function getTemplates(SMS,type){
     if(type != 'Send Email'){
      $("#email_subject").hide();
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
      $("#email_subject").prev().show();
    }
  $.ajax({
  type: 'POST',
  url: '<?php echo base_url();?>message/get_templates/'+SMS,
  })
  .done(function(data){
      
      $('#modal-titlesms').html(type);
      $('#mesge_type').val(SMS);
      $('#templates').html(data);
      //$("#email_subject").val(data.mail_subject);

  })
  .fail(function() {
      alert( "fail!" );

  });
  }


function  send_sms(){
  $("#loader1").show();
  if($('.checkbox1:checked').size() > 1000){
    alert('You can not send more that 1000 sms at once');
  }else{
    var sms_type = $("#mesge_type").val();
     url =  '<?php echo base_url();?>message/send_sms';
     $.ajax({
    type: 'POST',
    url: url,
    data: $('#enquery_assing_from').serialize()
    })
    .done(function(data){
      $("#loader1").hide();
Swal.fire({
  icon: 'success',
  title: 'Email Response!',
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
  title: 'Email Response!',
  text: 'Email',
  confirmButtonText: `OK`,
}).then((result) => {
  if (result.isConfirmed) {
    location.reload();
  }
})
    
    });   
  }
}
</script>
<script>
  function getMessage(){
        
        var tmpl_id = document.getElementById('templates').value;
        
       
        
        $.ajax({
            
            url : '<?php echo base_url('enquiry/msg_templates') ?>',
            type: 'POST',
            data: {tmpl_id:tmpl_id},
            success:function(data){
                
                var obj = JSON.parse(data);
                 $('#templates option[value='+tmpl_id+']').attr("selected", "selected");
                $("#template_message").html(obj.template_content);
                $("#email_subject").val(obj.mail_subject);
            }
            
        });
      
  }   
</script>
 <script>
    /*function getMessage(){
       id=document.getElementById('templates').value;
    $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>message/getMessage/'+id,
    })
    .done(function(data){
        $("#template_message").html(data);
    })
    .fail(function() {
    alert( "fail!" );

    });
  }*/

function save_enquery(){
     
  $.ajax({
  type: 'POST',
  url: '<?php echo base_url();?>enquiry/create',
  cache: false,
  data: $('#enquery_from').serialize(),
  dataType: 'json',
  success:function(data){
  if(data.status === true ) 
      document.location.href = data.redirect;
  else  
       document.getElementById('success').style.display='none';
     document.getElementById('error').style.display='inline';
     $('#error').html(data.error);
         
  }});
}

function autoDial(){
  if($('.checkbox1:checked').size() > 1000){
    alert('You can not dial more that 1000 Onboarding at once');
  }else{
    data_type = "<?=$data_type?>";
    data_type = parseInt(data_type);
    //if (data_type == 1) {
      var p_url = '<?php echo base_url();?>enquiry/autoDial';
      //var re_url = '<?php echo base_url();?>enquiry';
    //}
    // else if(data_type == 2){
    //   var p_url = '<?php echo base_url();?>lead/assign_lead';
    //   var re_url = '<?php echo base_url();?>led/index';
    // }else if(data_type == 3){      
    //   var p_url = '<?php echo base_url();?>client/assign_enquiry';
    //   var re_url = '<?php echo base_url();?>client/index';
    // }    

  $.ajax({
    type: 'POST',
    url: p_url,
    data: $('#enquery_assing_from').serialize(),
    beforeSend: function(){
                 $("#imgBack").html('uploading').show();
    },
    success:function(data){
      Swal.fire(
            'success',
            'call scheduled successfully',
            'success'
            );
         //alert(data);
         //document.getElementById('testdata').innerHTML =data;
          //window.location.href=re_url;
    }});
  }
}

function assign_enquiry(){
  if($('.checkbox1:checked').size() > 1000){
    alert('You can not assign more that 1000 Onboarding at once');
  }else{
    data_type = "<?=$data_type?>";
    data_type = parseInt(data_type);
    if (data_type == 1) {
      var p_url = '<?php echo base_url();?>enquiry/assign_enquiry';
      var re_url = '<?php echo base_url();?>enquiry';
    }else if(data_type == 2){
      var p_url = '<?php echo base_url();?>lead/assign_lead';
      var re_url = '<?php echo base_url();?>led/index';
    }else if(data_type == 3){      
      var p_url = '<?php echo base_url();?>client/assign_enquiry';
      var re_url = '<?php echo base_url();?>client/index';
    }    

  $.ajax({
    type: 'POST',
    url: p_url,
    data: $('#enquery_assing_from').serialize(),
    beforeSend: function(){
                 $("#imgBack").html('uploading').show();
    },
    success:function(data){
         alert(data);
         //document.getElementById('testdata').innerHTML =data;
          window.location.href=re_url;
    }});
  }
}



function moveto_lead(){
  if($('.checkbox1:checked').size() > 1000){
    alert('You can not move more that 1000 Onboarding at once');
  }else{
  $.ajax({
  type: 'POST',
  url: '<?php echo base_url();?>enquiry/move_to_lead',
  data: $('#enquery_assing_from').serialize(),
  success:function(data){
      if(data=='1'){
           alert('Successfully Moved in Application'); 
        window.location.href='<?php echo base_url();?>enquiry'
      }else{
       alert(data);
      }
  }});
  }
}

function drop_enquiry(){
if($('.checkbox1:checked').size() > 1000){
    alert('You can not drop more that 1000 Onboarding at once');
  }else{

     data_type = "<?=$data_type?>";
  data_type = parseInt(data_type);
  if (data_type == 1) {
    var p_url = '<?php echo base_url();?>enquiry/drop_enquiries';
    var re_url = '<?php echo base_url();?>enquiry';
  }else if(data_type == 2){
    var p_url = '<?php echo base_url();?>lead/drop_leadss';
    var re_url = '<?php echo base_url();?>led/index';
  }else if(data_type == 3){
    var p_url = '';
    var re_url = '<?php echo base_url();?>client/index';
  }


  $.ajax({
    type: 'POST',
  url: p_url,
  data: $('#enquery_assing_from').serialize(),
  success:function(data){
          if(data=='1'){
         alert('Successfully Droped Onboarding'); 
        window.location.href=re_url;
      }else{
        alert(data); 
      }
  }});
  }
}



function delete_recorde() {
    $('#enquery_assing_from').attr('action','<?php echo base_url();?>enquiry/delete_recorde')
    $('#enquery_assing_from').submit()
}


</script>

<script>
/*
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
      // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
      // update the format if it's yyyy-mm-dd
      var date = parseDate($(this).val());

      if (! isValidDate(date)) {
        //create date based on momentjs (we have that)
        date = moment().format('YYYY-MM-DD');
      }

      $(this).val(date);
    });
  }
   
   var isValidDate = function(value, format) {
    format = format || false;
    // lets parse the date to the best of our knowledge
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
      // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
      // update the format if it's yyyy-mm-dd
      var date = parseDate($(this).val());

      if (! isValidDate(date)) {
        //create date based on momentjs (we have that)
        date = moment().format('YYYY-MM-DD');
      }

      $(this).val(date);
    });
  }
   
   var isValidDate = function(value, format) {
    format = format || false;
    // lets parse the date to the best of our knowledge
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
    */
</script>
<script type='text/javascript'>
$(window).load(function(){
  stage_counter();
$("#active_class p").click(function() {
    $('.border_bottom_active').removeClass('border_bottom_active');
    $(this).addClass("border_bottom_active");
});
});  
</script>
<script type="text/javascript">
  function stage_counter(){     
    lead_stages  = $("input[name='top_filter']:checked"). val();
      $.ajax({
        url: "<?=base_url().'enq/count_stages/'.$data_type.'/'?>",
        type: 'get',
        dataType: 'json',
        success: function(responseData){
          res = responseData;
          filters =   $("input[name='lead_stages']");
          filters.each(function(item,o){
            $("#lead_stage_"+o.value). text(0);
          });
          res.forEach(function(item,index,arr){
            $("#lead_stage_"+item.lead_stage). text(item.c);
          })
          all_lead_stage_c  = $("input[name='top_filter']:checked").next().next().next().html();
          $('#lead_stage_-1').text(all_lead_stage_c);        

          //$("#other_stage_-1"). text(res[0].item.c);

          
        }
    });
  }
</script>

 <script>
  
$(document).ready(function(){
   $("#save_advance_filters").on('click',function(e){
    e.preventDefault();
    var arr = Array();  
    $("input[name='filter_checkbox']:checked").each(function(){
      arr.push($(this).val());
    });        
    setCookie('enquiry_filter_setting',arr,365);      
    alert('Your custom filters saved successfully.');
  }) 



var enq_filters  = getCookie('enquiry_filter_setting');

if (enq_filters=='') {
    $('#save_filterbutton').hide();
}else{
  $('#save_filterbutton').show();

}
if (!enq_filters.includes('date')) {
  $('#fromdatefilter').hide();
  $('#todatefilter').hide();
}else{
  $("input[value='date']").prop('checked', true);
}

if (!enq_filters.includes('emp')) {
  $('#empfilter').hide();
}else{
  $("input[value='emp']").prop('checked', true);
}

if (!enq_filters.includes('source')) {
  $('#sourcefilter').hide();
}else{
  $("input[value='source']").prop('checked', true);
}

if (!enq_filters.includes('subsource')) {
  $('#subsourcefilter').hide();
}else{
  $("input[value='subsource']").prop('checked', true);
}

if (!enq_filters.includes('phone')) {
  $('#phonefilter').hide();
}else{
  $("input[value='phone']").prop('checked', true);
}

if (!enq_filters.includes('datasource')) {
  $('#datasourcefilter').hide();
}else{
  $("input[value='datasource']").prop('checked', true);
}

if (!enq_filters.includes('email')) {
  $('#emailfilter').hide();
}else{
  $("input[value='email']").prop('checked', true);
}

/*if (!enq_filters.includes('company')) {
  $('#companyfilter').hide();
}else{
  $("input[value='company']").prop('checked', true);
}*/

if (!enq_filters.includes('process')) {
  $('#proccessfilter').hide();
}else{
  $("input[value='process']").prop('checked', true);
}
if (!enq_filters.includes('product')) {
  $('#prodfilter').hide();
}else{
  $("input[value='product']").prop('checked', true);
}

if (!enq_filters.includes('address')) {
  $('#addfilter').hide();
}else{
  $("input[value='address']").prop('checked', true);
}

if (!enq_filters.includes('created_by')) {
  $('#createdbyfilter').hide();
}else{
  $("input[value='created_by']").prop('checked', true);
}
if (!enq_filters.includes('assign_to')) {
  $('#assignfilter').hide();
}else{
  $("input[value='assign_to']").prop('checked', true);
}
if (!enq_filters.includes('process')) {
  $('#proccessfilter').hide();
}else{
  $("input[value='process']").prop('checked', true);
}
if (!enq_filters.includes('product')) {
  $('#prodfilter').hide();
}else{
  $("input[value='product']").prop('checked', true);
}
if (!enq_filters.includes('state')) {
  $('#statefilter').hide();
}else{
  $("input[value='state']").prop('checked', true);
}
if (!enq_filters.includes('city')) {
  $('#cityfilter').hide();
}else{
  $("input[value='city']").prop('checked', true);
}
if (!enq_filters.includes('stage')) {
  $('#stagefilter').hide();
}else{
  $("input[value='stage']").prop('checked', true);
}
if (!enq_filters.includes('final')) {
  $('#finalfilter').hide();
}else{
  $("input[value='final']").prop('checked', true);
}
if (!enq_filters.includes('intake')) {
  $('#intakefilter').hide();
}else{
  $("input[value='intake']").prop('checked', true);
}
if (!enq_filters.includes('visatype')) {
  $('#visafilter').hide();
}else{
  $("input[value='visatype']").prop('checked', true);
}
if (!enq_filters.includes('preferred')) {
  $('#preferredfilter').hide();
}else{
  $("input[value='preferred']").prop('checked', true);
}
if (!enq_filters.includes('nationality')) {
  $('#nationalityfilter').hide();
}else{
  $("input[value='nationality']").prop('checked', true);
}
if (!enq_filters.includes('residing')) {
  $('#residingfilter').hide();
}else{
  $("input[value='residing']").prop('checked', true);
}

if (!enq_filters.includes('tag')) {
  $('#tagfilter').hide();
}else{
  $('#tagfilter').show();
  $("input[value='tag']").prop('checked', true);
}


$('#buttongroup').hide();
 $('input[name="filter_checkbox"]').click(function(){              
        if($('#datecheckbox').is(":checked")){
         $('#fromdatefilter').show();
         $('#todatefilter').show();
         $("#buttongroup").show();
         $('#save_filterbutton').show();
        }
        else{
           $('#fromdatefilter').hide();
           $('#todatefilter').hide();
           $("#buttongroup").hide();
           $('#save_filterbutton').hide();
        }
         if($('#empcheckbox').is(":checked")){
        $('#empfilter').show();
        $("#buttongroup").show();
        $('#save_filterbutton').show();
        }
        else{
          $('#empfilter').hide();
          $("#buttongroup").hide();
        }
        if($('#sourcecheckbox').is(":checked")){
          $('#sourcefilter').show();
          $("#buttongroup").show();
          $('#save_filterbutton').show();
        }
        else{
          $('#sourcefilter').hide();
          $("#buttongroup").hide();
        }


        if($('#subsourcecheckbox').is(":checked")){
          $('#subsourcefilter').show();
          $("#buttongroup").show();
          $('#save_filterbutton').show();
        }
        else{
          $('#subsourcefilter').hide();
          $("#buttongroup").hide();
        }



        if($('#emailcheckbox').is(":checked")){
          $('#emailfilter').show();
          $('#save_filterbutton').show();
        }
        else{
          $('#emailfilter').hide();
        }
        if($('#datasrccheckbox').is(":checked")){
          $('#datasourcefilter').show();
          $('#save_filterbutton').show();
        }
        else{
          $('#datasourcefilter').hide();
        }
        /*if($('#companycheckbox').is(":checked")){
          $('#companyfilter').show();
          $('#save_filterbutton').show();
        }
        else{
          $('#companyfilter').hide();
        }*/
        if($('#phonecheckbox').is(":checked")){
          $('#phonefilter').show();
          $('#save_filterbutton').show();
        }
        else{
          $('#phonefilter').hide();
        }
        if($('#proccheckbox').is(":checked")){
          $('#proccessfilter').show();
          $('#save_filterbutton').show();
        }
        else{
          $('#proccessfilter').hide();
        }
        if($('#createdbycheckbox').is(":checked")){
          $('#createdbyfilter').show();
          $('#save_filterbutton').show();
        }
        else{
          $('#createdbyfilter').hide();
        }
        if($('#assigncheckbox').is(":checked")){
          $('#assignfilter').show();
          $('#save_filterbutton').show();
        }
        else{
          $('#assignfilter').hide();
        }
        if($('#addcheckbox').is(":checked")){
          $('#addfilter').show();
          $('#save_filterbutton').show();
        }
        else{
          $('#addfilter').hide();
        }

       if($('#stageheckbox').is(":checked")){
          $('#stagefilter').show();
          $('#save_filterbutton').show();
       }
       else{
         $('#stagefilter').hide();
       }

      if($('#finalcheckbox').is(":checked")){
          $('#finalfilter').show();
          $('#save_filterbutton').show();
       }else{
          $('#finalfilter').hide();
       }
       if($('#intakecheckbox').is(":checked")){
          $('#intakefilter').show();
          $('#save_filterbutton').show();
       }else{
          $('#intakefilter').hide();
       }
       if($('#visacheckbox').is(":checked")){
          $('#visafilter').show();
          $('#save_filterbutton').show();
       }else{
          $('#visafilter').hide();
       }
       if($('#preferredcheckbox').is(":checked")){
          $('#preferredfilter').show();
          $('#save_filterbutton').show();
       }else{
          $('#preferredfilter').hide();
       }
       if($('#nationalitycheckbox').is(":checked")){
          $('#nationalityfilter').show();
          $('#save_filterbutton').show();
       }else{
          $('#nationalityfilter').hide();
       }
       if($('#residingcheckbox').is(":checked")){
          $('#residingfilter').show();
          $('#save_filterbutton').show();
       }else{
          $('#residingfilter').hide();
       }

       if($('#tagcheckbox').is(":checked")){
          $('#tagfilter').show();
          $('#save_filterbutton').show();
       }else{
          $('#tagfilter').hide();
       }

       if($('#prodcheckbox').is(":checked")){
         $('#prodfilter').show();
         $('#save_filterbutton').show();
       }
       else{
         $('#prodfilter').hide();
       }
      if($('#statecheckbox').is(":checked")){
        $('#statefilter').show();
        $('#save_filterbutton').show();
      }
      else{
        $('#statefilter').hide();
      }
     if($('#citycheckbox').is(":checked")){
        $('#cityfilter').show();
        $('#save_filterbutton').show();
      }
      else{
       $('#cityfilter').hide();
      }       
    });
})

/*$(document).ready(function(){
    $('#newenqfilter').hide();
    $('#cityfilter').hide();
    $('#statefilter').hide();
    $('#prodfilter').hide();
    $('#stagefilter').hide();
    $('#finalfilter').hide();
    $('#intakefilter').hide();
    $('#visafilter').hide();
    $('#preferredfilter').hide();
    $('#nationalityfilter').hide();
    $('#residingfilter').hide();
});*/
$(document).ready(function(){
  $(".lead_stage_filter").click(function(){
    $(".lead_stage_filter").css("background-color","#e6e9ed");
    $(this).css("background-color","#20a8d8");
  });  
  var count=0;
  var checkboxes = document.getElementsByName('product_filter[]');
  var id = [];
  // loop over them all
  for (var i=0; i<checkboxes.length; i++) {     
     if (checkboxes[i].checked) {
        id.push(checkboxes[i].value);
        count++;
     }
  }
  if(count>1){
   $("#enq-create").hide();
  } 
  else{
    $("#enq-create").show();
  }  
});

$(document).on('mouseover','.change_dispositions',function(e){
  var enq  = $(this).data('id');
  var dis  = $(this).val();
  var post_url = "<?=base_url().'enq/enquiry_disposition/'?>"+enq;
  $.ajax({
      url: post_url,
      type: 'post',      
      data:{
        disposition:dis
      },
      success: function(res){
        $("select[data-id="+enq+"]").html(res);
      }
  });
});

$(document).on('change','.change_dispositions',function(e){
  var enq  = $(this).data('id');
  var dis  = $(this).val();
  var post_url = "<?=base_url().'enq/enquiry_update_disposition/'?>"+enq;
  $.ajax({
      url: post_url,
      type: 'post',      
      data:{
        disposition:dis
      },
      success: function(res){
        Swal.fire(
            'Good job!',
            'Disposition Updated Successfully!',
            'success'
          )
      }
  });
});

$("#state").change(function() {
    var state_id = $(this).val();
    var html = '';
    $.ajax({
        url: '<?php echo base_url();?>Location/select_city_bystate',
        type: 'POST',
        data: {
            state_id: state_id
        },
        success: function(data) {
            var obj = JSON.parse(data);
            html += '<option value="" style="display:none">---Select City---</option>';
            for (var i = 0; i < (obj.length); i++) {
                html += '<option value="' + obj[i].id + '">' + obj[i].city + '</option>';
            }
            $('#city_name').html(html);
        }
    });
});

$('#source').select2({});
$('#subsource').select2({});
$('#datasource').select2({});
$('#enq_product').select2({});
$('#createdby').select2({});
$('#assign').select2({});
$('#prodcntry').select2({});
$('#state').select2({});
$('#city_name').select2({});
$('#stage').select2({});
$('#final').select2({});
$('#intake').select2({});
$('#visatype').select2({});
$('#preferred').select2({});
$('#nationality').select2({});
$('#residing').select2({});
$('#tag').select2({});
$('#select_user').select2({});

function moveto_client(){
  if($('.checkbox1:checked').size() > 1000){
    alert('You can not move more that 1000 Onboarding at once');
  }else{
  $.ajax({
  type: 'POST',
  url: '<?php echo base_url();?>enquiry/move_to_client',
  data: $('#enquery_assing_from').serialize(),
  success:function(data){
      if(data=='1'){
           alert('Successfully Moved in Case Management'); 
        window.location.href='<?php echo base_url();?>led/index'
      }else{
       alert(data);
      }
  }});
  }
}

$(document).on('click',".top_pill",function(){

var stg_id = $(this).data('stage-id');
if(!$(this).hasClass('top-active'))
{
   $(".top_pill").removeClass('top-active');
   $(this).addClass('top-active');
   var form_data = $("#enq_filter").serialize(); 
     form_data+="&stage="+stg_id;
     $.ajax({
       url: '<?=base_url()?>enq/enquiry_set_filters_session',
       type: 'post',
       data: form_data,
       success: function(responseData){
         $('#enq_table').DataTable().ajax.reload();   
        // update_top_filter_counter(); 
     }
   });
   
}
else
{
   $(".top_pill").removeClass('top-active');
   var form_data = $("#enq_filter").serialize(); 
     form_data+="&stage=";
     $.ajax({
       url: '<?=base_url()?>enq/enquiry_set_filters_session',
       type: 'post',
       data: form_data,
       success: function(responseData){
         $('#enq_table').DataTable().ajax.reload();    
          //update_top_filter_counter();
     }
   });
}
$('#enq_table').DataTable().ajax.reload();
});

function enq_save_filter(){
var form_data = $("#enq_filter").serialize();       
// alert(form_data);
$.ajax({
url: '<?=base_url()?>enq/data_save_filter/1',
type: 'post',
data: form_data,
success: function(responseData){
  Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'filted data saved',
  showConfirmButton: false,
  timer: 500
});


}
});
  }
</script>