# 🚚 SwiftLogix — Website Logistik Dinamis

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
</div>

<br>

> **Delivering Trust, Every Mile** — Website dinamis perusahaan logistik SwiftLogix dibangun dengan Laravel, Blade, dan MySQL.

---

## 📋 Daftar Isi

- [Fitur](#-fitur)
- [Teknologi](#-teknologi)
- [Persyaratan](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Konfigurasi Database](#-konfigurasi-database)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Akun Admin](#-akun-admin-default)
- [Testing](#-testing)
- [Struktur Proyek](#-struktur-proyek)
- [Dokumentasi Tambahan](#-dokumentasi-tambahan)
- [Kontribusi](#-kontribusi)

---

## ✨ Fitur

### 🌐 Frontend Publik
| Halaman | URL | Deskripsi |
|---------|-----|-----------|
| Beranda | `/` | Hero, statistik, layanan, testimoni, blog |
| Tentang Kami | `/tentang-kami` | Profil, visi-misi, tim |
| Layanan | `/layanan` | Daftar & detail layanan |
| Lacak Paket | `/lacak` | Tracking pengiriman real-time |
| Blog | `/blog` | Artikel & berita perusahaan |
| Kontak | `/kontak` | Form kontak + informasi kantor |

### 🔐 Panel Admin (`/admin`)
| Modul | Fitur |
|-------|-------|
| Dashboard | Statistik ringkasan, pengiriman & pesan terbaru |
| Pengiriman | CRUD + manajemen riwayat status tracking |
| Layanan | CRUD layanan dengan upload gambar |
| Blog | CRUD artikel dengan editor teks |
| Testimoni | CRUD + moderasi ulasan pelanggan |
| Pesan Masuk | Inbox pesan kontak, tandai sudah dibaca |
| Tim | CRUD profil anggota tim |
| Pengaturan | Kelola info perusahaan, kontak, media sosial |

---

## 🛠 Teknologi

| Komponen | Teknologi |
|----------|-----------|
| Framework | Laravel 13 |
| Templating | Blade |
| Database | MySQL 8 |
| Auth | Laravel Breeze |
| CSS Framework | Bootstrap 5.3 |
| Icons | Font Awesome 6 |
| Animasi | AOS (Animate on Scroll) |
| Fonts | Inter + Poppins (Google Fonts) |

---

## 📦 Persyaratan Sistem

- PHP >= 8.2
- Composer >= 2.0
- MySQL >= 8.0
- Node.js >= 18 (opsional, untuk build assets)
- Git

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/farelzy/website_logistik.git
cd website_logistik
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Salin file konfigurasi

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

## 🗄 Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=swiftlogix
DB_USERNAME=root
DB_PASSWORD=your_password
```

Buat database MySQL:

```sql
CREATE DATABASE swiftlogix CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Jalankan migrasi dan seeder:

```bash
php artisan migrate --seed
```

Buat symlink untuk storage publik:

```bash
php artisan storage:link
```

---

## ▶ Menjalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

Panel admin di: **http://localhost:8000/admin/dashboard**

---

## 👤 Akun Admin Default

| Field | Value |
|-------|-------|
| Email | `admin@swiftlogix.id` |
| Password | `admin123` |

> ⚠️ **Segera ganti password** setelah login pertama kali di Pengaturan Akun.

---

## 🧪 Testing

Jalankan semua unit & feature tests:

```bash
php artisan test
```

Jalankan test spesifik:

```bash
# Unit tests (Model tests)
php artisan test tests/Unit/ModelTest.php

# Feature tests (Frontend routes)
php artisan test tests/Feature/FrontendRouteTest.php

# Feature tests (Admin panel)
php artisan test tests/Feature/AdminTest.php
```

Lihat coverage:

```bash
php artisan test --coverage
```

### Test yang Tersedia

| Test Class | Jumlah Test | Keterangan |
|-----------|-------------|------------|
| `ModelTest` | 10 | Model logic, scopes, accessors |
| `FrontendRouteTest` | 12 | HTTP routes, form validation |
| `AdminTest` | 8 | Auth, CRUD admin operations |

---

## 📁 Struktur Proyek

```
swiftlogix/
├── app/
│   ├── Http/Controllers/
│   │   ├── Frontend/           # Controller halaman publik
│   │   │   ├── HomeController.php
│   │   │   ├── ServiceController.php
│   │   │   ├── TrackingController.php
│   │   │   ├── BlogController.php
│   │   │   └── ContactController.php
│   │   └── Admin/              # Controller panel admin
│   │       ├── DashboardController.php
│   │       ├── ServiceController.php
│   │       ├── ShipmentController.php
│   │       ├── BlogController.php
│   │       ├── TestimonialController.php
│   │       ├── ContactController.php
│   │       ├── TeamController.php
│   │       └── SettingController.php
│   └── Models/
│       ├── Service.php
│       ├── Shipment.php
│       ├── ShipmentHistory.php
│       ├── BlogPost.php
│       ├── Testimonial.php
│       ├── Contact.php
│       ├── TeamMember.php
│       └── Setting.php
├── database/
│   ├── migrations/             # 8 tabel custom + default Laravel
│   └── seeders/
│       └── DatabaseSeeder.php  # Data dummy realistis
├── public/
│   └── css/
│       ├── app.css             # CSS frontend
│       └── admin.css           # CSS admin panel
├── resources/views/
│   ├── layouts/
│   │   ├── frontend.blade.php
│   │   └── admin.blade.php
│   ├── frontend/               # Views publik
│   └── admin/                  # Views admin
├── routes/
│   └── web.php                 # Semua routes
├── tests/
│   ├── Unit/ModelTest.php
│   └── Feature/
│       ├── FrontendRouteTest.php
│       └── AdminTest.php
└── docs/                       # Dokumentasi tambahan
    ├── DATABASE.md
    ├── API.md
    └── DEPLOYMENT.md
```

---

## 📚 Dokumentasi Tambahan

- [📊 Skema Database](docs/DATABASE.md)
- [🔌 API Reference](docs/API.md)
- [🚀 Panduan Deployment](docs/DEPLOYMENT.md)
- [🤝 Panduan Kontribusi](CONTRIBUTING.md)
- [📝 Changelog](CHANGELOG.md)

---

## 🤝 Kontribusi

Silakan baca [CONTRIBUTING.md](CONTRIBUTING.md) untuk panduan kontribusi.

---

## 📄 Lisensi

Proyek ini menggunakan lisensi **MIT**. Lihat file [LICENSE](LICENSE) untuk detail.

---

<div align="center">
  <p>Dibuat dengan ❤️ menggunakan Laravel & Blade</p>
  <p><strong>SwiftLogix</strong> — Delivering Trust, Every Mile</p>
</div>
