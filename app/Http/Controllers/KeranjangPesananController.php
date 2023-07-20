<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\KeranjangPesanan;
use App\Models\Transaksi;
use App\Models\TransaksiBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeranjangPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kasir.keranjang_pesanan.index', [
            'barang' => Barang::where('jumlah_barang', '>', 0)->get()
        ]);
    }

    public function readData()
    {
        return view('kasir.keranjang_pesanan.tbody',[
            'data' => KeranjangPesanan::get(),
        ]);
    }

    public function listPenjualan()
    {
        return view('kasir.list_penjualan.index');
    }

    public function readDataPenjualan()
    {
        return view('kasir.list_penjualan.tbody',[
            'data' => Transaksi::with(['user'])->get(),
        ]);
    }

    public function detailTransaksi(Request $request)
    {
        return view('kasir.list_penjualan.detail', [
            'barang' => TransaksiBarang::with('barang')->where('transaksi_id', $request->id)->get()
        ]);
    }

    public function showForm(Request $request)
    {
        if(!$request->id){
            return view('kasir.keranjang_pesanan.form-add', [
                'kategori' => KategoriBarang::all()
            ]);
        } else {
            return view('kasir.keranjang_pesanan.form-edit', [
                'data'      => Barang::find($request->id),
                'kategori'  => KategoriBarang::all()
            ]);
        }
    }

    public function pembayaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tunai' => 'required',
            'total' => 'required',
        ]);

        if ($validator->fails()) {
            return 'Pembarayan gagal';
        } else {
            $data = [
                'user_id' => auth()->user()->id,
                'total'   => $request->total,
                'tunai'   => $request->tunai,
            ];
            $transaksi = Transaksi::create($data);

            $barang = KeranjangPesanan::get();
            foreach($barang as $brg) {
                TransaksiBarang::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id'    => $brg->barang_id,
                    'harga'        => (integer) $brg->harga,
                    'jumlah'       => (integer) $brg->jumlah,
                ]);

                $stock = Barang::where('id', $brg->barang_id)->first();
                $stock->fill(['jumlah_barang' => ($stock->jumlah_barang - $brg->jumlah)]);
                $stock->save();
            }
            KeranjangPesanan::truncate();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required',
        ]);

        if ($validator->fails()) {
            return 'Data added not successfully';
        } else {
            $barang = Barang::find($request->barang_id);

            $barangInKeranjang = KeranjangPesanan::where('barang_id', $barang->id)->first();

            if(!$barangInKeranjang) {
                $data = $request->all();
                $data['harga'] = $barang->harga_jual;
                $data['jumlah'] = 1;
                KeranjangPesanan::create($data);
            } else {
                if($barang->jumlah_barang === $barangInKeranjang->jumlah) { return 'Not enough stock'; }

                $barangInKeranjang->fill(['jumlah' => ($barangInKeranjang->jumlah+1)]);
                $barangInKeranjang->save();
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KeranjangPesanan $keranjangPesanan)
    {
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required',
            'jumlah'    => 'required',
        ]);

        if ($validator->fails()) {
            return 'Data added not successfully';
        } else {
            $barang = Barang::find($request->barang_id);

            $barangInKeranjang = KeranjangPesanan::where('barang_id', $barang->id)->first();

            if($barang->jumlah_barang < $request->jumlah) { return $barangInKeranjang->jumlah; }
           
            $barangInKeranjang->fill(['jumlah' => $request->jumlah]);
            $barangInKeranjang->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KeranjangPesanan $keranjangPesanan)
    {
        KeranjangPesanan::destroy($keranjangPesanan->id);
    }

    public function resetKeranjang() {
        KeranjangPesanan::truncate();
    }
}
