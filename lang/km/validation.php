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

    'accepted' => ':attribute ត្រូវតែត្រូវបានទទួលយក។',
    'accepted_if' => ':attribute ត្រូវតែត្រូវបានទទួលយកនៅពេល :other គឺ :value។',
    'active_url' => ':attribute ត្រូវតែជាអាសយដ្ឋាន URL សុពលភាព។',
    'after' => ':attribute ត្រូវតែជាថ្ងៃក្រោយ :date។',
    'after_or_equal' => ':attribute ត្រូវតែជាថ្ងៃក្រោយ ឬ ស្មើនឹង :date។',
    'alpha' => ':attribute អាចមានតែអក្សរប៉ុណ្ណោះ។',
    'alpha_dash' => ':attribute អាចមានតែអក្សរ លេខ សញ្ញា និង អន្លាក់បន្ទាត់ក្រោម។',
    'alpha_num' => ':attribute អាចមានតែអក្សរ និង លេខប៉ុណ្ណោះ។',
    'any_of' => ':attribute មិនត្រឹមត្រូវ។',
    'array' => ':attribute ត្រូវតែជាអារេ។',
    'ascii' => ':attribute ត្រូវតែមានតែតួអក្សរ alfanumerik មួយប៊ីត និង សញ្ញា។',
    'before' => ':attribute ត្រូវតែជាថ្ងៃមុន :date។',
    'before_or_equal' => ':attribute ត្រូវតែជាថ្ងៃមុន ឬ ស្មើនឹង :date។',
    'between' => [
        'array' => ':attribute ត្រូវតែមានចន្លោះ :min និង :max ធាតុ។',
        'file' => ':attribute ត្រូវតែមានចន្លោះ :min និង :max 킬ូបៃត។',
        'numeric' => ':attribute ត្រូវតែមានចន្លោះ :min និង :max។',
        'string' => ':attribute ត្រូវតែមានចន្លោះ :min និង :max តួអក្សរ។',
    ],
    'boolean' => ':attribute ត្រូវតែជា true ឬ false។',
    'can' => ':attribute មានតម្លៃដែលមិនត្រូវបានអនុញ្ញាត។',
    'confirmed' => 'ការបញ្ជាក់ :attribute មិនត្រូវគ្នា។',
    'contains' => ':attribute មិនមានតម្លៃដែលត្រូវការ។',
    'current_password' => 'ពាក្យសម្ងាត់មិនត្រឹមត្រូវ។',
    'date' => ':attribute ត្រូវតែជាថ្ងៃសុពលភាព។',
    'date_equals' => ':attribute ត្រូវតែជាថ្ងៃដូចគ្នានឹង :date។',
    'date_format' => ':attribute ត្រូវតែត្រូវគ្នានឹងទ្រង់ទ្រាយ :format។',
    'decimal' => ':attribute ត្រូវតែមាន :decimal ខ្ទង់ទសភាគ។',
    'declined' => ':attribute ត្រូវតែត្រូវបានបដិសេធ។',
    'declined_if' => ':other គឺ :value នោះ :attribute ត្រូវតែត្រូវបានបដិសេធ។',
    'different' => ':attribute និង :other ត្រូវតែខុសគ្នា។',
    'digits' => ':attribute ត្រូវតែមាន :digits ខ្ទង់។',
    'digits_between' => ':attribute ត្រូវតែមានចន្លោះ :min និង :max ខ្ទង់។',
    'dimensions' => ':attribute មានទំហំរូបភាពមិនសុពលភាព។',
    'distinct' => ':attribute មានតម្លៃស្ទួន។',
    'doesnt_end_with' => ':attribute មិនត្រូវបញ្ចប់ដោយមួយក្នុងចំណោម: :values។',
    'doesnt_start_with' => ':attribute មិនត្រូវចាប់ផ្តើមដោយមួយក្នុងចំណោម: :values។',
    'email' => ':attribute ត្រូវតែជាអាសយដ្ឋានអ៊ីមែលសុពលភាព។',
    'ends_with' => ':attribute ត្រូវតែបញ្ចប់ដោយមួយក្នុងចំណោម: :values។',
    'enum' => 'ជម្រើស :attribute មិនសុពលភាព។',
    'exists' => 'ជម្រើស :attribute មិនសុពលភាព។',
    'extensions' => ':attribute ត្រូវតែមានការពង្រីកមួយក្នុងចំណោម: :values។',
    'file' => ':attribute ត្រូវតែជាឯកសារ។',
    'filled' => ':attribute ត្រូវតែមានតម្លៃ។',
    'gt' => [
        'array' => ':attribute ត្រូវតែមានច្រើនជាង :value ធាតុ។',
        'file' => ':attribute ត្រូវតែធំជាង :value 킬ូបៃត។',
        'numeric' => ':attribute ត្រូវតែធំជាង :value។',
        'string' => ':attribute ត្រូវតែមានច្រើនជាង :value តួអក្សរ។',
    ],
    'gte' => [
        'array' => ':attribute ត្រូវតែមាន :value ធាតុ ឬច្រើនជាង។',
        'file' => ':attribute ត្រូវតែធំជាង ឬ ស្មើនឹង :value 킬ូបៃត។',
        'numeric' => ':attribute ត្រូវតែធំជាង ឬ ស្មើនឹង :value។',
        'string' => ':attribute ត្រូវតែធំជាង ឬ ស្មើនឹង :value តួអក្សរ។',
    ],
    'hex_color' => ':attribute ត្រូវតែជាពណ៌ហែកសុពលភាព។',
    'image' => ':attribute ត្រូវតែជារូបភាព។',
    'in' => 'ជម្រើស :attribute មិនសុពលភាព។',
    'in_array' => ':attribute ត្រូវតែមាននៅក្នុង :other។',
    'in_array_keys' => ':attribute ត្រូវតែមានកូនសោមួយក្នុងចំណោម: :values។',
    'integer' => ':attribute ត្រូវតែជាចំនួនគត់។',
    'ip' => ':attribute ត្រូវតែជាអាសយដ្ឋាន IP សុពលភាព។',
    'ipv4' => ':attribute ត្រូវតែជាអាសយដ្ឋាន IPv4 សុពលភាព។',
    'ipv6' => ':attribute ត្រូវតែជាអាសយដ្ឋាន IPv6 សុពលភាព។',
    'json' => ':attribute ត្រូវតែជាខ្សែអក្សរ JSON សុពលភាព។',
    'list' => ':attribute ត្រូវតែជាបញ្ជី។',
    'lowercase' => ':attribute ត្រូវតែជាអក្សរតូច។',
    'lt' => [
        'array' => ':attribute ត្រូវតែមានតិចជាង :value ធាតុ។',
        'file' => ':attribute ត្រូវតែតិចជាង :value 킬ូបៃត។',
        'numeric' => ':attribute ត្រូវតែតិចជាង :value។',
        'string' => ':attribute ត្រូវតែតិចជាង :value តួអក្សរ។',
    ],
    'lte' => [
        'array' => ':attribute មិនត្រូវលើសពី :value ធាតុទេ។',
        'file' => ':attribute ត្រូវតែតិចជាង ឬ ស្មើនឹង :value 킬ូបៃត។',
        'numeric' => ':attribute ត្រូវតែតិចជាង ឬ ស្មើនឹង :value។',
        'string' => ':attribute ត្រូវតែតិចជាង ឬ ស្មើនឹង :value តួអក្សរ។',
    ],
    'mac_address' => ':attribute ត្រូវតែជាអាសយដ្ឋាន MAC សុពលភាព។',
    'max' => [
        'array' => ':attribute មិនត្រូវលើសពី :max ធាតុទេ។',
        'file' => ':attribute មិនត្រូវលើសពី :max 킬ូបៃតទេ។',
        'numeric' => ':attribute មិនត្រូវលើសពី :max ទេ។',
        'string' => ':attribute មិនត្រូវលើសពី :max តួអក្សរទេ។',
    ],
    'max_digits' => ':attribute មិនត្រូវលើសពី :max ខ្ទង់ទេ។',
    'mimes' => ':attribute ត្រូវតែជាឯកសារប្រភេទ: :values។',
    'mimetypes' => ':attribute ត្រូវតែជាឯកសារប្រភេទ: :values។',
    'min' => [
        'array' => ':attribute ត្រូវតែមានយ៉ាងហោចណាស់ :min ធាតុ។',
        'file' => ':attribute ត្រូវតែមានយ៉ាងហោចណាស់ :min 킬ូបៃត។',
        'numeric' => ':attribute ត្រូវតែមានយ៉ាងហោចណាស់ :min។',
        'string' => ':attribute ត្រូវតែមានយ៉ាងហោចណាស់ :min តួអក្សរ។',
    ],
    'min_digits' => ':attribute ត្រូវតែមានយ៉ាងហោចណាស់ :min ខ្ទង់។',
    'missing' => ':attribute មិនត្រូវមានទេ។',
    'missing_if' => ':other គឺ :value នោះ :attribute មិនត្រូវមានទេ។',
    'missing_unless' => ':other មិនមែន :value ទេ លើកលែងតែ :attribute មិនត្រូវមានទេ។',
    'missing_with' => ':values មាន នោះ :attribute មិនត្រូវមានទេ។',
    'missing_with_all' => ':values មាន នោះ :attribute មិនត្រូវមានទេ។',
    'multiple_of' => ':attribute ត្រូវតែជាពហុគុណនៃ :value។',
    'not_in' => 'ជម្រើស :attribute មិនសុពលភាព។',
    'not_regex' => 'ទ្រង់ទ្រាយ :attribute មិនសុពលភាព។',
    'numeric' => ':attribute ត្រូវតែជាលេខ។',
    'password' => [
        'letters' => ':attribute ត្រូវតែមានអក្សរយ៉ាងហោចណាស់មួយ។',
        'mixed' => ':attribute ត្រូវតែមានអក្សរធំ និង អក្សរតូចយ៉ាងហោចណាស់មួយ។',
        'numbers' => ':attribute ត្រូវតែមានលេខយ៉ាងហោចណាស់មួយ។',
        'symbols' => ':attribute ត្រូវតែមានសញ្ញាយ៉ាងហោចណាស់មួយ។',
        'uncompromised' => ':attribute ដែលផ្តល់ឱ្យត្រូវបានរកឃើញក្នុងការហូរចេញទិន្នន័យ។ សូមជ្រើសរើស :attribute ផ្សេងទៀត។',
    ],
    'present' => ':attribute ត្រូវតែមាន។',
    'present_if' => ':other គឺ :value នោះ :attribute ត្រូវតែមាន។',
    'present_unless' => ':other មិនមែន :value ទេ លើកលែងតែ :attribute ត្រូវតែមាន។',
    'present_with' => ':values មាន នោះ :attribute ត្រូវតែមាន។',
    'present_with_all' => ':values មាន នោះ :attribute ត្រូវតែមាន។',
    'prohibited' => ':attribute ត្រូវបានហាមឃាត់។',
    'prohibited_if' => ':other គឺ :value នោះ :attribute ត្រូវបានហាមឃាត់។',
    'prohibited_if_accepted' => ':other ត្រូវបានទទួលយក នោះ :attribute ត្រូវបានហាមឃាត់។',
    'prohibited_if_declined' => ':other ត្រូវបានបដិសេធ នោះ :attribute ត្រូវបានហាមឃាត់។',
    'prohibited_unless' => ':other មិនមែនស្ថិតក្នុង :values ទេ លើកលែងតែ :attribute ត្រូវបានហាមឃាត់។',
    'prohibits' => ':attribute ហាមឃាត់ :other មិនឱ្យមាន។',
    'regex' => 'ទ្រង់ទ្រាយ :attribute មិនសុពលភាព។',
    'required' => ':attribute ត្រូវបានទាមទារ។',
    'required_array_keys' => ':attribute ត្រូវតែមានធាតុសម្រាប់: :values។',
    'required_if' => ':other គឺ :value នោះ :attribute ត្រូវបានទាមទារ។',
    'required_if_accepted' => ':other ត្រូវបានទទួលយក នោះ :attribute ត្រូវបានទាមទារ។',
    'required_if_declined' => ':other ត្រូវបានបដិសេធ នោះ :attribute ត្រូវបានទាមទារ។',
    'required_unless' => ':other មិនមែនស្ថិតក្នុង :values ទេ លើកលែងតែ :attribute ត្រូវបានទាមទារ។',
    'required_with' => ':values មាន នោះ :attribute ត្រូវបានទាមទារ។',
    'required_with_all' => ':values មាន នោះ :attribute ត្រូវបានទាមទារ។',
    'required_without' => ':values គ្មាន នោះ :attribute ត្រូវបានទាមទារ។',
    'required_without_all' => ':values គ្មាន នោះ :attribute ត្រូវបានទាមទារ។',
    'same' => ':attribute ត្រូវតែដូចគ្នានឹង :other។',
    'size' => [
        'array' => ':attribute ត្រូវតែមាន :size ធាតុ។',
        'file' => ':attribute ត្រូវតែមាន :size 킬ូបៃត។',
        'numeric' => ':attribute ត្រូវតែមាន :size។',
        'string' => ':attribute ត្រូវតែមាន :size តួអក្សរ។',
    ],
    'starts_with' => ':attribute ត្រូវតែចាប់ផ្តើមដោយមួយក្នុងចំណោម: :values។',
    'string' => ':attribute ត្រូវតែជាខ្សែអក្សរ។',
    'timezone' => ':attribute ត្រូវតែជាតំបន់ពេលវេលាសុពលភាព។',
    'unique' => ':attribute ត្រូវបានប្រើរួចហើយ។',
    'uploaded' => ':attribute បានផ្ទុកឡើងមិនជោគជ័យ។',
    'uppercase' => ':attribute ត្រូវតែជាអក្សរធំ។',
    'url' => ':attribute ត្រូវតែជាអាសយដ្ឋាន URL សុពលភាព។',
    'ulid' => ':attribute ត្រូវតែជា ULID សុពលភាព។',
    'uuid' => ':attribute ត្រូវតែជា UUID សុពលភាព។',

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
            'rule-name' => 'សារកំណត់',
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
