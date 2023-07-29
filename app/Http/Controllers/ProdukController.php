<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public  function index()
    {
        $users = User::orderBy('id', 'DESC')->get();

        return view('app')->with([
            'users' => $users
        ]);
    }

    public function tamabah(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        $newProduk = new User([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);

        $newProduk->save();

        return redirect()->back()->with('success', 'Berhasil Menambahakan Data Baru.');
    }

    public function edit($id)
    {
        return User::find($id);
    }

    public function updateProduk($id, Request $request)
    {
        $produk = User::find($id);
        $produk->update($request->except(['_token','submit']));    

        return redirect()->back()->with('success', 'Berhasil Perbaharui Data.');
    }

    public function deleteProduk($id)
    {
        $produk = User::find($id);
        $produk->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data.');
    }
}
