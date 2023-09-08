
<!------ Include the above in your HEAD tag ---------->
<br><br>
<div id="navbar-example"> 
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#attributes" role="tab">General</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile" role="tab" >Payment Getway</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#experience" role="tab">Lead Setting</a>
        </li>
       
    </ul>

    <!-- Tab panes {Fade}  -->
    <div class="tab-content">
        <div class="tab-pane fade in active" id="attributes" name="attributes" role="tabpanel">
            <div class="bs-callout bs-callout-danger">
          <h4>General</h4>

        </div>
        </div>
      <div class="tab-pane fade" id="profile" role="tabpanel">
          <div class="bs-callout bs-callout-danger" id="certifications" name="certifications">

        
         <?php echo form_open_multipart('Crm_setting/payment_setting','class="form-inner" id="payment_setting"') ?> 
     <div id="acnt-details" class="tab-pane fade active in">

                            <div class="form-group col-md-12">
                                     <h1>Payment Getway</h1>
                                         
                                </div>
                                 <?php
                         $payment_getway =  get_sys_parameter('payment','PAYMENT_GETWAY');
                       $data = json_decode($payment_getway);
                        //  echo "<pre>";
                        // print_r($data);die;
                          ?>
                              <input type="hidden" name="id" value="">
                                
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Type Of Payment</label>
                                     <select class="form-control" id="" name="payment_type">
                                    <option value="">Select</option>
                                    <option value="Cashfree">Cashfree</option> 
                                    <option value="PayU">PayU</option> 
                                    <option value="Razorpay">Razorpay</option>  
                                    <option value="PayPal">PayPal</option>  
                                    <option value="PayKun">PayKun</option>  
                                   <option value="CCAvenue">CCAvenue</option>  
                                   <option value="Paytm">Paytm</option>  
                                                              
                                      
                                  </select>
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Api Key</label>
                                   <input type="text" class="form-control br_25  m-0 icon_left_input"  placeholder="Api Key" name="api_key" value="<?php if(!empty($data->api_key)){ echo $data->api_key; }?>">
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Secret key</label>
                                     <input type="text" maxlength="10" class="form-control br_25  m-0 icon_left_input" value="<?php if(!empty($data->secretkey)){ echo $data->secretkey;}?>" placeholder="Secret key" name="secretkey">
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Amount</label>
                                     <input type="number" maxlength="10" class="form-control br_25  m-0 icon_left_input" value="<?php  if(!empty($data->amount)){ echo $data->amount;}?>" placeholder="Amount" name="amount">
                                </div>

                                <!-- <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Key Id</label>
                                     <input type="text" maxlength="10" class="form-control br_25  m-0 icon_left_input" value="<?php if(!empty($data->keyid)){echo $data->keyid;}?>" placeholder="Key Id" name="keyid">
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Key Seprate</label>
                                     <input type="text" maxlength="10" class="form-control br_25  m-0 icon_left_input" value="<?php if(!empty($data->keyseprate)){echo $data->keyseprate;}?>" placeholder="Key Seprate" name="keyseprate">
                                </div> -->
                                
                            
                               
              
              
                <div class="row">
                  <div class="col-md-12 text-center">
                    <div class="ui buttons">
                     <button type="reset" class="ui button">Reset</button>
                     <div class="or"></div>
                    <button class="ui positive button">Save</button>
                    </div>
                  </div>
                </div>  
          </form>
          </div>
 

       
      </div>
     

     
      </div>

      <div class="tab-pane fade" id="experience" name="experience" role="tabpanel">
        <div class="bs-callout bs-callout-danger">
      
 
       <p>
       <div class="panel panel-default">
       <div class="panel-body">   
       <h2>Do You Want To Create a Portal For Enquiry ?  &nbsp;&nbsp;&nbsp;</h2>
   <input type="button" value="Yes"  id="button" name = "btnPassport" class="btn btn-default" />
<input type="button" value="No" id="button1" name = "btnPassport" class="btn btn-default" /></p>
<br>
<?php echo form_open_multipart('Crm_setting/stage','class="form-inner" id="payment_setting"') ?> 
<?php
     $portal_stage =  get_sys_parameter('portal_stage','STAGE');
  
     
    
      ?>
