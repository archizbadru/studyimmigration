<div class="row">
   <!--  table area -->
	<style>
		.card{
			border: 1px solid #ccc;
    border-radius: 10px;
    text-align: center;
		}
		.card-header{
			padding:0px;
		}
		.card-header img{
			    height: 180px;
    width: 100%;
		}
		.panel .pad {
  padding: 0 15px; 
}
.panel.flip .action {
  display: none;
}
.item-card .product-info {
    padding: 0;
    margin: 0;
    opacity: 0;
    left: 28%;
    text-align: center;
    position: absolute;
    bottom: -30px;
    z-index: 1;
    transition: all .5s ease 0s;
}
.box20{position:relative;overflow:hidden;}
.box20:after,.box20:before{position:absolute;content:""}
.box20:before{width:80%;height:220%;background:#ff402a;top:-50%;left:-100%;z-index:1;transform:rotate(25deg);transform-origin:center top 0;transition:all .5s ease 0s}
.box20:hover:before{left:10%}
.box20:after{width:55%;height:175%;background-color:rgba(0,0,0,.8);bottom:-1000%;left:53%;transform:rotate(-33deg);transform-origin:center bottom 0;transition:all .8s ease 0s}
.box20 .box-content,.box20 .icon{width:100%;padding:0 20px;position:absolute;left:0;z-index:2;transition:all 1.1s ease 0s}
.box20:hover:after{bottom:-70%}
.box20 img{width:100%;height:190px;}
.box20 .box-content{top:-100%;color:#fff}
.box20:hover .box-content{top:30px}
.box20 .title{font-size:24px;margin:0}
.box20 .icon li a,.box20 .post{display:inline-block;font-size:14px}
.box20 .post{margin-top:5px}
.box20 .icon{list-style:none;margin:0;bottom:-100%}
.box20:hover .icon{bottom:25px}
.box20 .icon li{display:inline-block}
.box20 .icon li a{width:35px;height:35px;line-height:35px;background:#444;border-radius:50%;margin:0 3px;color:#fff;text-align:center;transition:all .5s ease 0s}
.box20 .icon li a:hover{background:#fff;color:#ff402a}
@media only screen and (max-width:990px){.box20{margin-bottom:30px}
}
@media only screen and (max-width:479px){.box20 .title{font-size:20px}
}
.add-to-cart{
	position:relative;
}
.cart-quantity{
	    position: absolute;
    top: -5px;
    background: #272727;
    line-height: 16px;
    width: 18px;
    border-radius: 10px;
    font-size: 10px;
	right:0px;
	
}
.minus-quantity{
	left:3px;
}
	</style>
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print col-md-12" style="padding-top:15px;">
         	<form action="<?=base_url('buy');?>" method="get">
         		<div class="col-md-8">
         			<input type="text" name="searched_product" value="<?php if(isset($_GET['searched_product'])){ echo $_GET['searched_product'];} ?>" class="form-control" placeholder="Enter Keywords..."><br>
         			<input type="hidden" name="sc" value="<?php if(isset($_GET['sc'])){ echo $_GET['sc'];} ?>">
         			<input type="hidden" name="c" value="<?php if(isset($_GET['c'])){ echo $_GET['c'];} ?>">
         		</div>
         		<div class="col-md-2">
         			<button type="submit" class="btn btn-primary col-xs-12 col-sm-12 ">Search</button><br>
         		</div>
         	</form>
         	<div class="col-md-2">
            	<a class=" btn btn-success col-xs-12 col-sm-12" href = "<?php echo base_url("buy"); ?>"> Items : <?php echo $totalprod; ?></a> 
            </div>
            <!-- <a href="#" class="btn-xs btn btn-default"><i class="fa fa-filter"></i>Filters</a>             -->
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
			
				<?php
				if(!empty($product_list)) {
					
				
					foreach($product_list as $i => $prd){ 
					$disc = 0;
					$prd->stock = 5;
						if(empty($prd->image)){
							$prd->image = "default.png";
						}
					?>
						<div class = "col-md-3 ">
					
							<div class = "card hover" style = "position:relative;display:block;">
								<div class = "box20">
									<img src = "<?php  echo base_url("assets/images/products/".$prd->image); ?>" class = "img-responsive">
												<div class = "card-body card-content-member">
							<h4><?php echo  $prd->country_name;  ?></h4>
							<p> <strike><?php
								$currdate = date("Y-m-d");
								if($prd->from_date <= $currdate and $currdate <=  $prd->to_date){
									echo '<i class = "fa fa-rupee"></i>';
									if($prd->calc_mth == 1){
										
										echo $disc = $prd->price + $prd->price *$prd->discount/100;
									}else{
										echo $disc = $prd->price + $prd->discount;
										
									}	
										
								}		
								?></strike> <b><i class = "fa fa-rupee"></i><?php echo $prd->price ?></b>
									
									<?php if(empty($prd->stock_qty) || $prd->stock_qty  <= $prd->minimum_order_quantity){
										?>Out Of Stock<?php
									}else{
										
										
									} ?>
									
								</p>
								</div>
								<div class = "box-content text-left" style = "text-align:left;">
								
									<h1><?php echo  $prd->country_name; ?></h1>
									<?php if(!empty($disc)){
										
										?><strike><i class = "fa fa-rupee"></i><?php echo $disc; ?></strike><?php
									} ?>
									<p><i class = "fa fa-rupee"></i> <?php echo $prd->price ?></p>
								</div>
									 <ul class="icon">
									<li>
										<?php if(empty($prd->stock_qty) || $prd->stock_qty  <= $prd->minimum_order_quantity){
											
											//echo "Out of stock";
										}else { ?>
									<?php if(!empty($incart[$prd->id])) { ?>
									<a href = "javascript:void(0)" class = "minus-quantity" data-prodid = "<?php echo $prd->id; ?>" data-minalert = "<?php echo $prd->minimum_order_quantity ?>" ><span> - </span></a>
									<?php } ?>
									
									<a href = "javascript:void(0)" data-prodid = "<?php echo $prd->id; ?>" class = "add-to-cart" data-minalert = "<?php echo $prd->minimum_order_quantity ?>">
									<?php
									$plus = "shopping-cart";	
									if(!empty($incart[$prd->id])) {  ?>
									
											<span class="cart-quantity"><?php echo $incart[$prd->id]; ?></span> 
										<?php 
										$plus = "cart-plus";
										} ?>	
										<i class="fa fa-<?php echo $plus; ?>" aria-hidden="true"></i> 
											</a>
										<?php } 																				
										if ($disc) {
											$t_price = $disc-$prd->price;
										}else{
											$t_price = 0;
										}
										?>	
											<input type = "hidden" class = "tot-price" value = "<?php echo $t_price; ?>">
							
											</li>
									<li>	
										<a href = "<?php echo base_url("buy/view/".$prd->id); ?>"> <i class="fa fa-eye" aria-hidden="true"></i> </a></li>
									</ul>
								
								</div>
								 
							</div>
						</div>
				<?php }
				}else{
					?>
					<div class  = "col-md-12 text-center">
						<h1 class="alert alert-info">Sorry! There is no product available</h1>	
					</div>
					<?php
					
					
				}
				?>		
			</div>
			<div class="row">
				<div class = "col-md-12 text-center">
				<nav aria-label="Page navigation example">
			<?php if(!empty($limit) and !empty($totalprod)) {
					$tpage  =  ceil($totalprod/$limit);
					if($tpage > 1) { 
					?> <ul class="pagination">
					<?php 
						if(isset($_GET['page'])){
							
							$page = $_GET['page'];
						}else{
							
							$page = 1;
						} 
						if($page > 1) { ?>
					 <li class="page-item"><a class="page-link" href="<?php echo $page - 1; ?>">Previous</a></li>
					<?php
						}
					$nurl = "";	
					foreach ($_GET as $key => $gt) {

						if ($key != "page") {
							$nurl = "&".$key."=".$gt;
						}
					
					}
					//for($i = 1; $i <= $tpage; $i++) { 
					

						?>
						<!-- <li class="page-item <?php echo ($page == $i) ? "active" : "";  ?>" ><a class="page-link" href="<?php echo base_url("buy?page=".$i.$nurl); ?>"><?php echo $i; ?></a></li>	 -->	
			<?php	//}
				if($page < $tpage) {
			?>
			<li class="page-item"><a class="page-link" href="<?php echo base_url("buy?page=".($page + 1)).$nurl.''; ?>">Next</a></li>
			<?php }
			}	
			?>	
 
   </ul>
			<?php } ?>	
</nav>
				</div>	
			</div>
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
	$(document).on("click", ".minus-quantity", function(){
		
		 cartchange($(this), -1);
		
	});
	
	function cartchange(currobj, qty){
		
		var crtobj = currobj.closest("li").find(".add-to-cart");
			$.ajax({
				url  	: "<?php echo base_url('buy/addtocart'); ?>",
				type 	: "post",
				data 	: {product:currobj.data("prodid"),qty : qty, "minimum" : crtobj.data("minalert")},
				success	: function(resp){
					var jresp = JSON.parse(resp);
					
					if(jresp.status == 1){
						
						//<span class="minus-quantity"> - </span>
						
				
						
						currobj.append('<span class="cart-quantity">1</span>');
						currobj.closest("li").prepend('<a href = "javascript:void(0)" class = "minus-quantity" data-prodid = "'+jresp.prodid+'"><span> - </span></a>');
						var tprice = parseInt(jresp.price) * parseInt(jresp.qty);
						var htmcnt = '<li id = "cart-li-'+jresp.prodid+'"><div class="cart-items"><h4><a href="" class="prodname">'+jresp.product+' </a></h4>'+
										'<p><a href=""> Price : <i class="fa fa-rupee"></i> '+jresp.price+' X '+'<input type="number" value="'+jresp.qty+'" min=1 class="cart-qty" data-prodid='+jresp.prodid+'><input type="hidden" name="minimum" class="minimum" value="'+jresp.minalert+'">'+' = <i class="fa fa-rupee"></i> <span class="item-price-'+jresp.prodid+'">'+tprice+'</span> </a>'+ 
										'</p></div><hr /></li>';
											$("#cart-nav-menu").prepend(htmcnt);
											$("#nav-cart-count").text(jresp.total);					
					}else if(jresp.status == 2){
						
						if(parseInt(jresp.qty)  > 0){
							
							crtobj.find("i.fa").addClass("fa-cart-plus").removeClass("fa-cart");
									crtobj.find(".cart-quantity").text(parseInt(crtobj.find(".cart-quantity").text()) + qty);
					
						var tprice = parseInt(jresp.price) * parseInt(jresp.qty);
						$("#cart-li-"+jresp.prodid).html('<div class="cart-items"><h4><a class="prodname" href="">'+jresp.product+' </a></h4>'+
										'<p><a href=""> Price : <i class="fa fa-rupee"></i> '+jresp.price+' X '+'<input type="number" value="'+jresp.qty+'" min=1 class="cart-qty" data-prodid='+jresp.prodid+'><input type="hidden" name="minimum" class="minimum" value="'+jresp.minalert+'">'+' = <i class="fa fa-rupee"></i> <span class="item-price-'+jresp.prodid+'">'+tprice+'</span> </a>'+ 
										'</p></div>');
						}else{
						
							crtobj.find("i.fa").addClass("fa-shopping-cart").removeClass("fa-cart-plus");
							crtobj.find(".cart-quantity").remove();
							$("#cart-li-"+jresp.prodid).remove();
							$("#nav-cart-count").text(jresp.total);
							currobj.remove();
						}
						
					
					}
					
				}
			});	
		
	}
	 
	$(document).on("click", ".add-to-cart", function(){		
		var currobj = $(this);	
		$.ajax({
			url  	: "<?php echo base_url('buy/addtocart'); ?>",
			type 	: "post",
			data 	: {
				product:$(this).data("prodid"),
				qty:parseInt($(this).first().find('.cart-quantity').html())+1,
				disc:$(this).closest("li").find(".tot-price").val(),
				minimum : currobj.data("minalert")
			},
			success	: function(resp){
				var jresp = JSON.parse(resp);				
				if(jresp.status == 1){					
					//<span class="minus-quantity"> - </span>
					currobj.find("i.fa").addClass("fa-cart-plus").removeClass("fa-cart");
					currobj.append('<span class="cart-quantity">1</span>');
					currobj.closest("li").prepend('<a href = "javascript:void(0)" class = "minus-quantity" data-prodid = "'+jresp.prodid+'"><span> - </span></a>');
					var tprice = parseInt(jresp.price) * parseInt(jresp.qty);
					var htmcnt = '<li id = "cart-li-'+jresp.prodid+'"><div class="cart-items"><h4><a href="" class="prodname">'+jresp.product+' </a></h4>'+
									'<p><a href=""> Price : <i class="fa fa-rupee"></i> '+jresp.price+' X '+'<input type="number" value="'+jresp.qty+'" min=1 class="cart-qty" data-prodid='+jresp.prodid+'><input type="hidden" name="minimum" class="minimum" value="'+jresp.minalert+'">'+' = <i class="fa fa-rupee"></i> <span class="item-price-'+jresp.prodid+'">'+tprice+'</span> </a>'+ 
									'<a href="javascript:void(0)" onclick="remove_cart_item('+jresp.prodid+')" class="fa fa-trash btn btn-danger btn-sm pull-right remove-item-cart"></a></p></div><hr /></li>';
										$("#cart-nav-menu").prepend(htmcnt);
										$("#nav-cart-count").text(jresp.total);					
				}else if(jresp.status == 2){
					currobj.find(".cart-quantity").text(parseInt(currobj.find(".cart-quantity").text()) + 1);
				
					var tprice = parseInt(jresp.price) * parseInt(jresp.qty);
					$("#cart-li-"+jresp.prodid).html('<div class="cart-items"><h4><a href="" class="prodname">'+jresp.product+' </a></h4>'+
									'<p><a href=""> Price : <i class="fa fa-rupee"></i> '+jresp.price+' X '+'<input type="number" value="'+jresp.qty+'" min=1 class="cart-qty" data-prodid='+jresp.prodid+'><input type="hidden" name="minimum" class="minimum" value="'+jresp.minalert+'">'+' = <i class="fa fa-rupee"></i> <span class="item-price-'+jresp.prodid+'">'+tprice+'</span> </a>'+ 
									'<a href="javascript:void(0)" onclick="remove_cart_item('+jresp.prodid+')" class="fa fa-trash btn btn-danger btn-sm pull-right remove-item-cart"></a></p></div>');
				}
				
			}
		});	
		
	});
</script>
