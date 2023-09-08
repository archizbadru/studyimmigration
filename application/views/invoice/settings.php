<link rel="stylesheet" type="text/css" href=" https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
      <div  class="panel panel-default thumbnail">         
         <div class="panel-body panel-form">
            <div class="row">               
               <div class="col-md-12">
                  <ul class="nav nav-tabs nav-justified nav-pills">
                     <li class="active">
                        <a data-toggle="tab" href="#invoice_settings" ><?=display('invoice_settings')?></a>
                     </li>

                     <li>
                        <a data-toggle="tab" href="#invoice_advance_setting"><?php echo display('invoice_advance_setting') ?></a>
                     </li>

                     <li>
                        <a data-toggle="tab" href="#invoice_seller_buyer"><?php echo display('invoice_seller_buyer_setting') ?></a>
                     </li>

                     <li>
                        <a data-toggle="tab" href="#invoice_content_block"><?php echo display('invoice_content_block_setting') ?></a>
                     </li>

                     <li>
                        <a data-toggle="tab" href="#invoice_payment_setting"><?php echo display('invoice_payment_setting') ?></a>
                     </li>                  
                  </ul>

                 <div class="tab-content">
                  <br/>                     
                   <div id="invoice_settings" class="tab-pane fade in active">
                      <div class="row">
                         <div class="col-md-offset-1 col-md-10">
                            <form action="<?=base_url().'invoice/invoice/save_general_setting'?>" method="post" id="general_setting_form">
                            <div class="panel panel-primary">
                               <div class="panel-heading">
                                  <h3 class="panel-title">General Settings</h3>
                               </div>
                               <div class="panel-body">
                                  <div class="row">
                                     <div class="form-group col-md-3">
                                        <label for="prefix" >Prefix </label>
                                        <input type="text" id="prefix" class="form-control br_25  m-0 icon_left_input" name="prefix" placeholder="invoice prefix" required value="<?=get_sys_parameter('invoice_id_prefix','INVOICE_SETTINGS')?>">
                                     </div>
                                     <div class="form-group col-md-3">
                                        <label for="suffix" >Suffix </label>
                                        <input type="text" id="suffix" class="form-control br_25  m-0 icon_left_input" name="suffix" placeholder="invoice suffix" value="<?=get_sys_parameter('invoice_id_suffix','INVOICE_SETTINGS')?>">
                                     </div>
                                     
                                     <div class="form-group col-md-3">
                                        <label for="nxt_number" >Next Number  <i class="text-danger">*</i></label>
                                        <input type="number" id="nxt_number" class="form-control br_25  m-0 icon_left_input" name="nxt_number" required value="<?=get_sys_parameter('invoice_nxt_number','INVOICE_SETTINGS')?>">
                                     </div>

                                     <div class="form-group col-md-3">
                                        <?php
                                        $currency = get_sys_parameter('invoice_currency','INVOICE_SETTINGS');
                                        ?>
                                        <label for="currency"> Currency <i class="text-danger">*</i></label>
                                        <select id="currency" class="form-control" name="currency" required>
                                           <option value="inr" <?=($currency=='inr')?'selected':''?>>Indian rupee</option>
                                           <option value="usd" <?=($currency=='usd')?'selected':''?>>American Dollar</option>
                                        </select>
                                     </div>

                                  </div>
                                  <div class="row">
                                    <?php
                                        $invoice_allowed_download = get_sys_parameter('invoice_allowed_download','INVOICE_SETTINGS');
                                    ?>
                                     <div class="form-group col-md-4">
                                        <label for="currency"> Allow Download </label>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <div class="pretty p-default">
                                           <input type="checkbox" name="allow_download" value="1" <?=($invoice_allowed_download==1)?'checked':''?>/>
                                           <div class="state p-success">
                                              <label></label>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="row">
                                    <?php
                                        $customer_invoice_email = get_sys_parameter('invoice_customer_email','INVOICE_SETTINGS');
                                    ?>
                                     <div class="form-group col-md-4">
                                        <label for="currency"> Trigger Customer Invoice emails </label>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <div class="pretty p-default">
                                           <input type="checkbox" name="customer_invoice_email" value="1" <?=($customer_invoice_email==1)?'checked':''?>/>
                                           <div class="state p-success">
                                              <label></label>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class="panel-footer">
                                  <div class="form-group text-center">
                                     <button type="submit" id="submit_btn" class="btn btn-primary">Save</button>
                                  </div>
                               </div>
                            </div>
                        </form>
                         </div>
                      </div>                  
                   </div>
                   <div id="invoice_advance_setting" class="tab-pane fade">
                      <div class="row">
                         <div class="col-md-offset-1 col-md-10">
                            <div class="panel panel-primary">
                               <div class="panel-heading">
                                  <h3 class="panel-title">Advanced Settings</h3>
                               </div>
                               <div class="panel-body">
                                  <div class="row">
                                     <div class="form-group col-md-4">
                                        <label for="currency"> Display product ID/SKU <i class="text-danger">*</i></label>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <select id="currency" class="form-control" name="currency" required>
                                           <option value="0">Do not display</option>
                                           <option value="1">Display product ID (WP post ID)</option>
                                           <option value="2">Display SKU</option>
                                        </select>
                                     </div>
                                  </div>
                                  <div class="row">
                                     <div class="form-group col-md-4">
                                        <label for="currency"> Display product category <i class="text-danger">*</i></label>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <div class="pretty p-default">
                                           <input type="checkbox" />
                                           <div class="state p-success">
                                              <label></label>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="row">
                                     <div class="form-group col-md-4">
                                        <label for="currency"> Display short description <i class="text-danger">*</i></label>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <div class="pretty p-default">
                                           <input type="checkbox" />
                                           <div class="state p-success">
                                              <label></label>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="row">
                                     <div class="form-group col-md-4">
                                        <label for="currency"> Display currency symbol <i class="text-danger">*</i></label>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <div class="pretty p-default">
                                           <input type="checkbox" />
                                           <div class="state p-success">
                                              <label></label>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="row">
                                     <div class="form-group col-md-4">
                                        <label for="currency"> Display amount in words <i class="text-danger">*</i></label>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <div class="pretty p-default">
                                           <input type="checkbox" />
                                           <div class="state p-success">
                                              <label></label>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class="panel-footer">
                                  <div class="form-group text-center">
                                     <button type="submit" id="submit_btn" class="btn btn-primary">Save</button>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div id="invoice_seller_buyer" class="tab-pane fade">
                      <div class="row">
                         <div class="col-md-offset-1 col-md-10">
                            <div class="panel panel-primary">
                               <div class="panel-heading">
                                  <h3 class="panel-title">Seller Block</h3>
                               </div>
                               <div class="panel-body">
                                  <div class="row">
                                     <div class="form-group col-md-3">
                                        <label for="prefix" >Logo image  <i class="text-danger">*</i></label>
                                        <input type="file" id="logo" class="form-control br_25  m-0 icon_left_input" name="logo" placeholder="" required>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <label for="prefix" >Logo resize factor (in percent) <i class="text-danger">*</i></label>
                                        <input type="text" id="resize" class="form-control br_25  m-0 icon_left_input" name="resize" placeholder="Resize factor" required>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <label for="nxt_number" >Block title  <i class="text-danger">*</i></label>
                                        <input type="text" id="title" class="form-control br_25  m-0 icon_left_input" name="title" required>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <label for="nxt_number" >Company name  <i class="text-danger">*</i></label>
                                        <input type="text" id="company" class="form-control br_25  m-0 icon_left_input" name="company" required>
                                     </div>
                                  </div>
                                  <div class="row">
                                     <div class="form-group col-md-4">
                                        <label for="currency">Company details <i class="text-danger">*</i></label>
                                     </div>
                                     <div class="form-group col-md-3">  
                                        <textarea id="woo_pdf_seller_content" name="detail" class="form-control"    style="width: 450px;height:150px;">
                                        </textarea>
                                     </div>
                                  </div>
                                  <div class="panel panel-primary">
                                     <div class="panel-heading">
                                        <h3 class="panel-title">Buyer Block</h3>
                                     </div>
                                  </div>
                                  <div class="row">
                                     <div class="form-group col-md-4">
                                        <label for="currency"> Block title <i class="text-danger">*</i></label>
                                     </div>
                                     <div class="form-group col-md-3">  
                                        <input type="text" id="resize" class="form-control br_25  m-0 icon_left_input" name="resize" placeholder="Block title" required>
                                     </div>
                                  </div>
                                  <div class="row">
                                     <div class="form-group col-md-4">
                                        <label for="currency">Buyer details layout <i class="text-danger">*</i></label>
                                     </div>
                                     <div class="form-group col-md-3">  
                                        <textarea id="woo_pdf_seller_content" name="detail" class="form-control"    style="width: 450px;height:150px;">
                                        </textarea>
                                     </div>
                                  </div>
                                  <div class="row">
                                     <div class="form-group col-md-4">
                                        <label for="currency">Remove lines with empty values <i class="text-danger">*</i></label>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <div class="pretty p-default">
                                           <input type="checkbox" />
                                           <div class="state p-success">
                                              <label></label>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class="panel-footer">
                                  <div class="form-group text-center">
                                     <button type="submit" id="submit_btn" class="btn btn-primary">Save</button>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div id="invoice_content_block" class="tab-pane fade">
                      <div class="row">
                         <div class="col-md-offset-1 col-md-10">
                            <div class="panel panel-primary">
                               <div class="panel-heading">
                                  <h3 class="panel-title">Invoice Details</h3>
                               </div>
                               <div class="panel-body">
                                  <div class="row">
                                     <div class="form-group col-md-4">
                                        <label for="currency">Block layout <i class="text-danger">*</i></label>
                                     </div>
                                     <div class="form-group col-md-3">  
                                        <textarea id="woo_pdf_seller_content" name="layout" class="form-control"    style="width: 450px;height:150px;">
                                        </textarea>
                                     </div>
                                  </div>
                                  <div class="row">
                                     <div class="form-group col-md-4">
                                        <label for="currency">Remove lines with empty values <i class="text-danger">*</i></label>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <div class="pretty p-default">
                                           <input type="checkbox" />
                                           <div class="state p-success">
                                              <label></label>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class="panel-footer">
                                  <div class="form-group text-center">
                                     <button type="submit" id="submit_btn" class="btn btn-primary">Save</button>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div id="invoice_payment_setting" class="tab-pane fade">
                      sdf
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $("#general_setting_form").on('submit',function(e){
        e.preventDefault();
        form = $(this);
        var url = form.attr('action');
        $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {               
            data = JSON.parse(data);
            Swal.fire("Good job!", data.msg, "success");
           }
         });
    });
</script>