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
    <h2>Kết quả bài làm</h2>
    <p>Tên ứng viên: <b>{{ $data[0]->username }}</b></p>
    <p>Email: <b>{{ $data[0]->email }}</b></p>
    <hr/>
    <h4>Mã đề thi: <b>{{ $data[0]->language_nm }}</b></h4>
    <h4>Tổng điểm: <b style="color: red">{{ $score->total }}</b></h4>

    <div id="exam">
    @if($question[0])
        @foreach($question as $row_question)
            <div class="form-group exam">
                <input type="hidden" class="question_id" value="{{ $row_question->question_id }}" />
                <label class="question_nm">{{ $row_question->question_nm }}</label>
                    @if($data[0])
                        @foreach($data as $key => $rows)
                            @if($row_question->question_id == $rows->question_id)
                                <div class="radio rad <?php
                                    if($rows->ans_correct == 1) {
                                        echo "correct";
                                    }

                                    if($rows->answer_member == 1 && $rows->answer_member != $rows->ans_correct) {
                                        echo "wrong";
                                    }
                                ?>" style="margin-top: 0px" ans_id="{{ $rows->answer_id  }}">
                                    <label><input type="radio" class="inputRad" name="{{ 'radio'.$row_question->question_id }}" {{ ($rows->ans_correct == 1)?"checked":"" }}>{{ $rows->answer_nm }}</label>
                                </div>
                            @endif
                        @endforeach
                    @endif
            </div>
        @endforeach
    @endif
    </div>
@stop