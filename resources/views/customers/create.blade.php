@extends('layouts.main')

@section('title', 'Pelanggan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Pelanggan</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Tambah Pelanggan
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('customer.store') }}" autocomplete="off">
            @csrf
            {{--<div class="form-group">
                <label for="customer_no">Nomor Pelanggan</label>
                <input type="text"  name="customer_no" value="{{ old('customer_no') }}"
                class="form-control @error('customer_no') is-invalid @enderror"
                required/>
                @error('customer_no')
                    <label for="customer_no" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>--}}
            <div class="form-group">
                <label for="customer_name">Nama</label>
                <input type="text"  name="customer_name" value="{{ old('customer_name') }}"
                       class="form-control @error('customer_name') is-invalid @enderror"
                       required/>
                @error('customer_name')
                <label for="customer_name" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text"  name="address" value="{{ old('address') }}"
                       class="form-control @error('address') is-invalid @enderror"
                       required/>
                @error('address')
                <label for="address" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="city">Kota</label>
                <input type="text"  name="city" value="{{ old('city') }}"
                       class="form-control @error('city') is-invalid @enderror"
                       required/>
                @error('city')
                <label for="city" class="invalid-feedback">{{ $message }}</label>
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
                <label for="hp">HP</label>
                <input type="text"  name="hp" value="{{ old('hp') }}"
                       class="form-control @error('hp') is-invalid @enderror"
                       required/>
                @error('hp')
                <label for="hp" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('customer.index') }}" class="btn btn-warning">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

    @push('script')
        <script>
            $('#customer-menu').addClass('active');
        </script>
@endpush
