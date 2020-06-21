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
              <li><a href="#">Quiz</a></li>
            </ul>
        </div>
            <div class="row">
              <div class="my-cources col-lg-12 col-sm-12 com-xs-12">
                  <div class="cource-content">
                    <div class="title">
                      <h3>Quiz</h3>
                      <a type="button" href="{{route('staff.createquiz')}}" class="btn btn-primary" name="button"><i class="fas fa-plus-circle"></i> &nbsp; Add New Quiz</a>
                    </div>
                    <div class="row">
                      <table class="table table-bordered" id="quiz_table">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th style="width:300px;">Title</th>
                            <th>Course Name</th>
                            <th style="width:160px;">No of question</th>
                            <th>Created at</th>
                            <th style="width:150px;">Status</th>
                            <th style="width:206px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach($quizList as $row)
                          <tr>
                            <td>{{$row['quiz_id']}}</td>
                            <td>{{$row['Quiz_title']}}</td>
                            <td>{{$row['CourseName']}}</td>
                            <td>{{$row['no_of_question']}}</td>
                            <td>{{$row['created_at']}}</td>
                            <td>
                              <?php
                              if($row['status']==0){
                                ?>
                                <button type="button" name="button" onclick="postQuiz({{$row['quiz_id']}})"  class="btn btn-success" style="width:130px;">Post</button>
                                <?php
                              }else{
                                ?>
                                <button type="button" name="button" class="btn btn-success" disabled style="width:130px;">Posted</button>
                                <?php
                              }
                              ?>
                            </td>
                            <td>
                               <a href="" class="btn btn-info btn-sm show_quiz_btn" data-val="{{$row['quiz_id']}}"  data-toggle="modal" data-target="#showquiz{{$row['quiz_id']}}" style="padding: 5px;font-size:20px;width:80px;">  <i class="fas fa-eye"></i></a>
                               <a data-toggle="modal" href="" class="btn btn-danger" style="padding: 5px;font-size:20px;width:80px;" data-toggle="modal" data-target="#deletequiz{{$row['quiz_id']}}"><i class="fas fa-trash"></i></a>
                               <div class="modal" id="deletequiz{{$row['quiz_id']}}" data-backdrop="static">
                                  <div class="modal-dialog">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h4 class="modal-title">Delete Quiz</h4>
                                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                         </div><div class="container"></div>
                                         <div class="modal-body">
                                             <p>Are you sure want to delete this quiz??</p>
                                         </div>
                                         <div class="modal-footer">
                                           <a href="#" data-dismiss="modal" class="btn">Close</a>
                                           <form class="" action="{{route('staff.quiz.deletequiz',$row['quiz_id'])}}" method="get">
                                             <button type="submit" name="button" class="btn btn-danger">Ok</button>
                                           </form>
                                         </div>
                                       </div>
                                     </div>
                                   </div>
                               <div class="modal" id="showquiz{{$row['quiz_id']}}" role="dialog">
                                 <div class="modal-dialog modal-xl" style="overflow-y: initial">
                                     <div class="modal-content">
                                       <div class="modal-header">
                                         <h4 class="modal-title">Quiz Question</h4>
                                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                       </div>
                                       <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                                         <form class="" action="index.html" method="post">
                                           <div class="row" style="margin:5px;border:1px dashed #000000;padding:10px;">
                                             <div class="col-lg-8 col-sm-6 col-xs-12">
                                               <h5 style="text-align:center;padding-top:10px;">No of question: {{$row['no_of_question']}}</h5>
                                             </div>
                                              <div class="col-lg-4 col-sm-6" style="margin:0px;padding:0px;">
                                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addquestion{{$row['quiz_id']}}"  style="margin:0px;float:right;" > Add New Quiestion</a>
                                              <div class="modal addquestion-modal" id="addquestion{{$row['quiz_id']}}" data-backdrop="static">
                                                 <div class="modal-dialog modal-lg" >
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h4 class="modal-title">Delete Quiz</h4>
                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div><div class="container"></div>
                                                        <div class="modal-body">
                                                          <form class="newassignment_form" action="{{route('staff.createquiz')}}" method="post" enctype="multipart/form-data" id="quiz_question">
                                                            {{csrf_field()}}
                                                            <div class="title" style="margin-bottom:20px;">
                                                                <h5>Quiz Quiestion</h5>
                                                            </div>
                                                            <div class="row">
                                                              <div class="col">
                                                                <div class="">
                                                                  <div class="form-group">
                                                                    <label for="formGroupExampleInput">Quiz Title</label>
                                                                    <input type="text"  value="{{$row['Quiz_title']}}" name="title" class="form-control"  placeholder="" readonly>
                                                                    <input type="hidden" name="quiz_id" value="{{$row['quiz_id']}}"  class="form-control"  placeholder="" readonly>
                                                                    <input type="hidden" name="title" class="form-control"  placeholder="" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                  <div class="form-group">
                                                                      <label for="formGroupExampleInput" style="width:100%">Add Options (Only 3):</label>
                                                                      <input type="text"  name="option" class="form-control option_value" placeholder="Options">
                                                                      <button type="button" class="btn btn-primary add_button"  name="button"><i class="fas fa-plus-circle"></i></button>
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
                                                                      <textarea name="quiz_question" rows="8" cols="60" class="form-control quiz_ans"></textarea>
                                                                    </div>
                                                                  <div class="form-group">
                                                                      <label for="formGroupExampleInput">Answer</label>
                                                                      <input type="text" name="answer" class="form-control"  placeholder="Answer">
                                                                  </div>
                                                              </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                          <a href="#" data-dismiss="modal" class="btn">Close</a>
                                                          <button type="button" class="btn btn-primary save_question" name="button" style="width:120px;margin:10px;margin-top:0px;">Save</button>
                                                        </div>
                                                      </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>
                                           </div>
                                         </form>
                                         <form class="question_form" action="index.html" method="post">


                                         </form>
                                       </div>
                                       <div class="modal-footer">
                                         <a href="#" data-dismiss="modal" class="btn">Close</a>
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
var jsonObj = [];
$("#quiz_question").hide();
$(".add_button").click(function(){
  $("#option_list").empty();
  var inputValue=$('input[name="option"]').val();
  $('input[name="option"]').val('');
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
$('#quiz_table').DataTable({
         "ordering": false
});
});
</script>
<script type="text/javascript">
function postQuiz(quiz_id){
 $.ajax({
     type:'get',
     url:'/staff/updatequiz',
     data:{quiz_id:quiz_id},
     success:function(data){
      if(data.message===1){
        setTimeout(function(){// wait for 5 secs(2)
   location.reload(); // then reload the page.(3)
 }, 100);
      }
    }
});
}
$('.show_quiz_btn').click(function(){
var quiz_id= $(this).data("val");
displayQuestion(quiz_id);
});
function displayQuestion(quiz_id){
  $('.question_form').empty();
  $.ajax({
      type:'get',
      dataType: "json",
      url:'/staff/getquestion',
      data:{quiz_id:quiz_id},
      success:function(data){
         $.each(data[0], function(j, v){
            $('.question_form').append('<div class="question_container">\
             <div class="question_heading">\
               <h5>'+ v['question']+'</h5>\
                <button type="button" data-value="'+v['quiz_id']+'"  onClick="return deleteQuestionList('+v['question_id']+')" name="button" class="btn btn-default delete_question_btn"><i class="fas fa-times-circle"></i></button>\
              </div>\
              <div class="options">\
                <ol>\
                  <li>'+v['option1']+'</li>\
                  <li>'+v['option2']+'</li>\
                  <li>'+v['option3']+'</li>\
                  <li>'+v['answer']+'</li>\
                  <h5 class="answer">Ans:&nbsp;'+v['answer']+'</h5>\
                </ol>\
              </div>\
            </div>');
         });
     }
  });
}
function deleteQuestionList(question_id){
  var quiz_id= $(this).data("val");
  if(!confirm("Are You Sure to delete this")){
    event.preventDefault();
  }else{
    $.ajax({
        type:'get',
        url:'/staff/deletequestion',
        data:{question_id:question_id,quiz_id:quiz_id},
        success:function(data){

          if(data.success===true){
            displayQuestion(data.message)
          }
       }
   });
  }
}
$(".save_question").click(function(e){
  e.preventDefault();
  var options=[];
  $('#option_list li').each(function(i)
  {
    options.push($(this).text());
  });
  var quiz_id=$('input[name="quiz_id"]').val();
  var question=$('.quiz_ans').val();
  var answer=$('input[name="answer"]').val();
  var option1=options[0];
  var option2=options[1];
  var option3=options[1];
  $.ajax({
     type:'get',
     url:'/staff/updatequizquestion',
     data:{quiz_id:quiz_id, question:question, answer:answer, option1:option1, option2:option2, option3:option3},
     success:function(data){
       displayQuestion(data.quiz_id)
       console.log(data.quiz_id);
       $('.addquestion-modal').modal('hide');
       return false;
    }
});

});

</script>
