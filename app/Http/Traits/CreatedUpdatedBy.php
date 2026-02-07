<?php

namespace App\Http\Traits;

trait CreatedUpdatedBy
{
    public static function bootCreatedUpdatedBy()
    {
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (! $model->isDirty('created_id')) {
                $model->created_id = (! empty(auth()->user()->id)) ? auth()->user()->id : null;
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (! $model->isDirty('updated_id')) {
                $model->updated_id = (! empty(auth()->user()->id)) ? auth()->user()->id : null;
            }
        });
        static::deleting(function ($model) {
            $model->deleted_id = (! empty(auth()->user()->id)) ? auth()->user()->id : null;
            $model->save();
        });
    }
}
