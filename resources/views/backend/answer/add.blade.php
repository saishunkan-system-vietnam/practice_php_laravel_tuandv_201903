{{--<form class="wForm" action="{{ url("admin/member_action") }}" method="POST" role="form" style="width: 1000px">--}}
@extends('backend.dashboard')
@section('style_dashboard')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/manage/answer.css') }}">
@stop
@section('javascript_dashboard')
    <script type="text/javascript" src="{{ asset('js/backend/manage/answer.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop
@section('directional')
    <h2>Quản lý câu trả lời</h2>
    {!! Form::open(['method' => 'POST', 'route' => ['answer_action.store'], 'style'=>'width:1000px']) !!}

    <div class="form-group">
        <label for="question_id">Câu hỏi:</label>
        <input type="hidden" class="form-control" id="question_id" name="question_id" value="{{ $question_id }}">
        <input type="text" class="form-control" id="question_nm" name="question_nm" value="{{ $question_nm }}" disabled>
    </div>

    @for($i=1;$i<=4;$i++)
        <div class="form-group">
            <label for="ans_{{ $i }}">Câu trả lời {{ $i }}:</label>
            <input type="text" class="form-control" id="ans_{{ $i }}" name="ans[{{ $i }}][answer_nm]" value="{{ isset($data[$i-1])?$data[$i-1]->answer_nm:'' }}">
            <div class="checkbox">
                <label><input type="checkbox" value="0" id="ans_correct_{{ $i }}" name="ans[{{ $i }}][ans_correct]"
                              {{ (isset($data[$i-1]) && $data[$i-1]->ans_correct == 1)?'checked':'' }}>Đáp án đúng
                </label>
            </div>
            <input type="hidden" class="form-control" id="ans_key_{{ $i }}" name="ans[{{ $i }}][answer_id]" value="{{ isset($data[$i-1])?$data[$i-1]->answer_id:'' }}">
        </div>
    @endfor


    <div class="form-group">
        <input type="submit" id="btn" class="btn btn-primary" value="Lưu"/>
    </div>
    <br/> {{--để tạm, sẽ sửa sau--}}
    <br/>
    {!! Form::close() !!}
@stop