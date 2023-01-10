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
        'sub3_note',

        'sub3_check_0',
        'sub3_inspector_0',
        'sub3_datetime_0',

        'sub3_check_1',
        'sub3_inspector_1',
        'sub3_datetime_1',

        'sub3_check_2',
        'sub3_inspector_2',
        'sub3_datetime_2',

        'sub3_sealdetail_0',
        'sub3_sealnote_0',
        'sub3_sealpos_0',
        'sub3_sealdate_0',
        'sub3_sealid_0',
        'sub3_ca_0',

        'sub3_sealdetail_1',
        'sub3_sealnote_1',
        'sub3_sealpos_1',
        'sub3_sealdate_1',
        'sub3_sealid_1',
        'sub3_ca_1',

        'sub3_sealdetail_2',
        'sub3_sealnote_2',
        'sub3_sealpos_2',
        'sub3_sealdate_2',
        'sub3_sealid_2',
        'sub3_ca_2',

        'sub3_sealdetail_3',
        'sub3_sealnote_3',
        'sub3_sealpos_3',
        'sub3_sealdate_3',
        'sub3_sealid_3',
        'sub3_ca_3',

        'sub3_sealdetail_4',
        'sub3_sealnote_4',
        'sub3_sealpos_4',
        'sub3_sealdate_4',
        'sub3_sealid_4',
        'sub3_ca_4',

        'sub3_sealdetail_5',
        'sub3_sealnote_5',
        'sub3_sealpos_5',
        'sub3_sealdate_5',
        'sub3_sealid_5',
        'sub3_ca_5',

        'sub3_created_at',
        'sub3_updated_at'
    ];
}
