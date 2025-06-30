@extends('layouts.admin')

@section('content')
<div class="container pt-3 pb-4">
    <h4 class="mb-2 fw-bold fs-5">Whistleblowing Reports</h4>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
    
            <div class="table-responsive">
                <table id="reportsTable" class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Report Number</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    
</div>

<!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="reportModalLabel">Report Detail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Diisi lewat AJAX -->
          <div id="modalReportContent" class="small text-muted text-center py-2">
              <i class="fas fa-spinner fa-spin"></i> Loading...
          </div>
        </div>
      </div>
    </div>
  </div>
  
@endsection

@push('scripts')

<script>
    $(document).ready(function () {
        $('#reportsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.reports.data') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'report_number', name: 'report_number' },
                { data: 'status', name: 'status' },
                { data: 'category', name: 'category' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#reportsTable').on('click', '.view-report-btn', function () {
            const reportId = $(this).data('id');
            $('#reportModal').modal('show');
            $('#modalReportContent').html('<i class="fas fa-spinner fa-spin"></i> Loading...');
    
            $.ajax({
                url: `/admin/reports/${reportId}`,
                method: 'GET',
                success: function (response) {
                    $('#modalReportContent').html(response);
                },
                error: function () {
                    $('#modalReportContent').html('<div class="text-danger">Failed to load report details.</div>');
                }
            });
        });
    });
    </script>
    
@endpush
