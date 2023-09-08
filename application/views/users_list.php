<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

       <title>Admin Panel | BOQ</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>

    <!--start global css-->

    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/app.css" />

    <!-- end of global css -->

    <!--start plugin css -->

    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>vendors/datatables/css/dataTables.bootstrap.min.css">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>vendors/datatables/css/buttons.bootstrap.min.css">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/plugincss/responsive.dataTables.min.css" />

    <!--end plugin css -->

    <!--start page level css-->

    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/custom.css"/>

    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/pages/tables.css">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/pages/user.css">

	 <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/pages/icons.css"/>

	 <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>vendors/themify-icons/css/themify-icons.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/ionicons/css/ionicons.min.css" />

    <!--end page level css-->

       <style>

         table th {

        padding: 4px 20px 6px 20px;

        background: #3D599A;

        color: white;

        padding: 3px;

        text-align: center;

         border-right: 1px solid #777777;

        font-size: 12px;

        font-family: Arial,sans-serif,Verdana;

    }

    table td {

         border-right: 1px solid #777777;

    padding: 3px;

    text-align: center;

    font-size: 12px;color: #000000;

    font-family: Arial,sans-serif,Verdana;

    white-space: unset;

    }

	table tr:nth-child(odd){ 

	

		background: #e4e7ed;

	}

	table td:nth-last-child(1){ 

	

		border-right: none !important;

	}

	/*  Define the background color for all the EVEN background rows  */

	table tr:nth-child(even){

		background: #ffffff;

	}

    

    

    table.dataTable.no-footer {

        border-top: 2px solid #ebeff2;

        border-bottom: 2px solid #ebeff2;

    }

    table tbody td {

        vertical-align: middle;

    }

    table thead th.sorting::after, table thead th.sorting_asc::after, table thead th.sorting_desc::after {

        top: 5px;

        right: 5px;

    }

    </style>

</head>

<body>

<div class="preloader">

    <div class="preloader_img">

        <img src="<?php echo base_url();?>img/loader.gif" class="pre_img" alt="loading...">

    </div>

</div>

<!-- Start header-->

<?php include('header.php');?>

<!--End header-->

<!--Start wrapper-->

<div class="wrapper">

    <!-- Left side column. contains the logo and sidebar -->

    <?php include('nav.php');?>

	<div class="right-aside view-port-height">

        <!-- Content Header (Page header) -->

        <div class="content-header container-fluid bg-white">

            <div class="row">

                <div class="col-sm-4">

                    <h4><i class="ti-user"> </i> Users List</h4>

                </div>

                <div class="col-6 col-sm-4 offset-md-2 col-md-3 offset-xl-4 col-xl-2 header_left_xs_up pt-2">

                    <div class="row">

                        <div class="col-6">

                            <span>Users</span><br/>

                            <span>250 <i class="ti-angle-up text-primary"> </i></span>

                        </div>

                        <div class="col-6">

                            <div class="sparkline_users"></div>

                        </div>

                    </div>

                </div>

                <div class="col-6 col-sm-4 col-md-3 col-xl-2 header_left pt-2">

                    <div class="row">

                        <div class="col-6">

                            <span>Sales</span><br/>

                            <span>150 <i class="ti-angle-up text-danger"> </i></span>

                        </div>

                        <div class="col-6">

                            <div class="sparkline_sales"></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Main content -->

        <div class="content">

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-block">

                            <div class="row">

                                <?php if(!empty($this->session->success)){?>

                                                    <div class='btn  btn-success text-left' ><?php echo $this->session->success; ?></div>

                                                <?php     }?>

							<p id="error" class='btn  btn-danger'style="display:none;"></p>

							<p id="success" class='btn btn-success' style="display:none;"></p>

                                <div class="col-12 text-right">

                                    <a href="<?php echo base_url();?>add_user" class="btn btn-primary" style="float:left;z-index:9999">

                                       <strong> <i class="ti-plus text-white" ></i> &nbsp;Add New User</strong></a>

                                </div>

                            </div>



                            <div class="">

                                        <div class="pull-sm-right">

                                            <div class="tools pull-sm-right"></div>

                                        </div>

                                    </div>

									<div class="row m-t-20"><?php if($this->session->error!=''){ ?>

                                                           <button  class='btn btn-danger text-left'><?php echo $this->session->error; ?></button>

									                        <?php } ?>

															<?php if($this->session->success!=''){ ?>

                                                            <button  class='btn  btn-success left'><?php echo $this->session->success; ?></button>

									                        <?php } ?>

													 

                                                </div>

                                    <div class="table-responsive" style="margin-top:-70px;">

									<form class="form-horizontal "  action='' method="post" id="login">

                                        <table   border='1' cellspacing='0' cellpadding='0' id="users_table" role="grid" width="100%">

                                            <thead>

                                            <tr role="row">

                                                <th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1">

												<input type='checkbox' class="checked_all" value="check all" >&nbsp; S.N</th>

                                                <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Userame</th>

                                                <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Display Name</th>

                                                <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">Email</th>

                                                <th class="sorting wid-15" tabindex="0" rowspan="1" colspan="1">Mobile</th>

                                                <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Status</th>

                                                <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Actions</th>

                                            </tr>

                                            </thead>

                                            <tbody>

									

											<?php $i=1;foreach($get_users as $user){?>

                                            <tr role="row" class="even">

											  <td><input type='checkbox' name='user_status[]' class="checkbox" value='<?php echo $user->pk_i_admin_id;?>'>&nbsp; <?php echo $i;?></td>

                                                <td class="sorting_1 user_face">

												<?php echo $user->s_username;?></td>

                                                <td> <?php echo $user->s_display_name;echo $user->last_name;?></td>

                                                <td class="center"> <?php echo $user->s_user_email;?></td>

                                                <td class="center"> <?php echo $user->s_phoneno;?></td>

												<td class="center"> <?php if($user->b_status==1){echo "<i class='ion-checkmark-circled'> </i>"; }else{echo "<i class='ion-close-circled'> </i>";} ;?></td>

                                             

                                                <td>&nbsp; &nbsp;

												<a class="edit" data-toggle="tooltip" data-placement="top" title="delete" onclick="return confirm('Are you sure delete this user ? ');"

                                                        href="<?php echo base_url();?>edit_user/<?php echo base64_encode($user->pk_i_admin_id);?>"><i class="ti-trash text-warning"></i></a>

                                                        <a class="edit" data-toggle="tooltip" data-placement="top" title="Edit" 

                                                        href="<?php echo base_url();?>edit-users/<?php echo base64_encode($user->pk_i_admin_id);?>"><i class="ti-pencil"></i></a>

												</td>

                                            </tr>

											<?php $i++; } ?>

                                          

									

											

											

											

											</tbody>

                                        </table>

										<button class="btn btn-primary" type="button" onclick="is_Active()">

                                             <i class="ion-checkmark-circled"></i>

                                                    Active

                                            </button>

											<button class="btn btn-danger" type="button" onclick="deactive_user()">

                                             <i class="ion-close-circled"></i>

                                                    DeActive

                                            </button>

                                      </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- /.content -->

    </div>

    <!-- /.right-side -->

