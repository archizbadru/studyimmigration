 <style>
 .line_break {
    width:1000px;
    height: 5px;
    float: left;
    color: black;
    padding-top: 3px;
    background-color: rgba(255,255,255,.5);
}
</style>
    <div class="tab-pane <?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='payment'){ echo 'active';}};?>" id="payment">
      <div class="content-panel">
 <hr>
 <div class="table-responsive" style="overflow-y: scroll;">

<table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">S.No</th>
      <th class="th-sm">Action</th>
      <th class="th-sm">Invoice</th>
    <th class="th-sm">Reg. fees</th>
    <th class="th-sm">Reg. Tax</th>
    <th class="th-sm">Reg. Total</th>
      <th class="th-sm">App. fees</th>
      <th class="th-sm">App. Tax</th>
      <th class="th-sm">App. Total</th>
      <th class="th-sm">Family Fee</th>
    <th class="th-sm">Family Tax</th>
    <th class="th-sm">Family Total</th>
      <th class="th-sm">Lawyer Fee</th>
    <th class="th-sm">Lawyer Tax</th>
    <th class="th-sm">Lawyer Total</th>
      <th class="th-sm">Consultancy Fee</th>
    <th class="th-sm">Consultancy Tax</th>
    <th class="th-sm">Consultancy Total</th>
    <th class="th-sm">Stamp Fee</th>
    <th class="th-sm">Stamp Tax</th>
    <th class="th-sm">Stamp Total</th>
    <th class="th-sm">Total Fee</th>
      <th class="th-sm">Total Amount(tax)</th>
    <th class="th-sm">Advance</th>
    <th class="th-sm">Payment Mode</th>
    <th class="th-sm">Paid Amount</th>
    <th class="th-sm">Paid Date</th>
    <th class="th-sm">Remark</th>
    </tr>
  </thead>
  <tbody>
 <?php if(!empty($fee_list)){ ?>
 <?php $i=1; foreach($fee_list as $value){ ?>
    <tr>
    <td><?php echo '1'; ?></td>
    <td>
      <?php if((empty($value->status)) && (!in_array($this->session->userdata('user_right'), applicant))){ ?>

        <a href="#modaleditp<?= $i?>" class="titlehover" data-toggle="modal" data-title="Upadate" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<?php if(user_access('730')===true){ ?>
         <a href="#modal9p<?= $i?>" class="titlehover" data-toggle="modal" data-title="Unsettled" data-animation="effect-scale"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>

         <?php if(empty($ins_list)){ if($value->link_status==''){ ?>
         <a href="<?php echo base_url('payment/payment_link_send/'.$value->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1).'/'.'s')?>" class="titlehover" data-title="Send Link"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></a>
        <?php }else{ ?>
         <a href="<?php echo base_url('payment/payment_link_send/'.$value->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1).'/'.'s')?>" class="titlehover" data-title="Resend Link"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:red;"></i></a>
       <?php }} ?>
       <?php } ?>
        <?php }else if((empty($value->status)) && (in_array($this->session->userdata('user_right'), applicant))){ ?>
         <span class="label label-warning">Unsetteld</span>
         <?php if(empty($ins_list)){ if($value->link_status=='0'){ ?>
         <a href="<?php echo base_url('payment/pay_method/'.$value->id.'/'.$this->session->integration_name.'/'.base64_encode($value->taxabal_amt).'/'.'s');?>" class="label label-danger">Click For Pay</a>
        <?php }else if($value->link_status=='1'){ ?>
         <span class="label label-info">Paid</span>
       <?php }} ?> 
        <?php }else{ ?>
       <span class="titlehover" data-title="settled"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>
     <a href="#modal10p<?= $i?>" class="titlehover" data-title="Details" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
    <?php } ?>     
      </td>
  <td> <?php if(!empty($value->onetime_invoice)){ ?> <a href="<?php if(!empty($value->onetime_invoice)){ echo 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/God Speed/'.$value->onetime_invoice;} ?>" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a> <?php } ?> </td>

  <td><?php if(!empty($value->reg_fee)){ echo $value->reg_fee;} ?></td>
  <td><?php if(!empty($value->tax_value_reg)){ echo $value->tax_value_reg;} ?></td>
  <td><?php if(!empty($value->total_reg)){ echo $value->total_reg;} ?></td>

  <td><?php if(!empty($value->app_fee)){ echo $value->app_fee;} ?></td>
  <td><?php if(!empty($value->tax_value_app)){ echo $value->tax_value_app;} ?></td>
  <td><?php if(!empty($value->total_app)){ echo $value->total_app;} ?></td>

  <td><?php if(!empty($value->family_fee)){ echo $value->family_fee;} ?></td>
  <td><?php if(!empty($value->tax_value_family)){ echo $value->tax_value_family;} ?></td>
  <td><?php if(!empty($value->total_family)){ echo $value->total_family;} ?></td>
  <td><?php if(!empty($value->lawyer_fee)){ echo $value->lawyer_fee;} ?></td>
  <td><?php if(!empty($value->tax_value_lawyer)){ echo $value->tax_value_lawyer;} ?></td>
  <td><?php if(!empty($value->total_lawyer)){ echo $value->total_lawyer;} ?></td>
    <td><?php if(!empty($value->consultancy_fee)){ echo $value->consultancy_fee;} ?></td>
  <td><?php if(!empty($value->tax_value_consultancy)){ echo $value->tax_value_consultancy;} ?></td>
  <td><?php if(!empty($value->total_consultancy)){ echo $value->total_consultancy;} ?></td>
  <td><?php if(!empty($value->stamp)){ echo $value->stamp;} ?></td>
  <td><?php if(!empty($value->tax_value_stamp)){ echo $value->tax_value_stamp;} ?></td>
  <td><?php if(!empty($value->total_stamp)){ echo $value->total_stamp;} ?></td>
  <td><?php if(!empty($value->notax_amt)){ echo $value->notax_amt;} ?></td>
    <td><?php if(!empty($value->taxabal_amt)){ echo $value->taxabal_amt;} ?></td>
  <td><?php if(!empty($value->advance)){ echo $value->advance;} ?></td>
  <td><?php if(!empty($value->onetime_mode)){ if($value->onetime_mode=='1'){ echo 'Cash';}else if($value->onetime_mode=='2'){ echo 'Card';}else if($value->onetime_mode=='3'){ echo 'Cheque';}else if($value->onetime_mode=='4'){ echo 'D-Draft';}else if($value->onetime_mode=='5'){ echo 'Online (Payment Link)';}}; ?></td>
  <td><?php if(!empty($value->onetime_pay_amt)){ echo $value->onetime_pay_amt;} ?></td>
  <td><?php if(!empty($value->onetime_pay_date)){ echo $value->onetime_pay_date;} ?></td>
    <td><?php if(!empty($value->p_remark)){ echo $value->p_remark;} ?></td>
    </tr>

<!--------------------------------Modal Popup for Update One time Payment-------------------------------------------------->
                      
      <div class="modal fade" id="modaleditp<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6p" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <?php
              echo form_open('client/update_payment_onetime/'.$this->uri->segment(3).'/'.$this->uri->segment(1),array('class'=>"",'name'=>'paymentform','enctype'=>'multipart/form-data'));
            ?>
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6p">Update Payment</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <input type="hidden" class="form-control" name="pay_id" value="<?= $value->id; ?>">

          <div class="col-md-4">
              <label>Registration Fee<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="regedit" name="reg_fee" value="<?= $value->reg_fee; ?>" placeholder="Registration Fee">
          </div>

          <!--<div class="col-md-4">
              <label>Registration Tax<i class="text-danger"></i></label>
              <input type="text" class="form-control" name="reg_tax" value="<?= $value->tax_value_reg; ?>" placeholder="Registration Tax">
          </div>-->
          <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                  <select name="reg_tax" class="form-control" onchange="calculateAmountedit(this.value,'reg')">
                    <option value="" disabled selected>Choose here</option>
                    <?php foreach($all_gst as $glist){ ?>
                    <option value="<?php echo $glist->gst_value; ?>" <?php if($value->tax_value_reg==$glist->gst_value){ echo 'selected';} ?>><?php echo $glist->gst_name; ?></option>
                    <?php } ?>   
                  </select>
          </div>

          <div class="col-md-4">
              <label>Registration Amt<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="tregedit" name="reg_amt" value="<?= $value->total_reg; ?>">
          </div>


          <div class="col-md-4">
              <label>Application Fee<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="appedit" name="app_fee" value="<?= $value->app_fee; ?>" placeholder="Application Fee">
          </div>

          <!--<div class="col-md-4">
              <label>Application Tax<i class="text-danger"></i></label>
              <input type="text" class="form-control" name="app_tax" value="<?= $value->tax_value_app; ?>" placeholder="Application Tax">
          </div>-->
          <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                  <select name="app_tax" class="form-control" onchange="calculateAmountedit(this.value,'app')">
                    <option value="" disabled selected>Choose here</option>
                    <?php foreach($all_gst as $glist){ ?>
                    <option value="<?php echo $glist->gst_value; ?>" <?php if($value->tax_value_app==$glist->gst_value){ echo 'selected';} ?>><?php echo $glist->gst_name; ?></option>
                    <?php } ?>   
                  </select>
          </div>

          <div class="col-md-4">
              <label>Application Amt<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="tappedit" name="app_amt" value="<?= $value->total_app; ?>">
          </div>


          <div class="col-md-4">
              <label>Family Fee<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="familyedit" name="family_fee" value="<?= $value->family_fee; ?>">
          </div>

          <!--<div class="col-md-4">
              <label>Family Tax<i class="text-danger"></i></label>
              <input type="text" class="form-control" name="family_tax" value="<?= $value->tax_value_family; ?>">
          </div>-->
          <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                  <select name="family_tax" class="form-control" onchange="calculateAmountedit(this.value,'family')">
                    <option value="" disabled selected>Choose here</option>
                    <?php foreach($all_gst as $glist){ ?>
                    <option value="<?php echo $glist->gst_value; ?>" <?php if($value->tax_value_family==$glist->gst_value){ echo 'selected';} ?>><?php echo $glist->gst_name; ?></option>
                    <?php } ?>   
                  </select>
          </div>

          <div class="col-md-4">
              <label>Family Amt<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="tfamilyedit" name="family_amt" value="<?= $value->total_family; ?>">
          </div>


          <div class="col-md-4">
              <label>Lawyer Fee<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="lawyeredit" name="lawyer_fee" value="<?= $value->lawyer_fee; ?>">
          </div>

          <!--<div class="col-md-4">
              <label>Lawyer Tax<i class="text-danger"></i></label>
              <input type="text" class="form-control" name="lawyer_tax" value="<?= $value->tax_value_lawyer; ?>">
          </div>-->
          <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                  <select name="lawyer_tax" class="form-control" onchange="calculateAmountedit(this.value,'lawyer')">
                    <option value="" disabled selected>Choose here</option>
                    <?php foreach($all_gst as $glist){ ?>
                    <option value="<?php echo $glist->gst_value; ?>" <?php if($value->tax_value_lawyer==$glist->gst_value){ echo 'selected';} ?>><?php echo $glist->gst_name; ?></option>
                    <?php } ?>   
                  </select>
          </div>

          <div class="col-md-4">
              <label>Lawyer Amt<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="tlawyeredit" name="lawyer_amt" value="<?= $value->total_lawyer; ?>">
          </div>


          <div class="col-md-4">
              <label>Consultancy Fee<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="consultancyedit" name="consultancy_fee" value="<?= $value->consultancy_fee; ?>">
          </div>

          <!--<div class="col-md-4">
              <label>Consultancy Tax<i class="text-danger"></i></label>
              <input type="text" class="form-control" name="consultancy_tax" value="<?= $value->tax_value_consultancy; ?>">
          </div>-->
          <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                  <select name="consultancy_tax" class="form-control" onchange="calculateAmountedit(this.value,'consultancy')">
                    <option value="" disabled selected>Choose here</option>
                    <?php foreach($all_gst as $glist){ ?>
                    <option value="<?php echo $glist->gst_value; ?>" <?php if($value->tax_value_consultancy==$glist->gst_value){ echo 'selected';} ?>><?php echo $glist->gst_name; ?></option>
                    <?php } ?>   
                  </select>
          </div>

          <div class="col-md-4">
              <label>Consultancy Amt<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="tconsultancyedit" name="consultancy_amt" value="<?= $value->total_consultancy; ?>">
          </div>


          <div class="col-md-4">
              <label>Stamp Paper Fee<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="stampedit" name="stamp_fee" value="<?= $value->stamp; ?>">
          </div>

          <!--<div class="col-md-4">
              <label>Stamp Paper Tax<i class="text-danger"></i></label>
              <input type="text" class="form-control" name="stamp_tax" value="<?= $value->tax_value_stamp; ?>">
          </div>-->
          <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                  <select name="stamp_tax" class="form-control" onchange="calculateAmountedit(this.value,'stamp')">
                    <option value="" disabled selected>Choose here</option>
                    <?php foreach($all_gst as $glist){ ?>
                    <option value="<?php echo $glist->gst_value; ?>" <?php if($value->tax_value_stamp==$glist->gst_value){ echo 'selected';} ?>><?php echo $glist->gst_name; ?></option>
                    <?php } ?>   
                  </select>
          </div>

          <div class="col-md-4">
              <label>Stamp Paper Amt<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="tstampedit" name="stamp_amt" value="<?= $value->total_stamp; ?>">
          </div>

          <div class="col-md-2" style="padding-top: 20px;">
                   <button type="button" class="btn btn-info" onclick="calculateTotaledit();"><i class="fa fa-calculator" aria-hidden="true"></i></button>
                </div>


          <div class="col-md-5">
              <label>Total without(Tax)<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="notax_amtedit" name="t_no_tax" value="<?= $value->notax_amt; ?>">
          </div>

          <div class="col-md-5">
              <label>Total with(Tax)<i class="text-danger"></i></label>
              <input type="text" class="form-control" id="taxabal_amtedit" name="t_with_tax" value="<?= $value->taxabal_amt; ?>">
          </div>

          <div class="col-md-4">
              <label>Advance<i class="text-danger"></i></label>
              <input type="text" class="form-control" name="advance" value="<?= $value->advance; ?>">
          </div>

          <!-- <div class="col-md-4">
              <label>Payment Type<i class="text-danger"></i></label>
              <input type="text" class="form-control" name="pay_type" value="<?= $value->advance; ?>">
          </div>

          <div class="col-md-4">
              <label>Payment Mode<i class="text-danger"></i></label>
              <input type="text" class="form-control" name="pay_mode" value="<?= $value->typepay; ?>">
          </div> -->

          <div class="col-md-4">
              <label>Pay Amount<i class="text-danger"></i></label>
              <input type="text" class="form-control" name="pay_amt" value="<?= $value->onetime_pay_amt; ?>">
          </div>

          <div class="col-md-4">
              <label>Pay Date<i class="text-danger"></i></label>
              <input type="date" class="form-control" name="pay_date" value="<?= $value->onetime_pay_date; ?>">
          </div>

          <div class="form-group col-md-5">
              <label>Attach Invoice</label>
              <input type="file" class="form-control" name="onetime_invoice" placeholder="Invoice">
          </div>
<?php if(!empty($value->onetime_invoice)){ ?>
          <div class="form-group col-md-1">
              <label>.</label>
              <a href="<?php if(!empty($value->onetime_invoice)){ echo 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/God Speed/'.$value->onetime_invoice;} ?>" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a>
          </div>
<?php } ?>
          <div class="col-md-6">
              <label>Remark<i class="text-danger"></i></label>
              <textarea type="text" class="form-control" name="remark" value="<?= $value->p_remark; ?>"><?= $value->p_remark; ?></textarea>
          </div>
                        
          </div>
          <div class="modal-footer" style="border-top: none;">
            <div class="col-md-12">
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary tx-13">Save</button>
            </div>
          </div>
        </div>
        <?php echo form_close()?>
      </div>
    </div>
<!---------------------------END------------------------->
  
  <!-----------------------Modal Popup for Setteled One time Payment------------------------->
                      
      <div class="modal fade" id="modal9p<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6p" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <?php
              echo form_open('client/update_setlled_onetime/'.$this->uri->segment(3).'/'.$this->uri->segment(1),array('class'=>"",'name'=>'paymentform'));
            ?>
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6p">Update Payment</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
      <input type="hidden" class="form-control" name="pay_id" value="<?= $value->id; ?>">
      <?php if(!empty($value->advance)){ $adv=$value->advance;}else{$adv='0';} ?>
      <input type="hidden" class="form-control" name="t_amt" id="t_amt<?= $i; ?>" value="<?= $value->taxabal_amt-$adv; ?>"> 
            <label>Payment Mode<i class="text-danger"></i></label>
            <select class="form-control"  name="onetime_mode" onchange="showDivs(this)"> 
                <option value = "">Select Type</option>
                <option value = "1">Cash</option>
                <option value = "2">Card</option>
          <option value = "3">cheque</option>
        <option value = "4">D-Draft</option>
        <option value = "5">Online (Payment Link)</option>
            </select>
            
<div class="hidden_div1" style="display:none;">
        
                    
                        <label>Card Type<i class="text-danger"></i></label>
                        <select class="form-control"  name="onetime_type_card"> 
                          <option value = "">Select Type</option>
                          <option value = "1">Credit Card</option>
                          <option value = "2">Dabit Card</option>
                        </select>
    
  
                        <label>Card Bank</label>
                        <input type="text" class="form-control" name="onetime_card_bank" placeholder="Card Bank">
   
   
                        <label>Card Last 4 Digit</label>
                        <input type="text" class="form-control" name="onetime_card_digit" placeholder="Card Last 4 Digit"> 
                    
</div>      
      
<div class="hidden_div2" style="display:none;">
        
                    
                        <label>Cheque No <i class="text-danger"></i></label>
                        <input type="text" class="form-control" name="onetime_cheque_no" placeholder="Cheque No">
                    
                                                  
                    
                        <label>Bank Name <i class="text-danger"></i></label>
                        <input type="text" class="form-control" name="onetime_cheque_bank_name" placeholder="Bank Name"> 
                    
          
          
                        <label>A/C No <i class="text-danger"></i></label>
                        <input type="text" class="form-control" name="onetime_cheque_account_no" placeholder="A/C No"> 
                    
</div>

<div class="hidden_div3" class="container11" style="display:none;">
        
                    
                        <label>DD No <i class="text-danger"></i></label>
                        <input type="text" class="form-control" name="onetime_dd_no" placeholder="DD No"> 
                    
</div>
      
      
            
                  <label for="date">Received amount(Including Tax)</label>
                  <input type="text" class="form-control" name="onetime_pay_amt" id="onetime_pay_amt<?= $i; ?>" placeholder="Received amount">
                
        
                  <label for="date">Received date</label>
                  <input type="date" class="form-control" name="onetime_pay_date" placeholder="Received date"> 
                  
                
                  <label for="date">Name</label>
                  <input type="text" class="form-control" name="onetime_pay_name" placeholder="Name" value="<?php echo $this->session->fullname; ?>"> 
                
                  <label>Attach Invoice</label>
                  <input type="file" class="form-control" name="onetime_invoice" placeholder="Invoice">
                  
                  <label for="date">Signature</label>
                  <input type="file" class="form-control" name="onetime_pay_sign" placeholder="Signature"> 
                        
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary tx-13" id="submit_btn<?= $i; ?>">Send</button>
          </div>
        </div>
        <?php echo form_close()?>
      </div>
    </div>

<script type="text/javascript">
  $(document).on("click", "#submit_btn<?= $i; ?>", function (e) {

  var t_amt  = $("input[id='t_amt<?= $i; ?>']").val();
  var onetime_pay_amt  = $("input[id='onetime_pay_amt<?= $i; ?>']").val();
  var msg = '';

  if (t_amt!=onetime_pay_amt) {
    msg += '<b>Amount must be equal To due.</b><br>';    
  }

  if (msg) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      html: msg    
    });
  }
});
</script>
<!--------------END--------------->
       <!---------------Modal Popup for Onetime Detail of Payment--------------->
                      
      <div class="modal fade" id="modal10p<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6">Detail of Payment</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
        
      <div class="col-md-6">
                Payment Mode : <span><?php if($value->onetime_mode=='1'){ echo 'Cash';}else if($value->onetime_mode=='2'){ echo 'Card';}else if($value->onetime_mode=='3'){ echo 'Cheque';}else if($value->onetime_mode=='4'){ echo 'D-Draft';}; ?><span>
            </div>
      
                <?php if($value->onetime_mode=='2'){ ?>
          <div class="col-md-6">
              Card Type : <span><?php if($value->onetime_type_card=='1'){ echo 'Credit Card';}else if($value->onetime_type_card=='2'){ echo 'Debit Card';}; ?></span>
          </div>
          <div class="col-md-6">
              Card Bank : <span><?php if(!empty($value->onetime_card_bank)){ echo $value->onetime_card_bank;}; ?></span>
          </div>
          <div class="col-md-6">
              Card Last 4 digit : <span><?php if(!empty($value->onetime_card_digit)){ echo $value->onetime_card_digit;}; ?></span>
          </div>
        <?php }else if($value->onetime_mode=='3'){ ?>
          <div class="col-md-6">
              Cheque No : <span><?php if(!empty($value->onetime_cheque_no)){ echo $value->onetime_cheque_no;}; ?></span>
          </div>
          <div class="col-md-6">
              Bank Bank : <span><?php if(!empty($value->onetime_cheque_bank_name)){ echo $value->onetime_cheque_bank_name;}; ?></span>
          </div>
          <div class="col-md-6">
              A/C No : <span><?php if(!empty($value->onetime_cheque_account_no)){ echo $value->onetime_cheque_account_no;}; ?></span>
          </div>
        <?php }else if($value->onetime_mode=='4'){ ?>
          <div class="col-md-6">
              D-Draft No : <span><?php if(!empty($value->onetime_dd_no)){ echo $value->onetime_dd_no;}; ?></span>
          </div>
        <?php } ?>
        
      <div class="col-md-6">
                Received Amount : <span><?php if(!empty($value->onetime_pay_amt)){ echo $value->onetime_pay_amt;}; ?></span>
            </div>
      <div class="col-md-6">
                Received Date : <span><?php if(!empty($value->onetime_pay_date)){ echo $value->onetime_pay_date;}; ?></span>
            </div>
      <div class="col-md-6">
                Accountant Name : <span><?php if(!empty($value->onetime_pay_name)){ echo $value->onetime_pay_name;}; ?></span>
            </div>
      
      
            </div>
      
          <div class="modal-footer" style="border-top: none;">
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

