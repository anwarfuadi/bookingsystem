<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $totalBooking = Booking::count();
        $totalRoom = Room::count();
        $totalCustomer = Customer::count();
        $bookings = Booking::limit(5)->latest()->get();

        $monthly = DB::select('SELECT * FROM booking_per_bulan');

        return view('home', compact('totalBooking', 'totalRoom', 'bookings', 'totalCustomer', 'monthly'));
    }
}
