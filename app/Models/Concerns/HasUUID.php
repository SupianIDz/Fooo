<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasUUID
{
    /**
     * @return void
     */
    public static function bootHasUUID() : void
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
