<?php

namespace App\Http\Controllers\backend;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AnswersController extends AppController
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
        /*$data = DB::table('question')
            ->leftJoin('language', 'question.language_id', '=', 'language.language_id')
            ->where('question.del_flag',0)
            ->get();*/
        return view("backend.answer")->with([
            'user' => $user,
            /*'data' => $data*/
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    {
        $user = '';
        if ($request->session()->has('username')) {
            $user = Session::get('username');
        }
       /* $data_answer = DB::table('answer')
            ->where('del_flag',0)
            ->get();*/
        $cb_question = DB::table('question')
           // ->leftJoin('question', 'answer.question_id', '=', 'question.question_id')
            ->where('question.del_flag',0)
            ->get();
        return view("backend.answer.add")->with([
            'user' => $user,
            'cb_question' => $cb_question,
            'question_key' => $id
        ]);
    }

    public function refer_question(Request $request) {
        if($request->ajax()){
            $question_id = $request->question_key;
            $data = DB::table('answer')
                ->where('answer.question_id', $question_id)
                ->where('answer.del_flag',0)
                ->get();
            /*return response()->json([
                'refer_data' => isset($data[0])?$data[0]:''
            ]);*/

            return response()->json([
                'refer_data' => isset($data)?$data:''
            ]);

        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Trường :attribute bắt buộc nhập.',
        ];
        $validator = Validator::make($request->all(), [
            'ans_correct' => 'required|max:255',
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/answer/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = new Answer();
            $question_id = $request->question_id;
            for($i=1;$i<=4;$i++) {
                $ans_1
            }
            $ans_1   = $request->ans_1;
            $ans_correct1 = $request->ans_correct1;
            $ans_2   = $request->ans_2;
            $ans_correct2 = $request->ans_correct2;
            ans_correct1
            $ans_correct = $request->ans_correct;
            /*$result = DB::table('answer')
                ->where("question_id",$question_id)
                ->update([
                       "ans_a"       => $ans_a
                    ,   "ans_b"       => $ans_b
                    ,   "ans_c"       => $ans_c
                    ,   "ans_d"       => $ans_d
                    ,   "ans_correct" => $ans_correct
                ]);*/

            if($data->save()){
                $request->session()->flash('alert-success', 'Thêm mới thành công!');
                return redirect('admin/answer');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