</div>

<!-- ./wrapper -->

<?php include('footer.php');?>

<!--start global css-->

<script type="text/javascript" src="<?php echo base_url();?>js/app.js"></script>

<!--End global css-->

<!--start plugin js -->

<script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url();?>vendors/datatables/js/dataTables.bootstrap.min.js"></script>



<script src="<?php echo base_url();?>vendors/datatables/js/buttons.print.min.js"></script>

<script src="<?php echo base_url();?>vendors/datatables/js/buttons.html5.min.js"></script>

<script src="<?php echo base_url();?>vendors/datatables/js/dataTables.responsive.js"></script>

<!--end plugin js -->

<!-- start of page level js -->

<script type="text/javascript" src="<?php echo base_url();?>js/custom.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>js/pages/user_list.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>js/pages/icons.js"></script>

<!-- end of page level js -->

<script>

function is_Active(){

$.ajax({

type: 'POST',

url: '<?php echo base_url();?>active_user',

data: $('#login').serialize()

})

.done(function(data){

if(data=='User Exist'){	

     document.getElementById('success').style.display='none';

	 document.getElementById('error').style.display='inline';

	$('#error').html(data);

}else{

	document.getElementById('error').style.display='none';

	document.getElementById('success').style.display='inline';

	$('#success').html(data);

		window.location.href = '<?php echo base_url()?>users-list';

}

})

.fail(function() {

alert( "fail!" );



});

}

</script>

<script>

function deactive_user(){

$.ajax({

type: 'POST',

url: '<?php echo base_url();?>deactive_user',

data: $('#login').serialize()

})

.done(function(data){

if(data=='User Exist'){	

     document.getElementById('success').style.display='none';

	 document.getElementById('error').style.display='inline';

	$('#error').html(data);

}else{

	document.getElementById('error').style.display='none';

	document.getElementById('success').style.display='inline';

	$('#success').html(data);

		window.location.href = '<?php echo base_url()?>users-list';

}

})

.fail(function() {

alert( "fail!" );



});

}

</script>

 <script type="text/javascript">

        $('.checked_all').on('change', function() {     

                $('.checkbox').prop('checked', $(this).prop("checked"));              

        });

        $('.checkbox').change(function(){ 

            if($('.checkbox:checked').length == $('.checkbox').length){

                   $('.checked_all').prop('checked',true);

            }else{

                   $('.checked_all').prop('checked',false);

            }

        });

    </script>

</body>

</html>

