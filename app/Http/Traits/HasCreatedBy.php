<?php

namespace App\Http\Traits;

trait HasCreatedBy
{
    public static function bootHasCreatedBy()
    {
        static::creating(function($model) {
            $model->created_by = auth()->id();
        });

        static::updating(function($model) {
            $model->created_by = auth()->id();
        });
    }
}