<!-----------------------------------------------END------------------------------------>


  
 <?php } } ?>
</tbody>
</table>
 </div>
<table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">S.No</th>
      <th class="th-sm">Action</th>
      <th class="th-sm">Invoice</th>
    <th class="th-sm">Installment No</th>
    <th class="th-sm">Set Reminder</th>
    <th class="th-sm">From Date</th>
    <th class="th-sm">To Date</th>
    <th class="th-sm">Stage</th>
    <th class="th-sm">Paid Amount</th>
    <th class="th-sm">Paid Date</th>
    <th class="th-sm">Remark</th>
    </tr>
  </thead>
  <tbody>
      <?php $i=1; foreach($ins_list as $val){ ?>
    <tr> 
      <td><?php echo $i; ?></td>
      <td>
    <?php if((empty($val->Pay_status)) && (!in_array($this->session->userdata('user_right'), applicant))){ ?>

        <a href="#modaleditins<?= $i?>" class="titlehover" data-toggle="modal" data-title="Update" data-animation="effect-scale" onclick="trigger(<?= $i?>);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

<?php if(user_access('730')===true){ ?>
         <a href="#modal7p<?= $i?>" class="titlehover" data-title="Unsettled" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
         <?php if($val->link_status==''){ ?>
         <a href="<?php echo base_url('payment/payment_link_send/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1).'/'.'m')?>" class="titlehover" data-title="Send Link"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></a>
        <?php }else{ ?>
         <a href="<?php echo base_url('payment/payment_link_send/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1).'/'.'m')?>" class="titlehover" data-title="Resend Link"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:red;"></i></a>
       <?php } ?>
       <?php if($val->link_status=='1'){ ?>
         <span class="label label-info titlehover" data-title="Details" onclick="paydetails(<?= $val->id; ?>,'m');" style="cursor: pointer;">Paid &nbsp;<i class="fa fa-info-circle" aria-hidden="true"></i></span>
       <?php } ?>
   <?php } ?>
       <?php }else if((empty($val->Pay_status)) && (in_array($this->session->userdata('user_right'), applicant))){ ?>
         <?php if(!empty($ins_list)){ if($val->link_status=='0'){ ?>
          <span class="label label-warning">Unsetteld</span>
         <a href="<?php echo base_url('payment/pay_method/'.$val->id.'/'.$this->session->integration_name.'/'.base64_encode($val->pay_amt).'/'.'m');?>" class="label label-danger">Click For Pay</a>
        <?php }else if($val->link_status=='1'){ ?>
          <span class="label label-warning">Waiting For Confirmation</span>
         <span class="label label-info">Paid</span>
       <?php }} ?>
    <?php }else{ ?>
       <span class="titlehover" data-title="Settled"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>
     <a href="#modal8p<?= $i?>" class="titlehover" data-title="Details" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
     <!--<a href="<?php echo base_url('docs/Invoice Godspeed Immigration-GST-034.pdf');?>" target="_blank" class="label label-success">View Invoice</a>-->
    <?php } ?>
         <!--<a href="#modal6<?= $i?>" class="btn btn-danger" data-toggle="modal" data-animation="effect-scale">Send Link</a>--> 
      </td>
    <td> <?php if(!empty($val->ins_invoice)){ ?> <a href="<?php if(!empty($val->ins_invoice)){ echo 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/God Speed/'.$val->ins_invoice;} ?>" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a> <?php } ?> </td>
      <td><?php foreach($all_installment as $installment){ if($installment->id==$val->ini_set){echo $installment->install_name;}}; ?></td>
    <td><?php if($val->remainder_set=='1'){ echo 'By Date';}else if($val->remainder_set=='2'){ echo 'By Stage';} ?></td>
    <td><?php echo $val->from_date; ?></td>
    <td><?php echo $val->to_date; ?></td>
    <td><?php foreach($all_estage_lists as $stage){ if($stage->stg_id==$val->reminder_satge){echo $stage->lead_stage_name;}}; ?></td>
    <td><?php echo $val->pay_amt; ?></td>
    <td><?php echo $val->pay_date; ?></td>
    <td><?php echo $val->pi_remark; ?></td>
    </tr>



    <!--------------------------Modal Popup for Update installment Payment-------------------------------------->
                      
      <div class="modal fade" id="modaleditins<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6p" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <?php
              echo form_open('client/update_payment_installment/'.$this->uri->segment(3).'/'.$this->uri->segment(1),array('class'=>"",'name'=>'paymentform','enctype'=>'multipart/form-data'));
            ?>
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6p">Update Payment</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <input type="hidden" class="form-control" name="ins_id" value="<?= $val->id; ?>">

  <div class="form-group col-md-6">
        <label>Installments</label>
        <select class="form-control"  name="ini_set"> 
            <option value = "">Select Installment</option>
            <?php foreach($all_installment as $installment){ ?>
            <option value = "<?php echo $installment->id; ?>" <?php if($val->ini_set==$installment->id){ echo 'selected';} ?>><?php echo $installment->install_name; ?></option>
      <?php } ?>
        </select>
  </div>
  <div class="form-group col-md-6">
        <label>Set reminder</label>
        <select class="form-control remdr"  name="remainder_set" id="autotrigger<?= $i?>" onchange="showreminders(this.value,0)"> 
            <option value = "">Select Type</option>
            <option value = "1" <?php if($val->remainder_set=='1'){ echo 'selected';} ?>>By date</option>
            <option value = "2" <?php if($val->remainder_set=='2'){ echo 'selected';} ?>>By Stage</option>
        </select>
  </div>
<div class="bydate0" style="display:none;">    
    <div>
  <div class="form-group col-md-6">
        <label>From Date</label>
        <input type="date" class="form-control" name="from_date" value="<?= $val->from_date; ?>">
    </div>
  <div class="form-group col-md-6">
        <label>To Date</label>
        <input type="date" class="form-control" name="to_date" value="<?= $val->to_date; ?>">
    </div>
  </div>
</div>  
<div class="bystage0" style="display:none;">    
    <div>
  <div class="col-md-6">
    <label>Reminder Stage<i class="text-danger"></i></label>
        <select class="form-control"  name="reminder_satge"> 
            <option value = "">Select Stage</option>
      <?php foreach($all_estage_lists as $stage){ ?>
            <option value = "<?php echo $stage->stg_id; ?>" <?php if($val->reminder_satge==$stage->stg_id){ echo 'selected';} ?>><?php echo $stage->lead_stage_name; ?></option>
      <?php } ?>
        </select>
    </div>
  </div>
</div>

    <div class="form-group col-md-6">
        <label>Pay Amount</label>
        <input type="text" class="form-control" name="pay_amt" value="<?= $val->pay_amt; ?>">
    </div>
    <div class="form-group col-md-6">
        <label>Pay Date</label>
        <input type="date" class="form-control" name="pay_date" value="<?= $val->pay_date; ?>">
    </div>

<div class="form-group col-md-5">
              <label>Attach Invoice</label>
              <input type="file" class="form-control" name="ins_invoice" placeholder="Invoice">
          </div>
<?php if(!empty($val->ins_invoice)){ ?>
          <div class="form-group col-md-1">
              <label>.</label>
              <a href="<?php if(!empty($val->ins_invoice)){ echo 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/God Speed/'.$val->ins_invoice;} ?>" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a>
          </div>
<?php } ?>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="pi_remark" value="<?= $val->pi_remark; ?>"><?= $val->pi_remark; ?></textarea>
    </div>  
                        
          </div>
          <div class="modal-footer" style="border-top: none;">
            <div class="col-md-12">
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary tx-13">Save</button>
            </div>
          </div>
        </div>
        <?php echo form_close()?>
      </div>
    </div>
<!-----------------------------------------------END------------------------------------>

  
       <!--------------------------------Modal Popup for Update Payment-------------------------------------------------->
                      
      <div class="modal fade" id="modal7p<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <?php
              echo form_open('client/update_setlled/'.$this->uri->segment(3).'/'.$this->uri->segment(1),array('class'=>"",'name'=>'paymentform','enctype'=>'multipart/form-data'));
            ?>
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6">Update Payment</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
      <input type="hidden" class="form-control" name="pay_id" value="<?= $val->id; ?>">
       <input type="hidden" class="form-control" name="ins_amt" id="ins_amt<?= $i; ?>" value="<?= $val->pay_amt; ?>"> 
            <label>Payment Mode<i class="text-danger"></i></label>
            <select class="form-control"  name="typpay" onchange="showDivs(this)"> 
                <option value = "">Select Type</option>
                <option value = "1">Cash</option>
                <option value = "2">Card</option>
                <option value = "3">cheque</option>
                <option value = "4">D-Draft</option>
                <option value = "5">Online (Payment Link)</option>
            </select>
            
<div class="hidden_div1" style="display:none;">
        
                    
                        <label>Card Type<i class="text-danger"></i></label>
                        <select class="form-control"  name="type_card"> 
                          <option value = "">Select Type</option>
                          <option value = "1">Credit Card</option>
                          <option value = "2">Dabit Card</option>
                        </select>
    
  
                        <label>Card Bank</label>
                        <input type="text" class="form-control" name="card_bank" placeholder="Card Bank">
   
   
                        <label>Card Last 4 Digit</label>
                        <input type="text" class="form-control" name="card_digit" placeholder="Card Last 4 Digit"> 
                    
</div>      
      
<div class="hidden_div2" style="display:none;">
        
                    
                        <label>Cheque No <i class="text-danger"></i></label>
                        <input type="text" class="form-control" name="cheque_no" placeholder="Cheque No">
                    
                                                  
                    
                        <label>Bank Name <i class="text-danger"></i></label>
                        <input type="text" class="form-control" name="bank_name" placeholder="Bank Name"> 
                    
          
          
                        <label>A/C No <i class="text-danger"></i></label>
                        <input type="text" class="form-control" name="account_no" placeholder="A/C No"> 
                    
</div>

<div class="hidden_div3" class="container11" style="display:none;">
        
                    
                        <label>DD No <i class="text-danger"></i></label>
                        <input type="text" class="form-control" name="dd_no" placeholder="DD No"> 
                    
</div>
      
      
            
                  <label for="date">Received amount(Including Tax)</label>
                  <input type="text" class="form-control" name="recieved_amt" id="recieved_amt<?= $i; ?>" placeholder="Received amount">
                
        
                  <label for="date">Received date</label>
                  <input type="date" class="form-control" name="recieved_date" placeholder="Received date"> 
                  
                
                  <label for="date">Name</label>
                  <input type="text" class="form-control" name="account_name" placeholder="Name" value="<?php echo $this->session->fullname; ?>"> 

                  <label>Attach Invoice</label>
                  <input type="file" class="form-control" name="ins_invoice" placeholder="Invoice">
                
                
                  <label for="date">Signature</label>
                  <input type="file" class="form-control" name="account_sign" placeholder="Signature"> 
                        
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary tx-13" id="submit_ins<?= $i; ?>">Send</button>
          </div>
        </div>
        <?php echo form_close()?>
      </div>
    </div>
<script type="text/javascript">
$(document).on("click", "#submit_ins<?= $i; ?>", function (e) {

  var ins_amt  = $("input[id='ins_amt<?= $i; ?>']").val();
  var recieved_amt  = $("input[id='recieved_amt<?= $i; ?>']").val();
  var msg = '';
  if (ins_amt!=recieved_amt) {
    msg += '<b>Amount must be equal to Paid Amount.</b><br>';    
  }

  if (msg) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      html: msg    
    });
  }
});
</script>
<!-----------------------------------------------END------------------------------------>
       <!--------------------------------Modal Popup for Detail of Payment-------------------------------------------------->
                      
      <div class="modal fade" id="modal8p<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6pp" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6pp">Detail of Payment</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
        
      <div class="col-md-6">
                Payment Mode : <span><?php if($val->typpay=='1'){ echo 'Cash';}else if($val->typpay=='2'){ echo 'Card';}else if($val->typpay=='3'){ echo 'Cheque';}else if($val->typpay=='4'){ echo 'D-Draft';}; ?><span>
            </div>
      
                <?php if($val->typpay=='2'){ ?>
          <div class="col-md-6">
              Card Type : <span><?php if($val->type_card=='1'){ echo 'Credit Card';}else if($val->type_card=='2'){ echo 'Debit Card';}; ?></span>
          </div>
          <div class="col-md-6">
              Card Bank : <span><?php if(!empty($val->card_bank)){ echo $val->card_bank;}; ?></span>
          </div>
          <div class="col-md-6">
              Card Last 4 digit : <span><?php if(!empty($val->card_digit)){ echo $val->card_digit;}; ?></span>
          </div>
        <?php }else if($val->typpay=='3'){ ?>
          <div class="col-md-6">
              Cheque No : <span><?php if(!empty($val->cheque_no)){ echo $val->cheque_no;}; ?></span>
          </div>
          <div class="col-md-6">
              Bank Bank : <span><?php if(!empty($val->bank_name)){ echo $val->bank_name;}; ?></span>
          </div>
          <div class="col-md-6">
              A/C No : <span><?php if(!empty($val->account_no)){ echo $val->account_no;}; ?></span>
          </div>
        <?php }else if($val->typpay=='4'){ ?>
          <div class="col-md-6">
              D-Draft No : <span><?php if(!empty($val->dd_no)){ echo $val->dd_no;}; ?></span>
          </div>
        <?php } ?>
        
      <div class="col-md-6">
                Received Amount : <span><?php if(!empty($val->recieved_amt)){ echo $val->recieved_amt;}; ?></span>
            </div>
      <div class="col-md-6">
                Received Date : <span><?php if(!empty($val->recieved_date)){ echo $val->recieved_date;}; ?></span>
            </div>
      <div class="col-md-6">
                Accountant Name : <span><?php if(!empty($val->account_name)){ echo $val->account_name;}; ?></span>
            </div>
      
      
            </div>
      
          <div class="modal-footer" style="border-top: none;">
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <?php $i++;} ?>
  </tbody>
