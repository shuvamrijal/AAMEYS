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
                    <div class="start_page" id='start_page'>
                      <?php
                      $status=0;
                      if(count($quiz_result)>=1){
                        foreach ($quiz_result as $key => $value) {
                          $status=$value['status'];
                        }
                      }
                      if($status=='1'){
                        ?>
                          <h4 style="text-align:center">You already submit your quiz.</h4>
                        <?php
                      }else{
                        ?>
                        @foreach($quiz as $value)
                          <h4>Welcome to {{$value['Quiz_title']}} Quiz. You have total {{$value['no_of_question']}}
                          questions and 45min to finish this quiz </h4>
                          <button type="button" name="button" class="btn btn-primary" style="text-align:right;" id="quiz_start_btn">Strat Quiz</button>
                        @endforeach
                        <?php
                      }
                       ?>
                    </div>
                    <form class="" action="{{route('student.submitquiz')}}" method="post" enctype="multipart/form-data" id="quiz_question_form">
                        {{csrf_field()}}
                  <h3>
                      @foreach($quiz as $value)
                        {{$value['Quiz_title']}}
                        <input type="hidden" name="quiz_id" value="{{$value['quiz_id']}}">
                      @endforeach
                  </h3>

                  <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="time_left">
                        <button type="button" id="time_left" name="button" class="btn btn-primary" style=""></button>
                    </div>
                      <ol>

                          <?php
                          foreach ($questions as $key => $value) {
                            ?>
                      <div class="quiz_question">
                        <li>
                            <p id="question_title"><?php echo $value['question']?></p>
                            <div class="options">
                              <ol>
                                <?php
                                foreach ($value['options'] as $key => $row) {
                                  $option1=$row[0];
                                  $option2=$row[1];
                                  $option3=$row[2];
                                  $option4=$row[3];
                                  if (strpos($option1, 'answer:') !== false) {
                                      $arr=explode('answer:',$option1);
                                      ?>
                                        <li>
                                          <input type="radio" name="options<?php echo $value['question_id']?>" value="<?php echo 'answer:'.$arr[1] ?>">
                                           <label for="huey"><?php echo $arr[1] ?></label>
                                        </li>
                                      <?php
                                    }else{
                                      ?>
                                      <li>
                                        <input type="radio" name="options<?php echo $value['question_id']?>" value="<?php echo $option1 ?>">
                                         <label for="huey"><?php echo $option1 ?></label>
                                       </li>
                                      <?php
                                  }
                                  if (strpos($option2, 'answer:') !== false) {
                                      $arr=explode('answer:',$option2);
                                      ?>
                                        <li>
                                          <input type="radio" name="options<?php echo $value['question_id']?>" value="<?php echo'answer:'.$arr[1] ?>">
                                           <label for="huey"><?php echo $arr[1] ?></label>
                                        </li>
                                      <?php
                                    }else{
                                      ?>
                                      <li>
                                        <input type="radio" name="options<?php echo $value['question_id']?>" value="<?php echo $option2 ?>">
                                         <label for="huey"><?php echo $option2 ?></label>
                                       </li>
                                      <?php
                                  }
                                  if (strpos($option3, 'answer:') !== false) {
                                      $arr=explode('answer:',$option3);
                                      ?>
                                        <li>
                                          <input type="radio" name="options<?php echo $value['question_id']?>" value="<?php echo'answer:'. $arr[1] ?>">
                                           <label for="huey"><?php echo $arr[1] ?></label>
                                        </li>
                                      <?php
                                    }else{
                                      ?>
                                      <li>
                                        <input type="radio" name="options<?php echo $value['question_id']?>" value="<?php echo $option3 ?>">
                                         <label for="huey"><?php echo $option3 ?></label>
                                       </li>
                                      <?php
                                  }
                                  if (strpos($option4, 'answer:') !== false) {
                                      $arr=explode('answer:',$option4);
                                      ?>
                                        <li>
                                          <input type="radio" name="options<?php echo $value['question_id']?>" value="<?php echo 'answer:'. $arr[1] ?>">
                                           <label for="huey"><?php echo $arr[1] ?></label>
                                        </li>
                                      <?php
                                    }else{
                                      ?>
                                      <li>
                                        <input type="radio" name="options<?php echo $value['question_id']?>" value="<?php echo $option4 ?>">
                                         <label for="huey"><?php echo $option4 ?></label>
                                       </li>
                                      <?php
                                  }
                                ?>
                                <?php
                              }
                            ?>

                            </ol>
                            </div>
                            </li>
                          </div>
                            <?php
                          }
                           ?>
                            </div>
                            <div class="submit_quiz" style="margin-top:20px;">
                              <button type="submit" name="button" class="btn btn-primary btn-lg" style="width:150px;">Submit</button>
                            </div>

                      </ol>

                </form>
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
$('#quiz_question_form').hide();
$('#start_page').show();
$('#quiz_start_btn').click(function(){
    $('#quiz_question_form').show();
    $('#start_page').hide();
    var fiveMinutes = 60 * 45,
    display = $('#time_left');
    startTimer(fiveMinutes, display);
});

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.text("Time Left: "+ minutes + ":" + seconds);
        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}
</script>
