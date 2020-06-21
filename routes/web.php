<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/prfoile', function () {
    return view('admin/adminprofile');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/send', 'AdminController@sendNotification')->name('send');


Route::get('/admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
Route::get('/adminlogout','Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/admin/staff','AdminController@staffReg')->name('admin.staff');
Route::get('/admin/stafflist','AdminController@staffList')->name('admin.stafflist');
Route::get('/admin/studentList','AdminController@studentList')->name('admin.studentList');
Route::get('/admin/studentenroll','AdminController@studentEnroll')->name('admin.enroll');
Route::get('/admin/newstudent','AdminController@newStudent')->name('admin.newStudent');
Route::post('/admin/staff','AdminController@createStaff')->name('admin.staff.submit');
Route::get('/approvestundet/{id}','AdminController@approveStudent')->name('admin.student.approve');
Route::get('/declinestudent/{id}','AdminController@declineStudent')->name('admin.student.decline');
Route::post('/staff/create','AdminController@createPassword')->name('staff.createPassword');
Route::get('/deletestaff/{id}','AdminController@deleteStaff')->name('admin.staff.deleteStaff');
Route::get('/deletestudent/{id}','AdminController@deleteStudent')->name('admin.deletestudent');
Route::get('/admin/profile','AdminController@adminProfile')->name('admin.adminprofile');
Route::post('/admin/prfoile/edit','AdminController@editProfile')->name('admin.profile.edit');
Route::get('/admin/courses','AdminController@Courses')->name('admin.courcces');
Route::post('/admin/createcourses','AdminController@createCourses')->name('admin.create.courses');
Route::get('/deletecourses/{id}','AdminController@deleteCourses')->name('admin.courses.deletecourses');
Route::get('/admin/schedule','AdminController@Schedule')->name('admin.schedule');
Route::post('/admin/createschedule','AdminController@createSchedule')->name('admin.create.schedule');
Route::get('/deleteschedule/{id}','AdminController@deleteSchedule')->name('admin.schedule.deleteschedule');
Route::post('/editschedule','AdminController@editSchedule')->name('admin.schedule.edit');
Route::get('/editcourses','AdminController@editCourses')->name('admin.courses.edit');
Route::get('/admin/resources','AdminController@Resources')->name('admin.resources');
Route::post('/admin/createresources','AdminController@createResources')->name('admin.create.resources');
Route::get('/deleteresources/{id}','AdminController@deleteResources')->name('admin.schedule.deleteresources');
Route::post('/admin/changeusername','AdminController@changeUsername')->name('admin.changeusername');
Route::get('admin/changepassword', 'AdminController@changePassword')->name('change.password');
Route::post('admin/assigncourses','AdminController@assignCourses')->name('admin.assigncourses');
Route::get('/admin/getstaff','AdminController@getStaff')->name('admin.getstaff');
Route::get('/admin/delete/assignstaff','AdminController@deleteAssignStaff')->name('admin.deleteassigncourse');
Route::post('/admin/saveimage','AdminController@uploadImage')->name('admin.saveimage');
Route::get('/admin/attedance_report', 'AdminController@attendaceReport')->name('admin.report');
Route::get('/enrollstatus/{id}','AdminController@enrollStaus')->name('change_enrollStatus');
Route::get('/admin/getattendancereport','AdminController@getattendanceReport')->name('admin.attendace_report');

Route::get('/login','Auth\LoginController@Showlogin')->name('login');
//staff
Route::get('staff/setpassword/{id}','AdminController@showPassword');
Route::post('staff/createpassword','Auth\StaffRegisterController@create')->name('staff.createpassword');
Route::post('/login','Auth\LoginController@login')->name('login');
Route::get('/staff/logout','Auth\LoginController@stafflogout')->name('staff.logout');
Route::get('/staff', 'StaffController@index')->name('staff.dashboard');
Route::get('/staff/calendar', 'StaffController@Calendar')->name('staff.calendar');
Route::get('/staff/createvent', 'StaffController@creatEvent')->name('staff.createvent');
Route::get('/staff/getevent', 'StaffController@getEvent')->name('staff.getevent');
Route::get('/staff/attendance', 'StaffController@showAttendance')->name('staff.attendance');
Route::get('/staff/getattendancecode', 'StaffController@getAttendanceCode');
Route::get('/staff/assignment', 'StaffController@showAssignment')->name('staff.assignment');
Route::get('/staff/newassignment', 'StaffController@newAssignment')->name('staff.newassignment');
Route::post('/staff/creatassignment', 'StaffController@creatAssignment')->name('staff.creatassignment');
Route::get('/staff/deleteassignment/{id}','StaffController@deleteAssignment')->name('staff.deleteassignment');
Route::post('/staff/editassignment', 'StaffController@editAssignment')->name('staff.editassignment');
Route::get('/staff/feedback', 'StaffController@showFeedback')->name('staff.feedback');
Route::get('/staff/getassignmentId', 'StaffController@getAssignment');
Route::get('/staff/getassignmentlist', 'StaffController@getAssignmentList');
Route::get('/staff/makefeedback/{id}', 'StaffController@makeFeedback')->name('staff.makefeedback');
Route::post('/staff/createfeedback', 'StaffController@createFeedback')->name('staff.createfeedback');
Route::get('/staff/quiz', 'StaffController@showQuiz')->name('staff.showquiz');
Route::get('/staff/createquiz', 'StaffController@createQuiz')->name('staff.createquiz');
Route::get('/staff/createquizcat', 'StaffController@createQuizCat')->name('staff.createquizcat');
Route::get('/staff/createquizquestion', 'StaffController@createQuizQuestion')->name('staff.createquizquestion');
Route::get('/staff/updatequiz', 'StaffController@updateQuiz')->name('staff.updatequiz');
Route::get('/staff/getquestion', 'StaffController@getQuestion')->name('staff.getquestion');
Route::get('/staff/deletequestion', 'StaffController@deleteQuestion')->name('staff.deletequestion');
Route::get('/staff/quiz/deletequiz/{id}','StaffController@deleteQuiz')->name('staff.quiz.deletequiz');
Route::get('/staff/updatequizquestion', 'StaffController@updateQuizQuestion')->name('staff.updatequizquestion');
Route::get('/staff/profile','StaffController@staffProfile')->name('staff.staffprofile');
Route::post('/staff/saveimage','StaffController@uploadImage')->name('staff.saveimage');
Route::post('/staff/prfoile/edit','StaffController@editProfile')->name('staff.profile.edit');
Route::post('/staff/changeusername','StaffController@changeUsername')->name('staff.changeusername');
Route::get('staff/changepassword', 'StaffController@changePassword')->name('staff.change.password');


Route::post('/student/prfoile/edit','StudentController@editProfile')->name('student.profile.edit');
Route::post('/student/saveimage','StudentController@uploadImage')->name('student.saveimage');


Route::get('/student/profile','StudentController@studentProfile')->name('student.profile');
Route::get('/student/grade','StudentController@studentGrade')->name('student.grade');
Route::get('/student/getgrade/{id}','StudentController@getGrade');



//students
Route::get('/student', 'StudentController@index')->name('student.dashboard');
Route::get('/logout','Auth\LoginController@studentlogout')->name('student.logout');
Route::get('/student/calendar', 'StudentController@Calendar')->name('student.calendar');
Route::get('/student/createvent', 'StudentController@creatEvent')->name('student.createvent');
Route::get('/student/getevent', 'StudentController@getEvent')->name('student.getevent');
Route::get('/student/courses', 'StudentController@courseList')->name('student.courses');
Route::post('/student/newenroll', 'StudentController@newEnroll')->name('student.newenroll');
Route::get('/student/attendance', 'StudentController@showAttendance')->name('student.attendance');
Route::get('/student/getAttendanceCode', 'StudentController@getAttendanceCode')->name('student.getattendance');
Route::get('/student/makeattendance', 'StudentController@makeAttendance')->name('student.makeattendance');
Route::get('/register', 'Auth\LoginController@Register')->name('student.register');
Route::post('/register', 'Auth\LoginController@makeRegister')->name('register');

Route::get('/home', 'HomeController@index')->name('home');



//moodle

  Route::get('/course/moodle/{id}', 'MoodleController@index')->name('moodle.page');
  Route::get('/moodle/assignment', 'MoodleController@showAssignment')->name('student.assignment');
  Route::post('/moodle/assignment/', 'MoodleController@submitAssignment')->name('student.submitassignment');
  Route::get('/moodle/quiz', 'MoodleController@showQuiz')->name('student.showquiz');
  Route::post('/moodle/submitquiz', 'MoodleController@submitQuiz')->name('student.submitquiz');
