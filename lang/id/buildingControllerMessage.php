<?php

return [
    // Title & Page Headings
    'title_index'   => 'Halaman Building | Dashboard',
    'title_create'  => 'Tambah Building | Dashboard',
    'title_show'    => 'Detail Building | Dashboard',
    'title_edit'    => 'Edit Building | Dashboard',

    // Success Messages
    'success_add'   => 'Building berhasil ditambahkan!',
    'success_update'=> 'Building berhasil diperbarui!',
    'success_delete'=> 'Data building berhasil dihapus!',

    // Validation Error Messages
    'validation' => [
        'building_name_required' => 'Nama building wajib diisi.',
        'slug_required'          => 'Slug wajib diisi.',
        'slug_unique'            => 'Slug sudah digunakan.',
        'description_required'   => 'Deskripsi wajib diisi.',
        'photo_image'            => 'File yang diunggah harus berupa gambar.',
        'photo_mimes'            => 'Format gambar harus jpeg, png, jpg, atau gif.',
        'photo_max'              => 'Ukuran gambar maksimal 2MB.',
    ],
];
