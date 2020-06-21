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
                  <div class="cource-content">
                    <h3>My Units</h3>
                    <div class="row">
                      @foreach($arrayName as $row)
                      <div class="col-lg-4 col-md-6 col-sm-12 ">
                        <div class="courceslist-box">
                          <div class="image">
                              <img src="{{URL::asset('/images/courses.png')}}" alt="">
                          </div>
                          <div class="cource_name">
                          <h4>{{$row['CourseName']}}</h4>
                          <h6>Teacher Name:{{$row['Staff_name']}}</h6>
                          </div>
                          <div class="enroll-btn">
                            <form class="" action="{{route('student.newenroll')}}" method="post">
                              {{csrf_field()}}
                                <input type="hidden" name="courses_id" value="{{$row['courses_id']}}">
                                <button type="submit" name="button" class="btn btn-success">Enroll This Courses</button>
                            </form>
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
