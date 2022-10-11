@extends('admin.layouts.master') @stack('head')
<link rel="stylesheet" href="{{ asset('admin/css/pages/edit.css') }}" />
@section('mainContent') @yield('editContent') @endsection
