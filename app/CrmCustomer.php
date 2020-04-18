<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrmCustomer extends Model
{
    use SoftDeletes;

    public $table = 'crm_customers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'email',
        'phone',
        'skype',
        'address',
        'website',
        'last_name',
        'status_id',
        'first_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function clientCourtCases()
    {
        return $this->hasMany(CourtCase::class, 'client_id', 'id');

    }

    public function clientAccounts()
    {
        return $this->hasMany(Account::class, 'client_id', 'id');

    }

    public function clientCourtDates()
    {
        return $this->hasMany(CourtDate::class, 'client_id', 'id');

    }

    public function status()
    {
        return $this->belongsTo(CrmStatus::class, 'status_id');

    }
}
