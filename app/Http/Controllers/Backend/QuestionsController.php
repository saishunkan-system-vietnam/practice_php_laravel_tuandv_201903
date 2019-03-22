<?php

namespace App\Http\Controllers\backend;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends AppController
{
    /**
     * show information
     *
     * @author : tuantv - 2019/03/11 - create
     * @author :
     * @return : null
     * @access : public
     * @see :
     */
    public function index(Request $request)
    {
        $user = '';
        if ($request->session()->has('username')) {
            $user = Session::get('username');
        }

        if ($request->session()->has('lang_session')){
            $lang_id_session = Session::get('lang_session');
        }else {
            $lang_id_session = '';
        }
        $data_language = DB::table('language')
            ->where('language.del_flag',0)
            ->get();

        $data = DB::table('question')
            ->leftJoin('language', 'question.language_id', '=', 'language.language_id')
            ->where('question.del_flag',0)
            ->get();

        return view("backend.question")->with([
            'user'            => $user,
            'data_language'   => $data_language,
            'data'            => $data,
            'lang_id_session' => $lang_id_session
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = '';
        if ($request->session()->has('username')) {
            $user = Session::get('username');
        }
        $data_language = DB::table('language')
            ->where('del_flag',0)
            ->get();


        return view("backend.question.add")->with([
            'user' => $user,
            'data_language' => $data_language
        ]);
    }

    /**
     * refer language
     *
     * @author : tuantv - 2019/03/13 - create
     * @author :
     * @return : null
     * @access : public
     * @see :
     */
    public function refer_language(Request $request) {
        Session::put('lang_session', $request->language_id);
        $language_id = $request->session()->get('lang_session');
        $data = Question::where('language_id', $language_id)->get();
        $view = view('backend.question.refer_language')
            ->with('data_language', $data)->render();
        return response()->json([
            'view_language' => $view
        ]);
    }

    /**
     * save
     *
     * @author : tuantv - 2019/03/11 - create
     * @author :
     * @return : null
     * @access : public
     * @see :
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Trường :attribute bắt buộc nhập.',
        ];
        $validator = Validator::make($request->all(), [
            'question_nm' => 'required|max:255',
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/question/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = new Question();
            $data->question_nm      = $request->question_nm;
            $data->question_code    = htmlentities($request->question_code);
            $data->language_id      = $request->language_id;
            $data->del_flag         = 0;
            $data->save();

            if($data->save()){
                $request->session()->flash('alert-success', 'Thêm mới thành công!');
                return redirect('admin/question');
            }
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
     * update
     *
     * @author : tuantv - 2019/03/11 - create
     * @author :
     * @return : null
     * @access : public
     * @see :
     */

    public function update(Request $request, $id = "")
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
     * process update
     *
     * @author : tuantv - 2019/03/11 - create
     * @author :
     * @return : null
     * @access : public
     * @see :
     */
    public function process_update(Request $request){
        $question_id = $request ->question_id;
        $question_nm = $request ->question_nm;
        $question_code = htmlentities($request->question_code);
        $language_id = $request ->language_id;
        $result = DB::table('question')
            ->where("question_id",$question_id)
            ->update([
                    "question_nm" => $question_nm
                ,   "question_code" => $question_code
                ,   "language_id" => $language_id
            ]);
        if($result){
            $request->session()->flash('alert-success', 'Sửa đổi thành công!');
        }else {
            $request->session()->flash('alert-success', 'Sửa đổi thất bại!');
        }
        //return redirect('admin/question');
        return response()->json();
    }


    /**
     * Delete
     *
     * @author : tuantv - 2019/03/11 - create
     * @author :
     * @return : null
     * @access : public
     * @see :
     */
    public function destroy($id)
    {
        $del_flag = 1; // row deleted = 1
        $result = DB::table('question')
            ->where("question_id",$id)
            ->update([
                "del_flag" => $del_flag
            ]);

        if($result){
            return redirect('admin/question');
        }
    }
}
