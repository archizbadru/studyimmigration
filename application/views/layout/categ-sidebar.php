			 <?php if(!empty($category)) {
				
				 		foreach($category as $ind => $ctg) {
							
							if(count($ctg) > 1){
								$treemenu  =  true;
							}else{
								$treemenu  =  false;
							}
						if(empty($ctg[0]->categid)) continue;			
						?>
							<li class="<?php echo (($segment1 == $ctg[0]->category) ? "active" : null) ?> <?php echo ($treemenu == true) ? "treeview" : ""; ?>">
								
										<?php if(($treemenu == false) and !empty($ctg[0]->category) ) { ?>
											
										 <a href="<?php echo base_url('buy?c'.$ctg[0]->categid); ?>">
										 <i class="fa fa-home"></i>  <?php echo $ctg[0]->category; ?>
							  
										 </a>
											
										<?php }else{ ?>
												 <a href="#">
										 <i class="fa fa-home" style="color:#fff;font-size:17px;background:#2ecc71;padding:7px;border-radius:4px;width:30px;"></i> &nbsp;<?php echo $ctg[0]->category; ?>   <span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								  </span>
							  
										 </a>
											
										<?php } ?>
									<?php 
										if(count($ctg) > 1){
									?>    <ul class="treeview-menu"><?php	
											foreach($ctg as $cind => $sbctg) {
											
											?><li><a href = "<?php echo base_url("buy?sc=".$sbctg->id); ?>"><?php echo $sbctg->subcat_name; ?></a></li><?php
											}
											?></ul><?php
										}
											?>
									
									
						  </li>
						
			<?php		}
				 } ?>