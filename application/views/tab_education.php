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
   <div class="tab-pane <?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='education'){ echo 'active';}};?>" id="education">
    <div class="content-panel">
                <hr>
                <div class="table-responsive" style="overflow-y: scroll;">

<table id="dtBasicExampleq" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">S.No</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Education</th>
          <th class="th-sm">From</th>
          <th class="th-sm">To</th>
          <th class="th-sm">Course name</th>
          <th class="th-sm">university name</th>
          <th class="th-sm">Institution name</th>
          <th class="th-sm">year awarded</th>
          <th class="th-sm">Remark</th>
          <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
          <th class="th-sm">Edit Right</th>
          <?php } ?>
      <th class="th-sm">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php $i=1; foreach($tab_education as $val){ ?>
    <tr> 
      <td><?php echo $i; ?></td>
      <td><?php echo $val->e_member_name; ?></td>
      <td><?php foreach($all_education_master as $test){ if($test->id==$val->e_qualification){ echo $test->edu_name;}}; ?></td>
      <td><?php echo $val->e_from; ?></td>
      <td><?php echo $val->e_to; ?></td>
      <td><?php echo $val->e_crsname; ?></td>
      <td><?php echo $val->e_uniname; ?></td>
      <td><?php echo $val->e_institutename; ?></td>
      <td><?php echo $val->e_yearawarded; ?></td>
      <td><?php echo $val->e_remark; ?></td>
      <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
      <td>
        <a href="<?php echo base_url('lead/member_education_edit_right/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>"><span class="label label-primary"><?php if($val->edit_access=='1'){ echo'Unedit'; }else{ echo 'Edit'; } ?><span></a>
      </td>
      <?php } ?>
      <td>
         <?php if(in_array($this->session->userdata('user_right'), applicant) && $val->edit_access=='1'){ ?>
         <a href="#modaledu<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
         <?php } ?>
         <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
          <a href="#modaledu<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
         <a href="<?php echo base_url('lead/member_education_delete/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>" class="titlehover" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
         <?php } ?> 
      </td>
    </tr>
 <!--------------------------------Modal Popup for Detail of Document-------------------------------------------------->
                      
    <div class="modal fade" id="modaledu<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6q" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6q">Update of Education</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
<form class="" action="<?php echo base_url()?>lead/member_education_update/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">
    <div class="modal-body" style="padding: 0px !important;">
        <input type="hidden" class="form-control" name="e_member_id" placeholder="" value="<?php echo $val->id; ?>"> 
      <div class="form-group col-md-6">
     <label>Education Name</label>
     <select class="form-control"  name="e_qualification"> 
            <option value = "">Select Type</option>
            <?php foreach($all_education_master as $test){ ?>
            <option value = "<?php echo $test->id; ?>" <?php if($test->id==$val->e_qualification){ echo 'selected';};?>><?php echo $test->edu_name; ?></option>
            <?php } ?>
    </select>
    </div>
    <div class="form-group col-md-6">
        <label>From</label>
        <input type="date" class="form-control" name="e_from" value = "<?php echo $val->e_from; ?>" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>To</label>
        <input type="date" class="form-control" name="e_to" value = "<?php echo $val->e_to; ?>" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Course Name</label>
        <input type="text" class="form-control" name="e_crsname" value = "<?php echo $val->e_crsname; ?>" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>University Name</label>
        <input type="text" class="form-control" name="e_uniname" value = "<?php echo $val->e_uniname; ?>" placeholder="">
    </div>

    <div class="form-group col-md-5">
      <label>Institute Name</label>
    <input type="text" class="form-control" name="e_institutename" value = "<?php echo $val->e_institutename; ?>" placeholder="">
    </div>

    <div class="form-group col-md-5">
        <label>Year Awarded</label>
        <input type="text" class="form-control" name="e_yearawarded" value = "<?php echo $val->e_yearawarded; ?>" placeholder="">
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="e_remark" value="<?php echo $val->e_remark; ?>"><?php echo $val->e_remark; ?></textarea>
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
<form class="" action="<?php echo base_url()?>lead/member_education_save/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">              
<div class="educationcontainer" style=""> 
<div class="form-group col-md-6">
     <label>Person Name</label>
     <select class="form-control"  name="edu_person"  id="edu_person" required> 
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
     <label>Education Name</label>
     <select class="form-control"  name="e_qualification[]"> 
            <option value = "">Select Type</option>
            <?php foreach($all_education_master as $test){ ?>
            <option value = "<?php echo $test->id; ?>"><?php echo $test->edu_name; ?></option>
            <?php } ?>
    </select>
    </div>
    <div class="form-group col-md-6">
        <label>From</label>
        <input type="date" class="form-control" name="e_from[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>To</label>
        <input type="date" class="form-control" name="e_to[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Course Name</label>
        <input type="text" class="form-control" name="e_crsname[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>University Name</label>
        <input type="text" class="form-control" name="e_uniname[]" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Institute Name</label>
        <input type="text" class="form-control" name="e_institutename[]" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Year Awarded</label>
        <input type="text" class="form-control" name="e_yearawarded[]" placeholder="">
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="e_remark[]"></textarea>
    </div>

      <div class="form-group col-md-1">
          <label></label>
        <button type="button" class="add_form_field_education btn btn-success"> 
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
    var wrapper = $(".educationcontainer");
    var add_button = $(".add_form_field_education");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
                  $.ajax({
                        url: '<?=base_url("lead/geteducationHtml/")?>'+x,
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