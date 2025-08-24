<?php

return [
    'index' => [
        'title'  => '📊 Formula Data',

        'table' => [
            'building'     => 'Building',
            'member'       => 'Member',
            'oa'           => 'OA',
            'ov'           => 'OV',
            'stay'         => 'Stay',
            'vec'          => 'Vec',
            'premier'      => 'Premier',
            'action'       => 'Action',
        ],
    ],
    'create' => [
        'title'                 => 'Add Formula',
    ],

    'form' => [
        'building_label'        => 'Building Name',
        'building_placeholder'  => 'Select Building',
        'member_label'          => "Member Count (number or 'random')",
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
        'title'          => 'Formula Detail',
        'building_name'  => 'Building Name',
        'member_count'   => 'Member Count',
        'oa'             => 'OA',
        'ov'             => 'OV',
        'stay'           => 'Stay',
        'vec'            => 'Vec',
        'premier'        => 'Premier',
    ],
    'controller' => [
        'index' => [
            'title' => 'Formula Data | Dashboard',
        ],
        'create' => [
            'title' => 'Add Formula | Dashboard',
            'success_add'      => 'Formula has been successfully added!',
        ],
        'edit' => [
            'title' => 'Edit Formula | Dashboard',
            'success_update'   => 'Formula has been successfully updated!',
        ],
        'show' => [
            'title' => 'Formula Details | Dashboard',
        ],
        'delete' => [
            'title' => '',
            'success_delete'   => 'Formula has been successfully deleted!',
        ],
        'validation' => [
            'building_slug_required' => 'Building slug is required.',
            'member_count_required'  => 'Member count is required.',
            'oa_required'            => 'OA value is required.',
            'ov_required'            => 'OV value is required.',
            'stay_required'          => 'Stay value is required.',
            'vec_required'           => 'Vec value is required.',
            'premier_numeric'        => 'Premier value must be a number.',
        ],
    ],
];
