<?php

return [
    'index' => [
        'title'       => 'Beranda | Homepage',
    ],

    'cleaning' => [
        'title'       => 'Input Cleaning | Homepage',
        'validation' => [
            'building_required'      => 'Gedung harus dipilih.',
            'building_id_exists'     => 'Gedung tidak ditemukan.',
            'oa_required'            => 'Nilai OA wajib diisi.',
            'ov_required'            => 'Nilai OV wajib diisi.',
            'stay_required'          => 'Nilai Stay wajib diisi.',
            'vec_required'           => 'Nilai Vec wajib diisi.',
            'total_room_required'    => 'Jumlah kamar wajib diisi.',
            'members_required'       => 'Minimal satu anggota harus dipilih.',

            'building_exists'        => 'Gedung yang dipilih tidak ditemukan.',
            'oa_integer'             => 'OA harus berupa angka.',
            'oa_min'                 => 'OA tidak boleh negatif.',
            'ov_integer'             => 'OV harus berupa angka.',
            'ov_min'                 => 'OV tidak boleh negatif.',
            'stay_integer'           => 'Stay harus berupa angka.',
            'stay_min'               => 'Stay tidak boleh negatif.',
            'vec_integer'            => 'Vec harus berupa angka.',
            'vec_min'                => 'Vec tidak boleh negatif.',
            'total_room_integer'     => 'Jumlah kamar harus berupa angka.',
            'total_room_min'         => 'Jumlah kamar tidak boleh negatif.',
            'members_array'          => 'Anggota harus dalam format array.',
            'members_exists'         => 'Anggota yang dipilih tidak ditemukan.',

            'date_required' => 'Tanggal wajib diisi.',
            'date_date'     => 'Format tanggal tidak valid.',
        ],
        'warning_formula'  => 'Formula tidak tersedia untuk gedung dan jumlah anggota ini.',
        'success_store'    => 'Data berhasil disimpan.',
    ],

    'checker' => [
        'title' => 'Input Checker | Homepage',
        'validation' => [
            'user_id_required'       => 'Nama staf wajib diisi.',
            'user_id_exists'         => 'Staf tidak ditemukan.',
            'date_required'          => 'Tanggal wajib diisi.',
            'date_date'              => 'Format tanggal tidak valid.',
            'jumlah_kamar_required'  => 'Jumlah kamar wajib diisi.',
            'jumlah_kamar_integer'   => 'Jumlah kamar harus berupa angka.',
            'jumlah_kamar_min'       => 'Jumlah kamar tidak boleh kurang dari 0.',
        ],
        'error_no_formula'         => 'Kesalahan sistem: formula tidak tersedia.',
        'success_store'            => 'Data berhasil disimpan!',
    ],

    'office' => [
        'title' => 'Input Office | Homepage',
        'validation' => [
            'user_id_required'       => 'Nama staf wajib diisi.',
            'user_id_exists'         => 'Staf tidak ditemukan.',
            'date_required'          => 'Tanggal wajib diisi.',
            'date_date'              => 'Format tanggal tidak valid.',
            'tasks_required'         => 'Minimal satu tugas harus dipilih.',
            'tasks_array'            => 'Tugas harus dalam format array.',
            'task_group_id_required' => 'Grup tugas harus dipilih.',
            'task_group_id_exists'   => 'Grup tugas yang dipilih tidak ditemukan.',
        ],
        'success_store' => 'Data berhasil disimpan!',
    ],

    'history' => [
        'title' => 'Data Riwayat | Homepage',
    ],

    'report' => [
        'title' => 'Buat Laporan | Homepage',
        'validation' => [
            'user_id_required'     => 'Pengguna harus dipilih.',
            'user_id_exists'       => 'Pengguna yang dipilih tidak ditemukan.',
            'report_type_required' => 'Jenis laporan wajib diisi.',
            'report_type_string'   => 'Jenis laporan harus berupa teks.',
            'report_type_max'      => 'Jenis laporan tidak boleh lebih dari 255 karakter.',
            'description_required' => 'Deskripsi wajib diisi.',
            'description_string'   => 'Deskripsi harus berupa teks.',
            'photos_image'         => 'Setiap foto harus berupa gambar.',
            'photos_mimes'         => 'Foto harus berupa file dengan tipe: jpeg, png, jpg, gif.',
            'photos_max'           => 'Ukuran foto tidak boleh lebih dari 2MB.',
            'videos_mimetypes'     => 'Video harus berupa file valid (mp4, avi, mpeg, quicktime).',
            'videos_max'           => 'Ukuran video tidak boleh lebih dari 100MB.',
            'members_array'        => 'Anggota harus berupa array.',
            'members_exists'       => 'Anggota yang dipilih tidak ditemukan.',
            'date_required'        => 'Tanggal wajib diisi.',
            'date_date'            => 'Format tanggal tidak valid.',
        ],
        'success_store' => 'Laporan berhasil disimpan.',
        'failed_store'  => 'Gagal menyimpan laporan: :message',
    ],

    'reportHistory' => [
        'title' => 'Riwayat Laporan | Homepage',
    ]
];
