<?php

return [
    'show' => [
        'title' => '📋 「:name」のタスク',
    ],

    'table' => [
        'task_name' => 'タスク名',
        'point'     => 'ポイント',
        'action'    => 'アクション',
    ],

    'form' => [
        'task_name'         => 'タスク名',
        'point'             => 'ポイント',
        'placeholder_point' => '0',
    ],

    'create' => [
        'title' => '「:name」のタスクを追加',
    ],

    'edit' => [
        'title' => '「:name」タスクを編集',
    ],

    'controller' => [
        'create' => [
            'title'        => 'タスクを追加 | ダッシュボード',
            'success_add'  => 'タスクが正常に追加されました。',
        ],

        'edit' => [
            'title'          => 'タスクを編集 | ダッシュボード',
            'success_update' => 'タスクが正常に更新されました。',
        ],

        'delete' => [
            'success_delete' => 'タスクが正常に削除されました。',
        ],
    ],

    'validation' => [
        'required' => 'このフィールドは必須です。',
        'number'   => '有効な数字を入力してください。',
    ],
];