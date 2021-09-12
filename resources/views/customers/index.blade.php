@extends('layouts.main')

@section('title', 'Pelanggan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Pelanggan</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Data Pelanggan
    </div>
    <div class="card-body">

        <a href="{{ route('customer.create') }}" class="btn btn-success btn-sm mb-3">Tambah</a>

        <table id="customer-table" class="table table-stripped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Pelanggan</th>
                    <th>Nama</th>
                    <th>Kota</th>
                    <th>Email</th>
                    <th>HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('script')
<script>
    var table = $('#customer-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('customer.index') }}',
        order: [[1,'asc']],
        columns: [
            {data: 'DT_RowIndex', searchable: false, orderable:false},
            {data: 'customer_no'},
            {data: 'customer_name'},
            {data: 'address'},
            {data: 'email'},
            {data: 'hp'},
            {data: 'action', searchable: false, orderable:false},
        ],
        drawCallback: function(){
            confirmDelete();
        }
    });

    $('#customer-menu').addClass('active');
</script>
@endpush
