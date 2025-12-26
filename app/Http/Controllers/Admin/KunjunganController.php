<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\KunjunganStatusMail;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil query builder untuk model Kunjungan
        $query = Kunjungan::query();

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Urutkan dari yang terbaru dan lakukan paginasi
        $kunjungans = $query->latest()->paginate(15)->withQueryString();

        // Kirim data ke view
        return view('admin.kunjungan.index', compact('kunjungans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kunjungan $kunjungan)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Update status kunjungan
        $kunjungan->update(['status' => $request->status]);

        // Kirim email notifikasi ke pengunjung
        try {
            if ($kunjungan->email_pengunjung) {
                Mail::to($kunjungan->email_pengunjung)->send(new KunjunganStatusMail($kunjungan));
            }
        } catch (\Exception $e) {
            // Jika email gagal dikirim, jangan hentikan proses.
            // Admin tetap melihat sukses, tapi error email bisa di-log.
            \Log::error("Gagal mengirim email status kunjungan ke {$kunjungan->email_pengunjung}: " . $e->getMessage());
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.kunjungan.index')->with('success', 'Status kunjungan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kunjungan $kunjungan)
    {
        // Hapus data kunjungan
        $kunjungan->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.kunjungan.index')->with('success', 'Data pendaftaran kunjungan berhasil dihapus.');
    }
}
