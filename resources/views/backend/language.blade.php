@extends('backend.dashboard')
@section('style_dashboard')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/manage/language.css') }}">
@stop
@section('javascript_dashboard')
    <script type="text/javascript" src="{{ asset('js/backend/manage/language.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop
@section('directional')
    <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <h2>Quản lý ngôn ngữ</h2>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                Thông tin đăng ký không đầy đủ, bạn cần chỉnh sửa như sau:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (isset($message))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}" style="color: green">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div>

        <div id="wrap" class="wrap">
            <div id="language_add">
                @include('backend.language.add')
            </div>
            <div id="language_show">

                <div class="col-md-12 divAdd">
                    <button id="add_new" class="btn btn-primary">Thêm mới</button>
                </div>
                <div class="col-md-12 divShow">
                    <table id="myTable" class="display cell-border compact stripe" style="width:100%">
                        <thead>
                        <tr>
                            <th>Mã ngôn ngữ</th>
                            <th>Tên ngôn ngữ</th>
                            <th>Thời gian làm bài</th>
                            <th colspan="1"></th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(isset($data))
                            @foreach($data as $row)
                                <tr>
                                    <td class="text-center">{{ $row->language_id }}</td>
                                    <td style="font-weight: bold">{{ $row->language_nm }}</td>
                                    <td>{{ $row->language_time }} {{ ($row->language_time !=0)?'giây':'' }}</td>
                                    <td class="text-center"><a class="language_id" href="#" language_id="{{$row->language_id}}">Sửa</a> | <a href="{{ 'language/del/'.$row->language_id }}">Xóa</a></td>
                                </tr>
                                @foreach($language_children as $rew)
                                    @if($row->language_id == $rew->language_parent)
                                        <tr>
                                            <td class="text-center">{{ $rew->language_id }}</td>
                                            <td>{{ "-- ".$rew->language_nm." (".$row->language_nm.")" }}</td>
                                            <td>{{ $rew->language_time }} {{ ($row->language_time !=0)?'giây':'' }}</td>
                                            <td class="text-center"><a class="language_id" href="#" language_id="{{$rew->language_id}}">Sửa</a> | <a href="{{ 'language/del/'.$rew->language_id }}">Xóa</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">Không tồn tại bản ghi nào</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
            {{--  <div id="member_add">
                  @include('backend.member.add')
              </div>--}}
        </div>
    </div>
@stop