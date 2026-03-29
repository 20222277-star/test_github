<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cấu hình Cảnh báo Điểm Thấp (Low Grade Warning)
    |--------------------------------------------------------------------------
    |
    | Tệp này chứa các cấu hình cho hệ thống cảnh báo điểm thấp dành cho
    | sinh viên và giáo viên theo dõi tình trạng học tập.
    |
    */

    // Mức điểm tối thiểu cảnh báo
    'warning_threshold' => 5.0,

    // Mức điểm nguy hiểm (dưới 3.0)
    'critical_threshold' => 3.0,

    // Mô tả các mức cảnh báo
    'thresholds' => [
        'critical' => [
            'score' => 3.0,
            'label' => 'Nguy hiểm',
            'class' => 'danger',
            'icon' => '🔴',
        ],
        'warning' => [
            'score' => 5.0,
            'label' => 'Cảnh báo',
            'class' => 'warning',
            'icon' => '🟠',
        ],
        'good' => [
            'score' => 7.0,
            'label' => 'Tốt',
            'class' => 'success',
            'icon' => '🟢',
        ],
        'excellent' => [
            'score' => 8.5,
            'label' => 'Xuất sắc',
            'class' => 'info',
            'icon' => '⭐',
        ],
    ],
];
