<?php 
echo form_open('auth/signup','id="signupForm" novalidate'); 
?>
<input type="hidden" name="c" value="<?=$c?>">
<div class="form-group">
    <label class="control-label" for="name"><?= display('full_name') ?></label>
    <input type="text" placeholder="<?=display('name')?>" name="name" class="form-control"> 
</div>
<div class="form-group">
    <label class="control-label" for="name"><?= display('mobile') ?></label>
    <input type="text" placeholder="<?=display('mobile')?>" name="mobile" class="form-control" > 
</div>
<div class="form-group">
    <label class="control-label" for="name"><?= display('email') ?></label>
    <input type="email" placeholder="<?=display('email')?>" name="email" class="form-control"> 
</div>
<div class="form-group">
    <label class="control-label" for="name"><?= display('password') ?></label>
    <input type="password" placeholder="<?=display('password')?>" name="password" class="form-control"> 
</div>
<div class="form-group">
    <label class="control-label" for="name"><?= display('confirm_password') ?></label>
    <input type="password" placeholder="<?=display('confirm_password')?>" name="confirm_password" class="form-control"> 
</div>
<br>
<div class="text-center">
    <button  type="submit" class="btn btn-success"><?= display('signup') ?></button>          
</div>
<br>
<br>
<div style="text-align: center;">	
	Already have account ?<a href="javascript:void(0)" onclick="location.reload()" id="login">Login</a>
</div>
<?php
echo form_close();
?>

<script type="text/javascript">
$("#signupForm").on("submit",function(e){
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data){
            data = JSON.parse(data);                                
           if(data.status){
                Swal.fire({                                    
                    title: "success",
                    html: data.message,
                    icon: "warning",
                    button: "OK",
                    dangerMode: true,
                });
           }else{
            Swal.fire({                                    
                title: "Warning",
                html: data.message,
                icon: "warning",
                button: "OK",
                dangerMode: true,
            });
           }
        }
    }); 
});                 
</script>