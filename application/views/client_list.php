 <style> 
   table td,table th{text-align:center;font-size:10px;}
table th{background:#283593;color:#fff;}
</style>
<link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
        <div class="panel-default "> 
      
            <div id="content_tabs1"  class="tab-pane active" id="allclients">

                <table class="datatable1 table table-striped table-bordered" cellspacing="0" width="100%" id="client_list">
              <thead class="thead-light">
                 <tr>
                  <th>  <input type='checkbox' class="checked_all6" value="check all" ></th> 
                  <th title="S.No.">#</th> 
                  
                  <!---<th> Type                   
                  </th>
                  <th>Organisation Name</th>-->
                  <th title="<?php echo display('name');?>"><?php echo display('name');?></th> 
                  <th>Mobile No.</th>
                  <th>Process</th>
                <!--<th title="Looping Diagram">Layout Sheet</th>
                  
                  <th class="text-center" title="<?php echo display('circuit_sheet');?>">
                    <?php echo display('circuit_sheet');?>
                  </th>
                  
                   <th class="text-center" title="<?php echo display('boq');?>">
                    <?php echo display('boq');?>
                  </th>
                  
                   <th class="text-center" title="<?php echo display('pi');?>">
                    <?php echo display('pi');?>
                  </th>
                  
                  <th title="<?php echo display('po');?>"><?php echo display('po');?></th>-->
                 
                  
                 
                  <th class="text-center" title="User">
                   Assigned To
                  </th>
                  <th class="text-center" title="User">
                   Data Source
                  </th>
                  
                  
                </tr>
              </thead>
              <tbody>
                <?php  function initials($str) {     
                        $ret = '';
                        foreach (explode(' ', $str) as $word)
                        $ret= strtoupper(substr($word,0,1));
                        return $ret;                                    
                    }      
                if (!empty($all_clients->result())) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($all_clients->result() as $client) { ?>
                <tr onclick="window.location='<?php echo base_url("client/view/$client->enquiry_id/$client->Enquery_id") ?>';" style="cursor:pointer;">
                <td>
                         <input onclick="event.stopPropagation();" type='checkbox' name='enquiry_id[]' class="checkbox6" value='<?php echo $client->enquiry_id;?>'></td>
                <td><?php echo $sl;?></td>
                <td>
                <?php echo $client->name_prefix." ".$client->name." ".$client->lastname?>
                </td>
                <td><?= $client->phone ?></td>
                <td><?= !empty($client->product_name)?$client->product_name:'N/A' ?></td>
                        <td>                          
                         <?php $assign= $this->Leads_Model->user_by_id_($client->aasign_to);
                                          if(!empty($assign->result())){
                                          foreach($assign->result() as $assignname){
                            ?>                              
                              <?= $assignname->s_display_name." ".$assignname->last_name ?>      
                            <?php }}else{ ?>
                              NA
                            <?php } ?>
                        </td>
                        <td><?=$client->datasource_name?></td>
                        </tr>                
                <?php $sl++; } } ?>                                  
              </tbody>
            </table>
            </div> 
            </div>            
            <script>
function reset_input(){
$('input:checkbox').removeAttr('checked');
}
function check_all(checkclass,checkbox){
    $('.'+ checkclass).on('change', function() {     
                $('.'+ checkbox).prop('checked', $(this).prop("checked"));
                
        });
        $('.'+checkbox).change(function(){ 
            if($('.'+ checkbox +':checked').length == $('.'+ checkbox).length){
                   $('.'+ checkclass).prop('checked',true);
            }else{
                   $('.'+ checkclass).prop('checked',false);
            }
        });
}  
        
        
        $('.checked_all1').on('change', function() {     
                $('.checkbox1').prop('checked', $(this).prop("checked"));
                
        });
        $('.checkbox1').change(function(){ 
            if($('.checkbox1:checked').length == $('.checkbox1').length){
                   $('.checked_all1').prop('checked',true);
            }else{
                   $('.checked_all1').prop('checked',false);
            }
        });
        
         $('.checked_all2').on('change', function() {     
                $('.checkbox2').prop('checked', $(this).prop("checked"));              
        });
        $('.checkbox1').change(function(){ 
            if($('.checkbox2:checked').length == $('.checkbox2').length){
                   $('.checked_all2').prop('checked',true);
            }else{
                   $('.checked_all2').prop('checked',false);
            }
        });
        
         $('.checked_all3').on('change', function() {     
                $('.checkbox3').prop('checked', $(this).prop("checked"));              
        });
        $('.checkbox3').change(function(){ 
            if($('.checkbox3:checked').length == $('.checkbox3').length){
                   $('.checked_all3').prop('checked',true);
            }else{
                   $('.checked_all3').prop('checked',false);
            }
        });
        
         $('.checked_all4').on('change', function() {     
                $('.checkbox4').prop('checked', $(this).prop("checked"));              
        });
        $('.checkbox4').change(function(){ 
            if($('.checkbox4:checked').length == $('.checkbox4').length){
                   $('.checked_all4').prop('checked',true);
            }else{
                   $('.checked_all4').prop('checked',false);
            }
        });
        
         $('.checked_all5').on('change', function() {     
                $('.checkbox5').prop('checked', $(this).prop("checked"));              
        });
        $('.checkbox5').change(function(){ 
            if($('.checkbox5:checked').length == $('.checkbox5').length){
                   $('.checked_all5').prop('checked',true);
            }else{
                   $('.checked_all5').prop('checked',false);
            }
        });
        
         $('.checked_all6').on('change', function() {     
                $('.checkbox6').prop('checked', $(this).prop("checked"));              
        });
        $('.checkbox5').change(function(){ 
            if($('.checkbox6:checked').length == $('.checkbox6').length){
                   $('.checked_all6').prop('checked',true);
            }else{
                   $('.checked_all6').prop('checked',false);
            }
        });
</script>
<!-- jquery-ui js -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>      
<!-- DataTables JavaScript -->
<script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>  
<script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>