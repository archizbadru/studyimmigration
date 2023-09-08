<?php 

 $panel_menu = $this->db->select("tbl_user_role.user_permissions")
            ->where('pk_i_admin_id',$this->session->user_id)
            ->join('tbl_user_role','tbl_user_role.use_id=tbl_admin.user_permissions')
            ->get('tbl_admin')
            ->row();
            if (!empty($panel_menu->user_permissions)) {
              $module=explode(',',$panel_menu->user_permissions);
            }else{
              $module=array();
            }


?>

<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("lead/productcountry") ?>"> <i class="fa fa-list"></i>  <?php echo 'Product List' ?> </a>  
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                     <?php    if(in_array(300,$module) || in_array(301,$module) || in_array(302,$module) || in_array(303,$module) || in_array(304,$module) || in_array(305,$module) || in_array(306,$module)){ ?>
                         <?php echo form_open_multipart('lead/addproduct','class="form-inner"') ?>
                            <?php echo form_hidden('id',$formdata->id);?>

                            <div class="form-group row">
                                <label for="price" class="col-xs-3 col-form-label">Product Name</label>
                                <div class="col-xs-3">
                                    <input name="proname" type="text" class="form-control" id="proname" placeholder="Product Name" value="<?php echo $formdata->country_name ?>" >
                                </div>  
                                 <label for="price" class="col-xs-3 col-form-label">SKU ID</label>
                                <div class="col-xs-3">
                                    <input name="skuid" type="text" class="form-control" id="skuid" placeholder="SKU ID" value="<?php if(!empty($formdata->skuid )) { echo $formdata->skuid ; } ?>" >
                                </div>                                
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-xs-3 col-form-label">Type of product</label>
                                <div class="col-xs-3">
                                    <select name="top" class="form-control" id="top">
                                        <option value="">Select</option>
                                        <?php if(!empty($typeofpro_list)){ foreach($typeofpro_list as $typeofprolist){?>
                                        <option value="<?= $typeofprolist->id?>" ><?= $typeofprolist->name?></option>
                                    <?php }}?>
                                    </select>
                                </div>  
                                 <label for="brand" class="col-xs-3 col-form-label">Brand</label>
                                <div class="col-xs-3">
                                    <select name="brand" class="form-control" id="brand">
                                         <option value="">Select</option>
                                        <?php if(!empty($brand_list)){ foreach($brand_list as $brandlist){?>
                                        <option value="<?= $brandlist->id?>" ><?= $brandlist->name?></option>
                                    <?php }}?>
                                    </select>
                                </div>                                
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-xs-3 col-form-label">Price</label>
                                <div class="col-xs-3">
                                    <input name="price" class="form-control" id="price" value="<?php echo $formdata->price ?>">
                                    
                                </div>  
                                                            
                            </div>
                              
                               <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('status') ?></label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="1"  <?php if($formdata->status == 1) { echo 'checked'; } ?>><?php echo display('active') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="0" <?php if($formdata->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                           
                           
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                        <div class="or"></div>
                                        <button class="ui positive button"><?php echo display('save') ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                       <?php }else { ?>
                        <?php echo form_open_multipart('lead/addproductcountry','class="form-inner"') ?>
                            <?php echo form_hidden('id',$formdata->id);?>
                            <div class="form-group row">
                                <label for="country_name" class="col-xs-3 col-form-label">Product Name<i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="country_name" type="text" class="form-control" id="firstname" placeholder="Product Name" value="<?php echo $formdata->country_name ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-xs-3 col-form-label">Product Price</label>
                                <div class="col-xs-3">
                                    <input name="price" type="text" class="form-control" id="price" placeholder="Product Price" value="<?php echo $formdata->price ?>" >
                                </div>                                
                            </div>
                              
                               <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('status') ?></label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="1"  <?php if($formdata->status == 1) { echo 'checked'; } ?>><?php echo display('active') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="0" <?php if($formdata->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                           
                           
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                        <div class="or"></div>
                                        <button class="ui positive button"><?php echo display('save') ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php }?>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>