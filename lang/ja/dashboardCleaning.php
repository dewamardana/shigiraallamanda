<?php

return [
    'cleaningdata' => [
        'title'            => 'ダッシュボード：データクリーニング',
        'filter_building'  => '建物：',
        'filter_all'       => 'すべての建物',
        'filter_user'      => 'ユーザーでフィルター',
        'members' => 'メンバー',
        'table' => [
            'date'      => '日付',
            'name'      => '名前',
            'oa'        => 'OA',
            'ov'        => 'OV',
            'stay'      => '滞在',
            'vec'       => 'V/eco',
            'premier'   => 'プレミア',
            'total'     => '合計',
            'point'     => 'ポイント',
            'total_info' => '合計',
            'member' => 'メンバー',
        ],
    ],

    'checkdata' => [
        'title' => 'データチェック',
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

     'userpoint' => [
        'title'         => '月次ポイント集計',
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
        'title' => 'クリーニングデータ',
        'cleaning_title' => '📊 すべてのクリーニング入力データを表示中。',
        'checker_title' => '📊 すべてのチェックおよびオフィスデータを表示中。',
        'table' => [
            'no' => '番号',
            'date' => '日付',
            'input_by' => '入力者',
            'building' => '建物',
            'oa' => 'OA',
            'ov' => 'OV',
            'stay' => '滞在',
            'vec' => '<V/eco',
            'premier' => 'プレミア',
            'total_room' => '部屋数合計',
            'total_point' => 'ポイント合計',
            'point_per_member' => '1人あたりポイント',
            'members' => 'メンバー',
            'no_data' => 'データがありません。',
        ],
    ],

    'checkRecords' => [
        'title' => 'チェックおよびオフィスデータ',
        'table' => [
            'no' => '番号',
            'date' => '日付',
            'type' => 'タイプ',
            'input_by' => '入力者',
            'total_point' => 'ポイント合計',
            'point_per_member' => 'ポイント / メンバー',
            'no_data' => 'データがありません',
        ],
    ],
    'controller' => [
        'indextitle' => 'ダッシュボード：データクリーニング',
        // Header exportCleaningData
        'header_name_member'  => 'メンバー名',
        'header_oa'           => 'OA',
        'header_ov'           => 'OV',
        'header_stay'         => '滞在',
        'header_vec'          => 'Vec',
        'header_premier'      => 'プレミア',
        'header_total'        => '合計',
        'header_name_member2' => 'メンバー名',
        'header_poin'         => 'ポイント',

        // Header exportRekapBulanan
        'header_no'           => '番号',
        'header_nama'         => '名前',
        'header_day'          => '日',
        'header_total_poin'   => 'ポイント合計',

        // Filename
        'filename_cleaning'   => 'クリーニング報告書',
        'filename_rekap'      => '月次報告書',
        'checkerDataTitle' => 'チェックポイントデータ | ダッシュボード',

        'no_active_formula' => '有効な計算式が見つかりません。',
        'filename' => 'Checker_報告書.xlsx',

        'headers' => [
            'no' => '番号',
            'date' => '日付',
            'name' => '名前',
            'room_count' => '部屋数',
            'total_points' => 'ポイント合計',
        ],
        'userPoint' => [
            'title' => 'メンバーポイント概要 | ダッシュボード',
        ],
        'CleaningHistoryData' => [
            'title' => 'クリーニング入力履歴',
        ],
        'CheckOfficeHistoryData' => [
            'title' => 'チェックおよびオフィス履歴 | ダッシュボード',
        ],
    ],


];
