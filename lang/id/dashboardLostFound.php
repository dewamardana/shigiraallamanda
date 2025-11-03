<?php

return [

    // 🌐 Bagian umum yang sering digunakan ulang
    'common' => [
        'date' => 'Tanggal',
        'name' => 'Nama Barang',
        'location' => 'Lokasi',
        'description' => 'Deskripsi',
        'status' => 'Status',
        'not_taken' => 'Belum Diambil',
        'taken' => 'Sudah Diambil',
        'action' => 'Aksi',
        'detail' => 'Detail',
        'edit' => 'Simpan Perubahan',
        'no_media' => 'Tidak ada media',
        'serial_number' => 'Nomor Seri',
        'close' => 'Tutup Modal',
    ],

    // 📋 Halaman utama (index)
    'index' => [
        'title' => 'Dasbor Barang Ditemukan',
    ],

    // 🔎 Filter data
    'filter' => [
        'start_date' => 'Tanggal Mulai',
        'end_date' => 'Tanggal Akhir',
        'user' => 'Ditemukan Oleh',
        'all' => 'Semua',
    ],

    // 🧾 Tabel daftar data
    'table' => [
        'date' => 'Tanggal',
        'name' => 'Nama Barang',
        'location' => 'Lokasi',
        'description' => 'Deskripsi',
        'status' => 'Status',
        'action' => 'Aksi',
        'empty' => 'Tidak ada data barang ditemukan.',
    ],

    // 🚦 Status barang
    'status' => [
        'not_taken' => 'Belum Diambil',
        'taken' => 'Sudah Diambil',
    ],

    // 🔘 Tombol umum
    'button' => [
        'detail' => 'Detail',
        'delete' => 'Hapus',
        'edit' => 'Simpan Perubahan',
        'back' => 'Kembali',
    ],

    // ⚠️ Konfirmasi tindakan
    'confirm' => [
        'delete' => 'Apakah Anda yakin ingin menghapus barang ini?',
    ],

    // ⏩ Navigasi tabel
    'pagination' => [
        'next' => 'Berikutnya',
        'previous' => 'Sebelumnya',
    ],

    // 🔔 Pesan alert
    'alert' => [
        'success_delete' => 'Barang berhasil dihapus.',
        'error_delete' => 'Gagal menghapus barang.',
    ],

    // 🧠 Controller (judul halaman dan pesan aksi)
    'controller' => [
        'index' => [
            'title' => 'Daftar Barang Ditemukan | Dasbor',
        ],
        'create' => [
            'title' => 'Tambah Barang Ditemukan | Dasbor',
        ],
        'edit' => [
            'title' => 'Ubah Barang Ditemukan | Dasbor',
        ],
        'show' => [
            'title' => 'Detail Barang Ditemukan | Dasbor',
        ],
        'delete' => [
            'success' => 'Barang berhasil dihapus.',
            'error' => 'Terjadi kesalahan saat menghapus barang.',
        ],
    ],

    // 🔍 Halaman detail (show)
    'show' => [
        'title' => 'Detail Barang Ditemukan',
        'media_section' => 'Media Barang',
        'date_found' => 'Tanggal Ditemukan',
        'found_by' => 'Yang Menemukan',
        'location' => 'Tempat Ditemukan',
        'description' => 'Deskripsi Barang',
        'serial_number' => 'Nomor Seri',
    ],
];
