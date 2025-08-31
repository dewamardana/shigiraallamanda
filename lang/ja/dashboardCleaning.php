<?php

return [
    'cleaningdata' => [
        'title'            => '清掃データダッシュボード',
        'filter_building'  => '建物:',
        'filter_all'       => 'すべての建物',
        'filter_user'      => 'ユーザーで絞り込む',
        'members' => 'メンバー',
        'table' => [
            'date'      => '日付',
            'name'      => '名前',
            'oa'        => 'OA',
            'ov'        => 'OV',
            'stay'      => '滞在',
            'vec'       => 'Vec',
            'premier'   => 'プレミア',
            'total'     => '合計',
            'point'     => 'ポイント',
            'total_info' => '合計',
            'member' => 'メンバー',
        ],
    ],

    'checkdata' => [
        'title' => 'インスペクタデータ',
        'user' => 'ユーザー',
        'all'  => 'すべて',
        'table' => [
            'date'       => '日付',
            'name'       => '名前',
            'room'       => '部屋',
            'total'      => '合計',
            'no_data'    => 'データが見つかりません。',
        ],
    ],
    'officedata' => [
        'title'        => 'オーダーデータ',
        'table' => [
            'no'         => '番号',
            'date'       => '日付',
            'user'       => 'ユーザー',
            'task_group' => 'タスクグループ',
            'task_point' => 'タスクとポイント',
            'total'      => '合計ポイント',
            'empty'      => 'オフィス記録が見つかりません。',
        ],
    ],

    'userpoint' => [
        'title'         => '月間ポイント集計',
        'filter_year'   => '年',
        'filter_month'  => '月',
        'table' => [
            'no'      => '番号',
            'name'    => '名前',
            'day'     => '日',
            'total'   => '合計',
        ],
    ],

    'cleaningHistory' => [
        'title' => '清掃データ',
        'cleaning_title' => '📊 全ての清掃入力データを表示しています。',
        'checker_title' => '📊 全てのインスペクタとオーダーデータを表示しています。',
        'table' => [
            'no' => '番号',
            'date' => '日付',
            'input_by' => '入力者',
            'building' => '建物',
            'oa' => 'OA',
            'ov' => 'OV',
            'stay' => '滞在',
            'vec' => 'Vec',
            'premier' => 'プレミア',
            'total_room' => '総部屋数',
            'total_point' => '総ポイント',
            'point_per_member' => 'メンバーポイント',
            'members' => 'メンバー',
            'no_data' => '利用可能なデータはありません。',
        ],
    ],

    'checkRecords' => [
        'title' => 'インスペクタとオーダー記録データ',
        'table' => [
            'no' => '番号',
            'date' => '日付',
            'type' => 'タイプ',
            'input_by' => '入力者',
            'total_point' => '総ポイント',
            'point_per_member' => 'ポイント/メンバー',
            'no_data' => '利用可能なデータはありません',
        ],
    ],
    'controller' => [
        'indextitle' => '清掃データダッシュボード',
        'header_name_member'  => 'メンバー名',
        'header_oa'           => 'OA',
        'header_ov'           => 'OV',
        'header_stay'         => '滞在',
        'header_vec'          => 'Vec',
        'header_premier'      => 'プレミア',
        'header_total'        => '合計',
        'header_name_member2' => 'メンバー名',
        'header_poin'         => 'ポイント',

        'header_date'        => '日付',
        'header_user'        => 'ユーザー',
        'header_task_group'  => 'タスクグループ',
        'header_task'        => 'タスク',
        'header_point'       => 'ポイント',
        'header_total_point' => '総ポイント',

        'header_no'           => '番号',
        'header_nama'         => '名前',
        'header_day'          => '日',
        'header_total_poin'   => '総ポイント',

        'filename_cleaning'   => '清掃レポート',
        'filename_rekap'      => '月次レポート',
        'checkerDataTitle' => 'チェッカーポイントデータ | ダッシュボード',

        'no_active_formula' => '有効な数式が見つかりません。',
        'filename' => 'Checker_Report.xlsx',

        'headers' => [
            'no' => '番号',
            'date' => '日付',
            'name' => '名前',
            'room_count' => '部屋数',
            'total_points' => '総ポイント',
        ],
        'officedata' => [
            'title' => 'オーダーデータ | ダッシュボード',
        ],
        'userPoint' => [
            'title' => 'メンバーポイント概要 | ダッシュボード',
        ],
        'CleaningHistoryData' => [
            'title' => '清掃入力履歴',
        ],
        'CheckOfficeHistoryData' => [
            'title' => 'インスペクタとオーダー履歴 | ダッシュボード',
        ],
    ],

];
