
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
         <li class="{{ Route::is('staff.dashboard') ? 'active' : '' }}"><a href="{{route('staff.dashboard')}}">Home</a></li>
         <li class="{{ Route::is('staff.calendar') ? 'active' : '' }}"><a href="{{route('staff.calendar')}}">Calender</a></li>
         <li class="{{ Route::is('staff.assignment') ? 'active' : '' }}"><a href="{{route('staff.assignment')}}">Assignment</a></li>
         <li class="{{ Route::is('staff.attendance') ? 'active' : '' }}"><a href="{{route('staff.attendance')}}">Attendance</a></li>
         <li class="{{ Route::is('staff.showquiz') ? 'active' : '' }}"><a href="{{route('staff.showquiz')}}">Quiz</a></li>
         <li class="{{ Route::is('staff.feedback') ? 'active' : '' }}"><a href="{{route('staff.feedback')}}">Feedback</a></li>
       </div>
      </ul>
  </nav>
