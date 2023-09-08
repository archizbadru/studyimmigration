<style>
 button{margin-left:10px !important;}
.dropdown-toggle .btn{border-radius:none !important;}

.dropdown_width{
  width:700px;bottom:0px !important;overflow-y:scroll !important;
max-height: 300px;
padding:10px;
    
}
@media screen and (max-width: 619px) {
    
    .dropdown_width{
            width: 85vw;
    bottom: 0px !important;
    overflow-y: scroll !important;
    height: 400px;
    height: fit-content;
    padding: 10px;
    margin-left: -20px;
        
            
    }
    #filter-menu-bar .dropdown{
        width: 132px;
    margin-bottom: 2px;
    margin-left: 2px;
    }
    #filter-menu-bar .dropdown-toggle{
        width:100%;
    }
    .container-fluid{
        padding-right: 0px; 
     padding-left: 0px;
    }
    .owl-theme .owl-dots{
            white-space: nowrap;
    max-width: 75vw;
        overflow: hidden;
    }
 
}
@media screen and (min-width: 720px) {
    
    .dropdown_width{
        width:700px;
        bottom:0px !important;
        overflow-y:scroll !important;
        height: 400px;
        height:fit-content;
        padding:10px;
        
            
    }
 
}

 .dropdown_content{background-color: #f2f2f2 ;
 border-radius:0px ;border: 1px solid #a39f9f ;
 color: #545050;margin-left:10px ;margin-top:10px !important}
.pxpadding{
    padding-left:10px;
    padding-right:10px;
    padding-bottom:20px;
}



.course-details h5.title{
    font-size: 18px;
    color: #8499b8;
    color: #88898a;
}
.course-details p.instructors{
        margin-top: -5px;
    font-size: 12px;
    margin-bottom: 1rem;
    color: #958c8c;
    font-weight: 700;
}
.badge-success-lighten{
        font-size: 12px;
    border-radius: 12px;
    color: #545050;
    font-weight: 900;
    padding: 5px;
}
.img-responsive{
width:100%;
max-height:212px;
}
.grid-show{
    border: 1px solid #f5f7fa;
    padding: 10px 0px;
    margin-bottom: 10px;
}
.category-filter-box a{
color: #9bacbe;
margin-bottom:10px;
}
.category-filter-box a.active{
}
.fltr-menu-btn{
    background-color: #f2f2f2;
    border-radius:0px;
    border: 1px solid #a39f9f ;
    color: #545050;
        padding: 5px;
}
.cats-menu-list li{
    display:inline-block;
}
.fltr-execute{
    display:none;
}
.dropdown_content{
    float:left;
    cursor:pointer;
}
.dropdown_content.active{
        background-color: #b2b2ef;
            border: 1px solid #bdbdff;
}
.drop-menu-area{
    width: 100%;
    max-height: 400px;
    display: block;
    overflow: auto;
}
#loader{
    top: 10%;
    left: 0px;
    right: 0px;
    position: fixed;
    height: 100%;
    z-index: 1000;
    background: #fff;
    opacity: 0.7;
    display:none;
    padding-top: 2%;
    text-align: center;
    
}
#loader .fa-spinner{
    font-size: 116px !important;
}
.dropdown-toggle i.fa-caret-up{
       position: absolute;
    bottom: -12px;
    font-size: 28px;
    color: #fff;
    margin-left: 30%;
    display:none;
}
.show .dropdown-toggle i.fa-caret-up{
    display:block;
}

.show>.dropdown-menu{
    margin-top:5px !important;
    border: 1px solid #ccc;
    border-radius: 0px;
    -webkit-box-shadow: 2px 4px 14px -6px rgba(0,0,0,0.75);
-moz-box-shadow: 2px 4px 14px -6px rgba(0,0,0,0.75);
box-shadow: 2px 4px 14px -6px rgba(0,0,0,0.75);
}
ul.pagination-area{
    list-style : none;
}
ul.pagination-area li{
    display:inline-block;
}
.search-box-area{
    float:right;
}
.sts-movie{
        position: absolute;
    background: #fff;
    opacity: 0.5;
    right: 4px;
    padding: 0px 5px;
    top: 5px;
}
</style>
 

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
             <!--   <h4 class="mb-3 header-title">content_list</h4>-->

 
<!-- Item slider-->
<div class="container-fluid">
 <section class="category-course-list-area">
        <div class="category-filter-box filter-box clearfix">

            <span>Showing Total : <?php echo $count_filtered_data.'/'.$all_data_count; ?></span>
            <a href="javascript::" onclick="toggleLayout('grid')" <?php (!empty($_SESSION["layout"]) and $_SESSION["layout"] == "grid") ? "class = 'active'" :""; ?> style="float: right; font-size: 19px; margin-left: 5px;"><i class="fa fa-th"></i></a>
            <a href="javascript::" onclick="toggleLayout('list')"  <?php (!empty($_SESSION["layout"]) and $_SESSION["layout"] == "list") ? "class = 'active'" :""; ?> style="float: right; font-size: 19px;"><i class="fa fa-list" aria-hidden="true"></i></a>
            <a href="<?php echo site_url('user/content'); ?>" style="float: right; font-size: 19px; margin-right: 5px;"><i class="fas fa-sync-alt"></i></a>
        </div>
        <div class="col-md-12">
                <div class="category-course-list">
                <div id="loader"><i class="fa fa-spinner fa-pulse"></i></div>
                    <div class="row" id= "courses-area">
                       
                        
                <?php if(!empty($courses)) { ?>
                        
                    <?php if(!empty($_SESSION["layout"]) and $_SESSION["layout"] == "grid") {                               
                                include("content-grid-view.php");
                            }else{ 
                                include("content-list-view.php");
                            }
                        ?>  
                        
                <?php } else { ?>
                    <div class="col-md-12">
                        <h2>Your filter result not found</h2>
                    </div>
                <?php } ?>
                
                    </div>
                    <nav>
                    <?php
                      //  echo $this->pagination->create_links();
                    ?>
                </nav>
                    <?php  ?>
                </div>
                </div>
                <nav>
             <?php if(!empty($cnttotal[0])){
                    $total = $cnttotal[0];
                           ?><ul>
        
                           
                    </ul>      
            <?php   } ?>
                   
                </nav>
       
</section>
 </div>
</div>


        </div>
    </div>
</div>
<script type="text/javascript">

function toggleLayout(layout) {
    $.ajax({
        type : 'POST',
        url : '<?php echo site_url('home/set_layout_to_session'); ?>',
        data : {layout : layout},
        success : function(response){
            location.reload();
        }
    });
}
</script>

<!-- Item slider end-->

