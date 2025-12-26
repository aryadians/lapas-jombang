<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kunjungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Informasi Kunjungan #{{ $kunjungan->id }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>Status:</strong> <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kunjungan->status === 'approved' ? 'bg-green-100 text-green-800' : ($kunjungan->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($kunjungan->status) }}
                            </span></p>
                            <p><strong>Nomor Antrian Harian:</strong> #{{ $kunjungan->nomor_antrian_harian }}</p>
                            <p><strong>Tanggal Kunjungan:</strong> {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('l, d F Y') }}</p>
                            @if($kunjungan->sesi)
                            <p><strong>Sesi Kunjungan:</strong> {{ ucfirst($kunjungan->sesi) }}</p>
                            @endif
                        </div>
                        <div>
                            <p><strong>Nama Pengunjung:</strong> {{ $kunjungan->nama_pengunjung }}</p>
                            <p><strong>NIK Pengunjung:</strong> {{ $kunjungan->nik_pengunjung }}</p>
                            <p><strong>Nomor WA:</strong> {{ $kunjungan->no_wa_pengunjung }}</p>
                            <p><strong>Email Pengunjung:</strong> {{ $kunjungan->email_pengunjung }}</p>
                            <p><strong>Alamat Pengunjung:</strong> {{ $kunjungan->alamat_pengunjung }}</p>
                        </div>
                        <div>
                            <p><strong>Nama WBP:</strong> {{ $kunjungan->nama_wbp }}</p>
                            <p><strong>Hubungan:</strong> {{ $kunjungan->hubungan }}</p>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <h4 class="text-md font-bold mb-3">Aksi:</h4>
                        <div class="flex space-x-2">
                            @if ($kunjungan->status === 'pending')
                            <form action="{{ route('admin.kunjungan.update', $kunjungan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <x-primary-button type="submit" class="bg-green-600 hover:bg-green-700">Setujui</x-primary-button>
                            </form>
                            <form action="{{ route('admin.kunjungan.update', $kunjungan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <x-danger-button type="submit">Tolak</x-danger-button>
                            </form>
                            @endif
                            <form action="{{ route('admin.kunjungan.destroy', $kunjungan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kunjungan ini?');">
                                @csrf
                                @method('DELETE')
                                <x-danger-button type="submit">Hapus</x-danger-button>
                            </form>
                            <a href="{{ route('admin.kunjungan.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
