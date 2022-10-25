<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reserve_number extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'reserve_number',
        'reserve_topic',
        'reserve_date',
        'reserve_status',
        'reserve_type',
        'reserve_template',
        'reserve_used',
        'reserve_group',
        'reserve_owner',
        'reserve_site',
        'reserve_created_at',
        'reserve_updated_at'
    ];
}
