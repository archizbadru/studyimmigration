<div class="row">
   <!--  table area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">

         <div class="panel-body">
            <table class="datatable1 table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                  <tr>
                     <th><?php echo display('serial') ?></th>                     
                     <th>Name</th>
                     <th>Total Quantity</th>
                     <th>Used Quantity</th>
                     <th>Price</th>
                     <th>Total Amount</th>
                     <th>Created By</th>
                     <th>Created Date</th>
                     <th>Expiry Date</th>
                                         
                  </tr>
               </thead>
               <tbody id="tBody">               
                  
               </tbody>
            </table>
            <!-- /.table-responsive -->
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(function(){
        url = "<?=base_url().'api/whatsapp/get_report/'?>"+"<?=$type?>";     
        $.ajax({
          type: "GET",
          url: url,      
          success: function(data){  
            let trHTML = ''              
            if(data.status){
               $.each(data.message, function (i, userData) {
                            trHTML +=`
                                    <tr>
                                        <td>${i+1}</td>
                                        <td>${userData.comp_admin_name}</td>
                                        <td>${userData.qty}</td>
                                        <td>${userData.qty_used}</td>
                                        <td>${userData.price}</td>
                                        <td>${userData.total_amt}</td>
                                        <td>${userData.created_by_name}</td>
                                        <td>${userData.created_date}</td>
                                        <td>${userData.expiry_date}</td>
                                    </tr>
                                 `
                        });
                        $('#tBody').html(trHTML);
            }
          }
        });
   }); 
</script>