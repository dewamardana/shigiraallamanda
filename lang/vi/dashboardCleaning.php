<?php

return [
    'cleaningdata' => [
        'title'            => 'Bảng điều khiển Dọn dẹp dữ liệu',
        'filter_building'  => 'Tòa nhà:',
        'filter_all'       => 'Tất cả các tòa nhà',
        'filter_user'      => 'Lọc theo Người dùng',
        'members' => 'Thành viên',
        'table' => [
            'date'      => 'Ngày',
            'name'      => 'Tên',
            'oa'        => 'OA',
            'ov'        => 'OV',
            'stay'      => 'Ở lại',
            'vec'       => 'Vec',
            'premier'   => 'Premier',
            'total'     => 'Tổng cộng',
            'point'     => 'Điểm',
            'total_info' => 'Tổng cộng',
            'member' => 'thành viên',
        ],
    ],

    'checkdata' => [
        'title' => 'Kiểm tra dữ liệu',
        'user' => 'Người dùng',
        'all'  => 'Tất cả',
        'table' => [
            'date'       => 'Ngày',
            'name'       => 'Tên',
            'room'       => 'Phòng',
            'total'      => 'Tổng cộng',
            'no_data'    => 'Không tìm thấy dữ liệu.',
        ],
    ],

    'userpoint' => [
        'title'         => 'Tổng hợp điểm hàng tháng',
        'filter_year'   => 'Năm',
        'filter_month'  => 'Tháng',
        'table' => [
            'no'      => 'Số',
            'name'    => 'Tên',
            'day'     => 'Ngày',
            'total'   => 'Tổng cộng',
        ],
    ],

    'cleaningHistory' => [
        'title' => 'Dữ liệu dọn dẹp',
        'cleaning_title' => '📊 Hiển thị tất cả dữ liệu nhập dọn dẹp.',
        'checker_title' => '📊 Hiển thị tất cả dữ liệu kiểm tra và văn phòng.',
        'table' => [
            'no' => 'Số',
            'date' => 'Ngày',
            'input_by' => 'Nhập bởi',
            'building' => 'Tòa nhà',
            'oa' => 'OA',
            'ov' => 'OV',
            'stay' => 'Ở lại',
            'vec' => 'Vec',
            'premier' => 'Premier',
            'total_room' => 'Tổng số phòng',
            'total_point' => 'Tổng điểm',
            'point_per_member' => 'Điểm mỗi thành viên',
            'members' => 'Thành viên',
            'no_data' => 'Không có dữ liệu.',
        ],
    ],

    'checkRecords' => [
        'title' => 'Dữ liệu kiểm tra và văn phòng',
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
        'indextitle' => 'Bảng điều khiển Dọn dẹp dữ liệu',
        // Header exportCleaningData
        'header_name_member'  => 'Tên thành viên',
        'header_oa'           => 'OA',
        'header_ov'           => 'OV',
        'header_stay'         => 'Ở lại',
        'header_vec'          => 'Vec',
        'header_premier'      => 'Premier',
        'header_total'        => 'Tổng cộng',
        'header_name_member2' => 'Tên thành viên',
        'header_poin'         => 'Điểm',

        // Header exportRekapBulanan
        'header_no'           => 'Số',
        'header_nama'         => 'Tên',
        'header_day'          => 'Ngày',
        'header_total_poin'   => 'Tổng điểm',

        // Filename
        'filename_cleaning'   => 'Báo cáo dọn dẹp',
        'filename_rekap'      => 'Báo cáo hàng tháng',
        'checkerDataTitle' => 'Dữ liệu điểm kiểm tra | Bảng điều khiển',

        'no_active_formula' => 'Không tìm thấy công thức hoạt động.',
        'filename' => 'Báo cáo_Kiểm tra.xlsx',

        'headers' => [
            'no' => 'Số',
            'date' => 'Ngày',
            'name' => 'Tên',
            'room_count' => 'Số lượng phòng',
            'total_points' => 'Tổng điểm',
        ],
        'userPoint' => [
            'title' => 'Tóm tắt điểm thành viên | Bảng điều khiển',
        ],
        'CleaningHistoryData' => [
            'title' => 'Lịch sử nhập dọn dẹp',
        ],
        'CheckOfficeHistoryData' => [
            'title' => 'Lịch sử kiểm tra và văn phòng | Bảng điều khiển',
        ],
    ],


];
