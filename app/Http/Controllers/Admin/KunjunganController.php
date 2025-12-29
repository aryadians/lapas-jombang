<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\KunjunganStatusMail;
use Illuminate\Support\Str;

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

        // Filter berdasarkan rentang tanggal kunjungan
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        if ($tanggalMulai && $tanggalSelesai) {
            // Jika kedua tanggal ada, gunakan whereBetween
            $query->whereBetween('tanggal_kunjungan', [$tanggalMulai, $tanggalSelesai]);
        } elseif ($tanggalMulai) {
            // Jika hanya tanggal mulai
            $query->whereDate('tanggal_kunjungan', '>=', $tanggalMulai);
        } elseif ($tanggalSelesai) {
            // Jika hanya tanggal selesai
            $query->whereDate('tanggal_kunjungan', '<=', $tanggalSelesai);
        }

        // Filter berdasarkan kata kunci pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pengunjung', 'like', '%' . $search . '%')
                  ->orWhere('nama_wbp', 'like', '%' . $search . '%')
                  ->orWhere('nik_pengunjung', 'like', '%' . $search . '%');
            });
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

        $updateData = ['status' => $request->status];

        // Jika status adalah "approved", buat token unik untuk QR code
        // dan pastikan token belum ada.
        if ($request->status === 'approved' && is_null($kunjungan->qr_token)) {
            $updateData['qr_token'] = Str::random(40);
        }

        // Update status kunjungan (dan token jika ada)
        $kunjungan->update($updateData);

        // Refresh model untuk mendapatkan data terbaru (termasuk token)
        $kunjungan->refresh();

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

    /**
     * Display the specified resource.
     */
    public function show(Kunjungan $kunjungan)
    {
        return view('admin.kunjungan.show', compact('kunjungan'));
    }

    /**
     * Show the form for verifying a QR code.
     */
    public function showVerificationForm()
    {
        return view('admin.kunjungan.verifikasi');
    }

    /**
     * Verify the QR code token and display the visit details.
     */
    public function verifyQrCode(Request $request)
    {
        $request->validate([
            'qr_token' => 'required|string',
        ]);

        $kunjungan = Kunjungan::where('qr_token', $request->qr_token)->first();

        return view('admin.kunjungan.verifikasi', compact('kunjungan'));
    }

    /**
     * Bulk update status for multiple kunjungans.
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:kunjungans,id',
            'status' => 'required|in:approved,rejected',
        ]);

        $ids = $request->input('ids');
        $status = $request->input('status');

        // Update all selected kunjungans
        $kunjungans = Kunjungan::whereIn('id', $ids)->get();

        foreach ($kunjungans as $kunjungan) {
            $updateData = ['status' => $status];

            // Generate QR token for approved kunjungans if not exists
            if ($status === 'approved' && is_null($kunjungan->qr_token)) {
                $updateData['qr_token'] = Str::random(40);
            }

            $kunjungan->update($updateData);

            // Send email notification
            try {
                if ($kunjungan->email_pengunjung) {
                    Mail::to($kunjungan->email_pengunjung)->send(new KunjunganStatusMail($kunjungan));
                }
            } catch (\Exception $e) {
                \Log::error("Gagal mengirim email status kunjungan ke {$kunjungan->email_pengunjung}: " . $e->getMessage());
            }
        }

        return redirect()->route('admin.kunjungan.index')->with('success', 'Status ' . count($kunjungans) . ' pendaftaran kunjungan berhasil diperbarui.');
    }

    /**
     * Bulk delete multiple kunjungans.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:kunjungans,id',
        ]);

        $ids = $request->input('ids');
        $count = Kunjungan::whereIn('id', $ids)->count();

        // Delete all selected kunjungans
        Kunjungan::whereIn('id', $ids)->delete();

        return redirect()->route('admin.kunjungan.index')->with('success', $count . ' pendaftaran kunjungan berhasil dihapus.');
    }
}
