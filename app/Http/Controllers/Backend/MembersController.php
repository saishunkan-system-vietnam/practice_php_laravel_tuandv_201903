<?php

namespace App\Http\Controllers\Backend;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class MembersController extends AppController
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
        $model = DB::table('member')->where("username",$user)->first();
        $role = $model->role;
        if( $user == '' ) {
            return redirect('admin/login');
        }
        if( $role != 1 ) {
            return redirect('admin/logout');
        }

        $data = DB::table('Member')
            ->where('Member.del_flag',0)
            ->orderBy('Member.member_id', 'desc')
            ->get();
        return view("backend.member")->with([
            'user' => $user,
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'email' => 'Trường :attribute phải có định dạng email',
            'min' => 'Trường :attribute tối thiểu phải có 6 ký tự'
        ];
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'password' => 'required|min:6',
            'email' => 'required|email',
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/member')
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = new Member();
            $data->username = $request->username;
            $data->password = $request->password;
            $data->email = $request->email;
            $data->birthday = date('Y-m-d', strtotime($request->birthday));
            $data->address1 = $request->address1;
            $data->address2 = $request->address2;
            $data->gender = $request->gender;
            $data->shool = $request->shool;
            $data->education_year = $request->education_year;
            $data->interview_start = date('Y-m-d', strtotime($request->interview_start));
            $data->interview_end = date('Y-m-d', strtotime($request->interview_end));
            $data->experience_year = $request->experience_year;
            $data->role = $request->role;
            $data->del_flag = 0;
            $data->save();

            if ($data->save()) {
                $request->session()->flash('alert-success', 'Thêm mới thành công!');
                return redirect('admin/member');
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
    public function update(Request $request)
    {
        $member_id = $request->member_id;
        $data = Member::where('member_id', $member_id)->first();
        $view = view('backend.member.update')
            ->with('data', $data)->render();
        return response()->json([
            'viewUpdate' => $view
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
        $data = $request->all();
        $member_id              = $request->member_id;
        $username        = $request->username;
        $password        = $request->password;
        $email           = $request->email;
        $birthday        = date('Y-m-d', strtotime($request->birthday));
        $address1        = $request->address1;
        $address2        = $request->address2;
        $gender          = $request->gender;
        $shool           = $request->shool;
        $education_year  = $request->education_year;
        $interview_start = date('Y-m-d', strtotime($request->interview_start));
        $interview_end   = date('Y-m-d', strtotime($request->interview_end));
        $experience_year = $request->experience_year;
        $role            = $request->role;
        $result = DB::table('member')
            ->where("member_id",$member_id)
            ->update([
                "username"          => $username
             ,   "password"          => $password
             ,   "email"             => $email
             ,   "birthday"          => $birthday
             ,   "address1"          => $address1
             ,   "address2"          => $address2
             ,   "gender"            => $gender
             ,   "shool"             => $shool
             ,   "education_year"    => $education_year
             ,   "interview_start"   => $interview_start
             ,   "interview_end"     => $interview_end
             ,   "experience_year"   => $experience_year
             ,   "role"              => $role
            ]);

        if($result){
            $request->session()->flash('alert-success', 'Sửa đổi thành công!');
        }else {
            $request->session()->flash('alert-success', 'Sửa đổi thất bại!');
        }
        return response()->json();
    }

    /**
     * process delete
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
        $result = DB::table('member')
            ->where("member_id",$id)
            ->update([
                "del_flag" => $del_flag
            ]);
        if($result){
            return redirect('admin/member');
        }
    }

}
