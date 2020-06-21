<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    @include('student.includes.head')
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ URL::asset('css/staff/staffmedia.css') }}">
  </head>
  <body>
    <div  id="wrapper" class="">
      @include('student.includes.navbar')
      @include('student.includes.sidebar')
      <div class="container-fluid" id="body-section" style="">
        <div class="row">
            <ul class="breadcrumb">
              <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
              <li><a href="#">Settings</a></li>
            </ul>
        </div>
            <div class="row">
              <div class="my-cources col-lg-12 ">
                  <div class="cource-content staff-profile">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class=" profile-sidebar-portlet">
                          <div class="profile-img">
                              <form class="" action="{{route('student.saveimage')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                @foreach($student ?? '' as $row)
                                @if($row['image']!="")
                                <?php $file = explode('/public', $row['image']);
                                ?>
                                <img src="{{URL::asset($file[1])}}"   id="uploadImage" class="rounded-circle"/>
                                @else
                                <img  id="uploadImage" src="{{URL::asset('/images/default.jpg')}}" alt=""/>
                                @endif

                                @endforeach
                                <input type="file" style="display:none"  id="file" name="userimage"/>
                                <span class="editimage"><a href="#" onclick="document.getElementById('file').click();">change image</a>  </span>
                            </div>
                            <div class="imagesave">
                              <button type="submit" name="button" class="btn btn-primary" id="savebtn">Save</button>
                            </div>
                          </form>
                          <div class="account_list" style="margin-top:20px;">
                            <ul class="nav nav-tabs" id="account_list">
                              <li class="active"><a data-toggle="tab"  href="#about"> <i class="fas fa-info-circle"></i> About</a> <i class="fas fa-angle-right"></i></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-12">
                        <div class="profile-sidebar-portlet">
                          <div class="tab-content">
                            <div id="about" class="tab-pane in active">
                              <div class="row">
                                <div class="about_title">
                                  @foreach($student ?? '' as $row)
                                  <a href="" data-toggle="modal" data-target="#showProfile{{$row['staff_id']}}"><p><i class="fas fa-pencil-alt"></i>Edit</p></a>
                                  <div class="modal" id="showProfile{{$row['staff_id']}}" data-backdrop="static">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="" style="margin:0px">
                                            <form method="post" action="{{route('student.profile.edit')}}" style="marrgin:0px;"  >
                                              {{csrf_field()}}
                                              <input type="hidden" name="staff_id" value="{{$row['staff_id']}}">
                                              <div class="row">
                                                <div class="col-lg-10 col-xs-12 col-sm-5">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">Name</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="First Name" name="name"  value="{{$row['Name']}}">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input type="email"  class="form-control" name="email" placeholder="Email" required  value="{{$row['email']}}" readonly/>
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
                                                    <input type="date" class="form-control"  name="dob" placeholder="Street" value="{{$row['dateofbirth']}}" required />
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-lg-offset-0 col-lg-12 col-xs-12 col-sm-10">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">Address</label>
                                                    <input type="text" class="form-control"  name="address" placeholder="address" value="{{$row['Address']}}" required />
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
                                          @foreach($student ?? '' as $row)
                                          <tr class="col-md-12">
                                            <td>Name: </td>
                                            <td class="value">
                                              @if(empty($row['Name']))
                                              -------------------
                                              @else
                                              {{$row['Name']}}
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
                                          @foreach($student ?? '' as $row)
                                          <tr class="">
                                            <td>Address: </td>
                                            <td class="value">
                                              @if(empty($row['Address']))
                                              -------------------
                                              @else
                                              {{$row['Address']}}
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

                        </div><!--right content-->
                      </div>
                      </div>
                    </div>
                </div>


              </div>


            </div>
      </div>
    </div>
  </body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/staff.js') }}"></script>
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
           url:'/staff/changepassword',
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
