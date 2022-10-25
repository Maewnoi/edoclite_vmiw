<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class token extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'token_id',
        'token_site_id',
        'token_level',
        'token_token',
        'token_seal'
    ];
}
