<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Login;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
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

            $messages = [
                'required' => 'Trường :attribute bắt buộc nhập.',
            ];
            $validator = Validator::make($request->all(), [
                'username' => 'required|max:60',
                'password' => 'required|max:60',
            ], $messages);

            if ($validator->fails()) {
                return redirect('admin/login')
                    ->withErrors($validator)
                    ->withInput();
            } else {
           /* }
            $formData = Input::only('username','password');
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];
            $validator = \Validator::make($formData, $rules);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator->errors());
            }else {*/
                $arr_admin=[
                    'username'  => $request->username,
                    'password'  => $request->password,
                    'role'      =>  1
                ];
                $arr_member=[
                    'username'  => $request->username,
                    'password'  => $request->password,
                    'role'      =>  2
                ];
                Session::put('username', $request->username);
                $count_admin = DB::table('member')->where($arr_admin)->count();
                $count_member = DB::table('member')->where($arr_member)->count();
                if($count_member > 0) {
                    return redirect('home/exercise');
                } else {
                    if($count_admin > 0) {
                        return redirect('admin/dashboard');
                    } else {
                        $errors = 'fail';
                        return view('backend.login')->with('errors',$errors);
                    }
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
