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
          <h4 class="">Staff List</h4>
          <a type="button" name="button" href="{{route('admin.staff')}}" class='btn btn-primary' style="margin: 0px;padding: 10px;float:right;background:#0069D9;color:#ffffff">Add New Staff</a>
        </div>

<div class="" style="margin-top:25px;">
      <table id="staff-table" class="table table-bordered">
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
           @foreach($staff ?? '' as $row)
           <tr>
           <td>{{$row['staff_id']}}</td>
          <td>{{$row['FirstName']}} {{$row['LastName']}}</td>
          <td>  {{$row['street']}}, {{$row['city']}}, {{$row['state']}},{{$row['postcode']}}, {{$row['country']}}
          </td>
            <td>{{$row['email']}}</td>
         <td>{{$row['PhoneNo']}}</td>
         <td>
           <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#showstaff{{$row['staff_id']}}">  <i class="fas fa-eye"></i></a>

           <div class="modal" id="showstaff{{$row['staff_id']}}" role="dialog">
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
                            <div class="light bordered profile-sidebar-portlet" style="margin-top:20px;" >
                              <div class="uploadImage">
                                @if($row['image']!="")
                                <?php $file = explode('/public', $row['image']);
                                ?>
                                <img src="{{URL::asset($file[1])}}" style="margin:auto;height:300px;width:280px;" id="uploadImage" class="rounded-circle"/>
                                @else
                                <img  id="uploadImage" src="{{URL::asset('/images/default.jpg')}}" alt="" style="margin:auto;height:300px;width:280px;"/>
                                @endif
                              </div>
                              <div class="profile-head">
                                <div class="profile-usertitle-name">{{$row['FirstName']}}{{$row['LastName']}} </div>
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
                                                <span>Staff Id:</span>
                                              </div>
                                              <div class="col-md-6">
                                                <i>{{$row['staff_id']}}</i>
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
                                                <i>{{$row['street']}}, {{$row['city']}}, {{$row['state']}},{{$row['postcode']}}, {{$row['country']}}</i>
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
                                      <a data-toggle="modal" href="#showdeletestaff{{$row['staff_id']}}" class="btn btn-danger">Delete</a>
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
            <div class="modal" id="showdeletestaff{{$row['staff_id']}}" data-backdrop="static">
              	<div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Delete User {{$row['FirstName']}}{{$row['LastName']}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      </div><div class="container"></div>
                      <div class="modal-body">
                          <p>Are you sure want to delete the user??</p>

                      </div>
                      <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn">Close</a>

                        <form class="" action="{{route('admin.staff.deleteStaff',$row['staff_id'])}}" method="get">
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
  $('.sub-menu .studentsub').hide();
  $('.sub-menu .stffsub').show();
});
</script>

<script>
$(document).ready(function(){
  $('#staff-table').dataTable();
  });
</script>
</body>
</html>
