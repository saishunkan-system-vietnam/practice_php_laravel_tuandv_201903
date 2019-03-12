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

        /*$param = $request->param;
        switch($param){
            case 'language':
                return view('backend.language')->with([
                    'user'=>$user
                ]);
                break;
            case 'question':
                return view('backend.question')->with([
                    'user'=>$user
                ]);
                break;
            case 'answer':
                return view('backend.answer')->with([
                    'user'=>$user
                ]);
                break;
            case 'member':
                return view('backend.member')->with([
                    'user'=>$user
                ]);
                break;
            default:
                break;
        }*/
        return view('backend.dashboard')->with('user',$user);
    }
}
