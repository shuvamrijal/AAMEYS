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
                  <div class="cource-content">
                        <h3>{{$courses['CourseName']}} </h3>
                        <div class="row" style="padding:25px;">
                          <div class="col-lg-12 col-md-12 col-sm-12 moodle-box assignment collapsed" style="margin-bottom:25px;">
                            <div class="title dropdown-toggle" type="button" data-toggle="collapse"><h5>Assignment</h5><span class="caret"></span></div>
                              <div class="body" style="">
                                <div class="moodle_list">
                                  @foreach($assignment as $value)
                                  <li><a href="/moodle/assignment/?id={{$value['id']}}&cources_id={{$value['cources_id']}}">{{$value['title']}}</a></li>
                                  @endforeach
                                </div>
                              </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 moodle-box course collapsed" style="margin-bottom:25px;">
                            <div class="title dropdown-toggle" type="button" data-toggle="collapse"><h5>Course Content</h5><span class="caret"></span></div>
                              <div class="body" style="">
                                <div class="moodle_list">
                                  @foreach($resources as $row)
                                  <div class="collapsable">
                                    <div class="list_title" id='res{{$row['resources_id']}}' data-val='content{{$row['resources_id']}}'>
                                        <a><h5>{{$row['Resources_Name']}}</h5>
                                            <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                          </a>
                                    </div>
                                    <div class="list_content" id='content{{$row['resources_id']}}'>
                                        <p>
                                          {{$row['Resources_Description']}}
                                        </p>
                                        @if($row['Resources_Path']!="")
                                        <?php $file = explode('/public', $row['Resources_Path']);
                                        ?>
                                        <?php $filename = explode('/public/resources/admin/', $row['Resources_Path']);
                                        ?>
                                        <a href="{{$file['1']}}" download>
                                          <img src="resource_icon" alt="">
                                          <?php
                                          $file_format=explode('.',$filename[1]);
                                          $value=$file_format[1];

                                          switch ($value) {
                                            case 'pdf':
                                              ?>
                                                <img class="resource_icon" src="{{URL::asset('/images/file_format/pdf.png')}}" alt="">
                                              <?php
                                              break;
                                              case 'jpg':
                                                ?>
                                                  <img class="resource_icon" src="{{URL::asset('/images/file_format/jpg.png')}}" alt="">
                                                <?php
                                                break;
                                                case 'jpeg':
                                                  ?>
                                                    <img class="resource_icon" src="{{URL::asset('/images/file_format/jpg.png')}}" alt="">
                                                  <?php
                                                  break;
                                                case 'docx':

                                                  ?>
                                                    <img class="resource_icon" src="{{URL::asset('/images/file_format/word.png')}}" alt="">
                                                  <?php
                                                  break;
                                                  case 'doc':
                                                  echo'hello';
                                                    ?>
                                                      <img class="resource_icon" src="{{URL::asset('/images/file_format/word.png')}}" alt="">
                                                    <?php
                                                    break;
                                                  case 'rar' || 'zip':
                                                    ?>
                                                      <img class="resource_icon" src="{{URL::asset('/images/file_format/rar.png')}}" alt="">
                                                    <?php
                                                    break;
                                            default:
                                            ?>
                                              <img class="resource_icon" src="{{URL::asset('/images/file_format/doc.png')}}" alt="" style="padding:10px;margin:10px;">
                                            <?php
                                              break;
                                          }
                                          ?>
                                            <span>  {{$filename[1]}}</span>
                                        </a>
                                        @endif
                                    </div>
                                  </div>
                                  @endforeach
                                </div>
                              </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 moodle-box quiz collapsed" style="margin-bottom:25px;">
                            <div class="title dropdown-toggle" type="button" data-toggle="collapse"><h5>Quiz</h5><span class="caret"></span></div>
                              <div class="body" style="">
                                <div class="moodle_list">
                                  @foreach($quiz as $value)
                                  <li><a href="/moodle/quiz/?id={{$value['quiz_id']}}&cources_id={{$value['cources_id']}}">{{$value['Quiz_title']}}</a></li>
                                  @endforeach
                                  </li>
                                </div>
                              </div>
                          </div>
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
    var assign= document.querySelector(".assignment");
    var course=document.querySelector(".course");
    var quiz=document.querySelector(".quiz");

    $('.assignment .title').click(function(){
      assign.classList.toggle('collapsed');
    });
    $('.course .title').click(function(){
      course.classList.toggle('collapsed');
    });
    $('.quiz .title').click(function(){
      quiz.classList.toggle('collapsed');
    });
</script>
<script type="text/javascript">
  $('.collapsable').find('.list_title').each(function(){
    var innerDivId = $(this).attr('id');
    var content=$(this).attr('data-val');
    console.log(content);
    var resource_titile= document.querySelector('#'+content+' ');
    $('#'+innerDivId+'').click(function(){
      resource_titile.classList.toggle('collapsed');
    });
  });


  //var value=$('.collapsable').data("resources");
  //var resource_titile= document.querySelector('#'+value+'');
  //console.log(resource_titile);
  //$('#'+value+' .list_title').click(function(){
    //resource_titile.classList.toggle('collapsed');
  //})
</script>
