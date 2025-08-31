<?php

return [
    'index' => [
        'title' => 'Danh sách công thức',

        'table' => [
            'name'           => 'Tên công thức',
            'description'    => 'Mô tả',
            'status'         => 'Trạng thái',
            'action'         => 'Hành động',
            'active'         => 'Hoạt động',
            'inactive'       => 'Không hoạt động',
            'delete_confirm' => 'Bạn có chắc chắn muốn xóa công thức này không?',
        ],

    ],

    'form' => [
        'name'                => 'Tên công thức',
        'description'         => 'Mô tả',
        'active'              => 'Hoạt động',
        'jumlah_kamar'        => 'Số lượng phòng',
        'mengajar'            => 'Dạy học',
        'pembersihan_khusus'  => 'Dọn dẹp đặc biệt',
        'mengangkat_barang'   => 'Khiêng đồ',
        'membersihkan_gudang' => 'Dọn dẹp kho',
        'obat_pool'           => 'Thuốc bể bơi',
        'membersihkan_pool'   => 'Dọn dẹp bể bơi',
        'sampah'              => 'Rác',
    ],

    'create' => [
        'title' => 'Thêm kiểm tra công thức',
    ],

    'edit' => [
        'title' => 'Chỉnh sửa kiểm tra công thức',
    ],

    'show' => [
        'title' => 'Chi tiết kiểm tra công thức',
    ],

    'controller' => [
        'index' => [
            'title' => 'Kiểm tra công thức | Trang chủ',
        ],

        'create' => [
            'title' => 'Thêm kiểm tra công thức | Trang chủ',
            'success_create' => 'Công thức đã được thêm thành công.',
        ],

        'show' => [
            'title' => 'Chi tiết kiểm tra công thức | Trang chủ',
        ],

        'edit' => [
            'title' => 'Chỉnh sửa kiểm tra công thức | Trang chủ',
            'error_edit' => 'Ít nhất một công thức phải vẫn hoạt động.',
            'success_edit' => 'Công thức đã được cập nhật thành công.',
        ],

        'delete' => [
            'error_delete' => 'Công thức đang hoạt động không thể bị xóa.',
            'success_delete' => 'Dữ liệu công thức đã được xóa thành công.',
        ],

        'validation' => [
            'name.required' => 'Trường tên là bắt buộc.',
            'name.string'   => 'Tên phải là văn bản.',
            'name.max'      => 'Tên không được vượt quá 255 ký tự.',

            'description.required' => 'Trường mô tả là bắt buộc.',
            'description.string'   => 'Mô tả phải là văn bản.',

            'jumlah_kamar.required' => 'Số lượng phòng là bắt buộc.',
            'jumlah_kamar.numeric'  => 'Số lượng phòng phải là số.',

            'mengajar.required' => 'Giá trị dạy học là bắt buộc.',
            'mengajar.numeric'  => 'Giá trị dạy học phải là số.',

            'pembersihan_khusus.required' => 'Giá trị dọn dẹp đặc biệt là bắt buộc.',
            'pembersihan_khusus.numeric'  => 'Giá trị dọn dẹp đặc biệt phải là số.',

            'mengangkat_barang.required' => 'Giá trị khiêng đồ là bắt buộc.',
            'mengangkat_barang.numeric'  => 'Giá trị khiêng đồ phải là số.',

            'membersihkan_gudang.required' => 'Giá trị dọn dẹp kho là bắt buộc.',
            'membersihkan_gudang.numeric'  => 'Giá trị dọn dẹp kho phải là số.',

            'obat_pool.required' => 'Giá trị thuốc bể bơi là bắt buộc.',
            'obat_pool.numeric'  => 'Giá trị thuốc bể bơi phải là số.',

            'membersihkan_pool.required' => 'Giá trị dọn dẹp bể bơi là bắt buộc.',
            'membersihkan_pool.numeric'  => 'Giá trị dọn dẹp bể bơi phải là số.',

            'sampah.required' => 'Giá trị rác là bắt buộc.',
            'sampah.numeric'  => 'Giá trị rác phải là số.',
        ]
    ],

];