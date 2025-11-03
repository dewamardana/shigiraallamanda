<?php

return [
    'index' => [
        'title' => 'Cleaning Task',
    ],

    'create' => [
        'title' => 'Add Cleaning Task',
    ],

    'edit' => [
        'title' => 'Edit Cleaning Task',
    ],

    'table' => [
        'no' => 'No',
        'task_name' => 'Task Name',
        'status' => 'Status',
        'action' => 'Action',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'show' => 'Show',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'delete_confirm' => 'Are you sure you want to delete this task?',
        'no_data' => 'No Task found.',
    ],

    'form' => [
        'task_name' => 'Task Name',
        'status' => 'Status',
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'button' => [
        'add' => 'Add Task',
        'back' => 'Back',
        'edit' => 'Save Changes',
        'delete' => 'Delete',
        'delete_confirm' => 'Are you sure you want to delete this task?',
    ],

    'alert' => [
        'success' => 'Task has been successfully processed.',
        'error' => 'An error occurred while processing the task.',
    ],

    'controller' => [
        'index' => [
            'title' => 'Cleaning Task | Dashboard',
        ],
        'create' => [
            'title' => 'Add Cleaning Task | Dashboard',
            'success_add' => 'Cleaning task created successfully.',
            'error_add' => 'Failed to create cleaning task.',
        ],
        'edit' => [
            'title' => 'Edit Cleaning Task | Dashboard',
            'success_edit' => 'Cleaning task updated successfully.',
            'error_edit' => 'Failed to update cleaning task.',
        ],
        'delete' => [
            'deleted_success' => 'Cleaning Task deleted successfully.',
            'deactivated_warning' => 'Task is already used, status changed to inactive.',
        ],
    ],
];