</table> 
 
 
<script>
     $(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
 </script>
 <?php if(user_access('720')===true){ ?>
 <form class="" action="<?php echo base_url()?>client/create_payment/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">
            <div class="col-md-12 col-sm-12">        
              <div class="row">
                <div class="col-md-4">
                    <label>Deposit/Reg. Fee<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="Enter Fee" name="reg_fee" id="reg">
                </div>
        
        <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                    <select name="tax_value_reg" class="form-control" onchange="calculateAmount(this.value,'reg')">
                      <option value="" disabled selected>Choose here</option>
                    <?php foreach($all_gst as $glist){ ?>
                      <option value="<?php echo $glist->gst_value; ?>"><?php echo $glist->gst_name; ?></option>
                    <?php } ?>  
                    </select>
                </div>
        
        <div class="col-md-4">
                    <label>Total Amount<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="total Fee" name="total_reg" id="treg">
                </div>

                <div class="col-md-4">
                    <label>Application Fees<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="Enter Fee" name="app_fee" id="app">
                </div>
        
        <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                    <select name="tax_value_app" class="form-control" onchange="calculateAmount(this.value,'app')">
                      <option value="" disabled selected>Choose here</option>
                    <?php foreach($all_gst as $glist){ ?>
                      <option value="<?php echo $glist->gst_value; ?>"><?php echo $glist->gst_name; ?></option>
                    <?php } ?>
                      
                    </select>
                </div>
        
        <div class="col-md-4">
                    <label>Total Amount<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="total Fee" name="total_app" id="tapp">
                </div>        
        
        <div class="col-md-4">
                    <label>Family Fee<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="Enter Fee" name="family_fee" id="family">
                </div>
        
        <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                    <select name="tax_value_family" class="form-control" onchange="calculateAmount(this.value,'family')">
                      <option value="" disabled selected>Choose here</option>
                    <?php foreach($all_gst as $glist){ ?>
                      <option value="<?php echo $glist->gst_value; ?>"><?php echo $glist->gst_name; ?></option>
                    <?php } ?>
                      
                    </select>
                </div>
        
        <div class="col-md-4">
                    <label>Total Amount<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="total Fee" name="total_family" id="tfamily">
                </div>
        
        <div class="col-md-4">
                    <label>Lawyer Fee<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="Enter Fee" name="lawyer_fee" id="lawyer">
                </div>
        
        <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                    <select name="tax_value_lawyer" class="form-control" onchange="calculateAmount(this.value,'lawyer')">
                      <option value="" disabled selected>Choose here</option>
                    <?php foreach($all_gst as $glist){ ?>
                      <option value="<?php echo $glist->gst_value; ?>"><?php echo $glist->gst_name; ?></option>
                    <?php } ?>
                    </select>
                </div>
        
        <div class="col-md-4">
                    <label>Total Amount<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="total Fee" name="total_lawyer" id="tlawyer">
                </div>

                <div class="col-md-4">
                    <label>Consultancy  Fee<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="Consultancy Fee" name="consultancy_fee" id="consultancy">
                </div>
        
        <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                    <select name="tax_value_consultancy" class="form-control" onchange="calculateAmount(this.value,'consultancy')">
                      <option value="" disabled selected>Choose here</option>
                    <?php foreach($all_gst as $glist){ ?>
                      <option value="<?php echo $glist->gst_value; ?>"><?php echo $glist->gst_name; ?></option>
                    <?php } ?>
                    </select>
                </div>
        
        <div class="col-md-4">
                    <label>Total Amount<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="total Fee" name="total_consultancy" id="tconsultancy">
                </div>
        
        
        <div class="col-md-4">
                    <label>Stamp Paper Fee<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="Stamp Paper Fee" name="stamp_fee" id="stamp">
                </div>
        
        <div class="col-md-4">
                    <label>Tax (%)<i class="text-danger"></i></label>
                    <select name="tax_value_stamp" class="form-control" onchange="calculateAmount(this.value,'stamp')">
                      <option value="" disabled selected>Choose hrere</option>
                    <?php foreach($all_gst as $glist){ ?>
                      <option value="<?php echo $glist->gst_value; ?>"><?php echo $glist->gst_name; ?></option>
                    <?php } ?>
                    </select>
                </div>
        
        <div class="col-md-3">
                    <label>Total Amount<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="total Fee" name="total_stamp" id="tstamp">
                </div>

                <div class="col-md-1" style="padding-top: 20px;">
                   <button type="button" class="btn btn-info" onclick="calculateTotal();"><i class="fa fa-calculator" aria-hidden="true"></i></button>
                </div>

        
        <div class="col-md-4">
                    <label>Total without(Tax)<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="total Fee" name="notax_amt" id="notax_amt">
                </div>

                <div class="col-md-4">
                    <label>Total with(Tax)<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="total Fee" name="taxabal_amt" id="taxabal_amt">
                </div>
        
        <div class="col-md-4">
                    <label>Advance<i class="text-danger"></i></label>
                    <input type="text" class="form-control" placeholder="Advanced Fee" name="advance" id="adv4">
                </div>
        
        <div class="col-md-6">
            <label>Payment Type<i class="text-danger"></i></label>
                     <select class="form-control"  name="typepay"  id="typepay" onchange="paytype(this)"> 
                     <option value = "">Select Type</option>
                     <option value = "1">Onetime</option>
                     <option value = "2">Installment</option>
                    </select>
        </div>
    <hr class="line_break">
<div id="onetime" style="display:none;">   
    <div>
  <div class="col-md-6">
    <label>Payment Mode<i class="text-danger"></i></label>
        <select class="form-control"  name="onetime_mode" onchange="showDivonetime(this)"> 
            <option value = "">Select Type</option>
            <option value = "1">Cash</option>
            <option value = "2">Card</option>
      <option value ="3">Cheque</option>
      <option value ="4">D-Draft</option>
      <option value ="5">Net Banking</option>
        </select>
    </div>
  </div>

<!--<div id="cash" style="display:none;">    
    <div>
    <div class="form-group col-md-6">
        <label>Pay Amount</label>
        <input type="text" class="form-control" name="onetime_pay_amt" placeholder="Paid Amount">
    </div>
  <div class="form-group col-md-6">
        <label>Pay Date</label>
        <input type="date" class="form-control" name="onetime_pay_date" placeholder="Paid date">
    </div>  
  </div>
</div>-->

<div id="card" style="display:none;">    
    <div>
  <div class="col-md-6">
    <label>Card Type<i class="text-danger"></i></label>
        <select class="form-control"  name="onetime_type_card"> 
            <option value = "">Select Type</option>
            <option value = "1">Credit Card</option>
            <option value = "2">Dabit Card</option>
        </select>
    </div>
  <div class="form-group col-md-6">
        <label>Card Bank</label>
        <input type="text" class="form-control" name="onetime_card_bank" placeholder="Card Bank">
    </div>
  <div class="form-group col-md-6">
        <label>Card Last 4 Digit</label>
        <input type="text" class="form-control" name="onetime_card_digit" placeholder="Card Last 4 Digit">
    </div>
  </div>
</div>

<div id="cheque" style="display:none;">    
    <div>
  <div class="form-group col-md-6">
      <label>Cheque No <i class="text-danger"></i></label>
        <input type="text" class="form-control" name="onetime_cheque_no" placeholder="Cheque No">
    </div>                                                                
    <div class="form-group col-md-6">                
        <label>Bank Name <i class="text-danger"></i></label>
        <input type="text" class="form-control" name="onetime_cheque_bank_name" placeholder="Bank Name"> 
    </div>                          
  <div class="form-group col-md-6">       
        <label>A/C No <i class="text-danger"></i></label>
        <input type="text" class="form-control" name="onetime_cheque_account_no" placeholder="A/C No">
  </div>
  </div>
</div>

<div id="dd" style="display:none;">    
    <div>
  <div class="form-group col-md-6">
      <label>DD No <i class="text-danger"></i></label>
      <input type="text" class="form-control" name="onetime_dd_no" placeholder="DD No">
  </div>  
  </div>
</div>
<div class="form-group col-md-6">
        <label>Pay Amount</label>
        <input type="text" class="form-control" name="onetime_pay_amt" placeholder="Paid Amount">
</div>
<div class="form-group col-md-6">
        <label>Pay Date</label>
        <input type="date" class="form-control" name="onetime_pay_date" placeholder="Paid date">
</div>
<div class="form-group col-md-6">
        <label>Attach Invoice</label>
        <input type="file" class="form-control" name="onetime_invoice" placeholder="Invoice">
</div>
<div class="form-group col-md-6">
        <label>Remark</label>
        <textarea class="form-control" name="p_remark"></textarea>
</div>
</div>

<div id="installment" class="container1" style="display:none;">    
    <div>
  <div class="form-group col-md-6">
        <label>Installments</label>
        <select class="form-control"  name="ini_set[]"> 
            <option value = "">Select Installment</option>
            <?php foreach($all_installment as $installment){ ?>
            <option value = "<?php echo $installment->id; ?>"><?php echo $installment->install_name; ?></option>
      <?php } ?>
        </select>
    </div>
  <div class="form-group col-md-6">
        <label>Set reminder</label>
        <select class="form-control remdr"  name="remainder_set[]" onchange="showreminders(this.value,0)"> 
            <option value = "">Select Type</option>
            <option value = "1">By date</option>
            <option value = "2">By Stage</option>
        </select>
    </div>
<div class="bydate0" style="display:none;">    
    <div>
  <div class="form-group col-md-6">
        <label>From Date</label>
        <input type="date" class="form-control" name="from_date[]" placeholder="">
    </div>
  <div class="form-group col-md-6">
        <label>To Date</label>
        <input type="date" class="form-control" name="to_date[]" placeholder="">
    </div>
  </div>
</div>  
<div class="bystage0" style="display:none;">    
    <div>
  <div class="col-md-6">
    <label>Reminder Stage<i class="text-danger"></i></label>
        <select class="form-control"  name="reminder_satge[]"> 
            <option value = "">Select Stage</option>
      <?php foreach($all_estage_lists as $stage){ ?>
            <option value = "<?php echo $stage->stg_id; ?>"><?php echo $stage->lead_stage_name; ?></option>
      <?php } ?>
        </select>
    </div>
  </div>
</div>

    <div class="form-group col-md-6">
        <label>Pay Amount</label>
        <input type="text" class="form-control" name="pay_amt[]" placeholder="Paid Amount">
    </div>
  <div class="form-group col-md-6">
        <label>Pay Date</label>
        <input type="date" class="form-control" name="pay_date[]" placeholder="Paid date">
    </div>
  <div class="form-group col-md-6">
        <label>Attach Invoice</label>
        <input type="file" class="form-control" name="ins_invoice[]" placeholder="Invoice">
  </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="pi_remark[]"></textarea>
    </div>  
  
  <div class="form-group col-md-1">
      <label></label>
        <button type="button" class="add_form_field btn btn-success"> 
        <span style="font-size:16px; font-weight:bold;">+ </span>
    </button>
    </div>
  </div>
</div>
<div class="col-md-12" style="padding:20px;">                                                
                              <input class="btn btn-success" type="submit" value="Submit" name="submit" >           
                           </div>
</div>
</div>
</form>
<?php } ?>
</div>
</div>
<script>
  function calculateAmount(val,key) { 
    if(key=='reg'){
      var totalValue = document.getElementById('reg').value;
    }else if(key=='family'){
      var totalValue = document.getElementById('family').value;
    }else if(key=='lawyer'){
      var totalValue = document.getElementById('lawyer').value;
    }else if(key=='consultancy'){
      var totalValue = document.getElementById('consultancy').value;
    }else if(key=='stamp'){
      var totalValue = document.getElementById('stamp').value;
    }else if(key=='app'){
      var totalValue = document.getElementById('app').value;
    }
      var price = val * 1;
      var total = totalValue * 1;
      var tax = (price/100)
      //display the result
      var tot_price = total + (total * tax);
//alert(tot_price);
      if(key=='reg'){
      var divobj = document.getElementById('treg');
    }else if(key=='family'){
      var divobj = document.getElementById('tfamily');
    }else if(key=='lawyer'){
      var divobj = document.getElementById('tlawyer');
    }else if(key=='consultancy'){
      var divobj = document.getElementById('tconsultancy');
    }else if(key=='stamp'){
      var divobj = document.getElementById('tstamp');
    }else if(key=='app'){
      var divobj = document.getElementById('tapp');
    }
      divobj.value = tot_price;
  }

  function calculateAmountedit(val,key) { 
    if(key=='reg'){
      var totalValue = document.getElementById('regedit').value;
    }else if(key=='family'){
      var totalValue = document.getElementById('familyedit').value;
    }else if(key=='lawyer'){
      var totalValue = document.getElementById('lawyeredit').value;
    }else if(key=='consultancy'){
      var totalValue = document.getElementById('consultancyedit').value;
    }else if(key=='stamp'){
      var totalValue = document.getElementById('stampedit').value;
    }else if(key=='app'){
      var totalValue = document.getElementById('appedit').value;
    }
      var price = val * 1;
      var total = totalValue * 1;
      var tax = (price/100)
      //display the result
      var tot_price = total + (total * tax);
//alert(tot_price);
      if(key=='reg'){
      var divobj = document.getElementById('tregedit');
    }else if(key=='family'){
      var divobj = document.getElementById('tfamilyedit');
    }else if(key=='lawyer'){
      var divobj = document.getElementById('tlawyeredit');
    }else if(key=='consultancy'){
      var divobj = document.getElementById('tconsultancyedit');
    }else if(key=='stamp'){
      var divobj = document.getElementById('tstampedit');
    }else if(key=='app'){
      var divobj = document.getElementById('tappedit');
    }
      divobj.value = tot_price;
  }

function calculateTotal() { 
    var txtFirstNumberValue = document.getElementById('reg').value;
    var txtSecondNumberValue = document.getElementById('family').value;
    var txtThirdNumberValue = document.getElementById('lawyer').value;
    var txtfourthNumberValue = document.getElementById('consultancy').value;
    var txtfifthNumberValue = document.getElementById('stamp').value;
    var txtsixthNumberValue = document.getElementById('app').value;
  
    var ttxtFirstNumberValue = document.getElementById('treg').value;
    var ttxtSecondNumberValue = document.getElementById('tfamily').value;
    var ttxtThirdNumberValue = document.getElementById('tlawyer').value;
    var ttxtfourthNumberValue = document.getElementById('tconsultancy').value;
    var ttxtfifthNumberValue = document.getElementById('tstamp').value;
    var ttxtsixthNumberValue = document.getElementById('tapp').value;
    
    if(txtFirstNumberValue==''){txtFirstNumberValue='0';}else{txtFirstNumberValue=txtFirstNumberValue;}
    if(txtSecondNumberValue==''){txtSecondNumberValue='0';}else{txtSecondNumberValue=txtSecondNumberValue;}
    if(txtThirdNumberValue==''){txtThirdNumberValue='0';}else{txtThirdNumberValue=txtThirdNumberValue;}
    if(txtfourthNumberValue==''){txtfourthNumberValue='0';}else{txtfourthNumberValue=txtfourthNumberValue;}
    if(txtfifthNumberValue==''){txtfifthNumberValue='0';}else{txtfifthNumberValue=txtfifthNumberValue;}
    if(txtsixthNumberValue==''){txtsixthNumberValue='0';}else{txtsixthNumberValue=txtsixthNumberValue;}

    if(ttxtFirstNumberValue==''){ttxtFirstNumberValue='0';}else{ttxtFirstNumberValue=ttxtFirstNumberValue;}
    if(ttxtSecondNumberValue==''){ttxtSecondNumberValue='0';}else{ttxtSecondNumberValue=ttxtSecondNumberValue;}
    if(ttxtThirdNumberValue==''){ttxtThirdNumberValue='0';}else{ttxtThirdNumberValue=ttxtThirdNumberValue;}
    if(ttxtfourthNumberValue==''){ttxtfourthNumberValue='0';}else{ttxtfourthNumberValue=ttxtfourthNumberValue;}
    if(ttxtfifthNumberValue==''){ttxtfifthNumberValue='0';}else{ttxtfifthNumberValue=ttxtfifthNumberValue;}
    if(ttxtsixthNumberValue==''){ttxtsixthNumberValue='0';}else{ttxtsixthNumberValue=ttxtsixthNumberValue;}


      var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue) + parseInt(txtThirdNumberValue) + parseInt(txtfourthNumberValue) + parseInt(txtfifthNumberValue) + parseInt(txtsixthNumberValue);
      var taxresult = parseInt(ttxtFirstNumberValue) + parseInt(ttxtSecondNumberValue) + parseInt(ttxtThirdNumberValue) + parseInt(ttxtfourthNumberValue) + parseInt(ttxtfifthNumberValue) + parseInt(ttxtsixthNumberValue);
    if (!isNaN(result)) {
         document.getElementById('notax_amt').value = result;
      }
    if (!isNaN(taxresult)) {
         document.getElementById('taxabal_amt').value = taxresult;
      }
 }

 function calculateTotaledit() { 
    var txtFirstNumberValue = document.getElementById('regedit').value;
    var txtSecondNumberValue = document.getElementById('familyedit').value;
    var txtThirdNumberValue = document.getElementById('lawyeredit').value;
    var txtfourthNumberValue = document.getElementById('consultancyedit').value;
    var txtfifthNumberValue = document.getElementById('stampedit').value;
    var txtsixthNumberValue = document.getElementById('appedit').value;
  
    var ttxtFirstNumberValue = document.getElementById('tregedit').value;
    var ttxtSecondNumberValue = document.getElementById('tfamilyedit').value;
    var ttxtThirdNumberValue = document.getElementById('tlawyeredit').value;
    var ttxtfourthNumberValue = document.getElementById('tconsultancyedit').value;
    var ttxtfifthNumberValue = document.getElementById('tstampedit').value;
    var ttxtsixthNumberValue = document.getElementById('tappedit').value;
    
    if(txtFirstNumberValue==''){txtFirstNumberValue='0';}else{txtFirstNumberValue=txtFirstNumberValue;}
    if(txtSecondNumberValue==''){txtSecondNumberValue='0';}else{txtSecondNumberValue=txtSecondNumberValue;}
    if(txtThirdNumberValue==''){txtThirdNumberValue='0';}else{txtThirdNumberValue=txtThirdNumberValue;}
    if(txtfourthNumberValue==''){txtfourthNumberValue='0';}else{txtfourthNumberValue=txtfourthNumberValue;}
    if(txtfifthNumberValue==''){txtfifthNumberValue='0';}else{txtfifthNumberValue=txtfifthNumberValue;}
    if(txtsixthNumberValue==''){txtsixthNumberValue='0';}else{txtsixthNumberValue=txtsixthNumberValue;}

    if(ttxtFirstNumberValue==''){ttxtFirstNumberValue='0';}else{ttxtFirstNumberValue=ttxtFirstNumberValue;}
    if(ttxtSecondNumberValue==''){ttxtSecondNumberValue='0';}else{ttxtSecondNumberValue=ttxtSecondNumberValue;}
    if(ttxtThirdNumberValue==''){ttxtThirdNumberValue='0';}else{ttxtThirdNumberValue=ttxtThirdNumberValue;}
    if(ttxtfourthNumberValue==''){ttxtfourthNumberValue='0';}else{ttxtfourthNumberValue=ttxtfourthNumberValue;}
    if(ttxtfifthNumberValue==''){ttxtfifthNumberValue='0';}else{ttxtfifthNumberValue=ttxtfifthNumberValue;}
    if(ttxtsixthNumberValue==''){ttxtsixthNumberValue='0';}else{ttxtsixthNumberValue=ttxtsixthNumberValue;}


      var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue) + parseInt(txtThirdNumberValue) + parseInt(txtfourthNumberValue) + parseInt(txtfifthNumberValue) + parseInt(txtsixthNumberValue);
      var taxresult = parseInt(ttxtFirstNumberValue) + parseInt(ttxtSecondNumberValue) + parseInt(ttxtThirdNumberValue) + parseInt(ttxtfourthNumberValue) + parseInt(ttxtfifthNumberValue) + parseInt(ttxtsixthNumberValue);
    if (!isNaN(result)) {
         document.getElementById('notax_amtedit').value = result;
      }
    if (!isNaN(taxresult)) {
         document.getElementById('taxabal_amtedit').value = taxresult;
      }
 } 
