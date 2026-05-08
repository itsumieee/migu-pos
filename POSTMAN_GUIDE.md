# 📝 Postman Collection - Product API Guide

## ⚙️ Setup Awal di Postman

### Step 1: Buat Environment Variable

1. **Klik gear icon** (⚙️) di kanan atas → **Environments**
2. **Klik "Create New Environment"** → Beri nama `Migu POS`
3. **Tambahkan 2 variable:**

```
base_url = http://localhost:8000
api_url = http://localhost:8000/api
```

4. **Set environment ke Migu POS** (pilih di dropdown kanan atas)

---

## 🔍 1. SEARCH & PAGINATION - GET /products

### Endpoint
```
GET {{api_url}}/products
```

### Query Parameters - WAJIB DIMENGERTI

| Parameter | Type | Required | Default | Range | Contoh |
|-----------|------|----------|---------|-------|--------|
| `q` | string | ❌ No | - | max 255 | kaos, kopi, KAOS-001 |
| `page` | integer | ❌ No | 1 | min 1 | 1, 2, 3 |
| `per_page` | integer | ❌ No | 12 | 1-100 | 10, 20, 50 |

### Validasi di API
```php
'q' => 'nullable|string|max:255',
'page' => 'nullable|integer|min:1',
'per_page' => 'nullable|integer|min:1|max:100',
```

### Contoh Request di Postman

#### 📌 Contoh 1: Lihat semua produk (halaman 1)
```
GET {{api_url}}/products
```

#### 📌 Contoh 2: Search produk berdasarkan nama
```
GET {{api_url}}/products?q=kaos
```
Akan mencari di `name` atau `sku` yang mengandung "kaos"

#### 📌 Contoh 3: Search dengan pagination
```
GET {{api_url}}/products?q=kaos&page=1&per_page=10
```

#### 📌 Contoh 4: Hanya pagination (tanpa search)
```
GET {{api_url}}/products?page=2&per_page=20
```

#### 📌 Contoh 5: Cari SKU spesifik
```
GET {{api_url}}/products?q=KAOS-001
```

#### 📌 Contoh 6: Banyak data per halaman
```
GET {{api_url}}/products?per_page=100
```
Max 100 data per halaman (untuk mobile app)

