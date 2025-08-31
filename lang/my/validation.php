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

    'accepted' => ':attribute ကိုလက်ခံရမည်ဖြစ်သည်။',
    'accepted_if' => ':other သည် :value ဖြစ်ပါက :attribute ကိုလက်ခံရမည်။',
    'active_url' => ':attribute သည် မှန်ကန်သော URL ဖြစ်ရမည်။',
    'after' => ':attribute သည် :date နောက်ပိုင်းရက်စွဲဖြစ်ရမည်။',
    'after_or_equal' => ':attribute သည် :date နောက်ပိုင်း (သို့) ညီမျှသောရက်စွဲဖြစ်ရမည်။',
    'alpha' => ':attribute တွင် အက္ခရာများသာပါဝင်ရမည်။',
    'alpha_dash' => ':attribute တွင် အက္ခရာ၊ ဂဏန်း၊ ခြစ်မျဉ်နှင့် အောက်ခြေမျဉ်များသာပါဝင်နိုင်သည်။',
    'alpha_num' => ':attribute တွင် အက္ခရာနှင့် ဂဏန်းများသာပါဝင်ရမည်။',
    'any_of' => ':attribute သည် မမှန်ပါ။',
    'array' => ':attribute သည် အခင်းဖြစ်ရမည်။',
    'ascii' => ':attribute တွင် စာလုံး၊ ဂဏန်းနှင့် သင်္ကေတများ၏ တစ်ဘိုက်စီသာပါဝင်ရမည်။',
    'before' => ':attribute သည် :date မတိုင်မီရက်စွဲဖြစ်ရမည်။',
    'before_or_equal' => ':attribute သည် :date မတိုင်မီ (သို့) ညီမျှသောရက်စွဲဖြစ်ရမည်။',
    'between' => [
        'array' => ':attribute တွင် :min နှင့် :max အကြားရှိ item များပါဝင်ရမည်။',
        'file' => ':attribute သည် :min နှင့် :max ကီလိုဘိုက်အကြားဖြစ်ရမည်။',
        'numeric' => ':attribute သည် :min နှင့် :max အကြားဖြစ်ရမည်။',
        'string' => ':attribute တွင် :min နှင့် :max အကြားရှိ စာလုံးများပါဝင်ရမည်။',
    ],
    'boolean' => ':attribute သည် true သို့မဟုတ် false ဖြစ်ရမည်။',
    'can' => ':attribute တွင် ခွင့်မပြုသောတန်ဖိုးပါဝင်နေသည်။',
    'confirmed' => ':attribute အတည်ပြုချက် မကိုက်ညီပါ။',
    'contains' => ':attribute တွင် လိုအပ်သောတန်ဖိုးမပါဝင်ပါ။',
    'current_password' => 'စကားဝှက်မှားယွင်းနေပါသည်။',
    'date' => ':attribute သည် မှန်ကန်သောရက်စွဲဖြစ်ရမည်။',
    'date_equals' => ':attribute သည် :date နှင့်တူညီသောရက်စွဲဖြစ်ရမည်။',
    'date_format' => ':attribute သည် :format ဖော်မတ်နှင့်ကိုက်ညီရမည်။',
    'decimal' => ':attribute တွင် :decimal ဒသမနေရာပါရမည်။',
    'declined' => ':attribute ကိုငြင်းပယ်ရမည်။',
    'declined_if' => ':other သည် :value ဖြစ်ပါက :attribute ကိုငြင်းပယ်ရမည်။',
    'different' => ':attribute နှင့် :other မတူညီရမည်။',
    'digits' => ':attribute သည် :digits လုံးရှိရမည်။',
    'digits_between' => ':attribute သည် :min နှင့် :max အကြားရှိ ဂဏန်းများဖြစ်ရမည်။',
    'dimensions' => ':attribute တွင် မှားယွင်းသောပုံအရွယ်အစားများရှိပါသည်။',
    'distinct' => ':attribute တွင် တူညီသောတန်ဖိုးများပါဝင်နေပါသည်။',
    'doesnt_end_with' => ':attribute သည် အောက်ပါတစ်ခုခုဖြင့် မဆုံးသင့်ပါ: :values။',
    'doesnt_start_with' => ':attribute သည် အောက်ပါတစ်ခုခုဖြင့် မစသင့်ပါ: :values။',
    'email' => ':attribute သည် မှန်ကန်သော အီးမေးလ်လိပ်စာဖြစ်ရမည်။',
    'ends_with' => ':attribute သည် အောက်ပါတစ်ခုခုဖြင့် ဆုံးရမည်: :values။',
    'enum' => ':attribute ရွေးချယ်မှုသည် မမှန်ပါ။',
    'exists' => ':attribute ရွေးချယ်မှုသည် မမှန်ပါ။',
    'extensions' => ':attribute တွင် အောက်ပါတစ်ခုခုရှိရမည်: :values။',
    'file' => ':attribute သည် ဖိုင်ဖြစ်ရမည်။',
    'filled' => ':attribute တွင် တန်ဖိုးပါဝင်ရမည်။',
    'gt' => [
        'array' => ':attribute တွင် :value ထက်ပိုသော item များပါဝင်ရမည်။',
        'file' => ':attribute သည် :value ကီလိုဘိုက်ထက်ကြီးရမည်။',
        'numeric' => ':attribute သည် :value ထက်ကြီးရမည်။',
        'string' => ':attribute သည် :value စာလုံးထက်ကြီးရမည်။',
    ],
    'gte' => [
        'array' => ':attribute တွင် :value နှင့်ညီမျှသို့မဟုတ် ပိုမိုသော item များပါဝင်ရမည်။',
        'file' => ':attribute သည် :value ကီလိုဘိုက်နှင့်ညီမျှသို့မဟုတ် ကြီးရမည်။',
        'numeric' => ':attribute သည် :value နှင့်ညီမျှသို့မဟုတ် ကြီးရမည်။',
        'string' => ':attribute သည် :value စာလုံးနှင့်ညီမျှသို့မဟုတ် ကြီးရမည်။',
    ],
    'hex_color' => ':attribute သည် မှန်ကန်သော 16 ဂဏန်းအရောင်ဖြစ်ရမည်။',
    'image' => ':attribute သည် ပုံဖြစ်ရမည်။',
    'in' => ':attribute ရွေးချယ်မှုသည် မမှန်ပါ။',
    'in_array' => ':attribute သည် :other တွင် ပါဝင်ရမည်။',
    'in_array_keys' => ':attribute တွင် အောက်ပါ key တစ်ခုခုပါဝင်ရမည်: :values။',
    'integer' => ':attribute သည် ကိန်းပြည့်ဖြစ်ရမည်။',
    'ip' => ':attribute သည် မှန်ကန်သော IP လိပ်စာဖြစ်ရမည်။',
    'ipv4' => ':attribute သည် မှန်ကန်သော IPv4 လိပ်စာဖြစ်ရမည်။',
    'ipv6' => ':attribute သည် မှန်ကန်သော IPv6 လိပ်စာဖြစ်ရမည်။',
    'json' => ':attribute သည် မှန်ကန်သော JSON စာကြောင်းဖြစ်ရမည်။',
    'list' => ':attribute သည် စာရင်းဖြစ်ရမည်။',
    'lowercase' => ':attribute သည် စာလုံးအသေးဖြစ်ရမည်။',
    'lt' => [
        'array' => ':attribute တွင် :value ထက်နည်းသော item များပါဝင်ရမည်။',
        'file' => ':attribute သည် :value ကီလိုဘိုက်ထက်နည်းရမည်။',
        'numeric' => ':attribute သည် :value ထက်နည်းရမည်။',
        'string' => ':attribute သည် :value စာလုံးထက်နည်းရမည်။',
    ],
    'lte' => [
        'array' => ':attribute တွင် :value ထက်မပိုသော item များပါဝင်ရမည်။',
        'file' => ':attribute သည် :value ကီလိုဘိုက်နှင့်ညီမျှသို့မဟုတ် နည်းရမည်။',
        'numeric' => ':attribute သည် :value နှင့်ညီမျှသို့မဟုတ် နည်းရမည်။',
        'string' => ':attribute သည် :value စာလုံးနှင့်ညီမျှသို့မဟုတ် နည်းရမည်။',
    ],
    'mac_address' => ':attribute သည် မှန်ကန်သော MAC လိပ်စာဖြစ်ရမည်။',
    'max' => [
        'array' => ':attribute တွင် :max ထက်မပိုသော item များပါဝင်ရမည်။',
        'file' => ':attribute သည် :max ကီလိုဘိုက်ထက်မပိုရ။',
        'numeric' => ':attribute သည် :max ထက်မပိုရ။',
        'string' => ':attribute တွင် :max စာလုံးထက်မပိုရ။',
    ],
    'max_digits' => ':attribute သည် :max ဂဏန်းထက်မပိုရ။',
    'mimes' => ':attribute သည် အောက်ပါဖိုင်အမျိုးအစားဖြစ်ရမည်: :values။',
    'mimetypes' => ':attribute သည် အောက်ပါဖိုင်အမျိုးအစားဖြစ်ရမည်: :values။',
    'min' => [
        'array' => ':attribute တွင် :min ထက်မနည်းသော item များပါဝင်ရမည်။',
        'file' => ':attribute သည် :min ကီလိုဘိုက်နှင့်ညီမျှသို့မဟုတ် ပိုရမည်။',
        'numeric' => ':attribute သည် :min နှင့်ညီမျှသို့မဟုတ် ပိုရမည်။',
        'string' => ':attribute တွင် :min စာလုံးနှင့်ညီမျှသို့မဟုတ် ပိုရမည်။',
    ],
    'min_digits' => ':attribute သည် :min ဂဏန်းနှင့်ညီမျှသို့မဟုတ် ပိုရမည်။',
    'missing' => ':attribute မပါဝင်ရပါ။',
    'missing_if' => ':other သည် :value ဖြစ်ပါက :attribute မပါဝင်ရပါ။',
    'missing_unless' => ':other သည် :value မဟုတ်ပါက :attribute မပါဝင်ရပါ။',
    'missing_with' => ':values ပါဝင်ပါက :attribute မပါဝင်ရပါ။',
    'missing_with_all' => ':values များပါဝင်ပါက :attribute မပါဝင်ရပါ။',
    'multiple_of' => ':attribute သည် :value ၏ များပါးဖြစ်ရမည်။',
    'not_in' => ':attribute ရွေးချယ်မှုသည် မမှန်ပါ။',
    'not_regex' => ':attribute ဖော်မတ်သည် မမှန်ပါ။',
    'numeric' => ':attribute သည် နံပါတ်ဖြစ်ရမည်။',
    'password' => [
        'letters' => ':attribute တွင် အက္ခရာတစ်လုံးအနည်းဆုံးပါဝင်ရမည်။',
        'mixed' => ':attribute တွင် အကြီးစာလုံးနှင့် အသေးစာလုံးတစ်လုံးစီအနည်းဆုံးပါဝင်ရမည်။',
        'numbers' => ':attribute တွင် ဂဏန်းတစ်လုံးအနည်းဆုံးပါဝင်ရမည်။',
        'symbols' => ':attribute တွင် သင်္ကေတတစ်ခုအနည်းဆုံးပါဝင်ရမည်။',
        'uncompromised' => 'ပေးထားသော :attribute သည် ဒေတာထွက်စောင်းမှုတွင်တွေ့ရှိရသည်။ အခြား :attribute ကိုရွေးပါ။',
    ],
    'present' => ':attribute ပါဝင်ရမည်။',
    'present_if' => ':other သည် :value ဖြစ်ပါက :attribute ပါဝင်ရမည်။',
    'present_unless' => ':other သည် :value မဟုတ်ပါက :attribute ပါဝင်ရမည်။',
    'present_with' => ':values ပါဝင်ပါက :attribute ပါဝင်ရမည်။',
    'present_with_all' => ':values များပါဝင်ပါက :attribute ပါဝင်ရမည်။',
    'prohibited' => ':attribute ကိုတားမြစ်ထားပါသည်။',
    'prohibited_if' => ':other သည် :value ဖြစ်ပါက :attribute ကိုတားမြစ်ထားပါသည်။',
    'prohibited_if_accepted' => ':other ကိုလက်ခံပါက :attribute ကိုတားမြစ်ထားပါသည်။',
    'prohibited_if_declined' => ':other ကိုငြင်းပယ်ပါက :attribute ကိုတားမြစ်ထားပါသည်။',
    'prohibited_unless' => ':other သည် :values တွင်မပါပါက :attribute ကိုတားမြစ်ထားပါသည်။',
    'prohibits' => ':attribute သည် :other ပါဝင်ခွင့်ကိုတားမြစ်ထားပါသည်။',
    'regex' => ':attribute ဖော်မတ်သည် မမှန်ပါ။',
    'required' => ':attribute ကိုလိုအပ်ပါသည်။',
    'required_array_keys' => ':attribute တွင် :values အတွက် entry ပါဝင်ရမည်။',
    'required_if' => ':other သည် :value ဖြစ်ပါက :attribute ကိုလိုအပ်ပါသည်။',
    'required_if_accepted' => ':other ကိုလက်ခံပါက :attribute ကိုလိုအပ်ပါသည်။',
    'required_if_declined' => ':other ကိုငြင်းပယ်ပါက :attribute ကိုလိုအပ်ပါသည်။',
    'required_unless' => ':other သည် :values တွင်မပါပါက :attribute ကိုလိုအပ်ပါသည်။',
    'required_with' => ':values ပါဝင်ပါက :attribute ကိုလိုအပ်ပါသည်။',
    'required_with_all' => ':values များပါဝင်ပါက :attribute ကိုလိုအပ်ပါသည်။',
    'required_without' => ':values မပါပါက :attribute ကိုလိုအပ်ပါသည်။',
    'required_without_all' => ':values တစ်ခုမှမပါပါက :attribute ကိုလိုအပ်ပါသည်။',
    'same' => ':attribute သည် :other နှင့်တူညီရမည်။',
    'size' => [
        'array' => ':attribute တွင် :size item ပါဝင်ရမည်။',
        'file' => ':attribute သည် :size ကီလိုဘိုက်ဖြစ်ရမည်။',
        'numeric' => ':attribute သည် :size ဖြစ်ရမည်။',
        'string' => ':attribute တွင် :size စာလုံးပါဝင်ရမည်။',
    ],
    'starts_with' => ':attribute သည် အောက်ပါတစ်ခုခုဖြင့်စရမည်: :values။',
    'string' => ':attribute သည် စာကြောင်းဖြစ်ရမည်။',
    'timezone' => ':attribute သည် မှန်ကန်သော အချိန်ဇုန်ဖြစ်ရမည်။',
    'unique' => ':attribute ကိုယခုအသုံးပြုနေပါသည်။',
    'uploaded' => ':attribute ကိုတင်ပို့ရန် မအောင်မြင်ပါ။',
    'uppercase' => ':attribute သည် စာလုံးအကြီးဖြစ်ရမည်။',
    'url' => ':attribute သည် မှန်ကန်သော URL ဖြစ်ရမည်။',
    'ulid' => ':attribute သည် မှန်ကန်သော ULID ဖြစ်ရမည်။',
    'uuid' => ':attribute သည် မှန်ကန်သော UUID ဖြစ်ရမည်။',
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
            'rule-name' => 'စိတ်ကြိုက်စာသား',
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
