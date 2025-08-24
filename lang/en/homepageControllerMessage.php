<?php

return [
    'index' => [
        'title'       => 'Home | Homepage',
    ],

    'cleaning' => [
        'title'       => 'Cleaning Input | Homepage',
        'validation' => [
            'building_required'      => 'Building must be selected.',
            'building_id_exists'     => 'Building not found.',
            'oa_required'            => 'OA value is required.',
            'ov_required'            => 'OV value is required.',
            'stay_required'          => 'Stay value is required.',
            'vec_required'           => 'Vec value is required.',
            'total_room_required'    => 'Total room is required.',
            'members_required'       => 'At least one member must be selected.',
            
            'building_exists'        => 'Selected building not found.',
            'oa_integer'             => 'OA must be a number.',
            'oa_min'                 => 'OA cannot be negative.',
            'ov_integer'             => 'OV must be a number.',
            'ov_min'                 => 'OV cannot be negative.',
            'stay_integer'           => 'Stay must be a number.',
            'stay_min'               => 'Stay cannot be negative.',
            'vec_integer'            => 'Vec must be a number.',
            'vec_min'                => 'Vec cannot be negative.',
            'total_room_integer'     => 'Total room must be a number.',
            'total_room_min'         => 'Total room cannot be negative.',
            'members_array'          => 'Members must be in array format.',
            'members_exists'         => 'Selected member not found.',

            'date_required' => 'The date field is required.',
            'date_date'     => 'The date format is invalid.',
        ],
        'warning_formula'  => 'Formula is not available for this building and number of members.',
        'success_store'    => 'Data has been successfully saved.',
    ],

    'checker' => [
        'title' => 'Checker Input | Homepage',
        'validation' => [
            'user_id_required'       => 'Staff name is required.',
            'user_id_exists'         => 'Staff not found.',
            'date_required'          => 'Date is required.',
            'date_date'              => 'Invalid date format.',
            'jumlah_kamar_required'  => 'Number of rooms is required.',
            'jumlah_kamar_integer'   => 'Number of rooms must be a number.',
            'jumlah_kamar_min'       => 'Number of rooms cannot be less than 0.',
        ],
        'error_no_formula'         => 'System error: formula not available.',
        'success_store'            => 'Data has been successfully saved!',
    ],

    'office' => [
        'title' => 'Office Input | Homepage',
            'validation' => [
                'user_id_required'       => 'Staff name is required.',
                'user_id_exists'         => 'Staff not found.',
                'date_required'          => 'Date is required.',
                'date_date'              => 'Invalid date format.',
                'tasks_required'         => 'At least one task must be selected.',
                'tasks_array'            => 'Tasks must be in array format.',
                'task_group_id_required' => 'Task group must be selected.',
                'task_group_id_exists'   => 'Selected task group not found.',
            ],
        'success_store' => 'Data has been successfully saved!',
        ],

        'history' => [
            'title' => 'History Data | Homepage',
        ],

        'report' => [
            'title' => 'Make Report | Homepage',
            'validation' => [
                'user_id_required'     => 'User must be selected.',
                'user_id_exists'       => 'Selected user not found.',
                'report_type_required' => 'Report type is required.',
                'report_type_string'   => 'Report type must be a string.',
                'report_type_max'      => 'Report type must not exceed 255 characters.',
                'description_required' => 'Description is required.',
                'description_string'   => 'Description must be a string.',
                'photos_image'         => 'Each photo must be an image.',
                'photos_mimes'         => 'Photo must be a file of type: jpeg, png, jpg, gif.',
                'photos_max'           => 'Photo size must not exceed 2MB.',
                'videos_mimetypes'     => 'Video must be a valid video file (mp4, avi, mpeg, quicktime).',
                'videos_max'           => 'Video size must not exceed 100MB.',
                'members_array'        => 'Members must be an array.',
                'members_exists'       => 'Selected member not found.',
                'date_required'        => 'Date is required.',
                'date_date'            => 'Date format is invalid.',
            ],
            'success_store' => 'Report has been successfully saved.',
            'failed_store'  => 'Failed to save report: :message',
        ],

        'reportHistory' => [
            'title' => 'Report History | Homepage',
        ]


];
