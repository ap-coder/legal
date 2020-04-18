<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Service extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'services';

    protected $appends = [
        'banner',
        'featured_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'excerpt',
        'meta_title',
        'icon_class',
        'created_at',
        'updated_at',
        'deleted_at',
        'service_text',
        'facebook_desc',
        'service_text_2',
        'facebook_title',
        'meta_description',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function categories()
    {
        return $this->belongsToMany(ContentCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(ContentTag::class);
    }

    public function getFeaturedImageAttribute()
    {
        $file = $this->getMedia('featured_image')->last();

        if ($file) {
            $file->url = $file->getUrl();
        }

        return $file;
    }

    public function getBannerAttribute()
    {
        $file = $this->getMedia('banner')->last();

        if ($file) {
            $file->url = $file->getUrl();
        }

        return $file;
    }
}
