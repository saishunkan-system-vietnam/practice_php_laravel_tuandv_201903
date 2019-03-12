
{{--<form class="wForm" action="{{ url("admin/member_action") }}" method="POST" role="form" style="width: 1000px">--}}
    {!! Form::open(['method' => 'POST', 'route' => ['member_action.store'], 'style'=>'width:1000px']) !!}
    <div class="form-group">
        <label for="username">Name:</label>
        <input type="text" class="form-control" id="username" name="username">
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>

    <div class="form-group">
        <label for="birthday">Birthday:</label>
        <input type="datetime" class="form-control datepicker" name="birthday">
    </div>

    <div class="form-group">
        <label for="address1">Address1:</label>
        <input type="text" class="form-control" id="address1" name="address1">
    </div>

    <div class="form-group">
        <label for="address2">Address2:</label>
        <input type="text" class="form-control" id="address2" name="address2">
    </div>

    <div class="form-group">
        <label for="gender">Gender</label>
        <select name="gender" class="form-control" id="gender">
            <option value="0">Nam</option>
            <option value="1">Nữ</option>
            <option value="2">Khác</option>
        </select>
    </div>

    <div class="form-group">
        <label for="shool">Shool:</label>
        <input type="text" class="form-control" id="shool" name="shool">
    </div>

    <div class="form-group">
        <label for="education_year">Education year</label>
        <select name="education_year" class="form-control" id="education_year">
            {{ $year_current = date("Y") }}
            @for($education_year = 1980; $education_year <= 2050; $education_year++)
                <option value="{{ $education_year }}" {{ ($education_year == $year_current)?"selected":"" }}>{{ $education_year }}</option>
            @endfor
        </select>
    </div>

    <div class="form-group">
        <label for="interview_start">Interview start:</label>
        <input type="datetime" class="form-control datepicker" id="interview_start" name="interview_start">
    </div>

    <div class="form-group">
        <label for="interview_end">Interview end</label>
        <input type="datetime" class="form-control datepicker" id="interview_end" name="interview_end">
    </div>

    <div class="form-group">
        <label for="experience_year">Experience year</label>
        <input type="number" class="form-control" id="experience_year" name="experience_year">
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control" id="role">
            <option value="1">Admin</option>
            <option value="2" selected>Member</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" id="Lưu" class="btn btn-primary" value="Lưu"/>
    </div>
    <br/> {{--để tạm, sẽ sửa sau--}}
    <br/>
{!! Form::close() !!}