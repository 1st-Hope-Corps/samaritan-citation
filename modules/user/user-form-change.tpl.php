<?php
if ($_GET['option'] == 'submit') {
echo 'submitted';
}
?> 
<!--<form action="/admin/user/user/create"  accept-charset="UTF-8" method="post" id="user-register">-->
<!--<form action="/admin/user/user/create?option=submit"  accept-charset="UTF-8" method="post" id="user-register">-->
<form action="/admin/user/user/create"  accept-charset="UTF-8" method="post" id="user-register">
<div><fieldset><legend>Create User Option</legend><div class="form-radios"><div class="form-item" id="edit-user-option--wrapper">
 <label class="option" for="edit-user-option-"><input type="radio" id="edit-user-option-" name="user_option" value=""  checked="checked"  class="form-radio" /> Create a new User</label>
</div>
<div class="form-item" id="edit-user-option-child-wrapper">
 <label class="option" for="edit-user-option-child"><input type="radio" id="edit-user-option-child" name="user_option" value="child"   class="form-radio" /> Create a new Student</label>
</div>
<div class="form-item" id="edit-user-option-volunteer-wrapper">
 <label class="option" for="edit-user-option-volunteer"><input type="radio" id="edit-user-option-volunteer" name="user_option" value="volunteer"   class="form-radio" /> Create a new Volunteer</label>

</div>
</div></fieldset>
<fieldset><legend>Account information</legend><div class="form-item" id="edit-name-wrapper">
 <label for="edit-name">Username: <span class="form-required" title="This field is required.">*</span></label>
 <input type="text" maxlength="60" name="name" id="edit-name" size="60" value="" class="form-text required" />
 <div class="description">Spaces are allowed; punctuation is not allowed except for periods, hyphens, and underscores.</div>
</div>
<div class="form-item" id="edit-mail-wrapper">
 <label for="edit-mail">E-mail address: <span class="form-required" title="This field is required.">*</span></label>

 <input type="text" maxlength="64" name="mail" id="edit-mail" size="60" value="" class="form-text required" />
 <div class="description">A valid e-mail address. All e-mails from the system will be sent to this address. The e-mail address is not made public and will only be used if you wish to receive a new password or wish to receive certain news or notifications by e-mail.</div>
</div>
<div class="form-item" id="edit-pass-wrapper">
 <div class="form-item" id="edit-pass-pass1-wrapper">
 <label for="edit-pass-pass1">Password: <span class="form-required" title="This field is required.">*</span></label>
 <input type="password" name="pass[pass1]" id="edit-pass-pass1"  maxlength="128"  size="25"  class="form-text required password-field" />
</div>
<div class="form-item" id="edit-pass-pass2-wrapper">

 <label for="edit-pass-pass2">Confirm password: <span class="form-required" title="This field is required.">*</span></label>
 <input type="password" name="pass[pass2]" id="edit-pass-pass2"  maxlength="128"  size="25"  class="form-text required password-confirm" />
</div>

 <div class="description">Provide a password for the new account in both fields.</div>
</div>
<div class="form-item">
 <label>Status: </label>
 <div class="form-radios"><div class="form-item" id="edit-status-0-wrapper">

 <label class="option" for="edit-status-0"><input type="radio" id="edit-status-0" name="status" value="0"   class="form-radio" /> Blocked</label>
</div>
<div class="form-item" id="edit-status-1-wrapper">
 <label class="option" for="edit-status-1"><input type="radio" id="edit-status-1" name="status" value="1"  checked="checked"  class="form-radio" /> Active</label>
</div>
</div>
</div>
<div class="form-item">
 <label>Roles: </label>

 <div class="form-checkboxes"><div class="form-item" id="edit-roles-2-wrapper">
 <label class="option" for="edit-roles-2"><input type="checkbox" name="roles[2]" id="edit-roles-2" value="1"  checked="checked"  disabled="disabled" class="form-checkbox" /> Member</label>
</div>
<div class="form-item" id="edit-roles-10-wrapper">
 <label class="option" for="edit-roles-10"><input type="checkbox" name="roles[10]" id="edit-roles-10" value="10"   class="form-checkbox" /> Guest</label>
</div>
<div class="form-item" id="edit-roles-9-wrapper">
 <label class="option" for="edit-roles-9"><input type="checkbox" name="roles[9]" id="edit-roles-9" value="9"   class="form-checkbox" /> Hopeful</label>

</div>
<div class="form-item" id="edit-roles-11-wrapper">
 <label class="option" for="edit-roles-11"><input type="checkbox" name="roles[11]" id="edit-roles-11" value="11"   class="form-checkbox" /> Moderator</label>
</div>
<div class="form-item" id="edit-roles-7-wrapper">
 <label class="option" for="edit-roles-7"><input type="checkbox" name="roles[7]" id="edit-roles-7" value="7"   class="form-checkbox" /> Sponsor</label>
</div>
<div class="form-item" id="edit-roles-5-wrapper">
 <label class="option" for="edit-roles-5"><input type="checkbox" name="roles[5]" id="edit-roles-5" value="5"   class="form-checkbox" /> Staff</label>

