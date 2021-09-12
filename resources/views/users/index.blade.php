@extends('layouts.main')

@section('title', 'Pengguna')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Pengguna</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Data Pengguna
    </div>
    <div class="card-body">

        <a href="{{ route('user.create') }}" class="btn btn-success btn-sm mb-3">Tambah</a>

        <table id="user-table" class="table table-stripped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>HP</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('script')
<script>
    var table = $('#user-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('user.index') }}',
        order: [[1,'asc']],
        columns: [
            {data: 'DT_RowIndex', searchable: false, orderable:false},
            {data: 'name'},
            {data: 'hp'},
            {data: 'email'},
            {data: 'level'},
            {data: 'action', searchable: false, orderable:false},
        ],
        drawCallback: function(){
            confirmDelete();
        }
    });


    $('#user-menu').addClass('active');

</script>
@endpush
