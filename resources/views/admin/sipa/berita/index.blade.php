@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('admin.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            Berita Dashboard
        </h4>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ isset($dashboardNew) ? __('Edit Data') : __('Add Data') }}</h5>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data"
                            action="{{ isset($dashboardNew) ? route('berita-dashboard.update', $dashboardNew->id) : route('berita-dashboard.store') }}"
                            method="POST">
                            @csrf
                            @method(isset($dashboardNew) ? 'PUT' : 'POST')
                            <div class="mb-3">
                                <label class="form-label">{{ __('Link') }}</label>
                                <input type="url" class="form-control @error('title') is-invalid @enderror"
                                    name="title"
                                    value="{{ isset($dashboardNew) ? $dashboardNew->title : old('title') }}" />
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Link Name') }}</label>
                                <input type="text" class="form-control @error('body') is-invalid @enderror"
                                    name="body" value="{{ isset($dashboardNew) ? $dashboardNew->body : old('body') }}" />
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Sort Order') }}</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                    name="sort_order"
                                    value="{{ isset($dashboardNew) ? $dashboardNew->sort_order : old('sort_order') }}" />
                                @error('sort_order')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="upload_file" class="form-label">{{ __('Upload Image') }} (1320*583
                                    pixel)</label>
                                <input class="form-control @error('upload_file') is-invalid @enderror" type="file"
                                    id="upload_file" name="upload_file"
                                    value="{{ isset($dashboardNew) ? $dashboardNew->url_file : old('url_file') }}" />
                                @error('upload_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-primary btn-block"><b>{{ __('Save') }}</b></button>
                            @isset($dashboardNew)
                                <a href="{{ route('berita-dashboard.index') }}"
                                    class="btn btn-secondary btn-block"><b>{{ __('Cancel') }}</b></a>
                            @endisset
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table-->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Dashboard News Data') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12 table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>{{ __('Link') }}</th>
                                        {{-- <th>Body</th> --}}
                                        <th>{{ __('Sort Order') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dashboardNews as $key => $value)
                                        <tr>
                                            <td>
                                                @if ($value->title)
                                                    <a href="{{ $value->title }}" target="_blank">
                                                        @if ($value->body)
                                                            {{ $value->body }}
                                                        @else
                                                            Lihat Selengkapnya
                                                        @endif
                                                    </a>
                                                @endif
                                            </td>
                                            {{-- <td>{{ $value->body }}</td> --}}
                                            <td>{{ $value->sort_order }}</td>
                                            <td align="center">
                                                @if ($value->pathUrl())
                                                    <a href="{{ $value->pathUrl() }}" class="badge bg-label-primary"
                                                        target="_blank">
                                                        Download
                                                    </a>
                                                @endif
                                            </td>
                                            @php
                                                $badgeClass =
                                                    $value->status == 'Active' ? 'bg-label-primary' : 'bg-label-danger';
                                            @endphp

                                            <td><span class="badge {{ $badgeClass }}">{{ $value->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">

                                                    <form action="{{ route('berita-dashboard.destroy', $value->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('berita-dashboard.edit', $value->id) }}"
                                                            class="btn btn-icon btn-outline-primary btn-sm">
                                                            <span class="tf-icons bx bx-edit-alt"></span>
                                                        </a>
                                                        <button type="submit"
                                                            class="btn btn-icon btn-outline-danger btn-sm swalSuccesInActive"><i
                                                                class="tf-icons bx bx-trash"></i></button>
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
