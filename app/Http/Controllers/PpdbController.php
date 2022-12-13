<?php

namespace App\Http\Controllers;

use App\Models\Ppdb;
use Illuminate\Http\Request;

class PpdbController extends Controller
{
    public function index()
    {
        return view('dashboard.ppdb.index', [
            'title' => 'PPDB',
            'ppdb' => Ppdb::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_siswa' => 'required|max:255',
            'asal_sekolah' => 'required|max:255',
            'alamat' => 'required',
            'email' => 'required|email|max:255',
            'no_tlp' => 'required|max:255'
        ]);

        Ppdb::create($validatedData);

        return redirect('/')->with('success', 'Terimakasih atas pendaftaran yang telah anda kirimkan!!!. <br>Bila ada yang ditanyaka bisa chat WhatsApp pada nomor di contact.');
    }
}
