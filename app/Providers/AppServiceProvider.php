<?php

namespace App\Providers;
use App\AdminProfile;
use App\Staff;
use App\Admin;
use App\Student;
use auth;
use DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer('admin/*', function ($view) {
        $adminprofile=AdminProfile::all();
        $admin=Admin::first();
        $data = array();
        foreach ($admin->unreadNotifications as $notification) {
          array_push($data,$notification->data['message'],true);
        }
        $view->with(['adminprofile'=>$adminprofile,'data'=>$data]);
      });
      view()->composer('staff/*', function ($view) {
        if (Auth::guard('staff')->check()) {
          $id=Auth::guard('staff')->user()->id;
          $staff=Staff::where('staff_id',$id)->get();
          $view->with('staff', $staff);
        }
      });
      view()->composer('student/*', function ($view) {
        if (Auth::guard('student')->check()) {
          $id=Auth::guard('student')->user()->studentId;
          $student=Student::where('studentId',$id)->get();
          $sch = DB::table('enroll_courses')->where('enroll_courses.studentId',$id)
          ->join('courses', 'enroll_courses.cources_id', '=', 'courses.courses_id')
          ->join('schedules', 'courses.courses_id', '=', 'schedules.courses_id')
          ->select('courses.*')
          ->get();
          $mycourses=json_decode($sch, true);
          $view->with(['student'=>$student,'mycourses'=>$mycourses]);
        }
      });
    }
}
