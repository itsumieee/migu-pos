# 🏪 Migu POS - Point of Sale System

Migu POS adalah sistem Point of Sale (POS) modern yang dibangun dengan Laravel, dirancang untuk memudahkan manajemen penjualan, inventori, dan pelaporan.

## 📋 Fitur Utama

### 1. **Manajemen Kategori & Produk**
- ✅ CRUD Kategori Produk
- ✅ CRUD Produk dengan SKU dan Tracking Stok
- ✅ Manajemen Harga Jual dan Harga Pokok

### 2. **Transaksi & Penjualan**
- ✅ Catat transaksi penjualan real-time
- ✅ Riwayat transaksi lengkap
- ✅ Dukungan multiple payment methods
- ✅ QR Code QRIS integration

### 3. **Laporan & Analytics**
- ✅ Laporan Penjualan (daily/monthly)
- ✅ Laporan Profit & Margin
- ✅ Laporan Inventori
- ✅ Summary Dashboard

### 4. **Manajemen User**
- ✅ Multi-user dengan role (Admin, Kasir)
- ✅ Manajemen profile dan password
- ✅ Audit trail transaksi per user

### 5. **Pengaturan Sistem**
- ✅ Konfigurasi toko (nama, alamat, kontak)
- ✅ Manajemen QRIS
- ✅ Jadwal otomatis laporan

---

## 🚀 API Endpoints

### **Base URL**: `http://localhost:8000/api`

#### **1. Kategori** (`/api/categories`)
```
GET    /api/categories           - Lihat semua kategori
GET    /api/categories/{id}      - Lihat detail kategori
POST   /api/categories           - Buat kategori baru
PUT    /api/categories/{id}      - Update kategori
DELETE /api/categories/{id}      - Hapus kategori
```

**Contoh POST:**
```json
{
  "name": "Minuman"
}
```

---

#### **2. Produk** (`/api/products`)
```
GET    /api/products             - Lihat semua produk
GET    /api/products/{id}        - Lihat detail produk
POST   /api/products             - Buat produk baru
PUT    /api/products/{id}        - Update produk
DELETE /api/products/{id}        - Hapus produk
```

**Contoh POST:**
```json
{
  "name": "Kopi Arabika",
  "sku": "KOPI001",
  "price": 25000,
  "cost_price": 15000,
  "stock": 100,
  "category_id": 1
}
```

---

#### **3. User** (`/api/users`) - Manajemen User
```
GET    /api/users                - Lihat semua user
GET    /api/users/{id}           - Lihat detail user
POST   /api/users                - Buat user baru
PUT    /api/users/{id}           - Update user
DELETE /api/users/{id}           - Hapus user
```

**Contoh POST:**
```json
{
  "name": "Kasir 1",
  "email": "kasir1@pos.com",
  "password": "password123",
  "role": "kasir",
  "phone": "081234567890"
}
```

---

#### **4. Pengaturan** (`/api/settings`)
```
GET    /api/settings             - Lihat semua pengaturan
GET    /api/settings/{key}       - Lihat setting spesifik
POST   /api/settings             - Buat setting baru
PUT    /api/settings/{key}       - Update setting
DELETE /api/settings/{key}       - Hapus setting
```

**Contoh POST:**
```json
{
  "key": "store_name",
  "value": "Toko Migu"
}
```

---

#### **5. Jadwal Laporan** (`/api/schedules`)
```
GET    /api/schedules            - Lihat semua jadwal
GET    /api/schedules/{id}       - Lihat detail jadwal
POST   /api/schedules            - Buat jadwal baru
PUT    /api/schedules/{id}       - Update jadwal
DELETE /api/schedules/{id}       - Hapus jadwal
```

**Contoh POST:**
```json
{
  "name": "Laporan Harian",
  "type": "fixed",
  "value_fixed": "09:00",
  "phone_override": "081234567890",
  "is_active": true
}
```

---

#### **6. Laporan Profit** (`/api/profits`)
```
GET    /api/profits?period=month - Lihat profit (period: today/week/month/year)
GET    /api/profits/{id}         - Lihat profit per transaksi
```

