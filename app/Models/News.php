<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class News extends Model
{
    use HasTags;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'status',
        'published_at',
    ];

    /**
     * A news item belongs to an author (user).
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * A news item can belong to many categories.
     */
    public function categories()
    {
        return $this->belongsToMany(
            NewsCategory::class,          // related model
            'news_has_categories',        // pivot table
            'news_id',                    // foreign key on pivot
            'category_id'                 // related key on pivot
        )->withTimestamps(); // ensures the pivot table’s created_at and updated_at fields are maintained.
    }
}
