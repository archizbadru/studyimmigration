        <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="<?= base_url('assets_web/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets_web/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('assets_web/css/flaticon.css') ?>" rel="stylesheet" type="text/css"/>
		
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/style.css" type="text/css">

<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400' rel='stylesheet' type='text/css'>
<style>


* {
  box-sizing: border-box;
}

#container{
    margin: 100px auto;
    width: 90%;
    text-align: left;
  position: relative;
}

.widget{


    background-color: #fff;
    font: 11pt Georgia,Times,serif;
    color: #333;
    padding: 7px;
    /*margin: 20px;*/
    width: 100%;
  
}

    .widget ul{
        list-style-position: inside;
    }

.widget h5{
    font-size: 14pt;
    margin: 5px;
}

.new-widget{
    margin: 0px;


    border: 1px solid #ddd;
  border-top: 0;
    background-color: #fff;
    /*padding: 7px;*/
    width: 100%;
    clear: both;
}
    .new-widget ul{
        display: none;
    }

.tab-wrapper{

 /*  margin-left: 1px; */
  
  width: 1000px;
  padding: 0;
 /*  height: 0px; */
  

 
 /*  background: #1abc9c;  */


}


.tab{
 /* width: 100px;*/
  padding: 8px 10px;
  margin-right: 5px;
  font-size: 0.9em;
/*   border: 1px solid red; */
    border-radius: 10px 10px 0 0;
  /* height: 33px; */
    float: left;
    background: #eee;
    text-transform: capitalize;
    color: #333;
    text-align: center;
    /* line-height: 2.0em; */
    cursor: pointer;
    list-style: none!important;
  transition: all 200ms;
/*   border-right: 0.125rem solid #16a085; */
    border-top: 1px solid #ddd;
    border-right: 1px solid #ddd;
    border-left: 1px solid #ddd;


}

.tab:hover {
  background: #428bca;
  color: #fff;
}

.active-tab{
    background: #428bca;
  color: #fff;
}

.active-tab:hover {


}

.tab-content {
  padding: 0 0;
}

/* TABLE STYLING */

.group-table caption {
    background:#428bca;
  color: #fff;
  padding: 8px;
  font-size: 1.4em;
}

.group-table {
    border-top: 1px solid #ddd; 
  width:100%;
    /*  border:1px solid #ddd; */
/*    border-top: none;  */
    border-collapse:collapse;
        padding:5px;
    text-align: center;
    }
    .group-table th {
    /*  border:1px solid #ddd;
    border-top: none; */
        padding: 10px 5px;
    font-weight: normal;
        background:#428bca;
    color: #fff;
    }
    .group-table td {
    /*  border:1px solid #ddd; */
        padding:10px 2px;
    }

td:nth-child(3) {
    /* min-width: 90px; */
}

.group-table th, .group-table td {
  border-right: 1px solid #ddd;
}

.group-table th:last-child, .group-table td:last-child {
  border-right: none;
}

.group-table tr:nth-child(odd) {
  background: #f0f0f0;
}

#morning .group-table td:nth-child(3) {
  background: #fff;
}

.group-table td.align-bottom {
  vertical-align: bottom;
  padding: 0;
}

.group-table td.align-top {
  vertical-align: top;
  padding: 0;  
}

#morning .group-table td:nth-child(3), #afternoon .group-table td:nth-child(3), #evening .group-table td:nth-child(3) {
  background: #fff;
} 

#weekend .group-table td:nth-child(2) {
  background: #fff;
}
</style>
<div class="row">


    <!--  form area -->


    <div class="col-sm-12">


        <div  class="panel panel-default thumbnail">
 

<div id='container'>

  <div class='widget'>
    <div id='Appoinment-history' class="tab-content">

<section class="shoping-cart spad">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="shoping__cart__table">
<table>
<thead>
<tr>
<th class="shoping__product" style="font-size: 15px;">University</th>
<th style="font-size: 15px;">Course</th>
<th style="font-size: 15px;">Rating</th>
<th style="font-size: 15px;">Date</th>
<th style="font-size: 15px;">Timeslot</th>
<th style="font-size: 15px;">Action</th>
</tr>
</thead>
<tbody>
<?php if(!empty($my_history)){ ?>
<?php foreach($my_history as $history){ ?>
<tr>
<td class="shoping__cart__item">
<img src="<?php echo base_url($history->profile_image); ?>" alt="" style="height:80px;">
<h5><?php echo $history->institute_name; ?></h5>
</td>
<td class="shoping__cart__price">
<?php echo $history->course_name; ?>
</td>
<td class="shoping__cart__quantity">
<?php $num=$history->course_rating;  ?>
<?php for($i=0;$i<$num;$i++){ ?>
<i class="fa fa-star" aria-hidden="true" style="color:red;"></i> 
<?php } ?>
</td>
<td class="shoping__cart__total">
<?php echo $history->apdt; ?>
</td>
<td class="shoping__cart__total">
<?php echo $history->tmslt; ?>
</td>
<td class="shoping__cart__item__close">
<span class="icon_close"></span>
</td>
</tr>
<?php } ?>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</section>
    </div>
  </div>

  <div class='widget'>
    <div id='My-wishlist' class="tab-content">
<section class="shoping-cart spad">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="shoping__cart__table">
<table>
<thead>
<tr>
<th class="shoping__product" style="font-size: 15px;">University</th>
<th style="font-size: 15px;">Course</th>
<th style="font-size: 15px;">Rating</th>
<th style="font-size: 15px;">Date</th>
<th style="font-size: 15px;">Action</th>
</tr>
</thead>
<tbody>
<?php if(!empty($my_app)){ ?>
<?php foreach($my_app as $wish){ ?>
<tr>
<td class="shoping__cart__item">
<img src="<?php echo base_url($wish->profile_image); ?>" alt="" style="height:80px;">
<h5><?php echo $wish->institute_name; ?></h5>
</td>
<td class="shoping__cart__price">
<?php echo $wish->course_name_str; ?>
</td>
<td class="shoping__cart__quantity">
<?php $num=$wish->course_rating;  ?>
<?php for($i=0;$i<$num;$i++){ ?>
<i class="fa fa-star" aria-hidden="true" style="color:red;"></i> 
<?php } ?>
</td>
<td class="shoping__cart__total">
<?php echo $wish->created_date; ?>
</td>
<td class="shoping__cart__item__close">
 <a class="btn btn-sm btn-danger" href="<?=base_url().'dashboard/remove_from_wish_list/'.$wish->wid?>" onclick="return confirm('Are you sure ?')" >X</a>
</td>
</tr>
<?php } ?>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</section>   
    </div>
  </div>

</div>
<!-- End of container -->


        </div>


    </div>





</div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var newWidget="<div class='widget-wrapper'> <ul class='tab-wrapper'></ul> <div class='new-widget'></div></div>";
    $(".widget").hide();
    $(".widget:first").before(newWidget);
    $(".widget > div").each(function(){
        $(".tab-wrapper").append("<li class='tab'>"+this.id+"</li>");
        $(this).appendTo(".new-widget");
    });
    $(".tab").click(function(){
        $(".new-widget > div").hide();
        $('#'+$(this).text()).show();
        $(".tab").removeClass("active-tab");
        $(this).addClass("active-tab");
    });
    $(".tab:first").click();

  
  
  
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo base_url()?>demo/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/jquery.slicknav.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/mixitup.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/main.js" type="text/javascript"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="text/javascript"></script>
<script src="<?= base_url('assets_web/js/custom.js') ?>" type="text/javascript"></script> 