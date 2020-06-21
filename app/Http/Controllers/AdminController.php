<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Student;
use App\StudentLogin;
use Mail;
use Auth;
use Hash;
use View;
use DB;
use Crypt;
use Redirect;
use Notification;
use App\Notifications\NewUserNotification;
use App\Admin;
use App\AdminProfile;
use App\Courses;
use App\Schedule;
use App\Resources;
use DateTime;
use App\Attendance;
use App\EnrollCourse;
use App\Rules\MatchOldPassword;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $id=Auth::guard('admin')->user()->id;
      $admin=AdminProfile::all();
      if($admin->isEmpty()){
          $admin=new AdminProfile;
          $admin->admin_id=$id;
          $admin->FirstName="";
          $admin->LastName="";
          $admin->email="";
          $admin->street="";
          $admin->city="";
          $admin->state="";
          $admin->postcode="";
          $admin->PhoneNo="";
          $admin->image="";
          $admin->country="";
          $admin->gender="";
          $admin->dateofbirth="";
          $admin->status=1;
          $admin->save();
      }
      $student=Student::all()->toArray();
      $staff=Staff::all()->toArray();
      $courses=Courses::all()->toArray();
      return view('admin.dashboard',compact(['student', 'staff','courses']));
    }

    public function staffReg(){
      return view('admin.staffregi');
    }
    public function createStaff(Request $request){
      $staff= new Staff;
      $name=request('fname').' '.request('lname');
      $staff->FirstName=request('fname');
      $staff->LastName=request('lname');
      $staff->phoneno=request('phone');
      $staff->street=request('street');
      $staff->city=request('city');
      $staff->state=request('state');
      $staff->postcode=request('postcode');
      $staff->country=request('country');
      $staff->gender=request('gender');
      $mail=request('email');
      $staff->email=request('email');
      $staff->image='';
      $staff->dateofbirth=request('dob');
      $to_name =$name;
      $to_email =$mail;
      $staff->save();
      $id=DB::getPdo()->lastInsertId();
      $link=asset('staff/setpassword/'.Crypt::encrypt($id));
      $data = array('name'=>$link, 'body' => 'Welcome to AAMEYS');
        Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('Create a new Password');
        $message->from('shuvam.rijal@gmail.com','Welcome to AAMEYS');
      });

      return redirect('/admin/stafflist');
    }
    public function showPassword($id){
      $encvalue=Crypt::decrypt($id);
      $staff=Staff::find($encvalue);
      $staff_value= json_decode($staff, true);
      return view('admin.staffSetPassword',compact('staff_value'));
    }
    public function createPassword(){
      return ('Hello');
    }
    public function staffList(){
      $staff=Staff::all()->toArray();
      return view('admin.staff',compact('staff'));
    }
    public function deleteStaff($id){
      DB::delete('delete from assignment_lists where staff_id = ?',[$id]);
      DB::delete('delete from attendances where staff_id = ?',[$id]);
      DB::delete('delete from feedback where staff_id = ?',[$id]);
      DB::delete('delete from schedules where staff_id = ?',[$id]);
      DB::delete('delete from staff_logins where staff_id = ?',[$id]);
      DB::delete('delete from assigncourses where staff_id = ?',[$id]);
      $staff=Staff::find($id);
      $staff->delete();
      $staff=Staff::all()->toArray();
    return redirect('/admin/stafflist');
    }
    public function deleteStudent($id){
      DB::delete('delete from assignment_lists where studentId = ?',[$id]);
      DB::delete('delete from attendances where studentId = ?',[$id]);
      DB::delete('delete from feedback where studentId = ?',[$id]);
      DB::delete('delete from quiz_results where studentId = ?',[$id]);
      DB::delete('delete from student_logins where studentId = ?',[$id]);
      DB::delete('delete from enroll_courses where studentId = ?',[$id]);
      $student=Student::find($id);
      $student->delete();
      return redirect('admin/studentList');
    }

    public function studentList(){
      $student=DB::table('students')
              ->join('student_logins','students.studentId', '=', 'student_logins.studentId')
              ->select('students.*','student_logins.username')
              ->get();
      $student=json_decode($student,true);
      return view('admin.studentList',compact('student'));
    }
    public function newStudent(){
      $student=Student::all()->toArray();
      return view('admin.enrollstudent',compact('student'));
    }
    public function approveStudent($id){
      $now = new DateTime();
      $year = $now->format("Y");
      $month=$now->format("m");
      $student=Student::find($id);
      $student_login=new StudentLogin();
      $id=$student->studentId;
      $student_id=$year.''.$month.''.$id;
      $student_email=$student->email;
      $studnet_password=Hash::make($student_id);
      $student_login->studentId=$id;
      $student_login->username=$student_id;
      $student_login->password=$studnet_password;
      $student_login->save();
      $student->status='1';
      $student->save();
      $to_name =$student->Name;
      $to_email =$student->email;
      $data = array('name'=>$student_id, 'body' => 'Welcome to AAMEYS');
        Mail::send('enrollmail', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('Create a new Password');
        $message->from('shuvam.rijal@gmail.com','Welcome to AAMEYS');
      });
      return redirect('/admin/newstudent');
    }
    public function declineStudent($id){
      $student=Student::find($id);
      $student->status='2';
      $student->save();
      return redirect('/admin/newstudent');
    }
    public function adminProfile(){
      $adminprofile=AdminProfile::all()->toArray();
      return view('admin.adminprofile',compact('adminprofile'));
    }
    public function  editProfile(Request $request){
      $id=request('id');
      $admin=AdminProfile::find($id);
      $admin->FirstName=request('fname');
      $admin->LastName=request('lname');
      $admin->email=request('email');
      $admin->street=request('street');
      $admin->city=request('city');
      $admin->state=request('state');
      $admin->postcode=request('pcode');
      $admin->country=request('country');
      $admin->PhoneNo=request('phoneno');
      $admin->gender=request('gender');
      $admin->dateofbirth=request('dateofbirth');
      $admin->status=1;
      $admin->save();
      return redirect('/admin/profile');
    }


    public function uploadImage(Request $request){
      //dd(request('id')." ". request('userimage'));
      $id=request('id');
      $fname=request('fname');
      $admin=AdminProfile::find($id);
      if ($request->hasFile('userimage')) {
          $image = $request->file('userimage');
          $name = str_replace(' ', '',rand()).$id.'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/images/admin');
          $imagePath = $destinationPath. "/".  $name;
          $image->move($destinationPath, $name);
          $admin->image = $imagePath;
          $admin->save();
      }
      return redirect('/admin/profile');
    }
    public function createCourses(Request $request){
      $courses=new Courses;
      $courses->CourseName=request('coursename');
      $courses->Coursedescription=request('coursedescription');
      $courses->save();

      return redirect('/admin/courses');
    }
    public function getStaff(Request $request){
      $courses_id=request('id');
      $row=request('row');
      $staff = DB::table('staff')
            ->join('assigncourses', 'assigncourses.staff_id', '=', 'staff.staff_id')
            ->where('assigncourses.cources_id', '=',$courses_id )
            ->select('staff.*','assigncourses.cources_id')
            ->get();
      return json_encode(array($staff,$row));
    }
    public function deleteAssignStaff(Request $request){
      $staff_id=request('staff_id');
      $courses_id=request('course_id');
    if(DB::table('assigncourses')->where('staff_id', '=', $staff_id )->where('cources_id','=', $courses_id)->delete()){
        return redirect('/admin/courses');
      }
    }

    public function Courses(){
      $staff=Staff::all()->toArray();
      $courses=Courses::all()->toArray();
      return view('admin.courses',compact(['courses','staff']));
    }
    public function deleteCourses($id){
      DB::delete('delete from assignments where cources_id = ?',[$id]);
      DB::delete('delete from attendance_codes where cources_id = ?',[$id]);
      DB::delete('delete from attendances where cources_id = ?',[$id]);
      DB::delete('delete from enroll_courses where cources_id = ?',[$id]);
      DB::delete('delete from quizes where cources_id = ?',[$id]);
      DB::delete('delete from resources where courses_id = ?',[$id]);
      DB::delete('delete from schedules where courses_id = ?',[$id]);
      $courses=Courses::find($id);
      $courses->delete();
      return redirect('/admin/courses');
    }
    public function editCourses(Request $request){
      $id=request('id');
      $courses=Courses::find($id);
      $courses->CourseName=request('coursename');
      $courses->Coursedescription=request('coursedescription');
      $courses->save();
      return redirect('/admin/courses');
    }
    public function Schedule(){
      $staff=Staff::all()->toArray();
      $courses=Courses::all()->toArray();
      $sch = DB::table('schedules')
            ->join('staff', 'schedules.staff_id', '=', 'staff.staff_id')
            ->join('courses', 'schedules.courses_id', '=', 'courses.courses_id')
            ->select('schedules.*', 'staff.*', 'courses.*','schedules.id as schedules_id')
            ->get();
      $schedule= json_decode($sch, true);
      //dd($schedule);
      return view('admin.schedule',compact(['courses','staff','schedule']));
    }
    public function createSchedule(Request $request){
      $schedule=new Schedule;
      $schedule->courses_id=request('courseid');
      $schedule->staff_id=request('staffid');
      $schedule->Start_time=request('starttime');
      $schedule->End_time=request('endtime');
      $schedule->DaysOfWeek=request('days');
      $schedule->save();
      $admin = Admin::first();
      $admin->notify(new NewUserNotification('Sucessfully Create a schedule'));
      return redirect('/admin/schedule');
    }
    public function editSchedule(){
      $id=request('id');
      $schedule=Schedule::find($id);
      $schedule->courses_id=request('courseid');
      $schedule->staff_id=request('staffid');
      $schedule->Start_time=request('starttime');
      $schedule->End_time=request('endtime');
      $schedule->DaysOfWeek=request('days');
      $schedule->save();
      return redirect('/admin/schedule');
    }

  public function deleteSchedule($id){
    $schedule=Schedule::find($id);
    $schedule->delete();
    return redirect('/admin/schedule');
  }
  public function assignCourses(Request $request){
    DB::table('assigncourses')->insert([
        'cources_id' => request('courses_id'), 'staff_id' => request('staff_id')
    ]);
    return redirect('/admin/courses');
  }


