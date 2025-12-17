<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
   
    public function index()
    {
        // Ambil berita terbaru, paginasi 10 per halaman
        $news = News::latest()->paginate(10);
        
        // Kirim ke view
        return view('admin.news.index', compact('news'));
    }

    /**
     * Menampilkan form tambah berita (CREATE)
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Menyimpan berita baru ke database (STORE)
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|file|max:2048' // Maks 2MB
            
        ]);

        // 2. Siapkan data dasar
        $data = [
            'title'   => $request->title,
    'slug'    => Str::slug($request->title),
    'content' => $request->content,
    'status'  => $request->status,
        ];

        // 3. Logika Upload Gambar ke Base64
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            
            // Ambil path sementara file
            $path = $file->getRealPath();
            
            // Ubah file jadi string binary
            $image = file_get_contents($path);
            
            // Ubah jadi base64
            $base64 = base64_encode($image);
            
            // Gabungkan header tipe data + kode base64
            // Hasilnya: "data:image/jpeg;base64,/9j/4AAQSkZJRg..."
            $data['image'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        // 4. Simpan ke Database
        News::create($data);

        // 5. Redirect kembali
        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit berita (EDIT)
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Memperbarui data berita (UPDATE)
     */
    public function update(Request $request, News $news)
    {
        // 1. Validasi Input
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|file|max:2048'
        ]);

        // 2. Siapkan data update
       $data = [
    'title'   => $request->title,
    'slug'    => Str::slug($request->title),
    'content' => $request->content,
    'status'  => $request->status,
        ];

        // 3. Cek apakah user mengupload gambar baru?
        if ($request->hasFile('image')) {
            // Jika ada gambar baru, proses Base64 lagi
            $file = $request->file('image');
            $path = $file->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            
            $data['image'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        } 
        // Jika tidak ada gambar baru, $data['image'] tidak diset
        // sehingga gambar lama di database tidak akan tertimpa/hilang.

        // 4. Lakukan Update
        $news->update($data);

        // 5. Redirect
        return redirect()->route('news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Menghapus berita (DESTROY)
     */
    public function destroy(News $news)
    {
        // Hapus data dari database
        $news->delete();

        // Karena pakai Base64, kita tidak perlu menghapus file di folder storage.
        
        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus!');
    }
}