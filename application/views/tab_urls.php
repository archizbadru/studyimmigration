<style>
.ribbon {
 font-size: 20px !important;
 /* This ribbon is based on a 16px font side and a 24px vertical rhythm. I've used em's to position each element for scalability. If you want to use a different font size you may have to play with the position of the ribbon elements */

 width: 50%;
    
 position: relative;
 background: #ba89b6;
 color: #fff;
 text-align: center;
 padding: 1em 2em; /* Adjust to suit */
 margin: 2em auto 3em; /* Based on 24px vertical rhythm. 48px bottom margin - normally 24 but the ribbon 'graphics' take up 24px themselves so we double it. */
}
.ribbon:before, .ribbon:after {
 content: "";
 position: absolute;
 display: block;
 bottom: -1em;
 border: 1.5em solid #986794;
 z-index: -1;
}
.ribbon:before {
 left: -2em;
 border-right-width: 1.5em;
 border-left-color: transparent;
}
.ribbon:after {
 right: -2em;
 border-left-width: 1.5em;
 border-right-color: transparent;
}
.ribbon .ribbon-content:before, .ribbon .ribbon-content:after {
 content: "";
 position: absolute;
 display: block;
 border-style: solid;
 border-color: #804f7c transparent transparent transparent;
 bottom: -1em;
}
.ribbon .ribbon-content:before {
 left: 0;
 border-width: 1em 0 0 1em;
}
.ribbon .ribbon-content:after {
 right: 0;
 border-width: 1em 1em 0 0;
}
</style>
<div class="tab-pane <?php if(!empty($this->uri->segment(4))){ $str=base64_decode($this->uri->segment(4)); if($str=='url'){ echo 'active';}};?>" id="url-tab">
<div class="content-panel">
<section class="url">
 <?php if(!empty($urls_list)){ ?>
<table id="dtBasicExampletr" class="table table-striped table-bordered" style="width:100%">
<thead>
<tr>
<th class="" style="font-size: 10px;">S.No</th>
<th style="font-size: 10px;">Url Name</th>
<th style="font-size: 10px;">Url</th>
<?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
        <th class="th-sm">Status</th>
<?php } ?>
<th style="font-size: 10px;">Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($urls_list as $urls){ ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $urls->url_name; ?></td>
      <td><?php echo $urls->url_link; ?></td>
      <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
      	<td>
        <span class="label label-primary"><?php if($urls->visibility=='1'){ echo'Visible'; }else{ echo 'Unvisible'; } ?><span>
        </td>
    <?php } ?>
      <?php if(in_array($this->session->userdata('user_right'), applicant) && $urls->visibility=='1'){ ?>
      <td><a href="<?php echo $urls->url_link; ?>" target="_blank"><button type="button" class="btn btn-success">Visit Url</button></a></td>
      <?php } ?>
      <td>
      <?php if(!in_array($this->session->userdata('user_right'), applicant)){ ?>
      	<a href="<?php echo $urls->url_link; ?>" target="_blank"><i class="fa fa-globe" aria-hidden="true"></i></a>&nbsp;
         <a href="<?php echo base_url('lead/client_url_visible/'.$urls->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(1))?>" class="titlehover" data-title="Visibility Access"><i class="fa fa-eye" aria-hidden="true"></i></a> 
        <?php } ?>
      </td>
    </tr>
<?php $i++; ?>
<?php } ?>
</tbody>
</table>
<?php }else{ ?> 
<h1 class="ribbon">
   <strong class="ribbon-content">Sorry' Data Not Found! </strong>
</h1>
<?php } ?>        
    </section>
                  </div>
                </div>