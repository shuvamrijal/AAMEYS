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
          <h4 class="">Resources</h4>
        </div>
      <div class="row" style="padding:5px;">
        <div class="col-sm-12">
          <div class="createschedule">
            <form class="" action="{{route('admin.create.resources')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="row">
                <div class="col-lg-offset-1 col-lg-6 col-xs-12 col-sm-12">
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
                <div class="col-lg-offset-1 col-lg-6 col-xs-12 col-sm-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Resources Name(Week/Month/Year)</label>
                    <input type="text"  class="form-control" name="resname" placeholder="Courses Name" required/>
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12 col-sm-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Resources Description</label>
                    <textarea name="resdesc"  class="form-control"  rows="8" cols="80"></textarea>

                    </div>
                </div>
                </div>
              <div class="row">
                <div class="col-lg-offset-1 col-lg-3 col-xs-12 col-sm-12">
                       <div class="form-group">
                         <label for="exampleInputEmail1">Upload Resources </label>
                         <input type="file"  class="form-control" name="respath" placeholder="Resources path" required/>
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
      </div>
        <div class="row scheduleList">
          @foreach($resources as $row)
            <div class="col-lg-4 col-md-6 col-sm-12 ">
              <div class="courceslist-box">
                <div class="image">
                  @if($row['Resources_Path']!="")
                  <?php $file = explode('/public', $row['Resources_Path']);
                  ?>
                  <?php $filename = explode('/public/resources/admin/', $row['Resources_Path']);
                  $file_format=explode('.',$filename[1]);
                  $value=$file_format[1];

                  switch ($value) {
                    case 'pdf':
                      ?>
                        <img src="{{URL::asset('/images/file_format/pdf.png')}}" alt="">
                      <?php
                      break;
                      case 'jpg':
                        ?>
                          <img src="{{URL::asset('/images/file_format/jpg.png')}}" alt="">
                        <?php
                        break;
                        case 'jpeg':
                          ?>
                            <img src="{{URL::asset('/images/file_format/jpg.png')}}" alt="">
                          <?php
                          break;
                        case 'docx':

                          ?>
                            <img src="{{URL::asset('/images/file_format/word.png')}}" alt="">
                          <?php
                          break;
                          case 'doc':
                          echo'hello';
                            ?>
                              <img src="{{URL::asset('/images/file_format/word.png')}}" alt="">
                            <?php
                            break;
                          case 'rar' || 'zip':
                            ?>
                              <img src="{{URL::asset('/images/file_format/rar.png')}}" alt="">
                            <?php
                            break;
                    default:
                    ?>
                      <img src="{{URL::asset('/images/file_format/doc.png')}}" alt="" style="padding:10px;margin:10px;">
                    <?php
                      break;
                  }
                  ?>
                  @endif

                </div>
                <div class="cource_name">
                <h4>{{$row['CourseName']}}</h4>
                <h6>{{$row['CourseName']}}</h6>
                </div>
                <div class="enroll-btn">
                      <input type="hidden" name="courses_id" value="{{$row['courses_id']}}">
                      @if($row['Resources_Path']!="")
                      <?php $file = explode('/public', $row['Resources_Path']);
                      ?>
                      <?php $filename = explode('/public/resources/admin/', $row['Resources_Path']);
                      ?>
                      <a href="{{$file['1']}}" download>{{$filename[1]}}</a>
                      @endif
                </div>
              </div>
            </div>
      @endforeach
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