### Response Format (200 OK)
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Kaos Polos Putih Premium",
      "sku": "KAOS-001",
      "price": "85000.00",
      "cost_price": "50000.00",
      "stock": 284,
      "image": "products/kaos_putih.jpg",
      "category_id": 1,
      "category": {
        "id": 1,
        "name": "Kaos"
      },
      "created_at": "2026-04-29T10:00:00.000000Z",
      "updated_at": "2026-04-29T10:00:00.000000Z"
    }
  ],
  "pagination": {
    "current_page": 1,
    "per_page": 10,
    "total": 45,
    "last_page": 5,
    "from": 1,
    "to": 10
  }
}
```

### Cara Baca Pagination Response

```
total = 45        → Total ada 45 produk
per_page = 10     → Setiap halaman tampil 10 produk
last_page = 5     → Total ada 5 halaman
current_page = 1  → Sedang di halaman 1
from = 1, to = 10 → Produk yang ditampil dari no 1-10
```

### Testing di Postman

**Klik Params tab**, isi separuh di bawah:

| KEY | VALUE |
|-----|-------|
| q | kaos |
| page | 1 |
| per_page | 10 |

Postman otomatis akan buat URL: `{{api_url}}/products?q=kaos&page=1&per_page=10`

---

## 🖼️ 2. UPLOAD GAMBAR - POST /products (CREATE)

### Endpoint
```
POST {{api_url}}/products
```

### Headers
```
Content-Type: multipart/form-data
(Otomatis di Postman kalau pilih Body > form-data)
```

### Form-Data Fields - WAJIB DIMENGERTI

| Field | Type | Required | Max Size | Format | Example |
|-------|------|----------|----------|--------|---------|
| **name** | text | ✅ YES | 255 char | - | Kaos Polos Putih |
| **sku** | text | ✅ YES | 255 char | Unik | KAOS-001 |
| **price** | text | ✅ YES | - | Numeric | 85000 |
| **cost_price** | text | ✅ YES | - | Numeric | 50000 |
| **stock** | text | ✅ YES | - | Integer | 100 |
| **category_id** | text | ✅ YES | - | Integer ID | 1 |
| **image** | file | ❌ NO | 2 MB | JPEG/PNG/GIF | photo.jpg |

### Validasi Gambar
```php
'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
```

**Format Gambar yang VALID:**
- ✅ `.jpg` / `.jpeg` - JPEG Image
- ✅ `.png` - PNG Image  
- ✅ `.gif` - GIF Image

**Ukuran Gambar:**
- ✅ Max 2 MB (2048 KB)
- ❌ Lebih dari 2 MB akan error

### Cara Upload di Postman

1. **Klik tab Body** → Pilih **form-data**
2. **Isi field dengan nama:**
   - name = "Kaos Polos Putih"
   - sku = "KAOS-001"
   - price = "85000"
   - cost_price = "50000"
   - stock = "100"
   - category_id = "1"
3. **Untuk image field:**
   - Klik dropdown di samping "image", pilih **File**
   - Klik **Select File** dan pilih gambar dari komputer
4. **Klik Send**

### Response (201 - Created) ✅
```json
{
  "success": true,
  "message": "Produk berhasil dibuat",
  "data": {
    "id": 5,
    "name": "Kaos Polos Putih",
    "sku": "KAOS-001",
    "price": "85000.00",
    "cost_price": "50000.00",
    "stock": 100,
    "image": "products/XXXXXXXXXXXXXX.jpg",
    "category_id": 1,
    "category": {
      "id": 1,
      "name": "Kaos"
    },
    "created_at": "2026-05-06T10:00:00.000000Z",
    "updated_at": "2026-05-06T10:00:00.000000Z"
  }
}
```

### Error Response - Validasi Gagal (422)

**Error: Gambar format tidak valid**
```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "image": ["The image must be a file of type: jpeg, png, jpg, gif."]
  }
}
```

**Error: Gambar terlalu besar**
```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "image": ["The image must not be greater than 2048 kilobytes."]
  }
}
```

**Error: SKU sudah ada (duplikat)**
```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "sku": ["The sku has already been taken."]
  }
}
```

**Error: Category tidak ada**
```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "category_id": ["The category_id field must exist in categories table."]
  }
}
```

---

## 🖼️ 3. UPDATE GAMBAR - PUT /products/{id}

### Endpoint
```
PUT {{api_url}}/products/1
```

### Headers
```
Content-Type: multipart/form-data
```

### Form-Data Fields - SEMUA OPTIONAL

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| name | text | ❌ NO | Update nama (jika kosong, tidak diubah) |
| sku | text | ❌ NO | Update SKU |
| price | text | ❌ NO | **Update harga - INI YANG SERING DIPAKE** |
| cost_price | text | ❌ NO | Update harga modal |
| stock | text | ❌ NO | Update stok |
| category_id | text | ❌ NO | Update kategori |
| image | file | ❌ NO | **Upload gambar baru - INI YANG SERING DIPAKE** |

### Cara Update Harga & Gambar di Postman

1. **URL:** `PUT {{api_url}}/products/1`
2. **Body → form-data:**
   - price = "80000" (harga baru)
   - image = [select file gambar baru]
3. **Klik Send**

### Response (200 OK) ✅
```json
{
  "success": true,
  "message": "✅ Produk berhasil diperbarui!",
  "data": {
    "id": 1,
    "name": "Kaos Polos Putih Premium",
    "sku": "KAOS-001",
    "price": "80000.00",
    "cost_price": "50000.00",
    "stock": 284,
    "image": "products/XXXXXXXXXXXXXX.jpg",
    "category_id": 1,
    "category": {
      "id": 1,
      "name": "Kaos"
    },
    "updated_at": "2026-05-06T11:30:00.000000Z"
  }
}
```

### ⚠️ Contoh Error: Product Tidak Ditemukan (404)
```json
{
  "success": false,
  "message": "Produk tidak ditemukan"
}
```

---

## 📋 Quick Checklist Testing

- [ ] ✅ Test GET search: `{{api_url}}/products?q=kaos`
- [ ] ✅ Test GET pagination: `{{api_url}}/products?page=1&per_page=10`
- [ ] ✅ Test POST create dengan image
- [ ] ✅ Test PUT update harga
- [ ] ✅ Test PUT update gambar
- [ ] ✅ Test PUT update keduanya (harga + gambar)

---

## 🎯 Saran Testing Urutan

1. **GET products tanpa search** - untuk lihat data yang ada
2. **GET products dengan search** - test search query
3. **GET products dengan pagination** - test page & per_page
4. **POST product baru dengan image** - test create + upload
5. **PUT product harga saja** - test update sebagian
6. **PUT product gambar saja** - test upload gambar
7. **PUT product harga + gambar** - test update lengkap

## 🧪 Contoh Request Postman - Product

### **Scenario 1: Cari Produk dengan Pagination**

#### Step 1: Cari produk dengan kata kunci "kopi"
```
GET {{api_url}}/products?q=kopi&page=1&per_page=10
```

Response: Menampilkan produk yang cocok dengan pagination info

#### Step 2: Lihat halaman berikutnya
```
GET {{api_url}}/products?q=kopi&page=2&per_page=10
```

---

### **Scenario 2: Tambah Produk Minuman Baru dengan Gambar**

#### Step 1: Buat kategori terlebih dahulu (jika belum ada)
```
POST /api/categories
Headers: Content-Type: application/json
Body: {"name": "Minuman"}
Response: category_id = 1
```

#### Step 2: Buat produk baru dengan upload gambar
```
POST {{api_url}}/products
Headers: Content-Type: multipart/form-data
Body (form-data):
  - name: "Kopi Arabika Premium"
  - sku: "KOPI-PREM-001"
  - price: 35000
  - cost_price: 20000
  - stock: 50
  - category_id: 1
  - image: (pilih file gambar dari komputer)
