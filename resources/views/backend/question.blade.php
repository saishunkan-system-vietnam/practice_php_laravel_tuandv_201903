@extends('backend.dashboard')
@section('style_dashboard')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/manage/question.css') }}">
@stop
@section('javascript_dashboard')
    <script type="text/javascript" src="{{ asset('js/backend/manage/question.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop
@section('directional')
    <div class="row">
        <h2>Quản lý câu hỏi</h2>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                Thông tin đăng ký không đầy đủ, bạn cần chỉnh sửa như sau:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (isset($message))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <div class="flash-message" style="margin-bottom: 15px">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}" style="color: green">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div>

        <div id="wrap" class="wrap">
            <div id="question_add">
                {{--@include('backend.question.add')--}}
            </div>
            <div id="question_show">
                <div class="col-md-12 divAdd">
                    <a id="add_new" class="btn btn-primary col-md-1" href="{{ asset("admin/question/create") }}">Thêm mới</a>
                    <select class="form-control col-md-3" id="lang_id">
                         @if(isset($data_language[0]) && $data_language[0]->language_id !='')
                            <option value="">Lựa chọn ngôn ngữ</option>
                             @foreach($data_language as $rows)
                                <option value="{{ $rows->language_id }}" {{ (isset($lang_id_session) && $lang_id_session == $rows->language_id)?'selected':''  }} style="font-weight: bold">{{ $rows->language_nm }}</option>
                            @foreach($language_children as $rews)
                                  @if($rows->language_id == $rews->language_parent)
                                        <option value="{{ $rews->language_id }}" {{ (isset($lang_id_session) && $lang_id_session == $rews->language_id)?'selected':''  }} style="padding-left: 35px">{{ "- ". $rews->language_nm }}</option>
                                  @endif
                                @endforeach
                             @endforeach
                         @endif
                    </select>
                </div>
                <div class="col-md-12 divShow">
                    <table id="myTable" class="display cell-border compact stripe" style="width:100%">
                        <thead>
                        <tr>
                            <th>Mã câu hỏi</th>
                            <th>Câu dạng văn bản</th>
                            {{--<th>Câu hỏi dạng code</th>--}}
                            <th>Mã ngôn ngữ</th>
                            <th></th>
                            <th>Gán câu trả lời</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($data))
                            @foreach($data as $row)
                                <tr>
                                    <td class="text-center">{{ $row->question_id }}</td>
                                    <td>{{ $row->question_nm }}</td>
                                    {{--<td>{{ substr($row->question_code,0,50) }} {{ ($row->question_code != '')?'...':'' }}</td>--}}
                                    <td>{{ $row->language_nm }}</td>
                                    <td class="text-center"><a class="question_id" href="{{ asset('admin/question/update/'.$row->question_id)  }}" question_id="{{$row->question_id}}">Sửa</a> | <a href="{{ 'question/del/'.$row->question_id }}">Xóa</a></td>
                                    <td class="text-center">
                                        <a class="btn btn-success add_answer" href="{{ asset('admin/answer/create/'.$row->question_id) }}">Gán</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">Không tồn tại bản ghi nào</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>

            </div>
            {{--  <div id="member_add">
                  @include('backend.member.add')
              </div>--}}
        </div>
    </div>
@stop
