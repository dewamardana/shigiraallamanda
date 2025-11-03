<?php

return [
    'index' => [
        'title' => 'Checker Task List',
    ],

    'create' => [
        'title' => 'Add Checker Task',
    ],

    'edit' => [
        'title' => 'Edit Checker Task',
    ],

    'form' => [
        'name' => 'Task Name',
        'type' => 'Type',
        'formula' => 'Formula',
        'active' => 'Active',
    ],

    'option' => [
        'boolean' => 'Boolean',
        'number' => 'Number',
    ],

    'table' => [
        'name' => 'Task Name',
        'type' => 'Type',
        'formula' => 'Formula',
        'active' => 'Active',
        'action' => 'Action',
        'empty' => 'No checker task found.',
    ],

    'status' => [
        'yes' => 'Yes',
        'no' => 'No',
    ],

    'button' => [
        'add' => 'Add Task',
        'edit' => 'Update Task',
        'delete' => 'Delete',
        'back' => 'Back',
        'show' => 'Show',
    ],

    'alert' => [
        'success_add' => 'Checker task has been successfully added.',
        'error_add' => 'Failed to add checker task.',
        'success_edit' => 'Checker task has been successfully updated.',
        'error_edit' => 'Failed to update checker task.',
        'success_delete' => 'Checker task has been successfully deleted.',
        'error_delete' => 'Failed to delete checker task.',
    ],

    'controller' => [
        'index' => [
            'title' => 'Checker Task List | Dashboard',
        ],
        'create' => [
            'title' => 'Add Checker Task | Dashboard',
            'success_add' => 'Checker task has been created successfully.',
        ],
        'edit' => [
            'title' => 'Edit Checker Task | Dashboard',
            'success_edit' => 'Checker task has been updated successfully.',
            'error_edit' => 'An error occurred while updating the checker task.',
        ],
        'delete' => [
            'success_delete' => 'Checker task has been deleted successfully.',
            'error_delete' => 'Failed to delete checker task.',
            'disabled' => 'Checker task has been deactivated (cannot be deleted because data exists).',
        ],
    ],
];
