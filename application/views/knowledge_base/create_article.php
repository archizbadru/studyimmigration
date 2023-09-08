<link href="<?=base_url().'assets/summernote/summernote-bs4.css'?>" rel="stylesheet" />
<br>
<div class="row">
   <div class="col-lg-10 col-md-offset-1">
      <div class="panel panel-default">
         <div class="panel-heading">            
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?=base_url().'knowledge_base/articles'?>"> <i class="fa fa-list"></i>&nbsp;Articles</a>  
            </div>
         </div>
         <div class="">
            
            <form id="form_validation" data-parsley-validate="" novalidate="" enctype="multipart/form-data" action="<?=base_url()?>knowledge_base/saved_articles/" method="post" class="form-horizontal" style="border:none !important; box-shadow:none !important;">
               <input type="hidden" name="edit" value="<?=!empty($articles_details['id'])?$articles_details['id']:'' ?>">
               <div class="form-group">
                  <label class="col-sm-2 control-label">Title <span
                     class="text-danger">*</span></label>
                  <div class="col-sm-9">
                     <input type="text" name="title" required class="form-control" id="title" value="<?=!empty($articles_details['title'])?$articles_details['title']:'' ?>"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Slug <span
                     class="text-danger">*</span></label>
                  <div class="col-sm-9">
                     <input type="text" name="slug" required class="form-control" id="slug" value="<?=!empty($articles_details['title'])?$articles_details['slug']:'' ?>"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-lg-2 control-label">Category <span
                     class="text-danger">*</span>
                  </label>
                  <div class="col-lg-5">
                     <div class="input-group">
                        <select class="form-control" name="kb_category_id"
                           required>
                           <option value="">Select Category</option>
                           <?php
                           if (!empty($categories)) {
                              foreach ($categories as $key => $value) {?>
                                 <option value="<?=$value['id']?>" <?php if(!empty($articles_details['cat_id']) && $articles_details['cat_id']==$value['id']){ echo "selected=selected";}?>>
                                    <?php echo $value['name']?>                                       
                                 </option>                                 
                              <?php
                              }
                           }
                           ?>
                        </select>                        
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="field-1" class="col-sm-2 control-label">Only for internal</label>
                  <div class="col-sm-9">
                     <div class="checkbox-inline">
                        <label>
                        <input type="checkbox" name="for_all" value="1" <?php if(!empty($articles_details['scope']) && $articles_details['scope']==1){ echo "checked=checked";}?> >
                        </label>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="field-1" class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-9">
                     <div class="col-sm-2 row">
                        <div class="checkbox-inline">
                           <label>
                           <input class="select_one" type="radio" name="status" value="1" <?php if(!empty($articles_details['status']) && $articles_details['status']==1){ echo "checked=''";} ?> >
                           Active</label>
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="checkbox-inline">
                           <label>
                           <input class="select_one" type="radio" name="status" value="0" <?php if(!empty($articles_details) && $articles_details['status']!=1){ echo "checked";}?>>
                           Inactive </label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-9">
                     <textarea class="form-control summernote" name="description" rows="15"><?=!empty($articles_details['description'])?$articles_details['description']:''?></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label for="field-1" class="col-sm-2 control-label">Attachment</label>
                  <div class="col-sm-5">
                     <input type="file" name="kb_attachment[]" multiple="" class="form-control">
                  </div>
                  <?php
                  if (!empty($articles_details)) { ?>
                     <div class="col-sm-4" style="max-height: 400px;max-width: 300px; overflow: scroll;">
                        <?php $file=json_decode($articles_details['attachment']); 
                        $fileextenstin=$file;                     
                        if (!empty($fileextenstin)) {
                           ?>
                           <h2>Uploaded Files</h2>
                           <?php
                           $i = 0;                           
                           foreach($fileextenstin as $filename){ 
                              echo '<div class="file_'.$i.'"><a href='."$filename".' target="_blank" class="btn btn-primary " ><b>'.character_limiter(basename(parse_url($filename)["path"]), 10).'</b></a> <i class="fa fa-trash btn btn-danger" onclick="delete_file(`'.$filename.'`,`'.$i.'`)"></i><br><br></div>';
                              $i++;
                           }                        
                        }
                        ?>
                     </div>
                  <?php
                  }
                  ?>
               </div><br>
               <div class="form-group">
                 <div class="col-sm-offset-2 col-sm-3">
                     <button type="submit" id="file-save-button" class="btn btn-primary btn-block">Save</button>
                 </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script src="<?=base_url().'assets/summernote/summernote-bs4.min.js'?>"></script>
   <?php
   if(empty($articles_details)){
      $articles_details['id'] = '';
   }
   ?>
     <script>

         function delete_file(file_name,i){
            //alert(file_name);
            var url = "<?=base_url().'knowledge_base/remove_article_file'?>"
            var id = "<?=$articles_details['id']?>"
            $.ajax({
              type: "POST",
              url: url,
              data: {'file_to_remove':file_name,'id':id},
              success: function(data)
              {
                  if (data) {
                     alert('File Removed');
                     $(".file_"+i).remove();
                  }
              }
            });
         }

            jQuery(document).ready(function(){

                $('.summernote').summernote({

                    height: 200,                 // set editor height

                    minHeight: null,             // set minimum height of editor

                    maxHeight: null,             // set maximum height of editor

                    focus: false                 // set focus to editable area after initializing summernote

                });

            });

        </script> 