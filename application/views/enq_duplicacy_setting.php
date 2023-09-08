<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default thumbnail"> 
      <div class="panel-body">
        <div class="col-md-12"> 
          <?php if(!empty($ruledata)) { ?>
          <a href="#" onclick="alert('You had already created a rule please delete that before creating a new one');" class="btn btn-raised btn-success"><i class="ti-plus text-white"></i> &nbsp;Add Duplicacy setting</a>
        <?php } else { ?>
          <a href="#" data-toggle="modal" data-target="#rulemodal" class="btn btn-raised btn-success"><i class="ti-plus text-white"></i> &nbsp;Add Duplicacy setting</a>
        <?php } ?>
        </div>
      </div>
    </div>
    <div class="panel panel-default thumbnail"> 
      <div class="panel-body">
        <div class="col-md-12">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>S No.</th>
                <th>Duplicacy Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ruledata as $value) 
              { $sn = 1;?>
                <tr>
                  <td><?=$sn++?></td>
                  <td><?php if($value['duplicacy_status'] == 0){ echo "Not Allowed(".ucfirst($value['field_for_identification']).")";}else{ echo "Allowed"; } ?></td>
                  <td>
                    <!-- <a href="<?=base_url('setting/saveEnquiryRule/'.$value['id'].'')?>" class="btn btn-primary btn-sm" ><i class="fa fa-pencil"></i></a> -->

                    <a href="<?=base_url('setting/deleteEnquiryRule/'.$value['id'].'')?>" class="btn btn-danger btn-sm" style="margin-left: 10px;" ><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <!-- <?php echo $table; ?> -->
        </div>
      </div>
    </div>
  </div>
</div> 

<div id="rulemodal" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Add New Enquiry Rule </h4>
      </div>
      <div class="modal-body">
        <div class="row" style="display: block;" id="rulelist">
          <div class="col-sm-12">
            <form action="<?=base_url('setting/saveEnquiryRule')?>" method="post">
              <div class="form-group">
                <input type="radio" name="allowornot" value="1" class="form-control">Allow Duplicate
                <input type="radio" name="allowornot" value="0" class="form-control">Don't Allow Duplicate
              </div>
              <div class="form-group  fields" style="display: none;">
                <label>Select Field For Uniquely Identification</label>
                <select name="fields" class="form-control">
                  <option value="">Select</option>
                  <option value="email">Email</option>
                  <option value="phone">Phone</option>
                  <option value="both">Both Email And Phone</option>
                </select>
              </div>
              <button type="submit" name="submit" class="btn btn-success">Save</button>
              <button type="button"  data-dismiss="modal" class="btn btn-default">Close</button>
            </form>
          </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $('input[type="radio"][name="allowornot"]').change(function() {
     if(this.value == "0") {
         // do something when checked
         $(".fields").css("display","block");
     }
     else
     {
        $(".fields").css("display","none");  
     }
 });
</script>