<div id="fn" hidden>
<label for="exampleFormControlTextarea1"> Portal For Enquiry  &nbsp;&nbsp;&nbsp;</label>
<?php
  if($portal_stage == 'enquiry')
  {
    ?>
    <label class="radio-inline">
      <input type="radio" name="portal" value="enquiry" checked>Enquiry
    </label>
  <?php
  }
  else
  {
    ?>
    <label class="radio-inline">
      <input type="radio" name="portal" value="enquiry">Enquiry
    </label>
    <?php
  }
   ?>
   <?php
  if($portal_stage == 'stage')
  {
  ?>
    <label class="radio-inline">
      <input type="radio" name="portal" value="stage" checked>Lead
    </label>
  <?php
  }
  else
  {
    ?>
    <label class="radio-inline">
      <input type="radio" name="portal" value="stage">Lead
    </label>
    <?php
  }
  ?>
 <?php
  if($portal_stage == 'client_stage')
  {
  ?>
    <label class="radio-inline">
      <input type="radio" name="portal" value="client_stage" checked>Client 
    </label>
  <?php
  }
  else
  {
    ?>
    <label class="radio-inline">
      <input type="radio" name="portal" value="client_stage">Client 
    </label></p>
    <?php
  }
  ?>
  
    <div class="col-md-12 text-center">
      <div class="ui buttons">
        <button type="reset" class="ui button">Reset</button>
        <div class="or"></div>
        <button class="ui positive button">Save</button>
      </div>
    </div>

</div>
</form>
</div>
</div>
  <div class="panel panel-default">
       <div class="panel-body"> 
  <?php echo form_open_multipart('Crm_setting/processrights','class="form-inner" id="payment_setting"') ?> 
<div class="row">
    <h2>Default User rights for Portal</h2>
             
    
           <?php
               $process_rights =  get_sys_parameter('process_rights','RIGHT_OF_PORTAL');
             $process_right = json_decode($process_rights);
              // //  echo "<pre>";
              // print_r($process_right->process);die;
                ?>
        <div class="form-group col-md-4">
        <select class="form-control" id="" name="process">
          <option value="">Process</option>
          <?php
          foreach ($product_list as $value) { 
            
         ?>

          
          <option value="<?php echo $value->product_name; ?>"><?php echo $value->product_name; ?></option>
          
         <?php } ?> 

             
        </select>
        </div>
        <div class="form-group col-md-4">
          <select class="form-control" id="" name="user_right">
            <option value="">User Rights</option>
           <?php
          foreach ($user_list as $users) { 
         ?>

        <option value="<?php echo $users['user_role']; ?>"><?php echo $users['user_role']; ?></option>
          
         
         <?php } ?> 

             
          </select>
        </div>
         <div class="form-group col-md-6">
          
            &nbsp;
        </div>


    </div>
     <div class="row">
      <div class="col-md-12 text-center">
        <div class="ui buttons">
         <button type="reset" class="ui button">Reset</button>
         <div class="or"></div>
        <button class="ui positive button">Save</button>
        </div>
      </div>
    </div>  <br>
</form>
</div>
</div>
<div class="panel panel-default">
       <div class="panel-body"> 
  <?php echo form_open_multipart('Crm_setting/enquiry_setting','class="form-inner" id="payment_setting"') ?> 
   <?php
         $enquiry_setting =  get_sys_parameter('enquiry','ENQUIRY_SETTING');
       $enquiry_setting = json_decode($enquiry_setting);
        //  echo "<pre>";
        // print_r($enquiry_setting);die;
          ?>
<div class="row">
    <h2>Enquiry ID Setting</h2>
             
        
       <div class="form-group col-md-3">
            <label for="exampleFormControlTextarea1">Prefix</label>
           <input type="text" class="form-control br_25  m-0 icon_left_input" value="<?php if(!empty($enquiry_setting->prefix)){echo $enquiry_setting->prefix;}?>" placeholder="Prefix" name="prefix" >
        </div>
        <div class="form-group col-md-3">
            <label for="exampleFormControlTextarea1">Postfix</label>
           <input type="text" class="form-control br_25  m-0 icon_left_input" value="<?php if(!empty($enquiry_setting->postfix)){echo $enquiry_setting->postfix;}?>" placeholder="Postfix" name="postfix" >
        </div>
        <div class="form-group col-md-3">
            <label for="exampleFormControlTextarea1">Digit</label>
           <input type="number" class="form-control br_25  m-0 icon_left_input" value="<?php if(!empty($enquiry_setting->digit)){echo $enquiry_setting->digit;}?>" placeholder="Digit" name="digit" >
        </div>


     
    </div><br><br>

     <div class="row">
      <div class="col-md-12 text-center">
        <div class="ui buttons">
         <button type="reset" class="ui button">Reset</button>
         <div class="or"></div>
        <button class="ui positive button">Save</button>
        </div>
      </div>
    </div> 
    </form>
  </div>
