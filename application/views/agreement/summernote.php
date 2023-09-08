<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<link href="<?php echo base_url(); ?>assets/summernote/summernote-bs4.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/c3/c3.min.css" rel="stylesheet" type="text/css"  />

                  <label for="message" class="col-xs-3 col-form-label">Agreement Content <i class="text-danger">*</i></label>
                  <div class="col-lg-12">
                     <textarea name="agreement_content" class="form-control summernote"   rows="7"><?php echo $content->template_content; ?></textarea>
                  </div>

<script src="<?php echo base_url('assets/js/editor/editor.js') ?>"></script>
<script src="<?php echo base_url(); ?>assets/summernote/summernote-bs4.min.js"></script>
<script>
   jQuery(document).ready(function(){
   
       $('.summernote').summernote({
   
           height: 200,                 // set editor height
   
           minHeight: null,             // set minimum height of editor
   
           maxHeight: null,             // set maximum height of editor
   
           focus: false                 // set focus to editable area after initializing summernote
   
       });
   
   });
   
</script>