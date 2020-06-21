<!DOCTYPE html>
<html>
<head>
@include('admin.includes.head')
<style media="screen">
  .search_attendance{
    padding: 20px;
    width: 100%;
    text-align: center;
    background-color: whitesmoke;
  }
  .search_attendance label{
    font-size: 16px;
    color: #000000;
    font-weight: normal;
    padding: 10px;
    margin: 2px;
  }
  .search_attendance input{
    height: 40px;
    border: 1px solid #000000;
    width: 150px;
    margin: 2px;
  }
  .search_attendance  select{
    height: 40px;
    border: 1px solid #000000;
    width: 160px;
    margin: 2px;
  }
  .search_attendance button{
    height: 40px;
    width: 130px;
    margin: 2px;
  }
  .attendace_report{
    width: 100%;
    margin: 0px;
    padding: 0px;
  }
  .attendace_report table{
    width: 100%;
  }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="wrapper">
  @include('admin.includes.sidebar')
  @include('admin.includes.navbar')
    <section id="content-wrapper" class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="slist-title" style="width:100%;">
            <h4 class="">Attendance Report</h4>
          </div>

            <div class="search_attendance">
              <form class="" action="index.html" method="post">
              <label for="">Serach Attendace:</label>
              <select id='course_id'  class="" name='courseid'>
                   <option value="" disabled selected>Select Courses</option>
                    @foreach($courses as $row)
                    <option value="{{$row['courses_id']}}">{{$row['CourseName']}}</option>
                    @endforeach
            </select>
              <input type="date" id="attendance_date" value="<?php echo date('Y-m-d'); ?>" />
              <button type="button" id="attendance_serach" name="button" class="btn btn-primary">Show</button>
            </form>
            </div>

    <div class="attendace_report col-lg-12" style="width:100px;">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Student Name</th>
            <th scope="col">Subject Name</th>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody id="attendance_body">

        </tbody>
      </table>
    </div>



        </div>

      </div>
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
<script type="text/javascript">
$('#attendance_serach').click(function(){
  $('#attendance_body').empty();
  var coursesid=$("#course_id option:selected" ).val();
  var attn_date=$('#attendance_date').val();
 $.ajax({
     type:'get',
     url:'/admin/getattendancereport',
     dataType: "json",
     data:{coursesid:coursesid,attn_date:attn_date},
     success:function(data){

       if(data.value.length>=1){
         var count=0;
         $.each(data.value, function(j, v){
           count=count+1;
           var attendances_status;
           if(v['status']==1){
              attendances_status='Present';
           }else if(v['status']===0){
              attendances_status='Absent';
           }
            $('#attendance_body').append('<tr><th>'+count+'</th><th>'+v['StudentName']+'</th><th>'+v['CourseName']+'</th><th>'+v['date']+'</th><th>'+attendances_status+'</th></tr>');
            });

      }else{
            $('#attendance_body').append('No Record Found');
       }

}
});

});

</script>
</body>
</html>
