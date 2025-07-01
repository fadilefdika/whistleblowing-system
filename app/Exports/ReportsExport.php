<?php

namespace App\Exports;

use App\Models\WhistleblowingReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return WhistleblowingReport::select('report_number', 'reporter_type', 'category','case_description','suspect_name','incident_date','incident_location','status', 'created_at','supporting_document_path')->get();
    }

    public function headings(): array
    {
        return [
            'Report Number',
            'Reporter Type',
            'Category',
            'Case Description',
            'Suspect Name',
            'Incident Date',
            'Incident Location',
            'Status',
            'Created At',
        ];
    }
}
