<?php

return [
    'cleaningdata' => [
        'title'            => 'Bảng điều khiển Dữ liệu Vệ sinh',
        'filter_building'  => 'Tòa nhà:',
        'filter_all'       => 'Tất cả Tòa nhà',
        'filter_user'      => 'Lọc theo Người dùng',
        'members' => 'Thành viên',
        'table' => [
            'date'      => 'Ngày',
            'name'      => 'Tên',
            'oa'        => 'OA',
            'ov'        => 'OV',
            'stay'      => 'Lưu trú',
            'vec'       => 'Vec',
            'premier'   => 'Premier',
            'total'     => 'Tổng',
            'point'     => 'Điểm',
            'total_info' => 'Tổng',
            'member' => 'thành viên',
        ],
    ],

    'checkdata' => [
        'title' => 'Dữ liệu Kiểm tra',
        'user' => 'Người dùng',
        'all'  => 'Tất cả',
        'table' => [
            'date'       => 'Ngày',
            'name'       => 'Tên',
            'room'       => 'Phòng',
            'total'      => 'Tổng',
            'no_data'    => 'Không tìm thấy dữ liệu.',
        ],
    ],
    'officedata' => [
        'title'        => 'Dữ liệu Văn phòng',
        'table' => [
            'no'         => 'Số',
            'date'       => 'Ngày',
            'user'       => 'Người dùng',
            'task_group' => 'Nhóm Nhiệm vụ',
            'task_point' => 'Nhiệm vụ & Điểm',
            'total'      => 'Tổng điểm',
            'empty'      => 'Không tìm thấy dữ liệu văn phòng.',
        ],
    ],

    'userpoint' => [
        'title'         => 'Tổng hợp Điểm Tháng',
        'filter_year'   => 'Năm',
        'filter_month'  => 'Tháng',
        'table' => [
            'no'      => 'Số',
            'name'    => 'Tên',
            'day'     => 'Ngày',
            'total'   => 'Tổng',
        ],
    ],

    'cleaningHistory' => [
        'title' => 'Dữ liệu Vệ sinh',
        'cleaning_title' => '📊 Hiển thị tất cả dữ liệu nhập vệ sinh.',
        'checker_title' => '📊 Hiển thị tất cả dữ liệu kiểm tra và văn phòng.',
        'table' => [
            'no' => 'Số',
            'date' => 'Ngày',
            'input_by' => 'Nhập bởi',
            'building' => 'Tòa nhà',
            'oa' => 'OA',
            'ov' => 'OV',
            'stay' => 'Lưu trú',
            'vec' => 'Vec',
            'premier' => 'Premier',
            'total_room' => 'Tổng số Phòng',
            'total_point' => 'Tổng điểm',
            'point_per_member' => 'Điểm Thành viên',
            'members' => 'Thành viên',
            'no_data' => 'Không có dữ liệu.',
        ],
    ],

    'checkRecords' => [
        'title' => 'Dữ liệu Hồ sơ Kiểm tra & Văn phòng',
        'table' => [
            'no' => 'Số',
            'date' => 'Ngày',
            'type' => 'Loại',
            'input_by' => 'Nhập bởi',
            'total_point' => 'Tổng điểm',
            'point_per_member' => 'Điểm / Thành viên',
            'no_data' => 'Không có dữ liệu',
        ],
    ],
    'controller' => [
        'indextitle' => 'Bảng điều khiển Dữ liệu Vệ sinh',
        'header_name_member'  => 'Tên Thành viên',
        'header_oa'           => 'OA',
        'header_ov'           => 'OV',
        'header_stay'         => 'Lưu trú',
        'header_vec'          => 'Vec',
        'header_premier'      => 'Premier',
        'header_total'        => 'Tổng',
        'header_name_member2' => 'Tên Thành viên',
        'header_poin'         => 'Điểm',

        'header_date'        => 'Ngày',
        'header_user'        => 'Người dùng',
        'header_task_group'  => 'Nhóm Nhiệm vụ',
        'header_task'        => 'Nhiệm vụ',
        'header_point'       => 'Điểm',
        'header_total_point' => 'Tổng điểm',

        'header_no'           => 'Số',
        'header_nama'         => 'Tên',
        'header_day'          => 'Ngày',
        'header_total_poin'   => 'Tổng điểm',

        'filename_cleaning'   => 'Báo cáo Vệ sinh',
        'filename_rekap'      => 'Báo cáo Tháng',
        'checkerDataTitle' => 'Dữ liệu Điểm Kiểm tra | Bảng điều khiển',

        'no_active_formula' => 'Không tìm thấy công thức hoạt động.',
        'filename' => 'Checker_Report.xlsx',

        'headers' => [
            'no' => 'Số',
            'date' => 'Ngày',
            'name' => 'Tên',
            'room_count' => 'Số lượng Phòng',
            'total_points' => 'Tổng điểm',
        ],
        'officedata' => [
            'title' => 'Dữ liệu Văn phòng | Bảng điều khiển',
        ],
        'userPoint' => [
            'title' => 'Tổng hợp Điểm Thành viên | Bảng điều khiển',
        ],
        'CleaningHistoryData' => [
            'title' => 'Lịch sử Nhập Vệ sinh',
        ],
        'CheckOfficeHistoryData' => [
            'title' => 'Lịch sử Kiểm tra & Văn phòng | Bảng điều khiển',
        ],
    ],
    
];
