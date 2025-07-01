@extends('layouts.admin')

@section('content')
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
    <div class="container pt-4 pb-5">

        <!-- Heading -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <h4 class="fw-bold mb-0 fs-5 fs-md-4">
                Whistleblowing Reports
            </h4>
            <a href="{{ route('admin.reports.export') }}" class="btn btn-success btn-sm btn-md">
                <i class="fas fa-file-excel me-2"></i> Export to Excel
            </a>
        </div>        

        <!-- Card Table -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table id="reportsTable" class="table table-striped small table-hover align-middle mb-0 w-100">
                        <thead class="table-light">
                            <tr class="small text-uppercase text-muted">
                                <th class="text-nowrap">#</th>
                                <th class="text-nowrap">Report Number</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Category</th>
                                <th class="text-nowrap">Created At</th>
                                <th class="text-nowrap text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold" id="reportModalLabel">
                        <i class="fas fa-info-circle me-2"></i> Report Detail
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body small text-muted">
                    <div id="modalReportContent" class="text-center py-3">
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
            responsive: true,
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
