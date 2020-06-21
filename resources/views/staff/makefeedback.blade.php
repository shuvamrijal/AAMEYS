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
                <li><a href="#">Assignment List</a></li>
                <li><a href="#">Feedback</a></li>
            </ul>
        </div>
            <div class="row">
              <div class="my-cources col-lg-12 col-sm-12 com-xs-12">
                  <div class="cource-content">
                    <h3>Feedback</h3>
                    <form class="" action="{{route('staff.createfeedback')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="row makefeedback-wrapper">
                        @foreach($assignList as $row)
                          <div class="feedback_info col-lg-6">
                            <ul>
                                <input type="hidden" class="form-control" name="assign_id" value="{{$row['assign_id']}}" readonly>
                              <li><label for="">Course Name</label>
                                  <div class="col-lg-12">
                                      <input type="text" class="form-control" name="" value="{{$row['CourseName']}}" readonly>
                                  </div>
                                  <label for="">Student Name</label>
                                      <div class="col-lg-12">
                                        <input type="hidden" class="form-control" name="student_id" value="{{$row['studentId']}}" readonly>
                                        <input type="text" class="form-control" name="" value="{{$row['Name']}}" readonly>
                                      </div>
                              </li>
                              <li><label for="">Submited Date</label>
                                  <div class="col-lg-12">
                                      <input type="text" class="form-control" name="" value="{{$row['submittedDate']}}" readonly>
                                  </div>
                                  <label for="">Submitted File </label>
                                      <div class="col-lg-12">
                                        @if($row['submittedFile']!="")
                                          <?php
                                          $file_value=json_decode($row['submittedFile']);
                                          foreach ($file_value as $key => $file_value) {
                                            $file = explode('/public', $file_value->filename);
                                            $filename = explode('/public/resources/submitted/', $file_value->filename);
                                            ?>
                                            <a href="{{$file['1']}}" download><i>{{$filename['1']}}</i> </a>
                                            <?php
                                            }
                                           ?>
                                        @endif
                                      </div>
                              </li>
                            </ul>

                          </div>
                          <div class="feedback_content col-lg-6">
                            <ul>
                              <li>
                                <div class="row">
                                  <div class="col-lg-6">
                                      <label for="">Grade</label>
                                      <div class="" style="padding:10px">
                                        <input type="text"  class="form-control" name="grade" value="" required >
                                      </div>
                                    </div>
                                  <div class="col-lg-6"  >
                                    <label for="">Max Grade</label>
                                    <div class=""  style="padding:10px">
                                      <input type="text" class="form-control" name="" value="{{$row['max_grade']}}" readonly>
                                    </div>
                                  </div>
                                </div>
                                 </li>
                              <li>
                              <label for="">Comment</label>
                              <div class="comment">
                                  <textarea  class="form-control" name="comment" rows="6" cols="70" required></textarea>
                              </div>
                              </li>
                              <li>
                                <div class="form-group"  style="padding:10px">
                                    <label for="formGroupExampleInput">Feedback File:</label>
                                    <div class="preview-zone">
                                        <div class="box box-solid">
                                          <div class="box-body">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="dropzone-wrapper">
                                        <div class="dropzone-desc">
                                          <i class="glyphicon glyphicon-download-alt"></i>
                                          <p>Choose a file or drag it here.</p>
                                        </div>
                                        <input type="file" name="files[]" id="collection" multiple class="dropzone-multi"  required/><br/>
                                      </div>
                                      <div class="" id="output" style="padding:10px;">
                                      </div>
                                </div>
                              <div class="" style="padding:10px">
                                <button type="submit" class="col-lg-2 btn btn-primary"  name="button">Save</button>
                                <button type="Cancel" class="col-lg-2 btn btn-danger"  name="button">Cancel</button>
                              </div>
                                </li>
                            </ul>

                          </div>

                      </div>
                    </form>

                </div>

              </div>
              @endforeach

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
  $('#feedback-table').dataTable({
     "ordering": false
  });
  });
</script>
<script type="text/javascript">
document.getElementById("collection").onchange = function(){
    var counter = -1, file;
    while ( file = this.files[ ++counter ] ) {
        var reader = new FileReader();
        reader.onloadend = (function(file){
            return function(){
              file.name;
              var htmlPreview ='<p>' + file.name + '</p>';
                $('#output').append(htmlPreview);
            }

        })(file);

        reader.readAsDataURL( file );

    }

}
</script>
