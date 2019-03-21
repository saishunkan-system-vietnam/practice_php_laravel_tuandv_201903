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
            <div id="answer_show">
                <div class="col-md-12 divAdd">
                    <a id="add_new" class="btn btn-primary" href="{{ asset("admin/answer/create") }}">Thêm mới</a>
                </div>
                <div class="col-md-12 divShow">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Mã câu trả lời</th>
                                <th>Tên câu trả lời</th>
                                <th>Câu hỏi</th>
                                <th>Đáp án A</th>
                                <th>Đáp án B</th>
                                <th>Đáp án C</th>
                                <th>Đáp án D</th>
                                <th>Đáp án đúng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
@stop