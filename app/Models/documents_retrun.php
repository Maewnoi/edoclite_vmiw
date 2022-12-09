<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documents_retrun extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'docrt_id',
        'docrt_owner',
        'docrt_sites_id',
        'docrt_groupmems_id',
        'docrt_type',
        'docrt_status',
        'docrt_check_0',
        'docrt_inspector_0',
        'docrt_datetime_0',
        'docrt_check_1',
        'docrt_inspector_1',
        'docrt_datetime_1',

        'docrt_check_2',
        'docrt_inspector_2',
        'docrt_datetime_2',

        'docrt_sealdetail_0',
        'docrt_sealnote_0',
        'docrt_sealpos_0',
        'docrt_sealdate_0',
        'docrt_sealid_0',
        'docrt_sealdetail_1',
        'docrt_sealnote_1',
        'docrt_sealpos_1',
        'docrt_sealdate_1',
        'docrt_sealid_1',
        'docrt_created_at',
        'docrt_updated_at'
    ];
}
