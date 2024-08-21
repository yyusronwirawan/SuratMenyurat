@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-12">
                <div class="card alert alert-primary">
                    <div class="card-body p-2">
                        <div class="row">
                            <label class="col-sm-2 col-form-label text-primary" for="basic-default-department"
                                style="font-weight: bold;">{{ __('Select Department') }}</label>
                            <div class="col-sm-10">
                                <select id="departmentSelect" class="form-select" onchange="getDepartmentData()">
                                    <option value="0">{{ __('All Departments') }}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Total -->
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-dark text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex pb-1">
                            <div class="me-3 d-flex align-items-center">
                                <i class="bx bx-hourglass" style="font-size: 3rem"></i>
                            </div>
                            <div
                                class="d-flex w-100 flex-wrap adivgn-items-center justify-content-center gap-2 text-center">
                                <div class="me-2">
                                    <h6 class="d-block mb-2 text-white">{{ __('NOT PROCESSED') }}</h6>
                                    <h3 class="card-title mb-0 text-white" style="font-weight: bolder;">
                                        <span id="sent">{{ isset($sent) ? $sent : 0 }}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex pb-1">
                            <div class="me-3 d-flex align-items-center">
                                <i class="bx bx-time-five" style="font-size: 3rem"></i>
                            </div>
                            <div
                                class="d-flex w-100 flex-wrap adivgn-items-center justify-content-center gap-2 text-center">
                                <div class="me-2">
                                    <h6 class="d-block mb-2 text-white">{{ __('REVIEWED') }}</h6>
                                    <h3 class="card-title mb-0 text-white" style="font-weight: bolder;">
                                        <span id="reviewed">{{ isset($reviewed) ? $reviewed : 0 }}</span>

                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex pb-1">
                            <div class="me-3 d-flex align-items-center">
                                <i class="bx bx-x-circle" style="font-size: 3rem"></i>
                            </div>
                            <div
                                class="d-flex w-100 flex-wrap adivgn-items-center justify-content-center gap-2 text-center">
                                <div class="me-2">
                                    <h6 class="d-block mb-2 text-white">{{ __('REJECTED') }}</h6>
                                    <h3 class="card-title mb-0 text-white" style="font-weight: bolder;">
                                        <span id="reject">{{ isset($reject) ? $reject : 0 }}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex pb-1">
                            <div class="me-3 d-flex align-items-center">
                                <i class="bx bx-check-circle" style="font-size: 3rem"></i>
                            </div>
                            <div
                                class="d-flex w-100 flex-wrap adivgn-items-center justify-content-center gap-2 text-center">
                                <div class="me-2">
                                    <h6 class="d-block mb-2 text-white">{{ __('FINISHED') }}</h6>
                                    <h3 class="card-title mb-0 text-white" style="font-weight: bolder;">
                                        <span id="finished">{{ isset($finished) ? $finished : 0 }}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menunggu Pemrosesan -->
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Hi, {{ $user->fullName() }} 🎉</h5>
                                <p class="mb-4">
                                    {{ __('Welcome Administrator') }} <br>
                                    Aplikasi <span class="fw-medium">Sistem Informasi
                                        Persuratan
                                        Akademik</span>
                                </p>
                                <a href="{{ route('pengajuanadmin.index') }}"
                                    class="btn btn-sm btn-outline-primary">{{ __('List of Application') }}</a>
                            </div>
                        </div>
                        <div class="col-md-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('/img/undraw_road_to_knowledge_m8s0.svg') }}" height="140"
                                    alt="View Badge User" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0 mb-3">
                                        <i class="bx bx-edit text-success" style="font-size: 3rem"></i>
                                    </div>
                                </div>
                                <span class="fw-medium d-block mb-1"><b>{{ __('Submission') }}</b></span>
                                <h3 class="card-title mb-2 text-success"><span
                                        id="totalSubmission">{{ isset($totalSubmission) ? $totalSubmission : 0 }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0 mb-3">
                                        <i class="bx bx-user text-primary" style="font-size: 3rem"></i>
                                    </div>
                                </div>
                                <span class="fw-medium d-block mb-1"><b>{{ __('User') }}</b></span>
                                <h3 class="card-title mb-2 text-primary">
                                    <span id="totalUser">{{ isset($totalUser) ? $totalUser : 0 }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Menunggu Pemrosesan -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card" style="min-height: 175px">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">{{ __('Processing Application') }}</h5>
                        <div class="card-subtitle text-muted mb-3"></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-sm table-bordered user_datatable">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Study Program') }}</th>
                                            <th>{{ __('Form Type') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pagination">
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Total Revenue -->
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0 mb-3">
                                            <i class="bx bx-file text-info" style="font-size: 3rem"></i>
                                        </div>
                                    </div>
                                    <span class="fw-medium d-block mb-1"><b>{{ __('File') }}</b></span>
                                    <h3 class="card-title mb-2 text-info"> <span
                                            id="totalFile">{{ isset($totalFile) ? $totalFile : 0 }}</span>
                                        {{ __('File') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0 mb-3">
                                            <i class="bx bx-server text-warning" style="font-size: 3rem"></i>
                                        </div>
                                    </div>
                                    <span class="fw-medium d-block mb-1"><b>{{ __('Size') }}</b></span>
                                    <h3 class="card-title mb-2 text-warning"><span
                                            id="totalSizeFile">{{ isset($totalSizeFile) ? $totalSizeFile : 0 }}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        getDepartmentData();

        function getDepartmentData() {
            var departmentId = document.getElementById('departmentSelect').value;

            var apiUrl = "{{ route('getDataHome', ['departmentId' => ':departmentId']) }}";
            apiUrl = apiUrl.replace(':departmentId', departmentId);
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalSubmission').innerText = data.totalSubmission;
                    document.getElementById('sent').innerText = data.sent;
                    document.getElementById('reviewed').innerText = data.reviewed;
                    document.getElementById('reject').innerText = data.reject;
                    document.getElementById('finished').innerText = data.finished;
                    document.getElementById('totalUser').innerText = data.totalUser;
                    document.getElementById('totalFile').innerText = data.totalFile;
                    document.getElementById('totalSizeFile').innerText = data.totalSizeFile;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }



        $(function() {
            var table;

            function initDataTable(departmentId) {
                table = $('.user_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('getPengajuanByDepartmentId', ['departmentId' => ':departmentId', 'status' => ':status']) }}"
                            .replace(':departmentId', departmentId)
                            .replace(':status', 'Sent'),
                        data: function(d) {
                            d.searchInput = $('#searchInput').val();
                        }
                    },
                    "order": [],
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    oLanguage: {
                        "sEmptyTable": "{{ __('No data available in table') }}",
                        "sProcessing": "{{ __('Processing') }}...",
                        "sLengthMenu": "{{ __('Show _MENU_ entries') }}",
                        "sZeroRecords": "{{ __('No matching records found') }}",
                        "sInfo": "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                        "sInfoEmpty": "{{ __('Showing 0 to 0 of 0 entries') }}",
                        "sInfoFiltered": "{{ __('(filtered from _MAX_ total entries)') }}",
                        "sInfoPostFix": "",
                        "sSearch": "{{ __('Search') }}:",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "<i class='tf-icon bx bx-chevrons-left'></i>",
                            "sPrevious": "<i class='tf-icon bx bx-chevron-left'></i>",
                            "sNext": "<i class='tf-icon bx bx-chevron-right'></i>",
                            "sLast": "<i class='tf-icon bx bx-chevrons-right'></i>"
                        }
                    },
                    columns: [{
                            data: 'full_name',
                            name: 'full_name'
                        },
                        {
                            data: 'study_program_name',
                            name: 'study_program_name'
                        },
                        {
                            data: 'template_name',
                            name: 'template_name'
                        },

                        {
                            data: 'status',
                            name: 'status',
                            orderable: true,
                            searchable: false,
                            orderData: [
                                5
                            ]
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'form_status', // Kolom tersembunyi
                            name: 'form_status',
                            visible: false, // Menyembunyikan kolom ini
                            orderable: true, // Kolom ini dapat diurutkan
                        },
                        {
                            data: 'updated_by', // Kolom tersembunyi
                            name: 'updated_by',
                            visible: false, // Menyembunyikan kolom ini
                            orderable: false, // Kolom ini dapat diurutkan
                        }
                    ]
                });
            }

            // Initial load with departmentId = 0
            initDataTable(0);

            // Handle change event on departmentSelect dropdown
            $('#departmentSelect').on('change', function() {
                var departmentId = $(this).val() || 0; // If no value selected, default to 0
                table.destroy(); // Destroy existing DataTable
                initDataTable(departmentId); // Initialize DataTable with new departmentId
            });
        });
    </script>
@endsection
