<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Login;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
class DashboardController extends AppController
{
    public function dashboard(Request $request){
        $user = '';
        if ($request->session()->has('username')) {
            $user = Session::get('username');
        }
        $model = DB::table('member')->where("username",$user)->first();
        $role = $model->role;
        if( $user == '' ) {
            return redirect('admin/login');
        }
        if( $role != 1 ) {
            return redirect('admin/logout');
        }
        return view('backend.dashboard')->with('user',$user);
    }
}
