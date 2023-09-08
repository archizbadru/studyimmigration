 <style>
 .line_break {
    width:100%;
    height: 5px;
    float: left;
    color: black;
    padding-top: 3px;
    background-color: rgba(255,255,255,.5);
}
</style>
   <div class="tab-pane <?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='experience'){ echo 'active';}};?>" id="experience">
    <div class="content-panel">
                <hr>
<div style="width: 100%;overflow-x: scroll;">
<table id="dtBasicExamplee" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">S.No</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Total Experience</th>
          <th class="th-sm">Relevant Experience</th>
          <th class="th-sm">Tax Payer</th>
          <th class="th-sm">Whole Eperience</th>
          <th class="th-sm">Last Return Filed Date</th>
          <th class="th-sm">Professional Tax</th>
          <th class="th-sm">Insurance Benefit</th>
          <th class="th-sm">Any Contribution</th>
          <th class="th-sm">Payment Mode</th>
          <th class="th-sm">Remark</th>
          <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
          <th class="th-sm">Edit Right</th>
          <?php } ?>
      <th class="th-sm">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php $i=1; foreach($tab_exp_detail as $val){ ?>
    <tr> 
      <td><?php echo $i; ?></td>
      <td><?php echo $val->e_member_name; ?></td>
      <td><?php echo $val->total_experience; ?></td>
      <td><?php echo $val->relevant_experience; ?></td>
      <td><?php if($val->tax_payer=='1'){ echo 'Yes';}else{ echo 'No';}; ?></td>
      <td><?php if($val->whole_eperience=='1'){ echo 'Yes';}else{ echo 'No';}; ?></td>
      <td><?php echo $val->return_filed; ?></td>
      <td><?php if($val->professional_tax=='1'){ echo 'Yes';}else{ echo 'No';}; ?></td>
      <td><?php if($val->insurance_benefit=='1'){ echo 'Yes';}else{ echo 'No';}; ?></td>
      <td><?php echo $val->any_contribution; ?></td>
      <td><?php if($val->payment_mode=='Cash'){ echo 'Cash';}else{ echo 'Account';}; ?></td>
      <td><?php echo $val->ex_remark; ?></td>
      <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
      <td>
        <a href="<?php echo base_url('lead/member_exp_edit_right/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>"><span class="label label-primary"><?php if($val->edit_access=='1'){ echo'Unedit'; }else{ echo 'Edit'; } ?><span></a>
      </td>
      <?php } ?>
      <td>
        <?php if(in_array($this->session->userdata('user_right'), applicant) && $val->edit_access=='1'){ ?>
         <a href="#modale<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
       <?php } ?>
         <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
          <a href="#modale<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
         <a href="<?php echo base_url('lead/member_exp_delete/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>" class="titlehover" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
         <?php } ?> 
      </td>
    </tr>
 <!--------------------------------Modal Popup for Detail of Document-------------------------------------------------->
                      
    <div class="modal fade" id="modale<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6e" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6e">Update of Qualification</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
<form class="" action="<?php echo base_url()?>lead/member_exp_update/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">
    <div class="modal-body" style="padding: 0px !important;">
        <input type="hidden" class="form-control" name="e_member_id" placeholder="" value="<?php echo $val->id; ?>"> 
      <div class="form-group col-md-6">
        <label>Total Experience</label>
        <input type="text" class="form-control" name="total_experience" value="<?php echo $val->total_experience; ?>" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Relevant Experience(yrs)</label>
        <input type="text" class="form-control" name="relevant_experience" value="<?php echo $val->relevant_experience; ?>" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Are You A Tax Payer</label>
        <select class="form-control"  name="tax_payer"> 
            <option value = "">-------Select-------</option>
            <option value = "1" <?php if($val->tax_payer=='1'){ echo "selected";}?>>Yes</option>
            <option value = "0" <?php if($val->tax_payer=='0'){ echo "selected";}?>>No</option>
        </select>
    </div>
      <div class="form-group col-md-6">
        <label>Tax Deduction By Employer For Whole Experience</label>
        <select class="form-control"  name="whole_eperience"> 
            <option value = "">-------Select-------</option>
            <option value = "1" <?php if($val->whole_eperience=='1'){ echo "selected";}?>>Yes</option>
            <option value = "0" <?php if($val->whole_eperience=='0'){ echo "selected";}?>>No</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Last Income Tax Return Filed Date</label>
        <input type="date" class="form-control" name="return_filed" value="<?php echo $val->return_filed; ?>" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Paying Professional Tax</label>
        <select class="form-control"  name="professional_tax"> 
            <option value = "">-------Select-------</option>
            <option value = "1" <?php if($val->professional_tax=='1'){ echo "selected";}?>>Yes</option>
            <option value = "0" <?php if($val->professional_tax=='0'){ echo "selected";}?>>No</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Insurance Benefit From Employer</label>
        <select class="form-control"  name="insurance_benefit"> 
            <option value = "">-------Select-------</option>
            <option value = "1" <?php if($val->insurance_benefit=='1'){ echo "selected";}?>>Yes</option>
            <option value = "0" <?php if($val->insurance_benefit=='0'){ echo "selected";}?>>No</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Any Contribution To PF For Whole Experience</label>
        <input type="text" class="form-control" name="any_contribution" value="<?php echo $val->any_contribution; ?>" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Salary Payment Mode</label>
        <select class="form-control"  name="payment_mode"> 
            <option value = "">-------Select-------</option>
            <option value = "Cash" <?php if($val->payment_mode=='Cash'){ echo "selected";}?>>Cash</option>
            <option value = "Account" <?php if($val->payment_mode=='Account'){ echo "selected";}?>>Account</option>
        </select>
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="ex_remark" value="<?php echo $val->ex_remark; ?>"><?php echo $val->ex_remark; ?></textarea>
    </div>


      <div class="col-md-12" style="padding:20px;">                                                
        <button class="btn btn-success" type="submit">Save</button>           
    </div>        
    </div>
