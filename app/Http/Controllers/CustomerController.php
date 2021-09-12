<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = Customer::get();

            return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('action', function ($customer) {
                    return '<a href="'.route('customer.edit', [$customer->id]).'"
                     class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                     <a href="'.route('customer.destroy', [$customer->id]).'"
                     class="btn btn-xs btn-danger" data-confirm="Yakin menghapus data ini?">
                     <i class="fa fa-trash"></i> Hapus</a>';
                })
                ->toJson();
        }

        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    private function validateForm(Request $request){
        $this->validate($request, [

            'customer_name' => 'required|min:3|max:50',
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
        $this->validateForm($request);

        try {
            /*$customer = new Customer();

            $customer->customer_no = $request->customer_no;
            $customer->customer_name = $request->customer_name;
            $customer->address = $request->address;
            $customer->email = $request->email;
            $customer->city = $request->city;
            $customer->hp = $request->hp;
            $customer->save();*/

            DB::statement("CALL proc_customer('ADD', null,
                '$request->customer_name',
                '$request->address',
                '$request->city',
                '$request->email',
                '$request->hp'
            )");

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

        return redirect()->route('customer.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validateForm($request);

        try {
            /*$customer->customer_no = $request->customer_no;
            $customer->customer_name = $request->customer_name;
            $customer->address = $request->address;
            $customer->email = $request->email;
            $customer->city = $request->city;
            $customer->hp = $request->hp;
            $customer->save();*/

            DB::statement("CALL proc_customer('EDIT', $customer->id,
                '$request->customer_name',
                '$request->address',
                '$request->city',
                '$request->email',
                '$request->hp'
            )");

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

        return redirect()->route('customer.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {

        try {

            DB::statement("CALL proc_customer('DELETE', $customer->id,
                null,
                null,
                null,
                null,
                null
            )");

            $status = [
                'status' => 'success',
                'message' => 'Data Berhasil Dihaupus'
            ];
        } catch (Exception $e) {
            $status = [
                'status' => 'error',
                'message' => 'Data Gagal Dihaupus'
            ];
        }

        return response()->json($status);
    }
}
