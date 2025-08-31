<?php

return [
   'index' => [
        'title'  => '📊 រូបមន្តទិន្នន័យ',

        'table' => [
            'building'     => 'អាគារ',
            'member'       => 'សមាជិក',
            'oa'           => 'OA',
            'ov'           => 'OV',
            'stay'         => 'ស្នាក់នៅ',
            'vec'          => 'Vec',
            'premier'      => 'Premier',
            'action'       => 'សកម្មភាព',
        ],
    ],
    'create' => [
        'title'                 => 'បន្ថែមរូបមន្ត',
    ],

    'form' => [
        'building_label'        => 'ឈ្មោះអាគារ',
        'building_placeholder'  => 'ជ្រើសរើសអាគារ',
        'member_label'          => "ចំនួនសមាជិក (លេខ ឬ 'ចៃដន្យ')",
        'oa_label'              => 'OA',
        'ov_label'              => 'OV',
        'stay_label'            => 'ស្នាក់នៅ',
        'vec_label'             => 'Vec',
        'premier_label'         => 'Premier',
    ],
    'edit' => [
        'title'                 => 'កែសម្រួលរូបមន្ត',
    ],
    'show' => [
        'title'          => 'ព័ត៌មានលម្អិតរូបមន្ត',
        'building_name'  => 'ឈ្មោះអាគារ',
        'member_count'   => 'ចំនួនសមាជិក',
        'oa'             => 'OA',
        'ov'             => 'OV',
        'stay'           => 'ស្នាក់នៅ',
        'vec'            => 'Vec',
        'premier'        => 'Premier',
    ],
    'controller' => [
        'index' => [
            'title' => 'រូបមន្តទិន្នន័យ | ផ្ទៃតាប្លូប្រចាំថ្ងៃ',
        ],
        'create' => [
            'title' => 'បន្ថែមរូបមន្ត | ផ្ទៃតាប្លូប្រចាំថ្ងៃ',
            'success_add'      => 'រូបមន្តត្រូវបានបន្ថែមដោយជោគជ័យ!',
        ],
        'edit' => [
            'title' => 'កែសម្រួលរូបមន្ត | ផ្ទៃតាប្លូប្រចាំថ្ងៃ',
            'success_update'   => 'រូបមន្តត្រូវបានធ្វើបច្ចុប្បន្នភាពដោយជោគជ័យ!',
        ],
        'show' => [
            'title' => 'ព័ត៌មានលម្អិតរូបមន្ត | ផ្ទៃតាប្លូប្រចាំថ្ងៃ',
        ],
        'delete' => [
            'title' => '',
            'success_delete'   => 'រូបមន្តត្រូវបានលុបដោយជោគជ័យ!',
        ],
        'validation' => [
            'building_slug_required' => 'ស្លាកអាគារគឺជាចំបាច់។',
            'member_count_required'  => 'ចំនួនសមាជិកគឺជាចំបាច់។',
            'oa_required'            => 'តម្លៃ OA គឺជាចំបាច់។',
            'ov_required'            => 'តម្លៃ OV គឺជាចំបាច់។',
            'stay_required'          => 'តម្លៃស្នាក់នៅគឺជាចំបាច់។',
            'vec_required'           => 'តម្លៃ Vec គឺជាចំបាច់។',
            'premier_numeric'        => 'តម្លៃ Premier ត្រូវតែជាលេខ។',
        ],
    ],
];
