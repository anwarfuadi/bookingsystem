@extends('layouts.main')

@section('title', 'Pemesanan')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a>
<li class="breadcrumb-item active"><a href="#">Pelanggan</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Tambah Pemesanan
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('booking.store') }}" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer">Pelanggan</label>
                        <select class="select2 form-control @error('customer') is-invalid @enderror" name="customer_id" data-allow-clear="true"
                                data-placeholder="Pilih customer" required>
                            <option></option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                        @error('customer')
                        <label class="invalid-feedback" for="customer">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="customer_detail">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <select class="select2 form-control" name="room_id" data-allow-clear="true" id="select_room_id"
                            data-placeholder="Pilih Ruangan">
                        <option></option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->room_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="use_date" class="form-control" placeholder="Tanggal Penggunaan">
                </div>
                <div class="col-md-1">
                    <input type="number" name="hour_num" min="1" class="form-control" value="1" placeholder="Jumlah Jam Penggunaan">
                </div>
                <div class="col-md-3">
                    <button type="button" id="btn_add" class="btn btn-primary">Tambah</button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    @error('total')
                    <label class="text-danger" for="total"><small><strong>{{ $message }}</strong></small></label>
                    @enderror
                    {{session()->forget('booking')}}
                    <table id="table-cart" class="table booking-detail">
                        <thead>
                        <tr>
                            <th width="200px">Nama Ruang</th>
                            <th width="200px">Tanggal</th>
                            <th width="100px">Jumlah Jam</th>
                            <th width="10px"></th>
                        </tr>
                        </thead>
                        <tbody class="cart_detail">
                        @if(Session::has('booking'))
                            @foreach (session('booking') as $booking)
                                <tr>
                                    <td>{{ $booking['room_name'] }}</td>
                                    <td>{{ $booking['use_date'] }}</td>
                                    <td>{{ $booking['hour_num'] }}</td>
                                    <td><button type="button" class="btn btn-outline-danger btn-sm remove" title="Hapus" onclick="removeCart(this);"><i class="far fa-trash-alt"></i></button></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('booking.index') }}" class="btn btn-warning">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script>

    function removeCart(element){
        let row = element.parentNode.parentNode;
        row.parentNode.removeChild(row);

        let table = document.querySelector('.booking-detail').getElementsByTagName('tbody')[0];
        if (table.rows.length == 1) {
            document.querySelectorAll('button.remove').forEach(element => {
                element.readonly = true;
            });
        }
    }

    $('#btn_add').on('click', function(){
        let tableBooking = document.querySelector('.booking-detail').getElementsByTagName('tbody')[0];
        let lastId = tableBooking.rows.length;
        $.ajax({
            type: 'GET',
            url: '{{ route('booking.getRoom') }}',
            data: {
                'room_id': $("#select_room_id :selected").val(),
                'use_date': $('input[name="use_date"]').val(),
                'hour_num': $('input[name="hour_num"]').val()},
            dataType: 'JSON',
            success: function(data) {
                $('input[name="room_id"]').val();
                $('input[name="use_date"]').val();
                $('input[name="hour_num"]').val(1);
                console.log(data);
                if (data.order.length != 0){
                    if (!data.outOfStock){
                        let content = '';
                        //let total_product = ($('input[name="total_product"]').val() == "") ? 0 :  $('input[name="total_product"]').val();
                        for(let i in data.order){
                            content += `
                        <tr><td>${data.order[i].room_name}</td>
                        <td>${data.order[i].use_date}</td>
                        <td>${data.order[i].hour_num}</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger btn-sm remove" title="Hapus" onclick="removeCart(this);"><i class="far fa-trash-alt"></i></button>
                        </td></tr>`;
                           // total_product += 1;
                        }
                        $('.cart_detail').html(content);
                    }else{
                        sweetAlert('error', 'Stok Produk tidak mencukupi');
                    }

                }else{
                    sweetAlert('error', 'Produk tidak ada');
                }
            }
        })
    });

</script>
@endpush
