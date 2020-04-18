<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourtCase extends Model
{
    use SoftDeletes;

    public $table = 'court_cases';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'closed_date',
        'completed_date',
    ];

    protected $fillable = [
        'client_id',
        'case_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'case_number',
        'closed_date',
        'awarded_value',
        'proposed_value',
        'completed_date',
    ];

    public function client()
    {
        return $this->belongsTo(CrmCustomer::class, 'client_id');

    }

    public function getClosedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setClosedDateAttribute($value)
    {
        $this->attributes['closed_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function getCompletedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setCompletedDateAttribute($value)
    {
        $this->attributes['completed_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function attorneys()
    {
        return $this->belongsToMany(Attorney::class);

    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class);

    }
}
