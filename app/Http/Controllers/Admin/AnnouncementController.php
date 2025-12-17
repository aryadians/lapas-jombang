<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    // INDEX: Tampilkan daftar pengumuman
    public function index()
    {
        // Urutkan berdasarkan tanggal kegiatan terbaru
        $announcements = Announcement::orderBy('date', 'desc')->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    // CREATE: Form tambah
    public function create()
    {
        return view('admin.announcements.create');
    }

    // STORE: Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|max:255',
            'date'    => 'required|date',
            'content' => 'required',
        ]);

        Announcement::create($request->all());

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil dibuat!');
    }

    // EDIT: Form edit
    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    // UPDATE: Simpan perubahan
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title'   => 'required|max:255',
            'date'    => 'required|date',
            'content' => 'required',
        ]);

        $announcement->update($request->all());

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    // DESTROY: Hapus
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Pengumuman dihapus!');
    }
}