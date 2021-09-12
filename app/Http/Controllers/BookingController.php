<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bookings = Booking::get();

            return DataTables::of($bookings)
                ->addIndexColumn()
                ->addColumn('customer_name', function ($booking){
                    return $booking->customer->customer_name;
                })
                ->addColumn('user_name', function ($booking){
                    return $booking->user->name;
                })
                ->addColumn('action', function ($booking) {
                    return '<a href="'.route('booking.edit', [$booking->id]).'"
                     class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>';
                })
                ->toJson();
        }

        return view('bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::get(['id', 'customer_name']);
        $rooms = Room::get(['id', 'room_name']);

        return view('bookings.create', compact('customers','rooms'));
    }

    public function getRoom(Request $request)
    {
        $room = Room::find($request->room_id);

        $orders = [];
        $outOfStock = false;
        if (!is_null($room)){
            if(!$request->session()->has('order')){
                session([
                    'order' => $orders,
                    'outOfStock' => $outOfStock
                ]);
            }

            $orders = (session('order'));

            $orders[$room->id] = [
                'room_id' => $room->id,
                'room_name' => $room->room_name,
                'use_date' => $request->use_date,
                'hour_num' => $request->hour_num
            ];

            //simpan ke session
            session([
                'order' => $orders,
                'outOfStock' => $outOfStock
            ]);
        }

        return response()->json(['order' => $orders, 'outOfStock' => $outOfStock]);
    }

    private function validateForm(Request $request){
        $this->validate($request, [

            'booking_no' => 'required|min:1|max:10',
            'booking_name' => 'required|min:3|max:50',
            'address' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:100',
            'city' => 'required|min:3|max:50',
            'hp' => 'required|min:10|max:15',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orders = session('order');
        $orderDetails = [];
        foreach($orders as $order){
            $orderDetails[] = [
                'room_id' => $order['room_id'],
                'use_date' => $order['use_date'],
                'hour_num' => $order['hour_num']
            ];
        }

        DB::beginTransaction();
        try{
            $order = Booking::create([
                'booking_no' => "B00001",
                'customer_id' => $request->customer_id,
                'booking_date' => now(),
                'user_id' => Auth::user()->id
            ]);

            //insert ke tabel order detail dengan eloquent relationship
            $order->bookingDetails()->createMany($orderDetails);

            DB::commit();
            $status = [
                'status' => 'success',
                'message' => 'Proses order telah berhasil'
            ];

            $request->session()->forget('order');

        }catch(Exception $e){
            DB::rollback();
            $status = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }

        return redirect('booking')->with($status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $this->validateForm($request);

        try {
            $booking->booking_no = $request->booking_no;
            $booking->booking_name = $request->booking_name;
            $booking->address = $request->address;
            $booking->email = $request->email;
            $booking->city = $request->city;
            $booking->hp = $request->hp;
            $booking->save();

            $result = [
                'status' => 'success',
                'message' => 'Data Berhasil Diperbarui'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 'error',
                'message' => 'Data Gagal Diperbarui'
            ];
        }

        return redirect()->route('booking.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $result = $booking->delete();
        if ($result > 0){
            $status = [
                'status' => 'success',
                'message' => 'Data Berhasil Dihaupus'
            ];
        }else{
            $status = [
                'status' => 'error',
                'message' => 'Data Gagal Dihaupus'
            ];
        }

        return response()->json($status);
    }
}
