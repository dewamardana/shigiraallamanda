<?php

return [
    'title' => 'Pengaturan',

    // Tabs
    'tabs' => [
        'roles' => 'Peran',
        'skills' => 'Keahlian',
        'report_types' => 'Jenis Laporan',
    ],

    // Form placeholders
    'placeholders' => [
        'role_name' => 'Nama peran',
        'skill_name' => 'Nama keahlian',
        'report_type_name' => 'Nama jenis laporan',
    ],

    // Buttons
    'buttons' => [
        'add' => 'Tambah',
        'delete' => 'Hapus',
    ],

    // Confirmation
    'confirm' => [
        'delete_role' => 'Hapus peran ini?',
        'delete_skill' => 'Hapus keahlian ini?',
        'delete_report_type' => 'Hapus jenis laporan ini?',
    ],

    'controller' => [
        'index' => [
            'title' => 'Tambah Nilai | Dashboard',
        ],

        'create' => [
            'success_add_role' => 'Peran berhasil ditambahkan',
            'success_add_skill' => 'Keahlian berhasil ditambahkan',
            'success_add_report' => 'Jenis laporan berhasil ditambahkan',
        ],

        'delete' => [
            'success_delete_role' => 'Peran berhasil dihapus',
            'success_delete_skills' => 'Keahlian berhasil dihapus',
            'success_delete_report' => 'Jenis laporan berhasil dihapus',
        ],
    ]
];
