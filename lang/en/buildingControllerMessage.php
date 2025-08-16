<?php

return [
    // Title & Page Headings
    'title_index'   => 'Building Page | Dashboard',
    'title_create'  => 'Add Building | Dashboard',
    'title_show'    => 'Building Details | Dashboard',
    'title_edit'    => 'Edit Building | Dashboard',

    // Success Messages
    'success_add'   => 'Building has been successfully added!',
    'success_update'=> 'Building has been successfully updated!',
    'success_delete'=> 'Building data has been successfully deleted!',

    // Validation Error Messages
    'validation' => [
        'building_name_required' => 'Building name is required.',
        'slug_required'          => 'Slug is required.',
        'slug_unique'            => 'Slug has already been taken.',
        'description_required'   => 'Description is required.',
        'photo_image'            => 'The uploaded file must be an image.',
        'photo_mimes'            => 'The image must be a file of type: jpeg, png, jpg, or gif.',
        'photo_max'              => 'The image size must not exceed 2MB.',
    ],
];
