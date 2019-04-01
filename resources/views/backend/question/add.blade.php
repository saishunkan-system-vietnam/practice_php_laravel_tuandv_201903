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
    <label for="question_nm">Câu hỏi dạng văn bản:</label>
    <input type="text" class="form-control" id="question_nm" name="question_nm">
</div>

<div class="form-group">
    <label for="question_nm">Câu hỏi dạng code:</label>
    <textarea type="text" class="form-control" id="question_code" name="question_code" rows="10" style="background: black !important;"> </textarea>
</div>

<div class="form-group">
    <label for="language_id">Language name:</label>
    <select name="language_id" class="form-control" id="language_id">
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

<div class="form-group">
    <input type="submit" id="" class="btn btn-primary" value="Lưu"/>
</div>
<br/> {{--để tạm, sẽ sửa sau--}}
<br/>
{!! Form::close() !!}
@stop