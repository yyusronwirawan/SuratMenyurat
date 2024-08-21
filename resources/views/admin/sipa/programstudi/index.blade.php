@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('admin.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            {{ __('Study Program') }}
        </h4>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ isset($studyProgram) ? __('Edit Data') : __('Add Data') }}</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($studyProgram) ? route('program-studi.update', $studyProgram->id) : route('program-studi.store') }}"
                            method="POST">
                            @csrf
                            @method(isset($studyProgram) ? 'PUT' : 'POST')
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-department">{{ __('Code of Study Program') }}</label>
                                <input type="text" class="form-control @error('study_program_code') is-invalid @enderror"
                                    id="basic-default-department" name="study_program_code"
                                    value="{{ isset($studyProgram) ? $studyProgram->study_program_code : old('study_program_code') }}" />
                                @error('study_program_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-department">{{ __('Name of Study Program') }}</label>
                                <input type="text" class="form-control @error('study_program_name') is-invalid @enderror"
                                    id="basic-default-department" name="study_program_name"
                                    value="{{ isset($studyProgram) ? $studyProgram->study_program_name : old('study_program_name') }}" />
                                @error('study_program_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="departmentName" class="form-label">{{ __('Name of Department') }}</label>
                                <select class="form-select @error('department_id') is-invalid @enderror""
                                    id="departmentName" aria-label="Default select example" name="department_id">
                                    <option></option>
                                    @foreach ($departments as $key => $value)
                                        <option value="{{ $value->id }}"
                                            {{ old('department_id') == $value->id ? 'selected' : '' }}
                                            {{ isset($studyProgram) ? ($studyProgram->department_id == $value->id ? 'selected' : '') : '' }}>
                                            {{ $value->department_name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-primary btn-block"><b>{{ __('Save') }}</b></button>
                            @isset($studyProgram)
                                <a href="{{ route('program-studi.index') }}"
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
                        <h5 class="mb-0">{{ __('Data of Study Program') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12 table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('Name of Department') }}</th>
                                        <th>{{ __('Name of Study Program') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studyPrograms as $key => $value)
                                        <tr>
                                            <td>{{ $value->study_program_code }}</td>
                                            <td>{{ $value->department()->department_name }}</td>
                                            <td>{{ $value->study_program_name }}</td>
                                            @php
                                                $badgeClass =
                                                    $value->status == 'Active' ? 'bg-label-primary' : 'bg-label-danger';
                                            @endphp

                                            <td><span class="badge {{ $badgeClass }}">{{ $value->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">

                                                    <form action="{{ route('program-studi.destroy', $value->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('program-studi.edit', $value->id) }}"
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
