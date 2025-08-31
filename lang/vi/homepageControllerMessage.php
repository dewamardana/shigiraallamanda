<?php

return [
    'index' => [
        'title'       => 'Trang chủ | Trang web',
    ],

    'cleaning' => [
        'title'       => 'Nhập liệu dọn dẹp | Trang web',
        'validation' => [
            'building_required'      => 'Phải chọn tòa nhà.',
            'building_id_exists'     => 'Không tìm thấy tòa nhà.',
            'oa_required'            => 'Giá trị OA là bắt buộc.',
            'ov_required'            => 'Giá trị OV là bắt buộc.',
            'stay_required'          => 'Giá trị Stay là bắt buộc.',
            'vec_required'           => 'Giá trị Vec là bắt buộc.',
            'total_room_required'    => 'Số lượng phòng là bắt buộc.',
            'members_required'       => 'Phải chọn ít nhất một thành viên.',

            'building_exists'        => 'Tòa nhà đã chọn không tồn tại.',
            'oa_integer'             => 'OA phải là số nguyên.',
            'oa_min'                 => 'OA không được âm.',
            'ov_integer'             => 'OV phải là số nguyên.',
            'ov_min'                 => 'OV không được âm.',
            'stay_integer'           => 'Stay phải là số nguyên.',
            'stay_min'               => 'Stay không được âm.',
            'vec_integer'            => 'Vec phải là số nguyên.',
            'vec_min'                => 'Vec không được âm.',
            'total_room_integer'     => 'Số lượng phòng phải là số nguyên.',
            'total_room_min'         => 'Số lượng phòng không được âm.',
            'members_array'          => 'Thành viên phải ở dạng mảng.',
            'members_exists'         => 'Thành viên đã chọn không tồn tại.',

            'date_required' => 'Ngày là bắt buộc.',
            'date_date'     => 'Định dạng ngày không hợp lệ.',
        ],
        'warning_formula'  => 'Công thức không khả dụng cho tòa nhà và số lượng thành viên này.',
        'success_store'    => 'Dữ liệu đã được lưu thành công.',
    ],

    'checker' => [
        'title' => 'Nhập liệu Checker | Trang web',
        'validation' => [
            'user_id_required'       => 'Tên nhân viên là bắt buộc.',
            'user_id_exists'         => 'Không tìm thấy nhân viên.',
            'date_required'          => 'Ngày là bắt buộc.',
            'date_date'              => 'Định dạng ngày không hợp lệ.',
            'jumlah_kamar_required'  => 'Số lượng phòng là bắt buộc.',
            'jumlah_kamar_integer'   => 'Số lượng phòng phải là số nguyên.',
            'jumlah_kamar_min'       => 'Số lượng phòng không được nhỏ hơn 0.',
        ],
        'error_no_formula'         => 'Lỗi hệ thống: công thức không khả dụng.',
        'success_store'            => 'Dữ liệu đã được lưu thành công!',
    ],

    'office' => [
        'title' => 'Nhập liệu Văn phòng | Trang web',
        'validation' => [
            'user_id_required'       => 'Tên nhân viên là bắt buộc.',
            'user_id_exists'         => 'Không tìm thấy nhân viên.',
            'date_required'          => 'Ngày là bắt buộc.',
            'date_date'              => 'Định dạng ngày không hợp lệ.',
            'tasks_required'         => 'Phải chọn ít nhất một nhiệm vụ.',
            'tasks_array'            => 'Nhiệm vụ phải ở dạng mảng.',
            'task_group_id_required' => 'Phải chọn nhóm nhiệm vụ.',
            'task_group_id_exists'   => 'Nhóm nhiệm vụ đã chọn không tồn tại.',
        ],
        'success_store' => 'Dữ liệu đã được lưu thành công!',
    ],

    'history' => [
        'title' => 'Dữ liệu Lịch sử | Trang web',
    ],

    'report' => [
        'title' => 'Tạo Báo cáo | Trang web',
        'validation' => [
            'user_id_required'     => 'Phải chọn người dùng.',
            'user_id_exists'       => 'Người dùng đã chọn không tồn tại.',
            'report_type_required' => 'Loại báo cáo là bắt buộc.',
            'report_type_string'   => 'Loại báo cáo phải là văn bản.',
            'report_type_max'      => 'Loại báo cáo không được vượt quá 255 ký tự.',
            'description_required' => 'Mô tả là bắt buộc.',
            'description_string'   => 'Mô tả phải là văn bản.',
            'photos_image'         => 'Mỗi ảnh phải là hình ảnh.',
            'photos_mimes'         => 'Ảnh phải là tệp có định dạng: jpeg, png, jpg, gif.',
            'photos_max'           => 'Kích thước ảnh không được vượt quá 2MB.',
            'videos_mimetypes'     => 'Video phải là tệp hợp lệ (mp4, avi, mpeg, quicktime).',
            'videos_max'           => 'Kích thước video không được vượt quá 100MB.',
            'members_array'        => 'Thành viên phải là mảng.',
            'members_exists'       => 'Thành viên đã chọn không tồn tại.',
            'date_required'        => 'Ngày là bắt buộc.',
            'date_date'            => 'Định dạng ngày không hợp lệ.',
        ],
        'success_store' => 'Báo cáo đã được lưu thành công.',
        'failed_store'  => 'Lưu báo cáo thất bại: :message',
    ],

    'reportHistory' => [
        'title' => 'Lịch sử Báo cáo | Trang web',
    ]
];