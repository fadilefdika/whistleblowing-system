<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhistleblowingReport extends Model
{
    protected $table = 'whistleblowing_reports'; // Sesuaikan dengan tabel SQL Server
    protected $fillable = [
        'report_number',
        'reporter_type',
        'category',
        'case_description',
        'suspect_name',
        'incident_date',
        'incident_location',
        'supporting_document_path',
        'declaration_confirmed',
        'status',
        'status_note'
    ];
    public $timestamps = true;
};
