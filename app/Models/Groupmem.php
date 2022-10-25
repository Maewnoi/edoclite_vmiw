<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupmem extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'group_name',
        'group_token',
        'group_site_id',
        'group_created_at',
        'group_updated_at'
    ];
}
