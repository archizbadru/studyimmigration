<?php
if (user_access(450)) { ?>
  <style type="text/css">
    .mask-number{
      -webkit-text-security: square;
    }
  </style>  
<?php
}
?>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>

<?php
   if ($tid == 1) {      
  define('FIRST_NAME',1);
  define('LAST_NAME',2);
  define('GENDER',3); 
  define('MOBILE',4);
  define('EMAIL',5);
 // define('COMPANY',6);
  define('LEAD_SOURCE',7);
  define('PRODUCT_FIELD',8);
  define('STATE_FIELD',9);
  define('CITY_FIELD',10);
  define('ADDRESS_FIELD',11);  
  define('REMARK_FIELD',12);  
  define('FINAL_COUNTRY_FIELD',13);  
  define('PIN_CODE',14);
  define('BRANCH_NAME',15);
  define('IN_TAKE',16);
  define('RESIDING_COUNTRY',17);
  define('NATIONALITY',18);
  define('PREFERRED_COUNTRY_FIELD',19);
  define('AGE',20);
  define('MARITAL_STATUS',21);
  define('APPLY_PERSON',22);
  define('COUNTRY_STAYED',23);
  define('POLICE_CASE',24);
  define('BAN_COUNTRY',25);
  define('VISA_TYPE',26);
  ?>
<hr>
<?php echo form_open_multipart('client/updateclient/'.$details->enquiry_id,'class="form-inner tabbed_form"') ?>  
<input type="hidden" name="form" value="client">  
<input name="en_comments" type="hidden" value="<?=$details->Enquery_id?>" >    
<div class="row">
   <?php                    
   $process_id = $details->product_id;    
      if(is_active_field(FIRST_NAME,$process_id)){
      ?>
   <div class="form-group col-sm-6 col-md-6">
      <label><?=display('first_name')?> <i class="text-danger">*</i> </label>
      <div class = "input-group">
         <span class = "input-group-addon" style="padding:0px !important;border:0px !important;width:44%;">
            <select class="form-control" name="name_prefix">
               <?php foreach($name_prefix as $n_prefix){?>
               <option value="<?= $n_prefix->prefix ?>" <?php if($n_prefix->prefix==$details->name_prefix){ echo 'selected';} ?>><?= $n_prefix->prefix ?></option>
               <?php } ?>
            </select>
         </span>
         <input class="form-control" name="enquirername" type="text" value="<?php echo $details->name ?>" placeholder="Enter First Name" style="width:100%;" />
      </div>
   </div>
   <?php }?>
   <?php
      if(is_active_field(LAST_NAME,$process_id)){
      ?>
   <div class="form-group col-sm-6 col-md-6"> 
      <label><?=display('last_name')?> <i class="text-danger"></i></label>
      <input class="form-control" value="<?php echo $details->lastname ?>" name="lastname" type="text" placeholder="Last Name" >  
   </div>
   <?php }?>
   <?php
      if(is_active_field(MOBILE,$process_id)){
      ?>
   <div class="form-group col-sm-6 col-md-6"> 
      <label><?php echo display('mobile') ?><i class="text-danger">*</i></label>
      <div class="input-group">
                           <span class="input-group-addon" style="padding:0px!important;border:0px!important;width:30%;">
                              <select class="form-control" name="code_prefix" id="prefixcode111">
                                <option value="93" data-country="Afghanistan"> +93</option>
                                <option value="355" data-country="Albania"> +355</option>
                                <option value="213" data-country="Algeria"> +213</option>
                                <option value="1684" data-country="American Samoa"> +1684</option>
                                <option value="376" data-country="Andorra"> +376</option>
                                <option value="244" data-country="Angola"> +244</option>
                                <option value="1264" data-country="Anguilla"> +1264</option>
                                <option value="0" data-country="Antarctica"> +0</option>
                                <option value="1268" data-country="Antigua and Barbuda"> +1268</option>
                                <option value="54" data-country="Argentina"> +54</option>
                                <option value="374" data-country="Armenia"> +374</option>
                                <option value="297" data-country="Aruba"> +297</option>
                                <option value="61" data-country="Australia"> +61</option>
                                <option value="43" data-country="Austria"> +43</option>
                                <option value="994" data-country="Azerbaijan"> +994</option>
                                <option value="1242" data-country="Bahamas"> +1242</option>
                                <option value="973" data-country="Bahrain"> +973</option>
                                <option value="880" data-country="Bangladesh"> +880</option>
                                <option value="1246" data-country="Barbados"> +1246</option>
                                <option value="375" data-country="Belarus"> +375</option>
                                <option value="32" data-country="Belgium"> +32</option>
                                <option value="501" data-country="Belize"> +501</option>
                                <option value="229" data-country="Benin"> +229</option>
                                <option value="1441" data-country="Bermuda"> +1441</option>
                                <option value="975" data-country="Bhutan"> +975</option>
                                <option value="591" data-country="Bolivia"> +591</option>
                                <option value="387" data-country="Bosnia and Herzegovina"> +387</option>
                                <option value="267" data-country="Botswana"> +267</option>
                                <option value="0" data-country="Bouvet Island"> +0</option>
                                <option value="55" data-country="Brazil"> +55</option>
                                <option value="246" data-country="British Indian Ocean Territory"> +246</option>
                                <option value="673" data-country="Brunei Darussalam"> +673</option>
                                <option value="359" data-country="Bulgaria"> +359</option>
                                <option value="226" data-country="Burkina Faso"> +226</option>
                                <option value="257" data-country="Burundi"> +257</option>
                                <option value="855" data-country="Cambodia"> +855</option>
                                <option value="237" data-country="Cameroon"> +237</option>
                                <option value="1" data-country="Canada"> +1</option>
                                <option value="238" data-country="Cape Verde"> +238</option>
                                <option value="1345" data-country="Cayman Islands"> +1345</option>
                                <option value="236" data-country="Central African Republic"> +236</option>
                                <option value="235" data-country="Chad"> +235</option>
                                <option value="56" data-country="Chile"> +56</option>
                                <option value="86" data-country="China"> +86</option>
                                <option value="61" data-country="Christmas Island"> +61</option>
                                <option value="672" data-country="Cocos (Keeling) Islands"> +672</option>
                                <option value="57" data-country="Colombia"> +57</option>
                                <option value="269" data-country="Comoros"> +269</option>
                                <option value="242" data-country="Congo"> +242</option>
                                <option value="242" data-country="Congo, the Democratic Republic of the"> +242</option>
                                <option value="682" data-country="Cook Islands"> +682</option>
                                <option value="506" data-country="Costa Rica"> +506</option>
                                <option value="225" data-country="Cote D" ivoire'=""> +225</option>
                                <option value="385" data-country="Croatia"> +385</option>
                                <option value="53" data-country="Cuba"> +53</option>
                                <option value="357" data-country="Cyprus"> +357</option>
                                <option value="420" data-country="Czech Republic"> +420</option>
                                <option value="45" data-country="Denmark"> +45</option>
                                <option value="253" data-country="Djibouti"> +253</option>
                                <option value="1767" data-country="Dominica"> +1767</option>
                                <option value="1809" data-country="Dominican Republic"> +1809</option>
                                <option value="593" data-country="Ecuador"> +593</option>
                                <option value="20" data-country="Egypt"> +20</option>
                                <option value="503" data-country="El Salvador"> +503</option>
                                <option value="240" data-country="Equatorial Guinea"> +240</option>
                                <option value="291" data-country="Eritrea"> +291</option>
                                <option value="372" data-country="Estonia"> +372</option>
                                <option value="251" data-country="Ethiopia"> +251</option>
                                <option value="500" data-country="Falkland Islands (Malvinas)"> +500</option>
                                <option value="298" data-country="Faroe Islands"> +298</option>
                                <option value="679" data-country="Fiji"> +679</option>
                                <option value="358" data-country="Finland"> +358</option>
                                <option value="33" data-country="France"> +33</option>
                                <option value="594" data-country="French Guiana"> +594</option>
                                <option value="689" data-country="French Polynesia"> +689</option>
                                <option value="0" data-country="French Southern Territories"> +0</option>
                                <option value="241" data-country="Gabon"> +241</option>
                                <option value="220" data-country="Gambia"> +220</option>
                                <option value="995" data-country="Georgia"> +995</option>
                                <option value="49" data-country="Germany"> +49</option>
                                <option value="233" data-country="Ghana"> +233</option>
                                <option value="350" data-country="Gibraltar"> +350</option>
                                    <option value="30" data-country="Greece"> +30</option>
                                    <option value="299" data-country="Greenland"> +299</option>
                                    <option value="1473" data-country="Grenada"> +1473</option>
                                    <option value="590" data-country="Guadeloupe"> +590</option>
                                    <option value="1671" data-country="Guam"> +1671</option>
                                    <option value="502" data-country="Guatemala"> +502</option>
                                    <option value="224" data-country="Guinea"> +224</option>
                                    <option value="245" data-country="Guinea-Bissau"> +245</option>
                                    <option value="592" data-country="Guyana"> +592</option>
                                    <option value="509" data-country="Haiti"> +509</option>
                                    <option value="0" data-country="Heard Island and Mcdonald Islands"> +0</option>
                                    <option value="39" data-country="Holy See (Vatican City State)"> +39</option>
                                    <option value="504" data-country="Honduras"> +504</option>
                                    <option value="852" data-country="Hong Kong"> +852</option>
                                    <option value="36" data-country="Hungary"> +36</option>
                                    <option value="354" data-country="Iceland"> +354</option>
                                    <option value="91" data-country="India" selected="" data-select2-id="3"> +91</option>
                                    <option value="62" data-country="Indonesia"> +62</option>
                                    <option value="98" data-country="Iran, Islamic Republic of"> +98</option>
                                    <option value="964" data-country="Iraq"> +964</option>
                                    <option value="353" data-country="Ireland"> +353</option>
                                    <option value="972" data-country="Israel"> +972</option>
                                    <option value="39" data-country="Italy"> +39</option>
                                    <option value="1876" data-country="Jamaica"> +1876</option>
                                    <option value="81" data-country="Japan"> +81</option>
                                    <option value="962" data-country="Jordan"> +962</option>
                                    <option value="7" data-country="Kazakhstan"> +7</option>
                                    <option value="254" data-country="Kenya"> +254</option>
                                    <option value="686" data-country="Kiribati"> +686</option>
                                    <option value="850" data-country="Korea, Democratic People" s="" republic="" of'=""> +850</option>
                                    <option value="82" data-country="Korea, Republic of"> +82</option>
                                    <option value="965" data-country="Kuwait"> +965</option>
                                    <option value="996" data-country="Kyrgyzstan"> +996</option>
                                    <option value="856" data-country="Lao People" s="" democratic="" republic'=""> +856</option>
                                    <option value="371" data-country="Latvia"> +371</option>
                                    <option value="961" data-country="Lebanon"> +961</option>
                                    <option value="266" data-country="Lesotho"> +266</option>
                                    <option value="231" data-country="Liberia"> +231</option>
                                    <option value="218" data-country="Libyan Arab Jamahiriya"> +218</option>
                                    <option value="423" data-country="Liechtenstein"> +423</option>
                                    <option value="370" data-country="Lithuania"> +370</option>
                                    <option value="352" data-country="Luxembourg"> +352</option>
                                    <option value="853" data-country="Macao"> +853</option>
                                    <option value="389" data-country="Macedonia, the Former Yugoslav Republic of"> +389</option>
                                    <option value="261" data-country="Madagascar"> +261</option>
                                    <option value="265" data-country="Malawi"> +265</option>
                                    <option value="60" data-country="Malaysia"> +60</option>
                                    <option value="960" data-country="Maldives"> +960</option>
                                    <option value="223" data-country="Mali"> +223</option>
                                    <option value="356" data-country="Malta"> +356</option>
                                    <option value="692" data-country="Marshall Islands"> +692</option>
                                    <option value="596" data-country="Martinique"> +596</option>
                                    <option value="222" data-country="Mauritania"> +222</option>
                                    <option value="230" data-country="Mauritius"> +230</option>
                                    <option value="269" data-country="Mayotte"> +269</option>
                                    <option value="52" data-country="Mexico"> +52</option>
                                    <option value="691" data-country="Micronesia, Federated States of"> +691</option>
                                    <option value="373" data-country="Moldova, Republic of"> +373</option>
                                    <option value="377" data-country="Monaco"> +377</option>
                                    <option value="976" data-country="Mongolia"> +976</option>
                                    <option value="1664" data-country="Montserrat"> +1664</option>
                                    <option value="212" data-country="Morocco"> +212</option>
                                    <option value="258" data-country="Mozambique"> +258</option>
                                    <option value="95" data-country="Myanmar"> +95</option>
                                    <option value="264" data-country="Namibia"> +264</option>
                                    <option value="674" data-country="Nauru"> +674</option>
                                    <option value="977" data-country="Nepal"> +977</option>
                                    <option value="31" data-country="Netherlands"> +31</option>
                                    <option value="599" data-country="Netherlands Antilles"> +599</option>
                                    <option value="687" data-country="New Caledonia"> +687</option>
                                    <option value="64" data-country="New Zealand"> +64</option>
                                    <option value="505" data-country="Nicaragua"> +505</option>
                                    <option value="227" data-country="Niger"> +227</option>
                                    <option value="234" data-country="Nigeria"> +234</option>
                                    <option value="683" data-country="Niue"> +683</option>
                                    <option value="672" data-country="Norfolk Island"> +672</option>
                                    <option value="1670" data-country="Northern Mariana Islands"> +1670</option>
                                    <option value="47" data-country="Norway"> +47</option>
                                    <option value="968" data-country="Oman"> +968</option>
                                    <option value="92" data-country="Pakistan"> +92</option>
                                    <option value="680" data-country="Palau"> +680</option>
                                    <option value="970" data-country="Palestinian Territory, Occupied"> +970</option>
                                    <option value="507" data-country="Panama"> +507</option>
                                    <option value="675" data-country="Papua New Guinea"> +675</option>
                                    <option value="595" data-country="Paraguay"> +595</option>
                                    <option value="51" data-country="Peru"> +51</option>
                                    <option value="63" data-country="Philippines"> +63</option>
                                    <option value="0" data-country="Pitcairn"> +0</option>
                                    <option value="48" data-country="Poland"> +48</option>
                                    <option value="351" data-country="Portugal"> +351</option>
                                    <option value="1787" data-country="Puerto Rico"> +1787</option>
                                    <option value="974" data-country="Qatar"> +974</option>
                                    <option value="262" data-country="Reunion"> +262</option>
                                    <option value="40" data-country="Romania"> +40</option>
                                    <option value="70" data-country="Russian Federation"> +70</option>
                                    <option value="250" data-country="Rwanda"> +250</option>
                                    <option value="290" data-country="Saint Helena"> +290</option>
                                    <option value="1869" data-country="Saint Kitts and Nevis"> +1869</option>
                                    <option value="1758" data-country="Saint Lucia"> +1758</option>
                                    <option value="508" data-country="Saint Pierre and Miquelon"> +508</option>
                                    <option value="1784" data-country="Saint Vincent and the Grenadines"> +1784</option>
                                    <option value="684" data-country="Samoa"> +684</option>
                                    <option value="378" data-country="San Marino"> +378</option>
                                    <option value="239" data-country="Sao Tome and Principe"> +239</option>
                                    <option value="966" data-country="Saudi Arabia"> +966</option>
                                    <option value="221" data-country="Senegal"> +221</option>
                                    <option value="381" data-country="Serbia and Montenegro"> +381</option>
                                    <option value="248" data-country="Seychelles"> +248</option>
                                    <option value="232" data-country="Sierra Leone"> +232</option>
                                    <option value="65" data-country="Singapore"> +65</option>
                                    <option value="421" data-country="Slovakia"> +421</option>
                                    <option value="386" data-country="Slovenia"> +386</option>
                                    <option value="677" data-country="Solomon Islands"> +677</option>
                                    <option value="252" data-country="Somalia"> +252</option>
                                    <option value="27" data-country="South Africa"> +27</option>
                                    <option value="0" data-country="South Georgia and the South Sandwich Islands"> +0</option>
                                    <option value="34" data-country="Spain"> +34</option>
                                    <option value="94" data-country="Sri Lanka"> +94</option>
                                    <option value="249" data-country="Sudan"> +249</option>
                                    <option value="597" data-country="Suriname"> +597</option>
                                    <option value="47" data-country="Svalbard and Jan Mayen"> +47</option>
                                    <option value="268" data-country="Swaziland"> +268</option>
                                    <option value="46" data-country="Sweden"> +46</option>
                                    <option value="41" data-country="Switzerland"> +41</option>
                                    <option value="963" data-country="Syrian Arab Republic"> +963</option>
                                    <option value="886" data-country="Taiwan, Province of China"> +886</option>
                                    <option value="992" data-country="Tajikistan"> +992</option>
                                    <option value="255" data-country="Tanzania, United Republic of"> +255</option>
                                    <option value="66" data-country="Thailand"> +66</option>
                                    <option value="670" data-country="Timor-Leste"> +670</option>
                                    <option value="228" data-country="Togo"> +228</option>
                                    <option value="690" data-country="Tokelau"> +690</option>
                                    <option value="676" data-country="Tonga"> +676</option>
                                    <option value="1868" data-country="Trinidad and Tobago"> +1868</option>
                                    <option value="216" data-country="Tunisia"> +216</option>
                                    <option value="90" data-country="Turkey"> +90</option>
                                    <option value="7370" data-country="Turkmenistan"> +7370</option>
                                    <option value="1649" data-country="Turks and Caicos Islands"> +1649</option>
                                    <option value="688" data-country="Tuvalu"> +688</option>
                                    <option value="256" data-country="Uganda"> +256</option>
                                    <option value="380" data-country="Ukraine"> +380</option>
                                    <option value="971" data-country="United Arab Emirates"> +971</option>
                                    <option value="44" data-country="United Kingdom"> +44</option>
                                    <option value="1" data-country="United States"> +1</option>
                                    <option value="1" data-country="United States Minor Outlying Islands"> +1</option>
                                    <option value="598" data-country="Uruguay"> +598</option>
                                    <option value="998" data-country="Uzbekistan"> +998</option>
                                    <option value="678" data-country="Vanuatu"> +678</option>
                                    <option value="58" data-country="Venezuela"> +58</option>
                                    <option value="84" data-country="Viet Nam"> +84</option>
                                    <option value="1284" data-country="Virgin Islands, British"> +1284</option>
                                    <option value="1340" data-country="Virgin Islands, U.s."> +1340</option>
                                    <option value="681" data-country="Wallis and Futuna"> +681</option>
                                    <option value="212" data-country="Western Sahara"> +212</option>
                                    <option value="967" data-country="Yemen"> +967</option>
                                    <option value="260" data-country="Zambia"> +260</option>
                                    <option value="263" data-country="Zimbabwe"> +263</option>
                                                               </select>
                           </span>
      <input class="form-control mask-number" style="width:100%" id="mobileno" name="mobileno" type="text" maxlength='12' value="<?php echo $p = substr($details->phone, -10); ?>" onchange="exist_alert(this.value,'mobile')" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
   </div>
   <i class="fa fa-plus" onclick="add_more_phone('add_more_phone')" style="float:right;margin-top:-25px;margin-right:10px;color:red;"></i>

   </div>
   <script>
$(document).ready(function(){ 
  $('#prefixcode111').select2({}); 

  $('#prefixcode111 [value=<?= $details->code_prefix??'91' ?>]').attr('selected', 'true');
 });
</script>
   <?php }?>
   <?php
      if(is_active_field(MOBILE,$process_id)){
      ?>
   <div id="add_more_phone">
      <?php
         if (!empty($details->other_phone)) {
           $other_phones = explode(',', $details->other_phone);
           foreach ($other_phones as $k=>$p) { ?>
      <div class="form-group col-sm-6 col-md-6">
         <label>Other No </label>
         <input class="form-control mask-number"  name="other_no[]" type="text" placeholder="Other Number" value="<?=$p?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
      </div>
      <?php
         }
         }
         ?>
   </div>
   <?php }?>                     
   <?php
      if(is_active_field(EMAIL,$process_id)){
      ?>
   <div class="form-group col-sm-6 col-md-6"> 
      <label><?php echo display('email') ?><i class="text-danger">*</i></label>
      <input class="form-control" name="email" id="email" type="email" onchange="exist_alert(this.value,'email')" value="<?php echo $details->email ?>" required>
      <i class="fa fa-plus" onclick="add_more_email('add_more_email')" style="float:right;margin-top:-25px;margin-right:10px;color:red"></i>  
   </div>
   <?php }?>


   <?php
      if(is_active_field(EMAIL,$process_id)){
      ?>
   <div id="add_more_email">
      <?php
         if (!empty($details->other_email)) {
           $other_email = explode(',', $details->other_email);
           foreach ($other_email as $k=>$p) { ?>
      <div class="form-group col-sm-6 col-md-6">
         <label>Other Email </label>
         <input class="form-control mask-number"  name="other_email[]" type="text" placeholder="Other Email" value="<?=$p?>">
      </div>
      <?php
         }
         }
         ?>
   </div>
   <?php }?>



   <?php
      if(is_active_field(EMAIL,$process_id)){
      ?>
   <div class="form-group col-sm-6 col-md-6">
      <label>Process <i class="text-danger">*</i></label>
      <select name="product_id" id="product_id_alert" class="form-control">
         <option value="" style="">--Select process--</option>
         <?php foreach($products as $product){?>
         <option value="<?=$product->sb_id ?>" <?php if($product->sb_id==$details->product_id){ echo 'selected';}?>><?=$product->product_name ?></option>
         <?php } ?>
      </select>
   </div>
   <?php
      }
     if(is_active_field(GENDER,$process_id)){
     ?>
      <div class="form-group col-sm-6 col-md-6"> 
         <label><?php echo display("gender"); ?><i class="text-danger"></i></label>
          <select name="gender" class="form-control">
            <option value="">---Select---</option>
            <option value="1" <?php if(1==$details->gender){ echo 'selected';}?> ><?php echo display("male"); ?></option>
            <option value="2" <?php if(2==$details->gender){ echo 'selected';}?> ><?php echo display("female"); ?></option>
            <option value="3" <?php if(3==$details->gender){ echo 'selected';}?> ><?php echo display("other"); ?></option>
          </select>                           
      </div>

    <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Expected Closer Date'; ?></label>
        <input class="form-control" name="expected_date" type="date" id="expected_date" value="<?php echo $details->lead_expected_date; ?>" placeholder="Expected Closer Date"> 
    </div>
  
  <div class="form-group col-sm-6 col-md-6">
  <label class="col-form-label">Conversion Probability</label>
        <select class="form-control" id="Lead_Scores" name="lead_score">
        <option>Select Here</option>
        <?php foreach ($lead_score as $score) {  ?>
        <option value="<?= $score->sc_id?>" <?php if($score->sc_id==$details->lead_score){ echo 'selected';}?>><?= $score->score_name?>&nbsp;<?= $score->probability?></option>
        <?php } ?>
        </select>
  </div>
    
   <?php
    }
      if(is_active_field(LEAD_SOURCE,$process_id)){
      ?> 
   <div class="form-group   col-sm-4 col-md-6">
      <label><?php echo display('lead_source') ?><i class="text-danger">*</i></label>
      <select class="form-control" name="lead_source" id="lead_source" onchange="find_sub1()">
         <option value=""><?php echo display('lead_source') ?></option>
         <?php 
            foreach ($leadsource as $post){?>
         <option value="<?= $post->lsid?>" <?php if($details->enquiry_source==$post->lsid){echo 'selected';}?>><?= $post->lead_name?></option>
         <?php } ?>
      </select>
   </div>

    <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Point test' ?> <i class="text-danger"></i><a href="https://www.cic.gc.ca/english/immigrate/skilled/crs-tool.asp" target="_blank" class="float-right"><u> Go To Calculator </u></a></label>
        <input class="form-control" value="<?php  echo $details->point_calc;?> " name="point_calc" type="text"  placeholder="Point test Calculator"> 
    </div>

   <?php } 
   if(is_active_field(PRODUCT_FIELD,$process_id)){
        ?>
   <div class="form-group col-sm-6 col-md-6">
      <label><?php echo display("subsource"); ?></label>
      <select class="form-control" name="sub_source" id="sub_source">
         <option value="" style="display:none;">Select Product</option>
         <?php foreach ($subsource_list as $subsource){ ?>
         <option value="<?= $subsource->subsource_id?>" <?php if($subsource->subsource_id==$details->enquiry_subsource){ echo 'selected';}?>><?= $subsource->subsource_name?></option>
         <?php } ?>
      </select>
   </div>

    <div class="form-group col-sm-6 col-md-6">
      <label><?php echo display("product"); ?><i class="text-danger">*</i></label>
      <select class="form-control" name="req_program" id="req_program">
          <option value="" style="display:none;">---Select---</option>
          <?php foreach ($product_contry as $subsource){ ?>
          <option value="<?= $subsource->id?>" <?php if($subsource->id==$details->req_program){ echo 'selected';}?>><?= $subsource->country_name?></option>
          <?php } ?>
        </select>
    </div>
   <?php }?> 
   <?php      
      if(is_active_field(STATE_FIELD,$process_id)){
      ?>  
   <div class="form-group col-sm-6 col-md-6">
      <label>State <i class="text-danger"></i></label>                        
      <select name="state_id" class="form-control" id="fstate">
         <option value="" >Select</option>
         <?php foreach($state_list as $state){
            //echo  $state->id.' '.$details->state_id;
            ?>
         <option value="<?php echo $state->id ?>" <?php if(!empty($state_list)){ if($state->id == $details->enquiry_state_id){echo 'selected';} }?>><?php echo $state->state; ?></option>
         <?php } ?>
      </select>
   </div>
   <?php }?>
   <?php
      if(is_active_field(CITY_FIELD,$process_id)){
      ?>                   
   <div class="form-group col-sm-6 col-md-6">
      <label>City <i class="text-danger"></i></label>
      <select name="city_id" class="form-control" id="fcity">
         <option value="" >Select</option>
         <?php
            foreach ($city_list as $value) { ?>
         <option value="<?=$value->id?>" <?php if($details->enquiry_city_id == $value->id) echo "selected = selected";?>><?=$value->city;?></option>
         <?php                           
            }
            ?>
      </select>
   </div>

   <?php }
  if(is_active_field(RESIDING_COUNTRY,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Residing Country' ?> <i class="text-danger"></i></label>
            <select class="form-control" name="residing_country" class="" id="residing_country">
                <option value="">---Select---</option>
                  <?php foreach($allcountry_list as $country){ ?>
                <option value="<?= $country->id_c?>" <?php if(!empty($details->residing_country)){ if($country->id_c == $details->residing_country){echo 'selected';} }?>> <?= $country->country_name?></option>
                  <?php } ?>
            </select> 
    </div>


   <?php }
   if(is_active_field(PIN_CODE,$process_id)){    ?> 
     <div class="form-group col-sm-6 col-md-6">
        <label><?php echo display('pin_code') ?> <i class="text-danger"></i></label>
        <input class="form-control" value="<?php  echo $details->pin_code;?> " name="pin_code" type="text"  placeholder="Pin Code"> 
     </div>   
     <?php
   }   
     // if(is_active_field(COMPANY,$process_id)){
      ?>
   <!-- <div class="form-group col-sm-6 col-md-6">
      <label><?php echo display('company_name') ?> <i class="text-danger">*</i></label>
      <input class="form-control" name="company" type="company" value="<?php echo $details->company; ?>">
   </div> -->

   <?php //} 
   if(is_active_field(FINAL_COUNTRY_FIELD,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
      <label>Final Country <i class="text-danger">*</i></label>
      <?php
         $current_country  = $details->enq_country;             
         $current_country = explode(',',$current_country);                        
         ?>
      <select name="country_id[]" id="final_contry" class="form-control" onchange="find_visa()">
         <?php foreach($all_country_list as $product){ ?>
         <option value="<?=$product->id_c?>" <?php if(in_array($product->id_c,$current_country)) echo "selected = selected"; ?>><?=$product->country_name ?></option>
         <?php } ?>
      </select>
   </div> 

  <?php }
  if(is_active_field(BRANCH_NAME,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Branch Name' ?> <i class="text-danger">*</i></label>
        <select class="form-control" name="branch_name" id="branch_name" required>
            <option value="" style="">---Select---</option>
        <?php foreach ($all_branch as $key => $branch) { ?>
            <option value="<?php echo $branch->id; ?>" <?php if($branch->id==$details->branch_name){ echo 'selected';}?>><?php echo $branch->b_name; ?></option>
        <?php } ?>
        </select> 
    </div>

    <?php }
  if(is_active_field(IN_TAKE,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'In Take' ?> <i class="text-danger"></i></label>
            <select class="form-control" name="in_take" class="" id="in_take">
                <option value="">---Select---</option>
                <option value="" style="display:none;">---Select---</option>
                <option value="January" <?php if(!empty($details->in_take)){ if($details->in_take == 'January'){echo 'selected';} }?>> January</option>
                <option value="February" <?php if(!empty($details->in_take)){ if($details->in_take == 'February'){echo 'selected';} }?>> February</option>
                <option value="March" <?php if(!empty($details->in_take)){ if($details->in_take == 'March'){echo 'selected';} }?>> March</option>
                <option value="April" <?php if(!empty($details->in_take)){ if($details->in_take == 'April'){echo 'selected';} }?>> April</option>
                <option value="May" <?php if(!empty($details->in_take)){ if($details->in_take == 'May'){echo 'selected';} }?>> May</option>
                <option value="June" <?php if(!empty($details->in_take)){ if($details->in_take == 'June'){echo 'selected';} }?>> June</option>
                <option value="July" <?php if(!empty($details->in_take)){ if($details->in_take == 'July'){echo 'selected';} }?>> July</option>
                <option value="August" <?php if(!empty($details->in_take)){ if($details->in_take == 'August'){echo 'selected';} }?>> August</option>
                <option value="September" <?php if(!empty($details->in_take)){ if($details->in_take == 'September'){echo 'selected';} }?>> September</option>
                <option value="October" <?php if(!empty($details->in_take)){ if($details->in_take == 'October'){echo 'selected';} }?>> October</option>
                <option value="November" <?php if(!empty($details->in_take)){ if($details->in_take == 'November'){echo 'selected';} }?>> November</option>
                <option value="December" <?php if(!empty($details->in_take)){ if($details->in_take == 'December'){echo 'selected';} }?>> December</option>
            </select> 
    </div>

    <div class="form-group col-sm-6 col-md-6">
      <label><?php echo 'Qualification' ?> <i class="text-danger"></i></label>
      <input class="form-control" name="qualification" type="text" value="<?php echo $details->qualification; ?>">
    </div>
    
    <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Experience' ?> <i class="text-danger"></i></label>
            <select class="form-control" name="experience" class="" id="">
                <option value="" style="">---Select Experience---</option>
                <option value="Yes" <?php if(!empty($details->experience)){ if($details->experience == 'Yes'){echo 'selected';} }?>> Yes</option>
                <option value="No" <?php if(!empty($details->experience)){ if($details->experience == 'No'){echo 'selected';} }?>> No</option>
            </select> 
    </div>

    <?php }
  if(is_active_field(PREFERRED_COUNTRY_FIELD,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Preferred Country' ?> <i class="text-danger"></i></label>
          <?php
          $preferred_country  = $details->preferred_country;             
          $preferred_country = explode(',',$preferred_country);                        
          ?>
            <select class="form-control" multiple autocomplete="false" name="preferred_country[]" class="" id="preferred_country">
                <?php foreach($all_country_list as $product){ ?>
                <option value="<?=$product->id_c?>" <?php if(in_array($product->id_c,$preferred_country)) echo "selected = selected"; ?>><?=$product->country_name ?></option>
                <?php } ?>
            </select>    
    </div>

    <?php }
    if(is_active_field(VISA_TYPE,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Visa Type' ?> <i class="text-danger"></i></label>
          <select class="form-control" name="visa_type" class="" id="visa_type" onchange="find_visa_class()">
              <option value="">---Select---</option>
              <?php foreach($visa_type as $visa){ ?>
              <option value="<?php echo $visa->id; ?>" <?php if(!empty($details->visa_type)){ if($details->visa_type == $visa->id){echo 'selected';} }?>><?php echo $visa->visa_type; ?></option>
              <?php } ?>
          </select> 
    </div>

    <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Visa Sub Class' ?> <i class="text-danger"></i></label>
          <select class="form-control" name="sub_class" class="" id="sub_class">
              <option value="">---Select---</option>
              <?php foreach($visa_class as $sub_class){ ?>
              <option value="<?php echo $sub_class->id; ?>" <?php if(!empty($details->sub_class)){ if($details->sub_class == $sub_class->id){echo 'selected';} }?>><?php echo $sub_class->sub_class; ?></option>
              <?php } ?>
          </select> 
    </div>

    <?php }
  if(is_active_field(NATIONALITY,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Nationality' ?> <i class="text-danger"></i></label>
            <select class="form-control" name="nationality" class="" id="nationality">
                <option value="">---Select---</option>
                  <?php foreach($allcountry_list as $country){ ?>
                <option value="<?= $country->id_c?>" <?php if(!empty($details->nationality)){ if($country->id_c == $details->nationality){echo 'selected';} }?>> <?= $country->country_name?></option>
                  <?php } ?>
            </select> 
    </div> 

  <?php }
  if(is_active_field(AGE,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Age' ?> <i class="text-danger"></i></label>
        <input class="form-control" value="<?= $details->age?>" name="age" type="number"  placeholder="Enter Age"> 
    </div>

  <?php }
  if(is_active_field(MARITAL_STATUS,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Marital Status' ?> <i class="text-danger"></i></label>
          <select class="form-control" name="marital_status" class="" id="marital_status">
            <option value="">---Select---</option>
            <option value="single" <?php if(!empty($details->marital_status)){ if($details->marital_status == 'single'){echo 'selected';} }?>> Single</option>
            <option value="married" <?php if(!empty($details->marital_status)){ if($details->marital_status == 'married'){echo 'selected';} }?>> Married</option>
            <option value="widowed" <?php if(!empty($details->marital_status)){ if($details->marital_status == 'widowed'){echo 'selected';} }?>> Widowed</option>
            <option value="divorced" <?php if(!empty($details->marital_status)){ if($details->marital_status == 'divorced'){echo 'selected';} }?>> Divorced</option>
            <option value="separated" <?php if(!empty($details->marital_status)){ if($details->marital_status == 'separated'){echo 'selected';} }?>> Separated</option>
        </select> 
    </div>

    <?php }
  if(is_active_field(APPLY_PERSON,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Number Of Persons To Apply' ?> <i class="text-danger"></i></label>
        <input class="form-control" value="<?php echo $details->apply_person; ?>" name="apply_person" type="number"  placeholder="Apply Person">
  </div>

  <?php }
  if(is_active_field(COUNTRY_STAYED,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Countries Stayed For More Than 6 Months' ?> <i class="text-danger"></i></label>
        <input class="form-control" value="<?php echo $details->country_stayed; ?>" name="country_stayed" type="number"  placeholder="No. of Countries"> 
  </div>

  <?php }
  if(is_active_field(POLICE_CASE,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Any Police Case(in Any Country Including India)' ?> <i class="text-danger"></i></label>
        <select class="form-control" name="police_case" class="" id="police_case">
            <option value="">---Select---</option>
            <option value="1" <?php if($details->police_case == '1'){echo 'selected';} ?>> Yes</option>
            <option value="0" <?php if($details->police_case == '0'){echo 'selected';} ?>> No</option>
        </select> 
    </div>

    <?php }
  if(is_active_field(BAN_COUNTRY,$process_id)){
   ?>
   <div class="form-group col-sm-6 col-md-6">
        <label><?php echo 'Any Visa Rejection/Ban From Any Country' ?> <i class="text-danger"></i></label>
        <select class="form-control" name="ban_country" class="" id="ban_country">
          <option value="">---Select---</option>
          <option value="1" <?php if($details->ban_country == '1'){echo 'selected';} ?>> Yes</option>
          <option value="0" <?php if($details->ban_country == '0'){echo 'selected';} ?>> No</option>
        </select> 
    </div>
     
  <?php }
  if(is_active_field(ADDRESS_FIELD,$process_id)){
    ?>  
   <div class="form-group col-sm-6 col-md-6">
      <label><?php echo display('address') ?> <i class="text-danger"></i></label>
      <textarea class="form-control" name="address"><?php echo $details->address; ?></textarea>
   </div>
   <?php }
   if(is_active_field(REMARK_FIELD,$process_id)){
      ?>  
   <div class="form-group col-sm-12 col-md-12"> 
      <label><?=display('remark')?></label>
      <textarea class="form-control" name="enquiry"><?php echo $details->enquiry; ?></textarea>
   </div>
   <?php }  
      if(!empty($dynamic_field)) {       
          foreach($dynamic_field as $ind => $fld){
            ?>
<?php if($fld['input_type']==19){ ?>         
<div class="col-md-12">
<label style="color:#283593;"><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?><i class="text-danger"></i></label>
 <hr>
</div>
<?php }?>
<?php if($fld['input_type']!=19){ ?>      
            <div class="form-group col-md-6 <?=$fld['input_name']?> " >
               <?php if($fld['input_type']==1){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="text" name="enqueryfield[]"  value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>"  class="form-control">
               <?php }
               if($fld['input_type']==2){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <?php $optarr = (!empty($fld['input_values'])) ? explode(",",$fld['input_values']) : array(); 
               ?>
               <select class="form-control"  name="enqueryfield[]" id="<?=$fld['input_name']?>">
                  <option value="">Select</option>
                  <?php  foreach($optarr as $key => $val){
                  ?>
                  <option value = "<?php echo $val; ?>" <?php echo (!empty($fld["fvalue"]) and trim($fld["fvalue"]) == trim($val)) ? "selected" : ""; ?>><?php echo $val; ?></option>
                  <?php
                     } 
                  ?>
               </select>
               <?php }
               if($fld['input_type']==20){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <?php $optarr = (!empty($fld['input_values'])) ? explode(",",$fld['input_values']) : array(); 
               ?>
               <input type="hidden"  name="enqueryfield[]"  id="multi-<?=$fld['input_name']?>"  value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <select class="multiple-select" name='multi[]' multiple onchange="changeSelect(this)" id="<?=$fld['input_name']?>">
                  <?php  foreach($optarr as $key => $val){                  
                    $fvalues  = explode(',', $fld['fvalue']);
                    ?>
                    <option value = "<?php echo $val; ?>" <?php echo (!empty($fld["fvalue"]) and in_array($val, $fvalues)) ? "selected" : ""; ?>><?php echo $val; ?></option>
                  <?php
                     } 
                  ?>
               </select>
               <?php }
               if($fld['input_type']==3){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="radio"  name="enqueryfield[]"  id="<?=$fld['input_name']?>" class="form-control">                         
               <?php }if($fld['input_type']==4){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="checkbox"  name="enqueryfield[]"  id="<?=$fld['input_name']?>" class="form-control">         
               <?php }if($fld['input_type']==5){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <textarea   name="enqueryfield[]"  <?= $fld['fld_attributes']; ?> class="form-control" placeholder="<?= $fld['input_place']; ?>" ><?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?></textarea>
               <?php }?>
               <?php if($fld['input_type']==6){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="date"  name="enqueryfield[]" class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
               <?php if($fld['input_type']==7){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="time"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
               <?php if($fld['input_type']==8){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="hidden" readonly name="enqueryfield[]"  class="form-control"  value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <input type="file"  name="enqueryfiles[]"  class="form-control" >
                <?php 
               if (!empty($fld["fvalue"])) {
                  ?>
                  <a href="<?=$fld['fvalue']?>" target="_blank"><?=basename($fld['fvalue'])?></a>
                  <?php
               }
                }?>                
               <?php if($fld['input_type']==9){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="password"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                  <?php if($fld['input_type']==10){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="color"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
               <?php if($fld['input_type']==11){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="datetime-local"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==12){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="email"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==13){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="month"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==14){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="number"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==15){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="url"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==16){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="week"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==17){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="search"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
               <?php if($fld['input_type']==18){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="tel"  name="enqueryfield[]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>              
               <input type="hidden" name= "inputfieldno[]" value = "<?=$fld['input_id']; ?>">
               <input type="hidden" name= "inputtype[]" value = "<?=$fld['input_type']?>">
            </div>
<?php } ?>
   <?php  }   
  }
  ?>
</div>
<div class="row"   id="save_button">
   <div class="col-md-12 text-center">                                                      
      <input type="submit" name="submit_only" class="btn btn-primary" value="Save" >
      <input type="submit" name="submit_and_next" class="btn btn-primary" value="Save And Next">
      <input type="button" class="btn btn-success" onclick="disableField();" value="Enable Edit">
      <input type="hidden" name="go_new_tab">           
   </div>
</div>
   <?php echo form_close(); 
   }else if($form_type == 1){ ?>
          
          <hr>
          <?php
          if ($tid == 48 || $tid==49) { 
            $form_id = base64_encode($tid);
            $ucomp_id = base64_encode($this->session->companey_id);
            $uenquiry_code = base64_encode($details->Enquery_id);
            $uuid = base64_encode($this->session->user_id);
            $f_url = base_url().'public/survery/'.$form_id.'/'.$ucomp_id.'/'.$uenquiry_code.'/'.$uuid;
            ?>
            <a onclick='share_form("<?=$f_url?>","<?=$details->email?>")' href='javascript:void(0)' class="btn btn-primary btn-sm">Share to user</a>
            <br>
            <br>            
          <?php
          }
          if(!empty($dynamic_field)) {
          ?>
          <div style="overflow-y: scroll;">
          <table class="table table-striped table-bordered table-responsive table-sm">
            <thead class="thead-dark">
                <tr>
                  <?php
                    $counter = 0;
                  if(!empty($dynamic_field)) {
                    foreach($dynamic_field as $ind => $fld){ $counter++; ?>

                        <th><?=ucwords($fld["input_label"])?></th>
                    <?php
                    }
                    ?>
                    <th>Created At</th>
                    <th>Action</th>
                    <?php
                  }
                  ?>
                </tr>              
            </thead>
            <tbody>
              <?php              
                $sql  = "SELECT GROUP_CONCAT(concat(`extra_enquery`.`input`,'#',`extra_enquery`.`fvalue`,'#',`extra_enquery`.`created_date`,'#',`extra_enquery`.`comment_id`) separator ',') as d FROM `extra_enquery` INNER JOIN (select * from tbl_input where form_id=$tid) as tbl_input ON `tbl_input`.`input_id`=`extra_enquery`.`input` where `extra_enquery`.`cmp_no`=$comp_id and `extra_enquery`.`enq_no`='$details->Enquery_id' GROUP BY `extra_enquery`.`comment_id` ORDER BY `extra_enquery`.`comment_id` DESC";
                $res = $this->db->query($sql)->result_array();    
                //print_r($res);die;

                if (!empty($res)) {
                  foreach ($res as $key => $value) {
                    ?>
                    <tr>
                    <?php
                    $arr  = explode(',', $value['d']);                     
                    if (!empty($arr)) {
                      foreach($dynamic_field as $ind => $fld){ 
                        $d = 'NA';
                        foreach ($arr as $key1 => $value1) {                        
                          $arr1 = explode('#', $value1);                           
                          if (!empty($arr1[1]) && $arr1[0]==$fld['input']) {
                            $d  = $arr1[1];
                            $d  = explode('/',$arr1[1]);
                            if (filter_var($arr1[1], FILTER_VALIDATE_URL)) 
                            {
                              $d = '<a href='.$arr1[1].'>'.end($d).'</a>';
                            }
                            else
                            {
                              $d = end($d);
                            }                              
                            
                            break;
                          }                         
                        } 
                        ?>                        
                        <td><?=$d?></td>                                                           
                        <?php
                      } 
                      ?>
                      <td><?=!empty($arr1[2])?$arr1[2]:'NA'?></td>
                      <td><?=!empty($arr1[3])? "<a class='btn btn-danger' href='".base_url("enquiry/deleteDocument/$arr1[3]/$details->Enquery_id/".base64_encode($tabname)."")."' onclick='return alert(\'are you sure\')'><i class='fa fa-trash'></i></a> " :'NA'?></td>                                                  
                      <?php
                    } ?>                    
                    </tr>
                    <?php
                  }
                }
                else { ?>
                  <tr><td colspan="<?=($counter+2);?>" class="text-center">No Records Found</td></tr>
                <?php } 
              
              ?>              
            </tbody>
          </table>
          </div>
          <?php
        }?>
         <?php echo form_open_multipart('client/update_enquiry_tab/'.$details->enquiry_id,'class="form-inner"') ?>           
         <input name="en_comments" type="hidden" value="<?=$details->Enquery_id?>" >    
         <input name="tid" type="hidden" value="<?=$tid?>" >    
         <input name="form_type" type="hidden" value="<?=$form_type?>" >    
         <div class="row">
         <?php
         if(!empty($dynamic_field)) {       
          foreach($dynamic_field as $ind => $fld){
            $fld_id = $fld['input_id'];
            ?>  
            <?php if($fld['input_type']==19){?>        
            <div class="col-md-12">
            <label style="color:#283593;"><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?><i class="text-danger"></i></label>
             <hr>
            </div>
            <?php }?>
            <?php if($fld['input_type']!=19){ ?>
            <div class="form-group col-md-6 <?=$fld['input_name']?> col-md-6" >     
               <?php if($fld['input_type']==1){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="text" name="enqueryfield[<?=$fld_id?>]" class="form-control">
               <?php }if($fld['input_type']==2){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <?php $optarr = (!empty($fld['input_values'])) ? explode(",",$fld['input_values']) : array(); 
               ?>
               <select class="form-control"  name="enqueryfield[<?=$fld_id?>]" >
                  <option>Select</option>
                  <?php  foreach($optarr as $key => $val){
                  ?>
                  <option value = "<?php echo $val; ?>"><?php echo $val; ?></option>
                  <?php
                     } 
                  ?>
               </select>
               <?php }if($fld['input_type']==3){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="hidden"  name="enqueryfield[<?=$fld_id?>]" class="form-control">                         
               <?php 
               $optarr = (!empty($fld['input_values'])) ? explode(",",$fld['input_values']) : array(); 
                  foreach($optarr as $key => $val){
                  ?><label><?=$val?></label>
                  <input type="radio"  id="<?=$fld['input_name']?>" name="enqueryfield[<?=$fld_id?>]" value="<?=$val;?>" class="form-control">
                <?php
                }                               
               }if($fld['input_type']==4){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="hidden"  name="enqueryfield[<?=$fld_id?>]" class="form-control">                         
               <input type="checkbox"  name="enqueryfield[<?=$fld_id?>]"  id="<?= $fld['input_name']?>" class="form-control">                         
               <?php }if($fld['input_type']==5){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <textarea   name="enqueryfield[<?=$fld_id?>]" <?= $fld['fld_attributes']; ?>  class="form-control" placeholder="<?= $fld['input_place']; ?>" ></textarea>
               <?php }?>
               <?php if($fld['input_type']==6){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="date"  name="enqueryfield[<?=$fld_id?>]" class="form-control">
               <?php }?>
               <?php if($fld['input_type']==7){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="time"  name="enqueryfield[<?=$fld_id?>]"  class="form-control">
               <?php }?>
               <?php if($fld['input_type']==8){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="hidden" readonly name="enqueryfield[<?=$fld_id?>]"  class="form-control"  value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">               
               <input type="file"  name="enqueryfiles[]"  class="form-control" >
               <?php 
               if (!empty($fld["fvalue"])) {
                  ?>
                  <!-- <a href="<?=$fld['fvalue']?>" target="_blank"><?=basename($fld['fvalue'])?></a> -->
                  <?php
               }
            }?>
               <?php if($fld['input_type']==9){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="password"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
                  <?php if($fld['input_type']==10){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="color"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
               <?php if($fld['input_type']==11){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="datetime-local"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
                 <?php if($fld['input_type']==12){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="email"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
                 <?php if($fld['input_type']==13){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="month"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
                 <?php if($fld['input_type']==14){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="number"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
                 <?php if($fld['input_type']==15){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="url"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
                 <?php if($fld['input_type']==16){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="week"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
                 <?php if($fld['input_type']==17){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="search"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>
               <?php if($fld['input_type']==18){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="tel"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" >
               <?php }?>                 
               <input type="hidden" name= "inputfieldno[]" value = "<?=$fld['input_id']; ?>">
               <input type="hidden" name= "inputtype[]" value = "<?=$fld['input_type']?>">
            </div>
<?php } ?>
      <?php  }
         } ?>
         </div>
         <div class="row"   id="save_button">
            <div class="col-md-12 text-center">                                                
               <button class="btn btn-primary" type="submit" >Save</button>            
            </div>
         </div>
   <?php
   echo form_close(); 


   }else{ ?>
         <hr>
         <?php echo form_open_multipart('client/update_enquiry_tab/'.$details->enquiry_id,'class="form-inner tabbed_form"') ?>           
         <input name="en_comments" type="hidden" value="<?=$details->Enquery_id?>" >    
         <div class="row">
         <?php
         if(!empty($dynamic_field)) {       
          foreach($dynamic_field as $ind => $fld){
            $fld_id = $fld['input_id'];
            ?>  
<?php if($fld['input_type']==19){?>        
<div class="col-md-12">
<label style="color:#283593;"><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?><i class="text-danger"></i></label>
 <hr>
</div>
<?php }?>
<?php if($fld['input_type']!=19){ ?>
            <div class="form-group col-md-6 <?=$fld['input_name']?> col-md-6" >     
               <?php if($fld['input_type']==1){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="text" name="enqueryfield[<?=$fld_id?>]"  value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>"  class="form-control">
               <?php }if($fld['input_type']==2){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <?php $optarr = (!empty($fld['input_values'])) ? explode(",",$fld['input_values']) : array(); 
               ?>
               <select class="form-control"  name="enqueryfield[<?=$fld_id?>]" >
                  <option>Select</option>
                  <?php  foreach($optarr as $key => $val){
                  ?>
                  <option value = "<?php echo $val; ?>" <?php echo (!empty($fld["fvalue"]) and trim($fld["fvalue"]) == trim($val)) ? "selected" : ""; ?>><?php echo $val; ?></option>
                  <?php
                     } 
                  ?>
               </select>
               <?php }if($fld['input_type']==3){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="hidden"  name="enqueryfield[<?=$fld_id?>]" class="form-control">                         
               <?php 
               $optarr = (!empty($fld['input_values'])) ? explode(",",$fld['input_values']) : array(); 
                  foreach($optarr as $key => $val){
                  ?><label><?=$val?></label>
                  <input type="radio"  id="<?=$fld['input_name']?>" name="enqueryfield[<?=$fld_id?>]" value="<?=$val;?>" class="form-control">
          <?php
                     }                               
               }if($fld['input_type']==4){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="hidden"  name="enqueryfield[<?=$fld_id?>]" class="form-control">                         
               <input type="checkbox"  name="enqueryfield[<?=$fld_id?>]"  id="<?= $fld['input_name']?>" class="form-control">                         
               <?php }if($fld['input_type']==5){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <textarea   name="enqueryfield[<?=$fld_id?>]"  <?= $fld['fld_attributes']; ?>  class="form-control" placeholder="<?= $fld['input_place']; ?>" ><?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?></textarea>
               <?php }?>
               <?php if($fld['input_type']==6){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="date"  name="enqueryfield[<?=$fld_id?>]" class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
               <?php if($fld['input_type']==7){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="time"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
               <?php if($fld['input_type']==8){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="hidden" readonly name="enqueryfield[<?=$fld_id?>]"  class="form-control"  value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">               
               <input type="file"  name="enqueryfiles[]"  class="form-control" >
               <?php 
               if (!empty($fld["fvalue"])) {
                  ?>
                  <a href="<?=$fld['fvalue']?>" target="_blank"><?=basename($fld['fvalue'])?></a>
                  <?php
               }
            }?>
               <?php if($fld['input_type']==9){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="password"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                  <?php if($fld['input_type']==10){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="color"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
               <?php if($fld['input_type']==11){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="datetime-local"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==12){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="email"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==13){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="month"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==14){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="number"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==15){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="url"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==16){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="week"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
                 <?php if($fld['input_type']==17){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="search"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>
               <?php if($fld['input_type']==18){?>
               <label><?php echo(!empty($fld["input_label"])) ?  ucwords($fld["input_label"]) : ""; ?></label>
               <input type="tel"  name="enqueryfield[<?=$fld_id?>]"  class="form-control" value ="<?php echo  (!empty($fld["fvalue"])) ? $fld["fvalue"] : ""; ?>">
               <?php }?>                 
               <input type="hidden" name= "inputfieldno[]" value = "<?=$fld['input_id']; ?>">
               <input type="hidden" name= "inputtype[]" value = "<?=$fld['input_type']?>">
            </div>
<?php } ?>
      <?php  }
         } ?>
         </div>
         <div class="row" id="save_button">
            <div class="col-md-12 text-center">                                                               
               <input type="submit" name="submit_only" class="btn btn-primary" value="Save" >
               <input type="submit" name="submit_and_next" class="btn btn-primary" value="Save And Next">
               <input type="hidden" name="go_new_tab">
            </div>
         </div>
   <?php
   echo form_close(); 
   }
?>
<script>
  $(document).ready(function(){
  var src_id = $('#lead_source').val();
  var sub_src_id = '<?= $details->sub_source; ?>'  
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>lead/get_subsource_by_source',
        data: {src_id:src_id,sub_src_id:sub_src_id},
        success:function(data){        
          $("#subsource").html(data);
        }    
    });
  });
  function find_sub1(){    
    var src_id = $('#lead_source').val();    
        $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>lead/get_subsource_by_source',
        data: {src_id:src_id},
        success:function(data){        
          $("#subsource").html(data);
        }    
    });
  }
</script>

<script>
$(document).ready(function(){ 
  $('#preferred_country').select2({
     placeholder: "Select Country"
  }); 

  
  $('#prefixcode111').select2({}); 
 });

</script>

<script>
  function find_visa(f=0) { 
           if(f==0){
            var f_country = $("#final_contry").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_visa_by_finalcntry',
            data: {finalcntry:f_country},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select---</option>';
                for(var i=0; i <(obj.length); i++){                   
                    html +='<option value="'+(obj[i].vid)+'">'+(obj[i].vnm)+'</option>';
                }                
                $("#visa_type").html(html); 
                find_visa_class();             
            } 
            });
           }
            }

  function find_visa_class(f=0) { 
           if(f==0){
            var f_country = $("#final_contry").val();
            var visa_id = $("#visa_type").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_class_by_cntryandvisa',
            data: {finalcntry:f_country,visa_id:visa_id},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select---</option>';
                for(var i=0; i <(obj.length); i++){                   
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].sub_class)+'</option>';
                }                
                $("#sub_class").html(html);               
            } 
            });
           }
            }

  $(function() {
    $('.multiple-select').select2();
  });
  function changeSelect(e){        
    var input_name = e.id;
    var data = $("#"+input_name).val();    
    $("#multi-"+input_name).val(data);
  }
  function share_form(f_url,email){    
    if (confirm('Are you sure ?')) {
      $.ajax({
        url: "<?=base_url().'message/send_sms'?>",
        type:"POST",
        data:{
          mesge_type:3,
          message_name:f_url,
          email_subject:'Survey Form',
          mail:email
        },
        success: function(data){
          alert(data);
        }
      });
    }
  }

function exist_alert(type,parameter){ 
var process_id =  $("#product_id_alert").val();
var enquiry_id = "<?=$enquiry->Enquery_id?>";     
     $.ajax({
          url: "<?php echo base_url().'enquiry/get_exist_alert'?>",
          type: 'POST',
      data: {type:type,parameter:parameter,process_id:process_id,enq_no:enquiry_id},
          
          success: function(data) {
            var obj = JSON.parse(data);
if(obj.table_content != ''){       
Swal.fire({
  icon: 'error',
  title: 'Already exist details....',
  html: obj.table_content,
})

//auto fill old value
if(parameter=='mobile'){
    $("#mobileno").val(obj.old_phone);
  }
if(parameter=='email'){
    $("#email").val(obj.old_email);
}

}
          }
      });
    
}

$(window).load(function() {
document.getElementById("mobileno").disabled = true;
document.getElementById("email").disabled = true;
document.getElementById("expected_date").disabled = true;
document.getElementById("Lead_Scores").disabled = true;
});

function disableField() {
document.getElementById("mobileno").disabled = false;
document.getElementById("email").disabled = false;
document.getElementById("expected_date").disabled = false;
document.getElementById("Lead_Scores").disabled = false;
}  
</script>