</div>
    <div class="panel panel-default">
       <div class="panel-body"> 
 <h2>Do You Want To Present Data Duplicates  &nbsp;&nbsp;&nbsp;</h2>
  <?php
     $duplicates =  get_sys_parameter('dublicate','DUBLICATES');
   $duplicate = json_decode($duplicates);

      ?>
 <?php echo form_open_multipart('Crm_setting/duplicates','class="form-inner" id="payment_setting"') ?>   <div class="custom-control custom-checkbox">
 <?php
 if(!empty($duplicate)){
 if($duplicate->email == 'email'  || $duplicate->email =='null')
 {
 ?>
  <input type="checkbox" name="email"  value="email" class="custom-control-input" id="defaultUnchecked" checked>
  <label class="custom-control-label" for="defaultUnchecked">Email</label><br>
  <?php
   }
   else
 {
  ?>
  <input type="checkbox" name="email"  value="email" class="custom-control-input" id="defaultUnchecked">
    <label class="custom-control-label" for="defaultUnchecked">Email</label><br>
  <?php
   }
  
    
 if($duplicate->phone == 'phone' || $duplicate->phone =='null')
 {
 ?>
  <input type="checkbox" name="phone"  value="phone" class="custom-control-input" id="defaultUnchecked" checked>
    <label class="custom-control-label" for="defaultUnchecked">Phone</label><br>
  <?php
  }
  else
  {
    ?>
    <input type="checkbox" name="phone"  value="phone" class="custom-control-input" id="defaultUnchecked">
      <label class="custom-control-label" for="defaultUnchecked">Phone</label><br>
    <?php
  }
    if($duplicate->company_name == 'company_name' || $duplicate->company_name =='null')
   {
   ?>
    <input type="checkbox"  name="company_name"  value="company_name" class="custom-control-input" id="defaultUnchecked" checked>
    <label class="custom-control-label" for="defaultUnchecked">Company Nmae</label><br>
    <?php
  } 
  else
   {
    ?>
      <input type="checkbox"  name="company_name"  value="company_name" class="custom-control-input" id="defaultUnchecked">
        <label class="custom-control-label" for="defaultUnchecked">Company Nmae</label><br>
    <?php
    }
    
   
    
    
   if($duplicate->optradio == 'globle' || $duplicate->optradio =='null')
   {
   ?>
    <label class="radio-inline">
      <input type="radio" name="optradio" value="globle" checked>Globle
    </label>
  
    <?php
    }
    else
    {

     ?>
    <label class="radio-inline">
      <input type="radio" name="optradio" value="globle">Globle
    </label>
    <?php
    }
    if($duplicate->optradio == 'process' || $duplicate->optradio =='null')
     {
     ?>
    <label class="radio-inline">
      <input type="radio" name="optradio" value="process" checked>Process
    </label>
    
    <?php
  }
  else
    {
    ?>
     <label class="radio-inline">
      <input type="radio" name="optradio" value="process">Process
    </label>
    <?php
    } }?>
     <br><br>       
      <div class="ui buttons">
       <button type="reset" class="ui button">Reset</button>
       <div class="or"></div>
      <button class="ui positive button">Save</button>

    </div>
  
  </form>
</div>
</div>
</div></p>
<br><br> 
      </div>



      <div class="tab-pane fade" id="schools" name="schools" role="tabpanel">
         <div class="bs-callout bs-callout-danger">
     
    </div>
      </div>
    </div>
</div>


<!-- <script type="text/javascript">
    $(function () {
        $("input[name=btnPassport]").click(function () {
            if ($(this).val() == "Yes") {
                $("#dvPassport").show();
            } else {
                $("#dvPassport").hide();
            }
        });
    });
</script> -->

<script type="text/javascript">
  $("#button").click(function() {
  $("#fn").show();
 
})
   $("#button1").click(function() {
 
   $("#fn").hide();
  
})
</script>