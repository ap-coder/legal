<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Attorney extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'attorneys';

    protected $appends = [
        'photo',
        'banner',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        '1' => 'Published',
        '0' => 'Not Published',
    ];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'intro',
        'notes',
        'title',
        'status',
        'google',
        'twitter',
        'youtube',
        'linkedin',
        'bio_area',
        'facebook',
        'specialty',
        'other_link',
        'created_at',
        'updated_at',
        'deleted_at',
        'content_area',
        'content_area_2',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function attorneysCourtCases()
    {
        return $this->belongsToMany(CourtCase::class);

    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;

    }

    public function getBannerAttribute()
    {
        $file = $this->getMedia('banner')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;

    }

}
