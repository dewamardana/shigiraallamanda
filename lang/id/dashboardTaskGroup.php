<?php

return [
    'index' => [
        'title' => 'Tugas Kantor',
    ],

    'table' => [
        'name' => 'Nama Grup',
        'status' => 'Status',
        'action' => 'Aksi',
        'active' => 'Aktif',
        'inactive' => 'Tidak Aktif',
        'show' => 'Lihat',
        'edit' => 'Ubah',
        'delete' => 'Hapus',
        'delete_confirm' => 'Apakah Anda yakin ingin menghapus grup ini?',
    ],

    'create' => [
        'title' => 'Tambah Grup Tugas',
    ],

    'form' => [
        'name' => 'Nama Grup',
        'active' => 'Aktif',
    ],

    'edit' => [
        'title' => 'Ubah Grup Tugas',
    ],

    'controller' => [
        'index' => [
            'title' => 'Grup Tugas Aktif | Dashboard',
        ],

        'create' => [
            'title' => 'Buat Grup Tugas | Dashboard',
            'success_add' => 'Grup tugas berhasil dibuat.',
        ],

        'show' => [
            'title' => 'Grup Tugas Aktif | Dashboard',
        ],

        'edit' => [
            'title' => 'Ubah Grup Tugas | Dashboard',
            'error_edit' => 'Tidak dapat menonaktifkan semua tugas. Setidaknya satu tugas harus tetap aktif.',
            'success_edit' => 'Grup tugas berhasil diperbarui.',
        ],

        'delete' => [
            'error_delete' => 'Grup Tugas yang aktif tidak dapat dihapus.',
            'success_delete' => 'Data Grup Tugas berhasil dihapus.',
        ],
    ]
];
