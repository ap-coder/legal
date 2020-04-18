<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrmNote extends Model
{
    use SoftDeletes;

    public $table = 'crm_notes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'note',
        'created_at',
        'updated_at',
        'deleted_at',
        'customer_id',
        'court_case_id',
    ];

    public function notesAccounts()
    {
        return $this->hasMany(Account::class, 'notes_id', 'id');

    }

    public function customer()
    {
        return $this->belongsTo(CrmCustomer::class, 'customer_id');

    }

    public function court_case()
    {
        return $this->belongsTo(CourtCase::class, 'court_case_id');

    }
}
