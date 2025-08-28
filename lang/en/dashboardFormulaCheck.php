<?php

return [
    'index' => [
        'title' => 'Formula List',

        'table' => [
            'name'           => 'Formula Name',
            'description'    => 'Description',
            'status'         => 'Status',
            'action'         => 'Action',
            'active'   => 'Active',
            'inactive' => 'Inactive',
            'delete_confirm' => 'Are you sure you want to delete this formula?',
        ],

    ],

    'form' => [
        'name'                => 'Formula Name',
        'description'         => 'Description',
        'active'              => 'Active',
        'jumlah_kamar'        => 'Number of Rooms',
        'mengajar'            => 'Teaching',
        'pembersihan_khusus'  => 'Special Cleaning',
        'mengangkat_barang'   => 'Carrying Goods',
        'membersihkan_gudang' => 'Warehouse Cleaning',
        'obat_pool'           => 'Pool Chemicals',
        'membersihkan_pool'   => 'Pool Cleaning',
        'sampah'              => 'Trash',
    ],

    'create' => [
        'title' => 'Add Formula Check',
    ],

    'edit' => [
        'title' => 'Edit Formula Check',
    ],

    'show' => [
        'title' => 'Show Formula Check',
    ],

    'controller' => [
        'index' => [
            'title' => 'Formula Check | Homepage',
        ],

        'create' => [
            'title' => 'Formula Check Create | Homepage',
            'success_create' => 'The formula has been successfully added.',
        ],

        'show' => [
            'title' => 'Detail Formula Check | Homepage',
        ],

        'edit' => [
            'title' => 'Formula Check Edit | Homepage',
            'error_edit' => 'At least one formula must remain active.',
            'success_edit' => 'The formula has been successfully updated.',
        ],

        'delete' => [
            'error_delete' => 'Formulas that are still active cannot be deleted.',
            'success_delete' => 'The formula data has been successfully deleted.',
        ],

        'validation' => [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',

            'jumlah_kamar.required' => 'The number of rooms is required.',
            'jumlah_kamar.numeric' => 'The number of rooms must be a number.',

            'mengajar.required' => 'The teaching value is required.',
            'mengajar.numeric' => 'The teaching value must be a number.',

            'pembersihan_khusus.required' => 'The special cleaning value is required.',
            'pembersihan_khusus.numeric' => 'The special cleaning value must be a number.',

            'mengangkat_barang.required' => 'The lifting items value is required.',
            'mengangkat_barang.numeric' => 'The lifting items value must be a number.',

            'membersihkan_gudang.required' => 'The warehouse cleaning value is required.',
            'membersihkan_gudang.numeric' => 'The warehouse cleaning value must be a number.',

            'obat_pool.required' => 'The pool treatment value is required.',
            'obat_pool.numeric' => 'The pool treatment value must be a number.',

            'membersihkan_pool.required' => 'The pool cleaning value is required.',
            'membersihkan_pool.numeric' => 'The pool cleaning value must be a number.',

            'sampah.required' => 'The trash value is required.',
            'sampah.numeric' => 'The trash value must be a number.',
        ]
    ],

];
