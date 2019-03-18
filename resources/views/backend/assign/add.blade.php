{{--<form class="wForm" action="{{ url("admin/member_action") }}" method="POST" role="form" style="width: 1000px">--}}
@extends('backend.dashboard')
@section('style_dashboard')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/manage/assign.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

@stop
@section('javascript_dashboard')
    <script type="text/javascript" src="{{ asset('js/backend/manage/assign.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop
@section('directional')
    <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
    <h2>Quản lý đề thi</h2>
    {{--<h5>Thiết lập đề thi cho ứng viên</h5>--}}

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}" style="color: green">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->

    {!! Form::open(['method' => 'POST', 'route' => ['assign_action.store']]) !!}
    <div class="form-group">
        <label>Mã ứng viên: <b class="member">{{ $model_member['member_id'] }}</b></label><br/>
        <label>Tên ứng viên: <b class="member">{{ $model_member['username'] }}</b></label>
    </div>

    <div class="form-group">
        <button id="add_exam" class="btn btn-success">Thêm mã đề</button>
    </div>

    <div id="manage_exam">
        @foreach($model_assign as $key => $row_assign)
            <div class="form-group exam">
                <label for="language_id">Mã đề thi</label><br/>
                <div class="form-inline">
                <select name="" class="form-control language_id" id="language_id">
                    @if(isset($model_language)  !='' )
                        @foreach($model_language as $rows)
                            <option value="{{ $rows->language_id }}" {{ ($rows->language_id == $row_assign->language_id)?'selected':'' }}>{{ $rows->language_nm }}</option>
                        @endforeach
                    @endif
                </select>
                <input type="hidden" name="arr[{{ $key }}][assign_id]"  value="{{ $row_assign->assign_id }}"/>
                <input type="hidden" class="language_id" name="arr[{{ $key }}][language_id]" value="{{ $row_assign->language_id }}"/>
                <i class="fas fa-minus-circle optionI delRow" assign_id = "{{ $row_assign->assign_id }}"></i>
                <a href="{{ url('admin/assign/send_email/'.$row_assign->assign_id.'/'.$row_assign->member_id.'/'.$row_assign->language_id) }}"
                        class="btn {{ ($row_assign->accept_email == 0) ? 'btn-primary' : 'btn-default disabled' }}">Send email</a>
                </div>
            </div>
        @endforeach
    </div>

    <div id="exam_temp" style="display: none">
        <div class="form-group exam">
            <label for="language_id">Mã đề thi</label><br/>
            <div class="form-inline">
                <select name="" class="form-control language_id" id="language_id">
                    <option value="">Lựa chọn mã đề thi</option>
                    @if(isset($model_language)  !='' )
                        @foreach($model_language as $rows)
                            <option value="{{ $rows->language_id }}">{{ $rows->language_nm }}</option>
                        @endforeach
                    @endif
                </select>
                {{--<input type="hidden" class="language_id" name="arr[4][language_id]" value=""/>--}}
                <i class="fas fa-minus-circle optionI delRow" assign_id=""></i>
            </div>
        </div>
    </div>
    <input type="hidden" name="member_id" value="{{ $model_member['member_id'] }}"/>
    <br/> {{--để tạm, sẽ sửa sau--}}
    <br/><div class="form-group">
        <input type="submit" id="btn" class="btn btn-primary" value="Lưu"/>
    </div>
    {!! Form::close() !!}
@stop