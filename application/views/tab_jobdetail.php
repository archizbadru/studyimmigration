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
   <div class="tab-pane <?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='jobdetail'){ echo 'active';}};?>" id="jobdetail">
    <div class="content-panel">
                <hr>
                <div  style="overflow-y: scroll;">
<table  id="dtBasicExamplej" class="table table-striped table-bordered table-sm" cellspacing="0" >
  <thead>
    <tr>
      <th class="th-sm">S.No</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">From</th>
          <th class="th-sm">To</th>
          <th class="th-sm">Still Working</th>
          <th class="th-sm">Designation</th>
          <th class="th-sm">Company</th>
          <!-- <th class="th-sm">Duration</th> -->
          <th class="th-sm">Duration In Year</th>
          <th class="th-sm">Duration In Month</th>
          <th class="th-sm">Relavent</th>
          <th class="th-sm">Remark</th>
          <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
          <th class="th-sm">Edit Right</th>
          <?php } ?>
      <th class="th-sm">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php $i=1; foreach($tab_job_detail as $val){ ?>
    <tr> 
      <td><?php echo $i; ?></td>
      <td><?php echo $val->j_member_name; ?></td>
      <td><?php echo $val->j_from; ?></td>
      <td><?php echo $val->j_to; ?></td>
      <td><?php if($val->still_work=='1'){ echo 'Still Working';}else{ echo '';}; ?></td>
      <td><?php echo $val->j_designation; ?></td>
      <td><?php echo $val->j_company; ?></td>
      <!-- <td><?php echo $val->j_duration; ?></td> -->
      <td><?php echo $val->jy_duration; ?></td>
      <td><?php echo $val->jm_duration; ?></td>
      <td><?php if($val->j_relevant=='1'){ echo 'Yes';}else{ echo 'No';}; ?></td>
      <td><?php echo $val->j_remark; ?></td>
      <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
      <td>
        <a href="<?php echo base_url('lead/member_job_edit_right/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>"><span class="label label-primary"><?php if($val->edit_access=='1'){ echo'Unedit'; }else{ echo 'Edit'; } ?><span></a>
      </td>
    <?php } ?>
      <td>
        <?php if(in_array($this->session->userdata('user_right'), applicant) && $val->edit_access=='1'){ ?>
         <a href="#modalj<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
       <?php } ?>
         <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
          <a href="#modalj<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
         <a href="<?php echo base_url('lead/member_job_delete/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>" class="titlehover" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
         <?php } ?> 
      </td>
    </tr>
 <!--------------------------------Modal Popup for Detail of Document-------------------------------------------------->
                      
    <div class="modal fade" id="modalj<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6j" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6j">Update of Qualification</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
<form class="" action="<?php echo base_url()?>lead/member_job_update/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">
    <div class="modal-body" style="padding: 0px !important;">
        <input type="hidden" class="form-control" name="j_member_id" placeholder="" value="<?php echo $val->id; ?>">

    <div class="form-group col-md-12"> <label>Still Working</label>
        &nbsp;&nbsp;<input type="checkbox" class="" id="stillchk<?php echo $i; ?>" name="still_work" placeholder="" value="1" <?php if($val->still_work=='1'){ echo 'checked';}; ?> onclick="hidto(<?php echo $i; ?>);">
    </div>

      <div class="form-group col-md-6">
        <label>From</label>
        <input type="date" class="form-control" name="from" value="<?php echo $val->j_from; ?>" id="jfrom<?php echo $i; ?>" placeholder="">
    </div>
    
    <div class="form-group col-md-6" id="box<?php echo $i; ?>" style="<?php if($val->still_work=='1'){ echo 'display: none';}; ?>"">
        <label>To</label>
        <input type="date" class="form-control" name="to" value="<?php echo $val->j_to; ?>" id="jto<?php echo $i; ?>" onchange="udrtn(<?php echo $i; ?>);" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Designation</label>
        <input type="text" class="form-control" name="designation" value="<?php echo $val->j_designation; ?>" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Company Name</label>
        <input type="text" class="form-control" name="company" value="<?php echo $val->j_company; ?>" placeholder="">
    </div>

     <div class="form-group col-md-6" style="display: none;">
        <label>Duration In Days</label>
        <input type="text" class="form-control" name="duration" value="<?php echo $val->j_duration; ?>" id="jduration<?php echo $i; ?>" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Duration In Year</label>
        <input type="number" class="form-control" name="yduration" value="<?php echo $val->jy_duration; ?>" id="jyduration<?php echo $i; ?>" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Duration In Month</label>
        <input type="number" class="form-control" name="mduration" value="<?php echo $val->jm_duration; ?>" id="jmduration<?php echo $i; ?>" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label class="form-group col-md-12">Relevant Experience</label>
      <div class="form-group col-md-6"> Yes 
        &nbsp;&nbsp;<input type="checkbox" class="" name="relevant" placeholder="" value="1" <?php if($val->j_relevant=='1'){ echo 'checked';}; ?>>
      </div>
      <div class="form-group col-md-6"> No 
        &nbsp;&nbsp;<input type="checkbox" class="" name="relevant" placeholder="" value="0" <?php if($val->j_relevant=='0'){ echo 'checked';}; ?>>
      </div>
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="j_remark" value="<?php echo $val->j_remark; ?>"><?php echo $val->j_remark; ?></textarea>
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

