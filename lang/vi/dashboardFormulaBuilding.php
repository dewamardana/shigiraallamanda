<?php

return [
    'index' => [
        'title'  => '📊 Công thức dữ liệu',

        'table' => [
            'building'     => 'Tòa nhà',
            'member'       => 'Thành viên',
            'oa'           => 'OA',
            'ov'           => 'OV',
            'stay'         => 'Ở lại',
            'vec'          => 'Vec',
            'premier'      => 'Premier',
            'action'       => 'Hành động',
        ],
    ],
    'create' => [
        'title'                 => 'Thêm công thức',
    ],

    'form' => [
        'building_label'        => 'Tên tòa nhà',
        'building_placeholder'  => 'Chọn tòa nhà',
        'member_label'          => "Số lượng thành viên (số hoặc 'ngẫu nhiên')",
        'oa_label'              => 'OA',
        'ov_label'              => 'OV',
        'stay_label'            => 'Ở lại',
        'vec_label'             => 'Vec',
        'premier_label'         => 'Premier',
    ],
    'edit' => [
        'title'                 => 'Chỉnh sửa công thức',
    ],
    'show' => [
        'title'          => 'Chi tiết công thức',
        'building_name'  => 'Tên tòa nhà',
        'member_count'   => 'Số lượng thành viên',
        'oa'             => 'OA',
        'ov'             => 'OV',
        'stay'           => 'Ở lại',
        'vec'            => 'Vec',
        'premier'        => 'Premier',
    ],
    'controller' => [
        'index' => [
            'title' => 'Công thức dữ liệu | Bảng điều khiển',
        ],
        'create' => [
            'title' => 'Thêm công thức | Bảng điều khiển',
            'success_add'      => 'Công thức đã được thêm thành công!',
        ],
        'edit' => [
            'title' => 'Chỉnh sửa công thức | Bảng điều khiển',
            'success_update'   => 'Công thức đã được cập nhật thành công!',
        ],
        'show' => [
            'title' => 'Chi tiết công thức | Bảng điều khiển',
        ],
        'delete' => [
            'title' => '',
            'success_delete'   => 'Công thức đã được xóa thành công!',
        ],
        'validation' => [
            'building_slug_required' => 'Slug tòa nhà là bắt buộc.',
            'member_count_required'  => 'Số lượng thành viên là bắt buộc.',
            'oa_required'            => 'Giá trị OA là bắt buộc.',
            'ov_required'            => 'Giá trị OV là bắt buộc.',
            'stay_required'          => 'Giá trị Ở lại là bắt buộc.',
            'vec_required'           => 'Giá trị Vec là bắt buộc.',
            'premier_numeric'        => 'Giá trị Premier phải là số.',
        ],
    ],
];
