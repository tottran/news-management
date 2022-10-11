@extends('admin.layouts.layoutList') @section('listContent')
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
            <th>Email</th>
            <th>Level</th>
            <th>
                @if($userLogin->level == 1) Sửa
                @endif
            </th>
            <th>
                @if($userLogin->level == 1) Xoá
                @endif
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td
                style="background-image: url('{{ asset("upload/user/".$user->cover) }}'); background-size: cover;"
            >
                <p>{{ $user->name }}</p>
                @if($user->avatar)
                <img
                    class="materialboxed"
                    width="100"
                    src="{{ asset('upload/user/'.$user->avatar) }}"
                    alt="{{$user->name}}"
                />
                @endif
            </td>
            <td>{{$user->email}}</td>
            <td>{{$user->level == 1 ? "Admin" : "User"}}</td>
            <td>
                @if($userLogin->level == 1)
                    <a
                        class="
                            btn-floating
                            waves-effect waves-light
                            yellow
                            darken-3
                        "
                        href="{{url('/admin/user/edit').'/'.$user->id}}"
                        ><i class="material-icons">create</i></a
                    >
                @endif
            </td>
            <td>
                @if($userLogin->level == 1)
                    <a
                    class="btn-floating waves-effect waves-light red darken-3"
                    href="{{url('/admin/user/delete').'/'.$user->id}}"
                    ><i class="material-icons">delete_forever</i></a
                    >
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('admin.layouts.components.pagination') @endsection
