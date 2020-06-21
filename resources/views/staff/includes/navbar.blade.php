
<div id="staff_navabar">
  <nav class="navbar">
    <ul class="top-navbar">
      <li>
        <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
      </li>
      <li>
        <li><a href="{{route('staff.dashboard')}}">Home</a></li>
      </li>
      <li>
        <ul class="left">
          <li>
            <div class="dropdown">
              <div class="dropdown-toggle"  data-toggle="dropdown">
                @foreach($staff ?? '' as $row)
                @if($row['image']!="")
                <?php $file = explode('/public', $row['image']);
                ?>
                <img src="{{URL::asset($file[1])}}"/>
                <span>{{$row['FirstName']}}&nbsp;{{$row['LastName']}}</span>
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
                  @foreach($staff as $row)
                  @if($row['image']!="")
                  <?php $file = explode('/public', $row['image']);
                  ?>
                  <img class="rounded-circle" style="height:170px;" src="{{URL::asset($file[1])}}">
                  @else
                  <img class="rounded-circle" src="https://cdn0.iconfinder.com/data/icons/avatars-3/512/avatar_hipster_guy-512.png">
                  @endif
                  @endforeach
                </li>
                <li>
                  <a href="{{route('staff.staffprofile')}}"><i class="fas fa-cogs" style="margin-right:10px;"></i>Settings</a>
                    <a href="{{route('staff.logout') }}"><i class="fas fa-sign-out-alt" style="margin-right:10px;"></i>Logout</a>
                </li>
                </ul>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</div>
