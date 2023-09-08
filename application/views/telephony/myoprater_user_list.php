<div class="row">

    <!--  table area -->

    <div class="col-sm-12">
       <br>
        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">
         
                <div class="btn-group"> 

                    <a class="btn btn-success" > <i class="fa fa-plus"></i> Telephony Users </a>  

                </div>

            </div>

            <div class="panel-body">

                <table class="datatable1 table table-striped table-bordered" cellspacing="0" width="100%">

                    <thead>

                        <tr>

                            <th><?php echo display('serial') ?></th>
                            <th>UID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>

                        </tr>

                    </thead>

                    <tbody>
                     <?php $sl = 1; ?>
                        <?php if (!empty($all_user)){
							foreach ($all_user as $department) { ?>

                            

                            <?php if(!empty($department['user_data'])){
								foreach ($department['user_data'] as $d) { ?>
                                 <tr>
                                    <td ><?php echo $sl; ?></td>
                                    <td ><?php echo $d->uuid; ?></td>
                                    <td><?php echo $d->name; ?></td>
                                    <td><?php echo $d->email;   ?></td>
                                    <td><?php echo $d->contact_number; ?></td>
                                </tr>

                                

                                <?php $sl++; //$this->User_model->update_uid($d->uuid,$d->contact_number); 
								//
								//$this->User_model->inbound_uid($d->uuid,$d->contact_number);
								?>

                            <?php } ?> 

                        <?php }}} ?> 

                    </tbody>

                </table>  <!-- /.table-responsive -->

            </div>

        </div>

    </div>

</div>

<script>

    $(document).ready(function(){

    $('table tr').click(function(){
        var a = $(this).attr('href');
        if (a) {
            window.location = $(this).attr('href');
        }
        return false;

    });

});

</script>

