<?php

return [

    // 🌐  共通部分
    'common' => [
        'date' => '日付',
        'name' => '品名',
        'location' => '場所',
        'description' => '説明',
        'status' => 'ステータス',
        'not_taken' => '未受取',
        'taken' => '受取済み',
        'action' => '操作',
        'detail' => '詳細',
        'edit' => '変更を保存',
        'no_media' => 'メディアがありません',
        'serial_number' => 'シリアル番号',
        'close' => 'モーダルを閉じる',
    ],

    'index' => [
        'title' => '遺失物ダッシュボード',
    ],

    'filter' => [
        'start_date' => '開始日',
        'end_date' => '終了日',
        'user' => '発見者',
        'all' => 'すべて',
    ],

    'table' => [
        'date' => '日付',
        'name' => '品名',
        'location' => '場所',
        'description' => '説明',
        'status' => 'ステータス',
        'action' => '操作',
        'empty' => '遺失物が見つかりません。',
    ],

    'status' => [
        'not_taken' => '未受取',
        'taken' => '受取済み',
    ],

    'button' => [
        'detail' => '詳細',
        'delete' => '削除',
        'edit' => '変更を保存',
        'back' => '戻る',
    ],

    'confirm' => [
        'delete' => 'この品物を削除してもよろしいですか？',
    ],

    'pagination' => [
        'next' => '次へ',
        'previous' => '前へ',
    ],

    'alert' => [
        'success_delete' => '品物が正常に削除されました。',
        'error_delete' => '品物の削除に失敗しました。',
    ],

    'controller' => [
        'index' => ['title' => '遺失物一覧 | ダッシュボード'],
        'create' => ['title' => '遺失物を追加 | ダッシュボード'],
        'edit' => ['title' => '遺失物を編集 | ダッシュボード'],
        'show' => ['title' => '遺失物詳細 | ダッシュボード'],
        'delete' => [
            'success' => '品物が正常に削除されました。',
            'error' => '削除中にエラーが発生しました。',
        ],
    ],

    'show' => [
        'title' => '遺失物の詳細',
        'media_section' => '品物のメディア',
        'date_found' => '発見日',
        'found_by' => '発見者',
        'location' => '発見場所',
        'description' => '品物の説明',
        'serial_number' => 'シリアル番号',
    ],
];