```

#### Step 3: Lihat produk yang baru dibuat
```
GET {{api_url}}/products/2
```

#### Step 4: Update produk dengan gambar baru
```
PUT {{api_url}}/products/2
Headers: Content-Type: multipart/form-data
Body (form-data):
  - price: 38000
  - stock: 45
  - image: (pilih file gambar baru)
```

#### Step 5: Hapus produk
```
DELETE {{api_url}}/products/2
```

---

### **Scenario 3: Update Harga Tanpa Mengubah Gambar**

#### Step 1: Update hanya harga (gambar tetap)
```
PUT {{api_url}}/products/1
Headers: Content-Type: multipart/form-data
Body (form-data):
  - price: 27000
```

Gambar lama akan tetap tersimpan karena tidak ada file baru yang diupload.

---

## 🆘 TROUBLESHOOTING - ERROR & SOLUSI

### ❌ Error: "The image must be a file of type: jpeg, png, jpg, gif, webp"

**Penyebab:** Format gambar tidak sesuai  
**Solusi:**
- ✅ Gunakan file dengan format: **JPEG**, **PNG**, **GIF**, atau **WEBP**
- ❌ Jangan gunakan: BMP, TIFF, SVG, atau format lainnya
- 💡 Tip: Pakai format PNG untuk gambar dengan background transparan

---

### ❌ Error: "The image must not be greater than 2048 kilobytes"

**Penyebab:** File gambar terlalu besar (>2MB)  
**Solusi:**
- ✅ Kompresi gambar menggunakan tool: TinyPNG, ImageOptimizer, atau Preview
- ✅ Target ukuran: 500KB - 1.5MB
- 💡 Tip: Gunakan format WEBP untuk ukuran lebih kecil dengan kualitas sama

---

### ❌ Error: "The price field is required"

**Penyebab:** Field price kosong atau tidak dikirim  
**Solusi:**
- ✅ **Pastikan format NUMERIC**: `85000` (bukan `85,000` atau `85.000`)
- ❌ JANGAN gunakan: comma (,) atau format mata uang
- ✅ Field price harus berupa angka bulat atau desimal
- 💡 Contoh yang benar: `85000`, `85000.50`, `100`

---

### ❌ Error: "The sku has already been taken"

**Penyebab:** SKU sudah ada di database (duplikat)  
**Solusi:**
- ✅ Gunakan SKU yang unik dan berbeda
- ✅ Format SKU: `KATEGORI-ITEM-NOMOR` (contoh: `KAOS-001`, `KAOS-002`)
- 💡 Tip: Gunakan Postman pre-request script untuk auto-generate SKU

---

### ❌ Error: "The category_id field must exist in categories table"

**Penyebab:** Category ID tidak ada atau salah  
**Solusi:**
- ✅ Cek dulu kategori mana saja yang ada di database:
  ```
  GET {{api_url}}/categories
  ```
- ✅ Gunakan `id` dari kategori yang ada
- 💡 Tip: Biasanya kategori default adalah ID: 1, 2, 3, dst

---

### ❌ Error: "Produk tidak ditemukan" (404)

**Penyebab:** Product ID tidak ada  
**Solusi:**
- ✅ Gunakan ID produk yang valid (cek dari GET /products)
- ✅ ID harus berupa angka positif: `1`, `2`, `3`, dst
- ❌ Jangan gunakan: `0`, negatif, atau string

---

### ❌ Error: "The request signature we calculated does not match the signature you provided"

**Penyebab:** Masalah authentication/headers  
**Solusi:**
- ✅ Pastikan Headers sudah benar: `Content-Type: multipart/form-data`
- ✅ Jika pakai token, pastikan token di header `Authorization: Bearer {token}`
- 💡 Tip: Postman biasanya auto-set header jika pilih "form-data"

---

### ⚠️ TIPS: Pagination & Search TIDAK ERROR

**Search parameter (`q`):**
```
GET {{api_url}}/products?q=kaos
```
- ✅ Tidak case-sensitive: `kaos` = `KAOS` = `Kaos`
- ✅ Bisa partial search: `KA` akan match `KAOS-001`
- ✅ Cari di: nama produk + SKU

**Pagination parameters:**
```
GET {{api_url}}/products?page=1&per_page=10
```
- ✅ `page` harus >= 1 (tidak boleh 0)
- ✅ `per_page` harus 1-100
- ✅ Default `page=1`, `per_page=12`
- ✅ Jika page melebihi last_page, akan return empty array

---

### 📸 Format Gambar yang BENAR untuk Postman

| Format | Ekstensi | Ukuran Typical | Catatan |
|--------|----------|---|---------|
| JPEG | .jpg, .jpeg | 100-500KB | Format paling umum, cocok untuk foto |
| PNG | .png | 200-800KB | Support transparansi, cocok untuk grafis |
| GIF | .gif | 50-200KB | Format animasi, jarang dipakai |
| WEBP | .webp | 50-300KB | **Format terbaru, file lebih kecil** |

**Rekomendasi:** Gunakan JPEG untuk foto produk, PNG untuk grafis dengan background, WEBP untuk optimasi ukuran.

---

### ✅ CHECKLIST SEBELUM SUBMIT REQUEST

- [ ] Method HTTP sudah benar (GET/POST/PUT/DELETE)
- [ ] URL/Endpoint sudah benar
- [ ] Headers sudah benar (terutama Content-Type)
- [ ] Untuk form-data: pastikan tipe field sudah benar (Text vs File)
- [ ] Untuk numeric fields: format angka tanpa comma atau symbol
- [ ] Untuk file: ukuran < 2MB dan format valid
- [ ] Untuk ID fields: pastikan ID ada di database
- [ ] Pastikan Environment variable sudah di-set (Migu POS)

---

## 📞 Bantuan Tambahan

Jika masih ada error:
1. **Cek response body** - lihat pesan error detail di bagian `errors`
2. **Cek HTTP status code:**
   - `200-201` = Sukses ✅
   - `400` = Bad Request (format data salah)
   - `404` = Not Found (resource tidak ada)
   - `422` = Validation Error (validasi gagal)
   - `500` = Server Error (hubungi developer)
3. **Lihat Console Postman** - untuk melihat request/response mentah

---

## 📊 Contoh Data Product Testing

### **Test Data Set 1 - Minuman (Dengan Image)**

```json
[
  {
    "name": "Kopi Hitam",
    "sku": "KOPI-HITAM-001",
    "price": 8000,
    "cost_price": 3000,
    "stock": 100,
    "category_id": 1,
    "image": "products/kopi_hitam.jpg"
  },
  {
    "name": "Kopi Susu",
    "sku": "KOPI-SUSU-001",
    "price": 12000,
    "cost_price": 5000,
    "stock": 80,
    "category_id": 1,
    "image": "products/kopi_susu.jpg"
  },
  {
    "name": "Teh Panas",
    "sku": "TEH-PANAS-001",
    "price": 5000,
    "cost_price": 2000,
    "stock": 150,
    "category_id": 1,
    "image": "products/teh_panas.jpg"
  }
]
```

### **Test Data Set 2 - Makanan (Dengan Image)**

```json
[
  {
    "name": "Roti Tawar",
    "sku": "ROTI-TAWAR-001",
    "price": 15000,
    "cost_price": 8000,
    "stock": 50,
    "category_id": 2,
    "image": "products/roti_tawar.jpg"
  },
  {
    "name": "Donat",
    "sku": "DONAT-001",
    "price": 3000,
    "cost_price": 1500,
    "stock": 200,
    "category_id": 2,
    "image": "products/donat.jpg"
  },
  {
    "name": "Sandwich",
    "sku": "SANDWICH-001",
    "price": 20000,
    "cost_price": 10000,
    "stock": 30,
    "category_id": 2,
    "image": "products/sandwich.jpg"
  }
]
```

---

## 🔍 Postman Scripts & Tests

### **Pre-request Script** (Setup sebelum request)

Tambahkan di tab **Pre-request Script** untuk auto-generate SKU:

```javascript
// Generate unique SKU
const timestamp = new Date().getTime();
const sku = "PROD-" + timestamp;
pm.environment.set("generated_sku", sku);
```

### **Test Script** (Validasi response)

Tambahkan di tab **Tests** untuk validasi response:

```javascript
// Check if response status is 201 (Created)
pm.test("Status code is 201", function () {
    pm.response.to.have.status(201);
});

