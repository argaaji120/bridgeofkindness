<?php

namespace App\Models;

use App\Traits\HasSortable;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasSortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'category', 'content', 'image', 'status', 'sort'];
}
