<?php

namespace App\Http\Controllers\backend;

use App\Assign;
use App\Member;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;
use SebastianBergmann\CodeCoverage\Report\Html;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AssignsController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = '';
        if ($request->session()->has('username')) {
            $user = Session::get('username');
        }

        $data = DB::table('assign')
            ->select(
                'assign.assign_id'
            ,   'assign.member_id'
            ,   'member.username'
            ,   'assign.language_id'
            ,   'language.language_nm'
            )
            ->leftJoin('member', 'assign.member_id', '=', 'member.member_id')
            ->leftJoin('language', 'assign.language_id', '=', 'language.language_id')
            ->where('assign.del_flag',0)
            ->get();
        return view("backend.assign")->with([
            'user' => $user,
            'data' => $data
        ]);
    }

    public function create(Request $request,$id)
    {
        $user = '';
        if ($request->session()->has('username')) {
            $user = Session::get('username');
        }
        $model_member = Member::where('member_id',$id)->first();
        /*var_dump($model_member);
        die();*/
        $model_language= Language::where('language_parent','!=',0)->get();
        return view("backend.assign.add")->with([
            'user'        => $user,
            'model_member'   => $model_member,
            'model_language' => $model_language
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Assign();
        $data->member_id      = $request->language_id;
        $data->language_id    = $request->language_id;
        $data->del_flag       = 0;
        $data->save();

        if($data->save()){
            $request->session()->flash('alert-success', 'Thêm mới thành công!');
            return redirect('admin/assign');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $assign_id, $member_id)
    {
        
        $user = '';
        if ($request->session()->has('username')) {
            $user = Session::get('username');
        }

        $combo_language = DB::table('language')
            ->where('language.del_flag',0)
            ->orderBy('language.language_id', 'desc')
            ->get();

        $data = Question::leftJoin('language', function($join) {
            $join->on('question.language_id', '=', 'language.language_id');
        })
            ->where('question.question_id',$id)
            ->first([
                'question.question_id',
                'question.question_nm',
                'question.question_code',
                'question.language_id',
                'language.language_nm',
                'question.del_flag',
                'language.del_flag',
            ]);
        return view("backend.question.update")->with([
            'user'           => $user,
            'combo_language' => $combo_language,
            'data'           => $data
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}