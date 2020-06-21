@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <h2>Logo</h2>
      </div>
      <ul class="navbar-nav">
        <li class="nav-item ">
          <div id="navbar-wrapper">
     <nav class="navbar navbar-inverse">
       <div class="container-fluid">
         <div class="navbar-header">
           <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
         </div>
       </div>
     </nav>
   </div>
        </li>




        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <div class="half">
          <label for="profile2" class="profile-dropdown">
              <input type="checkbox" id="profile2">
                <img src="https://cdn0.iconfinder.com/data/icons/avatars-3/512/avatar_hipster_guy-512.png">
                    <span>John Doe</span>
                      <label for="profile2"><i class="mdi mdi-menu"></i></label>
                        <ul>
                          <li><a href="#"><i class="mdi mdi-email-outline"></i>Messages</a></li>
                          <li><a href="#"><i class="mdi mdi-account"></i>Account</a></li>
                          <li><a href="#"><i class="mdi mdi-settings"></i>Settings</a></li>
                          <li><a href="#"><i class="mdi mdi-logout"></i>Logout</a></li>
                          </ul>
                      </label>
                    </div>
        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

      </ul>
    </aside>
</div>
@endsection
