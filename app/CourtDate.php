<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class CourtDate extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'court_dates';

    protected $dates = [
        'courtdate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'needed',
        'outcome',
        'client_id',
        'courtdate',
        'created_at',
        'updated_at',
        'deleted_at',
        'courthouse_id',
        'docket_number',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function courtDatesAccounts()
    {
        return $this->belongsToMany(Account::class);

    }

    public function client()
    {
        return $this->belongsTo(CrmCustomer::class, 'client_id');

    }

    public function court_cases()
    {
        return $this->belongsToMany(CourtCase::class);

    }

    public function courthouse()
    {
        return $this->belongsTo(Courthouse::class, 'courthouse_id');

    }

    public function getCourtdateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setCourtdateAttribute($value)
    {
        $this->attributes['courtdate'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }
}
