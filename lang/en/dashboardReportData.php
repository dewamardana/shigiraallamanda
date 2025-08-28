<?php

return [
    'title' => 'Report Dashboard',

    'table' => [
        'reporter_name' => 'Reporter Name',
        'report_type'   => 'Report Type',
        'date'          => 'Date',
        'description'   => 'Description',
        'media'         => 'Media',
        'member_name'   => 'Member Name',
        'point'         => 'Point',
        'action'        => 'Action',
        'no_data'       => 'No reports available.',
    ],

    'form' => [
        'reply_placeholder' => 'Write a reply...',
        'point_placeholder' => 'Point',
    ],

    'controller' => [
        'index' => [
            'title' => 'Report Data | Dashboard',
        ],

        'reply' => [
            'success_reply' => 'The reply and points have been successfully awarded.',
        ]
    ]
];