// Check if success is true
pm.test("Success is true", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData.success).to.be.true;
});

// Check if data object exists
pm.test("Data object exists", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData.data).to.exist;
});

// Check if product has required fields
pm.test("Product has required fields", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData.data).to.have.property('id');
    pm.expect(jsonData.data).to.have.property('name');
    pm.expect(jsonData.data).to.have.property('sku');
    pm.expect(jsonData.data).to.have.property('price');
});

// Save product ID untuk request berikutnya
pm.test("Save product ID", function () {
    var jsonData = pm.response.json();
    pm.environment.set("product_id", jsonData.data.id);
});
```

---

## � Tutorial: Upload Image di Postman

### **Step-by-Step Upload Image**

#### 1. **Buat Request POST untuk Create Product dengan Image**

- Method: `POST`
- URL: `{{api_url}}/products`
- Buka tab **Body**

#### 2. **Setup Form-Data**

- Klik **Body** → pilih **form-data**
- Jangan gunakan "raw JSON"!

#### 3. **Tambah Fields**

Dalam form-data, tambahkan fields berikut:

```
KEY              | TYPE    | VALUE
name             | text    | Kopi Arabika
sku              | text    | KOPI-BARU-001
price            | text    | 25000
cost_price       | text    | 15000
stock            | text    | 100
category_id      | text    | 1
image            | file    | (pilih file)
```

#### 4. **Upload File Gambar**

- Di kolom VALUE untuk field `image`, ubah tipe dari **text** menjadi **file**
- Klik tombol pilih file yang muncul
- Pilih file gambar dari komputer (jpg, png, atau gif)

#### 5. **Send Request**

- Klik tombol **Send**
- Response akan menampilkan data produk dengan path gambar di field `image`

### **Contoh Response dengan Image**

```json
{
  "success": true,
  "data": {
    "id": 10,
    "name": "Kopi Arabika",
    "sku": "KOPI-BARU-001",
    "price": 25000,
    "cost_price": 15000,
    "stock": 100,
    "image": "products/kopi_arabika_xyz123.jpg",
    "category_id": 1,
    "category": {
      "id": 1,
      "name": "Minuman"
    },
    "created_at": "2026-05-06T10:15:30.000000Z",
    "updated_at": "2026-05-06T10:15:30.000000Z"
  }
}
```

### **Tips & Tricks**

✅ **Format file yang diterima:**
- `.jpg`, `.jpeg`, `.png`, `.gif`

✅ **Ukuran maksimal:**
- 2 MB (2048 KB)

✅ **Cara melihat gambar yang sudah upload:**
- Gambar tersimpan di: `storage/app/public/products/`
- URL akses: `http://localhost:8000/storage/products/filename.jpg`

