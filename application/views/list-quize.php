
<div class="row">
    <!--  table area -->
    <br>
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <br>
           <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                                   <div role="alert" class="alert alert-success">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                           
                                           <?=$this->session->flashdata('SUCCESSMSG')?>
                                   </div>
                           <?php } ?>
           
           <br>
           
                                    
                    <div class="card-box table-responsive">
                                    
                                    <p class="text-muted font-13 m-b-30">
                                      <a href="<?php echo base_url(); ?>add-questions"><span class="btn label-warning" style="float:right;margin-left:5px;">Add More</span></a>
                                      <!--<a href="<?php echo base_url(); ?>upload-questions"><span class="label btn  label-warning" style="float:right;margin-left:5px;">Upload Question</span></a>
                                      <a href="<?php echo base_url(); ?>assets/files/sampel.csv"><span class="label btn  label-warning" style="float:right;">Download Samples</span></a>-->
                                    </p>
                                    <?php if($this->session->success!=''){?>
                                     	<div class="col-md-12 btn btn-success text-left"> <?php echo $this->session->success;?></div>
                                     	<?php } ?>
	                          <form class="form-horizontals "  action='' method="post" id="login">
                                    <table id="dataTable" class="table table-responsive-sm table-hover table-outline mb-0" style="background: #fff;">
              <thead class="thead-light">
                                        <tr style="background: #f1f3f6;">
                                            
                                        <th width="2%"><input type='checkbox' class="checked_all" value="check all" ></th>
                                        <th style="width: 2%;" title="S.No.">#</th> 
                                       
                                            <th>Question</th>
                                            <th>Question Type</th>
                                           
                                           
                                            <th>Action</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                            <?php $i=1;foreach($get_users as $value){ ?>
                                            <tr>
                                                <td width="30px;"><input type='checkbox' name='user_status[]' class="checkbox" value='<?php echo $value->q_id;?>'></td>
                                           <td width="30px;"><?php echo $i; ?></td>
                                           
                                           <td><?php echo $value->q_question; ?></td>
                                         
                                           <td width="30px;"><?php if($value->q_type==1){?> 
                                            Multiple Choice Single Answer
                        						
                                           <?php }elseif($value->q_type==2){?>
                                           Multiple Choice Multiple Answer
                                            <?php }elseif($value->q_type==3){?>
                                            Match the Column
                                             <?php }elseif($value->q_type==4){?>
                                             Short Answer
                                              <?php }else{?>
                                              Long Answer
                                            <?php } ?></td>
                                         
                                         
                                           <td>
                                                
                                              
                                           </td>
                                           
                                        </tr>
                                        <?php $i++;} ?>
                                        </tbody>
                                    </table>
                                     <button class="btn btn-danger" type="button" onclick="delete_row()">
                                             <i class="ti-trash"></i>
                                                    Delete
                                  </button>
                                  <button class="btn btn-info" type="button"  data-toggle="modal" data-target="#myModal">
                                             <i class="ti-trash"></i>
                                                   Assign Question To module
                                  </button>
                                 
                                </div>
                            </div>
                        </div> <!-- end row -->



                    </div> <!-- container -->

                </div> <!-- content -->

             

            </div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload()">&times;</button>
        <h4 class="modal-title"> Assign Question To module</h4>
      </div>
      <div class="modal-body">
         
            
                 <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1">Select module & assesment Tool</label>
                                            <input type="text" name="parameter" class="form-control">
                                           <!--<select class="form-control" id="level" name="parameter" tabindex="-1" >
                                         <option value="">Select</option> 
                                        <?php foreach($get_parameter as $vl){ ?>
                                             <option value="<?php echo $vl->p_id; ?>"><?php  echo $vl->p_name; ?></option> 
                                             
                                             <?php } ?>
                                            </select>-->
                                        </div>
                                         <button class="btn btn-info" type="button"  onclick="assign_quetion_to()">
                                             <i class="ti-trash"></i>
                                                   Save
                                  </button>
                                        </div>
                                         
                                                             
                                                            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="window.location.reload()">Close</button>
      </div>
    </div>

  </div>
</div>
</form>

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


            </div>
        </div>
    </div>
</div>

<style>
    
[data-letters]:before {
    content: attr(data-letters);
    display: inline-block;
    font-size: 1em;
    width: 2.5em;
    height: 2.5em;
    line-height: 2.5em;
    text-align: center;
    border-radius: 50%;
    background: #37a000;
    vertical-align: middle;
    margin-right: 1em;
    color: white;
}

    
</style>

<script type="text/javascript">
        $('.checked_all').on('change', function() {     
                $('.checkbox').prop('checked', $(this).prop("checked"));              
        });
        $('.checkbox').change(function(){ 
            if($('.checkbox:checked').length == $('.checkbox').length){
                   $('.checked_all').prop('checked',true);
            }else{
                   $('.checked_all').prop('checked',false);
            }
        });
    </script>

<script>
function assign_quetion_to(){
$.ajax({
type: 'POST',
url: '<?php echo base_url();?>question/assign_test',
data: $('#login').serialize()
})
.done(function(data){
    alert(data);
    location.reload();
})
.fail(function() {
alert( "fail!" );

});
}
</script>

