<?php

return [
    'cleaningdata' => [
        'title'            => 'ផ្ទៃតាប្លូប្រចាំថ្ងៃដែលសំអាតទិន្នន័យ',
        'filter_building'  => 'អាគារ៖',
        'filter_all'       => 'អាគារទាំងអស់',
        'filter_user'      => 'តម្រងតាមអ្នកប្រើប្រាស់',
        'members' => 'សមាជិក',
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
        'title' => 'ការពិនិត្យទិន្នន័យ',
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

    'userpoint' => [
        'title'         => 'សំណុំពិន្ទុប្រចាំខែ',
        'filter_year'   => 'ឆ្នាំ',
        'filter_month'  => 'ខែ',
        'table' => [
            'no'      => 'លេខ',
            'name'    => 'ឈ្មោះ',
            'day'     => 'ថ្ងៃ',
            'total'   => 'សរុប',
        ],
    ],

    'cleaningHistory' => [
        'title' => 'ទិន្នន័យសំអាត',
        'cleaning_title' => '📊 បង្ហាញទិន្នន័យការបញ្ចូលសំអាតទាំងអស់។',
        'checker_title' => '📊 បង្ហាញទិន្នន័យការពិនិត្យ និងការិយាល័យទាំងអស់។',
        'table' => [
            'no' => 'លេខ',
            'date' => 'កាលបរិច្ឆេទ',
            'input_by' => 'បញ្ចូលដោយ',
            'building' => 'អាគារ',
            'oa' => 'OA',
            'ov' => 'OV',
            'stay' => 'ស្នាក់នៅ',
            'vec' => 'Vec',
            'premier' => 'Premier',
            'total_room' => 'បន្ទប់សរុប',
            'total_point' => 'ពិន្ទុសរុប',
            'point_per_member' => 'ពិន្ទុក្នុងមួយសមាជិក',
            'members' => 'សមាជិក',
            'no_data' => 'គ្មានទិន្នន័យ។',
        ],
    ],

    'checkRecords' => [
        'title' => 'ទិន្នន័យការពិនិត្យ និងការិយាល័យ',
        'table' => [
            'no' => 'លេខ',
            'date' => 'កាលបរិច្ឆេទ',
            'type' => 'ប្រភេទ',
            'input_by' => 'បញ្ចូលដោយ',
            'total_point' => 'ពិន្ទុសរុប',
            'point_per_member' => 'ពិន្ទុ / សមាជិក',
            'no_data' => 'គ្មានទិន្នន័យ',
        ],
    ],
    'controller' => [
        'indextitle' => 'ផ្ទៃតាប្លូប្រចាំថ្ងៃដែលសំអាតទិន្នន័យ',
        // Header exportCleaningData
        'header_name_member'  => 'ឈ្មោះសមាជិក',
        'header_oa'           => 'OA',
        'header_ov'           => 'OV',
        'header_stay'         => 'ស្នាក់នៅ',
        'header_vec'          => 'Vec',
        'header_premier'      => 'Premier',
        'header_total'        => 'សរុប',
        'header_name_member2' => 'ឈ្មោះសមាជិក',
        'header_poin'         => 'ពិន្ទុ',

        // Header exportRekapBulanan
        'header_no'           => 'លេខ',
        'header_nama'         => 'ឈ្មោះ',
        'header_day'          => 'ថ្ងៃ',
        'header_total_poin'   => 'ពិន្ទុសរុប',

        // Filename
        'filename_cleaning'   => 'របាយការណ៍សំអាត',
        'filename_rekap'      => 'របាយការណ៍ប្រចាំខែ',
        'checkerDataTitle' => 'ទិន្នន័យពិន្ទុការពិនិត្យ | ផ្ទៃតាប្លូប្រចាំថ្ងៃ',

        'no_active_formula' => 'រកមិនឃើញរូបមន្តសកម្ម។',
        'filename' => 'របាយការណ៍_Checker.xlsx',

        'headers' => [
            'no' => 'លេខ',
            'date' => 'កាលបរិច្ឆេទ',
            'name' => 'ឈ្មោះ',
            'room_count' => 'ចំនួនបន្ទប់',
            'total_points' => 'ពិន្ទុសរុប',
        ],
        'userPoint' => [
            'title' => 'សំណុំពិន្ទុសមាជិក | ផ្ទៃតាប្លូប្រចាំថ្ងៃ',
        ],
        'CleaningHistoryData' => [
            'title' => 'ប្រវត្តិការបញ្ចូលសំអាត',
        ],
        'CheckOfficeHistoryData' => [
            'title' => 'ប្រវត្តិការពិនិត្យ និងការិយាល័យ | ផ្ទៃតាប្លូប្រចាំថ្ងៃ',
        ],
    ],


];
