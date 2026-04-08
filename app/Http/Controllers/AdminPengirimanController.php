<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class AdminPengirimanController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::all();
        return view('admin.pengiriman', compact('pesanans'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $pesanan->status = $request->status;
        $pesanan->save();

        return back();
    }
}