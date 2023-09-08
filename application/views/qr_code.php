<div class="row">
   <!--  table area --> 
   <div class="col-sm-12">
      <div class="panel panel-default thumbnail">
         <div class="col-md-12">
            <div class="panel-body">
               <div class="col-sm-12">
                  <!--<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8" title="Link to Google.com" />-->
                  <button class="btn btn-sm btn-success" style="float: left" type="button" data-toggle="modal" data-target="#createnewintegration"><i class="fa fa-plus"></i> <?php echo display('add_new_integration');?></button>
               </div>
               <br><br>
               <table width="100%" class="datatable1 table table-striped table-bordered table-hover">
                  <thead>
                     <tr>
                        <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1">&nbsp; <?php echo display('serial') ?></th>
                        <th class="th1"><?php echo display('integration_name');?></th>
                        <th class="th2"><?php echo display('assign_to');?></th>
                        <th class="th3"><?php echo display('qr_code');?></th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (!empty($web_intergrationlist)) { ?>
                     <?php $sl = 1; ?>
                     <?php foreach ($web_intergrationlist as $list) { ?>
                     <?php foreach($user_list as $val){ 
                        if($val->pk_i_admin_id==$list->assign_by){
                        
                            $name=$val->s_display_name.' '.$val->last_name;
                        
                        }
                        
                        }
                        
                        ?>
                     <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="cursor:pointer;"  data-toggle="modal" data-target="#createnewintegration<?php echo $list->wid;?>">
                        <td class="th0" onclick="event.stopPropagation();">&nbsp; <?php echo $sl;?></td>
                        <td class="th1"><?php echo $list->integration_name; ?></td>
                        <td class="th2"><?php echo !empty($name)?$name:''; ?></td>
                        <td class="th3"><a href="<?php echo $list->capture_link; ?>"><img  id="<?php echo $list->wid; ?>" src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $list->capture_link?>&choe=UTF-8" /></a></td>
                        <td class="center">
                           <a onclick="Popup('https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $list->capture_link?>&choe=UTF-8')" class="btn btn-xs  btn-warning"><i class="fa fa-print"></i></a>  
                           <!-- <a href="<?php echo base_url("configurations/delete_integration/$list->wid") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a>--> 
                        </td>
                     </tr>
                     <!--------------- ADD NEW API ------------->
                     <?php $sl++; ?>
                     <?php } ?> 
                     <?php } ?> 
                  </tbody>
               </table>
               <!-- /.table-responsive -->
            </div>
         </div>
      </div>
   </div>
</div>
<style>
   #exTab3 .nav-pills > li > a {
   border-radius: 4px 4px 0 0 ;
   }
   #exTab3 .tab-content {
   background-color: #f1f3f6;
   padding : 5px 15px;
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
   input[type=number]::-webkit-inner-spin-button, 
   input[type=number]::-webkit-outer-spin-button { 
   -webkit-appearance: none; 
   margin: 0; 
   }
   input[type=number]::-webkit-inner-spin-button, 
   input[type=number]::-webkit-outer-spin-button { 
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;
   margin: 0; 
   }
</style>
<!--------------- ADD NEW CLIENT ------------->
<div id="createnewintegration" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Use our QR-Code integration link to capture enquiries, to create your QR-Code provide information below</h4>
         </div>
         <div class="modal-body">
            <!--<form>-->
            <?php echo form_open_multipart('configurations/create_qr_code','class="form-inner"') ?>                      
            <div class="row">
               <div class="form-group   col-sm-6">
                  <label><?php echo display('integration_name');?>*</label>
                  <input class="form-control" name="integration_name" type="text" id="IntegrationName"  required=""> 
               </div>
               <div class="form-group   col-sm-6">
                  <label>Type*</label>
                  <select class="form-control" name="qr_code_type">
                     <option value="1">Onboarding</option>
                     <option value="2">Event</option>
                     <option value="3">Webinar</option>
                  </select>
               </div>
               <div class="form-group col-sm-6">
                  <label><?php echo display('assign_to');?>*</label>
                  <select class="form-control" name="assign" id="enquiry_type" required >
                     <option value="" style="">Select User</option>
                     <?php foreach($user_list as $val){ ?>
                     <option value="<?php echo $val->pk_i_admin_id; ?>"><?php echo $val->s_display_name.' '.$val->last_name; ?></option>
                     <?php } ?>
                  </select> 
               </div>

               <div class="form-group col-sm-6">
                  <label><?php echo display('proccess');?>*</label>
                  <select class="form-control" name="assign_process" id="assign_process" required >
                     <option value="" style="">Select Process</option>
                     <?php foreach($process_listss as $val){ ?>
                     <option value="<?php echo $val->sb_id; ?>"><?php echo $val->product_name; ?></option>
                     <?php } ?>
                  </select> 
               </div>
            </div>
            <div class="col-12" style="padding: 0px;">
               <div class="row">
                  <div class="col-12" style="text-align:center;">                                                
                     <button class="btn btn-success" type="submit"><?php echo display('save');?></button>            
                  </div>
               </div>
            </div>
            </form> 
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo display('close');?></button>
         </div>
      </div>
   </div>
</div>
<!---------------------------------------------------------------->
<script>
   function ImagetoPrint(source)
   
    {
   
        return "<html><head><scri"+"pt>function step1(){\n" +
   
                "setTimeout('step2()', 10);}\n" +
   
                "function step2(){window.print();window.close()}\n" +
   
                "</scri" + "pt></head><body onload='step1()'>\n" +
   
                "<img src='" + source + "' /></body></html>";
   
    }
   
   
   
    function Popup(source)
   
    {
   
        var Pagelink = "about:blank";
   
        var pwa = window.open(Pagelink, "_new");
   
        pwa.document.open();
   
        pwa.document.write(ImagetoPrint(source));
   
        pwa.document.close();
   
    }
jQuery(document).ready(function(){
$("#enquiry_type").select2();
$("#assign_process").select2();
});   
</script>