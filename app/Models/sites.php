<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sites extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'site_id',
        'site_name',
        'site_number_run',
        'site_path_folder',
        'site_img',
        'site_color',
        'site_ca',
        'site_created_at',
        'site_updated_at'
    ];
}
