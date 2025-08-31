<?php

return [
    'index' => [
        'title' => 'បញ្ជីរូបមន្ត',

        'table' => [
            'name'           => 'ឈ្មោះរូបមន្ត',
            'description'    => 'ការពិពណ៌នា',
            'status'         => 'ស្ថានភាព',
            'action'         => 'សកម្មភាព',
            'active'         => 'សកម្ម',
            'inactive'       => 'អសកម្ម',
            'delete_confirm' => 'តើអ្នកប្រាកដទេថាអ្នកចង់លុបរូបមន្តនេះ?',
        ],

    ],

    'form' => [
        'name'                => 'ឈ្មោះរូបមន្ត',
        'description'         => 'ការពិពណ៌នា',
        'active'              => 'សកម្ម',
        'jumlah_kamar'        => 'ចំនួនបន្ទប់',
        'mengajar'            => 'បង្រៀន',
        'pembersihan_khusus'  => 'ការសំអាតពិសេស',
        'mengangkat_barang'   => 'ការពង្រឹងទំនិញ',
        'membersihkan_gudang' => 'សំអាតឃ្លាំង',
        'obat_pool'           => 'ថ្នាំប swimming pool',
        'membersihkan_pool'   => 'សំអាតឃ្លាំង swimming pool',
        'sampah'              => 'សំរាម',
    ],

    'create' => [
        'title' => 'បន្ថែមការពិនិត្យរូបមន្ត',
    ],

    'edit' => [
        'title' => 'កែសម្រួលការពិនិត្យរូបមន្ត',
    ],

    'show' => [
        'title' => 'ព័ត៌មានលម្អិតការពិនិត្យរូបមន្ត',
    ],

    'controller' => [
        'index' => [
            'title' => 'ការពិនិត្យរូបមន្ត | ទំព័រដើម',
        ],

        'create' => [
            'title' => 'បន្ថែមការពិនិត្យរូបមន្ត | ទំព័រដើម',
            'success_create' => 'រូបមន្តត្រូវបានបន្ថែមដោយជោគជ័យ។',
        ],

        'show' => [
            'title' => 'ព័ត៌មានលម្អិតការពិនិត្យរូបមន្ត | ទំព័រដើម',
        ],

        'edit' => [
            'title' => 'កែសម្រួលការពិនិត្យរូបមន្ត | ទំព័រដើម',
            'error_edit' => 'រូបមន្តយ៉ាងហោចណាស់មួយត្រូវតែនៅសកម្ម។',
            'success_edit' => 'រូបមន្តត្រូវបានធ្វើបច្ចុប្បន្នភាពដោយជោគជ័យ។',
        ],

        'delete' => [
            'error_delete' => 'រូបមន្តដែលនៅសកម្មមិនអាចលុបបានទេ។',
            'success_delete' => 'ទិន្នន័យរូបមន្តត្រូវបានលុបដោយជោគជ័យ។',
        ],

        'validation' => [
            'name.required' => 'វាលឈ្មោះគឺជាចំបាច់។',
            'name.string'   => 'ឈ្មោះត្រូវតែជាអក្សរ។',
            'name.max'      => 'ឈ្មោះមិនត្រូវលើសពី 255 តួអក្សរ។',

            'description.required' => 'វាលការពិពណ៌នាគឺជាចំបាច់។',
            'description.string'   => 'ការពិពណ៌នាត្រូវតែជាអក្សរ។',

            'jumlah_kamar.required' => 'ចំនួនបន្ទប់គឺជាចំបាច់។',
            'jumlah_kamar.numeric'  => 'ចំនួនបន្ទប់ត្រូវតែជាលេខ។',

            'mengajar.required' => 'តម្លៃបង្រៀនគឺជាចំបាច់។',
            'mengajar.numeric'  => 'តម្លៃបង្រៀនត្រូវតែជាលេខ។',

            'pembersihan_khusus.required' => 'តម្លៃការសំអាតពិសេសគឺជាចំបាច់។',
            'pembersihan_khusus.numeric'  => 'តម្លៃការសំអាតពិសេសត្រូវតែជាលេខ។',

            'mengangkat_barang.required' => 'តម្លៃការពង្រឹងទំនិញគឺជាចំបាច់។',
            'mengangkat_barang.numeric'  => 'តម្លៃការពង្រឹងទំនិញត្រូវតែជាលេខ។',

            'membersihkan_gudang.required' => 'តម្លៃការសំអាតឃ្លាំងគឺជាចំបាច់។',
            'membersihkan_gudang.numeric'  => 'តម្លៃការសំអាតឃ្លាំងត្រូវតែជាលេខ។',

            'obat_pool.required' => 'តម្លៃថ្នាំប៊ីតគឺជាចំបាច់។',
            'obat_pool.numeric'  => 'តម្លៃថ្នាំប៊ីតត្រូវតែជាលេខ។',

            'membersihkan_pool.required' => 'តម្លៃការសំអាតឃ្លាំងប៊ីតគឺជាចំបាច់។',
            'membersihkan_pool.numeric'  => 'តម្លៃការសំអាតឃ្លាំងប៊ីតត្រូវតែជាលេខ។',

            'sampah.required' => 'តម្លៃសំរាមគឺជាចំបាច់។',
            'sampah.numeric'  => 'តម្លៃសំរាមត្រូវតែជាលេខ។',
        ]
    ],

];