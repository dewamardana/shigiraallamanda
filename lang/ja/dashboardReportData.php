<?php

return [
    'title' => 'レポートダッシュボード',

    'table' => [
        'reporter_name' => '報告者名',
        'report_type'   => 'レポート種別',
        'date'          => '日付',
        'description'   => '説明',
        'media'         => 'メディア',
        'member_name'   => 'メンバー名',
        'point'         => 'ポイント',
        'action'        => 'アクション',
        'no_data'       => '利用可能なレポートがありません。',
    ],

    'form' => [
        'reply_placeholder' => '返信を書く...',
        'point_placeholder' => 'ポイント',
    ],

    'controller' => [
        'index' => [
            'title' => 'レポートデータ | ダッシュボード',
        ],

        'reply' => [
            'success_reply' => '返信とポイントが正常に付与されました。',
        ]
    ]
];