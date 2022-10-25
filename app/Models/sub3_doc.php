<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub3_doc extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'sub3_id',
        'sub3_docid',
        'sub3_subid',
        'sub3_sub_2id',
        'sub3_type',
        'sub3_status',
        'sub3_check_0',
        'sub3_inspector_0',
        'sub3_datetime_0',
        'sub3_check_1',
        'sub3_inspector_1',
        'sub3_datetime_1',
        'sub3_sealdetail_0',
        'sub3_sealnote_0',
        'sub3_sealpos_0',
        'sub3_sealdate_0',
        'sub3_sealid_0',
        'sub3_sealdetail_1',
        'sub3_sealnote_1',
        'sub3_sealpos_1',
        'sub3_sealdate_1',
        'sub3_sealid_1',
        'sub3_created_at',
        'sub3_updated_at'
    ];
}
