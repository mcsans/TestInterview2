<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KeranjangPesanan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kasir.pesan.index', [
            'totalCart' => KeranjangPesanan::count(),
        ]);
    }

    public function readData()
    {
        return view('kasir.pesan.tbody',[
            'data' => Barang::with('kategori')->get(),
            'cart' => KeranjangPesanan::get(),
        ]);
    }
}
