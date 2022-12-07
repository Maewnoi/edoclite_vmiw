<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documents_retrun_detail extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'docrtdt_id',
        'docrtdt_sub_3id',
        'docrtdt_government',
        'docrtdt_draft',
        'docrtdt_date',
        'docrtdt_topic',
        'docrtdt_learn',
        'docrtdt_podium',
        'docrtdt_therefore',
        'docrtdt_pos',
        'docrtdt_speed',
        'docrtdt_file'
    ];
}
