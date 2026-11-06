# Flutter API Testing (PHP Native)

API sederhana untuk menguji login, daftar, detail object, dan respons tanpa data dari aplikasi Flutter. Tidak membutuhkan framework atau dependency Composer.

## Menjalankan server

Dari folder project, jalankan:

```bash
php -S 0.0.0.0:8000 -t public
```

## Deploy ke Azure App Service (Linux F1)

Project ini disiapkan agar bisa dijalankan sebagai PHP native di Azure App Service Linux. File `default` mengatur NGINX agar web root mengarah ke `public`, sehingga folder helper `src` tidak menjadi folder publik.

1. Di Azure Portal, buat **Web App** dengan **Publish: Code**, **Operating System: Linux**, runtime PHP 8.x yang tersedia, dan App Service Plan **Free F1**. Kode memakai fitur PHP 8.1+, jadi pilih runtime 8.1 atau lebih baru. Pilih region terdekat yang menyediakan F1. Nama Web App harus unik karena menjadi alamat publik `https://<nama-app>.azurewebsites.net`.
2. Deploy ZIP project dari Azure CLI. Pastikan struktur di dalam ZIP dimulai langsung dengan `composer.json`, `default`, `public/`, dan `src/` (jangan ada folder project pembungkus).
3. Pada Web App, buka **Settings > Configuration > General settings** lalu isi **Startup Command** dengan:

   ```bash
   cp /home/site/wwwroot/default /etc/nginx/sites-available/default && service nginx reload
   ```

   Azure menyalin konfigurasi NGINX bawaan saat container mulai; startup command ini memasang konfigurasi yang mengarahkan root ke `public` setiap kali app restart.
4. Restart Web App, lalu coba URL endpoint di bawah. Endpoint selain login tetap memerlukan header Bearer token.

Contoh pembuatan ZIP dan deploy dari PowerShell (jalankan dari root project; ganti nama resource sesuai Azure Web App kamu):

```powershell
Compress-Archive -Path composer.json,README.md,default,src,public -DestinationPath .\azure-deploy.zip -Force
az login
az webapp deploy --resource-group <resource-group> --name <nama-app> --src-path .\azure-deploy.zip --type zip
```

Jangan deploy folder `.idea`. Setelah berhasil, Base URL API menjadi `https://<nama-app>.azurewebsites.net`. Paket F1 gratis untuk pemakaian dalam batasnya, tetapi memiliki kuota CPU dan bandwidth serta tidak memiliki SLA.

Base URL:

- Browser/emulator desktop: `http://localhost:8000`
- Android Emulator: `http://10.0.2.2:8000`
- Perangkat fisik: `http://<IP-LAN-komputer>:8000` (pastikan komputer dan ponsel satu jaringan)

## Endpoint

Semua endpoint memakai envelope yang sama:

```json
{
  "status": true,
  "message": "...",
  "data": {}
}
```

`status` adalah boolean. Untuk respons tanpa payload, `data` bernilai `null`. Error juga memakai tiga field tersebut dan mengembalikan HTTP status yang sesuai.

| Method | Path | Kegunaan |
|---|---|---|
| `POST` | `/api/login.php` | Login demo, menghasilkan token dan profil |
| `GET` | `/api/items.php?page=1` | Daftar ringkas dengan URL gambar dan pagination |
| `GET` | `/api/item.php?id=1` | Detail object untuk item pada daftar |
| `GET` | `/api/empty.php` | Respons sukses dengan `data: null` |

Semua endpoint selain login memerlukan token. Kirim token dari respons login melalui header berikut:

```http
Authorization: Bearer test-token-1234567890
```

Jika token tidak dikirim atau nilainya salah, API mengembalikan HTTP 401 dengan `status: false` dan `data: null`.

### 1. Login

Kredensial demo: `demo@example.com` / `password123`.

```http
POST /api/login.php
Content-Type: application/json
```

```json
{
  "email": "demo@example.com",
  "password": "password123"
}
```

Contoh respons sukses:

```json
{
  "status": true,
  "message": "Login berhasil.",
  "data": {
    "token": "test-token-1234567890",
    "user": {
      "id": 1,
      "name": "Demo User",
      "email": "demo@example.com",
      "avatar": "https://i.pravatar.cc/300?img=12"
    }
  }
}
```

Token dan field user bisa disimpan ke SharedPreferences, lalu token dipakai pada header endpoint lainnya. Akun dan token ini hardcoded untuk testing, bukan autentikasi produksi.

### 2. Daftar data

`GET /api/items.php?page=1` dengan header Bearer token menghasilkan daftar kisah mitologi dan metadata pagination. `page` dimulai dari 1, sedangkan `per_page` ditetapkan tetap 20 item per halaman. Total data contoh adalah 39 item, sehingga ada dua halaman: halaman pertama berisi 20 item dan halaman kedua 19 item. Setiap item memiliki `id`, `author`, `title`, `description`, `image`, `reading_time_minutes`, dan `reader_count`.

`reading_time_minutes` berupa angka menit, sedangkan `reader_count` berupa angka pembaca. Flutter dapat memformat angka pembaca menjadi tampilan ringkas seperti `12,8 rb`.

Contoh bentuk `data`:

```json
{
  "items": [
    {
      "id": 1,
      "author": "Alya Prameswari",
      "title": "Persephone dan Biji Delima",
      "description": "Kisah tentang Persephone, musim yang berubah, dan kesepakatan yang menghubungkan dunia manusia dengan dunia bawah.",
      "image": "https://picsum.photos/id/1018/900/600",
      "reading_time_minutes": 7,
      "reader_count": 12800
    }
  ],
  "pagination": {
    "total": 39,
    "per_page": 20,
    "current_page": 1,
    "last_page": 2
  }
}
```

Gunakan `page=2` untuk mengambil halaman berikutnya. Parameter `page` yang bukan bilangan bulat positif menghasilkan HTTP 422.

### 3. Detail object

`GET /api/item.php?id=1` dengan header Bearer token menghasilkan satu object lengkap dengan penulis, judul, deskripsi, gambar, estimasi menit baca, dan jumlah pembaca. Ganti `id` dengan ID dari daftar. ID yang tidak dikenal menghasilkan HTTP 404 dengan `data: null`.

Item ID `2` (kisah Fenrir) sengaja memakai URL gambar pada domain `.invalid`, sehingga pengambilan gambar gagal untuk menguji error state gambar di Flutter. Field `image` tetap berupa string URL, bukan `null`.

Item ID `4` memakai gambar lokal. Letakkan file gambar kamu di `public/images/developer.webp`. API membentuk URL gambar dari host request, misalnya `http://10.0.2.2:8000/images/developer.webp` jika request datang dari Android Emulator melalui `10.0.2.2`.

### 4. Respons tanpa data

`GET /api/empty.php` dengan header Bearer token menghasilkan:

```json
{
  "status": true,
  "message": "Request berhasil. Endpoint ini tidak mengembalikan data.",
  "data": null
}
```

## Catatan Flutter

Untuk Android, izinkan koneksi HTTP lokal (cleartext) pada konfigurasi debug Android jika memakai URL `http://`. CORS sudah dibuka untuk memudahkan pemanggilan dari Flutter Web.
