@extends('layouts.main')

@section('title', 'Ruangan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Ruangan</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Tambah Ruangan
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('room.store') }}" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="room_code">Kode Ruangan</label>
                <input type="text"  name="room_code" value="{{ old('room_code') }}"
                class="form-control @error('room_code') is-invalid @enderror"
                required/>
                @error('room_code')
                    <label for="room_code" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="room_name">Nama Ruangan</label>
                <input type="text"  name="room_name" value="{{ old('room_name') }}"
                       class="form-control @error('room_name') is-invalid @enderror"
                       required/>
                @error('room_name')
                <label for="room_name" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="capacity">Kapasitas</label>
                <input type="number"  name="capacity" value="{{ old('capacity') }}"
                       class="form-control @error('capacity') is-invalid @enderror"
                       required/>
                @error('capacity')
                <label for="capacity" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="floor">Lantai</label>
                <input type="text"  name="floor" value="{{ old('floor') }}"
                       class="form-control @error('floor') is-invalid @enderror"
                       required/>
                @error('floor')
                <label for="floor" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('room.index') }}" class="btn btn-warning">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

    @push('script')
        <script>
            $('#room-menu').addClass('active');
        </script>
@endpush
