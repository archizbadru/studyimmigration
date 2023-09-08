<br>
<div class="row">
   <div class="col-lg-10 col-md-offset-1">          
   		<div class="panel panel-default">   			
	        <div class="panel-heading">
	    		<h1 class="text-center"><?=$articles_details['title']?></h1>    		
			</div>
			<br>
			<br>
			<div class="panel panel-body">
				<?=$articles_details['description']?>
			</div>	
			<div class="col-md-12" >
				<?php $file=json_decode($articles_details['attachment']); 
				if(!empty($file)){

					$fileextenstin=$file;//explode(',',$file);
					foreach($fileextenstin as $filename){ 
						if(pathinfo($filename, PATHINFO_EXTENSION)=='mp4'||pathinfo($filename, PATHINFO_EXTENSION)=='mp3'||pathinfo($filename, PATHINFO_EXTENSION)=='avi'||pathinfo($filename, PATHINFO_EXTENSION)=='flv'||pathinfo($filename, PATHINFO_EXTENSION)=='wmv'||pathinfo($filename, PATHINFO_EXTENSION)=='mpeg'){ ?>
				         	<video width="100" height="100" controls>
				              <source src="<?=$filename?>" type="video/mp4">
				            </video> 
				            <br>								
							<?php 
						}elseif(pathinfo($filename, PATHINFO_EXTENSION)=='jpg'||pathinfo($filename, PATHINFO_EXTENSION)=='png'||pathinfo($filename, PATHINFO_EXTENSION)=='gif'){?>
							  <img  src="<?=$filename?>" width="100" height="100">
							   <br>
						<?php  
						}elseif(pathinfo($filename, PATHINFO_EXTENSION)=='pdf'){ ?>
						    <a href="<?=$filename?>" width="100" height="100" target="_blank"><?=basename(parse_url($filename)["path"])?></a>
						    <object data="<?=$filename?>" type="application/pdf" width="100%" height="100%">
						    	<a href="<?=$filename?>" width="100" height="100" target="_blank"><?=basename(parse_url($filename)["path"])?></a>							  
							</object>
				            <br>
							<?php 
						}else{ ?>
						    <a href="<?=$filename?>" width="100" height="100" target="_blank"><?=basename(parse_url($filename)["path"])?></a>
				            <br>
							<?php 
						} 
					}
				}
				?>
			</div>
   		</div>
		
	</div>
</div>