
<table id="myTable" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Question name</th>
        <th>Question name</th>
        <th>Language code</th>
        <th>Process</th>
        <th>Answer</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($data_language))
        @foreach($data_language as $row)
            <tr>
                <td class="text-center">{{ $row->question_id }}</td>
                <td>{{ $row->question_nm }}</td>
                <td>{{ substr($row->question_code,0,50) }} {{ ($row->question_code != '')?'...':'' }}</td>
                <td>{{ $row->language_nm }}</td>
                <td><a class="question_id" href="{{ asset('admin/question/update/'.$row->question_id)  }}" question_id="{{$row->question_id}}">Sửa</a> | <a href="{{ 'question/del/'.$row->question_id }}">Xóa</a></td>
                <td>
                    <a class="btn btn-success add_answer" href="{{ asset('admin/answer/create/'.$row->question_id) }}">Gán</a>
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