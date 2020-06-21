  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <img id="smallloginLogo" class="smallloginLogo" src="{{URL::asset('/images/mainlogo.png')}}" alt="IMG">
  <div id="title">
  <h1>AAMEYS</h1>
  </div>
    </div>
    <ul class="sidebar-nav">
      <li class="{{ Route::is('admin.dashboard') ? 'activebar' : '' }}">
        <a href="{{route('admin.dashboard')}}"><i class="fas fa-home sidebar-icon"></i><span>Home</span></a>
      </li>
      <li class="sub-menu">
        <a href="#staff" ><i class="fa fa-chalkboard-teacher sidebar-icon"></i></i><span>Staff</span> <i class="fas fa-caret-down" style="float:right;font-size:18px;text-align:center;margin:5px;"></i></a>
        <ul class="stffsub">
            <li class="{{ Route::is('admin.staff') ? 'activebar' : '' }}"><a href="{{route('admin.staff')}}">New Staff</a></li>
            <li class="{{ Route::is('admin.stafflist') ? 'activebar' : '' }}"><a href="{{route('admin.stafflist')}}">Staff List</a></li>
          </ul>
      </li>
      <li class="sub-menu">
        <a href="#student" ><i class="fas fa-user-graduate sidebar-icon"></i></i><span>Student</span> <i class="fas fa-caret-down" style="float:right;font-size:18px;text-align:center;margin:5px;"></i></a>
        <ul class="studentsub">
          <li class="{{ Route::is('admin.newStudent') ? 'activebar' : '' }}"><a href="{{route('admin.newStudent')}}">New Student</a></li>
          <li class="{{ Route::is('admin.enroll') ? 'activebar' : '' }}"><a href="{{route('admin.enroll')}}">Enroll Courses</a></li>
          <li class="{{ Route::is('admin.studentList') ? 'activebar' : '' }}"><a href="{{route('admin.studentList')}}">Student List</a></li>
          </ul>
      </li>
      <li class="{{ Route::is('admin.schedule') ? 'activebar' : '' }}">
        <a href="{{route('admin.schedule')}}"><i class="fas fa-calendar-alt sidebar-icon"></i><span>Schedule</span></a>
      </li>
      <li class="{{ Route::is('admin.courcces') ? 'activebar' : '' }}">
        <a href="{{route('admin.courcces')}}"><i class="fas fa-chalkboard-teacher sidebar-icon"></i><span>Courses</span> </a>
      </li>
      <li class="{{ Route::is('admin.report') ? 'activebar' : '' }}">
        <a href="{{route('admin.report')}}"><i class="far fa-address-book sidebar-icon"></i></i><span>Attendance</span></a>
      </li>
    </ul>
  </aside>
