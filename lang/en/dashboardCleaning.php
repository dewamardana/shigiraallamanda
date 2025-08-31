<?php

return [
    'cleaningdata' => [
        'title'            => 'Cleaning Data Dashboard',
        'filter_building'  => 'Building:',
        'filter_all'       => 'All Building',
        'filter_user'      => 'Filter by User',
        'members' => 'Member(s)',
        'table' => [
            'date'      => 'Date',
            'name'      => 'Name',
            'oa'        => 'OA',
            'ov'        => 'OV',
            'stay'      => 'Stay',
            'vec'       => 'Vec',
            'premier'   => 'Premier',
            'total'     => 'Total',
            'point'     => 'Point',
            'total_info' => 'Total',
            'member' => 'member',
        ],
    ],

    'checkdata' => [
        'title' => 'Checker Data',
        'user' => 'User',
        'all'  => 'All',
        'table' => [
            'date'       => 'Date',
            'name'       => 'Name',
            'room'       => 'Room',
            'total'      => 'Total',
            'no_data'    => 'No data found.',
        ],
    ],
    'officedata' => [
        'title'        => 'Office Data',
        'table' => [
            'no'         => 'No',
            'date'       => 'Date',
            'user'       => 'User',
            'task_group' => 'Task Group',
            'task_point' => 'Task & Point',
            'total'      => 'Total Points',
            'empty'      => 'No office records found.',
        ],
    ],

    'userpoint' => [
        'title'         => 'Monthly Points Recap',
        'filter_year'   => 'Year',
        'filter_month'  => 'Month',
        'table' => [
            'no'      => 'No',
            'name'    => 'Name',
            'day'     => 'Day',
            'total'   => 'Total',
        ],
    ],

    'cleaningHistory' => [
        'title' => 'Cleaning Data',
        'cleaning_title' => '📊 Displaying All Cleaning Input Data.',
        'checker_title' => '📊 Displaying All Checking And Office Data.',
        'table' => [
            'no' => 'No',
            'date' => 'Date',
            'input_by' => 'Input By',
            'building' => 'Building',
            'oa' => 'OA',
            'ov' => 'OV',
            'stay' => 'Stay',
            'vec' => 'Vec',
            'premier' => 'Premier',
            'total_room' => 'Total Room',
            'total_point' => 'Total Point',
            'point_per_member' => 'Point Member',
            'members' => 'Members',
            'no_data' => 'No data available.',
        ],
    ],

    'checkRecords' => [
        'title' => 'Checker and Office Records Data',
        'table' => [
            'no' => 'No',
            'date' => 'Date',
            'type' => 'Type',
            'input_by' => 'Input By',
            'total_point' => 'Total Point',
            'point_per_member' => 'Point / Member',
            'no_data' => 'No data available',
        ],
    ],
    'controller' => [
        'indextitle' => 'Cleaning Data Dashboard',
        // Header exportCleaningData
        'header_name_member'  => 'Member Name',
        'header_oa'           => 'OA',
        'header_ov'           => 'OV',
        'header_stay'         => 'Stay',
        'header_vec'          => 'Vec',
        'header_premier'      => 'Premier',
        'header_total'        => 'Total',
        'header_name_member2' => 'Member Name',
        'header_poin'         => 'Poin',

        //Header Office Data Export
        'header_date'        => 'Date',
        'header_user'        => 'User',
        'header_task_group'  => 'Task Group',
        'header_task'        => 'Task',
        'header_point'       => 'Point',
        'header_total_point' => 'Total Point',


        // Header exportRekapBulanan
        'header_no'           => 'No',
        'header_nama'         => 'Name',
        'header_day'          => 'Day',
        'header_total_poin'   => 'Total Points',

        // Filename
        'filename_cleaning'   => 'Cleaning Report',
        'filename_rekap'      => 'Monthly Report',
        'checkerDataTitle' => 'Checker Points Data | Dashboard',

        'no_active_formula' => 'No active formula found.',
        'filename' => 'Checker_Report.xlsx',

        'headers' => [
            'no' => 'No',
            'date' => 'Date',
            'name' => 'Name',
            'room_count' => 'Room Count',
            'total_points' => 'Total Points',
        ],
        'officedata' => [
            'title' => 'Office Data | Dashboard',
        ],
        'userPoint' => [
            'title' => 'Member Points Summary | Dashboard',
        ],
        'CleaningHistoryData' => [
            'title' => 'Cleaning Input History',
        ],
        'CheckOfficeHistoryData' => [
            'title' => 'Check and Office History | Dashboard',
        ],
    ],


];
