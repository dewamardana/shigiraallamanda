<?php

namespace App\Traits;

use App\Models\DailyPoint;

trait HandlesDailyPoints
{
    public function addDailyPoint($userId, $date, $point, $activity, array $detail = [])
    {
        return DailyPoint::create([
            'user_id' => $userId,
            'date' => $date,
            'point' => $point,
            'activity_type' => get_class($activity),
            'activity_id' => $activity->id,
            'activity_detail' => $detail,
        ]);
    }
}
