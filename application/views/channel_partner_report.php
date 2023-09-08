<!------ Filter Div ---------->
    <div class="row" id="filter_pannel">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="widget-title">
                        <!--<h3><?= display('total_progress')?></h3>-->
                        <!--<span><?= display('last_year_status') ?></span>-->
                        <h3><?= $title ?></h3>
                    </div><hr>
                    <form method="post" id="channel-partner-filter-form">
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <label for="inputEmail4">From Date</label>
                          <input type="date" class="form-control" id="from-date" name="from-date">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4">To Date</label>
                          <input type="date" class="form-control" id="to-date" name="todate">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4">Channel partner</label>
                          <select class="form-control selectpicker" name="channel_partner" id="channel_partner">
                              <option value="" style="display:none">---Select Partner---</option>
                               <!--<option value="">OPT1</option>
                                <option value="">OPT2</option>-->
                                
                                <?php foreach($channel_partner as $user){?>
                                    <option value="<?= $user->pk_i_admin_id ?>"><?= $user->s_display_name." ".$user->last_name ?></option>
                                    
                                <?php } ?>
                              
                          </select>
                        </div>
                        <!--<div class="form-group col-md-3">
                          <label for="inputPassword4">Employee Id</label>
                          <input type="text" name="employee_id" id="employee_id" class="form-control" placeholder="Enter employee id">
                        </div>-->
                        <div class="form-group col-md-3">
                          <label for="inputPassword4">Email</label>
                          <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4">Phone</label>
                          <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number">
                        </div>
                      </div>
                      
                       <div class="form-row">
                           
                         <div class="form-group col-md-3">
                          <label for="inputPassword4">Country</label>
                          <select class="form-control" name="country" id="fcountry">
                              <option value="" style="display:none">---Select Country---</option>
                              <?php foreach($countries as $row){?>
                                 
                                 <option value="<?= $row->id_c ?>" ><?= $row->country_name ?></option>
                              <?php } ?>
                          </select>
                        </div>
                        
                        <div class="form-group col-md-3">
                          <label for="inputEmail4">Region</label>
                          <select class="form-control selectpicker" name="region" id="fregion">
                              <!--<option value="" style="display:none">---Select Region---</option>
                               <option value="">OPT1</option>
                               <option value="">OPT2</option>-->
                              
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4">Territory</label>
                          <select class="form-control selectpicker" name="territory" id="fterritory">
                              <!--<option value="" style="display:none">---Select Territory---</option>
                               <option value="">OPT1</option>
                               <option value="">OPT2</option>-->
                              
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4">State</label>
                          <select class="form-control selectpicker" name="state" id="fstate">
                              <!--<option value="" style="display:none">---Select State---</option>
                               <option value="">OPT1</option>
                                <option value="">OPT2</option>-->
                              
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4">City</label>
                          <select class="form-control" name="city" id="fcity">
                              <!--<option value="" style="display:none">---Select City---</option>
                              <option value="">OPT1</option>
                                <option value="">OPT2</option>-->
                          </select>
                        </div>
                        
                         <div class="form-group col-md-3">
                          <label for="inputPassword4">Orgnisation Name</label>
                          <input type="text" class="form-control" name="organisational_name" id="organisational_name" placeholder="Enter orgnisation name">
                        </div>
                        
                        <div class="form-group col-md-3">
                          <label for="inputPassword4">Source</label>
                          <select class="form-control" name="source" id="source">
                              <option value="" style="display:none;">---Select---</option>
                              <?php foreach($leadsource as $source){?>
                              <option value="<?= $source->lsid ?>"><?=$source->lead_name ?></option>
                              <?php } ?>
                          </select>
                        </div>
                        
                        <!--<div class="form-group col-md-3">
                          <label for="inputPassword4">Lead Stage</label>
                          <select class="form-control" name="lead_stage" id="lead_stage">
                              <option value="" style="display:none;">---Select---</option>
                              <?php foreach($lead_stage as $stage_name){?>
                              <option value="<?= $stage_name->stg_id ?>"><?=$stage_name->lead_stage_name ?></option>
                              <?php } ?>
                          </select>
                        </div>-->
                      </div>
                      <div class="form-row">
                          
                        <div class="form-group col-md-12" id="showResult">
                          
                        </div>
                          
                          
                        <div class="form-group col-md-12 text-center">
                            <button type="submit" class="btn btn-success">Filter</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                      </div>
                      <!--<button type="submit" class="btn btn-primary">Sign in</button>-->
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
<!---------------------------->
 
 


 

 