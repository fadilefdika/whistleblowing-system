<div class="report-details-container">
    <div class="report-header mb-4">
        <h4 class="fw-semibold text-dark">Report #{{ $report->report_number }}</h4>
        <div class="header-divider"></div>
    </div>

    <div class="detail-grid">
        <div class="detail-item">
            <span class="detail-label">Category</span>
            <span class="detail-value">{{ Str::title($report->category) }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Status</span>
            <span class="detail-value">
                <span class="status-badge bg-{{ $badgeColor }}">
                    {{ Str::title($report->status) }}
                </span>
            </span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Incident Date</span>
            <span class="detail-value">{{ \Carbon\Carbon::parse($report->incident_date)->format('M j, Y') }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Location</span>
            <span class="detail-value">{{ $report->incident_location }}</span>
        </div>
    </div>

    <div class="description-section mt-4">
        <h6 class="section-title mb-3">Case Description</h6>
        <div class="description-content">
            {{ $report->case_description }}
        </div>
    </div>

    @php
        $files = [];

        if (!empty($report->supporting_document_path)) {
            $decoded = json_decode($report->supporting_document_path, true);
            if (is_array($decoded)) {
                $files = $decoded;
            } else {
                $files[] = $report->supporting_document_path;
            }
        }
    @endphp

    @if(count($files))
        <div class="attachments-section mt-4">
            <h6 class="section-title mb-3">Attachments</h6>
            <div class="file-list d-flex flex-column gap-2">
                @foreach($files as $file)
                    <a href="{{ asset('storage/' . $file) }}" target="_blank" class="file-item d-flex align-items-center gap-2 text-decoration-none text-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="file-icon">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                        </svg>
                        <span class="file-name">{{ basename($file) }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>

<style>
    .report-details-container {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        color: #333;
        line-height: 1.6;
    }

    .report-header {
        position: relative;
    }

    .header-divider {
        height: 2px;
        background: linear-gradient(90deg, rgba(0,114,245,0.1) 0%, rgba(0,114,245,0.6) 50%, rgba(0,114,245,0.1) 100%);
        margin-top: 8px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        font-size: 0.8rem;
        color: #6b7280;
        font-weight: 500;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 0.95rem;
        font-weight: 500;
        color: #111827;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
    }

    .section-title {
        font-size: 0.9rem;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .description-content {
        background: #f9fafb;
        border-radius: 6px;
        padding: 1rem;
        font-size: 0.9rem;
        line-height: 1.7;
    }

    .file-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .file-item {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 6px;
        background: #f9fafb;
        text-decoration: none;
        color: #374151;
        transition: all 0.2s ease;
    }

    .file-item:hover {
        background: #f0f4f8;
        color: #0072f5;
    }

    .file-icon {
        margin-right: 10px;
        flex-shrink: 0;
    }

    .file-name {
        font-size: 0.85rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>