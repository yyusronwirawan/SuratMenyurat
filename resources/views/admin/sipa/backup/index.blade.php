@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('admin.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            {{ __('Backup') }}
        </h4>

        <div class="row">
            <div class="col-md-12 mb-1">
                <form enctype="multipart/form-data" action="{{ route('backup.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button class="btn btn-primary btn-block"><b>Download (Jenis Form, Berita Dashboard)</b></button>
                </form>
            </div>
            <div class="col-md-12 mb-3">
                <form enctype="multipart/form-data" action="{{ route('backup.downloadDB') }}" method="POST">
                    @csrf


                    @method('PUT')
                    <button class="btn btn-primary btn-block"><b>Backup Database</b></button>
                </form>
            </div>

            <!-- Table-->
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">List Backup Database</h5>
                        <div class="card-subtitle text-muted mb-3">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12 table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Sent/Draft</th>
                                        <th>Approve</th>
                                        <th>Total File</th>
                                        <th>Processed ZIP</th>
                                        <th>Delete Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->created_at_month }}</td>
                                            <td>{{ $value->file_berkas }}</td>
                                            <td>{{ $value->file_approve }}</td>
                                            <td>{{ $value->total_files }}</td>
                                            <td><a href="{{ route('backup.edit', $value->created_at_month) }}"
                                                    class="badge bg-label-primary">
                                                    Download
                                                </a></td>
                                            <td>
                                                <div class="btn-group">
                                                    <form action="{{ route('backup.destroy', $value->created_at_month) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a type="submit"
                                                            class="badge bg-label-danger swalDeleteData">Delete</a>
                                                    </form>
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
        $('.swalDeleteData').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'MENGHAPUS SEMUA DATA',
                text: "Apakah anda yakin ingin menghapus semua data ini?",
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
    </script>
@endsection
