# SIAKAD - Sistem Informasi Akademik

Aplikasi web berbasis Laravel 12 untuk mensimulasikan Sistem Informasi Akademik (SIAKAD) sederhana yang dapat digunakan untuk mengelola data akademik seperti dosen, mahasiswa, mata kuliah, jadwal, dan Kartu Rencana Studi (KRS).

## 🔗 Link Hosting
**https://tubes-siakad-ifb2024-5520124044-mnaufalavridatja-production.up.railway.app/login**

## 👤 Akun Demo
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@siakad.com | password |
| Mahasiswa | mahasiswa@siakad.com | password |

## 📋 Deskripsi Aplikasi
SIAKAD adalah sistem informasi akademik berbasis web yang dibangun menggunakan framework Laravel 12. Aplikasi ini memiliki dua peran pengguna yaitu Admin dan Mahasiswa, masing-masing dengan hak akses yang berbeda. Admin dapat mengelola seluruh data akademik, sedangkan Mahasiswa hanya dapat melihat jadwal dan mengambil mata kuliah melalui fitur KRS.

## 📄 Penjelasan Fungsi Halaman

### Halaman Publik
**Login** (`/login`)
Halaman autentikasi untuk masuk ke sistem. Pengguna memasukkan email dan password sesuai role masing-masing (Admin atau Mahasiswa). Setelah login berhasil, sistem akan mengarahkan pengguna ke dashboard sesuai role.

### Halaman Admin
**Dashboard Admin** (`/admin/dashboard`)
Halaman utama admin yang menampilkan statistik keseluruhan sistem meliputi total dosen, mahasiswa, mata kuliah, jadwal, dan KRS. Terdapat juga tabel mahasiswa paling aktif dan mata kuliah terpopuler, serta menu akses cepat ke semua fitur.

**Data Dosen** (`/admin/dosen`)
Halaman untuk mengelola data dosen. Admin dapat melihat daftar dosen, menambah dosen baru, mengedit data dosen, menghapus data dosen, serta melakukan pencarian berdasarkan nama atau NIDN.

**Data Mahasiswa** (`/admin/mahasiswa`)
Halaman untuk mengelola data mahasiswa. Admin dapat melihat daftar mahasiswa, menambah mahasiswa baru, mengedit data mahasiswa, menghapus data mahasiswa, serta melakukan pencarian berdasarkan nama atau NPM.

**Mata Kuliah** (`/admin/mata-kuliah`)
Halaman untuk mengelola data mata kuliah. Admin dapat melihat daftar mata kuliah, menambah mata kuliah baru, mengedit data mata kuliah, menghapus data mata kuliah, serta melakukan pencarian dan filter berdasarkan nama, kode, atau jumlah SKS.

**Jadwal** (`/admin/jadwal`)
Halaman untuk mengelola jadwal perkuliahan. Admin dapat membuat jadwal dengan menentukan mata kuliah, dosen pengajar, kelas, hari, dan jam. Tersedia fitur pencarian dan filter berdasarkan nama mata kuliah, dosen, atau hari.

**KRS** (`/admin/krs`)
Halaman untuk melihat seluruh Kartu Rencana Studi mahasiswa. Admin dapat melihat mata kuliah yang diambil oleh setiap mahasiswa beserta informasi SKS. Tersedia fitur export data KRS ke format PDF dan CSV.

### Halaman Mahasiswa
**Dashboard Mahasiswa** (`/mahasiswa/dashboard`)
Halaman utama mahasiswa yang menampilkan menu akses cepat ke fitur jadwal perkuliahan dan KRS.

**Jadwal Perkuliahan** (`/mahasiswa/jadwal`)
Halaman untuk melihat seluruh jadwal perkuliahan yang tersedia, meliputi informasi mata kuliah, dosen pengajar, kelas, hari, dan jam kuliah.

**KRS Saya** (`/mahasiswa/krs`)
Halaman untuk mahasiswa mengambil dan mengelola Kartu Rencana Studi. Mahasiswa dapat memilih mata kuliah yang ingin diambil dari daftar yang tersedia, melihat daftar mata kuliah yang sudah diambil beserta total SKS, dan melakukan drop mata kuliah yang tidak diinginkan.

## ✨ Fitur Utama
- Authentication & Authorization dengan 2 role (Admin & Mahasiswa)
- CRUD Data Dosen, Mahasiswa, Mata Kuliah, dan Jadwal
- Manajemen KRS (Ambil & Drop Mata Kuliah)
- Export KRS ke PDF dan CSV
- Pencarian & Filter Data
- Dashboard Statistik
- Validasi Form di setiap halaman
- Middleware Role untuk keamanan akses

## 🛠 Teknologi
- Laravel 12
- SQLite
- Tailwind CSS
- Laravel Breeze
- DomPDF
- Eloquent ORM & Relationship
- Middleware

## ⚙️ Instalasi Local
```bash
git clone https://github.com/feitan2006/tubes-siakad-ifb2024-5520124044-mnaufalavridatja.git
cd tubes-siakad-ifb2024-5520124044-mnaufalavridatja
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm install && npm run dev
php artisan serve
```