<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    @include('student.includes.head')
    <title>Dashboard</title>
  </head>
  <body>
    <div  id="wrapper" class="toggled">
      @include('student.includes.navbar')
      @include('student.includes.sidebar')
      <div class="container-fluid" id="body-section" style="">
        <div class="row">
            <ul class="breadcrumb">
              <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
            </ul>
        </div>
            <div class="row">
              <div class="my-cources col-lg-12 col-sm-12 com-xs-12">
                  <div class="cource-content" style="height:600px;">
                    <h3>Attendance</h3>
                    <div class="row" style="padding:25px;">

                      @foreach($courses as $row)
                      <div class="col-lg-4 col-md-6 col-sm-12 cources-box">
                          <div class="course_name"><h5>{{$row['CourseName']}} </h5></div>
                        <div class="" style="text-align:center;padding:40px;">
                          <a href="#" style="font-size:20px;" data-toggle="modal" data-target="#showAttendance{{$row['courses_id']}}" onclick="myFunction({{$row['courses_id']}})">Make Attendance</a>
                          <div class="modal" id="showAttendance{{$row['courses_id']}}" data-backdrop="static">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Make Attendance </h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div><div class="container"></div>
                                    <div class="modal-body">
                                      <form class="" action="" method="get">
                                          <div class="attendance_code">
                                              <h2 id="attendance_code"></h2>
                                          </div>
                                          <div class="attendance_form">
                                            <div class="form-group">
                                              <input type="hidden" name="" value="" id="courses_id">
                                                <label for="" class="col-sm-12">Enter Code:</label>
                                                <input type="text" id="enter_value" class="form-control" name="attendance_code" value="">
                                                <p id="error" style="color:red;padding:10px;"></p>
                                                <p id="message"></p>
                                            </div>

                                            <button type="button" name="button" id="make_attendance" class="btn btn-primary">Submit</button>
                                          </div>
                                      </form>
                                    </div>

                                  </div>
                                </div>
                              </div>
                        </div>
                      </div>
                      @endforeach
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
<script type="text/javascript">
  function myFunction(id){
    var courses_id = id;
        $.ajax({
           type:'get',
           url:'/student/getAttendanceCode',
           dataType: "json",
           data:{courses_id:courses_id},
           success:function(data){
             console.log(data.success);
             if(data.success===false){
                 $('#attendance_code').text(data.message);
                 $('#attendance_code').css('height','150px');
                 $('.attendance_form').hide();
             }else{
                $code=data.message['value'];
                $('#attendance_code').text($code);
                $('#courses_id').val(data.courses_id);
                $('.attendance_form').show();
             }
        }
        });
  }
  $("#make_attendance").click(function(){
        var value=$('#attendance_code').text();
        var input_value=$('#enter_value').val();
        if(value===input_value){
            $('#error').text(" ");
            var courses_id= $('#courses_id').val();

            $.ajax({
               type:'get',
               url:'/student/makeattendance',
               dataType: "json",
               data:{courses_id:courses_id},
               success:function(data){
                 $('#message').text(data.message);
            }
            });
        }else{
            $('#error').text("Code dosen't match");
            $('#enter_value').val('');
        }


  })
</script>
