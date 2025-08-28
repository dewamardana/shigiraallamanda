<?php

return [
    'title' => 'Dashboard Laporan',

    'table' => [
        'reporter_name' => 'Nama Pelapor',
        'report_type'   => 'Jenis Laporan',
        'date'          => 'Tanggal',
        'description'   => 'Deskripsi',
        'media'         => 'Media',
        'member_name'   => 'Nama Anggota',
        'point'         => 'Poin',
        'action'        => 'Aksi',
        'no_data'       => 'Tidak ada laporan tersedia.',
    ],

    'form' => [
        'reply_placeholder' => 'Tulis balasan...',
        'point_placeholder' => 'Poin',
    ],

    'controller' => [
        'index' => [
            'title' => 'Data Laporan | Dashboard',
        ],

        'reply' => [
            'success_reply' => 'Balasan dan poin berhasil diberikan.',
        ]
    ]
];
