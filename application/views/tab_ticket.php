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
   <div class="tab-pane <?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='ticket'){ echo 'active';}};?>" id="ticket">
    <div class="content-panel">
                <hr>
                <div class="table-responsive" style="overflow-y: scroll;">

<table id="dtBasicExamplett" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">S.No</th>
      <th class="th-sm">Action</th>
          <th class="th-sm">Subject</th>
          <th class="th-sm">Description</th>
          <th class="th-sm">Revert Message</th>
          <th class="th-sm">Create Date</th>
          <th class="th-sm">Revert Date</th>
          <th class="th-sm">Status</th>
          <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
            <th class="th-sm">Priority</th>
          <th class="th-sm">Edit Right</th>
        <?php } ?>
    </tr>
  </thead>
  <tbody>
      <?php $i=1; foreach($tab_ticketdata as $val){ ?>
    <tr> 
      <td><?php echo $i; ?></td>
      <td>
        <?php if(in_array($this->session->userdata('user_right'), applicant) && $val->edit_access=='1'){ ?>
         <?php if($val->t_status=='0'){ ?>
         <a href="#modaltt<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
       <?php } ?>
       <?php } ?>
         <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
          <?php if($val->t_status=='0'){ ?>
            <a href="#modaltt<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
          <a href="#modalttr<?= $i?>" class="titlehover" data-title="Revert" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        <?php } ?>
         <a href="<?php echo base_url('lead/member_ticket_delete/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>" class="titlehover" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
         <?php } ?> 
      </td>
      <td><?php foreach ($all_subject as $key => $value) { if($value->id==$val->t_subject){ echo $value->subject_title; }} ?></td>
      <td><?php echo $val->t_description; ?></td>
      <td><?php echo $val->t_reply; ?></td>
      <td><?php echo $val->t_date; ?></td>
      <td><?php echo $val->r_date; ?></td>
      <td><?php if($val->t_status=='0'){ ?>
        <span style="background:#fe4734;padding:5px;border-radius: 10px;color: #fff;">Pending</span>
      <?php }else{ ?>
        <span style="background:#1abc9c;padding:5px;border-radius: 10px;color: #fff;">Done</span>
      <?php } ?>
      </td>
      <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
        <td><?php if($val->t_preority==1){ echo 'Low';}else if($val->t_preority==2){ echo 'Medium';}else if($val->t_preority==3){ echo 'High';}else{ echo 'Not Mention';} ?></td>
      <td>
        <a href="<?php echo base_url('lead/member_ticket_edit_right/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>"><span class="label label-primary"><?php if($val->edit_access=='1'){ echo'Unedit'; }else{ echo 'Edit'; } ?><span></a>
      </td>
      <?php } ?>
      
    </tr>
 <!--------------------------------Modal Popup for Detail of revert-------------------------------------------------->
                      
    <div class="modal fade" id="modalttr<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6tt" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6tt">Update of Ticket</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
<form class="" action="<?php echo base_url()?>lead/member_ticket_reply/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">
    <div class="modal-body" style="padding: 0px !important;">
        <input type="hidden" class="form-control" name="t_ticket_id" placeholder="" value="<?php echo $val->id; ?>"> 
      <div class="form-group col-md-12">
        <label>Ticket Reply</label>
        <textarea class="form-control" name="t_rply"></textarea>
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
<!--------------------------------Modal Popup for ticket of edit-------------------------------------------------->
                      
    <div class="modal fade" id="modaltt<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6tt" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6tt">Update of Ticket</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
<form class="" action="<?php echo base_url()?>lead/member_ticket_update/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">
    <div class="modal-body" style="padding: 0px !important;">
        <input type="hidden" class="form-control" name="t_ticket_id" placeholder="" value="<?php echo $val->id; ?>"> 

    <div class="form-group col-md-6">
        <label>Ticket Priority</label>
      <select class="form-control" name="priority" id="priority">
        <option value="">--Please Select--</option>
        <option value="1" <?php if($val->t_preority==1){ echo 'selected';} ?>>Low</option>
        <option value="2" <?php if($val->t_preority==2){ echo 'selected';} ?>>Medium</option>
        <option value="3" <?php if($val->t_preority==3){ echo 'selected';} ?>>High</option>
      </select>
    </div>

    <div class="form-group col-md-6">
        <label>Ticket Subject</label>
      <select class="form-control" name="t_sub" id="t_sub">
        <option value="">--Please Select--</option>
        <?php foreach ($all_subject as $key => $value) { ?>
        <option value="<?php echo $value->id; ?>" <?php if($value->id==$val->t_subject){ echo 'selected';} ?>><?php echo $value->subject_title; ?></option> 
      <?php } ?>
      </select>
    </div>

    <!-- <div class="form-group col-md-6">
        <label>Subject</label>
        <input type="text" class="form-control" name="t_sub" value = "<?php echo $val->t_subject; ?>" placeholder="">
    </div> -->
      <div class="form-group col-md-12">
        <label>Detail Description</label>
        <textarea class="form-control" name="t_desc" value = "<?php echo $val->t_description; ?>"><?php echo $val->t_description; ?></textarea>
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
<form class="" action="<?php echo base_url()?>lead/member_ticket_save/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">              
<!-- <div class="form-group col-md-6">
        <label>Subject</label>
        <input type="text" class="form-control" name="t_sub" placeholder="">
    </div> -->
    <div class="form-group col-md-6">
        <label>Ticket Subject</label>
      <select class="form-control" name="t_sub" id="t_sub">
        <option value="">--Please Select--</option>
        <?php foreach ($all_subject as $key => $value) { ?>
        <option value="<?php echo $value->id; ?>"><?php echo $value->subject_title; ?></option> 
      <?php } ?>
      </select>
    </div>

      <div class="form-group col-md-6">
        <label>Detail Description</label>
        <textarea class="form-control" name="t_desc"></textarea>
    </div>
<div class="col-md-12" style="padding:20px;">                                                
                              <input class="btn btn-success" type="submit" value="Submit" name="submit" >           
                           </div>
</form>
                </div>
</div>
 <script>
     $(document).ready(function () {
  $('#dtBasicExamplett').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
 </script>