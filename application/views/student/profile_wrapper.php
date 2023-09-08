<style>

body{
    background:#f9f9fb;    
}
.view-account{
    background:#FFFFFF; 
    margin-top:50px;
}
.view-account .pro-label {
    font-size: 13px;
    padding: 4px 5px;
    position: relative;
    top: -5px;
    margin-left: 10px;
    display: inline-block
}

.view-account .side-bar {
    padding-bottom: 30px
}

.view-account .side-bar .user-info {
    text-align: center;
    margin-bottom: 15px;
    padding: 30px;
    color: #616670;
    border-bottom: 1px solid #f3f3f3
}

.view-account .side-bar .user-info .img-profile {
    width: 120px;
    height: 120px;
    margin-bottom: 15px
}

.view-account .side-bar .user-info .meta li {
    margin-bottom: 10px
}

.view-account .side-bar .user-info .meta li span {
    display: inline-block;
    width: 100px;
    margin-right: 5px;
    text-align: right
}

.view-account .side-bar .user-info .meta li a {
    color: #616670
}

.view-account .side-bar .user-info .meta li.activity {
    color: #a2a6af
}

.view-account .side-bar .side-menu {
    text-align: center
}

.view-account .side-bar .side-menu .nav {
    display: inline-block;
    margin: 0 auto
}

.view-account .side-bar .side-menu .nav>li {
    font-size: 14px;
    margin-bottom: 0;
    border-bottom: none;
    display: inline-block;
    float: left;
    margin-right: 15px;
    margin-bottom: 15px
}

.view-account .side-bar .side-menu .nav>li:last-child {
    margin-right: 0
}

.view-account .side-bar .side-menu .nav>li>a {
    display: inline-block;
    color: #9499a3;
    padding: 5px;
    border-bottom: 2px solid transparent
}

.view-account .side-bar .side-menu .nav>li>a:hover {
    color: #616670;
    background: none
}

.view-account .side-bar .side-menu .nav>li.active a {
    color: #40babd;
    border-bottom: 2px solid #40babd;
    background: none;
    border-right: none
}

.theme-2 .view-account .side-bar .side-menu .nav>li.active a {
    color: #6dbd63;
    border-bottom-color: #6dbd63
}

.theme-3 .view-account .side-bar .side-menu .nav>li.active a {
    color: #497cb1;
    border-bottom-color: #497cb1
}

.theme-4 .view-account .side-bar .side-menu .nav>li.active a {
    color: #ec6952;
    border-bottom-color: #ec6952
}

.view-account .side-bar .side-menu .nav>li .icon {
    display: block;
    font-size: 24px;
    margin-bottom: 5px
}

.view-account .content-panel {
    padding: 30px
}

.view-account .content-panel .title {
    margin-bottom: 15px;
    margin-top: 0;
    font-size: 18px
}

.view-account .content-panel .fieldset-title {
    padding-bottom: 15px;
    border-bottom: 1px solid #eaeaf1;
    margin-bottom: 30px;
    color: #616670;
    font-size: 16px
}

.view-account .content-panel .avatar .figure img {
    float: right;
    width: 64px
}

.view-account .content-panel .content-header-wrapper {
    position: relative;
    margin-bottom: 30px
}

.view-account .content-panel .content-header-wrapper .actions {
    position: absolute;
    right: 0;
    top: 0
}

.view-account .content-panel .content-utilities {
    position: relative;
    margin-bottom: 30px
}

.view-account .content-panel .content-utilities .btn-group {
    margin-right: 5px;
    margin-bottom: 15px
}

.view-account .content-panel .content-utilities .fa {
    font-size: 16px;
    margin-right: 0
}

.view-account .content-panel .content-utilities .page-nav {
    position: absolute;
    right: 0;
    top: 0
}

.view-account .content-panel .content-utilities .page-nav .btn-group {
    margin-bottom: 0
}

.view-account .content-panel .content-utilities .page-nav .indicator {
    color: #a2a6af;
    margin-right: 5px;
    display: inline-block
}

