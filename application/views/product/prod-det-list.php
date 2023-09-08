<div class="row">

   <!--  table area -->

   <div class="col-sm-12">

      <div  class="panel panel-default thumbnail">

         <div class="panel-heading no-print">
          <?php if (user_access(470)) { ?>            
            <div class="btn-group"> 

               <a class="btn btn-success" href = "<?php echo base_url("product/addproduct"); ?>" ><i class="fa fa-plus"></i> <?php echo display('Add_More') ?></a> 

            </div>
            <?php
          } 
          ?>
         </div>

         <div class="panel-body">

            <div class="row m-t-20"><?php if($this->session->error!=''){ ?>

               <button  class='btn btn-danger text-left'><?php echo $this->session->error; ?></button>

               <?php } ?>

               <?php if($this->session->success!=''){ ?>

               <button  class='btn  btn-success left'><?php echo $this->session->success; ?></button>

               <?php } ?>

            </div>

            <table class="datatable1 table table-striped table-bordered mobile-optimised" cellspacing="0" width="100%">

               <thead>

                  <tr role="row">

                     <th class=" wid-20" tabindex="0" rowspan="1" colspan="1">

                        <input type='checkbox' class="checked_all" value="check all" >&nbsp; 

                     </th>

                     <th class="sorting wid-10" style="border-left:none;">S.N </th>
					 
                     <th>Product Id</th>
                     <th>Product Name</th>
					           <th>Price</th>
                     <th>Stock</th>
                     <th>Minimum Order Quantity</th>
                     <th>Seller</th>
                     <th>Seller Mobile</th>
                     <th>Status</th> 
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $c=1; foreach($product_list as $i => $row){ ?>
                  <tr>
                     <td><input type='checkbox' name='product_status[]' class="checkbox" value='<?php echo $row->id;?>'>
                     </td>
                     <td data-th='S.N'><?=$c++?></td>
                     <td data-th='Product Id'><?= $row->id; ?></td>
                     <td data-th='Product Name'><?= $row->country_name; ?></td>
                     <td data-th='Price'> <i class = "fa fa-rupee"></i> <?php echo $row->price; ?></td>
            				 <td data-th='Stock'><?php
                     if ($row->stock_qty < 25) {
                      if ($row->stock_qty == NULL) {
                        echo "<a class='badge badge-danger' style='background:red;'>No Stock Found!</a>";                        
                      }else{
                        echo "<a class='badge badge-danger' style='background:orange;'>$row->stock_qty
                      </a>";
                      }
                     }else{
                        echo "<a class='badge badge-success' style='background:green;'>$row->stock_qty
                      </a>";                                                                    
                     }
                     ?></td>
                     <td data-th='Minimum Order Quantity'><?=$row->minimum_order_quantity?></td>                     
                     <td data-th='Seller'><a href="<?=base_url().'client/view/'.$row->enquiry_id?>"><?=($row->seller!='')?$row->seller:'NA'?></a></td>
            				 <td data-th='Seller Mobile'><a href="tel:<?=$row->seller_phone?>"><?=$row->seller_phone?></a></td>
            				 <td data-th='Status'> 
                      <?php                      
                      if (!empty($row->status)) {
                        if ($row->status == 1) {
                          echo "Active";
                        }else if ($row->status == 2){
                          echo "Inactive";
                        }
                      }
                      ?>
                     </td>
                     <td class="center" data-th='Actions'>
                      <?php if (user_access(471)) { ?>
                        <a  class="edit btn btn-xs btn-primary" href = "<?php echo base_url("product/editproduct/".$row->id); ?>"><i class="ti-pencil"></i></a>
                      <?php
                      }
                      ?>
                     </td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
            <?php
            if (user_access(472)) { ?>            
              <button class="btn btn-danger" type="button" onclick="delete_product()">
              <i class="ti-trash"></i>
                Delete
              </button>
            <?php
            }
            ?>
            </form>

         </div>

      </div>

   </div>

</div>

<!----- Add switch box modal -------->

<!-- Modal -->

<div class="modal fade" id="myModal"  role="dialog">

   <div class="modal-dialog">

      <!-- Modal content-->

      <div class="modal-content">

         <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Add Product</h4>

         </div>

         <div class="modal-body">

            <form method="POST" action="<?php echo base_url('dash/add_product')?>">

               <div class="row">

                  <div class="form-group col-md-12">

                     <label>Product Name</label>

                     <input type="text" class="form-control" name="product_name" required>

                  </div>

               </div>

               <div class="row">

                  <div class="form-group col-md-6">

                     <button class="btn btn-success" type="submit">Submit</button>

                  </div>

               </div>

            </form>

         </div>

         <div class="modal-footer">

         </div>

      </div>

   </div>

</div>

<!----------------------------------->       

<script type="text/javascript">

   $('.checked_all').on('change', function() {     

           $('.checkbox').prop('checked', $(this).prop("checked"));              

   });

   $('.checkbox').change(function(){ 

       if($('.checkbox:checked').length == $('.checkbox').length){

              $('.checked_all').prop('checked',true);

       }else{

              $('.checked_all').prop('checked',false);

       }

   });

   

</script>

<script>

   function delete_product(){

     var x=  confirm('Are you sure delete this Records ? ');

    if(x==true){   

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>deactive_product',

   data: $('#login').serialize()

   })

   .done(function(data){

   if(data==1){	

       alert( "Delete successfully" );

       window.location.href = '<?php echo base_url()?>dash/product_list';

       

   }else{

   alert( "Delete Unsuccessful" );

   window.location.href = '<?php echo base_url()?>dash/product_list';

   }

   })

   .fail(function() {

   alert( "fail!" );

   

   });

   }else{

        location.reload(); 

   }}

</script>

<script>

   function delete_switches(){       

      var ids = [];      

     $('input[name^="user_status[]"]').each(function() {          

          ids.push($(this).val());

      });

      if(confirm("Are you sure want to delete...")){          

         $.ajax({             

             url : '<?php echo base_url('dash/delete_switch_box')?>',

             type: 'POST',

             data: {ids:ids},

             success:function(data){                 

                 alert("Deleted successfully");

                 location.reload();

             }

         });

      }   

   }

</script>