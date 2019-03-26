<?php

namespace App\Http\Controllers\backend;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class LanguagesController extends AppController
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
    public function index(Request $request){
        // return view("language.index");
        parent::__construct();
        $user = $this->username;
        if($user == '') {
            return redirect('admin/login');
        }

        $cb_language = $data = DB::table('Language')
            ->where('Language.del_flag',0)
            ->get();

        $data = DB::table('Language')
            ->where('Language.del_flag',0)
            ->orderBy('Language.language_id', 'desc')
            ->get();
        return view("backend.language")->with([
            'user'        => $user,
            'cb_language' => $cb_language,
            'data'        => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'language_nm' => 'required|max:255',
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/language')
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = new Language();
            $data->language_nm        = $request->language_nm;
            $data->language_parent    = $request->language_parent;
            $data->language_time      = $request->language_time;
            $data->del_flag           = 0;
            $data->save();

            if($data->save()){
                $request->session()->flash('alert-success', 'Thêm mới thành công!');
                return redirect('admin/language');
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
        $language_id = $request->language_id;
        $data = Language::where('language_id', $language_id)->first();
        $cb_language = DB::table('Language')
            ->where('Language.language_id','!=',$language_id)
            ->where('Language.del_flag',0)
            ->get();
        $view = view('backend.language.update')
            ->with([
                'cb_language' => $cb_language,
                'data'        => $data
            ])
            ->render();
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
        $id = $request->language_id;
        $result = DB::table('language')
            ->where("language_id",$id)
            ->update([
                    "language_nm" => $request->language_nm,
                    "language_time" => $request->language_time
                ]);
        if($result){
            $request->session()->flash('alert-success', 'Sửa đổi thành công!');
        }else {
            $request->session()->flash('alert-success', 'Sửa đổi thất bại!');
        }
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
        $result = DB::table('language')
            ->where("language_id",$id)
            ->update([
                "del_flag" => $del_flag
            ]);

        if($result){
            return redirect('admin/language');
        }
    }
}
