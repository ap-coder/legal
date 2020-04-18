<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courthouse extends Model
{
    use SoftDeletes;

    public $table = 'courthouses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'updated_at',
        'created_at',
        'deleted_at',
        'googlemaps_url',
        'courthouse_zip',
        'courthouse_name',
        'courthouse_city',
        'courthouse_state',
        'courthouse_street',
        'courthouse_street_2',
    ];

    public function courthouseAccounts()
    {
        return $this->hasMany(Account::class, 'courthouse_id', 'id');

    }
}
