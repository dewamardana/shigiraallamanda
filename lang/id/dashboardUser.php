<?php

return [
    'index' => [
        'title' => '📋 Data Pekerja',
        'new_worker' => 'Tambah Pekerja',
        'table' => [
            'name' => 'Nama',
            'department' => 'Departemen',
            'gender' => 'Jenis Kelamin',
            'status' => 'Status',
            'action' => 'Aksi',
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
        ],
    ],

    'form' => [
        'profile_photo' => 'Foto Profil',
        'photo_hint' => 'Klik gambar untuk mengganti foto',
        'photo_upload' => 'Unggah Foto',
        'upload_hint' => 'SVG, PNG, JPG atau GIF (Rasio 1:1).',
        'name' => 'Nama',
        'username' => 'Username',
        'email' => 'Email',
        'phone_number' => 'Nomor Telepon',
        'department' => 'Departemen',
        'gender' => 'Jenis Kelamin',
        'male' => 'Laki-laki',
        'female' => 'Perempuan',
        'status' => 'Status',
        'active' => 'Aktif',
        'inactive' => 'Tidak Aktif',
        'password' => 'Kata Sandi',
        'role'  => 'Peran',
        'skill' => 'Keahlian',

        'name_placeholder' => 'Masukkan nama lengkap',
        'username_placeholder' => 'Masukkan username',
        'email_placeholder' => 'Masukkan alamat email aktif',
        'phone_placeholder' => 'Nomor telepon aktif',
        'department_placeholder' => 'Masukkan nama departemen',
        'password_placeholder' => 'Masukkan kata sandi',
        'password_hint'       => 'Biarkan kosong jika tidak ingin mengubah kata sandi.',
    ],

    'create' => [
        'title' => 'Tambah Pekerja',
    ],

    'edit' => [
        'title' => 'Ubah Pekerja',
    ],

    'show' => [
        'title' => 'Detail Pekerja',
    ],

    'controller' => [
        'index' => [
            'title' => 'Halaman Pekerja | Dashboard',
        ],

        'create' => [
            'title' => 'Tambah Pekerja | Dashboard',
        ],

        'store' => [
            'name_required'        => 'Nama wajib diisi.',
            'username_required'    => 'Username wajib diisi.',
            'username_unique'      => 'Username ini sudah digunakan. Silakan pilih yang lain.',
            'email_required'       => 'Alamat email wajib diisi.',
            'email_unique'         => 'Email ini sudah terdaftar.',
            'password_required'    => 'Kata sandi wajib diisi.',
            'password_min'         => 'Kata sandi harus minimal 6 karakter.',
            'phone_required'       => 'Nomor telepon wajib diisi.',
            'gender_in'            => 'Silakan pilih jenis kelamin yang valid.',
            'photo_error'          => 'File yang dipilih harus berupa gambar.',
            'photo_mimes'          => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'photo_max'            => 'Ukuran foto tidak boleh lebih dari 2MB.',
            'success_add'          => 'Data pekerja berhasil ditambahkan!',
        ],

        'edit' => [
            'title' => 'Ubah Pekerja | Dashboard',
        ],

        'upload' => [
            'name_required'        => 'Nama wajib diisi.',
            'username_required'    => 'Username wajib diisi.',
            'username_unique'      => 'Username ini sudah digunakan. Silakan pilih yang lain.',
            'email_required'       => 'Alamat email wajib diisi.',
            'email_unique'         => 'Email ini sudah terdaftar.',
            'password_required'    => 'Kata sandi wajib diisi.',
            'password_min'         => 'Kata sandi harus minimal 6 karakter.',
            'phone_required'       => 'Nomor telepon wajib diisi.',
            'gender_in'            => 'Silakan pilih jenis kelamin yang valid.',
            'photo_error'          => 'File yang dipilih harus berupa gambar.',
            'photo_mimes'          => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'photo_max'            => 'Ukuran foto tidak boleh lebih dari 2MB.',
            'role_required'        => 'Peran harus dipilih.',
            'role_in'              => 'Peran harus berupa user atau admin.',
            'success_edit'         => 'Data berhasil diperbarui.',
        ],

        'show' => [
            'title' => 'Detail Pekerja | Dashboard',
        ],

        'delete' => [
            'success_deleted'   => 'Data pekerja berhasil dihapus.',
        ]
    ]
];
