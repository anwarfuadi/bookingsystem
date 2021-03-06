@extends('layouts.main')

@section('title', 'Home')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Pengguna</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Tambah Pengguna
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.store') }}" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text"  name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror"
                required/>
                @error('name')
                    <label for="name" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="hp">HP</label>
                <input type="text"  name="hp" value="{{ old('hp') }}"
                       class="form-control @error('hp') is-invalid @enderror"
                       required/>
                @error('hp')
                <label for="hp" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text"  name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       required/>
                @error('email')
                <label for="email" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <select name="level" class="form-control @error('level') is-invalid @enderror" required>
                    <option value="admin" @if (old('level') == 'admin') selected @endif>Admin</option>
                    <option value="user" @if (old('level') == 'user') selected @endif>User</option>
                </select>
                @error('level')
                <label for="level" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"  name="password" value="{{ old('password') }}"
                       class="form-control @error('password') is-invalid @enderror"
                       required/>
                @error('password')
                <label for="password" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('user.index') }}" class="btn btn-warning">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

    @push('script')
        <script>
            $('#user-menu').addClass('active');
        </script>
@endpush
