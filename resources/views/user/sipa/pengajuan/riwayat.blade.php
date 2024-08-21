@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('user.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            {{ __('Application History') }}
        </h4>

        <div class="row">
            <!-- Table-->
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Status of Application') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12 table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Form Type') }}</th>
                                        <th>{{ __('Date of Application') }}</th>
                                        <th>{{ __('Date of Process') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formSubmission as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->user()->fullName() }}</td>
                                            <td>{{ $value->formTemplate()->template_name }}</td>
                                            <td>{{ $value->submission_date }}</td>
                                            <td>{{ $value->processed_date }}</td>
                                            <td>
                                                <span class="badge bg-label-{{ $value->getLabelStatus() }}">
                                                    {{ $value->form_status }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item text-primary"
                                                            href="{{ route('pengajuan.preview', $value->id) }}">
                                                            <i class='bx bxs-show me-1'></i> Preview
                                                        </a>
                                                        @if ($value->form_status == 'Draft')
                                                            <a class="dropdown-item text-danger swalCancelPengajuan"
                                                                href="{{ route('pengajuan.cancel', $value->id) }}">
                                                                <i class='bx bx-x-circle me-1'></i> Cancel
                                                            </a>
                                                        @endif
                                                        @if ($value->form_status == 'Draft' || $value->form_status == 'Revisi')
                                                            <a class="dropdown-item"
                                                                href="{{ route('pengajuan.edit', $value->id) }}">
                                                                <i class='bx bx-edit me-1'></i> Edit
                                                            </a>
                                                        @endif
                                                        @if ($value->form_status == 'Draft')
                                                            <a class="dropdown-item text-primary swalSentPengajuan"
                                                                href="{{ route('pengajuan.sent', $value->id) }}">
                                                                <i class='bx bx-send me-1'></i> Sent
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $('.swalSentPengajuan').click(function(event) {
            event.preventDefault();
            var cancelUrl = $(this).attr('href'); // Mendapatkan URL pembatalan dari link

            Swal.fire({
                title: 'Kirim Pengajuan!',
                text: "Apakah Anda yakin ingin mengirim surat ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kirim!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = cancelUrl; // Arahkan ke URL pembatalan
                }
            });
        });

        $('.swalCancelPengajuan').click(function(event) {
            event.preventDefault();
            var cancelUrl = $(this).attr('href'); // Mendapatkan URL pembatalan dari link

            Swal.fire({
                title: 'Batalkan Pengajuan!',
                text: "Apakah Anda yakin ingin membatalkan surat ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batal!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = cancelUrl; // Arahkan ke URL pembatalan
                }
            });
        });
    </script>
@endsection
