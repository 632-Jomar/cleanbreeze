<?php

namespace App\Http\Traits;

trait HasCreatedBy
{
    public static function bootHasCreatedBy()
    {
        static::creating(function($model) {
            if (is_null($model->created_by)) {
                $model->created_by = auth()->id();
            }
        });
    }
}