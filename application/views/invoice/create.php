<script src="<?=base_url()?>/assets/summernote/summernote-bs4.min.js"></script>
<link href="<?=base_url()?>/assets/summernote/summernote-bs4.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

<style type="text/css">
  .amount{
    font-weight: bold;
  }
</style>
    <br>
    <div class="col-sm-1">
      
    </div>
    <div class="col-sm-10">
      <div  class="panel panel-default thumbnail">
        <div class="panel-heading no-print">
         <div class="btn-group"> 
            <a class="btn btn-primary" href="<?=base_url().'invoice/invoice'?>"> <i class="fa fa-list"></i>&nbsp;Invoice List</a>  
         </div>
      </div>
      <div class="panel-body panel-form" id="app">         
          <form class="form-inner" method="POST" v-on:submit.prevent="saveInvoice">
             <div id="error" class='btn btn-danger form-group col-sm-12'style="display:none;text-align:left"></div>
             <input type="hidden" name="id" value="<?php echo !empty($invoice)?$invoice['id']:'' ?>">
             <div id="success" class='btn btn-success form-group col-sm-12' style="display:none;text-align:left"></div>
             <div class="row">
                <div class="form-group col-sm-4"> 
                   <label>Invoice Id <i class="text-danger"></i></label>
                   <input class="form-control" value="<?php echo !empty($invoice)?$invoice['invoice_code']:'' ?>" name="invoice_id" type="text" placeholder="Invoice Id" required>  
                </div>
                <div class="form-group col-sm-4">
                   <label>Related To <i class="text-danger"></i></label>
                   <select name="related_to" id="related_to" class="form-control" @change="related_to_change()" required >
                      <option value="">---Select---</option>
                      <option value="1" <?php echo !empty($invoice)?(($invoice['related_to'] == 1)?'selected':''):'' ?>>Enquiry</option>
                      <option value="2" <?php echo !empty($invoice)?(($invoice['related_to'] == 2)?'selected':''):'' ?>>Lead</option>
                      <option value="3" <?php echo !empty($invoice)?(($invoice['related_to'] == 3)?'selected':''):'' ?>>Client</option>
                   </select>
                </div>
                <div class="form-group col-sm-4">
                   <label>Enquiry <i class="text-danger"></i></label>
                   <select name="enquiry_code" class="form-control" required>
                      <option value="">---Select---</option>
                      <?php
                      if (!empty($related_to_list)) {
                        foreach ($related_to_list as $key => $value) {
                          ?>
                          <option value="<?=$value['Enquery_id']?>" <?php echo !empty($invoice)?(($invoice['enquiry_code'] == $value['Enquery_id'])?'selected':''):'' ?> ><?=$value['name_prefix'].' '.$value['name'].' '.$value['lastname']?></option>
                          <?php
                        }
                      }
                      ?>                      
                   </select>
                </div>
                <div class="form-group col-sm-4"> 
                   <label>Invoice Date <i class="text-danger">*</i></label>
                   <input class="form-control" value="<?php echo !empty($invoice)?$invoice['invoice_date']:'' ?>" name="invoice_date" type="date" required>
                </div>
                <div class="form-group col-sm-4"> 
                   <label>Due Date <i class="text-danger">*</i></label>
                   <input class="form-control" value="<?php echo !empty($invoice)?$invoice['invoice_date']:'' ?>" name="due_date" type="date" required>
                </div>

                <div class="form-group col-sm-12"> 
                   <label>Note </label>
                    <textarea class="form-control summernote" name="description" rows="12"><?php echo !empty($invoice)?$invoice['note']:'' ?></textarea>
                </div>
             <div id="">
                  <!-- VueJs app will mounted here-->
                  <table class="table">
                    <tbody>
                      <tr>                                  
                        <th></th>                 
                        <th width="15%">Product</th>                 
                        <th>Rate</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Disc (%)</th> 
                        <th>GST (%)</th>                
                        <th>Net</th>                
                        <th></th>                                                   
                      </tr>             
                    </tbody>                      
                    <tr v-for="(invoice_product, k) in invoice_products" :key="k">

                      <td scope="row" class="trashIconContainer">
                          <i class="fa fa-trash btn btn-danger" v-if="k>0" @click="deleteRow(k, invoice_product)"></i>
                      </td>
                      <td>
                          <select v-model="invoice_product.id" class="form-control" name="item" @change="calculateTotal($event.target.selectedIndex,invoice_product)" required>                            
                              <option v-for="(item , index) in items" :value="item.id"  :data-price="item.price">
                                  {{ item.country_name }}
                              </option>
                          </select>                          
                      </td>
                      <td>
                          <input class="form-control" type="number" v-model="invoice_product.rate" name="rate" readonly />
                      </td>
                      <td>
                          <input class="form-control" type="number" v-model="invoice_product.qty" name="qty" @change="calculateTotalOf_qty($event.target.value,invoice_product)" min="1" max="10" />
                      </td>
                      <td>
                          <input class="form-control text-right" type="number" min="0" step=".01" name="total" v-model="invoice_product.total" 
                            readonly />
                      </td>
                      <td>
                          <input class="form-control text-right" type="number" min="0" step=".01" v-model="invoice_product.disc" 
                           name="disc" @change="calculateTotalOf_disc($event.target.value,invoice_product)"/>
                      </td>
                      <td>
                          <input readonly class="form-control text-right" type="number" min="0" step=".01" v-model="invoice_product.gst" name="gst" readonly min="0" />
                      </td>
                      <td>
                          <input readonly class="form-control text-right" type="number" min="0" step=".01" v-model="invoice_product.net_total" name="net_total" readonly min="0"/>
                      </td> 
                  </tr>
                </table>
                 <button type='button' class="btn btn-primary" @click="addNewRow">
                  <i class="fa fa-plus"></i>
                  Add
              </button> 

              <div class="col-md-4" style="padding-left: 50px;padding-right: 50px;padding-top: 10px;overflow: auto;float:right; ">
                <br>
                <center style="width: 100%;border: 1px dashed #2e2e2e;">
                  <table class="table" style="margin-bottom: 0px !important;">
                    <tbody><tr>
                        <td><b>Total Amount</b></td>
                        <td><span id="total" class="amount">{{ invoice_total }}</span></td>
                      </tr>
                      <tr>
                        <td><b>Total Discount</b></td>
                        <td><span id="discount" class="amount">{{ invoice_disc }}</span></td>
                      </tr>
                      <tr>
                        <td><b>GST</b></td>
                        <td><span id="GST" class="amount">{{ invoice_gst }}</span></td>
                      </tr>                      
                      <tr style="background: aqua;">
                        <td><b>Net Amount</b></td>
                        <td><span id="net" class="amount">{{ invoice_net_total }}</span></td>
                      </tr>
                    </tbody>
                  </table>
                </center>                                 
              </div>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <div class="col-md-4">
            	<button type="submit" class="btn btn-success btn-lg">Save Invoice</button>              	
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php
    if(!empty($invoice_items)){
      $items_products = json_encode($invoice_items);
    }else{
      $items_products = json_encode(array(array(
              'rate'=> 0,
              'qty'=> 1,            
              'total'=> 0,
              'disc'=> 0,
              'gst'=> 0,
              'net_total'=> 0
          )));      
    }
    ?>
