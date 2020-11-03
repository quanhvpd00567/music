
<table id="{{$id}}" class="table table-hover" style="width:100%; color: #ffffff">
    <thead>
    <tr>
        <th>.No</th>
        <th>Hình ảnh</th>
        <th>Tên bài hát</th>
        <th>Ngày đăng</th>
    </tr>
    </thead>
    <tbody>
    @if(count($songs) == 0)
        <tr>
             <td colspan="4" class="text-center">Không có bài hát nào</td>
        </tr>
    @else
        @foreach($songs as $key => $song)
            <tr>
                <td>{{$key + 1}}</td>
                <td style="width: 100px">
                    <img src="{{$song->image}}" alt="{{$song->title}}">
                </td>
                <td>{{$song->title}}</td>
                <td>{{$song->created_at}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
