@extends('admin.layouts.layoutAdd') @stack('head')
<link rel="stylesheet" href="{{ asset('css/pages/add.css') }}" />

@section('addContent')
<h2>Thêm loại tin</h2>
<div class="row">
    <form class="col s12" action="add" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        @if(count($errors) > 0)
        <div class="card-panel deep-orange lighten-2">
            @foreach($errors->all() as $err)
            {{ $err }}<br />
            @endforeach
        </div>
        @endif @if(session('thongbao'))
        <div class="card-panel teal lighten-2">
            {{ session("thongbao") }}
        </div>

        @endif
        <div class="row">
            <div class="input-field col s6">
                <input
                    id="Ten"
                    name="Ten"
                    data-length="10"
                    maxlength="50"
                    placeholder="Nhập tên loại tin"
                />
                <button
                    class="btn waves-effect waves-light"
                    type="submit"
                    name="action"
                >
                    Thêm
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
