@extends('admin.layouts.layoutList') @section('listContent')
<h2>Loại tin</h2>
@if(session('thongbao'))
<div class="card-panel teal lighten-2">
    {{ session("thongbao") }}
</div>
@endif
<table id="table_loaitin" class="highlight responsive-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Tên không dấu</th>
            <th>Sửa</th>
            <th>Xoá</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loaitin as $lt)
        <tr>
            <td>{{ $lt->id }}</td>
            <td>{{ $lt->Ten }}</td>
            <td>{{ $lt->TenKhongDau }}</td>
            <td>
                <a
                    class="
                        btn-floating
                        waves-effect waves-light
                        yellow
                        darken-3
                    "
                    href="{{url('/admin/loaitin/edit').'/'.$lt->id}}"
                    ><i class="material-icons">create</i></a
                >
            </td>
            <td>
                <a
                    class="btn-floating waves-effect waves-light red darken-3"
                    href="{{url('/admin/loaitin/delete').'/'.$lt->id}}"
                    ><i class="material-icons">delete_forever</i></a
                >
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('admin.layouts.components.pagination') @endsection
