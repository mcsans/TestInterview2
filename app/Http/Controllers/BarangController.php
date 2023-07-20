<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manajemen_inventory.barang.index');
    }

    public function readData()
    {
        return view('manajemen_inventory.barang.tbody',[
            'data' => Barang::with('kategori')->get(),
        ]);
    }

    public function showForm(Request $request)
    {
        if(!$request->id){
            return view('manajemen_inventory.barang.form-add', [
                'kategori' => KategoriBarang::all()
            ]);
        } else {
            return view('manajemen_inventory.barang.form-edit', [
                'data'      => Barang::find($request->id),
                'kategori'  => KategoriBarang::all()
            ]);
        }
    }

    public function showFormStock()
    {
        return view('manajemen_inventory.barang.form-stock', [
            'barang' => Barang::all()
        ]);
    }

    public function addStock(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barang_id'     => 'required',
            'jumlah_barang' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('barang/showFormStock')->withErrors($validator)->withInput();
        } else {
            $barang = Barang::find($request->barang_id);

            if(!$barang) { return 'Barang tidak tersedia'; }

            $barang->fill(['jumlah_barang' => ($barang->jumlah_barang + $request->jumlah_barang)]);
            $barang->save();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_barang_id' => 'required',
            'nama'               => 'required',
            'foto'               => 'image|max:2048',
            'tanggal_masuk'      => 'required',
            'jumlah_barang'      => 'required',
            'harga_beli'         => 'required',
            'harga_jual'         => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('barang/showForm')->withErrors($validator)->withInput();
        } else {
            $data = $request->all();
            if($request->file('foto')) {
                $data['foto'] = $request->file('foto')->store('barang/foto');
            }
            Barang::create($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $validator = Validator::make($request->all(), [
            'kategori_barang_id' => 'required',
            'nama'               => 'required',
            'foto'               => 'image|max:2048',
            'tanggal_masuk'      => 'required',
            'jumlah_barang'      => 'required',
            'harga_beli'         => 'required',
            'harga_jual'         => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('barang/showForm?id='.$barang->id)->withErrors($validator)->withInput();
        } else {
            $data = $request->all();
            if($request->file('foto')) {
                $data['foto'] = $request->file('foto')->store('product/foto');
                if ($barang->foto != null) { Storage::delete($barang->foto); }
            }
            $barang->fill($data);
            $barang->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        if ($barang->foto != null) { Storage::delete($barang->foto); }
        Barang::destroy($barang->id);
    }
}
