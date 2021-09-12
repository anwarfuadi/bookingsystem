@extends('layouts.main')

@section('title', 'Home')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalBooking }}</h3>
                    <p>Pemesanan</p>
                </div>
                <div class="icon"><i class="fas fa-shopping-cart"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalRoom }}</h3>
                    <p>Produk</p>
                </div>
                <div class="icon"><i class="fas fa-th"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalCustomer }}</h3>
                    <p>Customer</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Pemesanan Terakhir</div>
                <div class="card-body">
                    <table class="table table-stripped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomer Pemesanan</th>
                            <th>Pelanggan</th>
                            <th>Pengguna</th>
                            <th>Tanggal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->booking_no }}</td>
                                <td>{{ $booking->customer->customer_name }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->booking_date }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Pemesanan Per Bulan</div>
                <div class="card-body">
                    <table class="table table-stripped">
                        <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Jumlah Pesanan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($monthly as $m)
                            <tr>
                                <td>{{ $m->bulan }}</td>
                                <td>{{ $m->tahun }}</td>
                                <td>{{ $m->jml_booking }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
