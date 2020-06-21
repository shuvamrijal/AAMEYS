<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Auth;
use Hash;
use View;
use App\Event;
use DB;
use diff;
use DateTime;
use File;
use Carbon\Carbon;
use App\Courses;
use App\Schedule;
use App\Resources;
use App\AttendanceCode;
use App\Attendance;
use App\Assignment;
use App\AssignmentList;
use App\Feedback;
use App\Quiz;
use App\Staff;
use App\StaffLogin;
use Illuminate\Support\Str;
class StaffController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:staff');
  }
  public function index(){

    $id=Auth::guard('staff')->user()->staff_id;
    $sch = DB::table('assigncourses')->where('assigncourses.staff_id',$id)
    ->join('courses', 'assigncourses.cources_id', '=', 'courses.courses_id')
    ->join('schedules', 'courses.courses_id', '=', 'schedules.courses_id')
    ->select('courses.*','schedules.*')
    ->get();
    $courses=json_decode($sch, true);
    return view('staff.dashboard',compact('courses'));
  }
  public function Calendar(){
    $event=Event::all()->toArray();
    return view('staff.calendar',compact('event'));
  }
  public function creatEvent(Request $request){
    $event=new Event;
    $event->event_title=request('event_title');
    $event->event_desc=request('event_desc');
    $event->event_date=request('event_date');
    $event->category=request('category');
    $event->save();
    return response()->json(
      [
        'success'=>true,
        'message' => 'Sucess'
      ]
    );
  }

  public function getEvent(){
    $event=Event::all()->toArray();
    echo json_encode($event);
  }
  public function showAttendance(){
    $id=Auth::guard('staff')->user()->staff_id;
    $sch = DB::table('schedules')
    ->join('staff', 'schedules.staff_id', '=', 'staff.staff_id')->where('staff.staff_id',$id)
    ->join('courses', 'schedules.courses_id', '=', 'courses.courses_id')
    ->select('schedules.*', 'staff.*', 'courses.*')
    ->get();
    $today_date=date('Y-m-d');
    $attn=DB::table('attendances')->whereDate('attendance_date', $today_date)
    ->join('staff', 'attendances.staff_id', '=', 'staff.staff_id')->where('staff.staff_id',$id)
    ->join('courses', 'attendances.cources_id', '=', 'courses.courses_id')
    ->join('students', 'attendances.studentId', '=', 'students.studentId')
    ->select('attendances.*', 'staff.*', 'courses.*','students.*')
    ->get();
    // dd($today_date);
    $attendance=json_decode($attn, true);
    $schedule=json_decode($sch, true);
    return view('staff.attendance',compact('schedule','attendance'));
  }

  public function getAttendanceCode(Request $request){
    $id=request('shcedule_id');
    $schedule=Schedule::find($id);
    $start_time=$schedule->Start_time;
    $day=$schedule->DaysOfWeek;
    $end_time=$schedule->End_time;
    $value = config('app.timezone');
    $current_time=Carbon::now($value);
    $now_time=$current_time->format( 'H:i:s' );
    $today=$current_time->format( 'l' );
    if($day==$today){
      if ($now_time > $start_time && $now_time < $end_time)
      {
        $result=DB::table('attendance_codes')->where('cources_id',$schedule->courses_id )->delete();
        $token = random_int(111111, 999999);
        $code=new AttendanceCode;
        $code->attendance_code=$token;
        $code->cources_id=$schedule->courses_id;
        $code->save();
      }else{
        $token='No running class in this cources';
      }
    }else{
      $token='No running class in this cources';
    }
    return response()->json(
      [
        'success'=>true,
        'message' =>$token,
      ]
    );
  }
  public function showAssignment(){
    $id=Auth::guard('staff')->user()->staff_id;
    $sch = DB::table('schedules')
    ->leftJoin('staff', 'schedules.staff_id', '=', 'staff.staff_id')->where('staff.staff_id',$id)
    ->rightjoin('courses', 'schedules.courses_id', '=', 'courses.courses_id')
    ->select('schedules.*', 'staff.*', 'courses.*')
    ->get();
    $courses=json_decode($sch, true);
    $assign = DB::table('assignments')
    ->join('courses', 'assignments.cources_id', '=', 'courses.courses_id')
    ->select('assignments.*','courses.*')
    ->get();
    $assignment=json_decode($assign, true);
    return view('staff.assignment',compact(['assignment','courses']));
  }
  public function newAssignment(){
    $id=Auth::guard('staff')->user()->staff_id;
    $sch = DB::table('assigncourses')->where('assigncourses.staff_id',$id)
    ->join('courses', 'assigncourses.cources_id', '=', 'courses.courses_id')
    ->select('courses.*')
    ->get();
    $courses=json_decode($sch, true);
    return view('staff.newassignment',compact('courses'));
  }

  public function creatAssignment(Request $request){
    $assignment=new Assignment;
    $assignment->cources_id=request('cource_id');
    $assignment->title=request('title');
    $assignment->content=request('content');
    $assignment->due_date=request('due_date');
    $assignment->grade_category=request('gradecategory');
    $assignment->max_grade=request('max_grade');
    if ($request->hasFile('attachment')) {
      $file = $request->file('attachment');
      $name = str_replace(' ', '',rand()).request('title').'.'.$file->getClientOriginalExtension();
      $destinationPath = public_path('/resources/assignment');
      $filepath = $destinationPath. "/".  $name;
      $file->move($destinationPath, $name);
      $assignment->attachment = $filepath;
    }
    $assignment->save();
    return redirect('/staff/assignment');
  }

  public function editAssignment(Request $request){
    $id=request('id');
    $assignment=Assignment::find($id);
    $assignment->cources_id=request('cource_id');
    $assignment->title=request('title');
    $assignment->content=request('content');
    $assignment->due_date=request('due_date');
    $assignment->grade_category=request('gradecategory');
    $assignment->max_grade=request('max_grade');
    if ($request->hasFile('attachment')) {
      $file = $request->file('attachment');
      $name = str_replace(' ', '',rand()).request('title').'.'.$file->getClientOriginalExtension();
      $destinationPath = public_path('/resources/assignment');
      $filepath = $destinationPath. "/".  $name;
      $file->move($destinationPath, $name);
      $assignment->attachment = $filepath;
    }
    $assignment->save();
    return redirect('/staff/assignment');
  }

  public function deleteAssignment($id){
    $assignment=Assignment::find($id);
    $filename=$assignment->attachment;
    File::delete($filename);
    $assignment->delete();
    return redirect('/staff/assignment');
  }
  public function showFeedback(){
    $id=request('id');
    $id=Auth::guard('staff')->user()->staff_id;
    $sch = DB::table('assigncourses')->where('assigncourses.staff_id',$id)
    ->join('courses', 'assigncourses.cources_id', '=', 'courses.courses_id')
    ->select('courses.*')
    ->get();
    $courses=json_decode($sch, true);
    return view('staff.assignmentfeedback',compact('courses'));
  }
  public function getAssignment(Request $request){
    $id=request('id');
    $row=$id;
    $assignment=Assignment::where('cources_id', $id)->orderBy('id', 'asc')->get();
    return json_encode(array($assignment,$row));
  }
  public function getAssignmentList(Request $request){
    $id=request('id');
    $assign_list = DB::table('assignment_lists')->where('assignment_lists.assign_id',$id)
    ->join('students', 'students.studentId', '=', 'assignment_lists.studentId')
    ->join('assignments', 'assignments.id', '=','assignment_lists.assign_id' )->where('assignments.id',$id)
    ->select('assignment_lists.id AS assignList_id','students.*','assignments.*','assignment_lists.*','assignment_lists.status as feedback_status')
    ->get();

    $feedback_list = DB::table('assignment_lists')->where('assignment_lists.assign_id',$id)
                    ->join('students', 'students.studentId', '=', 'assignment_lists.studentId')
                    ->join('feedback','assignment_lists.assign_id','=','feedback.assign_id')
                    ->join('assignments', 'assignments.id', '=','assignment_lists.assign_id' )->where('assignments.id',$id)
                    ->select('assignment_lists.id AS assignList_id','students.*','assignments.*','assignment_lists.*','assignment_lists.status as feedback_status','feedback.*')
                    ->get();
    return json_encode(array($assign_list,$id,$feedback_list));
  }

  public function makeFeedback($id){
    $assign_list = DB::table('assignment_lists')->where('assignment_lists.id',$id)
                    ->join('students', 'students.studentId', '=', 'assignment_lists.studentId')
                    ->join('courses', 'assignment_lists.cources_id', '=', 'courses.courses_id')
                    ->join('assignments', 'assignments.id', '=','assignment_lists.assign_id' )
                    ->select('assignment_lists.id AS assign_id','assignment_lists.*','students.*','assignments.*','courses.*')
                    ->get();
    $assignList=json_decode($assign_list, true);


    return view('staff.makefeedback',compact('assignList'));
  }
  public function createFeedback(Request $request){
    $assign_list = DB::table('assignment_lists')
                ->where('assign_id', request('assign_id'))
                ->where('studentId', request('student_id'))
                ->update(['status' => '1']);
    $staff_id=Auth::guard('staff')->user()->staff_id;
    $feedback=new Feedback;
    $feedback->assign_id=request('assign_id');
    $feedback->staff_id=$staff_id;
    $feedback->studentId=request('student_id');
    $feedback->grade=request('grade');
    $feedback->gradeOn=Carbon::now();
    $feedback->comment=request('comment');
    $data = array();

    if($request->hasfile('files'))
    {
      foreach($request->file('files') as $file)
      {
        $name = str_replace(' ', '',rand(10,99)).'Feedback'.request('assign_id').'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('/resources/feedback');
        $filepath = $destinationPath. "/".  $name;
        $file->move($destinationPath, $name);
        array_push($data, array('filename' => $filepath));

      }
    }
    $feedback->feedbackFile=json_encode($data);
    $feedback->save();
    return redirect('/staff/feedback');
  }

  public function showQuiz(){
    $q_list = DB::table('quizes')
    ->join('courses', 'quizes.cources_id', '=', 'courses.courses_id')
    ->select('quizes.*','courses.CourseName')
    ->orderBy('quizes.status','asc')
     ->orderBy('quizes.quiz_id', 'ASC')
    ->get();
    $quizList=json_decode($q_list, true);
    return view('staff.quiz',compact('quizList'));
  }
  public function createQuiz(){
    $id=Auth::guard('staff')->user()->staff_id;
    $sch = DB::table('assigncourses')->where('assigncourses.staff_id',$id)
    ->join('courses', 'assigncourses.cources_id', '=', 'courses.courses_id')
    ->select('courses.*')
    ->get();
    $courses=json_decode($sch, true);
    return view('staff.createquiz',compact('courses'));
  }
  public function createQuizCat(Request $request){
    $quiz=new Quiz;
    $quiz_title=request('quiz_title');
    $course_id=request('course_id');
    $no_of_question=request('no_of_question');
    $value= array(
            'Quiz_title'   =>   $quiz_title,
            'cources_id'   =>   $course_id,
            'no_of_question'   =>   $no_of_question,
     );
  if(DB::table('quizes')->insert($value)){
    return response()->json(
      [
        'success'=>true,
        'id'=>DB::getPdo()->lastInsertId(),
        'value'=>$value,
      ]
    );
  }


  }
  public function createQuizQuestion(Request $request){
    $quiz_id=request('quiz_id');
    $question=request('question');
    $answer=request('answer');
    $option1=request('option1');
    $option2=request('option2');
    $option3=request('option3');
    $count=DB::table('quiz_questions')->count();
    $value= array(
            'quiz_id'   =>   $quiz_id,
            'question'   =>   $question,
            'answer'   =>     $answer,
            'option1'   =>   $option1,
            'option2'   =>   $option2,
            'option3'   =>   $option3,
     );
     DB::table('quiz_questions')->insert($value);
     return response()->json(
       [
         'success'=>true,
       ]
     );
  }
  public function updateQuizQuestion(Request $request){
    $quiz_id=request('quiz_id');
    $question=request('question');
    $answer=request('answer');
    $option1=request('option1');
    $option2=request('option2');
    $option3=request('option3');
    $update=DB::table('quizes')->where('quiz_id', $quiz_id)->increment('no_of_question', 1);
    $value= array(
            'quiz_id'   =>   $quiz_id,
            'question'   =>   $question,
            'answer'   =>     $answer,
            'option1'   =>   $option1,
            'option2'   =>   $option2,
            'option3'   =>   $option3,
     );
     DB::table('quiz_questions')->insert($value);
     return response()->json(
       [
         'success'=>true,
         'quiz_id'=>$quiz_id,
       ]
     );
  }

  public function updateQuiz(Request $request){
    $quiz_id=request('quiz_id');
    $quiz_update = DB::table('quizes')->where('quiz_id', $quiz_id)->update(['status' => '1']);

    return response()->json(
      [
        'success'=>true,
        'message'=>$quiz_update,
      ]
    );
  }

