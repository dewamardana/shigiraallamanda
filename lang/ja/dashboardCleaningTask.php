<?php

return [
    'index' => [
        'title' => '清掃タスク',
    ],

    'create' => [
        'title' => '清掃タスクを追加',
    ],

    'edit' => [
        'title' => '清掃タスクを編集',
    ],

    'table' => [
        'no' => '番号',
        'task_name' => 'タスク名',
        'status' => 'ステータス',
        'action' => '操作',
        'active' => '有効',
        'inactive' => '無効',
        'delete_confirm' => 'このタスクを削除してもよろしいですか？',
        'no_data' => 'タスクが見つかりません。',
    ],

    'form' => [
        'task_name' => 'タスク名',
        'status' => 'ステータス',
        'active' => '有効',
        'inactive' => '無効',
    ],

    'button' => [
        'add' => 'タスクを追加',
        'back' => '戻る',
        'edit' => '変更を保存',
        'delete' => '削除',
        'delete_confirm' => 'このタスクを削除してもよろしいですか？',
    ],

    'alert' => [
        'success' => 'タスクが正常に処理されました。',
        'error' => 'タスクの処理中にエラーが発生しました。',
    ],

    'controller' => [
        'index' => [
            'title' => '清掃タスク | ダッシュボード',
        ],
        'create' => [
            'title' => '清掃タスクを追加 | ダッシュボード',
            'success_add' => '清掃タスクが正常に追加されました。',
            'error_add' => '清掃タスクの追加に失敗しました。',
        ],
        'edit' => [
            'title' => '清掃タスクを編集 | ダッシュボード',
            'success_edit' => '清掃タスクが正常に更新されました。',
            'error_edit' => '清掃タスクの更新に失敗しました。',
        ],
        'delete' => [
            'deleted_success' => '清掃タスクが削除されました。',
            'deactivated_warning' => 'このタスクは使用中のため、非アクティブに変更されました。',
        ],
    ],
];
