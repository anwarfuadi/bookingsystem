@extends('layouts.main')

@section('title', 'Home')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a>
<li class="breadcrumb-item active"><a href="#">Pelanggan</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Ubah Pelanggan
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('customer.update', $customer->id) }}" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="customer_no">Nomor Pelanggan</label>
                <input type="text"  name="customer_no" value="{{ $customer->customer_no }}"
                       class="form-control @error('customer_no') is-invalid @enderror"
                       required/>
                @error('customer_no')
                <label for="customer_no" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="customer_name">Nama</label>
                <input type="text"  name="customer_name" value="{{ $customer->customer_name }}"
                       class="form-control @error('customer_name') is-invalid @enderror"
                       required/>
                @error('customer_name')
                <label for="customer_name" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text"  name="address" value="{{ $customer->address }}"
                       class="form-control @error('address') is-invalid @enderror"
                       required/>
                @error('address')
                <label for="address" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="city">Kota</label>
                <input type="text"  name="city" value="{{ $customer->city }}"
                       class="form-control @error('city') is-invalid @enderror"
                       required/>
                @error('city')
                <label for="city" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text"  name="email" value="{{ $customer->email }}"
                       class="form-control @error('email') is-invalid @enderror"
                       required/>
                @error('email')
                <label for="email" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="hp">HP</label>
                <input type="text"  name="hp" value="{{ $customer->hp }}"
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
