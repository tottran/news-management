@extends('admin.layouts.master') @stack('head')
<link rel="stylesheet" href="{{ asset('admin/css/pages/add.css') }}" />

@section('mainContent') @yield('addContent') @endsection
