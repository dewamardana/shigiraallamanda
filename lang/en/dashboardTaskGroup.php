<?php

return [
    'index' => [
        'title' => 'Office Task',
    ],

    'table' => [
        'name' => 'Group Name',
        'status' => 'Status',
        'action' => 'Action',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'show' => 'Show',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'delete_confirm' => 'Are you sure you want to delete this group?',
    ],

    'create' => [
        'title' => 'Add Task Group',
    ],

    'form' => [
        'name' => 'Group Name',
        'active' => 'Active',
    ],
    'edit' => [
        'title' => 'Edit Task Group',
    ],

    'controller' => [
        'index' => [
            'title' => 'Task Group Active | Dashboard',
        ],

        'create' => [
            'title' => 'Task Group Create| Dashboard ',
            'success_add' => 'Task group created successfully.',
        ],

        'show' => [
            'title' => 'Task Group Active | Dashboard',
        ],

        'edit' => [
            'title' => 'Task Group Edit | Dashboard',
            'error_edit' => 'Cannot disable all tasks. At least one task must remain active.',
            'success_edit' => 'Task group updated successfully.',
        ],

        'delete' => [
            'error_delete' => 'Active Task Groups cannot be deleted.',
            'success_delete' => 'The Task Group data has been successfully deleted.',
        ],


    ]
];
