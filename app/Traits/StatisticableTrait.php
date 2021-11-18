<?php

namespace App\Traits;

use App\Models\Statistic;

trait StatisticableTrait
{
    public static function storeRecord(mixed $record, int $statisticable_id, string $type): void
    {
        Statistic::updateOrCreate(
            ['statisticable_id' => $statisticable_id],
            [
                'type' => $type,
                'record' => $record,
            ]);
    }

    public static function incrementRecord(int $statisticable_id, string $type): void
    {
        ($model = Statistic::where(['statisticable_id' => $statisticable_id])->first())
            ? $model->increment('record')
            : self::storeRecord(0, $statisticable_id, $type);
    }
}