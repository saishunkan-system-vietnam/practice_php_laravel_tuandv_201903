@extends('frontend.layout')
@section('title')
    Bài làm ứng viên
@stop
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/manage/exercise.css') }}">
@stop

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/frontend/manage/exercise.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop

@section('account')
    <div id="account">
        <h4>Ứng viên: <b>{{ $username }}</b></h4>
    </div>
@stop
@section('list_exam')
    <div id="list_exam">
        <p>Chuyên đề: <b>{{ $language }}</b></p>
        <a class="" href="../../admin/logout"> Đăng xuất</a>
        <input type="hidden" id="language_key" value="{{ $language_key }}"/>
       {{-- @if(isset($titleExam[0]))
            @foreach($titleExam as $row)
                <a href="{{ URL::route('home_action.show', ['language_id' => $row->language_id]) }}" class="list-group-item list-group-item-action bg-light">{{ $row->language_nm }}</a>
            @endforeach
        @endif--}}
    </div>
@stop

@section('content')
    <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-9">
            <div class="panel-group">
                <div class="panel panel-default bg_panel">
                    <div class="panel-heading"> <b>{{ $language_children }}</b></div>
                    <div class="panel-body">
                        <div id="exam">
                            @if(isset($data_question[0]))
                                @foreach($data_question as $question)
                                    <div class="form-group exam">
                                        <input type="hidden" class="question_id" value="{{ $question['question_id'] }}" />
                                        <label class="question_nm">{{ $question['question_nm'] }}</label>
                                        <?php
                                            if( $question['question_code'] != '') {
                                                echo '<pre class="question_code">'.html_entity_decode($question['question_code']).'</pre>';
                                            } else {
                                                echo '';
                                            }
                                        ?>
                                        @foreach($data_answer as $answer)
                                            @if($answer->question_id == $question['question_id'] )
                                                <div class="radio rad" style="margin-top: 0px" ans_id="{{ $answer->answer_id  }}">
                                                    <input type="hidden" class="answer_id" value="{{ $answer->answer_id }}" answer_member="0"/>
                                                    <input type="hidden" class="ans_correct" value="{{ $answer->ans_correct }}" />
                                                    <label><input type="radio" class="inputRad" name="{{ 'radio'.$question['question_id'] }}">{{ $answer->answer_nm }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button class="btn btn-primary" id="btnSubmit"> Nộp bài </button>
                        <button class="btn btn-primary"  id="ReturnEmail" style="display: none">Send email</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3" style="">
            <div class="text-center">
                <h2>Thời gian còn lại</h2>
                <span id="time" style="font-size: 80px">05:00</span>
            </div>
        </div>
    </div>
    <input type="hidden" id="token" value="{{ $token }}" />
    <input type="hidden" id="assign_id" value="{{ $assign_id }}" />
    <input type="hidden" id="language_time" value="{{ $time }}" />
@stop
