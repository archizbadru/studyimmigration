<style>
  .hide-timeline{
    display: none;
  }
  #toggle_timeline{
    position: fixed;
    top: 94px;
    right: 0;
  }

  .col-height{
    min-height: 700px;
    max-height: 700px;
    overflow-y: auto;
    border-bottom: solid #c8ced3 1px;
  }
  /* select2 css start*/
  .select2-container--default .select2-selection--single .select2-selection__arrow b:before {
    content: "";
  }
  /* select2 css end*/

.cbp_tmtimeline {
  margin: 30px 0 0 0;
  padding: 0;
  list-style: none;
  position: relative;
} 

/* The line */
.cbp_tmtimeline:before {
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  width: 10px;
  background: #afdcf8;
  left: 20%;
  margin-left: -10px;
}

.cbp_tmtimeline > li {
  position: relative;
}

/* The date/time */
.cbp_tmtimeline > li .cbp_tmtime {
  display: block;
  width: 25%;
  padding-right: 100px;
  position: absolute;
}

.cbp_tmtimeline > li .cbp_tmtime span {
  display: block;
  text-align: right;
}

.cbp_tmtimeline > li .cbp_tmtime span:first-child {
  font-size: 0.9em;
  color: #bdd0db;
}

.cbp_tmtimeline > li .cbp_tmtime span:last-child {
  font-size: 2.9em;
  color: #3594cb;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmtime span:last-child {
  color: #6cbfee;
}

/* Right content */
.cbp_tmtimeline > li .cbp_tmlabel {
  margin: 0 0 15px 25%;
  background: #3594cb;
  color: #fff;
  padding: 10px;
  font-size: 1.2em;
  font-weight: 300;
  line-height: 1.4;
  position: relative;
  border-radius: 5px;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel {
  background: #6cbfee;
}

.cbp_tmtimeline > li .cbp_tmlabel h2 { 
  margin-top: 0px;
  padding: 0 0 10px 0;
  border-bottom: 1px solid rgba(255,255,255,0.4);
}

/* The triangle */
.cbp_tmtimeline > li .cbp_tmlabel:after {
  right: 100%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-right-color: #3594cb;
  border-width: 10px;
  top: 10px;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel:after {
  border-right-color: #6cbfee;
}

/* The icons */
.cbp_tmtimeline > li .cbp_tmicon {
  width: 40px;
  height: 40px;
  font-family: 'ecoico';
  speak: none;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  font-size: 1.4em;
  line-height: 40px;
  -webkit-font-smoothing: antialiased;
  position: absolute;
  color: #fff;
  background: #46a4da;
  border-radius: 50%;
  box-shadow: 0 0 0 8px #afdcf8;
  text-align: center;
  left: 20%;
  top: 0;
  margin: 0 0 0 -25px;
}

.cbp_tmicon-phone:before {
  content: "☣";
}

.cbp_tmicon-screen:before {
  content: "☣";
}

.cbp_tmicon-mail:before {
  content: "☣";
}

.cbp_tmicon-earth:before {
  content: "☣";
}

/* Example Media Queries */
@media screen and (max-width: 65.375em) {
  .cbp_tmtimeline > li .cbp_tmtime span:last-child {
    font-size: 1.5em;
  }
}

@media screen and (max-width: 47.2em) {
  .cbp_tmtimeline:before {
    display: none;
  }

  .cbp_tmtimeline > li .cbp_tmtime {
    width: 100%;
    /*position: relative;*/
    padding: 0 0 20px 0;
  }

  .cbp_tmtimeline > li .cbp_tmtime span {
    text-align: left;
  }

  .cbp_tmtimeline > li .cbp_tmlabel {
    margin: 0 0 30px 0;
    padding: 1em;
    font-weight: 400;
    font-size: 95%;
  }

  .cbp_tmtimeline > li .cbp_tmlabel:after {
    right: auto;
    left: 20px;
    border-right-color: transparent;
    border-bottom-color: #3594cb;
    top: -20px;
  }

  .cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel:after {
    border-right-color: transparent;
    border-bottom-color: #6cbfee;
  }

  .cbp_tmtimeline > li .cbp_tmicon {
    position: relative;
    /*float: right;*/
    left: auto;
    margin: -55px 5px 0 10px;
  } 
} 
.dataTables_paginate{
   display: none;
}   
</style>

<div class="tab-pane" id="timeline-tab">
<div class="content-panel">
<div class="col-md-12 col-xs-12 col-sm-12 col-height timeline">
        <!--<h3 class="text-center">Activity Timeline</h3><hr>-->
        <div id="exTab4" class="">
            <ul  class="nav nav-tabs hideScroll tscroll" role="tablist" style="margin-top: 18px;">  
                <span style="position: absolute; left: 0; font-size: 22px; line-height: 40px; z-index: 999"><i class="fa fa-caret-left" onclick="tabScrollt('left')"></i></span> 

          <li class="active" style="background:#34495e;"><a  href="#others" data-toggle="tab" style="padding: 10px 100px;font-weight: 900;">Activity</a></li> 
          <li style="background:#0382ae;"><a href="#tsms" data-toggle="tab" onclick="findtimline('2')" style="padding: 10px 100px;font-weight: 900;">SMS</a></li>        
          <li style="background:#0fda02;"><a href="#twhatsapp" data-toggle="tab" onclick="findtimline('1')" style="padding: 10px 100px;font-weight: 900;">Whatsapp</a></li>
          <li style="background:#a92e3f;"><a href="#temail" data-toggle="tab" onclick="findtimline('3')" style="padding: 10px 100px;font-weight: 900;">Emails</a></li>

                <span style="position: absolute; right: 0; font-size: 22px; line-height: 40px; z-index: 999"><i class="fa fa-caret-right"  onclick="tabScrollt('right')"></i></span>
            </ul>
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="others">
                  <div class="activitytimelinediv"></div>
                </div>

                <div class="tab-pane" id="tsms">
                  <div class="activitytimelinedivsms"></div>
                </div>

                <div class="tab-pane" id="twhatsapp">
                  <div class="activitytimelinedivwhatsapp"></div>
                </div>

                <div class="tab-pane" id="temail">
                  <div class="activitytimelinedivemail"></div>
                </div>
            </div>
      </div>          
      </div>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function()
  {
    var noti = '4';
    $.ajax({
          url: "<?php echo base_url().'enquiry/activityTimeline/'?>"+noti,
          type: 'POST',          
          data: {
              'id':<?=$this->uri->segment(3)?>
          },
          success: function(content) {                       
            $(".activitytimelinediv").html(content);
           // $("#task_edit").modal('show');
          }
      });
  });

  function findtimline(tid){            
      $.ajax({
          url: "<?php echo base_url().'enquiry/activityTimeline/'?>"+tid,
          type: 'POST',
          data: {
              'id':<?=$this->uri->segment(3)?>
          },
          success: function(content) { 
          if(tid=='1'){                      
            $(".activitytimelinedivwhatsapp").html(content);
          }else if(tid=='2'){
            $(".activitytimelinedivsms").html(content);
          }else if(tid=='3'){
            $(".activitytimelinedivemail").html(content);
          }
          }
      });
    
    }

    function timline_alert(rem){            
     $.ajax({
          url: "<?php echo base_url().'enquiry/get_timline_alert/'?>"+rem,
          type: 'POST',
          
          success: function(content) { 
Swal.fire(
  'Your Content Here....',
  content
)
          }
      });
    
    }
</script>