@extends('admin.layouts.master') @stack('head')
<link rel="stylesheet" href="{{ asset('admin/css/pages/list.css') }}" />
<script src="{{ asset('admin/js/pages/list.js') }}"></script>

@section('mainContent') @yield('listContent') @endsection
