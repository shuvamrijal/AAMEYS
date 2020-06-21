<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    @if(Auth::guard('student')->check())
      @include('student.includes.head')
    @elseif(Auth::guard('staff')->check())
      @include('staff.includes.head')
    @endif
    <title>Dashboard</title>
  </head>
  <body>
    <div  id="wrapper" class="toggled">
      @if(Auth::guard('student')->check())
        @include('student.includes.navbar')
      @elseif(Auth::guard('staff')->check())
        @include('staff.includes.navbar')
      @endif
      @if(Auth::guard('student')->check())
          @include('student.includes.sidebar')
      @elseif(Auth::guard('staff')->check())
          @include('staff.includes.sidebar')
      @endif
      <div class="container-fluid" id="body-section" style="">
        <div class="row">
            <ul class="breadcrumb">
              <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
            </ul>
        </div>
            <div class="row">
              <div class="my-cources">

                <form class="" action="{{route('student.submitassignment')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="assign_id" value="{{$assign['id']}}">
                  <div class="cource-content">
                  <h3>{{$assign['title']}} </h3>
                      <div class="row" style="padding:5px;">
                        <div class="assign_content col-lg-12">
                            <p>{{$assign['content']}}</p>
                        </div>
                        <div class="assign_details col-lg-12">
                          <p>The details for Assignment 1 are: </p>
                           @if($assign['attachment']!="")
                           <?php $file = explode('/public', $assign['attachment']);
                           ?>
                           <?php $filename = explode('/public/resources/assignment/', $assign['attachment']);
                           ?>
                           <a href="{{$file['1']}}" download><i>{{$filename['1']}}</i> </a>
                           @endif
                        </div>
                      </div>
                      <div class="row" style="padding:20px;margin-top:20px;">
                        @foreach($cor as $row)
                              <input type="hidden" name="staff_id" value="{{$row['staff_id']}}">
                              <input type="hidden" name="cources_id" value="{{$row['cources_id']}}">
                        @endforeach
                          <h4>Submission status</h4>
                          <div class="col-lg-12">
                            <table class="table table-striped">
                                <tr>
                                  <td style="width:300px;">Submission status</td>
                                    <?php
                                    if(count($submit)==0){
                                      ?>
                                        <td> Not Submited</td>
                                        <?php
                                    }else{
                                      ?>
                                        <td style='background:#CFEFCF'>Submitted for Grading</td>
                                      <?php
                                    }
                                     ?>

                                </tr>
                                <tr>
                                  <td>Grading status</td>
                                  <?php
                                  $falg=0;
                                  if(count($feedback)==0){
                                    $flag=0;
                                  }
                                   ?>
                              @foreach($submit as $val)
                                  <?php
                                if($val['status']==0){
                                  $flag=0;
                                  }else{
                                    $flag=1;
                                  }
                                   ?>
                                   @endforeach
                                   <?php
                                   if($flag==0){
                                     ?>
                                         <td>Not Graded</td>
                                       <?php
                                   }else{
                                     ?>
                                       <td style="background:#CFEFCF">Graded</td>
                                     <?php
                                   }

                                    ?>
                                </tr>
                                <tr>
                                  <td>Due Date</td>
                                  <td>{{$assign['due_date']}}</td>
                                </tr>
                                <tr>
                                  <td>Time remaining</td>

                                    <?php
                                    if(count($submit)==0){
                                      $datetime1=new DateTime($assign['due_date']);
                                      $datetime2 = new DateTime();
                                      $interval = $datetime2->diff($datetime1);
                                      if($datetime1>$datetime2){
                                          echo "<td>". $interval->format('%a days')."</td>";
                                      }else{
                                        echo "<td>" .$interval->format('%R%a days')."</td>";
                                      }
                                    }else{
                                      foreach ($submit as $key => $value) {
                                        $datetime1=new DateTime($assign['due_date']);
                                        $datetime2 = new DateTime($value['submittedDate']);
                                        $interval = $datetime2->diff($datetime1);
                                        if($datetime1>$datetime2){
                                          ?>
                                            <td style="background:#CFEFCF">Assignment was submitted <?php echo $interval->format('%a days')?> early</td>
                                          <?php
                                        }else{
                                          ?>
                                            <td style="background:#CFEFCF">Assignment was submitted <?php echo $interval->format('%a days')?> late</td>
                                          <?php
                                        }
                                      }

                                    }
                                     ?>

                                </tr>
                                <tr>
                                  <td>File submissions</td>
                                  <td>
                                    <?php
                                    if(count($submit)==0){
                                      ?>
                                      <div class="form-group"  style="padding:10px">
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
                                        <?php
                                    }else{
                                      foreach ($submit as $key => $value) {
                                      $file_value=json_decode($value['submittedFile']);
                                      foreach ($file_value as $key => $file_value) {
                                        $file = explode('/public', $file_value->filename);
                                        $filename = explode('/public/resources/submitted/', $file_value->filename);
                                        ?>
                                        <a href="{{$file['1']}}" download><i>{{$filename['1']}}</i> </a>
                                        <?php
                                        }
                                      }
                                    }
                                     ?>

                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                  </td>
                                  <td style="float:right">
                                    <?php
                                    if(count($submit)==0){
                                      ?>
                                      <button type="cancel" name="button" class="btn btn-danger" style="margin:10px;">Cancel</button>
                                      <button type="submit" name="button" class="btn btn-primary" style="float:right;margin:10px;">Submit</button></td>
                                        <?php
                                    }
                                     ?>
                                  </tr>
                            </table>
                          </div>
                        </form>
                          <h4>Feedback</h4>
                          <?php
                          $falg=0;
                          if(count($feedback)==1){
                          ?>
                          <div class="col-lg-12">
                            <table class="table table-striped">
                              @foreach($feedback as $feed)
                              <tr>
                                <td style="width:300px;">Grade</td>
                                <td>{{$feed['grade']}}</td>
                              </tr>
                              <tr>
                                <td style="width:300px;">Grade On</td>
                                <td>{{$feed['gradeOn']}}</td>
                              </tr>
                              <tr>
                                <td style="width:300px;">Graded By</td>
                                <td>{{$feed['FirstName']}}&nbsp;{{$feed['LastName']}}</td>
                              </tr>
                              <tr>
                                <td>Feedback files</td>
                                <td>
                                  <?php
                                  $feedback_file_value=json_decode($feed['feedbackFile']);
                                  foreach ($feedback_file_value as $key => $file_value) {
                                    $file = explode('/public', $file_value->filename);
                                    $filename = explode('/public/resources/feedback/', $file_value->filename);
                                    ?>
                                    <a href="{{$file['1']}}" download><i>{{$filename['1']}}</i> </a>
                                    <?php
                                    }
                                   ?>

                                </td>
                              </tr>
                            @endforeach
                            </table>
                          </div>
                          <?php
                          }
                           ?>
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
