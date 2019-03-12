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
        <label for="username">Name:</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ $data->username }}">
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" value="{{ $data->password }}">
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}">
    </div>

    <div class="form-group">
        <label for="birthday">Birthday:</label>
        <input type="datetime" class="form-control datepicker" id="birthday" name="birthday" value="{{ $data->birthday }}">
    </div>

    <div class="form-group">
        <label for="address1">Address1:</label>
        <input type="text" class="form-control" id="address1" name="address1" value="{{ $data->address1 }}">
    </div>

    <div class="form-group">
        <label for="address2">Address2:</label>
        <input type="text" class="form-control" id="address2" name="address2" value="{{ $data->address2 }}">
    </div>

    <div class="form-group">
        <label for="gender">Gender</label>
        <select name="gender" class="form-control" id="gender">
            <option value="0" {{ ($data->gender == 0)?'selected':'' }}>Nam</option>
            <option value="1" {{ ($data->gender == 1)?'selected':'' }}>Nữ</option>
            <option value="2" {{ ($data->gender == 2)?'selected':'' }}>Khác</option>
        </select>
    </div>

    <div class="form-group">
        <label for="shool">Shool:</label>
        <input type="text" class="form-control" id="shool" name="shool" value="{{ $data->shool }}">
    </div>

    <div class="form-group">
        <label for="education_year">Education year</label>
        <select name="education_year" class="form-control" id="education_year">
            @for($education_year = 1980; $education_year <= 2050; $education_year++)
                <option value="{{ $education_year }}" {{ ($education_year == $data->education_year)?"selected":"" }}>{{ $education_year }}</option>
            @endfor
        </select>
    </div>

    <div class="form-group">
        <label for="interview_start">Interview start:</label>
        <input type="datetime" class="form-control datepicker" id="interview_start" name="interview_start" value="{{ $data->interview_start }}">
    </div>

    <div class="form-group">
        <label for="interview_end">Interview end</label>
        <input type="datetime" class="form-control datepicker" id="interview_end" name="interview_end" value="{{ $data->interview_end }}">
    </div>

    <div class="form-group">
        <label for="experience_year">Experience year</label>
        <input type="number" class="form-control" id="experience_year" name="experience_year" value="{{ $data->experience_year }}">
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control" id="role">
            <option value="1" {{ ($data->role == 1)?'selected':'' }}>Admin</option>
            <option value="2" {{ ($data->role == 2)?'selected':'' }}>Member</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" id="btnUpdate" class="btn btn-primary" value="Lưu"/>
    </div>
    <input type="hidden" id="member_id" value="{{ $data->member_id }}"/>
    <br/>
    <br/>
    <br/>
    {!! Form::close() !!}
