<?php

return [
    'index' => [
        'title'  => '📋 Dữ liệu tòa nhà',
        'table' => [
            'photo'        => 'Hình ảnh',
            'name'         => 'Tên',
            'description'  => 'Mô tả',
            'action'       => 'Hành động',
            'edit'         => 'Chỉnh sửa',
        ],
    ],

    'form' => [
        'building_image'      => 'Hình ảnh tòa nhà',
        'image_hint'          => 'Nhấn vào hình để thay đổi',
        'image_upload'        => 'Tải tệp lên',
        'upload_hint'         => 'SVG, PNG, JPG hoặc GIF (Tỉ lệ 1:1)',
        'building_name'       => 'Tên tòa nhà',
        'description'         => 'Mô tả',
    ],

    'create' => [
        'title'               => 'Thêm tòa nhà',
    ],

    'edit' => [
        'title'               => 'Chỉnh sửa tòa nhà',
    ],

    'controller' => [
        'index' => [
            'title'   => 'Trang tòa nhà | Bảng điều khiển',
        ],
        'create' => [
            'title'   => 'Thêm tòa nhà | Bảng điều khiển',
            'success_add'   => 'Thêm tòa nhà thành công!',
        ],
        'show' => [
            'title'   => 'Chi tiết tòa nhà | Bảng điều khiển',
        ],
        'edit' => [
            'title'   => 'Chỉnh sửa tòa nhà | Bảng điều khiển',
            'success_update' => 'Cập nhật tòa nhà thành công!',
        ],
        'delete' => [
            'success_delete' => 'Xóa dữ liệu tòa nhà thành công!',
        ],

        'validation' => [
            'building_name_required' => 'Tên tòa nhà là bắt buộc.',
            'slug_required'          => 'Slug là bắt buộc.',
            'slug_unique'            => 'Slug đã được sử dụng.',
            'description_required'   => 'Mô tả là bắt buộc.',
            'photo_image'            => 'Tệp tải lên phải là hình ảnh.',
            'photo_mimes'            => 'Hình ảnh phải có định dạng: jpeg, png, jpg hoặc gif.',
            'photo_max'              => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ],
    ]

];
