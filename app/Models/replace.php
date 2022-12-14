<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class replace extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'replace_id',
        'replace_user_id',
        'replace_user_id_acting',
        'replace_created_at',
        'replace_updated_at'
    ];
}
