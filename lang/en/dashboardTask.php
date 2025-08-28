<?php

return [
    'show' => [
        'title' => '📋 Tasks for ":name"',

    ],
    'table' => [
        'task_name' => 'Task Name',
        'point'     => 'Point',
        'action'    => 'Action',
    ],

    'form' => [
        'task_name' => 'Task Name',
        'point'     => 'Point',
        'placeholder_point' => '0',
    ],

    'create' => [
        'title' => 'Add Task for ":name"',
    ],

    'edit' => [
        'title' => 'Edit Task ":name"',
    ],

    'controller' => [
        'create' => [
            'title' => 'add Task | Dashboard',
            'success_add' =>  'Task successfully added.',
        ],

        'edit' => [
            'title' => 'Edit Task | Dashboard',
            'success_update' =>  'Task successfully updated.',
        ],

        'delete' => [
            'success_delete' =>  'Task successfully deleted.',
        ],
    ],




    'validation' => [
        'required' => 'This field is required',
        'number'   => 'Please enter a valid number',
    ],
];
