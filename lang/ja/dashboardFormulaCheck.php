<?php

return [
    'index' => [
        'title' => '計算式一覧',

        'table' => [
            'name'           => '計算式名',
            'description'    => '説明',
            'status'         => 'ステータス',
            'action'         => 'アクション',
            'active'         => '有効',
            'inactive'       => '無効',
            'delete_confirm' => '本当にこの計算式を削除しますか？',
        ],

    ],

    'form' => [
        'name'                => '計算式名',
        'description'         => '説明',
        'active'              => '有効',
        'jumlah_kamar'        => '部屋数',
        'mengajar'            => '指導',
        'pembersihan_khusus'  => '特別清掃',
        'mengangkat_barang'   => '荷物運搬',
        'membersihkan_gudang' => '倉庫清掃',
        'obat_pool'           => 'プール薬品',
        'membersihkan_pool'   => 'プール清掃',
        'sampah'              => 'ゴミ',
    ],

    'create' => [
        'title' => 'チェック計算式を追加',
    ],

    'edit' => [
        'title' => 'チェック計算式を編集',
    ],

    'show' => [
        'title' => 'チェック計算式の詳細',
    ],

    'controller' => [
        'index' => [
            'title' => 'チェック計算式 | ホーム',
        ],

        'create' => [
            'title' => 'チェック計算式を追加 | ホーム',
            'success_create' => '計算式が正常に追加されました。',
        ],

        'show' => [
            'title' => 'チェック計算式の詳細 | ホーム',
        ],

        'edit' => [
            'title' => 'チェック計算式を編集 | ホーム',
            'error_edit' => '少なくとも1つの計算式を有効にしておく必要があります。',
            'success_edit' => '計算式が正常に更新されました。',
        ],

        'delete' => [
            'error_delete' => '有効な計算式は削除できません。',
            'success_delete' => '計算式データが正常に削除されました。',
        ],

        'validation' => [
            'name.required' => '名前欄は必須です。',
            'name.string'   => '名前はテキストである必要があります。',
            'name.max'      => '名前は255文字以内で入力してください。',

            'description.required' => '説明欄は必須です。',
            'description.string'   => '説明はテキストである必要があります。',

            'jumlah_kamar.required' => '部屋数は必須です。',
            'jumlah_kamar.numeric'  => '部屋数は数値である必要があります。',

            'mengajar.required' => '指導値は必須です。',
            'mengajar.numeric'  => '指導値は数値である必要があります。',

            'pembersihan_khusus.required' => '特別清掃値は必須です。',
            'pembersihan_khusus.numeric'  => '特別清掃値は数値である必要があります。',

            'mengangkat_barang.required' => '荷物運搬値は必須です。',
            'mengangkat_barang.numeric'  => '荷物運搬値は数値である必要があります。',

            'membersihkan_gudang.required' => '倉庫清掃値は必須です。',
            'membersihkan_gudang.numeric'  => '倉庫清掃値は数値である必要があります。',

            'obat_pool.required' => 'プール薬品値は必須です。',
            'obat_pool.numeric'  => 'プール薬品値は数値である必要があります。',

            'membersihkan_pool.required' => 'プール清掃値は必須です。',
            'membersihkan_pool.numeric'  => 'プール清掃値は数値である必要があります。',

            'sampah.required' => 'ゴミ値は必須です。',
            'sampah.numeric'  => 'ゴミ値は数値である必要があります。',
        ]
    ],

];
