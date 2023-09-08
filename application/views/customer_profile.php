<?php 

 $panel_menu = $this->db->select("modules")

    ->where('user_id',$this->uri->segment(3))

    ->get('user')

    ->row();

    $module=explode(',',$panel_menu->modules);

    $all_modules = $this->db->get('tbll_modules')

    ->result();

    $module=explode(',',$panel_menu->modules);

    

    $form_edit_rights = $this->db->select("form_edit_rights")

    ->where('user_id',$this->uri->segment(3))

    ->get('user')

    ->row();

    $form_edit_right=explode(',',$form_edit_rights->form_edit_rights);

?>



<div class="row">



    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("customer/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_doctor') ?> </a>  

                    <a class="btn btn-primary" href="<?php echo base_url("customer") ?>"> <i class="fa fa-list"></i>  <?php echo display('doctor_list') ?> </a>  

                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 

                </div>

            </div> 



            <div class="panel-body">

                <div class="row">

                <nav>

  <div class="nav nav-tabs" id="nav-tab" role="tablist">

    <a class="nav-item nav-link active btn btn-info" style="margin-top:10px;" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"> <?php echo display('personal_info') ?></a>

    <a class="nav-item nav-link btn btn-info" style="margin-top:10px;" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"> <?php echo display('account_details') ?></a>

    <a class="nav-item nav-link btn btn-info" style="margin-top:10px;" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><?php echo display('add_companey_details') ?></a>

     <a class="nav-item nav-link btn btn-info" style="margin-top:10px;" id="nav-services-tab" data-toggle="tab" href="#nav-services" role="tab" aria-controls="nav-services" aria-selected="false">

         <?php echo display('customer_services') ?></a>

         <a class="nav-item nav-link btn btn-info" style="margin-top:10px;" id="nav-from_rights-tab" data-toggle="tab" href="#nav-from_rights" role="tab" aria-controls="nav-from_rights" aria-selected="false">

         <?php echo display('from_rights') ?></a>

  </div>

</nav>

<div class="tab-content" id="nav-tabContent">

  

<div class="tab-pane" id="nav-from_rights" role="tabpanel" aria-labelledby="nav-from_rights-tab">

<div class="col-md-12"><br></div>

                   



                    <div class="col-md-7 col-lg-7 ">

                   

                         <?php echo form_open_multipart(current_url(),'class="form-inner"') ?> 

                    <dl class="dl-horizontal">

                     <dt>Service Modules</dt><dd><?php echo display('Edit') ?></dd>

                     <?php foreach($all_modules as $value){ if(in_array($value->m_id,$module)){ ?>

                       <dt><?php echo $value->m_name.'<br>'; ?></dt><dd><input type="checkbox" name="rights[]"  <?php  if(in_array($value->m_id,$form_edit_right)){ echo "checked"; }?> value="<?php echo $value->m_id;?>"></dd>

                     

                      <?php }} ?>

                       <dt></dt><dd>  <input type="submit" value="<?php echo display('save') ?>"  class="btn btn-info"></dd>

                    

                     </dl> 

                     </form>

                    </div>

  </div>

  

    

<div class="tab-pane" id="nav-services" role="tabpanel" aria-labelledby="nav-services-tab">

<div class="col-md-12"><br></div>

                   



                    <div class="col-md-7 col-lg-7 "> 

                     <?php foreach($all_modules as $value){ if(in_array($value->m_id,$module)){ ?>

                       <?php echo $value->m_name.'<br>';; ?>

                     

                      <?php }} ?> 

                      

                    </div>

                     

      

  </div>

    

  <div class="tab-pane  active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

<div class="col-md-12"><br></div>

                    <div class="col-md-3 col-lg-3 " align="center"> 

                        <img alt="Picture" src="<?php echo (!empty($user->picture)?base_url($user->picture):base_url("assets/images/no-img.png")) ?>" class="img-thumbnail img-responsive">

                        <h3>

                            <?php echo $user->firstname.' '.$user->lastname ?> 

                        </h3>

                    </div>



                    <div class="col-md-7 col-lg-7 "> 

                        <dl class="dl-horizontal">

                            <dt><?php echo display('email')?></dt><dd><?php echo (!empty($user->email)?$user->email:null) ?></dd>

                            <dt><?php echo display('designation')?></dt><dd><?php echo (!empty($user->designation)?$user->designation:null) ?></dd>

                            <dt><?php echo display('department')?></dt><dd><?php echo (!empty($user->department)?$user->department:null) ?></dd>

                            <dt><?php echo display('address')?></dt><dd><?php echo (!empty($user->address)?$user->address:null) ?></dd>

                            <dt><?php echo display('phone')?></dt><dd><?php echo (!empty($user->phone)?$user->phone:null) ?></dd>

                            <dt><?php echo display('mobile')?></dt><dd><?php echo (!empty($user->mobile)?$user->mobile:null) ?></dd>

                            <dt><?php echo display('short_biography')?></dt><dd><?php echo (!empty($user->short_biography)?$user->short_biography:null) ?></dd>

                            <dt><?php echo display('specialist')?></dt><dd><?php echo (!empty($user->specialist)?$user->specialist:null) ?></dd>

                            <dt><?php echo display('date_of_birth')?></dt><dd><?php echo (!empty($user->date_of_birth)?$user->date_of_birth:null) ?></dd>

                            <dt><?php echo display('sex')?></dt><dd><?php echo (!empty($user->sex)?$user->sex:null) ?></dd>

                            <dt><?php echo display('degree')?></dt><dd><?php echo (!empty($user->degree)?$user->degree:null) ?></dd>

                            <dt><?php echo display('create_date')?></dt><dd><?php echo (!empty($user->create_date)?$user->create_date:null) ?></dd>

                            <dt><?php echo display('update_date')?></dt><dd><?php echo (!empty($user->update_date)?$user->update_date:null) ?></dd>

                            <dt><?php echo display('status')?></dt><dd><?php echo (!empty($user->status)?

                            display('active'):display('inactive')) ?></dd>

                        </dl> 

                    </div>

                     

      

  </div>

  

  

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

   <div class="col-md-12"><br></div>

                    



                    <div class="col-md-7 col-lg-7 "> 

                        <dl class="dl-horizontal">

                            <dt><?php echo display('customer_account_name')?></dt><dd><?php echo (!empty($user->a_name)?$user->a_name:null) ?></dd>

                            <dt><?php echo display('customer_account_number')?></dt><dd><?php echo (!empty($user->a_account_number)?$user->a_account_number:null) ?></dd>

                            <dt><?php echo display('customer_ifsc')?></dt><dd><?php echo (!empty($user->a_ifsc)?$user->a_ifsc:null) ?></dd>

                            <dt><?php echo display('customer_account_branch')?></dt><dd><?php echo (!empty($user->a_branch)?$user->a_branch:null) ?></dd>

                           

                           

                        </dl> 

                    </div>   

      

  </div>

  

  

  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

      

       <div class="col-md-12"><br></div>

                    



                    <div class="col-md-7 col-lg-7 "> 

                        <dl class="dl-horizontal">

                            <dt><?php echo display('customer_company_name')?></dt><dd><?php echo (!empty($user->a_branch)?$user->a_branch:null) ?></dd>

                            <dt><?php echo display('a_companyaddress')?></dt><dd><?php echo (!empty($user->a_companyaddress)?$user->a_companyaddress:null) ?></dd>

                            

                           

                        </dl> 

                    </div> 

      

      

      

  </div>

  

 

  

</div>

                    

                </div>

            </div> 



            <div class="panel-footer">

                <div class="text-center">

                    <strong><?php echo $this->session->userdata('title') ?></strong>

                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>

                </div>

            </div>

        </div>

    </div>

 

</div>

