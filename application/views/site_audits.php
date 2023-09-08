   <div class="panel panel-default thumbnail"> 
        <div class="col-md-12" id="content_tabs"></div>
            <div id="content_tabs1"  class="tab-pane active" id="allclients">

                <table id="dataTable" class="table table-responsive-sm table-hover table-outline mb-0" style="background: #fff;">
              <thead class="thead-light">
                 <tr style="background: #f1f3f6;">
                  <th style="width: 3%;">  <input type='checkbox' class="checked_all6" value="check all" ></th> 
                  <th style="width: 2%;" title="S.No.">#</th> 
                  
                  <th style="width:2%;" class="text-center">                    
                  </th>  
                  <th title="<?php echo display('details');?>"><?php echo display('details');?></th>                                    
                                                        
                     <th style="width: 20%;" class="text-center" title="Looping Diagram">L Diagram</th>
                  
                  <th style="width: 15%;" class="text-center" title="<?php echo display('circuit_sheet');?>">
                    <?php echo display('circuit_sheet');?>
                  </th>
                  
                   <th style="width: 20%;" class="text-center" title="Looping Diagram">Site Audit</th>
                  
                  <th style="width: 15%;" class="text-center" title="<?php echo display('circuit_sheet');?>">
                   Site Readiness
                  </th>
                  <th style="width: 3%;" class="text-center" title="Whatsapp">
                    <i class="fa fa-whatsapp"></i>
                  </th> 
                  <th style="width: 3%;" class="text-center" title="E-Mail">
                    <i class="fa fa-envelope-open"></i>
                  </th> 
                  <th style="width: 5%;" class="text-center" title="User">
                    <i class="fa fa-user"></i>
                  </th>
                  
                </tr>
              </thead>
              
                <tr onclick="window.location='';" style="cursor:pointer;">
                <td style="width:1%">
                         <input onclick="event.stopPropagation();" type='checkbox' name='enquiry_id[]' class="checkbox6" value=''></td>
                <td></td>
                
                <td class="text-center" title="">                            
               
                <div class="avatar">
                <p data-red="">Prem</p>
                </div> 
                
                </td>
                <td>
                <div>Prem Prabhat</div>
                <div class="small">
                7876716396| prem@gmail.com<br>                            
                
                Delhi<br>
                19/07/2019                         
                </div>                             
                </td>                                                  
                
                <td class="text-center">Siya </td>
                             
                <td>Sharma</td>
                     
                      
                      <td class="text-center">Hello</td>
                        <td class="text-center">Siya</td>
                      
                        <td class="text-center">1</td>
                        <td class="text-center">2</td>
                        <td class="text-center">3</td>
                        </tr>
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