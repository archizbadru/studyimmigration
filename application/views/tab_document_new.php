               <div class="tab-pane <?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='document'){ echo 'active';}};?>" id="document_new">
                <div class="content-panel">
                <hr>
  
<div class="postdoccontainer" style="">    
  <div class="form-group col-md-12">
    <div class="form-group col-md-6">
        <label>Document Type</label>
        <select class="form-control"  name="doc_type"  id="all_type" onchange="find_stream_name(this.value,0)"> 
            <option value = "">Select Stream</option>
            <?php foreach($post_doc_list as $doc_type){ ?>
            <option value = "<?php echo $doc_type->id; ?>"><?php echo $doc_type->document_type; ?></option>
      <?php } ?>
        </select>
    </div>
  <div class="form-group col-md-6">
        <label>Document Stream Name</label>
        <select class="form-control"  name="stream_name"  id="all_stream0" onchange="find_file_name(this.value,0)"> 

        </select>
    </div>
    <div class="form-group col-md-12" id="all_files">

    </div>
  </div>
</div>
<button class="btn btn-sm btn-success center-block" type="button"><i class="fa fa-download"></i><a href="<?php echo base_url().'/lead/select_file_download/'.$this->uri->segment(3);?>" style="color:#fff;">&nbsp; All Document Download</a></button>

                </div>
              </div>
<script>
function find_stream_name(sid,x) {  
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_file_stream',
            data: {stream_id:sid},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].stream)+'</option>';
                }
                
                $("#all_stream"+x).html(html);
                
            }           
            });
            }
      
function find_file_name(fid,x) {
var doc_typ = $("select[name='doc_type']").val();
var en_no = "<?=$this->uri->segment(3)?>";
//alert(en_no);
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_file_type',
            data: {file_id:fid,doc_type:doc_typ,enq_no:en_no},
            
            success:function(data){
                var html=data;                
                $("#all_files").html(html);
                
            }           
            });
            }

function document_save(x){
var attachment = new FormData();
var enq_no = $("#enq_no"+x).val();
var doc_type = $("#doc_type"+x).val();
var stream_name = $("#stream_name"+x).val();
var file_name = $("#file_name"+x).val();
var d_remark = $("#d_remark"+x).val();
      attachment.append('browse_file', $("#browse_file"+x)[0].files[0]);
      attachment.append('enq_no',enq_no );
      attachment.append('doc_type',doc_type );
      attachment.append('stream_name',stream_name );
      attachment.append('file_name',file_name );
      attachment.append('d_remark',d_remark );     
$.ajax({
type: 'POST',
url: '<?=base_url()?>lead/client_document_save/'+x,
data:attachment,
contentType: false,
processData: false,
async: false,
success: function(responseData){
  if(responseData=='1'){
  Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Document saved successfully',
  showConfirmButton: false,
  timer: 1500
});
}else{
Swal.fire({
  position: 'top-end',
  icon: 'error',
  title: 'Something went wrong!',
  showConfirmButton: false,
  timer: 1500
});
}
}
});
  }

function document_check(x,y,z){
if ($('#checklist'+x).is(':checked')){ 
  var check = 1;
}else{
  var check = 0;
}    
$.ajax({
type: 'POST',
url: '<?=base_url()?>lead/client_document_checklist',
data: {sn:x,doc:y,enq_no:z,check:check},
success: function(responseData){
  if(responseData=='1'){
  Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Checklist Upadate successfully',
  showConfirmButton: false,
  timer: 1500
});
}else{
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Checklist Upadate successfully',
  showConfirmButton: false,
  timer: 1500
});
}
}
});
  }

function document_required(x,y,z){
if ($('#required'+x).is(':checked')){ 
  var check = 1;
}else{
  var check = 0;
}    
$.ajax({
type: 'POST',
url: '<?=base_url()?>lead/client_document_required',
data: {sn:x,doc:y,enq_no:z,check:check},
success: function(responseData){
  if(responseData=='1'){
  Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Required Upadate successfully',
  showConfirmButton: false,
  timer: 1500
});
}else{
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Required Upadate successfully',
  showConfirmButton: false,
  timer: 1500
});
}
}
});
  }

function document_edit(x,y,z){
if ($('#edit'+x).is(':checked')){ 
  var check = 1;
}else{
  var check = 0;
}    
$.ajax({
type: 'POST',
url: '<?=base_url()?>lead/client_document_edit',
data: {sn:x,doc:y,enq_no:z,check:check},
success: function(responseData){
  if(responseData=='1'){
  Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Edit Upadate successfully',
  showConfirmButton: false,
  timer: 1500
});
}else{
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Edit Upadate successfully',
  showConfirmButton: false,
  timer: 1500
});
}
}
});
  }

function document_approve(x,y,z){
if ($('#approved'+x).is(':checked')){ 
  var check = 1;
}else{
  var check = 0;
}    
$.ajax({
type: 'POST',
url: '<?=base_url()?>lead/client_document_approve',
data: {sn:x,doc:y,enq_no:z,check:check},
success: function(responseData){
  if(responseData=='1'){
  Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Approved Upadate successfully',
  showConfirmButton: false,
  timer: 1500
});
}else{
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Approved Upadate successfully',
  showConfirmButton: false,
  timer: 1500
});
}
}
});
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var max_fields = 10;
  var cntry_id = '<?php if(!empty($details->enq_country)){ echo $details->enq_country;}else{ echo $details->country_id;}; ?>';
    var wrapper = $(".postdoccontainer");
    var add_button = $(".add_form_field_pdoc");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
      $.ajax({
        url: '<?=base_url("lead/getHtml/")?>'+cntry_id+'/'+x,
        type: 'POST', 
        dataType : "json",
        success : function(data)
        {
          $(wrapper).append(data.html); //add input box
        }
      });
            
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
</script>
 <script>
     $(document).ready(function () {
  $('#dtBasicExampled').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
 </script>