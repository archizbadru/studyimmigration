<?php 

  if (!empty($repdetails)) {
    foreach($repdetails as $ind => $val){

      $enqno = $val->enquiry_id;
      if(!empty($fieldsval[$enqno])){
        $exptracol = $fieldsval[$enqno];
      }
    }
  }
 ?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading no-print">
            <div class="btn-group"> 
              <?php if($type==1){ ?>
                <a class="btn btn-primary" href="<?=base_url()?>report/index"> <i class="fa fa-list"></i>  All Reports  </a>
              <?php }else if($type==2){ ?> 
              <a class="btn btn-primary" href="<?=base_url()?>report/account_report_list"> <i class="fa fa-list"></i>  All Reports  </a> 
             <?php }else if($type==3){ ?>
              <a class="btn btn-primary" href="<?=base_url()?>report/case_report_list"> <i class="fa fa-list"></i>  All Reports  </a>
             <?php }else if($type==4){ ?>
              <a class="btn btn-primary" href="<?=base_url()?>report/legal_report_list"> <i class="fa fa-list"></i>  All Reports  </a>
             <?php }else if($type==5){ ?>
              <a class="btn btn-primary" href="<?=base_url()?>report/call_report"> <i class="fa fa-list"></i>  All Reports  </a>
             <?php } ?>
            </div>
        </div>
        <div class="panel-body">
            <div class="widget-title">
              View Report
            </div>
            <hr>                   
            <div class="row">  
              <?php
                  echo form_open_multipart('report/view/'.$rid.'/'.$this->uri->segment(4).'/'.$type,array('class'=>"",'name'=>'search'));
              ?>
              <div class="col-sm-3">    
              </div>
              <div class="col-sm-3">
                <label>From</label>
                 <input type="date" class="form-control" name="from" value="<?php if(!empty($from)){ echo $from; } ?>">
              </div>
              <div class="col-sm-3">
                 <label>To</label>
                 <input type="date" class="form-control" name="to" value="<?php if(!empty($to)){ echo $to; } ?>">
              </div>
              <br>
              <div class="col-sm-2">
                <input type="submit" class="btn btn-primary" value="Filter">
             </div> 
              <?php echo form_close(); ?>  
          </div>
       </div>
    </div>
    <div style="overflow: scroll;">
      <table id="example"  class=" table table-striped table-bordered" style="width:100%;">
          <thead>
          <tr>
              <?php
              if (!empty($report_columns)) {
                foreach ($report_columns as $value) { ?>
                  <th><?=$value?></th>
                <?php
                }
              }
              ?>
          </tr>
          </thead>
           <tbody>
          </tbody>
      </table>
    </div>
  </div>
</div>
<?php 
  $name=base64_decode($this->uri->segment(4)); 
?>
</div>
<script>
    $(document).ready(function(){
      var rep_type = <?=$type ?>;
      $('#example').DataTable({
        "processing": true,
        "scrollX": true,
        "serverSide": true,
        "lengthMenu": [[10,30, 50,100,500,1000, -1], [10,30, 50,100,500,1000, "All"]],
        "ajax": {
          "url":  "<?=base_url().'report/report_view_data/'?>"+rep_type,
          "type": "POST",
        },    
        "columnDefs": [{ "orderable": false, "targets": 0 }],
            "order": [[ 1, "desc" ]],
        dom: 'lBfrtip',
        buttons: [
        {
          extend: 'copyHtml5',
          title: '<?php echo $name; ?>'
        },
        {
          extend: 'csvHtml5',
          charset: 'UTF-8',         
          bom: true,
        },
        {
          extend: 'excelHtml5',
          title: '<?php echo $name; ?>'
        },
        {
          extend: 'pdfHtml5',
          title: '<?php echo $name; ?>'
        },
        {
          extend: 'print',
          title: '<?php echo $name; ?>'
        }
      ]
    });
});
</script>