❌ **Kesalahan umum:**
- Lupa ubah tipe field menjadi "file" → Gunakan tipe "file", bukan "text"!
- Upload file terlalu besar → Kurangi ukuran gambar atau kompres
- Format file salah → Hanya jpg, png, gif yang diterima

### **Update Produk dengan Gambar Baru**

#### Request: `PUT {{api_url}}/products/10`

- Method: `PUT`
- Headers: Content-Type: multipart/form-data
- Body: form-data
  - `image`: (upload file baru)
  - atau field lain yang ingin diupdate

Gambar lama akan otomatis dihapus saat upload gambar baru.

### **cURL - Upload Image**

Jika ingin menggunakan cURL command:

```bash
curl -X POST http://localhost:8000/api/products \
  -F "name=Kopi Arabika" \
  -F "sku=KOPI-001" \
  -F "price=25000" \
  -F "cost_price=15000" \
  -F "stock=100" \
  -F "category_id=1" \
  -F "image=@/path/to/image.jpg"
```

Ganti `/path/to/image.jpg` dengan path file gambar di komputer.

---

## �📋 Checklist Testing

- [ ] Environment `Migu POS` sudah dibuat
- [ ] Base URL diset di environment variable
- [ ] POST /api/categories berhasil (dapatkan category_id)
- [ ] POST /api/products dengan category_id valid
- [ ] POST /api/products dengan upload image berhasil
- [ ] GET /api/products lihat semua produk
- [ ] GET /api/products?q=kopi cari produk dengan keyword
- [ ] GET /api/products?page=1&per_page=10 test pagination
- [ ] GET /api/products/{id} lihat produk spesifik
- [ ] PUT /api/products/{id} update produk
- [ ] PUT /api/products/{id} update dengan image baru
- [ ] DELETE /api/products/{id} hapus produk
- [ ] Test response status code
- [ ] Test response format JSON
- [ ] Validasi error message untuk search/pagination
- [ ] Validasi error message untuk image (ukuran/format)

