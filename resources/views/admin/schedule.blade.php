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
          <h4 class="">Schedule</h4>
        </div>
      <div class="row" style="padding:5px;">
        <div class="col-sm-12">
          <div class="createschedule">
            <form class="" action="{{route('admin.create.schedule')}}" method="post">
              {{csrf_field()}}
              <div class="row">
                <div class="col-lg-offset-1 col-lg-6 col-xs-12 col-sm-6">
                       <div class="form-group">
                         <label for="exampleInputEmail1">Courses Name</label>
                         <select id='country_select'  class="form-control" name='courseid'>
                      <option value="" disabled selected>Select Courses</option>
                       @foreach($courses as $row)
                       <option value="{{$row['courses_id']}}">{{$row['CourseName']}}</option>
                       @endforeach
                     </select>
                         </div>
                </div>
                <div class="col-lg-offset-1 col-lg-6 col-xs-12 col-sm-6">
                       <div class="form-group">
                        <label for="exampleInputEmail1">Staff Name</label>
                        <select id='country_select'  class="form-control"  name='staffid'>
                       <option value="" disabled selected>Select Staff</option>
                       @foreach($staff as $row)
                       <option value="{{$row['staff_id']}}">{{$row['FirstName']}}&nbsp;{{$row['LastName']}}</option>
                       @endforeach
                     </select>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-offset-1 col-lg-3 col-xs-12 col-sm-3">
                       <div class="form-group">
                         <label for="exampleInputEmail1">Class Start Time</label>
                         <input type="time"  class="form-control" name="starttime" placeholder="Courses Description" required/>
                         </div>
                </div>
                <div class="col-lg-offset-1 col-lg-3 col-xs-12 col-sm-3">
                       <div class="form-group">
                         <label for="exampleInputEmail1">Class End Time</label>
                         <input type="time"  class="form-control" name="endtime" placeholder="Courses Description" required/>
                        </div>
                </div>
                <div class="col-lg-offset-1 col-lg-6 col-xs-12 col-sm-6">
                       <div class="form-group">
                         <label for="exampleInputEmail1">Class Day</label>
                         <select class="form-control" name="days">
                        <option value="" disabled selected>Select Day</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                         </select>
                        </div>
                </div>
              </div>
              <div class="row">
              <div class="col-lg-offset-1 col-lg-2 col-xs-12 col-sm-2">

                     <button type="submit"  class="btn btn-primary" name="button" style="width:100%">Save</button>
              </div>
            
              </div>
            </form>
          </div>
        </div>

        <div class="col-sm-12 scheduleList">
          <table>
          <thead>
           <tr>
             <th>Id</th>
             <th>Course Name</th>
             <th>Staff Name</th>
             <th>Start Time</th>
             <th>End Time</th>
              <th>Day</th>
             <th>Action</th>
           </tr>
         <thead>
           <tbody>
              @foreach($schedule as $row)
              <tr>
               <td>{{$row['id']}}</td>
              <td>{{$row['CourseName']}}</td>
              <td>{{$row['FirstName']}}&nbsp;{{$row['LastName']}}</td>
              <td>{{$row['Start_time']}}</td>
              <td>{{$row['End_time']}}</td>
              <td>{{$row['DaysOfWeek']}}</td>
             <td>
               <div class="courses-action">
                 <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#deleteschedule{{$row['schedules_id']}}">  <i class="fas fa-trash"></i></a>

                 <a href="" id="editbtn" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editschedule{{$row['schedules_id']}}">  <i class="fas fa-pencil"></i></a>
                 <div class="modal" id="editschedule{{$row['schedules_id']}}" role="dialog">
                   {{$row['schedules_id']}}
                     <div class="modal-dialog modal-lg  ">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h4 class="modal-title">Edit Schedule</h4>
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           </div><div class="container"></div>
                           <div class="modal-body">
                             <div class="container emp-profile">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="right-content light bordered details">
                                        <div class="row" style="">
                                          <div class="col-md-12">
                                            <div class="portlet-title tabbable-line" >
                                                <div class="caption-md">
                                                  <form class="" action="{{route('admin.schedule.edit')}}" method="post">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" value="{{$row['id']}}">
                                                    <div class="row">
                                                      <div class="col-lg-offset-1 col-lg-6 col-xs-12 col-sm-6">
                                                             <div class="form-group">
                                                               <label for="exampleInputEmail1">Courses Name</label>
                                                               <select id='country_select'  class="form-control" name='courseid'>
                                                             <option value="{{$row['courses_id']}}"  selected>{{$row['CourseName']}}</option>
                                                             @foreach($courses as $cor)
                                                             <option value="{{$cor['courses_id']}}">{{$cor['CourseName']}}</option>
                                                             @endforeach
                                                           </select>
                                                               </div>
                                                      </div>
                                                      <div class="col-lg-offset-1 col-lg-6 col-xs-12 col-sm-6">
                                                             <div class="form-group">
                                                              <label for="exampleInputEmail1">Staff Name</label>
                                                              <select id='country_select'  class="form-control"  name='staffid'>
                                                                <option value="{{$row['staff_id']}}"  selected>{{$row['FirstName']}}&nbsp;{{$row['LastName']}}</option>
                                                             @foreach($staff as $sta)
                                                             <option value="{{$sta['staff_id']}}">{{$sta['FirstName']}}&nbsp;{{$sta['LastName']}}</option>
                                                             @endforeach
                                                           </select>
                                                      </div>
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-lg-offset-1 col-lg-3 col-xs-12 col-sm-3">
                                                             <div class="form-group">
                                                               <label for="exampleInputEmail1">Class Start Time</label>
                                                               <input type="time" value="{{$row['Start_time']}}" class="form-control" name="starttime" placeholder="Courses Description" required/>
                                                               </div>
                                                      </div>
                                                      <div class="col-lg-offset-1 col-lg-3 col-xs-12 col-sm-3">
                                                             <div class="form-group">
                                                               <label for="exampleInputEmail1">Class End Time</label>
                                                               <input type="time" value="{{$row['End_time']}}" class="form-control" name="endtime" placeholder="Courses Description" required/>
                                                              </div>
                                                      </div>
                                                      <div class="col-lg-offset-1 col-lg-6 col-xs-12 col-sm-6">
                                                             <div class="form-group">
                                                               <label for="exampleInputEmail1">Class Day</label>
                                                               <select class="form-control" name="days">
                                                              <option value="{{$row['DaysOfWeek']}}"  selected>{{$row['DaysOfWeek']}}</option>
                                                              <option value="Monday">Monday</option>
                                                              <option value="Tuesday">Tuesday</option>
                                                              <option value="Wednesday">Wednesday</option>
                                                              <option value="Thursday">Thursday</option>
                                                              <option value="Friday">Friday</option>
                                                              <option value="Saturday">Saturday</option>
                                                              <option value="Sunday">Sunday</option>
                                                               </select>
                                                              </div>
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-lg-offset-1 col-lg-2 col-xs-12 col-sm-2">

                                                           <button type="submit"  class="btn btn-primary" name="button" style="width:100%">Save</button>
                                                    </div>
                                                    <div class="col-lg-offset-1 col-lg-2 col-xs-12 col-sm-2">

                                                           <button type="cancel"  class="btn btn-default" name="button" style="width:100%">Cancel</button>
                                                    </div>
                                                    </div>
                                                  </form>
                                                  </div>
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
                 <div class="modal" id="deleteschedule{{$row['schedules_id']}}" data-backdrop="static">
                    <div class="modal-dialog">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h4 class="modal-title">Delete Schedule</h4>
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           </div><div class="container"></div>
                           <div class="modal-body">
                               <p>Are you sure want to delete the courses??</p>
                           </div>
                           <div class="modal-footer">
                             <a href="#" data-dismiss="modal" class="btn">Close</a>
                             <form class="" action="{{route('admin.schedule.deleteschedule',$row['id'])}}" method="get">
                               <button type="submit" name="button" class="btn btn-danger">Ok</button>
                             </form>
                           </div>
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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/admin.js') }}"></script>
</body>
</html>
