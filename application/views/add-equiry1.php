<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>   
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<style>
   label{         
   font-weight:bold;
   font-size:13px;
   }
</style>

<div class="col-md-1"></div>
<div class="col-sm-10">
   <div  class="panel panel-default thumbnail">
      <div class="panel-heading no-print">
         <div class="btn-group"> 
       <a class="btn btn-primary" href="<?php echo base_url("enquiry") ?>"> <i class="fa fa-list"></i>&nbsp;<?php echo display("enquiry"); ?></a>  
         </div>
      </div>
      <div class="panel-body panel-form">
         <div class="row">          
            <?php              
            if (!$invalid_process) { ?>              
            <form method="post" action="<?=base_url()?>enquiry/create" id="enquiry_form">
              <?php $process_id = $this->session->process[0]; ?>
              <input type="hidden" name="product_id" id="product_id_alert" value="<?=$process_id?>">
              <div id="process_basic_fields" class="row">
              </div>            
              <div class="row">
                  <button class="btn btn-primary" type="submit">Save</button>
                  <input  class="btn btn-success" type="button" id="saveandnew" value="Save And Create New"/>
              </div>
            </form>
            <?php

            }else{ 

              ?>
              <div>
                <div class="alert alert-danger">
                  <strong>Please Select one process in which you want to create enquiry</strong>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
      </div>
   </div>
</div>

<script type="text/javascript">
  
  $('input#saveandnmmew').click( function() {
    $.ajax({
        url: "<?=base_url()?>enquiry/create",
        type: 'post',
        dataType: 'json',
        data: $('form#enquiry_form').serialize(),
        success: function(data) 
        {
          if(data.status == "success")
          {
            //swal("success","Your Enquiry has been  Successfully created","success");
            Swal.fire({
              icon: 'success',
              title: 'Your Enquiry has been  Successfully created',
              showConfirmButton: true,
            });
            $('#enquiry_form').trigger("reset");
          }
          else
          {
            Swal.fire({
              icon: 'warning',
              title: data.error,
              showConfirmButton: true,
            });
          }
        }
    });
});
</script>

<script type="text/javascript">
function add_more_phone(add_more_phone) {
  var html='<div class="form-group col-sm-4"><label>Other No </label><input class="form-control"  name="other_no[]" type="text" placeholder="Other Number"   ></div>';
  $('#'+add_more_phone).append(html);          
  }

  function add_more_email(add_more_email) {
       var html='<div class="form-group col-sm-4"><label>Other Email </label><input class="form-control"  name="other_email[]" type="text" placeholder="Other Email"></div>';
        $('#'+add_more_email).append(html);          
    }
</script>
  <script type="text/javascript">      
  $(function () {    
    var process_id = "<?=$process_id?>";   
    if (process_id) {
      get_basic_field();           
    }
  });
  function get_basic_field(){
      var process_id = "<?=$process_id?>";
      var tele_mob = "<?=$mobi?>";   
      var para ='';
      if ("<?=!empty($_GET['phone'])?$_GET['phone']:''?>"!="") {
        para = "?phone=<?=!empty($_GET['phone'])?$_GET['phone']:''?>";
      }
      var url = "<?=base_url().'form/form/get_basic_field_by_process'?>"+para;       
      $.ajax({
          type: "POST",
          url: url,
          data: {
            'process_id':process_id,'tele_mob':tele_mob
          },
          success: function(data){                
            $("#process_basic_fields").html(data);
            $("#fcity").select2();
            $("#fstate").select2();
            get_custom_field(); 
          }
      });
   }
   function get_custom_field(){
      var process_id = "<?=$process_id?>";   
      var url = "<?=base_url().'form/form/get_custom_field_by_process'?>";       
      $.ajax({
          type: "POST",
          url: url,
          data: {
            'process_id':process_id
          },
          success: function(data){                
            $("#process_basic_fields").append(data);
            hide_all_dependent_field();
          }
      });
   }



$(document).on("change",'#fcity',function () {
    var selDpto = $(this).val(); // <-- change this line
    $.ajax({
        url: "<?php echo base_url();?>lead/select_state_by_city",
        async: false,
        type: "POST",
        data: {city_id:selDpto},
       dataType: 'html',
        success: function(data) {
        var obj=JSON.parse(data);
          $('#fstate option[value="'+obj.state_id+'"]').attr("selected","selected");
        }
    })
});


  $(document).on("change",'#fstate',function () {
    var id = $(this).val(); // <-- change this line
    $.ajax({
        url: "<?php echo base_url();?>location/get_city_byid",
        async: false,
        type: "POST",
        data: {state_id:id},
       dataType: 'html',
        success: function(data) {
          $('#fcity').html(data);
        }
    })
});  
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
</script>
<?php
  if ($this->session->companey_id == 79) {
?>
<script>
    $('#vertex-course').on('change',function(){
      subcourse();
    });    
    function subcourse(){    
        var options = '';
        course = $("#vertex-course").val();
        if(course == 'SCIENCE & DEVELOPMENT'){
            options = `<option>WEB DEVELOPMENT 
                        <option>DATA SCIENCE</option> 
                        <option>MOBILE APPS</option> 
                        <option>CODINGS</option> 
                        <option>GAMING</option> 
                        <option>DATABASES</option>
                        <option>SOFTWARE TESTING</option> 
                        <option>ECOMMERCE</option> 
                        <option>TOOLS FOR WEBSITE</option> 
                        <option>ALGORITHMS</option> 
                        <option>SOFTWARE DEVELOPMENT</option> 
                        <option>SECURITY AND NETWORKS</option>`;
        }else if(course == 'DESIGN'){
            options = `<option>WEB DESIGN</option> 
                        <option>GRAPHIC DESIGN</option> 
                        <option>GAME DESIGN</option> 
                        <option>3D AND ANIMATION</option>
                        <option>FASHION DESIGNING</option> 
                        <option>ARCHITECHTURE</option> 
                        <option>INTERIOR DESIGN</option>`;
            
        }else if(course == 'BUSINESS'){
            options = `<option>FINANCE</option> 
                        <option>MANAGEMENT</option> 
                        <option>SALES</option>
                        <option>HUMAN RESOUCE</option> 
                        <option>COMMUNICATION</option> 
                        <option>PROJECT MANAGEMENT</option> 
                        <option>DIGITAL MARKETING</option> 
                        <option>MARKETING</option> 
                        <option>MEDIA</option> 
                        <option>ENTREPRENUERSHIP</option> 
                        <option>BUSINESS STARTERGY</option>  
                        <option>OPERATIONS</option> 
                        <option>DATA AND ANALYTICS</option> 
                        <option>BUSINESS LAW</option>
                        <option>REAL ESTATE</option> 
                        <option>DATA MANAGEMENT</option>`;
        }else if(course == 'LIFESTYLE'){
            options = `<option>ARTS</option> 
                        <option>PHOTOGRAPHY</option>
                        <option>GAMING</option> 
                        <option>MUSIC</option> 
                        <option>COOKING</option>`;
        }else if(course == 'ACADEMICS'){
            options = `<option>ENGINEERING</option> 
                        <option>HUMANITIES</option> 
                        <option>SOCIAL STUDIES</option> 
                        <option>SCIENCE</option> 
                        <option>MATHEMATICS</option> 
                        <option>LANGUAGES</option>`;
        }else if(course == 'PROFESSIONAL'){
            options = `<option>LEADERSHIP</option> 
                        <option>STRESS MANAGEMENT</option> 
                        <option>MOTIVATION</option> 
                        <option>CAREER DEVELOPMENT</option> 
                        <option>SOFT SKILLS</option>`;

        }else if(course == 'TECHNOLOGY & DATA'){
            options = `<option>CLOUD COMPUTING</option> 
                        <option>NETWORKING</option> 
                        <option>DATA ANALYTICS</option>
                        <option>PROBABILITY AND STATISTICS</option>
                        <option>MACHINES LEARNING</option>`; 

        }else if(course == 'LANGUAGES'){
            options = `<option>ENGLISH</option> 
                        <option>FRENCH</option> 
                        <option>SPANISH</option> 
                        <option>JAPANESE</option>
                        <option>GERMAN</option>
                        <option>CHINESE</option>`;

        }else if(course == 'Fitness'){
            options = `<option>Yoga</option>
                        <option>Zumba</option>
                        <option>Diet</option>`;
        }else if(course == 'Other'){
            
        }
        $("#vertex-sub-course").html(options);
    }
</script>
<?php
}
?>