**Response:**
```json
{
  "success": true,
  "period": "month",
  "data": {
    "total_revenue": 5000000,
    "total_cost": 3000000,
    "total_profit": 2000000,
    "profit_margin": 40.0,
    "transaction_count": 150
  }
}
```

---

#### **7. Laporan** (`/api/reports`)
```
GET    /api/reports/sales?type=monthly   - Laporan penjualan
GET    /api/reports/inventory            - Laporan inventori
GET    /api/reports/summary              - Ringkasan laporan
```

**Contoh:**
```
GET /api/reports/summary

Response:
{
  "success": true,
  "data": {
    "total_transactions": 500,
    "total_revenue": 50000000,
    "total_products": 150,
    "low_stock_products": 12
  }
}
```

---

#### **8. Riwayat Transaksi** (`/api/transactions`)
```
GET    /api/transactions         - Lihat semua transaksi
GET    /api/transactions/{id}    - Lihat detail transaksi
POST   /api/transactions         - Buat transaksi baru
PUT    /api/transactions/{id}    - Update transaksi
DELETE /api/transactions/{id}    - Hapus transaksi
```

**Contoh POST:**
```json
{
  "user_id": 1,
  "total_amount": 150000,
  "payment_method": "cash",
  "items": [
    {
      "product_id": 1,
      "quantity": 2,
      "price": 25000
    },
    {
      "product_id": 2,
      "quantity": 1,
      "price": 100000
    }
  ]
}
```

---

## 🛠️ Instalasi & Setup

### Requirements
- PHP 8.1+
- Laravel 11
- MySQL/MariaDB
- Composer

### Langkah Instalasi
```bash
# 1. Clone repository
git clone <repository-url>
cd migu-pos

# 2. Install dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Setup database di .env
# DB_DATABASE=migu_pos
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Migrate database
php artisan migrate

# 7. Seed data (optional)
php artisan db:seed

# 8. Jalankan server
php artisan serve
```

---

## 📊 Database Structure

Proyek ini menggunakan tabel-tabel berikut:
- `users` - Data user/kasir dengan role
- `categories` - Kategori produk
- `products` - Data produk dengan harga & stok
- `transactions` - Riwayat penjualan
- `transaction_items` - Item detail per transaksi
- `settings` - Konfigurasi sistem toko
- `report_schedules` - Jadwal laporan otomatis

---

## 🧪 Testing dengan Postman

1. **Import Collection** - Setup di Postman
2. **Set Environment** - Base URL: `http://localhost:8000`
3. **Test Endpoints** - Ikuti format di atas
4. **Headers** - Content-Type: `application/json`

### Quick Test
```bash
# Test API status
curl http://localhost:8000/api/test

# Response:
# {"message":"API jalan 🚀"}
```

---

## 📁 Project Structure

```
migu-pos/
├── app/
│   ├── Http/Controllers/
│   │   ├── CategoryApiController.php
│   │   ├── ProductApiController.php
│   │   ├── UserApiController.php
│   │   ├── SettingsApiController.php
│   │   ├── ReportScheduleApiController.php
│   │   ├── ProfitApiController.php
│   │   ├── ReportApiController.php
│   │   └── TransactionApiController.php
│   ├── Models/
│   └── Services/
├── routes/
│   └── api.php          # Semua endpoint API
├── config/
├── database/
└── public/
```

---

## 💡 Tips Penggunaan

### Validasi Error
Semua endpoint mengembalikan format JSON konsisten:

**Success Response:**
```json
{
  "success": true,
  "data": { ... }
}
```

**Error Response:**
```json
{
  "success": false,
  "message": "Error description"
}
```

### Authentication (Opsional)
Untuk menambahkan autentikasi, extend controller dengan:
```php
middleware(['auth:sanctum'])
```

---

## 🔒 Security

- Validasi input di semua endpoint
- Hash password user
- CORS enabled (sesuaikan di config)
- Pagination untuk data besar

---

## 📄 License

MIT License - Bebas digunakan untuk keperluan komersial maupun personal.

---

## 👨‍💻 Support

Untuk pertanyaan atau issue, silakan buat di repository atau hubungi tim development.

**Last Updated:** April 29, 2026
