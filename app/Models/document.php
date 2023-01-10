<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'doc_id',
        'doc_site_id',
        'doc_year',
        'doc_recnum',
        'doc_docnum',
        'doc_date',
        'doc_time',
        'doc_date_2',
        'doc_origin',
        'doc_title',
        'doc_filedirec',
        'doc_filedirec_1',
        'doc_filedirec_1_ca',
        'doc_attached_file',
        'doc_type',
        'doc_template',
        'doc_president_active',
        'doc_note',
        'doc_note2',
        'doc_speed',
        'doc_tab',
        'doc_status',
        'doc_owner',
        'doc_group',
        'seal_point',
        'seal_deteil',
        'seal_date',
        'doc_created_at',
        'doc_updated_at'
    ];
}
