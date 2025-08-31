<?php

return [
    'index' => [
        'title'  => '📋 Data Gedung',
        'table' => [
            'photo'        => 'Foto',
            'name'         => 'Nama',
            'description'  => 'Deskripsi',
            'action'       => 'Aksi',
            'edit'         => 'Ubah',
        ],
    ],

    'form' => [
        'building_image'      => 'Gambar Gedung',
        'image_hint'          => 'Klik gambar untuk mengganti',
        'image_upload'        => 'Unggah file',
        'upload_hint'         => 'SVG, PNG, JPG atau GIF (Rasio 1:1).',
        'building_name'       => 'Nama Gedung',
        'description'         => 'Deskripsi',
    ],

    'create' => [
        'title'               => 'Tambah Gedung',
    ],

    'edit' => [
        'title'               => 'Ubah Gedung',
    ],
    'controller' => [
        'index' => [
            'title'   => 'Halaman Gedung | Dashboard',
        ],
        'create' => [
            'title'   => 'Tambah Gedung | Dashboard',
            'success_add'   => 'Gedung berhasil ditambahkan!',
        ],
        'show' => [
            'title'   => 'Detail Gedung | Dashboard',
        ],
        'edit' => [
            'title'   => 'Ubah Gedung | Dashboard',
            'success_update' => 'Gedung berhasil diperbarui!',
        ],
        'delete' => [
            'success_delete' => 'Data gedung berhasil dihapus!',
        ],

        'validation' => [
            'building_name_required' => 'Nama gedung wajib diisi.',
            'slug_required'          => 'Slug wajib diisi.',
            'slug_unique'            => 'Slug sudah digunakan.',
            'description_required'   => 'Deskripsi wajib diisi.',
            'photo_image'            => 'File yang diunggah harus berupa gambar.',
            'photo_mimes'            => 'Gambar harus berupa file dengan tipe: jpeg, png, jpg, atau gif.',
            'photo_max'              => 'Ukuran gambar tidak boleh melebihi 2MB.',
        ],
    ]

];
