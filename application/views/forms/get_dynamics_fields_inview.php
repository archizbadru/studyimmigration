<?php
		
			if(!empty($dynamic_field)) {
        // print_r($dynamic_field);exit();

        // print_r($dynamic_field);exit();
				
							foreach($dynamic_field as $ind => $fld){

								
							?>	
							<div class="form-group col-md-4">
							
								
					<?php if($fld['input_type']==1){?>
            <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
						<input type="text" name="enqueryfield[]"  value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>"  class="form-control">
                   
                  <?php }if($fld['input_type']==2){?>
                 <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
					  
					  <?php $optarr = (!empty($fld['input_values'])) ? explode(",",$fld['input_values']) : array(); 
					  ?>
                   
                     <select class="form-control"  name="enqueryfield[]" > 
                        <option>Select</option>
						<?php 	foreach($optarr as $key => $val){
							//echo $fld["fvalue"].''.trim($val);
							?><option value = "<?php echo $val; ?>" <?php echo (!empty($fld["fvalue"]) and trim($fld["fvalue"]) == trim($val)) ? "selected" : ""; ?>><?php echo $val; ?></option><?php
						}	
						
						?>
                     </select> 
               
                  <?php }if($fld['input_type']==3){?>
                          <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
                         <input type="radio"  name="enqueryfield[]"  id="<?=  $fld['input_name']?>" class="form-control">                         
                  
                    <?php }if($fld['input_type']==4){?>
                          <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
                         <input type="checkbox"  name="enqueryfield[][]"  id="<?= $fld['input_name']?>" class="form-control">                         
           
                    <?php }if($fld['input_type']==5){ ?>
                    <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
                   <textarea   name="enqueryfield[][]"   class="form-control" placeholder="<?= $fld['input_place']; ?>"></textarea>
                     <?php }?>

                 <?php if($fld['input_type']==6){?>
                          <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
                         <input type="date"  name="enqueryfield[]" class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">                         
           
                    <?php }?>

                     <?php if($fld['input_type']==7){?>
                          <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
                         <input type="time"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">                         
           
                    <?php }?>

          <input type="hidden" name= "inputfieldno[]" value = "<?=$fld['input_id']; ?>">
					 <input type="hidden" name= "inputtype[]" value = "<?=$fld['input_type']?>">
								
							</div>	
					<?php	}

						 ?>
					 
					 <?php } ?>