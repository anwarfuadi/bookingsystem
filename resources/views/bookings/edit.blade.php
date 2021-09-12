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
        <form method="POST" action="{{ route('booking.update', $booking->id) }}" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer">Pelanggan</label>
                        <input type="hidden" id="bookingId" value="{{ $booking->id }}"/>
                        <select class="select2 form-control @error('customer') is-invalid @enderror" name="customer_id" data-allow-clear="true" disabled
                                data-placeholder="Pilih customer" required>
                            <option></option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" @if ($booking->customer_id == $customer->id) selected @endif>{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                        @error('customer')
                        <label class="invalid-feedback" for="customer">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <!--div class="row">
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
            </div-->
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
                                    <td><</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <a href="{{ route('booking.index') }}" class="btn btn-warning">Kembali</a>
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

            let tableBooking = document.querySelector('.booking-detail').getElementsByTagName('tbody')[0];
            let lastId = tableBooking.rows.length;
            $.ajax({
                type: 'GET',
                url: '{{ route('booking.getDetails') }}',
                data: {
                    'bookingId': $("#bookingId").val()},
                dataType: 'JSON',
                success: function(data) {
                    if (data.order.length != 0){
                        if (!data.outOfStock){
                            let content = '';
                            for(let i in data.order){
                                content += `
                        <tr><td>${data.order[i].room_name}</td>
                        <td>${data.order[i].use_date}</td>
                        <td>${data.order[i].hour_num}</td>
                        <td></td></tr>`;
                            }
                            $('.cart_detail').html(content);
                        }else{
                            sweetAlert('error', 'Stok Produk tidak mencukupi');
                        }
                    }else{
                        sweetAlert('error', 'Produk tidak ada');
                    }
                }
            });



        </script>
@endpush
