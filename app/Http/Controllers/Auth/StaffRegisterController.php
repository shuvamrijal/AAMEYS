<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use App\StaffLogin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffRegisterController extends Controller
{




      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
          $this->middleware('guest');
      }

      /**
       * Get a validator for an incoming registration request.
       *
       * @param  array  $data
       * @return \Illuminate\Contracts\Validation\Validator
       */
      protected function validator(array $data)
      {
          return Validator::make($data, [
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
              'password' => ['required', 'string', 'min:8', 'confirmed'],
          ]);
      }

      /**
       * Create a new user instance after a valid registration.
       *
       * @param  array  $data
       * @return \App\User
       */
      protected function create(Request $request)
      {
        $request->validate([
              'email' => ['required'],
              'password' => ['required'],
              'repassword' => ['same:password'],
          ]);
           StaffLogin::create([
              'staff_id'=>request('staff_id'),
              'email' => request('email'),
              'password' => Hash::make(request('password'))
          ]);
           return redirect('/login');;
      }
  }
