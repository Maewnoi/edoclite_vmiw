<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class sub2_doc extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'sub2_id',
        'sub2_docid',
        'sub2_subid',
        'sub2_sendid',
        'sub2_recid',
        'sub2_status',
        'sub2_check',
        'sub2_created_at',
        'sub2_updated_at'
    ];
}
