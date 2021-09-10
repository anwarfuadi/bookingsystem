<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::get();

            return Datatables::of($categories)
                 ->addIndexColumn()
                 ->addColumn('action', function ($category) {
                     return '<a href="'.route('category.edit', [$category->id]).'"
                     class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                     <a href="'.route('category.destroy', [$category->id]).'"
                     class="btn btn-xs btn-danger" data-confirm="Yakin menghapus data ini?">
                     <i class="fa fa-trash"></i> Hapus</a>';
                 })
                 ->toJson();
        }

        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    private function validateForm(Request $request){
        $this->validate($request, [
            'category_name' => 'required|min:3|max:30'
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
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->save();

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

        return redirect()->route('category.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validateForm($request);

        try {
            $category->category_name = $request->category_name;
            $category->save();

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

        return redirect()->route('category.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $result = $category->delete();
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
