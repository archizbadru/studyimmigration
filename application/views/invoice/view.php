
<style type="text/css">   
/*.content{
  min-height: unset !important;
}*/
.invoice {
    background: #fff;
    padding: 20px
}

.invoice-company {
    font-size: 20px
}

.invoice-header {
    margin: 0 -20px;
    background: #0eadeb;
    padding: 20px
}

.invoice-date,
.invoice-from,
.invoice-to {
    display: table-cell;
    width: 1%
}

.invoice-from,
.invoice-to {
    padding-right: 20px
}

.invoice-date .date,
.invoice-from strong,
.invoice-to strong {
    font-size: 16px;
    font-weight: 600
}

.invoice-date {
    text-align: right;
    padding-left: 20px
}

.invoice-price {
    background: #f0f3f4;
    display: table;
    width: 100%
}

.invoice-price .invoice-price-left,
.invoice-price .invoice-price-right {
    display: table-cell;
    padding: 20px;
    font-size: 20px;
    font-weight: 600;
    width: 75%;
    position: relative;
    vertical-align: middle
}

.invoice-price .invoice-price-left .sub-price {
    display: table-cell;
    vertical-align: middle;
    padding: 0 20px
}

.invoice-price small {
    font-size: 12px;
    font-weight: 400;
    display: block
}

.invoice-price .invoice-price-row {
    display: table;
    float: left
}

.invoice-price .invoice-price-right {
    width: 25%;
    background: #2d353c;
    color: #fff;
    font-size: 28px;
    text-align: right;
    vertical-align: bottom;
    font-weight: 300
}

.invoice-price .invoice-price-right small {
    display: block;
    opacity: .6;
    position: absolute;
    top: 10px;
    left: 10px;
    font-size: 12px
}

.invoice-footer {
    border-top: 1px solid #ddd;
    padding-top: 10px;
    font-size: 10px
}

.invoice-note {
    /*color: #999;*/
    margin-top: 80px;
    font-size: 85%
}

.invoice>div:not(.invoice-footer) {
    margin-bottom: 20px
}

.btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
    color: #2d353c;
    background: #fff;
    border-color: #d9dfe3;
}

</style>


  <div class="col-md-1"></div>
   <div class="col-md-9 card" style="border: 1px grey;">
      <div class="invoice">
         <!-- begin invoice-company -->
         <div class="invoice-company text-inverse f-w-600">
            <span class="pull-right hidden-print">            
            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
            </span>
            <?=$company_row['a_companyname']?>
         </div>
         <!-- end invoice-company -->         
         <!-- begin invoice-header -->
         <div class="invoice-header">
            <div class="invoice-from" >
               <label>From</label>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse"><?=$company_row['a_companyname']?></strong><br>
                  <?=$company_row['a_companyaddress']?><br>
                  <!-- <?=$company_row['a_companyname']?>, <?=$company_row['a_companyname']?><br> -->
                  Phone: <?=$company_row['mobile']?><br>                  
               </address>
            </div>
            <div class="invoice-to">
               <label>To</label>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse"><?=$enquiry_row['company']?></strong><br>
                  <?=$enquiry_row['address']?><br>
                  <?=$enquiry_row['city_id']?>,<br>
                  Phone: <?=$enquiry_row['phone']?><br>                  
               </address>
            </div>
            <div class="invoice-date">
               <small>Invoice / July period</small>
               <div class="date text-inverse m-t-5"><?=$invoice['invoice_date']?></div>
               <div class="invoice-detail">
                  #<?=$invoice['invoice_code']?><br>
                  Services Product
               </div>
            </div>
         </div>
         <!-- end invoice-header -->
         <!-- begin invoice-content -->
         <div class="invoice-content">
            <!-- begin table-responsive -->
            <div class="table-responsive">
               <table class="table table-invoice">
                    <thead>
                      <tr>                                                          
                        <th>Product</th>                 
                        <th>Rate</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Disc (%)</th> 
                        <th>GST (%)</th>                
                        <th>Net</th>                
                        <th></th>                                                   
                      </tr>
                      </thead>             
                    <tbody>      
                     <?php
                     if (!empty($invoice_products)) {
                      foreach ($invoice_products as $key => $value) { ?>
                       <tr>
                            <td><?=$value['country_name']?></td>             
                            <td><?=$value['rate']?> inr</td>             
                            <td><?=$value['qty']?></td>             
                            <td><?=$value['total']?> inr</td>             
                            <td><?=$value['discount']?>%</td>             
                            <td><?=$value['gst']?>%</td>             
                            <td><?=$value['net_payable']?> inr</td>             
                       </tr>                        
                       <?php
                      }                      
                     }
                     ?>                        
                  </tbody>
               </table>
            </div>
            <!-- end table-responsive -->
            <!-- begin invoice-price -->
            <div class="invoice-price">
               <div class="col-md-4" style="padding-left: 50px;padding-right: 50px;float:right; ">
                <center style="width: 100%;border: 1px dashed #2e2e2e;">
                  <table class="table" style="margin-bottom: 0px !important;">
                    <tbody>
                      <tr>
                        <td><b>Total Amount</b></td>
                        <td><span id="total" class="amount"><?=$invoice['total_amount']?> inr</span></td>
                      </tr>
                      <tr>
                        <td><b>Total Discount</b></td>
                        <td><span id="discount" class="amount"><?=$invoice['total_discount_amount']?> inr</span></td>
                      </tr>
                      <tr>
                        <td><b>GST</b></td>
                        <td><span id="GST" class="amount"><?=$invoice['total_gst_amount']?></span> inr</td>
                      </tr>                      
                      <tr style="background: aqua;">
                        <td><b>Net Amount</b></td>
                        <td><span id="net" class="amount"><?=$invoice['net_payable']?></span> inr</td>
                      </tr>
                    </tbody>
                  </table>
                </center>                                 
              </div>               
            </div>
            <!-- end invoice-price -->
         </div>
         <!-- end invoice-content -->
         <!-- begin invoice-note -->
         <div class="invoice-note">
            * Make all cheques payable to <?=$company_row['a_companyname']?><br>
            * Payment is due within 30 days<br>
            * If you have any questions concerning this invoice, contact  [<?=$company_row['a_companyname']?>, <?=$company_row['mobile']?>, <?=$company_row['email']?>]
         </div>
         <!-- end invoice-note -->
         <!-- begin invoice-footer -->
         <div class="invoice-footer">
            <p class="text-center m-b-5 f-w-600">
               THANK YOU FOR YOUR BUSINESS
            </p>
            <p class="text-center" style="display: none;">
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> matiasgallipoli.com</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:016-18192302</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> rtiemps@gmail.com</span>
            </p>
         </div>
         <!-- end invoice-footer -->
       </div>
      </div>
    