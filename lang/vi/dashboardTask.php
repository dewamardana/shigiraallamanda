<?php

return [
    'show' => [
        'title' => '📋 Nhiệm vụ cho ":name"',
    ],

    'table' => [
        'task_name' => 'Tên nhiệm vụ',
        'point'     => 'Điểm',
        'action'    => 'Hành động',
    ],

    'form' => [
        'task_name'         => 'Tên nhiệm vụ',
        'point'             => 'Điểm',
        'placeholder_point' => '0',
    ],

    'create' => [
        'title' => 'Thêm nhiệm vụ cho ":name"',
    ],

    'edit' => [
        'title' => 'Chỉnh sửa nhiệm vụ ":name"',
    ],

    'controller' => [
        'create' => [
            'title'        => 'Thêm nhiệm vụ | Bảng điều khiển',
            'success_add'  => 'Nhiệm vụ đã được thêm thành công.',
        ],

        'edit' => [
            'title'          => 'Chỉnh sửa nhiệm vụ | Bảng điều khiển',
            'success_update' => 'Nhiệm vụ đã được cập nhật thành công.',
        ],

        'delete' => [
            'success_delete' => 'Nhiệm vụ đã được xóa thành công.',
        ],
    ],

    'validation' => [
        'required' => 'Trường này là bắt buộc.',
        'number'   => 'Vui lòng nhập số hợp lệ.',
    ],
];