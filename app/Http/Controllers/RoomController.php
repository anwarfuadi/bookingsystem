<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rooms = Room::get();

            return DataTables::of($rooms)
                ->addIndexColumn()
                ->addColumn('action', function ($rooms) {
                    return '<a href="'.route('room.edit', [$rooms->id]).'"
                     class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                     <a href="'.route('room.destroy', [$rooms->id]).'"
                     class="btn btn-xs btn-danger" data-confirm="Yakin menghapus data ini?">
                     <i class="fa fa-trash"></i> Hapus</a>';
                })
                ->toJson();
        }

        return view('rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    private function validateForm(Request $request){
        $this->validate($request, [
            'room_code' => 'required|min:3|max:5',
            'room_name' => 'required|min:1|max:50',
            'capacity' => 'required|numeric',
            'floor' => 'required|min:1|max:3'
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
        $this->validateForm($request);

        try {
            $room = new Room();
            $room->room_code = $request->room_code;
            $room->room_name = $request->room_name;
            $room->capacity = $request->capacity;
            $room->floor = $request->floor;
            $room->save();

            $result = [
                'status' => 'success',
                'message' => 'Data Berhasil Ditambahkan'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 'error',
                'message' => 'Data Gagal Ditambahkan'
            ];
        }

        return redirect()->route('room.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $this->validateForm($request);

        try {
            $room->room_code = $request->room_code;
            $room->room_name = $request->room_name;
            $room->capacity = $request->capacity;
            $room->floor = $request->floor;
            $room->save();

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

        return redirect()->route('room.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $result = $room->delete();
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
