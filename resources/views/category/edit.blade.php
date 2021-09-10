@extends('layouts.main')

@section('title', 'Home')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a>
<li class="breadcrumb-item active"><a href="#">Kategori</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Ubah Kategori Produk
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('category.update', $category->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="category_name">Nama Kategori</label>
                <input type="text"  name="category_name" value="{{ $category->category_name }}"
                class="form-control @error('category_name') is-invalid @enderror"
                required/>
                @error('category_name')
                    <label for="category_name" class="invalid-feedback">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('category.index') }}" class="btn btn-warning">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
