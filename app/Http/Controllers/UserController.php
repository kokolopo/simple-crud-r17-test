<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public  function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);

        return view('app')->with([
            'users' => $users,
            'totalData' => count($users)
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

        $newUser = new User([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);

        $newUser->save();

        return redirect()->back()->with('success', 'Berhasil Menambahakan Data Baru.');
    }

    public function edit($id)
    {
        return User::find($id);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->update($request->except(['_token','submit']));    

        return redirect()->back()->with('success', 'Berhasil Perbaharui Data.');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data.');
    }

    public function fetchUsers(Request $request)
    {
        try {
            $response = Http::get($request->url);
            $data = $response->json();

            $rowsToInsert = [];

            foreach ($data as $user) {
                $row = [
                    'nama' => $user['nama'],
                    'jabatan' => $user['jabatan'],
                    'jenis_kelamin' => $user['jenis_kelamin'],
                    'alamat' => $user['alamat'],
                ];

                $rowsToInsert[] = $row;
            }

            User::insert($rowsToInsert);
            
            return redirect()->back()->with('success', 'Berhasil Menambahakan Data Baru.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function boot()
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
