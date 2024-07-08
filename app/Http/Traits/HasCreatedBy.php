<?php

namespace App\Http\Traits;

trait HasCreatedBy
{
    public static function bootHasCreatedBy()
    {
        static::creating(function($model) {
            $model->created_by = auth()->id() ?? $model->created_by;
        });
    }
}