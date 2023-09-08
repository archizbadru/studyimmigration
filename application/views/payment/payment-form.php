<?php  

/*define('MERCHANT_KEY', 'A0ZvklkZ');
define('SALT', 'xZXfbRGyAu');
harshit
*/

/*define('MERCHANT_KEY', '16pUJhQ9');
define('SALT', 'vYsS4mkpf1');*/
/*customer*/


define('MERCHANT_KEY', 'GyGrb4rz');
define('SALT', 'xEB2K9rvWb');
/*kanhaiya*/


//define('PAYU_BASE_URL', 'https://test.payu.in');    //Testing url Use in development mode
define('PAYU_BASE_URL', 'https://secure.payu.in');  //actual URL Use in production mode
define('SUCCESS_URL', base_url().'payment/payment_success');  //order sucess url replace with your complete url
define('FAIL_URL', base_url().'payment/payment_failed');    //add complete url 
$txnid      = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$email      = $this->session->email;
$mobile     = $this->session->phone;
$name       = explode(' ',$this->session->fullname);
$firstName  = !empty($name[0])?$name[0]:'';
$lastName   = !empty($name[1])?$name[1]:'';
$productinfo= 'msg';
$totalCost  = '1';
$hash       = '';

$hash_string = MERCHANT_KEY."|".$txnid."|".$totalCost."|".$productinfo."|".$firstName."|".$email."|||||||||||".SALT;
$hash = strtolower(hash('sha512', $hash_string));
$action = PAYU_BASE_URL . '/_payment'; 
 //print_r($hash_string);exit;
?>
<form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm" style="display: none;">
    <input type="hidden" name="key" value="<?php echo MERCHANT_KEY ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
    <input name="amount" type="number" value="<?php echo $totalCost; ?>" />
    <input type="text" name="firstname" id="firstname" value="<?php echo $firstName; ?>" />
    <input type="email" name="email" id="email" value="<?php echo $email; ?>" />
    <input type="text" name="phone" value="<?php echo $mobile; ?>" />
    <textarea name="productinfo"><?php echo $productinfo; ?></textarea>
    <input type="text" name="surl" value="<?php echo SUCCESS_URL; ?>" />
    <input type="text" name="furl" value="<?php echo  FAIL_URL?>"/>
    <input type="text" name="service_provider" value="payu_paisa"/>
    <input type="text" name="lastname" id="lastname" value="<?php echo $lastName ?>" />
</form>
<script type="text/javascript">
    var payuForm = document.forms.payuForm;
    payuForm.submit();
</script>
