<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\WhistleblowingReport;

class ReportController extends Controller
{
    public function form(){
        return view('whistleblowing');
    }

    public function track(Request $request)
{
    $report_number = $request->input('report_number');
    $report = WhistleblowingReport::where('report_number', $report_number)->first();

    return view('track-report', [
        'report' => $report,
        'reportSearched' => true
    ]);
}


    public function store(Request $request)
    {
        $request->validate([
            'reporter_type' => 'required|in:employee,external',
            'has_violation' => 'required|boolean',
            'category' => 'required|string|max:100',
            'case_description' => 'required|string',
            'suspect_name' => 'required|string|max:255',
            'incident_date' => 'required|date',
            'incident_location' => 'required|string|max:255',
            'supporting_document' => 'nullable|array|max:5',
            'supporting_document.*' => 'file|max:5120',
            'declaration' => 'required|accepted',
        ]);

        DB::beginTransaction();

        try {
            $today = now()->format('Ymd');
            $last = WhistleblowingReport::whereDate('created_at', now()->toDateString())
                ->orderBy('id', 'desc')
                ->first();

            $increment = $last ? ((int)substr($last->report_number, -3)) + 1 : 1;
            $reportNumber = 'WBS-' . $today . '-' . str_pad($increment, 3, '0', STR_PAD_LEFT);

            $paths = [];

            if ($request->hasFile('supporting_document')) {
                foreach ($request->file('supporting_document') as $file) {
                    $savedPath = $file->storeAs(
                        'whistleblowing_files/' . $reportNumber,
                        $file->getClientOriginalName(),
                        'public'
                    );
                    $paths[] = $savedPath;
                }
            }

            WhistleblowingReport::create([
                'report_number' => $reportNumber,
                'reporter_type' => $request->reporter_type,
                'has_violation' => $request->has_violation,
                'category' => $request->category,
                'case_description' => $request->case_description,
                'suspect_name' => $request->suspect_name,
                'incident_date' => $request->incident_date,
                'incident_location' => $request->incident_location,
                'supporting_document_path' => implode(',', $paths),
                'declaration_confirmed' => true,
                'status' => 'Diterima',
                'status_note' => null,
            ]);
            

            DB::commit();

            return redirect()
            ->route('whistleblowing.success', ['report_number' => $reportNumber])
            ->with('success', 'Your report has been submitted successfully.');


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            return back()->withErrors('An error occurred while saving the report. Please try again.');
        }
    }

    public function trackresult(Request $request)
    {
        $request->validate([
            'report_number' => 'required|string'
        ]);

        $report = WhistleblowingReport::where('report_number', $request->report_number)->first();

        if (!$report) {
            return back()->with('error', 'Nomor laporan tidak ditemukan.');
        }

        return view('track-result', compact('report'));
    }

    public function success($report_number)
    {
        return view('success', compact('report_number'));
    }

}
