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
   <div class="tab-pane <?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='qalification'){ echo 'active';}};?>" id="qalification">
    <div class="content-panel">
                <hr>
                <div style="overflow-x:scroll; ">
<table id="dtBasicExampleq" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">S.No</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Test</th>
          <th class="th-sm">Speaking</th>
          <th class="th-sm">Reading</th>
          <th class="th-sm">Writing</th>
          <th class="th-sm">Listening</th>
          <th class="th-sm">doe</th>
          <th class="th-sm">Remark</th>
      <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
          <th class="th-sm">Edit Right</th>
          <?php } ?>
      <th class="th-sm">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php $i=1; foreach($tab_qualification as $val){ ?>
    <tr> 
      <td><?php echo $i; ?></td>
      <td><?php echo $val->q_member_name; ?></td>
      <td><?php foreach($all_qualification_test as $test){ if($test->id==$val->q_test){ echo $test->test_language_name;}}; ?></td>
      <td><?php echo $val->q_speaking; ?></td>
      <td><?php echo $val->q_reading; ?></td>
      <td><?php echo $val->q_writing; ?></td>
      <td><?php echo $val->q_listening; ?></td>
      <td><?php echo $val->q_doe; ?></td>
      <td><?php echo $val->q_remark; ?></td>
      <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
      <td>
        <a href="<?php echo base_url('lead/member_qualification_edit_right/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>"><span class="label label-primary"><?php if($val->edit_access=='1'){ echo'Unedit'; }else{ echo 'Edit'; } ?><span></a>
    </td>
     
      <?php } ?>
      <td>
        <?php if(in_array($this->session->userdata('user_right'), applicant) && $val->edit_access=='1'){ ?>
         <a href="#modalq<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
       <?php } ?>
         <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
          <a href="#modalq<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
         <a href="<?php echo base_url('lead/member_qualification_delete/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>" class="titlehover" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
         <?php } ?> 
      </td>
    </tr>
 <!--------------------------------Modal Popup for Detail of Document-------------------------------------------------->
                      
    <div class="modal fade" id="modalq<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6q" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6q">Update of Qualification</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
<form class="" action="<?php echo base_url()?>lead/member_qualification_update/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">
    <div class="modal-body" style="padding: 0px !important;">
        <input type="hidden" class="form-control" name="q_member_id" placeholder="" value="<?php echo $val->id; ?>"> 
      <div class="form-group col-md-6">
     <label>Test Name</label>
     <select class="form-control"  name="language_test"> 
            <option value = "">Select Type</option>
            <?php foreach($all_qualification_test as $test){ ?>
            <option value = "<?php echo $test->id; ?>" <?php if($test->id==$val->q_test){ echo 'selected';};?>><?php echo $test->test_language_name; ?></option>
            <?php } ?>
    </select>
    </div>
    <div class="form-group col-md-6">
        <label>Speaking</label>
        <input type="text" class="form-control" name="speaking" value="<?php echo $val->q_speaking; ?>" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Reading</label>
        <input type="text" class="form-control" name="reading" value="<?php echo $val->q_reading; ?>" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Writing</label>
        <input type="text" class="form-control" name="writing" value="<?php echo $val->q_writing; ?>" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Listening</label>
        <input type="text" class="form-control" name="listening" value="<?php echo $val->q_listening; ?>" placeholder="">
    </div>

    <div class="form-group col-md-5">
        <label>Date Of Examination</label>
        <input type="date" class="form-control" name="doe" value="<?php echo $val->q_doe; ?>" placeholder="">
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="q_remark" value="<?php echo $val->q_remark; ?>"><?php echo $val->q_remark; ?></textarea>
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
<form class="" action="<?php echo base_url()?>lead/member_qualification_save/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">              
<div class="qualificationcontainer" style=""> 
<div class="form-group col-md-6">
     <label>Person Name</label>
     <select class="form-control"  name="test_person"  id="test_person" required> 
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
     <label>Test Name</label>
     <select class="form-control"  name="language_test[]"> 
            <option value = "">Select Type</option>
            <?php foreach($all_qualification_test as $test){ ?>
            <option value = "<?php echo $test->id; ?>"><?php echo $test->test_language_name; ?></option>
            <?php } ?>
    </select>
    </div>
    <div class="form-group col-md-6">
        <label>Speaking</label>
        <input type="text" class="form-control" name="speaking[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Reading</label>
        <input type="text" class="form-control" name="reading[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Writing</label>
        <input type="text" class="form-control" name="writing[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Listening</label>
        <input type="text" class="form-control" name="listening[]" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Date Of Examination</label>
        <input type="date" class="form-control" name="doe[]" placeholder="">
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="q_remark[]"></textarea>
    </div>

      <div class="form-group col-md-1">
          <label></label>
        <button type="button" class="add_form_field_qualifcation btn btn-success"> 
        <span style="font-size:16px; font-weight:bold;">+ </span>
    </button>
    </div>
  </div>
</div>
<div class="col-md-12" style="padding:20px;">                                                
                              <input class="btn btn-success" type="submit" value="Submit" name="submit" >           
                           </div>
</form>
                </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".qualificationcontainer");
    var add_button = $(".add_form_field_qualifcation");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
                  $.ajax({
                        url: '<?=base_url("lead/getqualificationHtml/")?>'+x,
                        type: 'POST', 
                        dataType : "json",
                        success : function(data)
                        {
                              $(wrapper).append(data.html); //add input box
                        }
                  });
            
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
</script>
 <script>
     $(document).ready(function () {
  $('#dtBasicExampleq').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
 </script>