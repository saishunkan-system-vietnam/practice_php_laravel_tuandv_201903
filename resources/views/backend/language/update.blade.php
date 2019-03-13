{{--<form class="wForm" action="{{ url("admin/member_action") }}" method="POST" role="form" style="width: 1000px">--}}
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}" style="color: green">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div> <!-- end .flash-message -->

{!! Form::open(['method' => 'POST', 'style'=>'width:1000px']) !!}

<div class="form-group">
    <label for="language_nm">Language name:</label>
    <input type="text" class="form-control" id="language_nm" name="language_nm" value="{{ $data->language_nm }}">
</div>

<div class="form-group">
<select name="language_parent" class="form-control" id="language_parent">
    <option value="0"></option>
    @foreach($cb_language as $rows)
        <option value="{{ $rows->language_id }}" {{ ($rows->language_id == $data->language_parent)?'selected':'' }}>{{ $rows->language_nm }}</option>
    @endforeach
</select>
</div>

<div class="form-group">
    <input type="text" id="btnUpdate" class="btn btn-primary" value="Lưu"/>
</div>
<input type="hidden" id="language_id" value="{{ $data->language_id }}"/>
<br/>
<br/>
<br/>
{!! Form::close() !!}

