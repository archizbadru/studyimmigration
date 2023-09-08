<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 4cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: .5cm;
                left: 0cm;
                right: 1cm;
                height: 2cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }
/**costomize CSS Start**/
#footer { 
  position: fixed;
  bottom: 120px;
  width:30%;
  left:30px;
}

#fullfooter { 
  position: fixed;
  bottom: 50px;
  width:849px;
  left:0px;
}
#fullcontent {
  padding:0px 30px;
}

#footer1 {  
  position: fixed;
  bottom: 100px;
  width:20%;
  right:30px;
}
/**costomize CSS End**/
        </style>
    </head>
    <body>
<?php 
$logopath = 'https://desk.godspeedvisa.com/assets/images/godspeed.png';
$logotype = pathinfo($logopath, PATHINFO_EXTENSION);
$logodata = file_get_contents($logopath);
$logo = 'data:image/' . $logotype . ';base64,' . base64_encode($logodata);
?>
        <!-- Define header and footer blocks before your content -->
        <!--<header>
            <img src="<?php echo $logo; ?>" width="150" height="80" style="float:right;"/>
        </header>-->

        <footer>
<div id="footer"> 
<label for="acc-or">
<?php if($this->session->userdata('companey_id')==83){ ?>
     M/s. GODSPEED IMMIGRATION
</br>AND STUDY ABROAD PVT LTD 
</br>represented by its Director
</br>Anoop Kumar T.K
<?php }elseif($this->session->userdata('companey_id')==85){ ?>
       INTERNATIONAL ACADEMY
<?php } ?>
</label>
</div>
<?php 
if(!empty($content->applicant_sign)){
$path = 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/God%20Speed/'.$content->applicant_sign;
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
}
?>
<div id="footer1"> 
<label for="acc-or">
<?php echo $content->applicant_name; ?>
<?php 
if(!empty($content->applicant_sign)){ ?>

<img src="<?php echo $base64?>" alt="" width="150" height="50" style="margin-left: -60px;">
<?php } ?>
</br>
</label>
</div>
<div id="fullfooter"> 
<hr>
<p style="font-size: 12px;" id="fullcontent">GODSPEED IMMIGRATION, 1st Floor, National Nandanam, Palace Road, Edappally, Ernakulum,Cochin – 682024,Kerala, India.
</p>
</div>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <?php echo $content->agreement_content; ?>
        </main>
    </body>
</html>