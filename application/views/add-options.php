<link href="<?php echo base_url(); ?>assets/summernote/summernote-bs4.css" rel="stylesheet" />
<div class="row">
    <!--  table area -->
    <br>
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <br>
           <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                                   <div role="alert" class="alert alert-success">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only"><?php echo display("close"); ?></span></button>
                                           
                                           <?=$this->session->flashdata('SUCCESSMSG')?>
                                   </div>
                           <?php } ?>
           
           <br>
           <!-------------- body part ------------->
           
           
                        
                          <div class="row">
                            <div class="col-md-12">
                                <div class="card-box col-md-12">
                                    <h4 class="m-t-0 m-b-30 header-title"> <?php echo display("add_new"); ?></h4>
                                     	<?php if($this->session->error!=''){?>
                                     	<div class="col-md-12 btn btn-danger text-left"> <?php echo $this->session->error;?></div>
                                     	<?php } ?>
                                     		<?php if($this->session->success!=''){?>
                                     	<div class="col-md-12 btn btn-success text-left"> <?php echo $this->session->success;?></div>
                                     	<?php } ?>
                                     
                                    <form role="form" method="post" id="parameter">
                                         <div class="form-row">
                                         <div class="form-group col-md-6">
                                             <label for="exampleInputEmail1"><?php echo display("question"); ?> </label>
                                                    <textarea class="summernote" name="Question">
                                                       

                                                     </textarea>                  
                                        </div>
                                        <?php $paragraph=explode('_',$this->uri->segment('2'));if($paragraph[1]>0){ ?>
                                        
                                         <div class="form-group col-md-6">
                                               <label for="exampleInputEmail1"><?php echo display("question_paragraph"); ?> </label>
                                                    <textarea class="summernote" name="Paragraph">
                                                       

                                                     </textarea>                  
                                        </div>
                                        <?php } ?>
                                        
                                        
                                         <div class="form-group col-md-6">
                                             <label for="exampleInputEmail1"><?php echo display("question_descreption"); ?></label>
                                                    <textarea class="summernote" name="Discreption">
                                                       

                                                     </textarea>                  
                                        </div>
                                         <input type="hidden" name="question_type" value="<?php echo $this->uri->segment(3); ?>"> 
                                        <?php  if($this->uri->segment(3)==1 || $this->uri->segment(3)==2){
                                            $option=$this->uri->segment(4);
                                        
                                        for($i=1;$i<=$option;$i++){?>
                                         <div class="form-group col-md-6">
                                              <label for="exampleInputEmail1">Option(<?php echo $i; ?>)<br>
                                             <?php  if($this->uri->segment(3)==2){?>
                                              <input type="checkbox" name="correct[]" value="<?php echo $i; ?>" > <?php echo display("select_correct_option"); ?>
                                              <?php }else{ ?>
                                                <input type="radio" name="correct" value="<?php echo $i; ?>" checked> <?php echo display("select_correct_option"); ?>
                                                <?php } ?>
                                              <br>
                                              </label>
                                                    <textarea class="summernote" name="option[]">
                                                       

                                                     </textarea> 
                                                     </div>
                                                     <?php }}elseif($this->uri->segment(3)==4 || $this->uri->segment(3)==5){ ?>
                                                     <div class="form-group col-md-6">
                                                     <label for="exampleInputEmail1"><?php echo display("correct_answer"); ?></label>
                                                      <input type="text" name="correct" class="form-control"   value="" > 
                                                      </div>
                                                     
                                        <?php }elseif($this->uri->segment(3)==3){ 
                                          $option=$this->uri->segment(4);
                                        
                                        for($i=1;$i<=$option;$i++){?>
                                         <div class="form-group col-md-5">
                                            
                                          
                                              <input type="text" name="option[]" class="form-control" value="" > 
                                             </div><div class="form-group col-md-2 text-center">==</div> <div class="form-group col-md-5"> 
                                                <input type="text" name="option1[]"class="form-control" value="" >
                                              
                                             
                                              
                                                  
                                        </div>
                                        
                                        <?php } } ?>
                                        <div class="form-group col-md-3">
                                             <label for="exampleInputEmail1"> <?php echo display("mark_score"); ?></label>
                                                    <input type="text" name="marks_sccore" class="form-control" palceholder="Enter Marks Score ">
                                                      
                                        </div>
                                    
                                        </div>
                                         
                                
                                        <button type="submit" class="btn btn-purple waves-effect waves-light"> <?php echo display("submit"); ?></button>
                                        
                                    </form>
                                </div>
                            </div>
                            <!-- end col -->

                         

                        </div>
                        
                        
                                    
        
                

            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/summernote/summernote-bs4.min.js"></script>
         <script>
            jQuery(document).ready(function(){
                $('.summernote').summernote({
                    height: 100,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });
            });
        </script>

