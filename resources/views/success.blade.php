@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-body px-3 px-md-4 py-5 text-center">

            <h3 class="fw-bold text-success mb-3">Report Submitted</h3>
            <p class="mb-1">Here is your report number:</p>

            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2 mb-3">
                <span id="reportNumber" class="fw-semibold text-primary fs-5">
                    {{ $report_number }}
                </span>
                <button class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1" 
                        onclick="copyReportNumber()">
                    Copy
                </button>
            </div>

            <div id="copyFeedback" class="text-success small" style="display: none;">
                Copied!
            </div>

            <p class="text-muted mt-3 mb-4 small">
                Keep this number for tracking your report status.
            </p>

            <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                <a href="{{ route('whistleblowing.form') }}" class="btn btn-outline-primary w-100 w-md-auto">
                    Submit Another Report
                </a>
                <a href="{{ route('whistleblowing.track') }}" class="btn btn-primary w-100 w-md-auto">
                    Track Report
                </a>
            </div>

        </div>
    </div>
</div>


@push('scripts')
<script>
    function copyReportNumber() {
        const reportNumber = document.getElementById('reportNumber').innerText.trim();
        navigator.clipboard.writeText(reportNumber).then(() => {
            const feedback = document.getElementById('copyFeedback');
            feedback.style.display = 'inline';
            setTimeout(() => {
                feedback.style.display = 'none';
            }, 1500);
        });
    }
</script>
@endpush
@endsection





