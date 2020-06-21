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
            </ul>
        </div>
            <div class="row">
              <div class="my-cources col-lg-9 col-sm-12 com-xs-12">
                  <div class="cource-content">
                      <h3>Create a Quiz</h3>
                    <div class="row">
                      <form class="newassignment_form" action="{{route('staff.createquiz')}}" method="post" enctype="multipart/form-data" id="create_quiz">
                        {{csrf_field()}}
                        <div class="title" style="margin-bottom:20px;">
                            <h5>Quiz Category</h5>
                        </div>
                        <div class="row">
                          <div class="col-lg-8">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Title:</label>
                                <input type="text"  name="quiz_title" class="form-control"  placeholder="Title">
                              </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">No Of Question:</label>
                                <input type="number" step="1" name="no_of_question" class="form-control"  placeholder="No of question">
                              </div>
                          </div>
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="formGroupExampleInput">Cource Name</label>
                              <select id="course_id" class="form-control">
                                  <option value="" disabled selected>Select.....</option>
                                @foreach($courses as $row)
                                    <option value="{{$row['courses_id']}}">{{$row['CourseName']}}</option>
                                @endforeach
                              </select>
                              </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group" style="float:right;margin-top:35px;">
                                    <button type="button" id="add_quiz" class="btn btn-primary" name="button" style="width:100px;margin:10px;margin-top:0px;">Add Quiz</button>
                              </div>
                          </div>

                        </div>


                      </form>
                      <form class="newassignment_form" action="{{route('staff.createquiz')}}" method="post" enctype="multipart/form-data" id="quiz_question">
                        {{csrf_field()}}
                        <div class="title" style="margin-bottom:20px;">
                            <h5>Quiz Quiestion</h5>
                        </div>
                        <div class="row">

                          <div class="col-lg-12" style="margin:20px;text-align:center">
                              <label for="formGroupExampleInput">Question Left: <i id="left_ques"></i></label>
                          </div>
                          <div class="col">
                            <div class="">
                              <div class="form-group">
                                <label for="formGroupExampleInput">Quiz Title</label>
                                <input type="text" id="create_quiz_title" name="title" class="form-control"  placeholder="" readonly>
                                <input type="hidden" id="create_quiz_id" name="title" class="form-control"  placeholder="" readonly>
                                <input type="hidden" id="create_quiz_noq" name="title" class="form-control"  placeholder="" readonly>
                                </div>
                            </div>
                            <div class="">
                              <div class="form-group">
                                  <label for="formGroupExampleInput" style="width:100%">Add Options (Only 3):</label>
                                  <input type="text" id="option_value" name="title" class="form-control" placeholder="Options">
                                  <button type="button" class="btn btn-primary" id="addbutton" name="button"><i class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
                            <div>
                              <div class="form-group">
                                  <label for="formGroupExampleInput">Options List:</label>
                                  <ol id="option_list">
                                  </ol>
                                </div>
                            </div>
                          </div>
                          <div class="col">
                              <div class="form-group">
                                  <label for="formGroupExampleInput">Question:</label>
                                  <textarea name="quiz_question" id="quiz_qns" rows="8" cols="60" class="form-control"></textarea>
                                </div>
                              <div class="form-group">
                                  <label for="formGroupExampleInput">Answer</label>
                                    <input type="text" name="answer" class="form-control"  placeholder="Answer">
                              </div>
                            <div class="form-group" style="float:right;margin:30px;margin-right:0px;">
                                    <button type="button"  id="save_question" class="btn btn-primary" name="button" style="width:120px;margin:10px;margin-top:0px;">Save</button>
                              </div>
                          </div>
                        </div>
                      </form>
                    </div>
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
<script>
$(document).ready(function(){
var jsonObj = [];
$("#quiz_question").hide();
$("#addbutton").click(function(){
  $("#option_list").empty();
  var inputValue=$("#option_value").val();
  $("#option_value").val('');
  item = {}
  if(inputValue!==''){
    item['options']=inputValue;
    jsonObj.push(item);
    $.each( jsonObj, function( key, val ) {
          $("#option_list").append('<li>'+val['options']+'</li>')
    });
    if(jsonObj.length===3){
        $(this).hide();
        jsonObj=[];
    }
  }
});
})
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $("#add_quiz").click(function(e){
      e.preventDefault();
      var quiz_title = $('input[name="quiz_title"]').val();
      var course_id = $('#course_id option:selected').val();
      var no_of_question = $('input[name="no_of_question"]').val();
      $.ajax({
         type:'get',
         url:'/staff/createquizcat',
         data:{quiz_title:quiz_title, course_id:course_id, no_of_question:no_of_question},
         success:function(data){
           console.log(data.id);
           console.log(data.value['Quiz_title']);
           $("#create_quiz :input" ).prop( "disabled", true);
           $("#quiz_question").show();
           $("#create_quiz_title").val(data.value['Quiz_title']);
           $("#create_quiz_id").val(data.id);
           $("#create_quiz_noq").val(data.value['no_of_question']);
           $("#left_ques").text(data.value['no_of_question']);
        }
      });
});

$("#save_question").click(function(e){
  e.preventDefault();
  var options=[];
  $('#option_list li').each(function(i)
  {
    options.push($(this).text());
  });
  var quiz_id=$('#create_quiz_id').val();
  var question=$('#quiz_qns').val();
  var answer=$('input[name="answer"]').val();
  var option1=options[0];
  var option2=options[1];
  var option3=options[1];

  $.ajax({
     type:'get',
     url:'/staff/createquizquestion',
     data:{quiz_id:quiz_id, question:question, answer:answer, option1:option1, option2:option2, option3:option3},
     success:function(data){
       console.log(data.success);
       $('#create_quiz_id').val("");
       $('#quiz_qns').val("");
       $('input[name="answer"]').val("");
       $('#addbutton').show();
       var left=$('#left_ques').text();
       if(left-1===0){
         window.location.href = "/staff/quiz";
       }
       $('#left_ques').text(left-1);
       $('#option_list li').remove();
    }
});

});

</script>