</div>
<div class="form-item" id="edit-roles-15-wrapper">
 <label class="option" for="edit-roles-15"><input type="checkbox" name="roles[15]" id="edit-roles-15" value="15"   class="form-checkbox" /> Volunteer - Admin</label>
</div>
<div class="form-item" id="edit-roles-14-wrapper">
 <label class="option" for="edit-roles-14"><input type="checkbox" name="roles[14]" id="edit-roles-14" value="14"   class="form-checkbox" /> Volunteer - Editor</label>
</div>
<div class="form-item" id="edit-roles-13-wrapper">
 <label class="option" for="edit-roles-13"><input type="checkbox" name="roles[13]" id="edit-roles-13" value="13"   class="form-checkbox" /> Volunteer - Guide</label>

</div>
<div class="form-item" id="edit-roles-4-wrapper">
 <label class="option" for="edit-roles-4"><input type="checkbox" name="roles[4]" id="edit-roles-4" value="4"   class="form-checkbox" /> Volunteer - Instant Tutor</label>
</div>
<div class="form-item" id="edit-roles-6-wrapper">
 <label class="option" for="edit-roles-6"><input type="checkbox" name="roles[6]" id="edit-roles-6" value="6"   class="form-checkbox" /> Volunteer - Mentor</label>
</div>
<div class="form-item" id="edit-roles-12-wrapper">
 <label class="option" for="edit-roles-12"><input type="checkbox" name="roles[12]" id="edit-roles-12" value="12"   class="form-checkbox" /> Volunteer - Monitor</label>

</div>
<div class="form-item" id="edit-roles-16-wrapper">
 <label class="option" for="edit-roles-16"><input type="checkbox" name="roles[16]" id="edit-roles-16" value="16"   class="form-checkbox" /> Volunteer - Private Tutor</label>
</div>
</div>
</div>
<div class="form-item" id="edit-notify-wrapper">
 <label class="option" for="edit-notify"><input type="checkbox" name="notify" id="edit-notify" value="1"   class="form-checkbox" /> Notify user of new account</label>
</div>
</fieldset>
<input type="hidden" name="destination" id="edit-destination" value="admin/user/user/create"  />

<input type="hidden" name="timezone" id="edit-user-register-timezone" value="28800"  />
<!--<input type="hidden" name="form_build_id" id="form-6e94d6da79e4d3fa2feb50523928805c" value="form-6e94d6da79e4d3fa2feb50523928805c"  />
<input type="hidden" name="form_token" id="edit-user-register-form-token" value="352aa741c6176010f010610e43adfeb0"  />
<input type="hidden" name="form_id" id="edit-user-register" value="user_register"  />-->
<input type="hidden" name="form_build_id" id="form-<?=drupal_get_token('user-register')?>" value="form-<?=drupal_get_token('user-register')?>"  />
<input type="hidden" name="form_token" id="edit-user-register-form-token" value="<?=drupal_get_token('user-register')?>"  />
<input type="hidden" name="form_id" id="edit-user-register" value="user-register"  />

<script type="text/javascript" src="http://drupal.hopecybrary.org/sites/all/modules/civicrm/js/Common.js"></script><fieldset><legend>I. Personal Info</legend><div class="form-item" id="edit-profile-last-name-wrapper">

 <label for="edit-profile-last-name">Last Name: <span class="form-required" title="This field is required.">*</span></label>
 <input type="text" maxlength="255" name="profile_last_name" id="edit-profile-last-name" size="60" value="" class="form-text required" />
 <div class="description"> The content of this field is kept private and will not be shown publicly.</div>
</div>
<div class="form-item" id="edit-profile-first-name-wrapper">
 <label for="edit-profile-first-name">First Name: <span class="form-required" title="This field is required.">*</span></label>
 <input type="text" maxlength="255" name="profile_first_name" id="edit-profile-first-name" size="60" value="" class="form-text required" />

</div>
<div class="form-item" id="edit-profile-address-wrapper">
 <label for="edit-profile-address">Home Address: <span class="form-required" title="This field is required.">*</span></label>
 <textarea cols="60" rows="5" name="profile_address" id="edit-profile-address"  class="form-textarea resizable required"></textarea>
 <div class="description"> The content of this field is kept private and will not be shown publicly.</div>
</div>
<div class="form-item" id="edit-profile-city-wrapper">
 <label for="edit-profile-city">City: <span class="form-required" title="This field is required.">*</span></label>

 <input type="text" maxlength="255" name="profile_city" id="edit-profile-city" size="60" value="" class="form-text required" />
 <div class="description"> The content of this field is kept private and will not be shown publicly.</div>
</div>
<div class="form-item" id="edit-profile-state-wrapper">
 <label for="edit-profile-state">State/Province: <span class="form-required" title="This field is required.">*</span></label>
 <input type="text" maxlength="255" name="profile_state" id="edit-profile-state" size="60" value="" class="form-text required" />
 <div class="description"> The content of this field is kept private and will not be shown publicly.</div>

