# 🏨 Shigira Allamanda — Sistem Manajemen Operasional Housekeeping

Sistem manajemen operasional internal untuk properti hotel/resort **Shigira Allamanda** — mencakup penugasan kerja, quality control, sistem poin kinerja staf, hingga pelaporan insiden.

## 📌 Deskripsi

Aplikasi web berbasis Laravel untuk mengelola operasional harian tim housekeeping/facility di sebuah properti hotel/resort. Sistem ini menangani seluruh alur kerja mulai dari penugasan tugas kebersihan per ruangan/gedung, verifikasi kualitas kerja oleh supervisor (checker), pencatatan performa staf melalui sistem poin, hingga pelaporan lost & found dan insiden — menggantikan proses manual berbasis kertas/spreadsheet dengan sistem digital terpusat.

## ✨ Fitur Utama

- 🏢 **Manajemen Properti** — data gedung (`Building`) dan kamar/ruangan (`Room`)
- 🧹 **Penugasan & Pencatatan Cleaning** — pengelompokan tim (`CleaningGroup`), penugasan tugas (`CleaningTask`), pencatatan hasil kerja per staf (`CleaningRecord`, `CleaningRecordDetail`)
- ✅ **Quality Control / Inspeksi** — supervisor memverifikasi hasil kerja (`CheckerTask`, `CheckerRecord`) lengkap dengan pencatatan lokasi inspeksi (`CheckerRecordLocation`)
- 🏆 **Sistem Poin Kinerja Harian** — perhitungan skor/insentif staf berbasis formula kustom (`DailyPoint`, `Formula`, `FormulaCheck`)
- 📝 **Manajemen Tugas Kantor** — pencatatan tugas non-cleaning (`OfficeRecord`, `OfficeTaskDetail`)
- 🔍 **Lost & Found** — pencatatan barang tamu yang ditemukan (`FoundItem`)
- 📋 **Pelaporan Insiden** — laporan dengan lampiran media & status tindak lanjut (`Report`, `ReportMedia`, `ReportMember`, `ReportType`)
- 👥 **Manajemen Staf** — role dan keahlian staf (`Role`, `Skill`), autentikasi & manajemen pengguna
- 📊 **Export Laporan** — dukungan ekspor data ke Excel (PhpSpreadsheet)

## ⚙️ Teknologi

- **Framework:** Laravel 12 (PHP 8.2+)
- **Frontend:** Tailwind CSS v4, Flowbite (komponen UI), Feather Icons
- **Build tool:** Vite 7
- **Export data:** PhpOffice/PhpSpreadsheet
- **Database:** MySQL (via Eloquent ORM)

## 🚀 Cara Menjalankan

```bash
git clone https://github.com/dewamardana/shigiraallamanda.git
cd shigiraallamanda
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build   # atau: composer run dev (menjalankan server + queue + vite sekaligus)
```
