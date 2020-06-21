<style>
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>

<div id="navbar-wrapper">
  <nav class="navbar navbar-inverse">
  <div class="container-fluid" style="">
    <ul id="top-navbar">
      <li>
        <div class="navbar-header" style="">
          <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
        </div>
      </li>
      <li>
        <div class="navbar-button" style="">
          <a href="{{route('admin.dashboard')}}" class="pull-left" id="sidebar-toggle" style="">Home</a>
        </div>
      </li>
    </ul>
    <ul style="">
      <li class="nav-item d-none d-sm-inline-block" style="position:relative;margin:15px;margin-right:25px;"><div class="dropdown">
            <i class="fas fa-bell"></i>
            <div class="dropdown-content" style="width:250px;float:right;right:-90%;top:100%;">
              <?php
              foreach ($data as $key => $value) {
              ?>
              <tr>
                <div style="padding:10px;margin:5px;background:#EEEEEEEE"><a><?php
                  echo $value;
                 ?>
              </a>
            </div>
            </tr>
              <?php
              }
               ?>
            </div>
          </div>
      </li>
      <li class="nav-item d-none d-sm-inline-block" style="float:right;position:relative;">
        <div class="dropdown">
          <div class="dropdown-toggle" type="button" data-toggle="dropdown">
            @foreach($adminprofile ?? '' as $row)
            @if($row['image']!="")
            <?php $file = explode('/public', $row['image']);
            ?>
            <img src="{{URL::asset($file[1])}}"/>
            <span>{{$row['FirstName']}}&nbsp; {{$row['LastName']}}</span>
            <label for="profile2"><i class="mdi mdi-menu"></i></label>
            @else
            <img src="https://cdn0.iconfinder.com/data/icons/avatars-3/512/avatar_hipster_guy-512.png">
            <span>{{$row['FirstName']}}&nbsp;{{$row['LastName']}} </span>
            <label for="profile2"><i class="mdi mdi-menu"></i></label>
            @endif
            @endforeach
          <span class="caret"></span>
        </div>
          <ul class="dropdown-menu">
            <li>
              @foreach($adminprofile as $row)
              @if($row['image']!="")
              <?php $file = explode('/public', $row['image']);
              ?>
              <img class="rounded-circle" style="height:170px;" src="{{URL::asset($file[1])}}">
              @else
              <img class="rounded-circle" src="https://cdn0.iconfinder.com/data/icons/avatars-3/512/avatar_hipster_guy-512.png">
              @endif
              @endforeach
            </li>
           <li style="z-index:1000"><a href="{{route('admin.adminprofile')}}"><i class="fas fa-cogs" style="margin-right:10px;"></i>Settings</a></li>
           <li><a href="{{route('admin.logout') }}"><i class="fas fa-sign-out-alt" style="margin-right:10px;"></i>Logout</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>
</div>
