<?php

return [
    'index' => [
        'title'  => '📋 Building Data',
        'table' => [
            'photo'        => 'Photo',
            'name'         => 'Name',
            'description'  => 'Description',
            'action'       => 'Action',
            'edit'         => 'Edit',
        ],
    ],

    'form' => [
        'building_image'      => 'Building Image',
        'image_hint'          => 'Click image to replace',
        'image_upload'        => 'Upload file',
        'upload_hint'         => 'SVG, PNG, JPG or GIF (Ratio 1:1).',
        'building_name'       => 'Building Name',
        'description'         => 'Description',
    ],

    'create' => [
        'title'               => 'Add Building',
    ],

    'edit' => [
        'title'               => 'Edit Building',
    ],
    'controller' => [
        'index' => [
            'title'   => 'Building Page | Dashboard',
        ],
        'create' => [
            'title'   => 'Add Building | Dashboard',
            'success_add'   => 'Building has been successfully added!',
        ],
        'show' => [
            'title'   => 'Building Details | Dashboard',
        ],
        'edit' => [
            'title'   => 'Edit Building | Dashboard',
            'success_update' => 'Building has been successfully updated!',
        ],
        'delete' => [
            'success_delete' => 'Building data has been successfully deleted!',
        ],

        'validation' => [
            'building_name_required' => 'Building name is required.',
            'slug_required'          => 'Slug is required.',
            'slug_unique'            => 'Slug has already been taken.',
            'description_required'   => 'Description is required.',
            'photo_image'            => 'The uploaded file must be an image.',
            'photo_mimes'            => 'The image must be a file of type: jpeg, png, jpg, or gif.',
            'photo_max'              => 'The image size must not exceed 2MB.',
        ],
    ]

];
