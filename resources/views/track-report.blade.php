@extends('layouts.app')

@section('content')
<div class="container pt-3 pb-4">
    {{-- Tombol Back --}}
    <div class="mb-3">
        <a href="{{ route('landingpage') }}"
           class="btn btn-outline-primary fw-semibold rounded-2 shadow-sm"
           style="border-color: #0061f2; color: #0061f2; transition: 0.2s all;"
           onmouseover="this.style.backgroundColor='#0061f2'; this.style.color='#fff';"
           onmouseout="this.style.backgroundColor=''; this.style.color='#0061f2';">
            Back
        </a>
    </div>
    <div class="row justify-content-center"> 
        <div class="col-md-8 col-lg-6">
            <!-- Main Card -->
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-body p-4 p-md-5">
                    <!-- Header Section -->
                    <div class="text-center mb-5">
                        <h2 class="h4 text-dark fw-bold mb-3">Report Status Tracking</h2>
                        <p class="text-muted mb-0">
                            Enter your unique report reference number to check the current status
                        </p>
                        <div class="divider mx-auto my-3" style="width: 60px; height: 3px; background: linear-gradient(90deg, #0061f2, #5800c6);"></div>
                    </div>

                    <!-- Search Form -->
                    <form action="#" method="GET" class="mt-4">
                        <div class="mb-4">
                            <label for="report_number" class="form-label small text-uppercase text-muted fw-semibold mb-2">Report Reference Number</label>
                            <div class="input-group shadow-lg rounded">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="fas fa-hashtag"></i>
                                </span>
                                <input class="form-control border-start-0" 
                                       name="report_number" 
                                       id="report_number"  
                                       type="text" 
                                       placeholder="WBS-20250626-001" 
                                       required>
                            </div>
                            <small class="text-muted mt-2 d-block">You received this number when submitting your report</small>
                        </div>

                        <div class="d-grid gap-3 mt-5">
                            <button type="submit" class="btn btn-primary py-2 fw-semibold rounded shadow-lg">
                                <i class="fas fa-search me-2"></i> Check Status
                            </button>
                            
                            <a href="{{ route('whistleblowing.form') }}" 
                               class="btn btn-outline-primary py-2 fw-semibold rounded shadow-lg hover-effect">
                                <i class="fas fa-plus me-2"></i> Submit New Report
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Section -->
            @if(isset($report))
                <div class="card border-0 shadow-lg rounded-lg mt-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-info-circle text-primary me-2 fs-5"></i>
                            <h5 class="mb-0 text-primary">Tracking Result</h5>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Report Number:</span>
                                    <span class="detail-value">{{ $report->report_number }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Status:</span>
                                    <span class="badge 
                                        @if($report->status == 'Resolved') bg-success 
                                        @elseif($report->status == 'In Progress') bg-warning text-dark 
                                        @else bg-secondary @endif rounded-pill">
                                        {{ $report->status }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Submitted On:</span>
                                    <span class="detail-value">
                                        {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->timezone('Asia/Jakarta')->isoFormat('D MMMM Y, HH:mm') }} WIB
                                    </span>
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Last Updated:</span>
                                    <span class="detail-value">{{ \Carbon\Carbon::parse($report->updated_at)->diffForHumans() }}</span>
                                </div>
                            </div>
                            @if($report->note)
                            <div class="col-12 mt-2">
                                <div class="detail-item">
                                    <span class="detail-label">Notes:</span>
                                    <div class="note-box bg-light rounded p-3 mt-2">
                                        {{ $report->note }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </>
                    </div>
                </div>
            @elseif(isset($reportSearched) && request()->has('report_number'))
                <div class="alert alert-danger rounded-lg shadow-lg mt-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-times-circle me-2"></i>
                        <span>Report not found. Please check the reference number.</span>
                    </div>
                </div>
            @endif            
        </div>
    </div>
</div>

<style>
    .detail-item {
        margin-bottom: 0.5rem;
    }
    
    .detail-label {
        font-weight: 600;
        color: #495057;
        display: block;
        margin-bottom: 0.2rem;
        font-size: 0.875rem;
    }
    
    .detail-value {
        color: #212529;
        font-size: 0.9375rem;
    }
    
    .note-box {
        border-left: 3px solid #0061f2;
    }
    
    .hover-effect {
        transition: all 0.25s ease;
    }
    
    .hover-effect:hover {
        background-color: #0061f2;
        color: white !important;
    }
    
    .bg-primary-soft {
        background-color: rgba(0, 97, 242, 0.1);
    }
</style>
@endsection