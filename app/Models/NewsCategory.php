<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * A category can have many news items.
     */
    public function news()
    {
        return $this->belongsToMany(
            News::class,                  // related model
            'news_has_categories',        // pivot table
            'category_id',                // foreign key on pivot
            'news_id'                     // related key on pivot
        )->withTimestamps();
    }
}
