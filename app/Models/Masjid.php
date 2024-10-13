<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masjid extends Model
{
    use HasFactory;

    protected $fillable = [
        'masjid_name',
        'address_1',
        'address_2',
        'district',
        'state',
        'postcode',
        'status'
    ];
}