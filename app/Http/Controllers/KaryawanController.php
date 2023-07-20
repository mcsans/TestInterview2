<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manajemen_karyawan.daftar_karyawan.index');
    }

    public function readData()
    {
        return view('manajemen_karyawan.daftar_karyawan.tbody',[
            'data' => User::get(),
        ]);
    }

    public function showForm(Request $request)
    {
        if(!$request->id){
            return view('manajemen_karyawan.daftar_karyawan.form-add');
        } else {
            return view('manajemen_karyawan.daftar_karyawan.form-edit', [
                'data' => User::find($request->id),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|unique:karyawans',
            'password' => 'required',
            'ktp'      => 'required',
            'role'     => 'required',
            'telepon'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('karyawan/showForm')->withErrors($validator)->withInput();
        } else {
            User::create($request->all());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        User::destroy($karyawan->id);
    }
}
