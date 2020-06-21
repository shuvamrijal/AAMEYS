<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
class AdminLoginController extends Controller
{
    //
    public function __construct(){
      $this->middleware('guest:admin',['except'=>['logout']]);
    }
    public function showLoginForm(){
    $admin=Admin::all();
    if($admin->isEmpty()){
        $admin=new Admin;
        $admin->username='admin';
        $admin->password=Hash::make('admin');
        $admin->save();
    }
    return view('admin.adminLogin');
    }
    public function login(Request $request){
      if(Auth::guard('admin')->attempt(['username'=>$request->username,'password'=>$request->password])){
        return redirect()->intended(route('admin.dashboard'));
      }
      return redirect()->back()->withInput($request->only('username'));
    }
    public function logout(){
      Auth::guard('admin')->logout();
      return redirect('/admin/login');
    }
}
