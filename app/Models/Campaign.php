<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class Campaign extends Model
{
    use HasFactory, Mediable;

    protected $fillable = [
        'campaign_name',
        'campaign_description',
        'masjid_id',
        'start_date',
        'end_date',
        'location',
        'volunteers',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'volunteers' => 'array',
    ];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class);
    }
}