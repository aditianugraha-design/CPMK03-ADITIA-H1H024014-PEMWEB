CREATE DATABASE IF NOT EXISTS ps_rental CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ps_rental;

-- Tabel users (autentikasi)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel unit_ps
CREATE TABLE unit_ps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_unit VARCHAR(20) NOT NULL UNIQUE,
    tipe VARCHAR(50) NOT NULL,
    tarif_per_jam DECIMAL(10,2) NOT NULL,
    status ENUM('tersedia','dipakai') DEFAULT 'tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel pelanggan
CREATE TABLE pelanggan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel penyewaan
CREATE TABLE penyewaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_unit INT NOT NULL,
    id_pelanggan INT NOT NULL,
    jam_mulai DATETIME NOT NULL,
    durasi_jam INT NOT NULL,
    total_bayar DECIMAL(10,2) NOT NULL,
    status ENUM('aktif','selesai') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_unit) REFERENCES unit_ps(id) ON DELETE RESTRICT,
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id) ON DELETE RESTRICT
);

-- Data awal: admin
INSERT INTO users (username, password, nama_lengkap) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator');
-- Password default: password

-- Data contoh unit PS
INSERT INTO unit_ps (nomor_unit, tipe, tarif_per_jam, status) VALUES
('PS-01', 'PlayStation 4', 10000.00, 'tersedia'),
('PS-02', 'PlayStation 4', 10000.00, 'tersedia'),
('PS-03', 'PlayStation 5', 15000.00, 'tersedia'),
('PS-04', 'PlayStation 5', 15000.00, 'dipakai'),
('PS-05', 'PlayStation 3', 7000.00, 'tersedia');

-- Data contoh pelanggan
INSERT INTO pelanggan (nama, no_hp) VALUES
('Budi Santoso', '081234567890'),
('Andi Wijaya', '082345678901'),
('Citra Dewi', '083456789012');
