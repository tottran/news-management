@extends('admin.layouts.layoutList') @section('listContent')
<h2>Tin Tức</h2>
@if(session('thongbao'))
<div class="card-panel teal lighten-2">
    {{ session("thongbao") }}
</div>
@endif
<table id="table_id" class="highlight responsive-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Tóm tắt</th>
            <th>Nội Dung</th>
            <th>Thể loại</th>
            <th>Loại tin</th>
            <th>Nổi bật</th>
            <th>Số Lượt xem</th>
            <th>Sửa</th>
            <th>Xoá</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tintuc as $tt)
        <tr>
            <td>{{ $tt->id }}</td>
            <td>
                <p>{{ $tt->TieuDe }}</p>
                @if($tt->Hinh)
                <img
                    class="materialboxed"
                    width="100"
                    src="{{ asset('upload/tintuc/'.$tt->Hinh) }}"
                    alt="{{$tt->TieuDe}}"
                />
                @endif
            </td>
            <td>{!! $tt->TomTat !!}</td>
            <td>{!! $tt->NoiDung !!}</td>
            <td>{{ $tt->loaitin->theloai->Ten }}</td>
            <td>{{ $tt->loaitin->Ten }}</td>
            <td>
                @if($tt->NoiBat==0)
                {{ "Không" }}
                @else
                {{ "Có" }}
                @endif
            </td>
            <td>{{ $tt->SoLuotXem }}</td>
            <td>
                <a
                    class="
                        btn-floating
                        waves-effect waves-light
                        yellow
                        darken-3
                    "
                    href="{{url('/admin/tintuc/edit').'/'.$tt->id}}"
                    ><i class="material-icons">create</i></a
                >
            </td>
            <td>
                <a
                    class="btn-floating waves-effect waves-light red darken-3"
                    href="{{url('/admin/tintuc/delete').'/'.$tt->id}}"
                    ><i class="material-icons">delete_forever</i></a
                >
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('admin.layouts.components.pagination') @endsection
