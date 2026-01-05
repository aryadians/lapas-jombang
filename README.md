<div align="center">
  <img src="/public/img/logo.png" alt="Lapas Jombang Logo" width="150">
  <h1>🏛️ Sistem Informasi Lapas Kelas IIB Jombang</h1>
  <p>Aplikasi web modern untuk layanan publik dan manajemen internal di <strong>Lapas Kelas IIB Jombang</strong>, dibangun dengan Laravel 12.</p>

  <!-- Badges -->
  <p>
    <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
    <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
    <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
    <img src="https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
    <br>
    <img src="https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge" alt="License: MIT">
    <img src="https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=for-the-badge" alt="PRs Welcome">
    <img src="https://img.shields.io/badge/Code%20Style-Pint-22A39F?style=for-the-badge" alt="Code Style: Pint">
  </p>
</div>

---

## 📜 About The Project

**Sistem Informasi Lapas Kelas IIB Jombang** adalah aplikasi berbasis web yang dirancang untuk mendigitalkan dan menyederhanakan layanan di Lembaga Pemasyarakatan Kelas IIB Jombang. Aplikasi ini memfasilitasi pendaftaran kunjungan online, berfungsi sebagai portal berita dan pengumuman, serta menyediakan antarmuka manajemen yang kuat untuk admin.

Proyek ini dibuat untuk memenuhi kebutuhan informasi publik yang cepat dan akurat, serta meningkatkan efisiensi operasional internal.

---

## ✨ Features

### 🌍 Halaman Publik (Guest View)
*   **📝 Pendaftaran Kunjungan Online:** Formulir pendaftaran kunjungan tatap muka dengan validasi jadwal otomatis (Senin-Kamis) dan sistem kuota harian. Pengguna menerima konfirmasi melalui email.
*   **Generate QR Code:** Pengguna mendapatkan QR Code unik setelah pendaftaran berhasil untuk proses verifikasi di lokasi.
*   **📰 Portal Informasi:** Menampilkan berita terbaru dan pengumuman resmi dari Lapas Jombang.
*   **♿ Widget Aksesibilitas:** Fitur untuk membantu pengguna disabilitas, termasuk:
    *   🔊 *Text-to-Speech* (Pembaca Layar)
    *   👁️ Mode Kontras Tinggi & Grayscale
    *   🔤 Font Ramah Disleksia & Pembesaran Teks
    *   🖱️ Kursor Besar untuk Navigasi Mudah
*   **📱 Desain Responsif:** Tampilan yang dioptimalkan untuk semua perangkat (Mobile, Tablet, dan Desktop).

### 🔐 Panel Admin (Admin View)
*   **📊 Dashboard Real-time:** Menyajikan statistik ringkas, jam digital, dan tabel aktivitas terbaru.
*   **✅ Manajemen Kunjungan:** Melihat, menyetujui, menolak, dan mengelola semua permintaan kunjungan yang masuk.
*   **📢 Manajemen Konten (CMS):** CRUD (Create, Read, Update, Delete) penuh untuk Berita dan Pengumuman.
*   **👤 Manajemen Pengguna:** Mengelola akun petugas (admin).
*   **🛡️ Autentikasi Aman:** Sistem login yang aman dengan enkripsi password standar industri yang disediakan oleh Laravel.

---

## 💻 Tech Stack

Aplikasi ini dibangun menggunakan teknologi modern dan andal:

*   **Backend:** PHP 8.2, Laravel 12
*   **Frontend:** Tailwind CSS, Alpine.js
*   **Database:** MySQL / MariaDB
*   **Build Tool:** Vite
*   **Deployment:** (Belum ditentukan, siap untuk platform apa pun)

---

## 🚀 Getting Started

Untuk menjalankan proyek ini secara lokal, Anda bisa mengikuti opsi instalasi cepat atau manual.

### Prerequisites

Sebelum memulai, pastikan sistem Anda telah terinstal:
*   **PHP >= 8.2**
*   **Composer**
*   **Node.js & NPM**
*   **MySQL** (atau database sejenis seperti MariaDB)
*   **Git**

---

### ⚡ Automatic Setup (Recommended)

