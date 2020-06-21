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
      <table id="student-table" class="table table-bordered" style="width:100%">
        <thead>
       <tr>
         <th>Student Id</th>
         <th>Name</th>
          <th>Address</th>
         <th>Email</th>
         <th>Phone No</th>
         <th>View</th>
       </tr>
     <thead>
       <tbody>

           @foreach($student as $row)
           <tr>
           <td>{{$row['username']}}</td>
          <td>{{$row['Name']}}</td>
          <td>{{$row['Address']}}</td>
            <td>{{$row['email']}}</td>
         <td>{{$row['PhoneNo']}}</td>
         <td>
           <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#showstaff{{$row['studentId']}}">  <i class="fas fa-eye"></i></a>

           <div class="modal" id="showstaff{{$row['studentId']}}" role="dialog">
             <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Student Info</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   </div><div class="container"></div>
                   <div class="modal-body">

                     <div class="container emp-profile">
                        <div class="row">
                          <div class="col-md-4">
                            <div class=" light bordered profile-sidebar-portlet">
                              <div class="profile-img">
                                @if($row['image']!="")
                                <?php $file = explode('/public', $row['image']);
                                ?>
                                <img class="rounded-circle" style="height:170px;" src="{{URL::asset($file[1])}}">
                                @else
                                <img class="rounded-circle" src="https://cdn0.iconfinder.com/data/icons/avatars-3/512/avatar_hipster_guy-512.png">
                                @endif
                              </div>
                              <div class="profile-head">
                                <div class="profile-usertitle-name">{{$row['Name']}} </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8">

                            <div class="right-content light bordered details">
                                <div class="row" style="">
                                  <div class="col-md-12">
                                    <div class="portlet-title tabbable-line" >
                                        <div class="caption-md">
                                          <div class="row">
                                            <div class="details-container">
                                              <div class="col-md-6">
                                                <span>Student Id:</span>
                                              </div>
                                              <div class="col-md-6">
                                                <i>{{$row['studentId']}}</i>
                                              </div>
                                            </div>

                                          </div>
                                          <div class="row">
                                            <div class="details-container">
                                              <div class="col-md-6">
                                                <i>Email:</i>
                                              </div>
                                              <div class="col-md-6">
                                                <i>{{$row['email']}}</i>
                                              </div>
                                            </div>

                                          </div>
                                          <div class="row">
                                            <div class="details-container">
                                              <div class="col-md-6">
                                                <i>Phone No:</i>
                                              </div>
                                              <div class="col-md-6">
                                                <i>{{$row['PhoneNo']}}</i>
                                              </div>
                                            </div>

                                          </div>
                                          <div class="row">
                                            <div class="details-container">
                                              <div class="col-md-6">
                                                <i>Address:</i>
                                              </div>
                                              <div class="col-md-6">
                                                <i>{{$row['Address']}}</i>
                                              </div>
                                            </div>

                                          </div>
                                          <div class="row">
                                            <div class="details-container">
                                              <div class="col-md-6">
                                                <span>Date Of Birth:</span>
                                              </div>
                                              <div class="col-md-6">
                                                <i>{{$row['dateofbirth']}}</i>
                                              </div>
                                            </div>

                                          </div>
                                          </div>
                                    </div>
                                  </div>
                                <div class="row">

                                </div>

                                </div>
                            </div>
                            <div class="right-content  light bordered delete-record">
                                <div class="row" style="">
                                  <div class="col-md-12">
                                    <div class="portlet-title tabbable-line" >
                                      <a data-toggle="modal" href="#showdeletestaff{{$row['studentId']}}" class="btn btn-danger">Delete</a>
                                    </div>
                                  </div>
                                </div>

                            </div>
                          </div>
                        </div>
                     </div>
                   </div>
                   <div class="modal-footer">
                     <a href="#" data-dismiss="modal" class="btn">Close</a>
                   </div>
                 </div>
               </div>
            </div>
            <div class="modal" id="showdeletestaff{{$row['studentId']}}" data-backdrop="static">
              	<div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Delete User {{$row['Name']}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      </div><div class="container"></div>
                      <div class="modal-body">
                          <p>Are you sure want to delete the user??</p>

                      </div>
                      <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn">Close</a>

                        <form class="" action="{{route('admin.deletestudent',$row['studentId'])}}" method="get">
                          <button type="submit" name="button" class="btn btn-danger">Ok</button>
                        </form>

                      </div>
                    </div>
                  </div>
                </div>

         </td>
         </td>
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


<!-- Bootstrap 4 -->
<script type="text/javascript">
.modal:nth-of-type(even) {
  z-index: 1052 !important;
}
.modal-backdrop.show:nth-of-type(even) {
  z-index: 1051 !important;
}

</script>
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
  $('#student-table').dataTable();
  });
</script>
</body>
</html>
