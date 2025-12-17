<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSJ Career - Temukan Karir Impianmu</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        /* Hero Section Style */
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
            padding: 80px 0 60px;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
        }
        /* Card Hover Effect */
        .job-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            background: white;
        }
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }
        .dept-badge {
            background-color: #e7f1ff;
            color: #0d6efd;
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: 600;
        }
        .quota-text {
            font-size: 0.9rem;
            color: #198754;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="/">
                <i class="bi bi-buildings-fill me-2"></i> MSJ Career
            </a>
            <div class="ms-auto">
                <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 btn-sm fw-medium">
                    <i class="bi bi-shield-lock me-1"></i> Login Admin
                </a>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="fw-extrabold mb-3 display-5">Bergabunglah Bersama Kami</h1>
            <p class="lead opacity-75 mx-auto" style="max-width: 600px;">
                Temukan peluang karir terbaik dan kembangkan potensimu di lingkungan kerja yang profesional dan inovatif.
            </p>
        </div>
    </header>

    <div class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex align-items-center mb-4">
            <h3 class="fw-bold mb-0 text-dark">Lowongan Tersedia</h3>
            <span class="badge bg-primary ms-2 rounded-pill">{{ count($lowongans) }} Posisi</span>
        </div>

        <div class="row g-4">
            @forelse($lowongans as $l)
            <div class="col-md-4">
                <div class="card job-card h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="dept-badge">
                                <i class="bi bi-building me-1"></i> {{ $l->departemen->name }}
                            </span>
                            <div class="text-end">
                                <small class="text-muted d-block" style="font-size: 0.7rem;">Diposting</small>
                                <small class="fw-bold text-secondary" style="font-size: 0.8rem;">
                                    {{ $l->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>

                        <h5 class="card-title fw-bold mb-2 text-dark">{{ $l->posisi }}</h5>
                        <p class="card-text text-muted small flex-grow-1" style="line-height: 1.6;">
                            {{ Str::limit($l->deskripsi, 100) }}
                        </p>
                        
                        <hr class="border-light my-3">

                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <div class="quota-text">
                                <i class="bi bi-people-fill me-1"></i> Kuota: {{ $l->quota }}
                            </div>
                            <a href="{{ route('apply', $l->id) }}" class="btn btn-primary px-4 rounded-3">
                                Daftar <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded-3 shadow-sm">
                    <i class="bi bi-search fs-1 text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada lowongan dibuka saat ini.</h5>
                    <p class="text-secondary">Silakan kembali lagi nanti.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <div class="mt-5 pt-4 text-center text-muted border-top">
            <small>&copy; {{ date('Y') }} MSJ Recruitment Portal. All rights reserved.</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>