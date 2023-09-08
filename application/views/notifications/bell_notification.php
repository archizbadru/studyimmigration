    <ul class="nav nav-tabs nav-pills nav-justified" >
      <li class="active"><a href="#bell_all" data-toggle="tab">All</a></li>
      <li><a href="#bell_read" data-toggle="tab">Read</a></li>
      <li><a href="#bell_unread" data-toggle="tab">Unread</a></li>
      <li><a href="#bell_today" data-toggle="tab">Today's</a></li>
    </ul>    
    <!-- Tab panes -->
    <div class="tab-content bell-tab-content" id="notificationdiv">
      <div class="tab-pane active" id="bell_all">        
        <?php
          if (!empty($res)) {
            foreach ($res as $key => $value) { 
              if ($value['enq_status'] == 1) {
                $url  = base_url().'enquiry/view/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 2) {
                $url  = base_url().'lead/lead_details/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 3) {
                $url  = base_url().'client/view/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 4) {
                $url  = base_url().'refund/view/'.$value['enquiry_id'];
              }else{
                $url  = 'javascript:void(0)';
              }
              if ($value['noti_read']) {
                $flag = "<a href='javascript:void(0)' onclick='noti_make_unread(".$value["resp_id"].")' class='btn btn-default btn-sm pull-right'>Unread</a>";
              }else{
                $flag = "<a href='javascript:void(0)' onclick='noti_make_read(".$value["resp_id"].")' class='btn btn-default btn-sm pull-right'>Read</a>";                
              }
              ?>
              <li class="media">
                  <div style="float: left;margin-right:12px;">
                    <a href="#" class="btn btn-default"><i class="fa fa-bell"></i></a>
                  </div>
                  <div class="media-body" style="text-align: justify;">
                   <span style="color:#45a000;"> <?=ucfirst($value['subject']).' '.$flag?></span>
                   <br><b style="color:#E74C3C;">[ <?=ucfirst($value['lead_stage_name']);?> ]</b>
                   <br><br><small><?=$value['task_remark']?></small><br>
                    <?php if($this->session->userdata('user_right')!=214){ ?>
                    <a href="<?=$url?>"><?=ucfirst($value['user_name'])?></a>
                  <?php } ?>
                    <div class="text-muted font-size-sm" style="float: right;"><?=$value['task_date'].' '.$value['task_time']?></div>
                </div>
              </li>
              <hr>
              <li>
              <?php
            }

          }
        ?>
        <li class="media"><a class="btn btn-sm btn-primary" onclick="loadMoreNotification('<?=$limit?>','bell_all')">View More</a></li>
        <hr>        
      </div>
      <div class="tab-pane" id="bell_read">
        <?php
          if (!empty($res)) {
            foreach ($res as $key => $value) {
              if ($value['enq_status'] == 1) {
                $url  = base_url().'enquiry/view/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 2) {
                $url  = base_url().'lead/lead_details/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 3) {
                $url  = base_url().'client/view/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 4) {
                $url  = base_url().'refund/view/'.$value['enquiry_id'];
              }else{
                $url  = 'javascript:void(0)';
              } 
              if ($value['noti_read']) {
                $flag = "<a href='javascript:void(0)' onclick='noti_make_unread(".$value["resp_id"].")' class='btn btn-default btn-sm pull-right'>Unread</a>";
              ?>
              <li class="media">
                  <div style="float: left;margin-right:12px;">
                    <a href="#" class="btn btn-default"><i class="fa fa-bell"></i></a>
                  </div>
                  <div class="media-body" style="text-align: justify;">
                   <span style="color:#45a000;"> <?=ucfirst($value['subject']).' '.$flag?></span>
                   <br><b style="color:#E74C3C;">[ <?=ucfirst($value['lead_stage_name']);?> ]</b>
                   <br><br><small><?=$value['task_remark']?></small><br>
                    <?php if($this->session->userdata('user_right')!=214){ ?>
                    <a href="<?=$url?>"><?=ucfirst($value['user_name'])?></a>
                    <?php } ?>
                    <div class="text-muted font-size-sm" style="float: right;"><?=$value['task_date'].' '.$value['task_time']?></div>
                </div>
              </li>
              <hr>
              <li>
              <?php
              }
            }
          }
        ?>
        <li class="media"><a class="btn btn-primary btn-sm" onclick="loadMoreNotification('<?=$limit?>','bell_read')">View More</a></li>
        <hr>      
      </div>
      <div class="tab-pane" id="bell_unread">
        <?php
          if (!empty($res)) {
            foreach ($res as $key => $value) { 
              if ($value['enq_status'] == 1) {
                $url  = base_url().'enquiry/view/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 2) {
                $url  = base_url().'lead/lead_details/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 3) {
                $url  = base_url().'client/view/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 4) {
                $url  = base_url().'refund/view/'.$value['enquiry_id'];
              }else{
                $url  = 'javascript:void(0)';
              }
              if (!$value['noti_read']) {
                $flag = "<a href='javascript:void(0)' onclick='noti_make_read(".$value["resp_id"].")' class='btn btn-default btn-sm pull-right'>Read</a>";
              ?>
              <li class="media">
                  <div style="float: left;margin-right:12px;">
                    <a href="#" class="btn btn-default"><i class="fa fa-bell"></i></a>
                  </div>
                  <div class="media-body" style="text-align: justify;">
                    <span style="color:#45a000;"><?=ucfirst($value['subject']).' '.$flag?></span>
                    <br><b style="color:#E74C3C;">[ <?=ucfirst($value['lead_stage_name']);?> ]</b>
                    <br><br><small><?=$value['task_remark']?></small><br>
                    <?php if($this->session->userdata('user_right')!=214){ ?>
                    <a href="<?=$url?>"><?=ucfirst($value['user_name'])?></a>
                    <?php } ?>
                    <div class="text-muted font-size-sm" style="float: right;"><?=$value['task_date'].' '.$value['task_time']?></div>
                </div>
              </li>
              <hr>
              <li>
              <?php
              }
            }
          }
        ?>
        <li class="media"><a class="btn btn-primary btn-sm" onclick="loadMoreNotification('<?=$limit?>','bell_unread')">View More</a></li>
        <hr>
      </div>
      <div class="tab-pane" id="bell_today">
        <?php
          if (!empty($res)) {
            foreach ($res as $key => $value) { 
              if($value['task_date'] == date("d-m-Y")) {
              if ($value['enq_status'] == 1) {
                $url  = base_url().'enquiry/view/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 2) {
                $url  = base_url().'lead/lead_details/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 3) {
                $url  = base_url().'client/view/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 4) {
                $url  = base_url().'refund/view/'.$value['enquiry_id'];
              }else{
                $url  = 'javascript:void(0)';
              }
              if (!$value['noti_read']) {
                $flag = "<a href='javascript:void(0)' onclick='noti_make_read(".$value["resp_id"].")' class='btn btn-default btn-sm pull-right'>Read</a>";
              ?>
              <li class="media">
                  <div style="float: left;margin-right:12px;">
                    <a href="#" class="btn btn-default"><i class="fa fa-bell"></i></a>
                  </div>
                  <div class="media-body" style="text-align: justify;">
                   <span style="color:#45a000;"> <?=ucfirst($value['subject']).' '.$flag?> </span>
                   <br><b style="color:#E74C3C;">[ <?=ucfirst($value['lead_stage_name']);?> ]</b> 
                   <br><br><small><?=$value['task_remark']?></small><br>
                    <?php if($this->session->userdata('user_right')!=214){ ?>
                    <a href="<?=$url?>"><?=ucfirst($value['user_name'])?></a>
                    <?php } ?>
                    <div class="text-muted font-size-sm" style="float: right;"><?=$value['task_date'].' '.$value['task_time']?></div>
                </div>
              </li>
              <hr>
              <li>
              <?php
              }
              }
            }
          }
        ?>
        <li class="media"><a class="btn btn-primary btn-sm" onclick="loadMoreNotification('<?=$limit?>','bell_today')">View More</a></li>
        <hr>
      </div>
    </div>
    <script type="text/javascript">

      // $("#notificationdiv").scroll(function() {
      //   alert();
      // });
      function loadMoreNotification(limit,tabid)
      {
        event.stopPropagation();
        $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>notification/web/get_bell_notification_content", 
           data:{
            limit:limit,
            loaddata :'yes',
           },
           dataType:"json",
           success: function(data){              
            $("#notification_dropdown_tabs").html(data.html);   
            $("#"+tabid).addClass('active');       
            }
          });
        

      }

      function noti_make_unread(id){
         $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>notification/web/mark_as_unread", 
           data:{
            id:id
           },
           success: function(data){              
            count_bell_notification();            
            }
          });
      }

      function noti_make_read(id){
        $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>notification/web/mark_as_read", 
           data:{
            id:id
           },
           success: function(data){ 
              count_bell_notification();             
            }
          });
      }
    </script>
