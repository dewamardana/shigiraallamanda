<?php

return [
    'index' => [
        'title'  => '📋 ទិន្នន័យអាគារ',
        'table' => [
            'photo'        => 'រូបភាព',
            'name'         => 'ឈ្មោះ',
            'description'  => 'ការពិពណ៌នា',
            'action'       => 'សកម្មភាព',
            'edit'         => 'កែប្រែ',
        ],
    ],

    'form' => [
        'building_image'      => 'រូបភាពអាគារ',
        'image_hint'          => 'ចុចរូបភាពដើម្បីផ្លាស់ប្ដូរ',
        'image_upload'        => 'ផ្ទុកឡើងឯកសារ',
        'upload_hint'         => 'SVG, PNG, JPG ឬ GIF (សមាមាត្រ 1:1)',
        'building_name'       => 'ឈ្មោះអាគារ',
        'description'         => 'ការពិពណ៌នា',
    ],

    'create' => [
        'title'               => 'បន្ថែមអាគារ',
    ],

    'edit' => [
        'title'               => 'កែប្រែអាគារ',
    ],
    'controller' => [
        'index' => [
            'title'   => 'ទំព័រអាគារ | ផ្ទាំងគ្រប់គ្រង',
        ],
        'create' => [
            'title'   => 'បន្ថែមអាគារ | ផ្ទាំងគ្រប់គ្រង',
            'success_add'   => 'បានបន្ថែមអាគារដោយជោគជ័យ!',
        ],
        'show' => [
            'title'   => 'ព័ត៌មានលម្អិតអាគារ | ផ្ទាំងគ្រប់គ្រង',
        ],
        'edit' => [
            'title'   => 'កែប្រែអាគារ | ផ្ទាំងគ្រប់គ្រង',
            'success_update' => 'អាគារត្រូវបានធ្វើបច្ចុប្បន្នភាព!',
        ],
        'delete' => [
            'success_delete' => 'ទិន្នន័យអាគារត្រូវបានលុប!',
        ],

        'validation' => [
            'building_name_required' => 'ឈ្មោះអាគារត្រូវតែបំពេញ។',
            'slug_required'          => 'Slug ត្រូវតែបំពេញ។',
            'slug_unique'            => 'Slug ត្រូវបានប្រើរួចហើយ។',
            'description_required'   => 'ការពិពណ៌នាត្រូវតែបំពេញ។',
            'photo_image'            => 'ឯកសារដែលបានផ្ទុកឡើងត្រូវតែជារូបភាព។',
            'photo_mimes'            => 'រូបភាពត្រូវតែមានទម្រង់: jpeg, png, jpg, ឬ gif។',
            'photo_max'              => 'ទំហំរូបភាពមិនអាចលើសពី 2MB។',
        ],
    ]

];
