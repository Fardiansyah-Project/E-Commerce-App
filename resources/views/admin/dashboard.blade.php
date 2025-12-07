@extends('admin.layouts.base')
@section('title')
    Dashboard
@endsection
@section('content')
    <h1 class="font-bolc">Dashboard</h1>
    <p class="d-block">Selamat datang, {{ Auth::user()->name }}</p>
@endsection
