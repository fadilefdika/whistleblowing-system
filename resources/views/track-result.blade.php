@extends('layouts.app')

@section('content')
<div class="container py-4 py-md-5">
    <div class="card bg-white border-0 shadow rounded-4" style="max-width: 700px; margin: 0 auto;">
        <div class="card-body p-4 p-md-5">
            <!-- Heading -->
            <div class="text-center mb-4">
                <h2 class="text-primary fw-bold mb-1">Report Status</h2>
                <small class="text-muted">Report Number: <strong class="text-dark">{{ $report->report_number }}</strong></small>
            </div>

            <!-- Status Box -->
            <div class="border rounded-3 p-3 mb-4 text-center bg-light">
                <p class="mb-1 text-secondary">Current Status</p>
                <h4 class="fw-semibold text-{{ $report->status === 'Resolved' ? 'success' : ($report->status === 'In Progress' ? 'warning' : 'secondary') }}">
                    {{ $report->status }}
                </h4>
                @if($report->status_note)
                <p class="small text-muted mt-2">{{ $report->status_note }}</p>
                @endif
            </div>

            <!-- Summary -->
            <div class="mb-4">
                <h5 class="fw-semibold text-dark mb-2">Report Summary</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Category:</span>
                        <span class="fw-medium">{{ $report->category }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Suspect:</span>
                        <span class="fw-medium">{{ $report->suspect_name }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Incident Date:</span>
                        <span class="fw-medium">{{ \Carbon\Carbon::parse($report->incident_date)->format('d M Y') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Supporting Document (optional) -->
            @if($report->supporting_document_path)
            <div class="mb-3">
                <h6 class="text-dark fw-medium">Supporting Documents</h6>
                @foreach(explode(',', $report->supporting_document_path) as $file)
                    <a href="{{ asset('storage/' . $file) }}" target="_blank" class="d-block small text-primary">
                        <i class="fas fa-file-alt me-1"></i> {{ basename($file) }}
                    </a>
                @endforeach
            </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('whistleblowing.track') }}" class="btn btn-outline-secondary px-4 py-2 rounded-2">
                    <i class="fas fa-arrow-left me-1"></i> Back to Tracking
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
