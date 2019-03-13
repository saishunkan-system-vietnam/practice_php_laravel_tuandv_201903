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
                    <a id="add_new" class="btn btn-primary col-md-1" href="{{ asset("admin/question/create") }}" style="">Thêm mới</a>
                    <select class="form-control col-md-3" id="lang_id">
                         @if(isset($data_language) && $data_language[0]->language_id !='')
                            <option value="">Lựa chọn ngôn ngữ</option>
                             @foreach($data_language as $rows)
                                 <option value="{{ $rows->language_id }}" {{ (isset($lang_id_session) && $lang_id_session == $rows->language_id)?'selected':''  }}>{{ $rows->language_nm }}</option>
                             @endforeach
                         @endif
                    </select>
                </div>
                <div class="col-md-12 divShow">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Question name</th>
                            <th>Question name</th>
                            <th>Language code</th>
                            <th>Process</th>
                            <th>Answer</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($data))
                            @foreach($data as $row)
                                <tr>
                                    <td class="text-center">{{ $row->question_id }}</td>
                                    <td>{{ $row->question_nm }}</td>
                                    <td>{{ substr($row->question_code,0,50) }} {{ ($row->question_code != '')?'...':'' }}</td>
                                    <td>{{ $row->language_nm }}</td>
                                    <td><a class="question_id" href="{{ asset('admin/question/update/'.$row->question_id)  }}" question_id="{{$row->question_id}}">Edit</a> | <a href="{{ 'question/del/'.$row->question_id }}">Del</a></td>
                                    <td>
                                        <a class="btn btn-success add_answer" href="{{ asset('admin/answer/create/'.$row->question_id) }}">Add answer</a>
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
