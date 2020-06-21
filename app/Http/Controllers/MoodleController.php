<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Courses;
use App\Assignment;
use App\Staff;
use App\AssignmentList;
use Carbon\Carbon;
use App\Quiz;
class MoodleController extends Controller
{
  public function __construct(){
        $this->middleware('auth:staff,student');
  }


  public function index($id){
      $courses=Courses::find($id)->toArray();
      $assignment=DB::table('assignments')->where('assignments.cources_id',$id)->get();
      $resources=DB::table('resources')->where('resources.courses_id',$id)->get();
      $quiz=DB::table('quizes')->where('quizes.cources_id',$id)
                              ->where('quizes.status','1')
                              ->get();

      $resources=json_decode($resources, true);
      $assignment=json_decode($assignment, true);
      $quiz=json_decode($quiz,true);
       return view('courcemoodle',compact(['resources','courses','assignment','quiz']));
  }
  public function showAssignment(Request $request){
      $id=request('id');
      $cources_id=request('cources_id');
      $cource = DB::table('assigncourses')->where('assigncourses.cources_id',$cources_id)
            ->join('staff', 'staff.staff_id', '=', 'assigncourses.staff_id')
            ->select('staff.*','assigncourses.*')
            ->get();
      $cor=json_decode($cource, true);
      $assign=Assignment::find($id)->toArray();
      $student_id=Auth::guard('student')->user()->studentId;
      $submit = DB::table('assignments')->where('assignments.id',$id)
                    ->join('assignment_lists', 'assignment_lists.assign_id', '=','assignments.id' )->where('assignment_lists.studentId',$student_id)
                    ->select('assignments.*','assignment_lists.*')
                    ->get();
      $submit=json_decode($submit, true);
      $feedback = DB::table('assignments')->where('assignments.id',$id)
                    ->join('feedback', 'feedback.assign_id', '=','assignments.id' )->where('feedback.studentId',$student_id)
                    ->join('staff', 'feedback.staff_id', '=','staff.staff_id' )
                    ->select('assignments.*','feedback.*','staff.*')
                    ->get();
      $feedback=json_decode($feedback, true);
      //dd($feedback);
      return view('assignment',compact(['assign','submit','feedback','cor']));
  }
  public function submitAssignment(Request $request){
    $assign_id=request('assign_id');
    $staff_id=request('staff_id');
    $cources_id=request('cources_id');
    $assignment=Assignment::find($assign_id)->toArray();
    $student_id=Auth::guard('student')->user()->studentId;
    $assign=new AssignmentList;
    $assign->assign_id=$assign_id;
    $assign->staff_id=$staff_id;
    $assign->cources_id=$cources_id;
    $assign->studentId=$student_id;
    $assign->submittedDate=Carbon::now();
    $data = array();
    if($request->hasfile('files'))
    {
      foreach($request->file('files') as $file)
      {
        $name = str_replace(' ', '',$assignment['title']).'_'.Auth::guard('student')->user()->username.'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('/resources/submitted');
        $filepath = $destinationPath. "/".  $name;
        $file->move($destinationPath, $name);
        array_push($data, array('filename' => $filepath));
      }
    }
    $assign->submittedFile=json_encode($data);;
    $assign->save();
    return redirect('/course/moodle/'.$cources_id);
  }


  public function showQuiz(Request $request){
    $cources_id=request('cources_id');
    $quiz_id=request('id');
    $quiz=DB::table('quizes')->where('quiz_id',$quiz_id)->get();
    $student_id=Auth::guard('student')->user()->studentId;
    $quiz_result=DB::table('quiz_results')->where('quiz_id',$quiz_id)
                                          ->where('studentId',$student_id)
                                          ->get();
    $question=DB::table('quiz_questions')->where('quiz_id',$quiz_id)
                                         ->get();
    $quiz=json_decode($quiz, true);
    $quiz_result=json_decode($quiz_result, true);

    $quiz_question=json_decode($question, true);
    $questions=array();
    $new_array=array();
    $options=array();
    foreach ($quiz_question as $key => $value) {
        $sufflevalue=array('option1'=>$value['option1'],'option2'=>$value['option2'],'option3'=>$value['option3'],'answer'=>'answer:'.$value['answer']);
        $options=array();
        shuffle($sufflevalue);
        array_push($options,$sufflevalue);
        array_push($questions,array('question_id' => $value['question_id'],'quiz_id'=>$value['quiz_id'],'options'=>$options,'question'=>$value['question']));
    }

    return view('quiz',compact(['quiz','questions','quiz_result']));
  }
  public function submitQuiz(Request $request){
    $quiz_id=request('quiz_id');
    $quiz=DB::table('quizes')->where('quiz_id',$quiz_id)->get();
    $data = $request->except(['_token','button','quiz_id']);
    $correct=0;
    $courses_id;
    $incorrect=0;
    $no_of_question;
    $student_id=Auth::guard('student')->user()->studentId;
    $quiz=json_decode($quiz, true);
    foreach ($data as $key => $value) {
        if (strpos($value, 'answer:') !== false) {
            $correct=$correct+1;
        }else{
            $incorrect=$incorrect+1;
        }
    }
    foreach ($quiz as $key => $value) {
      $cources_id=$value['cources_id'];
      $no_of_question=$value['no_of_question'];

    }
    $result='';
    $correct_percentage=(($correct/$no_of_question)*100);
    if($correct_percentage<40){
      $result='Fail';
    }else{
      $result='Pass';
    }
    $value= array(
            'quiz_id'   =>   $quiz_id,
            'cources_id'   =>   $cources_id,
            'studentId'   =>   $student_id,
            'marks'     => $correct,
            'comment' =>$result,
            'status' =>'1',
     );
     if(DB::table('quiz_results')->insert($value)){
          return view('quiz_result',compact(['correct','incorrect','quiz']));
     }
  }
}
