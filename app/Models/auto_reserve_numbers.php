<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auto_reserve_numbers extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'arn_id',
        'arn_site_id',
        'arn_level',
        'arn_user_id',
        'arn_quantity',
        'arn_template',
        'arn_created_at',
        'arn_updated_at'
    ];
}
