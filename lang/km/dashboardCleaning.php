<?php

return [
    'cleaningdata' => [
        'title'            => 'ផ្ទាំងទិន្នន័យ សម្អាត',
        'filter_building'  => 'អគារ:',
        'filter_all'       => 'អគារ ទាំងអស់',
        'filter_user'      => 'ច្រោះតាម អ្នកប្រើប្រាស់',
        'members' => 'សមាជិក(រ)',
        'table' => [
            'date'      => 'កាលបរិច្ឆេទ',
            'name'      => 'ឈ្មោះ',
            'oa'        => 'OA',
            'ov'        => 'OV',
            'stay'      => 'ស្នាក់នៅ',
            'vec'       => 'Vec',
            'premier'   => 'Premier',
            'total'     => 'សរុប',
            'point'     => 'ពិន្ទុ',
            'total_info' => 'សរុប',
            'member' => 'សមាជិក',
        ],
    ],

    'checkdata' => [
        'title' => 'ទិន្នន័យ ពិនិត្យ',
        'user' => 'អ្នកប្រើប្រាស់',
        'all'  => 'ទាំងអស់',
        'table' => [
            'date'       => 'កាលបរិច្ឆេទ',
            'name'       => 'ឈ្មោះ',
            'room'       => 'បន្ទប់',
            'total'      => 'សរុប',
            'no_data'    => 'រកមិនឃើញទិន្នន័យ។',
        ],
    ],
    'officedata' => [
        'title'        => 'ទិន្នន័យ ការិយាល័យ',
        'table' => [
            'no'         => 'ល.រ',
            'date'       => 'កាលបរិច្ឆេទ',
            'user'       => 'អ្នកប្រើប្រាស់',
            'task_group' => 'ក្រុមភារកិច្ច',
            'task_point' => 'ភារកិច្ច & ពិន្ទុ',
            'total'      => 'ពិន្ទុ សរុប',
            'empty'      => 'រកមិនឃើញ កំណត់ត្រា ការិយាល័យ។',
        ],
    ],

    'userpoint' => [
        'title'         => 'សង្ខេប ពិន្ទុ ប្រចាំខែ',
        'filter_year'   => 'ឆ្នាំ',
        'filter_month'  => 'ខែ',
        'table' => [
            'no'      => 'ល.រ',
            'name'    => 'ឈ្មោះ',
            'day'     => 'ថ្ងៃ',
            'total'   => 'សរុប',
        ],
    ],

    'cleaningHistory' => [
        'title' => 'ទិន្នន័យ សម្អាត',
        'cleaning_title' => '📊 ការបង្ហាញទិន្នន័យ សម្អាត ទាំងអស់។',
        'checker_title' => '📊 ការបង្ហាញទិន្នន័យ ពិនិត្យ និង ការិយាល័យ ទាំងអស់។',
        'table' => [
            'no' => 'ល.រ',
            'date' => 'កាលបរិច្ឆេទ',
            'input_by' => 'បញ្ចូលដោយ',
            'building' => 'អគារ',
            'oa' => 'OA',
            'ov' => 'OV',
            'stay' => 'ស្នាក់នៅ',
            'vec' => 'Vec',
            'premier' => 'Premier',
            'total_room' => 'បន្ទប់ សរុប',
            'total_point' => 'ពិន្ទុ សរុប',
            'point_per_member' => 'ពិន្ទុ សមាជិក',
            'members' => 'សមាជិក',
            'no_data' => 'គ្មានទិន្នន័យ។',
        ],
    ],

    'checkRecords' => [
        'title' => 'ទិន្នន័យ កំណត់ត្រា ពិនិត្យ និង ការិយាល័យ',
        'table' => [
            'no' => 'ល.រ',
            'date' => 'កាលបរិច្ឆេទ',
            'type' => 'ប្រភេទ',
            'input_by' => 'បញ្ចូលដោយ',
            'total_point' => 'ពិន្ទុ សរុប',
            'point_per_member' => 'ពិន្ទុ / សមាជិក',
            'no_data' => 'គ្មានទិន្នន័យ។',
        ],
    ],
    'controller' => [
        'indextitle' => 'ផ្ទាំងទិន្នន័យ សម្អាត',
        'header_name_member'  => 'ឈ្មោះ សមាជិក',
        'header_oa'           => 'OA',
        'header_ov'           => 'OV',
        'header_stay'         => 'ស្នាក់នៅ',
        'header_vec'          => 'Vec',
        'header_premier'      => 'Premier',
        'header_total'        => 'សរុប',
        'header_name_member2' => 'ឈ្មោះ សមាជិក',
        'header_poin'         => 'ពិន្ទុ',

        'header_date'        => 'កាលបរិច្ឆេទ',
        'header_user'        => 'អ្នកប្រើប្រាស់',
        'header_task_group'  => 'ក្រុមភារកិច្ច',
        'header_task'        => 'ភារកិច្ច',
        'header_point'       => 'ពិន្ទុ',
        'header_total_point' => 'ពិន្ទុ សរុប',

        'header_no'           => 'ល.រ',
        'header_nama'         => 'ឈ្មោះ',
        'header_day'          => 'ថ្ងៃ',
        'header_total_poin'   => 'ពិន្ទុ សរុប',

        'filename_cleaning'   => 'របាយការណ៍ សម្អាត',
        'filename_rekap'      => 'របាយការណ៍ ប្រចាំខែ',
        'checkerDataTitle' => 'ទិន្នន័យ ពិន្ទុ ពិនិត្យ | ផ្ទាំង',

        'no_active_formula' => 'រកមិនឃើញ រូបមន្ត សកម្ម។',
        'filename' => 'Checker_Report.xlsx',

        'headers' => [
            'no' => 'ល.រ',
            'date' => 'កាលបរិច្ឆេទ',
            'name' => 'ឈ្មោះ',
            'room_count' => 'ចំនួន បន្ទប់',
            'total_points' => 'ពិន្ទុ សរុប',
        ],
        'officedata' => [
            'title' => 'ទិន្នន័យ ការិយាល័យ | ផ្ទាំង',
        ],
        'userPoint' => [
            'title' => 'សង្ខេប ពិន្ទុ សមាជិក | ផ្ទាំង',
        ],
        'CleaningHistoryData' => [
            'title' => 'ប្រវត្តិ សម្អាត',
        ],
        'CheckOfficeHistoryData' => [
            'title' => 'ប្រវត្តិ ពិនិត្យ និង ការិយាល័យ | ផ្ទាំង',
        ],
    ],
    
];
