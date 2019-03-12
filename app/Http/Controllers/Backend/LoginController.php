<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Login;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function getLogin(Request $request) {
        if ($request->session()->has('username')){
            return redirect('admin/dashboard');
        }else {
            return view('backend.login');
        }
    }

    public function postLogin(Request $request){
        if ($request->isMethod('post')) {
            $formData = Input::only('username','password');
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];
            $validator = \Validator::make($formData, $rules);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator->errors());
            }else {
                $arr=[
                    'username' => $request->username,
                    'password'=> $request->password
                ];
                Session::put('username', $request->username);
                $count = DB::table('member')->where($arr)->count();
                if($count == 1 ) {
                    return redirect('admin/dashboard');
                } else {
                    $errors = 'fail';
                    return view('backend.login')->with('errors',$errors);
                }
            }
        }
    }



    public function logout(Request $request){
        if ($request->session()->has('username')) {

            $request->session()->forget('username');
            return redirect('admin/login');
        }
    }
}
