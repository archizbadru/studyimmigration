<div class="row">
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("setting/remindermsg") ?>"> <i class="fa fa-list"></i> <?= display('reminder_template') ?> </a> 
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card-body">
                        <form action="<?= base_url('setting/insertSetting') ?>" method="POST" >
                             <div class="card-body">
                             <div class="row">
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lead_source_name">Message Type</label>
                                    <select class="form-control" name="type" id="type" onchange="get_fnction()">
                                        <option value="" selected="">Select</option>
                                        <option value="1">Agreement Generated</option>
                                        <option value="2">Refund Form Allow</option>
                                        <option value="3">Agent Raise Ticket</option>
                                        <option value="4">Payment Reminder</option>
                                        <option value="5">Student Raise Ticket </option>
                                        <option value="7">Signed Agreement Submited</option>
                                        
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lead_source_name">Message</label>
                                    <textarea name="message"  rows="8" class="form-control" id="message"></textarea>
                                </div>
                                </div>
                                <div class="col-md-4" >
                                <div class="form-group">
                                   <span id="messageData" style="margin-top:50px;color:red;" ></span>
                                </div>
                                </div>
                                
                            </div>
                            </div>
                            <div class="row">
                            <div class="card-footer">
                                <button type="reset" class="btn btn-default"><?php echo display('reset') ?></button> &nbsp;<button class="btn btn-primary"><?php echo display('save') ?></button>
                            </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function get_fnction(){
   var type= $( "#type option:selected" ).val();
$.ajax({
            url: '<?php echo base_url();?>setting/fetchTemplate/0',
            type: 'POST',    
             data: {type:type},
            success: function(data) {      
            $('#messageData').html(data);
            }
        });
        $.ajax({
            url: '<?php echo base_url();?>setting/fetchTemplate/1',
            type: 'POST',    
             data: {type:type},
            success: function(data) {      
            $('#message').val(data);
            }
        });
    }
</script>