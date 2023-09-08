<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Godspeed Emails</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */

/*table{
    width: 643px;
    border-collapse: collapse;
}
th{
    padding: 5px;
    font-size: 11px;
    color: #777777;
    border: 1px solid #2c3e50;
}
tr{
    padding: 5px;
    font-size: 11px;
    height: 30px;
    border: 1px solid #2c3e50;
}
tr, td:first-child{
    font-weight: bold;
    text-align: left;
    border: 1px solid #2c3e50;
}
td{
    padding-left: 3px;
    border: 1px solid #2c3e50;
    color: #333333;
}*/

  @media screen {
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }

    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }

  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }

  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }

  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }

  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }

  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  }

  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }

  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }

  a {
    color: #1a82e2;
  }

  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  </style>
  
</head>
<body style="">

  <!-- start preheader -->
  <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
    A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
  </div>
  <!-- end preheader -->

<div class="col-md-12" style="padding-top: 20px;">
 <table border="0" cellspacing="0" cellpadding="0" bgcolor="#edeff1"
style="margin: 0px; padding-top: 40px; padding-bottom: 80px; width:
100%;">
<tbody>
<tr>
<td><!-- Email Container --> <!-- NOTE: Mailer width 640px -->
<table class="container" align="center" border="0" cellspacing="0"
cellpadding="0" style="width: 640px;"><!-- @row 1 --> <!-- Preheader -->
<tbody>
<tr>
<td>
<table bgcolor="#e9e9e9" border="0" cellspacing="0" cellpadding="0"
style="width: 100%;">
<tbody>

<tr>
<td valign="top" style="text-align: left; padding: 20px 50px;
background-color: #ffffff;"><!-- Intro content -->
<p style="font-family: 'Open Sans', sans-serif; color: #333333; font-size:
17px; font-weight: 500; margin: 0 auto;">
<?php echo $message; ?>
<br>
<div class="row row text-center short_dashboard" id="active_class">   

        <section id="statistic" class="statistic-section one-page-section" style=" padding-top: 70px;
     padding-bottom: 70px;
     ">
        <div>
            
            <div style="display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap;  text-align: center!important;">
                <div style="flex: 0 0 160px;
    max-width: 160px;width: 160px; border:solid 1px black;-webkit-box-shadow: 4px 3px 13px 4px rgba(0,0,0,0.48); 
