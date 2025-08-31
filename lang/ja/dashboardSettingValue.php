<?php

return [
    'title' => '設定',

    // Tabs
    'tabs' => [
        'roles' => '役割',
        'skills' => 'スキル',
        'report_types' => 'レポート種別',
    ],

    // Form placeholders
    'placeholders' => [
        'role_name' => '役割名',
        'skill_name' => 'スキル名',
        'report_type_name' => 'レポート種別名',
    ],

    // Buttons
    'buttons' => [
        'add' => '追加',
        'delete' => '削除',
    ],

    // Confirmation
    'confirm' => [
        'delete_role' => 'この役割を削除しますか？',
        'delete_skill' => 'このスキルを削除しますか？',
        'delete_report_type' => 'このレポート種別を削除しますか？',
    ],

    'controller' => [
        'index' => [
            'title' => '値を追加 | ダッシュボード',
        ],

        'create' => [
            'success_add_role' => '役割が正常に追加されました',
            'success_add_skill' => 'スキルが正常に追加されました',
            'success_add_report' => 'レポート種別が正常に追加されました',
        ],

        'delete' => [
            'success_delete_role' => '役割が正常に削除されました',
            'success_delete_skills' => 'スキルが正常に削除されました',
            'success_delete_report' => 'レポート種別が正常に削除されました',
        ],
    ]
];