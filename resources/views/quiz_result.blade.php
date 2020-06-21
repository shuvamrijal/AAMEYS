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

                <form class="" action="{{route('student.submitquiz')}}" method="get" enctype="multipart/form-data">
                    {{csrf_field()}}

                  <div class="cource-content">
                  <h3>
                    @foreach($quiz as $value)
                      {{$value['Quiz_title']}}
                    @endforeach
                  </h3>
                  <?php
                    foreach ($quiz as $key => $value) {

                  ?>
                  <table class="table table-striped col-lg-9 col-sm-12 col-md-12">
                      <tr>
                        <td style="width:50%;">No. Of. Question</td>
                        <td><?php echo $value['no_of_question']?></td>
                      </tr>
                      <tr>
                        <td>Your Score</td>
                        <td>
                          <?php
                          $no_of_question=$value['no_of_question'];
                          $correct_percentage=(($correct/$no_of_question)*100);
                          echo $correct.'&nbsp; ('.$correct_percentage.') %';
                          ?>

                        </td>
                      </tr>
                      <tr>
                        <td>Result</td>
                        <td>
                          <?php
                          $no_of_question=$value['no_of_question'];
                          $result='';
                          $correct_percentage=(($correct/$no_of_question)*100);
                          if($correct_percentage<40){
                            $result='Fail';
                          }else{
                            $result='Pass';
                          }
                          echo $result;
                          ?>
                        </td>
                      </tr>
                  </table>
                  <?php
                }
              ?>

              <div class="col-lg-9 col-sm-12 col-md-12">
                <div class="back_moodle-btn" >
                      @foreach($quiz as $value)
                            <a href="{{route('moodle.page',$value['cources_id'])}}" class="btn btn-primary">Go to moodle Page</a>
                      @endforeach
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
