<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    @include('staff.includes.head')
    <title>Dashboard</title>
  </head>
  <body>
    <div  id="wrapper" class="toggled">
      @include('staff.includes.navbar')
      @include('staff.includes.sidebar')
      <div class="container-fluid" id="body-section" style="">
        <div class="row">
            <ul class="breadcrumb">
              <li><a href="{{route('staff.dashboard')}}">Dashboard</a></li>
            </ul>
        </div>
            <div class="row">
              <div class="my-cources col-lg-12 col-sm-12 com-xs-12">
                  <div class="cource-content">
                    <h3>My Cources</h3>
                    <div class="row">
                      @foreach($courses as $row)
                      <div class="col-lg-12 col-md-6 col-sm-12 cources-box">
                          <div class="course_name"><h5>Cource Name: {{$row['CourseName']}} </h5></div>
                          <div class="course_schedule">
                            <h6>Class Day: {{$row['DaysOfWeek']}}</h6>
                            <h6>Class Time: {{$row['Start_time']}} {{$row['End_time']}}  </h6>
                          </div>

                        <div class="more_info">
                          <a href="#">Go to moddle</a>
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