<form class="" action="<?php echo base_url()?>lead/member_job_save/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">              
<div class="jobcontainer" style=""> 
<div class="form-group col-md-6">
     <label>Person Name</label>
     <select class="form-control"  name="job_person"  id="job_person" required> 
            <option value = "">Select Name</option>
            <option value = "self">Self</option>
          <?php foreach($all_tab_member as $member){ ?>
            <option value = "<?php echo $member->f_member_name; ?>"><?php echo $member->f_member_name; ?></option>
          <?php } ?>
    </select>
</div>
<hr class="line_break">   
  <div>
    
    <div class="form-group col-md-12"> <label>Still Working</label>
        &nbsp;&nbsp;<input type="checkbox" class="" id="stillchk0" name="still_work[]" placeholder="" value="1" onclick="hidto(0);">
    </div>

    <div class="form-group col-md-6">
        <label>From</label>
        <input type="date" class="form-control" name="from[]" id="from0" placeholder="">
    </div>
    
    <div class="form-group col-md-6" id="box0">
        <label>To</label>
        <input type="date" class="form-control" name="to[]" id="to0" onchange="drtn(0);" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Designation</label>
        <input type="text" class="form-control" name="designation[]" placeholder="">
    </div>
      <div class="form-group col-md-6">
        <label>Company Name</label>
        <input type="text" class="form-control" name="company[]" placeholder="">
    </div>

     <div class="form-group col-md-6" style="display: none;">
        <label>Duration In Days</label>
        <input type="text" class="form-control" name="duration[]" id="duration0" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Duration In Year</label>
        <input type="number" class="form-control" name="yduration[]" id="yduration0" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label>Duration In Month</label>
        <input type="number" class="form-control" name="mduration[]" id="mduration0" placeholder="">
    </div>

    <div class="form-group col-md-6">
        <label class="form-group col-md-12">Relevant Experience</label>
      <div class="form-group col-md-6"> Yes 
        &nbsp;&nbsp;<input type="checkbox" class="" name="relevant[]" placeholder="" value="1">
      </div>
      <div class="form-group col-md-6"> No 
        &nbsp;&nbsp;<input type="checkbox" class="" name="relevant[]" placeholder="" value="0">
      </div>
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="j_remark[]"></textarea>
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
    function drtn(val) {
        var txtFirstNumberValue = document.getElementById('from'+val).value;
        var txtSecondNumberValue = document.getElementById('to'+val).value;
        //alert(txtFirstNumberValue);
        var dateFirst = new Date(txtFirstNumberValue);
        var dateSecond = new Date(txtSecondNumberValue);

         // time difference
         var timeDiff = Math.abs(dateSecond.getTime() - dateFirst.getTime());

         // days difference
         var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
      if (!isNaN(diffDays)) {
        $("#duration"+val).val(diffDays);
         //document.getElementById('duration'+x).value = diffDays;
      }
}

function udrtn(val) {
        var txtFirstNumberValue = document.getElementById('jfrom'+val).value;
        var txtSecondNumberValue = document.getElementById('jto'+val).value;
        //alert(txtFirstNumberValue);
        var dateFirst = new Date(txtFirstNumberValue);
        var dateSecond = new Date(txtSecondNumberValue);

         // time difference
         var timeDiff = Math.abs(dateSecond.getTime() - dateFirst.getTime());

         // days difference
         var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
      if (!isNaN(diffDays)) {
        $("#jduration"+val).val(diffDays);
         //document.getElementById('duration'+x).value = diffDays;
      }
}

function hidto(val) {
var checkbox = document.getElementById('stillchk'+val);
    if (checkbox.checked) {
        $('#box'+val).css('display','none');
    } else {
      $('#box'+val).css('display','block');
    }
}
</script>

<script type="text/javascript">
  $(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".jobcontainer");
    var add_button = $(".add_form_field_job");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
                  $.ajax({
                        url: '<?=base_url("lead/getjobHtml/")?>'+x,
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
  $('#dtBasicExamplej').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
 </script>