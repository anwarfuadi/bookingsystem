@extends('layouts.main')

@section('title', 'Home')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a>
<li class="breadcrumb-item active"><a href="#">Ruangan</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Data Ruangan
    </div>
    <div class="card-body">

        <a href="{{ route('room.create') }}" class="btn btn-success btn-sm mb-3">Tambah</a>

        <table id="room-table" class="table table-stripped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Kapasitas</th>
                    <th>Lantai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('script')
<script>
    var table = $('#room-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('room.index') }}',
        order: [[1,'asc']],
        columns: [
            {data: 'DT_RowIndex', searchable: false, orderable:false},
            {data: 'room_code'},
            {data: 'room_name'},
            {data: 'capacity'},
            {data: 'floor'},
            {data: 'action', searchable: false, orderable:false},
        ],
        drawCallback: function(){
            confirmDelete();
        }
    });
</script>
@endpush
