<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    public $table = 'accounts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'status',
        'notes_id',
        'client_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'document_id',
        'courthouse_id',
    ];

    const STATUS_SELECT = [
        'active'                => 'Active & Up to Date',
        'payment_required'      => 'Waiting on Retainer',
        'payment_plan'          => 'Paying on Retainer',
        'new_retainer_required' => 'Refill Retainer',
        'on_hold'               => 'On Hold',
        'completed'             => 'Case Completed',
        'pulled_services'       => 'Pulled My Serviced',
        'not_representing'      => 'No Longer Representing',
        'prelim'                => 'Starting Case',
    ];

    public function client()
    {
        return $this->belongsTo(CrmCustomer::class, 'client_id');

    }

    public function court_dates()
    {
        return $this->belongsToMany(CourtDate::class);

    }

    public function notes()
    {
        return $this->belongsTo(CrmNote::class, 'notes_id');

    }

    public function document()
    {
        return $this->belongsTo(CrmDocument::class, 'document_id');

    }

    public function courthouse()
    {
        return $this->belongsTo(Courthouse::class, 'courthouse_id');

    }
}
