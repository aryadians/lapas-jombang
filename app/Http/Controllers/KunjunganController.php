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
        // 1. Validasi Input Dasar
        $validated = $request->validate([
            'nama_pengunjung'    => 'required|string|max:255',
            'nik_pengunjung'     => 'required|string|size:16',
            'no_wa_pengunjung'   => 'required|string|max:15',
            'email_pengunjung'   => 'required|email|max:255',
            'alamat_pengunjung'  => 'required|string',
            'nama_wbp'           => 'required|string|max:255',
            'hubungan'           => 'required|string|max:100',
            'tanggal_kunjungan'  => 'required|date|after_or_equal:today',
            'sesi'               => 'nullable|string|in:pagi,siang',
        ]);

        $tanggalKunjungan = \Carbon\Carbon::parse($validated['tanggal_kunjungan']);
        $sesi = $request->input('sesi');

        // 2. Validasi Hari & Sesi
        // Cek apakah hari libur (Jumat, Sabtu, Minggu)
        if ($tanggalKunjungan->isFriday() || $tanggalKunjungan->isSaturday() || $tanggalKunjungan->isSunday()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'tanggal_kunjungan' => 'Pendaftaran tidak bisa dilakukan pada hari Jumat, Sabtu, atau Minggu.',
            ]);
        }

        // Jika hari senin, sesi wajib diisi
        if ($tanggalKunjungan->isMonday() && !$sesi) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'sesi' => 'Untuk hari Senin, Anda wajib memilih sesi kunjungan.',
            ]);
        }

        // 3. Validasi Kuota
        $kuotaPagiSenin = 120;
        $kuotaSiangSenin = 40;
        $kuotaHariBiasa = 150;

        $query = Kunjungan::where('tanggal_kunjungan', $tanggalKunjungan->format('Y-m-d'));
        
        if ($tanggalKunjungan->isMonday()) {
            $jumlahPendaftar = (clone $query)->where('sesi', $sesi)->count();
            $kuota = ($sesi == 'pagi') ? $kuotaPagiSenin : $kuotaSiangSenin;
            $namaSesi = ($sesi == 'pagi') ? 'Pagi' : 'Siang';
            if ($jumlahPendaftar >= $kuota) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'sesi' => "Maaf, kuota untuk Sesi {$namaSesi} pada tanggal tersebut sudah penuh.",
                ]);
            }
        } else {
            $jumlahPendaftar = (clone $query)->count();
            if ($jumlahPendaftar >= $kuotaHariBiasa) {
                 throw \Illuminate\Validation\ValidationException::withMessages([
                    'tanggal_kunjungan' => 'Maaf, kuota untuk tanggal tersebut sudah penuh.',
                ]);
            }
        }

        // 4. Proses Database (Nomor Antrian & Penyimpanan)
        $kunjunganBaru = null;
        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $tanggalKunjungan, &$kunjunganBaru) {
            // Hitung nomor antrian untuk hari itu
            $nomorAntrian = Kunjungan::where('tanggal_kunjungan', $tanggalKunjungan->format('Y-m-d'))->count() + 1;
            
            // Tambahkan data nomor antrian dan sesi ke data tervalidasi
            $validated['nomor_antrian_harian'] = $nomorAntrian;
            $validated['sesi'] = $validated['sesi'] ?? null; // Pastikan sesi null jika bukan senin

            // Simpan ke Database
            $kunjunganBaru = Kunjungan::create($validated);
        });

        // 5. Redirect dengan pesan sukses
        return redirect()->route('kunjungan.create')->with('success', 'Pendaftaran kunjungan berhasil dikirim! Nomor antrian Anda untuk hari itu adalah ' . $kunjunganBaru->nomor_antrian_harian . '. Silakan tunggu konfirmasi dari petugas kami.');
    }
}
