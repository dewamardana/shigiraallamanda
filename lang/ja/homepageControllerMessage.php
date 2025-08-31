<?php

return [
    'index' => [
        'title'       => 'ホーム | ホームページ',
    ],

    'cleaning' => [
        'title'       => '清掃入力 | ホームページ',
        'validation' => [
            'building_required'      => '建物を選択してください。',
            'building_id_exists'     => '建物が見つかりません。',
            'oa_required'            => 'OAの値は必須です。',
            'ov_required'            => 'OVの値は必須です。',
            'stay_required'          => 'Stayの値は必須です。',
            'vec_required'           => 'Vecの値は必須です。',
            'total_room_required'    => '部屋数を入力してください。',
            'members_required'       => '少なくとも1人のメンバーを選択してください。',

            'building_exists'        => '選択された建物は存在しません。',
            'oa_integer'             => 'OAは数値である必要があります。',
            'oa_min'                 => 'OAは負の値にできません。',
            'ov_integer'             => 'OVは数値である必要があります。',
            'ov_min'                 => 'OVは負の値にできません。',
            'stay_integer'           => 'Stayは数値である必要があります。',
            'stay_min'               => 'Stayは負の値にできません。',
            'vec_integer'            => 'Vecは数値である必要があります。',
            'vec_min'                => 'Vecは負の値にできません。',
            'total_room_integer'     => '部屋数は数値である必要があります。',
            'total_room_min'         => '部屋数は負の値にできません。',
            'members_array'          => 'メンバーは配列形式である必要があります。',
            'members_exists'         => '選択されたメンバーは存在しません。',

            'date_required' => '日付は必須です。',
            'date_date'     => '日付の形式が無効です。',
        ],
        'warning_formula'  => 'この建物およびメンバー数には計算式が利用できません。',
        'success_store'    => 'データが正常に保存されました。',
    ],

    'checker' => [
        'title' => 'チェッカー入力 | ホームページ',
        'validation' => [
            'user_id_required'       => 'スタッフ名は必須です。',
            'user_id_exists'         => 'スタッフが見つかりません。',
            'date_required'          => '日付は必須です。',
            'date_date'              => '日付の形式が無効です。',
            'jumlah_kamar_required'  => '部屋数は必須です。',
            'jumlah_kamar_integer'   => '部屋数は数値である必要があります。',
            'jumlah_kamar_min'       => '部屋数は0未満にできません。',
        ],
        'error_no_formula'         => 'システムエラー：計算式が利用できません。',
        'success_store'            => 'データが正常に保存されました！',
    ],

    'office' => [
        'title' => 'オフィス入力 | ホームページ',
        'validation' => [
            'user_id_required'       => 'スタッフ名は必須です。',
            'user_id_exists'         => 'スタッフが見つかりません。',
            'date_required'          => '日付は必須です。',
            'date_date'              => '日付の形式が無効です。',
            'tasks_required'         => '少なくとも1つのタスクを選択してください。',
            'tasks_array'            => 'タスクは配列形式である必要があります。',
            'task_group_id_required' => 'タスクグループを選択してください。',
            'task_group_id_exists'   => '選択されたタスクグループは存在しません。',
        ],
        'success_store' => 'データが正常に保存されました！',
    ],

    'history' => [
        'title' => '履歴データ | ホームページ',
    ],

    'report' => [
        'title' => '報告書作成 | ホームページ',
        'validation' => [
            'user_id_required'     => 'ユーザーを選択してください。',
            'user_id_exists'       => '選択されたユーザーは存在しません。',
            'report_type_required' => '報告書の種類は必須です。',
            'report_type_string'   => '報告書の種類はテキストである必要があります。',
            'report_type_max'      => '報告書の種類は255文字以内でなければなりません。',
            'description_required' => '説明は必須です。',
            'description_string'   => '説明はテキストである必要があります。',
            'photos_image'         => '各写真は画像である必要があります。',
            'photos_mimes'         => '写真はjpeg, png, jpg, gif形式のファイルである必要があります。',
            'photos_max'           => '写真のサイズは2MB以下である必要があります。',
            'videos_mimetypes'     => '動画は有効なファイルである必要があります（mp4, avi, mpeg, quicktime）。',
            'videos_max'           => '動画のサイズは100MB以下である必要があります。',
            'members_array'        => 'メンバーは配列である必要があります。',
            'members_exists'       => '選択されたメンバーは存在しません。',
            'date_required'        => '日付は必須です。',
            'date_date'            => '日付の形式が無効です。',
        ],
        'success_store' => '報告書が正常に保存されました。',
        'failed_store'  => '報告書の保存に失敗しました: :message',
    ],

    'reportHistory' => [
        'title' => '報告書履歴 | ホームページ',
    ]
];