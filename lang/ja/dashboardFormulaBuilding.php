<?php

return [
   'index' => [
        'title'  => '📊 データ計算式',

        'table' => [
            'building'     => '建物',
            'member'       => 'メンバー',
            'oa'           => 'OA',
            'ov'           => 'OV',
            'stay'         => '滞在',
            'vec'          => 'Vec',
            'premier'      => 'プレミア',
            'action'       => 'アクション',
        ],
    ],
    'create' => [
        'title'                 => '計算式を追加',
    ],

    'form' => [
        'building_label'        => '建物名',
        'building_placeholder'  => '建物を選択',
        'member_label'          => "メンバー数（数字または「ランダム」）",
        'oa_label'              => 'OA',
        'ov_label'              => 'OV',
        'stay_label'            => '滞在',
        'vec_label'             => 'Vec',
        'premier_label'         => 'プレミア',
    ],
    'edit' => [
        'title'                 => '計算式を編集',
    ],
    'show' => [
        'title'          => '計算式の詳細',
        'building_name'  => '建物名',
        'member_count'   => 'メンバー数',
        'oa'             => 'OA',
        'ov'             => 'OV',
        'stay'           => '滞在',
        'vec'            => 'Vec',
        'premier'        => 'プレミア',
    ],
    'controller' => [
        'index' => [
            'title' => 'データ計算式 | ダッシュボード',
        ],
        'create' => [
            'title' => '計算式を追加 | ダッシュボード',
            'success_add'      => '計算式が正常に追加されました！',
        ],
        'edit' => [
            'title' => '計算式を編集 | ダッシュボード',
            'success_update'   => '計算式が正常に更新されました！',
        ],
        'show' => [
            'title' => '計算式の詳細 | ダッシュボード',
        ],
        'delete' => [
            'title' => '',
            'success_delete'   => '計算式が正常に削除されました！',
        ],
        'validation' => [
            'building_slug_required' => '建物スラッグは必須です。',
            'member_count_required'  => 'メンバー数は必須です。',
            'oa_required'            => 'OA値は必須です。',
            'ov_required'            => 'OV値は必須です。',
            'stay_required'          => '滞在値は必須です。',
            'vec_required'           => 'Vec値は必須です。',
            'premier_numeric'        => 'プレミア値は数値である必要があります。',
        ],
    ],
];