.view-account .content-panel .mails-wrapper .mail-item {
    position: relative;
    padding: 10px;
    border-bottom: 1px solid #f3f3f3;
    color: #616670;
    overflow: hidden
}

.view-account .content-panel .mails-wrapper .mail-item>div {
    float: left
}

.view-account .content-panel .mails-wrapper .mail-item .icheck {
    background-color: #fff
}

.view-account .content-panel .mails-wrapper .mail-item:hover {
    background: #f9f9fb
}

.view-account .content-panel .mails-wrapper .mail-item:nth-child(even) {
    background: #fcfcfd
}

.view-account .content-panel .mails-wrapper .mail-item:nth-child(even):hover {
    background: #f9f9fb
}

.view-account .content-panel .mails-wrapper .mail-item a {
    color: #616670
}

.view-account .content-panel .mails-wrapper .mail-item a:hover {
    color: #494d55;
    text-decoration: none
}

.view-account .content-panel .mails-wrapper .mail-item .checkbox-container,
.view-account .content-panel .mails-wrapper .mail-item .star-container {
    display: inline-block;
    margin-right: 5px
}

.view-account .content-panel .mails-wrapper .mail-item .star-container .fa {
    color: #a2a6af;
    font-size: 16px;
    vertical-align: middle
}

.view-account .content-panel .mails-wrapper .mail-item .star-container .fa.fa-star {
    color: #f2b542
}

.view-account .content-panel .mails-wrapper .mail-item .star-container .fa:hover {
    color: #868c97
}

