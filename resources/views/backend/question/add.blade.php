{{--<form class="wForm" action="{{ url("admin/member_action") }}" method="POST" role="form" style="width: 1000px">--}}
@extends('backend.question')
@section('directional')
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

{!! Form::open(['method' => 'POST', 'route' => ['question_action.store'], 'style'=>'width:1000px']) !!}
<div class="form-group">
    <label for="question_nm">Question name:</label>
    <input type="text" class="form-control" id="question_nm" name="question_nm">
</div>

<div class="form-group">
    <label for="language_id">Language name:</label>
    <select name="language_id" class="form-control" id="language_id">
        @if(isset($data_language) && $data_language[0]->language_id !='')
            @foreach($data_language as $rows)
                <option value="{{ $rows->language_id }}">{{ $rows->language_nm }}</option>
            @endforeach
        @endif
    </select>
</div>

<div class="form-group">
    <input type="submit" id="Lưu" class="btn btn-primary" value="Lưu"/>
</div>
<br/> {{--để tạm, sẽ sửa sau--}}
<br/>
{!! Form::close() !!}
@stop