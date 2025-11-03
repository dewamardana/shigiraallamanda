<?php

return [

    // 🌐 Common section for reusable phrases
    'common' => [
        'date' => 'Date',
        'name' => 'Item Name',
        'location' => 'Location',
        'description' => 'Description',
        'status' => 'Status',
        'not_taken' => 'Not Yet Taken',
        'taken' => 'Already Taken',
        'action' => 'Action',
        'back' => 'Back',
        'delete' => 'Delete',
        'detail' => 'Detail',
        'edit' => 'Save Changes',
        'no_media' => 'No media available',
        'serial_number' => 'Serial Number',
        'close' => 'Close Modal',
    ],

    // 📋 Main page (index)
    'index' => [
        'title' => 'Dashboard Lost & Found',
    ],

    // 🔎 Data filter
    'filter' => [
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'user' => 'Found By',
        'all' => 'All',
    ],

    // 🧾 Data table
    'table' => [
        'date' => 'Date',
        'name' => 'Item Name',
        'location' => 'Location',
        'description' => 'Description',
        'status' => 'Status',
        'action' => 'Action',
        'empty' => 'No found item data available.',
    ],

    // 🚦 Item status
    'status' => [
        'not_taken' => 'Not Yet Taken',
        'taken' => 'Already Taken',
    ],

    // 🔘 Common buttons
    'button' => [
        'detail' => 'Detail',
        'delete' => 'Delete',
        'edit' => 'Save Changes',
        'back' => 'Back',
    ],

    // ⚠️ Confirmation prompts
    'confirm' => [
        'delete' => 'Are you sure you want to delete this item?',
    ],

    // ⏩ Table pagination
    'pagination' => [
        'next' => 'Next',
        'previous' => 'Previous',
    ],

    // 🔔 Alerts and notifications
    'alert' => [
        'success_delete' => 'Item deleted successfully.',
        'error_delete' => 'Failed to delete item.',
    ],

    // 🧠 Controller (page titles and action messages)
    'controller' => [
        'index' => [
            'title' => 'Found Item List | Dashboard',
        ],
        'create' => [
            'title' => 'Add Found Item | Dashboard',
        ],
        'edit' => [
            'title' => 'Edit Found Item | Dashboard',
        ],
        'show' => [
            'title' => 'Found Item Details | Dashboard',
        ],
        'delete' => [
            'success' => 'Item deleted successfully.',
            'error' => 'An error occurred while deleting the item.',
        ],
    ],

    // 🔍 Detail page (show)
    'show' => [
        'title' => 'Found Item Details',
        'media_section' => 'Item Media',
        'date_found' => 'Date Found',
        'found_by' => 'Found By',
        'location' => 'Found Location',
        'description' => 'Item Description',
        'serial_number' => 'Serial Number',
        'status' => 'Item Status',
        'status_not_taken' => 'Not Yet Taken',
        'status_taken' => 'Already Taken',
    ],
];
