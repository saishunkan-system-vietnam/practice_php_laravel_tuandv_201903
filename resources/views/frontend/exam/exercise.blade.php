@extends('frontend.layout')
@section('account')
    {{ "Ứng viên: ".$username }}
@stop
@section('list_exam')
    <h3>Chuyên đề: {{ $language }}</h3>
    @if(isset($titleExam[0]))
        @foreach($titleExam as $row)
            <a href="{{ URL::route('home_action.show', ['language_id' => $row->language_id]) }}" class="list-group-item list-group-item-action bg-light">{{ $row->language_nm }}</a>
        @endforeach
    @endif
@stop
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="panel-group">
                <div class="panel panel-default bg_panel">
                    <div class="panel-heading">@yield('title2')</div>
                    <div class="panel-body">@yield('content2')</div>
                </div>
            </div>
        </div>

        <div class="col-md-3" style="background: #d17768">

        </div>
    </div>
@stop
