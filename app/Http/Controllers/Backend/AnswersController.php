<?php

namespace App\Http\Controllers\backend;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;
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
        parent::__construct();
        $user = $this->username;
        if($user == '') {
            return redirect('admin/login');
        }

        return view("backend.answer")->with([
            'user' => $user,
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
        $query = DB::table('question')
            ->where('question.question_id', $id)
            ->where('question.del_flag',0)
            ->get();
        $data = DB::table('answer')
            ->where('answer.question_id', $id)
            ->where('answer.del_flag',0)
            ->get();
        return view("backend.answer.add")->with([
            'user'        => $user,
            'question_id' => $id,
            'question_nm' => $query[0]->question_nm,
            'data'        => $data
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
        $args = $request->input('ans');
        //dd($args);
        $qID = $request->input('question_id');
        try{
            foreach($args as $row) {
                $data = new Answer();
                $ans_correct = isset($row['ans_correct']) ? $row['ans_correct'] : 0;
                if (!empty($qID)) {
                    if (!empty($row['answer_id'])) {
                        DB::table('answer')
                            ->where("answer_id", $row['answer_id'])
                            ->where("question_id", $qID)
                            ->update([
                                'answer_nm' => $row['answer_nm'],
                                'ans_correct' => $ans_correct
                            ]);
                    } else {
                        $data->question_id = $qID;
                        $data->answer_nm = $row['answer_nm'];
                        $data->ans_correct = $ans_correct;
                        $data->del_flag = 0;
                        $data->save();
                    }
                }
            }// end foreach
            $request->session()->flash('alert-success', 'Cập nhật thành công!');
            return redirect('admin/question');
        }catch(Exception $e){
            print_r($e);
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
