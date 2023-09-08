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
</style>


<form method="post" id="ref_filter" >
<div class="row">
 <div class="row" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">  
        <div class="col-md-4 col-sm-4 col-xs-4" > 
          <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>
        </div>
         <div class="col-md-4 col-sm-8 col-xs-8 pull-right" >  
          <div style="float: right;">      
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
                      <input type="checkbox" value="email" id="emailcheckbox" name="filter_checkbox"> Email</label>
                    </li> 
                    <li>
                      <label>
                      <input type="checkbox" value="phone" id="phonecheckbox" name="filter_checkbox"> Phone</label>
                    </li> 
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
                      <input type="checkbox" value="stage" id="stageheckbox" name="filter_checkbox"> Stage</label>
                    </li>

                    <li>
                      <label>
                      <input type="checkbox" value="status" id="statuscheckbox" name="filter_checkbox"> Status</label>
                    </li>

                    <li>
                      <label>
                      <input type="checkbox" value="days" id="dayscheckbox" name="filter_checkbox"> Refund Days</label>
                    </li>

                    <li>
                      <label>
                      <input type="checkbox" value="final" id="finalcheckbox" name="filter_checkbox"> Final Country</label>
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
              <a class="btn" data-toggle="modal" data-target="#table-col-conf" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('table_config'); ?></a>
              <?php if(user_access(710)){ ?> 
                  <a class="btn" data-toggle="modal" data-target="#tagas" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo 'Tag AS'; ?></a>   
                  <?php } ?>                        
            </div>                                         
          </div>  
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
});
</script>



