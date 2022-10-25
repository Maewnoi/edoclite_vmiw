<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cottons extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'cottons_id',
        'cottons_name',
        'cottons_site',
        'cottons_group',
        'cottons_created_at',
        'cottons_updated_at'
    ];
}
