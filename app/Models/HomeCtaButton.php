<?php

namespace App\Models;

use App\Traits\HasSortable;
use Illuminate\Database\Eloquent\Model;

class HomeCtaButton extends Model
{
    use HasSortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['title_prefix', 'title_highlight', 'title_suffix', 'image', 'link', 'sort'];
}
