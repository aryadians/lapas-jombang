<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamar Posisi - {{ $lowongan->posisi }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .header-bg {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            height: 200px;
            border-radius: 0 0 30px 30px;
            margin-bottom: -100px;
        }
        .apply-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        .form-control, .form-select {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }
        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.15);
        }
        .btn-submit {
            padding: 0.8rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(25,135,84,0.3);
        }
    </style>
</head>
<body class="pb-5">
    <div class="header-bg position-relative">
        <div class="container h-100 d-flex flex-column justify-content-center text-white">
            <a href="/" class="text-white-50 text-decoration-none mb-2">
                <i class="bi bi-arrow-left"></i> Kembali ke Lowongan
            </a>
            <h2 class="fw-bold">{{ $lowongan->posisi }}</h2>
            <p class="opacity-75 mb-0">
                <i class="bi bi-building me-1"></i> {{ $lowongan->departemen->name }} &bull; 
                <i class="bi bi-geo-alt ms-2"></i> Surabaya, Indonesia
            </p>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card apply-card bg-white">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold text-primary">Formulir Pendaftaran</h4>
                            <p class="text-muted small">Silakan lengkapi data diri Anda dengan benar.</p>
                        </div>

                        <form action="{{ route('apply.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_lowongan" value="{{ $lowongan->id }}">
                            
                            <h6 class="text-uppercase text-muted fw-bold small mb-3 mt-4 border-bottom pb-2">Data Pribadi</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                        <input type="text" name="name" class="form-control" placeholder="Sesuai KTP" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-gender-ambiguous"></i></span>
                                        <select name="gender" class="form-select" required>
                                            <option value="" selected disabled>Pilih Gender</option>
                                            <option value="male">Laki-laki</option>
                                            <option value="female">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="dob" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Telepon / WhatsApp</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-whatsapp"></i></span>
                                        <input type="text" name="no_telp" class="form-control" placeholder="0812..." required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat Domisili</label>
                                    <textarea name="address" class="form-control" rows="2" placeholder="Alamat lengkap saat ini..." required></textarea>
                                </div>
                            </div>

                            <h6 class="text-uppercase text-muted fw-bold small mb-3 mt-5 border-bottom pb-2">Data Pendidikan</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Universitas</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-mortarboard"></i></span>
                                        <input type="text" name="university" class="form-control" placeholder="Nama Kampus" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jurusan</label>
                                    <input type="text" name="major" class="form-control" placeholder="Contoh: Informatika" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">IPK Terakhir</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-bar-chart"></i></span>
                                        <input type="number" step="0.01" min="0" max="4.0" name="ipk" class="form-control" placeholder="0.00" required>
                                    </div>
                                    <div class="form-text text-muted small">Gunakan titik (.) untuk desimal. Contoh: 3.50</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Upload CV (PDF/JPG)</label>
                                    <input type="file" name="path_cv" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                                    <div class="form-text text-muted small">Maksimal ukuran file 2MB.</div>
                                </div>
                            </div>

                            <div class="mt-5 d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-submit btn-lg text-white">
                                    <i class="bi bi-send-fill me-2"></i> Kirim Lamaran Saya
                                </button>
                                <a href="/" class="btn btn-light text-muted">Batal & Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4 text-muted small">
                    &copy; {{ date('Y') }} MSJ Recruitment Portal. Data Anda aman bersama kami.
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>