<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    @include('staff.includes.head')
    <title>Dashboard</title>
  </head>
  <body>
    <div  id="wrapper" class="">
      @include('staff.includes.navbar')
      @include('staff.includes.sidebar')
      <div class="container-fluid" id="body-section" style="">
        <div class="row">

              <div class="col-lg-3 col-sm-12 col-xs-12">
                <div class="my-cources-side-bar">
                  <h5>Activities</h5>
                  <ul>
                        <li><a href="#">Chat <i class="fas fa-angle-double-right"></i></a></li>
                          <li><a href="#">News Forum <i class="fas fa-angle-double-right"></i></a></li>
                  </ul>
                </div>
                <div class="my-cources-side-bar">
                  <h5>Announcement</h5>
                  <ul>
                        <li><a href="#">Chat <i class="fas fa-angle-double-right"></i></a></li>
                          <li><a href="#">News Forum <i class="fas fa-angle-double-right"></i></a></li>
                  </ul>
                </div>
                <div class="my-cources-side-bar">
                  <h5>Upcoming Evetnst</h5>
                  <ul>
                      <li><a href="#">Chat <i class="fas fa-angle-double-right"></i></a></li>
                      <li><a href="#">News Forum <i class="fas fa-angle-double-right"></i></a></li>
                  </ul>
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
