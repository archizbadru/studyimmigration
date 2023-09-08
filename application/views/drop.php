

<div class="row">

    <!--  table area --> 

    <div class="col-sm-12"> 



        <div class="panel panel-default thumbnail"> 

       <div class="col-md-12">

           

           <?php if($this->session->flashdata('SUCCESSMSG')) { ?>

                                   <div role="alert" class="alert alert-success">

                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>

                                           

                                           <?=$this->session->flashdata('SUCCESSMSG')?>

                                   </div>

                           <?php } ?>

           

           

           <button class="btn btn-sm btn-success" style="float: left" type="button" data-toggle="modal" data-target="#createnewReason"><i class="fa fa-plus"></i> Add New Drop Reason</button>

        

        

        <div class="btn-group col-md-1" role="group" aria-label="Button group" style="float: right">

            <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

              <i class="fa fa-check-circle"></i>&nbsp;

              

            </button>  

            <div class="dropdown-menu" style="max-height: 400px; overflow: auto; position: absolute; will-change: transform; top: 26px; left: 0px; margin-left: -110px; transform: translate3d(0px, -7px, 0px);" x-placement="top-start">

               <ul style="list-style-type:none;">

                   <li><label><input type="checkbox" onclick="hide_td('th0','tt0')" id="tt0" checked> S.No.</label></li>

                    <li><label><input type="checkbox" onclick="hide_td('th1','tt1')" id="tt1" checked> Name</label></li>

                    <li><label><input type="checkbox" onclick="hide_td('th2','tt2')" id="tt2" checked> Mobile</label></li>

                    <li><label><input type="checkbox" onclick="hide_td('th3','tt3')" id="tt3" checked> Email</label></li>

                    <li><label><input type="checkbox" onclick="hide_td('th4','tt4')" id="tt4" checked> Address</label></li>

                    <li><label><input type="checkbox" onclick="hide_td('th5','tt5')" id="tt5" checked> Status</label></li>

                    



                   

               </ul>

                

            </div>   

            <br>

            

            

          </div>

        

        

        

        

        </div>

        <br>

        

            <div class="panel-body">

                <table width="100%" class="datatable table table-striped table-bordered table-hover">

                    <thead>

                        <tr>

                            <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1"><input type='checkbox' class="checked_all" value="check all" >&nbsp; <?php echo display('serial') ?></th>

                            <th class="th1">Drop Reason</th>

                            <th>Action</th>

                            

                            

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($drops)) { ?>

                            <?php $sl = 1; ?>

                            <?php foreach ($drops as $drop) { ?>

                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="cursor:pointer;" >

                                    <td class="th0">
                                      <input type='checkbox' onclick="event.stopPropagation();" name='enquiry_id[]' class="checkbox" value='<?php echo $drop->d_id;?>' style="display: inline;" >
                                      &nbsp; <?php echo $sl;?></td>

                                    

                                    <td class="th1"><?php echo $drop->drop_reason; ?></td>

                                    <td class="center">

                                        <a  class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#Editreason<?php echo $drop->d_id;?>"><i class="fa fa-edit"></i></a> 

                                        <a href="<?php echo base_url("lead/delete_dropReason/$drop->d_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 

                                    </td>

                                   

                                    

                                </tr>

                                

        

<div id="Editreason<?php echo $drop->d_id;?>" class="modal fade" role="dialog">

  <div class="modal-dialog">

 

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Edit Drop Reason</h4>

      </div>

      <div class="modal-body">

        <!--<form>-->

            <?php echo form_open_multipart('lead/update_drop','class="form-inner"') ?>                      

                                       

           

              <div class="row">

                

                <div class="form-group col-sm-12"> 

                  <label>Drop Reason*</label>

                  <input type="hidden" name="drop_id" value="<?php echo $drop->d_id;?>">

                  <input class="form-control" name="reason" type="text" value="<?php echo $drop->drop_reason;?>" required="">  

                </div>                

               

                

                

                

                

              </div>          

              <div class="col-12" style="padding: 0px;">

                <div class="row">              

                  <div class="col-12" style="text-align:center;">                                                

                    <button class="btn btn-success" type="submit">Save</button>            

                  </div>

                </div>                                   

              </div> 

                  

         

      </form> 

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>

</div>

        

   

                                <?php $sl++; ?>

                            <?php } ?> 

                        <?php } ?> 

                    </tbody>

                </table>  <!-- /.table-responsive -->

                

                



            </div>

        </div>

        

        

        

       

        

    </div>

</div>

<script>

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

        

        



$( "#service" ).click(function() {     

    if($('#another-element:visible').length)

        $('#another-element').hide();

    else

        $('#another-element').show();        

});





$( "#task_create_div" ).click(function() {     

    if($('#task_create:visible').length)

        $('#task_create').hide();

    else

        $('#task_create').show();        

});





</script>





<style>

    input[type=number]::-webkit-inner-spin-button, 

input[type=number]::-webkit-outer-spin-button { 

  -webkit-appearance: none; 

  margin: 0; 

}



input[type=number]::-webkit-inner-spin-button, 

input[type=number]::-webkit-outer-spin-button { 

    -webkit-appearance: none;

    -moz-appearance: none;

    appearance: none;

    margin: 0; 

}



</style>



<!--------------- ADD NEW Drop Reason ------------->



        

<div id="createnewReason" class="modal fade" role="dialog">

  <div class="modal-dialog">

 

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Create New Drop Reason</h4>

      </div>

      <div class="modal-body">

        <!--<form>-->

            <?php echo form_open_multipart('lead/add_drop','class="form-inner"') ?>                      

                                       

           

              <div class="row">

                

                <div class="form-group col-sm-12"> 

                  <label>Drop Reason*</label>

                  <input class="form-control" name="reason" type="text" required="">  

                </div>                

               

                

                

                

                

              </div>          

              <div class="col-12" style="padding: 0px;">

                <div class="row">              

                  <div class="col-12" style="text-align:center;">                                                

                    <button class="btn btn-success" type="submit">Save</button>            

                  </div>

                </div>                                   

              </div> 

                  

         

      </form> 

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>

</div>

        

        

 



<script>

    

function hide_td(id,id2){

 var a=   document.getElementById(id2);

 if(a.checked==true){   

  $('.'+id).css('visibility','visible');

$('.'+id).css('display','table-cell');  

  //  document.getElementsByClassName("th1").style.visibility = "hidden";

}else{

    $('.'+id).css('visibility','hidden');

$('.'+id).css('display','none');

    



}

}

    

    

</script>