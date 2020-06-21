<?php

namespace App\Http\Controllers;
use Auth;
use App\Student;
use App\Event;
use App\Courses;
use App\AttendanceCode;
use App\EnrollCourse;
use App\Attendance;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       $this->middleware('auth:student');
     }
    public function index()
    {
      $id=Auth::guard('student')->user()->studentId;
      $sch = DB::table('enroll_courses')->where('enroll_courses.studentId',$id)
      ->join('courses', 'enroll_courses.cources_id', '=', 'courses.courses_id')
      ->join('schedules', 'courses.courses_id', '=', 'schedules.courses_id')
      ->select('courses.*','schedules.*')
      ->get();
      $courses=json_decode($sch, true);
    return view('student.dashboard',compact('courses'));
    }

    public function Calendar(){
      $event=Event::all()->toArray();
      return view('student.calender',compact('event'));
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

    public function courseList(){
      $id=Auth::guard('student')->user()->studentId;
      $staff = DB::table('assigncourses')
            ->join('staff', 'staff.staff_id', '=', 'assigncourses.staff_id')
            ->join('courses', 'courses.courses_id', '=', 'assigncourses.cources_id')
            ->select('staff.*','assigncourses.cources_id','courses.*','courses.courses_id AS corId')
            ->get();
      $courses = json_decode($staff, true);
      $enroll_course=DB::table('enroll_courses')->where('enroll_courses.studentId','=',$id)->get();
      $result = json_decode($enroll_course, true);
      $arrayName = array();
      $flag=0;
      $d=0;
      if($result ==null){
        $flag=0;
        foreach ($courses as $key => $value) {

          array_push($arrayName,array('courses_id'=>$value['corId'],'CourseName'=>$value['CourseName'],'Staff_name'=>$value['FirstName'].' '.$value['LastName']));
        }
      }else{
        foreach ($courses as $key => $value) {
            foreach ($result as $key => $val) {
                  if($value['corId']==$val['cources_id']){
                    $arrayName=array();
                    if($d==1){
                          $flag=0;
                    }else{
                      $flag=1;
                    }
                  }else{
                  $d=1;
                  $flag=0;
                  array_push($arrayName,array('courses_id'=>$value['corId'],'CourseName'=>$value['CourseName'],'Staff_name'=>$value['FirstName'].' '.$value['LastName']));
                  }
            }
        }
      }


      return view('student.courseslist',compact('arrayName'));
    }
    public function newEnroll(Request $request){
      $enroll=new EnrollCourse;
      $enroll->cources_id=request('courses_id');
      $enroll->studentId=Auth::guard('student')->user()->studentId;
      $enroll->save();
      return redirect('/student/courses');
    }

    public function showAttendance(){

      $id=Auth::guard('student')->user()->studentId;
      $sch = DB::table('enroll_courses')->where('enroll_courses.studentId',$id)
      ->join('courses', 'enroll_courses.cources_id', '=', 'courses.courses_id')
      ->join('schedules', 'courses.courses_id', '=', 'schedules.courses_id')
      ->select('courses.*','schedules.*')
      ->get();
      $courses=json_decode($sch, true);
      return view('student.attendance',compact('courses'));
    }
    public function getAttendanceCode(Request $request){
      $courses_id=request('courses_id');
      $id=Auth::guard('student')->user()->studentId;
      $sch = DB::table('enroll_courses')->where('enroll_courses.studentId',$id)
            ->join('courses', 'enroll_courses.cources_id', '=', 'courses.courses_id')->where('courses.courses_id',$courses_id)
            ->join('schedules', 'courses.courses_id', '=', 'schedules.courses_id')
            ->select('courses.*','schedules.*')
            ->get();
      $schedule=json_decode($sch, true);
      $start_time;
      $end_time;
      $day;
      foreach ($schedule as $key => $value) {
          $start_time=$value['Start_time'];
          $end_time=$value['End_time'];
          $day=$value['DaysOfWeek'];
      }
      $value = config('app.timezone');
      $current_time=Carbon::now($value);
      $now_time=$current_time->format( 'H:i:s' );
      $today=$current_time->format( 'l' );
      if($day==$today){
          if ($now_time > $start_time && $now_time < $end_time){
                $attendance_code=AttendanceCode::all()->where('cources_id',1)->toArray();
                foreach ($attendance_code as $key => $value) {
                      $code = array('value' =>$value['attendance_code']);
                      $status=true;
            }
          }else{
            $status=false;
            $code='No running class in this cources';
          }
      }else{
        $status=false;
        $code='No running class in this cources';
      }

      return response()->json(
        [
            'success' => $status,
            'message' => $code,
            'courses_id'=>$courses_id
        ]
    );
    }


    public function studentProfile(){
      return view('student.profile');
    }

public function editProfile(Request $request){
  $id=Auth::guard('student')->user()->studentId;
  $student=Student::find($id);
  $student->Name=request('name');
  $student->Email=request('email');
  $student->PhoneNo=request('phoneno');
  $student->address=request('address');
  $student->gender=request('gender');
  $student->dateofbirth=request('dob');
  $student->save();
  return redirect('/student/profile');

}
public function uploadImage(Request $request){

  //dd(request('id')." ". request('userimage'));
  $id=Auth::guard('student')->user()->studentId;
  $student=student::find($id);
  if ($request->hasFile('userimage')) {
      $image = $request->file('userimage');
      $name = str_replace(' ', '',rand()).$id.'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/images/student');
      $imagePath = $destinationPath. "/".  $name;
      $image->move($destinationPath, $name);
      $student->image = $imagePath;
      $student->save();
  }
  return redirect('/student/profile');
}
  public function makeAttendance(Request $request){
  $courses_id=request('courses_id');
  $staff_id;
  $student_id=Auth::guard('student')->user()->studentId;
  $staff=DB::table('assigncourses')->where('cources_id',$courses_id)->get()->toArray();
  foreach ($staff as $key => $value) {
    $staff_id=$value->staff_id;
  }


  $value = config('app.timezone');
  $current_time=Carbon::now($value);
  $attendance_date=$current_time->format('Y-m-d h:i:s');

  $attendance_value=DB::table('attendances')
                    ->where('cources_id',1)
                    ->where('studentId',1)
                    ->get();
  $attendanceDate;
  $now_date=$current_time->format('Y-m-d');
  foreach ($attendance_value as $key => $value) {
  $attendanceDate=date("Y-m-d", strtotime($value->attendance_date));
  }
  if($attendanceDate==$now_date){
    $message='Your Attendance already done';
  }else{
    $attendance=new Attendance;
    $attendance->cources_id=$courses_id;
    $attendance->staff_id=$staff_id;
    $attendance->attendance_date=$attendance_date;
    $attendance->studentId=$student_id;
    $attendance->save();
    $message='Attendance Sucessfully done';
  }
  return response()->json(
    [
        'success' => true,
        'message' => $message,
    ]
);
}
public function studentGrade(){
  $id=Auth::guard('student')->user()->studentId;
  $sch = DB::table('enroll_courses')->where('enroll_courses.studentId',$id)
  ->join('courses', 'enroll_courses.cources_id', '=', 'courses.courses_id')
  ->join('schedules', 'courses.courses_id', '=', 'schedules.courses_id')
  ->select('courses.*')
  ->get();
  $courses=json_decode($sch, true);
  return view('student.grade',compact('courses'));
}
public function getGrade($id){
  $courses_id=$id;
  $student_id=Auth::guard('student')->user()->studentId;
  $courses=Courses::find($id)->all()->toArray();
  $assignment_grade=DB::table('assignments')->where('assignments.cources_id',$courses_id)
        ->join('assignment_lists','assignment_lists.assign_id','=','assignments.id')
        ->join('feedback','assignments.id','=','feedback.assign_id')  ->where('feedback.studentId',$student_id)
        ->select('feedback.*','assignments.*')
        ->get();

  $quiz_grade=DB::table('quizes')->where('quizes.cources_id',$courses_id)
              ->join('quiz_results','quiz_results.quiz_id','=','quizes.quiz_id')->where('quiz_results.studentId',$student_id)
              ->select('quiz_results.*','quizes.*')
              ->get();
$assignment_grade=json_decode($assignment_grade, true);
$quiz_grade=json_decode($quiz_grade, true);
return view('student.gradelist',compact(['courses','assignment_grade','quiz_grade']));
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {

    }
}