<script>
  var app = new Vue({
    el: "#app",
    data: {
        items:<?php echo json_encode($items); ?>,
        invoice_total: <?php echo !empty($invoice)?$invoice['total_amount']:0 ?>,
        invoice_disc: <?php echo !empty($invoice)?$invoice['total_discount_amount']:0 ?>,
        invoice_gst: <?php echo !empty($invoice)?$invoice['total_gst_amount']:0 ?>,
        invoice_net_total: <?php echo !empty($invoice)?$invoice['net_payable']:0 ?>,        
        invoice_products: <?=$items_products?>
    },
    
    methods: {
        saveInvoice(event) {        
        	items 			= this.invoice_products;
        	total_amount 	= this.invoice_total;
        	disc_amount 	= this.invoice_disc;
        	gst_amount 		= this.invoice_gst;
        	net_amount 		= this.invoice_net_total;

          id            = $("input[name='id']").val();
        	invoice_id		=	$("input[name='invoice_id']").val();
        	related_to		=	$("select[name='related_to']").val();
        	enquiry_code	=	$("select[name='enquiry_code']").val();
        	invoice_date	=	$("input[name='invoice_date']").val();
        	due_date		  =	$("input[name='due_date']").val();
        	note			    =	$("textarea[name='description']").val();


        	data = {
        		'items':items,
        		'total_amount':total_amount,
    				'disc_amount':disc_amount,
    				'gst_amount':gst_amount,
    				'net_amount':net_amount,
            'invoice_id':invoice_id,
    				'id':id,
    				'related_to':related_to,
    				'enquiry_code':enquiry_code,
    				'note':note,
    				'invoice_date':invoice_date,
    				'due_date':due_date
        	}
        	url = "<?=base_url().'invoice/invoice/saveInvoice'?>"
        	$.ajax({
	           	type: "POST",
	           	url: url,
	           	data: data, // serializes the form's elements.
	           	success: function(data){
	           		data = JSON.parse(data);
	            	//alert(data); // show response from the php script.
	            	if (data.status == true) {
	            		alert(data.msg);
	            		window.location = "<?=base_url().'invoice/invoice'?>";
	            	}else{
	            		alert('Something went wrong!');
	            	}
	           	}
	        });

            //console.log(JSON.stringify(this.invoice_products));

        },
        related_to_change(){
            related_to  = $("#related_to").val();
            url = "<?=base_url().'invoice/invoice/get_related_to_list'?>"
            $.ajax({
              type: "POST",
              url: url,
              data: {'related_to':related_to},
              success: function(data){                
                $("select[name='enquiry_code']").html(data);
              }
            });

        },
        calculateLineTotal() {
            var subtotal, total;
            
            total = this.invoice_products.reduce(function (sum, product) {
                var total = parseFloat(product.total);
                if (!isNaN(total)) {
                    return sum + total;
                }

            }, 0);

            this.invoice_total = total.toFixed(2);


            total = this.invoice_products.reduce(function (sum, product) {
                var total = parseFloat(product.net_total);
                if (!isNaN(total)) {
                    return sum + total;
                }

            }, 0);

            this.invoice_net_total = total.toFixed(2);


            total = this.invoice_products.reduce(function (sum, product) {
            	var disc	=	parseFloat(product.total * product.disc/100);                 
                if (!isNaN(disc)) {
                    return sum + disc;
                }

            }, 0);

            this.invoice_disc = total.toFixed(2);



            total = this.invoice_products.reduce(function (sum, product) {
            	var gst	=	parseFloat(product.total * product.gst/100);                 
                if (!isNaN(gst)) {
                    return sum + gst;
                }

            }, 0);

            this.invoice_gst = total.toFixed(2);


            /*net_total = (subtotal * (this.invoice_tax / 100)) + subtotal;
            
            total = parseFloat(total);
            if (!isNaN(total)) {
                this.invoice_total = total.toFixed(2);
            } else {
                this.invoice_total = '0.00'
            }*/
        },
        calculateTotal(index,invoice_product) {
          	invoice_product.rate  = this.items[index].price;
          	invoice_product.total  = invoice_product.rate*invoice_product.qty;                	
	    	discounted_price = invoice_product.total - (invoice_product.total * invoice_product.disc/100);        	
	    	net_total = discounted_price + (invoice_product.total * invoice_product.gst/100);
	      	invoice_product.net_total  = net_total.toFixed(2);	        	        
	      	this.calculateLineTotal();
        },
        calculateTotalOf_qty(qty,invoice_product) {                    	
          	invoice_product.total  = invoice_product.rate*qty;	                	
        	discounted_price = invoice_product.total - (invoice_product.total * invoice_product.disc/100);        	
        	net_total = discounted_price + (invoice_product.total * invoice_product.gst/100);        	
          	invoice_product.net_total  = net_total.toFixed(2);	        	        	        
	      	this.calculateLineTotal();

        },
        calculateTotalOf_disc(disc,invoice_product) {          
        	discounted_price = invoice_product.total - (invoice_product.total * invoice_product.disc/100);        	        	
        	net_total = discounted_price + (invoice_product.total * invoice_product.gst/100);        	
          	invoice_product.net_total  = net_total.toFixed(2);	        	        	        
	      	this.calculateLineTotal();

        },
        deleteRow(index, invoice_product) {
            var idx = this.invoice_products.indexOf(invoice_product);
            
            if (idx > -1) {
                this.invoice_products.splice(idx, 1);
            }
	      	this.calculateLineTotal();            
        },
        addNewRow() {
        	if(this.invoice_products[this.invoice_products.length-1].rate){
	            this.invoice_products.push({                
	                rate: 0,
	                qty: 1,            
	                total: 0,
	                disc: 0,
	                gst: 0,
	                net_total: 0
	            });

        	}else{
        		alert('Please Select the product.');
        	}
        }
    }
}); 

  $(document).ready(function(){
      $(".addCF").click(function(){        
        $("#table_id1").append(
          '<tr><td>'+result[1]+'<input type="hidden" class="add_admount" value="'+amount+'"></td><td>'+rate+'</td><td>'+qty+'</td><td>'+totalamnt+'</td><td>'+disc+'</td><td>'+gst+'</td><td>'+amount+'</td><td><a href="javascript:void(0);" class="remCF btn btn-danger">X</a></td></tr>');
       
      });
      
      $("#table_id1").on('click','.remCF',function(){
        $(this).parent().parent().remove();
        calculate_gst();
      });
  }); 
  
  function getRate(id){
    var res = id.replace("/", "_");
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>client/get_item_cost/'+res,
    })
    .done(function(data){
      $('#rate').val(data);
      calculate_price();
    })
    .fail(function() {
      alert( "fail!" );
    });
  }

  function calculate_price(){
    var rate=$('#rate').val();
    var qty=$('#qty').val();
    var t=rate*qty;
    $('#totalamnt').val(t);
    $('#amount').val(t);
    var disc=$('#disc').val();
    var gst=$('#gst').val();
    var totalamnt=$('#amount').val();
    var d=totalamnt-(totalamnt*disc/100);
    $('#amount').val(d);
    var totalamnt1=$('#amount').val();
    var g=parseInt(totalamnt1)+parseInt((totalamnt1*gst/100));
    $('#amount').val(g);
  }
   
  function calculate_gst(){
    var sum = 0
    $('.add_admount').each(function(){
     sum += parseFloat(this.value);
    });
    $('#total').html(sum);
  }
  jQuery(document).ready(function(){
    $('.summernote').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false                 // set focus to editable area after initializing summernote
    });
  }); 
 </script>