<!------ Filter Div ---------->
 <div class="row" id="filter_pannel">
        <div class="col-lg-12">
            <div class="panel panel-default">
               
                      <div class="form-row">
                       
                        <div class="form-group col-md-3" id="fromdatefilter">
                          <label for="from-date"><?php echo display("from_date"); ?></label>
                          <input type="date" class="form-control" id="from-date" name="from_created" style="padding-top:0px;">
                        </div>
                        <div class="form-group col-md-3" id="todatefilter">
                          <label for="to-date"><?php echo display("to_date"); ?></label>
                          <input type="date" class="form-control" id="to-date" name="to_created" style="padding-top:0px;">
                        </div>

                         <div class="form-group col-md-3" id="empfilter">
                          <label for=""><?php echo 'Name'; ?></label>
                          <input type="text" class="form-control chosen-select" name="employee" id="employee">
                        </div>

                        <div class="form-group col-md-3" id="emailfilter">
                          <label for=""><?php echo display("email"); ?></label>
                          <input type="text" name="email" class="form-control">
                        </div>
                     </div>
                    <div class="form-row">                      
                        <div class="form-group col-md-3" id="phonefilter">
                          <label for="">Phone</label>
                         <input type="text" name="phone" class="form-control">                        
                        </div>
                         <div class="form-group col-md-3" id="createdbyfilter">
                          <label for="">Created By</label>
                         <select name="createdby" class="form-control" id="creid"> 
                          <option value="">Select</option>
                         <?php 
                          if (!empty($created_bylist)) {
                              foreach ($created_bylist as $createdbylist) {?>
                              <option value="<?=$createdbylist->pk_i_admin_id;?>" <?php if(!empty(set_value('createdby'))){if (in_array($product->sb_id,set_value('createdby'))) {echo 'selected';}}?>><?=$createdbylist->s_display_name.' '.$createdbylist->last_name;?> -  <?=$createdbylist->s_user_email?$createdbylist->s_user_email:$createdbylist->s_phoneno;?>                               
                              </option>
                              <?php }}?>    
                         </select>                       
                        </div>
                         <div class="form-group col-md-3" id="assignfilter">
                          <label for="">Assign To</label>  
                         <select name="assign" class="form-control" id="assid"> 
                          <option value="">Select</option>
                         <?php 
                              if (!empty($created_bylist)) {
                              foreach ($created_bylist as $createdbylist) {?>
                              <option value="<?=$createdbylist->pk_i_admin_id;?>" <?php if(!empty(set_value('assign'))){if (in_array($product->sb_id,set_value('assign'))) {echo 'selected';}}?>><?=$createdbylist->s_display_name.' '.$createdbylist->last_name;?> -  <?=$createdbylist->s_user_email?$createdbylist->s_user_email:$createdbylist->s_phoneno;?></option>
                              <?php }}?>    
                         </select>                          
                        </div>
                    </div>

                    <div class="row"> 

                    <div class="form-group col-md-3" id="stagefilter">
                        <label for="">Stage</label> 
                        <select name="stage" class="form-control">
                          <option value="">Select</option>
                          <?php foreach ($all_stage_lists as $stage) {  ?>
                              <option value="<?= $stage->stg_id?>" <?php if(!empty(set_value('stage'))){if (in_array($stage->stg_id,set_value('stage'))) {echo 'selected';}}?>><?php echo $stage->lead_stage_name; ?></option>
                              <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-md-3" id="statusfilter">
                        <label for="">Status</label> 
                        <select name="status" class="form-control">
                          <option value="">Select</option>
                          <option value="1" <?php if(!empty(set_value('status'))){if (in_array(1,set_value('status'))) {echo 'selected';}}?>>Onboarding</option>
                          <option value="2" <?php if(!empty(set_value('status'))){if (in_array(2,set_value('status'))) {echo 'selected';}}?>>Application</option>
                          <option value="3" <?php if(!empty(set_value('status'))){if (in_array(3,set_value('status'))) {echo 'selected';}}?>>Case Management</option>
                        </select>
                      </div>

                      <div class="form-group col-md-3" id="finalfilter">
                        <label for="">Final Country</label> 
                        <select name="final" class="form-control">
                          <option value="">Select</option>
                          <?php foreach($all_country_list as $product){ ?>
                          <option value="<?=$product->id_c?>" <?php if(!empty(set_value('final'))){if (in_array($product->id_c,set_value('final'))) {echo 'selected';}}?>><?=$product->country_name ?></option>
                        <?php } ?>
                        </select>
                      </div>

                      <?php
                      if(user_access(710)){
                      ?>
                      <div class="form-group col-md-3" id="tagfilter">
                        <label for="">Tag</label> 
                        <select name="tag" class="form-control">
                          <option value="">Select</option>
                          <?php 
                          if(!empty($tags)){
                            foreach ($tags as $t=>$tag) {  ?>
                              <option value="<?=$tag['id']?>"  <?php if(!empty($filterData['tag']) && $tag['id']==$filterData['tag']) {echo 'selected';}?>><?php echo $tag['title']; ?></option>
                              <?php } 
                          } ?>
                        </select>
                      </div>                   
                      <?php
                      }
                      ?>

                    </div>
          
            </div>
        </div>
    </div>   
</form>
<br>
<br>

<form class="form-inner" method="post" id="refund_assing_from" >  
<div class="card-body">
      <?php 
        $acolarr = array();
        $dacolarr = array();
        if(isset($_COOKIE["rallowcols"])) {
          $showall = false;
          $acolarr  = explode(",", trim($_COOKIE["rallowcols"], ","));       
        }else{          
          $showall = true;
        }         
        if(isset($_COOKIE["rdallowcols"])) {
          $dshowall = false;
          $dacolarr  = explode(",", trim($_COOKIE["rdallowcols"], ","));       
        }else{
          $dshowall = false;
        }       
      ?>
  <div class="row">
    <div class="col-md-12" >    
            <table id="refund_table" class="table table-bordered table-hover mobile-optimised" style="width:100%;">
        <thead>
          <tr class="bg-info table_header">
              <th class="noExport">
                <input type='checkbox' class="checked_all1" value="check all" >
              </th>
                  <th>S.N</th>

                  <th>No Of Day's</th>

              <?php if ($showall == true or in_array(1, $acolarr)) {  ?>
                  <th>Onboarding Id</th>
             <?php } ?> 

              <?php if ($showall == true or in_array(2, $acolarr)) {  ?>
            <th>Name</th>
                   <?php } ?>
              <?php if ($showall == true or in_array(3, $acolarr)) {  ?>
            <th>Email </th>
                   <?php } ?>
              <?php if ($showall == true or in_array(4, $acolarr)) {  ?>
            <th>Phone <?=user_access(220)?' (Click to dial)':''?></th>
                   <?php } ?>                  
           
            <?php if ($showall == true or in_array(5, $acolarr)) {  ?>
                  <th ><?php echo display("create_date"); ?></th>
          <?php } ?>
              <?php if ($showall == true or in_array(6, $acolarr)) {  ?>
                  <th ><?php echo display("created_by"); ?></th>
            <?php } ?>
             <?php if ($showall == true or in_array(7, $acolarr)) {  ?>
                  <th ><?php echo display("assign_to"); ?></th>
                <?php } ?>

               <?php if ($showall == true or in_array(8, $acolarr)) {  ?>
                  <th>Remark</th>
             <?php } ?> 

            <?php if ($showall == true or in_array(9, $acolarr)) {  ?>
                  <th >Branch Name</th>
            <?php } ?>
            <?php if ($showall == true or in_array(10, $acolarr)) {  ?>
                  <th >Final Country</th>
            <?php } ?>

            <?php if ($showall == true or in_array(11, $acolarr)) {  ?>
                  <th >Status</th>
            <?php } ?>

            <?php if ($showall == true or in_array(12, $acolarr)) {  ?>
                  <th >Lead Stage</th>
            <?php } ?>


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
                      foreach ($tags as $tag) {   ?>
                      <option value="<?php echo $tag['id'];?>">
                          <?php echo $tag['title']; ?>
                      </option>
                      <?php } 
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
            <label class=""><input type="checkbox" class="choose-col"  value = "1"  <?php echo ($showall == true or in_array(1, $acolarr)) ? "checked" : ""; ?>>OnboardingId</label>  &nbsp;
          </div>

          <div class = "col-md-4">  
          <label  class=""><input type="checkbox" class="choose-col"  value = "2"  <?php echo ($showall == true or in_array(2, $acolarr)) ? "checked" : ""; ?>> Name</label>
          </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "3"  <?php echo ($showall == true or in_array(3, $acolarr)) ? "checked" : ""; ?>>  Email </label>
          </div>
          
          
          
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "4"  <?php echo ($showall == true or in_array(4, $acolarr)) ? "checked" : ""; ?>>  Phone </label>
              </div>
         
          <div class = "col-md-4">  
          
              <label class=""><input type="checkbox" class="choose-col"  value = "5"  <?php echo ($showall == true or in_array(5, $acolarr)) ? "checked" : ""; ?>>     <?php echo display("create_date"); ?></label> &nbsp;
          </div>
          <div class = "col-md-4">  
          
              <label class=""><input type="checkbox" class="choose-col"  value = "6"  <?php echo ($showall == true or in_array(6, $acolarr)) ? "checked" : ""; ?>>     <?php echo display("created_by"); ?></label>  &nbsp;
          </div>
          <div class = "col-md-4">  
          
              <label class=""><input type="checkbox" class="choose-col"  value = "7"  <?php echo ($showall == true or in_array(7, $acolarr)) ? "checked" : ""; ?>>     <?php echo display("assign_to"); ?></label>  &nbsp;
          </div>

          <div class = "col-md-4">  
            <label class=""><input type="checkbox" class="choose-col"  value = "8"  <?php echo ($showall == true or in_array(8, $acolarr)) ? "checked" : ""; ?>>  Remark</label>  &nbsp;
          </div>

           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "9"  <?php echo ($showall == true or in_array(9, $acolarr)) ? "checked" : ""; ?>> Branch Name</label>  &nbsp; 
           </div>

           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "10"  <?php echo ($showall == true or in_array(10, $acolarr)) ? "checked" : ""; ?>> Final Country</label>  &nbsp; 
           </div>

           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "11"  <?php echo ($showall == true or in_array(11, $acolarr)) ? "checked" : ""; ?>> Status</label>  &nbsp; 
           </div>

           <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "12"  <?php echo ($showall == true or in_array(12, $acolarr)) ? "checked" : ""; ?>> Lead Stage</label>  &nbsp; 
           </div>
                
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
</form>

<script>
$(document).ready(function(){ 
  $('#enq_tags').select2({
  }); 
 });

function mark_tag(){
    var form_data = $("#refund_assing_from").serialize();       
    console.log(form_data);
    $.ajax({
      url: '<?=base_url()?>refund/mark_tag',
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
          $('#refund_table').DataTable().ajax.reload();   
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
    
    document.cookie = "rallowcols="+chkval+"; expires=Thu, 18 Dec 2053 12:00:00 UTC; path=/";
    document.cookie = "rdallowcols="+dchkval+"; expires=Thu, 18 Dec 2053 12:00:00 UTC; path=/";
    location.reload();    
  });

  $(document).ready(function() {
       
      $('#refund_table').DataTable(
        {         
          "processing": true,
          "scrollX": true,
          "scrollY": 520,
          "serverSide": true,          
          "lengthMenu": [ [10,30, 50,100,500,1000, -1], [10,30, 50,100,500,1000, "All"] ],
          "ajax": {
              "url": "<?=base_url().'refund/refund_load_data'?>",
              "type": "POST",
              "data":{'data_type':""}
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

      function process_change_fun(){
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
        $('#refund_table').DataTable().ajax.reload();
        process_change_fun();
      });


      $('#ref_filter').change(function() { 
        var form_data = $("#ref_filter").serialize();       
        $.ajax({
        url: '<?=base_url()?>enq/refund_set_filters_session',
        type: 'post',
        data: form_data,
        success: function(responseData){
          $('#refund_table').DataTable().ajax.reload();
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
    setCookie('refund_filter_setting',arr,365);      
    alert('Your custom filters saved successfully.');
  }) 



var ref_filters  = getCookie('refund_filter_setting');
if (!ref_filters.includes('date')) {
  $('#fromdatefilter').hide();
  $('#todatefilter').hide();
}else{
  $("input[value='date']").prop('checked', true);
}

if (!ref_filters.includes('phone')) {
  $('#phonefilter').hide();
}else{
  $("input[value='phone']").prop('checked', true);
}

if (!ref_filters.includes('employee')) {
  $('#empfilter').hide();
}else{
  $("input[value='employee']").prop('checked', true);
}

if (!ref_filters.includes('email')) {
  $('#emailfilter').hide();
}else{
  $("input[value='email']").prop('checked', true);
}

if (!ref_filters.includes('created_by')) {
  $('#createdbyfilter').hide();
}else{
  $("input[value='created_by']").prop('checked', true);
}
if (!ref_filters.includes('assign_to')) {
  $('#assignfilter').hide();
}else{
  $("input[value='assign_to']").prop('checked', true);
}

if (!ref_filters.includes('stage')) {
  $('#stagefilter').hide();
}else{
  $("input[value='stage']").prop('checked', true);
}
if (!ref_filters.includes('status')) {
  $('#statusfilter').hide();
}else{
  $("input[value='status']").prop('checked', true);
}
if (!ref_filters.includes('days')) {
  $('#daysfilter').hide();
}else{
  $("input[value='days']").prop('checked', true);
}
if (!ref_filters.includes('final')) {
  $('#finalfilter').hide();
}else{
  $("input[value='final']").prop('checked', true);
}

if (!ref_filters.includes('tag')) {
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
        }
        else{
           $('#fromdatefilter').hide();
           $('#todatefilter').hide();
           $("#buttongroup").hide();
        }

        if($('#empcheckbox').is(":checked")){
          $('#empfilter').show();
        }
        else{
          $('#empfilter').hide();
        }

        if($('#emailcheckbox').is(":checked")){
          $('#emailfilter').show();
        }
        else{
          $('#emailfilter').hide();
        }

        if($('#phonecheckbox').is(":checked")){
          $('#phonefilter').show();
        }
        else{
          $('#phonefilter').hide();
        }

        if($('#createdbycheckbox').is(":checked")){
          $('#createdbyfilter').show();
        }
        else{
          $('#createdbyfilter').hide();
        }
        if($('#assigncheckbox').is(":checked")){
          $('#assignfilter').show();
        }
        else{
          $('#assignfilter').hide();
        }

       if($('#stageheckbox').is(":checked")){
          $('#stagefilter').show();
       }
       else{
         $('#stagefilter').hide();
       }

       if($('#statuscheckbox').is(":checked")){
          $('#statusfilter').show();
       }
       else{
         $('#statusfilter').hide();
       }

       if($('#dayscheckbox').is(":checked")){
          $('#daysfilter').show();
       }
       else{
         $('#daysfilter').hide();
       }

      if($('#finalcheckbox').is(":checked")){
          $('#finalfilter').show();
       }else{
          $('#finalfilter').hide();
       }

       if($('#tagcheckbox').is(":checked")){
          $('#tagfilter').show();
       }else{
          $('#tagfilter').hide();
       }
       
    });
})

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

$('#select_user').select2({});
$('#assid').select2({});
$('#creid').select2({});
</script>