<?php

namespace App\Models\Traits;

trait Uuid
{
    public static function bootUuid()
    {
        static::creating(function ($model) {
            $model->uuid = \Ramsey\Uuid\Uuid::uuid4();
        });
    }
}
