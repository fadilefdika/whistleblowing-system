@extends('layouts.app')

@section('content')
<div class="container py-4 py-md-5">
    <div class="card bg-white border-0 rounded-4 overflow-hidden shadow-lg" style="max-width: 840px; margin: 0 auto;">
        <div class="card-body p-4 p-md-5">

            <!-- Logo -->
            <div class="text-center mb-4">
                <img src="{{ asset('images/LOGO-AVI-OFFICIAL.png') }}" 
                     alt="PT Astra Visteon Indonesia" 
                     class="img-fluid" style="height: 55px;">
            </div>

            <!-- Heading -->
            <div class="text-center mb-4 position-relative">
                <h1 class="fw-bold mb-1" style="font-size: 2rem;">
                    Whistleblowing System
                </h1>
                {{-- <div class="mx-auto" style="width: 80px; height: 4px; background: linear-gradient(90deg, #0061f2, #5800c6); border-radius: 2px;"></div> --}}
            </div>

            <!-- Description -->
            <div class="text-center mb-5">
                <p class="text-secondary" style="font-size: 1.1rem; line-height: 1.7; max-width: 650px; margin: 0 auto;">
                    A secure platform provided by <strong class="text-dark">PT Astra Visteon Indonesia</strong>
                    for confidential reporting of suspected violations.
                    <span class="d-block mt-2 text-primary fw-semibold">Your identity will always be protected.</span>
                </p>
            </div>

            <!-- Buttons -->
            <div class="d-flex flex-column flex-md-row justify-content-center gap-2 mt-3">
                <a href="{{ route('whistleblowing.form') }}" 
                class="btn btn-primary px-3 py-2 rounded-2 fw-medium shadow-sm"
                style="min-width: 160px; font-size: 0.95rem; transition: all 0.2s;">
                    <i class="fas fa-plus-circle me-1"></i> Submit Report
                </a>
                <a href="{{ route('whistleblowing.track') }}" 
                class="btn btn-outline-primary px-3 py-2 rounded-2 fw-medium shadow-sm"
                style="min-width: 160px; font-size: 0.95rem; transition: all 0.2s;">
                    <i class="fas fa-search me-1"></i> Track Report
                </a>
            </div>


            <!-- Security info -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fas fa-lock me-1"></i> 100% Confidential Reporting
                </small>
            </div>
        </div>
    </div>
</div>

@endsection
