@extends('layouts.app')

@section('content')
<div class="container pt-3 pb-5">

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
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-white text-black text-center rounded-top-4">
            <img src="{{ asset('images/LOGO-AVI-OFFICIAL.png') }}" alt="Logo PT Astra Visteon Indonesia" class="my-3" style="max-height: 60px;">
            <h2 class="mb-1">AVI - WHISTLE BLOWING SYSTEM</h2>
            <p class="mb-0 small">PT Astra Visteon Indonesia</p>
        </div>     
        
        <div class="card-body bg-white rounded-bottom-4 p-4">
            <div class="rounded-3 py-3" style="font-size: 1rem; line-height: 1.6; text-align: justify;">
                <p class="mb-2">
                    <strong>Whistleblowing System</strong> is an application provided by <strong>PT Astra Visteon Indonesia</strong> for anyone who has information and wants to report actions suspected of violations within the company environment.
                </p>
                <p class="mb-2">
                    Your identity will be <strong>KEPT CONFIDENTIAL</strong> as a whistleblower.
                </p>
                <p class="mb-0">
                    We appreciate your information. Our focus is on the reported material facts.
                </p>
            </div>
                      
        
            <form method="POST" action="{{ route('whistleblowing.submit') }}" enctype="multipart/form-data">
                @csrf
        
                <!-- Reporter Identity -->
                <div class="my-4">
                    <h5 class="text-primary border-bottom pb-2">Reporter Identity</h5>
                    <label for="reporter_type" class="form-label small mb-1">Your role<span class="text-danger"> *</span></label>
                    <select class="form-select" id="reporter_type" name="reporter_type" required>
                        <option value="" selected disabled>-- Select --</option>
                        <option value="employee">Employee</option>
                        <option value="external">External Party</option>
                    </select>
                </div>
        
                <!-- Report Information -->
                <div class="mb-4">
                    <h5 class="text-primary border-bottom pb-2">Report Information</h5>
        
                    <label for="category" class="form-label small mb-1">Report Category<span class="text-danger"> *</span></label>
                    <select class="form-select mb-3" id="category" name="category" required>
                        <option value="" selected disabled>-- Select Category --</option>
                        <option value="Fraud">Fraud</option>
                        <option value="Document Forgery">Document Forgery</option>
                        <option value="Law Violation">Law Violation</option>
                        <option value="Ethics Violation">Business Ethics or Work Ethics Violation</option>
                        <option value="Discrimination">Discrimination</option>
                        <option value="Sexual Harassment">Sexual Harassment</option>
                        <option value="Safety Violation">Workplace Safety/Health Hazard</option>
                        <option value="Corruption">Corruption, bribery, gratification</option>
                        <option value="Power Abuse">Abuse of Power</option>
                        <option value="Company Asset Abuse">Company Asset Misuse</option>
                        <option value="Data Manipulation">Data Manipulation</option>
                    </select>
        
                    <label for="case_description" class="form-label small mb-1">Describe the alleged violation in detail</label>
                    <small class="text-muted d-block mb-2">Start with the case title. Describe the alleged violation, involved parties, department, time, and initial evidence.</small>
                    <textarea class="form-control" id="case_description" name="case_description" rows="5" required></textarea>
                </div>
        
                <!-- Violation Details -->
                <div class="mb-4">
                    <h5 class="text-primary border-bottom pb-2">Violation Details</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="suspect_name" class="form-label small mb-1">Suspect Name and Position<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="suspect_name" name="suspect_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="incident_date" class="form-label small mb-1">Date of Reported Event<span class="text-danger"> *</span></label>
                            <input type="date" class="form-control" id="incident_date" name="incident_date" value="{{ now()->toDateString() }}" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="incident_location" class="form-label small mb-1">Incident Location<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="incident_location" name="incident_location" required>
                    </div>
                </div>
        
                <!-- Supporting Document -->
                <div class="mb-4">
                    <h5 class="text-primary border-bottom pb-2">Supporting Information</h5>
                    <small class="text-muted d-block mb-2">Upload documents (max 5 files, each max 1MB)</small>
                    <input 
                        type="file" 
                        class="form-control" 
                        id="supporting_document" 
                        name="supporting_document[]" 
                        multiple 
                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                    >
                    <div id="filePreview" class="mt-2"></div>
                </div>
                            
                <!-- Declaration -->
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="declaration" name="declaration">
                    <label class="form-check-label small" for="declaration">
                        I declare that the information provided is true and can be used for investigation purposes.
                    </label>
                </div>
        
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 py-2 opacity-50" id="submitBtn" disabled>
                        Submit Report
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        html: `{!! session('success') !!}`,
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}',
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false
    });
</script>
@endif

@endsection

@push('scripts')
<script>
    const input = document.getElementById('supporting_document');
    const preview = document.getElementById('filePreview');

    input.addEventListener('change', function () {
        preview.innerHTML = '';
        const maxFiles = 5;
        const maxFileSizeMB = 1;

        const files = Array.from(input.files);
        const validFiles = [];

        if (files.length > maxFiles) {
            preview.innerHTML = `<div class="text-danger">You can upload up to ${maxFiles} files only.</div>`;
            input.value = '';
            return;
        }

        files.forEach((file, index) => {
            const sizeMB = file.size / 1024 / 1024;
            if (sizeMB > maxFileSizeMB) {
                const msg = `<div class="text-danger">${file.name} - ${(sizeMB).toFixed(2)} MB (Too large, max 1MB allowed)</div>`;
                preview.innerHTML += msg;
            } else {
                validFiles.push(file);
            }
        });

        if (validFiles.length !== files.length) {
            input.value = ''; // Reset jika ada file tidak valid
            return;
        }

        // If all files valid, preview them
        validFiles.forEach((file, index) => {
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);

            const fileItem = document.createElement('div');
            fileItem.className = 'file-item mb-2 d-flex align-items-center gap-2';

            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'file-thumb rounded';
                img.style.width = '40px';
                img.style.height = '40px';
                img.style.objectFit = 'cover';
                fileItem.appendChild(img);
            }

            const fileInfo = document.createElement('span');
            fileInfo.innerText = `${file.name} (${sizeMB} MB)`;
            fileItem.appendChild(fileInfo);

            preview.appendChild(fileItem);
        });
    });
</script>

    
    

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const incidentDate = document.getElementById('incident_date');

        if (incidentDate && typeof incidentDate.showPicker === 'function') {
            incidentDate.addEventListener('click', function () {
                this.showPicker();
            });

            incidentDate.addEventListener('focus', function () {
                this.showPicker();
            });
        }
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('declaration');
        const submitBtn = document.getElementById('submitBtn');
    
        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50');
            }
        });
    });
    </script>
@endpush