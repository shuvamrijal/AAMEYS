<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    @include('staff.includes.head')
    <title>Dashboard</title>
  </head>
  <body>
    <div  id="wrapper" class="toggled">
      @include('staff.includes.navbar')
      @include('staff.includes.sidebar')
      <div class="container-fluid" id="body-section" style="">
        <div class="row">
            <ul class="breadcrumb">
              <li><a href="{{route('staff.dashboard')}}">Dashboard</a></li>
              <li><a href="#">Assignment</a></li>
                <li><a href="#">Feedback</a></li>
            </ul>
        </div>
            <div class="row">
              <div class="my-cources col-lg-12 col-sm-12 com-xs-12">
                  <div class="cource-content">
                    <h3>Assignment and Feedback</h3>
                    <button class="js-sidebar-expand" id="collapse-btn">
                      <i id="nav-btn" class="fas fa-bars left"></i>
                  </button>
                    <div class="" id="feedback-wrapper">
                      <nav id="feedback-sidebar-wrapper" class="feedback-sidebar-wrapper" >
                       <ul class="feedback-nav">
                         <div class="cources-header">
                           <h5>Courses Name</h5>
                         </div>
                         @foreach($courses as $row)
                         <li class="sub-menu" data-id="{{$row['courses_id']}}">
                           <a href="#" ></i><span>{{$row['CourseName']}}</span> <i class="fas fa-caret-down" style="float:right;font-size:22px;"></i></a>
                           <ul id="{{$row['courses_id']}}">
                          </ul>
                         </li>
                         @endforeach
                        </ul>
                    </nav>
                    <div class="feedback-content" id="feedback-content-wrapper">
                    <table id="feedback-table" class="table table-bordered">
                      <thead>
                       <tr>
                         <th>Student Name</th>
                         <th>Due Date</th>
                         <th>Submited Date</th>
                         <th>Feedback</th>
                         <th>Grade</th>
                       </tr>
                     <thead>
                       <tbody id="assignment_body">

                       </tbody>
                     </table>
                    </div>
                    </div>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
});

</script>

<script type="text/javascript">
$('.sub-menu').click(function(){
var myId = $(this).data('id');
    $.ajax({
       type:'get',
       url:'/staff/getassignmentId',
       dataType: "json",
       data:{id:myId},
       success:function(data){
         var val=data[0];
         console.log(val);
           $('#'+data[1]+'').empty();
            $.each(data[0], function(j, v){
                  $('#'+data[1]+'').append('<li><a href="#" data-val="'+v['cources_id']+'" onClick="myFunction('+v['id']+','+v['studentId']+')">'+v['title']+'</a></li>');
            });
    }
    });

})
  $("#collapse-btn").click(function(){
    const $wrapper = document.querySelector('#feedback-wrapper');
      $wrapper.classList.toggle('collapsed');
      if($("#feedback-wrapper").hasClass('collapsed')) {
      $("#nav-btn").removeClass("left");
      $("#nav-btn").addClass("right");
  } else {
    $("#nav-btn").removeClass("right");
    $("#nav-btn").addClass("left");
  }
  });
  function myFunction(id,studentId){
    $.ajax({
       type:'get',
       url:'/staff/getassignmentlist',
       dataType: "json",
       data:{id:id,studentId:studentId},
       success:function(data){
        $('#assignment_body').empty();
          var status;
         $.each(data[0], function(j, v){
            if(v['feedback_status']==="0"){
              status='<a class="btn btn-info" href="/staff/makefeedback/'+v['assignList_id']+'">Make</a>'
              $('#assignment_body').append('<tr><th>'+v['Name']+'</th><th>'+v['due_date']+'</th><th>'+v['submittedDate']+'</th><th>'+status+'</th><th>'+' '+'/'+v['max_grade']+'</th></tr>');
            }
        });
        $.each(data[2], function(j, v){
           if(v['feedback_status']==="1"){
             status='<button class="btn btn-success" disabled>Graded</button>'
             $('#assignment_body').append('<tr><th>'+v['Name']+'</th><th>'+v['due_date']+'</th><th>'+v['submittedDate']+'</th><th>'+status+'</th><th>'+v['grade']+'/'+v['max_grade']+'</th></tr>');
           }
       });
    }
    });
  }
</script>
