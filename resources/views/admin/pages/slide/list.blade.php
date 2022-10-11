@extends('admin.layouts.layoutList') @section('listContent')
<h2>Slide</h2>
@if(session('thongbao'))
<div class="card-panel teal lighten-2">
    {{ session("thongbao") }}
</div>
@endif
<table id="table_id" class="highlight responsive-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Nội Dung</th>
            <th>Link</th>
            <th>Sửa</th>
            <th>Xoá</th>
        </tr>
    </thead>
    <tbody>
        @foreach($slide as $sl)
        <tr>
            <td>{{ $sl->id }}</td>
            <td>
                <p>{{ $sl->Ten }}</p>
                @if($sl->Hinh)
                <img
                    class="materialboxed"
                    width="100"
                    src="{{ asset('upload/slide/'.$sl->Hinh) }}"
                    alt="{{$sl->TieuDe}}"
                />
                @endif
            </td>
            <td>{!! $sl->NoiDung !!}</td>
            <td>{{$sl->Link}}</td>
            <td>
                <a
                    class="
                        btn-floating
                        waves-effect waves-light
                        yellow
                        darken-3
                    "
                    href="{{url('/admin/slide/edit').'/'.$sl->id}}"
                    ><i class="material-icons">create</i></a
                >
            </td>
            <td>
                <a
                    class="btn-floating waves-effect waves-light red darken-3"
                    href="{{url('/admin/slide/delete').'/'.$sl->id}}"
                    ><i class="material-icons">delete_forever</i></a
                >
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('admin.layouts.components.pagination') @endsection
