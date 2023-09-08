<!-- <div class="col-sm-1">
</div> -->
<br>
<div class="col-sm-12">
   <div  class="panel panel-default thumbnail">
      <div class="panel-heading no-print">
         <div class="btn-group"> 
            <a class="btn btn-primary" href="<?=base_url().'invoice/invoice/create'?>"> <i class="fa fa-plus"></i>&nbsp;Create Invoice</a>  
         </div>
      </div>
      <div class="panel-body panel-form">
         <div class="row">
            <div class="col-md-12 col-sm-12">
                <form class="form-inner" action="http://thecrm360.com/new_crm/enquiry/create" id="enquery_from" method="POST">
                  <div id="error" class='btn btn-danger form-group col-sm-12'style="display:none;text-align:left"></div>
                  <div id="success" class='btn btn-success form-group col-sm-12' style="display:none;text-align:left"></div>
                  <div class="row">
                      <table class="add-data-table table table-bordered" style="overflow: scroll;">
                        <thead>
                          <tr>
                            <th>Invoice</th>
                            <th>Invoice Date</th>
                            <th>Due Date</th>
                            <th>Client Name</th>
                            <th>Due Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (!empty($invoice_list)) {
                            foreach ($invoice_list as $key => $value) { ?>
                              <tr>
                                <td>
                                  <?=$value['invoice_code']?>
                                </td>
                                <td><?=$value['invoice_date']?></td>
                                <td><?=$value['due_date']?></td>
                                <td><?=$value['enquiry_code']?></td>
                                <td><?=$value['net_payable']?></td>
                                <td>
                                  <?php
                                  if ($value['status'] == 0) {
                                    echo "<a class='btn btn-danger btn-xs' href='javascript:void(0)'>Not Paid</a>";
                                  }elseif($value['status'] == 1){
                                    echo "<a class='btn btn-success btn-xs' href='javascript:void(0)'>Paid</a>";
                                  }
                                  ?>
                                </td>
                                <td>
                                  <a href="<?=base_url().'invoice/invoice/create/'.$value['id']?>"><i class="fa fa-edit btn btn-primary btn-sm" ></i></a>
                                  <a href="javascript:void(0)" onclick="delete_row(<?=$value['id']?>)"><i class="fa fa-trash btn btn-danger btn-sm" ></i></a>
                                  <a href="<?=base_url().'invoice/invoice/view/'.$value['id']?>"><i class="fa fa-file btn btn-warning btn-sm" ></i></a>
                                </td>
                              </tr>                              
                            <?php
                            }
                          }
                          ?>
                        </tbody>
                      </table>
                  </div>
                </form>
            </div>
          </div>
      </div>
  </div>
</div>

<script type="text/javascript">
  function delete_row(id){
    var result = confirm("Want to delete?");
    if (result) { 
      url = "<?=base_url().'invoice/invoice/delete_invoice_row'?>"
      $.ajax({
        type: "POST",
        url: url,
        data: {'id':id},
        success: function(data){                
          alert('Deleted Successfully');
          location.reload();
        }
      });
    }
  }
</script>