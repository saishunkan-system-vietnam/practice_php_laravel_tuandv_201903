@extends('backend.dashboard')
@section('style_dashboard')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/manage/answer.css') }}">
@stop
@section('javascript_dashboard')
    <script type="text/javascript" src="{{ asset('js/backend/manage/answer.js') }}"></script>
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
            <div id="answer_add">
                {{--@include('backend.question.add')--}}
            </div>
            <div id="answer_show">
                <div class="col-md-12 divAdd">
                    <a id="add_new" class="btn btn-primary" href="{{ asset("admin/answer/create") }}">Thêm mới</a>
                </div>
                <div class="col-md-12 divShow">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Answer name</th>
                                <th>Question id</th>
                                <th>Answer A</th>
                                <th>Answer B</th>
                                <th>Answer C</th>
                                <th>Answer D</th>
                                <th>Correct</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                       {{-- @if(isset($data))
                            @foreach($data as $row)
                                <tr>
                                    <td>{{ $row->question_id }}</td>
                                    <td>{{ $row->question_nm }}</td>
                                    <td>{{ $row->language_nm }}</td>
                                    <td><a class="question_id" href="{{ asset('admin/question/update/'.$row->question_id)  }}" question_id="{{$row->question_id}}">Edit</a> | <a href="{{ 'question/del/'.$row->question_id }}">Del</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">Không tồn tại bản ghi nào</td>
                            </tr>
                        @endif--}}
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