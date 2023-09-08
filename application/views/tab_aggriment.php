    <div class="tab-pane" id="aggrement">
 <hr> 
 
 
 <script>
     $(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
 </script>

<form id="formtype" method="post">
<div class="col-md-6" style="padding:20px;">
<input type="hidden" id="enq_id" name="enq_id" value="<?php echo $this->uri->segment(3); ?>" class="col-md-6">
            <select class="form-control"  name="agg_frmt"  id="agg_frmt"> 
              <option>Select Form</option>
              <option value = "CDF">Client Detail Form</option>
            </select>
</div>
<div class="col-md-6" style="padding:20px;">                                                
            <button type="button" onclick="find_form()">Find Agreement Form</button> 			
</div>
</form>
 
            <div class="col-md-12 col-sm-12" id="agg_form">        


            </div>


<script>
function myaggrement() {
if (document.getElementById('agg_same').checked) 
  {
    var cdata=$("#agg_same").val();
     $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>client/find_same',
            data: {cdata:cdata},
         success:function(data){
            res = JSON.parse(data);
              if(res){              
                $("input[name='agg_user']").val(res.name_prefix + res.name  +' '+ res.lastname);
                $("input[name='agg_mobile']").val(res.phone);                
                $("input[name='agg_email']").val(res.email);
                $("input[name='agg_adrs']").val(res.address);              
              }
         }               
     });        
    }else{
                $("input[name='agg_user']").val('');
                $("input[name='agg_mobile']").val('');                
                $("input[name='agg_email']").val('');
                $("input[name='agg_adrs']").val('');  
    }      
}
</script>

<script>
function  find_form(){
     $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>client/read_form',
        data: $('#formtype').serialize()
      })
	  .done(function(data){
		  //alert(data);
       $('#agg_form').html(data);
   })

.fail(function() {
   alert( "fail!" );   
   });
  }
</script>

</div>