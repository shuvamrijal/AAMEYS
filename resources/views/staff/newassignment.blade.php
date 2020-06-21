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
              <li><a href="#">Assignment</a></li>
              <li><a href="#">New Assignment</a></li>
            </ul>
        </div>
            <div class="row">
              <div class="my-cources col-lg-9 col-sm-12 com-xs-12">
                  <div class="cource-content">
                      <h3>New Assignment</h3>
                    <div class="row">
                        <form class="newassignment_form" action="{{route('staff.creatassignment')}}" method="post" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                  <label for="formGroupExampleInput">Title:</label>
                                  <input type="text" name="title" class="form-control"  placeholder="Title" required>
                                </div>
                                <div class="form-group">
                                  <label for="formGroupExampleInput">Cource Name</label>
                                  <select name="cource_id" class="form-control">
                                      <option value="" disabled selected>Select.....</option>
                                    @foreach($courses as $row)
                                        <option value="{{$row['courses_id']}}">{{$row['CourseName']}}</option>
                                    @endforeach

                                  </select>
                                  </div>
                              <div class="form-group">
                                <label for="formGroupExampleInput">Due Date</label>
                                <input type="datetime-local" class="form-control"  name="due_date" placeholder="Example input" value="{{date('Y-m-d\Th:i')}}" min='{{date('Y-m-d\Th:i')}}'>
                              </div>
                              <div class="form-group">
                                <label for="formGroupExampleInput">Grade Category</label>
                                <select name="gradecategory" class="form-control">
                                  <option value="" disabled selected>Select.....</option>
                                  <option value="Number">Number</option>
                                  <option value="Char">Char</option>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Max Grade:</label>
                                    <input type="text" class="form-control" name="max_grade" placeholder="Max grade" required>
                                  </div>
                            </div>
                          <div class="col">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Content:</label>
                                <textarea  class="form-control" name="content" rows="8" cols="80" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Upload File:</label>
                                <div class="preview-zone hidden">
                                    <div class="box box-solid">
                                      <div class="box-header with-border">
                                        <div><b>Preview</b></div>
                                        <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-danger btn-xs remove-preview">
                                            <i class="fa fa-times"></i> Reset This Form
                                          </button>
                                        </div>
                                      </div>
                                      <div class="box-body"></div>
                                    </div>
                                  </div>
                                  <div class="dropzone-wrapper">
                                    <div class="dropzone-desc">
                                      <i class="glyphicon glyphicon-download-alt"></i>
                                      <p>Choose a file or drag it here.</p>
                                    </div>
                                    <input type="file" name="attachment" class="dropzone" required>
                                  </div>
                            </div>
                            <div class="form-group" style="float:right">
                                  <div class="row">
                                    <button type="cancel" class="btn btn-danger" name="button">Cancel</button>
                                    <button type="submit" class="btn btn-primary" name="button" style="">Save</button>
                                  </div>

                              </div>


                            </div>
                          </div>
                          </div>


                        </form>
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
                  <h5>Upcoming Evetnst</h5>
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
$(document).ready(function(){
  $('#assignment_table').dataTable();
  });
</script>
