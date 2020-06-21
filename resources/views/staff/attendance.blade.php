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
            <ul class="breadcrumb">
              <li><a href="{{route('staff.dashboard')}}">Dashboard</a></li>
              <li> <a href="#">Attendance</a></li>
            </ul>
        </div>
            <div class="row">
              <div class="generate-attendance col-lg-9 col-sm-12 com-xs-12">
                <div class="courcename">
                    <h3>Attendance</h3>
                  <form class="" action="" method="">
                      {{csrf_field()}}
                      <div class="form-group row">
                         <label for="staticEmail" class="col-sm-3 col-form-label">Select Cources:</label>
                         <div class="col-sm-6">
                           <select class="form-control" id="schedule_id">
                             @foreach($schedule as $row)
                              <option value="{{$row['id']}}">{{$row['CourseName']}}</option>
                             @endforeach
                           </select>

                         </div>
                           <button type="button" class="col-sm-2 btn btn-primary" id="generate_code" name="button">Generate Code</button>
                       </div>
                  </form>
                </div>
                <div class="attendance_id">
                  <h4>Your attendance code</h4>
                  <div id="attendance_id">
                  </div>
                  <div class="">
                    <a href="#">Share this code</a>
                  </div>
                </div>
                <div class="attendance-list">
                  <div class="content">
                    <h3>Today's Attendance</h3>
                    <table class="table table-bordered" id="myTable" style="margin:0;padding:0px">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Student Name</th>
                          <th>Cource Name</th>
                          <th>Attendance Date</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($attendance as $value)
                        <tr>
                          <td>{{$value['id']}}</td>
                          <td>{{$value['Name']}}</td>
                          <td>{{$value['CourseName']}}</td>
                            <td>{{$value['attendance_date']}}</td>
                        </tr>
                        @endforeach

                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
              <div class="col-lg-3 col-sm-12 col-xs-12" style="margin:0;padding:0px;">
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
                  <h5>Upcoming Event</h5>
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

<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script>

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $("#generate_code").click(function(e){
      e.preventDefault();
      var shcedule_id = $( "#schedule_id option:selected" ).val();
      $.ajax({
         type:'get',
         url:'/staff/getattendancecode',
         data:{shcedule_id:shcedule_id},
         success:function(data){
           $("#attendance_id").html(data.message);
         }
      });
});
</script>
<script>
$(document).ready(function(){

  $('#myTable').dataTable({
    dom: 'l<"refresh">frtip',
     initComplete: function(){
        $("div.refresh")
           .html('<a href="#" id="refresh"><i class="fas fa-sync"></i></a>');
     }
  });

$("#refresh").click(function(){
$('#myTable').hide();
  setTimeout(function(){// wait for 5 secs(2)
location.reload(); // then reload the page.(3)
}, 100);
})
});
</script>
