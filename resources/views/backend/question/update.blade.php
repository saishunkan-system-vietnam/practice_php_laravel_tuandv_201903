{{--<form class="wForm" action="{{ url("admin/member_action") }}" method="POST" role="form" style="width: 1000px">--}}
@extends('backend.dashboard')
@section('style_dashboard')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/manage/question.css') }}">
@stop
@section('javascript_dashboard')
    <script type="text/javascript" src="{{ asset('js/backend/manage/question.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop
@section('directional')
    <h2>Quản lý câu hỏi</h2>
    {!! Form::open(['method' => 'POST', 'style'=>'width:1000px']) !!}
    <div class="form-group">
        <label for="question_nm">Question name:</label>
        <input type="text" class="form-control" id="question_nm" name="question_nm" value="{{ $data->question_nm }}">
    </div>

    <div class="form-group">
        <label for="question_code">Question code:</label>
        <textarea type="" class="form-control" id="question_code" name="question_code" rows="15" style="background: black !important;">{{ $data->question_code }}</textarea>
    </div>

    <div class="form-group">
        <label for="language_id">Language name:</label>
        <select name="language_id" class="form-control" id="language_id">
            @if(isset($combo_language) && $combo_language[0]->language_id !='')
                @foreach($combo_language as $rows)
                    <option value="{{ $rows->language_id }}" {{ ($data->language_id == $rows->language_id)?'selected':'' }}>{{ $rows->language_nm }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <input type="hidden" id="question_id" value="{{ $data->question_id }}" />
    <div class="form-group">
        <input type="" id="btnUpdate" class="btn btn-primary" value="Lưu"/>
    </div>
    <br/> {{--để tạm, sẽ sửa sau--}}
    <br/>
  {{--  </form>--}}
    {!! Form::close() !!}
@stop