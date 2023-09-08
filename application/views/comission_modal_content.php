<div class="card card-body">
  <?php echo form_open_multipart('enquiry/add_enquery_comission/'.base64_encode($Enquiry_id),array('class'=>"form-inner",'id'=>'update_comission_form')) ?>        
  <input type="hidden" name="enq_com_id" value="<?=$comission_data['id']?>">              
    <div class="row">                                          
     <div class="form-group col-sm-4"> 
        <label>Amount Disbursed</label>
        <input class="form-control" name="amtdisb" type="text" placeholder="Application Url" value="<?=$comission_data['amt_disb']?>">  
     </div>

     <div class="form-group col-sm-4"> 
        <label>Comission </label>
        <input class="form-control" name="comission" type="text" placeholder="Major" value="<?=$comission_data['comission']?>">  
     </div>
      <div class="form-group col-sm-4"> 
        <label>Amount Earned</label>
        <input class="form-control" name="amtearned" type="text" placeholder="Username" value="<?=$comission_data['amt_earned']?>">  
     </div>
    </div>
    <div class="row">                                          
    
                                             
     <div class="form-group col-sm-4"> 
        <label>TDS</label>
        <input class="form-control" name="tds" type="text" placeholder="TDS" value="<?=$comission_data['tds']?>">  
     </div>

     <div class="form-group col-sm-4"> 
        <label>Amount Paid</label>                          
        <input type="text" name="amtpaid" class="form-control" value="<?=$comission_data['amt_paid']?>" >                      
     </div>
       <div class="form-group col-sm-4"> 
        <label>Payout Percentage </label>
        <input class="form-control" name="payoutper" type="text" placeholder="App Fee" value="<?=$comission_data['payout_per']?>">  
     </div>
   </div>
   <div class="row">
     <div class="form-group col-sm-4"> 
        <label>Month</label>
        <select class="form-control" name="month" required>
         <option value="">Select</option>
                            <option value="january" <?php if($comission_data['month']=='january'){?> selected <?php }?>>January</option>
                            <option value="february" <?php if($comission_data['month']=='february'){?> selected <?php }?>>February</option>
                            <option value="march" <?php if($comission_data['month']=='march'){?> selected <?php }?>>March</option>
                            <option value="april" <?php if($comission_data['month']=='april'){?> selected <?php }?>>April</option>
                            <option value="may" <?php if($comission_data['month']=='may'){?> selected <?php }?>>May</option>
                            <option value="june" <?php if($comission_data['month']=='june'){?> selected <?php }?>>June</option>
                            <option value="july" <?php if($comission_data['month']=='july'){?> selected <?php }?>>July</option>
                            <option value="august" <?php if($comission_data['month']=='august'){?> selected <?php }?>>August</option>
                            <option value="september" <?php if($comission_data['month']=='september'){?> selected <?php }?>>September</option>
                            <option value="october" <?php if($comission_data['month']=='october'){?> selected <?php }?>>October</option>
                            <option value="novmber" <?php if($comission_data['month']=='novmber'){?> selected <?php }?>>Novmber</option>
                            <option value="december" <?php if($comission_data['month']=='december'){?> selected <?php }?>>December</option>
                        </select>
     </div>
    </div>
                                    
     <br>
         <div class=""  id="save_button">                                                
            <div class="col-md-12">                                                
                  <button class="btn btn-primary" type="submit" >Save</button>            
            </div>
          </div>
     </form>
  </div>

  <script type="text/javascript">
    $("#update_comission_form").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
      $.ajax({
         type: "POST",
         url: url,
         data: form.serialize(), // serializes the form's elements.
         success: function(data)
         {              
            data = JSON.parse(data);
            alert(data.msg);
            if(data.status == true){
              window.location.reload();
            }
         }
       });
  });
  </script>