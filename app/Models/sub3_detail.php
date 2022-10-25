<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub3_detail extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'sub3d_id',
        'sub3d_sub_3id',
        'sub3d_government',
        'sub3d_draft',
        'sub3d_date',
        'sub3d_topic',
        'sub3d_learn',
        'sub3d_podium',
        'sub3d_therefore',
        'sub3d_pos',
        'sub3d_speed',
        'sub3d_file'
    ];
}
