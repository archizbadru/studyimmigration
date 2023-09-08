<div class="row">

   <!--  table area -->

   <div class="col-sm-12">

      <div  class="panel panel-default thumbnail">

         <div class="panel-heading no-print">

            <div class="btn-group"> 
				<a href = "javascript:void(0)" onclick="window.history.back()" class="btn btn-success"> Back </a>
              

            </div>

         </div>
 
         <div class="panel-body">

            <div class="row m-t-20"><?php if($this->session->error!=''){ ?>

               <button  class='btn btn-danger text-left'><?php echo $this->session->error; ?></button>

               <?php } ?>

               <?php if($this->session->success!=''){ ?>

               <button  class='btn  btn-success left'><?php echo $this->session->success; ?></button>

               <?php } ?>

            </div>
			<div class = "row">
				<div class = "col-md-12">
					<?php echo form_open() ?>
					<div class = "row">
						<div class = "form-group col-md-1">
							<label>Category</label>
						</div>
						<div class = "form-group col-md-3">
							<input type = "text" class = "form-control col-md-7" name = "category" value ="">
						</div>
						
							<div class = "form-group col-md-3">
							<?php if(!empty($categid)){
								?><input type = "hidden" name = "categid" value = "<?php echo $categid; ?>"><?php
							} ?>
							<button type = "submit" class = "btn btn-info"> Save </button>
						</div>
					</div>
			
					<?php echo form_close(); ?>
				</div>
			</div>
      <form id='product_cat_form'>
            <input type = "hidden" name = "categid" value = "<?php echo $categid; ?>">
            <table class="datatable1 table table-striped table-bordered" cellspacing="0" width="100%">

               <thead>

                  <tr role="row">

                     <th class=" wid-20" tabindex="0" rowspan="1" colspan="1">

                        <input type='checkbox' class="checked_all" value="check all" >&nbsp; 

                     </th>

                     <th class="sorting wid-10" style="border-left:none;">S.N </th>

                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Category Name</th>

                     <!-- <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Status</th> -->
                     <?php
                     if (empty($categid)) { ?>
                      <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Actions</th>
                       <?php
                     }
                     ?>

                  </tr>

               </thead>

               <tbody>

                  <?php $i=1; foreach($category as $ctg){?>

                  <tr>

                     <td><input type='checkbox' name='cat[]' class="checkbox" value='<?php echo $ctg->id;?>'>&nbsp; </td>

                     <td><?=$i++ ?></td>

                     <td><?=$ctg->name ?></td>

<!--                      <td><?php echo (($ctg->status==1)?display('active'):display('inactive')); ?></td> -->


                        <!-- <a  class="edit" data-toggle="modal" data-target="#product_list<?php echo $ctg->id;?>"><i class="ti-pencil"></i></a>  -->
                        <?php
                     if (empty($categid)) { ?>
                       <td class="center">
  						            <a  href = "<?php echo base_url("product/category/".$ctg->id.".html"); ?>" class="btn btn-primary btn-sm">Go to sub-category</a> 
                       </td>
                        <?php
                      }
                      ?>

                  </tr>

                  <?php } ?>

         

               </tbody>

            </table>

            <button class="btn btn-danger" type="button" onclick="delete_product()">

            <i class="ti-trash"></i>

            Delete

            </button>

            </form>

         </div>

      </div>

   </div>

</div>

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
   url: '<?php echo base_url();?>product/delete_product_category',
   data: $('#product_cat_form').serialize()
   })
   .done(function(data){   
      alert( "Delete successfully" );
      window.location.href = '<?php echo base_url()?>product/category';
   })
   .fail(function() {
    alert( "fail!" );
   });
   }else{
      location.reload(); 
   }}
</script>
