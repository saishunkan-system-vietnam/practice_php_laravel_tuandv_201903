@extends('backend.dashboard')
@section('style_dashboard')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/manage/member.css') }}">
@stop
@section('javascript_dashboard')
    <script type="text/javascript" src="{{ asset('js/backend/manage/member.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop
@section('directional')
   <div class="row">
       <h2>Quản lý ứng viên</h2>
       {{--check error--}}
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
       </div> <!-- end .flash-message -->

       <div id="wrap" class="wrap">
           <div id="member_add">
               @include('backend.member.add')
           </div>
           <div id="member_show">
               {{--@include('backend.member.show')--}}

               <div class="col-md-12 divAdd">
                   <button id="add_new" class="btn btn-primary">Thêm mới</button>
                   {{--<a id="add_new" href="{{ asset("/admin/member/create") }}" class="btn btn-primary">Thêm mới</a>--}}
               </div>
               <div class="col-md-12 divShow">
                   <table id="myTable" class="display" style="width:100%">
                       <thead>
                       <tr>
                           <th>Id</th>
                           <th>Username</th>
                           <th>Password</th>
                           <th>Email</th>
                           <th>Birthday</th>
                           <th>Address1</th>
                           <th>Address2</th>
                           <th>Gender</th>
                           <th>Shool</th>
                           <th>Education_year</th>
                           <th>Interview_start</th>
                           <th>Interview_end</th>
                           <th>Experience_year</th>
                           <th>Role</th>
                           <th></th>
                           <th></th>
                       </tr>
                       </thead>
                       <tbody>
                           @if(isset($data))
                               @foreach($data as $row)
                                   <tr>
                                       <td class="text-center">{{$row->member_id}}</td>
                                       <td>{{$row->username}}</td>
                                       <td>{{$row->password}}</td>
                                       <td>{{$row->email}}</td>
                                       <td>{{$row->birthday}}</td>
                                       <td>{{$row->address1}}</td>
                                       <td>{{$row->address2}}</td>
                                       <td>{{$row->gender}}</td>
                                       <td>{{$row->shool}}</td>
                                       <td>{{$row->education_year}}</td>
                                       <td>{{$row->interview_start}}</td>
                                       <td>{{$row->interview_end}}</td>
                                       <td>{{$row->experience_year}}</td>
                                       <td>{{$row->role}}</td>
                                       <td style="min-width: 55px"><a class="member_id" member_id="{{$row->member_id}}" href="{{ 'member/edit/'.$row->member_id }}">Sửa</a> | <a href="{{ 'member/del/'.$row->member_id }}">Xóa</a></td>
                                       <td>
                                           <a class="btn btn-success" href="{{ URL::route('assign_action.create', ['member_id' => $row->member_id]) }}">Gán</a>
                                       </td>
                                   </tr>
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
