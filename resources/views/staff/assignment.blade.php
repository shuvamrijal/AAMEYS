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

            </ul>
        </div>
            <div class="row">
              <div class="my-cources col-lg-12 col-sm-12 com-xs-12">
                  <div class="cource-content">
                    <div class="title">
                      <h3>Assignment</h3>
                      <a type="button" href="{{route('staff.newassignment')}}" class="btn btn-primary" name="button"><i class="fas fa-plus-circle"></i> &nbsp; Add New Assignment</a>
                    </div>

                    <div class="row">
                        <table class="table table-bordered" id="assignment_table" style="margin:0;padding:0px">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Title</th>
                              <th>Cource Name</th>
                              <th>Due Date</th>
                              <th>Max Grade</th>
                              <th>Attachemnt</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($assignment as $row)
                            <tr>
                              <td>{{$row['id']}}</td>
                              <td>{{$row['title']}}</td>
                              <td>{{$row['CourseName']}}</td>
                              <td>{{$row['due_date']}}</td>
                              <td>{{$row['max_grade']}}</td>
                              <td>
                                <?php $file = explode('/public', $row['attachment']);
                                ?>
                                <?php $filename = explode('/public/resources/assignment/', $row['attachment']);
                                ?>
                                <a href="{{$file['1']}}" download>{{$filename[1]}}</a>
                              </td>
                              <td>
                                <a href=""  class="btn btn-primary" data-toggle="modal" data-target="#showassignment{{$row['id']}}"><i class="far fa-edit"></i></a>
                                <div class="modal" id="showassignment{{$row['id']}}" data-backdrop="static">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title">Edit Assignment</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                          </div><div class="container"></div>
                                          <div class="modal-body">
                                            <form  class="newassignment_form" action="{{route('staff.editassignment')}}" method="post" enctype="multipart/form-data">
                                              {{csrf_field()}}
                                              <input type="hidden" name="id" value="{{$row['id']}}">
                                              <div class="row">
                                                <div class="col">
                                                  <div class="form-group">
                                                      <label for="formGroupExampleInput">Title:</label>
                                                      <input type="text" name="title" class="form-control"  value="{{$row['title']}}" placeholder="Title">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="formGroupExampleInput">Cource Name</label>
                                                      <select name="cource_id" class="form-control">
                                                          <option value="{{$row['cources_id']}}" selected>{{$row['CourseName']}}</option>
                                                          @foreach($courses as $cor)
                                                              <option value="{{$cor['courses_id']}}">{{$cor['CourseName']}}</option>
                                                          @endforeach
                                                      </select>
                                                      </div>
                                                  <div class="form-group">
                                                    <label for="formGroupExampleInput">Due Date</label>
                                                      <?php
                                                      $value= date('Y-m-d\Th:i', strtotime($row['due_date']));
                                                      echo($value);  ?>
                                                    <input type='datetime-local' class="form-control" name='due_date' value='<?php echo($value); ?>' min='{{date('Y-m-d\Th:i')}}' >
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="formGroupExampleInput">Grade Category</label>
                                                    <select name="gradecategory" class="form-control">
                                                      <option value="{{$row['grade_category']}}"  selected>{{$row['grade_category']}}</option>
                                                      <option value="Number">Number</option>
                                                      <option value="Char">Char</option>
                                                    </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="formGroupExampleInput">Max Grade:</label>
                                                        <input type="text" class="form-control" name="max_grade" placeholder="Max grade" value="{{$row['max_grade']}}">
                                                      </div>
                                                </div>
                                              <div class="col">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Content:</label>
                                                    <textarea  class="form-control" name="content" rows="8" cols="80">{{$row['content']}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Upload File:</label>
                                                    <div class="preview-zone">
                                                        <div class="box box-solid">
                                                          <div class="box-header with-border">
                                                            <div><b>Preview</b></div>
                                                            <div class="box-tools pull-right">
                                                              <button type="button" class="btn btn-danger btn-xs remove-preview">
                                                                <i class="fa fa-times"></i> Reset This Form
                                                              </button>
                                                            </div>
                                                          </div>
                                                          <div class="box-body">
                                                            <?php $file = explode('/public', $row['attachment']);
                                                            ?>
                                                            <?php $filename = explode('/public/resources/assignment/', $row['attachment']);
                                                            ?>
                                                            <a href="{{$file['1']}}" download>{{$filename[1]}}</a>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="dropzone-wrapper">
                                                        <div class="dropzone-desc">
                                                          <i class="glyphicon glyphicon-download-alt"></i>
                                                          <p>Choose a file or drag it here.</p>
                                                        </div>
                                                        <input type="file" name="attachment" class="dropzone">
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
                                          <div class="modal-footer">
                                            <a href="#" data-dismiss="modal" class="btn">Close</a>

                                            <form class="" action="" method="get">
                                              <button type="submit" name="button" class="btn btn-danger">Ok</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>


                                <a data-toggle="modal" href="#delteassignment{{$row['id']}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                <div class="modal" id="delteassignment{{$row['id']}}" data-backdrop="static">
                                  	<div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title">Delete Assignment</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                          </div><div class="container"></div>
                                          <div class="modal-body">
                                              <p>Are you sure want to delete this assignment??</p>

                                          </div>
                                          <div class="modal-footer">
                                            <a href="#" data-dismiss="modal" class="btn">Close</a>

                                            <form class="" action="{{route('staff.deleteassignment',$row['id'])}}" method="get">
                                              <button type="submit" name="button" class="btn btn-danger">Ok</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                          </tbody>
                      </table>
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
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function(){
  $('#assignment_table').dataTable();
  });
</script>
