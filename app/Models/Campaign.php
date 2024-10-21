<?php

namespace App\Models;

use Carbon\Carbon;
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
    protected $appends = [
        'campaign_status' => '',
    ];
    public function masjid()
    {
        return $this->belongsTo(Masjid::class);
    }
    public function scopeStatus($query, $status = null) {
        if (empty($status) || $status == 'all')
            return $query;

        if ($status == 'latest'){
            $query->whereDate('start_date', '>=', Carbon::now());
        }

        if ($status == 'upcoming')
            $query->whereDate('start_date', '>', Carbon::now());

        if ($status == 'completed')
            $query->whereDate('start_date', '<', Carbon::now());

        if ($status == 'ongoing')
            $query->whereDate('start_date', '=', Carbon::now());
    }
    public function getCampaignStatusAttribute()
    {
        if (Carbon::parse($this->start_date) > Carbon::now()) {
            return 'upcoming';
        } elseif (Carbon::parse($this->end_date) < Carbon::now()) {
            return 'completed';
        } else {
            return 'ongoing';
        }
    }
}