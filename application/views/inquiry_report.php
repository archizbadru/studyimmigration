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
                    <form method="post" id="filter-form" class="submit-report-form" action="<?php echo base_url('Report/download_report')?>">
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
                          <label for="inputPassword4">Employee</label>
                          <select class="form-control selectpicker" name="employee" id="employee">
                              <option value="" style="display:none">---Select Employee---</option>
                               <!--<option value="">OPT1</option>
                                <option value="">OPT2</option>-->
                                
                                <?php foreach($user_lists as $user){?>
                                    <option value="<?= $user->pk_i_admin_id ?>"><?= $user->s_display_name." ".$user->last_name ?></option>
                                    
                                <?php } ?>
                              
                          </select>
                        </div>
                        
                        <div class="form-group col-md-3">
                            
                            <label>Name</label>
                            <input type="text" class="form-control" name="srch_by_name" id="srch_by_name" placeholder="Enter name">
                            
                        </div>
                        
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
                            <label>Pincode</label>
                            <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter Pincode">
                            
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                            
                        </div>
                        
                         <div class="form-group col-md-3">
                          <label for="inputPassword4">Orgnisation Name</label>
                          <input type="text" class="form-control" name="organisational_name" id="organisational_name" placeholder="Enter Orgnisation Name">
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
                        
                        <div class="form-group col-md-3">
                            <label>Opportunity Size</label>
                            <input type="text" class="form-control" name="opportunity_size" id="opportunity_size" placeholder="Enter Opportunity Size">
                            
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Enquiry Type</label>
                            <select class="form-control" name="enquiry_type" id="enquiry_type">
                                <option value="" style="display:none;">---Select---</option>
                                <option value="1">Customer</option>
                                <option value="11">Channel Partner</option>
                            </select>
                            
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="" style="display:none">---Select---</option>
                                <option value="1">Drop</option>
                                <option value="2">Active</option>
                                <option value="3">Lead</option>
                                <option value="4">Created Today</option>
                                <option value="5">Updated Today</option>
                                <option value="6">Assigned</option>
                                <option value="7">Unassigned</option>
                            </select>
                            
                        </div>
                        
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-12 text-right">
                            <button type="submit" class="btn btn-success">Filter</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                        
                        <div class="form-group col-md-12 table-responsive" id="showResult">
                            
                        </div>
                        <!--<div class="form-group col-md-12" style="display:none" id="resultDiv">
                         
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home" >Total</a></li>
                            <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                            <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                            <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                          </ul>
                        
                          <div class="tab-content"><br>
                            <div id="home" class="tab-pane fade in active">
                              
                              <div id="showResult"></div>
                              
                            </div>
                            <div id="menu1" class="tab-pane fade">
                              <h3>Menu 1</h3>
                              <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                              <h3>Menu 2</h3>
                              <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                              <h3>Menu 3</h3>
                              <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                            </div>
                          </div>
                          
                        </div>-->
                          
                      </div>
                      <!--<button type="submit" class="btn btn-primary">Sign in</button>-->
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <style>
        th{
            
            font-size: 12px;
            font-weight: normal;
        }
        
        td{
            
            font-size: 11px;
            font-weight: normal;
        }
        
    </style>
<!---------------------------->
 
 


 

 