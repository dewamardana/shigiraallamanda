<?php

return [
    'index' => [
        'title' => '📋 従業員データ',
        'new_worker' => '従業員を追加',
        'table' => [
            'name' => '名前',
            'department' => '部署',
            'gender' => '性別',
            'status' => '状態',
            'action' => '操作',
            'male' => '男性',
            'female' => '女性',
        ],
    ],

    'form' => [
        'profile_photo' => 'プロフィール写真',
        'photo_hint' => '写真をクリックして変更',
        'photo_upload' => '写真をアップロード',
        'upload_hint' => 'SVG、PNG、JPG、GIF（アスペクト比1:1）',
        'name' => '名前',
        'username' => 'ユーザー名',
        'email' => 'メールアドレス',
        'phone_number' => '電話番号',
        'department' => '部署',
        'gender' => '性別',
        'male' => '男性',
        'female' => '女性',
        'status' => '状態',
        'active' => '有効',
        'inactive' => '無効',
        'password' => 'パスワード',
        'role'  => '役割',
        'skill' => 'スキル',

        'name_placeholder' => 'フルネームを入力してください',
        'username_placeholder' => 'ユーザー名を入力してください',
        'email_placeholder' => '有効なメールアドレスを入力してください',
        'phone_placeholder' => '有効な電話番号を入力してください',
        'department_placeholder' => '部署名を入力してください',
        'password_placeholder' => 'パスワードを入力してください',
        'password_hint'       => 'パスワードを変更しない場合は、空のままにしてください。',
    ],

    'create' => [
        'title' => '従業員を追加',
    ],

    'edit' => [
        'title' => '従業員を編集',
    ],

    'show' => [
        'title' => '従業員詳細',
    ],

    'controller' => [
        'index' => [
            'title' => '従業員ページ | ダッシュボード',
        ],

        'create' => [
            'title' => '従業員を追加 | ダッシュボード',
        ],

        'store' => [
            'name_required'        => '名前は必須です。',
            'username_required'    => 'ユーザー名は必須です。',
            'username_unique'      => 'このユーザー名はすでに使用されています。他の名前を選んでください。',
            'email_required'       => 'メールアドレスは必須です。',
            'email_unique'         => 'このメールアドレスは既に登録されています。',
            'password_required'    => 'パスワードは必須です。',
            'password_min'         => 'パスワードは最低6文字必要です。',
            'phone_required'       => '電話番号は必須です。',
            'gender_in'            => '有効な性別を選択してください。',
            'photo_error'          => '選択したファイルは画像である必要があります。',
            'photo_mimes'          => '画像はjpeg、png、jpg、gif形式である必要があります。',
            'photo_max'            => '画像サイズは2MB以下である必要があります。',
            'success_add'          => '従業員データが正常に追加されました！',
        ],

        'edit' => [
            'title' => '従業員を編集 | ダッシュボード',
        ],

        'upload' => [
            'name_required'        => '名前は必須です。',
            'username_required'    => 'ユーザー名は必須です。',
            'username_unique'      => 'このユーザー名はすでに使用されています。他の名前を選んでください。',
            'email_required'       => 'メールアドレスは必須です。',
            'email_unique'         => 'このメールアドレスは既に登録されています。',
            'password_required'    => 'パスワードは必須です。',
            'password_min'         => 'パスワードは最低6文字必要です。',
            'phone_required'       => '電話番号は必須です。',
            'gender_in'            => '有効な性別を選択してください。',
            'photo_error'          => '選択したファイルは画像である必要があります。',
            'photo_mimes'          => '画像はjpeg、png、jpg、gif形式である必要があります。',
            'photo_max'            => '画像サイズは2MB以下である必要があります。',
            'role_required'        => '役割を選択してください。',
            'role_in'              => '役割はuserまたはadminである必要があります。',
            'success_edit'         => 'データが正常に更新されました。',
        ],

        'show' => [
            'title' => '従業員詳細 | ダッシュボード',
        ],

        'delete' => [
            'success_deleted'   => '従業員データが正常に削除されました。',
        ]
    ]
];