public function getQuestion(Request $request){
    $quiz_id=request('quiz_id');
    $quiz_question = DB::table('quiz_questions')->where('quiz_id', $quiz_id)->get();
    return json_encode(array($quiz_question,$quiz_id));
}
public function deleteQuestion(Request $request){
    $question_id=request('question_id');
    $quiz_id=request('quiz_id');
    $quiz_question = DB::table('quiz_questions')->where('question_id', $question_id)->delete();
    $update_quizes=DB::table('quizes')->where('quiz_id', $quiz_id)->decrement('no_of_question', 1);
    return response()->json(
      [
        'success'=>true,
        'message'=>$quiz_id,
      ]
    );
}
public function deleteQuiz($id){
  $quiz_question = DB::table('quiz_questions')->where('quiz_id', $id)->delete();
  $quiz = DB::table('quizes')->where('quiz_id', $id)->delete();
return redirect('/staff/quiz');
}
public function staffProfile(){
  return view('staff.staffprofile');
}
public function uploadImage(Request $request){
  //dd(request('id')." ". request('userimage'));
  $id=request('id');
  $fname=request('fname');
  $staff=Staff::find($id);
  if ($request->hasFile('userimage')) {
      $image = $request->file('userimage');
      $name = str_replace(' ', '',rand()).$id.'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/images/staff');
      $imagePath = $destinationPath. "/".  $name;
      $image->move($destinationPath, $name);
      $staff->image = $imagePath;
      $staff->save();
  }
  return redirect('/staff/profile');
}
public function  editProfile(Request $request){
  $id=request('staff_id');
  $staff=Staff::find($id);
  $staff->FirstName=request('fname');
  $staff->LastName=request('lname');
  $staff->email=request('email');
  $staff->street=request('street');
  $staff->city=request('city');
  $staff->state=request('state');
  $staff->postcode=request('pcode');
  $staff->country=request('country');
  $staff->PhoneNo=request('phoneno');
  $staff->gender=request('gender');
  $staff->dateofbirth=request('dateofbirth');
  $staff->qualification=request('qualification');
  $staff->save();
  return redirect('/staff/profile');
}
public function changeUsername(){
  $id=request('id');
  $staffLogin=StaffLogin::find($id);
  $staffLogin->email=request('email');
  $staffLogin->save();
  $staff_id=Auth::guard('staff')->user()->staff_id;
  $staff=StaffLogin::find($staff_id);
  $staff->email=request('email');
  $staff->save();
  return redirect('/staff/profile');
}
public function changePassword(Request $request){
  $request->validate([
        'current_password' => ['required'],
        'new_password' => ['required'],
        'new_confirm_password' => ['same:new_password'],
    ]);
    $staff=StaffLogin::find(Auth::guard('staff')->user()->id);
    if (!Hash::check($request->current_password, $staff->password)) {
      return response()->json(
        [
            'success' => false,
            'error' => true,
            'message' => 'Password does not match'
        ]
    );
  }else{
    $staff->password=Hash::make(request('new_password'));
    $staff->save();
    return response()->json(
      [
          'error'=>false,
          'success' => true,
          'message' => 'Password Sucessfully updated'
      ]
      );
  }

}
}
