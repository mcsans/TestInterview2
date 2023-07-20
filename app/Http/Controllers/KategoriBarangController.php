<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manajemen_inventory.kategori_barang.index');
    }

    public function readData()
    {
        return view('manajemen_inventory.kategori_barang.tbody',[
            'data' => KategoriBarang::get(),
        ]);
    }

    public function showForm(Request $request)
    {
        if(!$request->id){
            return view('manajemen_inventory.kategori_barang.form-add');
        } else {
            return view('manajemen_inventory.kategori_barang.form-edit', [
                'data' => KategoriBarang::find($request->id),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:kategori_barangs',
        ]);

        if ($validator->fails()) {
            return redirect('kategori-barang/showForm')->withErrors($validator)->withInput();
        } else {
            KategoriBarang::create($request->all());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriBarang $kategoriBarang)
    {
        $validator = Validator::make($request->all(), [
            'nama' => $kategoriBarang->nama == $request->nama ? 'required' : 'required|unique:kategori_barangs',
        ]);

        if ($validator->fails()) {
            return redirect('kategori-barang/showForm?id='.$kategoriBarang->id)->withErrors($validator)->withInput();
        } else {
            $kategoriBarang->fill($request->all());
            $kategoriBarang->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriBarang $kategoriBarang)
    {
        Barang::where('kategori_barang_id', $kategoriBarang->id)->update(['kategori_barang_id' => null]);
        KategoriBarang::destroy($kategoriBarang->id);
    }
}
