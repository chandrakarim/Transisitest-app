
![Beranda](images/1.%20Beranda.png)



# Aplikasi Manajemen Karyawan dan Perusahaan

Aplikasi ini dibangun menggunakan **Laravel** untuk mengelola data perusahaan dan karyawan dengan fungsionalitas **CRUD** (Create, Read, Update, Delete) dan fitur tambahan seperti **Import Excel** dan **Export PDF** untuk data karyawan. Aplikasi ini dilengkapi dengan **autentikasi admin** untuk pengelolaan data perusahaan dan karyawan.

## Fitur Utama

- **Autentikasi Admin**: Login untuk administrator.
- **CRUD Perusahaan**: Menambahkan, mengedit, menghapus, dan menampilkan data perusahaan.
- **CRUD Karyawan**: Menambahkan, mengedit, menghapus, dan menampilkan data karyawan.
- **Export PDF**: Menghasilkan laporan PDF untuk data karyawan berdasarkan perusahaan.
- **Import Excel**: Mengimpor data karyawan dari file Excel.
- **Pagination**: Menampilkan data dalam format paginasi (5 data per halaman).

## Persyaratan Sistem

Sebelum memulai, pastikan Anda sudah menginstal perangkat lunak berikut:

- **PHP 8.2+**: Versi PHP yang dibutuhkan untuk menjalankan aplikasi.
- **Composer**: Pengelola dependensi PHP.
- **Laravel 10.x**: Framework yang digunakan untuk membangun aplikasi ini.
- **MySQL** atau database lain yang Anda pilih.
- **wkhtmltopdf**: Digunakan untuk mengekspor data ke format PDF.

## Langkah-langkah Instalasi

Ikuti langkah-langkah berikut untuk menginstal aplikasi ini:

### 1. Clone Repository

Clone proyek ini ke komputer lokal Anda dengan perintah berikut:

```bash
git clone https://github.com/chandrakarim/Transisitest-app.git
```
### 2. Install Dependencies
Setelah meng-clone repository, masuk ke folder proyek dan jalankan perintah berikut untuk menginstal dependensi yang dibutuhkan oleh Laravel:

```bash
Copy code
cd project-name
composer install
```
### 3. Konfigurasi .env
Salin file .env.example menjadi .env:

```bash
Copy code
cp .env.example .env
```
Buka file .env dan sesuaikan pengaturan database Anda. Misalnya, untuk menggunakan MySQL, atur seperti ini:
```bash
.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Kunci Aplikasi
Jalankan perintah berikut untuk menghasilkan kunci enkripsi aplikasi:
```bash
Copy code
php artisan key:generate
```
### 5. Jalankan Migrations dan Seeder
Lakukan migrasi untuk membuat tabel di database serta menambahkan data dummy, termasuk akun admin, dengan perintah berikut:
```bash
Copy code
php artisan migrate --seed
```

### 6. Install wkhtmltopdf
wkhtmltopdf digunakan untuk fitur export PDF. Ikuti langkah-langkah berikut untuk menginstalnya:

Unduh wkhtmltopdf dari situs resmi.

Ekstrak file yang diunduh dan pastikan wkhtmltopdf.exe berada di folder berikut:
```bash
C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe.
```

### 7. Konfigurasi Snappy PDF
Di file .env, pastikan Anda mengatur path ke file wkhtmltopdf.exe:

.env Copy code
```bash
WKHTMLTOPDF_BINARY="C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe"
```
### 8. Jalankan Aplikasi
Sekarang, jalankan aplikasi menggunakan perintah berikut:

```bash
Copy code
php artisan serve
Aplikasi akan berjalan di http://localhost:8000.
```
## Fitur Aplikasi
### 1. Autentikasi Admin
Login dengan akun admin untuk mengelola data perusahaan dan karyawan:
```bash
Email: admin@transisi.id

Password: transisi
```
### 2. CRUD Data Perusahaan
Tambah Perusahaan: Menambahkan perusahaan baru dengan nama, email, logo, dan website.

- Edit Perusahaan: Mengubah detail perusahaan yang ada.

- Hapus Perusahaan: Menghapus perusahaan yang tidak diperlukan.

- Lihat Perusahaan: Melihat daftar perusahaan yang ada.

### 3. CRUD Data Karyawan
- Tambah Karyawan: Menambahkan karyawan dengan nama, email, dan memilih perusahaan terkait.

- Edit Karyawan: Mengubah detail karyawan yang ada.

- Hapus Karyawan: Menghapus data karyawan dari daftar.

- Lihat Karyawan: Menampilkan daftar karyawan yang terdaftar di aplikasi.

### 4. Export PDF
Anda dapat mengekspor data karyawan berdasarkan perusahaan dalam format PDF. Klik tombol Export to PDF di halaman daftar karyawan perusahaan untuk menghasilkan laporan PDF.

### 5. Import Excel
Aplikasi ini memungkinkan Anda untuk mengimpor data karyawan dari file Excel. Pastikan file Excel memiliki kolom yang sesuai dengan data yang dibutuhkan (misalnya: nama, email, perusahaan).
```bash
Langkah-langkah Import:

Klik tombol Import Excel.

Pilih file Excel yang sesuai dari komputer Anda atau
anda dapat mengambil dalam projek ini nama file *dummy_company.xlsx*
dan klik Submit untuk mengimpor data.
```
### 6. Pagination
Daftar perusahaan dan karyawan akan ditampilkan dengan pagination, yang menampilkan 5 data per halaman.

Pemecahan Masalah
Export PDF Tidak Berfungsi: Jika Anda mengalami masalah dengan export PDF, pastikan bahwa wkhtmltopdf telah terinstal dengan benar dan path-nya sudah diatur dengan benar di file .env dan config/snappy.php.

Import Excel Tidak Berhasil: Jika file Excel tidak terimpor dengan benar, pastikan file Excel yang diunggah memiliki format yang sesuai dan menggunakan versi Maatwebsite/Excel yang tepat.

### Penting!
Sebelum menjalankan aplikasi di lingkungan produksi, pastikan Anda telah mengamankan aplikasi dengan langkah-langkah berikut:

Amankan file .env agar tidak bocor ke publik.

Menonaktifkan debug mode di file .env dengan mengubah APP_DEBUG=false.

Pastikan autentikasi dan otorisasi diimplementasikan dengan baik agar hanya admin yang dapat mengakses data sensitif.

Lisensi
Aplikasi ini dilisensikan di bawah Lisensi MIT. Untuk detail lebih lanjut,lihat file LICENSE.
