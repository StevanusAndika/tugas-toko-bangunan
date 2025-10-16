# 🏗️ API Laravel Toko Bangunan (Laravel 12)

## 📋 Deskripsi
RESTful API untuk Sistem Manajemen Toko Bangunan yang dibangun dengan **Laravel 12**. Menyediakan endpoint lengkap untuk mengelola data karyawan, produk, penjualan, dan detail transaksi dengan fitur-fitur terbaru Laravel 12.

> **Catatan Penting**: Semua operasi spesifik berdasarkan ID resource

## 🚀 Base URL
```
http://localhost:8000/api
```

## 🆕 Fitur Laravel 12
API ini memanfaatkan fitur-fitur terbaru Laravel 12:
- **Laravel Reverb** untuk real-time communication
- **Native Type Hinting** yang lebih baik
- **Improved Testing Experience**
- **Latest Eloquent Features**

## 📊 Endpoints

### 👥 Manajemen Karyawan

#### 1. List Data Semua Karyawan
- **Method**: `GET`
- **Endpoint**: `/karyawan/list-data`
- **Deskripsi**: Mendapatkan daftar lengkap semua karyawan yang terdaftar dalam sistem
- **Fungsi**: Menampilkan informasi seluruh staff toko
- **Response**: Collection data karyawan

#### 2. Tambah Data Karyawan Baru
- **Method**: `POST`
- **Endpoint**: `/karyawan/simpan`
- **Deskripsi**: Menambahkan karyawan baru ke dalam sistem
- **Fungsi**: Pendaftaran staff baru dengan data lengkap
- **Body Request**:
```json
{
    "Nama": "Stevanus Andika Galih Setiawan",
    "Gender": "L",
    "Sandi": "password123"
}
```

#### 3. Hapus Data Karyawan
- **Method**: `DELETE`
- **Endpoint**: `/karyawan/hapus/{id}`
- **Deskripsi**: Menghapus data karyawan berdasarkan ID
- **Fungsi**: Menghapus akun staff dari sistem secara permanen
- **Contoh**: `/karyawan/hapus/1`

---

### 📦 Manajemen Produk

#### 1. Lihat Data Produk
- **Method**: `GET`
- **Endpoint**: `/produk/list-data`
- **Deskripsi**: Mengambil semua data produk yang tersedia di toko
- **Fungsi**: Menampilkan katalog produk bangunan lengkap dengan stok dan harga

#### 2. Tambah Data Produk
- **Method**: `POST`
- **Endpoint**: `/produk/simpan`
- **Deskripsi**: Menambahkan produk baru ke dalam inventori toko
- **Fungsi**: Input produk baru ke sistem dengan detail lengkap
- **Body Request**:
```json
{
    "Produk": "kuas",
    "Harga": 5000,
    "Stok": 20
}
```

#### 3. Hapus Data Produk
- **Method**: `DELETE`
- **Endpoint**: `/produk/hapus/{id}`
- **Deskripsi**: Menghapus produk dari inventori berdasarkan ID
- **Fungsi**: Menghapus produk yang sudah tidak tersedia atau tidak lagi dijual
- **Contoh**: `/produk/hapus/2`

---

### 💰 Manajemen Penjualan

#### 1. List Data Penjualan
- **Method**: `GET`
- **Endpoint**: `/penjualan/list-data`
- **Deskripsi**: Mendapatkan riwayat semua transaksi penjualan
- **Fungsi**: Melacak seluruh transaksi yang pernah dilakukan di toko

#### 2. Simpan Data Penjualan
- **Method**: `POST`
- **Endpoint**: `/penjualan/simpan`
- **Deskripsi**: Membuat transaksi penjualan baru
- **Fungsi**: Inisialisasi transaksi penjualan dengan data waktu dan petugas
- **Body Request**:
```json
{
    "tgl": "2024-01-15 10:00:00",
    "pengguna_id": 2
}
```

#### 3. Lihat List Detail Penjualan
- **Method**: `GET`
- **Endpoint**: `/penjualan/list-detail/{id}`
- **Deskripsi**: Melihat detail item dari suatu transaksi penjualan
- **Fungsi**: Melacak produk-produk yang dibeli dalam satu transaksi tertentu
- **Contoh**: `/penjualan/list-detail/1`

#### 4. Simpan Detail Penjualan
- **Method**: `POST`
- **Endpoint**: `/penjualan/simpan-detail`
- **Deskripsi**: Menambahkan item produk ke dalam transaksi penjualan
- **Fungsi**: Input produk yang dibeli beserta quantity dan harga ke dalam transaksi
- **Body Request**:
```json
{
    "penjualan_id": 1,
    "produk_id": 1,
    "qty": 2,
    "harga": 100000
}
```

#### 5. Spesifik Detail Penjualan
- **Method**: `GET`
- **Endpoint**: `/penjualan/list-detail/{id}`
- **Deskripsi**: Melihat detail spesifik transaksi penjualan
- **Fungsi**: Menampilkan informasi lengkap tentang satu transaksi tertentu
- **Contoh**: `/penjualan/list-detail/1`

#### 6. Hapus Detail Penjualan
- **Method**: `DELETE`
- **Endpoint**: `/penjualan/hapus/{id}`
- **Deskripsi**: Menghapus transaksi penjualan berdasarkan ID
- **Fungsi**: Membatalkan transaksi penjualan secara keseluruhan
- **Contoh**: `/penjualan/hapus/1`

---

## 🛠️ Instalasi & Konfigurasi

### 1. Requirements
```bash
PHP >= 8.2
Composer
MySQL >= 8.0
Laravel 12
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### 5. Serve Application
```bash
php artisan serve
```

## 🧪 Testing dengan Laravel 12
```bash
# Menjalankan test suite terbaru Laravel 12
php artisan test

# Test dengan coverage
php artisan test --coverage
```

## 📡 Real-time Features (Laravel Reverb)
API ini siap diintegrasikan dengan Laravel Reverb untuk fitur real-time:
```bash
# Install Reverb
php artisan install:broadcasting

# Start Reverb server
php artisan reverb:start
```

## 🔐 Authentication (Opsional)
Untuk menambahkan authentication menggunakan fitur Laravel 12:
```bash
php artisan install:api
```

## 📝 Model Structure (Laravel 12)

### Karyawan Model
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nama',
        'Gender', 
        'Sandi'
    ];
}
```

## 🚀 Deployment

### Production Setup
```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force
```

## 📞 Support & Documentation

- **Laravel 12 Documentation**: https://laravel.com/docs/12.x
- **API Documentation**: Import file Postman collection yang disediakan
- **Testing**: Gunakan PHPUnit terintegrasi dengan Laravel 12
-**Email**   : stevcomp58@gmail.com
---

**🔄 Dibangun dengan Laravel 12 - Memanfaatkan fitur-fitur terbaru framework PHP modern**
