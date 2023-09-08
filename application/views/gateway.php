<div class="row">
   <!--  table area --> 
   <div class="col-sm-12">
      <div class="panel panel-default thumbnail">
         <div class="col-md-12">
            <div class="panel-body">
               <div class="col-sm-12">
                  <button class="btn btn-sm btn-success" style="float: left" type="button" data-toggle="modal" data-target="#createnewintegration"><i class="fa fa-plus"></i> <?php echo display('add_new_integration');?></button>
               </div>
               <br><br>
               <table width="100%" class="datatable1 table table-striped table-bordered table-hover">
                  <thead>
                     <tr>
                        <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1">&nbsp; <?php echo display('serial') ?></th>
                        <th class="th1"><?php echo display('integration_name');?></th>
                        <th class="th1"><?php echo display('key_id');?></th>
                        <th class="th2"><?php echo display('key_secret');?></th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (!empty($gateway_list)) { ?>
                     <?php $sl = 1; ?>
                     <?php foreach ($gateway_list as $list) { ?>
                     <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="cursor:pointer;"  data-toggle="modal"data-target="#createnewintegration<?php echo $list->id;?>">
                        <td class="th0" onclick="event.stopPropagation();">&nbsp; <?php echo $sl;?></td>
                        <td class="th1"><?php echo $list->integration_name; ?></td>
                        <td class="th1"><?php echo $list->key_id; ?></td>
                        <td class="th2"><?php echo $list->key_secret; ?></td>
                        <td class="center">
                           <a href="<?php echo base_url('configurations/delete_gateway/'.$list->id); ?>" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
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
            <h4 class="modal-title">Payment Gateway</h4>
         </div>
         <div class="modal-body">
            <!--<form>-->
            <?php echo form_open_multipart('configurations/create_pay_gateway','class="form-inner"') ?>                      
            <div class="row">
               <div class="form-group   col-sm-6">
                  <label><?php echo display('integration_name');?>*</label>
                  <select class="form-control" name="integration_name">
                     <option value="payumoney">Payumoney</option>
                     <option value="razorpay">Razorpay</option>
                  </select> 
               </div>
               <div class="form-group   col-sm-6">
                  <label><?php echo display('key_id');?>*</label>
                  <input class="form-control" name="key_id" type="text"  required>
               </div>
               <div class="form-group col-sm-6">
                  <label><?php echo display('key_secret');?>*</label>
                  <input class="form-control" name="key_secret" type="text"  required> 
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