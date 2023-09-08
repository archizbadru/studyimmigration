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
   <div class="tab-pane <?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='refund'){ echo 'active';}};?>" id="refund">
    <div class="content-panel">
                <hr>
    <div class="text-center">
    <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
    <?php if(empty($ref_req_form->enquiry_id)){ ?>
         <a href="<?php echo base_url('lead/member_refund_form/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>" class="btn btn-primary">Allow Applicant For Refund Form</a>
    <?php }else{ ?>
        <a href="<?php echo base_url('lead/member_refund_form_close/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>" class="btn btn-primary">Disallow Applicant For Refund Form</a>
    <?php } ?>
    <?php } ?>
  </div>
  </br>
<div style="width: 100%;overflow-x: scroll;">
<table id="dtBasicExampler" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">S.No</th>
          <th class="th-sm">Awareness </th>
          <th class="th-sm">Consultant’s </th>
          <th class="th-sm">Explanation </th>
          <th class="th-sm">Cancellation Date </th>
          <th class="th-sm">Reporting person </th>
          <th class="th-sm">Reason </th>
          <th class="th-sm">Medical Reason </th>
          <th class="th-sm">Proof </th>
          <th class="th-sm">Other Options</th>
          <th class="th-sm">Remark </th>
          <th class="th-sm">Eligiblity </th>
          <th class="th-sm">Refund Eligiblity </th>
          <th class="th-sm">Signature </th>
          <th class="th-sm">Place </th>
          <th class="th-sm">Date </th>
          <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
          <th class="th-sm">Edit Right</th>
          <?php } ?>
      <th class="th-sm">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php $i=1; foreach($refund_list as $val){ ?>
    <tr> 
      <td><?php echo $i; ?></td>
      <td><?php if($val->pr_awarness=='1'){ echo 'Yes';}else{ echo 'No';}; ?></td>
      <td><?php echo $val->consultant_name; ?></td>
      <td><?php if($val->explaine_benifit=='1'){ echo 'Yes';}else{ echo 'No';}; ?></td>
      <td><?php echo $val->cancellation_date; ?></td>
      <td><?php echo $val->cancellation_person; ?></td>
      <td><?php echo $val->language_score; ?></td>
      <td><?php echo $val->medical_reason; ?></td>
      <td>
        <?php if(!empty($val->provide_proof)){ ?>
        <a href="<?php echo 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/'.$this->session->awsfolder.'/'.$val->provide_proof; ?>" target="_blank" class="titlehover" data-title="Proof File"><i class="fa fa-file" aria-hidden="true"></i></a>
      <?php } ?>
      </td>
      <td><?php if($val->other_options=='1'){ echo 'Yes';}else{ echo 'No';}; ?></td>
      <td><?php echo $val->r_remark; ?></td>
      <td><?php if($val->proceed_further=='1'){ echo 'Yes';}else{ echo 'No';}; ?></td>
      <td><?php if($val->refund_eligiblity=='1'){ echo 'Yes';}else{ echo 'No';}; ?></td>
      <td>
        <?php if(!empty($val->signature)){ ?>
        <a href="<?php echo 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/'.$this->session->awsfolder.'/'.$val->signature; ?>" target="_blank" class="titlehover" data-title="Signeture"><i class="fa fa-file" aria-hidden="true"></i></a>
      <?php } ?>
      </td>
      <td><?php echo $val->place; ?></td>
      <td><?php echo $val->approve_date; ?></td>
    <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
      <td>
       <a href="<?php echo base_url('lead/member_refund_edit_right/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>"><span class="label label-primary"><?php if($val->edit_access=='1'){ echo'Unedit'; }else{ echo 'Edit'; } ?><span></a>
      </td>
    <?php } ?>
      <td>
        <?php if(in_array($this->session->userdata('user_right'), applicant) && $val->edit_access=='1'){ ?>
         <a href="#modalref<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
       <?php } ?>
         <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
          <a href="#modalref<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
         <a href="<?php echo base_url('lead/member_refund_delete/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>" class="titlehover" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
         <?php } ?> 
      </td>
    </tr>
 <!--------------------------------Modal Popup for Detail of Document-------------------------------------------------->
                      
    <div class="modal fade" id="modalref<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6e" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6e">Update of Refund</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
