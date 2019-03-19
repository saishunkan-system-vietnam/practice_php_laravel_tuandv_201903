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
//        $user = '';
//        if ($request->session()->has('username')) {
//            $user = Session::get('username');
//        }
//
//        $data = DB::table('assign')
//            ->select(
//                'assign.assign_id'
//            ,   'assign.member_id'
//            ,   'member.username'
//            ,   'assign.language_id'
//            ,   'language.language_nm'
//            )
//            ->leftJoin('member', 'assign.member_id', '=', 'member.member_id')
//            ->leftJoin('language', 'assign.language_id', '=', 'language.language_id')
//            ->where('assign.del_flag',0)
//            ->get();
//        return view("backend.assign")->with([
//            'user' => $user,
//            'data' => $data
//        ]);

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
        $name = 'tuan';
        $model = DB::table('member')->where('username',$this->username)->first();
        $email = $model->email;
        $country = 'Viet Nam';

        $info = [
                'name'  => $name
            ,   'email' => $email
            ,   'url'   => $url
        ];
        Mail::send('backend.assign.template_email', ['info' => $info], function ($m) use ($info) {
            $m->from('vantuant2@gmail.com', 'Ung dung gui email');
            $m->to('vantuant2@gmail.com','tuantv')->subject('gui email');
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
