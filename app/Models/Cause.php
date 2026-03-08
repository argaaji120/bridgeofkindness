<?php

namespace App\Models;

use App\Traits\HasSortable;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasSortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'sort_description',
        'featured_image',
        'goal_amount',
        'category',
        'status',
        'start_date',
        'end_date',
        'featured',
        'sort'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'featured' => 'boolean',
    ];
}
