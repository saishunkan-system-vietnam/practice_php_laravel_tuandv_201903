{{--<form class="wForm" action="{{ url("admin/member_action") }}" method="POST" role="form" style="width: 1000px">--}}
{!! Form::open(['method' => 'POST', 'route' => ['language_action.store'], 'style'=>'width:1000px']) !!}
<div class="form-group">
    <label for="language_nm">Language name:</label>
    <input type="text" class="form-control" id="language_nm" name="language_nm">
</div>

<div class="form-group">
    <label for="language_parent">Language parent</label>
    <select name="language_parent" class="form-control" id="language_parent">
        <option value="0"></option>
        @foreach($cb_language as $rows)
            <option value="{{ $rows->language_id }}">{{ $rows->language_nm }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <input type="submit" id="Lưu" class="btn btn-primary" value="Lưu"/>
</div>
<br/> {{--để tạm, sẽ sửa sau--}}
<br/>
{!! Form::close() !!}