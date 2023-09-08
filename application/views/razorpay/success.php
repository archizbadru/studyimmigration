<style>
 .content-panel{
  padding: 10%;
 } 
</style>
<div class="content-panel">
<section class="showcase">
   <div class="container">
    <div class="text-center">
      <h1 class="display-3">Thank You!</h1>
      <p class="lead">Your payment has been received successfully.</p>
      <hr>
      <p>
        Having trouble? <a href="mailto:contact@webhaunt.com">Contact us</a>
      </p>
      <p class="lead">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url('dashboard/user_profile/').$this->uri->segment(4).'/'.$this->uri->segment(5); ?>" role="button">Continue to homepage</a>
      </p>
    </div>
    </div>
</section>
</div>