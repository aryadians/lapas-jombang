<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guest.kunjungan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'nama_pengunjung'    => 'required|string|max:255',
            'nik_pengunjung'     => 'required|string|size:16',
            'no_wa_pengunjung'   => 'required|string|max:15',
            'email_pengunjung'   => 'required|email|max:255',
            'alamat_pengunjung'  => 'required|string',
            'nama_wbp'           => 'required|string|max:255',
            'hubungan'           => 'required|string|max:100',
            'tanggal_kunjungan'  => 'required|date',
        ]);

        // 2. Simpan ke Database
        Kunjungan::create($validated);

        // 3. Redirect dengan pesan sukses
        return redirect()->route('kunjungan.create')->with('success', 'Pendaftaran kunjungan berhasil dikirim! Silakan tunggu konfirmasi dari petugas kami.');
    }
}
