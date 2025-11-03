<?php

return [
    'index' => [
        'title' => 'Daftar Tugas Checker',
    ],

    'create' => [
        'title' => 'Tambah Tugas Checker',
    ],

    'edit' => [
        'title' => 'Edit Tugas Checker',
    ],

    'form' => [
        'name' => 'Nama Tugas',
        'type' => 'Tipe',
        'formula' => 'Rumus',
        'active' => 'Aktif',
    ],

    'option' => [
        'boolean' => 'Boolean',
        'number' => 'Angka',
    ],

    'table' => [
        'name' => 'Nama Tugas',
        'type' => 'Tipe',
        'formula' => 'Rumus',
        'active' => 'Aktif',
        'action' => 'Aksi',
        'empty' => 'Tidak ada tugas checker ditemukan.',
    ],

    'status' => [
        'yes' => 'Ya',
        'no' => 'Tidak',
    ],

    'button' => [
        'add' => 'Tambah Tugas',
        'edit' => 'Perbarui Tugas',
        'delete' => 'Hapus',
        'back' => 'Kembali',
        'show' => 'Lihat',
    ],

    'alert' => [
        'success_add' => 'Tugas checker berhasil ditambahkan.',
        'error_add' => 'Gagal menambahkan tugas checker.',
        'success_edit' => 'Tugas checker berhasil diperbarui.',
        'error_edit' => 'Gagal memperbarui tugas checker.',
        'success_delete' => 'Tugas checker berhasil dihapus.',
        'error_delete' => 'Gagal menghapus tugas checker.',
    ],

    'controller' => [
        'index' => [
            'title' => 'Daftar Tugas Checker | Dashboard',
        ],
        'create' => [
            'title' => 'Tambah Tugas Checker | Dashboard',
            'success_add' => 'Tugas checker berhasil dibuat.',
        ],
        'edit' => [
            'title' => 'Edit Tugas Checker | Dashboard',
            'success_edit' => 'Tugas checker berhasil diperbarui.',
            'error_edit' => 'Terjadi kesalahan saat memperbarui tugas checker.',
        ],
        'delete' => [
            'success_delete' => 'Tugas checker berhasil dihapus.',
            'error_delete' => 'Gagal menghapus tugas checker.',
            'disabled' => 'Tugas checker dinonaktifkan (tidak bisa dihapus karena sudah memiliki data).',
        ],
    ],
];
