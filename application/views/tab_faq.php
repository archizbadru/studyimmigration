<style>
  .faq {
  padding: 60px 0;
}
.faq .faq-list {
  padding: 0;
  list-style: none;
}
.faq .faq-list li {
    background-color: #6c6c6c;
    margin-bottom: 10px;
    border-radius: 10px;
    padding: 10px 40px;
}
.faq .faq-list a {
    display: block;
    position: relative;
    font-size: 16px;
    font-weight: 600;
    color: #333333;
    text-decoration: none;
}

.faq .faq-list i {
  font-size: 16px;
  position: absolute;
  left: -25px;
  top: 1px;
  transition: 1s;
}
.faq-title {
    text-align: center;
    font-size: 17px;
    border-bottom: 2px dashed #ffffff;
    margin-bottom: 30px;
    padding-bottom: 10px;
    color: #ffffff;
}

.faq .faq-list p {
  padding-top: 5px;
  margin-bottom: 20px;
  font-size: 15px;
}

.collapsed i.fa.fa-arrow-circle-o-up {
    
}
.collapsed i.fa.fa-arrow-circle-o-up {
    transform: rotate(180deg);
}
</style>
<div class="tab-pane" id="faq-tab">
                  <div class="content-panel">
<section class="faq">
      <div class="container">

        <!-- <ul class="faq-list">
          <?php $i=1; foreach($all_faq as $val){ ?>
          <li data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate">
            <a data-toggle="collapse" class="collapsed" href="#faq<?php echo $i; ?>" aria-expanded="false" style="color: #dbdcdf"><?php echo $val->que_type; ?> <i class="fa fa-arrow-circle-o-up"></i></a>
            <div id="faq<?php echo $i; ?>" class="collapse" data-parent=".faq-list" style="">
              <p style="color: #fff;">
                <?php echo $val->answer; ?>
              </p>
            </div>
          </li>
          <?php $i++;} ?>
        </ul> -->
<ul class="faq-list">
<table id="dtBasicfaqs" class="table table-striped table-bordered" style="width:100%">
<thead>
<tr>
<th class="" style="font-size: 10px;">All Faq's Are Here!</th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($all_faq as $val){ ?>
<tr>
     <td> <li data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate">
            <a data-toggle="collapse" class="collapsed" href="#faq<?php echo $i; ?>" aria-expanded="false" style="color: #dbdcdf"><?php echo $val->que_type; ?> <i class="fa fa-arrow-circle-o-up"></i></a>
            <div id="faq<?php echo $i; ?>" class="collapse" data-parent=".faq-list" style="">
              <p style="color: #fff;">
                <?php echo $val->answer; ?>
              </p>
            </div>
          </li></td>
</tr>
<?php $i++;} ?>
</tbody>
</table>
</ul>
</div>
</section>

 <script>
     $(document).ready(function () {
  $('#dtBasicfaqs').DataTable();
});
 </script>
                  </div>
                </div>