</div>
<div class="form-item" id="edit-profile-country-wrapper">
 <label for="edit-profile-country">Country: <span class="form-required" title="This field is required.">*</span></label>
 <select name="profile_country" class="form-select required" id="edit-profile-country" ><option value="Philippines">Philippines</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote D&#039;Ivoire">Cote D&#039;Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-bissau">Guinea-bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic People&#039;s Republic of">Korea, Democratic People&#039;s Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People&#039;s Democratic Republic">Lao People&#039;s Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macau">Macau</option><option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Moldova, Republic of">Moldova, Republic of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia (Slovak Republic)">Slovakia (Slovak Republic)</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="St. Helena">St. Helena</option><option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Vatican City State (Holy See)">Vatican City State (Holy See)</option><option value="Venezuela">Venezuela</option><option value="Viet Nam">Viet Nam</option><option value="Virgin Islands (British)">Virgin Islands (British)</option><option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>

 <div class="description"> The content of this field is kept private and will not be shown publicly.</div>
</div>
<div class="form-item" id="edit-profile-gender-wrapper">
 <label for="edit-profile-gender">Gender: <span class="form-required" title="This field is required.">*</span></label>
 <select name="profile_gender" class="form-select required" id="edit-profile-gender" ><option value="Male">Male</option><option value="Female">Female</option></select>
</div>
<div class="form-item" id="edit-profile-dob-wrapper">
 <label for="edit-profile-dob">Birthdate: <span class="form-required" title="This field is required.">*</span></label>

 <div class="container-inline"><div class="form-item" id="edit-profile-dob-month-wrapper">
 <select name="profile_dob[month]" class="form-select" id="edit-profile-dob-month" ><option value="1">Jan</option><option value="2">Feb</option><option value="3" selected="selected">Mar</option><option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option></select>
</div>

<div class="form-item" id="edit-profile-dob-day-wrapper">
 <select name="profile_dob[day]" class="form-select" id="edit-profile-dob-day" ><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15" selected="selected">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>

</div>
<div class="form-item" id="edit-profile-dob-year-wrapper">
 <select name="profile_dob[year]" class="form-select" id="edit-profile-dob-year" ><option value="1900">1900</option><option value="1901">1901</option><option value="1902">1902</option><option value="1903">1903</option><option value="1904">1904</option><option value="1905">1905</option><option value="1906">1906</option><option value="1907">1907</option><option value="1908">1908</option><option value="1909">1909</option><option value="1910">1910</option><option value="1911">1911</option><option value="1912">1912</option><option value="1913">1913</option><option value="1914">1914</option><option value="1915">1915</option><option value="1916">1916</option><option value="1917">1917</option><option value="1918">1918</option><option value="1919">1919</option><option value="1920">1920</option><option value="1921">1921</option><option value="1922">1922</option><option value="1923">1923</option><option value="1924">1924</option><option value="1925">1925</option><option value="1926">1926</option><option value="1927">1927</option><option value="1928">1928</option><option value="1929">1929</option><option value="1930">1930</option><option value="1931">1931</option><option value="1932">1932</option><option value="1933">1933</option><option value="1934">1934</option><option value="1935">1935</option><option value="1936">1936</option><option value="1937">1937</option><option value="1938">1938</option><option value="1939">1939</option><option value="1940">1940</option><option value="1941">1941</option><option value="1942">1942</option><option value="1943">1943</option><option value="1944">1944</option><option value="1945">1945</option><option value="1946">1946</option><option value="1947">1947</option><option value="1948">1948</option><option value="1949">1949</option><option value="1950">1950</option><option value="1951">1951</option><option value="1952">1952</option><option value="1953">1953</option><option value="1954">1954</option><option value="1955">1955</option><option value="1956">1956</option><option value="1957">1957</option><option value="1958">1958</option><option value="1959">1959</option><option value="1960">1960</option><option value="1961">1961</option><option value="1962">1962</option><option value="1963">1963</option><option value="1964">1964</option><option value="1965">1965</option><option value="1966">1966</option><option value="1967">1967</option><option value="1968">1968</option><option value="1969">1969</option><option value="1970">1970</option><option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option><option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option><option value="2008">2008</option><option value="2009">2009</option><option value="2010">2010</option><option value="2011" selected="selected">2011</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option><option value="2029">2029</option><option value="2030">2030</option><option value="2031">2031</option><option value="2032">2032</option><option value="2033">2033</option><option value="2034">2034</option><option value="2035">2035</option><option value="2036">2036</option><option value="2037">2037</option><option value="2038">2038</option><option value="2039">2039</option><option value="2040">2040</option><option value="2041">2041</option><option value="2042">2042</option><option value="2043">2043</option><option value="2044">2044</option><option value="2045">2045</option><option value="2046">2046</option><option value="2047">2047</option><option value="2048">2048</option><option value="2049">2049</option><option value="2050">2050</option></select>

</div>
</div>
 <div class="description">If a child, fill in child�s date of birth. To be eligible for the Cybrary, the child must be no younger than 7 or older than 12 years old. The content of this field is kept private and will not be shown publicly.</div>
</div>

</fieldset>
<input type="submit" name="op" id="edit-submit" value="Create new account"  class="form-submit" />

</div></form>
                                                                                                                    </div>

                                