<div class="row panel">
    <div class="col-md-12">
        
        <div class="panel-body">
            <div class="row ">
                <div class="col-md-3 ">
                    <label>Select Activity Date <span class="badge badge-secondary"><?php echo $total; ?></span></label>
                    <?php
                    
                    if (empty($fltrdate)) {
                       // $filter_date = $this->session->attendance_filter_date;
						 $fltrdate    =   date("Y-m-d");
                    }
						
                    ?>
                    <input type="date" name="att_date" class="form-control" style="width: 80%" id="att_date" value="<?=$fltrdate?>">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">        
        <div class="panel-body">
            <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><?php echo display('serial') ?></th>
                        <th>Lead</th>
                        <th>Action</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($result)) { ?>
                       
                        <?php foreach ($result as $key =>  $rslt) { ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $rslt->lead_id; ?></td>
                                <td><?php echo $rslt->comment_msg; ?></td>
                                <td>
                                    <?php
                                   echo date("d, M Y", strtotime($rslt->created_date));
                                    ?>
                                </td>
								<td> <?php
                                   echo date("h:i A", strtotime($rslt->created_date));
                                    ?></td>
                            </tr>                                
                          
                        <?php } ?> 
                    <?php } ?> 
                </tbody>
            </table>  <!-- /.table-responsive -->
        </div>
    </div>
</div>

<script type="text/javascript">

    $("#att_date").on('change',function(){
        var date_f = $(this).val();
		document.cookie = "activity="+date_f;
		location.reload();
           
    });

</script>