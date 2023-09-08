<style>
 .content-panel{
  padding: 10%;
 } 
</style>
<?php 
require_once "constants.php";
?>
<form name="razorpay_frm_payment" class="razorpay-frm-payment" id="razorpay-frm-payment" method="post">
<input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo mt_rand(10000,99999); ?>"> 
<input type="hidden" name="language" value="EN"> 
<input type="hidden" name="currency" id="currency" value="INR">
<input type="hidden" name="paytyp" id="paytyp" value="<?php echo $this->uri->segment(6); ?>"> 
<input type="hidden" name="surl" id="surl" value="<?php echo base_url('payment/razorpay_success/'.$this->uri->segment(3)); ?>"> 
<input type="hidden" name="furl" id="furl" value="<?php echo base_url('payment/razorpay_failed/'.$this->uri->segment(3)); ?>">
<input type="hidden" class="form-control" id="insid" name="insid" placeholder="insid" value="<?php echo $this->uri->segment(3); ?>" readonly="readonly"> 
</br>
<div class="content-panel">

<a href="<?php echo base_url('dashboard/user_profile'); ?>" class="btn btn-default">Back To Dashboard</a>
</br></br></br>
<section class="showcase">
    <div class="row align-items-center">
       <div class="form-group col-md-6">
        <label for="inputEmail4">Amount</label>
        <input type="text" class="form-control" id="amount" name="amount" placeholder="amount" value="<?php echo base64_decode($this->uri->segment(5)); ?>" readonly="readonly">
      </div> 
      <div class="form-group col-md-6">
        <label for="inputEmail4">Full Name</label>
        <input type="text" name="billing_name" class="form-control" id="billing-name" value="<?php echo $this->session->fullname; ?>" readonly="readonly" Placeholder="Name" required> 
      </div>
  </div>
    <div class="row align-items-center">
       <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="email" name="billing_email"class="form-control" id="billing-email" value="<?php echo $this->session->email; ?>" readonly="readonly" Placeholder="Email" required>
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">Phone</label>
        <input type="text" name="billing_phone" class="form-control" id="billing-phone" value="<?php echo $this->session->phone; ?>" readonly="readonly" Placeholder="Phone" required>
      </div>
  </div>
    <div class="row align-items-center">  
      <div class="form-group col-md-6">
        <label for="inputEmail4">Address</label>
         <input type="text" name="billing_address" class="form-control" value="" Placeholder="Address">
      </div>
       <div class="form-group col-md-6">
        <label for="inputEmail4">Country</label>
        <input type="text" name="billing_country" class="form-control" value=""  Placeholder="Country">
      </div>
    </div>

    <div class="row align-items-center">  
      <div class="form-group col-md-6">
        <label for="inputEmail4">State</label>
         <input type="text" name="billing_state" class="form-control" value=""  Placeholder="State"> 
      </div>
       <div class="form-group col-md-6">
        <label for="inputEmail4">Zipcode</label>
        <input type="text" name="billing_zip" class="form-control" Placeholder="Zipcode">
      </div>
    </div>

    <div class="row">
      <div class="col">
        <button type="button" class="btn btn-success mt-4 float-right" id="razor-pay-now"><i class="fa fa-credit-card" aria-hidden="true"></i> Pay</button>
      </div>
    </div>
</section>
</div>
</form>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
  jQuery(document).on('click', '#razor-pay-now', function (e) {
    var total = (jQuery('form#razorpay-frm-payment').find('input#amount').val() * 100);
    var merchant_order_id = jQuery('form#razorpay-frm-payment').find('input#merchant_order_id').val();
    var merchant_pay_typ = jQuery('form#razorpay-frm-payment').find('input#paytyp').val();
    var merchant_surl_id = jQuery('form#razorpay-frm-payment').find('input#surl').val();
    var merchant_furl_id = jQuery('form#razorpay-frm-payment').find('input#furl').val();
    var card_holder_name_id = jQuery('form#razorpay-frm-payment').find('input#billing-name').val();
    var merchant_total = total;
    var merchant_amount = jQuery('form#razorpay-frm-payment').find('input#amount').val();
	  var merchant_insid = jQuery('form#razorpay-frm-payment').find('input#insid').val();
    var currency_code_id = jQuery('form#razorpay-frm-payment').find('input#currency').val();
    var key_id = "<?php echo RAZOR_KEY_ID; ?>";
    var store_name = 'God Speed';
    var store_description = 'Payment';
    <?php if($this->session->companey_id==83){ ?>
    var store_logo = 'https://consultantscrm.com/assets/images/godspeed.png';
    <?php }else{ ?>
      var store_logo = 'https://thecrm360.com/new_crm/assets/images/new_logo.png';
    <?php } ?>
    var email = jQuery('form#razorpay-frm-payment').find('input#billing-email').val();
    var phone = jQuery('form#razorpay-frm-payment').find('input#billing-phone').val();
    
    jQuery('.text-danger').remove();

    if(card_holder_name_id=="") {
      jQuery('input#billing-name').after('<small class="text-danger">Please enter full mame.</small>');
      return false;
    }
    if(email=="") {
      jQuery('input#billing-email').after('<small class="text-danger">Please enter valid email.</small>');
      return false;
    }
    if(phone=="") {
      jQuery('input#billing-phone').after('<small class="text-danger">Please enter valid phone.</small>');
      return false;
    }
    
    var razorpay_options = {
        key: key_id,
        amount: merchant_total,
        name: store_name,
        description: store_description,
        image: store_logo,
        netbanking: true,
        currency: currency_code_id,
        prefill: {
            name: card_holder_name_id,
            email: email,
            contact: phone
        },
        notes: {
            soolegal_order_id: merchant_order_id,
        },
        handler: function (transaction) {
         // alert(transaction);
            jQuery.ajax({
                url:'<?php echo base_url();?>payment/razorpay_payment_final',
                type: 'post',
                data: {razorpay_payment_id: transaction.razorpay_payment_id, merchant_order_id: merchant_order_id, merchant_surl_id: merchant_surl_id, merchant_furl_id: merchant_furl_id,merchant_pay_typ: merchant_pay_typ, card_holder_name_id: card_holder_name_id, merchant_total: merchant_total, merchant_amount: merchant_amount, currency_code_id: currency_code_id,merchant_insid: merchant_insid}, 
                dataType: 'json',
                success: function (res) {
                    if(res.msg){
                        return false;
                    } 
                    window.location = res.redirectURL;
                }
            });
        },
        "modal": {
            "ondismiss": function () {
                // code here
            }
        }
    };
    // obj        
    var objrzpv1 = new Razorpay(razorpay_options);
    objrzpv1.open();
        e.preventDefault();
            
});
</script>