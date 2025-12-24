@extends('admin.layouts.base')
@section('title')
    Tambah Admin
@endsection
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Admin</h4>
                <form class="forms-sample" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="ADMIN" id="role" name="role" >
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="Nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" value="{{ old('email') }}" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" value="{{ old('password') }}" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                    <a href="{{ url('/admin/users/admins') }}" class="btn btn-dark">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