public function Resources(){
  $courses=Courses::all()->toArray();
  $res = DB::table('Resources')
        ->join('courses', 'resources.courses_id', '=', 'courses.courses_id')
        ->select('Resources.*','courses.*')
        ->get();
  $resources= json_decode($res, true);
  //dd($schedule);
  return view('admin.resources',compact(['courses','resources']));
}
public function createResources(Request $request){
  $resources=new Resources;
  $resources->courses_id=request('courseid');
  $cor=Courses::find(request('courseid'));
  $resources->Resources_Name=request('resname');
  $resources->Resources_Path=request('respath');
  $resources->Resources_Description=request('resdesc');
  if ($request->hasFile('respath')) {
      $image = $request->file('respath');
      $name = str_replace(' ', '',rand()).$cor->CourseName.'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/resources/admin');
      $imagePath = $destinationPath. "/".  $name;
      $image->move($destinationPath, $name);
      $resources->Resources_Path = $imagePath;
  }
  $resources->save();
  return redirect('/admin/resources');
}

public function deleteResources($id){
  $resources=Resources::find($id);
  $resources->delete();
  return redirect('/admin/resources');
}

    public function changeUsername(){
      $id=request('id');
      $admin=Admin::find($id);
      $admin->username=request('username');
      $admin->save();
      return redirect('/admin/profile');
    }
    public function changePassword(Request $request){
      $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        $admin=Admin::find(Auth::guard('admin')->user()->id);
        if (!Hash::check($request->current_password, $admin->password)) {
          return response()->json(
            [
                'success' => false,
                'error' => true,
                'message' => 'Password does not match'
            ]
        );
      }else{
        $admin->password=Hash::make(request('new_password'));
        $admin->save();

        return response()->json(
          [
              'error'=>false,
              'success' => true,
              'message' => 'Password Sucessfully updated'
          ]
          );
      }

    }
    public function studentEnroll(){
      $cor = DB::table('enroll_courses')
            ->join('students', 'enroll_courses.studentId', '=', 'students.studentId')
            ->join('courses', 'enroll_courses.cources_id', '=', 'courses.courses_id')
            ->select('enroll_courses.id AS enrollId','students.*', 'courses.*', 'courses.*','enroll_courses.status AS enroll_status')
            ->orderBy('enroll_courses.status','asc')
            ->orderBy('enroll_courses.id', 'ASC')
            ->get();
      $courses= json_decode($cor, true);
      return view('admin.enroll_student',compact('courses'));
    }
    public function enrollStaus($id){
      $enroll=EnrollCourse::find($id);
      $enroll->status='1';
      $enroll->save();
      return redirect('/admin/studentenroll');
    }
    public function attendaceReport(){

      $courses=Courses::all()->toArray();
      return view('admin/attendance_report',compact('courses'));
    }
    public function getattendanceReport(Request $request){
      $courses_id=request('coursesid');
      $date_value=request('attn_date');
      $attendance = DB::table('attendances')->where('cources_id',$courses_id)
                            ->join('students', 'attendances.studentId', '=', 'students.studentId')
                            ->join('courses', 'attendances.cources_id', '=', 'courses.courses_id')
                            ->select('attendances.*','students.*', 'courses.*','attendances.status AS attendance_status')
                            ->orderBy('attendances.id', 'ASC')
                            ->get();
            $courses= json_decode($attendance, true);
            $arrayName = array();
            foreach ($courses as $key => $value) {
                $attendance_date=  $value['attendance_date'];
                $attn_date=date('Y-m-d',strtotime($attendance_date));
                if($attn_date==$date_value){
                    $match_value=true;
                    //dd('match');
                    array_push($arrayName,array('StudentName'=>$value['Name'],'CourseName'=>$value['CourseName'],'date'=>$attn_date,'status'=>$value['attendance_status']));
                }else {
                    $match_value=false;
                }
            }
      return response()->json(
        [
          'success'=>true,
          'value'=>$arrayName,
        ]
      );
    }
}
