<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    // 🔥 TAMPIL DATA
    public function index()
    {
        $petugas = Petugas::all();
        return view('admin.petugas', compact('petugas'));
    }

    // 🔥 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:petugas,email',
            'password' => 'required|min:6',
            'alamat' => 'nullable'
        ]);

        Petugas::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat
        ]);

        return back()->with('success', 'Petugas berhasil ditambahkan');
    }

    // 🔥 HAPUS DATA
    public function delete($id)
    {
        Petugas::findOrFail($id)->delete();
        return back()->with('success', 'Petugas berhasil dihapus');
    }
}