<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div> 
  <div class="row">
    <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
        <div class="panel-heading no-print">
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?php echo base_url("leadRules/create_rule") ?>"> <i class="fa fa-list"></i> <?php echo display('create_rule') ?> </a>  
            </div>
        </div>
        <div class="panel-body">
          <table width="100%" class="datatable1 table table-striped table-bordered table-hover ">
            <thead>
                <tr>
                  <th>Title</th>
                  <th>status</th>
                  <th>Created by</th>
                  <th>Updated by</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php
              foreach ($leaddata as $k=>$value) {  ?>
                <tr>
                  <td><?=$value['title']?></td>
                  <td><?=($value['status']==1)?'Active':'Inactive'?></td>
                  <td><?=ucfirst($value['created_by_name'])?></td>
                  <td><?=ucfirst($value['updated_by_name'])?></td>
                  <td><?=$value['created_date']?></td>
                  <td><?=!empty($value['updated_date'])?$value['updated_date']:'NA'?></td>
                  <td><a href="<?=base_url().'leadRules/create_rule/'.$value['id']?>" class='btn btn-primary btn-sm'>View</a>
                  <?php
                  if($value['status']==1){
                  ?>
                    <!-- <a href="<?=base_url().'leadRules/execute_rule/'.$value['id']?>" onclick="return confirm('Are you sure, you want to execute this rule. Once executed you can not revert back.')" class='btn btn-success btn-sm'>Execute</a> -->
                  <?php
                  }
                  ?>
                  </td>
              </tr>
              <?php
              }  ?>
            </tbody>            
          </table>
        </div>
      </div>
    </div>
  </div>
</div>    