<script src="https://cdn.jsdelivr.net/jquery.query-builder/2.3.3/js/query-builder.standalone.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.query-builder/2.3.3/css/query-builder.default.min.css">
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("customer") ?>"> <i class="fa fa-list"></i>  <?php echo display('doctor_list') ?> </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
             
                    <div class="col-md-12 col-sm-12">
                        <?php $this->session->set_userdata('com_id',$doctor->user_id)?>
                        <?php echo form_open_multipart('customer/create','class="form-inner"') ?> 

                            <?php echo form_hidden('user_id',$doctor->user_id) ?>
							
							<div class="row">
								<div class="col-md-12">
									<ul class="nav nav-tabs">
									  <li class="active"><a data-toggle="tab" href="#prsnl-info"><?php echo display('personal_info'); ?></a></li>
									  <li ><a data-toggle="tab" href="#acnt-details"><?php echo display('account_details') ?> </a></li>
									  <li ><a data-toggle="tab" href="#comp-details"><?php echo display('add_companey_details') ?></a></li>
									  
                                      <li ><a data-toggle="tab" href="#cmp-right"><?php echo display('company_right'); ?> </a></li>
									  
                                      <li ><a data-toggle="tab" href="#cmp-custom_form"><?php echo display('custom_form_company'); ?> </a></li>
                                      <li class="tab_list" data-name="SMS" data-t="2" data-id="<?php echo base_url(); ?>api/whatsapp/get_comp_list" ><a data-toggle="tab" href="#cmp-transaction_detail"><?php echo display('sms_transaction_detail'); ?> </a></li>
                                      <li class="tab_list" data-name="Whatsapp" data-t="1"  data-id="<?php echo base_url(); ?>api/whatsapp/get_comp_list"><a data-toggle="tab" href="#cmp-transaction_detail"><?php echo display('whatapp_transaction_detail'); ?> </a></li>
                                      <li class="tab_list" data-name="Email" data-t="3"  data-id="<?php echo base_url(); ?>api/whatsapp/get_comp_list"><a data-toggle="tab" href="#cmp-transaction_detail"><?php echo display('email_transaction_detail'); ?> </a></li>
                                      <li class="tab_list" data-name="Telephonic" data-t="4" data-id="<?php echo base_url(); ?>api/whatsapp/get_comp_list"><a data-toggle="tab" href="#cmp-transaction_detail"><?php echo display('telephony_transaction_detail'); ?> </a></li>

									</ul>
								<div class="tab-content">
										<br />
									<div id="prsnl-info" class="tab-pane fade in active">
                                            <div class="form-group row">
                                                <label for="firstname" class="col-xs-3 col-form-label"><?php echo display('first_name')?> <i class="text-danger">*</i></label>
                                                <div class="col-xs-9">
                                                    <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name')?>" value="<?php echo $doctor->firstname ?>" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="lastname" class="col-xs-3 col-form-label"><?php echo display('last_name') ?> <i class="text-danger">*</i></label>
                                                <div class="col-xs-9">
                                                    <input name="lastname" type="text" class="form-control" id="lastname" placeholder="<?php echo display('last_name') ?>" value="<?php echo $doctor->lastname ?>" >
                                                </div>
                                            </div>

                                              <!-- display in edit mode -->
                                            <?php if (empty($doctor->user_id)) { ?>
                                            <div class="form-group row">
                                                <label for="email" class="col-xs-3 col-form-label"><?php echo display('email') ?> <i class="text-danger">*</i></label>
                                                <div class="col-xs-9">
                                                    <input name="email" class="form-control" type="text" placeholder="<?php echo display('email') ?>" id="email"  value="<?php echo $doctor->email ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-xs-3 col-form-label"><?php echo display('password') ?> <i class="text-danger">*</i></label>
                                                <div class="col-xs-9">
                                                    <input name="password" class="form-control" type="password" placeholder="<?php echo display('password') ?>" id="password" >
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <!-- ends of display edit mode-->
                

                                            <div class="form-group row">
                                                <label for="designation" class="col-xs-3 col-form-label"><?php echo display('designation') ?></label>
                                                <div class="col-xs-9">
                                                    <input name="designation" type="text" class="form-control" id="designation" placeholder="<?php echo display('designation') ?>" value="<?php echo $doctor->designation ?>" >
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="form-group row">
                                                <label for="address" class="col-xs-3 col-form-label"><?php echo display('address') ?> <i class="text-danger">*</i></label>
                                                <div class="col-xs-9">
                                                    <textarea name="address" class="form-control"  placeholder="<?php echo display('address') ?>" maxlength="140" rows="7" id="address"><?php echo $doctor->address ?></textarea>
                                                </div>
                                            </div> 

                                            <div class="form-group row">
                                                <label for="phone" class="col-xs-3 col-form-label"><?php echo display('phone') ?></label>
                                                <div class="col-xs-9">
                                                    <input name="phone" class="form-control" type="text" placeholder="<?php echo display('phone') ?>" id="phone" value="<?php echo $doctor->phone ?>" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="mobile" class="col-xs-3 col-form-label"><?php echo display('mobile') ?> <i class="text-danger">*</i></label>
                                                <div class="col-xs-9">
                                                    <input name="mobile" class="form-control" type="text" placeholder="<?php echo display('mobile') ?>" id="mobile" value="<?php echo $doctor->mobile ?>" >
                                                </div>
                                            </div>
                                            <!-- if representative picture is already uploaded -->
                                            <?php if(!empty($doctor->pictures)) {  ?>
                                            <div class="form-group row">
                                                <label for="picturePreview" class="col-xs-3 col-form-label"></label>
                                                <div class="col-xs-9">
                                                    <img src="<?php echo base_url($doctor->pictures) ?>" alt="Picture" class="img-thumbnail" />
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <div class="form-group row">
                                                <label for="picture" class="col-xs-3 col-form-label"><?php echo display('picture') ?></label>
                                                <div class="col-xs-9">
                                                    <input type="file" name="picture" id="picture" value="<?php echo $doctor->pictures ?>" class="form-control">
                                                    <input type="hidden" name="old_picture" value="<?php echo $doctor->pictures ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="date_of_birth" class="col-xs-3 col-form-label"><?php echo display('date_of_birth') ?></label>
                                                <div class="col-xs-9">
                                                    <input name="date_of_birth" class="datepicker form-control" type="date" placeholder="<?php echo display('date_of_birth') ?>" id="date_of_birth" value="<?php echo $doctor->date_of_birth ?>" >
                                                </div>
                                            </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3"><?php echo display('sex')?> <i class="text-danger">*</i></label>
                                                    <div class="col-xs-9">
                                                        <div class="form-check">
                                                            <label class="radio-inline">
                                                            <input type="radio" name="sex" value="Male" <?php echo  set_radio('sex', 'Male', TRUE); ?> ><?php echo display('male')?>
                                                            </label>
                                                            <label class="radio-inline">
                                                            <input type="radio" name="sex" value="Female" <?php echo  set_radio('sex', 'Female'); ?> ><?php echo display('female')?>
                                                            </label> 
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="blood_group" class="col-xs-3 col-form-label"><?php echo display('blood_group') ?></label>
                                                    <div class="col-xs-9"> 
                                                        <?php
                                                            $bloodList = array( 
                                                                ''   => display('select_option'),
                                                                'A+' => 'A+',
                                                                'A-' => 'A-',
                                                                'B+' => 'B+',
                                                                'B-' => 'B-',
                                                                'O+' => 'O+',
                                                                'O-' => 'O-',
                                                                'AB+' => 'AB+',
                                                                'AB-' => 'AB-'
                                                            );
                                                            echo form_dropdown('blood_group', $bloodList, $doctor->blood_group, 'class="form-control" id="blood_group" ');

                                                        ?>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="degree" class="col-xs-3 col-form-label"><?php echo display('education_degree') ?></label>
                                                    <div class="col-xs-9">
                                                        <textarea name="degree" class="tinymce form-control" placeholder="<?php echo display('education_degree') ?>" id="degree" maxlength="140" rows="7"><?php echo $doctor->degree ?></textarea>
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="short_biography" class="col-xs-3 col-form-label"><?php echo display('short_biography') ?></label>
                                                    <div class="col-xs-9">
                                                        <textarea name="short_biography" class="tinymce form-control" placeholder="Address" id="short_biography" maxlength="140" rows="7"><?php echo $doctor->short_biography ?></textarea>
                                                    </div>
                                                </div> 
                                                <div class="form-group row comp-status">
                                                    <label class="col-sm-3"><?php echo display('status') ?></label>
                                                    <div class="col-xs-9">
                                                        <div class="form-check">
                                                            <label class="radio-inline">
                                                            <input type="radio" name="status" value="1" <?php if(!empty($doctor) && $doctor->status)echo 'checked';?> ><?php echo display('active') ?>
                                                            </label>
                                                            <label class="radio-inline">
                                                            <input type="radio" name="status" value="0" <?php if(!empty($doctor) && $doctor->status==0)echo 'checked';?> ><?php echo display('inactive') ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-btns">
                                                    <div class="col-sm-offset-3 col-sm-6">
                                                        <div class="ui buttons">
                                                            <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                                            <div class="or"></div>
                                                            <button class="ui positive button"><?php echo display('save') ?></button>
                                                        </div>
                                                    </div>
                                                </div>

							        </div>

                                    <div id="acnt-details" class="tab-pane fade">
                                        <div class="form-group row">
                                            <label for="a_name" class="col-xs-3 col-form-label"><?php echo display('customer_account_name')?></label>
                                            <div class="col-xs-9">
                                                <input name="a_name" type="text" class="form-control" id="firstname" placeholder="<?php echo display('customer_account_name')?>" value="<?php echo $doctor->a_name ?>" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="a_account_number" class="col-xs-3 col-form-label"><?php echo display('customer_account_number')?></label>
                                            <div class="col-xs-9">
                                                <input name="a_account_number" type="text" class="form-control" id="firstname" placeholder="<?php echo display('customer_account_number')?>" value="<?php echo $doctor->a_account_number ?>" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="a_ifsc" class="col-xs-3 col-form-label"><?php echo display('customer_ifsc')?></label>
                                            <div class="col-xs-9">
                                                <input name="a_ifsc" type="text" class="form-control" id="firstname" placeholder="<?php echo display('customer_ifsc')?>" value="<?php echo $doctor->a_ifsc ?>" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="a_branch" class="col-xs-3 col-form-label"><?php echo display('customer_account_branch')?> </label>
                                            <div class="col-xs-9">
                                                <input name="a_branch" type="text" class="form-control" id="firstname" placeholder="<?php echo display('customer_account_branch')?>" value="<?php echo $doctor->a_branch ?>" >
                                            </div>
                                        </div>
                                    </div>
									<div id="comp-details" class="tab-pane fade">
											  
										 <div class="form-group row">
											<label for="a_companyname" class="col-xs-3 col-form-label"><?php echo display('customer_company_name')?></label>
											<div class="col-xs-9">
												<input name="a_companyname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('customer_company_name')?>" value="<?php echo $doctor->a_companyname ?>" >
											</div>
										</div>
										<div class="form-group row">
											<label for="a_companyaddress" class="col-xs-3 col-form-label"><?php echo display('Company_address')?> </label>
											<div class="col-xs-9">
												<textarea name="a_companyaddress" class="form-control"  placeholder="<?php echo display('Company_address') ?>" maxlength="140" rows="7" id="address2"><?php echo $doctor->a_companyaddress ?></textarea>
										   </div>
										</div>
                                        <div class="form-group row">
                                            <label for="a_companyaddress" class="col-xs-3 col-form-label">Account Type </label>
                                            <div class="col-xs-9">
                                                <select name="a_accounttype" class="form-control">
                                                    <option value="1" <?php if($doctor->account_type == 1){ echo "selected"; } ?> >Live</option>
                                                    <option value="2" <?php if($doctor->account_type == 2){ echo "selected"; } ?> >Trial</option>
                                                </select>
                                           </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="a_companyaddress" class="col-xs-3 col-form-label">Valid Upto : </label>
                                            <div class="col-xs-9">
                                                <input name="a_validupto" type="date" value="<?=date('Y-m-d', strtotime($doctor->valid_upto));?>" class="form-control"  placeholder="Valid Upto"  id="validupto"/>
                                           </div>
                                        </div>
									</div>
									  
									  <div id="cmp-right"  class="tab-pane fade">
											<div class="row">
                                                <?php
                                                echo $user_right_content;
                                                ?>
												<div class="col-md-12">
													<h4>Company Right</h4>
												</div>
											</div>
                                      </div>

                                      

                                   


                                    
                                    
                                    

                                    
                                    <div id="cmp-transaction_detail" class="tab-pane fade">
                                       
                                       <button type="button" class="btn btn-primary "  data-toggle="modal" data-target="#transaction-model">Add Transaction</button>
                                       



                                       <table class="table table-bordered table-hover mobile-optimised" style="width:100%;">
                                           <caption class="text-center" id="sms_heading"></caption>
                                           <thead>
                                               <tr>
                                               <th>S.NO</th>
                                               <th>Qty</th>
                                               <th>Price/Qty</th>
                                               <th>Amount</th>
                                               <th>Expiry Date</th>
                                               <th>Added Date</th>
                                                   <th>Added By </th>
                                               </tr>
                                           </thead>
                                           <tbody id="tBody">

                                           </tbody>
                                       </table>
                                       
                                   </div>


                                    <!-- <div id="cmp-sms_detail" class="tab-pane fade">
                                       
                                        <button type="button" class="btn btn-primary " onclick="transactionForm('1','SMS')" data-toggle="modal" data-target="#transaction-model">Add Transaction</button>
                                        



                                        <table class="table table-bordered table-hover mobile-optimised" style="width:100%;">
                                            <caption class="text-center" id="sms_heading"></caption>
                                            <thead>
                                                <tr>
                                                <th>S.NO</th>
                                                <th>Qty</th>
                                                <th>Price/Qty</th>
                                                <th>Amount</th>
                                                <th>Expiry Date</th>
                                                <th>Added Date</th>
                                                    <th>Added By </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tsms">

                                            </tbody>
                                        </table>
                                        
                                    </div>
                                    <div id="cmp-email_detail" class="tab-pane fade">
                                       
                                        <button type="button" class="btn btn-primary " onclick="transactionForm('2','Email')" data-toggle="modal" data-target="#transaction-model">Add Transaction</button>
                                        



                                        <table class="table table-bordered table-hover mobile-optimised" style="width:100%;">
                                            <caption class="text-center" id="sms_heading"></caption>
                                            <thead>
                                                <tr>
                                                <th>S.NO</th>
                                                <th>Qty</th>
                                                <th>Price/Qty</th>
                                                <th>Amount</th>
                                                <th>Expiry Date</th>
                                                <th>Added Date</th>
                                                    <th>Added By </th>
                                                </tr>
                                            </thead>
                                            <tbody id="temail">

                                            </tbody>
                                        </table>
                                        
                                    </div>
                                    <div id="cmp-whatsapp_detail" onclick="transactionForm('3','Whatsapp')" class="tab-pane fade">
                                       
                                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#transaction-model">Add Transaction</button>
                                        



                                        <table class="table table-bordered table-hover mobile-optimised" style="width:100%;">
                                            <caption class="text-center" id="sms_heading"></caption>
                                            <thead>
                                                <tr>
                                                <th>S.NO</th>
                                                <th>Qty</th>
                                                <th>Price/Qty</th>
                                                <th>Amount</th>
                                                <th>Expiry Date</th>
                                                <th>Added Date</th>
                                                    <th>Added By </th>
                                                </tr>
                                            </thead>
                                            <tbody id="twhatsapp">

                                            </tbody>
                                        </table>
                                        
                                    </div>
                                    <div id="cmp-telephony_detail" onclick="transactionForm('4','Telephonic')" class="tab-pane fade">
                                       
                                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#transaction-model">Add Transaction</button>
                                        



                                        <table class="table table-bordered table-hover mobile-optimised" style="width:100%;">
                                            <caption class="text-center" id="sms_heading"></caption>
                                            <thead>
                                                <tr>
                                                <th>S.NO</th>
                                                <th>Qty</th>
                                                <th>Price/Qty</th>
                                                <th>Amount</th>
                                                <th>Expiry Date</th>
                                                <th>Added Date</th>
                                                    <th>Added By </th>
                                                </tr>
                                            </thead>
                                            <tbody id="ttelephony">

                                            </tbody>
                                        </table>
                                        
                                    </div> -->



                                      <div id="cmp-custom_form" class="tab-pane fade">
                                            <div class="row">
                                                
                                            </div>
                                      </div>
                                      

									</div>
								</div>
							</div>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="transaction-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" id="trans-form">
            <input type="hidden" name="comp_admin_id"  value="<?=$doctor->user_id ?>"/>
            <input type="hidden" name="comp_id"  value="<?=$doctor->user_id ?>"/>
            <input type="hidden" name="trans_type" id="transaction-type"  value=""/>
            <div class="modal-header">
                <h5 class="modal-title" id="transaction-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                
              
               
                    <div class="form-group row">
                        <label for="trans_qty" class="col-xs-3 col-form-label">Quantity</label>
                        <div class="col-xs-9">
                            <input name="qty" required type="text" class="form-control" id="trans_qty" placeholder="Enter Quantity" value="" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="trans_price" class="col-xs-3 col-form-label">Price</label>
                        <div class="col-xs-9">
                            <input name="price" required type="text" class="form-control" id="trans_price" placeholder="Enter Price" value="" >
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="trans_total_amt" class="col-xs-3 col-form-label">Total Amount</label>
                        <div class="col-xs-9">
                            <input name="total_amt" required type="text" class="form-control" id="trans_total_amt" placeholder="Enter Total Amount" value="" >
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="expiry_date" class="col-xs-3 col-form-label"><?php echo display('expiry_date')?> : </label>
                        <div class="col-xs-9">
                            <input name="expiry_date" required type="date" value="" class="form-control"  placeholder="Expiry Date"  id="validupto"/>
                        </div>
                    </div>				
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-trans" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript"> 
    $(function(){
        url = "<?=base_url().'form/form/enquiry_extra_field/'?>"+"<?=$doctor->user_id?>";     
        $.ajax({
          type: "POST",
          url: url,      
          success: function(data){                
            $("#cmp-custom_form").html(data);
          }
        });
    }); 

  
    $(function(){
         $(".tab_list").click(function(){
          var type = $(this).attr("data-t");
          var url = $(this).attr("data-id");
          var name = $(this).attr("data-name");
          console.log(type)
          $('#transaction-title').html(name+" Transaction")
          $('#transaction-type').val(type)
          $.ajax({
			type: 'POST',
			url: url,
			data:{"type":type,"comp_id":"<?=$doctor->user_id?>"},
			success: function(data){
			           
				       let trHTML = ''
                        $.each(data.message, function (i, userData) {
                            trHTML +=`
                                    <tr>
                                        <td>${i+1}</td>
                                        <td>${userData.qty}</td>
                                        <td>${userData.price}</td>
                                        <td>${userData.total_amt}</td>
                                        <td>${userData.expiry_date}</td>
                                        <td>${userData.created_date}</td>
                                        <td>${userData.created_by_name}</td>
                                    </tr>
                                    `
						
                            
                        });
                        $('#tBody').html(trHTML);
			}
			});
		 
       });
    })

    $("#trans-form").submit(function(event){
        event.preventDefault()
        let data =  $(this).serialize()
        url = "<?=base_url().'api/SweTransaction/add'?>";     
        $.ajax({
            type: "POST",
            data:data,
            url: url,      
            success: function(data){   
                if(data.status){
                    $('#close-trans').click()
                    
                }             
                
            }
        });
    });
  
//    function transactionForm(type,name){
    
//    }

</script>