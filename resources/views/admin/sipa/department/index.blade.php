@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('admin.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            {{ __('Department') }}
        </h4>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ isset($department) ? __('Edit Data') : __('Add Data') }}</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($department) ? route('department.update', $department->id) : route('department.store') }}"
                            method="POST">
                            @csrf
                            @method(isset($department) ? 'PUT' : 'POST')
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-department">{{ __('Code of Department') }}</label>
                                <input type="text" class="form-control @error('department_code') is-invalid @enderror"
                                    id="basic-default-department" name="department_code"
                                    value="{{ isset($department) ? $department->department_code : old('department_code') }}" />
                                @error('department_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-department">{{ __('Name of Department') }}</label>
                                <input type="text" class="form-control @error('department_name') is-invalid @enderror"
                                    id="basic-default-department" name="department_name"
                                    value="{{ isset($department) ? $department->department_name : old('department_name') }}" />
                                @error('department_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <button class="btn btn-primary btn-block"><b>{{ __('Save') }}</b></button>
                            @isset($department)
                                <a href="{{ route('department.index') }}"
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
                        <h5 class="mb-0">{{ __('Data of Department') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12 table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('Name of Department') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $key => $value)
                                        <tr>
                                            <td>{{ $value->department_code }}</td>
                                            <td>{{ $value->department_name }}</td>
                                            @php
                                                $badgeClass =
                                                    $value->status == 'Active' ? 'bg-label-primary' : 'bg-label-danger';
                                            @endphp

                                            <td><span class="badge {{ $badgeClass }}">{{ $value->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">

                                                    <form action="{{ route('department.destroy', $value->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('department.edit', $value->id) }}"
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
