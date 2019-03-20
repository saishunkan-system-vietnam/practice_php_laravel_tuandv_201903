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
use Illuminate\Support\Facades\Mail;
use Helpers;
class AssignsController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        parent::__construct();
        $user = $this->username;

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

    public function create(Request $request)
    {
        $member_id = $request->member_id;
        $user = '';
        if ($request->session()->has('username')) {
            $user = Session::get('username');
        }
        $model_member   = Member::where('member.member_id',$member_id)->first();
        $model_language = Language::where('language.language_parent','!=',0)->get();
        $model_assign   = Assign::where([
            'assign.member_id' => $member_id,
            'assign.del_flag'  => 0
        ])->get();

        return view("backend.assign.add")->with([
            'user'           => $user,
            'model_member'   => $model_member,
            'model_language' => $model_language,
            'model_assign'   => $model_assign
        ]);
    }

    public function send_email(Request $request,$assign_id,$member_id,$language_id) {
        $strRandom1 = Helpers::generateRandomString(20);
        $strRandom2 = Helpers::generateRandomString(10);
        //$test = generateRandomString(10);
        parent::__construct();
        $token = base64_encode($strRandom1.':'.$assign_id.'/'.$strRandom2);
        $url = 'http://quiz.dev/home/exercise/'.$token;

        $Db_member = DB::table('member')
            ->where([
                'member_id' => $member_id,
                'del_flag'  => 0
            ])
            ->first();

        $Db_language = DB::table("language")
            ->where([
                'language_id' => $language_id,
                'del_flag'    => 0
            ])->first();
        $email_member  = $Db_member->email;
        $username      = $Db_member->username;
        $language_name = $Db_language->language_nm;

        $Db_company = DB::table("company")
            ->where([
                'del_flag'    => 0
            ])
            ->orderBy('id', 'DESC')
            ->first();
        $info = [
                'name'           => $username
            ,   'email'          => $email_member
            ,   'language_name'  => $language_name
            ,   'date_current'   => date("Y-m-d")
            ,   'company_name'   => $Db_company->company_nm
            ,   'address'        => $Db_company->address
            ,   'email_company'  => $Db_company->email
            ,   'tel'            => $Db_company->tel
            ,   'logo'           => $Db_company->logo
            ,   'website'        => $Db_company->website
            ,   'url'            => $url
        ];

        Mail::send('backend.assign.template_email', ['info' => $info], function ($m) use ($info) {
            $m->from($info['email_company'], $info['company_name']);
            $m->to($info['email'],'send')->subject('Đề thi trắc nghiệm');
        });

        if( count(Mail::failures()) > 0 ) {
            $request->session()->flash('alert-danger', 'Gửi email thất bại!');
            /*foreach(Mail::failures as $email_address) {
                echo " - $email_address <br />";
            }*/
        } else {
            $request->session()->flash('alert-success', 'Gửi email thành công!');
            $DB = DB::table('assign')
                ->where([
                    'assign_id'     => $assign_id,
                    'member_id'     => $member_id,
                    'language_id'   => $language_id,
                    'del_flag'      => 0
                ])
                ->update(
                    ['accept_email'=>1]
                );
        }
        return redirect('admin/assign_action/create?member_id='.$member_id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->input);
        $valiable = $request->input();
        $member_id = $request->member_id;
        foreach($valiable['arr'] as $row){
            $data = new Assign();
            $language_id = $row['language_id'];
            if (isset($row['assign_id']) && !empty($row['language_id'])) {
                $result = DB::table('assign')
                    ->where([
                        'assign.assign_id' => $row['assign_id'],
                        'assign.member_id' => $member_id
                    ])
                    ->update([
                        'assign.language_id' => $row['language_id']
                    ]);
            } else {
                $data->member_id      = $member_id;
                $data->language_id    = $row['language_id'];
                $data->del_flag       = 0;
                $result = $data->save();
            }
       }

       if($result){
           $request->session()->flash('alert-success', 'Thực hiện thành công!');
           return redirect('admin/member');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($member_id)
    {
        parent::__construct();
        $user = $this->username;
        $db_assign = DB::table('assign')
            ->select(
                    'member.member_id'
                ,   'member.username'
                ,   'member.email'
                ,   'assign.assign_id'
                ,   'assign.member_id'
                ,   'member.username'
                ,   'assign.language_id'
                ,   'language.language_nm'
            )
            ->leftJoin('member', 'assign.member_id', '=', 'member.member_id')
            ->leftJoin('language', 'assign.language_id', '=', 'language.language_id')
            ->where([
                'assign.member_id' =>$member_id,
                'assign.del_flag' => 0
            ])
            ->first();
        $language_id = $db_assign->language_id;

        //info member
        $data = DB::table('answer')
        ->leftJoin('question', 'answer.question_id', '=', 'question.question_id')
        ->leftJoin('language', 'question.language_id', '=', 'language.language_id')
        ->where([
            'language.language_id' => $language_id,
            'answer.del_flag'      => 0
        ])
        ->get();

        $question = DB::table('question')
            ->leftJoin('language', 'question.language_id', '=', 'language.language_id')
            ->where([
                'language.language_id' => $language_id,
                'question.del_flag'    => 0
            ])
            ->get();

        return view("backend.assign.show")->with([
            'data'      => $data,
            'user'      => $user,
            'member'    => $db_assign,
            'question'  => $question
        ]);
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

    public function del_row(Request $request)
    {
        $key = $request->assign_id;
        $result = DB::table('assign')
            ->where([
                'assign.assign_id' => $key
            ])
            ->update([
                'assign.del_flag' => 1
            ]);
        if($result) {
            return response()->json();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, $assign_id, $member_id, $language_id)
    {
        $user = '';
        if ($request->session()->has('username')) {
            $user = Session::get('username');
        }

        $info = Member::select("username")->where('member_id',$member_id)->first();
        $combo_language= Language::where('language_parent','!=',0)->get();

        return view("backend.assign.update")->with([
            'user'           => $user,
            'model_language' => $combo_language,
            'assign_id'      => $assign_id,
            'member_id'      => $member_id,
            'language_id'    => $language_id,
            'username'       => $info['username']
        ]);
    }*/

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

    public function process_update(Request $request) {
        //dd($request->input());
        if($request->isMethod("post")){
            $assign_id   = $request ->assign_id;
            $member_id   = $request->member_id;
            $language_id = $request->language_id;

            //$a = DB::table('assign')->toSql();
            //dd($language_id);
            $result = DB::table('assign')
                ->where([
                    "assign_id" => $assign_id,
                    'member_id' => $member_id
                ])
                ->update([
                    "language_id" => $language_id
                ]);
            if($result == 1 || $result == 0 ){
                $request->session()->flash('alert-success', 'Sửa đổi thành công!');
            }else {
                $request->session()->flash('alert-success', 'Sửa đổi thất bại!');
            }
            return redirect('admin/assign');
        }

    }
}
