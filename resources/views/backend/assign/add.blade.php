{{--<form class="wForm" action="{{ url("admin/member_action") }}" method="POST" role="form" style="width: 1000px">--}}
@extends('backend.dashboard')
@section('style_dashboard')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/manage/assign.css') }}">
@stop
@section('javascript_dashboard')
    <script type="text/javascript" src="{{ asset('js/backend/manage/assign.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop
@section('directional')
    <h2>Quản lý đề thi</h2>
    <h5>Thiết lập đề thi cho ứng viên</h5>
    {!! Form::open(['method' => 'POST', 'route' => ['assign_action.store'], 'style'=>'width:1000px']) !!}
    <div class="form-group">
        <label>Mã ứng viên: <b class="member">{{ $model_member['member_id'] }}</b></label><br/>
        <label>Tên ứng viên: <b class="member">{{ $username }}</b></label>
    </div>

    <div class="form-group">
        <label for="language_id">Mã đề thi</label><br/>
        <select name="language_id" class="form-control" id="language_id">
            @if(isset($model_language)  !='' )
                @foreach($model_language as $rows)
                    <option value="{{ $rows->language_id }}">{{ $rows->language_nm }}</option>
                @endforeach
            @endif
        </select>
    </div>

    {{--<input type="hidden" name="member_id" value="{{ $model_member['member_id'] }}"/>--}}
    <div class="form-group">
        <input type="submit" id="btn" class="btn btn-primary" value="Lưu"/>
    </div>
    <br/> {{--để tạm, sẽ sửa sau--}}
    <br/>
    {!! Form::close() !!}
@stop