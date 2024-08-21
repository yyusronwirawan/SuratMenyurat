@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('admin.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            {{ __('Master User') }}
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Data User') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3 alert alert-info">
                            <label class="col-sm-2 col-form-label text-info" for="basic-default-department"
                                style="font-weight: bold;">{{ __('Select Department') }}</label>
                            <div class="col-sm-10">
                                <select id="departmentSelect" class="form-select">
                                    <option value="">{{ __('All Departments') }}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-bordered user_datatable">
                                    <thead>
                                        <tr>
                                            <th>{{ __('No') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('NPM') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Gender') }}</th>
                                            <th>{{ __('Department') }}</th>
                                            <th>{{ __('Study Program') }}</th>
                                            <th>{{ __('Role') }}</th>
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
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).on('click', '.swalSuccesDeleteUser', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'MENGHAPUS SEMUA DATA',
                text: "Apakah anda yakin ingin menghapus semua data user ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });

        $(function() {
            var table;

            function initDataTable(departmentId) {
                table = $('.user_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('masteruser.getByDepartementId', ':departmentId') }}"
                            .replace(':departmentId', departmentId),
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
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },

                        {
                            data: 'avatar',
                            name: 'avatar',
                            orderable: true,
                            searchable: false,
                            orderData: [
                                9
                            ]
                        },
                        {
                            data: 'npm',
                            name: 'npm'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'gender',
                            name: 'gender'
                        },
                        {
                            data: 'department_name',
                            name: 'department_name'
                        },
                        {
                            data: 'study_program_name',
                            name: 'study_program_name'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: true,
                            searchable: false,
                            orderData: [
                                10
                            ] // Mengatur pengurutan berdasarkan kolom role_name (indeks 5 dalam array kolom)
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'full_name', // Kolom tersembunyi
                            name: 'full_name',
                            visible: false, // Menyembunyikan kolom ini
                            orderable: true, // Kolom ini dapat diurutkan
                        }, {
                            data: 'role_name', // Kolom tersembunyi
                            name: 'role_name',
                            visible: false, // Menyembunyikan kolom ini
                            orderable: true, // Kolom ini dapat diurutkan
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

        function handleImageError(img) {
            if (!img.getAttribute('data-error-handled')) {
                img.src = '{{ asset('file/avatars/blank-profile.png') }}';
                img.alt = 'Image not found';
                img.setAttribute('data-error-handled', true);
            }
        }
    </script>
@endsection
