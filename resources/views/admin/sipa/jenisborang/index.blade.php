@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('admin.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            {{ __('Form Type') }}
        </h4>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ isset($formTemplate) ? __('Edit Data') : __('Add Data') }}</h5>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data"
                            action="{{ isset($formTemplate) ? route('jenis-borang.update', $formTemplate->id) : route('jenis-borang.store') }}"
                            method="POST">
                            @csrf
                            @method(isset($formTemplate) ? 'PUT' : 'POST')
                            <div class="mb-3">
                                <label class="form-label">{{ __('Form Name') }}</label>
                                <input type="text" class="form-control @error('template_name') is-invalid @enderror"
                                    name="template_name"
                                    value="{{ isset($formTemplate) ? $formTemplate->template_name : old('template_name') }}" />
                                @error('template_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="tipeBorang" class="form-label">{{ __('Form Category') }}</label>
                                <select class="form-select @error('type_id') is-invalid @enderror" id="tipeBorang"
                                    aria-label="Default select example" name="type_id">
                                    <option></option>
                                    @foreach ($formType as $key => $value)
                                        <option value="{{ $value->id }}"
                                            {{ old('type_id') == $value->id ? 'selected' : '' }}
                                            {{ isset($formTemplate) ? ($formTemplate->type_id == $value->id ? 'selected' : '') : '' }}>
                                            {{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Sort Order') }}</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                    name="sort_order"
                                    value="{{ isset($formTemplate) ? $formTemplate->sort_order : old('sort_order') }}" />
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="upload_file" class="form-label">{{ __('Upload Template') }}</label>
                                <input class="form-control @error('upload_file') is-invalid @enderror" type="file"
                                    id="upload_file" name="upload_file"
                                    value="{{ isset($formTemplate) ? $formTemplate->url_file : old('url_file') }}" />
                                @error('upload_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-primary btn-block"><b>{{ __('Save') }}</b></button>
                            @isset($formTemplate)
                                <a href="{{ route('jenis-borang.index') }}"
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
                        <h5 class="mb-0">{{ __('Form Type Data') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12 table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>{{ __('Form Type') }}</th>
                                        <th>{{ __('Form Category') }}</th>
                                        <th>{{ __('Sort') }}</th>
                                        <th>{{ __('File') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formTemplates as $key => $value)
                                        <tr>
                                            <td>{{ $value->template_name }}</td>
                                            <td>{{ $value->formType()->name }}</td>
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

                                                    <form action="{{ route('jenis-borang.destroy', $value->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('jenis-borang.edit', $value->id) }}"
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