Cara ini paling cepat dan akan menjalankan sebagian besar perintah instalasi secara otomatis.

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/lapas-jombang.git
    cd lapas-jombang
    ```

2.  **Run the setup script:**
    Perintah ini akan menginstal dependensi, membuat file `.env`, generate key, menjalankan migrasi, dan build aset frontend.
    ```bash
    composer setup
    ```

3.  **Configure your database:**
    Meskipun setup otomatis, Anda tetap harus mengatur koneksi database secara manual. Buka file `.env` yang baru dibuat dan isi detail koneksi database Anda.
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=lapas_jombang
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    > **Penting:** Pastikan database `lapas_jombang` sudah dibuat di MySQL Anda.

4.  **Run database seeder (Optional but Recommended):**
    Untuk mengisi data awal seperti akun admin, jalankan seeder.
    ```bash
    php artisan db:seed
    ```
    > Akun admin default: `admin@example.com` | password: `password`


---

### 🛠️ Manual Installation (Step-by-step)

Ikuti langkah-langkah berikut jika Anda ingin mengontrol setiap proses instalasi.

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/lapas-jombang.git
    cd lapas-jombang
    ```

2.  **Install PHP dependencies:**
    Mengunduh semua library backend yang dibutuhkan.
    ```bash
    composer install
    ```

3.  **Install JavaScript dependencies:**
    Mengunduh semua library frontend yang dibutuhkan.
    ```bash
    npm install
    ```

4.  **Create your environment file:**
    Menyalin file konfigurasi contoh untuk proyek Anda.
    ```bash
    cp .env.example .env
    ```

5.  **Generate application key:**
    Membuat kunci enkripsi unik untuk mengamankan aplikasi.
    ```bash
    php artisan key:generate
    ```

6.  **Configure your database:**
    Buka file `.env` dan atur koneksi database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=lapas_jombang
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7.  **Run database migrations and seeders:**
    Perintah ini akan membuat semua tabel (`migrate`) dan mengisi data awal (`seed`), termasuk akun admin.
    ```bash
    php artisan migrate --seed
    ```
    > Akun admin default: `admin@example.com` | password: `password`

8.  **Build frontend assets:**
    Mengkompilasi file CSS dan JavaScript untuk produksi.
    ```bash
    npm run build
    ```

---

### ✅ Running The Application

Setelah instalasi selesai, jalankan server development:

1.  **Start the Laravel server:**
    ```bash
    php artisan serve
    ```

2.  **(Optional) Start the Vite server for frontend development:**
    Jika Anda ingin mengubah file CSS/JS, jalankan ini di terminal terpisah.
    ```bash
    npm run dev
    ```

3.  **Access the application:**
    Buka browser Anda dan kunjungi **`http://127.0.0.1:8000`**.

---

## 📸 Application Interface

| Halaman Depan | Formulir Kunjungan |
| :---: | :---: |
| <img src="https://via.placeholder.com/400x200?text=Landing+Page" alt="Landing Page"> | <img src="https://via.placeholder.com/400x200?text=Form+Kunjungan" alt="Form Kunjungan"> |

| Dashboard Admin | Fitur Aksesibilitas |
| :---: | :---: |
| <img src="https://via.placeholder.com/400x200?text=Dashboard+Admin" alt="Dashboard Admin"> | <img src="https://via.placeholder.com/400x200?text=Widget+Aksesibilitas" alt="Aksesibilitas"> |

---

## ⚡ Performance Optimization Tips

Untuk menjaga aplikasi tetap cepat di lingkungan produksi:

1.  **Optimasi Aset:** Selalu kompres gambar sebelum diunggah menggunakan tool seperti [TinyPNG](https://tinypng.com/) atau [Squoosh](https://squoosh.app/).

2.  **Laravel Cache:** Jalankan perintah berikut setelah setiap deployment untuk mempercepat aplikasi.
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```
    Untuk membersihkan cache saat development:
    ```bash
    php artisan optimize:clear
    ```
---

## 🤝 Contributing

Kontribusi membuat komunitas open source menjadi tempat yang luar biasa untuk belajar, menginspirasi, dan berkreasi. Setiap kontribusi yang Anda buat sangat **dihargai**.

Jika Anda memiliki saran untuk perbaikan, silakan fork repo dan buat *pull request*. Anda juga bisa membuka *issue* dengan tag "enhancement".

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

---

## 📄 License

Didistribusikan di bawah Lisensi MIT. Lihat `LICENSE` untuk informasi lebih lanjut.

---

<div align="center">
  <p>Dibuat dengan ❤️ untuk pelayanan publik yang lebih baik.</p>
</div>