</script>
<script type="text/javascript">
function showDivs(select){
   if(select.value==2){
     $('.hidden_div1').css('display','block');
     $('.hidden_div2').css('display','none');
     $('.hidden_div3').css('display','none');
   }else if(select.value==3){
     $('.hidden_div1').css('display','none');
     $('.hidden_div2').css('display','block');
     $('.hidden_div3').css('display','none');
   }else if(select.value==4){
     $('.hidden_div1').css('display','none');
     $('.hidden_div2').css('display','none');
     $('.hidden_div3').css('display','block');
   }else{
     $('.hidden_div1').css('display','none');
     $('.hidden_div2').css('display','none');
     $('.hidden_div3').css('display','none');
   }
}

function paytype(select){
   if(select.value==1){
    document.getElementById('onetime').style.display = "block";
  document.getElementById('installment').style.display = "none";
   }else{
  document.getElementById('installment').style.display = "block";
    document.getElementById('onetime').style.display = "none";
   }
}

function showDivonetime(select){
   if(select.value==1){
  //document.getElementById('cash').style.display = "block";
  document.getElementById('card').style.display = "none";
  document.getElementById('cheque').style.display = "none";
  document.getElementById('dd').style.display = "none";
   }else if(select.value==2){
  //document.getElementById('cash').style.display = "none";
  document.getElementById('card').style.display = "block";
  document.getElementById('cheque').style.display = "none";
  document.getElementById('dd').style.display = "none";
   }else if(select.value==3){
  //document.getElementById('cash').style.display = "none";
  document.getElementById('card').style.display = "none";
  document.getElementById('cheque').style.display = "block";
  document.getElementById('dd').style.display = "none";
   }else{
  //document.getElementById('cash').style.display = "none";
  document.getElementById('card').style.display = "none";
  document.getElementById('cheque').style.display = "none";
  document.getElementById('dd').style.display = "block";
   } 
}

