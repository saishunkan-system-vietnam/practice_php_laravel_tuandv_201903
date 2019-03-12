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
        <label for="question_id">Question name:</label>
        <select name="question_id" class="form-control" id="question_id">
             @if(isset($cb_question) && $cb_question[0]->question_id !='')
                 @foreach($cb_question as $rows)
                     <option value="{{ $rows->question_id }}" {{ ($rows->question_id == $question_key)?'selected':'' }}>{{ $rows->question_nm }}</option>
                 @endforeach
             @endif
        </select>
    </div>

    @for($i=1;$i<=4;$i++)
        <div class="form-group">
            <label for="ans_{{ $i }}">Answer {{ $i }}:</label>
            <input type="text" class="form-control" id="ans_{{ $i }}" name="ans_{{ $i }}">
            <div class="checkbox">
                <label><input type="checkbox" value="" id="ans_correct{{ $i }}" name="ans_correct{{ $i }}" >Correct</label>
            </div>
        </div>

        <input type="hidden" class="form-control" id="answer_id{{ $i }}" name="answer_id{{ $i }}">
    @endfor

   {{-- <div class="form-group">
        <label for="ans_correct">Answer Correct:</label>
        <select name="ans_correct" class="form-control required" id="ans_correct" >
            <option value=""></option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>
    </div>--}}

    <div class="form-group">
        <input type="submit" id="btn" class="btn btn-primary" value="Lưu"/>
    </div>
    <br/> {{--để tạm, sẽ sửa sau--}}
    <br/>
    {!! Form::close() !!}
@stop