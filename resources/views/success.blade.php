@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow rounded-4">
        <div class="card-body text-center p-5">
            <h2 class="text-success mb-3">Report Submitted Successfully</h2>
            <p>Your report number is:</p>
            <h3 class="text-primary fw-bold">{{ $report_number }}</h3>
            <p class="mt-3">Please save this report number for tracking your report status in the future.</p>
            <a href="#{{-- route('whistleblowing.form') --}}" class="btn btn-primary mt-4">Submit Another Report</a>
        </div>
    </div>
</div>
@endsection