.view-account .content-panel .mails-wrapper .mail-item .mail-to {
    display: inline-block;
    margin-right: 5px;
    min-width: 120px
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject {
    display: inline-block;
    margin-right: 5px
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label {
    margin-right: 5px
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label:last-child {
    margin-right: 10px
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label a,
.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label a:hover {
    color: #fff
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-1 {
    background: #f77b6b
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-2 {
    background: #58bbee
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-3 {
    background: #f8a13f
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-4 {
    background: #ea5395
}

.view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-5 {
    background: #8a40a7
}

.view-account .content-panel .mails-wrapper .mail-item .time-container {
    display: inline-block;
    position: absolute;
    right: 10px;
    top: 10px;
    color: #a2a6af;
    text-align: left
}

.view-account .content-panel .mails-wrapper .mail-item .time-container .attachment-container {
    display: inline-block;
    color: #a2a6af;
    margin-right: 5px
}

.view-account .content-panel .mails-wrapper .mail-item .time-container .time {
    display: inline-block;
    text-align: right
}

.view-account .content-panel .mails-wrapper .mail-item .time-container .time.today {
    font-weight: 700;
    color: #494d55
}

.drive-wrapper {
    padding: 15px;
    background: #f5f5f5;
    overflow: hidden
}

.drive-wrapper .drive-item {
    width: 130px;
    margin-right: 15px;
    display: inline-block;
    float: left
}

.drive-wrapper .drive-item:hover {
    box-shadow: 0 1px 5px rgba(0, 0, 0, .1);
    z-index: 1
}

.drive-wrapper .drive-item-inner {
    padding: 15px
}

.drive-wrapper .drive-item-title {
    margin-bottom: 15px;
    max-width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
}

.drive-wrapper .drive-item-title a {
    color: #494d55
}

.drive-wrapper .drive-item-title a:hover {
    color: #40babd
}

.theme-2 .drive-wrapper .drive-item-title a:hover {
    color: #6dbd63
}

.theme-3 .drive-wrapper .drive-item-title a:hover {
    color: #497cb1
}

.theme-4 .drive-wrapper .drive-item-title a:hover {
    color: #ec6952
}

.drive-wrapper .drive-item-thumb {
    width: 100px;
    height: 80px;
    margin: 0 auto;
    color: #616670
}

.drive-wrapper .drive-item-thumb a {
    -webkit-opacity: .8;
    -moz-opacity: .8;
    opacity: .8
}

.drive-wrapper .drive-item-thumb a:hover {
    -webkit-opacity: 1;
    -moz-opacity: 1;
    opacity: 1
}

.drive-wrapper .drive-item-thumb .fa {
    display: inline-block;
    font-size: 36px;
    margin: 0 auto;
    margin-top: 20px
}

.drive-wrapper .drive-item-footer .utilities {
    margin-bottom: 0
}

.drive-wrapper .drive-item-footer .utilities li:last-child {
    padding-right: 0
}

.drive-list-view .name {
    width: 60%
}

.drive-list-view .name.truncate {
    max-width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
}

.drive-list-view .type {
    width: 15px
}

.drive-list-view .date,
.drive-list-view .size {
    max-width: 60px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
}

.drive-list-view a {
    color: #494d55
}

.drive-list-view a:hover {
    color: #40babd
}

.theme-2 .drive-list-view a:hover {
    color: #6dbd63
}

.theme-3 .drive-list-view a:hover {
    color: #497cb1
}

.theme-4 .drive-list-view a:hover {
    color: #ec6952
}

.drive-list-view td.date,
.drive-list-view td.size {
    color: #a2a6af
}

@media (max-width:767px) {
    .view-account .content-panel .title {
        text-align: center
    }
    .view-account .side-bar .user-info {
        padding: 0
    }
    .view-account .side-bar .user-info .img-profile {
        width: 60px;
        height: 60px
    }
    .view-account .side-bar .user-info .meta li {
        margin-bottom: 5px
    }
    .view-account .content-panel .content-header-wrapper .actions {
        position: static;
        margin-bottom: 30px
    }
    .view-account .content-panel {
        padding: 0
    }
    .view-account .content-panel .content-utilities .page-nav {
        position: static;
        margin-bottom: 15px
    }
    .drive-wrapper .drive-item {
        width: 100px;
        margin-right: 5px;
        float: none
    }
    .drive-wrapper .drive-item-thumb {
        width: auto;
        height: 54px
    }
    .drive-wrapper .drive-item-thumb .fa {
        font-size: 24px;
        padding-top: 0
    }
    .view-account .content-panel .avatar .figure img {
        float: none;
        margin-bottom: 15px
    }
    .view-account .file-uploader {
        margin-bottom: 15px
    }
    .view-account .mail-subject {
        max-width: 100px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis
    }
    .view-account .content-panel .mails-wrapper .mail-item .time-container {
        position: static
    }
    .view-account .content-panel .mails-wrapper .mail-item .time-container .time {
        width: auto;
        text-align: left
    }
}

@media (min-width:768px) {
    .view-account .side-bar .user-info {
        padding: 0;
        padding-bottom: 15px
    }
    .view-account .mail-subject .subject {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis
    }
}

@media (min-width:992px) {
    .view-account .content-panel {
        min-height: 800px;
        border-left: 1px solid #f3f3f7;
        margin-left: 300px
    }
    .view-account .mail-subject .subject {
        max-width: 280px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis
    }
    .view-account .side-bar {
        position: absolute;
        width: 300px;
        min-height: 600px;
    }
    .view-account .side-bar .user-info {
        margin-bottom: 0;
        border-bottom: none;
        padding: 15px;
    }
    .view-account .side-bar .user-info .img-profile {
        width: 120px;
        height: 120px
    }
    .view-account .side-bar .side-menu {
        text-align: left
    }
    .view-account .side-bar .side-menu .nav {
        display: block
    }
    .view-account .side-bar .side-menu .nav>li {
        display: block;
        float: none;
        font-size: 14px;
        border-bottom: 1px solid #f3f3f7;
        margin-right: 0;
        margin-bottom: 0
    }
    .view-account .side-bar .side-menu .nav>li>a {
        display: block;
        color: #9499a3;
        padding: 10px 15px;
        padding-left: 30px
    }
    .view-account .side-bar .side-menu .nav>li>a:hover {
        background: #f9f9fb
    }
    .view-account .side-bar .side-menu .nav>li.active a {
        background: #f9f9fb;
        border-right: 4px solid #40babd;
        border-bottom: none
    }
    .theme-2 .view-account .side-bar .side-menu .nav>li.active a {
        border-right-color: #6dbd63
    }
    .theme-3 .view-account .side-bar .side-menu .nav>li.active a {
        border-right-color: #497cb1
    }
    .theme-4 .view-account .side-bar .side-menu .nav>li.active a {
        border-right-color: #ec6952
    }
    .view-account .side-bar .side-menu .nav>li .icon {
        font-size: 24px;
        vertical-align: middle;
        text-align: center;
        width: 40px;
        display: inline-block
    }
}
.module {
    border: 1px solid #f3f3f3;
    border-bottom-width: 2px;
    background: #fff;
    margin-bottom: 30px;
    position: relative;
    border-radius: 4px;
    background-clip: padding-box;
}
.module .module-footer {
    background: #fff;
    border-top: 1px solid #f3f3f7;
    padding: 15px;
}
.module .module-footer a {
    color: #9499a3;
}

.hoverbox
{
  border: 2px solid black;
  position:absolute;
  color: white;
  font-size:12px;
  text-align: center;
  width:100px;
  background-color: gray;
}
</style>
<div class="container-fluid">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        <img class="img-profile img-circle img-responsive center-block" src="<?php if(!empty($this->session->picture)){ echo 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/'.$this->session->awsfolder.'/'.$this->session->picture; }else{ echo 'https://bootdey.com/img/Content/avatar/avatar6.png'; } ?>" alt="">
                        <ul class="meta list list-unstyled">
                            <li class="name"><?php echo $student_Details['name'].' '.$student_Details['lastname']; ?></li>
                            <li class="email"><label class="label label-info">Applicant</label></li>
                            <li class="activity">Last logged in: Today at <?php echo $newDate = date("H:i a", strtotime($last_login->lg_date_time)); ?></li>
                        </ul>
                    </div>
                    <nav class="side-menu" style="height:449px;overflow-y: auto;">
                        <ul class="nav nav-tabs hideScroll" role="tablist">
                            <li class="<?php if(empty($this->uri->segment(4))){ echo 'active';};?>"><a href="#profile" data-toggle="tab"><span class="fa fa-user"></span> Profile</a></li>
                            <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='family'){ echo 'active';}};?>"><a href="#family_new" id="tab_family_new" data-toggle="tab"><span class="fa fa-users"></span> Family</a></li>
                            <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='education'){ echo 'active';}};?>"><a href="#education" id="tab_edu_new" data-toggle="tab"><span class="fa fa-graduation-cap"></span> Qualifications</a></li>
                            <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='qalification'){ echo 'active';}};?>"><a href="#qalification" id="tab_education_new" data-toggle="tab"><span class="fa fa-graduation-cap"></span> Education(Test)</a></li>
                            <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='jobdetail'){ echo 'active';}};?>"><a href="#jobdetail" id="tab_job_new" data-toggle="tab"><span class="fa fa-briefcase"></span> Job details</a></li>
                            <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='experience'){ echo 'active';}};?>"><a href="#experience" id="tab_experience_new" data-toggle="tab"><span class="fa fa-wpexplorer"></span> Experience</a></li>
                            <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='payment'){ echo 'active';}};?>"><a href="#payment" id="tab_payment_new" data-toggle="tab"><span class="fa fa-credit-card-alt"></span> Payment</a></li>
