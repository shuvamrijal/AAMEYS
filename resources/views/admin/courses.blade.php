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
          <h4 class="">Courses</h4>
          <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#addmodal" class="btn btn-primary" name="button" style="float:right;padding:10px">Add New Course</button>
        </div>
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Courses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="{{route('admin.create.courses')}}" method="post">
      <div class="modal-body">
        <div class="createcourses">
            {{csrf_field()}}
            <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
                   <div class="form-group">
                     <label for="exampleInputEmail1">Courses Name</label>
                     <input type="text"  class="form-control" name="coursename" placeholder="Courses Name" required />
                     </div>
            </div>
            <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
                   <div class="form-group">
                     <label for="exampleInputEmail1">Courses Description</label>
                     <input type="text"  class="form-control" name="coursedescription" placeholder="Courses Description" required/>
                     </div>
            </div>
            <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit"  class="btn btn-primary" name="button">Save</button>
      </div>
          </form>
    </div>
  </div>
</div>
      <div class="row" style="padding:10px;">

        <div class="col-sm-12">
          <table id="cources-table" class="table table-bordered">
          <thead>
           <tr>
             <th>Id</th>
             <th>Course Name</th>
             <th>Course Description</th>
             <th>Assign Staff</th>
             <th>Action</th>
           </tr>
         <thead>
           <tbody>
               @foreach($courses as $row)
               <tr>
               <td class="cor_id">{{$row['courses_id']}}</td>
              <td>{{$row['CourseName']}}</td>
              <td>{{$row['Coursedescription']}}</td>
              <th>
                <button type="button"  class="btn btn-primary add-btn" data-toggle="modal" data-target="#add{{$row['courses_id']}}"  name="button" style="padding:10px"><i class="fas fa-plus-circle"></i></button>
                <div class="modal fade" id="add{{$row['courses_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Assign Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form class="" action="{{route('admin.assigncourses')}}" method="post">
                      <div class="modal-body">
                        <div class="createcourses">
                            {{csrf_field()}}
                            <div class="col-lg-offset-0 col-lg-10 col-xs-12 col-sm-10">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Teacher Name</label>
                                  <input type="text" name="courses_id" value="{{$row['courses_id']}}">
                                  <select name="staff_id" data-live-search="true" class="form-control selectpicker">
                                    @foreach($staff as $stff)
                                        <option value="{{$stff['staff_id']}}">{{$stff['FirstName']}} &nbsp;{{$stff['LastName']}}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="delete"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Staff</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form class="" action="{{route('admin.deleteassigncourse')}}" method="get">
                      <div class="modal-body">
                        <h5>Are you sure want to delete staff from this courses??</h5>
                        <input type="hidden" name="course_id" value="" class="delete_course_id">
                         <input type="hidden" name="staff_id" class="delete_staff_id" value="">
                            {{csrf_field()}}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
            </th>
             <td>
               <div class="courses-action">
                 <a href="" id="editbtn" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editcourses{{$row['courses_id']}}">  <i class="fas fa-pencil"></i></a>
                 <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#showdeletecourses{{$row['courses_id']}}">  <i class="fas fa-trash"></i></a>
               <div class="modal" id="editcourses{{$row['courses_id']}}" role="dialog">
                   <div class="modal-dialog modal-md">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h4 class="modal-title">Edit Courses</h4>
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
                                                <form class="" action="{{route('admin.courses.edit')}}" method="post">
                                                  <div class="form-group">
                                                    <div class="col-md-12">
                                                      <i>Courses Id:</i>
                                                    </div>
                                                    <div class="col-md-12">
                                                      <input type="text" class="form-control" name="id" value="{{$row['courses_id']}}" readonly>
                                                    </div>
                                                  </div>

                                                  <div class="form-group">
                                                    <div class="col-md-12">
                                                      <i>Course Name:</i>
                                                    </div>
                                                    <div class="col-md-12">
                                                      <input type="text" class="form-control" name="coursename" value="{{$row['CourseName']}}">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <div class="col-md-12">
                                                      <i>Course Description</i>
                                                    </div>
                                                    <div class="col-md-12">
                                                      <input type="text" class="form-control" name="coursedescription" value="{{$row['Coursedescription']}}">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <div class="col-md-12">
                                                    <button type="submit" name="button" class="btn btn-primary">Save</button>
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
               </div>

                <div class="modal" id="showdeletecourses{{$row['courses_id']}}" data-backdrop="static">
                  	<div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Delete Course "{{$row['CourseName']}}"</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          </div><div class="container"></div>
                          <div class="modal-body">
                              <p>Are you sure want to delete the courses??</p>
                          </div>
                          <div class="modal-footer">
                            <a href="#" data-dismiss="modal" class="btn">Close</a>

                            <form class="" action="{{route('admin.courses.deletecourses',$row['courses_id'])}}" method="get">
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
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
$(document).ready(function(){
  $('#cources-table').dataTable();
  });
</script>
<script type="text/javascript">
   var x = document.getElementById("cources-table").rows.length;
   for (i = 1; i < x; i++) {
     var value = document.getElementById("cources-table").rows[i].cells;
     var rowValue=value[0].innerHTML;
     $.ajax({
        type:'get',
        url:'/admin/getstaff',
        dataType: "json",
        data:{id:rowValue,row:i},
        success:function(data){
          $.each(data[0], function(j, v){
            var node = document.createElement("span");
            var textnode = document.createTextNode(v['Name']);
            node.appendChild(textnode);
            node.setAttribute('class','staff_name');
            node.innerHTML="<i>"+v['FirstName']+''+v['LastName']+"</i>";
            document.getElementById("cources-table").rows[data[1]].cells[3].appendChild(node);
            var btn = document.createElement("a");
            btn.setAttribute("href","#");
            btn.setAttribute("class","open-dialog")
            btn.setAttribute("type","button");
            btn.setAttribute("data-toggle","modal");
            btn.setAttribute("data-target","#delete");
            btn.setAttribute("data-id",v['staff_id']);
            btn.setAttribute("data-cor",v['cources_id']);
            btn.innerHTML = "X";
            node.appendChild(btn);
        });
     }
     });
   }
   $(document).on("click", ".open-dialog", function () {
     var mystaffId = $(this).data('id');
     var mycourseId = $(this).data('cor');
     $(".delete_staff_id").val(mystaffId );
     $(".delete_course_id").val(mycourseId );
       // As pointed out in comments,
       // it is unnecessary to have to manually call the modal.
       // $('#addBookDialog').modal('show');
  });
</script>
</body>
</html>
