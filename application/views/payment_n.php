<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<style>
  .dropdown_css {
  left:auto!important;
  right: 0 ! important;
}
.dropdown_css a,.dropdown_css a h4{
  width:100%;text-align:left! important;
  border-bottom: 1px solid #c8ced3! important;
}
</style>
<form method="post" id="pay_filter" >
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
            </div>                                         
          </div>  
        </div>       
      </div>
</div>
</div>



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
                    </div>
          
            </div>
        </div>
    </div>   
</form>
<br>
<br>

<form class="form-inner" method="post" id="payment_assing_from" >  
<div class="card-body">
      <?php 
        $acolarr = array();
        $dacolarr = array();
        if(isset($_COOKIE["pallowcols"])) {
          $showall = false;
          $acolarr  = explode(",", trim($_COOKIE["pallowcols"], ","));       
        }else{          
          $showall = true;
        }         
        if(isset($_COOKIE["pdallowcols"])) {
          $dshowall = false;
          $dacolarr  = explode(",", trim($_COOKIE["pdallowcols"], ","));       
        }else{
          $dshowall = false;
        }       
      ?>
  <div class="row">
    <div class="col-md-12" >    
            <table id="payment_table" class="table table-bordered table-hover mobile-optimised" style="width:100%;">
        <thead>
          <tr class="bg-info table_header">
                  <th>S.N</th>

              <?php if ($showall == true or in_array(1, $acolarr)) {  ?>
                  <th>Applicant</th>
             <?php } ?> 

              <?php if ($showall == true or in_array(2, $acolarr)) {  ?>
            <th>Email</th>
                   <?php } ?>
              <?php if ($showall == true or in_array(3, $acolarr)) {  ?>
            <th>Mobile </th>
                   <?php } ?>
              <?php if ($showall == true or in_array(4, $acolarr)) {  ?>
            <th>Txn-Id</th>
                   <?php } ?>                  
           
            <?php if ($showall == true or in_array(5, $acolarr)) {  ?>
                  <th >Amount</th>
          <?php } ?>
              <!--<?php if ($showall == true or in_array(6, $acolarr)) {  ?>
                  <th >Deatils</th>
            <?php } ?>-->
             <?php if ($showall == true or in_array(7, $acolarr)) {  ?>
                  <th >Pay Date</th>
              <?php } ?>
          </tr>
        </thead>
        <tbody>             
        </tbody>
      </table>
    </div>
  </div>
</div>


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
            <label class=""><input type="checkbox" class="choose-col"  value = "1"  <?php echo ($showall == true or in_array(1, $acolarr)) ? "checked" : ""; ?>>Applicant</label>  &nbsp;
          </div>

          <div class = "col-md-4">  
          <label  class=""><input type="checkbox" class="choose-col"  value = "2"  <?php echo ($showall == true or in_array(2, $acolarr)) ? "checked" : ""; ?>> Email</label>
          </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "3"  <?php echo ($showall == true or in_array(3, $acolarr)) ? "checked" : ""; ?>>  Mobile</label>
          </div>
          
          
          
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "4"  <?php echo ($showall == true or in_array(4, $acolarr)) ? "checked" : ""; ?>>  Txn-Id</label>
              </div>
         
          <div class = "col-md-4">  
          
              <label class=""><input type="checkbox" class="choose-col"  value = "5"  <?php echo ($showall == true or in_array(5, $acolarr)) ? "checked" : ""; ?>>  Amount</label> &nbsp;
          </div>
          <div class = "col-md-4">  
          
              <label class=""><input type="checkbox" class="choose-col"  value = "6"  <?php echo ($showall == true or in_array(6, $acolarr)) ? "checked" : ""; ?>>  Deatils</label>  &nbsp;
          </div>
          <div class = "col-md-4">  
          
              <label class=""><input type="checkbox" class="choose-col"  value = "7"  <?php echo ($showall == true or in_array(7, $acolarr)) ? "checked" : ""; ?>>  Pay Date</label>  &nbsp;
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
    
    document.cookie = "pallowcols="+chkval+"; expires=Thu, 18 Dec 2053 12:00:00 UTC; path=/";
    document.cookie = "pdallowcols="+dchkval+"; expires=Thu, 18 Dec 2053 12:00:00 UTC; path=/";
    location.reload();    
  });

  $(document).ready(function() {
       
      $('#payment_table').DataTable(
        {         
          "processing": true,
          "scrollX": true,
          "scrollY": 520,
          "serverSide": true,          
          "lengthMenu": [ [10,30, 50,100,500,1000, -1], [10,30, 50,100,500,1000, "All"] ],
          "ajax": {
              "url": "<?=base_url().'refund/payment_load_data'?>",
              "type": "POST",
              "data":{'data_type':""}
          },
        <?php if(user_access(500)) { ?>
          dom: "<'row text-center'<'col-sm-12 col-xs-12 col-md-4'l><'col-sm-12 col-xs-12 col-md-4 text-center'B><'col-sm-12 col-xs-12 col-md-4'f>>tp", 
 
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


      $('#pay_filter').change(function() { 
        var form_data = $("#pay_filter").serialize();       
        $.ajax({
        url: '<?=base_url()?>enq/payment_set_filters_session',
        type: 'post',
        data: form_data,
        success: function(responseData){
          $('#payment_table').DataTable().ajax.reload();
          stage_counter();      
        }
      });
      });
      

  } );
</script>


<script>
  
$(document).ready(function(){
   $("#save_advance_filters").on('click',function(e){
    e.preventDefault();
    var arr = Array();  
    $("input[name='filter_checkbox']:checked").each(function(){
      arr.push($(this).val());
    });        
    setCookie('payment_filter_setting',arr,365);      
    alert('Your custom filters saved successfully.');
  }) 

var pay_filters  = getCookie('payment_filter_setting');
if (!pay_filters.includes('date')) {
  $('#fromdatefilter').hide();
  $('#todatefilter').hide();
}else{
  $("input[value='date']").prop('checked', true);
}

if (!pay_filters.includes('phone')) {
  $('#phonefilter').hide();
}else{
  $("input[value='phone']").prop('checked', true);
}

if (!pay_filters.includes('employee')) {
  $('#empfilter').hide();
}else{
  $("input[value='employee']").prop('checked', true);
}

if (!pay_filters.includes('email')) {
  $('#emailfilter').hide();
}else{
  $("input[value='email']").prop('checked', true);
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
       
    });
})
</script>