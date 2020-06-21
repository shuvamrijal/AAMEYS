<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Student;
class LoginController extends Controller
{
    //
    public function __construct(){
      $this->middleware('guest:staff',['except'=>['stafflogout']]);
      $this->middleware('guest:student',['except'=>['studentlogout']]);
    }

    public function Register(){
      return view('register');
    }
    public function Showlogin(){
    return view('login');
    }
    public function makeRegister(Request $request){

      $student=new Student();
      $student->Name=request('name');
      $student->Email=request('email');
      $student->PhoneNo=request('phoneno');
      $student->address=request('address');
      $student->gender=request('gender');
      $student->dateofbirth=request('dob');
      $student->status='0';
      $student->image='';
      $student->save();
      return view('sucess_register');
    }

    public function login(Request $request){
      if(Auth::guard('staff')->attempt(['email'=>$request->email,'password'=>$request->password])){
        return redirect()->intended(route('staff.dashboard'));
      }else if(Auth::guard('student')->attempt(['username'=>$request->email,'password'=>$request->password])){
        return redirect()->intended(route('student.dashboard'));
      }
      return redirect()->back()->withInput($request->only('username'));
    }
    public function studentlogout(){
      Auth::guard('student')->logout();
      return redirect('/login');
    }

    public function stafflogout(){
      Auth::guard('staff')->logout();
      return redirect('/login');
    }
}