<?php if(!empty($ref_req_form->enquiry_id)){ ?>
                            <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='refund'){ echo 'active';}};?>"><a href="#refund" id="tab_refund_new" data-toggle="tab"><span class="fa fa-retweet"></span> Refund Request</a></li>
<?php } ?>
                            <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='agreement'){ echo 'active';}};?>"><a href="#aggrement_new" id="tab_agreement_new" data-toggle="tab"><span class="fa fa-file-pdf-o"></span> Agreement</a></li>
                            <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='document'){ echo 'active';}};?>"><a href="#document_new" id="tab_document_new" data-toggle="tab"><span class="fa fa-file-o"></span> Documents</a></li>
                            <li class="<?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='ticket'){ echo 'active';}};?>"><a href="#ticket" id="tab_ticket_new" data-toggle="tab"><span class="fa fa-ticket"></span> Ticket</a></li>
                            <!--<li><a href="#"><span class="fa fa-clock-o"></span> Task</a></li>-->
                            <li><a href="#faq-tab" id="tab_faq_new" data-toggle="tab"><span class="fa fa-key"></span> FAQ's</a></li>
                            <li><a href="#url-tab" id="tab_url_new" data-toggle="tab"><span class="fa fa-globe"></span> Access Urls</a></li>
                            <li><a href="#timeline-tab" id="tab_timeline" data-toggle="tab"><span class="fa fa-line-chart"></span> Timeline</a></li>
                            <li><a href="#login-tab" id="tab_logintrail_new" data-toggle="tab"><span class="fa fa-key"></span> Login details</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="tab-content clearfix">
                
