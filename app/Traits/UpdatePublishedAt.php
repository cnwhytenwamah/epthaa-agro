<?php

namespace App\Traits;

use Carbon\Carbon;

trait UpdatePublishedAt
{
    public static function bootUpdatesPublishedAt()
    {
        static::saving(function ($model) {
            if ($model->isDirty('status') && $model->status === 'published') {
                $model->published_at = Carbon::now();
            }
        });
    }
}