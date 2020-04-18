<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentCategory extends Model
{
    use SoftDeletes;

    public $table = 'content_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function contentPages()
    {
        return $this->belongsToMany(ContentPage::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
