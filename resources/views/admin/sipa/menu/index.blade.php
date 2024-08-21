@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('admin.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            {{ __('Set Menu') }}
        </h4>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ isset($otherMenu) ? __('Edit Data') : __('Add Data') }}</h5>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data"
                            action="{{ isset($otherMenu) ? route('menu-lain.update', $otherMenu->id) : route('menu-lain.store') }}"
                            method="POST">
                            @csrf
                            @method(isset($otherMenu) ? 'PUT' : 'POST')
                            <div class="mb-3">
                                <label class="form-label">{{ __('Menu Name') }}</label>
                                <input type="text" class="form-control @error('menu_name') is-invalid @enderror"
                                    name="menu_name"
                                    value="{{ isset($otherMenu) ? $otherMenu->menu_name : old('menu_name') }}" />
                                @error('menu_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Link') }}</label>
                                <input type="url" class="form-control @error('url') is-invalid @enderror" name="url"
                                    value="{{ isset($otherMenu) ? $otherMenu->url : old('url') }}" />
                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Sort Order') }}</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                    name="sort_order"
                                    value="{{ isset($otherMenu) ? $otherMenu->sort_order : old('sort_order') }}" />
                                @error('sort_order')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <button class="btn btn-primary btn-block"><b>{{ __('Save') }}</b></button>
                            @isset($otherMenu)
                                <a href="{{ route('menu-lain') }}"
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
                        <h5 class="mb-0">{{ __('Other Menu Data') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12 table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>{{ __('Menu Name') }}</th>
                                        <th>{{ __('Sort Order') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($otherMenus as $key => $value)
                                        <tr>
                                            <td>
                                                <a href="{{ $value->url }}" target="_blank">
                                                    {{ $value->menu_name }}
                                                </a>
                                            </td>
                                            <td>{{ $value->sort_order }}</td>
                                            @php
                                                $badgeClass =
                                                    $value->status == 'Active' ? 'bg-label-primary' : 'bg-label-danger';
                                            @endphp

                                            <td><span class="badge {{ $badgeClass }}">{{ $value->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">

                                                    <form action="{{ route('menu-lain.destroy', $value->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('menu-lain.edit', $value->id) }}"
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
