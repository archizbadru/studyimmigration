
                   
<div class="row">
    <!--  table area -->
    <br>
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <br>
           <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                                   <div role="alert" class="alert alert-success">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only"><?php echo $display("close"); ?></span></button>
                                           
                                           <?=$this->session->flashdata('SUCCESSMSG')?>
                                   </div>
                           <?php } ?>
           
           <br>
           <!-------------- body part ------------->
           
           
                          <div class="row">
                                 <center><h4 class="m-t-0 m-b-30 header-title"><?php echo display("add_question"); ?></h4></center>
                            <div class="col-md-8 col-md-offset-2 thumbnail">
                                    
                                     	<?php if($this->session->error!=''){?>
                                     	<div class="col-md-12 btn btn-danger text-left"> <?php echo $this->session->error;?></div>
                                     	<?php } ?>
                                     	<?php if($this->session->success!=''){?>
                                     	<div class="col-md-12 btn btn-success text-left"> <?php echo $this->session->success;?></div>
                                     	<?php } ?>
                                    <form role="form" method="post" id="parameter">
                                         <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo display("select_question_type"); ?></label>
                                           	<select name='Question_type' class="form-control  br_25  m-0 icon_left_input" onChange="hidenop(this.value);">
                                                <option value="1">Multiple Choice Single Answer</option>
                        						<option value="2">Multiple Choice Multiple Answer</option>
                        						<option value="3">Match the Column</option>
                        						<option value="4">Short Answer</option>
                        						<option value="5">Long Answer</option>
                                            	</select>
                                        </div>
                                         <div class="form-group col-md-12" id="number_otion">
                                            <label for="exampleInputEmail1">Number of Options</label>
                                            <input type="text" name="option"  class="form-control br_25  m-0 icon_left_input" placeholder="Number of Options" value="<?php echo set_value('option'); ?>" name="username">
                                                               
                                        </div>
                                           <div class="form-group col-md-12">
                                               <input type="checkbox" name="with_paragraph" value="1"> &nbsp;With Paragraph 
                                           </div>
                                        
                                          <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end col -->

                         

                        </div>
                        
                        
                                    
        
                

            </div>
        </div>
    </div>

