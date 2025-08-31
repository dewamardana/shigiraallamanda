<?php

return [
    'index' => [
        'title' => 'Nhiệm vụ văn phòng',
    ],

    'table' => [
        'name' => 'Tên nhóm',
        'status' => 'Trạng thái',
        'action' => 'Hành động',
        'active' => 'Hoạt động',
        'inactive' => 'Không hoạt động',
        'show' => 'Xem',
        'edit' => 'Sửa',
        'delete' => 'Xóa',
        'delete_confirm' => 'Bạn có chắc chắn muốn xóa nhóm này không?',
    ],

    'create' => [
        'title' => 'Thêm nhóm nhiệm vụ',
    ],

    'form' => [
        'name' => 'Tên nhóm',
        'active' => 'Hoạt động',
    ],

    'edit' => [
        'title' => 'Sửa nhóm nhiệm vụ',
    ],

    'controller' => [
        'index' => [
            'title' => 'Nhóm nhiệm vụ hoạt động | Bảng điều khiển',
        ],

        'create' => [
            'title' => 'Tạo nhóm nhiệm vụ | Bảng điều khiển',
            'success_add' => 'Nhóm nhiệm vụ đã được tạo thành công.',
        ],

        'show' => [
            'title' => 'Nhóm nhiệm vụ hoạt động | Bảng điều khiển',
        ],

        'edit' => [
            'title' => 'Sửa nhóm nhiệm vụ | Bảng điều khiển',
            'error_edit' => 'Không thể vô hiệu hóa tất cả nhiệm vụ. Ít nhất một nhiệm vụ phải vẫn hoạt động.',
            'success_edit' => 'Nhóm nhiệm vụ đã được cập nhật thành công.',
        ],

        'delete' => [
            'error_delete' => 'Nhóm nhiệm vụ đang hoạt động không thể bị xóa.',
            'success_delete' => 'Dữ liệu nhóm nhiệm vụ đã được xóa thành công.',
        ],
    ]
];