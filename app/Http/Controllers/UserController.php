<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($user) {
                    return '<a href="'.route('user.edit', [$user->id]).'"
                     class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                     <a href="'.route('user.destroy', [$user->id]).'"
                     class="btn btn-xs btn-danger" data-confirm="Yakin menghapus data ini?">
                     <i class="fa fa-trash"></i> Hapus</a>';
                })
                ->toJson();
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    private function validateForm(Request $request){
        $this->validate($request, [

            'name' => 'required|min:3|max:50',
            'hp' => 'required|min:10|max:15',
            'email' => 'required|email|min:3|max:100',
            'level' => 'required',
            'password' => 'required'

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
            $user = new User();

            $user->name = $request->name;
            $user->hp = $request->hp;
            $user->email = $request->email;
            $user->level = $request->level;
            $user->password = Hash::make($request->password);

            $user->save();

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

        return redirect()->route('user.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validateForm($request);

        try {
            $user->name = $request->name;
            $user->hp = $request->hp;
            $user->email = $request->email;
            $user->level = $request->level;
            $user->password = Hash::make($request->password);
            $user->save();

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

        return redirect()->route('user.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $result = $user->delete();
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
