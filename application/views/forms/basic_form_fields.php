<style>
  .swal2-popup {
        width: 53em !important;
        }
</style>
<?php
  define('FIRST_NAME',1);
  define('LAST_NAME',2);
  define('GENDER',3); 
  define('MOBILE',4);
  define('EMAIL',5);
  //define('COMPANY',6);
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
 

                    if(!empty($company_list)){
                      foreach($company_list as $companylist){
                      if($companylist['field_id']==FIRST_NAME){?>
                    
                     <div class="form-group col-sm-4 col-md-4">
                        <label> <?php echo display("first_name"); ?> <i class="text-danger">*</i> </label>
                        <div class = "input-group" >
                           <span class="input-group-addon" style="padding:0px!important;border:0px!important;width:30%;">
                              <select class="form-control" name="name_prefix">
                                 <?php foreach($name_prefix as $n_prefix){?>
                                 <option value="<?= $n_prefix->prefix ?>"><?= $n_prefix->prefix ?></option>
                                 <?php } ?>
                              </select>
                           </span>
                           <input class="form-control" name="enquirername" type="text" value="<?php  echo set_value('enquirername');?>" placeholder="Enter First Name" required style="width:100%;"/>
                        </div>
                     </div>
                     <?php
                   }
                   ?>
                    <?php
                    if($companylist['field_id']==LAST_NAME){
                    ?>
                     <div class="form-group col-sm-4 col-md-4"> 
                        <label><?php echo display("last_name"); ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('lastname');?>" name="lastname" type="text" placeholder="Last Name">  
                     </div>
                     <?php
                   }
                   ?>
                   <?php
                    if($companylist['field_id']==GENDER){
                    ?>
                     <div class="form-group col-sm-4 col-md-4"> 
                        <label><?php echo display("gender"); ?><i class="text-danger"></i></label>
                         <select name="gender" class="form-control">
                           <option value="">---Select---</option>
                           <option value="1"><?php echo display("male"); ?></option>
                           <option value="2"><?php echo display("female"); ?></option>
                           <option value="3"><?php echo display("other"); ?></option>
                         </select>                           
                     </div>
                   
                  <?php
                   } 
                   ?>
                   <?php
                    if($companylist['field_id']==MOBILE){
                    ?>
                    
                     <div class="form-group col-sm-4 col-md-4"> 
                       
                        <label><?php echo display('mobile') ?> <i class="text-danger">*</i></label>
                        <div class="input-group">
                           <span class="input-group-addon" style="padding:0px!important;border:0px!important;width:30%;">
                              <select class="form-control" name="code_prefix" id="prefixcode111">
                                <option value="93"  data-country = 'Afghanistan'> +93</option>
                                <option value="355"  data-country = 'Albania'> +355</option>
                                <option value="213"  data-country = 'Algeria'> +213</option>
                                <option value="1684"  data-country = 'American Samoa'> +1684</option>
                                <option value="376"  data-country = 'Andorra'> +376</option>
                                <option value="244"  data-country = 'Angola'> +244</option>
                                <option value="1264"  data-country = 'Anguilla'> +1264</option>
                                <option value="0"  data-country = 'Antarctica'> +0</option>
                                <option value="1268"  data-country = 'Antigua and Barbuda'> +1268</option>
                                <option value="54"  data-country = 'Argentina'> +54</option>
                                <option value="374"  data-country = 'Armenia'> +374</option>
                                <option value="297"  data-country = 'Aruba'> +297</option>
                                <option value="61"  data-country = 'Australia'> +61</option>
                                <option value="43"  data-country = 'Austria'> +43</option>
                                <option value="994"  data-country = 'Azerbaijan'> +994</option>
                                <option value="1242"  data-country = 'Bahamas'> +1242</option>
                                <option value="973"  data-country = 'Bahrain'> +973</option>
                                <option value="880"  data-country = 'Bangladesh'> +880</option>
                                <option value="1246"  data-country = 'Barbados'> +1246</option>
                                <option value="375"  data-country = 'Belarus'> +375</option>
                                <option value="32"  data-country = 'Belgium'> +32</option>
                                <option value="501"  data-country = 'Belize'> +501</option>
                                <option value="229"  data-country = 'Benin'> +229</option>
                                <option value="1441"  data-country = 'Bermuda'> +1441</option>
                                <option value="975"  data-country = 'Bhutan'> +975</option>
                                <option value="591"  data-country = 'Bolivia'> +591</option>
                                <option value="387"  data-country = 'Bosnia and Herzegovina'> +387</option>
                                <option value="267"  data-country = 'Botswana'> +267</option>
                                <option value="0"  data-country = 'Bouvet Island'> +0</option>
                                <option value="55"  data-country = 'Brazil'> +55</option>
                                <option value="246"  data-country = 'British Indian Ocean Territory'> +246</option>
                                <option value="673"  data-country = 'Brunei Darussalam'> +673</option>
                                <option value="359"  data-country = 'Bulgaria'> +359</option>
                                <option value="226"  data-country = 'Burkina Faso'> +226</option>
                                <option value="257"  data-country = 'Burundi'> +257</option>
                                <option value="855"  data-country = 'Cambodia'> +855</option>
                                <option value="237"  data-country = 'Cameroon'> +237</option>
                                <option value="1"  data-country = 'Canada'> +1</option>
                                <option value="238"  data-country = 'Cape Verde'> +238</option>
                                <option value="1345"  data-country = 'Cayman Islands'> +1345</option>
                                <option value="236"  data-country = 'Central African Republic'> +236</option>
                                <option value="235"  data-country = 'Chad'> +235</option>
                                <option value="56"  data-country = 'Chile'> +56</option>
                                <option value="86"  data-country = 'China'> +86</option>
                                <option value="61"  data-country = 'Christmas Island'> +61</option>
                                <option value="672"  data-country = 'Cocos (Keeling) Islands'> +672</option>
                                <option value="57"  data-country = 'Colombia'> +57</option>
                                <option value="269"  data-country = 'Comoros'> +269</option>
                                <option value="242"  data-country = 'Congo'> +242</option>
                                <option value="242"  data-country = 'Congo, the Democratic Republic of the'> +242</option>
                                <option value="682"  data-country = 'Cook Islands'> +682</option>
                                <option value="506"  data-country = 'Costa Rica'> +506</option>
                                <option value="225"  data-country = 'Cote D'Ivoire'> +225</option>
                                <option value="385"  data-country = 'Croatia'> +385</option>
                                <option value="53"  data-country = 'Cuba'> +53</option>
                                <option value="357"  data-country = 'Cyprus'> +357</option>
                                <option value="420"  data-country = 'Czech Republic'> +420</option>
                                <option value="45"  data-country = 'Denmark'> +45</option>
                                <option value="253"  data-country = 'Djibouti'> +253</option>
                                <option value="1767"  data-country = 'Dominica'> +1767</option>
                                <option value="1809"  data-country = 'Dominican Republic'> +1809</option>
                                <option value="593"  data-country = 'Ecuador'> +593</option>
                                <option value="20"  data-country = 'Egypt'> +20</option>
                                <option value="503"  data-country = 'El Salvador'> +503</option>
                                <option value="240"  data-country = 'Equatorial Guinea'> +240</option>
                                <option value="291"  data-country = 'Eritrea'> +291</option>
                                <option value="372"  data-country = 'Estonia'> +372</option>
                                <option value="251"  data-country = 'Ethiopia'> +251</option>
                                <option value="500"  data-country = 'Falkland Islands (Malvinas)'> +500</option>
                                <option value="298"  data-country = 'Faroe Islands'> +298</option>
                                <option value="679"  data-country = 'Fiji'> +679</option>
                                <option value="358"  data-country = 'Finland'> +358</option>
                                <option value="33"  data-country = 'France'> +33</option>
                                <option value="594"  data-country = 'French Guiana'> +594</option>
                                <option value="689"  data-country = 'French Polynesia'> +689</option>
                                <option value="0"  data-country = 'French Southern Territories'> +0</option>
                                <option value="241"  data-country = 'Gabon'> +241</option>
                                <option value="220"  data-country = 'Gambia'> +220</option>
                                <option value="995"  data-country = 'Georgia'> +995</option>
                                <option value="49"  data-country = 'Germany'> +49</option>
                                <option value="233"  data-country = 'Ghana'> +233</option>
                                <option value="350"  data-country = 'Gibraltar'> +350</option>
                                    <option value="30"  data-country = 'Greece'> +30</option>
                                    <option value="299"  data-country = 'Greenland'> +299</option>
                                    <option value="1473"  data-country = 'Grenada'> +1473</option>
                                    <option value="590"  data-country = 'Guadeloupe'> +590</option>
                                    <option value="1671"  data-country = 'Guam'> +1671</option>
                                    <option value="502"  data-country = 'Guatemala'> +502</option>
                                    <option value="224"  data-country = 'Guinea'> +224</option>
                                    <option value="245"  data-country = 'Guinea-Bissau'> +245</option>
                                    <option value="592"  data-country = 'Guyana'> +592</option>
                                    <option value="509"  data-country = 'Haiti'> +509</option>
                                    <option value="0"  data-country = 'Heard Island and Mcdonald Islands'> +0</option>
                                    <option value="39"  data-country = 'Holy See (Vatican City State)'> +39</option>
                                    <option value="504"  data-country = 'Honduras'> +504</option>
                                    <option value="852"  data-country = 'Hong Kong'> +852</option>
                                    <option value="36"  data-country = 'Hungary'> +36</option>
                                    <option value="354"  data-country = 'Iceland'> +354</option>
                                    <option value="91" data-country = 'India' selected> +91</option>
                                    <option value="62"  data-country = 'Indonesia'> +62</option>
                                    <option value="98"  data-country = 'Iran, Islamic Republic of'> +98</option>
                                    <option value="964"  data-country = 'Iraq'> +964</option>
                                    <option value="353"  data-country = 'Ireland'> +353</option>
                                    <option value="972"  data-country = 'Israel'> +972</option>
                                    <option value="39"  data-country = 'Italy'> +39</option>
                                    <option value="1876"  data-country = 'Jamaica'> +1876</option>
                                    <option value="81"  data-country = 'Japan'> +81</option>
                                    <option value="962"  data-country = 'Jordan'> +962</option>
                                    <option value="7"  data-country = 'Kazakhstan'> +7</option>
                                    <option value="254"  data-country = 'Kenya'> +254</option>
                                    <option value="686"  data-country = 'Kiribati'> +686</option>
                                    <option value="850"  data-country = 'Korea, Democratic People's Republic of'> +850</option>
                                    <option value="82"  data-country = 'Korea, Republic of'> +82</option>
                                    <option value="965"  data-country = 'Kuwait'> +965</option>
                                    <option value="996"  data-country = 'Kyrgyzstan'> +996</option>
                                    <option value="856"  data-country = 'Lao People's Democratic Republic'> +856</option>
                                    <option value="371"  data-country = 'Latvia'> +371</option>
                                    <option value="961"  data-country = 'Lebanon'> +961</option>
                                    <option value="266"  data-country = 'Lesotho'> +266</option>
                                    <option value="231"  data-country = 'Liberia'> +231</option>
                                    <option value="218"  data-country = 'Libyan Arab Jamahiriya'> +218</option>
                                    <option value="423"  data-country = 'Liechtenstein'> +423</option>
                                    <option value="370"  data-country = 'Lithuania'> +370</option>
                                    <option value="352"  data-country = 'Luxembourg'> +352</option>
                                    <option value="853"  data-country = 'Macao'> +853</option>
                                    <option value="389"  data-country = 'Macedonia, the Former Yugoslav Republic of'> +389</option>
                                    <option value="261"  data-country = 'Madagascar'> +261</option>
                                    <option value="265"  data-country = 'Malawi'> +265</option>
                                    <option value="60"  data-country = 'Malaysia'> +60</option>
                                    <option value="960"  data-country = 'Maldives'> +960</option>
                                    <option value="223"  data-country = 'Mali'> +223</option>
                                    <option value="356"  data-country = 'Malta'> +356</option>
                                    <option value="692"  data-country = 'Marshall Islands'> +692</option>
                                    <option value="596"  data-country = 'Martinique'> +596</option>
                                    <option value="222"  data-country = 'Mauritania'> +222</option>
                                    <option value="230"  data-country = 'Mauritius'> +230</option>
                                    <option value="269"  data-country = 'Mayotte'> +269</option>
                                    <option value="52"  data-country = 'Mexico'> +52</option>
                                    <option value="691"  data-country = 'Micronesia, Federated States of'> +691</option>
                                    <option value="373"  data-country = 'Moldova, Republic of'> +373</option>
                                    <option value="377"  data-country = 'Monaco'> +377</option>
                                    <option value="976"  data-country = 'Mongolia'> +976</option>
                                    <option value="1664"  data-country = 'Montserrat'> +1664</option>
                                    <option value="212"  data-country = 'Morocco'> +212</option>
                                    <option value="258"  data-country = 'Mozambique'> +258</option>
                                    <option value="95"  data-country = 'Myanmar'> +95</option>
                                    <option value="264"  data-country = 'Namibia'> +264</option>
                                    <option value="674"  data-country = 'Nauru'> +674</option>
                                    <option value="977"  data-country = 'Nepal'> +977</option>
                                    <option value="31"  data-country = 'Netherlands'> +31</option>
                                    <option value="599"  data-country = 'Netherlands Antilles'> +599</option>
                                    <option value="687"  data-country = 'New Caledonia'> +687</option>
                                    <option value="64"  data-country = 'New Zealand'> +64</option>
                                    <option value="505"  data-country = 'Nicaragua'> +505</option>
                                    <option value="227"  data-country = 'Niger'> +227</option>
                                    <option value="234"  data-country = 'Nigeria'> +234</option>
                                    <option value="683"  data-country = 'Niue'> +683</option>
                                    <option value="672"  data-country = 'Norfolk Island'> +672</option>
                                    <option value="1670"  data-country = 'Northern Mariana Islands'> +1670</option>
                                    <option value="47"  data-country = 'Norway'> +47</option>
                                    <option value="968"  data-country = 'Oman'> +968</option>
                                    <option value="92"  data-country = 'Pakistan'> +92</option>
                                    <option value="680"  data-country = 'Palau'> +680</option>
                                    <option value="970"  data-country = 'Palestinian Territory, Occupied'> +970</option>
                                    <option value="507"  data-country = 'Panama'> +507</option>
                                    <option value="675"  data-country = 'Papua New Guinea'> +675</option>
                                    <option value="595"  data-country = 'Paraguay'> +595</option>
                                    <option value="51"  data-country = 'Peru'> +51</option>
                                    <option value="63"  data-country = 'Philippines'> +63</option>
                                    <option value="0"  data-country = 'Pitcairn'> +0</option>
                                    <option value="48"  data-country = 'Poland'> +48</option>
                                    <option value="351"  data-country = 'Portugal'> +351</option>
                                    <option value="1787"  data-country = 'Puerto Rico'> +1787</option>
                                    <option value="974"  data-country = 'Qatar'> +974</option>
                                    <option value="262"  data-country = 'Reunion'> +262</option>
                                    <option value="40"  data-country = 'Romania'> +40</option>
                                    <option value="70"  data-country = 'Russian Federation'> +70</option>
                                    <option value="250"  data-country = 'Rwanda'> +250</option>
                                    <option value="290"  data-country = 'Saint Helena'> +290</option>
                                    <option value="1869"  data-country = 'Saint Kitts and Nevis'> +1869</option>
                                    <option value="1758"  data-country = 'Saint Lucia'> +1758</option>
                                    <option value="508"  data-country = 'Saint Pierre and Miquelon'> +508</option>
                                    <option value="1784"  data-country = 'Saint Vincent and the Grenadines'> +1784</option>
                                    <option value="684"  data-country = 'Samoa'> +684</option>
                                    <option value="378"  data-country = 'San Marino'> +378</option>
                                    <option value="239"  data-country = 'Sao Tome and Principe'> +239</option>
                                    <option   value="966"  data-country = 'Saudi Arabia'> +966</option>
                                    <option value="221"  data-country = 'Senegal'> +221</option>
                                    <option value="381"  data-country = 'Serbia and Montenegro'> +381</option>
                                    <option value="248"  data-country = 'Seychelles'> +248</option>
                                    <option value="232"  data-country = 'Sierra Leone'> +232</option>
                                    <option value="65"  data-country = 'Singapore'> +65</option>
                                    <option value="421"  data-country = 'Slovakia'> +421</option>
                                    <option value="386"  data-country = 'Slovenia'> +386</option>
                                    <option value="677"  data-country = 'Solomon Islands'> +677</option>
                                    <option value="252"  data-country = 'Somalia'> +252</option>
                                    <option value="27"  data-country = 'South Africa'> +27</option>
                                    <option value="0"  data-country = 'South Georgia and the South Sandwich Islands'> +0</option>
                                    <option value="34"  data-country = 'Spain'> +34</option>
                                    <option value="94"  data-country = 'Sri Lanka'> +94</option>
                                    <option value="249"  data-country = 'Sudan'> +249</option>
                                    <option value="597"  data-country = 'Suriname'> +597</option>
                                    <option value="47"  data-country = 'Svalbard and Jan Mayen'> +47</option>
                                    <option value="268"  data-country = 'Swaziland'> +268</option>
                                    <option value="46"  data-country = 'Sweden'> +46</option>
                                    <option value="41"  data-country = 'Switzerland'> +41</option>
                                    <option value="963"  data-country = 'Syrian Arab Republic'> +963</option>
                                    <option value="886"  data-country = 'Taiwan, Province of China'> +886</option>
                                    <option value="992"  data-country = 'Tajikistan'> +992</option>
                                    <option value="255"  data-country = 'Tanzania, United Republic of'> +255</option>
                                    <option value="66"  data-country = 'Thailand'> +66</option>
                                    <option value="670"  data-country = 'Timor-Leste'> +670</option>
                                    <option value="228"  data-country = 'Togo'> +228</option>
                                    <option value="690"  data-country = 'Tokelau'> +690</option>
                                    <option value="676"  data-country = 'Tonga'> +676</option>
                                    <option value="1868"  data-country = 'Trinidad and Tobago'> +1868</option>
                                    <option value="216"  data-country = 'Tunisia'> +216</option>
                                    <option value="90"  data-country = 'Turkey'> +90</option>
                                    <option value="7370"  data-country = 'Turkmenistan'> +7370</option>
                                    <option value="1649"  data-country = 'Turks and Caicos Islands'> +1649</option>
                                    <option value="688"  data-country = 'Tuvalu'> +688</option>
                                    <option value="256"  data-country = 'Uganda'> +256</option>
                                    <option value="380"  data-country = 'Ukraine'> +380</option>
                                    <option value="971"  data-country = 'United Arab Emirates'> +971</option>
                                    <option value="44"  data-country = 'United Kingdom'> +44</option>
                                    <option value="1"  data-country = 'United States'> +1</option>
                                    <option value="1"  data-country = 'United States Minor Outlying Islands'> +1</option>
                                    <option value="598"  data-country = 'Uruguay'> +598</option>
                                    <option value="998"  data-country = 'Uzbekistan'> +998</option>
                                    <option value="678"  data-country = 'Vanuatu'> +678</option>
                                    <option value="58"  data-country = 'Venezuela'> +58</option>
                                    <option value="84"  data-country = 'Viet Nam'> +84</option>
                                    <option value="1284"  data-country = 'Virgin Islands, British'> +1284</option>
                                    <option value="1340"  data-country = 'Virgin Islands, U.s.'> +1340</option>
                                    <option value="681"  data-country = 'Wallis and Futuna'> +681</option>
                                    <option value="212"  data-country = 'Western Sahara'> +212</option>
                                    <option value="967"  data-country = 'Yemen'> +967</option>
                                    <option value="260"  data-country = 'Zambia'> +260</option>
                                    <option value="263" data-country = 'Zimbabwe'> +263</option>
                                                               </select>
                           </span>

<?php if(!empty($mobi)){ ?>
        <input style="width:90%;margin-bottom: 0px;" class="form-control col-sm-6" value="<?php echo $mobi; ?>" name="mobileno" id="mobileno" onchange="exist_alert(this.value,'mobile')" type="text" placeholder="Enter Mobile Number" required="">
<?php }else{ ?>
                        <input style="width:90%;margin-bottom: 0px;" class="form-control col-sm-6 mobno" value="<?php if(!empty($_GET['phone'])){echo $_GET['phone']; }else{ echo set_value('mobileno')?set_value('mobileno'):$this->input->get('phone')?$this->input->get('phone'):'';}?>" name="mobileno" id="mobileno" onchange="exist_alert(this.value,'mobile')" type="text" maxlength='12' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter Mobile Number" required="">
<?php } ?>
                        <i class="fa fa-plus" onclick="add_more_phone('add_more_phone')" style="margin-top: 5px;font-size:20px;color:red;width:10%;padding: 2px;"></i>
                        </div>
                     </div>
                     <div id="add_more_phone">
                           <div class="form-group col-sm-4 col-md-4">
                             <label>Other No </label>
                             <input class="form-control"  name="other_no[]" type="text" placeholder="Other Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </div>                           
                       </div>
                     <?php
                   }
                   ?>
                     <?php
                    if($companylist['field_id']==EMAIL){
                    ?>
                     <div class="form-group col-sm-4 col-md-4"> 
                        <label><?php echo display('email') ?> <i class="text-danger">*</i> </label>
                        <input class="form-control" value="<?php  echo set_value('email');?> " name="email" id="email" onchange="exist_alert(this.value,'email')" type="email"  placeholder="Enter Email"  required>
                        <i class="fa fa-plus" onclick="add_more_email('add_more_email')" style="float:right;margin-top:-25px;margin-right:10px;color:red"></i> 
                     </div>
                     <div id="add_more_email">
                          <div class="form-group col-sm-4 col-md-4">
                             <label>Other Email </label>
                             <input class="form-control"  name="other_email[]" type="text" placeholder="Other Email">
                          </div>                          
                       </div>                     
                     <?php
                   }
                   ?>
                   <?php
                   // if($companylist['field_id']==COMPANY){
                    ?>
                     <!-- <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display('company_name') ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('company');?> " name="company" type="text"  placeholder="Enter Company"> 
                     </div> -->
                   
                     <?php
                  // }
                   ?>  
                    <?php
                    if($companylist['field_id']==LEAD_SOURCE){
                    ?>      
                              
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display('lead_source') ?> <i class="text-danger">*</i></label>
                        <select class="form-control" name="lead_source" id="lead_source" onchange="find_sub()">
                           <option value="" style="display:none;">---Select---</option>
                           <option value="new">New Agent</option>
                           <?php foreach ($leadsource as $post){ ?>
                           <option value="<?= $post->lsid?>" <?php if(!empty($mobi)){ if($post->lsid=='292'){ echo 'selected';}} ?>><?= $post->lead_name?></option>
                           <?php } ?>
                        </select>
                     </div>

                     <div class="form-group col-sm-4 col-md-4" id="newagent" style="display:none;">
                        <label><?php echo 'Agent Name' ?> <i class="text-danger"></i></label>
                        <input class="form-control" name="new_agent" type="text"  placeholder="Enter Agent Name"> 
                     </div>

                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display("subsource"); ?></label>
                        <select class="form-control" name="sub_source" id="sub_source">
                           <option value="" style="display:none;">---Select---</option>
                           <?php foreach ($subsource_list as $subsource){ ?>
                           <option value="<?= $subsource->subsource_id?>"><?= $subsource->subsource_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                    <?php
                   }
                   ?>  
                      
                    <?php
                    if($companylist['field_id']==PRODUCT_FIELD){
                    ?>                
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display("product"); ?></label>
                        <select class="form-control" name="req_program" id="req_program">
                           <option value="" style="display:none;">---Select---</option>
                           <?php foreach ($product_contry as $subsource){ ?>
                           <option value="<?= $subsource->id?>"><?= $subsource->country_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                      <?php
                   }                                       
                    if($companylist['field_id']==STATE_FIELD){
                    ?>                
                     <div class="form-group col-sm-4 col-md-4">
                        <label> <?php echo display("state"); ?> <i class="text-danger"></i></label>
                        <select name="state_id" class="" id="fstate">
                           <option value="" style="display:none;">---Select---</option>
                           <?php foreach($state_list as $state){?>
                           <option value="<?php echo $state->id ?>"><?php echo $state->state; ?></option>
                           <?php } ?>
                        </select>
                     </div>                   
                       <?php
                   }
                   ?>  
                    <?php
                    if($companylist['field_id']==CITY_FIELD){
                    ?>             
                                             
                      <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display("city"); ?> <i class="text-danger"></i></label>
                        <select name="city_id" class="" id="fcity">
                           <option value="" style="display:none;">---Select---</option>
                            <?php foreach ($city_list as $city){ ?>
                           <option value="<?= $city->id?>"><?= $city->city?></option>
                        <?php } ?>
                        </select>
                     </div>
                       <?php
                   }
                  if($companylist['field_id']==PIN_CODE){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display('pin_code') ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('pin_code');?> " name="pin_code" type="text"  placeholder="Pin Code"> 
                     </div>
                   
                     <?php
                   }

                  if($companylist['field_id']==BRANCH_NAME){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Branch Name' ?> <i class="text-danger">*</i></label>
                        <select class="form-control" name="branch_name" id="branch_name" required>
                           <option value="" style="">---Select---</option>
                          <?php foreach ($all_branch as $key => $branch) { ?>
                              <option value="<?php echo $branch->id; ?>"><?php echo $branch->b_name; ?></option>
                          <?php } ?>
                        </select> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==IN_TAKE){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'In Take' ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="in_take" class="" id="intake">
                           <option value="" style="display:none;">---Select---</option>
                           <option value="January"> January</option>
                           <option value="February"> February</option>
                           <option value="March"> March</option>
                           <option value="April"> April</option>
                           <option value="May"> May</option>
                           <option value="June"> June</option>
                           <option value="July"> July</option>
                           <option value="August"> August</option>
                           <option value="September"> September</option>
                           <option value="October"> October</option>
                           <option value="November"> November</option>
                           <option value="December"> December</option>
                        </select> 
                     </div>

                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Qualification' ?> <i class="text-danger"></i></label>
                        <input class="form-control" name="qualification" type="text"  placeholder="Enter Qualification"> 
                     </div>

                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Experience' ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="experience" class="" id="">
                           <option value="" style="">---Select Experience---</option>
                           <option value="Yes"> Yes</option>
                           <option value="No"> No</option>
                        </select> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==VISA_TYPE){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Visa Type' ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="visa_type" class="" id="visa_type">
                           <option value="">---Select---</option>
                           <?php foreach($visa_type as $visa){ ?>
                           <option value="<?php echo $visa->id; ?>"><?php echo $visa->visa_type; ?></option>
                           <?php } ?>
                        </select> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==RESIDING_COUNTRY){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Residing Country' ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="residing_country" class="" id="residing_country">
                           <option value="">---Select---</option>
                           <?php foreach($country_list as $country){ ?>
                           <option value="<?= $country->id_c?>"> <?= $country->country_name?></option>
                         <?php } ?>
                        </select> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==NATIONALITY){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Nationality' ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="nationality" class="" id="nationality">
                           <option value="">---Select---</option>
                           <?php foreach($country_list as $country){ ?>
                           <option value="<?= $country->id_c?>"> <?= $country->country_name?></option>
                         <?php } ?>
                        </select> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==PREFERRED_COUNTRY_FIELD){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Preferred Country' ?> <i class="text-danger"></i></label>
                        <select class="form-control" multiple autocomplete="false" name="preferred_country[]" class="" id="preferred_country">
                           <option value="">---Select---</option>
                           <?php foreach($country_list as $country){ ?>
                           <option value="<?= $country->id_c?>"> <?= $country->country_name?></option>
                         <?php } ?>
                        </select> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==AGE){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Age' ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('age');?> " name="age" type="number"  placeholder="Enter Age"> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==MARITAL_STATUS){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Marital Status' ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="marital_status" class="" id="marital_status">
                           <option value="">---Select---</option>
                           <option value="single"> Single</option>
                           <option value="married"> Married</option>
                           <option value="widowed"> Widowed</option>
                           <option value="divorced"> Divorced</option>
                           <option value="separated"> Separated</option>
                        </select> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==APPLY_PERSON){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Number Of Persons To Apply' ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('apply_person');?> " name="apply_person" type="number"  placeholder="Apply Person"> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==COUNTRY_STAYED){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Countries Stayed For More Than 6 Months' ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('country_stayed');?> " name="country_stayed" type="number"  placeholder="No. of Countries"> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==POLICE_CASE){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Any Police Case(in Any Country Including India)' ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="police_case" class="" id="police_case">
                           <option value="">---Select---</option>
                           <option value="1"> Yes</option>
                           <option value="0"> No</option>
                        </select> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==BAN_COUNTRY){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo 'Any Visa Rejection/Ban From Any Country' ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="ban_country" class="" id="ban_country">
                           <option value="">---Select---</option>
                           <option value="1"> Yes</option>
                           <option value="0"> No</option>
                        </select> 
                     </div>
                   
                     <?php
                   }

                   if($companylist['field_id']==ADDRESS_FIELD){
                    ?>                                     
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display('address') ?> <i class="text-danger"></i></label>
                        <textarea class="form-control" name="address" placeholder="Enter Address"><?php  echo set_value('address');?></textarea> 
                     </div>
                   
                     <?php 
                   }
                   
                   if($companylist['field_id']==REMARK_FIELD){
                    ?>                                     
                     <div class="form-group col-sm-4 col-md-4"> 
                        <label><?=display('remark')?></label>
                        <textarea class="form-control" name="enquiry"></textarea>
                     </div>
                     <?php 
                   }
                  }}
                   ?> 


<script>
$(document).ready(function(){ 
  $('#preferred_country').select2({
     placeholder: "Select Country"
  }); 
 });
</script>
<script>
$(document).ready(function(){ 
  $('#prefixcode111').select2({}); 
 });
</script>

<script>
  
  function find_sub(){
    // alert('dadad');

  var src_id = $('#lead_source').val();

  if(src_id == "new"){
      document.getElementById("newagent").style.display="block";
  }else{
    document.getElementById("newagent").style.display="none";
  }

    // alert(src_id);


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
<script type="text/javascript">
  function exist_alert(type,parameter){
  var process_id =  $("#product_id_alert").val();        
     $.ajax({
          url: "<?php echo base_url().'enquiry/get_exist_alert'?>",
          type: 'POST',
      data: {type:type,parameter:parameter,process_id:process_id},
          
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
</script>