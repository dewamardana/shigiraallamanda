<?php

namespace App\Traits;

use App\Models\DailyPoint;

trait HandlesDailyPoints
{
    public function addDailyPoint($userId, $date, $point, $activityType, $activityId, array $detail = [])
    {
        return DailyPoint::create([
            'user_id'        => $userId,
            'date'           => $date,
            'point'          => $point,
            'activity_type'  => $activityType, // string langsung
            'activity_id'    => $activityId,
            'activity_detail' => $detail,
        ]);
    }
}
