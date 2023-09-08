<?php 
    if(!empty($nav1)){}else{$nav1='';}
    $panel_menu = $this->db->select("modules")
    ->where('pk_i_admin_id',$this->session->user_id)
    ->get('tbl_admin')
    ->row();
    $user_module=explode(',',$panel_menu->modules);

?>

<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary"> <i class="fa fa-list"></i> Add Invoice </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        
          

    <!-- Modal content-->
      <form action="<?php echo base_url();?>lead/invoice_add" method="post" enctype="multipart/form-data">
    <div class=" card">

      <div>
                <div class="form-group col-sm-12"> 
                <label>Add Invoice</label>
                <input type="file" name="img_file" class="from-control" accept=".doc,.docx,.jpg,.png,.pdf"> 
                </div>
      </div>
      
       <div class="col-md-12">
                                                               
                    <button class="btn btn-success" type="submit" >Save</button>            
                   <input type="hidden" value="<?php echo $enquiry_id;?>"  id="lead_id_name" name="lead_id_name">
              </div>
     
    </div>
</form>
  
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
$(document).ready(function (e){
$("#upload_po").on('submit',(function(e){
e.preventDefault();
$.ajax({
url: "<?php echo base_url();?>lead/post_po",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data){
      alert('success');
  
},
error: function(){
    
} 	        
});
}));
});
</script>
<script type="text/javascript">
            function find_region() {
                       $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>location/get_region_byid',
            data: $('#territory').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('region_id').innerHTML=data;
            }else{
              document.getElementById('region_id').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
        </script>
        
        <script type="text/javascript">
            function find_teretory() {
       
                       $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>location/get_tretory_byid',
            data: $('#territory').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('territory_id').innerHTML=data;
            }else{
              document.getElementById('territory_id').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
        </script>
         <script type="text/javascript">
            function find_state() {
       
                       $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>location/get_state_byid',
            data: $('#territory').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('state_id').innerHTML=data;
            }else{
              document.getElementById('state_id').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
        </script>
         <script type="text/javascript">
            function find_city() {
       
                       $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>location/get_city_byid',
            data: $('#territory').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('city_name').innerHTML=data;
            }else{
              document.getElementById('city_name').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
        </script>
        
        
        
        