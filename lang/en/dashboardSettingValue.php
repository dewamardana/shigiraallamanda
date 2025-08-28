<?php

return [
    'title' => 'Settings',

    // Tabs
    'tabs' => [
        'roles' => 'Roles',
        'skills' => 'Skills',
        'report_types' => 'Report Types',
    ],

    // Form placeholders
    'placeholders' => [
        'role_name' => 'Role name',
        'skill_name' => 'Skill name',
        'report_type_name' => 'Report type name',
    ],

    // Buttons
    'buttons' => [
        'add' => 'Add',
        'delete' => 'Delete',
    ],

    // Confirmation
    'confirm' => [
        'delete_role' => 'Delete this role?',
        'delete_skill' => 'Delete this skill?',
        'delete_report_type' => 'Delete this report type?',
    ],

    'controller' => [
        'index' => [
            'title' => 'Add Value | Dashboard',
        ],

        'create' => [
            'success_add_role' => 'Role added successfully',
            'success_add_skill' => 'Skill added successfully',
            'success_add_report' => 'Report type added successfully',
        ],

        'delete' => [
            'success_delete_role' => 'Role deleted successfully',
            'success_delete_skills' => 'Skill deleted successfully',
            'success_delete_report' => 'Report type deleted successfully',
        ],
    ]
];
