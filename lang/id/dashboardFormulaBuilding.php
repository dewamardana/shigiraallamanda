<?php

return [
    'index' => [
        'title'  => '📊 Data Formula',

        'table' => [
            'building'     => 'Gedung',
            'member'       => 'Anggota',
            'oa'           => 'OA',
            'ov'           => 'OV',
            'stay'         => 'Stay',
            'vec'          => 'Vec',
            'premier'      => 'Premier',
            'action'       => 'Aksi',
        ],
    ],
    'create' => [
        'title'                 => 'Tambah Formula',
    ],

    'form' => [
        'building_label'        => 'Nama Gedung',
        'building_placeholder'  => 'Pilih Gedung',
        'member_label'          => "Jumlah Anggota (angka atau 'random')",
        'oa_label'              => 'OA',
        'ov_label'              => 'OV',
        'stay_label'            => 'Stay',
        'vec_label'             => 'Vec',
        'premier_label'         => 'Premier',
    ],
    'edit' => [
        'title'                 => 'Edit Formula',
    ],
    'show' => [
        'title'          => 'Detail Formula',
        'building_name'  => 'Nama Gedung',
        'member_count'   => 'Jumlah Anggota',
        'oa'             => 'OA',
        'ov'             => 'OV',
        'stay'           => 'Stay',
        'vec'            => 'Vec',
        'premier'        => 'Premier',
    ],
    'controller' => [
        'index' => [
            'title' => 'Data Formula | Dashboard',
        ],
        'create' => [
            'title' => 'Tambah Formula | Dashboard',
            'success_add'      => 'Formula berhasil ditambahkan!',
        ],
        'edit' => [
            'title' => 'Edit Formula | Dashboard',
            'success_update'   => 'Formula berhasil diperbarui!',
        ],
        'show' => [
            'title' => 'Detail Formula | Dashboard',
        ],
        'delete' => [
            'title' => '',
            'success_delete'   => 'Formula berhasil dihapus!',
        ],
        'validation' => [
            'building_slug_required' => 'Slug gedung wajib diisi.',
            'member_count_required'  => 'Jumlah anggota wajib diisi.',
            'oa_required'            => 'Nilai OA wajib diisi.',
            'ov_required'            => 'Nilai OV wajib diisi.',
            'stay_required'          => 'Nilai Stay wajib diisi.',
            'vec_required'           => 'Nilai Vec wajib diisi.',
            'premier_numeric'        => 'Nilai Premier harus berupa angka.',
        ],
    ],
];
