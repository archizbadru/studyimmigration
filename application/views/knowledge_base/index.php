<style type="text/css">
	
	.ui-menu .ui-menu-item{	    
	    height:35px;
		font-size:30px;
		background-color: white; 
	}
			

</style>

<br>
<div class="row">
   <div class="col-lg-8 col-md-offset-2">          
        <div class="search-box">
    		<h1 class="text-center">How can we help?</h1>
    		<input type="text" name="search" value="" id="kb-search" autocomplete="false" class="form-control" placeholder="Search your question"  style="text-align: center;height: 50px; font-size: 30px;" />
		</div>
	</div>
</div>

<script type="text/javascript">
	  $(function() {
      	
      	//availableTags  = array();

   
   /*var availableTags = [
   				{
   					value:"ActionScript",
   					label:"ActionScript"
   				},
   				{
   					value:"bctionScript",
   					label:"bctionScript"
   				},
   				{
   					value:"cctionScript",
   					label:"cctionScript"
   				}
   ];*/



   $("#kb-search").autocomplete({     	
  	    source: "<?=base_url().'knowledge_base/get_kb_feed'?>",
     	select: function( event, ui ) { 
            window.location.href = 'article_read/'+ui.item.value;
     	}
   });

 });

</script>
