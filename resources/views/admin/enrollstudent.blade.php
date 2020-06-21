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

      <div class="row" style="padding:10px;">
        @if(count($student)!=0)
        <table>
          <thead>
         <tr>
           <th>Id</th>
           <th>Name</th>
            <th>Address</th>
           <th>Email</th>
           <th>Phone No</th>
           <th>View</th>
         </tr>
       <thead>
       <tbody>
           @foreach($student as $row)
           @if($row['status']==0)
           <tr>
           <td>{{$row['studentId']}}</td>
          <td>{{$row['Name']}}</td>
          <td>{{$row['Address']}}</td>
            <td>{{$row['email']}}</td>
         <td>{{$row['PhoneNo']}}</td>
         <td>
           <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#showstaff{{$row['studentId']}}">  <i class="fas fa-eye"></i></a>

           <div class="modal" id="showstaff{{$row['studentId']}}" role="dialog">
             <div class="modal-dialog modal-xl">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Staff Info</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   </div><div class="container"></div>
                   <div class="modal-body">

                     <div class="container emp-profile">
                        <div class="row">
                          <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class=" light bordered profile-sidebar-portlet">
                              <div class="profile-img" style="margin:0px;padding:0px;">
                                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                              </div>
                              <div class="profile-head">
                                <div class="profile-usertitle-name">{{$row['Name']}} </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-12 col-sm-12">
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
                                      <form class="" action="{{route('admin.student.approve',$row['studentId'])}}" method="get" style="display: inline-block;">
                                        <button type="submit" name="button" class="btn btn-primary">Approve</button>
                                      </form>
                                    <a data-toggle="modal" href="#declinestudent{{$row['studentId']}}" class="btn btn-danger" style="display: inline-block;">Decline</a>
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

                <div class="modal" id="declinestudent{{$row['studentId']}}" data-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Cancel User {{$row['Name']}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          </div><div class="container"></div>
                          <div class="modal-body">
                              <p>Are you sure want to cancel the enrollement??</p>

                          </div>
                          <div class="modal-footer">
                            <a href="#" data-dismiss="modal" class="btn">Close</a>

                            <form class="" action="{{route('admin.student.decline',$row['studentId'])}}" method="get">
                              <button type="submit" name="button" class="btn btn-danger">Ok</button>
                            </form>

                          </div>
                        </div>
                      </div>
                    </div>

         </td>
         </td>
        </tr>
        @endif
          @endforeach
       </tbody>
      </table>
      @else
      <span style="padding:10px;">No new enrollement <a href="{{route('admin.studentList')}}">View Student List</a></span>
    @endif
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
<script type="text/javascript">
$(document).ready(function(){
  $('.sub-menu .studentsub').show();
  $('.sub-menu .stffsub').hide();
});
</script>
</body>
</html>
