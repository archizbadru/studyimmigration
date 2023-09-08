<div class="tab-pane <?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='family'){ echo 'active';}};?>" id="family_new">
  <div class="content-panel">
                <hr>
                <div class="table-responsive" style="overflow-y: scroll;">

<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">S.No</th>
	    <th class="th-sm">Member Name</th>
	    <th class="th-sm">Relation</th>
	    <th class="th-sm">Mobile</th>
	    <th class="th-sm">Email</th>
        <th class="th-sm">Age</th>
        <th class="th-sm">Remark</th>
        <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
        <th class="th-sm">Edit</th>
        <?php } ?>
      <th class="th-sm">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php $i=1; foreach($family_tab_view as $val){ ?>
    <tr> 
      <td><?php echo $i; ?></td>
      <td><?php echo $val->f_member_name; ?></td>
	    <td><?php echo $val->f_relation; ?></td>
	    <td><?php echo $val->f_mobile; ?></td>
	    <td><?php echo $val->f_email; ?></td>
        <td><?php echo $val->f_age; ?></td>
        <td><?php echo $val->f_remark; ?></td>
        <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?><td>
        <a href="<?php echo base_url('lead/client_family_edit_right/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>"><span class="label label-primary"><?php if($val->edit_access=='1'){ echo'Unedit'; }else{ echo 'Edit'; } ?><span></a>
    </td>
    <?php } ?>

      <td>
        <?php if(in_array($this->session->userdata('user_right'), applicant) && $val->edit_access=='1'){ ?>
         <a href="#modal1f<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
       <?php } ?>
        <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
        <a href="#modal1f<?= $i?>" class="titlehover" data-title="Edit" data-toggle="modal" data-animation="effect-scale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
         <a href="<?php echo base_url('lead/client_family_delete/'.$val->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>" class="titlehover" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
        <?php } ?>
      </td>
    </tr>
 <!--------------------------------Modal Popup for Detail of Document-------------------------------------------------->
                      
    <div class="modal fade" id="modal1f<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6f" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel6f">Update of Family</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    <div class="modal-body" style="padding: 0px !important;">
      <form action="<?php echo base_url()?>lead/client_family_update/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">
	  <input type="hidden" class="form-control" name="member_id" placeholder="" value="<?php echo $val->id; ?>"> 
	<div class="form-group col-md-6">
        <label>Member Name</label>
        <input type="text" class="form-control" name="family_name" value="<?php echo $val->f_member_name; ?>" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Member Relation</label>
        <input type="text" class="form-control" name="family_relation" value="<?php echo $val->f_relation; ?>" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Member Mobile</label>
        <input type="text" class="form-control" name="family_mobile" value="<?php echo $val->f_mobile; ?>" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Member Email</label>
        <input type="text" class="form-control" name="family_email" value="<?php echo $val->f_email; ?>" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Member Age</label>
        <input type="text" class="form-control" name="family_age" value="<?php echo $val->f_age; ?>" placeholder="">
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="f_remark" value="<?php echo $val->f_remark; ?>"><?php echo $val->f_remark; ?></textarea>
    </div>

	<div class="col-md-12" style="padding:20px;">                                                
        <button class="btn btn-success" type="submit">Save</button>           
    </div>
    </form>		
    </div>			
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
<form class="" action="<?php echo base_url()?>lead/client_family_save/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(1); ?>" method="post" enctype="multipart/form-data">              
<div class="familycontainer" style="">    
  <div>
    <div class="form-group col-md-6">
        <label>Member Name</label>
        <input type="text" class="form-control" name="family_name[]" placeholder="">
    </div>
	<div class="form-group col-md-6">
        <label>Member Relation</label>
        <input type="text" class="form-control" name="family_relation[]" placeholder="">
    </div>
	<div class="form-group col-md-6">
        <label>Member Mobile</label>
        <input type="text" class="form-control" name="family_mobile[]" placeholder="">
    </div>
	<div class="form-group col-md-6">
        <label>Member Email</label>
        <input type="text" class="form-control" name="family_email[]" placeholder="">
    </div>
    <div class="form-group col-md-6">
        <label>Member Age</label>
        <input type="text" class="form-control" name="family_age[]" placeholder="">
    </div>

    <div class="form-group col-md-5">
        <label>Remark</label>
        <textarea class="form-control" name="f_remark[]"></textarea>
    </div>

	<div class="form-group col-md-1">
	    <label></label>
        <button type="button" class="add_form_field_family btn btn-success"> 
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
    var wrapper = $(".familycontainer");
    var add_button = $(".add_form_field_family");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
			$.ajax({
				url: '<?=base_url("lead/getfamilyHtml/")?>'+x,
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
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
 </script>