</form>                 
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

<!-----------------------------------------------END------------------------------------>
<?php $i++;} ?>
</tbody>
</table>
</div>
<form class="" action="<?php echo base_url()?>lead/member_exp_save/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(3); ?>" method="post" enctype="multipart/form-data">              
<div class="" style=""> 
<div class="form-group col-md-6">
     <label>Person Name</label>
     <select class="form-control"  name="exp_person"  id="exp_person" onchange="total_exp();" required> 
            <option value = "">Select Name</option>
            <option value = "self">Self</option>
          <?php foreach($all_tab_member as $member){ ?>
            <option value = "<?php echo $member->f_member_name; ?>"><?php echo $member->f_member_name; ?></option>
          <?php } ?>
    </select>
</div>
<hr class="line_break">   
  <div>

    <div class="form-group col-md-6">
        <label>Total Experience</label>
        <input type="text" class="form-control" name="total_experience[]" id="total_experience" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Relevant Experience(yrs)</label>
        <input type="text" class="form-control" name="relevant_experience[]" id="total_relevant" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Are You A Tax Payer</label>
        <select class="form-control"  name="tax_payer[]"> 
            <option value = "">-------Select-------</option>
            <option value = "1">Yes</option>
            <option value = "0">No</option>
        </select>
    </div>
      <div class="form-group col-md-6">
        <label>Tax Deduction By Employer For Whole Experience</label>
        <select class="form-control"  name="whole_eperience[]"> 
            <option value = "">-------Select-------</option>
            <option value = "1">Yes</option>
            <option value = "0">No</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Last Income Tax Return Filed Date</label>
        <input type="date" class="form-control" name="return_filed[]" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Paying Professional Tax</label>
        <select class="form-control"  name="professional_tax[]"> 
            <option value = "">-------Select-------</option>
            <option value = "1">Yes</option>
            <option value = "0">No</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Insurance Benefit From Employer</label>
        <select class="form-control"  name="insurance_benefit[]"> 
            <option value = "">-------Select-------</option>
            <option value = "1">Yes</option>
            <option value = "0">No</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Any Contribution To PF For Whole Experience</label>
        <input type="text" class="form-control" name="any_contribution[]" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Salary Payment Mode</label>
        <select class="form-control"  name="payment_mode[]"> 
            <option value = "">-------Select-------</option>
            <option value = "Cash">Cash</option>
            <option value = "Account">Account</option>
        </select>
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="ex_remark[]"></textarea>
    </div>

      <!--<div class="form-group col-md-1">
          <label></label>
        <button type="button" class="add_form_field_job btn btn-success"> 
        <span style="font-size:16px; font-weight:bold;">+ </span>
    </button>
    </div>-->
  </div>
</div>
<div class="col-md-12" style="padding:20px;">                                                
                              <input class="btn btn-success" type="submit" value="Submit" name="submit" >           
                           </div>
</form>
                </div>
</div>

<script type="text/javascript">
  function total_exp() {
        var txtValue = document.getElementById('exp_person').value;
        var enquiry_id = btoa("<?=$enquiry->Enquery_id?>");
        var x=btoa(txtValue);
        $.ajax({
                        url: '<?=base_url("lead/getexpHtml/")?>'+x+'/'+enquiry_id,
                        type: 'POST', 
                      //dataType : "json",
                        success : function(data)
                        {
                          //alert(data);
                          var json_obj = JSON.parse(data);
                             // alert(json_obj.experience);
                             $("#total_relevant").val(json_obj.relevant);
                             $("#total_experience").val(json_obj.experience); //add input box
                        }
              });
  }
</script>

 <script>
     $(document).ready(function () {
  $('#dtBasicExamplee').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
 </script>