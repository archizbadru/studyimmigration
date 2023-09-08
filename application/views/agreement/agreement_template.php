<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<link href="<?php echo base_url(); ?>assets/summernote/summernote-bs4.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/c3/c3.min.css" rel="stylesheet" type="text/css"  />

<div class="row">
   <!--  table area --> 
   <div class="col-sm-12">
      <div class="panel panel-default thumbnail">
         <br>
         <div class="panel-body">
               <div class="tab-content clearfix">                  
                  <div class="tab-pane active" id="tab-templates">
                     <br>
                     <button class="btn btn-sm btn-success" style="float: left" type="button" data-toggle="modal" data-target="#createnewtemplate"><i class="fa fa-plus"></i> Add New Template</button>
                     <br>
                     <br>
                     <form   action='' method="post" id="temptable">
                        <table width="100%" id="aggrmnt" class="datatable table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1"><input type='checkbox' class="checked_alltemp" value="check all" >&nbsp; <?php echo display('serial') ?></th>
                                 <th nowrap>Template Name</th>
                                 <th nowrap>Template Content</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if (!empty($all_template)) { ?>
                              <?php $sl = 1; ?>
                              <?php foreach ($all_template as $tlist) { ?>
                              <tr>
                                 <td class="th0"><input type='checkbox' onclick="event.stopPropagation();" name='sel_temp[]' class="checkboxtemp" value='<?php echo $tlist->id;?>'>&nbsp; <?php echo $sl;?></td>
                                 <td class="th1" class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="cursor:pointer;" data-toggle="modal" data-target="#createnewtemplate<?php echo $tlist->id;?>"><?php echo $tlist->template_name; ?></td>
                                 <td class="th2">
<div class="click_hide"><?php // strip tags to avoid breaking any html
$string = strip_tags($tlist->template_content);
if (strlen($string) > 100) {

    // truncate string
    $stringCut = substr($string, 0, 100);
    $endPoint = strrpos($stringCut, ' ');

    //if the string doesn't contain any space then it will cut without word basis.
    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
}
echo $string; ?>
</div>
<a href="#" class="show_hide" data-content="toggle-text">Read More</a>
<div class="contentx"> <?php echo $tlist->template_content; ?></div>
                                 </td>
                              </tr>
                              <?php $sl++; ?>
                              <?php } ?> 
                              <?php } ?> 
                           </tbody>
                        </table>
                        <button class="btn btn-danger" type="button" onclick="return is_deleteTemp()" >
                        <i class="ion-close-circled"></i>
                        Delete
                        </button>
                     </form>
                     <?php foreach ($all_template as $tlist) { ?>
                     <div id="createnewtemplate<?php echo $tlist->id;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                           <!-- Modal content-->
                           <div class="modal-content" >
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Edit Template <?php echo $tlist->template_name; ?></h4>
                              </div>
                              <div class="modal-body">
                                 <!--<form>-->
                                 <?php echo form_open_multipart('lead/template_details_update','class="form-inner"') ?>                      
                                 <div class="row">
                                    <input type="hidden" name="template_id" value="<?php echo $tlist->id; ?>">
                                    <div class="form-group   col-sm-12">
                                       <label>Template Name*</label>
                                       <input class="form-control" name="template_name" type="text" required="" value="<?php echo $tlist->template_name; ?>"> 
                                    </div>
                                    <div class="form-group col-sm-12">
                                       <label>Template Content</label>
                                       <textarea name="template_content" class="form-control summernote"  rows="7"><?php echo $tlist->template_content; ?></textarea>
                                    </div>
                                 </div>
                                 <div class="col-12" style="padding: 0px;">
                                    <div class="row">
                                       <div class="col-12" style="text-align:center;">                                                
                                          <button class="btn btn-success" type="submit">Save</button>            
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
                     <?php } ?>
                  </div>
               </div>
            <!-- /.table-responsive -->
         </div>
      </div>
   </div>
</div>

<!--------------- ADD NEW Template ------------->
<div id="createnewtemplate" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New</h4>
         </div>
         <div class="modal-body">
            <!--<form>-->
            <?php echo form_open_multipart('lead/agreement_template','class="form-inner" id="agreement_template"') ?>                      
            <div class="row">
               <div class="form-group   col-sm-12">
                  <label>Template Name*</label>
                  <input class="form-control" name="template_name" type="text" required="">
               </div>
               <div class="form-group row col-md-12">
                  <label for="message" class="col-xs-3 col-form-label">Template Content <i class="text-danger">*</i></label>
                  <div class="col-lg-12">
                     <textarea name="template_content" class="form-control summernote"   rows="7"></textarea>
                  </div>
               </div>
            </div>
            <div class="col-12" style="padding: 0px;">
               <div class="row">
                  <div class="col-12" style="text-align:center;">                                                
                     <button class="btn btn-success" type="submit">Save</button>            
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
<script src="<?php echo base_url('assets/js/editor/editor.js') ?>"></script>

<script>   
   $('.checked_alltemp').on('change', function() {     
   
                   $('.checkboxtemp').prop('checked', $(this).prop("checked"));              
   
           });
   
           $('.checkboxtemp').change(function(){ 
   
               if($('.checkboxtemp:checked').length == $('.checkboxtemp').length){
   
                      $('.checked_alltemp').prop('checked',true);
   
               }else{
   
                      $('.checked_alltemp').prop('checked',false);
   
               }
   
           });   
   
   
   function is_deleteTemp(){
   
     var x=  confirm('Are you sure want to delete ? ');
   
     if(x==true){
   
   $.ajax({
   
   type: 'POST',
   
   url: '<?php echo base_url();?>lead/delete_template',
   
   data: $('#temptable').serialize()
   
   })
   
   .done(function(data){
   
   alert( "success!" );
   
   location.reload(); 
   
   })
   
   .fail(function() {
   
   alert( "fail!" );
   
   
   
   });
   
   }else{
   
       location.reload(); 
   
   }
   
   }
   
   
   
</script>
<script src="<?php echo base_url(); ?>assets/summernote/summernote-bs4.min.js"></script>
<script>
$(document).ready(function() {
   // $('#aggrmnt').DataTable();
} );

   jQuery(document).ready(function(){
   
       $('.summernote').summernote({
   
           height: 200,                 // set editor height
   
           minHeight: null,             // set minimum height of editor
   
           maxHeight: null,             // set maximum height of editor
   
           focus: false                 // set focus to editable area after initializing summernote
   
       });
   
   });
   
</script>
<script type="text/javascript">
  $(document).ready(function () {
    $(".contentx").hide();
    $(".click_hide").show();
    $(".show_hide").on("click", function () {
        var txt = $(".contentx").is(':visible') ? 'Read More' : 'Read Less';
        $(".show_hide").text(txt);
        $(this).next('.contentx').slideToggle(200);
        $(this).prev('.click_hide').slideToggle(200);
    });
});
</script>