@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('user.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            {{ __('Download Form') }}
        </h4>



        {{-- <figure class="text-center mt-2">
            <blockquote class="blockquote">
                <h5 class="mb-0">Download {{ $titleForm }}</h5>
            </blockquote>
        </figure> --}}

        <div class="row">
            @if ($formTemplates->isNotEmpty())
                <div class="divider divider-dark">
                    <div class="divider-text"> {{ $formTemplates[0]->formType()->name }} </div>
                </div>
            @endif

            @php $prevTypeId = null; @endphp

            @foreach ($formTemplates as $key => $value)
                @if ($prevTypeId !== null && $prevTypeId !== $value->type_id)
                    <div class="w-100"></div>
                    <div class="divider divider-dark">
                        <div class="divider-text"> {{ $value->formType()->name }} </div>
                    </div>
                @endif

                <div class="col-sm-6 col-lg-6 mb-4">
                    <div class="card p-3 pb-1">
                        <p>
                            <i class="menu-icon bx bx-envelope text-primary"></i><a href="{{ $value->pathUrl() }}"
                                target="_blank">{{ $value->template_name }}</a>
                        </p>
                    </div>
                </div>

                @php $prevTypeId = $value->type_id; @endphp
            @endforeach




        </div>
    </div>
@endsection
