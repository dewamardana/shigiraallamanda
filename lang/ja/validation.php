<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Validasi
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut berisi pesan error default yang digunakan oleh
    | class validator. Beberapa aturan memiliki beberapa versi seperti aturan
    | ukuran. Silakan ubah sesuai kebutuhan aplikasi Anda.
    |
    */

   'accepted' => ':attribute は承認される必要があります。',
    'accepted_if' => ':other が :value の場合、:attribute は承認される必要があります。',
    'active_url' => ':attribute は有効なURLである必要があります。',
    'after' => ':attribute は :date より後の日付である必要があります。',
    'after_or_equal' => ':attribute は :date 以降の日付である必要があります。',
    'alpha' => ':attribute は文字のみを含めます。',
    'alpha_dash' => ':attribute は文字、数字、ハイフン、アンダースコアのみを含めます。',
    'alpha_num' => ':attribute は文字と数字のみを含めます。',
    'any_of' => ':attribute は無効です。',
    'array' => ':attribute は配列である必要があります。',
    'ascii' => ':attribute は英数字の単一バイト文字と記号のみを含めます。',
    'before' => ':attribute は :date より前の日付である必要があります。',
    'before_or_equal' => ':attribute は :date 以前の日付である必要があります。',
    'between' => [
        'array' => ':attribute は :min から :max 個のアイテムを持つ必要があります。',
        'file' => ':attribute は :min ～ :max キロバイトである必要があります。',
        'numeric' => ':attribute は :min から :max の間である必要があります。',
        'string' => ':attribute は :min ～ :max 文字である必要があります。',
    ],
    'boolean' => ':attribute は true または false である必要があります。',
    'can' => ':attribute に許可されていない値が含まれています。',
    'confirmed' => ':attribute の確認が一致しません。',
    'contains' => ':attribute に必要な値が含まれていません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attribute は有効な日付である必要があります。',
    'date_equals' => ':attribute は :date と同じ日付である必要があります。',
    'date_format' => ':attribute は :format 形式と一致する必要があります。',
    'decimal' => ':attribute は :decimal 桁の小数を持つ必要があります。',
    'declined' => ':attribute は拒否される必要があります。',
    'declined_if' => ':other が :value の場合、:attribute は拒否される必要があります。',
    'different' => ':attribute と :other は異なる必要があります。',
    'digits' => ':attribute は :digits 桁である必要があります。',
    'digits_between' => ':attribute は :min から :max 桁の間である必要があります。',
    'dimensions' => ':attribute の画像サイズが無効です。',
    'distinct' => ':attribute に重複する値があります。',
    'doesnt_end_with' => ':attribute は次のいずれかで終わってはいけません: :values。',
    'doesnt_start_with' => ':attribute は次のいずれかで始まってはいけません: :values。',
    'email' => ':attribute は有効なメールアドレスである必要があります。',
    'ends_with' => ':attribute は次のいずれかで終わる必要があります: :values。',
    'enum' => ':attribute の選択肢が無効です。',
    'exists' => ':attribute の選択肢が無効です。',
    'extensions' => ':attribute は次の拡張子のいずれかである必要があります: :values。',
    'file' => ':attribute はファイルである必要があります。',
    'filled' => ':attribute は値を持つ必要があります。',
    'gt' => [
        'array' => ':attribute は :value 個より多くのアイテムを持つ必要があります。',
        'file' => ':attribute は :value キロバイトより大きい必要があります。',
        'numeric' => ':attribute は :value より大きくなければなりません。',
        'string' => ':attribute は :value 文字より長くなければなりません。',
    ],
    'gte' => [
        'array' => ':attribute は :value 個以上のアイテムを持つ必要があります。',
        'file' => ':attribute は :value キロバイト以上である必要があります。',
        'numeric' => ':attribute は :value 以上である必要があります。',
        'string' => ':attribute は :value 文字以上である必要があります。',
    ],
    'hex_color' => ':attribute は有効な16進数の色である必要があります。',
    'image' => ':attribute は画像である必要があります。',
    'in' => ':attribute の選択肢が無効です。',
    'in_array' => ':attribute は :other に存在する必要があります。',
    'in_array_keys' => ':attribute は次のキーのいずれかを持つ必要があります: :values。',
    'integer' => ':attribute は整数である必要があります。',
    'ip' => ':attribute は有効なIPアドレスである必要があります。',
    'ipv4' => ':attribute は有効なIPv4アドレスである必要があります。',
    'ipv6' => ':attribute は有効なIPv6アドレスである必要があります。',
    'json' => ':attribute は有効なJSON文字列である必要があります。',
    'list' => ':attribute はリストである必要があります。',
    'lowercase' => ':attribute は小文字である必要があります。',
    'lt' => [
        'array' => ':attribute は :value 個未満のアイテムを持つ必要があります。',
        'file' => ':attribute は :value キロバイト未満である必要があります。',
        'numeric' => ':attribute は :value より小さくなければなりません。',
        'string' => ':attribute は :value 文字未満である必要があります。',
    ],
    'lte' => [
        'array' => ':attribute は :value 個以下のアイテムを持つ必要があります。',
        'file' => ':attribute は :value キロバイト以下である必要があります。',
        'numeric' => ':attribute は :value 以下である必要があります。',
        'string' => ':attribute は :value 文字以下である必要があります。',
    ],
    'mac_address' => ':attribute は有効なMACアドレスである必要があります。',
    'max' => [
        'array' => ':attribute は :max 個以下のアイテムを持つ必要があります。',
        'file' => ':attribute は :max キロバイト以下である必要があります。',
        'numeric' => ':attribute は :max 以下である必要があります。',
        'string' => ':attribute は :max 文字以下である必要があります。',
    ],
    'max_digits' => ':attribute は :max 桁以下である必要があります。',
    'mimes' => ':attribute は次のタイプのファイルである必要があります: :values。',
    'mimetypes' => ':attribute は次のタイプのファイルである必要があります: :values。',
    'min' => [
        'array' => ':attribute は少なくとも :min 個のアイテムを持つ必要があります。',
        'file' => ':attribute は少なくとも :min キロバイトである必要があります。',
        'numeric' => ':attribute は少なくとも :min である必要があります。',
        'string' => ':attribute は少なくとも :min 文字である必要があります。',
    ],
    'min_digits' => ':attribute は少なくとも :min 桁である必要があります。',
    'missing' => ':attribute は存在してはいけません。',
    'missing_if' => ':other が :value の場合、:attribute は存在してはいけません。',
    'missing_unless' => ':other が :value でない限り、:attribute は存在してはいけません。',
    'missing_with' => ':values がある場合、:attribute は存在してはいけません。',
    'missing_with_all' => ':values がある場合、:attribute は存在してはいけません。',
    'multiple_of' => ':attribute は :value の倍数である必要があります。',
    'not_in' => ':attribute の選択肢が無効です。',
    'not_regex' => ':attribute の形式が無効です。',
    'numeric' => ':attribute は数値である必要があります。',
    'password' => [
        'letters' => ':attribute は少なくとも1文字の文字を含む必要があります。',
        'mixed' => ':attribute は少なくとも1文字の大文字と小文字を含む必要があります。',
        'numbers' => ':attribute は少なくとも1つの数字を含む必要があります。',
        'symbols' => ':attribute は少なくとも1つの記号を含む必要があります。',
        'uncompromised' => '提供された :attribute はデータ漏洩で見つかりました。他の :attribute を選んでください。',
    ],
    'present' => ':attribute は存在する必要があります。',
    'present_if' => ':other が :value の場合、:attribute は存在する必要があります。',
    'present_unless' => ':other が :value でない限り、:attribute は存在する必要があります。',
    'present_with' => ':values がある場合、:attribute は存在する必要があります。',
    'present_with_all' => ':values がある場合、:attribute は存在する必要があります。',
    'prohibited' => ':attribute は禁止されています。',
    'prohibited_if' => ':other が :value の場合、:attribute は禁止されています。',
    'prohibited_if_accepted' => ':other が承認された場合、:attribute は禁止されています。',
    'prohibited_if_declined' => ':other が拒否された場合、:attribute は禁止されています。',
    'prohibited_unless' => ':other が :values に含まれない限り、:attribute は禁止されています。',
    'prohibits' => ':attribute は :other の存在を禁止します。',
    'regex' => ':attribute の形式が無効です。',
    'required' => ':attribute は必須です。',
    'required_array_keys' => ':attribute は次のエントリを含む必要があります: :values。',
    'required_if' => ':other が :value の場合、:attribute は必須です。',
    'required_if_accepted' => ':other が承認された場合、:attribute は必須です。',
    'required_if_declined' => ':other が拒否された場合、:attribute は必須です。',
    'required_unless' => ':other が :values にない限り、:attribute は必須です。',
    'required_with' => ':values がある場合、:attribute は必須です。',
    'required_with_all' => ':values がある場合、:attribute は必須です。',
    'required_without' => ':values がない場合、:attribute は必須です。',
    'required_without_all' => ':values のいずれも存在しない場合、:attribute は必須です。',
    'same' => ':attribute は :other と一致する必要があります。',
    'size' => [
        'array' => ':attribute は :size 個のアイテムを持つ必要があります。',
        'file' => ':attribute は :size キロバイトである必要があります。',
        'numeric' => ':attribute は :size である必要があります。',
        'string' => ':attribute は :size 文字である必要があります。',
    ],
    'starts_with' => ':attribute は次のいずれかで始まる必要があります: :values。',
    'string' => ':attribute は文字列である必要があります。',
    'timezone' => ':attribute は有効なタイムゾーンである必要があります。',
    'unique' => ':attribute は既に使用されています。',
    'uploaded' => ':attribute のアップロードに失敗しました。',
    'uppercase' => ':attribute は大文字である必要があります。',
    'url' => ':attribute は有効なURLである必要があります。',
    'ulid' => ':attribute は有効なULIDである必要があります。',
    'uuid' => ':attribute は有効なUUIDである必要があります。',

    /*
    |--------------------------------------------------------------------------
    | Baris Validasi Kustom
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut dengan
    | konvensi "attribute.rule". Hal ini memudahkan untuk menentukan baris
    | bahasa kustom untuk aturan atribut tertentu.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'カスタムメッセージ',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atribut Validasi Kustom
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk mengganti placeholder atribut
    | dengan sesuatu yang lebih ramah pembaca seperti "Alamat Email"
    | daripada "email". Hal ini membantu agar pesan lebih jelas.
    |
    */

    'attributes' => [],
];