<form class="" action="<?php echo base_url()?>lead/member_refund_update/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">
    <div class="modal-body" style="padding: 0px !important;">
        <input type="hidden" class="form-control" name="r_member_id" placeholder="" value="<?php echo $val->id; ?>"> 
      <div class="form-group col-md-6">
        <label>Are you aware that PR Visa is multiple a entry Visa?</label>
        <select class="form-control"  name="pr_awarness"> 
            <option value = "">-------Select-------</option>
            <option value = "1" <?php if($val->pr_awarness=='1'){ echo 'selected';} ?>>Yes</option>
            <option value = "0" <?php if($val->pr_awarness=='0'){ echo 'selected';} ?>>No</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Name Immigration Consultant’s you met</label>
        <input type="text" class="form-control" name="consultant_name" value="<?php echo $val->consultant_name; ?>">
    </div>
    <div class="form-group col-md-6">
        <label>Do the Immigration Consultant explained the whole process and benefits of PR Visa?</label>
        <select class="form-control"  name="explaine_benifit"> 
            <option value = "">-------Select-------</option>
            <option value = "1" <?php if($val->explaine_benifit=='1'){ echo 'selected';} ?>>Yes</option>
            <option value = "0" <?php if($val->explaine_benifit=='0'){ echo 'selected';} ?>>No</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Cancellation reporting date.</label>
        <input type="date" class="form-control" name="cancellation_date" value="<?php echo $val->cancellation_date; ?>">
    </div>
    <div class="form-group col-md-6">
        <label>Cancellation reporting person.</label>
        <input type="text" class="form-control" name="cancellation_person" value="<?php echo $val->cancellation_person; ?>">
    </div>
    <hr class="line_break">
    <span class="col-md-12" style="float:left;font-weight: 900;padding-bottom: 20px;">Reason for Cancellation</span>
    <div class="form-group col-md-6">
        <label>Language Score-IELTS/PTE/OET</label>
        <input type="text" class="form-control" name="language_score" value="<?php echo $val->language_score; ?>">
    </div>

    <div class="form-group col-md-6">
        <label>Medical Reason</label>
        <input type="text" class="form-control" name="medical_reason" value="<?php echo $val->medical_reason; ?>">
    </div>
    <div class="form-group col-md-6">
        <label>Please provide proof</label>
        <input type="file" class="form-control" name="provide_proof">
    </div>
    <input type="hidden" class="form-control" name="provide_proof_old" value="<?php echo $val->provide_proof; ?>">
    <div class="form-group col-md-6">
        <label>Ready to proceed with other Options</label>
        <select class="form-control"  name="other_options"> 
            <option value = "">-------Select-------</option>
            <option value = "1" <?php if($val->other_options=='1'){ echo 'selected';} ?>>Yes</option>
            <option value = "0" <?php if($val->other_options=='0'){ echo 'selected';} ?>>No</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Remark</label>
        <textarea class="form-control" name="r_remark" value="<?php echo $val->r_remark; ?>"><?php echo $val->r_remark; ?></textarea>
    </div>
    <hr class="line_break">
