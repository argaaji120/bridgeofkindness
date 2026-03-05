<?php

namespace App\Traits;

use Illuminate\Database\Query\Builder;

trait HasSortable
{
    protected static function bootHasSortable(): void
    {
        // Auto-assign next sort on create 
        static::creating(function ($record) {
            $max = static::max('sort');
            $record->sort = $max ? $max + 1 : 1;
        });

        // Normalize positions after delete 
        static::deleted(function ($record) {
            static::orderBy('sort')->get()->each(function ($item, $index) {
                $item->updateQuietly(['sort' => $index + 1]);
            });
        });
    }

    // Optional: scope for ordered results
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort');
    }
}
