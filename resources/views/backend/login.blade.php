<html>
<head>
    <meta charset="utf-8">
    <title>Quiz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/login.css') }}">
    {{--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">--}}
</head>
<body>
<form action="{{url('admin/login')}}" method="POST" role="form" id="login">
    {!! csrf_field() !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Đăng nhập</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Đăng ký</label>
            {{--<div class="login-form">
                <div class="sign-in-htm">
                    <div class="group">
                        <label for="username" class="label">Username</label>
                        <input id="username" type="text" class="input">
                    </div>
                    <div class="group">
                        <label for="password" class="label">Password</label>
                        <input id="password" type="password" class="input" data-type="password">
                    </div>
                    <div class="group">
                        <input id="check" type="checkbox" class="check" checked>
                        @if (isset($message))

                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif

                        <p class="err">
                            {{ (isset($errors) && $errors == "fail")?'Username or Password incorrect':'' }}
                        </p>
                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                    </div>
                    <div class="group">
                        --}}{{--<input type="submit" class="button" value="Sign In">--}}{{--
                        <button type="submit" class="button">Đăng nhập</button>
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="#forgot">Forgot Password?</a>
                    </div>
                </div>
                <div class="sign-up-htm">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Repeat Password</label>
                        <input id="pass" type="password" class="input" data-type="password">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Email Address</label>
                        <input id="pass" type="text" class="input">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Sign Up">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">Already Member?</label>
                    </div>
                </div>
            </div>--}}

            <form action="{{url('admin/login')}}" method="POST" role="form">
                <div class="login-form">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="" class="label">Tên người dùng</label>
                            <input type="text" class="input" id="username" placeholder="Username" name="username" value="">
                        </div>
                        <div class="group">
                            <label for="" class="label">Mật khẩu</label>
                            <input type="password" class="input" id="password" placeholder="Password" name="password">
                        </div>
                        @if (isset($message))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif

                        @if(count($errors) > 0 && $errors !="fail")
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li style="color: cornsilk">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <p class="err">
                            {{ (isset($errors) && $errors == "fail")?'Username or Password incorrect':'' }}
                        </p>
                        {!! csrf_field() !!}

                        <div class="group">
                            <input type="submit" class="button" value="Đăng nhập">
                        </div>
                    </div>

                    <div class="sign-up-htm">
                        <div class="group">
                            <label for="user" class="label">Username</label>
                            <input id="user" type="text" class="input">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input id="pass" type="password" class="input" data-type="password">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Repeat Password</label>
                            <input id="pass" type="password" class="input" data-type="password">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Email Address</label>
                            <input id="pass" type="text" class="input">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign Up">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <label for="tab-1">Already Member?</label>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</form>
</body>
</html>