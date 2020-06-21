
        <!-- Sidebar -->
    <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
     <ul class="nav sidebar-nav">
       <div class="sidebar-header">
       <div class="sidebar-brand">
           <a href="#">
             <img id="smallloginLogo" class="smallloginLogo" src="{{URL::asset('/images/69.png')}}" alt="IMG">
          </a>
       </div></div>
       <div class="listcontent">
         <li class="{{ Route::is('student.dashboard') ? 'active' : '' }}"><a href="{{route('student.dashboard')}}">Home</a></li>
         <li class="{{ Route::is('student.courses') ? 'active' : '' }}"><a href="{{route('student.courses')}}">Courses List</a></li>
         <li class="{{ Route::is('student.calendar') ? 'active' : '' }}"><a href="{{route('student.calendar')}}">Calender</a></li>
         <li class="sub-menu">
           <a data-toggle="dropdown" href="#">My Courses <i class="caret fas fa-caret-down" style="float:right;font-size:25px;"></i></a>
           <ul class="dropdown-menu">
             @foreach($mycourses as $row)
              <li>
                <a href="{{route('moodle.page',$row['courses_id'])}}">{{$row['CourseName']}}</a>
              </li>
             @endforeach
          </ul>
         </li>
         <li class="{{ Route::is('student.attendance') ? 'active' : '' }}"><a href="{{route('student.attendance')}}">Attendance</a></li>
       </div>
      </ul>
  </nav>
