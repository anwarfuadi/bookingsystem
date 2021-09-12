@extends('layouts.main')

@section('title', 'Pemesanan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Pemesanan</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Data Pemesanan
    </div>
    <div class="card-body">

        <a href="{{ route('booking.create') }}" class="btn btn-success btn-sm mb-3">Tambah</a>

        <table id="booking-table" class="table table-stripped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Pemesanan</th>
                    <th>Pelanggan</th>
                    <th>Pengguna</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('script')
<script>
    var table = $('#booking-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('booking.index') }}',
        order: [[1,'asc']],
        columns: [
            {data: 'DT_RowIndex', searchable: false, orderable:false},
            {data: 'booking_no'},
            {data: 'customer_name'},
            {data: 'user_name'},
            {data: 'booking_date'},
            {data: 'action', searchable: false, orderable:false},
        ],
        drawCallback: function(){
            confirmDelete();
        }
    });

    $('#booking-menu').addClass('active');
</script>
@endpush
