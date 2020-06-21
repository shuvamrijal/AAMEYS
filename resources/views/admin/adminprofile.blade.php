<!DOCTYPE html>
<html>
<head>
@include('admin.includes.head')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper" id="wrapper">
    @include('admin.includes.sidebar')
    @include('admin.includes.navbar')

      <section id="content-wrapper" class="content">
        <div class="container admin-profile">
          <div class="row">
            <div class="col-md-4">
              <div class=" light bordered profile-sidebar-portlet">
                <div class="profile-img">
                  <div class="col-sm-4">
                    <form class="" action="{{route('admin.saveimage')}}" method="POST" enctype="multipart/form-data">
                      {{csrf_field()}}
                      @foreach($adminprofile ?? '' as $row)
                      @if($row['image']!="")
                      <?php $file = explode('/public', $row['image']);
                      ?>
                      <img src="{{URL::asset($file[1])}}" style="height:180px;width:180px;" id="uploadImage" class="rounded-circle"/>
                      @else
                      <img  id="uploadImage" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                      @endif
                      @endforeach
                      <span class="editimage"><a href="#" onclick="document.getElementById('file').click();">change image</a>
                      </span>
                      <input type="hidden" name="id" value="{{$row['id']}}">
                      <input type="file" style="display:none"  id="file" name="userimage"/>
                    </div>
                  </div>
                  <div class="imagesave">
                    <button type="submit" name="button" class="btn btn-primary" id="savebtn">Save</button>
                  </div>
                </form>
                <div class="account_list" style="margin-top:20px;">
                  <ul class="nav nav-tabs" id="account_list">
                    <li class="active"><i class="fas fa-info-circle"></i><a data-toggle="tab"  href="#about">About</a> <i class="fas fa-angle-right"></i></li>
                    <li><i class="fas fa-user"></i><a <a data-toggle="tab"  href="#account">Account</a> <i class="fas fa-angle-right"></i></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="right-content light bordered">
                <div class="tab-content">
                  <div id="about" class="tab-pane  in active">
                    <div class="row">
                      <div class="about_title">
                        @foreach($adminprofile ?? '' as $row)
                        <a href="" data-toggle="modal" data-target="#showProfile{{$row['id']}}"><p><i class="fas fa-pencil-alt"></i>Edit</p></a>
                        <div class="modal" id="showProfile{{$row['id']}}" data-backdrop="static">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>
                              <div class="modal-body">
                                <div class="" style="margin:0px">
                                  <form method="post" action="{{route('admin.profile.edit')}}" style="marrgin:0px;"  >
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$row['id']}}">
                                    <div class="row">

                                      <div class="col-lg-5 col-xs-12 col-sm-5">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">First Name</label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="First Name" name="fname"  value="{{$row['FirstName']}}">
                                        </div>
                                      </div>
                                      <div class="col-lg-5 col-xs-12 col-sm-5">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Last Name</label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name"  name="lname" value="{{$row['LastName']}}">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Email</label>
                                          <input type="email"  class="form-control" name="email" placeholder="Email" required  value="{{$row['email']}}"/>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Phone No</label>
                                          <input type="text"  class="form-control" name="phoneno" placeholder="Phone No" required  value="{{$row['PhoneNo']}}"/>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Gender</label>
                                          <div class="row">
                                            <div class="col-md-3">
                                              <input type="radio" name="gender"  id="rd1" value="male" {{ ($row['gender']=="male")? "checked" : "" }}>
                                              <label for="rd1" >Male</label>
                                            </div>
                                            <div class="col-md-3">
                                              <input type="radio"  name="gender" id="rd2" value="female" {{ ($row['gender']=="female")? "checked" : "" }}>
                                              <label for="rd2"  >Female</label>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Date Of Birth</label>
                                          <input type="date" class="form-control"  name="dateofbirth" placeholder="Street" value="{{$row['dateofbirth']}}" required />
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Street</label>
                                          <input type="text" class="form-control"  name="street" placeholder="Street" value="{{$row['street']}}" required />
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-offset-1 col-lg-5 col-xs-12 col-sm-5">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">City</label>
                                          <input type="text" class="form-control"  name="city" id="exampleInputEmail1" placeholder="City" value="{{$row['city']}}">
                                        </div>
                                      </div>
                                      <div class="col-lg-offset-0 col-lg-5 col-xs-12 col-sm-5">
                                        <div class="row">
                                          <div class="col-lg-6">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">State</label>
                                              <input type="text"  name="state" class="form-control" id="exampleInputEmail1" placeholder="State" value="{{$row['state']}}">
                                            </div>
                                          </div>
                                          <div class="col-lg-6">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Post Code</label>
                                              <input type="text" name="pcode" class="form-control" id="exampleInputEmail1" placeholder="Post Code" value="{{$row['postcode']}}">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Country</label>
                                          <select id='country_select' name='country' class="form-control">
                                            <option value="{{$row['country']}}" selected>{{$row['country']}}</option>
                                            <option value="AF">Afghanistan</option>
                                            <option value="AX">Åland Islands</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AS">American Samoa</option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">Antarctica</option>
                                            <option value="AG">Antigua and Barbuda</option>
                                            <option value="AR">Argentina</option>
                                            <option value="AM">Armenia</option>
                                            <option value="AW">Aruba</option>
                                            <option value="AU">Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="AZ">Azerbaijan</option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BD">Bangladesh</option>
                                            <option value="BB">Barbados</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Benin</option>
                                            <option value="BM">Bermuda</option>
                                            <option value="BT">Bhutan</option>
                                            <option value="BO">Bolivia, Plurinational State of</option>
                                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                            <option value="BA">Bosnia and Herzegovina</option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">Bouvet Island</option>
                                            <option value="BR">Brazil</option>
                                            <option value="IO">British Indian Ocean Territory</option>
                                            <option value="BN">Brunei Darussalam</option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="BF">Burkina Faso</option>
                                            <option value="BI">Burundi</option>
                                            <option value="KH">Cambodia</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">Cape Verde</option>
                                            <option value="KY">Cayman Islands</option>
                                            <option value="CF">Central African Republic</option>
                                            <option value="TD">Chad</option>
                                            <option value="CL">Chile</option>
                                            <option value="CN">China</option>
                                            <option value="CX">Christmas Island</option>
                                            <option value="CC">Cocos (Keeling) Islands</option>
                                            <option value="CO">Colombia</option>
                                            <option value="KM">Comoros</option>
                                            <option value="CG">Congo</option>
                                            <option value="CD">Congo, the Democratic Republic of the</option>
                                            <option value="CK">Cook Islands</option>
                                            <option value="CR">Costa Rica</option>
                                            <option value="CI">Côte d'Ivoire</option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CW">Curaçao</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">Czech Republic</option>
                                            <option value="DK">Denmark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DM">Dominica</option>
                                            <option value="DO">Dominican Republic</option>
                                            <option value="EC">Ecuador</option>
                                            <option value="EG">Egypt</option>
                                            <option value="SV">El Salvador</option>
                                            <option value="GQ">Equatorial Guinea</option>
                                            <option value="ER">Eritrea</option>
                                            <option value="EE">Estonia</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="FK">Falkland Islands (Malvinas)</option>
                                            <option value="FO">Faroe Islands</option>
                                            <option value="FJ">Fiji</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="GF">French Guiana</option>
                                            <option value="PF">French Polynesia</option>
                                            <option value="TF">French Southern Territories</option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambia</option>
                                            <option value="GE">Georgia</option>
                                            <option value="DE">Germany</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">Gibraltar</option>
                                            <option value="GR">Greece</option>
                                            <option value="GL">Greenland</option>
                                            <option value="GD">Grenada</option>
                                            <option value="GP">Guadeloupe</option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">Guatemala</option>
                                            <option value="GG">Guernsey</option>
                                            <option value="GN">Guinea</option>
                                            <option value="GW">Guinea-Bissau</option>
                                            <option value="GY">Guyana</option>
                                            <option value="HT">Haiti</option>
                                            <option value="HM">Heard Island and McDonald Islands</option>
                                            <option value="VA">Holy See (Vatican City State)</option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">Hong Kong</option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="IN">India</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="IR">Iran, Islamic Republic of</option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IM">Isle of Man</option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="JP">Japan</option>
                                            <option value="JE">Jersey</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KZ">Kazakhstan</option>
                                            <option value="KE">Kenya</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KP">Korea, Democratic People's Republic of</option>
                                            <option value="KR">Korea, Republic of</option>
                                            <option value="KW">Kuwait</option>
                                            <option value="KG">Kyrgyzstan</option>
                                            <option value="LA">Lao People's Democratic Republic</option>
                                            <option value="LV">Latvia</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LR">Liberia</option>
                                            <option value="LY">Libya</option>
                                            <option value="LI">Liechtenstein</option>
                                            <option value="LT">Lithuania</option>
                                            <option value="LU">Luxembourg</option>
                                            <option value="MO">Macao</option>
                                            <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                            <option value="MG">Madagascar</option>
                                            <option value="MW">Malawi</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malta</option>
                                            <option value="MH">Marshall Islands</option>
                                            <option value="MQ">Martinique</option>
                                            <option value="MR">Mauritania</option>
                                            <option value="MU">Mauritius</option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexico</option>
                                            <option value="FM">Micronesia, Federated States of</option>
                                            <option value="MD">Moldova, Republic of</option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolia</option>
                                            <option value="ME">Montenegro</option>
                                            <option value="MS">Montserrat</option>
                                            <option value="MA">Morocco</option>
                                            <option value="MZ">Mozambique</option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibia</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Nepal</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="NC">New Caledonia</option>
                                            <option value="NZ">New Zealand</option>
                                            <option value="NI">Nicaragua</option>
                                            <option value="NE">Niger</option>
                                            <option value="NG">Nigeria</option>
                                            <option value="NU">Niue</option>
                                            <option value="NF">Norfolk Island</option>
                                            <option value="MP">Northern Mariana Islands</option>
                                            <option value="NO">Norway</option>
                                            <option value="OM">Oman</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PW">Palau</option>
                                            <option value="PS">Palestinian Territory, Occupied</option>
                                            <option value="PA">Panama</option>
                                            <option value="PG">Papua New Guinea</option>
                                            <option value="PY">Paraguay</option>
                                            <option value="PE">Peru</option>
                                            <option value="PH">Philippines</option>
                                            <option value="PN">Pitcairn</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="PR">Puerto Rico</option>
                                            <option value="QA">Qatar</option>
                                            <option value="RE">Réunion</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">Russian Federation</option>
                                            <option value="RW">Rwanda</option>
                                            <option value="BL">Saint Barthélemy</option>
                                            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                            <option value="KN">Saint Kitts and Nevis</option>
                                            <option value="LC">Saint Lucia</option>
                                            <option value="MF">Saint Martin (French part)</option>
                                            <option value="PM">Saint Pierre and Miquelon</option>
                                            <option value="VC">Saint Vincent and the Grenadines</option>
                                            <option value="WS">Samoa</option>
                                            <option value="SM">San Marino</option>
                                            <option value="ST">Sao Tome and Principe</option>
                                            <option value="SA">Saudi Arabia</option>
                                            <option value="SN">Senegal</option>
                                            <option value="RS">Serbia</option>
                                            <option value="SC">Seychelles</option>
                                            <option value="SL">Sierra Leone</option>
                                            <option value="SG">Singapore</option>
                                            <option value="SX">Sint Maarten (Dutch part)</option>
                                            <option value="SK">Slovakia</option>
                                            <option value="SI">Slovenia</option>
                                            <option value="SB">Solomon Islands</option>
                                            <option value="SO">Somalia</option>
                                            <option value="ZA">South Africa</option>
                                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                                            <option value="SS">South Sudan</option>
                                            <option value="ES">Spain</option>
                                            <option value="LK">Sri Lanka</option>
                                            <option value="SD">Sudan</option>
                                            <option value="SR">Suriname</option>
                                            <option value="SJ">Svalbard and Jan Mayen</option>
                                            <option value="SZ">Swaziland</option>
                                            <option value="SE">Sweden</option>
                                            <option value="CH">Switzerland</option>
                                            <option value="SY">Syrian Arab Republic</option>
                                            <option value="TW">Taiwan, Province of China</option>
                                            <option value="TJ">Tajikistan</option>
                                            <option value="TZ">Tanzania, United Republic of</option>
                                            <option value="TH">Thailand</option>
                                            <option value="TL">Timor-Leste</option>
                                            <option value="TG">Togo</option>
                                            <option value="TK">Tokelau</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TT">Trinidad and Tobago</option>
                                            <option value="TN">Tunisia</option>
                                            <option value="TR">Turkey</option>
                                            <option value="TM">Turkmenistan</option>
                                            <option value="TC">Turks and Caicos Islands</option>
                                            <option value="TV">Tuvalu</option>
                                            <option value="UG">Uganda</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="AE">United Arab Emirates</option>
                                            <option value="GB">United Kingdom</option>
                                            <option value="US">United States</option>
                                            <option value="UM">United States Minor Outlying Islands</option>
                                            <option value="UY">Uruguay</option>
                                            <option value="UZ">Uzbekistan</option>
                                            <option value="VU">Vanuatu</option>
                                            <option value="VE">Venezuela, Bolivarian Republic of</option>
                                            <option value="VN">Viet Nam</option>
                                            <option value="VG">Virgin Islands, British</option>
                                            <option value="VI">Virgin Islands, U.S.</option>
                                            <option value="WF">Wallis and Futuna</option>
                                            <option value="EH">Western Sahara</option>
                                            <option value="YE">Yemen</option>
                                            <option value="ZM">Zambia</option>
                                            <option value="ZW">Zimbabwe</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
                                        <div class="form-group">
                                          <div class="col-sm-2">
                                            <button type="submit"  name="button" class="btn btn-primary form-control">Save</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div><!--about title-->
                    </div><!--row-->
                    <div class="row">
                      <div class="about_body">
                        <div class="personal_information">
                          <h5>Personal Information</h5>
                          <div class="content col-md-12">
                            <table class="table table-borderless">
                              <tbody>
                                @foreach($adminprofile ?? '' as $row)
                                <tr class="col-md-12">
                                  <td>First Name: </td>
                                  <td class="value">
                                    @if(empty($row['FirstName']))
                                    -------------------
                                    @else
                                    {{$row['FirstName']}}
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td>Last Name: </td>
                                  <td class="value">
                                    @if(empty($row['LastName']))
                                    -------------------
                                    @else
                                    {{$row['LastName']}}
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td>Gender: </td>
                                  <td class="value">
                                    @if(empty($row['gender']))
                                    -------------------
                                    @else
                                    {{$row['gender']}}
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td>Date Of Birth: </td>
                                  <td class="value">
                                    @if(empty($row['dateofbirth']))
                                    -------------------
                                    @else
                                    {{$row['dateofbirth']}}
                                    @endif
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div><!--personal infromation-->
                        <div class="contact_information ">
                          <h5>Contact Information</h5>
                          <div class="content col-md-12">
                            <table class="table table-borderless">
                              <tbody>
                                @foreach($adminprofile ?? '' as $row)
                                <tr class="">
                                  <td>Address: </td>
                                  <td class="value">
                                    @if(empty($row['street']))
                                    -------------------
                                    @else
                                    {{$row['street']}}, {{$row['city']}}, {{$row['state']}},{{$row['postcode']}}, {{$row['country']}}
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td>Email: </td>
                                  <td class="value">
                                    @if(empty($row['email']))
                                    -------------------
                                    @else
                                    {{$row['email']}}
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td>Phone No: &nbsp; &nbsp; &nbsp; </td>
                                  <td class="value">
                                    @if(empty($row['PhoneNo']))
                                    -------------------
                                    @else
                                    {{$row['PhoneNo']}}
                                    @endif
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div><!--contact Information-->
                      </div><!--about body-->
                    </div><!--row-->
                  </div><!--about tab-->
                  <div id="account" class="tab-pane fade in active">
                    <div class="account-body">
                        <div class="row">
                            <div class="username col-sm-12">
                                <div class="title_container">
                                <h5> Account Seeting</h5>
                              </div>
                                <div id="usernamerow">
                                  <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-3 col-form-label">User Name:</label>
                                          <div class="col-sm-7">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{Auth::guard('admin')->user()->username}}">
                                          </div>
                                          <div class="col-sm-2">
                                            <a href="#" id="change_username"><p><i class="fas fa-pencil-alt"></i>Edit</p></a>
                                          </div>
                                        </div>
                                  </div>
                                <div id="changeusernamerow">
                                <p>Change User name</p>
                                <form class="" action="{{route('admin.changeusername')}}" method="post">
                                    {{csrf_field()}}

                                  <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-3 col-form-label">User Name:</label>
                                          <div class="col-sm-7">
                                            <input type="text"  name="username" class="form-control" value="{{Auth::guard('admin')->user()->username}}">
                                          </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="col-sm-3">
                                      <input type="hidden" name="id" value="{{Auth::guard('admin')->user()->id}}">
                                    </div>

                                    <div class="col-sm-2">
                                        <button type="submit" name="button" class="btn btn-primary">&nbsp; Save &nbsp;</button>
                                    </div>
                                    <div class="col-sm-1">
                                      <button type="button"  id="cancel" name="button" class="btn btn-default">cancel</button>
                                    </div>
                                  </div>
                              </form>
                            </div>

                            <div id="passwordrow">
                              <div class="form-group row">
                                      <label for="staticEmail" class="col-sm-3 col-form-label">Change Password:</label>
                                      <div class="col-sm-7">
                                      </div>
                                      <div class="col-sm-2">
                                        <a href="#" id="change_password"><p><i class="fas fa-pencil-alt"></i>Edit</p></a>
                                      </div>
                                    </div>
                              </div>

                            <p id="sucessmessage"></p>
                            <div id="chnagepassword">
                                <p id="erroemessage"></p>
                            <form class="" action="{{route('change.password')}}" method="" id="passchangeform">

                              <div class="form-group row">
                                      <label for="staticEmail" class="col-sm-4 col-form-label">Current Password:</label>
                                      <div class="col-sm-7">
                                        <input type="password"   id="current_password" name="current_password" class="form-control">
                                      </div>
                              </div>
                              <div class="form-group row">
                                      <label for="staticEmail" class="col-sm-4 col-form-label">New Password:</label>
                                      <div class="col-sm-7">
                                        <input type="password" id="new_password" name="new_password" class="form-control">
                                      </div>
                              </div>
                              <div class="form-group row">
                                      <label for="staticEmail" class="col-sm-4 col-form-label">Re-type New Password:</label>
                                      <div class="col-sm-7">
                                        <input type="password"  name="new_confirm_password" class="form-control">
                                      </div>
                              </div>
                              <p id="passnotmatch"></p>
                              <div class="form-group row">
                                <div class="col-sm-4">
                                  <input type="hidden" name="id" value="{{Auth::guard('admin')->user()->id}}">
                                </div>

                                <div class="col-sm-2">
                                    <button type="button" name="button"  id="save" class="btn btn-primary">&nbsp; Save &nbsp;</button>
                                </div>
                                <div class="col-sm-1">
                                  <button type="button"  id="passcancel" name="button" class="btn btn-default">cancel</button>
                                </div>
                              </div>
                              </form>
                        </div>
                        </div>

                    </div>
                  </div><!--acount tab-->
                </div><!--tab content-->
              </div><!--right content-->
            </div><!--right column-->
          </div><!--body row-->
        </div><!--container-->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.includes.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>

  </div>


  <!-- Bootstrap 4 -->

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="{{ URL::asset('js/admin.js') }}"></script>
  <script>
  $(document).ready(function(){
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#uploadImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $(document).on('change', '#file', function(){
      $('#savebtn').css('display','inline');
      readURL(this);
    });
  });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $("#save").click(function(e){
        e.preventDefault();
        var current_password = $("input[name=current_password]").val();
        var new_password = $("input[name=new_password]").val();
        var new_confirm_password = $("input[name=new_confirm_password]").val();
        if(new_password!==new_confirm_password){
          $("#passnotmatch").text("Not match");

        }else{
        $.ajax({
           type:'get',
           url:'/admin/changepassword',
           data:{current_password:current_password, new_password:new_password, new_confirm_password:new_confirm_password},
           success:function(data){
              if(data.error==true && data.success==false){
              $("#erroemessage").text(data.message);
            }
              if(data.error==false && data.success==true){
                $("#sucessmessage").text(data.message);
                $('#change_password p').css('display','block');
                $('#chnagepassword').css('display','none');
                $('#passchangeform').trigger("reset");
              }
           }
        });
      }
	});

</script>
</body>
</html>