<?php $this->load->view('tab_profile.php'); ?>
<?php $this->load->view('tab_family.php'); ?>
<?php $this->load->view('tab_payment.php'); ?>
<?php $this->load->view('tab_refund.php'); ?>
<?php // include('tab_aggriment.php'); ?>
<?php $this->load->view('tab_aggriment_new.php'); ?>
<?php $this->load->view('tab_document_new.php'); ?>
<?php $this->load->view('tab_education.php'); ?>
<?php $this->load->view('tab_qualification.php'); ?>
<?php $this->load->view('tab_login_trail.php'); ?>
<?php $this->load->view('tab_jobdetail.php'); ?>
<?php $this->load->view('tab_experience.php'); ?>
<?php $this->load->view('tab_faq.php'); ?>
<?php $this->load->view('tab_ticket.php'); ?>
<?php $this->load->view('tab_urls.php'); ?>
<?php $this->load->view('tab_timeline.php'); ?>
              </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">

/*$("#tab_family_new").on('click',function(){
    $("#family_new").load("<?=base_url().'enquiry/get_family_tab_content/'.$user_enq_no?>");
  })

$("#tab_education_new").on('click',function(){
    $("#qalification").load("<?=base_url().'enquiry/get_education_tab_content/'.$user_enq_no?>");
  })

$("#tab_job_new").on('click',function(){
    $("#jobdetail").load("<?=base_url().'enquiry/get_job_tab_content/'.$user_enq_no?>");
  })

$("#tab_experience_new").on('click',function(){
    $("#experience").load("<?=base_url().'enquiry/get_experience_tab_content/'.$user_enq_no?>");
  })

$("#tab_payment_new").on('click',function(){
    $("#payment").load("<?=base_url().'enquiry/get_payment_tab_content/'.$user_enq_no?>");
  })

$("#tab_agreement_new").on('click',function(){
    $("#aggrement_new").load("<?=base_url().'enquiry/get_agreement_tab_content/'.$user_enq_no?>");
  })

$("#tab_document_new").on('click',function(){
    $("#document_new").load("<?=base_url().'enquiry/get_document_tab_content/'.$user_enq_no?>");
  })

$("#tab_logintrail_new").on('click',function(){
    $("#login-tab").load("<?=base_url().'enquiry/get_logintrail_tab_content/'.$user_enq_no?>");
  })
*/
$(function(){
    $("[data-toggle='tooltip']").tooltip();
})
</script>
<script type="text/javascript">
$( ".titlehover" ).hover(
  function() {   
   var title = $(this).attr("data-title");
    $('<div/>', {
        text: title,
        class: 'hoverbox'
    }).appendTo(this); 
  }, function() {
    $(document).find("div.hoverbox").remove();
  }
);
</script>