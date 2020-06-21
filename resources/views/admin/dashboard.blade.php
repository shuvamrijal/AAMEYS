<!DOCTYPE html>
<html>
<head>
@include('admin.includes.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="wrapper">
  @include('admin.includes.sidebar')
  @include('admin.includes.navbar')
    <section id="content-wrapper" class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-sm-12 col-md-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>@php
                $count=0;
                @endphp
                @foreach($staff as $row)
                @php
                  $count = $count+1
                @endphp
                @endforeach
                {{$count}}
              </h3>
                <p>Staff</p>
              </div>
              <div class="icon">
                <i class="small-icon fa fa-chalkboard-teacher"></i>
              </div>
              <a href="{{route('admin.stafflist')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-sm-12 col-md-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  @php
                  $count=0;
                  @endphp
                  @foreach($student as $row)
                  @php
                    $count = $count+1
                  @endphp
                  @endforeach
                  {{$count}}
                </h3>
                <p>Student</p>
              </div>
              <div class="icon">
                <i class="small-icon fas fa-user-graduate"></i>
              </div>
              <a href="{{route('admin.studentList')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12 col-md-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>@php
                $count=0;
                @endphp
                @foreach($courses as $row)
                @php

                  $count = $count+1
                @endphp
                @endforeach
                {{$count}}
              </h3>
                <p>Course</p>
              </div>
              <div class="icon">
                <i class="small-icon fas fa-book-reader"></i>
              </div>
              <a href="{{route('admin.courcces')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
          <div class="row">
          <!-- ./col -->
          <div class="col-lg-4 col-sm-12 col-md-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <h3>...</h3>
                <p>Resources</p>
              </div>
              <div class="icon">
                <i class="small-icon  fas fa-calendar-check"></i>
              </div>
              <a href="{{route('admin.resources')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12 col-md-4">
            <!-- small box -->
            <div class="small-box" style="background:#ff9900">
              <div class="inner">
                    <h3>...</h3>
                <p>Announcement</p>
              </div>
              <div class="icon">
                  <i class="small-icon fas fa-bullhorn"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>
          </div>
          <div class="col-lg-4 col-sm-12 col-md-4">
            <!-- small box -->
            <div class="small-box" style="background:#EF8666">
              <div class="inner">
                    <h3>...</h3>
                <p>View Attendance</p>
              </div>
              <div class="icon">
                <i class="small-icon fas fa-user-check"></i>

              </div>
              <a href="{{route('admin.report')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

</div>


<!-- Bootstrap 4 -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/admin.js') }}"></script>
</body>
</html>
