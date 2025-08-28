<?php

return [
    'index' => [
        'title' => 'Daftar Formula',

        'table' => [
            'name'           => 'Nama Formula',
            'description'    => 'Deskripsi',
            'status'         => 'Status',
            'action'         => 'Aksi',
            'active'         => 'Aktif',
            'inactive'       => 'Nonaktif',
            'delete_confirm' => 'Apakah Anda yakin ingin menghapus formula ini?',
        ],

    ],

    'form' => [
        'name'                => 'Nama Formula',
        'description'         => 'Deskripsi',
        'active'              => 'Aktif',
        'jumlah_kamar'        => 'Jumlah Kamar',
        'mengajar'            => 'Mengajar',
        'pembersihan_khusus'  => 'Pembersihan Khusus',
        'mengangkat_barang'   => 'Mengangkat Barang',
        'membersihkan_gudang' => 'Membersihkan Gudang',
        'obat_pool'           => 'Obat Kolam',
        'membersihkan_pool'   => 'Membersihkan Kolam',
        'sampah'              => 'Sampah',
    ],

    'create' => [
        'title' => 'Tambah Formula Check',
    ],

    'edit' => [
        'title' => 'Edit Formula Check',
    ],

    'show' => [
        'title' => 'Detail Formula Check',
    ],

    'controller' => [
        'index' => [
            'title' => 'Formula Check | Beranda',
        ],

        'create' => [
            'title' => 'Tambah Formula Check | Beranda',
            'success_create' => 'Formula berhasil ditambahkan.',
        ],

        'show' => [
            'title' => 'Detail Formula Check | Beranda',
        ],

        'edit' => [
            'title' => 'Edit Formula Check | Beranda',
            'error_edit' => 'Setidaknya satu formula harus tetap aktif.',
            'success_edit' => 'Formula berhasil diperbarui.',
        ],

        'delete' => [
            'error_delete' => 'Formula yang masih aktif tidak dapat dihapus.',
            'success_delete' => 'Data formula berhasil dihapus.',
        ],

        'validation' => [
            'name.required' => 'Kolom nama wajib diisi.',
            'name.string'   => 'Nama harus berupa teks.',
            'name.max'      => 'Nama tidak boleh lebih dari 255 karakter.',

            'description.required' => 'Kolom deskripsi wajib diisi.',
            'description.string'   => 'Deskripsi harus berupa teks.',

            'jumlah_kamar.required' => 'Jumlah kamar wajib diisi.',
            'jumlah_kamar.numeric'  => 'Jumlah kamar harus berupa angka.',

            'mengajar.required' => 'Nilai mengajar wajib diisi.',
            'mengajar.numeric'  => 'Nilai mengajar harus berupa angka.',

            'pembersihan_khusus.required' => 'Nilai pembersihan khusus wajib diisi.',
            'pembersihan_khusus.numeric'  => 'Nilai pembersihan khusus harus berupa angka.',

            'mengangkat_barang.required' => 'Nilai mengangkat barang wajib diisi.',
            'mengangkat_barang.numeric'  => 'Nilai mengangkat barang harus berupa angka.',

            'membersihkan_gudang.required' => 'Nilai membersihkan gudang wajib diisi.',
            'membersihkan_gudang.numeric'  => 'Nilai membersihkan gudang harus berupa angka.',

            'obat_pool.required' => 'Nilai obat kolam wajib diisi.',
            'obat_pool.numeric'  => 'Nilai obat kolam harus berupa angka.',

            'membersihkan_pool.required' => 'Nilai membersihkan kolam wajib diisi.',
            'membersihkan_pool.numeric'  => 'Nilai membersihkan kolam harus berupa angka.',

            'sampah.required' => 'Nilai sampah wajib diisi.',
            'sampah.numeric'  => 'Nilai sampah harus berupa angka.',
        ]
    ],

];
