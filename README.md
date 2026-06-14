# 🎮 Sistem Informasi Penyewaan PlayStation (PS Rental)

Aplikasi web sederhana untuk pencatatan penyewaan unit PlayStation pada sebuah rental game, dibangun menggunakan framework **CodeIgniter 3**.

---

## 📋 Deskripsi

Aplikasi ini merupakan tugas mata kuliah Pemrograman Web dengan studi kasus **Paket 5 — Sistem Informasi Penyewaan PlayStation (Rental)**. Aplikasi mencakup pencatatan unit PS, data pelanggan, transaksi penyewaan, serta perhitungan otomatis total biaya sewa.

---

## 🎯 Fitur Utama

- **Autentikasi** — Login/logout dengan session
- **CRUD Unit PS** — Kelola data unit PlayStation (PS3/PS4/PS5)
- **CRUD Pelanggan** — Kelola data pelanggan
- **CRUD Penyewaan** — Catat transaksi penyewaan dengan JOIN antar tabel
- **Perhitungan Otomatis** — Total bayar = durasi (jam) × tarif per jam
- **Manajemen Status** — Status unit otomatis berubah saat sewa dimulai/selesai
- **Dashboard** — Ringkasan statistik dan daftar sewa aktif
- **UI Responsif** — Tampilan Bootstrap 5 yang rapi

---

## 🗃️ Struktur Database

### Tabel `unit_ps`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | INT PK | Auto increment |
| nomor_unit | VARCHAR(20) | Nomor unit unik |
| tipe | VARCHAR(50) | Tipe PS (PS3/PS4/PS5) |
| tarif_per_jam | DECIMAL(10,2) | Tarif sewa per jam |
| status | ENUM | tersedia / dipakai |

### Tabel `pelanggan`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | INT PK | Auto increment |
| nama | VARCHAR(100) | Nama lengkap |
| no_hp | VARCHAR(20) | Nomor HP |

### Tabel `penyewaan`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | INT PK | Auto increment |
| id_unit | INT FK | Relasi ke unit_ps |
| id_pelanggan | INT FK | Relasi ke pelanggan |
| jam_mulai | DATETIME | Waktu mulai sewa |
| durasi_jam | INT | Lama sewa dalam jam |
| total_bayar | DECIMAL(10,2) | Otomatis = durasi × tarif |
| status | ENUM | aktif / selesai |

---

## 🏗️ Struktur Proyek (MVC)

```
application/
├── controllers/
│   ├── Auth.php          # Login, logout
│   ├── Dashboard.php     # Halaman utama & statistik
│   ├── Unit_ps.php       # CRUD unit PlayStation
│   ├── Pelanggan.php     # CRUD pelanggan
│   └── Penyewaan.php     # CRUD penyewaan
├── models/
│   ├── User_model.php
│   ├── Unit_ps_model.php
│   ├── Pelanggan_model.php
│   └── Penyewaan_model.php
├── views/
│   ├── layouts/          # Header & footer template
│   ├── auth/             # Login view
│   ├── dashboard/
│   ├── unit_ps/
│   ├── pelanggan/
│   └── penyewaan/
└── config/
    ├── database.php
    ├── routes.php
    └── autoload.php
```

---

## 🚀 Cara Instalasi

### 1. Persyaratan
- PHP >= 7.4
- MySQL / MariaDB
- XAMPP / Laragon / WAMP

### 2. Clone & Setup

```bash
git clone [URL_REPOSITORY] ps_rental
```

### 3. Import Database

1. Buka **phpMyAdmin**
2. Buat database baru: `ps_rental`
3. Import file: `sql/ps_rental.sql`

### 4. Konfigurasi

Edit file `application/config/database.php`:
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '122345678',      
'database' => 'ps_rental',
```

Edit `application/config/config.php` — sesuaikan `base_url`:
```php
$config['base_url'] = 'http://localhost/ps_rental/';
```

### 5. Jalankan

Akses di browser: `http://localhost/ps_rental/`

**Login default:**
- Username: `admin`
- Password: `password`

---

## 🛠️ Teknologi

| Komponen | Versi |
|---------|-------|
| PHP | ≥ 7.4 |
| CodeIgniter | 3.x |
| MySQL | 5.7+ |
| Bootstrap | 5.3 |
| Bootstrap Icons | 1.11 |

---

---

## 👤 Informasi

- **Nama:** Aditia Wahyu Nugraha 
- **NIM:** H1H024014  
- **Mata Kuliah:** Pemrograman Web
- **Paket Studi Kasus:** Paket 5 — Sistem Informasi Penyewaan PlayStation
