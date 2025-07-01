@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column justify-content-center min-vh-100 py-5">

    <!-- Logo -->
    <div class="text-center mb-4">
        <img src="{{ asset('images/LOGO-AVI-OFFICIAL.png') }}" 
             alt="PT Astra Visteon Indonesia" 
             class="img-fluid" style="height: 60px;">
    </div>

    <!-- Card Login -->
    <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 420px; width: 100%;">
        <div class="card-body p-4 p-sm-5">
            <h5 class="text-center mb-4 fw-bold">
                <i class="fas fa-user-shield me-2"></i> ADMIN WHISTLEBLOWING SYSTEM
                <!-- Toggle Eye Icon -->
            </h5>
            <span class="position-absolute" 
                style="top: 38px; right: 15px; cursor: pointer;" 
                onclick="togglePassword()">
                <i class="fa-solid fa-eye text-muted" id="togglePasswordIcon"></i>
            </span>


            @if(session('error'))
                <div class="alert alert-danger py-2 small mb-4 d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2"></i> 
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="npk" class="form-label small fw-semibold text-muted mb-1">
                        <i class="fas fa-id-card me-1"></i> NPK <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="npk" 
                           id="npk" 
                           class="form-control rounded-3 py-2 px-3" 
                           placeholder="Masukkan NPK"
                           required>
                </div>

                <div class="mb-4 position-relative">
                    <label for="password" class="form-label small fw-semibold text-muted mb-1">
                        <i class="fa-solid fa-lock me-1"></i> PASSWORD <span class="text-danger">*</span>
                    </label>
                
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-control rounded-3 py-2 px-3 pe-5" 
                           placeholder="Masukkan password"
                           required>
                
                    
                </div>
                

                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 rounded-3 mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i> LOGIN
                </button>
                
                <div class="text-center mt-3 small text-muted">
                    &copy; {{ date('Y') }} PT Astra Visteon Indonesia
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }
    .min-vh-100 {
        min-height: 100vh;
    }
    .card {
        border: none;
    }
    .form-control {
        height: calc(2.5rem + 2px);
    }
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');
        
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        toggleIcon.classList.toggle('fa-eye');
        toggleIcon.classList.toggle('fa-eye-slash');
    }
</script>

@endsection
