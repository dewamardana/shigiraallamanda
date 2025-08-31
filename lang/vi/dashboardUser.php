<?php

return [
    'index' => [
        'title' => '📋 Dữ liệu nhân viên',
        'new_worker' => 'Thêm nhân viên',
        'table' => [
            'name' => 'Tên',
            'department' => 'Phòng ban',
            'gender' => 'Giới tính',
            'status' => 'Trạng thái',
            'action' => 'Hành động',
            'male' => 'Nam',
            'female' => 'Nữ',
        ],
    ],

    'form' => [
        'profile_photo' => 'Ảnh đại diện',
        'photo_hint' => 'Nhấn vào ảnh để thay đổi',
        'photo_upload' => 'Tải ảnh lên',
        'upload_hint' => 'SVG, PNG, JPG hoặc GIF (tỷ lệ 1:1)',
        'name' => 'Tên',
        'username' => 'Tên đăng nhập',
        'email' => 'Email',
        'phone_number' => 'Số điện thoại',
        'department' => 'Phòng ban',
        'gender' => 'Giới tính',
        'male' => 'Nam',
        'female' => 'Nữ',
        'status' => 'Trạng thái',
        'active' => 'Hoạt động',
        'inactive' => 'Không hoạt động',
        'password' => 'Mật khẩu',
        'role'  => 'Vai trò',
        'skill' => 'Kỹ năng',

        'name_placeholder' => 'Nhập họ tên đầy đủ',
        'username_placeholder' => 'Nhập tên đăng nhập',
        'email_placeholder' => 'Nhập địa chỉ email hoạt động',
        'phone_placeholder' => 'Nhập số điện thoại hoạt động',
        'department_placeholder' => 'Nhập tên phòng ban',
        'password_placeholder' => 'Nhập mật khẩu',
        'password_hint'       => 'Để trống nếu không muốn thay đổi mật khẩu.',
    ],

    'create' => [
        'title' => 'Thêm nhân viên',
    ],

    'edit' => [
        'title' => 'Sửa nhân viên',
    ],

    'show' => [
        'title' => 'Chi tiết nhân viên',
    ],

    'controller' => [
        'index' => [
            'title' => 'Trang nhân viên | Bảng điều khiển',
        ],

        'create' => [
            'title' => 'Thêm nhân viên | Bảng điều khiển',
        ],

        'store' => [
            'name_required'        => 'Tên là bắt buộc.',
            'username_required'    => 'Tên đăng nhập là bắt buộc.',
            'username_unique'      => 'Tên đăng nhập này đã được sử dụng. Vui lòng chọn tên khác.',
            'email_required'       => 'Địa chỉ email là bắt buộc.',
            'email_unique'         => 'Email này đã được đăng ký.',
            'password_required'    => 'Mật khẩu là bắt buộc.',
            'password_min'         => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'phone_required'       => 'Số điện thoại là bắt buộc.',
            'gender_in'            => 'Vui lòng chọn giới tính hợp lệ.',
            'photo_error'          => 'Tệp đã chọn phải là hình ảnh.',
            'photo_mimes'          => 'Ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
            'photo_max'            => 'Kích thước ảnh không được vượt quá 2MB.',
            'success_add'          => 'Dữ liệu nhân viên đã được thêm thành công!',
        ],

        'edit' => [
            'title' => 'Sửa nhân viên | Bảng điều khiển',
        ],

        'upload' => [
            'name_required'        => 'Tên là bắt buộc.',
            'username_required'    => 'Tên đăng nhập là bắt buộc.',
            'username_unique'      => 'Tên đăng nhập này đã được sử dụng. Vui lòng chọn tên khác.',
            'email_required'       => 'Địa chỉ email là bắt buộc.',
            'email_unique'         => 'Email này đã được đăng ký.',
            'password_required'    => 'Mật khẩu là bắt buộc.',
            'password_min'         => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'phone_required'       => 'Số điện thoại là bắt buộc.',
            'gender_in'            => 'Vui lòng chọn giới tính hợp lệ.',
            'photo_error'          => 'Tệp đã chọn phải là hình ảnh.',
            'photo_mimes'          => 'Ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
            'photo_max'            => 'Kích thước ảnh không được vượt quá 2MB.',
            'role_required'        => 'Vui lòng chọn vai trò.',
            'role_in'              => 'Vai trò phải là user hoặc admin.',
            'success_edit'         => 'Dữ liệu đã được cập nhật thành công.',
        ],

        'show' => [
            'title' => 'Chi tiết nhân viên | Bảng điều khiển',
        ],

        'delete' => [
            'success_deleted'   => 'Dữ liệu nhân viên đã được xóa thành công.',
        ]
    ]
];