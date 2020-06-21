<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    @include('student.includes.head')
    <title>Dashboard</title>
    <style media="screen">
      .mycources-box{
        border: 2px solid #E8E8E8;
        margin: 0px;
        padding: 15px;
        background-color: whitesmoke;
      }

    </style>
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
                  <div class="cource-content">
                    <h3>My Grades</h3>

                      @foreach($courses as $row)
                      <div class="col-lg-12 col-md-6 col-sm-12 mycources-box">
                          <a href="/student/getgrade/{{$row['courses_id']}}">{{$row['CourseName']}}</a>
                      </div>
                      @endforeach

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