---

## 🐛 Common Errors & Solutions

| Error | Penyebab | Solusi |
|-------|---------|--------|
| `422 Validation Error` | SKU sudah ada atau category_id tidak valid | Cek SKU unik, pastikan category_id ada |
| `422 Image validation error` | Format file salah atau ukuran > 2MB | Gunakan jpg/png/gif, ukuran < 2MB |
| `422 Pagination error` | per_page > 100 atau page < 1 | Gunakan per_page ≤ 100, page ≥ 1 |
| `404 Not found` | Product ID tidak ditemukan | Gunakan product ID yang valid |
| `400 Bad Request` | Format data salah (text vs file di form-data) | Pastikan field `image` bertipe "file" |
| `500 Server Error` | Error di server atau disk full | Check laravel log: `storage/logs/laravel.log` |
| Gambar tidak upload | Tidak ubah field type ke "file" di Postman | Pilih tipe "file" bukan "text" |
| Search tidak bekerja | Parameter `q` tidak diterima | Pastikan syntax: `?q=keyword&page=1&per_page=10` |

---

## 💾 Export Collection

**Di Postman:**
1. Klik menu 3 titik (...) pada folder collection
2. Pilih **Export**
3. Simpan sebagai file `.json`
4. Share dengan tim development

---

## 🎯 Quick Copy-Paste Commands

### **cURL - Buat Produk**
```bash
curl -X POST http://localhost:8000/api/products \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Kopi Arabika",
    "sku": "KOPI001",
    "price": 25000,
    "cost_price": 15000,
    "stock": 100,
    "category_id": 1
  }'
```

### **cURL - Lihat Semua Produk**
```bash
curl -X GET http://localhost:8000/api/products \
  -H "Content-Type: application/json"
```

### **cURL - Update Produk**
```bash
curl -X PUT http://localhost:8000/api/products/1 \
  -H "Content-Type: application/json" \
  -d '{
    "price": 30000,
    "stock": 80
  }'
```

### **cURL - Hapus Produk**
```bash
curl -X DELETE http://localhost:8000/api/products/1 \
  -H "Content-Type: application/json"
```

---

**Last Updated:** April 29, 2026
