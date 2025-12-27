@extends('layouts.admin')

@section('title', 'Verifikasi Kunjungan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Verifikasi Kode QR Kunjungan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Input Manual Token</h4>
                            <p>Masukkan token yang tertera di bawah kode QR pengunjung.</p>
                            <form action="{{ route('admin.kunjungan.verifikasi.submit') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="qr_token">Token Kode QR</label>
                                    <input type="text" name="qr_token" id="qr_token" class="form-control" placeholder="Masukkan token..." value="{{ request('qr_token') }}" required autofocus>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">
                                    <i class="fas fa-check"></i> Verifikasi
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h4>Pindai dengan Kamera</h4>
                            <p><i>(Fitur dalam pengembangan)</i></p>
                            <div id="qr-scanner-placeholder" style="width: 100%; height: 200px; border: 2px dashed #ccc; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                <span>Area Pindai Kamera</span>
                            </div>
                        </div>
                    </div>

                    @if(isset($kunjungan))
                        <hr class="my-4">
                        @if($kunjungan)
                            <div class="alert alert-success mt-4">
                                <h4><i class="icon fas fa-check"></i> Kunjungan Ditemukan</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Nama Pengunjung</dt>
                                            <dd>{{ $kunjungan->nama_pengunjung }}</dd>
                                            <dt>NIK</dt>
                                            <dd>{{ $kunjungan->nik_pengunjung }}</dd>
                                            <dt>Status</dt>
                                            <dd>
                                                @if($kunjungan->status == 'approved')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @else
                                                    <span class="badge bg-warning">{{ ucfirst($kunjungan->status) }}</span>
                                                @endif
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Nama Warga Binaan</dt>
                                            <dd>{{ $kunjungan->nama_wbp }}</dd>
                                            <dt>Tanggal Kunjungan</dt>
                                            <dd>{{ $kunjungan->tanggal_kunjungan->format('d F Y') }}</dd>
                                            <dt>Sesi</dt>
                                            <dd>{{ ucfirst($kunjungan->sesi) }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger mt-4">
                                <h4><i class="icon fas fa-ban"></i> Token Tidak Ditemukan</h4>
                                <p>Token yang Anda masukkan tidak cocok dengan data pendaftaran kunjungan manapun. Pastikan token sudah benar.</p>
                            </div>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