<?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
    <div class="form-group col-md-6">
        <label>Are you eligible to proceed further at this stage?</label>
        <select class="form-control"  name="proceed_further"> 
            <option value = "">-------Select-------</option>
            <option value = "1" <?php if($val->proceed_further=='1'){ echo 'selected';} ?>>Yes</option>
            <option value = "0" <?php if($val->proceed_further=='0'){ echo 'selected';} ?>>No</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>As per agreement are you eligible for refund?</label>
        <select class="form-control"  name="refund_eligiblity"> 
            <option value = "">-------Select-------</option>
            <option value = "1" <?php if($val->refund_eligiblity=='1'){ echo 'selected';} ?>>Yes</option>
            <option value = "0" <?php if($val->refund_eligiblity=='0'){ echo 'selected';} ?>>No</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Signature</label>
        <input type="file" class="form-control" name="signature">
    </div>
    <input type="hidden" class="form-control" name="signature_old" value="<?php echo $val->signature; ?>">
    <div class="form-group col-md-6">
        <label>Place</label>
        <input type="text" class="form-control" name="place" value="<?php echo $val->place; ?>">
    </div>
    <div class="form-group col-md-6">
        <label>Date</label>
        <input type="date" class="form-control" name="approve_date" value="<?php echo $val->approve_date; ?>">
    </div>
<?php } ?>
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
<?php if(in_array($this->session->userdata('user_right'), applicant) && empty($ref_req_form->enquiry_id)){ ?>
<div class="text-center">
</br>
<span style="background:#1abc9c;padding:5px;border-radius: 2px;color: #fff;">Go to ticket section and raise ticket for refund form!</span>
</div>
<?php } ?>
<div style="<?php if(!empty($ref_req_form->enquiry_id)){ echo 'display: block';}else{ echo 'display: none'; } ?>">
<form class="" action="<?php echo base_url()?>lead/member_refund_save/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">               
   
  <div style="padding-top: 50px;">
    <div class="form-group col-md-6">
        <label>Are you aware that PR Visa is multiple a entry Visa?</label>
        <select class="form-control"  name="pr_awarness"> 
            <option value = "">-------Select-------</option>
            <option value = "1">Yes</option>
            <option value = "0">No</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Name Immigration Consultant’s you met</label>
        <input type="text" class="form-control" name="consultant_name" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Do the Immigration Consultant explained the whole process and benefits of PR Visa?</label>
        <select class="form-control"  name="explaine_benifit"> 
            <option value = "">-------Select-------</option>
            <option value = "1">Yes</option>
            <option value = "0">No</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Cancellation reporting date.</label>
        <input type="date" class="form-control" name="cancellation_date" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Cancellation reporting person.</label>
        <input type="text" class="form-control" name="cancellation_person" placeholder="">
    </div>
    <hr class="line_break">
    <span class="col-md-12" style="float:left;font-weight: 900;padding-bottom: 20px;">Reason for Cancellation</span>
    <div class="form-group col-md-6">
        <label>Language Score-IELTS/PTE/OET</label>
        <input type="text" class="form-control" name="language_score" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Medical Reason</label>
        <input type="text" class="form-control" name="medical_reason" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Please provide proof</label>
        <input type="file" class="form-control" name="provide_proof" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Ready to proceed with other Options</label>
        <select class="form-control"  name="other_options"> 
            <option value = "">-------Select-------</option>
            <option value = "1">Yes</option>
            <option value = "0">No</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Remark</label>
        <textarea class="form-control" name="r_remark"></textarea>
    </div>
    <hr class="line_break">
<?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
    <div class="form-group col-md-6">
        <label>Are you eligible to proceed further at this stage?</label>
        <select class="form-control"  name="proceed_further"> 
            <option value = "">-------Select-------</option>
            <option value = "1">Yes</option>
            <option value = "0">No</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>As per agreement are you eligible for refund?</label>
        <select class="form-control"  name="refund_eligiblity"> 
            <option value = "">-------Select-------</option>
            <option value = "1">Yes</option>
            <option value = "0">No</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Signature</label>
        <input type="file" class="form-control" name="signature" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Place</label>
        <input type="text" class="form-control" name="place" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Date</label>
        <input type="date" class="form-control" name="approve_date" placeholder="">
    </div>
<?php } ?>
  </div>
                  <div class="col-md-12" style="padding:20px;">                                                
                      <input class="btn btn-success" type="submit" value="Submit" name="submit" >           
                  </div>
</form>
</div>
                </div>
</div>

 <script>
     $(document).ready(function () {
  $('#dtBasicExampler').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
 </script>