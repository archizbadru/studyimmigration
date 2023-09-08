

<style type="text/css">

/* Loader start */
    
.lds-hourglass {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-hourglass:after {
  content: " ";
  display: block;
  border-radius: 50%;
  width: 0;
  height: 0;
  margin: 8px;
  box-sizing: border-box;
  border: 32px solid #fff;
  border-color: #fff red #fff black;
  animation: lds-hourglass 1.2s infinite;
}
@keyframes lds-hourglass {
  0% {
    transform: rotate(0);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }
  50% {
    transform: rotate(900deg);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }
  100% {
    transform: rotate(1800deg);
  }
}


/* Loader END */




.row{
    margin-left:0px;
    margin-right:0px;
}

#wrapper {
    
    transition: all .4s ease 0s;
    height: 100%
}

#sidebar-wrapper {
    /*margin-left: -150px;
    left: 70px;
    width: 150px;
    background: #222;
    position: fixed;*/
    height: 100%;
    z-index: 10000;
    transition: all .4s ease 0s;
}

.sidebar-nav {
    display: block;
    /*float: left;*/
    width: max-content;
    list-style: none;
    margin: 0;
    padding: 0;
}
#page-content-wrapper {
    padding-left: 0;
    margin-left: 0;
    width: 100%;
    height: auto;
}
#wrapper.active {
    /*padding-left: 150px;*/
}
#wrapper.active #sidebar-wrapper {
    left: 150px;
}

#page-content-wrapper {
  width: 100%;
}

#sidebar_menu li a, .sidebar-nav li a {
    color: #999;
    display: block;
    float: left;
    text-decoration: none;
    width: 150px;
    background: #2c3136;
    border-top: 1px solid #373737;
    border-bottom: 1px solid #1A1A1A;
    -webkit-transition: background .5s;
    -moz-transition: background .5s;
    -o-transition: background .5s;
    -ms-transition: background .5s;
    transition: background .5s;
}
.sidebar_name {
    padding-top: 25px;
    color: #fff;
    opacity: .7;
}

.sidebar-nav li {
  line-height: 40px;
  text-indent: 20px;
}

.sidebar-nav li a {
  color: #999999;
  display: block;
  text-decoration: none;
}

.sidebar-nav li a:hover {
  color: #fff;
  background: #1c1f22;
  text-decoration: none;
  cursor: pointer;
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
  text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
  /*height: 65px;*/
  line-height: 60px;
  font-size: 18px;
}

.sidebar-nav > .sidebar-brand a {
  color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
  color: #1c1f22;
  background: none;
}

#main_icon
{
    float:right;
   padding-right: 8px;
   padding-top:20px;
}
.sub_icon
{
    float:right;
   padding-right: 30px;
   padding-top:10px;
}

@media (max-width:767px) {
#wrapper {
    padding-left: 70px;
    transition: all .4s ease 0s;
}
#sidebar-wrapper {
    left: 70px;
}
#wrapper.active {
    padding-left: 150px;
}
#wrapper.active #sidebar-wrapper {
    left: 150px;
    width: 150px;
    transition: all .4s ease 0s;
}
}
#form_content{
    min-height: 524px;
    max-height: 524px;
    overflow-y: auto;
}
</style>
<div id="wrapper" class="active">  
    <!-- Sidebar -->
            <!-- Sidebar -->
    <div id="sidebar-wrapper" style="width: 15%;min-height: 566px;max-height: 566px; float: left;background: #2c3136;">
        <ul id="sidebar_menu" class="sidebar-nav">
           <li class="sidebar-brand"><a id="menu-toggle" href="#">Tabs<span id="main_icon" class="glyphicon glyphicon-align-justify"></span></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">
            <?php            
            if (!empty($tab_list)) {
                foreach ($tab_list as $key => $value) { ?>
                    <li><a onclick="get_tab_fields(<?=$value['id']?>)"><?=$value['title']?><!--span class="sub_icon glyphicon glyphicon-link"></span--></a></li>                               
                    <?php
                }
            }
            ?>
        </ul>
      </div>
          
      <!-- Page content -->
      <div id="page-content-wrapper">       
        <div class="panel panel-default">
            <div class="panel-heading no-print">
                <b class="">Fields</b>                
                <button class="btn btn-warning btn-sm pull-right"  type="button"  data-toggle="modal" data-target="#form_ruleModal" ><i class="fa fa-plus"></i> Set Rules</button>
            </div>    
            <div class="" id="form_content">
                
            </div>    
        </div>
    </div>
      
</div>
<br>
<br>
<br>
<script type="text/javascript">
      $("a[data-toggle='tab']").click(function(){
          var a    =   $(this).attr('href');
          if(a == "#cmp-custom_form"){            
              $(".comp-status").hide();
              $(".form-btns").hide();
          }else{
              $(".comp-status").show();
              $(".form-btns").show();
          }
      });
      function get_tab_fields(tab_id){
          var comp_id = "<?=$comp_id?>";
          url = "<?=base_url().'form/form/get_tab_fields/'?>"+tab_id+'/'+comp_id;     
          $.ajax({
            type: "POST",
            url: url,
            beforeSend: function(){
              $("#form_content").html("<div class='lds-hourglass text-center'></div>");            
            },      
            success: function(data){                
              $("#form_content").html(data);              
            },
            complete: function (data) {
              query_builder();
              do_chosen();
             }
          });
      }
    $(function(){
      get_tab_fields(1);       
    });    
      function do_chosen(){
        $(".chosen-select").chosen({
          width: "100%"
        });
        $(".tab-process-chosen-select").chosen({
            width: "50%"
        });
      }     
    </script>
