<?php

return [
    'cleaningdata' => [
        'title'            => 'Dashboard Data Cleaning',
        'filter_building'  => 'Gedung:',
        'filter_all'       => 'Semua Gedung',
        'filter_user'      => 'Filter berdasarkan User',
        'members' => 'Anggota',
        'table' => [
            'date'      => 'Tanggal',
            'name'      => 'Nama',
            'oa'        => 'OA',
            'ov'        => 'OV',
            'stay'      => 'Stay',
            'vec'       => 'Vec',
            'premier'   => 'Premier',
            'total'     => 'Total',
            'point'     => 'Poin',
            'total_info' => 'Total',
            'member' => 'anggota',
        ],
    ],

    'checkdata' => [
        'title' => 'Data Checker',
        'user' => 'Pengguna',
        'all'  => 'Semua',
        'table' => [
            'date'       => 'Tanggal',
            'name'       => 'Nama',
            'room'       => 'Kamar',
            'total'      => 'Total',
            'no_data'    => 'Data tidak ditemukan.',
        ],
    ],
    'officedata' => [
        'title'        => '📋 Data Office',
        'table' => [
            'no'         => 'No',
            'date'       => 'Tanggal',
            'user'       => 'Pengguna',
            'task_group' => 'Grup Tugas',
            'task_point' => 'Tugas & Poin',
            'total'      => 'Total Poin',
            'empty'      => 'Tidak ada data office records.',
        ],

    ],

    'userpoint' => [
        'title'         => 'Rekap Poin Bulanan',
        'filter_year'   => 'Tahun',
        'filter_month'  => 'Bulan',
        'table' => [
            'no'      => 'No',
            'name'    => 'Nama',
            'day'     => 'Hari',
            'total'   => 'Total',
        ],
    ],

    'cleaningHistory' => [
        'title' => 'Data Cleaning',
        'cleaning_title' => '📊 Menampilkan Semua Data Input Cleaning.',
        'checker_title' => '📊 Menampilkan Semua Data Checking dan Office.',
        'table' => [
            'no' => 'No',
            'date' => 'Tanggal',
            'input_by' => 'Diinput Oleh',
            'building' => 'Gedung',
            'oa' => 'OA',
            'ov' => 'OV',
            'stay' => 'Stay',
            'vec' => 'Vec',
            'premier' => 'Premier',
            'total_room' => 'Total Kamar',
            'total_point' => 'Total Poin',
            'point_per_member' => 'Poin per Anggota',
            'members' => 'Anggota',
            'no_data' => 'Tidak ada data.',
        ],
    ],

    'checkRecords' => [
        'title' => 'Data Checker dan Office',
        'table' => [
            'no' => 'No',
            'date' => 'Tanggal',
            'type' => 'Tipe',
            'input_by' => 'Diinput Oleh',
            'total_point' => 'Total Poin',
            'point_per_member' => 'Poin / Anggota',
            'no_data' => 'Tidak ada data',
        ],
    ],
    'controller' => [
        'indextitle' => 'Dashboard Data Cleaning',
        // Header exportCleaningData
        'header_name_member'  => 'Nama Anggota',
        'header_oa'           => 'OA',
        'header_ov'           => 'OV',
        'header_stay'         => 'Stay',
        'header_vec'          => 'Vec',
        'header_premier'      => 'Premier',
        'header_total'        => 'Total',
        'header_name_member2' => 'Nama Anggota',
        'header_poin'         => 'Poin',

        //Header Office Data Export

        'header_date'        => 'Tanggal',
        'header_user'        => 'User',
        'header_task_group'  => 'Grup Tugas',
        'header_task'        => 'Tugas',
        'header_point'       => 'Poin',
        'header_total_point' => 'Total Poin',


        // Header exportRekapBulanan
        'header_no'           => 'No',
        'header_nama'         => 'Nama',
        'header_day'          => 'Hari',
        'header_total_poin'   => 'Total Poin',

        // Filename
        'filename_cleaning'   => 'Laporan Cleaning',
        'filename_rekap'      => 'Laporan Bulanan',
        'checkerDataTitle' => 'Data Poin Checker | Dashboard',

        'no_active_formula' => 'Tidak ada formula aktif yang ditemukan.',
        'filename' => 'Laporan_Checker.xlsx',

        'headers' => [
            'no' => 'No',
            'date' => 'Tanggal',
            'name' => 'Nama',
            'room_count' => 'Jumlah Kamar',
            'total_points' => 'Total Poin',
        ],
        'officedata' => [
            'title' => 'Data Office | Dashboard',
        ],
        'userPoint' => [
            'title' => 'Ringkasan Poin Anggota | Dashboard',
        ],
        'CleaningHistoryData' => [
            'title' => 'Riwayat Input Cleaning',
        ],
        'CheckOfficeHistoryData' => [
            'title' => 'Riwayat Checker dan Office | Dashboard',
        ],
    ],


];
