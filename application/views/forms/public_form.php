<?php ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</head>
  <body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h2><?=$form_row['title']?></h2>
    <!-- <p class="lead">This is description</p> -->
  </div>
  <div class="row">
    <div class="col-md-2">     
    </div>
    <div class="col-md-8">      
      <form class="" method="post" action="<?=base_url().'public/survey/survery_form_submit/'.$enquiry_id?>">
        <input name="tid" type="hidden" value="<?=$tid?>" >    
        <input name="comp_id" type="hidden" value="<?=$comp_id?>" >    
        <input name="uid" type="hidden" value="<?=$uid?>" >    
        <input name="form_type" type="hidden" value="<?=$form_row['form_type']?>" >    
        <?php                
         if(!empty($form_fields)) {       
          foreach($form_fields as $ind => $fld){
            $fld_id = $fld['input_id'];          
            if($fld['input_type']!=19){ ?>      
            <div class="form-group col-md-12 <?=$fld['input_name']?> " >
               <?php if($fld['input_type']==1){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="text" name="enqueryfield[<?=$fld_id?>]" class="form-control">
               <?php }
               if($fld['input_type']==2){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <?php $optarr = (!empty($fld['input_values'])) ? explode(",",$fld['input_values']) : array(); 
               ?>
               <select class="form-control"  name="enqueryfield[<?=$fld_id?>]" id="<?=$fld['input_name']?>">
                  <option value="">Select</option>
                  <?php  foreach($optarr as $key => $val){
                  ?>
                  <option value = "<?php echo $val; ?>"><?php echo $val; ?></option>
                  <?php
                     } 
                  ?>
               </select>
               <?php }
               if($fld['input_type']==20){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <?php $optarr = (!empty($fld['input_values'])) ? explode(",",$fld['input_values']) : array(); 
               ?>
               <input type="hidden"  name="enqueryfield[<?=$fld_id?>]"  id="multi-<?=$fld['input_name']?>" >
               <select class="multiple-select" name='multi[]' multiple onchange="changeSelect(this)" id="<?=$fld['input_name']?>">
                  <?php  foreach($optarr as $key => $val){                  
                    $fvalues  = explode(',', $fld['fvalue']);
                    ?>
                    <option value = "<?php echo $val; ?>"><?php echo $val; ?></option>
                  <?php
                     } 
                  ?>
               </select>
               <?php }
               if($fld['input_type']==3){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="radio"  name="enqueryfield[<?=$fld_id?>]"  id="<?=$fld['input_name']?>" class="form-control">                         
               <?php }if($fld['input_type']==4){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="checkbox"  name="enqueryfield[<?=$fld_id?>]"  id="<?=$fld['input_name']?>" class="form-control">         
               <?php }if($fld['input_type']==5){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <textarea   name="enqueryfield[<?=$fld_id?>]"   class="form-control" placeholder="<?= $fld['input_place']; ?>" ></textarea>
               <?php }?>
               <?php if($fld['input_type']==6){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="date"  name="enqueryfield[<?=$fld_id?>]" class="form-control">
               <?php }?>
               <?php if($fld['input_type']==7){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="time"  name="enqueryfield[<?=$fld_id?>]"  class="form-control">
               <?php }?>
               <?php if($fld['input_type']==8){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="hidden" readonly name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <input type="file"  name="enqueryfiles[]"  class="form-control" >
                <?php               
                }?>                
               <?php if($fld['input_type']==9){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="password"  name="enqueryfield[<?=$fld_id?>]"  class="form-control">
               <?php }?>
                  <?php if($fld['input_type']==10){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="color"  name="enqueryfield[<?=$fld_id?>]"  class="form-control">
               <?php }?>
               <?php if($fld['input_type']==11){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="datetime-local"  name="enqueryfield[<?=$fld_id?>]"  class="form-control">
               <?php }?>
                 <?php if($fld['input_type']==12){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="email"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
                 <?php if($fld['input_type']==13){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="month"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
                 <?php if($fld['input_type']==14){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="number"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
                 <?php if($fld['input_type']==15){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="url"  name="enqueryfield[<?=$fld_id?>]"  class="form-control">
               <?php }?>
                 <?php if($fld['input_type']==16){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="week"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
                 <?php if($fld['input_type']==17){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="search"  name="enqueryfield[<?=$fld_id?>]"  class="form-control">
               <?php }?>
               <?php if($fld['input_type']==18){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="tel"  name="enqueryfield[<?=$fld_id?>]"  class="form-control">
               <?php }?>              
               <input type="hidden" name= "inputfieldno[]" value = "<?=$fld['input_id']; ?>">
               <input type="hidden" name= "inputtype[]" value = "<?=$fld['input_type']?>">
            </div>
    <?php } 
        }
      ?>
        <?php
        }
        ?>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
      </form>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small" style="display: none;">
    <p class="mb-1">&copy; 2017-2019 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
</body>
</html>