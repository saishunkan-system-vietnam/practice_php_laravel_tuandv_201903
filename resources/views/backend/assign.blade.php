@extends('backend.dashboard')
@section('style_dashboard')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/manage/assign.css') }}">
@stop
@section('javascript_dashboard')
    <script type="text/javascript" src="{{ asset('js/backend/manage/assign.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop
@section('directional')
    <div class="row">
        <h2>Quản lý đề thi</h2>
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
        <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
        <div id="wrap" class="wrap">
            <div id="assign_show">
                <h5>Hiển thị danh sách</h5>
                <div class="col-md-12 divShow">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Mã đề thi</th>
                            <th>Mã ứng viên</th>
                            <th>Tên ứng viên</th>
                            <th>Mã ngôn ngữ</th>
                            <th>Tên ngôn ngữ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($data))
                            @foreach($data as $row)
                                <tr>
                                    <td class="text-center">{{ $row->assign_id }}</td>
                                    <td class="text-center">{{ $row->member_id }}</td>
                                    <td>{{ $row->username }}</td>
                                    <td class="text-center">{{ $row->language_id }}</td>
                                    <td>{{ $row->language_nm }}</td>
                                    <td><a class="assign_id" href="{{ url('admin/'.$row->member_id.'/language/'.$row->language_id) }}">Hiển thị</a> | <a class="delRow" assign_id="{{ $row->assign_id }}">Xóa</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">Không tồn tại bản ghi nào</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
@stop