function showreminders(value,x){
    if(value==1){
     $('.bydate'+x).css('display','block');
     $('.bystage'+x).css('display','none');
   }else{
     $('.bystage'+x).css('display','block');
     $('.bydate'+x).css('display','none');
   }
}

/*function sum() {
      var txtFirstNumberValue = document.getElementById('fee1').value;
      var txtSecondNumberValue = document.getElementById('fee2').value;
      var txtThirdNumberValue = document.getElementById('fee3').value;
      var txtfourthNumberValue = document.getElementById('fee4').value;
      var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue) + parseInt(txtThirdNumberValue) + parseInt(txtfourthNumberValue);
      if (!isNaN(result)) {
         document.getElementById('fee5').value = result;
      }
}*/
 
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var z = <?= $data_type; ?>;
    var max_fields = 10;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");
    var p_id ='<?php echo $add_more_pid; ?>';

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
      $.ajax({
        url: '<?=base_url("client/getHtml/")?>'+x+'/'+p_id+'/'+z,
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
function trigger(x) {
  $("#autotrigger"+x).trigger("change");
}
 </script>
 <script type="text/javascript">
  function paydetails(pd_id,t){ 
   $.ajax({
type: "POST",
url: "<?php echo base_url();?>payment/get_pay_details/"+btoa(pd_id)+'/'+t,        
success: function(data){ 
  if(data!=0){ 
Swal.fire({
  icon: 'info',
  title: 'Payment Deatails!',
  html: data
}); 
            }    
          }
             });
 }
 </script>