<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingHero extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'landing_hero';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image_path', 'title', 'subtitle', 'sort'];

    protected static function booted()
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
}