box-shadow: 4px 3px 13px 4px rgba(0,0,0,0.48); margin:5px;background-color:  linear-gradient(to right, #1a75ff , white );">
                    <div class="counter">
                        <i class="fa fa-laptop fa-2x stats-icon"></i>
                        <h2 class="timer count-title count-number">Onboarding</h2>
                        <div class="stats-line-black"></div>
                        <p class="stats-text"><?php echo $ob; ?></p>
                    </div>
                </div>
                
                <div style="flex: 0 0 160px;
    max-width: 160px;width: 160px; border:solid 1px black;-webkit-box-shadow: 4px 3px 13px 4px rgba(0,0,0,0.48); 
box-shadow: 4px 3px 13px 4px rgba(0,0,0,0.48); margin:5px;background-color:  linear-gradient(to right, #1a75ff , white );">
                    <div class="counter">
                        <i class="fa fa-laptop fa-2x stats-icon"></i>
                        <h2 class="timer count-title count-number">Application</h2>
                        <div class="stats-line-black"></div>
                        <p class="stats-text"><?php echo $ap; ?></p>
                    </div>
                </div>

                <div style="flex: 0 0 160px;
    max-width: 160px;width: 160px; border:solid 1px black;-webkit-box-shadow: 4px 3px 13px 4px rgba(0,0,0,0.48); 
box-shadow: 4px 3px 13px 4px rgba(0,0,0,0.48); margin:5px;background-color:  linear-gradient(to right, #1a75ff , white );">
                    <div class="counter">
                        <i class="fa fa-laptop fa-2x stats-icon"></i>
                        <h2 class="timer count-title count-number">Case Management</h2>
                        <div class="stats-line-black"></div>
                        <p class="stats-text"><?php echo $cm; ?></p>
                    </div>
                </div>

            </div>

            <div style="display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap;  text-align: center!important;">

                <div style="flex: 0 0 160px;
    max-width: 160px;width: 160px; border:solid 1px black;-webkit-box-shadow: 4px 3px 13px 4px rgba(0,0,0,0.48); 
box-shadow: 4px 3px 13px 4px rgba(0,0,0,0.48); margin:5px;background-color:  linear-gradient(to right, #1a75ff , white );">
                    <div class="counter">
                        <i class="fa fa-laptop fa-2x stats-icon"></i>
                        <h2 class="timer count-title count-number">Refunds</h2>
                        <div class="stats-line-black"></div>
                        <p class="stats-text"><?php echo $rc; ?></p>
                    </div>
                </div>


            </div>
        </div>
    </section>
        
    </div>
<br>

<a href="<?= $links ?>" target="_BLANK"><button type="button" style="margin:4px;
    background-color:green;
    border-radius:4px;
    border:1px solid #D0D0D0;
    overflow:auto;
    color:white;
    float:left;" >Click Here to view </button><br>
<br>
</p>
</td>
</tr>
<tr>

<!-- <td valign="top" style="text-align: left; padding: 20px 50px;
background-color: #ffffff;"> 
<p style="font-family: 'Open Sans', sans-serif; color: #333333; font-size:
17px; font-weight: 500; margin: 0 auto;">Sincerely,<br /> </p>
</td> -->
</tr>
<!-- end@row Footer --> <!-- @row Footer -->
<tr bgcolor="#fff">
<td style="padding: 55px; text-align: center;">
<div class="col-md-12" style="padding-top: 20px;">
<p style="margin: 0;font-size: 15px;text-align : justify; color :  #7F7F7F; ">
<span style="color: #a42658;font-size: 18px;font-weight: 900;font-family: 'Montserrat';">@username</span><br> 
<span style="font-size:18px;font-family: 'Montserrat';">@designation</span><br>
<span style="font-size: 18px;font-family: 'Montserrat';">@useremail</span><br>
<span style="font-size: 18px;font-family: 'Montserrat';">Mobile</span> : @userphone <br>
<span style="font-size: 18px;font-family: 'Montserrat';">www.godspeedvisa.com </span><br>
</p>
</div>

<div class="col-md-12" style="padding-top: 20px;">
  <div class="col-md-8" style="float:left;">
<span><img src="<?php echo base_url('assets/images/squire.png'); ?>" alt="Logo" border="0" style="display: block; width: 150px; max-width: 250px; min-width: 250px;"></span> 
 </div>
 <div class="col-md-4" style="float:left;">
<img src="<?php echo base_url('assets/images/circle.png'); ?>" alt="Logo" border="0" style="display: block; width: 80px; max-width: 80px; min-width: 80px; padding-left: 50px;margin-top: -6px;">
 </div>
</div>

<div class="col-md-12" style="padding-top: 100px;">
<p style="margin: 0;font-size: 12px;text-align : justify; color :  #7F7F7F;font-family: 'Montserrat'; "><b> DISCLAIMER:- </b>The information included or accompanying this email is intended only for the use of the recipient addressed and may contain confidential or privileged information. If the reader of this email is not the intended recipient thereof, you are hereby notified that any distribution or copying of this email is strictly prohibited and doing so will be deemed as a breach of confidence and/or privilege. If you have received this email in error, please notify us immediately. Any views or opinions presented in this email are solely those of the author and do not necessarily represent those of Godspeed Visa. Your case, if accepted by Godspeed visa, is based on the information you have provided, which we have been accepted by Godspeed Visa in good faith. Godspeed Visa is not liable and not responsible if the documents provided by you are misleading/fake /copy-pasted documents from Internet sources /in-genuine documentation or information. Godspeed Visa employees are very strictly warned and are required to follow the company policy. In the event of any employee going against company policy, Godspeed Visa is not responsible or liable for the same as our policy is to accept cases where details provided is 100% true. Godspeed visa will not provide any kind of documents/projects and only work on documentation that has been provided by the clients. We believe that all that has been submitted to us is 100% genuine. 
</p>
<br>
<p style="margin: 0;font-size: 12px;text-align : justify; color :  #7F7F7F; font-family: 'Montserrat';"><b>WARNING:</b><br> 
Computer viruses can be transmitted via email. The recipient should check this email and any attachments for the presence of viruses. The recipient should carry out their own virus checks before opening the email or attachment. Email transmission cannot be guaranteed to be secure or error-free as information could be intercepted, corrupted, lost, destroyed, arrive late or incomplete, or contain viruses. The sender, therefore, does not accept liability for any errors or omissions in the contents of this message, which arise as a result of email transmission. 
</p>
</div>
<p style="color: #646464; font-family: 'Open Sans', sans-serif; font-size:
14px; padding: 0; margin: 0; font-weight: normal; padding-top: 25px;
padding-bottom: 15px;">&copy; 2020 Godspeed. All rights reserved.</p>
</td>
</tr>
<!-- end@row Footer --></tbody>
</table>
<!-- End Email Container --></td>
</tr>
</tbody>
</table>
</div>

  <!-- end body -->
</body>
</html>