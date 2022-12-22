<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_doc extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'sub_docid',
        'sub_recnum',
        'sub_date',
        'sub_time',
        'sub_recid',
        'sub_cotton',
        'sub_status',
        'sub_check',
        'sub_created_at',
        'sub_updated_at',
        
        'seal_recname_0',
        'seal_detail_0',
        'seal_note_0',
        'seal_pos_0',
        'seal_date_0',
        'seal_id_0',

        'seal_recname_1',
        'seal_detail_1',
        'seal_note_1',
        'seal_pos_1',
        'seal_date_1',
        'seal_id_1',

        'seal_recname_2',
        'seal_detail_2',
        'seal_note_2',
        'seal_pos_2',
        'seal_date_2',
        'seal_id_2',

        'seal_recname_3',
        'seal_detail_3',
        'seal_note_3',
        'seal_pos_3',
        'seal_date_3',
        'seal_id_3',

        'seal_recname_4',
        'seal_detail_4',
        'seal_note_4',
        'seal_pos_4',
        'seal_date_4',
        'seal_id_4',

        'seal_recname_5',
        'seal_detail_5',
        'seal_note_5',
        'seal_pos_5',
        'seal_date_5',
        'seal_id_5',

        'seal_file',
        'seal_point',
        'seal_file2',
        'seal_recid',
        'seal_recdate',
        'sub_resendby'

    ];
}
