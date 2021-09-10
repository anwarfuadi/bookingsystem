@extends('layouts.main')

@section('title', 'Home')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a>
<li class="breadcrumb-item active"><a href="#">Kategori</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Data Kategori Produk
    </div>
    <div class="card-body">

        <a href="{{ route('category.create') }}" class="btn btn-success btn-sm mb-3">Tambah</a>

        <table id="category-table" class="table table-stripped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('script')
<script>
    var table = $('#category-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('category.index') }}',
        order: [[1,'asc']],
        columns: [
            {data: 'DT_RowIndex', searchable: false, orderable:false},
            {data: 'category_name'},
            {data: 'action', searchable: false, orderable:false},
        ],
        drawCallback: function(){
            confirmDelete();
        }
    });
</script>
@endpush
