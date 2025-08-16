<?php

return [
    'title_home'       => 'Beranda | Homepage',

    // Flash messages
    'success_store'    => 'Data berhasil disimpan.',
    'warning_formula'  => 'Formula belum tersedia untuk building dan jumlah member ini.',

    // Validation (opsional, kalau mau dipakai di request message)
    'validation' => [
        'building_required'      => 'Pilih building terlebih dahulu.',
        'oa_required'            => 'Nilai OA wajib diisi.',
        'ov_required'            => 'Nilai OV wajib diisi.',
        'stay_required'          => 'Nilai Stay wajib diisi.',
        'vec_required'           => 'Nilai Vec wajib diisi.',
        'total_room_required'    => 'Total room wajib diisi.',
        'members_required'       => 'Pilih minimal satu member.',

        'building_exists'        => 'Building tidak ditemukan.',
        'oa_integer'             => 'OA harus berupa angka.',
        'oa_min'                 => 'OA tidak boleh negatif.',
        'ov_integer'             => 'OV harus berupa angka.',
        'ov_min'                 => 'OV tidak boleh negatif.',
        'stay_integer'           => 'Stay harus berupa angka.',
        'stay_min'               => 'Stay tidak boleh negatif.',
        'vec_integer'            => 'Vec harus berupa angka.',
        'vec_min'                => 'Vec tidak boleh negatif.',
        'total_room_integer'     => 'Total room harus berupa angka.',
        'total_room_min'         => 'Total room tidak boleh negatif.',
        'members_array'          => 'Members harus dalam format array.',
        'members_exists'         => 'Member yang dipilih tidak ditemukan.',
    ],
];
