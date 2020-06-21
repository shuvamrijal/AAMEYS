<!DOCTYPE html>
<html>
<head>
@include('admin.includes.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="wrapper">
  @include('admin.includes.sidebar')
  @include('admin.includes.navbar')
    <!-- Main content -->
    <section id="content-wrapper" class="content">
      <div class="container">
        <div class="slist-title">
          <h4 class="">Enrolled Student List</h4>
        </div>

      <div class="" style="margin-top:25px;">
      <table id="enroll-table" class="table table-bordered" style="width:100%">
        <thead>
       <tr>

         <th>Id</th>
         <th>Student Name</th>
          <th>Course Name</th>
         <th>Status</th>
       </tr>
     <thead>
       <tbody>
         @foreach($courses as $row)
         <tr>
           <td>{{$row['enrollId']}}</td>
           <td>{{$row['Name']}}</td>
           <td>{{$row['CourseName']}}</td>
           <?php
           if($row['enroll_status']==0){
           ?>
           <form class="" action="{{route('change_enrollStatus',$row['enrollId'])}}" method="get">
             <td style="width:120px;">
               <button type="submit" name="button" class="btn btn-success btn-md" style="width:100%">Enroll</button>
             </td>
           </form>
           <?php
         }
           else{
             ?>
             <td style="width:120px;">
               <button type="button" name="button" class="btn btn-success btn-md" style="width:100%" disabled>Enrolled</button>
             </td>
          ?>
          <?php

           }
            ?>
         </tr>
         @endforeach

       </tbody>
      </table>

      </div>

    </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include('admin.includes.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/admin.js') }}"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $('.sub-menu .studentsub').show();
  $('.sub-menu .stffsub').hide();
});
</script>
<script>
$(document).ready(function(){
  $('#enroll-table').dataTable();
  });
</script>
</body>
</html>
