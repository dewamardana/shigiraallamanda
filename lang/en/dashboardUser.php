<?php

return [
    'index' => [
        'title' => '📋 Workers Data',
        'new_worker' => 'New Worker',
        'table' => [
            'name' => 'Name',
            'department' => 'Department',
            'gender' => 'Gender',
            'status' => 'Status',
            'action' => 'Action',
            'male' => 'Male',
            'female' => 'Female',
        ],
    ],

    'form' => [
        'profile_photo' => 'Profile Photo',
        'photo_hint' => 'Click the image to change photo',
        'photo_upload' => 'Upload Photo',
        'upload_hint' => 'SVG, PNG, JPG or GIF (Ratio 1:1).',
        'name' => 'Name',
        'username' => 'Username',
        'email' => 'Email',
        'phone_number' => 'Phone Number',
        'department' => 'Department',
        'gender' => 'Gender',
        'male' => 'Male',
        'female' => 'Female',
        'status' => 'Status',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'password' => 'Password',
        'role'  => 'Roles',
        'skill' => 'Skills',

        'name_placeholder' => 'Enter your full name',
        'username_placeholder' => 'Enter username',
        'email_placeholder' => 'Enter your active email address',
        'phone_placeholder' => 'Active phone number',
        'department_placeholder' => 'Enter the name of the department',
        'password_placeholder' => 'Enter the password',
        'password_hint'       => 'Leave it blank if you do not want to change the password.',
    ],

    'create' => [
        'title' => 'Add Workers',
    ],

    'edit' => [
        'title' => 'Edit Worker',
    ],
    'show' => [
        'title'         => 'Worker Details',
    ],

    'controller' => [
        'index' => [
            'title' => 'Worker page | Dashboard',
        ],

        'create' => [
            'title' => 'Worker Add | Dashboard',
        ],

        'store' => [
            'name_required'        => 'Name is required.',
            'username_required'    => 'Username is required.',
            'username_unique'      => 'This username is already taken. Please choose another.',
            'email_required'       => 'Email address is required.',
            'email_unique'         => 'This email is already registered.',
            'password_required'    => 'Password is required.',
            'password_min'         => 'Password must be at least 6 characters long.',
            'phone_required'       => 'Phone number is required.',
            'gender_in'            => 'Please select a valid gender.',
            'photo_error'          => 'The selected file must be an image.',
            'photo_mimes'          => 'Photo must be in jpeg, png, jpg, or gif format.',
            'photo_max'            => 'Photo size must not exceed 2MB.',
            'success_add'          => 'Data members added successfully!',
        ],

        'edit' => [
            'title' => 'Edit Worker | Dashboard',
        ],

        'upload' => [
            'name_required'        => 'Name is required.',
            'username_required'    => 'Username is required.',
            'username_unique'      => 'This username is already taken. Please choose another.',
            'email_required'       => 'Email address is required.',
            'email_unique'         => 'This email is already registered.',
            'password_required'    => 'Password is required.',
            'password_min'         => 'Password must be at least 6 characters long.',
            'phone_required'       => 'Phone number is required.',
            'gender_in'            => 'Please select a valid gender.',
            'photo_error'          => 'The selected file must be an image.',
            'photo_mimes'          => 'Photo must be in jpeg, png, jpg, or gif format.',
            'photo_max'            => 'Photo size must not exceed 2MB.',
            'role_required'        => 'Role must be selected.',
            'role_in'              => 'Role must be user or admin.',
            'success_edit' => 'Data updated successfully.',
        ],

        'show' => [
            'title' => 'Detail Worker | Dashboard',
        ],

        'delete' => [
            'success_deleted'   => 'Worker data deleted successfully.',
        ]
    ]


];
