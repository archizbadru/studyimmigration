<style>
    .bg-white{background:#fff;}
</style>
<div class="row">
<div class="col-md-3" >
</div>
<div class="col-md-9 bg-white">
                           
                    
          <div class="col-md-12" style="padding-left: 50px;padding-right: 50px;padding-top: 10px;overflow: auto">
            <h3>Invoice</h3>
            <br>
            <span style="font-size:18px;"><b>sads</b></span><br><br><br><br>GSTIN : <br>            
          </div>
              <div class="col-md-6" style="padding-left: 50px;padding-right: 50px;padding-top: 10px;overflow: auto" >
                <br>
                <div class="form-group">
                  <label>Invoice Date</label>                       
                  <input class="form-control" id="Date"  name="Date" type="date" value="2019-06-22">
                </div>                            
              </div>
              <div class="col-md-6" style="padding-left: 50px;padding-right: 50px;padding-top: 10px;overflow: auto">
                <br>
                <div class="form-group">
                  <label>Due Date</label>                       
                  <input class="form-control" id="DueDate"  name="DueDate" type="date" value="2019-06-22">
                </div>
                <div class="form-group">
                  <label>Invoice No</label>                       
                  <input class="form-control" id="No"  name="No" type="text" value="Auto">
                </div>  
         </div>
        <hr>
          <div class="col-md-12" style="padding-left: 50px;padding-right: 50px;padding-top: 10px;overflow: auto">
            <table id="dataTable" class="table table-bordered table-responsive-sm table-striped table-sm" style="margin-top:0px;">
              <tbody><tr>                                  
                <th>Product</th>                 
                <th>Rate</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Disc (%)</th> 
                <th>GST (%)</th>                
                <th>Net</th>                
                <th></th>                                                   
              </tr>             
              </tbody><tbody id="table_id1" >
                <tr>                                  
                <td>
                    <select id="Product" name="Product" style="width:15vw" onchange="getRate(this.value)"> 
                      <option>Select Product</option> 
                      <?php foreach($all_item as $value){ ?>
                      <option value="<?php echo $value->itemlist_id;?>_<?php echo $value->item_name;  ?>"><?php echo $value->item_name;  ?></option>
                      <?php } ?>
                      </select>
                </td>               
                <td>
                  <input id="rate" style="width:5vw" name="rate" type="number" value="0" onkeyup="calculate_price()" >
                </td>
                <td>
                  <input id="qty" style="width:5vw" name="qty" type="number" value="1" onkeyup="calculate_price()">
                </td>
                <td>
                  <input id="totalamnt" style="width:5vw" name="totalamnt" type="number" value="0" readonly="">
                </td>
                <td>
                  <input id="disc" style="width:5vw" name="disc" type="number" value="0" onkeyup="calculate_price()">
                </td> 
                <td>
                  <input id="gst" style="width:5vw" name="gst" type="number" value="0" onkeyup="calculate_price()">
                </td>                
                <td>
                  <input id="amount" style="width:5vw" name="amount" type="text" value="0" readonly="">
                </td>                
                <td><button id="adBtn" class="btn btn-dark btn-sm addCF"  type="button">+</button></td>                                                  
              </tr>
              </tbody>
            </table>         
          </div>          
          <div class="col-md-4" style="padding-left: 50px;padding-right: 50px;padding-top: 10px;overflow: auto;float:right;">
            <br>
            <center>
              <table style="width: 100%;border: 1px dashed #2e2e2e;">
                <tbody><tr>
                  <td>Total Amount</td>
                  <td><span id="total">0</span></td>
                </tr>
                <tr>
                  <td>Total Discount</td>
                  <td><span id="discount">0</span></td>
                </tr>
                <tr><td>CGST</td><td><span id="CGST">0</span></td></tr><tr><td>SGST</td><td><span id="SGST">0</span></td></tr>                <tr>
                  <td>Net Amount</td>
                  <td><span id="net">0</span></td>
                </tr>
              </tbody></table>
            </center>                                 
          </div>
        <hr>
          <div class="col-md-12" style="padding-left: 50px;padding-top: 10px;padding-right: 50px;">
             <center>
               <button class="btn btn-success" onclick="processSave()" type="button">Save Invoice</button>              
                            <button class="btn btn-dark" onclick="processBack()" type="button">Back to Client</button>             </center> 
            <br>                  
          </div>                              
      </div>
      </div>
      
      <script>
             $(document).ready(function(){
	$(".addCF").click(function(){
	    var rate=$('#rate').val();
       var qty=$('#qty').val();
       var totalamnt=$('#totalamnt').val();
       var disc=$('#disc').val();
       var gst=$('#gst').val();
       var amount=$('#amount').val();
       var Product=$('#Product').val();
       var result = Product.split('_');
	    
		$("#table_id1").append('<tr><td>'+result[1]+'<input type="hidden" class="add_admount" value="'+amount+'"></td><td>'+rate+'</td><td>'+qty+'</td><td>'+totalamnt+'</td><td>'+disc+'</td><td>'+gst+'</td><td>'+amount+'</td><td><a href="javascript:void(0);" class="remCF btn btn-danger">X</a></td></tr>');
	 calculate_gst();
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
  
 </script>