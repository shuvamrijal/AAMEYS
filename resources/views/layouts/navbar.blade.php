
<div id="main_navbar">
  <nav class="navbar">
    <div class="container-fluid">
      <div class="nav_logo">
        <img src="{{URL::asset('/images/69.png')}}" alt="">
      </div>
      <ul class="top-navbar">
        <li>
          <a href="{{route('student.register')}}">Register</a>
        </li>
        <li>
          <a href="{{route('login')}}">Login</a>
        </li>
        <li>
          <a href="{{route('staff.dashboard')}}">Courses</a>
        </li>
        <li>
          <a href="{{route('staff.dashboard')}}">Home</a>
        </li>
      </ul>
    </div>
  </nav>
</div>
